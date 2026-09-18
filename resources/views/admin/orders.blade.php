<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Admin E-Kantin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-[#f4f5fa] text-slate-800 min-h-screen flex">

    {{-- SIDEBAR --}}
    @include('admin.partials.sidebar', ['active' => 'orders'])

    {{-- KONTEN UTAMA --}}
    <main class="flex-1 p-8 overflow-y-auto">

        {{-- TOP BAR --}}
        <header class="flex justify-between items-center mb-8 pb-4 border-b border-slate-200">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Riwayat Pesanan</h1>
                <p class="text-xs text-slate-400 font-medium mt-1">Semua pesanan masuk dari siswa</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <h3 class="text-sm font-bold text-slate-900">Kasir Kantin</h3>
                    <span class="text-[10px] text-slate-400 font-medium">Administrator</span>
                </div>
                <div class="w-10 h-10 rounded-full bg-amber-500 text-white font-extrabold flex items-center justify-center text-sm shadow-md">K</div>
            </div>
        </header>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-semibold flex items-center gap-2">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- KARTU STATUS --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-500 flex items-center justify-center text-lg">🕒</div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pending</p>
                    <p class="text-2xl font-extrabold text-slate-800">{{ $pending }}</p>
                </div>
            </div>
            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-500 flex items-center justify-center text-lg">⚙️</div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Diproses</p>
                    <p class="text-2xl font-extrabold text-slate-800">{{ $processing }}</p>
                </div>
            </div>
            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-500 flex items-center justify-center text-lg">✅</div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Siap Ambil</p>
                    <p class="text-2xl font-extrabold text-slate-800">{{ $ready }}</p>
                </div>
            </div>
            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-500 flex items-center justify-center text-lg">🏁</div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Selesai</p>
                    <p class="text-2xl font-extrabold text-slate-800">{{ $completed }}</p>
                </div>
            </div>
        </div>

        {{-- FILTER STATUS --}}
        <div class="flex flex-wrap gap-2 mb-4">
            <button onclick="filterStatus('all')" id="btn-all"
                class="filter-btn px-4 py-1.5 rounded-full text-xs font-bold transition border border-amber-500 bg-amber-500 text-white">
                Semua ({{ $orders->count() }})
            </button>
            <button onclick="filterStatus('pending')" id="btn-pending"
                class="filter-btn px-4 py-1.5 rounded-full text-xs font-bold transition border border-slate-200 text-slate-500 bg-white hover:border-amber-400">
                🕒 Pending ({{ $pending }})
            </button>
            <button onclick="filterStatus('processing')" id="btn-processing"
                class="filter-btn px-4 py-1.5 rounded-full text-xs font-bold transition border border-slate-200 text-slate-500 bg-white hover:border-blue-400">
                ⚙️ Diproses ({{ $processing }})
            </button>
            <button onclick="filterStatus('ready')" id="btn-ready"
                class="filter-btn px-4 py-1.5 rounded-full text-xs font-bold transition border border-slate-200 text-slate-500 bg-white hover:border-emerald-400">
                ✅ Siap Ambil ({{ $ready }})
            </button>
            <button onclick="filterStatus('completed')" id="btn-completed"
                class="filter-btn px-4 py-1.5 rounded-full text-xs font-bold transition border border-slate-200 text-slate-500 bg-white hover:border-slate-400">
                🏁 Selesai ({{ $completed }})
            </button>
        </div>

        {{-- TABEL PESANAN --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] tracking-wider border-b border-slate-100">
                        <tr>
                            <th class="p-4">ID</th>
                            <th class="p-4">Siswa</th>
                            <th class="p-4">Menu Dipesan</th>
                            <th class="p-4">Istirahat</th>
                            <th class="p-4">Total</th>
                            <th class="p-4">Waktu</th>
                            <th class="p-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50" id="ordersTableBody">
                        @forelse($orders as $order)
                            <tr class="hover:bg-slate-50/70 transition order-row" data-status="{{ $order->status }}">
                                <td class="p-4 font-bold text-amber-500">#{{ $order->id }}</td>
                                <td class="p-4">
                                    <div class="font-bold text-slate-800">{{ $order->student_name }}</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">{{ $order->class_major }}</div>
                                    <div class="text-[10px] text-slate-400">WA: {{ $order->whatsapp }}</div>
                                </td>
                                <td class="p-4">
                                    <ul class="space-y-0.5">
                                        @foreach($order->items as $item)
                                            <li class="text-[11px] text-slate-600">
                                                • {{ $item->menu->name ?? 'Menu Dihapus' }}
                                                <span class="font-extrabold text-amber-500">(×{{ $item->quantity }})</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="p-4 font-semibold text-slate-600 whitespace-nowrap">{{ $order->break_time }}</td>
                                <td class="p-4 font-extrabold text-slate-800 whitespace-nowrap">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td class="p-4 text-slate-400 whitespace-nowrap text-[10px]">
                                    {{ $order->created_at->format('d/m/Y') }}<br>
                                    <span class="font-semibold">{{ $order->created_at->format('H:i') }}</span>
                                </td>
                                <td class="p-4">
                                    <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                                class="bg-slate-50 border border-slate-200 text-[10px] font-bold rounded-lg px-2.5 py-1.5 focus:outline-none focus:border-amber-500 cursor-pointer text-slate-600">
                                            <option value="pending"    {{ $order->status == 'pending'    ? 'selected' : '' }}>🕒 Pending</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>⚙️ Proses</option>
                                            <option value="ready"      {{ $order->status == 'ready'      ? 'selected' : '' }}>✅ Ready</option>
                                            <option value="completed"  {{ $order->status == 'completed'  ? 'selected' : '' }}>🏁 Selesai</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-10 text-center text-slate-400">
                                    <div class="text-4xl mb-2">📭</div>
                                    Belum ada pesanan masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <script>
        function filterStatus(status) {
            // Update tombol aktif
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('bg-amber-500', 'text-white', 'border-amber-500');
                btn.classList.add('bg-white', 'text-slate-500', 'border-slate-200');
            });
            const activeBtn = document.getElementById('btn-' + status);
            if (activeBtn) {
                activeBtn.classList.add('bg-amber-500', 'text-white', 'border-amber-500');
                activeBtn.classList.remove('bg-white', 'text-slate-500', 'border-slate-200');
            }
            // Filter baris tabel
            document.querySelectorAll('.order-row').forEach(row => {
                if (status === 'all' || row.dataset.status === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
