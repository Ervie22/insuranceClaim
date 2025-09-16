<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
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

<body>

    <div class="login-card " style="margin-top:100px; width:40%">
        <img src="{{ asset('/assets/auth/med-logo.png') }}" style="height: 150px; width: 150px; " alt="logo">

        <p>Please click below button to verify your email.</p>

        <form id="save_email_verfy" method="POST" action="{{ route('verification.save.verify') }}">
            @csrf

            <input type="hidden" name="user_id" id="user_id" value="{{ $id }}">

            <button type="submit" class="btn btn-login w-25 mb-3">Verify Email</button>
        </form>



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


</html>