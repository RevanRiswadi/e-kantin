<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Kantin SMKN 1 Ciomas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        input[type=number] { -moz-appearance: textfield; }
        .qty-btn:active { transform: scale(0.88); }
        select option { background-color: #0b1324; }

        /* Tab aktif */
        .tab-btn.active {
            background-color: #d97706;
            color: #fff;
            border-color: #d97706;
        }

        /* Modal backdrop */
        #strutModal { backdrop-filter: blur(6px); }

        /* Animasi masuk modal */
        @keyframes popIn {
            0%   { transform: scale(0.85); opacity: 0; }
            100% { transform: scale(1);    opacity: 1; }
        }
        #strutCard { animation: popIn .25s ease-out; }

        /* Dot blink untuk kode antrean */
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.3} }
        .blink { animation: blink 1.4s infinite; }
    </style>
</head>
<body class="min-h-screen py-6 px-4 sm:px-6" style="background-color:#0b1324;color:#f1f5f9;">

<div class="max-w-5xl mx-auto space-y-6">

    {{-- ════════════════════════════════════════════════════
         NAVBAR
    ════════════════════════════════════════════════════ --}}
    <header class="flex flex-wrap items-center justify-between gap-3 pb-2">
        <div class="flex items-center gap-3">
            <span class="text-3xl" role="img" aria-label="kantin">🍱</span>
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold leading-tight tracking-tight">
                    <span class="text-amber-400">E-Kantin</span>
                    <span class="text-white"> SMKN 1 Ciomas</span>
                </h1>
                <p class="text-xs text-slate-400 leading-none mt-0.5 hidden sm:block">Sistem pre-order kantin sekolah</p>
            </div>
        </div>

        <div class="flex items-center gap-2 sm:gap-3">
            {{-- Badge --}}
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-full border"
                  style="color:#fbbf24;background:rgba(245,158,11,.1);border-color:rgba(245,158,11,.3);">
                <span class="w-2 h-2 rounded-full bg-amber-400 blink inline-block"></span>
                Pre-Order System
            </span>
            {{-- Tombol Admin — permanen --}}
            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center gap-1.5 px-4 py-1.5 text-xs font-bold text-white rounded-full transition-all duration-200 shadow-md"
               style="background-color:#d97706;"
               onmouseover="this.style.backgroundColor='#b45309'"
               onmouseout="this.style.backgroundColor='#d97706'">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Admin
            </a>
        </div>
    </header>

    {{-- ════════════════════════════════════════════════════
         FLASH ERROR
    ════════════════════════════════════════════════════ --}}
    @if(session('error'))
        <div class="flex items-start gap-3 p-4 rounded-xl border text-sm"
             style="background:rgba(239,68,68,.1);border-color:rgba(239,68,68,.4);color:#fca5a5;">
            <svg class="w-4 h-4 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div class="p-4 rounded-xl border text-sm space-y-0.5"
             style="background:rgba(239,68,68,.1);border-color:rgba(239,68,68,.4);color:#fca5a5;">
            @foreach($errors->all() as $e)<p>• {{ $e }}</p>@endforeach
        </div>
    @endif

    {{-- ════════════════════════════════════════════════════
         BANNER HERO
    ════════════════════════════════════════════════════ --}}
    <div class="relative overflow-hidden rounded-2xl p-6 sm:p-8 shadow-xl"
         style="background:linear-gradient(135deg,#ea580c 0%,#d97706 55%,#ca8a04 100%);">
        <div class="absolute -top-8 -right-8 w-44 h-44 rounded-full opacity-20 bg-white"></div>
        <div class="absolute -bottom-10 -left-6 w-32 h-32 rounded-full opacity-10 bg-white"></div>
        <div class="relative z-10">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold mb-3"
                  style="background:rgba(255,255,255,.2);color:#fff7ed;">
                <span class="w-2 h-2 rounded-full bg-white blink inline-block"></span>
                Sistem Buka Setiap Hari Sekolah
            </span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-white mb-2 leading-tight">
                Pesan Duluan,<br class="sm:hidden"> Bebas Antre! 🚀
            </h2>
            <p class="text-orange-100 text-sm sm:text-base max-w-xl">
                Order sekarang, tinggal ambil pas istirahat — tanpa antri panjang!
            </p>
            {{-- Statistik singkat --}}
            <div class="flex flex-wrap gap-4 mt-4">
                <div class="flex items-center gap-2 text-xs font-semibold text-orange-100">
                    <span class="text-base">🍔</span> {{ $menus->count() }} Menu Tersedia
                </div>
                <div class="flex items-center gap-2 text-xs font-semibold text-orange-100">
                    <span class="text-base">🏪</span> {{ $stands->count() }} Stand Kantin
                </div>
                <div class="flex items-center gap-2 text-xs font-semibold text-orange-100">
                    <span class="text-base">⚡</span> Order Real-time
                </div>
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════
         FORM PEMESANAN
    ════════════════════════════════════════════════════ --}}
    <form action="{{ route('order.store') }}" method="POST" id="orderForm" class="space-y-6">
        @csrf

        {{-- ── BAGIAN 1: DATA PEMESAN ─────────────────────────── --}}
        <div class="rounded-2xl p-6 shadow-lg" style="background:#131d31;border:1px solid rgba(148,163,184,.1);">
            <h3 class="font-bold text-base mb-5 flex items-center gap-2" style="color:#fbbf24;">
                <span class="flex items-center justify-center w-7 h-7 rounded-lg text-sm" style="background:rgba(245,158,11,.15);">📋</span>
                Data Pemesan
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Nama --}}
                <div>
                    <label for="student_name" class="block text-xs font-semibold mb-1.5" style="color:#cbd5e1;">
                        Nama Lengkap <span class="text-red-400">*</span>
                    </label>
                    <input type="text" id="student_name" name="student_name" required
                           placeholder="Contoh: Revan Riswadi"
                           value="{{ old('student_name') }}"
                           class="w-full rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none transition-colors"
                           style="background:#0b1324;border:1px solid rgba(71,85,105,.6);"
                           onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='rgba(71,85,105,.6)'">
                    @error('student_name')<p class="text-xs mt-1 text-red-400">{{ $message }}</p>@enderror
                </div>
                {{-- Kelas --}}
                <div>
                    <label for="class_major" class="block text-xs font-semibold mb-1.5" style="color:#cbd5e1;">
                        Kelas &amp; Jurusan <span class="text-red-400">*</span>
                    </label>
                    <input type="text" id="class_major" name="class_major" required
                           placeholder="Contoh: X PPLG 1"
                           value="{{ old('class_major') }}"
                           class="w-full rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none transition-colors"
                           style="background:#0b1324;border:1px solid rgba(71,85,105,.6);"
                           onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='rgba(71,85,105,.6)'">
                    @error('class_major')<p class="text-xs mt-1 text-red-400">{{ $message }}</p>@enderror
                </div>
                {{-- WhatsApp --}}
                <div>
                    <label for="whatsapp" class="block text-xs font-semibold mb-1.5" style="color:#cbd5e1;">
                        Nomor WhatsApp <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm" style="color:#64748b;">📱</span>
                        <input type="tel" id="whatsapp" name="whatsapp" required
                               placeholder="Contoh: 08123456789"
                               value="{{ old('whatsapp') }}"
                               class="w-full rounded-xl pl-9 pr-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none transition-colors"
                               style="background:#0b1324;border:1px solid rgba(71,85,105,.6);"
                               onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='rgba(71,85,105,.6)'">
                    </div>
                    @error('whatsapp')<p class="text-xs mt-1 text-red-400">{{ $message }}</p>@enderror
                </div>
                {{-- Jam Pengambilan --}}
                <div>
                    <label for="break_time" class="block text-xs font-semibold mb-1.5" style="color:#cbd5e1;">
                        Jam Pengambilan <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm pointer-events-none" style="color:#64748b;">🕐</span>
                        <select id="break_time" name="break_time" required
                                class="w-full rounded-xl pl-9 pr-10 py-2.5 text-sm text-white appearance-none focus:outline-none transition-colors"
                                style="background:#0b1324;border:1px solid rgba(71,85,105,.6);"
                                onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='rgba(71,85,105,.6)'">
                            <option value="Istirahat 1" {{ old('break_time')=='Istirahat 1'?'selected':'' }}>Istirahat 1 (~10.00)</option>
                            <option value="Istirahat 2" {{ old('break_time')=='Istirahat 2'?'selected':'' }}>Istirahat 2 (~12.00)</option>
                        </select>
                        <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 pointer-events-none" style="color:#64748b;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                    @error('break_time')<p class="text-xs mt-1 text-red-400">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        {{-- ── BAGIAN 2: METODE PEMBAYARAN ────────────────────── --}}
        <div class="rounded-2xl p-6 shadow-lg" style="background:#131d31;border:1px solid rgba(148,163,184,.1);">
            <h3 class="font-bold text-base mb-4 flex items-center gap-2" style="color:#fbbf24;">
                <span class="flex items-center justify-center w-7 h-7 rounded-lg text-sm" style="background:rgba(245,158,11,.15);">💳</span>
                Metode Pembayaran
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                {{-- Tunai --}}
                <label for="pay_tunai"
                       class="payment-label flex items-center gap-4 p-4 rounded-xl cursor-pointer transition-all border"
                       style="border-color:rgba(71,85,105,.4);background:rgba(11,19,36,.6);"
                       data-value="tunai">
                    <input type="radio" id="pay_tunai" name="payment_method" value="tunai"
                           class="sr-only" {{ old('payment_method','tunai')=='tunai'?'checked':'' }}
                           onchange="updatePaymentUI()">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl shrink-0"
                         style="background:rgba(16,185,129,.15);">💵</div>
                    <div>
                        <p class="text-sm font-bold text-white">Bayar Tunai</p>
                        <p class="text-xs mt-0.5" style="color:#94a3b8;">Bayar langsung saat ambil di kasir</p>
                    </div>
                    <div class="ml-auto w-5 h-5 rounded-full border-2 shrink-0 flex items-center justify-center pay-dot"
                         style="border-color:rgba(71,85,105,.6);">
                        <div class="w-2.5 h-2.5 rounded-full bg-amber-400 hidden pay-dot-inner"></div>
                    </div>
                </label>

                {{-- QRIS --}}
                <label for="pay_qris"
                       class="payment-label flex items-center gap-4 p-4 rounded-xl cursor-pointer transition-all border"
                       style="border-color:rgba(71,85,105,.4);background:rgba(11,19,36,.6);"
                       data-value="qris">
                    <input type="radio" id="pay_qris" name="payment_method" value="qris"
                           class="sr-only" {{ old('payment_method')=='qris'?'checked':'' }}
                           onchange="updatePaymentUI()">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl shrink-0"
                         style="background:rgba(99,102,241,.15);">📲</div>
                    <div>
                        <p class="text-sm font-bold text-white">QRIS / Cashless</p>
                        <p class="text-xs mt-0.5" style="color:#94a3b8;">Scan QR code di kasir kantin</p>
                    </div>
                    <div class="ml-auto w-5 h-5 rounded-full border-2 shrink-0 flex items-center justify-center pay-dot"
                         style="border-color:rgba(71,85,105,.6);">
                        <div class="w-2.5 h-2.5 rounded-full bg-amber-400 hidden pay-dot-inner"></div>
                    </div>
                </label>
            </div>
            @error('payment_method')<p class="text-xs mt-2 text-red-400">{{ $message }}</p>@enderror
        </div>

        {{-- ── BAGIAN 3: PILIHAN MENU PER STAND ──────────────── --}}
        <div class="rounded-2xl p-6 shadow-lg" style="background:#131d31;border:1px solid rgba(148,163,184,.1);">
            <h3 class="font-bold text-base mb-4 flex items-center gap-2" style="color:#fbbf24;">
                <span class="flex items-center justify-center w-7 h-7 rounded-lg text-sm" style="background:rgba(245,158,11,.15);">🏪</span>
                Pilihan Menu
            </h3>

            {{-- Tab Stand --}}
            <div class="flex flex-wrap gap-2 mb-5" id="standTabs" role="tablist">
                <button type="button"
                        class="tab-btn active px-4 py-2 rounded-xl text-xs font-bold border transition-all"
                        style="border-color:rgba(71,85,105,.4);color:#94a3b8;"
                        onclick="switchTab(this, 'all')" role="tab" aria-selected="true">
                    🍽️ Semua Stand
                </button>
                @foreach($stands as $stand)
                    @php
                        $emoji = match(true) {
                            str_contains($stand, 'Makanan') => '🍔',
                            str_contains($stand, 'Minuman') => '🥤',
                            str_contains($stand, 'Snack')   => '🍿',
                            default                         => '🏪',
                        };
                    @endphp
                    <button type="button"
                            class="tab-btn px-4 py-2 rounded-xl text-xs font-bold border transition-all"
                            style="border-color:rgba(71,85,105,.4);color:#94a3b8;"
                            onclick="switchTab(this, '{{ Str::slug($stand) }}')"
                            role="tab">
                        {{ $emoji }} {{ $stand }}
                    </button>
                @endforeach
            </div>

            {{-- Grid Menu --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" id="menuGrid">
                @foreach($menusByStand as $standName => $items)
                    @foreach($items as $item)
                        @php $orderable = $item->isOrderable(); @endphp
                        <div class="menu-card rounded-2xl p-4 flex items-center justify-between gap-4 transition-all duration-200"
                             data-stand="{{ Str::slug($standName) }}"
                             style="background:rgba(11,19,36,.7);border:1px solid rgba(148,163,184,.1);">

                            {{-- Info Menu --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap mb-1">
                                    <h4 class="font-bold text-white text-sm leading-snug">{{ $item->name }}</h4>
                                    {{-- Badge stok --}}
                                    @if($item->stockLabel())
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full border {{ $item->stockColor() }}">
                                            {{ $item->stockLabel() }}
                                        </span>
                                    @endif
                                </div>
                                <p class="font-bold text-xs" style="color:#fbbf24;">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </p>
                                <p class="text-[10px] mt-0.5" style="color:#475569;">{{ $standName }}</p>
                            </div>

                            {{-- Kontrol Qty / Habis --}}
                            <div class="flex items-center gap-2 shrink-0">
                                @if($orderable)
                                    <button type="button"
                                            onclick="changeQty(this, -1)"
                                            class="qty-btn w-8 h-8 rounded-lg font-bold text-lg flex items-center justify-center transition-all duration-150 focus:outline-none"
                                            style="background:rgba(71,85,105,.4);color:#94a3b8;"
                                            aria-label="Kurangi">−</button>
                                    <input type="number"
                                           name="items[{{ $item->id }}]"
                                           min="0"
                                           max="{{ $item->stock ?? 99 }}"
                                           value="{{ old('items.'.$item->id, 0) }}"
                                           class="w-12 text-center rounded-lg py-1.5 text-sm font-bold text-white focus:outline-none qty-input"
                                           style="background:#0b1324;border:1px solid rgba(71,85,105,.6);"
                                           onfocus="this.style.borderColor='#f59e0b'"
                                           onblur="this.style.borderColor='rgba(71,85,105,.6)'"
                                           onchange="syncCard(this); updateTotal()"
                                           data-price="{{ $item->price }}"
                                           data-name="{{ $item->name }}"
                                           aria-label="Jumlah {{ $item->name }}">
                                    <button type="button"
                                            onclick="changeQty(this, 1)"
                                            class="qty-btn w-8 h-8 rounded-lg font-bold text-lg flex items-center justify-center transition-all duration-150 focus:outline-none"
                                            style="background:rgba(245,158,11,.2);color:#fbbf24;"
                                            aria-label="Tambah">+</button>
                                @else
                                    <span class="px-4 py-2 rounded-xl text-xs font-bold"
                                          style="background:rgba(239,68,68,.15);color:#f87171;border:1px solid rgba(239,68,68,.3);">
                                        Habis
                                    </span>
                                    <input type="hidden" name="items[{{ $item->id }}]" value="0">
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

        {{-- ── RINGKASAN & TOMBOL SUBMIT ──────────────────────── --}}
        <div class="rounded-2xl p-5 space-y-4" style="background:#131d31;border:1px solid rgba(148,163,184,.1);">
            {{-- Ringkasan item dipilih --}}
            <div id="orderSummary" class="space-y-1.5 hidden">
                <p class="text-xs font-bold uppercase tracking-wider mb-2" style="color:#64748b;">Ringkasan Pesanan</p>
                {{-- diisi JS --}}
            </div>
            <div class="flex items-center justify-between pt-2 border-t" style="border-color:rgba(71,85,105,.3);">
                <span class="text-sm font-semibold" style="color:#94a3b8;">Total Pesanan</span>
                <span id="totalDisplay" class="text-2xl font-extrabold" style="color:#fbbf24;">Rp 0</span>
            </div>
            <button type="submit" id="submitBtn"
                    class="w-full py-3.5 rounded-xl font-bold text-sm sm:text-base transition-all duration-200 shadow-lg flex items-center justify-center gap-2 focus:outline-none"
                    style="background:#d97706;color:#fff;"
                    onmouseover="this.style.backgroundColor='#b45309'"
                    onmouseout="this.style.backgroundColor='#d97706'">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Kirim Pesanan Sekarang
            </button>
        </div>

    </form>

    {{-- ════════════════════════════════════════════════════
         FOOTER
    ════════════════════════════════════════════════════ --}}
    <footer class="text-center text-xs pb-4" style="color:#475569;">
        &copy; {{ date('Y') }} E-Kantin SMKN 1 Ciomas &mdash; Sistem Pre-Order Kantin Sekolah
    </footer>

</div>{{-- /max-w-5xl --}}

{{-- ════════════════════════════════════════════════════
     MODAL STRUK DIGITAL
     Ditampilkan jika ada ?order_id di URL (redirect dari store)
════════════════════════════════════════════════════ --}}
@if(session('new_order'))
    @php $no = session('new_order'); @endphp
    <div id="strutModal"
         class="fixed inset-0 z-50 flex items-center justify-center p-4"
         style="background:rgba(0,0,0,.7);"
         onclick="closeModal(event)">

        <div id="strutCard"
             class="relative w-full max-w-sm rounded-3xl p-6 shadow-2xl"
             style="background:#131d31;border:1px solid rgba(245,158,11,.25);">

            {{-- Tombol tutup --}}
            <button onclick="document.getElementById('strutModal').remove()"
                    class="absolute top-4 right-4 w-7 h-7 rounded-lg flex items-center justify-center text-sm transition"
                    style="background:rgba(71,85,105,.4);color:#94a3b8;"
                    aria-label="Tutup"
                    onmouseover="this.style.backgroundColor='rgba(71,85,105,.8)'"
                    onmouseout="this.style.backgroundColor='rgba(71,85,105,.4)'">✕</button>

            {{-- Header --}}
            <div class="text-center mb-5">
                <div class="text-5xl mb-2">🎉</div>
                <h2 class="text-lg font-extrabold text-white">Pesanan Masuk!</h2>
                <p class="text-xs mt-1" style="color:#94a3b8;">Tunjukkan struk ini ke kasir saat mengambil</p>
            </div>

            {{-- Kode Antrean --}}
            <div class="rounded-2xl p-4 text-center mb-4"
                 style="background:linear-gradient(135deg,rgba(217,119,6,.2),rgba(202,138,4,.1));border:1px solid rgba(245,158,11,.3);">
                <p class="text-xs font-bold uppercase tracking-widest mb-1" style="color:#fbbf24;">Kode Antrean Anda</p>
                <p class="text-4xl font-extrabold text-white tracking-wider">#{{ $no['queue_code'] }}</p>
                <p class="text-xs mt-1" style="color:#94a3b8;">Simpan kode ini baik-baik</p>
            </div>

            {{-- Detail Pesanan --}}
            <div class="rounded-xl p-4 space-y-2 mb-4 text-sm"
                 style="background:rgba(11,19,36,.6);border:1px solid rgba(71,85,105,.3);">
                <div class="flex justify-between">
                    <span style="color:#94a3b8;">Pemesan</span>
                    <span class="font-semibold text-white">{{ $no['student_name'] }}</span>
                </div>
                <div class="flex justify-between">
                    <span style="color:#94a3b8;">Kelas</span>
                    <span class="font-semibold text-white">{{ $no['class_major'] }}</span>
                </div>
                <div class="flex justify-between">
                    <span style="color:#94a3b8;">Pengambilan</span>
                    <span class="font-semibold" style="color:#fbbf24;">{{ $no['break_time'] }}</span>
                </div>
                <div class="flex justify-between">
                    <span style="color:#94a3b8;">Estimasi</span>
                    <span class="font-semibold" style="color:#34d399;">{{ $no['estimasi'] }}</span>
                </div>
                <div class="flex justify-between">
                    <span style="color:#94a3b8;">Pembayaran</span>
                    <span class="font-semibold text-white">{{ $no['payment_label'] }}</span>
                </div>

                <div class="border-t pt-2 mt-2" style="border-color:rgba(71,85,105,.3);">
                    <p class="text-xs font-bold mb-2" style="color:#64748b;">Menu Dipesan:</p>
                    @foreach($no['items'] as $item)
                        <div class="flex justify-between text-xs">
                            <span style="color:#cbd5e1;">{{ $item['name'] }} ×{{ $item['qty'] }}</span>
                            <span class="font-semibold text-white">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between font-extrabold text-base pt-2 border-t" style="border-color:rgba(71,85,105,.3);">
                    <span class="text-white">Total</span>
                    <span style="color:#fbbf24;">Rp {{ number_format($no['total_price'], 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- CTA --}}
            <button onclick="document.getElementById('strutModal').remove()"
                    class="w-full py-3 rounded-xl font-bold text-sm text-white transition"
                    style="background:#d97706;"
                    onmouseover="this.style.backgroundColor='#b45309'"
                    onmouseout="this.style.backgroundColor='#d97706'">
                Oke, Saya Mengerti! 👍
            </button>
        </div>
    </div>
@endif

{{-- ════════════════════════════════════════════════════
     JAVASCRIPT
════════════════════════════════════════════════════ --}}
<script>
// ── Harga menu dari server ──────────────────────────────────────
const menuPrices = {
    @foreach($menus as $m)
        {{ $m->id }}: { price: {{ $m->price }}, name: @json($m->name) },
    @endforeach
};

// ── Tab Stand ──────────────────────────────────────────────────
function switchTab(btn, standSlug) {
    // Reset semua tombol
    document.querySelectorAll('#standTabs .tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    // Tampilkan/sembunyikan card
    document.querySelectorAll('#menuGrid .menu-card').forEach(card => {
        if (standSlug === 'all' || card.dataset.stand === standSlug) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}

// ── Qty +/- ────────────────────────────────────────────────────
function changeQty(btn, delta) {
    const wrap  = btn.parentElement;
    const input = wrap.querySelector('.qty-input');
    const max   = parseInt(input.max) || 99;
    let val = Math.max(0, Math.min(max, (parseInt(input.value) || 0) + delta));
    input.value = val;
    syncCard(input);
    updateTotal();
}

// Highlight card jika dipilih
function syncCard(input) {
    const card = input.closest('.menu-card');
    if (! card) return;
    if (parseInt(input.value) > 0) {
        card.style.borderColor = 'rgba(245,158,11,.5)';
        card.style.background  = 'rgba(245,158,11,.06)';
    } else {
        card.style.borderColor = 'rgba(148,163,184,.1)';
        card.style.background  = 'rgba(11,19,36,.7)';
    }
    updateTotal();
}

// ── Hitung total & ringkasan ───────────────────────────────────
function updateTotal() {
    let total   = 0;
    const lines = [];

    document.querySelectorAll('.qty-input').forEach(input => {
        const match = (input.getAttribute('name') || '').match(/items\[(\d+)\]/);
        if (! match) return;
        const id  = parseInt(match[1]);
        const qty = parseInt(input.value) || 0;
        if (qty <= 0) return;
        const info = menuPrices[id];
        if (! info) return;
        const sub = info.price * qty;
        total += sub;
        lines.push({ name: info.name, qty, sub });
    });

    document.getElementById('totalDisplay').textContent =
        'Rp ' + total.toLocaleString('id-ID');

    const summaryEl = document.getElementById('orderSummary');
    if (lines.length === 0) {
        summaryEl.classList.add('hidden');
        summaryEl.innerHTML = '';
        return;
    }
    summaryEl.classList.remove('hidden');
    const header = '<p class="text-xs font-bold uppercase tracking-wider mb-2" style="color:#64748b;">Ringkasan Pesanan</p>';
    const items  = lines.map(l =>
        `<div class="flex justify-between text-xs">
            <span style="color:#cbd5e1;">${l.name} ×${l.qty}</span>
            <span class="font-semibold text-white">Rp ${l.sub.toLocaleString('id-ID')}</span>
         </div>`
    ).join('');
    summaryEl.innerHTML = header + items;
}

// ── UI Metode Pembayaran ───────────────────────────────────────
function updatePaymentUI() {
    document.querySelectorAll('.payment-label').forEach(label => {
        const radio    = label.querySelector('input[type=radio]');
        const dot      = label.querySelector('.pay-dot');
        const dotInner = label.querySelector('.pay-dot-inner');
        if (radio.checked) {
            label.style.borderColor = '#f59e0b';
            label.style.background  = 'rgba(245,158,11,.08)';
            dot.style.borderColor   = '#f59e0b';
            dotInner.classList.remove('hidden');
        } else {
            label.style.borderColor = 'rgba(71,85,105,.4)';
            label.style.background  = 'rgba(11,19,36,.6)';
            dot.style.borderColor   = 'rgba(71,85,105,.6)';
            dotInner.classList.add('hidden');
        }
    });
}

// ── Tutup modal klik di luar ──────────────────────────────────
function closeModal(e) {
    if (e.target.id === 'strutModal') e.currentTarget.remove();
}

// ── Init ──────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    updatePaymentUI();
    updateTotal();
    // Set default tunai checked
    const tunai = document.getElementById('pay_tunai');
    if (tunai && !document.querySelector('input[name=payment_method]:checked')) {
        tunai.checked = true;
        updatePaymentUI();
    }
});
</script>

</body>
</html>
