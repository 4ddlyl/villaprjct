<!-- SIDEBAR -->
<div class="w-[250px] bg-[#16614D] flex flex-col h-screen">

    <div class="px-5 py-6">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-white flex items-center justify-center">
                <span class="text-[#16614D] text-xs font-bold">VL</span>
            </div>
            <div>
                <h2 class="text-white text-sm font-semibold">Luxury Villa Experience</h2>
            </div>
        </div>
    </div>

    <div class="px-3">
        <div class="space-y-1">
            <!-- DASHBOARD -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition {{ request()->routeIs('admin.dashboard') ? 'bg-white text-[#16614D]' : 'text-white/80 hover:bg-white/10' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <!-- KELOLA VILLA -->
            <a href="{{ route('admin.villa') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition {{ request()->routeIs('admin.villa*') ? 'bg-white text-[#16614D]' : 'text-white/80 hover:bg-white/10' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                </svg>
                Kelola Villa
            </a>

            <!-- VERIFIKASI PEMBAYARAN -->
            <a href="{{ route('admin.verifikasi.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition {{ request()->routeIs('admin.verifikasi*') ? 'bg-white text-[#16614D]' : 'text-white/80 hover:bg-white/10' }}">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
    </svg>
    Verifikasi Pembayaran
</a>

            <!-- STATUS CUSTOMER -->
            <a href="{{ route('admin.status-customer.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition {{ request()->routeIs('admin.status-customer*') ? 'bg-white text-[#16614D]' : 'text-white/80 hover:bg-white/10' }}">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
    </svg>
    Status Customer
</a>

            <!-- HISTORY TRANSAKSI -->
            <a href="{{ route('admin.history-transaksi.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.history-transaksi*') ? 'bg-white text-[#16614D]' : 'text-white/80 hover:bg-white/10' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                History Transaksi
            </a>

            <!-- LOGOUT -->
            <form action="{{ route('admin.logout') }}" method="POST" class="pt-1">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-300 hover:bg-white/10 text-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>