<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - E-Kantin SMKN 1 Ciomas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[#f4f5fa] text-slate-800 min-h-screen flex flex-col lg:flex-row antialiased overflow-x-hidden">

    {{-- SIDEBAR --}}
    @include('admin.partials.sidebar', ['active' => 'dashboard'])

    <!-- KONTEN UTAMA (KANAN) -->
    <main class="flex-1 min-w-0 w-full p-4 sm:p-6 lg:p-8 overflow-y-auto">
        <!-- TOP BAR (HEADER) -->
        <header class="flex justify-between items-center mb-6 sm:mb-8 pb-4 border-b border-slate-200 gap-3">
            <div class="flex items-center gap-3">
                <button type="button" onclick="toggleAdminSidebar()"
                        class="lg:hidden p-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 hover:text-amber-600 shadow-sm transition"
                        aria-label="Buka Menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div>
                    <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-tight">Dashboard</h1>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2 sm:gap-3">
                <div class="text-right">
                    <h3 class="text-xs sm:text-sm font-bold text-slate-900 leading-tight">Kasir Kantin</h3>
                    <span class="text-[10px] text-slate-400 font-medium">Administrator</span>
                </div>
                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-amber-500 text-white font-extrabold flex items-center justify-center text-xs sm:text-sm shadow-md shrink-0">
                    K
                </div>
            </div>
        </header>

        <!-- KARTU STATISTIK (CARD RINGKASAN) -->
        <div class="mb-6 sm:mb-8">
            <h2 class="text-lg sm:text-xl font-extrabold text-slate-800 flex items-center gap-2 mb-1">Selamat Datang! 👋</h2>
            <p class="text-xs text-slate-400 font-medium mb-4 sm:mb-6">Ringkasan kondisi kantin SMKN 1 Ciomas hari ini</p>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-6">
                <!-- Card 1 -->
                <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 flex items-center gap-4 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 bg-amber-100 text-amber-500 rounded-xl flex items-center justify-center font-bold text-xl shrink-0">
                        🛒
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block">Pesanan Baru</span>
                        <h3 class="text-2xl font-extrabold text-slate-800 leading-tight mt-0.5 truncate">{{ $orders->where('status', 'pending')->count() }}</h3>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 flex items-center gap-4 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-500 rounded-xl flex items-center justify-center font-bold text-xl shrink-0">
                        💰
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block">Hari Ini</span>
                        <h3 class="text-lg sm:text-xl font-extrabold text-slate-800 leading-tight mt-1 truncate">Rp {{ number_format($orders->where('status', 'completed')->sum('total_price'), 0, ',', '.') }}</h3>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 flex items-center gap-4 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 bg-blue-100 text-blue-500 rounded-xl flex items-center justify-center font-bold text-xl shrink-0">
                        🍽️
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block">Total Menu</span>
                        <h3 class="text-2xl font-extrabold text-slate-800 leading-tight mt-0.5 truncate">{{ \App\Models\Menu::count() }}</h3>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 flex items-center gap-4 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 bg-purple-100 text-purple-500 rounded-xl flex items-center justify-center font-bold text-xl shrink-0">
                        👥
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block">Siswa Order</span>
                        <h3 class="text-2xl font-extrabold text-slate-800 leading-tight mt-0.5 truncate">{{ $orders->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- CHARTS & AKTIVITAS (DUA KOLOM) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 mb-6 sm:mb-8">
            <!-- Left: Donut Chart Status Pesanan -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-100 shadow-sm">
                <h3 class="text-sm font-extrabold text-slate-800 mb-6 flex items-center gap-2">📊 Status Pesanan</h3>
                
                <!-- Mock Circle Gradient -->
                <div class="relative w-36 h-36 sm:w-40 sm:h-40 mx-auto flex items-center justify-center rounded-full bg-white shadow-inner"
                     style="background: conic-gradient(#f59e0b 0% 25%, #3b82f6 25% 55%, #10b981 55% 80%, #cbd5e1 80% 100%);">
                    <div class="absolute w-24 h-24 sm:w-28 sm:h-28 bg-white rounded-full flex flex-col items-center justify-center shadow-sm">
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Total</span>
                        <span class="text-xl sm:text-2xl font-extrabold text-slate-800 leading-none">{{ $orders->count() }}</span>
                    </div>
                </div>

                <!-- Legends -->
                <div class="mt-6 grid grid-cols-2 gap-x-3 gap-y-2 text-xs">
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 bg-amber-500 rounded-full shrink-0"></span>
                        <span class="text-slate-600 font-semibold truncate">Pending ({{ $orders->where('status', 'pending')->count() }})</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 bg-blue-500 rounded-full shrink-0"></span>
                        <span class="text-slate-600 font-semibold truncate">Proses ({{ $orders->where('status', 'processing')->count() }})</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 bg-emerald-500 rounded-full shrink-0"></span>
                        <span class="text-slate-600 font-semibold truncate">Ready ({{ $orders->where('status', 'ready')->count() }})</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 bg-slate-300 rounded-full shrink-0"></span>
                        <span class="text-slate-600 font-semibold truncate">Selesai ({{ $orders->where('status', 'completed')->count() }})</span>
                    </div>
                </div>
            </div>

            <!-- Right: Aktivitas Terbaru (2/3 width) -->
            <div class="lg:col-span-2 bg-white p-5 sm:p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col">
                <div class="flex justify-between items-center mb-5 sm:mb-6">
                    <h3 class="text-sm font-extrabold text-slate-800 flex items-center gap-2">⏱️ Aktivitas Pesanan</h3>
                    <a href="{{ route('admin.orders') }}" class="text-[11px] font-bold text-amber-500 hover:text-amber-600 bg-amber-50 px-2.5 py-1.5 rounded-lg transition">Lihat Semua</a>
                </div>

                <div class="space-y-3 sm:space-y-4 flex-1">
                    @forelse($orders->take(4) as $order)
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between p-3 rounded-xl border border-slate-100 hover:bg-slate-50 transition gap-2 sm:gap-3">
                            <div class="flex gap-3 items-center min-w-0">
                                <div class="w-9 h-9 sm:w-10 sm:h-10 bg-slate-100 text-slate-500 rounded-lg flex items-center justify-center font-bold text-sm shrink-0">
                                    📦
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-slate-900 leading-snug truncate">{{ $order->student_name }}</h4>
                                    <p class="text-[10px] text-slate-400 mt-0.5 truncate">{{ $order->class_major }} · {{ $order->break_time }}</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between sm:justify-end gap-2 shrink-0">
                                <span class="text-xs font-bold text-slate-700 sm:hidden">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                <span class="text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider
                                    {{ $order->status == 'pending' ? 'bg-amber-100 text-amber-600' : '' }}
                                    {{ $order->status == 'processing' ? 'bg-blue-100 text-blue-600' : '' }}
                                    {{ $order->status == 'ready' ? 'bg-emerald-100 text-emerald-600' : '' }}
                                    {{ $order->status == 'completed' ? 'bg-slate-100 text-slate-500' : '' }}">
                                    {{ $order->status }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-xs text-slate-400 py-10">Belum ada aktivitas baru hari ini.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- TABEL DATA UTAMA -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-4 sm:p-6 border-b border-slate-100 flex flex-wrap justify-between items-center gap-2">
                <h3 class="text-sm font-extrabold text-slate-800">📋 Pesanan & Staf Siswa Terbaru</h3>
                <span class="text-[10px] font-bold bg-amber-500/15 text-amber-600 px-3 py-1.5 rounded-full">Terakhir Diperbarui</span>
            </div>

            <div class="overflow-x-auto w-full">
                <table class="w-full text-left text-xs text-slate-600 min-w-[640px]">
                    <thead class="bg-slate-50/50 text-slate-400 uppercase text-[10px] tracking-wider border-b border-slate-100">
                        <tr>
                            <th class="p-3.5 sm:p-4">ID</th>
                            <th class="p-3.5 sm:p-4">Nama Siswa / Detail</th>
                            <th class="p-3.5 sm:p-4">Menu & Jumlah</th>
                            <th class="p-3.5 sm:p-4">Waktu</th>
                            <th class="p-3.5 sm:p-4">Harga</th>
                            <th class="p-3.5 sm:p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($orders as $order)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-3.5 sm:p-4 font-bold text-amber-500 whitespace-nowrap">#{{ $order->id }}</td>
                                <td class="p-3.5 sm:p-4">
                                    <div class="font-bold text-slate-800 text-xs">{{ $order->student_name }}</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">{{ $order->class_major }} | WA: {{ $order->whatsapp }}</div>
                                </td>
                                <td class="p-3.5 sm:p-4">
                                    <ul class="text-[10px] text-slate-500 font-medium space-y-0.5">
                                        @foreach($order->items as $item)
                                            <li>• {{ $item->menu->name ?? 'Menu Dihapus' }} <span class="text-amber-500 font-extrabold">(x{{ $item->quantity }})</span></li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="p-3.5 sm:p-4 text-[10px] font-bold text-slate-500 whitespace-nowrap">{{ $order->break_time }}</td>
                                <td class="p-3.5 sm:p-4 font-extrabold text-slate-800 whitespace-nowrap">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td class="p-3.5 sm:p-4 whitespace-nowrap">
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