<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Booking Villa | Luxury Villa Experience</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        :root {
            --colorgray-900: #081f32;
            --colorgray-800: #374a59;
            --colorbackgroundlight: #ffffff;
            --white-100: #fafafa;
            --colorprimary-500: #ecfdf3;
            --accent-blue: #068ff7;
        }

        body {
            background-color: #e7e0da;
            font-family: "Cormorant", "DM Sans", serif;
            overflow-x: hidden;
        }

        .hero-banner {
            position: relative;
            width: 100%;
            height: 500px;
            background: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.45)), url('https://images.unsplash.com/photo-1580587771525-78b9dba3b914?q=80&w=1920') center/cover no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0 52px;
            margin-top: 73px;
        }

        .hero-banner h1 {
            font-family: "Cormorant", serif;
            font-weight: 400;
            color: #ffffff;
            font-size: 64px;
            margin-bottom: 15px;
        }

        .hero-banner p {
            font-family: "Cormorant", serif;
            font-weight: 400;
            color: #ffffff;
            font-size: 20px;
            opacity: 0.9;
            max-width: 500px;
        }

        .search-container {
            max-width: 900px;
            margin: -35px auto 40px auto;
            position: relative;
            z-index: 10;
            padding: 0 20px;
        }

        .search-bar {
            background-color: #d9d9d9;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            overflow: hidden;
            flex-wrap: wrap;
        }

        .search-item {
            flex: 1;
            min-width: 180px;
            padding: 14px 18px;
            font-family: "Cormorant", serif;
            font-size: 14px;
            border-right: 1px solid rgba(0, 0, 0, 0.1);
            background-color: #d9d9d9;
        }

        .search-item:last-of-type {
            border-right: none;
        }

        .search-item input,
        .search-item select {
            width: 100%;
            border: none;
            background: transparent;
            font-family: "Cormorant", serif;
            font-size: 14px;
            color: #000;
            outline: none;
        }

        .search-item input::placeholder {
            color: rgba(0, 0, 0, 0.5);
        }

        .search-item select {
            cursor: pointer;
        }

        .search-btn {
            background-color: #068ff7;
            color: #ffffff;
            border: none;
            padding: 14px 35px;
            font-family: "Cormorant", serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .search-btn:hover {
            background-color: #0576cc;
        }

        .category-tabs {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 40px 0 50px 0;
            flex-wrap: wrap;
            padding: 0 20px;
        }

        .tab-btn {
            padding: 10px 30px;
            font-family: "Cormorant", serif;
            font-size: 16px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            background-color: #d9d9d9;
            color: #3e362e;
            border-radius: 50px;
        }

        .tab-btn.active {
            background-color: #068ff7;
            color: #ffffff;
        }

        .main-content {
            max-width: 1300px;
            margin: 0 auto 80px auto;
            padding: 0 20px;
        }

        .villa-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(370px, 1fr));
            gap: 35px;
        }

        .villa-card {
            background-color: var(--colorbackgroundlight);
            border-radius: 22px;
            box-shadow: -6px 8px 30px rgba(48, 58, 79, 0.2);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }

        .villa-card:hover {
            transform: translateY(-5px);
        }

        .card-img-wrapper {
            width: 100%;
            height: 242px;
            position: relative;
            overflow: hidden;
        }

        .card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .villa-card:hover .card-img-wrapper img {
            transform: scale(1.03);
        }

        .card-body {
            padding: 22px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .status-badge {
            font-family: "DM Sans", sans-serif;
            font-size: 12.8px;
            font-weight: 500;
            margin-bottom: 12px;
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            width: fit-content;
        }

        .status-badge.tersedia {
            color: #068ff7;
            background-color: #e6f4ff;
        }

        .status-badge.tidak-tersedia {
            color: #fb0202;
            background-color: #ffe6e6;
        }

        .villa-title {
            font-family: "DM Sans", sans-serif;
            font-weight: 700;
            font-size: 22px;
            color: var(--colorgray-900);
            margin-bottom: 10px;
        }

        .villa-location {
            font-family: "DM Sans", sans-serif;
            font-size: 13px;
            color: #068ff7;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .villa-location i {
            font-size: 12px;
        }

        .villa-info {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            font-family: "DM Sans", sans-serif;
            font-size: 12px;
            color: var(--colorgray-800);
        }

        .villa-info span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .price-tag {
            font-family: "DM Sans", sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--colorgray-900);
            margin-bottom: 20px;
            margin-top: auto;
        }

        .price-tag .unit {
            font-family: "DM Sans", sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .card-footer-action {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .action-btn {
            flex: 1;
            background-color: #068ff7;
            color: #ffffff;
            text-align: center;
            text-decoration: none;
            padding: 11px 0;
            border-radius: 8px;
            font-family: "DM Sans", sans-serif;
            font-weight: 700;
            font-size: 14px;
            transition: background 0.2s;
            border: none;
            cursor: pointer;
        }

        .action-btn:hover {
            background-color: #0576cc;
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 80px 20px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 16px;
            color: var(--colorgray-800);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .result-count {
            text-align: center;
            font-family: "Cormorant", serif;
            font-size: 16px;
            color: #3e362e;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .hero-banner {
                padding: 0 20px;
                height: 380px;
                margin-top: 73px;
            }

            .hero-banner h1 {
                font-size: 36px;
            }

            .hero-banner p {
                font-size: 16px;
            }

            .search-bar {
                flex-direction: column;
                border-radius: 12px;
            }

            .search-item {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            }

            .villa-grid {
                grid-template-columns: 1fr;
                gap: 25px;
            }
        }
    </style>
</head>

<body>

    @include('layouts.nav')

    <div class="hero-banner">
        <h1>Luxury Villa Experience</h1>
        <p>Discover beautiful villas with private pools,<br>stunning views, and unforgettable stays.</p>
    </div>

    <div class="search-container">
        <div class="search-bar">
            <div class="search-item">
                <input type="text" id="searchInput" placeholder="Search by villa name or location...">
            </div>
            <div class="search-item">
                <select id="cityFilter">
                    <option value="all">All areas</option>
                    <option value="bali">Ubud</option>
                    <option value="jakarta">Canggu</option>
                    <option value="bandung">Seminyak</option>
                    <option value="yogyakarta">Uluwatu</option>
                </select>
            </div>
            <button class="search-btn" id="searchBtn">
                <i class="fa-solid fa-search" style="margin-right: 8px;"></i> Search
            </button>
        </div>
    </div>

    <div class="category-tabs">
        <button class="tab-btn active" data-price="all">All Type</button>
        <button class="tab-btn" data-price="available" data-status="tersedia">Available</button>
        <button class="tab-btn" data-price="booked" data-status="tidak tersedia">Booked</button>
    </div>

    <div class="main-content">
        <div class="result-count" id="resultCount"></div>
        <div class="villa-grid" id="villaGrid">
            <!-- Card akan muncul di sini -->
        </div>
    </div>

    @include('layouts.footer')

    <script>
        // Data villa dari database
        const villasData = @json($villas);

        // Variabel filter
        let currentStatusFilter = 'all';
        let currentSearch = '';
        let currentCity = 'all';

        // Fungsi render card villa
        function renderVillas(villas) {
            const grid = document.getElementById('villaGrid');
            const resultCount = document.getElementById('resultCount');

            if (!villas || villas.length === 0) {
                grid.innerHTML = `
                    <div class="empty-state">
                        <i class="fa-solid fa-hotel"></i>
                        <p>No Villas Found</p>
                        <p>Try changing your search criteria or check back later</p>
                    </div>
                `;
                resultCount.innerHTML = '0 villas found';
                return;
            }

            resultCount.innerHTML = `Found ${villas.length} villa${villas.length > 1 ? 's' : ''}`;

            grid.innerHTML = villas.map(villa => {
                const statusClass = villa.status === 'tersedia' ? 'tersedia' : 'tidak-tersedia';
                const statusText = villa.status === 'tersedia' ? 'Tersedia' : 'Tidak tersedia';
                const harga = villa.harga_per_malam || 0;

                // Ambil gambar
                let gambarUrl = 'https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=600';
                if (villa.images && villa.images.length > 0) {
                    gambarUrl = '/storage/' + villa.images[0].image_path;
                }

                return `
                    <div class="villa-card">
                        <div class="card-img-wrapper">
                            <img src="${gambarUrl}" alt="${villa.nama_villa}">
                        </div>
                        <div class="card-body">
                            <div class="status-badge ${statusClass}">${statusText}</div>
                            <h3 class="villa-title">${villa.nama_villa || 'Villa Name'}</h3>
                            <div class="villa-location">
                                <i class="fa-solid fa-location-dot"></i> ${villa.lokasi || 'Location not set'}
                            </div>
                            <div class="villa-info">
                                <span><i class="fa-solid fa-user-group"></i> ${villa.kapasitas || '?'} persons</span>
                                <span><i class="fa-solid fa-bed"></i> ${villa.jumlah_kamar || '?'} rooms</span>
                            </div>
                            <div class="price-tag">
                                Rp ${harga.toLocaleString('id-ID')}<span class="unit">/night</span>
                            </div>
                            <div class="card-footer-action">
    ${villa.status === 'tersedia' 
        ? `<a href="/villa/${villa.id}" class="action-btn">View Details</a>`
        : `<button class="action-btn" style="background-color: #9ca3af; cursor: not-allowed;" disabled>View Details</button>`
    }
</div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // Fungsi filter
        function filterVillas() {
            let filtered = [...villasData];

            // Filter status
            if (currentStatusFilter !== 'all') {
                filtered = filtered.filter(v => v.status === currentStatusFilter);
            }

            // Filter search
            if (currentSearch.trim() !== '') {
                const searchLower = currentSearch.toLowerCase();
                filtered = filtered.filter(v =>
                    (v.nama_villa || '').toLowerCase().includes(searchLower) ||
                    (v.lokasi || '').toLowerCase().includes(searchLower)
                );
            }

            // Filter kota (sederhana)
            if (currentCity !== 'all') {
                filtered = filtered.filter(v =>
                    (v.lokasi || '').toLowerCase().includes(currentCity.toLowerCase())
                );
            }

            renderVillas(filtered);
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Tampilkan semua villa saat halaman dimuat
            filterVillas();

            // Search button
            document.getElementById('searchBtn').addEventListener('click', function() {
                currentSearch = document.getElementById('searchInput').value;
                currentCity = document.getElementById('cityFilter').value;
                filterVillas();
            });

            // Enter key pada search input
            document.getElementById('searchInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    document.getElementById('searchBtn').click();
                }
            });

            // Tab filter
            const tabBtns = document.querySelectorAll('.tab-btn');
            tabBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    tabBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    const status = this.getAttribute('data-status');
                    currentStatusFilter = status || 'all';
                    filterVillas();
                });
            });
        });
    </script>

</body>
</html>