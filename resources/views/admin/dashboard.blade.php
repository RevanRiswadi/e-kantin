<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin E-Kantin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(148,163,184,.2); border-radius: 99px; }
        @keyframes fadeUp { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:translateY(0); } }
        .fade-up { animation: fadeUp .3s ease-out both; }
    </style>
</head>
<body class="min-h-screen flex antialiased" style="background:#0b1324;color:#f1f5f9;">

    @include('admin.partials.sidebar', ['active' => 'dashboard'])

    <div class="flex-1 flex flex-col min-w-0">

        {{-- HEADER --}}
        <header class="sticky top-0 z-20 px-6 lg:px-8 py-4 flex items-center justify-between gap-4 shrink-0"
                style="background:rgba(11,19,36,.85);backdrop-filter:blur(12px);border-bottom:1px solid rgba(148,163,184,.08);">
            <div class="flex items-center gap-3">
                <button type="button" onclick="toggleAdminSidebar()"
                        class="lg:hidden w-9 h-9 rounded-xl flex items-center justify-center transition"
                        style="background:rgba(148,163,184,.08);color:#94a3b8;"
                        onmouseover="this.style.background='rgba(148,163,184,.15)'"
                        onmouseout="this.style.background='rgba(148,163,184,.08)'"
                        aria-label="Menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div>
                    <h1 class="text-lg font-bold text-white">Dashboard</h1>
                    <p class="text-xs" style="color:#64748b;">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-semibold text-white">Kasir Kantin</p>
                    <p class="text-[10px]" style="color:#64748b;">Administrator</p>
                </div>
                <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold shrink-0 text-white"
                     style="background:linear-gradient(135deg,#d97706,#f59e0b);">K</div>
            </div>
        </header>

        <main class="flex-1 p-5 lg:p-8 space-y-6 overflow-y-auto">

            {{-- FLASH --}}
            @if(session('success'))
                <div class="p-4 rounded-xl text-sm font-semibold flex items-center gap-2 fade-up"
                     style="background:rgba(16,185,129,.1);border:1px solid rgba(16,185,129,.25);color:#6ee7b7;">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- STAT CARDS --}}
            <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 fade-up">

                {{-- Pesanan Baru --}}
                <div class="rounded-2xl p-5 flex items-center gap-4 transition hover:scale-[1.01]"
                     style="background:#131d31;border:1px solid rgba(148,163,184,.08);">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                         style="background:rgba(245,158,11,.15);border:1px solid rgba(245,158,11,.2);">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] font-semibold uppercase tracking-wider" style="color:#64748b;">Pesanan Baru</p>
                        <p class="text-3xl font-extrabold text-white mt-0.5 leading-none">{{ $orders->where('status','pending')->count() }}</p>
                    </div>
                </div>

                {{-- Pendapatan --}}
                <div class="rounded-2xl p-5 flex items-center gap-4 transition hover:scale-[1.01]"
                     style="background:#131d31;border:1px solid rgba(148,163,184,.08);">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                         style="background:rgba(16,185,129,.12);border:1px solid rgba(16,185,129,.2);">
                        <svg class="w-5 h-5" style="color:#34d399;" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] font-semibold uppercase tracking-wider" style="color:#64748b;">Pendapatan</p>
                        <p class="text-lg font-extrabold leading-tight mt-0.5 truncate" style="color:#34d399;">
                            Rp {{ number_format($orders->where('status','completed')->sum('total_price'),0,',','.') }}
                        </p>
                    </div>
                </div>

                {{-- Total Menu --}}
                <div class="rounded-2xl p-5 flex items-center gap-4 transition hover:scale-[1.01]"
                     style="background:#131d31;border:1px solid rgba(148,163,184,.08);">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                         style="background:rgba(99,102,241,.12);border:1px solid rgba(99,102,241,.2);">
                        <svg class="w-5 h-5" style="color:#a5b4fc;" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] font-semibold uppercase tracking-wider" style="color:#64748b;">Total Menu</p>
                        <p class="text-3xl font-extrabold text-white mt-0.5 leading-none">{{ \App\Models\Menu::count() }}</p>
                    </div>
                </div>

                {{-- Siswa Order --}}
                <div class="rounded-2xl p-5 flex items-center gap-4 transition hover:scale-[1.01]"
                     style="background:#131d31;border:1px solid rgba(148,163,184,.08);">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                         style="background:rgba(56,189,248,.12);border:1px solid rgba(56,189,248,.2);">
                        <svg class="w-5 h-5" style="color:#7dd3fc;" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] font-semibold uppercase tracking-wider" style="color:#64748b;">Siswa Order</p>
                        <p class="text-3xl font-extrabold text-white mt-0.5 leading-none">{{ $orders->count() }}</p>
                    </div>
                </div>
            </div>

            {{-- CHART + AKTIVITAS --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 fade-up">

                {{-- Donut --}}
                <div class="rounded-2xl p-6" style="background:#131d31;border:1px solid rgba(148,163,184,.08);">
                    <h3 class="text-sm font-semibold text-white mb-5">Status Pesanan</h3>
                    @php
                        $tot  = $orders->count() ?: 1;
                        $pPen = round($orders->where('status','pending')->count()    / $tot * 360);
                        $pPro = round($orders->where('status','processing')->count() / $tot * 360);
                        $pRdy = round($orders->where('status','ready')->count()      / $tot * 360);
                        $c1=$pPen; $c2=$c1+$pPro; $c3=$c2+$pRdy;
                    @endphp
                    <div class="relative w-36 h-36 mx-auto flex items-center justify-center rounded-full"
                         style="background:conic-gradient(#f59e0b 0deg {{ $c1 }}deg, #38bdf8 {{ $c1 }}deg {{ $c2 }}deg, #34d399 {{ $c2 }}deg {{ $c3 }}deg, #334155 {{ $c3 }}deg 360deg);">
                        <div class="absolute w-24 h-24 rounded-full flex flex-col items-center justify-center"
                             style="background:#131d31;">
                            <span class="text-[9px] font-bold uppercase tracking-wider" style="color:#64748b;">Total</span>
                            <span class="text-2xl font-extrabold text-white leading-none">{{ $orders->count() }}</span>
                        </div>
                    </div>
                    <div class="mt-5 grid grid-cols-2 gap-x-4 gap-y-2">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full shrink-0 bg-amber-400"></span>
                            <span class="text-xs" style="color:#94a3b8;">Pending ({{ $orders->where('status','pending')->count() }})</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full shrink-0" style="background:#38bdf8;"></span>
                            <span class="text-xs" style="color:#94a3b8;">Proses ({{ $orders->where('status','processing')->count() }})</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full shrink-0" style="background:#34d399;"></span>
                            <span class="text-xs" style="color:#94a3b8;">Ready ({{ $orders->where('status','ready')->count() }})</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full shrink-0 bg-slate-600"></span>
                            <span class="text-xs" style="color:#94a3b8;">Selesai ({{ $orders->where('status','completed')->count() }})</span>
                        </div>
                    </div>
                </div>

                {{-- Aktivitas --}}
                <div class="lg:col-span-2 rounded-2xl p-6 flex flex-col" style="background:#131d31;border:1px solid rgba(148,163,184,.08);">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-sm font-semibold text-white">Aktivitas Pesanan</h3>
                        <a href="{{ route('admin.orders') }}"
                           class="text-xs font-semibold transition" style="color:#f59e0b;"
                           onmouseover="this.style.color='#fbbf24'" onmouseout="this.style.color='#f59e0b'">
                            Lihat Semua →
                        </a>
                    </div>
                    <div class="space-y-2.5 flex-1">
                        @forelse($orders->take(5) as $order)
                            <div class="flex items-center justify-between p-3 rounded-xl gap-3 transition"
                                 style="background:rgba(11,19,36,.5);border:1px solid rgba(148,163,184,.06);"
                                 onmouseover="this.style.background='rgba(245,158,11,.05)';this.style.borderColor='rgba(245,158,11,.15)'"
                                 onmouseout="this.style.background='rgba(11,19,36,.5)';this.style.borderColor='rgba(148,163,184,.06)'">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0"
                                         style="background:rgba(148,163,184,.08);">
                                        <svg class="w-3.5 h-3.5" style="color:#64748b;" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs font-semibold text-white truncate">{{ $order->student_name }}</p>
                                        <p class="text-[10px] truncate" style="color:#64748b;">{{ $order->class_major }} · {{ $order->break_time }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2.5 shrink-0">
                                    <span class="text-xs font-bold hidden sm:block" style="color:#94a3b8;">Rp {{ number_format($order->total_price,0,',','.') }}</span>
                                    @php
                                        $sc = match($order->status) {
                                            'pending'    => 'background:rgba(245,158,11,.15);color:#fbbf24;border:1px solid rgba(245,158,11,.25)',
                                            'processing' => 'background:rgba(56,189,248,.12);color:#7dd3fc;border:1px solid rgba(56,189,248,.2)',
                                            'ready'      => 'background:rgba(52,211,153,.12);color:#6ee7b7;border:1px solid rgba(52,211,153,.2)',
                                            default      => 'background:rgba(148,163,184,.1);color:#94a3b8;border:1px solid rgba(148,163,184,.15)',
                                        };
                                    @endphp
                                    <span class="text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wide" style="{{ $sc }}">{{ $order->status }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="flex items-center justify-center py-10 text-sm" style="color:#475569;">Belum ada aktivitas.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- REKAP DAPUR --}}
            @if(isset($rekapByTime) && $rekapByTime->isNotEmpty())
            <div class="rounded-2xl overflow-hidden fade-up" style="background:#131d31;border:1px solid rgba(148,163,184,.08);">
                <div class="px-6 py-4 flex items-center justify-between" style="border-bottom:1px solid rgba(148,163,184,.08);">
                    <div>
                        <h3 class="text-sm font-semibold text-white">Rekap Dapur Hari Ini</h3>
                        <p class="text-xs mt-0.5" style="color:#64748b;">Porsi yang harus disiapkan per jam istirahat</p>
                    </div>
                    <span class="text-[10px] font-bold px-2.5 py-1 rounded-full" style="background:rgba(245,158,11,.15);color:#fbbf24;border:1px solid rgba(245,158,11,.2);">
                        {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                    </span>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($rekapByTime as $breakTime => $stands)
                        @php $isOne = str_contains(strtolower($breakTime),'1'); @endphp
                        <div class="rounded-xl p-4" style="background:rgba(11,19,36,.5);border:1px solid rgba(148,163,184,.06);">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full shrink-0" style="background:{{ $isOne ? '#f59e0b' : '#38bdf8' }};"></span>
                                    <p class="text-sm font-semibold text-white">{{ $breakTime }}</p>
                                </div>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full"
                                      style="{{ $isOne ? 'background:rgba(245,158,11,.12);color:#fbbf24;' : 'background:rgba(56,189,248,.12);color:#7dd3fc;' }}">
                                    {{ $stands->flatten()->sum('total_porsi') }} porsi
                                </span>
                            </div>
                            @foreach($stands as $stand => $items)
                                <p class="text-[10px] font-bold uppercase tracking-wider mb-2" style="color:#475569;">{{ $stand }}</p>
                                @php $maxQ = $items->max('total_porsi') ?: 1; @endphp
                                <div class="space-y-2.5 mb-3">
                                    @foreach($items as $row)
                                        <div>
                                            <div class="flex justify-between text-xs mb-1">
                                                <span class="truncate pr-2" style="color:#cbd5e1;">{{ $row->menu_name }}</span>
                                                <span class="font-bold shrink-0" style="color:{{ $isOne ? '#fbbf24' : '#7dd3fc' }};">{{ $row->total_porsi }}×</span>
                                            </div>
                                            <div class="h-1.5 rounded-full" style="background:rgba(148,163,184,.1);">
                                                <div class="h-1.5 rounded-full transition-all duration-500"
                                                     style="width:{{ round($row->total_porsi/$maxQ*100) }}%;background:{{ $isOne ? '#f59e0b' : '#38bdf8' }};"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- TABEL PESANAN --}}
            <div class="rounded-2xl overflow-hidden fade-up" style="background:#131d31;border:1px solid rgba(148,163,184,.08);">
                <div class="px-6 py-4 flex items-center justify-between" style="border-bottom:1px solid rgba(148,163,184,.08);">
                    <h3 class="text-sm font-semibold text-white">Semua Pesanan</h3>
                    <span class="text-xs" style="color:#64748b;">{{ $orders->count() }} pesanan</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-xs min-w-[680px]">
                        <thead style="background:rgba(11,19,36,.6);border-bottom:1px solid rgba(148,163,184,.08);">
                            <tr>
                                @foreach(['Antrean','Siswa','Menu','Waktu','Bayar','Total','Aksi'] as $th)
                                <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide whitespace-nowrap" style="color:#64748b;">{{ $th }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr class="transition" style="border-bottom:1px solid rgba(148,163,184,.05);"
                                onmouseover="this.style.background='rgba(245,158,11,.03)'"
                                onmouseout="this.style.background=''">
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <span class="font-bold" style="color:#fbbf24;">{{ $order->queue_code ?? '#'.$order->id }}</span>
                                </td>
                                <td class="px-4 py-3.5">
                                    <p class="font-semibold text-white">{{ $order->student_name }}</p>
                                    <p style="color:#64748b;">{{ $order->class_major }}</p>
                                </td>
                                <td class="px-4 py-3.5">
                                    @foreach($order->items as $item)
                                        <p style="color:#cbd5e1;">{{ $item->menu->name ?? '—' }} <span style="color:#fbbf24;" class="font-bold">(×{{ $item->quantity }})</span></p>
                                    @endforeach
                                </td>
                                <td class="px-4 py-3.5 whitespace-nowrap" style="color:#94a3b8;">
                                    <p>{{ $order->break_time }}</p>
                                    <p>{{ $order->created_at->format('d/m H:i') }}</p>
                                </td>
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    @if(($order->payment_method ?? 'tunai') === 'qris')
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold" style="background:rgba(99,102,241,.15);color:#a5b4fc;border:1px solid rgba(99,102,241,.2);">QRIS</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold" style="background:rgba(52,211,153,.12);color:#6ee7b7;border:1px solid rgba(52,211,153,.2);">Tunai</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5 whitespace-nowrap font-bold text-white">Rp {{ number_format($order->total_price,0,',','.') }}</td>
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <form action="{{ route('admin.order.update',$order->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                                class="rounded-lg text-xs px-2.5 py-1.5 focus:outline-none transition cursor-pointer"
                                                style="background:rgba(148,163,184,.08);border:1px solid rgba(148,163,184,.15);color:#cbd5e1;">
                                            @foreach(['pending'=>'Pending','processing'=>'Proses','ready'=>'Ready','completed'=>'Selesai'] as $v=>$l)
                                            <option value="{{ $v }}" {{ $order->status==$v?'selected':'' }} style="background:#131d31;">{{ $l }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="px-4 py-12 text-center" style="color:#475569;">Belum ada pesanan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</body>
</html>
