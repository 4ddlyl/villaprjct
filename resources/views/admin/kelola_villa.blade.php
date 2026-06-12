<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8" />
    <title>Kelola Villa - Admin Villa Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        body {
            background: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .stat-card {
            background: white;
            border-radius: 1rem;
            padding: 1rem;
            border: 1px solid #eef2f6;
            transition: all 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }
        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }
        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }
        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }
        .main-content {
            overflow-y: auto;
            height: 100vh;
        }
        .btn-primary {
            background-color: #16614D;
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            background-color: #0f4a3a;
        }
        .modal {
            transition: opacity 0.25s ease;
        }
    </style>
</head>
<body>
    <div class="flex">
        @include('layouts.sidebar')

        <!-- MAIN CONTENT -->
        <div class="flex-1 main-content bg-[#f0f2f5]">
            
            <!-- TOPBAR -->
            <div class="bg-white border-b px-6 py-4 flex items-center justify-between sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <h1 class="text-xl font-semibold text-gray-800">Kelola Villa</h1>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="cari sesuatu" class="pl-10 pr-4 py-2 border rounded-lg w-64 focus:outline-none focus:ring-2 focus:ring-[#16614D] focus:border-transparent">
                        <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    
                    <div class="relative">
                        <button id="notificationBtn" class="relative p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-full transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </button>
                        
                        <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border z-20">
                            <div class="p-3 border-b">
                                <h3 class="font-semibold text-gray-800">Notifikasi</h3>
                            </div>
                            <div class="py-8 text-center">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                <p class="text-gray-500 text-sm">Belum ada notifikasi</p>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>

            <!-- KONTEN UTAMA -->
            <div class="p-6">
                
                <!-- JUDUL HALAMAN -->
                <div class="mb-6">
                    <div class="flex items-center gap-3">
                        <h1 class="text-2xl font-bold text-gray-800">Daftar Villa</h1>
                        <div class="bg-[#16614D]/10 text-[#16614D] px-3 py-1 rounded-full text-sm font-medium">
                            Total: {{ $villas->count() }} Villa
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm mt-1">Kelola dan pantau semua villa yang tersedia.</p>
                </div>

                <!-- ALERT MESSAGES -->
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- FILTER & SEARCH - SEJAJAR -->
                <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                    <!-- Kiri: Search & Filter Status Dropdown -->
                    <div class="flex flex-wrap items-center gap-3">
                        <!-- Search Input -->
                        <div class="relative">
                            <input type="text" id="searchInputTable" placeholder="Filter berdasarkan nama villa..." class="pl-10 pr-4 py-2 border rounded-lg w-72 focus:outline-none focus:ring-2 focus:ring-[#16614D] focus:border-transparent text-sm">
                            <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        
                        <!-- Dropdown Filter Status -->
                        <select id="statusFilter" class="px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#16614D] bg-white">
                            <option value="all">Semua Status</option>
                            <option value="tersedia">Tersedia</option>
                            <option value="tidak tersedia">Tidak Tersedia</option>
                            <option value="dipesan">Dipesan</option>
                        </select>
                    </div>
                    
                    <!-- Kanan: Tombol Tambah Villa -->
                    <button onclick="openCreateModal()" class="btn-primary flex items-center gap-2 px-4 py-2 bg-[#16614D] text-white rounded-lg text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Villa
                    </button>
                </div>

                <!-- TABEL VILLA -->
                <div class="bg-white rounded-2xl border overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">NAMA VILLA</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">KAPASITAS</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">HARGA / MALAM</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">STATUS</th>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">AKSI</th>
                                </tr>
                            </thead>
                            <tbody id="villaTableBody" class="divide-y divide-gray-100">
                                @forelse($villas as $villa)
                                <tr class="hover:bg-gray-50 transition villa-row" data-status="{{ $villa->status }}" data-name="{{ strtolower($villa->nama_villa) }}">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $villa->nama_villa }}</div>
                                        <div class="text-xs text-gray-500 mt-0.5">{{ $villa->lokasi ?? 'Bali' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $villa->kapasitas }} Tamu</td>
                                    <td class="px-6 py-4 text-sm text-gray-600 font-medium">Rp {{ number_format($villa->harga_per_malam, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="badge 
                                            @if($villa->status == 'tersedia') badge-success
                                            @elseif($villa->status == 'dipesan') badge-warning
                                            @elseif($villa->status == 'tidak tersedia') badge-danger
                                            @else badge-info @endif">
                                            {{ $villa->status == 'tersedia' ? 'Tersedia' : ($villa->status == 'dipesan' ? 'Dipesan' : ($villa->status == 'tidak tersedia' ? 'Tidak Tersedia' : ucfirst($villa->status))) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center gap-2">
                                            <button onclick="openEditModal({{ $villa->id }})" class="text-blue-600 hover:text-blue-800 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </button>
                                            <button onclick="openDeleteModal({{ $villa->id }}, '{{ $villa->nama_villa }}')" class="text-red-600 hover:text-red-800 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                        Belum ada data villa
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- PAGINATION INFO -->
                    <div class="px-6 py-4 border-t flex items-center justify-between bg-gray-50">
                        <div class="text-sm text-gray-500">
                            Menampilkan <span id="displayCount">{{ $villas->count() }}</span> dari {{ $villas->count() }} data
                        </div>
                        <div class="flex items-center gap-2">
                            <button class="px-3 py-1 border rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition">
                                Sebelumnya
                            </button>
                            <button class="px-3 py-1 bg-[#16614D] text-white rounded-lg text-sm">
                                1
                            </button>
                            <button class="px-3 py-1 border rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition">
                                Selanjutnya
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL CREATE -->
    <div id="createModal" class="modal fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl w-full max-w-md p-6 max-h-[90vh] overflow-y-auto">
            <h3 class="text-xl font-bold mb-4">Tambah Villa Baru</h3>
            <form action="{{ route('admin.villa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Villa</label>
                        <input type="text" name="nama_villa" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                        <input type="text" name="lokasi" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kapasitas (orang)</label>
                            <input type="number" name="kapasitas" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Kamar</label>
                            <input type="number" name="jumlah_kamar" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Harga per Malam</label>
                        <input type="number" name="harga_per_malam" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fasilitas</label>
                        <textarea name="fasilitas" rows="3" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#16614D]" placeholder="Pisahkan dengan koma, contoh: Kolam renang, WiFi, AC"></textarea>
                        <p class="text-xs text-gray-500 mt-1">Pisahkan setiap fasilitas dengan koma</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                            <option value="tersedia">Tersedia</option>
                            <option value="dipesan">Dipesan</option>
                            <option value="tidak tersedia">Tidak Tersedia</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Villa</label>
                        <input type="file" name="gambar[]" multiple accept="image/*" 
           class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                        <p class="text-xs text-gray-500 mt-1">Bisa pilih lebih dari satu gambar (CTRL + klik). Gambar pertama akan menjadi gambar utama.</p>
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeCreateModal()" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-[#16614D] text-white rounded-lg hover:bg-[#0f4a3a]">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div id="editModal" class="modal fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl w-full max-w-md p-6 max-h-[90vh] overflow-y-auto">
            <h3 class="text-xl font-bold mb-4">Edit Villa</h3>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Villa</label>
                        <input type="text" name="nama_villa" id="edit_nama_villa" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                        <input type="text" name="lokasi" id="edit_lokasi" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kapasitas (orang)</label>
                            <input type="number" name="kapasitas" id="edit_kapasitas" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Kamar</label>
                            <input type="number" name="jumlah_kamar" id="edit_jumlah_kamar" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Harga per Malam</label>
                        <input type="number" name="harga_per_malam" id="edit_harga_per_malam" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fasilitas</label>
                        <textarea name="fasilitas" id="edit_fasilitas" rows="3" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#16614D]"></textarea>
                        <p class="text-xs text-gray-500 mt-1">Pisahkan setiap fasilitas dengan koma</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="edit_status" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                            <option value="tersedia">Tersedia</option>
                            <option value="dipesan">Dipesan</option>
                            <option value="tidak tersedia">Tidak Tersedia</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tambah Gambar Baru</label>
                        <input type="file" name="gambar[]" multiple accept="image/*" 
                               class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                        <p class="text-xs text-gray-500 mt-1">Upload gambar baru akan menambah gallery (tidak mengganti yang lama)</p>
                    </div>
                    <div id="existingImages" class="mt-3"></div>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-[#16614D] text-white rounded-lg hover:bg-[#0f4a3a]">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL DELETE -->
    <div id="deleteModal" class="modal fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl w-full max-w-md p-6">
            <h3 class="text-xl font-bold mb-4">Hapus Villa</h3>
            <p id="deleteMessage" class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus villa ini?</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Filter Status dengan Dropdown
        const statusFilter = document.getElementById('statusFilter');
        const searchInputTable = document.getElementById('searchInputTable');

        function filterData() {
            const status = statusFilter.value;
            const searchTerm = searchInputTable ? searchInputTable.value.toLowerCase() : '';
            const rows = document.querySelectorAll('.villa-row');
            let visibleCount = 0;
            
            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                const rowName = row.getAttribute('data-name');
                
                let statusMatch = (status === 'all') || (rowStatus === status);
                let searchMatch = rowName.includes(searchTerm);
                
                if (statusMatch && searchMatch) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            const displayCountSpan = document.getElementById('displayCount');
            if (displayCountSpan) displayCountSpan.innerText = visibleCount;
        }

        if (statusFilter) statusFilter.addEventListener('change', filterData);
        if (searchInputTable) searchInputTable.addEventListener('keyup', filterData);

        // Toggle Notification Dropdown
        const notificationBtn = document.getElementById('notificationBtn');
        const notificationDropdown = document.getElementById('notificationDropdown');
        
        if (notificationBtn && notificationDropdown) {
            notificationBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                notificationDropdown.classList.toggle('hidden');
            });
            document.addEventListener('click', (e) => {
                if (!notificationBtn.contains(e.target) && !notificationDropdown.contains(e.target)) {
                    notificationDropdown.classList.add('hidden');
                }
            });
        }
        
        // Modal Functions
        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
            document.getElementById('createModal').classList.add('flex');
        }
        function closeCreateModal() {
            document.getElementById('createModal').classList.add('hidden');
            document.getElementById('createModal').classList.remove('flex');
        }
        
        function openEditModal(id) {
            fetch(`/admin/villa/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_nama_villa').value = data.nama_villa;
                    document.getElementById('edit_lokasi').value = data.lokasi;
                    document.getElementById('edit_kapasitas').value = data.kapasitas;
                    document.getElementById('edit_jumlah_kamar').value = data.jumlah_kamar;
                    document.getElementById('edit_harga_per_malam').value = data.harga_per_malam;
                    document.getElementById('edit_fasilitas').value = data.fasilitas || '';
                    document.getElementById('edit_status').value = data.status;
                    document.getElementById('editForm').action = `/admin/villa/${id}`;
                    
                    // Tampilkan gambar existing
                    const existingImagesDiv = document.getElementById('existingImages');
                    if (data.images && data.images.length > 0) {
                        let imagesHtml = '<p class="text-xs text-gray-500 mb-2">Gambar saat ini:</p><div class="flex gap-2 flex-wrap">';
                        data.images.forEach(img => {
                            imagesHtml += `<img src="/storage/${img.image_path}" class="w-16 h-16 object-cover rounded-lg border">`;
                        });
                        imagesHtml += '</div>';
                        existingImagesDiv.innerHTML = imagesHtml;
                    } else {
                        existingImagesDiv.innerHTML = '<p class="text-xs text-gray-400">Belum ada gambar</p>';
                    }
                    
                    document.getElementById('editModal').classList.remove('hidden');
                    document.getElementById('editModal').classList.add('flex');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal mengambil data villa');
                });
        }
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editModal').classList.remove('flex');
        }
        
        function openDeleteModal(id, name) {
            document.getElementById('deleteMessage').innerText = `Apakah Anda yakin ingin menghapus villa "${name}"?`;
            document.getElementById('deleteForm').action = `/admin/villa/${id}`;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
        }
        
        // Initial display count
        const initialCount = document.querySelectorAll('.villa-row').length;
        const displayCountSpan = document.getElementById('displayCount');
        if (displayCountSpan) displayCountSpan.innerText = initialCount;
    </script>
</body>
</html>