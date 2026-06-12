<!DOCTYPE html>
<html>
<head>
    <title>Detail Villa - {{ $villa->nama_villa }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'poppins', sans-serif;
        }
        body {
            background: #f5f7fa;
        }
    </style>
</head>
<body>


<div class="container mx-auto px-6 py-10 max-w-6xl">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        
        <!-- Header: Nama Villa & Lokasi -->
        <div class="p-6 border-b">
            <h1 class="text-2xl font-bold text-gray-800">{{ $villa->nama_villa }}</h1>
            <p class="text-gray-500 text-sm mt-1">{{ $villa->lokasi ?? 'Bali, Indonesia' }}</p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-0">
            
            <!-- KIRI: Gambar -->
            <div class="bg-gray-100">
                @if($villa->images && $villa->images->count() > 0)
                    <img src="/storage/{{ $villa->images->first()->image_path }}" 
                         class="w-full h-full object-cover min-h-[400px]">
                @else
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=800" 
                         class="w-full h-full object-cover min-h-[400px]">
                @endif
            </div>
            
            <!-- KANAN: Info Villa & Booking -->
            <div class="p-6">
                <!-- READY TO BOOK Badge -->
                <div class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold mb-4">
                    ✓ READY TO BOOK
                </div>
                
                <!-- Kapasitas & Kamar -->
                <div class="flex items-center gap-6 mb-6">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <div>
                            <p class="text-gray-400 text-xs">KAPASITAS</p>
                            <p class="font-semibold text-gray-800">{{ $villa->kapasitas }} orang</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                        </svg>
                        <div>
                            <p class="text-gray-400 text-xs">KAMAR TIDUR</p>
                            <p class="font-semibold text-gray-800">{{ $villa->jumlah_kamar }} Kamar</p>
                        </div>
                    </div>
                </div>
                
                <!-- Status -->
                <div class="mb-6">
                    <span class="inline-flex items-center gap-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        <span class="text-green-600 text-sm font-medium">Tersedia</span>
                    </span>
                </div>
                
                <!-- Harga -->
                <div class="mb-6">
                    <span class="text-3xl font-bold text-gray-800">Rp {{ number_format($villa->harga_per_malam, 0, ',', '.') }}</span>
                    <span class="text-gray-500">/ night</span>
                </div>
                
                <!-- Date Picker Check-in & Check-out -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">Check-In</label>
                        <input type="date" id="checkin" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">Check-Out</label>
                        <input type="date" id="checkout" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                    </div>
                </div>
                
                <!-- Tombol Pesan Sekarang -->
                <button onclick="pesanSekarang()" class="w-full bg-[#16614D] text-white py-3 rounded-lg font-semibold hover:bg-[#0f4a3a] transition mb-4">
                    Pesan Sekarang
                </button>
                
                <!-- Total Harga -->
                <div class="text-center mb-4">
                    <p class="text-gray-500 text-sm">Total : <span id="totalHarga" class="font-bold text-gray-800">Rp ---</span></p>
                    <p class="text-gray-400 text-xs mt-1">Kamu tidak dikenakan biaya sebelum konfirmasi</p>
                </div>
            </div>
        </div>
        
        <!-- FASILITAS SECTION -->
        <div class="p-6 border-t bg-gray-50">
            <h3 class="font-bold text-gray-800 mb-4">Nikmati berbagai fasilitas nyaman yang dirancang untuk membuat pengalaman menginap Anda lebih menyenangkan dan santai.</h3>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                @php
                    $fasilitas = $villa->fasilitas ? explode(',', $villa->fasilitas) : [];
                    $defaultFasilitas = ['Kolam renang pribadi', 'Dapur lengkap', 'Smart TV & Netflix', 'Wi-Fi kecepatan tinggi', 'Water heater', 'Sarapan gratis', 'Area BBQ', 'Ruang keluarga nyaman', 'Parkir luas', 'Pemandangan laut langsung'];
                    $fasilitasList = count($fasilitas) > 0 ? $fasilitas : $defaultFasilitas;
                @endphp
                @foreach($fasilitasList as $item)
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-gray-600 text-sm">{{ trim($item) }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    const hargaPerMalam = {{ $villa->harga_per_malam }};
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    const totalHargaSpan = document.getElementById('totalHarga');
    
    function hitungTotal() {
        const checkin = new Date(checkinInput.value);
        const checkout = new Date(checkoutInput.value);
        
        if (checkinInput.value && checkoutInput.value && checkout > checkin) {
            const diffTime = Math.abs(checkout - checkin);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            const total = diffDays * hargaPerMalam;
            totalHargaSpan.innerHTML = `Rp ${total.toLocaleString('id-ID')}`;
        } else {
            totalHargaSpan.innerHTML = `Rp ---`;
        }
    }
    
    function pesanSekarang() {
        const checkin = checkinInput.value;
        const checkout = checkoutInput.value;
        
        if (!checkin || !checkout) {
            alert('Silakan pilih tanggal check-in dan check-out terlebih dahulu');
            return;
        }
        
        alert(`Pemesanan villa ${@json($villa->nama_villa)} dari ${checkin} sampai ${checkout} akan diproses.`);
    }
    
    checkinInput.addEventListener('change', hitungTotal);
    checkoutInput.addEventListener('change', hitungTotal);
</script>

@include('layouts.footer')

</body>
</html>