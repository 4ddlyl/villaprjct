<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Luxury Villa </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300..700;1,300..700&family=Kumar+One&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        body {
            background-color: #e7e0da;
            font-family: "Cormorant", system-ui, -apple-system, sans-serif;
            overflow-x: hidden;
            min-width: 320px;
        }

        .HOME {
            background-color: #e7e0da;
            width: 100%;
            max-width: 1440px;
            margin: 0 auto;
            position: relative;
            padding-top: 73px;
        }

        .hero-section {
            position: relative;
            width: 100%;
            height: 80vh;
            min-height: 500px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
        }

        .hero-section .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 120%;
            object-fit: cover;
            z-index: 1;
            will-change: transform;
            transform: translateY(0);
        }

        .hero-section::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.25);
            z-index: 2;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            padding: 0 20px;
            animation: heroFadeInUp 1.2s ease-out;
        }

        @keyframes heroFadeInUp {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-section .text-wrapper {
            font-family: "Cormorant", serif;
            font-weight: 400;
            color: #ffffff;
            font-size: 48px;
        }

        .hero-section .div {
            font-family: "Cormorant", serif;
            font-weight: 400;
            color: #fff9f4;
            font-size: 48px;
            margin-top: 5px;
        }

        .hero-section .discover-beatiful {
            font-family: "Cormorant", serif;
            font-weight: 400;
            color: #ffffff;
            font-size: 16px;
            margin: 15px auto 25px;
            max-width: 600px;
        }

        .hero-section .book-btn {
            display: inline-block;
            background-color: #303030;
            color: #ffffff;
            font-family: "Kumar One", display;
            font-size: 10px;
            text-decoration: none;
            padding: 8px 30px;
            border-radius: 50px;
            transition: 0.3s;
        }

        .hero-section .book-btn:hover {
            background-color: #2b2520;
            transform: scale(1.05);
        }

        .section-container {
            width: 90%;
            max-width: 1200px;
            margin: 60px auto;
        }

        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s cubic-bezier(0.2, 0.9, 0.4, 1.1), transform 0.8s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }

        .reveal-on-scroll.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        .service-item,
        .villa-gallery img,
        .step-card {
            transition-delay: 0.1s;
        }

        .section-title-line {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            font-family: "Cormorant", serif;
            font-weight: 700;
            font-size: 26px;
            color: #303030;
            text-align: center;
            margin-bottom: 25px;
        }

        .section-title-line::before,
        .section-title-line::after {
            content: "";
            flex: 1;
            height: 1px;
            background-color: #3e362e;
            opacity: 0.3;
        }

        .services-panel {
            background: #d9d9d9;
            border-radius: 20px;
            padding: 30px;
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 30px;
        }

        .service-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            flex: 1;
            min-width: 220px;
            gap: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .service-item:hover {
            transform: translateY(-8px);
        }

        .service-icon {
            width: 50px;
            height: 50px;
            background: #3e362e;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .service-title {
            font-family: "Cormorant", serif;
            font-weight: 700;
            color: #3e362e;
            font-size: 18px;
        }

        .service-desc {
            font-family: "Cormorant", serif;
            font-weight: 400;
            color: #4e443b;
            font-size: 14px;
            max-width: 240px;
            line-height: 1.4;
        }

        .villa-gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
            background: #d9d9d9;
            border-radius: 24px;
            padding: 30px;
        }

        .villa-gallery img {
            width: 100%;
            max-width: 340px;
            height: 220px;
            border-radius: 16px;
            object-fit: cover;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            cursor: pointer;
        }

        .villa-gallery img:hover {
            transform: scale(1.03);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .step-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
        }

        .step-card {
            flex: 1;
            min-width: 230px;
            max-width: 265px;
            background-color: #d9d9d9;
            border-radius: 25px;
            padding: 25px 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .step-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        .step-number {
            font-family: "Cormorant", serif;
            font-weight: 400;
            color: #000000;
            font-size: 54px;
            line-height: 1;
            margin-bottom: 12px;
        }

        .step-text {
            font-family: "Cormorant", serif;
            font-weight: 400;
            color: #000000;
            font-size: 20px;
            line-height: 1.3;
        }

        .contact-section {
            width: 100%;
            background-color: #d9d9d9;
            padding: 70px 20px;
            text-align: center;
            margin-top: 80px;
        }

        .frame-6 {
            max-width: 650px;
            margin: 0 auto;
        }

        .pricing-plans {
            font-family: 'Cormorant', serif;
            font-weight: 700;
            color: #3e362e;
            font-size: 38px;
            margin-bottom: 16px;
        }

        .yall-can-contact-us {
            font-family: "Cormorant", serif;
            font-weight: 400;
            color: #4f463c;
            font-size: 17px;
            line-height: 1.6;
            margin-bottom: 32px;
        }

        .div-wrapper {
            display: inline-block;
            background-color: #12141d;
            border-radius: 50px;
            padding: 14px 45px;
            cursor: pointer;
            transition: 0.3s;
        }

        .div-wrapper:hover {
            background-color: #242838;
            transform: translateY(-2px);
        }

        .text-wrapper-20 {
            font-family: "Cormorant", serif;
            font-weight: 600;
            color: #fafafa;
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .hero-section .text-wrapper {
                font-size: 32px;
            }

            .hero-section .div {
                font-size: 32px;
            }

            .hero-section .discover-beatiful {
                font-size: 14px;
            }

            .section-title-line {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="HOME">

        @include('layouts.nav')

        <div class="hero-section" id="heroSection">
            <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?q=80&w=1920" alt="hero background" class="hero-bg" id="parallaxBg">
            <div class="hero-content">
                <div class="text-wrapper">WELCOME TO</div>
                <div class="div">Luxury Villa Experience</div>
                <p class="discover-beatiful">Discover beautiful villas with private pools, stunning views, and unforgettable</p>
                <a href="{{ route('booking.page') }}" class="book-btn">Book now!</a>
            </div>
        </div>

        <div class="section-container reveal-on-scroll" id="serviceSection">
            <div class="section-title-line">Our Service</div>
            <div class="services-panel">
                <div class="service-item">
                    <div class="service-icon">
                        <i class="fa-solid fa-hotel" style="color: white; font-size: 22px;"></i>
                    </div>
                    <div class="service-title">Family Stay</div>
                    <div class="service-desc">Villa nyaman untuk keluarga &amp; rombongan</div>
                </div>
                <div class="service-item">
                    <div class="service-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="4" width="18" height="18" rx="2" stroke="white" stroke-width="1.5" />
                            <path d="M8 2V6M16 2V6" stroke="white" stroke-width="1.5" />
                            <path d="M3 10H21" stroke="white" stroke-width="1.5" />
                        </svg>
                    </div>
                    <div class="service-title">Villa Booking</div>
                    <div class="service-desc">Cari &amp; booking villa terbaik dengan mudah</div>
                </div>
                <div class="service-item">
                    <div class="service-icon">
                        <i class="fa-solid fa-person-swimming" style="color: white;"></i>
                    </div>
                    <div class="service-title">Private Pool Villa</div>
                    <div class="service-desc">Pilih villa eksklusif dengan private pool</div>
                </div>
            </div>
        </div>

        <div class="section-container reveal-on-scroll" id="villaSection">
            <div class="section-title-line">Villa The Star</div>
            <div class="villa-gallery">
                <img src="{{ asset('img/g1.jpg')}} " alt="villa 1">
                <img src="{{ asset('img/g2.jpg')}} " alt="villa 1">
                <img src="{{ asset('img/g3.jpg')}} " alt="villa 1">
            </div>
        </div>

        <div class="section-container reveal-on-scroll" id="stepSection">
            <div class="section-title-line">Step Process Content</div>
            <div class="step-cards">
                <div class="step-card">
                    <div class="step-number">01</div>
                    <div class="step-text">Choose Villa and Dates</div>
                </div>
                <div class="step-card">
                    <div class="step-number">02</div>
                    <div class="step-text">Fill Out Booking Form</div>
                </div>
                <div class="step-card">
                    <div class="step-number">03</div>
                    <div class="step-text">Transfer and Upload Proof</div>
                </div>
                <div class="step-card">
                    <div class="step-number">04</div>
                    <div class="step-text">Waiting for approval from admin</div>
                </div>
            </div>
        </div>

        <div class="contact-section reveal-on-scroll" id="contactSection">
            <div class="frame-6">
                <div class="pricing-plans">Yall get any problem?</div>
                <p class="yall-can-contact-us">Yall can contact us, we will be ready to respond in a timely manner,<br>thank you for your attention and sorry if there is a little disturbance and confusion</p>
                <div class="div-wrapper">
                    <a href="https://wa.me/6289999999999?text=Halo%20saya%20ingin%20bertanya%20tentang%20villa"
                        target="_blank"
                        class="text-wrapper-20"
                        style="text-decoration: none; color: white;">
                        Contact us
                    </a>
                </div>
            </div>
        </div>

        @include('layouts.footer')

    </div>

    <script>
        (function() {
            const parallaxBg = document.getElementById('parallaxBg');
            const heroSection = document.getElementById('heroSection');

            if (parallaxBg && heroSection) {
                window.addEventListener('scroll', function() {
                    const scrollPosition = window.pageYOffset;
                    const heroOffset = heroSection.offsetTop;
                    const heroHeight = heroSection.offsetHeight;

                    let distance = scrollPosition - heroOffset;

                    if (distance < 0) distance = 0;
                    if (distance > heroHeight * 0.5) distance = heroHeight * 0.5;

                    const yOffset = distance * 0.45;
                    parallaxBg.style.transform = `translateY(${yOffset}px)`;
                });
            }

            const revealElements = document.querySelectorAll('.reveal-on-scroll');
            const observerOptions = {
                threshold: 0.15,
                rootMargin: '0px 0px -50px 0px'
            };

            const revealObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            revealElements.forEach(el => {
                revealObserver.observe(el);
            });

            const serviceItems = document.querySelectorAll('.service-item');
            const villaImages = document.querySelectorAll('.villa-gallery img');
            const stepCards = document.querySelectorAll('.step-card');

            function applyStaggerDelay(elements, baseDelay = 0.1) {
                elements.forEach((el, index) => {
                    el.style.transitionDelay = `${baseDelay + (index * 0.1)}s`;
                });
            }

            applyStaggerDelay(serviceItems, 0.1);
            applyStaggerDelay(villaImages, 0.15);
            applyStaggerDelay(stepCards, 0.12);

            setTimeout(() => {
                revealElements.forEach(el => {
                    const rect = el.getBoundingClientRect();
                    const windowHeight = window.innerHeight;
                    if (rect.top < windowHeight - 100) {
                        el.classList.add('revealed');
                        revealObserver.unobserve(el);
                    }
                });
            }, 200);

            console.log('Parallax & Scroll Reveal animations enabled');
        })();
    </script>
</body>

</html>