<style>
    .footer {
        background-color: #404040;
        padding: 60px 20px 30px;
    }

    .footer .frame {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: flex-start;
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer .heading {
        font-family: "Cormorant", serif;
        font-weight: 700;
        color: #fafafa;
        font-size: 30px;
        margin-bottom: 15px;
    }

    .footer .text-wrapper-16 {
        font-family: "Cormorant", serif;
        font-weight: 400;
        color: #b8b2b2;
        font-size: 14px;
        line-height: 1.6;
        max-width: 300px;
    }

    .footer .text-wrapper-17 {
        font-family: "Cormorant", serif;
        font-weight: 600;
        color: #fafafa;
        font-size: 18px;
        margin-bottom: 16px;
    }

    .footer .text-wrapper-18,
    .footer .text-wrapper-19 {
        font-family: "Cormorant", serif;
        font-weight: 400;
        color: #b8b2b2;
        font-size: 14px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: 0.2s;
    }

    .footer .text-wrapper-18:hover,
    .footer .text-wrapper-19:hover {
        color: #ffffff;
    }

    .footer .text-wrapper-18 a,
    .footer .text-wrapper-19 a {
        color: #b8b2b2;
        text-decoration: none;
        transition: 0.2s;
        display: block;
    }

    .footer .text-wrapper-18 a:hover,
    .footer .text-wrapper-19 a:hover {
        color: #ffffff;
    }

    .social-icons {
        margin-top: 25px;
        display: flex;
        gap: 18px;
    }

    .social-icons a {
        color: #b8b2b2;
        font-size: 20px;
        transition: 0.3s;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .footer .frame {
            flex-direction: column;
            gap: 30px;
        }
        .social-icons {
            justify-content: center;
        }
    }
</style>

<footer class="footer">
    <div class="frame">
        <div>
            <div class="heading">Luxury Villa Experience</div>
            <p class="text-wrapper-16">The purpose of a FAQ is generally to provide information on frequent questions or concerns.</p>
            <div class="social-icons">
                <a href="#" target="_blank" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#b8b2b2'"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#" target="_blank" onmouseover="this.style.color='#1877F2'" onmouseout="this.style.color='#b8b2b2'"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" target="_blank" onmouseover="this.style.color='#E1306C'" onmouseout="this.style.color='#b8b2b2'"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" target="_blank" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#b8b2b2'"><i class="fa-brands fa-github"></i></a>
            </div>
        </div>

        <div>
            <div class="text-wrapper-17">Company</div>
            <div class="text-wrapper-18"><a href="{{ url('/') }}">Home</a></div>
            <div class="text-wrapper-19"><a href="{{ route('booking.page') }}">Booking</a></div>
            <div class="text-wrapper-19"><a href="{{ route('about.page') }}">About us</a></div>
        </div>

        <div>
            <div class="text-wrapper-17">Contact Us</div>
            <div class="text-wrapper-18"><a href="mailto:Villaku@gmail.com">Villaku@gmail.com</a></div>
            <div class="text-wrapper-19"><a href="tel:089999999999">089999999999</a></div>
        </div>
    </div>

    <div style="width: 100%; max-width: 1240px; margin: 40px auto 20px; border-top: 1px solid #5e5e5e;"></div>
    <p style="font-family: 'Epilogue', sans-serif; font-weight: 400; color: #fafafa; font-size: 14px; text-align: center;">© Copyright 2026, All Rights Reserved</p>
</footer>