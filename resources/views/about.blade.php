<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>About Us | Luxury Villa Experience</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Kumar+One&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        body {
            background-color: #e7e0da;
            font-family: "Cormorant", serif;
            overflow-x: hidden;
        }

        .tentang-kami {
            background-color: #e7e0da;
            width: 100%;
            max-width: 1440px;
            margin: 0 auto;
            position: relative;
        }

        /* Hero Section */
        .hero-about {
            position: relative;
            width: 100%;
            height: 650px;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=1920') center/cover no-repeat;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: 73px;
        }

        .hero-about h1 {
            font-family: "Cormorant", serif;
            font-weight: 400;
            color: #ffffff;
            font-size: 84px;
        }

        .hero-about p {
            font-family: "Poppins", sans-serif;
            font-weight: 300;
            font-style: italic;
            color: #ffffff;
            font-size: 20px;
            margin-top: 15px;
        }

        /* Owner + Quote Section (2 kolom) */
        .owner-quote-section {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 60px;
            max-width: 1200px;
            margin: 80px auto;
            padding: 0 52px;
        }

        /* Kolom kiri (Owner) */
        .owner-col {
            flex: 1;
            min-width: 280px;
            text-align: center;
        }

        .owner-col img {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: 0 auto;
        }

        .owner-name {
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            font-size: 32px;
            color: #1a1a1a;
            margin-top: 20px;
        }

        .owner-title {
            font-family: "Poppins", sans-serif;
            font-weight: 200;
            font-style: italic;
            font-size: 18px;
            color: #777;
            margin-top: 5px;
        }

        /* Kolom kanan (Quote) */
        .quote-col {
            flex: 1;
            min-width: 280px;
        }

        .quote-col p {
            font-family: "Cormorant", serif;
            font-weight: 300;
            font-style: italic;
            color: #1a1a1a;
            font-size: 32px;
            line-height: 1.4;
        }

        /* Welcome Section dengan background abu-abu */
        .welcome-bg {
            background-color: #d9d9d9;
            padding: 60px 0;
            margin: 40px 0;
        }

        .welcome-section {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 50px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 52px;
        }

        .welcome-text {
            flex: 1;
            min-width: 280px;
        }

        .welcome-text p {
            font-family: "Cormorant", serif;
            font-weight: 300;
            font-style: italic;
            color: #1a1a1a;
            font-size: 28px;
            line-height: 1.5;
        }

        .welcome-image {
            flex: 1;
            min-width: 280px;
        }

        .welcome-image img {
            width: 100%;
            height: auto;
            border-radius: 16px;
            object-fit: cover;
        }

        /* Location Section */
        .location-section {
            text-align: center;
            margin: 80px auto;
            padding: 0 20px;
        }

        .location-section h2 {
            font-family: "Cormorant", serif;
            font-weight: 400;
            font-style: italic;
            color: #1a1a1a;
            font-size: 48px;
            margin-bottom: 30px;
        }

        .location-map {
            max-width: 1000px;
            margin: 0 auto;
            border-radius: 20px;
            overflow: hidden;
        }

        .location-map img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-about {
                height: 380px;
                margin-top: 73px;
            }

            .hero-about h1 {
                font-size: 40px;
            }

            .hero-about p {
                font-size: 16px;
            }

            .owner-quote-section {
                flex-direction: column;
                padding: 0 20px;
                gap: 30px;
            }

            .quote-col p {
                font-size: 24px;
                text-align: center;
            }

            .welcome-section {
                flex-direction: column;
                padding: 0 20px;
            }

            .welcome-text p {
                font-size: 22px;
            }

            .location-section h2 {
                font-size: 32px;
            }
        }
    </style>
</head>

<body>

    <div class="tentang-kami">

        @include('layouts.nav')

        <!-- Hero Section -->
        <div class="hero-about">
            <h1>About Us</h1>
            <p>A brief introduction about us</p>
        </div>

        <!-- Owner + Quote Section (2 KOLOM) -->
        <div class="owner-quote-section">
            <!-- Kolom Kiri: Foto Owner + Nama di bawahnya -->
            <div class="owner-col">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSMHs8IijGQbElzCqzeTlr6Tz-tAAGgA9HXlQ&s" alt="Villa Owner">
                <div class="owner-name">Tsara</div>
                <div class="owner-title">- Villa owner</div>
            </div>

            <!-- Kolom Kanan: Quote -->
            <div class="quote-col">
                <p>"Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et"</p>
            </div>
        </div>

        <!-- Welcome Section dengan background abu-abu -->
        <div class="welcome-bg">
            <div class="welcome-section">
                <div class="welcome-text">
                    <p>Welcome to Luxury Villa, where every corner whispers a story of passion, and every stay becomes part of a timeless legacy.<br><br>Luxury villa — Where a child's dream became your ultimate sanctuary.</p>
                </div>
                <div class="welcome-image">
                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?q=80&w=600" alt="Luxury Villa">
                </div>
            </div>
        </div>

        <!-- Location Section -->
        <div class="location-section">
            <h2>Where yall can find us</h2>
            <div class="location-map">
                <img src="https://screens.cdn.wordwall.net/800/f87f32bea6d143008483954d30c52d00_0" alt="Map Location">
            </div>
        </div>

        @include('layouts.footer')
    </div>

</body>

</html>