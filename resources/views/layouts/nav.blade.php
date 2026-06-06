<style>
    
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 73px;
        z-index: 1000;
        background-color: #d9d9d9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 40px;
    }

    .navbar-logo {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #4f4c49ff;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        overflow: hidden;
    }

    .logo-text {
        font-family: "Cormorant", serif;
        font-weight: 500;
        font-style: italic;
        color: #ffffff;
        font-size: 18px;
        position: relative;
        display: inline-block;
        letter-spacing: 0.5px;
    }



    .nav-links {
        display: flex;
        gap: 28px;
        align-items: center;
        list-style: none;
    }

    .nav-links a {
        font-family: "Cormorant", serif;
        font-weight: 600;
        color: #3e362e;
        font-size: 13px;
        text-decoration: none;
        opacity: 0.88;
        transition: 0.2s;
    }

    .nav-links a:hover {
        opacity: 1;
        color: #000000;
    }

    .nav-links a.active {
        color: #000000 !important;
        font-weight: 600 !important;
        opacity: 1 !important;
        border-bottom: 2px solid #3e362e;
        padding-bottom: 4px;
    }

    .login-btn-nav {
        background-color: #404040;
        border-radius: 50px;
        padding: 8px 24px;
        color: white !important;
        font-weight: 700;
    }

    .mobile-menu-btn {
        display: none;
        font-size: 22px;
        cursor: pointer;
        color: #3e362e;
        transition: transform 0.3s ease;
    }

    @media (max-width: 768px) {
        .mobile-menu-btn {
            display: block;
            z-index: 1001;
        }

        .mobile-menu-btn.is-active {
            transform: rotate(90deg);
        }

        .nav-links {
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 73px;
            left: 0;
            width: 100%;
            height: auto;
            background-color: #d9d9d9;
            gap: 24px;
            padding: 30px 0 40px 0;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.05);
            opacity: 0;
            transform: translateY(-20px);
            pointer-events: none;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .nav-links.mobile-active {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        .nav-links a {
            font-size: 16px;
        }
    }
</style>

<div class="navbar">
    <div class="navbar-logo">
        <span class="logo-text" data-text="VL">VL</span>
    </div>

    <ul class="nav-links" id="navLinks">
        <li>
            <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">HOME</a>
        </li>
        <li>
            <a href="{{ route('booking.page') }}" class="{{ Request::is('booking*') ? 'active' : '' }}">BOOKING</a>
        </li>
        <li>
            <a href="javascript:void(0)" class="{{ Request::is('about*') ? 'active' : '' }}">ABOUT US</a>
        </li>
        <li>
            <a href="javascript:void(0)" class="login-btn-nav {{ Request::is('login*') ? 'active' : '' }}">LOGIN</a>
        </li>
    </ul>

    <div class="mobile-menu-btn" id="menuBtn" onclick="toggleMenu()">
        <i class="fa-solid fa-bars" id="menuIcon"></i>
    </div>
</div>

<script>
    function toggleMenu() {
        const navLinks = document.getElementById('navLinks');
        const menuBtn = document.getElementById('menuBtn');
        const menuIcon = document.getElementById('menuIcon');

        navLinks.classList.toggle('mobile-active');
        menuBtn.classList.toggle('is-active');

        if (navLinks.classList.contains('mobile-active')) {
            menuIcon.classList.remove('fa-bars');
            menuIcon.classList.add('fa-xmark');
        } else {
            menuIcon.classList.remove('fa-xmark');
            menuIcon.classList.add('fa-bars');
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const links = document.querySelectorAll('.nav-links a');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                const text = this.innerText.trim();
                let target = null;

                // Hanya jalankan smooth scroll jika element target ada di halaman saat ini
                if (text === 'HOME') target = document.getElementById('heroSection');
                if (text === 'ABOUT US') target = document.getElementById('contactSection');

                // Jika sedang berada di halaman booking dan menekan HOME, biarkan link berpindah alami ke '/'
                if ((text === 'HOME' || text === 'ABOUT US') && !target) {
                    return; 
                }

                // Jika menu BOOKING ditekan, biarkan pindah halaman murni tanpa diinterupsi javascript
                if (text === 'BOOKING') {
                    return; 
                }

                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                    const container = document.getElementById('navLinks');
                    const btn = document.getElementById('menuBtn');
                    const icon = document.getElementById('menuIcon');

                    if (container && container.classList.contains('mobile-active')) {
                        container.classList.remove('mobile-active');
                        if (btn) btn.classList.remove('is-active');
                        if (icon) {
                            icon.classList.remove('fa-xmark');
                            icon.classList.add('fa-bars');
                        }
                    }
                }
            });
        });
    });
</script>