<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Villa Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            background: #f5f7fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }
        .login-wrapper {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .login-left {
            flex: 1;
            padding: 48px 44px;
            max-width: 460px;
        }
        .login-right {
            flex: 1.2;
            background: #e8ecf0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 580px;
            position: relative;
        }
        .login-right img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }
        .login-left h1 {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 6px;
        }
        .login-left .subtitle {
            color: #888;
            font-size: 14px;
            margin-bottom: 28px;
        }
        .login-left label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }
        .login-left input {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: 0.2s;
            background: #fafafa;
            color: #1a1a2e;
            margin-bottom: 16px;
        }
        .login-left input:focus {
            outline: none;
            border-color: #16614D;
            box-shadow: 0 0 0 3px rgba(22, 97, 77, 0.08);
            background: white;
        }
        .login-left input::placeholder {
            color: #aaa;
            font-size: 13px;
        }
        .login-left .btn-login {
            width: 100%;
            padding: 12px;
            background: #16614D;
            color: white;
            font-weight: 600;
            font-size: 15px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 4px;
        }
        .login-left .btn-login:hover {
            background: #0f4a3a;
        }
        .login-left .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }
        .login-left .login-link a {
            color: #16614D;
            text-decoration: none;
            font-weight: 600;
        }
        .login-left .login-link a:hover {
            text-decoration: underline;
        }
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 10px 14px;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 13px;
        }
        .alert-error p {
            margin: 0;
        }
        .alert-error p:not(:last-child) {
            margin-bottom: 4px;
        }
        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
            padding: 10px 14px;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
                max-width: 100%;
            }
            .login-left {
                max-width: 100%;
                padding: 32px 24px;
            }
            .login-right {
                min-height: 200px;
                order: -1;
            }
            .login-right img {
                height: 200px;
                position: relative;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <!-- KIRI: FORM -->
    <div class="login-left">
        <h1>Welcome Back</h1>
        <p class="subtitle">Login to your account</p>

        @if($errors->any())
            <div class="alert-error">
                @foreach($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('customer.login.submit') }}">
            @csrf

            <label>Username or Email</label>
            <input type="text" name="username" value="{{ old('username') }}" placeholder="Enter your username or email" required autofocus>

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <p class="login-link">
            Don't have an account? <a href="{{ route('customer.register') }}">Sign Up</a>
        </p>
    </div>

    <!-- KANAN: GAMBAR -->
    <div class="login-right">
        <img src="https://images.unsplash.com/photo-1525498128493-380d1990a112?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
             alt="Villa">
    </div>
</div>

</body>
</html>