{{-- Sidebar Admin Panel --}}
{{-- Variabel $active: 'dashboard' | 'menu' | 'orders' | 'laporan' --}}

<div id="sidebarBackdrop"
     class="fixed inset-0 z-40 hidden lg:hidden"
     style="background:rgba(0,0,0,.6);backdrop-filter:blur(4px);"
     onclick="toggleAdminSidebar()" aria-hidden="true"></div>

<aside id="adminSidebar"
       class="fixed inset-y-0 left-0 z-50 w-60 flex flex-col h-screen transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0 lg:sticky lg:top-0 lg:z-30 shrink-0"
       style="background:#0d1628;border-right:1px solid rgba(148,163,184,.08);">

    {{-- Logo --}}
    <div class="flex items-center justify-between px-5 py-4 shrink-0"
         style="border-bottom:1px solid rgba(148,163,184,.08);">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0"
                 style="background:rgba(245,158,11,.15);border:1px solid rgba(245,158,11,.25);">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 10a9 9 0 0118 0M3 10v1a9 9 0 0018 0v-1M6 21h12M6 21a2 2 0 01-2-2v-9h16v9a2 2 0 01-2 2H6z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-bold text-white leading-tight">Admin Panel</p>
                <p class="text-[10px] leading-tight" style="color:#f59e0b;">SMKN 1 Ciomas</p>
            </div>
        </div>
        <button type="button" onclick="toggleAdminSidebar()"
                class="lg:hidden w-8 h-8 rounded-lg flex items-center justify-center transition"
                style="background:rgba(148,163,184,.1);color:#94a3b8;"
                onmouseover="this.style.background='rgba(148,163,184,.2)'"
                onmouseout="this.style.background='rgba(148,163,184,.1)'"
                aria-label="Tutup">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 overflow-y-auto px-3 py-5 space-y-0.5">

        <p class="text-[10px] font-bold uppercase tracking-widest px-3 mb-2" style="color:#475569;">Overview</p>

        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition group"
           style="{{ ($active??'')==='dashboard' ? 'background:rgba(245,158,11,.12);color:#fbbf24;border:1px solid rgba(245,158,11,.15);' : 'color:#94a3b8;border:1px solid transparent;' }}"
           onmouseover="if('{{ ($active??'') }}'!=='dashboard'){this.style.background='rgba(148,163,184,.06)';this.style.color='#e2e8f0';}"
           onmouseout="if('{{ ($active??'') }}'!=='dashboard'){this.style.background='';this.style.color='#94a3b8';}">
            <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"
                 style="color:{{ ($active??'')==='dashboard' ? '#fbbf24' : '#64748b' }}">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5V19a1 1 0 001 1h4a1 1 0 001-1v-5.5M9 8V19a1 1 0 001 1h4a1 1 0 001-1V8M15 4v15a1 1 0 001 1h4a1 1 0 001-1V4"/>
            </svg>
            Dashboard
        </a>

        <p class="text-[10px] font-bold uppercase tracking-widest px-3 mt-5 mb-2" style="color:#475569;">Manajemen</p>

        <a href="{{ route('admin.menu') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition"
           style="{{ ($active??'')==='menu' ? 'background:rgba(245,158,11,.12);color:#fbbf24;border:1px solid rgba(245,158,11,.15);' : 'color:#94a3b8;border:1px solid transparent;' }}"
           onmouseover="if('{{ ($active??'') }}'!=='menu'){this.style.background='rgba(148,163,184,.06)';this.style.color='#e2e8f0';}"
           onmouseout="if('{{ ($active??'') }}'!=='menu'){this.style.background='';this.style.color='#94a3b8';}">
            <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"
                 style="color:{{ ($active??'')==='menu' ? '#fbbf24' : '#64748b' }}">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
            </svg>
            Data Menu
        </a>

        <a href="{{ route('admin.orders') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition"
           style="{{ ($active??'')==='orders' ? 'background:rgba(245,158,11,.12);color:#fbbf24;border:1px solid rgba(245,158,11,.15);' : 'color:#94a3b8;border:1px solid transparent;' }}"
           onmouseover="if('{{ ($active??'') }}'!=='orders'){this.style.background='rgba(148,163,184,.06)';this.style.color='#e2e8f0';}"
           onmouseout="if('{{ ($active??'') }}'!=='orders'){this.style.background='';this.style.color='#94a3b8';}">
            <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"
                 style="color:{{ ($active??'')==='orders' ? '#fbbf24' : '#64748b' }}">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Riwayat Pesanan
        </a>

        <a href="{{ route('admin.laporan') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition"
           style="{{ ($active??'')==='laporan' ? 'background:rgba(245,158,11,.12);color:#fbbf24;border:1px solid rgba(245,158,11,.15);' : 'color:#94a3b8;border:1px solid transparent;' }}"
           onmouseover="if('{{ ($active??'') }}'!=='laporan'){this.style.background='rgba(148,163,184,.06)';this.style.color='#e2e8f0';}"
           onmouseout="if('{{ ($active??'') }}'!=='laporan'){this.style.background='';this.style.color='#94a3b8';}">
            <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"
                 style="color:{{ ($active??'')==='laporan' ? '#fbbf24' : '#64748b' }}">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
            </svg>
            Laporan Keuangan
        </a>

        <p class="text-[10px] font-bold uppercase tracking-widest px-3 mt-5 mb-2" style="color:#475569;">System</p>

        <a href="{{ route('home') }}" target="_blank"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition"
           style="color:#94a3b8;border:1px solid transparent;"
           onmouseover="this.style.background='rgba(148,163,184,.06)';this.style.color='#e2e8f0';"
           onmouseout="this.style.background='';this.style.color='#94a3b8';">
            <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" style="color:#64748b;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
            Lihat Website
        </a>

    </nav>

    <div class="px-5 py-4 shrink-0" style="border-top:1px solid rgba(148,163,184,.08);">
        <p class="text-[10px] text-center" style="color:#475569;">E-Kantin &copy; {{ date('Y') }} SMKN 1 Ciomas</p>
    </div>
</aside>

<script>
    function toggleAdminSidebar() {
        const sidebar  = document.getElementById('adminSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        if (!sidebar || !backdrop) return;
        const closed = sidebar.classList.contains('-translate-x-full');
        sidebar.classList.toggle('-translate-x-full', !closed);
        sidebar.classList.toggle('translate-x-0', closed);
        backdrop.classList.toggle('hidden', !closed);
        document.body.classList.toggle('overflow-hidden', closed);
    }
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            document.getElementById('sidebarBackdrop')?.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    });
</script>
