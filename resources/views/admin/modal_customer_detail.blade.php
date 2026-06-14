<div class="space-y-3">
    <div class="flex justify-between border-b pb-2">
        <span class="text-gray-500">Nama Lengkap:</span>
        <span class="font-medium">{{ $customer->name }}</span>
    </div>
    <div class="flex justify-between border-b pb-2">
        <span class="text-gray-500">Email:</span>
        <span class="font-medium">{{ $customer->email }}</span>
    </div>
    <div class="flex justify-between border-b pb-2">
        <span class="text-gray-500">Status:</span>
        <span class="font-medium {{ !$customer->is_banned ? 'text-green-600' : 'text-red-600' }}">
            {{ !$customer->is_banned ? 'Aktif' : 'Diblokir' }}
        </span>
    </div>
    <div class="flex justify-between border-b pb-2">
        <span class="text-gray-500">Bergabung:</span>
        <span class="font-medium">{{ $customer->created_at->format('d/m/Y') }}</span>
    </div>
    <div class="flex justify-between border-b pb-2">
        <span class="text-gray-500">Total Reservasi:</span>
        <span class="font-medium">{{ $totalReservasi }} reservasi</span>
    </div>
    <div class="flex justify-between border-b pb-2">
        <span class="text-gray-500">Total belanja:</span>
        <span class="font-medium">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</span>
    </div>
    
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
            @forelse($customer->reservasis as $reservasi)
            <tr class="border-b">
                <td class="px-3 py-2">{{ \Carbon\Carbon::parse($reservasi->checkin)->format('d/m/Y') }}</td>
                <td class="px-3 py-2">{{ $reservasi->villa->nama_villa ?? '-' }}</td>
                <td class="px-3 py-2">Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</td>
                <td class="px-3 py-2">
                    <span class="px-2 py-1 rounded-full text-xs {{ $reservasi->status == 'dibayar' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ $reservasi->status == 'dibayar' ? 'Dibayar' : 'Pending' }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-3 py-4 text-center text-gray-400">Belum ada reservasi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>