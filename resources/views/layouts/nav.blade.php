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

    .login-btn-nav:hover {
        background-color: #2a2a2a;
        color: white !important;
    }

    /* Avatar Dropdown */
    .nav-avatar-wrapper {
        position: relative;
        cursor: pointer;
    }

    .nav-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #4f4c49;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 14px;
        font-family: "Cormorant", serif;
        text-transform: uppercase;
        flex-shrink: 0;
        transition: 0.2s;
        border: 2px solid transparent;
    }

    .nav-avatar:hover {
        border-color: #3e362e;
        transform: scale(1.05);
    }

    .nav-avatar img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .avatar-dropdown {
        position: absolute;
        top: 48px;
        right: 0;
        min-width: 150px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        padding: 8px 0;
        display: none;
        z-index: 999;
        border: 1px solid #e5e5e5;
    }

    .avatar-dropdown.show {
        display: block;
    }

    .dropdown-user {
        padding: 10px 16px;
        border-bottom: 1px solid #f0f0f0;
        font-family: "Cormorant", serif;
        font-size: 13px;
        color: #3e362e;
    }

    .dropdown-user .name {
        font-weight: 600;
        font-size: 14px;
    }

    .dropdown-user .email {
        font-size: 12px;
        color: #888;
        margin-top: 2px;
    }

    .dropdown-logout {
        display: block;
        width: 100%;
        text-align: left;
        padding: 10px 16px;
        background: none;
        border: none;
        font-family: "Cormorant", serif;
        font-size: 13px;
        color: #c0392b;
        cursor: pointer;
        transition: 0.2s;
        font-weight: 600;
    }

    .dropdown-logout:hover {
        background-color: #fdf2f2;
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

        .login-btn-nav {
            width: 80%;
            text-align: center;
        }

        .avatar-dropdown {
            position: fixed;
            top: 73px;
            right: 20px;
            left: auto;
            width: 200px;
        }

        .nav-avatar-wrapper {
            margin: 0;
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
            <a href="{{ route('about.page') }}" class="{{ Request::is('about*') ? 'active' : '' }}">ABOUT US</a>
        </li>
        
        @auth
            <!-- Avatar dengan dropdown -->
            <li class="nav-avatar-wrapper" onclick="toggleDropdown(event)">
                <div class="nav-avatar">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                    @else
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    @endif
                </div>

                <!-- Dropdown -->
                <div class="avatar-dropdown" id="avatarDropdown">
                    <div class="dropdown-user">
                        <div class="name">{{ Auth::user()->name }}</div>
                        <div class="email">{{ Auth::user()->email }}</div>
                    </div>
                    <form action="{{ route('customer.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-logout"> Logout</button>
                    </form>
                </div>
            </li>
        @else
            <li>
                <a href="{{ route('customer.login') }}" class="login-btn-nav {{ Request::is('login*') ? 'active' : '' }}">LOGIN</a>
            </li>
        @endauth
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

    function toggleDropdown(event) {
        event.stopPropagation();
        const dropdown = document.getElementById('avatarDropdown');
        dropdown.classList.toggle('show');
    }

    // Tutup dropdown kalo klik di luar
    document.addEventListener('click', function() {
        const dropdown = document.getElementById('avatarDropdown');
        if (dropdown) {
            dropdown.classList.remove('show');
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        const links = document.querySelectorAll('.nav-links a');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                const text = this.innerText.trim();
                let target = null;

                if (text === 'HOME') target = document.getElementById('heroSection');
                if (text === 'ABOUT US') target = document.getElementById('targetId');

                if ((text === 'HOME' || text === 'ABOUT US') && !target) {
                    return; 
                }

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