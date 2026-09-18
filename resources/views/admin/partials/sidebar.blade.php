{{-- Sidebar Admin Panel --}}
{{-- Dipakai di: dashboard, menu, orders, laporan --}}
{{-- Variabel $active: 'dashboard' | 'menu' | 'orders' | 'laporan' --}}

<aside class="w-64 bg-[#0e1428] text-slate-400 flex flex-col justify-between shrink-0 sticky top-0 h-screen border-r border-slate-800">
    <div>
        {{-- Header Sidebar --}}
        <div class="p-6 flex items-center gap-3 border-b border-slate-800/50">
            <div class="w-10 h-10 bg-amber-500/10 text-amber-500 rounded-xl flex items-center justify-center font-bold text-xl border border-amber-500/20">
                🍱
            </div>
            <div>
                <h2 class="font-extrabold text-white text-base leading-tight">Admin Panel</h2>
                <span class="text-[10px] text-amber-500 font-semibold tracking-wider uppercase">SMKN 1 Ciomas</span>
            </div>
        </div>

        {{-- Menu Navigasi --}}
        <div class="px-4 py-6">
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
        <div class="px-4 py-2 text-[10px] text-slate-600 text-center">
            E-Kantin &copy; {{ date('Y') }}
        </div>
    </div>
</aside>
