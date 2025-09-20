<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS CDN -->
    <link href="{{ asset('assets/auth/favicon.ico') }}" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(to right, #67C090, #59AC77);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .login-card img {
            width: 60px;
            margin-bottom: 1rem;
        }

        .login-card h4 {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .login-card p {
            font-size: 1rem;
        }

        .form-control {
            border-radius: 0.5rem;
            font-size: 1rem;
        }

        .btn-login {
            background-color: #67C090;
            color: white;
            font-weight: 600;
            border-radius: 0.5rem;
            font-size: 1rem;
        }

        .btn-login:hover {
            background-color: #59AC77;
        }

        .login-links a {
            font-size: 0.9rem;
            margin: 0 0.5rem;
            text-decoration: none;
        }

        .login-links a:hover {
            text-decoration: underline;
        }

        /* Tablet adjustments (768px – 1024px) */
        @media (min-width: 768px) and (max-width: 1024px) {
            .login-card {
                max-width: 600px;
                padding: 3rem;
            }

            .login-card img {
                width: 120px;
                height: 120px;
                margin-bottom: 1.5rem;
            }

            .login-card h4 {
                font-size: 2rem;
            }

            .login-card p {
                font-size: 1.2rem;
            }

            .form-control {
                font-size: 1.2rem;
                padding: 1rem;
            }

            .btn-login {
                font-size: 1.2rem;
                padding: 1rem;
            }

            .login-links a {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>

    <div class="login-card">
        <!-- <img src="{{ asset('/assets/auth/med-logo.png') }}" style="height: 150px; width: 150px;" alt="logo"> -->
        <h4>Login</h4>
        <p>Please enter your details to Login.</p>

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
            @if (session()->has('unverified_user_id'))
            <form method="POST" action="{{ route('verification.send.manual') }}" style="margin-top: 10px;">
                @csrf
                <button type="submit" class="btn btn-sm btn-warning">Resend Verification Email</button>
            </form>
            @endif
        </div>
        @endif

        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="text-start mb-3">
                <label for="username" class="form-label">Username</label>
                <input class="form-control" type="email" id="email" name="email" placeholder="Enter your username" required>
            </div>

            <div class="text-start mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" id="loginButton" class="btn btn-login w-100 mb-3">Login</button>
        </form>

        <!-- <div class="login-links">
            <a href="{{ route('register') }}">Register</a>
            <a href="{{ route('password.request.get') }}">Forgot password?</a>
        </div> -->
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</body>

</html>