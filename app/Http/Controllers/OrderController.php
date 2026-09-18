<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        // Kelompokkan menu per stand, hanya yang tersedia
        $menus = Menu::where('is_available', true)->get();

        // Daftar stand unik (urutan sesuai nama)
        $stands = $menus->pluck('stand')->unique()->sort()->values();

        // Per stand → koleksi menu
        $menusByStand = $menus->groupBy('stand');

        // Tetap kirim $makanan & $minuman untuk kompatibilitas JS harga
        $makanan = $menus->where('category', 'makanan');
        $minuman = $menus->where('category', 'minuman');

        return view('welcome', compact('menus', 'stands', 'menusByStand', 'makanan', 'minuman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_name'   => 'required|string|max:255',
            'class_major'    => 'required|string|max:255',
            'whatsapp'       => 'required|string|max:20',
            'break_time'     => 'required|in:Istirahat 1,Istirahat 2',
            'payment_method' => 'required|in:tunai,qris',
            'items'          => 'required|array',
            'items.*'        => 'nullable|integer|min:0',
        ]);

        // ── Hitung item & validasi stok ──────────────────────────────
        $orderItems = [];
        $totalPrice = 0;
        $stockErrors = [];

        foreach ($request->items as $menuId => $quantity) {
            $quantity = (int) $quantity;
            if ($quantity <= 0) continue;

            $menu = Menu::find($menuId);
            if (! $menu) continue;

            // Validasi stok
            if (! is_null($menu->stock) && $menu->stock < $quantity) {
                $stockErrors[] = "Stok \"{$menu->name}\" hanya tersisa {$menu->stock} porsi.";
                continue;
            }

            $subtotal     = $menu->price * $quantity;
            $totalPrice  += $subtotal;
            $orderItems[] = [
                'menu'     => $menu,
                'menu_id'  => $menu->id,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];
        }

        if (! empty($stockErrors)) {
            return back()->withInput()->with('error', implode(' ', $stockErrors));
        }

        if (empty($orderItems)) {
            return back()->withInput()->with('error', 'Pilih minimal satu menu sebelum memesan!');
        }

        // ── Generate kode antrean unik ───────────────────────────────
        // Format: KBT-{3 digit urutan hari ini}, contoh: KBT-001
        $todayCount = Order::whereDate('created_at', today())->count() + 1;
        $queueCode  = 'KBT-' . str_pad($todayCount, 3, '0', STR_PAD_LEFT);

        // ── Simpan order dalam satu transaksi ────────────────────────
        DB::transaction(function () use (&$order, $request, $orderItems, $totalPrice, $queueCode) {
            $order = Order::create([
                'student_name'   => $request->student_name,
                'class_major'    => $request->class_major,
                'whatsapp'       => $request->whatsapp,
                'break_time'     => $request->break_time,
                'total_price'    => $totalPrice,
                'status'         => 'pending',
                'queue_code'     => $queueCode,
                'payment_method' => $request->payment_method,
            ]);

            foreach ($orderItems as $item) {
                $order->items()->create([
                    'menu_id'  => $item['menu_id'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['subtotal'],
                ]);

                // Kurangi stok jika terbatas (bukan null)
                if (! is_null($item['menu']->stock)) {
                    $item['menu']->decrement('stock', $item['quantity']);
                }
            }
        });

        // Siapkan data struk untuk modal di halaman berikutnya
        $estimasi = match($order->break_time) {
            'Istirahat 1' => 'Siap sekitar pukul 10.00',
            'Istirahat 2' => 'Siap sekitar pukul 12.00',
            default       => 'Sesuai jam istirahat',
        };

        $strutItems = $order->items->map(fn($i) => [
            'name'    => $i->menu->name,
            'qty'     => $i->quantity,
            'subtotal'=> $i->subtotal,
        ])->toArray();

        session()->flash('new_order', [
            'queue_code'    => $order->queue_code,
            'student_name'  => $order->student_name,
            'class_major'   => $order->class_major,
            'break_time'    => $order->break_time,
            'estimasi'      => $estimasi,
            'payment_method'=> $order->payment_method,
            'payment_label' => $order->payment_method === 'qris' ? 'QRIS / Cashless' : 'Bayar Tunai saat Ambil',
            'total_price'   => $order->total_price,
            'items'         => $strutItems,
        ]);

        return redirect()->route('home');
    }

    public function show(string $id)
    {
        $order = Order::with('items.menu')->findOrFail($id);
        return view('order_detail', compact('order'));
    }
}
