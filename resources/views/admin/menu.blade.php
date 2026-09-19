<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Menu - Admin E-Kantin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        @keyframes fadeIn  { from { opacity:0; transform:translateY(6px); } to { opacity:1; transform:translateY(0); } }
        @keyframes popIn   { from { opacity:0; transform:scale(.93);      } to { opacity:1; transform:scale(1);     } }
        .fade-in  { animation: fadeIn  .3s ease-out both; }
        .pop-in   { animation: popIn   .25s ease-out both; }
        .modal-bg { backdrop-filter: blur(5px); }
    </style>
</head>
<body class="bg-[#f4f5fa] text-slate-800 min-h-screen flex flex-col lg:flex-row antialiased overflow-x-hidden">

    {{-- SIDEBAR --}}
    @include('admin.partials.sidebar', ['active' => 'menu'])

    {{-- ═══════════════════════════════════════════════════════
         KONTEN UTAMA
    ═══════════════════════════════════════════════════════ --}}
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
                    <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-tight">Data Menu</h1>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">Kelola semua menu makanan &amp; minuman kantin</p>
                </div>
            </div>
            <div class="flex items-center gap-2 sm:gap-3">
                {{-- Tombol Tambah Menu --}}
                <button onclick="openModal('modalTambah')"
                        class="inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-2 sm:py-2.5 rounded-xl text-xs sm:text-sm font-bold text-white transition shadow-md whitespace-nowrap"
                        style="background:#d97706;"
                        onmouseover="this.style.background='#b45309'"
                        onmouseout="this.style.background='#d97706'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    <span>Tambah Menu</span>
                </button>
                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-amber-500 text-white font-extrabold flex items-center justify-center text-xs sm:text-sm shadow shrink-0">K</div>
            </div>
        </header>

        {{-- FLASH --}}
        @if(session('success'))
            <div class="mb-5 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-semibold flex items-center gap-2 fade-in">
                <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-5 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm fade-in">
                <p class="font-bold mb-1">Mohon perbaiki kesalahan:</p>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
        @endif

        {{-- STATISTIK --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 mb-6 fade-in">
            <div class="bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-100 shadow-sm text-center">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Menu</p>
                <p class="text-2xl sm:text-3xl font-extrabold text-slate-800">{{ $menus->count() }}</p>
            </div>
            <div class="bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-100 shadow-sm text-center">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Makanan</p>
                <p class="text-2xl sm:text-3xl font-extrabold text-amber-500">{{ $makanan->count() }}</p>
            </div>
            <div class="bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-100 shadow-sm text-center">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Minuman</p>
                <p class="text-2xl sm:text-3xl font-extrabold text-blue-500">{{ $minuman->count() }}</p>
            </div>
            <div class="bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-100 shadow-sm text-center">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Tersedia</p>
                <p class="text-2xl sm:text-3xl font-extrabold text-emerald-500">{{ $menus->where('is_available', true)->count() }}</p>
            </div>
        </div>

        {{-- FILTER TAB STAND --}}
        <div class="flex flex-wrap gap-2 mb-4 overflow-x-auto pb-1" id="standTabs">
            <button onclick="filterStand('all', this)"
                    class="stand-btn active px-3.5 sm:px-4 py-2 rounded-xl text-xs font-bold border transition-all whitespace-nowrap"
                    style="background:#d97706;color:#fff;border-color:#d97706;">
                🍽️ Semua Stand
            </button>
            @foreach($stands as $stand)
                <button onclick="filterStand('{{ Str::slug($stand) }}', this)"
                        class="stand-btn px-3.5 sm:px-4 py-2 rounded-xl text-xs font-bold border border-slate-200 text-slate-500 bg-white hover:border-amber-400 transition-all whitespace-nowrap">
                    🏪 {{ $stand }}
                </button>
            @endforeach
        </div>

        {{-- TABEL MENU --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden fade-in">
            <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between gap-3">
                <h3 class="text-sm font-extrabold text-slate-800">📋 Daftar Menu</h3>
                <span id="visibleCount"
                      class="text-[10px] font-bold bg-amber-100 text-amber-600 px-2.5 py-1 rounded-full">
                    {{ $menus->count() }} item
                </span>
            </div>
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left text-xs text-slate-600 min-w-[720px]">
                    <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] tracking-wider border-b border-slate-100">
                        <tr>
                            <th class="p-3.5 sm:p-4 w-10">#</th>
                            <th class="p-3.5 sm:p-4">Nama Menu</th>
                            <th class="p-3.5 sm:p-4">Stand</th>
                            <th class="p-3.5 sm:p-4">Kategori</th>
                            <th class="p-3.5 sm:p-4">Harga</th>
                            <th class="p-3.5 sm:p-4">Stok</th>
                            <th class="p-3.5 sm:p-4">Status</th>
                            <th class="p-3.5 sm:p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50" id="menuTableBody">
                        @forelse($menus as $item)
                            <tr class="hover:bg-slate-50/70 transition menu-row"
                                data-stand="{{ Str::slug($item->stand) }}">
                                <td class="p-3.5 sm:p-4 font-bold text-amber-500 whitespace-nowrap">#{{ $item->id }}</td>
                                <td class="p-3.5 sm:p-4 font-bold text-slate-800">{{ $item->name }}</td>
                                <td class="p-3.5 sm:p-4">
                                    <span class="text-[11px] font-semibold text-slate-500">{{ $item->stand }}</span>
                                </td>
                                <td class="p-3.5 sm:p-4 whitespace-nowrap">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold
                                        {{ $item->category === 'makanan' ? 'bg-amber-100 text-amber-600' : 'bg-blue-100 text-blue-600' }}">
                                        {{ $item->category === 'makanan' ? '🍔 Makanan' : '🥤 Minuman' }}
                                    </span>
                                </td>
                                <td class="p-3.5 sm:p-4 font-extrabold text-slate-700 whitespace-nowrap">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </td>
                                <td class="p-3.5 sm:p-4 whitespace-nowrap">
                                    @if(is_null($item->stock))
                                        <span class="text-[10px] font-semibold text-slate-400">∞ Tak terbatas</span>
                                    @elseif($item->stock <= 0)
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-100 text-red-500">Habis</span>
                                    @elseif($item->stock <= 5)
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-orange-100 text-orange-600">⚠ {{ $item->stock }} sisa</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-600">{{ $item->stock }} porsi</span>
                                    @endif
                                </td>
                                <td class="p-3.5 sm:p-4 whitespace-nowrap">
                                    {{-- Toggle status --}}
                                    <form action="{{ route('admin.menu.toggle', $item->id) }}" method="POST" class="inline">
                                        @csrf @method('PATCH')
                                        <button type="submit"
                                                class="px-2.5 py-1 rounded-full text-[10px] font-bold transition
                                                    {{ $item->is_available ? 'bg-emerald-100 text-emerald-600 hover:bg-emerald-200' : 'bg-red-100 text-red-500 hover:bg-red-200' }}"
                                                title="{{ $item->is_available ? 'Klik untuk nonaktifkan' : 'Klik untuk aktifkan' }}">
                                            {{ $item->is_available ? '● Tersedia' : '● Habis' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="p-3.5 sm:p-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Tombol Edit --}}
                                        <button
                                            onclick="openEdit({{ $item->id }}, @json($item->name), '{{ $item->category }}', @json($item->stand), {{ $item->price }}, {{ $item->stock ?? 'null' }}, {{ $item->is_available ? 'true' : 'false' }})"
                                            class="w-8 h-8 rounded-lg flex items-center justify-center transition text-blue-600 bg-blue-50 hover:bg-blue-100"
                                            title="Edit">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </button>
                                        {{-- Tombol Hapus --}}
                                        <button
                                            onclick="openHapus({{ $item->id }}, @json($item->name))"
                                            class="w-8 h-8 rounded-lg flex items-center justify-center transition text-red-500 bg-red-50 hover:bg-red-100"
                                            title="Hapus">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-10 text-center text-slate-400">
                                    <div class="text-4xl mb-2">🍽️</div>
                                    Belum ada menu. Klik "Tambah Menu" untuk mulai.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>{{-- /main --}}


    {{-- ═══════════════════════════════════════════════════════
         MODAL: TAMBAH MENU
    ═══════════════════════════════════════════════════════ --}}
    <div id="modalTambah"
         class="modal-bg fixed inset-0 z-50 hidden items-center justify-center p-4 overflow-y-auto"
         style="background:rgba(0,0,0,.55);"
         onclick="closeModalOutside(event,'modalTambah')">
        <div class="pop-in bg-white w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-2xl shadow-2xl my-auto">
            {{-- Header --}}
            <div class="flex items-center justify-between px-5 sm:px-6 py-4 border-b border-slate-100 sticky top-0 bg-white z-10">
                <h2 class="text-base font-extrabold text-slate-800">➕ Tambah Menu Baru</h2>
                <button onclick="closeModal('modalTambah')"
                        class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 transition text-sm"
                        aria-label="Tutup">✕</button>
            </div>
            {{-- Form --}}
            <form action="{{ route('admin.menu.store') }}" method="POST" class="p-5 sm:p-6 space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Nama --}}
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-600 mb-1.5">Nama Menu <span class="text-red-400">*</span></label>
                        <input type="text" name="name" required placeholder="Contoh: Nasi Goreng Spesial"
                               value="{{ old('name') }}"
                               class="w-full rounded-xl px-4 py-2.5 text-sm border border-slate-200 focus:outline-none focus:border-amber-400 transition">
                    </div>
                    {{-- Kategori --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5">Kategori <span class="text-red-400">*</span></label>
                        <select name="category" required
                                class="w-full rounded-xl px-4 py-2.5 text-sm border border-slate-200 focus:outline-none focus:border-amber-400 transition bg-white">
                            <option value="">— Pilih —</option>
                            <option value="makanan" {{ old('category')=='makanan'?'selected':'' }}>🍔 Makanan</option>
                            <option value="minuman" {{ old('category')=='minuman'?'selected':'' }}>🥤 Minuman</option>
                        </select>
                    </div>
                    {{-- Stand --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5">Stand <span class="text-red-400">*</span></label>
                        <input type="text" name="stand" required placeholder="Contoh: Stand 1 - Makanan Utama"
                               value="{{ old('stand') }}"
                               list="standList"
                               class="w-full rounded-xl px-4 py-2.5 text-sm border border-slate-200 focus:outline-none focus:border-amber-400 transition">
                        <datalist id="standList">
                            @foreach($stands as $s)
                                <option value="{{ $s }}">
                            @endforeach
                        </datalist>
                    </div>
                    {{-- Harga --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5">Harga (Rp) <span class="text-red-400">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400">Rp</span>
                            <input type="number" name="price" required min="500" placeholder="12000"
                                   value="{{ old('price') }}"
                                   class="w-full rounded-xl pl-8 pr-4 py-2.5 text-sm border border-slate-200 focus:outline-none focus:border-amber-400 transition">
                        </div>
                    </div>
                    {{-- Stok --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5">
                            Stok
                            <span class="text-[10px] font-normal text-slate-400">(kosongkan = tak terbatas)</span>
                        </label>
                        <input type="number" name="stock" min="0" placeholder="Contoh: 20"
                               value="{{ old('stock') }}"
                               class="w-full rounded-xl px-4 py-2.5 text-sm border border-slate-200 focus:outline-none focus:border-amber-400 transition">
                    </div>
                    {{-- Status --}}
                    <div class="sm:col-span-2 flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-200">
                        <input type="checkbox" name="is_available" id="add_available" value="1"
                               {{ old('is_available', '1') ? 'checked' : '' }}
                               class="w-4 h-4 accent-amber-500 rounded cursor-pointer">
                        <label for="add_available" class="text-sm font-semibold text-slate-700 cursor-pointer select-none">
                            Menu langsung tersedia untuk dipesan
                        </label>
                    </div>
                </div>
                {{-- Footer --}}
                <div class="flex flex-wrap justify-end gap-3 pt-2">
                    <button type="button" onclick="closeModal('modalTambah')"
                            class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-5 py-2.5 rounded-xl text-sm font-bold text-white transition shadow"
                            style="background:#d97706;"
                            onmouseover="this.style.background='#b45309'"
                            onmouseout="this.style.background='#d97706'">
                        ➕ Simpan Menu
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- ═══════════════════════════════════════════════════════
         MODAL: EDIT MENU
    ═══════════════════════════════════════════════════════ --}}
    <div id="modalEdit"
         class="modal-bg fixed inset-0 z-50 hidden items-center justify-center p-4 overflow-y-auto"
         style="background:rgba(0,0,0,.55);"
         onclick="closeModalOutside(event,'modalEdit')">
        <div class="pop-in bg-white w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-2xl shadow-2xl my-auto">
            <div class="flex items-center justify-between px-5 sm:px-6 py-4 border-b border-slate-100 sticky top-0 bg-white z-10">
                <h2 class="text-base font-extrabold text-slate-800">✏️ Edit Menu</h2>
                <button onclick="closeModal('modalEdit')"
                        class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 transition text-sm"
                        aria-label="Tutup">✕</button>
            </div>
            <form id="editForm" action="" method="POST" class="p-5 sm:p-6 space-y-4">
                @csrf @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-600 mb-1.5">Nama Menu <span class="text-red-400">*</span></label>
                        <input type="text" id="edit_name" name="name" required
                               class="w-full rounded-xl px-4 py-2.5 text-sm border border-slate-200 focus:outline-none focus:border-amber-400 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5">Kategori <span class="text-red-400">*</span></label>
                        <select id="edit_category" name="category" required
                                class="w-full rounded-xl px-4 py-2.5 text-sm border border-slate-200 focus:outline-none focus:border-amber-400 transition bg-white">
                            <option value="makanan">🍔 Makanan</option>
                            <option value="minuman">🥤 Minuman</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5">Stand <span class="text-red-400">*</span></label>
                        <input type="text" id="edit_stand" name="stand" required
                                list="standListEdit"
                                class="w-full rounded-xl px-4 py-2.5 text-sm border border-slate-200 focus:outline-none focus:border-amber-400 transition">
                        <datalist id="standListEdit">
                            @foreach($stands as $s)
                                <option value="{{ $s }}">
                            @endforeach
                        </datalist>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5">Harga (Rp) <span class="text-red-400">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400">Rp</span>
                            <input type="number" id="edit_price" name="price" required min="500"
                                   class="w-full rounded-xl pl-8 pr-4 py-2.5 text-sm border border-slate-200 focus:outline-none focus:border-amber-400 transition">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5">
                            Stok
                            <span class="text-[10px] font-normal text-slate-400">(kosongkan = tak terbatas)</span>
                        </label>
                        <input type="number" id="edit_stock" name="stock" min="0"
                               class="w-full rounded-xl px-4 py-2.5 text-sm border border-slate-200 focus:outline-none focus:border-amber-400 transition">
                    </div>
                    <div class="sm:col-span-2 flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-200">
                        <input type="checkbox" id="edit_available" name="is_available" value="1"
                               class="w-4 h-4 accent-amber-500 rounded cursor-pointer">
                        <label for="edit_available" class="text-sm font-semibold text-slate-700 cursor-pointer select-none">
                            Menu tersedia untuk dipesan
                        </label>
                    </div>
                </div>
                <div class="flex flex-wrap justify-end gap-3 pt-2">
                    <button type="button" onclick="closeModal('modalEdit')"
                            class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-5 py-2.5 rounded-xl text-sm font-bold text-white transition shadow"
                            style="background:#2563eb;"
                            onmouseover="this.style.background='#1d4ed8'"
                            onmouseout="this.style.background='#2563eb'">
                        💾 Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- ═══════════════════════════════════════════════════════
         MODAL: KONFIRMASI HAPUS
    ═══════════════════════════════════════════════════════ --}}
    <div id="modalHapus"
         class="modal-bg fixed inset-0 z-50 hidden items-center justify-center p-4 overflow-y-auto"
         style="background:rgba(0,0,0,.55);"
         onclick="closeModalOutside(event,'modalHapus')">
        <div class="pop-in bg-white w-full max-w-sm rounded-2xl shadow-2xl p-5 sm:p-6 text-center my-auto">
            <div class="text-4xl sm:text-5xl mb-3">🗑️</div>
            <h2 class="text-base font-extrabold text-slate-800 mb-1">Hapus Menu?</h2>
            <p class="text-sm text-slate-500 mb-1">Anda akan menghapus menu:</p>
            <p id="hapusNama" class="text-sm font-extrabold text-red-500 mb-4 sm:mb-5"></p>
            <p class="text-xs text-slate-400 mb-5">Tindakan ini tidak bisa dibatalkan. Data order yang sudah ada tetap tersimpan.</p>
            <div class="flex gap-3">
                <button onclick="closeModal('modalHapus')"
                        class="flex-1 py-2.5 rounded-xl text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition">
                    Batal
                </button>
                <form id="hapusForm" action="" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-full py-2.5 rounded-xl text-sm font-bold text-white bg-red-500 hover:bg-red-600 transition">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>


    {{-- ═══════════════════════════════════════════════════════
         JAVASCRIPT
    ═══════════════════════════════════════════════════════ --}}
    <script>
        // ── Modal helpers ────────────────────────────────────────
        function openModal(id) {
            const el = document.getElementById(id);
            el.classList.remove('hidden');
            el.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }
        function closeModal(id) {
            const el = document.getElementById(id);
            el.classList.add('hidden');
            el.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }
        function closeModalOutside(e, id) {
            if (e.target.id === id) closeModal(id);
        }
        // ESC menutup semua modal
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                ['modalTambah','modalEdit','modalHapus'].forEach(closeModal);
            }
        });

        // ── Buka modal Edit, isi data ---------------------------
        function openEdit(id, name, category, stand, price, stock, available) {
            document.getElementById('editForm').action = `/admin/menu/${id}`;
            document.getElementById('edit_name').value     = name;
            document.getElementById('edit_category').value = category;
            document.getElementById('edit_stand').value    = stand;
            document.getElementById('edit_price').value    = price;
            document.getElementById('edit_stock').value    = stock !== null ? stock : '';
            document.getElementById('edit_available').checked = available;
            openModal('modalEdit');
        }

        // ── Buka modal Hapus ------------------------------------
        function openHapus(id, name) {
            document.getElementById('hapusForm').action = `/admin/menu/${id}`;
            document.getElementById('hapusNama').textContent = `"${name}"`;
            openModal('modalHapus');
        }

        // ── Filter stand ----------------------------------------
        function filterStand(slug, btn) {
            // Update tombol aktif
            document.querySelectorAll('.stand-btn').forEach(b => {
                b.style.background  = '';
                b.style.color       = '';
                b.style.borderColor = '';
                b.classList.remove('active');
                b.classList.add('text-slate-500','bg-white','border-slate-200');
            });
            btn.style.background  = '#d97706';
            btn.style.color       = '#fff';
            btn.style.borderColor = '#d97706';
            btn.classList.add('active');
            btn.classList.remove('text-slate-500','bg-white','border-slate-200');

            // Filter baris
            let visible = 0;
            document.querySelectorAll('.menu-row').forEach(row => {
                const show = slug === 'all' || row.dataset.stand === slug;
                row.style.display = show ? '' : 'none';
                if (show) visible++;
            });
            document.getElementById('visibleCount').textContent = `${visible} item`;
        }

        // ── Buka modal Tambah jika ada error validasi (setelah redirect back) ──
        @if($errors->any() && old('name'))
            document.addEventListener('DOMContentLoaded', () => openModal('modalTambah'));
        @endif
    </script>

</body>
</html>
