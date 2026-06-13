<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8" />
    <title>Verifikasi Pembayaran - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background: #f0f2f5; }
        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .modal { transition: opacity 0.25s ease; }
        .stat-card {
            background: white;
            border-radius: 1rem;
            padding: 1.25rem;
            border: 1px solid #eef2f6;
            transition: all 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>
    <div class="flex min-h-screen">
        @include('layouts.sidebar')

        <!-- MAIN CONTENT -->
        <div class="flex-1 overflow-y-auto">
            
            <!-- TOPBAR -->
            <div class="bg-white border-b px-6 py-4 sticky top-0 z-10">
                <h1 class="text-xl font-semibold text-gray-800">Verifikasi Pembayaran</h1>
                <p class="text-gray-500 text-sm mt-0.5">Kelola bukti transfer customer</p>
            </div>

            <div class="p-6">
                
                <!-- STATISTIK CARDS -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
                    <div class="stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Menunggu Verifikasi</p>
                                <p class="text-2xl font-bold text-yellow-600">{{ $menungguVerifikasi }}</p>
                            </div>
                            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-clock text-yellow-600"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Pembayaran</p>
                    </div>
                    
                    <div class="stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Terverifikasi</p>
                                <p class="text-2xl font-bold text-green-600">{{ $terverifikasi }}</p>
                            </div>
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Pembayaran</p>
                    </div>
                    
                    <div class="stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Ditolak</p>
                                <p class="text-2xl font-bold text-red-600">{{ $ditolak }}</p>
                            </div>
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-times-circle text-red-600"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Pembayaran</p>
                    </div>
                    
                    <div class="stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Transaksi</p>
                                <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</p>
                            </div>
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-chart-line text-blue-600"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Semua waktu</p>
                    </div>
                </div>
                
                <!-- ALERT MESSAGES -->
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                <!-- FILTER & SEARCH -->
                <div class="bg-white rounded-xl shadow-sm border p-4 mb-6">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex flex-wrap items-center gap-3">
                            <select id="statusFilter" class="px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                                <option value="all">Semua Status</option>
                                <option value="pending">Menunggu</option>
                                <option value="dibayar">Terverifikasi</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                            
                            <input type="date" id="dateFilter" class="px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                        </div>
                        
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Cari customer, villa, atau ID booking..." 
                                   class="pl-10 pr-4 py-2 border rounded-lg w-80 text-sm focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
                        </div>
                    </div>
                </div>
                
                <!-- TABEL RESERVASI -->
                <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Customer</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Villa</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal Booking</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Total</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">Bukti Transfer</th>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody" class="divide-y divide-gray-100">
                                @forelse($reservasi as $item)
                                <tr class="hover:bg-gray-50 transition" data-status="{{ $item->status }}" data-date="{{ $item->created_at->format('Y-m-d') }}">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $item->user->name ?? 'Unknown' }}</div>
                                        <div class="text-xs text-gray-500">{{ $item->user->email ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $item->villa->nama_villa ?? 'Unknown' }}</div>
                                        <div class="text-xs text-gray-500">{{ $item->villa->jumlah_kamar ?? '?' }} Kamar</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $item->created_at->format('d/m/Y') }}
                                        <div class="text-xs text-gray-400">{{ $item->created_at->format('H:i') }} WIB</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-800">
                                        Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium
                                            @if($item->status == 'pending') bg-yellow-100 text-yellow-700
                                            @elseif($item->status == 'dibayar') bg-green-100 text-green-700
                                            @else bg-red-100 text-red-700 @endif">
                                            {{ $item->status == 'pending' ? 'Menunggu' : ($item->status == 'dibayar' ? 'Terverifikasi' : 'Ditolak') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($item->bukti_pembayaran)
                                        <button onclick="previewBukti('{{ Storage::url($item->bukti_pembayaran) }}')" 
                                                class="text-blue-600 hover:text-blue-800 transition">
                                            <i class="fas fa-image text-xl"></i>
                                            <span class="text-xs block">Preview</span>
                                        </button>
                                        @else
                                        <span class="text-gray-400 text-sm">Belum upload</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center gap-2">
                                            @if($item->status == 'pending')
                                            <button onclick="verifikasi({{ $item->id }})" 
                                                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-xs flex items-center gap-1">
                                                <i class="fas fa-check"></i> Setuju
                                            </button>
                                            <button onclick="tolak({{ $item->id }})" 
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs flex items-center gap-1">
                                                <i class="fas fa-times"></i> Tolak
                                            </button>
                                            @else
                                            <span class="text-gray-400 text-xs">-</span>
                                            @endif

                                            
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                        <i class="fas fa-receipt text-4xl mb-3 block"></i>
                                        <p>Belum ada data pembayaran yang perlu diverifikasi</p>
                                        <p class="text-sm mt-1">Customer akan muncul di sini setelah upload bukti transfer</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PREVIEW BUKTI -->
    <div id="previewModal" class="modal fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl max-w-lg w-full mx-4 overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="font-bold text-lg">Preview Bukti Pembayaran</h3>
                <button onclick="closePreviewModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-4">
                <img id="previewImage" src="" alt="Bukti Pembayaran" class="w-full rounded-lg">
            </div>
            <div class="p-4 border-t flex justify-end">
                <button onclick="closePreviewModal()" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- FORM VERIFIKASI (hidden) -->
    <form id="verifikasiForm" method="POST" style="display: none;">
        @csrf
        @method('PUT')
    </form>

    <script>
        // Filter functions
        const statusFilter = document.getElementById('statusFilter');
        const dateFilter = document.getElementById('dateFilter');
        const searchInput = document.getElementById('searchInput');
        
        function filterTable() {
            const status = statusFilter.value;
            const date = dateFilter.value;
            const search = searchInput.value.toLowerCase();
            const rows = document.querySelectorAll('#tableBody tr');
            let visibleCount = 0;
            
            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                const rowDate = row.getAttribute('data-date');
                const rowText = row.innerText.toLowerCase();
                
                let statusMatch = status === 'all' || rowStatus === status;
                let dateMatch = !date || rowDate === date;
                let searchMatch = !search || rowText.includes(search);
                
                if (statusMatch && dateMatch && searchMatch) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
        }
        
        statusFilter.addEventListener('change', filterTable);
        dateFilter.addEventListener('change', filterTable);
        searchInput.addEventListener('keyup', filterTable);
        
        // Preview bukti
        function previewBukti(url) {
            document.getElementById('previewImage').src = url;
            document.getElementById('previewModal').classList.remove('hidden');
            document.getElementById('previewModal').classList.add('flex');
        }
        
        function closePreviewModal() {
            document.getElementById('previewModal').classList.add('hidden');
            document.getElementById('previewModal').classList.remove('flex');
        }
        
        // Verifikasi actions
        function verifikasi(id) {
            if (confirm('Apakah Anda yakin ingin memverifikasi pembayaran ini?')) {
                const form = document.getElementById('verifikasiForm');
                form.action = `/admin/verifikasi/${id}/verifikasi`;
                form.submit();
            }
        }
        
        function tolak(id) {
            if (confirm('Apakah Anda yakin ingin menolak pembayaran ini?')) {
                const form = document.getElementById('verifikasiForm');
                form.action = `/admin/verifikasi/${id}/tolak`;
                form.submit();
            }
        }
    </script>
</body>
</html>