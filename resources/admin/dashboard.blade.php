<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - E-Kantin SMKN 1 Ciomas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[#f4f5fa] text-slate-800 min-h-screen flex">

    <!-- SIDEBAR (NAVIGASI KIRI) -->
    <aside class="w-64 bg-[#0e1428] text-slate-400 flex flex-col justify-between shrink-0 sticky top-0 h-screen border-r border-slate-800">
        <div>
            <!-- Header Sidebar -->
            <div class="p-6 flex items-center gap-3 border-b border-slate-800/50">
                <div class="w-10 h-10 bg-amber-500/10 text-amber-500 rounded-xl flex items-center justify-center font-bold text-xl border border-amber-500/20">
                    🍱
                </div>
                <div>
                    <h2 class="font-extrabold text-white text-base leading-tight">Admin Panel</h2>
                    <span class="text-[10px] text-amber-500 font-semibold tracking-wider uppercase">SMKN 1 Ciomas</span>
                </div>
            </div>

            <!-- Menu Utama -->
            <div class="px-4 py-6">
                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-3 block mb-3">Overview</span>
                <nav class="space-y-1">
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-amber-400 bg-amber-500/10 border border-amber-500/10 rounded-xl">
                        <span>📊</span> Dashboard
                    </a>
                </nav>

                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-3 block mt-6 mb-3">Manajemen</span>
                <nav class="space-y-1">
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-slate-800/40 hover:text-white rounded-xl transition">
                        <span>🍔</span> Data Menu
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-slate-800/40 hover:text-white rounded-xl transition">
                        <span>📝</span> Riwayat Pesanan
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-slate-800/40 hover:text-white rounded-xl transition">
                        <span>📈</span> Laporan Keuangan
                    </a>
                </nav>

                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-3 block mt-6 mb-3">System</span>
                <nav class="space-y-1">
                    <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-slate-800/40 hover:text-white rounded-xl transition">
                        <span>🌐</span> Lihat Website
                    </a>
                </nav>
            </div>
        </div>

        <!-- Footer Sidebar -->
        <div class="p-4 border-t border-slate-800/50">
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-rose-400 hover:bg-rose-500/10 rounded-xl transition">
                <span>🚪</span> Logout
            </a>
        </div>
    </aside>

    <!-- KONTEN UTAMA (KANAN) -->
    <main class="flex-1 p-8 overflow-y-auto">
        <!-- TOP BAR (HEADER) -->
        <header class="flex justify-between items-center mb-8 pb-4 border-b border-slate-200">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Dashboard</h1>
                <p class="text-xs text-slate-400 font-medium mt-1">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <h3 class="text-sm font-bold text-slate-900">Kasir Kantin</h3>
                    <span class="text-[10px] text-slate-400 font-medium">Administrator</span>
                </div>
                <div class="w-10 h-10 rounded-full bg-amber-500 text-white font-extrabold flex items-center justify-center text-sm shadow-md">
                    K
                </div>
            </div>
        </header>

        <!-- KARTU STATISTIK (CARD RINGKASAN) -->
        <div class="mb-8">
            <h2 class="text-xl font-extrabold text-slate-800 flex items-center gap-2 mb-1">Selamat Datang! 👋</h2>
            <p class="text-xs text-slate-400 font-medium mb-6">Ringkasan kondisi kantin SMKN 1 Ciomas hari ini</p>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 flex items-center gap-4 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 bg-amber-100 text-amber-500 rounded-xl flex items-center justify-center font-bold text-lg">
                        🛒
                    </div>
                    <div>
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Pesanan Baru</span>
                        <h3 class="text-2xl font-extrabold text-slate-800 leading-tight mt-0.5">{{ $orders->where('status', 'pending')->count() }}</h3>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 flex items-center gap-4 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-500 rounded-xl flex items-center justify-center font-bold text-lg">
                        💰
                    </div>
                    <div>
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Hari Ini</span>
                        <h3 class="text-xl font-extrabold text-slate-800 leading-tight mt-1">Rp {{ number_format($orders->where('status', 'completed')->sum('total_price'), 0, ',', '.') }}</h3>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 flex items-center gap-4 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 bg-blue-100 text-blue-500 rounded-xl flex items-center justify-center font-bold text-lg">
                        🍽️
                    </div>
                    <div>
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Total Menu</span>
                        <h3 class="text-2xl font-extrabold text-slate-800 leading-tight mt-0.5">{{ \App\Models\Menu::count() }}</h3>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 flex items-center gap-4 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 bg-purple-100 text-purple-500 rounded-xl flex items-center justify-center font-bold text-lg">
                        👥
                    </div>
                    <div>
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Siswa Order</span>
                        <h3 class="text-2xl font-extrabold text-slate-800 leading-tight mt-0.5">{{ $orders->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- CHARTS & AKTIVITAS (DUA KOLOM) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Left: Donut Chart Status Pesanan -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                <h3 class="text-sm font-extrabold text-slate-800 mb-6 flex items-center gap-2">📊 Status Pesanan</h3>
                
                <!-- Mock Circle Gradient -->
                <div class="relative w-40 h-40 mx-auto flex items-center justify-center rounded-full bg-white shadow-inner"
                     style="background: conic-gradient(#f59e0b 0% 25%, #3b82f6 25% 55%, #10b981 55% 80%, #cbd5e1 80% 100%);">
                    <div class="absolute w-28 h-28 bg-white rounded-full flex flex-col items-center justify-center">
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Total</span>
                        <span class="text-2xl font-extrabold text-slate-800 leading-none">{{ $orders->count() }}</span>
                    </div>
                </div>

                <!-- Legends -->
                <div class="mt-6 grid grid-cols-2 gap-x-2 gap-y-1.5 text-xs">
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 bg-amber-500 rounded-full"></span>
                        <span class="text-slate-500 font-semibold">Pending ({{ $orders->where('status', 'pending')->count() }})</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                        <span class="text-slate-500 font-semibold">Proses ({{ $orders->where('status', 'processing')->count() }})</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 bg-emerald-500 rounded-full"></span>
                        <span class="text-slate-500 font-semibold">Ready ({{ $orders->where('status', 'ready')->count() }})</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 bg-slate-300 rounded-full"></span>
                        <span class="text-slate-500 font-semibold">Selesai ({{ $orders->where('status', 'completed')->count() }})</span>
                    </div>
                </div>
            </div>

            <!-- Right: Aktivitas Terbaru (2/3 width) -->
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-sm font-extrabold text-slate-800 flex items-center gap-2">⏱️ Aktivitas Pesanan</h3>
                    <a href="#" class="text-[11px] font-bold text-amber-500 hover:text-amber-600 bg-amber-50 px-2.5 py-1.5 rounded-lg transition">Lihat Semua</a>
                </div>

                <div class="space-y-4 flex-1">
                    @forelse($orders->take(4) as $order)
                        <div class="flex justify-between items-center p-3 rounded-xl border border-slate-100 hover:bg-slate-50 transition">
                            <div class="flex gap-3 items-center">
                                <div class="w-10 h-10 bg-slate-100 text-slate-500 rounded-lg flex items-center justify-center font-bold text-sm">
                                    📦
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900 leading-snug">{{ $order->student_name }}</h4>
                                    <p class="text-[10px] text-slate-400 mt-0.5">Memesan menu pre-order untuk {{ $order->break_time }}</p>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider
                                {{ $order->status == 'pending' ? 'bg-amber-100 text-amber-600' : '' }}
                                {{ $order->status == 'processing' ? 'bg-blue-100 text-blue-600' : '' }}
                                {{ $order->status == 'ready' ? 'bg-emerald-100 text-emerald-600' : '' }}
                                {{ $order->status == 'completed' ? 'bg-slate-100 text-slate-500' : '' }}">
                                {{ $order->status }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center text-xs text-slate-400 py-10">Belum ada aktivitas baru hari ini.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- TABEL DATA UTAMA -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-sm font-extrabold text-slate-800">📋 Pesanan & Staf Siswa Terbaru</h3>
                <span class="text-[10px] font-bold bg-amber-500/15 text-amber-600 px-3 py-1.5 rounded-full">Terakhir Diperbarui</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50/50 text-slate-400 uppercase text-[10px] tracking-wider border-b border-slate-100">
                        <tr>
                            <th class="p-4">ID</th>
                            <th class="p-4">Nama Siswa / Detail</th>
                            <th class="p-4">Menu & Jumlah</th>
                            <th class="p-4">Waktu</th>
                            <th class="p-4">Harga</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($orders as $order)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 font-bold text-amber-500">#{{ $order->id }}</td>
                                <td class="p-4">
                                    <div class="font-bold text-slate-800 text-xs">{{ $order->student_name }}</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">{{ $order->class_major }} | WA: {{ $order->whatsapp }}</div>
                                </td>
                                <td class="p-4">
                                    <ul class="text-[10px] text-slate-500 font-medium space-y-0.5">
                                        @foreach($order->items as $item)
                                            <li>• {{ $item->menu->name ?? 'Menu Dihapus' }} <span class="text-amber-500 font-extrabold">(x{{ $item->quantity }})</span></li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="p-4 text-[10px] font-bold text-slate-500">{{ $order->break_time }}</td>
                                <td class="p-4 font-extrabold text-slate-800">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td class="p-4">
                                    <form action="{{ route('admin.order.update', $order->id) }}" method="POST" class="inline-flex items-center">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" 
                                                class="bg-slate-50 border border-slate-200 text-[10px] font-bold rounded-lg px-2.5 py-1.5 focus:outline-none focus:border-amber-500 cursor-pointer text-slate-600">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>🕒 Pending</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>⚙️ Proses</option>
                                            <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>✅ Ready</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>🏁 Selesai</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-slate-400">Belum ada pesanan masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>