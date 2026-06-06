<div class="navbar">
    <div class="navbar-logo">
        <div class="logo-bg">VL</div>
    </div>
    
    <ul class="nav-links" id="navLinks">
        <li>
            <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">HOME</a>
        </li>
        <li>
            <a href="{{ url('/booking') }}" class="{{ Request::is('booking*') ? 'active' : '' }}">BOOKING</a>
        </li>
        <li>
            <a href="{{ url('/about') }}" class="{{ Request::is('about*') ? 'active' : '' }}">ABOUT US</a>
        </li>
        <li>
            <a href="{{ url('/login') }}" class="login-btn-nav {{ Request::is('login*') ? 'active' : '' }}">LOGIN</a>
        </li>
    </ul>
    
    <div class="mobile-menu-btn" onclick="toggleMenu()">☰</div>
</div>