<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Vizitora</title>

    {{-- baru --}}
    <link rel="stylesheet" href="{{asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.addons.css')}}">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/select2.css')}}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css')}}"> --}}
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">
    

    @section('css')

    @show
    {{-- end baru --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">

</head>
<body>
    

    {{-- <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap5.min.css')}}">

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap5.min.js')}}"></script> --}}

    {{-- baru --}}
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
          <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
            <a class="navbar-brand brand-logo" href="#" style="color: #2d2d2d">
              VIZITORA
            </a>
               <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="icon-menu"></span>
              <i class="fa fa-align-justify" style="color: #fff;"></i>
            </button>
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center">
            <ul class="navbar-nav navbar-nav-right">
             
              <li class="nav-item dropdown d-xl-inline-block">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <span class="profile-text">Hello, {{Auth::user()->name}} !</span>
                  @if(Auth::user()->type == 'Admin')
                    <img class="img-xs rounded-circle"  src="{{asset('images/admin.png')}}" alt="profile image">
                  @else
                    <img class="img-xs rounded-circle"  src="{{asset('images/user.png')}}" alt="profile image">
                  @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                  <a class="dropdown-item p-0">
                    <div class="d-flex border-bottom">
                     
                    </div>
                  </a>
                  <a class="dropdown-item" style="margin-top: 20px;" href="{{url('/profile')}}">
                   Edit Profile
                  </a>
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                     Sign Out
    
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                  </a>
                </div>
              </li>
            </ul>
         
          </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
          <!-- partial:partials/_sidebar.html -->
          <nav class=" sidebar-offcanvas sidebar" id="sidebar">
          @section('sidebar')
              @include('sidebar')
          @show
          </nav>
          <div class="main-panel">
            <div class="content-wrapper" >
              @yield('content')
    
            </div>
            <footer class="footer">
              <div class="container-fluid clearfix">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Vizitora - Visitor Management System
                </span>
              </div>
            </footer>
            <!-- partial -->
          </div>
          <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
    {{-- end baru --}}  

    {{-- <script src="{{ asset('js/bootstrap.js') }}"></script> --}}
    <script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('vendors/js/vendor.bundle.addons.js')}}"></script>
    <script src="{{asset('js/off-canvas.js')}}"></script>
    <script src="{{asset('js/misc.js')}}"></script>
    {{-- <script src="{{asset('js/chart.js')}}"></script> --}}
    <script src="{{asset('js/dashboard.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/sweetalert2.all.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.js')}}"></script>
    
    
   
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> --}}
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

    {{-- @include('sweetalert::alert') --}}

    @section('js')

    @show
</body>
</html>