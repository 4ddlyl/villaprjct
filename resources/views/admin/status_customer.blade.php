<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Status Customer - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .badge-active {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-banned {
            background: #fee2e2;
            color: #991b1b;
        }

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

        .modal {
            transition: opacity 0.25s ease;
        }

        .main-content {
            overflow-y: auto;
            height: 100vh;
        }

        .alert-success {
            background: #d1fae5;
            border: 1px solid #6ee7b7;
            color: #065f46;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success i {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="flex min-h-screen">
        @include('layouts.sidebar')

        <!-- MAIN CONTENT -->
        <div class="flex-1 main-content bg-[#f0f2f5]">

            <!-- TOPBAR -->
            <div class="bg-white border-b px-6 py-4 flex items-center justify-between sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <div>
                        <h1 class="text-xl font-semibold text-gray-800">Status Customer</h1>
                        <p class="text-gray-500 text-sm mt-0.5">Kelola dan pantau status customer</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="relative">
                        <button id="notificationBtn" class="relative p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-full transition">

                        </button>
                        <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border z-20">
                            <div class="p-3 border-b">
                                <h3 class="font-semibold text-gray-800">Notifikasi</h3>
                            </div>
                            <div class="py-8 text-center">
                                <i class="fas fa-bell-slash text-4xl text-gray-300 mb-3 block"></i>
                                <p class="text-gray-500 text-sm">Belum ada notifikasi</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="p-6">

                <!-- JUDUL HALAMAN (mobile) -->
                <div class="mb-6 lg:hidden">
                    <h1 class="text-2xl font-bold text-gray-800">Status Customer</h1>
                    <p class="text-gray-500 text-sm mt-1">Kelola dan pantau status customer</p>
                </div>

                <!-- ALERT MESSAGES - OTOMATIS HILANG 5 DETIK -->
                @if(session('success'))
                <div id="alertMessage" class="alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div id="alertMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                </div>
                @endif

                <!-- STATISTIK CARDS -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
                    <div class="stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Customers</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $totalCustomers }}</p>
                            </div>
                            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-users text-gray-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Active Customers</p>
                                <p class="text-2xl font-bold text-green-600">{{ $activeCustomers }}</p>
                            </div>
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-check text-green-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Banned Customers</p>
                                <p class="text-2xl font-bold text-red-600">{{ $bannedCustomers }}</p>
                            </div>
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-slash text-red-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Haven't Reserved</p>
                                <p class="text-2xl font-bold text-orange-600">{{ $haventReserved }}</p>
                            </div>
                            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-calendar-times text-orange-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FILTER & SEARCH -->
                <div class="bg-white rounded-xl shadow-sm border p-4 mb-6">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex flex-wrap items-center gap-3">
                            <select id="statusFilter" class="px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#16614D] bg-white">
                                <option value="all">Semua Status</option>
                                <option value="active">Aktif</option>
                                <option value="banned">Diblokir</option>
                            </select>
                        </div>

                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Cari nama atau email customer..."
                                class="pl-10 pr-4 py-2 border rounded-lg w-80 text-sm focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
                        </div>
                    </div>
                </div>

                <!-- TABEL CUSTOMER -->
                <div class="bg-white rounded-2xl border overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">NO</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">NAMA</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">EMAIL</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">STATUS AKUN</th>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">AKSI</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody" class="divide-y divide-gray-100">
                                @forelse($customers as $index => $customer)
                                <tr class="hover:bg-gray-50 transition" data-status="{{ $customer->status === 'banned' ? 'banned' : 'active' }}" data-name="{{ strtolower($customer->name) }}" data-email="{{ strtolower($customer->email) }}">
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration }}</td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $customer->name }}</div>
                                        <div class="text-xs text-gray-400 mt-0.5">
                                            Bergabung: {{ $customer->created_at->format('d/m/Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-600">{{ $customer->email }}</div>
                                        <div class="text-xs text-gray-400 mt-0.5">
                                            Total reservasi: {{ $customer->reservasis_count }} reservasi
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium
                                            {{ $customer->status === 'active' ? 'badge-active' : 'badge-banned' }}">
                                            {{ $customer->status === 'active' ? 'Active' : 'Banned' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center gap-2">
                                            <button onclick="detailCustomer({{ $customer->id }})"
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-xs flex items-center gap-1">
                                                <i class="fas fa-info-circle"></i> Detail
                                            </button>
                                            @if($customer->status === 'banned')
                                            <!-- Unban dengan form terpisah -->
                                            <form action="{{ route('admin.status-customer.toggle-ban', $customer->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-xs flex items-center gap-1">
                                                    <i class="fas fa-user-check"></i>
                                                    Unban
                                                </button>
                                            </form>
                                            @else
                                            <!-- Ban dengan modal -->
                                            <button onclick="openBanModal({{ $customer->id }}, '{{ $customer->name }}', '{{ $customer->email }}', '{{ $customer->status }}')"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs flex items-center gap-1">
                                                <i class="fas fa-user-slash"></i>
                                                Ban
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                        <i class="fas fa-users text-4xl mb-3 block"></i>
                                        <p>Belum ada customer</p>
                                        <p class="text-sm mt-1">Customer akan muncul setelah register</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION - CUSTOM -->
                    @if($customers->total() > 0)
                    <div class="px-6 py-4 border-t flex flex-wrap items-center justify-between gap-4 bg-gray-50">
                        <div class="text-sm text-gray-500">
                            Menampilkan {{ $customers->firstItem() }} - {{ $customers->lastItem() }} dari {{ $customers->total() }} data
                        </div>
                        <div class="flex items-center gap-2">
                            @if($customers->onFirstPage())
                            <span class="px-3 py-1 border rounded-lg text-sm text-gray-400 bg-gray-100 cursor-not-allowed">Sebelumnya</span>
                            @else
                            <a href="{{ $customers->previousPageUrl() }}" class="px-3 py-1 border rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition">Sebelumnya</a>
                            @endif

                            <span class="px-3 py-1 bg-[#16614D] text-white rounded-lg text-sm">{{ $customers->currentPage() }}</span>

                            @if($customers->hasMorePages())
                            <a href="{{ $customers->nextPageUrl() }}" class="px-3 py-1 border rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition">Selanjutnya</a>
                            @else
                            <span class="px-3 py-1 border rounded-lg text-sm text-gray-400 bg-gray-100 cursor-not-allowed">Selanjutnya</span>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DETAIL CUSTOMER -->
    <div id="detailModal" class="modal fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl max-w-2xl w-full mx-4 overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-xl font-bold text-gray-800">DETAIL CUSTOMER</h3>
                <button onclick="closeDetailModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-6" id="detailContent">
                <div class="text-center py-8">
                    <i class="fas fa-spinner fa-spin text-2xl text-gray-400"></i>
                    <p class="mt-2 text-gray-500">Memuat data...</p>
                </div>
            </div>
            <div class="p-4 border-t flex justify-end">
                <button onclick="closeDetailModal()" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL KONFIRMASI BAN -->
    <div id="banModal" class="modal fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl max-w-lg w-full mx-4 overflow-hidden">
            <div class="p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-red-600">⚠️ KONFIRMASI BAN CUSTOMER</h3>
                    <button onclick="closeBanModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Pesan Konfirmasi -->
                <p class="text-gray-600 mb-4">Apakah Anda yakin ingin memban customer ini?</p>

                <!-- Info Customer -->
                <div id="banCustomerInfo" class="bg-gray-50 rounded-lg p-4 mb-4">
                    <div class="flex justify-between border-b pb-2 mb-2">
                        <span class="text-gray-500">Nama :</span>
                        <span id="banCustomerName" class="font-medium text-gray-800">-</span>
                    </div>
                    <div class="flex justify-between border-b pb-2 mb-2">
                        <span class="text-gray-500">Email :</span>
                        <span id="banCustomerEmail" class="font-medium text-gray-800">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Status :</span>
                        <span id="banCustomerStatus" class="font-medium text-green-600">Aktif</span>
                    </div>
                </div>

                <!-- Peringatan -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-4">
                    <p class="text-yellow-800 text-sm">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Customer yang di-ban tidak bisa login dan tidak bisa melakukan reservasi baru.
                    </p>
                </div>

                <!-- Form Alasan -->
                <form id="banForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alasan <span class="text-gray-400 text-xs">(Opsional)</span></label>
                        <textarea name="alasan_ban" id="banAlasan" rows="3"
                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="Tulis alasan memban customer..."></textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeBanModal()"
                            class="px-4 py-2 border rounded-lg hover:bg-gray-50 transition">
                            Batalkan
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition flex items-center gap-2">
                            <i class="fas fa-user-slash"></i>
                            Ya, Ban customer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- FORM TOGGLE BAN (Hidden) -->
    <form id="toggleBanForm" method="POST" style="display: none;">
        @csrf
        @method('PUT')
    </form>

    <script>
        // HILANGKAN ALERT SETELAH 5 DETIK
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('alertMessage');
            if (alert) {
                setTimeout(function() {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 500);
                }, 5000);
            }
        });

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

        // Filter functions
        const statusFilter = document.getElementById('statusFilter');
        const searchInput = document.getElementById('searchInput');

        function filterTable() {
            const status = statusFilter.value;
            const search = searchInput.value.toLowerCase();
            const rows = document.querySelectorAll('#tableBody tr');

            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                const rowName = row.getAttribute('data-name');
                const rowEmail = row.getAttribute('data-email');

                let statusMatch = status === 'all' || rowStatus === status;
                let searchMatch = !search || rowName.includes(search) || rowEmail.includes(search);

                if (statusMatch && searchMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        statusFilter.addEventListener('change', filterTable);
        searchInput.addEventListener('keyup', filterTable);

        // Detail customer
        function detailCustomer(id) {
            const modal = document.getElementById('detailModal');
            const content = document.getElementById('detailContent');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            content.innerHTML = '<div class="text-center py-8"><i class="fas fa-spinner fa-spin text-2xl text-gray-400"></i><p class="mt-2 text-gray-500">Memuat data...</p></div>';

            fetch(`/admin/status-customer/${id}/detail`)
                .then(response => response.json())
                .then(data => {
                    let riwayatHtml = '';
                    if (data.reservasis && data.reservasis.length > 0) {
                        riwayatHtml = `
                            <h4 class="font-semibold text-gray-800 mt-4 mb-2">Riwayat Reservasi terbaru</h4>
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-3 py-2 text-left">Tanggal</th>
                                        <th class="px-3 py-2 text-left">Villa</th>
                                        <th class="px-3 py-2 text-left">Total</th>
                                        <th class="px-3 py-2 text-left">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${data.reservasis.map(r => `
                                        <tr class="border-b">
                                            <td class="px-3 py-2">${new Date(r.checkin).toLocaleDateString('id-ID')}</td>
                                            <td class="px-3 py-2">${r.villa?.nama_villa || '-'}</td>
                                            <td class="px-3 py-2">Rp ${parseInt(r.total_harga).toLocaleString('id-ID')}</td>
                                            <td class="px-3 py-2">
                                                <span class="px-2 py-1 rounded-full text-xs ${r.status === 'dibayar' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'}">
                                                    ${r.status === 'dibayar' ? 'Dibayar' : 'Pending'}
                                                </span>
                                            </td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        `;
                    } else {
                        riwayatHtml = `<p class="text-gray-500 text-sm mt-4">Belum ada reservasi</p>`;
                    }

                    content.innerHTML = `
                        <div class="space-y-3">
                            <div class="flex justify-between border-b pb-2">
                                <span class="text-gray-500">Nama Lengkap :</span>
                                <span class="font-medium">${data.name}</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="text-gray-500">Email :</span>
                                <span class="font-medium">${data.email}</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="text-gray-500">Status :</span>
                                <span class="font-medium ${data.status === 'active' ? 'text-green-600' : 'text-red-600'}">${data.status === 'active' ? 'Aktif' : 'Diblokir'}</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="text-gray-500">Bergabung :</span>
                                <span class="font-medium">${new Date(data.created_at).toLocaleDateString('id-ID')}</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="text-gray-500">Total Reservasi :</span>
                                <span class="font-medium">${data.total_reservasi} reservasi</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="text-gray-500">Total belanja :</span>
                                <span class="font-medium">Rp ${parseInt(data.total_belanja).toLocaleString('id-ID')}</span>
                            </div>
                            ${riwayatHtml}
                        </div>
                    `;
                })
                .catch(error => {
                    content.innerHTML = '<div class="text-center py-8 text-red-500"><i class="fas fa-exclamation-circle text-2xl"></i><p class="mt-2">Gagal memuat data</p></div>';
                });
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
            document.getElementById('detailModal').classList.remove('flex');
        }

        // BAN MODAL FUNCTIONS //
        function openBanModal(id, name, email, status) {
            document.getElementById('banCustomerName').innerText = name;
            document.getElementById('banCustomerEmail').innerText = email;
            document.getElementById('banCustomerStatus').innerText = status === 'active' ? 'Aktif' : 'Banned';
            document.getElementById('banCustomerStatus').className = status === 'active' ? 'font-medium text-green-600' : 'font-medium text-red-600';

            const form = document.getElementById('banForm');
            form.action = `/admin/status-customer/${id}/toggle-ban`;

            // Reset alasan
            document.getElementById('banAlasan').value = '';

            document.getElementById('banModal').classList.remove('hidden');
            document.getElementById('banModal').classList.add('flex');
        }

        function closeBanModal() {
            document.getElementById('banModal').classList.add('hidden');
            document.getElementById('banModal').classList.remove('flex');
            document.getElementById('banAlasan').value = '';
        }

        // UNBAN CUSTOMER //
        function unbanCustomer(id) {
            if (confirm('Apakah Anda yakin ingin mengaktifkan kembali customer ini?')) {
                const form = document.getElementById('toggleBanForm');
                form.action = `/admin/status-customer/${id}/toggle-ban`;
                form.submit();
            }
        }
    </script>
</body>

</html>