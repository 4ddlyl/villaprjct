<!DOCTYPE html>
<html>
<head>
    <title>Detail Villa - {{ $villa->nama_villa }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        body {
            background: #f0f2f5;
        }
        .villa-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.05);
            transition: 0.2s;
        }
        .badge-ready {
            background: #e8f5e9;
            color: #2e7d32;
            font-size: 11px;
            padding: 5px 14px;
            border-radius: 20px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        .btn-book {
            background: #16614D;
            color: white;
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            transition: 0.2s;
            border: none;
            width: 100%;
            font-size: 15px;
            cursor: pointer;
        }
        .btn-book:hover {
            background: #0f4a3a;
        }
        .btn-book:disabled {
            background: #a0aec0;
            cursor: not-allowed;
            opacity: 0.6;
        }
        .btn-book:disabled:hover {
            background: #a0aec0;
        }
        .input-field {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 11px 16px;
            width: 100%;
            font-size: 14px;
            background: #fafafa;
            transition: 0.2s;
            color: #1a1a2e;
        }
        .input-field:focus {
            outline: none;
            border-color: #16614D;
            box-shadow: 0 0 0 3px rgba(22,97,77,0.08);
            background: white;
        }
        .input-field:disabled {
            background: #f5f5f5;
            cursor: not-allowed;
            opacity: 0.7;
        }
        .input-field::placeholder {
            color: #aaa;
        }
        .fasilitas-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 0;
            font-size: 14px;
            color: #374151;
        }
        .fasilitas-item svg {
            width: 18px;
            height: 18px;
            color: #16614D;
            flex-shrink: 0;
        }
        .divider {
            border-color: #f0f0f0;
        }
        .stat-label {
            color: #9ca3af;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }
        /* Sembunyikan scrollbar thumbnail */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body>

<div class="container mx-auto px-4 py-8 max-w-6xl">
    <div class="grid md:grid-cols-3 gap-6">
        
        <!-- KIRI: Gambar + Info -->
        <div class="md:col-span-2 space-y-6">
            <!-- Gambar Galeri dengan Slider -->
            <div class="villa-card overflow-hidden">
                @php
                    $gambarList = $villa->images;
                @endphp
                
                @if($gambarList && $gambarList->count() > 0)
                    <div class="relative">
                        <!-- Gambar Utama -->
                        <img id="mainImage" 
                             src="/storage/{{ $gambarList->first()->image_path }}" 
                             class="w-full h-[440px] object-cover transition-opacity duration-300">
                        
                        <!-- Indikator Jumlah Gambar -->
                        <div class="absolute bottom-4 right-4 bg-black/60 text-white text-xs px-3 py-1.5 rounded-full">
                            <span id="currentIndex">1</span> / {{ $gambarList->count() }}
                        </div>
                        
                        <!-- Tombol Navigasi Prev/Next -->
                        @if($gambarList->count() > 1)
                        <button onclick="changeImage(-1)" 
                                class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white w-10 h-10 rounded-full flex items-center justify-center transition duration-200 hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <button onclick="changeImage(1)" 
                                class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white w-10 h-10 rounded-full flex items-center justify-center transition duration-200 hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        @endif
                    </div>
                    
                    <!-- Thumbnail Galeri (bisa digeser) -->
                    @if($gambarList->count() > 1)
                    <div class="flex gap-2 px-4 py-3 overflow-x-auto scrollbar-hide" id="galleryThumb" style="scroll-behavior: smooth;">
                        @foreach($gambarList as $index => $gambar)
                            <img src="/storage/{{ $gambar->image_path }}" 
                                 onclick="setImage({{ $index }})"
                                 data-index="{{ $index }}"
                                 class="w-20 h-20 object-cover rounded-lg cursor-pointer transition-all duration-200 
                                        {{ $index === 0 ? 'ring-2 ring-[#16614D] ring-offset-2' : 'opacity-70 hover:opacity-100' }}">
                        @endforeach
                    </div>
                    @endif
                    
                @else
                    <!-- Jika tidak ada gambar -->
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=800" 
                         class="w-full h-[440px] object-cover">
                @endif
            </div>

            <!-- Info Villa -->
            <div class="villa-card p-7">
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $villa->nama_villa }}</h1>
                        <p class="text-gray-500 text-sm mt-1 flex items-center gap-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $villa->lokasi ?? 'Bali, Indonesia' }}
                        </p>
                    </div>
                    <span class="badge-ready">✓ Siap Booking</span>
                </div>

                <!-- Statistik -->
                <div class="flex flex-wrap gap-8 mt-6 pt-5 border-t divider">
                    <div>
                        <p class="stat-label">Kapasitas</p>
                        <p class="font-semibold text-gray-800 text-lg mt-1">{{ $villa->kapasitas }} <span class="text-sm font-normal text-gray-500">orang</span></p>
                    </div>
                    <div>
                        <p class="stat-label">Kamar Tidur</p>
                        <p class="font-semibold text-gray-800 text-lg mt-1">{{ $villa->jumlah_kamar }} <span class="text-sm font-normal text-gray-500">kamar</span></p>
                    </div>
                    <div>
                        <p class="stat-label">Status</p>
                        <p class="font-semibold text-green-600 text-lg mt-1 flex items-center gap-2">
                            <span class="w-2.5 h-2.5 bg-green-500 rounded-full inline-block"></span>
                            Tersedia
                        </p>
                    </div>
                </div>

                <!-- Fasilitas -->
                <div class="mt-6 pt-5 border-t divider">
                    <h3 class="font-semibold text-gray-800 text-sm mb-4">Fasilitas</h3>
                    <div class="grid grid-cols-2 gap-x-8 gap-y-1">
                        @php
                            $fasilitas = $villa->fasilitas ? explode(',', $villa->fasilitas) : [];
                            $defaultFasilitas = ['Kolam renang pribadi', 'Dapur lengkap', 'Smart TV & Netflix', 'Wi-Fi kecepatan tinggi', 'Water heater', 'Sarapan gratis', 'Area BBQ', 'Ruang keluarga nyaman', 'Parkir luas', 'Pemandangan laut langsung'];
                            $fasilitasList = count($fasilitas) > 0 ? $fasilitas : $defaultFasilitas;
                        @endphp
                        @foreach($fasilitasList as $item)
                            <div class="fasilitas-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>{{ trim($item) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- KANAN: Booking Card -->
        <div class="md:col-span-1">
            <div class="villa-card p-6 sticky top-6">
                <div class="mb-5 pb-4 border-b divider">
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-bold text-gray-900">Rp {{ number_format($villa->harga_per_malam, 0, ',', '.') }}</span>
                        <span class="text-gray-400 text-sm">/ malam</span>
                    </div>
                    <p class="text-gray-400 text-xs mt-1">Harga sudah termasuk pajak</p>
                </div>

                <form action="{{ route('customer.booking.store') }}" method="POST" id="bookingForm">
                    @csrf
                    <input type="hidden" name="villa_id" value="{{ $villa->id }}">

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Check-In</label>
                            <input type="date" name="checkin" id="checkin" 
                                   class="input-field"
                                   min="{{ date('Y-m-d') }}" required
                                   @guest disabled @endguest>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Check-Out</label>
                            <input type="date" name="checkout" id="checkout" 
                                   class="input-field"
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}" required
                                   @guest disabled @endguest>
                        </div>
                    </div>

                    <div class="mt-5 py-4 border-t border-b divider">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-sm">Total</span>
                            <span id="totalHarga" class="font-bold text-gray-900 text-xl">Rp ---</span>
                        </div>
                        <input type="hidden" name="total_harga" id="total_harga_input" value="0">
                        <p class="text-gray-400 text-xs mt-1">Kamu tidak dikenakan biaya sebelum konfirmasi</p>
                    </div>

                    @auth
                        <button type="submit" class="btn-book mt-5">
                            Pesan Sekarang
                        </button>
                    @else
                        <button type="button" class="btn-book mt-5" disabled>
                            Login untuk Booking
                        </button>
                        <a href="{{ route('customer.login') }}" 
                           class="block text-center text-[#16614D] text-sm font-semibold mt-3 hover:underline">
                            Sudah punya akun? Login di sini
                        </a>
                        <p class="text-center text-gray-400 text-xs mt-2">Silakan login terlebih dahulu</p>
                    @endauth
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // ========== HARGA TOTAL ==========
    const hargaPerMalam = {{ $villa->harga_per_malam }};
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    const totalHargaSpan = document.getElementById('totalHarga');
    const totalHargaInput = document.getElementById('total_harga_input');
    
    function hitungTotal() {
        const checkin = new Date(checkinInput.value);
        const checkout = new Date(checkoutInput.value);
        
        if (checkinInput.value && checkoutInput.value && checkout > checkin) {
            const diffTime = Math.abs(checkout - checkin);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            const total = diffDays * hargaPerMalam;
            totalHargaSpan.innerHTML = `Rp ${total.toLocaleString('id-ID')}`;
            totalHargaInput.value = total;
        } else {
            totalHargaSpan.innerHTML = `Rp ---`;
            totalHargaInput.value = 0;
        }
    }
    
    checkinInput.addEventListener('change', function() {
        const minDate = new Date(this.value);
        minDate.setDate(minDate.getDate() + 1);
        checkoutInput.min = minDate.toISOString().split('T')[0];
        if (checkoutInput.value && new Date(checkoutInput.value) <= new Date(this.value)) {
            checkoutInput.value = '';
        }
        hitungTotal();
    });
    
    checkoutInput.addEventListener('change', hitungTotal);

    // ========== GALERI GAMBAR ==========
    let images = [];
    let currentImageIndex = 0;
    
    @if($villa->images && $villa->images->count() > 0)
        images = @json($villa->images->pluck('image_path'));
    @endif
    
    function setImage(index) {
        if (index < 0 || index >= images.length) return;
        currentImageIndex = index;
        
        const mainImage = document.getElementById('mainImage');
        mainImage.style.opacity = '0';
        setTimeout(() => {
            mainImage.src = '/storage/' + images[index];
            mainImage.style.opacity = '1';
        }, 150);
        
        document.getElementById('currentIndex').textContent = index + 1;
        
        document.querySelectorAll('#galleryThumb img').forEach((el, i) => {
            if (i === index) {
                el.classList.add('ring-2', 'ring-[#16614D]', 'ring-offset-2');
                el.classList.remove('opacity-70');
            } else {
                el.classList.remove('ring-2', 'ring-[#16614D]', 'ring-offset-2');
                el.classList.add('opacity-70');
            }
        });
    }
    
    function changeImage(direction) {
        let newIndex = currentImageIndex + direction;
        if (newIndex < 0) newIndex = images.length - 1;
        if (newIndex >= images.length) newIndex = 0;
        setImage(newIndex);
        
        const thumb = document.querySelector('#galleryThumb img.ring-2');
        if (thumb) {
            thumb.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
        }
    }
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft' && images.length > 0) changeImage(-1);
        if (e.key === 'ArrowRight' && images.length > 0) changeImage(1);
    });
</script>

</body>
</html>