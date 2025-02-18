<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Task Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Custom Styles -->
    <style>
        /* General Styles */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f4f7fc;
            font-family: 'Roboto', sans-serif;
            margin: 0;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #18305c, #343a40);
            color: white;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            height: 60px;
            width: 100%;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.4rem;
        }

        .menu-toggle {
            font-size: 1.5rem;
            cursor: pointer;
            color: white;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            width: 240px;
            height: calc(100vh - 60px);
            background: linear-gradient(188deg, #162a3f, #111e35);
            color: white;
            transition: width 0.3s ease, transform 0.3s ease;
            overflow-y: auto;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar.expanded {
            width: 60px;
        }

        .sidebar .nav-link {
            padding: 12px 20px;
            color: white;
            display: flex;
            align-items: center;
            font-size: 1rem;
            transition: background 0.3s ease, padding 0.3s ease;
        }

        .sidebar .nav-link i {
            margin-right: 12px;
            transition: margin 0.3s ease;
        }

        .sidebar.expanded .nav-link i {
            margin-right: 0;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        .sidebar .nav-link.active {
            background-color: rgba(46, 130, 219, 0.31);
            color: #007bff !important;
            font-weight: bold;
            border-radius: 5px;
        }

        .sidebar .nav-text {
            display: inline;
            transition: opacity 0.3s ease;
        }

        .sidebar.expanded .nav-text {
            opacity: 0;
            display: none;
        }

        .nav-link.active i {
            color: #007bff !important;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            margin-right: 10px;
            padding: 20px;
            flex-grow: 1;
            transition: margin-left 0.3s ease;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 70px;
            min-height: calc(100vh - 120px);
        }

        .sidebar.expanded+.main-content {
            margin-left: 80px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

        }

        .card:hover {

            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }

        .card-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 1.5rem;
            margin-bottom: 0;
        }

        .footer {
            height: 40px;
            background: rgb(219, 218, 218);
            text-align: center;
            padding: 10px;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            margin-top: auto;
        }

        .sidebar-header {
            background-color: rgb(32, 59, 87);
            border-bottom: 1px solid #495057;
        }

        .sidebar-header .text-white h5 {
            font-size: 1.2rem;
            font-weight: 600;

        }

        .sidebar-header .text-white p {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .sidebar-header .text-white strong {
            color: #f39c12;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 240px;
                transform: translateX(-240px);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>

    <!-- Page-specific CSS -->
    @yield('styles')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <span class="navbar-brand text-white">
                <a class="nav-link" href="">
                    {{ $appName ?? 'Task Dashboard' }}
                </a>
            </span>
            <span class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></span>
            <div class="dropdown ms-auto">
                <span class="user-dropdown dropdown-toggle text-white d-flex align-items-center" id="userDropdown"
                    data-bs-toggle="dropdown">
                    {{ Auth::user()->name ?? 'User' }}
                    <img src="{{ asset('assets/images/default/default-user.png') }}" alt="User Avatar"
                        class="rounded-circle ms-2" width="35" height="35">
                </span>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route(Auth::user()->role . '.profile') }}">Profile</a></li>
                    <li>
                        <form action="{{ route(Auth::user()->role . '.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header p-3">
            <div class="d-flex align-items-center">
                <div class="text-white">
                    <p class="m-0 small">{{ Auth::user()->email }}</p>
                    <p class="m-0 small"><strong>{{ Auth::user()->role ?? 'N/A' }}</strong></p>
                </div>
            </div>
        </div>
        <ul class="nav flex-column">
            <!-- Dynamic Menu Options -->
            @isset($menuOptions)
                @foreach ($menuOptions as $menu)
                    <li class="nav-item">
                        @if (isset($menu['submenu']))
                            <!-- Main Label with Submenu -->
                            <a class="nav-link" data-bs-toggle="collapse" href="#submenu-{{ $loop->index }}" role="button"
                                aria-expanded="false">
                                <i class="{{ $menu['icon'] ?? 'fas fa-circle' }}"></i>
                                <span class="nav-text">{{ $menu['text'] ?? 'Menu' }}</span>
                                <i class="fas fa-chevron-down ms-auto"></i>
                            </a>
                            <!-- Submenu -->
                            <div class="collapse" id="submenu-{{ $loop->index }}">
                                <ul class="nav flex-column ps-3">
                                    @foreach ($menu['submenu'] as $submenu)
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs($submenu['route'] ?? '') ? 'active' : '' }}"
                                                href="{{ route($submenu['route'] ?? '#') }}">
                                                <i class="{{ $submenu['icon'] ?? 'fas fa-circle' }}"></i>
                                                <span class="nav-text">{{ $submenu['text'] ?? 'Submenu' }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <!-- Single Menu Item -->
                            <a class="nav-link {{ request()->routeIs($menu['route'] ?? '') ? 'active' : '' }}"
                                href="{{ route($menu['route'] ?? '#') }}">
                                <i class="{{ $menu['icon'] ?? 'fas fa-circle' }}"></i>
                                <span class="nav-text">{{ $menu['text'] ?? 'Menu' }}</span>
                            </a>
                        @endif
                    </li>
                @endforeach
            @else
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-circle"></i>
                        <span class="nav-text">No Menu Options</span>
                    </a>
                </li>
            @endisset
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} <a href="{{ url('/') }}">{{ $appName ?? 'Task' }}</a>. All rights reserved.</p>
    </footer>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('menuToggle').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('expanded');
        });
    </script>

    <!-- Page-specific JavaScript -->
    @yield('scripts')
</body>

</html>