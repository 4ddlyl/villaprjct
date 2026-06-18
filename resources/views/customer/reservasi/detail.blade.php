<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Reservasi - Villa Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background: #f5f7fa; }
        .glass-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            border: 1px solid #eef2f6;
        }
        .status-badge {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-paid { background: #d1fae5; color: #065f46; }
        .status-rejected { background: #fee2e2; color: #991b1b; }
        .bank-option {
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .bank-option:hover { background: #f3f4f6; }
        .bank-option.active { border-color: #16614D; background: #ecfdf5; }
        .upload-area {
            border: 2px dashed #d1d5db;
            transition: all 0.2s ease;
        }
        .upload-area:hover { border-color: #16614D; background: #f9fafb; }
        .upload-area.dragover { border-color: #16614D; background: #ecfdf5; }
    </style>
</head>
<body>


<div class="min-h-screen py-10 px-4 md:px-8">
    <div class="max-w-5xl mx-auto">
        
        <!-- Alert Messages -->
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
        </div>
        @endif

        <div class="grid md:grid-cols-2 gap-8">
            
            <!-- KIRI: Detail Reservasi -->
            <div class="glass-card p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">DETAIL RESERVASI</h2>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-gray-500 text-sm">Villa</p>
                        <p class="font-semibold text-gray-800 text-lg">{{ $reservasi->villa->nama_villa }}</p>
                        <span class="inline-block mt-1 text-xs text-green-600 bg-green-50 px-3 py-1 rounded-full">READY TO BOOK</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-500 text-sm">Check-In</p>
                            <p class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($reservasi->checkin)->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Check-Out</p>
                            <p class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($reservasi->checkout)->format('d M Y') }}</p>
                        </div>
                    </div>
                    
                    <div>
                        <p class="text-gray-500 text-sm">Total Harga</p>
                        <p class="font-bold text-2xl text-[#16614D]">Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</p>
                    </div>
                    
                    <div>
                        <p class="text-gray-500 text-sm">Status</p>
                        <span class="status-badge status-pending">Menunggu Pembayaran</span>
                    </div>
                    
                    <div>
                        <p class="text-gray-500 text-sm">Nomor Booking</p>
                        <p class="font-mono font-bold text-gray-800">{{ $nomorBooking }}</p>
                    </div>
                </div>
            </div>
            
            <!-- KANAN: Form Upload Bukti -->
            <div class="glass-card p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">FORM UPLOAD BUKTI</h2>
                
                <form action="{{ route('customer.reservasi.upload-bukti', $reservasi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Metode Pembayaran -->
                    <div class="mb-6">
                        <label class="block font-semibold text-gray-700 mb-3">Metode Pembayaran</label>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach($banks as $bank => $rekening)
                            <label class="bank-option border rounded-xl p-3 flex items-center gap-2 cursor-pointer transition">
                                <input type="radio" name="bank" value="{{ $bank }}" class="text-[#16614D] focus:ring-[#16614D]" required>
                                <span class="text-sm font-medium">{{ $bank }}</span>
                            </label>
                            @endforeach
                            <label class="bank-option border rounded-xl p-3 flex items-center gap-2 cursor-pointer transition">
                                <input type="radio" name="bank" value="Lainnya" class="text-[#16614D] focus:ring-[#16614D]">
                                <span class="text-sm font-medium">Lainnya</span>
                            </label>
                        </div>
                        @error('bank')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Upload Bukti -->
                    <div class="mb-6">
                        <label class="block font-semibold text-gray-700 mb-3">Upload Bukti</label>
                        <div class="upload-area rounded-xl p-8 text-center cursor-pointer" id="uploadArea">
                            <input type="file" name="bukti_pembayaran" id="fileInput" class="hidden" accept="image/*,application/pdf" required>
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-300 mb-3 block"></i>
                            <p class="text-gray-500 text-sm">Klik atau seret file ke sini</p>
                            <p class="text-gray-400 text-xs mt-1">JPG, PNG, PDF (Max 2MB)</p>
                            <div id="fileName" class="hidden mt-3 text-sm text-[#16614D] font-medium">
                                <i class="fas fa-check-circle mr-1"></i> <span></span>
                            </div>
                        </div>
                        @error('bukti_pembayaran')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Informasi Transfer -->
                    <div class="bg-gray-50 rounded-xl p-4 mb-6">
                        <p class="text-sm text-gray-600 font-medium mb-2">Informasi Transfer</p>
                        <p class="text-xs text-gray-500" id="infoRekening">Pilih bank di atas untuk melihat nomor rekening</p>
                        <p class="text-xs text-gray-500 mt-2">Sertakan nomor booking: <span class="font-mono font-bold">{{ $nomorBooking }}</span></p>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-[#16614D] hover:bg-[#0f4a3a] text-white font-semibold py-3 rounded-xl transition">
                        <i class="fas fa-upload mr-2"></i> Upload Bukti Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    // Pilih bank -> tampilkan rekening
    const banks = @json($banks);
    const radioButtons = document.querySelectorAll('input[name="bank"]');
    const infoSpan = document.getElementById('infoRekening');
    
    radioButtons.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value !== 'Lainnya' && banks[this.value]) {
                infoSpan.innerHTML = `Transfer ke rekening ${this.value} ${banks[this.value]}`;
            } else {
                infoSpan.innerHTML = 'Silakan transfer ke rekening yang tersedia dan upload bukti pembayaran.';
            }
        });
    });
    
    // Upload area - klik
    document.getElementById('uploadArea').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });
    
    // Upload area - drag & drop
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');
    const fileName = document.getElementById('fileName');
    
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });
    
    uploadArea.addEventListener('dragleave', function() {
        uploadArea.classList.remove('dragover');
    });
    
    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        fileInput.files = e.dataTransfer.files;
        updateFileName();
    });
    
    fileInput.addEventListener('change', updateFileName);
    
    function updateFileName() {
        if (fileInput.files.length > 0) {
            fileName.querySelector('span').textContent = fileInput.files[0].name;
            fileName.classList.remove('hidden');
        } else {
            fileName.classList.add('hidden');
        }
    }
</script>

</body>
</html>