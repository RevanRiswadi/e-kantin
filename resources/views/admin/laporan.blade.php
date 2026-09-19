<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - Admin E-Kantin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { font-family:'Plus Jakarta Sans',sans-serif; }
        ::-webkit-scrollbar{width:4px;height:4px}
        ::-webkit-scrollbar-thumb{background:rgba(148,163,184,.2);border-radius:99px}
    </style>
</head>
<body class="min-h-screen flex antialiased" style="background:#0b1324;color:#f1f5f9;">

    @include('admin.partials.sidebar', ['active' => 'laporan'])

    <div class="flex-1 flex flex-col min-w-0">

        <header class="sticky top-0 z-20 px-6 lg:px-8 py-4 flex items-center justify-between gap-4 shrink-0"
                style="background:rgba(11,19,36,.85);backdrop-filter:blur(12px);border-bottom:1px solid rgba(148,163,184,.08);">
            <div class="flex items-center gap-3">
                <button onclick="toggleAdminSidebar()" class="lg:hidden w-9 h-9 rounded-xl flex items-center justify-center transition"
                        style="background:rgba(148,163,184,.08);color:#94a3b8;"
                        onmouseover="this.style.background='rgba(148,163,184,.15)'" onmouseout="this.style.background='rgba(148,163,184,.08)'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div>
                    <h1 class="text-lg font-bold text-white">Laporan Keuangan</h1>
                    <p class="text-xs" style="color:#64748b;">Ringkasan pendapatan &amp; performa menu kantin</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="hidden sm:block text-right">
                    <p class="text-xs font-semibold text-white">Kasir Kantin</p>
                    <p class="text-[10px]" style="color:#64748b;">Administrator</p>
                </div>
                <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold text-white shrink-0"
                     style="background:linear-gradient(135deg,#d97706,#f59e0b);">K</div>
            </div>
        </header>

        <main class="flex-1 p-5 lg:p-8 space-y-6 overflow-y-auto">

            {{-- STAT CARDS --}}
            <div class="grid grid-cols-2 xl:grid-cols-4 gap-4">
                <div class="rounded-2xl p-5 flex items-center gap-4" style="background:#131d31;border:1px solid rgba(148,163,184,.08);">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(52,211,153,.12);border:1px solid rgba(52,211,153,.2);">
                        <svg class="w-5 h-5" style="color:#6ee7b7;" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] font-semibold uppercase tracking-wide" style="color:#64748b;">Total Pendapatan</p>
                        <p class="text-base font-extrabold mt-0.5 truncate" style="color:#6ee7b7;">Rp {{ number_format($totalPendapatan,0,',','.') }}</p>
                    </div>
                </div>
                <div class="rounded-2xl p-5 flex items-center gap-4" style="background:#131d31;border:1px solid rgba(148,163,184,.08);">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(245,158,11,.15);border:1px solid rgba(245,158,11,.2);">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-wide" style="color:#64748b;">Total Pesanan</p>
                        <p class="text-2xl font-extrabold text-white mt-0.5 leading-none">{{ $totalPesanan }}</p>
                    </div>
                </div>
                <div class="rounded-2xl p-5 flex items-center gap-4" style="background:#131d31;border:1px solid rgba(148,163,184,.08);">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(56,189,248,.12);border:1px solid rgba(56,189,248,.2);">
                        <svg class="w-5 h-5" style="color:#7dd3fc;" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-wide" style="color:#64748b;">Selesai</p>
                        <p class="text-2xl font-extrabold text-white mt-0.5 leading-none">{{ $pesananSelesai }}</p>
                    </div>
                </div>
                <div class="rounded-2xl p-5 flex items-center gap-4" style="background:#131d31;border:1px solid rgba(148,163,184,.08);">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(245,158,11,.15);border:1px solid rgba(245,158,11,.2);">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-wide" style="color:#64748b;">Pending</p>
                        <p class="text-2xl font-extrabold text-white mt-0.5 leading-none">{{ $pesananPending }}</p>
                    </div>
                </div>
            </div>

            {{-- CHARTS --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

                {{-- Bar chart pendapatan --}}
                <div class="rounded-2xl overflow-hidden" style="background:#131d31;border:1px solid rgba(148,163,184,.08);">
                    <div class="px-6 py-4" style="border-bottom:1px solid rgba(148,163,184,.08);">
                        <h3 class="text-sm font-semibold text-white">Pendapatan 7 Hari Terakhir</h3>
                        <p class="text-xs mt-0.5" style="color:#64748b;">Berdasarkan pesanan selesai</p>
                    </div>
                    @if($dailyRevenue->isEmpty())
                        <div class="px-6 py-14 flex flex-col items-center text-center">
                            <svg class="w-10 h-10 mb-3" style="color:#334155;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                            <p class="text-sm" style="color:#475569;">Belum ada data pendapatan.</p>
                        </div>
                    @else
                        @php $maxTotal = $dailyRevenue->max('total') ?: 1; @endphp
                        <div class="px-6 py-5 space-y-4">
                            @foreach($dailyRevenue as $day)
                                @php $pct = round(($day->total/$maxTotal)*100); @endphp
                                <div>
                                    <div class="flex items-center justify-between text-xs mb-1.5">
                                        <span style="color:#94a3b8;">{{ \Carbon\Carbon::parse($day->tanggal)->isoFormat('ddd, D MMM') }}</span>
                                        <span class="font-bold" style="color:#6ee7b7;">Rp {{ number_format($day->total,0,',','.') }}</span>
                                    </div>
                                    <div class="h-2 rounded-full" style="background:rgba(148,163,184,.1);">
                                        <div class="h-2 rounded-full transition-all duration-500" style="width:{{ $pct }}%;background:linear-gradient(90deg,#059669,#34d399);"></div>
                                    </div>
                                    <p class="text-[10px] mt-1" style="color:#475569;">{{ $day->jumlah }} pesanan selesai</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Menu terlaris --}}
                <div class="rounded-2xl overflow-hidden" style="background:#131d31;border:1px solid rgba(148,163,184,.08);">
                    <div class="px-6 py-4" style="border-bottom:1px solid rgba(148,163,184,.08);">
                        <h3 class="text-sm font-semibold text-white">Menu Terlaris</h3>
                        <p class="text-xs mt-0.5" style="color:#64748b;">Dari pesanan selesai</p>
                    </div>
                    @if($menuTerlaris->isEmpty())
                        <div class="px-6 py-14 flex flex-col items-center text-center">
                            <svg class="w-10 h-10 mb-3" style="color:#334155;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <p class="text-sm" style="color:#475569;">Belum ada data menu terjual.</p>
                        </div>
                    @else
                        <div class="px-6 py-5 space-y-3">
                            @foreach($menuTerlaris as $i => $m)
                                <div class="flex items-center gap-3 p-3 rounded-xl transition"
                                     style="background:rgba(11,19,36,.5);border:1px solid rgba(148,163,184,.06);"
                                     onmouseover="this.style.borderColor='rgba(245,158,11,.15)'" onmouseout="this.style.borderColor='rgba(148,163,184,.06)'">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-sm font-extrabold shrink-0
                                        {{ $i===0 ? 'text-amber-400' : ($i===1 ? 'text-slate-400' : ($i===2 ? 'text-orange-400' : 'text-slate-600')) }}"
                                         style="{{ $i===0 ? 'background:rgba(245,158,11,.15);border:1px solid rgba(245,158,11,.2);' : ($i===1 ? 'background:rgba(148,163,184,.1);border:1px solid rgba(148,163,184,.15);' : 'background:rgba(148,163,184,.06);border:1px solid rgba(148,163,184,.1);') }}">
                                        {{ $i+1 }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-semibold text-white truncate">{{ $m->name }}</p>
                                        <p class="text-[10px] truncate" style="color:#64748b;">{{ ucfirst($m->category) }} · Rp {{ number_format($m->price,0,',','.') }}</p>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <p class="text-sm font-extrabold" style="color:#fbbf24;">{{ $m->total_qty }}×</p>
                                        <p class="text-[10px]" style="color:#64748b;">Rp {{ number_format($m->total_pendapatan,0,',','.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- TABEL DETAIL --}}
            @if($dailyRevenue->isNotEmpty())
            <div class="rounded-2xl overflow-hidden" style="background:#131d31;border:1px solid rgba(148,163,184,.08);">
                <div class="px-6 py-4" style="border-bottom:1px solid rgba(148,163,184,.08);">
                    <h3 class="text-sm font-semibold text-white">Detail Pendapatan Harian</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-xs min-w-[500px]">
                        <thead style="background:rgba(11,19,36,.6);border-bottom:1px solid rgba(148,163,184,.08);">
                            <tr>
                                @foreach(['Tanggal','Hari','Pesanan Selesai','Total Pendapatan'] as $th)
                                <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide" style="color:#64748b;">{{ $th }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dailyRevenue as $day)
                            <tr class="transition" style="border-bottom:1px solid rgba(148,163,184,.05);"
                                onmouseover="this.style.background='rgba(245,158,11,.03)'" onmouseout="this.style.background=''">
                                <td class="px-4 py-3.5 font-semibold text-white whitespace-nowrap">{{ \Carbon\Carbon::parse($day->tanggal)->format('d/m/Y') }}</td>
                                <td class="px-4 py-3.5 whitespace-nowrap" style="color:#94a3b8;">{{ \Carbon\Carbon::parse($day->tanggal)->isoFormat('dddd') }}</td>
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold" style="background:rgba(52,211,153,.1);color:#6ee7b7;border:1px solid rgba(52,211,153,.2);">{{ $day->jumlah }} pesanan</span>
                                </td>
                                <td class="px-4 py-3.5 font-bold whitespace-nowrap" style="color:#6ee7b7;">Rp {{ number_format($day->total,0,',','.') }}</td>
                            </tr>
                            @endforeach
                            <tr style="background:rgba(245,158,11,.04);border-top:1px solid rgba(245,158,11,.15);">
                                <td class="px-4 py-3.5 font-bold text-white" colspan="2">Total Keseluruhan</td>
                                <td class="px-4 py-3.5 font-bold text-white">{{ $dailyRevenue->sum('jumlah') }} pesanan</td>
                                <td class="px-4 py-3.5 font-extrabold" style="color:#6ee7b7;">Rp {{ number_format($dailyRevenue->sum('total'),0,',','.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

        </main>
    </div>
</body>
</html>
