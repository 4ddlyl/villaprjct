<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Saya - Villa Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>


<div class="min-h-screen py-10 px-4 md:px-8 bg-gray-50">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">📋 Reservasi Saya</h1>
        
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
        @endif
        
        <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
            @forelse($reservasis as $reservasi)
            <a href="{{ route('customer.reservasi.show', $reservasi->id) }}" class="block border-b hover:bg-gray-50 transition">
                <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <p class="font-semibold text-gray-800">{{ $reservasi->villa->nama_villa }}</p>
                        <p class="text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($reservasi->checkin)->format('d M Y') }} - 
                            {{ \Carbon\Carbon::parse($reservasi->checkout)->format('d M Y') }}
                        </p>
                        <p class="text-sm font-medium text-[#16614D]">Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-right">
                        <span class="status-badge 
                            @if($reservasi->status == 'pending') status-pending
                            @elseif($reservasi->status == 'dibayar') status-paid
                            @else status-rejected @endif">
                            {{ $reservasi->status == 'pending' ? 'Menunggu Pembayaran' : ($reservasi->status == 'dibayar' ? 'Dikonfirmasi' : 'Ditolak') }}
                        </span>
                        <p class="text-xs text-gray-400 mt-1">#RES-{{ str_pad($reservasi->id, 3, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
            </a>
            @empty
            <div class="text-center py-12">
                <i class="fas fa-calendar-alt text-4xl text-gray-300 mb-4 block"></i>
                <p class="text-gray-500">Belum ada reservasi</p>
                <a href="{{ route('booking.page') }}" class="mt-4 inline-block bg-[#16614D] text-white px-6 py-2 rounded-lg hover:bg-[#0f4a3a]">
                    Booking Villa Sekarang
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>


</body>
</html>