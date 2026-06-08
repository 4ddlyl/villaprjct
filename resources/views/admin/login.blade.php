<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Villa Booking</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Elegan -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: 'Cormorant Garamond', serif;
        }

        body{
    background-image:
    linear-gradient(
        rgba(0,0,0,0.55),
        rgba(0,0,0,0.55)
    ),
    url("{{ asset('img/g4.jpg') }}");

    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

        .glass-card{
            background: rgba(20,20,20,0.35);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);

            border: 1px solid rgba(255,255,255,0.15);

            border-radius: 24px;

            box-shadow:
            0 15px 40px rgba(0,0,0,0.35);
        }

        .glass-input{
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            color: white;
            transition: .3s;
        }

        .glass-input::placeholder{
            color: rgba(255,255,255,.45);
        }

        .glass-input:focus{
            background: rgba(255,255,255,0.12);
            border-color: #d4af37;
            box-shadow: 0 0 0 3px rgba(212,175,55,.15);
        }

        .login-btn{
            background: #d4af37;
            color: #111;
            transition: .3s;
            letter-spacing: .5px;
        }

        .login-btn:hover{
            background: #e7c65a;
            transform: translateY(-2px);
        }

        .title{
            font-size: 42px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .subtitle{
            letter-spacing: 3px;
            text-transform: uppercase;
            font-size: 12px;
            color: rgba(255,255,255,.75);
        }

        .label{
            color: rgba(255,255,255,.85);
            font-size: 17px;
            font-weight: 500;
        }

        .back-link{
            color: rgba(255,255,255,.7);
            transition: .3s;
        }

        .back-link:hover{
            color: #d4af37;
        }

        .error-box{
            background: rgba(150,0,0,.25);
            border: 1px solid rgba(255,100,100,.2);
            color: white;
        }

        .success-box{
            background: rgba(0,120,70,.25);
            border: 1px solid rgba(0,255,150,.15);
            color: white;
        }
    </style>
</head>

<body class="antialiased">

<div class="min-h-screen flex items-center justify-center p-6">

    <div class="glass-card p-10 w-full max-w-md">

        <div class="text-center mb-10">
            <h1 class="title text-white">
                Admin Panel
            </h1>

            <p class="subtitle mt-2">
                Villa Booking System
            </p>
        </div>

        @if($errors->any())
        <div class="error-box text-sm px-4 py-3 rounded-xl mb-6">
            {{ $errors->first() }}
        </div>
        @endif

        @if(session('success'))
        <div class="success-box text-sm px-4 py-3 rounded-xl mb-6">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="mb-5">
                <label class="block label mb-2">
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    value="{{ old('username') }}"
                    class="w-full px-4 py-3 rounded-xl focus:outline-none glass-input"
                    placeholder="Masukkan username admin"
                    required
                    autofocus
                >
            </div>

            <div class="mb-8">
                <label class="block label mb-2">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="w-full px-4 py-3 rounded-xl focus:outline-none glass-input"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <button
                type="submit"
                class="login-btn w-full py-3 rounded-xl font-semibold text-lg"
            >
                Login sebagai Admin
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="{{ url('/') }}" class="back-link text-sm">
                Kembali ke halaman user
            </a>
        </div>

    </div>

</div>

</body>
</html>