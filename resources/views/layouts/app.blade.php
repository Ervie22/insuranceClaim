<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Claim App') }}</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('/assets/auth/claimease.jpg') }}" rel="icon">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary: #0288d1;
            --primary-dark: #0277bd;
            --secondary: #4db6ac;
            --secondary-dark: #00796b;
            --light-bg: #f5f9fc;
            --card-bg: #ffffff;
            --text-dark: #2c3e50;
            --text-light: #7f8c8d;
            --border: #e0e0e0;
            --success: #2ecc71;
            --warning: #f39c12;
            --danger: #e74c3c;
        }

        body {
            background-color: var(--light-bg);
            color: var(--text-dark);
            min-height: 100vh;
        }

        /* Top Navigation */
        .navbar {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: 600;
        }

        .navbar-brand i {
            margin-right: 12px;
            font-size: 28px;
        }

        .navbar-menu {
            display: flex;
            list-style: none;
        }

        .navbar-menu li {
            margin: 0 15px;
            position: relative;
        }

        .navbar-menu a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .navbar-menu a:hover,
        .navbar-menu a.active {
            background: rgba(255, 255, 255, 0.15);
        }

        .navbar-user {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-size: 18px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 500;
            font-size: 14px;
        }

        .user-role {
            font-size: 12px;
            opacity: 0.8;
        }

        /* Main Content */
        .main-content {
            padding: 30px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 28px;
            color: var(--text-dark);
            display: flex;
            align-items: center;
        }

        .page-title i {
            margin-right: 15px;
            color: var(--primary);
            background: rgba(2, 136, 209, 0.1);
            padding: 10px;
            border-radius: 10px;
        }

        .page-actions {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(2, 136, 209, 0.3);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background: rgba(2, 136, 209, 0.1);
        }

        /* Patient List Card */
        .card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .card-header {
            padding: 20px 25px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .card-tools {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 8px 15px 8px 35px;
            border: 1px solid var(--border);
            border-radius: 6px;
            width: 250px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(2, 136, 209, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .entries-select {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .entries-select select {
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            background: white;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            text-align: left;
            padding: 15px 20px;
            background: #f8f9fa;
            border-bottom: 2px solid var(--border);
            color: var(--text-dark);
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .data-table td {
            padding: 15px 20px;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
        }

        .data-table tr {
            transition: all 0.3s;
        }

        .data-table tr:not(:first-child):hover {
            background: #f8f9fa;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background: rgba(46, 204, 113, 0.1);
            color: var(--success);
        }

        .status-insecure {
            background: rgba(243, 156, 18, 0.1);
            color: var(--warning);
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(2, 136, 209, 0.1);
            color: var(--primary);
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }

        .action-btn:hover {
            background: var(--primary);
            color: white;
            transform: scale(1.1);
        }

        /* Table Footer */
        .table-footer {
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8f9fa;
            border-top: 1px solid var(--border);
            font-size: 14px;
        }

        .pagination {
            display: flex;
            gap: 5px;
        }

        .pagination-btn {
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 5px;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
        }

        .pagination-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination-btn:disabled {
            background: #f5f5f5;
            color: #ccc;
            cursor: not-allowed;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .navbar-menu {
                display: none;
            }

            .search-box input {
                width: 200px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0 15px;
            }

            .main-content {
                padding: 20px 15px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .page-actions {
                width: 100%;
                justify-content: space-between;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .card-tools {
                width: 100%;
                justify-content: space-between;
            }

            .search-box input {
                width: 180px;
            }

            .table-footer {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
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