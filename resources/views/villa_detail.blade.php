<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Villa - {{ $villa->nama_villa }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">

<!-- Navbar Sederhana -->
<nav class="bg-white shadow-sm border-b">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="/" class="text-2xl font-bold text-gray-800">🏡 Luxury Villa</a>
        <div class="flex gap-6">
            <a href="/" class="text-gray-600 hover:text-gray-900">Home</a>
            <a href="{{ route('booking.page') }}" class="text-gray-600 hover:text-gray-900">Booking</a>
            <a href="{{ route('about.page') }}" class="text-gray-600 hover:text-gray-900">About Us</a>
            @auth
                <a href="{{ route('reservasi.index') }}" class="text-gray-600 hover:text-gray-900">Reservasi Saya</a>
                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                </form>
            @else
                <a href="/login" class="text-gray-600 hover:text-gray-900">Login</a>
                <a href="/register" class="text-gray-600 hover:text-gray-900">Register</a>
            @endauth
        </div>
    </div>
</nav>

<!-- Detail Villa -->
<div class="container mx-auto px-6 py-10">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="grid md:grid-cols-2 gap-8 p-8">
            
            <!-- Kiri: Gambar & Info -->
            <div>
                <img src="https://picsum.photos/600/400?random={{ $villa->id }}" alt="{{ $villa->nama_villa }}" class="w-full h-80 object-cover rounded-xl">
                
                <!-- Info singkat -->
                <div class="grid grid-cols-3 gap-4 mt-6 text-center">
                    <div class="bg-gray-100 p-3 rounded-xl">
                        <div class="text-2xl">👥</div>
                        <div class="font-semibold">{{ $villa->kapasitas }} orang</div>
                        <div class="text-xs text-gray-500">kapasitas</div>
                    </div>
                    <div class="bg-gray-100 p-3 rounded-xl">
                        <div class="text-2xl">🛏️</div>
                        <div class="font-semibold">{{ $villa->jumlah_kamar }} Kamar</div>
                        <div class="text-xs text-gray-500">tidur</div>
                    </div>
                    <div class="bg-gray-100 p-3 rounded-xl">
                        <div class="text-2xl">✅</div>
                        <div class="font-semibold text-green-600">{{ $villa->status == 'tersedia' ? 'Tersedia' : 'Tidak Tersedia' }}</div>
                        <div class="text-xs text-gray-500">status</div>
                    </div>
                </div>
                
                <!-- Deskripsi / Fasilitas -->
                <div class="mt-6">
                    <h3 class="font-bold text-lg mb-3">Nikmati berbagi fasilitas nyaman yang dirancang untuk membuat pengalaman menginap Anda lebih menyenangkan dan santai.</h3>
                    <div class="grid grid-cols-2 gap-2 mt-4">
                        @php
                            $fasilitasList = $villa->fasilitas ? explode(',', $villa->fasilitas) : ['Kolam renang pribadi', 'Dapur lengkap', 'Smart TV & Netflix', 'Wi-Fi kecepatan tinggi', 'Water heater', 'Area BBQ', 'Ruang keluarga nyaman', 'Parkir luas', 'Pemandangan indah'];
                        @endphp
                        @foreach($fasilitasList as $item)
                            <div class="flex items-center gap-2 text-gray-700">
                                <span class="text-green-500">✓</span>
                                <span>{{ trim($item) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Kanan: Harga & Booking -->
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $villa->nama_villa }}</h1>
                <p class="text-gray-500 mt-2">{{ $villa->lokasi }}</p>
                
                <div class="mt-6">
                    <div class="text-3xl font-bold text-yellow-600">Rp {{ number_format($villa->harga_per_malam, 0, ',', '.') }}</div>
                    <div class="text-gray-500">/ night</div>
                </div>
                
                <!-- Form Booking -->
                @auth
                    <form action="{{ route('booking.store') }}" method="POST" class="mt-6 space-y-4">
                        @csrf
                        <input type="hidden" name="villa_id" value="{{ $villa->id }}">
                        
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Check-In</label>
                            <input type="date" name="checkin" id="checkin" required 
                                   class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                   min="{{ date('Y-m-d') }}">
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Check-Out</label>
                            <input type="date" name="checkout" id="checkout" required
                                   class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        </div>
                        
                        <div class="bg-gray-100 p-4 rounded-xl">
                            <div class="flex justify-between">
                                <span>Total harga</span>
                                <span class="font-bold text-xl" id="totalHarga">Rp 0</span>
                            </div>
                            <input type="hidden" name="total_harga" id="total_harga_input" value="0">
                            <p class="text-xs text-gray-500 mt-2">Kamu tidak dikenakan biaya sebelum konfirmasi</p>
                        </div>
                        
                        <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 rounded-xl transition">
                            Pesan Sekarang
                        </button>
                    </form>
                @else
                    <div class="mt-6 bg-gray-100 p-6 rounded-xl text-center">
                        <p class="text-gray-700 mb-3">Silakan login terlebih dahulu untuk melakukan booking</p>
                        <a href="/login" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg">Login</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>

<script>
    const hargaPerMalam = {{ $villa->harga_per_malam }};
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    const totalHargaSpan = document.getElementById('totalHarga');
    const totalHargaInput = document.getElementById('total_harga_input');
    
    function hitungTotal() {
        if (checkinInput.value && checkoutInput.value) {
            const checkin = new Date(checkinInput.value);
            const checkout = new Date(checkoutInput.value);
            const diffTime = Math.abs(checkout - checkin);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            if (diffDays > 0) {
                const total = diffDays * hargaPerMalam;
                totalHargaSpan.innerText = 'Rp ' + total.toLocaleString('id-ID');
                totalHargaInput.value = total;
            } else {
                totalHargaSpan.innerText = 'Rp 0';
                totalHargaInput.value = 0;
            }
        }
    }
    
    checkinInput.addEventListener('change', function() {
        checkoutInput.min = this.value;
        if (checkoutInput.value < this.value) {
            checkoutInput.value = '';
        }
        hitungTotal();
    });
    
    checkoutInput.addEventListener('change', hitungTotal);
</script>

</body>
</html>