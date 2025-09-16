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
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="{{asset('/sidebar/css/style.css')}}"> -->

    <!-- In the <head> section -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">



    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body>
    <div id="app">


        @php
        use Illuminate\Support\Facades\Auth;

        @endphp

        <main>
            @guest
            <script>
                window.location.href = "{{ route('login') }}";
            </script>
            @endguest
            @auth
            <div class="container-fluid">
                <div class="wrapper d-flex align-items-stretch">
                    <nav id="sidebar">
                        <!-- <div class="custom-menu">
                            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                                <i class="fa fa-bars"></i>
                                <span class="sr-only">Toggle Menu</span>
                            </button>
                        </div> -->
                        <div class="p-4 ">
                            <h6>
                                <strong>Med*A-Eye Tech</strong>
                            </h6>
                            <hr>
                            <ul class="list-unstyled components mb-5">
                                @if(Auth::user()->roles == "admin")
                                <li>
                                    <a href="/admin-dashboard">Admin Home</a>
                                </li>
                                <li>
                                    <a href="/admin-user-management">Manage Users</a>
                                </li>
                                <li>
                                    <a href="/admin-file-management">File Management</a>
                                </li>
                                <li>
                                    <a href="/admin-system-management">Systems</a>
                                </li>
                                @else
                                <li class="active">
                                    <a href="/user-dashboard">User Home</a>
                                    <!-- <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a> -->
                                    <!-- <ul class="collapse list-unstyled" id="homeSubmenu">
                                        <li>
                                            <a href="#">Home 1</a>
                                        </li>
                                        <li>
                                            <a href="#">Home 2</a>
                                        </li>
                                        <li>
                                            <a href="#">Home 3</a>
                                        </li>
                                    </ul> -->
                                </li>
                                <li>
                                    <a href="/user-view-history">View History</a>
                                </li>
                                <li>
                                    <a href="/user-add-credit">Add Credits</a>
                                </li>
                                <li>
                                    <a href="/user-account">My Account</a>
                                </li>
                                <li>
                                    <a href="/user-upload-files">Upload Files</a>
                                </li>
                                <li>
                                    <a href="/user-view-results">View Results</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </nav>

                    <!-- Page Content  -->
                    <!-- Full height wrapper -->
                    <div id="content" class="d-flex flex-column flex-grow-1">

                        <!-- Top Bar -->
                        <div class="row text-white align-items-center justify-content-between" style="height:50px; background-color:#8A6FCF;">
                            <div class="col-auto ml-5">
                                <h6>
                                    Welcome {{ Auth::user()->first_name }} {{ isset(Auth::user()->last_name) ? Auth::user()->last_name:'' }}
                                </h6>
                            </div>
                            <div class="col-auto d-flex align-items-center text-white gap-3">
                                <a href="#" title="Notifications" class="btn btn-outline-secondary">🔔</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" title="Logout" class="btn btn-danger">
                                        <i class="fa-solid fa-power-off"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Scrollable Content Area -->
                        <div class="container-fluid flex-grow-1 overflow-auto">
                            @yield('content')
                        </div>

                        <!-- Sticky Footer -->
                        <div class="row text-white text-center align-items-center justify-content-between" style=" background-color:#8A6FCF;">
                            <p>&copy; 2025 Med * A-Eye . All rights reserved.</p>
                            <p><strong>Disclaimer:</strong> This application is not a substitute for professional medical advice, diagnosis, or treatment. Always consult a registered medical professional for any health-related concerns.</p>
                        </div>

                    </div>


                </div>
            </div>
            @endauth
        </main>


    </div>
    <script src="{{asset('/sidebar/js/jquery.min.js')}}"></script>
    <script src="{{asset('/sidebar/js/popper.js')}}"></script>
    <script src="{{asset('/sidebar/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/sidebar/js/main.js')}}"></script>
    <!-- Before the closing </body> tag -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</body>


</html>