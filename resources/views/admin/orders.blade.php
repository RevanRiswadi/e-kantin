<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Admin E-Kantin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { font-family:'Plus Jakarta Sans',sans-serif; }
        ::-webkit-scrollbar{width:4px;height:4px}
        ::-webkit-scrollbar-thumb{background:rgba(148,163,184,.2);border-radius:99px}
        @keyframes fadeUp{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}
        .fade-up{animation:fadeUp .3s ease-out both}
        @keyframes popIn{from{opacity:0;transform:scale(.94)}to{opacity:1;transform:scale(1)}}
        .pop-in{animation:popIn .2s ease-out both}
    </style>
</head>
<body class="min-h-screen flex antialiased" style="background:#0b1324;color:#f1f5f9;">

    @include('admin.partials.sidebar', ['active' => 'orders'])

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
                    <h1 class="text-lg font-bold text-white">Riwayat Pesanan</h1>
                    <p class="text-xs" style="color:#64748b;">Semua pesanan masuk dari siswa</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                @if($orders->count() > 0)
                <button onclick="openModal('modalHapusSemua')"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold transition shadow-lg"
                        style="background:rgba(239,68,68,.15);color:#f87171;border:1px solid rgba(239,68,68,.25);"
                        onmouseover="this.style.background='rgba(239,68,68,.3)'" onmouseout="this.style.background='rgba(239,68,68,.15)'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Hapus Semua
                </button>
                @endif
                <div class="hidden sm:block text-right">
                    <p class="text-xs font-semibold text-white">Kasir Kantin</p>
                    <p class="text-[10px]" style="color:#64748b;">Administrator</p>
                </div>
                <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold text-white shrink-0"
                     style="background:linear-gradient(135deg,#d97706,#f59e0b);">K</div>
            </div>
        </header>

        <main class="flex-1 p-5 lg:p-8 space-y-6 overflow-y-auto">

            @if(session('success'))
                <div class="p-4 rounded-xl text-sm font-semibold flex items-center gap-2 fade-up"
                     style="background:rgba(16,185,129,.1);border:1px solid rgba(16,185,129,.25);color:#6ee7b7;">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- STAT CARDS --}}
            <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 fade-up">
                @php
                    $cards = [
                        ['label'=>'Pending',    'val'=>$pending,    'bg'=>'rgba(245,158,11,.15)',   'bc'=>'rgba(245,158,11,.2)',    'ic'=>'#fbbf24', 'path'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['label'=>'Diproses',   'val'=>$processing, 'bg'=>'rgba(56,189,248,.12)',   'bc'=>'rgba(56,189,248,.2)',    'ic'=>'#7dd3fc', 'path'=>'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15'],
                        ['label'=>'Siap Ambil', 'val'=>$ready,      'bg'=>'rgba(52,211,153,.12)',   'bc'=>'rgba(52,211,153,.2)',    'ic'=>'#6ee7b7', 'path'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['label'=>'Selesai',    'val'=>$completed,  'bg'=>'rgba(148,163,184,.1)',   'bc'=>'rgba(148,163,184,.15)', 'ic'=>'#94a3b8', 'path'=>'M5 13l4 4L19 7'],
                    ];
                @endphp
                @foreach($cards as $c)
                <div class="rounded-2xl p-5 flex items-center gap-4 transition-all duration-200 hover:scale-[1.02] hover:-translate-y-0.5 hover:shadow-lg cursor-pointer select-none" style="background:#131d31;border:1px solid rgba(148,163,184,.08);">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0"
                         style="background:{{ $c['bg'] }};border:1px solid {{ $c['bc'] }};">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" style="color:{{ $c['ic'] }};">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $c['path'] }}"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-wide" style="color:#64748b;">{{ $c['label'] }}</p>
                        <p class="text-2xl font-extrabold text-white mt-0.5 leading-none">{{ $c['val'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- TABLE CARD --}}
            <div class="rounded-2xl overflow-hidden fade-up" style="background:#131d31;border:1px solid rgba(148,163,184,.08);">

                {{-- Filter pills --}}
                <div class="px-5 py-4 flex flex-wrap gap-2" style="border-bottom:1px solid rgba(148,163,184,.08);">
                    @php
                        $filters = [
                            ['id'=>'all',        'label'=>'Semua ('.$orders->count().')'],
                            ['id'=>'pending',    'label'=>'Pending ('.$pending.')'],
                            ['id'=>'processing', 'label'=>'Diproses ('.$processing.')'],
                            ['id'=>'ready',      'label'=>'Siap Ambil ('.$ready.')'],
                            ['id'=>'completed',  'label'=>'Selesai ('.$completed.')'],
                        ];
                    @endphp
                    @foreach($filters as $f)
                    <button id="btn-{{ $f['id'] }}"
                            onclick="filterStatus('{{ $f['id'] }}',this)"
                            class="filter-btn px-4 py-1.5 rounded-full text-xs font-semibold transition whitespace-nowrap"
                            style="{{ $f['id']==='all' ? 'background:#d97706;color:#fff;border:1px solid #d97706;' : 'background:rgba(148,163,184,.08);color:#94a3b8;border:1px solid rgba(148,163,184,.12);' }}">
                        {{ $f['label'] }}
                    </button>
                    @endforeach
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-xs min-w-[700px]">
                        <thead style="background:rgba(11,19,36,.6);border-bottom:1px solid rgba(148,163,184,.08);">
                            <tr>
                                @foreach(['ID','Siswa','Menu Dipesan','Istirahat','Total','Waktu','Status'] as $th)
                                <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide" style="color:#64748b;">{{ $th }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody id="ordersTableBody">
                            @forelse($orders as $order)
                            <tr class="order-row transition" data-status="{{ $order->status }}"
                                style="border-bottom:1px solid rgba(148,163,184,.05);"
                                onmouseover="this.style.background='rgba(245,158,11,.03)'"
                                onmouseout="this.style.background=''">
                                <td class="px-4 py-3.5 whitespace-nowrap font-bold" style="color:#fbbf24;">#{{ $order->id }}</td>
                                <td class="px-4 py-3.5">
                                    <p class="font-semibold text-white">{{ $order->student_name }}</p>
                                    <p style="color:#64748b;">{{ $order->class_major }}</p>
                                    <p style="color:#64748b;">WA: {{ $order->whatsapp }}</p>
                                </td>
                                <td class="px-4 py-3.5">
                                    @foreach($order->items as $item)
                                        <p style="color:#cbd5e1;">{{ $item->menu->name ?? '—' }}
                                            <span class="font-bold" style="color:#fbbf24;">(×{{ $item->quantity }})</span></p>
                                    @endforeach
                                </td>
                                <td class="px-4 py-3.5 whitespace-nowrap font-medium" style="color:#cbd5e1;">{{ $order->break_time }}</td>
                                <td class="px-4 py-3.5 whitespace-nowrap font-bold text-white">Rp {{ number_format($order->total_price,0,',','.') }}</td>
                                <td class="px-4 py-3.5 whitespace-nowrap" style="color:#94a3b8;">
                                    <p>{{ $order->created_at->format('d/m/Y') }}</p>
                                    <p class="font-semibold">{{ $order->created_at->format('H:i') }}</p>
                                </td>
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <form action="{{ route('admin.order.update',$order->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                                class="rounded-lg text-[11px] px-2.5 py-1.5 focus:outline-none cursor-pointer transition"
                                                style="background:rgba(148,163,184,.08);border:1px solid rgba(148,163,184,.15);color:#cbd5e1;">
                                            <option value="pending"    {{ $order->status=='pending'   ?'selected':'' }} style="background:#131d31;">Pending</option>
                                            <option value="processing" {{ $order->status=='processing'?'selected':'' }} style="background:#131d31;">Proses</option>
                                            <option value="ready"      {{ $order->status=='ready'     ?'selected':'' }} style="background:#131d31;">Ready</option>
                                            <option value="completed"  {{ $order->status=='completed' ?'selected':'' }} style="background:#131d31;">Selesai</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="px-4 py-14 text-center text-sm" style="color:#475569;">
                                <svg class="w-10 h-10 mx-auto mb-3" style="color:#334155;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                                Belum ada pesanan masuk.
                            </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    {{-- ── MODAL HAPUS SEMUA PESANAN ──────────────────────── --}}
    <div id="modalHapusSemua" class="fixed inset-0 z-50 hidden items-center justify-center p-4"
         style="background:rgba(0,0,0,.7);backdrop-filter:blur(8px);"
         onclick="if(event.target.id==='modalHapusSemua') closeModal('modalHapusSemua')">
        <div class="pop-in w-full max-w-sm rounded-2xl p-6 text-center" style="background:#131d31;border:1px solid rgba(239,68,68,.3);">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4"
                 style="background:rgba(239,68,68,.15);border:1px solid rgba(239,68,68,.3);">
                <svg class="w-8 h-8" style="color:#f87171;" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                </svg>
            </div>
            <h2 class="text-base font-bold text-white mb-1">Hapus Semua Pesanan?</h2>
            <p class="text-sm mb-3" style="color:#94a3b8;">Seluruh <span class="font-bold" style="color:#f87171;">{{ $orders->count() }} pesanan</span> akan dihapus permanen.</p>
            <p class="text-xs mb-5 px-2" style="color:#64748b;">⚠ Tindakan ini <strong style="color:#f87171;">tidak dapat dibatalkan</strong>. Semua riwayat pesanan & detail item akan hilang selamanya.</p>
            <div class="flex gap-3">
                <button onclick="closeModal('modalHapusSemua')"
                        class="flex-1 py-2.5 rounded-xl text-sm font-semibold transition"
                        style="background:rgba(148,163,184,.08);color:#94a3b8;border:1px solid rgba(148,163,184,.12);"
                        onmouseover="this.style.background='rgba(148,163,184,.15)'" onmouseout="this.style.background='rgba(148,163,184,.08)'">Batal</button>
                <form action="{{ route('admin.orders.destroyAll') }}" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-2.5 rounded-xl text-sm font-bold text-white transition"
                            style="background:#dc2626;" onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'">Ya, Hapus Semua</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(id)  { const el=document.getElementById(id); el.classList.remove('hidden'); el.classList.add('flex'); }
        function closeModal(id) { const el=document.getElementById(id); el.classList.add('hidden'); el.classList.remove('flex'); }
        document.addEventListener('keydown', e => { if(e.key==='Escape') closeModal('modalHapusSemua'); });

        function filterStatus(status, btn) {
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.style.background = 'rgba(148,163,184,.08)';
                b.style.color = '#94a3b8';
                b.style.borderColor = 'rgba(148,163,184,.12)';
            });
            btn.style.background = '#d97706';
            btn.style.color = '#fff';
            btn.style.borderColor = '#d97706';
            document.querySelectorAll('.order-row').forEach(r => {
                r.style.display = (status === 'all' || r.dataset.status === status) ? '' : 'none';
            });
        }
    </script>
</body>
</html>
