<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Claim App') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('/assets/auth/claimease.jpg') }}" rel="icon">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>

<body>
    @auth
    @else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
    @endauth
    @php
    use Illuminate\Support\Facades\Auth;

    @endphp
    @guest
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
    @endguest
    @auth


    @include('layouts.partials.navbar')
    <div class="d-flex">
        <!-- Main content -->
        <div class="flex-grow-1">



            <!-- Page Content -->
            <div class="p-0" style="margin-top: 100px;">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- User Detail Model starts-->

    @endauth

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</body>

</html>