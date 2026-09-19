{{-- Sidebar Admin Panel --}}
{{-- Dipakai di: dashboard, menu, orders, laporan --}}
{{-- Variabel $active: 'dashboard' | 'menu' | 'orders' | 'laporan' --}}

{{-- Backdrop Overlay untuk Mobile --}}
<div id="sidebarBackdrop"
     class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm z-40 hidden transition-opacity duration-300 lg:hidden"
     onclick="toggleAdminSidebar()"
     aria-hidden="true">
</div>

{{-- Sidebar Drawer --}}
<aside id="adminSidebar"
       class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0e1428] text-slate-400 flex flex-col justify-between shrink-0 h-screen border-r border-slate-800 transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0 lg:sticky lg:top-0 lg:z-30">
    <div>
        {{-- Header Sidebar --}}
        <div class="p-5 sm:p-6 flex items-center justify-between border-b border-slate-800/50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-amber-500/10 text-amber-500 rounded-xl flex items-center justify-center font-bold text-xl border border-amber-500/20 shrink-0">
                    🍱
                </div>
                <div>
                    <h2 class="font-extrabold text-white text-base leading-tight">Admin Panel</h2>
                    <span class="text-[10px] text-amber-500 font-semibold tracking-wider uppercase">SMKN 1 Ciomas</span>
                </div>
            </div>
            {{-- Tombol Close di Mobile --}}
            <button type="button"
                    onclick="toggleAdminSidebar()"
                    class="lg:hidden w-8 h-8 rounded-lg bg-slate-800/80 hover:bg-slate-700 text-slate-400 hover:text-white flex items-center justify-center text-sm transition"
                    aria-label="Tutup Menu">
                ✕
            </button>
        </div>

        {{-- Menu Navigasi --}}
        <div class="px-4 py-5 sm:py-6 overflow-y-auto max-h-[calc(100vh-140px)]">
            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-3 block mb-3">Overview</span>
            <nav class="space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-xl transition
                          {{ ($active ?? '') === 'dashboard' ? 'text-amber-400 bg-amber-500/10 border border-amber-500/10' : 'hover:bg-slate-800/40 hover:text-white' }}">
                    <span>📊</span> Dashboard
                </a>
            </nav>

            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-3 block mt-6 mb-3">Manajemen</span>
            <nav class="space-y-1">
                <a href="{{ route('admin.menu') }}"
                   class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-xl transition
                          {{ ($active ?? '') === 'menu' ? 'text-amber-400 bg-amber-500/10 border border-amber-500/10' : 'hover:bg-slate-800/40 hover:text-white' }}">
                    <span>🍔</span> Data Menu
                </a>
                <a href="{{ route('admin.orders') }}"
                   class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-xl transition
                          {{ ($active ?? '') === 'orders' ? 'text-amber-400 bg-amber-500/10 border border-amber-500/10' : 'hover:bg-slate-800/40 hover:text-white' }}">
                    <span>📝</span> Riwayat Pesanan
                </a>
                <a href="{{ route('admin.laporan') }}"
                   class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-xl transition
                          {{ ($active ?? '') === 'laporan' ? 'text-amber-400 bg-amber-500/10 border border-amber-500/10' : 'hover:bg-slate-800/40 hover:text-white' }}">
                    <span>📈</span> Laporan Keuangan
                </a>
            </nav>

            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-3 block mt-6 mb-3">System</span>
            <nav class="space-y-1">
                <a href="{{ route('home') }}" target="_blank"
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-slate-800/40 hover:text-white rounded-xl transition">
                    <span>🌐</span> Lihat Website
                </a>
            </nav>
        </div>
    </div>

    {{-- Footer Sidebar --}}
    <div class="p-4 border-t border-slate-800/50">
        <div class="px-4 py-2 text-[10px] text-slate-500 text-center">
            E-Kantin &copy; {{ date('Y') }} SMKN 1 Ciomas
        </div>
    </div>
</aside>

{{-- Script Toggle Mobile Sidebar --}}
<script>
    function toggleAdminSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        if (!sidebar || !backdrop) return;

        const isClosed = sidebar.classList.contains('-translate-x-full');
        if (isClosed) {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            backdrop.classList.remove('hidden');
            document.body.classList.add('overflow-hidden', 'lg:overflow-auto');
        } else {
            sidebar.classList.add('-translate-x-full');
            sidebar.classList.remove('translate-x-0');
            backdrop.classList.add('hidden');
            document.body.classList.remove('overflow-hidden', 'lg:overflow-auto');
        }
    }

    // Auto close sidebar on resize to desktop
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            const backdrop = document.getElementById('sidebarBackdrop');
            if (backdrop && !backdrop.classList.contains('hidden')) {
                backdrop.classList.add('hidden');
                document.body.classList.remove('overflow-hidden', 'lg:overflow-auto');
            }
        }
    });
</script>
