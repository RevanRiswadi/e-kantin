<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <title>Struk Pesanan {{ $order->queue_code ?? '#'.$order->id }} - E-Kantin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>* { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="min-h-screen flex items-center justify-center p-3 sm:p-6 overflow-x-hidden antialiased" style="background:#0b1324;">

    <div class="w-full max-w-md space-y-4 my-auto">

        {{-- Header --}}
        <div class="text-center">
            <div class="text-4xl sm:text-5xl mb-2">✅</div>
            <h2 class="text-lg sm:text-xl font-extrabold text-white">Pesanan Berhasil!</h2>
            <p class="text-xs mt-1" style="color:#94a3b8;">Tunjukkan halaman ini ke kasir saat mengambil pesanan</p>
        </div>

        {{-- Kode Antrean --}}
        <div class="rounded-2xl p-4 sm:p-5 text-center"
             style="background:linear-gradient(135deg,rgba(217,119,6,.25),rgba(202,138,4,.1));border:1px solid rgba(245,158,11,.35);">
            <p class="text-xs font-bold uppercase tracking-widest mb-1" style="color:#fbbf24;">Kode Antrean</p>
            <p class="text-4xl sm:text-5xl font-extrabold text-white tracking-widest">
                #{{ $order->queue_code ?? str_pad($order->id, 3, '0', STR_PAD_LEFT) }}
            </p>
            <p class="text-xs mt-2" style="color:#94a3b8;">Nomor antrian Anda hari ini</p>
        </div>

        {{-- Detail Pesanan --}}
        <div class="rounded-2xl p-4 sm:p-5 space-y-3 text-xs sm:text-sm"
             style="background:#131d31;border:1px solid rgba(148,163,184,.1);">

            <div class="grid grid-cols-2 gap-y-2.5">
                <span style="color:#94a3b8;">Pemesan</span>
                <span class="font-semibold text-white text-right truncate">{{ $order->student_name }}</span>

                <span style="color:#94a3b8;">Kelas</span>
                <span class="font-semibold text-white text-right truncate">{{ $order->class_major }}</span>

                <span style="color:#94a3b8;">WhatsApp</span>
                <span class="font-semibold text-white text-right">{{ $order->whatsapp }}</span>

                <span style="color:#94a3b8;">Pengambilan</span>
                <span class="font-bold text-right" style="color:#fbbf24;">{{ $order->break_time }}</span>

                <span style="color:#94a3b8;">Pembayaran</span>
                <span class="font-semibold text-white text-right">
                    {{ $order->payment_method === 'qris' ? '📲 QRIS / Cashless' : '💵 Bayar Tunai' }}
                </span>

                <span style="color:#94a3b8;">Status</span>
                <span class="text-right">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase
                        {{ $order->status === 'pending'    ? 'bg-amber-500/20 text-amber-400' : '' }}
                        {{ $order->status === 'processing' ? 'bg-blue-500/20 text-blue-400'   : '' }}
                        {{ $order->status === 'ready'      ? 'bg-emerald-500/20 text-emerald-400' : '' }}
                        {{ $order->status === 'completed'  ? 'bg-slate-500/20 text-slate-400' : '' }}">
                        {{ $order->status }}
                    </span>
                </span>
            </div>

            {{-- Daftar Item --}}
            <div class="border-t pt-3 space-y-2" style="border-color:rgba(71,85,105,.3);">
                <p class="text-xs font-bold uppercase tracking-wider" style="color:#64748b;">Menu Dipesan</p>
                @foreach($order->items as $item)
                    <div class="flex justify-between text-xs gap-2">
                        <span style="color:#cbd5e1;" class="truncate">
                            {{ $item->menu->name ?? 'Menu Dihapus' }}
                            <span class="font-bold" style="color:#fbbf24;">×{{ $item->quantity }}</span>
                        </span>
                        <span class="font-semibold text-white shrink-0">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>

            {{-- Total --}}
            <div class="flex justify-between items-center font-extrabold text-sm sm:text-base pt-2 border-t"
                 style="border-color:rgba(71,85,105,.3);">
                <span class="text-white">Total Bayar</span>
                <span style="color:#fbbf24;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- CTA --}}
        <a href="{{ route('home') }}"
           class="flex items-center justify-center gap-2 w-full py-3.5 sm:py-4 rounded-xl font-bold text-sm text-white transition shadow-lg min-h-[48px]"
           style="background:#d97706;"
           onmouseover="this.style.backgroundColor='#b45309'"
           onmouseout="this.style.backgroundColor='#d97706'">
            ⬅ Kembali ke Menu Utama
        </a>

    </div>
</body>
</html>
