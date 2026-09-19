<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - Admin E-Kantin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-[#f4f5fa] text-slate-800 min-h-screen flex flex-col lg:flex-row antialiased overflow-x-hidden">

    {{-- SIDEBAR --}}
    @include('admin.partials.sidebar', ['active' => 'laporan'])

    {{-- KONTEN UTAMA --}}
    <main class="flex-1 min-w-0 w-full p-4 sm:p-6 lg:p-8 overflow-y-auto">

        {{-- TOP BAR --}}
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
                    <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-tight">Laporan Keuangan</h1>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">Ringkasan pendapatan & performa menu kantin</p>
                </div>
            </div>
            <div class="flex items-center gap-2 sm:gap-3">
                <div class="text-right">
                    <h3 class="text-xs sm:text-sm font-bold text-slate-900 leading-tight">Kasir Kantin</h3>
                    <span class="text-[10px] text-slate-400 font-medium">Administrator</span>
                </div>
                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-amber-500 text-white font-extrabold flex items-center justify-center text-xs sm:text-sm shadow-md shrink-0">K</div>
            </div>
        </header>

        {{-- KARTU RINGKASAN --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 mb-6 sm:mb-8">
            <div class="bg-white p-3.5 sm:p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3 sm:gap-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-emerald-100 text-emerald-500 rounded-xl flex items-center justify-center text-lg sm:text-xl shrink-0">💰</div>
                <div class="min-w-0 flex-1">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Total Pendapatan</p>
                    <p class="text-sm sm:text-lg font-extrabold text-slate-800 leading-tight mt-0.5 truncate">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="bg-white p-3.5 sm:p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3 sm:gap-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-amber-100 text-amber-500 rounded-xl flex items-center justify-center text-lg sm:text-xl shrink-0">📋</div>
                <div class="min-w-0 flex-1">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Total Pesanan</p>
                    <p class="text-xl sm:text-3xl font-extrabold text-slate-800 leading-tight mt-0.5 truncate">{{ $totalPesanan }}</p>
                </div>
            </div>
            <div class="bg-white p-3.5 sm:p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3 sm:gap-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 text-blue-500 rounded-xl flex items-center justify-center text-lg sm:text-xl shrink-0">🏁</div>
                <div class="min-w-0 flex-1">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Selesai</p>
                    <p class="text-xl sm:text-3xl font-extrabold text-slate-800 leading-tight mt-0.5 truncate">{{ $pesananSelesai }}</p>
                </div>
            </div>
            <div class="bg-white p-3.5 sm:p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3 sm:gap-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-red-100 text-red-400 rounded-xl flex items-center justify-center text-lg sm:text-xl shrink-0">🕒</div>
                <div class="min-w-0 flex-1">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Pending</p>
                    <p class="text-xl sm:text-3xl font-extrabold text-slate-800 leading-tight mt-0.5 truncate">{{ $pesananPending }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 mb-6">

            {{-- PENDAPATAN HARIAN --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center gap-2">
                    <span class="text-lg">📅</span>
                    <h3 class="text-sm font-extrabold text-slate-800">Pendapatan 7 Hari Terakhir</h3>
                </div>
                @if($dailyRevenue->isEmpty())
                    <div class="p-10 text-center text-slate-400 text-xs">
                        <div class="text-4xl mb-2">📊</div>
                        Belum ada data pendapatan dari pesanan selesai.
                    </div>
                @else
                    {{-- Bar chart sederhana --}}
                    @php $maxTotal = $dailyRevenue->max('total') ?: 1; @endphp
                    <div class="p-4 sm:p-5 space-y-3">
                        @foreach($dailyRevenue as $day)
                            @php $pct = round(($day->total / $maxTotal) * 100); @endphp
                            <div>
                                <div class="flex justify-between text-[10px] font-semibold text-slate-500 mb-1">
                                    <span>{{ \Carbon\Carbon::parse($day->tanggal)->isoFormat('ddd, D MMM') }}</span>
                                    <span class="font-extrabold text-slate-700">Rp {{ number_format($day->total, 0, ',', '.') }}</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2.5">
                                    <div class="bg-amber-400 h-2.5 rounded-full transition-all duration-500"
                                         style="width: {{ $pct }}%"></div>
                                </div>
                                <p class="text-[9px] text-slate-400 mt-0.5">{{ $day->jumlah }} pesanan selesai</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- MENU TERLARIS --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center gap-2">
                    <span class="text-lg">🏆</span>
                    <h3 class="text-sm font-extrabold text-slate-800">Menu Terlaris</h3>
                    <span class="ml-auto text-[10px] text-slate-400">dari pesanan selesai</span>
                </div>
                @if($menuTerlaris->isEmpty())
                    <div class="p-10 text-center text-slate-400 text-xs">
                        <div class="text-4xl mb-2">🍽️</div>
                        Belum ada data menu terjual.
                    </div>
                @else
                    <div class="p-4 sm:p-5 space-y-3">
                        @foreach($menuTerlaris as $i => $menu)
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50/70 border border-slate-100">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-sm font-extrabold shrink-0
                                    {{ $i === 0 ? 'bg-amber-100 text-amber-600' : ($i === 1 ? 'bg-slate-200 text-slate-600' : ($i === 2 ? 'bg-orange-100 text-orange-600' : 'bg-slate-100 text-slate-400')) }}">
                                    {{ $i + 1 }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-bold text-slate-800 truncate">{{ $menu->name }}</p>
                                    <p class="text-[10px] text-slate-400 truncate">
                                        {{ ucfirst($menu->category) }} · Rp {{ number_format($menu->price, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="text-right shrink-0">
                                    <p class="text-sm font-extrabold text-amber-500">{{ $menu->total_qty }}×</p>
                                    <p class="text-[10px] text-slate-400">Rp {{ number_format($menu->total_pendapatan, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- TABEL DETAIL PENDAPATAN HARIAN --}}
        @if($dailyRevenue->isNotEmpty())
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-4 sm:p-5 border-b border-slate-100">
                <h3 class="text-sm font-extrabold text-slate-800">📋 Detail Pendapatan Harian</h3>
            </div>
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left text-xs text-slate-600 min-w-[500px]">
                    <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] tracking-wider border-b border-slate-100">
                        <tr>
                            <th class="p-3.5 sm:p-4">Tanggal</th>
                            <th class="p-3.5 sm:p-4">Hari</th>
                            <th class="p-3.5 sm:p-4">Pesanan Selesai</th>
                            <th class="p-3.5 sm:p-4">Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($dailyRevenue as $day)
                            <tr class="hover:bg-slate-50/70 transition">
                                <td class="p-3.5 sm:p-4 font-bold text-slate-700 whitespace-nowrap">{{ \Carbon\Carbon::parse($day->tanggal)->format('d/m/Y') }}</td>
                                <td class="p-3.5 sm:p-4 text-slate-500 whitespace-nowrap">{{ \Carbon\Carbon::parse($day->tanggal)->isoFormat('dddd') }}</td>
                                <td class="p-3.5 sm:p-4 whitespace-nowrap">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-600">
                                        {{ $day->jumlah }} pesanan
                                    </span>
                                </td>
                                <td class="p-3.5 sm:p-4 font-extrabold text-emerald-600 whitespace-nowrap">Rp {{ number_format($day->total, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr class="bg-slate-50 font-extrabold">
                            <td class="p-3.5 sm:p-4 text-slate-800 whitespace-nowrap" colspan="2">Total Keseluruhan</td>
                            <td class="p-3.5 sm:p-4 text-slate-800 whitespace-nowrap">{{ $dailyRevenue->sum('jumlah') }} pesanan</td>
                            <td class="p-3.5 sm:p-4 text-emerald-700 whitespace-nowrap">Rp {{ number_format($dailyRevenue->sum('total'), 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endif

    </main>
</body>
</html>
