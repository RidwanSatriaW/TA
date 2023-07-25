<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
    <title>Visitor Management System</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- datepicker bootstrap -->
    <link rel="stylesheet" href="bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <script src="bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js"></script>

</head>
<body>
    
    @guest

    <h1 class="mt-4 mb-5 text-center">Visitor Management System</h1>

    @yield('content')

    @else

    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap5.min.css')}}">

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap5.min.js')}}"></script>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Vizitora</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="#">Welcome, {{ Auth::user()->name }}</a>
            </div>
        </div>
    </header>
    {{-- @include('sidebar') --}}
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}" aria-current="page" href="/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'profile' ? 'active' : '' }}" aria-current="page" href="/profile">Profile</a>
                        </li>
                        @if(Auth::user()->type == 'Admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'sub_user' ? 'active' : '' }}" aria-current="page" href="/sub_user">Sub User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'department' ? 'active' : '' }}" aria-current="page" href="/department">Department</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'employee' ? 'active' : '' }}" aria-current="page" href="/employee">Employee</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'keperluan' ? 'active' : '' }}" aria-current="page" href="/keperluan">Necessity</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'employee_available' ? 'active' : '' }}" aria-current="page" href="/employee_available">Employee Available</a>
                        </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'visitor' ? 'active' : '' }}" href="/visitor">Visitor</a>
                        </li>

                        @if(Auth::user()->type == 'Admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'report' ? 'active' : '' }}" href="/report">Report</a>
                        </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                        </li>

                    </ul>

                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!--<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">!-->

                @yield('content')

                <!--</div>!-->
            </main>
        </div>
    </div>    

    @endguest

    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>