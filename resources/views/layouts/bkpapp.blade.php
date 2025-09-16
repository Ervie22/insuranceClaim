<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('assets/auth/logo2.jpg') }}" rel="icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Med * A-Eye') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        
        /* .sidebar {
            min-height: calc(100vh - 56px);
            background-color: #343a40;
            color: white;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1rem;
        }
        
        .sidebar .nav-link:hover {
            color: rgba(255, 255, 255, 1);
        }
        
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        
        .content-wrapper {
            min-height: calc(100vh - 56px);
        }
        
        .dropdown-item-icon {
            margin-right: 8px;
        } */
    </style>
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        @include('layouts.partials.navbar')
        
       

        <main>
            @auth
                <div class="container-fluid">
                    <div class="row">
                        <!-- Sidebar -->
                        <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                            @include('layouts.partials.sidebar')
                           
                        </div>
                        
                        <!-- Main Content -->
                        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content-wrapper">
                            <div class="mt-4">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="container">
                    @yield('content')
                </div>
            @endauth
        </main>
    </div>
</body>
</html>