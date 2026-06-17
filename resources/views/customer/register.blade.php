<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Villa Booking</title>
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
        .register-wrapper {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .register-left {
            flex: 1;
            padding: 40px 36px;
            max-width: 420px;
        }
        .register-right {
            flex: 1.2;
            background: #e8ecf0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 520px;
            position: relative;
        }
        .register-right img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }
        .register-left h1 {
            font-size: 26px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 4px;
        }
        .register-left .subtitle {
            color: #888;
            font-size: 13px;
            margin-bottom: 24px;
        }
        .register-left label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #333;
            margin-bottom: 3px;
            letter-spacing: 0.3px;
        }
        .register-left input {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 13px;
            transition: 0.2s;
            background: #fafafa;
            color: #1a1a2e;
            margin-bottom: 12px;
        }
        .register-left input:focus {
            outline: none;
            border-color: #16614D;
            box-shadow: 0 0 0 3px rgba(22, 97, 77, 0.08);
            background: white;
        }
        .register-left input::placeholder {
            color: #aaa;
            font-size: 12px;
        }
        .register-left .btn-register {
            width: 100%;
            padding: 11px;
            background: #16614D;
            color: white;
            font-weight: 600;
            font-size: 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 2px;
        }
        .register-left .btn-register:hover {
            background: #0f4a3a;
        }
        .register-left .terms {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 14px 0 18px 0;
        }
        .register-left .terms input[type="checkbox"] {
            width: 15px;
            height: 15px;
            accent-color: #16614D;
            cursor: pointer;
            flex-shrink: 0;
            margin: 0;
            padding: 0;
        }
        .register-left .terms label {
            font-size: 12px;
            color: #666;
            font-weight: 400;
            margin: 0;
        }
        .register-left .terms a {
            color: #16614D;
            text-decoration: none;
            font-weight: 500;
        }
        .register-left .terms a:hover {
            text-decoration: underline;
        }
        .register-left .login-link {
            text-align: center;
            margin-top: 18px;
            font-size: 13px;
            color: #888;
        }
        .register-left .login-link a {
            color: #16614D;
            text-decoration: none;
            font-weight: 600;
        }
        .register-left .login-link a:hover {
            text-decoration: underline;
        }
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 8px 12px;
            border-radius: 8px;
            margin-bottom: 14px;
            font-size: 12px;
        }
        .alert-error p {
            margin: 0;
        }
        .alert-error p:not(:last-child) {
            margin-bottom: 3px;
        }

        @media (max-width: 768px) {
            .register-wrapper {
                flex-direction: column;
                max-width: 100%;
            }
            .register-left {
                max-width: 100%;
                padding: 28px 20px;
            }
            .register-right {
                min-height: 180px;
                order: -1;
            }
            .register-right img {
                height: 180px;
                position: relative;
            }
        }
    </style>
</head>
<body>

<div class="register-wrapper">
    <!-- KIRI: FORM -->
    <div class="register-left">
        <h1>Get Started Now</h1>
        <p class="subtitle">Create your account to start booking</p>

        @if($errors->any())
            <div class="alert-error">
                @foreach($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('customer.register.submit') }}">
            @csrf

            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter your name" required>

            <label>Username</label>
            <input type="text" name="username" value="{{ old('username') }}" placeholder="Enter your username" required>

            <label>Email address</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>

            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" placeholder="Confirm your password" required>

            <div class="terms">
                <input type="checkbox" name="terms" id="terms" required>
                <label for="terms">I agree to the <a href="#">terms & policy</a></label>
            </div>

            <button type="submit" class="btn-register">Signup</button>
        </form>

        <p class="login-link">
            already have an account? <a href="{{ route('customer.login') }}">Login</a>
        </p>
    </div>

    <!-- KANAN -->
    <div class="register-right">
        <img src="https://images.unsplash.com/photo-1525498128493-380d1990a112?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
             alt="Villa">
    </div>
</div>

</body>
</html>