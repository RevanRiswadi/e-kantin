<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Menu - Admin E-Kantin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { font-family:'Plus Jakarta Sans',sans-serif; }
        ::-webkit-scrollbar{width:4px;height:4px}
        ::-webkit-scrollbar-thumb{background:rgba(148,163,184,.2);border-radius:99px}
        @keyframes popIn{from{opacity:0;transform:scale(.94)}to{opacity:1;transform:scale(1)}}
        .pop-in{animation:popIn .2s ease-out both}
        input,select,textarea{color-scheme:dark}
    </style>
</head>
<body class="min-h-screen flex antialiased" style="background:#0b1324;color:#f1f5f9;">

    @include('admin.partials.sidebar', ['active' => 'menu'])

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
                    <h1 class="text-lg font-bold text-white">Data Menu</h1>
                    <p class="text-xs" style="color:#64748b;">Kelola semua menu makanan &amp; minuman</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="openModal('modalTambah')"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold text-white transition shadow-lg"
                        style="background:#d97706;"
                        onmouseover="this.style.background='#b45309'" onmouseout="this.style.background='#d97706'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Tambah Menu
                </button>
                <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold text-white shrink-0"
                     style="background:linear-gradient(135deg,#d97706,#f59e0b);">K</div>
            </div>
        </header>

        <main class="flex-1 p-5 lg:p-8 space-y-6 overflow-y-auto">

            @if(session('success'))
                <div class="p-4 rounded-xl text-sm font-semibold flex items-center gap-2"
                     style="background:rgba(16,185,129,.1);border:1px solid rgba(16,185,129,.25);color:#6ee7b7;">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="p-4 rounded-xl text-sm" style="background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.25);color:#fca5a5;">
                    <p class="font-bold mb-1">Mohon perbaiki:</p>
                    @foreach($errors->all() as $e)<p>• {{ $e }}</p>@endforeach
                </div>
            @endif

            {{-- STAT CARDS --}}
            <div class="grid grid-cols-2 xl:grid-cols-4 gap-4">
                @php
                    $statCards = [
                        ['label'=>'Total Menu',  'val'=>$menus->count(),                              'bg'=>'rgba(148,163,184,.1)',  'bc'=>'rgba(148,163,184,.15)', 'ic'=>'#94a3b8', 'path'=>'M4 6h16M4 10h16M4 14h16M4 18h16'],
                        ['label'=>'Makanan',     'val'=>$makanan->count(),                            'bg'=>'rgba(245,158,11,.15)',  'bc'=>'rgba(245,158,11,.2)',   'ic'=>'#fbbf24', 'path'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                        ['label'=>'Minuman',     'val'=>$minuman->count(),                            'bg'=>'rgba(56,189,248,.12)',  'bc'=>'rgba(56,189,248,.2)',   'ic'=>'#7dd3fc', 'path'=>'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                        ['label'=>'Tersedia',    'val'=>$menus->where('is_available',true)->count(),  'bg'=>'rgba(52,211,153,.12)',  'bc'=>'rgba(52,211,153,.2)',   'ic'=>'#6ee7b7', 'path'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ];
                @endphp
                @foreach($statCards as $sc)
                <div class="rounded-2xl p-5 flex items-center gap-4" style="background:#131d31;border:1px solid rgba(148,163,184,.08);">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0"
                         style="background:{{ $sc['bg'] }};border:1px solid {{ $sc['bc'] }};">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" style="color:{{ $sc['ic'] }};">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $sc['path'] }}"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-wide" style="color:#64748b;">{{ $sc['label'] }}</p>
                        <p class="text-2xl font-extrabold text-white mt-0.5 leading-none">{{ $sc['val'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- TABLE CARD --}}
            <div class="rounded-2xl overflow-hidden" style="background:#131d31;border:1px solid rgba(148,163,184,.08);">

                {{-- Filter + count --}}
                <div class="px-5 py-4 flex flex-wrap items-center justify-between gap-3" style="border-bottom:1px solid rgba(148,163,184,.08);">
                    <div class="flex flex-wrap gap-2" id="standTabs">
                        <button onclick="filterStand('all',this)"
                                class="stand-btn px-4 py-1.5 rounded-full text-xs font-semibold transition whitespace-nowrap"
                                style="background:#d97706;color:#fff;border:1px solid #d97706;">Semua Stand</button>
                        @foreach($stands as $stand)
                        <button onclick="filterStand('{{ Str::slug($stand) }}',this)"
                                class="stand-btn px-4 py-1.5 rounded-full text-xs font-semibold transition whitespace-nowrap"
                                style="background:rgba(148,163,184,.08);color:#94a3b8;border:1px solid rgba(148,163,184,.12);">{{ $stand }}</button>
                        @endforeach
                    </div>
                    <span id="visibleCount" class="text-xs font-bold px-3 py-1 rounded-full"
                          style="background:rgba(245,158,11,.12);color:#fbbf24;border:1px solid rgba(245,158,11,.2);">{{ $menus->count() }} item</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-xs min-w-[780px]">
                        <thead style="background:rgba(11,19,36,.6);border-bottom:1px solid rgba(148,163,184,.08);">
                            <tr>
                                @foreach(['#','Nama Menu','Stand','Kategori','Harga','Stok','Status','Aksi'] as $th)
                                <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide" style="color:#64748b;">{{ $th }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody id="menuTableBody">
                            @forelse($menus as $item)
                            <tr class="menu-row transition" data-stand="{{ Str::slug($item->stand) }}"
                                style="border-bottom:1px solid rgba(148,163,184,.05);"
                                onmouseover="this.style.background='rgba(245,158,11,.03)'"
                                onmouseout="this.style.background=''">
                                <td class="px-4 py-3.5 font-bold whitespace-nowrap" style="color:#fbbf24;">#{{ $item->id }}</td>
                                <td class="px-4 py-3.5 font-semibold text-white">{{ $item->name }}</td>
                                <td class="px-4 py-3.5 text-xs" style="color:#94a3b8;">{{ $item->stand }}</td>
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    @if($item->category==='makanan')
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold" style="background:rgba(245,158,11,.15);color:#fbbf24;border:1px solid rgba(245,158,11,.25);">Makanan</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold" style="background:rgba(56,189,248,.12);color:#7dd3fc;border:1px solid rgba(56,189,248,.2);">Minuman</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5 font-bold whitespace-nowrap text-white">Rp {{ number_format($item->price,0,',','.') }}</td>
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    @if(is_null($item->stock))
                                        <span style="color:#475569;">∞ Tak terbatas</span>
                                    @elseif($item->stock<=0)
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold" style="background:rgba(239,68,68,.12);color:#f87171;border:1px solid rgba(239,68,68,.2);">Habis</span>
                                    @elseif($item->stock<=5)
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold" style="background:rgba(251,146,60,.12);color:#fb923c;border:1px solid rgba(251,146,60,.2);">⚠ {{ $item->stock }} sisa</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold" style="background:rgba(52,211,153,.1);color:#6ee7b7;border:1px solid rgba(52,211,153,.2);">{{ $item->stock }} porsi</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <form action="{{ route('admin.menu.toggle',$item->id) }}" method="POST" class="inline">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-bold transition cursor-pointer"
                                                style="{{ $item->is_available ? 'background:rgba(52,211,153,.1);color:#6ee7b7;border:1px solid rgba(52,211,153,.2);' : 'background:rgba(239,68,68,.1);color:#f87171;border:1px solid rgba(239,68,68,.2);' }}">
                                            {{ $item->is_available ? '● Tersedia' : '● Nonaktif' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openEdit({{ $item->id }},@json($item->name),'{{ $item->category }}',@json($item->stand),{{ $item->price }},{{ $item->stock??'null' }},{{ $item->is_available?'true':'false' }})"
                                                class="w-8 h-8 rounded-lg flex items-center justify-center transition"
                                                style="background:rgba(56,189,248,.1);color:#7dd3fc;border:1px solid rgba(56,189,248,.15);"
                                                onmouseover="this.style.background='rgba(56,189,248,.2)'" onmouseout="this.style.background='rgba(56,189,248,.1)'"
                                                title="Edit">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </button>
                                        <button onclick="openHapus({{ $item->id }},@json($item->name))"
                                                class="w-8 h-8 rounded-lg flex items-center justify-center transition"
                                                style="background:rgba(239,68,68,.1);color:#f87171;border:1px solid rgba(239,68,68,.15);"
                                                onmouseover="this.style.background='rgba(239,68,68,.2)'" onmouseout="this.style.background='rgba(239,68,68,.1)'"
                                                title="Hapus">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="8" class="px-4 py-14 text-center text-sm" style="color:#475569;">
                                <svg class="w-10 h-10 mx-auto mb-3" style="color:#334155;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                Belum ada menu.
                            </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    {{-- ── MODAL TAMBAH ──────────────────────────────────── --}}
    <div id="modalTambah" class="fixed inset-0 z-50 hidden items-center justify-center p-4"
         style="background:rgba(0,0,0,.65);backdrop-filter:blur(6px);"
         onclick="closeModalOutside(event,'modalTambah')">
        <div class="pop-in w-full max-w-lg rounded-2xl overflow-hidden" style="background:#131d31;border:1px solid rgba(148,163,184,.12);">
            <div class="flex items-center justify-between px-6 py-4" style="border-bottom:1px solid rgba(148,163,184,.1);">
                <h2 class="text-base font-bold text-white">Tambah Menu Baru</h2>
                <button onclick="closeModal('modalTambah')" class="w-8 h-8 rounded-lg flex items-center justify-center transition"
                        style="background:rgba(148,163,184,.08);color:#94a3b8;"
                        onmouseover="this.style.background='rgba(148,163,184,.15)'" onmouseout="this.style.background='rgba(148,163,184,.08)'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form action="{{ route('admin.menu.store') }}" method="POST" class="p-6 space-y-4 max-h-[80vh] overflow-y-auto">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold mb-1.5" style="color:#94a3b8;">Nama Menu <span style="color:#f87171;">*</span></label>
                        <input type="text" name="name" required placeholder="Contoh: Nasi Goreng Spesial" value="{{ old('name') }}"
                               class="w-full rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none transition"
                               style="background:rgba(11,19,36,.8);border:1px solid rgba(71,85,105,.5);"
                               onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='rgba(71,85,105,.5)'">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="color:#94a3b8;">Kategori <span style="color:#f87171;">*</span></label>
                        <select name="category" required class="w-full rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none transition"
                                style="background:rgba(11,19,36,.8);border:1px solid rgba(71,85,105,.5);"
                                onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='rgba(71,85,105,.5)'">
                            <option value="" style="background:#131d31;">— Pilih —</option>
                            <option value="makanan" {{ old('category')=='makanan'?'selected':'' }} style="background:#131d31;">Makanan</option>
                            <option value="minuman" {{ old('category')=='minuman'?'selected':'' }} style="background:#131d31;">Minuman</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="color:#94a3b8;">Stand <span style="color:#f87171;">*</span></label>
                        <input type="text" name="stand" required placeholder="Contoh: Stand 1" value="{{ old('stand') }}" list="standList"
                               class="w-full rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none transition"
                               style="background:rgba(11,19,36,.8);border:1px solid rgba(71,85,105,.5);"
                               onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='rgba(71,85,105,.5)'">
                        <datalist id="standList">@foreach($stands as $s)<option value="{{ $s }}">@endforeach</datalist>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="color:#94a3b8;">Harga (Rp) <span style="color:#f87171;">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-semibold" style="color:#64748b;">Rp</span>
                            <input type="number" name="price" required min="500" placeholder="12000" value="{{ old('price') }}"
                                   class="w-full rounded-xl pl-8 pr-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none transition"
                                   style="background:rgba(11,19,36,.8);border:1px solid rgba(71,85,105,.5);"
                                   onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='rgba(71,85,105,.5)'">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="color:#94a3b8;">Stok <span class="font-normal" style="color:#475569;">(kosong = tak terbatas)</span></label>
                        <input type="number" name="stock" min="0" placeholder="20" value="{{ old('stock') }}"
                               class="w-full rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none transition"
                               style="background:rgba(11,19,36,.8);border:1px solid rgba(71,85,105,.5);"
                               onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='rgba(71,85,105,.5)'">
                    </div>
                    <div class="sm:col-span-2 flex items-center gap-3 p-3.5 rounded-xl" style="background:rgba(11,19,36,.5);border:1px solid rgba(71,85,105,.3);">
                        <input type="checkbox" name="is_available" id="add_avail" value="1" {{ old('is_available','1')?'checked':'' }}
                               class="w-4 h-4 cursor-pointer" style="accent-color:#d97706;">
                        <label for="add_avail" class="text-sm cursor-pointer select-none" style="color:#cbd5e1;">Menu langsung tersedia untuk dipesan</label>
                    </div>
                </div>
                <div class="flex justify-end gap-3 pt-1">
                    <button type="button" onclick="closeModal('modalTambah')"
                            class="px-5 py-2 rounded-xl text-sm font-semibold transition"
                            style="background:rgba(148,163,184,.08);color:#94a3b8;border:1px solid rgba(148,163,184,.12);"
                            onmouseover="this.style.background='rgba(148,163,184,.15)'" onmouseout="this.style.background='rgba(148,163,184,.08)'">Batal</button>
                    <button type="submit"
                            class="px-5 py-2 rounded-xl text-sm font-semibold text-white transition"
                            style="background:#d97706;" onmouseover="this.style.background='#b45309'" onmouseout="this.style.background='#d97706'">Simpan Menu</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ── MODAL EDIT ────────────────────────────────────── --}}
    <div id="modalEdit" class="fixed inset-0 z-50 hidden items-center justify-center p-4"
         style="background:rgba(0,0,0,.65);backdrop-filter:blur(6px);"
         onclick="closeModalOutside(event,'modalEdit')">
        <div class="pop-in w-full max-w-lg rounded-2xl overflow-hidden" style="background:#131d31;border:1px solid rgba(148,163,184,.12);">
            <div class="flex items-center justify-between px-6 py-4" style="border-bottom:1px solid rgba(148,163,184,.1);">
                <h2 class="text-base font-bold text-white">Edit Menu</h2>
                <button onclick="closeModal('modalEdit')" class="w-8 h-8 rounded-lg flex items-center justify-center transition"
                        style="background:rgba(148,163,184,.08);color:#94a3b8;"
                        onmouseover="this.style.background='rgba(148,163,184,.15)'" onmouseout="this.style.background='rgba(148,163,184,.08)'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form id="editForm" action="" method="POST" class="p-6 space-y-4 max-h-[80vh] overflow-y-auto">
                @csrf @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold mb-1.5" style="color:#94a3b8;">Nama Menu <span style="color:#f87171;">*</span></label>
                        <input type="text" id="edit_name" name="name" required
                               class="w-full rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none transition"
                               style="background:rgba(11,19,36,.8);border:1px solid rgba(71,85,105,.5);"
                               onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='rgba(71,85,105,.5)'">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="color:#94a3b8;">Kategori <span style="color:#f87171;">*</span></label>
                        <select id="edit_category" name="category" required
                                class="w-full rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none transition"
                                style="background:rgba(11,19,36,.8);border:1px solid rgba(71,85,105,.5);"
                                onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='rgba(71,85,105,.5)'">
                            <option value="makanan" style="background:#131d31;">Makanan</option>
                            <option value="minuman" style="background:#131d31;">Minuman</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="color:#94a3b8;">Stand <span style="color:#f87171;">*</span></label>
                        <input type="text" id="edit_stand" name="stand" required list="standListEdit"
                               class="w-full rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none transition"
                               style="background:rgba(11,19,36,.8);border:1px solid rgba(71,85,105,.5);"
                               onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='rgba(71,85,105,.5)'">
                        <datalist id="standListEdit">@foreach($stands as $s)<option value="{{ $s }}">@endforeach</datalist>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="color:#94a3b8;">Harga (Rp) <span style="color:#f87171;">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-semibold" style="color:#64748b;">Rp</span>
                            <input type="number" id="edit_price" name="price" required min="500"
                                   class="w-full rounded-xl pl-8 pr-4 py-2.5 text-sm text-white focus:outline-none transition"
                                   style="background:rgba(11,19,36,.8);border:1px solid rgba(71,85,105,.5);"
                                   onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='rgba(71,85,105,.5)'">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="color:#94a3b8;">Stok</label>
                        <input type="number" id="edit_stock" name="stock" min="0"
                               class="w-full rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none transition"
                               style="background:rgba(11,19,36,.8);border:1px solid rgba(71,85,105,.5);"
                               onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='rgba(71,85,105,.5)'">
                    </div>
                    <div class="sm:col-span-2 flex items-center gap-3 p-3.5 rounded-xl" style="background:rgba(11,19,36,.5);border:1px solid rgba(71,85,105,.3);">
                        <input type="checkbox" id="edit_avail" name="is_available" value="1" class="w-4 h-4 cursor-pointer" style="accent-color:#d97706;">
                        <label for="edit_avail" class="text-sm cursor-pointer select-none" style="color:#cbd5e1;">Menu tersedia untuk dipesan</label>
                    </div>
                </div>
                <div class="flex justify-end gap-3 pt-1">
                    <button type="button" onclick="closeModal('modalEdit')"
                            class="px-5 py-2 rounded-xl text-sm font-semibold transition"
                            style="background:rgba(148,163,184,.08);color:#94a3b8;border:1px solid rgba(148,163,184,.12);"
                            onmouseover="this.style.background='rgba(148,163,184,.15)'" onmouseout="this.style.background='rgba(148,163,184,.08)'">Batal</button>
                    <button type="submit"
                            class="px-5 py-2 rounded-xl text-sm font-semibold text-white transition"
                            style="background:#2563eb;" onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563eb'">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ── MODAL HAPUS ───────────────────────────────────── --}}
    <div id="modalHapus" class="fixed inset-0 z-50 hidden items-center justify-center p-4"
         style="background:rgba(0,0,0,.65);backdrop-filter:blur(6px);"
         onclick="closeModalOutside(event,'modalHapus')">
        <div class="pop-in w-full max-w-sm rounded-2xl p-6 text-center" style="background:#131d31;border:1px solid rgba(239,68,68,.2);">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4"
                 style="background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.2);">
                <svg class="w-7 h-7" style="color:#f87171;" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
            <h2 class="text-base font-bold text-white mb-1">Hapus Menu?</h2>
            <p class="text-sm mb-1" style="color:#94a3b8;">Anda akan menghapus:</p>
            <p id="hapusNama" class="text-sm font-bold mb-4" style="color:#f87171;"></p>
            <p class="text-xs mb-5" style="color:#475569;">Tindakan ini tidak bisa dibatalkan.</p>
            <div class="flex gap-3">
                <button onclick="closeModal('modalHapus')"
                        class="flex-1 py-2.5 rounded-xl text-sm font-semibold transition"
                        style="background:rgba(148,163,184,.08);color:#94a3b8;border:1px solid rgba(148,163,184,.12);"
                        onmouseover="this.style.background='rgba(148,163,184,.15)'" onmouseout="this.style.background='rgba(148,163,184,.08)'">Batal</button>
                <form id="hapusForm" action="" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-2.5 rounded-xl text-sm font-bold text-white transition"
                            style="background:#dc2626;" onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(id) { const el=document.getElementById(id); el.classList.remove('hidden'); el.classList.add('flex'); }
        function closeModal(id) { const el=document.getElementById(id); el.classList.add('hidden'); el.classList.remove('flex'); }
        function closeModalOutside(e,id) { if(e.target.id===id) closeModal(id); }
        document.addEventListener('keydown', e => { if(e.key==='Escape') ['modalTambah','modalEdit','modalHapus'].forEach(closeModal); });

        function openEdit(id,name,category,stand,price,stock,available) {
            document.getElementById('editForm').action = `/admin/menu/${id}`;
            document.getElementById('edit_name').value     = name;
            document.getElementById('edit_category').value = category;
            document.getElementById('edit_stand').value    = stand;
            document.getElementById('edit_price').value    = price;
            document.getElementById('edit_stock').value    = stock !== null ? stock : '';
            document.getElementById('edit_avail').checked  = available;
            openModal('modalEdit');
        }
        function openHapus(id,name) {
            document.getElementById('hapusForm').action = `/admin/menu/${id}`;
            document.getElementById('hapusNama').textContent = `"${name}"`;
            openModal('modalHapus');
        }
        function filterStand(slug,btn) {
            document.querySelectorAll('.stand-btn').forEach(b => {
                b.style.background='rgba(148,163,184,.08)';b.style.color='#94a3b8';b.style.borderColor='rgba(148,163,184,.12)';
            });
            btn.style.background='#d97706';btn.style.color='#fff';btn.style.borderColor='#d97706';
            let v=0;
            document.querySelectorAll('.menu-row').forEach(r => {
                const show=slug==='all'||r.dataset.stand===slug;
                r.style.display=show?'':'none';if(show)v++;
            });
            document.getElementById('visibleCount').textContent=`${v} item`;
        }
        @if($errors->any() && old('name'))
            document.addEventListener('DOMContentLoaded',()=>openModal('modalTambah'));
        @endif
    </script>
</body>
</html>
