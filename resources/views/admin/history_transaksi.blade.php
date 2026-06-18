<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8" />
    <title>History Transaksi - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background: #f0f2f5; margin: 0; padding: 0; }
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
        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-dibayar { background: #d1fae5; color: #065f46; }
        .badge-ditolak { background: #fee2e2; color: #991b1b; }
        .badge-selesai { background: #dbeafe; color: #1e40af; }
    </style>
</head>
<body>
    <div class="flex min-h-screen">
        @include('layouts.sidebar')

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- TOPBAR -->
            <div class="bg-white border-b px-6 py-4 flex items-center justify-between flex-shrink-0">
                <div class="flex items-center gap-4">
                    <div>
                        <h1 class="text-xl font-semibold text-gray-800">History Transaksi</h1>
                        <p class="text-gray-500 text-sm mt-0.5">Kelola dan pantau semua transaksi customer</p>
                    </div>
                </div>
            </div>

            <!-- KONTEN YANG DISCROLL -->
            <div class="flex-1 overflow-y-auto p-6">
                
                <!-- JUDUL HALAMAN (untuk mobile) -->
                <div class="mb-6 lg:hidden">
                    <h1 class="text-2xl font-bold text-gray-800">History Transaksi</h1>
                    <p class="text-gray-500 text-sm mt-1">Kelola dan pantau semua transaksi customer</p>
                </div>
                
                <!-- STATISTIK CARDS -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
                    <div class="stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">TOTAL</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $totalReservasi ?? 0 }}</p>
                            </div>
                            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-receipt text-gray-600"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Reservasi</p>
                    </div>
                    
                    <div class="stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">PENDING</p>
                                <p class="text-2xl font-bold text-yellow-600">{{ $totalPending ?? 0 }}</p>
                            </div>
                            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-clock text-yellow-600"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Menunggu</p>
                    </div>
                    
                    <div class="stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">DIBAYAR</p>
                                <p class="text-2xl font-bold text-green-600">{{ $totalDibayar ?? 0 }}</p>
                            </div>
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Diverifikasi</p>
                    </div>
                    
                    <div class="stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">DITOLAK</p>
                                <p class="text-2xl font-bold text-red-600">{{ $totalDitolak ?? 0 }}</p>
                            </div>
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-times-circle text-red-600"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Gagal</p>
                    </div>
                </div>
                
                <!-- FILTER & SEARCH -->
                <div class="bg-white rounded-xl shadow-sm border p-4 mb-6">
                    <form method="GET" action="{{ route('admin.history-transaksi.index') }}" id="filterForm">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">FILTER TANGGAL</label>
                                <div class="flex gap-2">
                                    <input type="date" name="start_date" value="{{ request('start_date') }}" 
                                           class="px-3 py-2 border rounded-lg text-sm w-full focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                                    <span class="self-center text-gray-400">-</span>
                                    <input type="date" name="end_date" value="{{ request('end_date') }}" 
                                           class="px-3 py-2 border rounded-lg text-sm w-full focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">CARI DATA</label>
                                <div class="flex gap-2">
                                    <input type="text" name="search" value="{{ request('search') }}" 
                                           placeholder="Cari nama customer, email, atau ID booking..." 
                                           class="px-3 py-2 border rounded-lg text-sm flex-1 focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                                    <button type="submit" class="bg-[#16614D] text-white px-4 py-2 rounded-lg text-sm hover:bg-[#0f4a3a]">
                                        Cari
                                    </button>
                                    <a href="{{ route('admin.history-transaksi.index') }}" 
                                       class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300">
                                        Reset
                                    </a>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">FILTER STATUS</label>
                                <select name="status" class="px-3 py-2 border rounded-lg text-sm w-full focus:outline-none focus:ring-2 focus:ring-[#16614D]">
                                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua ({{ $totalReservasi ?? 0 }})</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending ({{ $totalPending ?? 0 }})</option>
                                    <option value="dibayar" {{ request('status') == 'dibayar' ? 'selected' : '' }}>Dibayar ({{ $totalDibayar ?? 0 }})</option>
                                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak ({{ $totalDitolak ?? 0 }})</option>
                                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai ({{ $totalSelesai ?? 0 }})</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="bg-[#16614D] text-white px-6 py-2 rounded-lg text-sm hover:bg-[#0f4a3a]">
                                Terapkan Filter
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- TABEL RESERVASI -->
                <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">NO</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">KODE BOOKING</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">CUSTOMER</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">VILLA TERPILIH</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">TANGGAL CHECK-IN/OUT</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">TOTAL</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">STATUS</th>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($reservasis ?? [] as $index => $reservasi)
                                @php
                                    $nights = \Carbon\Carbon::parse($reservasi->checkin)->diffInDays(\Carbon\Carbon::parse($reservasi->checkout));
                                    $statusClass = $reservasi->status == 'pending' ? 'badge-pending' : ($reservasi->status == 'dibayar' ? 'badge-dibayar' : ($reservasi->status == 'ditolak' ? 'badge-ditolak' : 'badge-selesai'));
                                    $statusIcon = $reservasi->status == 'pending' ? '⏳' : ($reservasi->status == 'dibayar' ? '✓' : ($reservasi->status == 'ditolak' ? '✗' : '✔'));
                                @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ ($reservasis->currentPage() - 1) * $reservasis->perPage() + $loop->iteration }}</td>
                                    <td class="px-6 py-4">
                                        <div class="font-mono text-sm font-medium text-gray-800">#RES-{{ str_pad($reservasi->id, 3, '0', STR_PAD_LEFT) }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $reservasi->user->name ?? 'Unknown' }}</div>
                                        <div class="text-xs text-gray-400">{{ $reservasi->user->email ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $reservasi->villa->nama_villa ?? 'Unknown' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($reservasi->checkin)->format('d/m/Y') }}</div>
                                        <div class="text-xs text-gray-400">s/d {{ \Carbon\Carbon::parse($reservasi->checkout)->format('d/m/Y') }}</div>
                                        <div class="text-xs text-gray-400">({{ $nights }} Malam)</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-800">Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }}">
                                            {{ $statusIcon }} {{ ucfirst($reservasi->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($reservasi->status == 'pending' || $reservasi->status == 'ditolak')
                                        <button onclick="deleteReservasi({{ $reservasi->id }}, '{{ $reservasi->user->name ?? 'Unknown' }}')" 
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs flex items-center gap-1 mx-auto">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                        @else
                                        <span class="text-gray-400 text-xs">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center text-gray-400">
                                        <i class="fas fa-receipt text-4xl mb-3 block"></i>
                                        <p>Belum ada data transaksi</p>
                                        <p class="text-sm mt-1">Transaksi akan muncul setelah customer melakukan booking</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- PAGINATION -->
                    @if(($reservasis ?? []) && $reservasis->total() > 0)
                    <div class="px-6 py-4 border-t flex flex-wrap items-center justify-between gap-4 bg-gray-50">
                        <div class="text-sm text-gray-500">
                            Menampilkan {{ $reservasis->firstItem() ?? 0 }} - {{ $reservasis->lastItem() ?? 0 }} dari {{ $reservasis->total() ?? 0 }} data
                        </div>
                        <div class="flex items-center gap-2">
                            @if($reservasis->onFirstPage())
                                <span class="px-3 py-1 border rounded-lg text-sm text-gray-400 bg-gray-100 cursor-not-allowed">Sebelumnya</span>
                            @else
                                <a href="{{ $reservasis->previousPageUrl() }}" class="px-3 py-1 border rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition">Sebelumnya</a>
                            @endif

                            <span class="px-3 py-1 bg-[#16614D] text-white rounded-lg text-sm">{{ $reservasis->currentPage() }}</span>

                            @if($reservasis->hasMorePages())
                                <a href="{{ $reservasis->nextPageUrl() }}" class="px-3 py-1 border rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition">Selanjutnya</a>
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

    <!-- FORM DELETE RESERVASI -->
    <form id="deleteReservasiForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        // Auto submit filter when status dropdown changes
        const statusSelect = document.querySelector('select[name="status"]');
        if (statusSelect) {
            statusSelect.addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });
        }

        // Delete Reservasi
        function deleteReservasi(id, name) {
            if (confirm(`Apakah Anda yakin ingin menghapus reservasi milik "${name}"?\n\nTindakan ini tidak dapat dibatalkan!`)) {
                const form = document.getElementById('deleteReservasiForm');
                form.action = `/admin/history-transaksi/${id}`;
                form.submit();
            }
        }
    </script>
</body>
</html>