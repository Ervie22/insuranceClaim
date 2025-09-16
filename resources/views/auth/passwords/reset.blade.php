<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Password Reset</title>
    <link href="{{ asset('assets/auth/favicon.ico') }}" rel="icon">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(to right, #7769F2, #8657F5);
            /* height: 100vh; */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        label.form-label {
            text-align: left !important;
            display: block;
        }

        .login-card {
            background: white;
            padding: 1rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            max-width: 1000px;
            width: 100%;
            text-align: center;
        }

        .login-card img {
            width: 60px;
            margin-bottom: 1rem;
        }

        .login-card h2 {
            font-weight: bold;
        }

        .form-control {
            border-radius: 0.5rem;
        }

        .btn-login {
            background-color: #4D3DF6;
            color: white;
            font-weight: 600;
            border-radius: 0.5rem;
        }

        .btn-login:hover {
            background-color: #3b2be1;
        }

        .login-links a {
            font-size: 0.9rem;
            margin: 0 0.5rem;
            text-decoration: none;
        }

        .login-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body style="min-height:100vh; display:flex; justify-content:center; align-items:center;">


    <div class="login-card" style="width:50%; max-width:700px;">
        <img src=" {{ asset('/assets/auth/med-logo.png') }}" style="height: 150px; width: 150px;" alt="logo">
        <h4 class="mt-3">Password Reset</h4>
        <!-- <p>Enter your email to reset your password.</p> -->


        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
        <form method="POST" action="{{ route('password.save.reset') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-start">{{ __('Email Address') }}</label>

                <div class="col-md-12">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-md-3 col-form-label text-md-start">{{ __('Password') }}</label>

                <div class="col-md-12">
                    <input id="password" type="password" onchange="checkPassword()" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">


                    <div class="text-danger error-message" id="password-error"></div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="password-confirm" class="col-md-5 col-form-label text-md-start">{{ __('Confirm Password') }}</label>

                <div class="col-md-12">
                    <input id="password-confirm" onchange="confirmPassword()" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="text-danger error-message" id="confirm-password-error"></div>
            </div>

            <div class="row mb-0">
                <div class="">
                    <button type="submit" id="reset-button" class="btn btn-primary">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </div>
        </form>
        <!-- <form method="POST" action="{{ route('password.send.email') }}">
                @csrf

                <div class="mb-3 text-start">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-login w-60 mb-3">Send Reset Link</button>
            </form> -->

        <a href="{{ route('login') }}" class="text-decoration-none">Back to Login</a>

    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    function checkPassword() {
        const password = $('#password').val();
        if (password.length < 8) {
            $('#password-error').text('Password must be at least 8 characters.');
            $('#reset-button').prop('disabled', true); // Disable button
        } else {
            $('#password-error').text('');
            $('#reset-button').prop('disabled', false); // Enable button
        }
    }


    function confirmPassword() {
        const password = $('#password').val();
        const confirmPassword = $('#password-confirm').val();
        // alert(password + ' ' + confirmpassword);
        if (password !== confirmPassword) {
            $('#confirm-password-error').text('Passwords do not match.');
            $('#reset-button').prop('disabled', true);

        } else {
            $('#confirm-password-error').text('');
            $('#reset-button').prop('disabled', false); // Enable button
        }
    }
</script>

</html>