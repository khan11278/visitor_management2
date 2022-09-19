<!DOCTYPE html>
<html>
<head>
    <title>Visitor Management System in Laravel</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    {{-- <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />

    <script src="{{asset('js/form.js')}}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css" />

    {{-- 13-sep-2022  --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css.map">
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js.map"></script> --}}

    <meta charset=utf-8 />
</head>
<body>

    @guest
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <h1 class="mt-4 mb-5 text-center">Visitor Management System</h1>

    @yield('content')

    @else

    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap5.min.css')}}">
    {{-- ///////// --}}
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
    {{-- /////// --}}
    {{-- <script src="{{asset('js/jquery.js')}}"></script> --}}
    {{-- <script src="{{asset('js/jquery.dataTables.min.js')}}"></script> --}}
    {{-- <script src="{{asset('js/dataTables.bootstrap5.min.js')}}"></script> --}}
    {{-- ////////// --}}
    {{-- <script src="{{asset('js/dataTables.bootstrap5.min.js')}}"></script> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    {{-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> --}}

    {{-- //////////// --}}

    <header class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <div class="d-flex justify-content-start">
            {{-- <div class="m-2"> --}}
                <img id="imgPrevie"  class="fieldlabels col-lg-6 col-md-6" height="40" src="{{asset('uploads/'.'1/'.'123.jpg')}}" alt="Preview">
            {{-- </div> --}}
                <a class="navbar-brand col-md-4 col-lg-auto me-0 px-3"  href="#">Visitor Management</a>
        </div>
        {{-- <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> --}}
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="#">Welcome, {{ Auth::user()->email }}</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'information' ? 'active' : '' }}"   aria-current="page" href="/information">Information</a>
                            <hr style="margin:0px 0px;padding:1px 1px;">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'profile' ? 'active' : '' }}" aria-current="page" href="/profile">Profile</a>
                            <hr style="margin:0px 0px; padding:1px 1px;">
                        </li>
                        @if(Auth::user()->type == 'Admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'settings' ? 'active' : '' }}" aria-current="page" href="/settings">Settings</a>
                            <hr style="margin:0px 0px; padding:1px 1px;">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'sub_user' ? 'active' : '' }}" aria-current="page" href="/sub_user">Sub User</a>
                            <hr style="margin:0px 0px; padding:1px 1px;">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'department' ? 'active' : '' }}" aria-current="page" href="/department">Department</a>
                            <hr style="margin:0.2px 0px; padding:1px 1px;">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'employee' ? 'active' : '' }}" aria-current="page" href="/employee">Employee</a>
                            <hr style="margin:0px 0px; padding:1px 1px;">
                        </li>
                        @endif

                       {{--  --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Visitor</a>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="/visitor">Visitor Report</a>
                              <a class="dropdown-item" href="/visitor/info">Visitor Entry</a>
                              {{-- <a class="dropdown-item" href="#">Link 3</a> --}}
                            </div>
                            <hr style="margin:0px 0px; padding:1px 1px;">
                          </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'visitor' ? 'active' : '' }}" href="/visitor">Visitor</a>

                            <hr style="margin:0px 0px; padding:1px 1px;">

                        </li> --}}
                      {{--  --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                            <hr style="margin:0px 0px; padding:1px 1px;">
                        </li>

                    </ul>

                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 datatable_margin">
                <!--<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">!-->
                    {{-- <h2 class="mt-3">Analytics</h2> --}}
                @yield('content')

                <!--</div>!-->
            </main>
        </div>
    </div>

    @endguest

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    @if(request()->segment(1)!='login' && request()->segment(1)!='')
    <footer class="footer1" style="text-align: center;">
        {{-- <hr> --}}
        <p>Visitor Management System
            &copy; Copyright 2022 Roshan Khan
        </p>
      </footer>
      @endif
</body>
</html>
