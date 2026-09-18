<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.menu')->latest()->get();

        // ── Rekap Dapur: total porsi per menu per jam istirahat (hari ini, non-cancelled) ──
        $rekapDapur = DB::table('order_items')
            ->join('menus',  'order_items.menu_id',  '=', 'menus.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereDate('orders.created_at', today())
            ->whereIn('orders.status', ['pending', 'processing', 'ready'])
            ->selectRaw('
                orders.break_time,
                menus.id        as menu_id,
                menus.name      as menu_name,
                menus.stand     as stand,
                menus.category  as category,
                SUM(order_items.quantity) as total_porsi
            ')
            ->groupBy('orders.break_time', 'menus.id', 'menus.name', 'menus.stand', 'menus.category')
            ->orderBy('orders.break_time')
            ->orderByDesc('total_porsi')
            ->get();

        // Kelompokkan per break_time → per stand
        $rekapByTime = $rekapDapur->groupBy('break_time')->map(fn($rows) => $rows->groupBy('stand'));

        return view('admin.dashboard', compact('orders', 'rekapByTime'));
    }

    public function updateStatus(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    public function menu()
    {
        $menus   = Menu::orderBy('stand')->orderBy('category')->orderBy('name')->get();
        $makanan = $menus->where('category', 'makanan');
        $minuman = $menus->where('category', 'minuman');
        $stands  = $menus->pluck('stand')->unique()->sort()->values();
        return view('admin.menu', compact('menus', 'makanan', 'minuman', 'stands'));
    }

    public function storeMenu(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'category'     => 'required|in:makanan,minuman',
            'stand'        => 'required|string|max:255',
            'price'        => 'required|integer|min:500',
            'stock'        => 'nullable|integer|min:0',
            'is_available' => 'nullable|boolean',
        ]);

        Menu::create([
            'name'         => $request->name,
            'category'     => $request->category,
            'stand'        => $request->stand,
            'price'        => $request->price,
            'stock'        => $request->stock ?: null,
            'is_available' => $request->boolean('is_available', true),
        ]);

        return back()->with('success', "Menu \"{$request->name}\" berhasil ditambahkan!");
    }

    public function updateMenu(Request $request, string $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'name'         => 'required|string|max:255',
            'category'     => 'required|in:makanan,minuman',
            'stand'        => 'required|string|max:255',
            'price'        => 'required|integer|min:500',
            'stock'        => 'nullable|integer|min:0',
            'is_available' => 'nullable|boolean',
        ]);

        $menu->update([
            'name'         => $request->name,
            'category'     => $request->category,
            'stand'        => $request->stand,
            'price'        => $request->price,
            'stock'        => $request->stock ?: null,
            'is_available' => $request->boolean('is_available', true),
        ]);

        return back()->with('success', "Menu \"{$menu->name}\" berhasil diperbarui!");
    }

    public function destroyMenu(string $id)
    {
        $menu = Menu::findOrFail($id);
        $name = $menu->name;
        $menu->delete();
        return back()->with('success', "Menu \"{$name}\" berhasil dihapus.");
    }

    public function toggleMenuStatus(string $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->update(['is_available' => ! $menu->is_available]);
        $status = $menu->is_available ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Menu \"{$menu->name}\" berhasil {$status}.");
    }

    public function orders()
    {
        $orders  = Order::with('items.menu')->latest()->get();
        $pending    = $orders->where('status', 'pending')->count();
        $processing = $orders->where('status', 'processing')->count();
        $ready      = $orders->where('status', 'ready')->count();
        $completed  = $orders->where('status', 'completed')->count();
        return view('admin.orders', compact('orders', 'pending', 'processing', 'ready', 'completed'));
    }

    public function laporan()
    {
        // Pendapatan per hari (7 hari terakhir)
        $dailyRevenue = Order::where('status', 'completed')
            ->where('created_at', '>=', now()->subDays(7))
            ->selectRaw('DATE(created_at) as tanggal, SUM(total_price) as total, COUNT(*) as jumlah')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        // Menu terlaris
        $menuTerlaris = DB::table('order_items')
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->selectRaw('menus.name, menus.category, menus.price, SUM(order_items.quantity) as total_qty, SUM(order_items.subtotal) as total_pendapatan')
            ->groupBy('menus.id', 'menus.name', 'menus.category', 'menus.price')
            ->orderByDesc('total_qty')
            ->get();

        // Ringkasan total
        $totalPendapatan  = Order::where('status', 'completed')->sum('total_price');
        $totalPesanan     = Order::count();
        $pesananSelesai   = Order::where('status', 'completed')->count();
        $pesananPending   = Order::where('status', 'pending')->count();

        return view('admin.laporan', compact(
            'dailyRevenue', 'menuTerlaris',
            'totalPendapatan', 'totalPesanan', 'pesananSelesai', 'pesananPending'
        ));
    }
}