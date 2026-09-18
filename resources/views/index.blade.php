<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Kantin SMKN 1 Ciomas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-slate-800 border-b border-slate-700 px-6 py-4 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-2xl">🍱</span>
                <h1 class="text-xl font-bold text-amber-500">E-Kantin <span class="text-white">SMKN 1 Ciomas</span></h1>
            </div>
            <span class="text-xs bg-amber-500/20 text-amber-400 px-3 py-1 rounded-full border border-amber-500/30">Pre-Order System</span>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-5xl mx-auto px-6 py-8">
        
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-amber-600 to-amber-700 rounded-2xl p-6 md:p-8 mb-8 text-white shadow-xl">
            <h2 class="text-2xl md:text-3xl font-extrabold mb-2">Pesan Duluan, Bebas Antre! 🚀</h2>
            <p class="text-amber-100 text-sm md:text-base">Pesan makanan & minuman favoritmu sebelum jam istirahat. Ambil di kantin tanpa perlu berdesakan.</p>
        </div>

        @if(session('error'))
            <div class="bg-red-500/20 border border-red-500 text-red-300 p-4 rounded-xl mb-6 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('order.store') }}" method="POST">
            @csrf

            <!-- Form Data Siswa -->
            <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 mb-8 shadow-lg">
                <h3 class="text-lg font-semibold text-amber-400 mb-4 border-b border-slate-700 pb-2">📋 Data Pemesan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-300 mb-1">Nama Lengkap</label>
                        <input type="text" name="student_name" required placeholder="Contoh: Revan Riswadi" 
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-300 mb-1">Kelas & Jurusan</label>
                        <input type="text" name="class_major" required placeholder="Contoh: X PPLG 1" 
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-300 mb-1">Nomor WhatsApp</label>
                        <input type="text" name="whatsapp" required placeholder="Contoh: 08123456789" 
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-300 mb-1">Jam Pengambilan</label>
                        <select name="break_time" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                            <option value="Istirahat 1">Istirahat 1</option>
                            <option value="Istirahat 2">Istirahat 2</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Makanan Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-amber-400 mb-4 flex items-center gap-2">🍔 Makanan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($makanan as $item)
                        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-4 flex justify-between items-center">
                            <div>
                                <h4 class="font-bold text-white">{{ $item->name }}</h4>
                                <p class="text-amber-400 font-semibold text-sm mt-1">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="w-24">
                                <input type="number" name="items[{{ $item->id }}]" min="0" value="0" 
                                    class="w-full bg-slate-900 border border-slate-700 rounded-xl py-2 text-center text-sm text-white focus:outline-none focus:border-amber-500">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Minuman Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-amber-400 mb-4 flex items-center gap-2">🥤 Minuman</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($minuman as $item)
                        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-4 flex justify-between items-center">
                            <div>
                                <h4 class="font-bold text-white">{{ $item->name }}</h4>
                                <p class="text-amber-400 font-semibold text-sm mt-1">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="w-24">
                                <input type="number" name="items[{{ $item->id }}]" min="0" value="0" 
                                    class="w-full bg-slate-900 border border-slate-700 rounded-xl py-2 text-center text-sm text-white focus:outline-none focus:border-amber-500">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold py-4 rounded-2xl transition duration-200 shadow-lg text-lg">
                Kirim Pesanan Sekarang 🛒
            </button>
        </form>

    </div>

</body>
</html>