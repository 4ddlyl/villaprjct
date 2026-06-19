<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Dashboard Admin - Villa Booking</title>
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
        .icon-bg {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
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
        .main-content {
            overflow-y: auto;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="flex">
        @include('layouts.sidebar')


        <div class="flex-1 main-content bg-[#f0f2f5]">
            
            <div class="bg-white border-b px-6 py-4 flex items-center justify-between sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <h1 class="text-xl font-semibold text-gray-800">Dashboard</h1>
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
                <!-- HERO SECTION -->
                <div class="relative rounded-2xl overflow-hidden mb-6 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                        alt="Luxury Villa"
                        class="w-full h-36 md:h-40 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#16614D]/80 via-[#16614D]/50 to-transparent"></div>
                    <div class="absolute inset-0 flex flex-col justify-center px-6 md:px-8">
                        <h2 class="text-xl md:text-2xl font-bold text-white">Selamat datang!</h2>
                        <p class="text-white/80 text-sm md:text-base mt-1">Kelola reservasi dan bisnis villa Anda dengan mudah.</p>
                    </div>
                </div>

                <!-- STAT CARDS -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
                    <div class="stat-card">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="text-gray-500 text-xs font-medium">Total Reservasi</div>
                                <div class="text-2xl font-bold mt-1">{{ $totalReservasi ?? 0 }}</div>
                            </div>
                            <div class="icon-bg bg-[#16614D]/10">
                                <svg class="w-4 h-4 text-[#16614D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="text-gray-500 text-xs font-medium">Total Pendapatan</div>
                                <div class="text-base font-bold mt-1 truncate">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</div>
                            </div>
                            <div class="icon-bg bg-[#16614D]/10">
                                <svg class="w-4 h-4 text-[#16614D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="text-gray-500 text-xs font-medium">Menunggu Pembayaran</div>
                                <div class="text-2xl font-bold mt-1">{{ $reservasiMenunggu ?? 0 }}</div>
                                <div class="text-gray-400 text-xs mt-1">Perlu ditindaklanjuti</div>
                            </div>
                            <div class="icon-bg bg-[#16614D]/10">
                                <svg class="w-4 h-4 text-[#16614D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="text-gray-500 text-xs font-medium">Verifikasi Menunggu</div>
                                <div class="text-2xl font-bold mt-1">{{ $verifikasiMenunggu ?? 0 }}</div>
                                <div class="text-gray-400 text-xs mt-1">Menunggu verifikasi</div>
                            </div>
                            <div class="icon-bg bg-[#16614D]/10">
                                <svg class="w-4 h-4 text-[#16614D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="text-gray-500 text-xs font-medium">Total Villa</div>
                                <div class="text-2xl font-bold mt-1">{{ $totalVilla ?? 0 }}</div>
                                <div class="text-green-600 text-xs mt-1">Aktif dan tersedia</div>
                            </div>
                            <div class="icon-bg bg-[#16614D]/10">
                                <svg class="w-4 h-4 text-[#16614D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="text-gray-500 text-xs font-medium">Customer Aktif</div>
                                <div class="text-2xl font-bold mt-1">{{ $customerAktif ?? 0 }}</div>
                            </div>
                            <div class="icon-bg bg-[#16614D]/10">
                                <svg class="w-4 h-4 text-[#16614D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RESERVASI TERBARU + LINE CHART -->
                <div class="bg-white rounded-2xl border p-6 mb-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-semibold text-gray-800">Reservasi Terbaru</h3>
                        <span class="text-xs text-gray-400">7 Hari Terakhir</span>
                    </div>
                    <canvas id="reservasiChart" height="200" style="max-height: 250px;"></canvas>
                </div>

                <!-- TABEL RESERVASI TERBARU -->
                <div class="bg-white rounded-2xl border p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-gray-800">Reservasi Terbaru</h3>
                        <a href="#" class="text-[#16614D] text-sm hover:underline">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="border-b">
                                <tr>
                                    <th class="pb-3 text-left text-xs font-medium text-gray-400">Tamu</th>
                                    <th class="pb-3 text-left text-xs font-medium text-gray-400">Villa</th>
                                    <th class="pb-3 text-left text-xs font-medium text-gray-400">Check-in</th>
                                    <th class="pb-3 text-left text-xs font-medium text-gray-400">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(($reservasiTerbaru ?? []) as $reservasi)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="py-3 text-sm">{{ $reservasi->user->name ?? '-' }}</td>
                                    <td class="py-3 text-sm">{{ $reservasi->villa->nama_villa ?? '-' }}</td>
                                    <td class="py-3 text-sm">{{ \Carbon\Carbon::parse($reservasi->checkin)->format('d M Y') }}</td>
                                    <td class="py-3">
                                        <span class="badge 
                                            @if($reservasi->status == 'dibayar') badge-success
                                            @elseif($reservasi->status == 'pending') badge-warning
                                            @elseif($reservasi->status == 'ditolak') badge-danger
                                            @else bg-gray-100 text-gray-700 @endif">
                                            {{ $reservasi->status == 'dibayar' ? 'Dikonfirmasi' : ($reservasi->status == 'pending' ? 'Menunggu' : ($reservasi->status == 'ditolak' ? 'Dibatalkan' : 'Selesai')) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-gray-400">Belum ada reservasi</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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
        
        const reservasiData = @json($reservasiPerHari ?? []);
        const defaultLabels = ['04 Jun', '05 Jun', '06 Jun', '07 Jun', '08 Jun', '09 Jun', '10 Jun'];
        const defaultValues = [0, 0, 0, 0, 0, 0, 0];

        let labels = defaultLabels;
        let values = defaultValues;

        if (reservasiData.length > 0) {
            labels = reservasiData.map(item => item.tanggal || '');
            values = reservasiData.map(item => item.jumlah || 0);
        }

        const ctx = document.getElementById('reservasiChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Reservasi',
                    data: values,
                    borderColor: '#16614D',
                    backgroundColor: 'rgba(22, 97, 77, 0.05)',
                    borderWidth: 2,
                    pointBackgroundColor: '#16614D',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#e5e7eb' }, ticks: { stepSize: 1 } },
                    x: { grid: { display: false }, ticks: { font: { size: 11 } } }
                }
            }
        });
    </script>
</body>
</html>