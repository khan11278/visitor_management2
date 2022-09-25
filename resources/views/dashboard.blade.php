<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Visitor Management System</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendors/themify-icons/css/themify-icons.css')}}" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="{{asset('assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="{{asset('assets/css/main.min.css')}}" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->

    <!-- Datatable -->
    <link href="{{asset('assets/vendors/DataTables/datatables.min.css')}}" rel="stylesheet" />
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script> --}}
    <!--Custom Css -->
    <link href="{{asset('css/form.css')}}" rel="stylesheet" />

</head>
    @guest
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <h1 class="mt-4 mb-5 text-center">Visitor Management System</h1>

        @yield('content')
    @else

    <body class="fixed-navbar">
        <div class="page-wrapper">
            <!-- START HEADER-->
            <header class="header">
                <div class="page-brand">
                    <a class="link" href="index.html">
                       <h6> <span class="brand">Visitor Management System
                            {{-- <span class="brand-tip"></span> --}}
                        </span>
                    </h6>
                        {{-- <span class="brand-mini">AC</span> --}}
                    </a>
                </div>
                <div class="flexbox flex-1">
                    <!-- START TOP-LEFT TOOLBAR-->
                    <ul class="nav navbar-toolbar">
                        <li>
                            <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                        </li>

                    </ul>

                    <!-- END TOP-LEFT TOOLBAR-->
                    <!-- START TOP-RIGHT TOOLBAR-->
                    <ul class="nav navbar-toolbar">


                        <li class="dropdown dropdown-user">
                            <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                                <img src="{{asset('assets/img/admin-avatar.png')}}" />
                                <span></span> {{ Auth::user()->email }}</a>

                        </li>
                    </ul>
                    <!-- END TOP-RIGHT TOOLBAR-->
                </div>
            </header>
            <!-- END HEADER-->
            <!-- START SIDEBAR-->
            <nav class="page-sidebar" id="sidebar">
                <div id="sidebar-collapse">
                    <div class="admin-block d-flex">
                        <div>
                            {{-- <img src="{{asset('assets/img/admin-avatar.png" width="45px" /> --}}
                            {{-- <div class="d-flex justify-content-start"> --}}

                                <img id="imgPrevie"  class="fieldlabels col-lg-12 col-md-12" height="42px" width="15px" src="{{asset('uploads/'.'1/'.'123.jpg')}}" alt="Preview">


                        {{-- </div> --}}
                        </div>
                        <div class="admin-info">
                            <div class="font-strong"> {{ Auth::user()->name }}</div><small> {{ Auth::user()->type }}</small>
                        </div>
                    </div>
                    <ul class="side-menu metismenu">
                        {{-- <li>
                            <a class="active" href="index.html"><i class="sidebar-item-icon fa fa-th-large"></i>
                                <span class="nav-label">Dashboard</span>
                            </a>
                        </li> --}}
                        <li class="heading">Menu</li>
                        <li>
                            <a href="/information"><i class="sidebar-item-icon fa fa-info-circle"></i>
                                <span class="nav-label">Information</span></a>

                        </li>
                        <li>
                            <a href="/profile"><i class="sidebar-item-icon fa fa-user-secret"></i>
                                <span class="nav-label">Profile</span></i></a>

                        </li>
                        @if(Auth::user()->type == 'Admin')
                        <li>
                            <a href="/settings"><i class="sidebar-item-icon fa fa-cog"></i>
                                <span class="nav-label">Settings</span></i></a>

                        </li>
                        <li>
                            <a href="/sub_user"><i class="sidebar-item-icon fa fa-user-circle"></i>
                                <span class="nav-label">Sub User</span></i></a>

                        </li>
                        <li>
                            <a href="/department"><i class="sidebar-item-icon fa fa-building-o"></i>
                                <span class="nav-label">Departments</span></a>
                        </li>
                        <li>
                            <a href="/employee"><i class="sidebar-item-icon fa fa-users"></i>
                                <span class="nav-label">Employee</span></a>
                        </li>
                        @endif
                        <li>
                            <a href="javascript:;"><i class="sidebar-item-icon fa fa-meetup"></i>
                                <span class="nav-label">Visitor</span><i class="fa fa-angle-left arrow"></i></a>
                            <ul class="nav-2-level collapse">
                                <li>
                                    <a href="/visitor">Visitor Report</a>
                                </li>
                                <li>
                                    <a href="/visitor/info">Visitor Entry</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"><i class="sidebar-item-icon fa fa-sign-out"></i>
                                <span class="nav-label">Logout</span></a>
                        </li>
                        {{-- <li>
                            <a href="icons.html"><i class="sidebar-item-icon fa fa-smile-o"></i>
                                <span class="nav-label">Icons</span>
                            </a>
                        </li> --}}




                    </ul>
                </div>
            </nav>
            <!-- END SIDEBAR-->




            <div class="content-wrapper">
                <main class="mt-2">
                @yield('content')
                </main>
                <!-- END PAGE CONTENT-->
                <footer class="page-footer">
                    <div class="font-13">2022 © <b>Roshan Khan</b> - All rights reserved.</div>
                    {{-- <a class="px-4"
                        href="http://themeforest.net/item/adminca-responsive-bootstrap-4-3-angular-4-admin-dashboard-template/20912589"
                        target="_blank">BUY PREMIUM</a> --}}
                    <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
                </footer>
            </div>
        </div>
        <!-- BEGIN THEME CONFIG PANEL-->

        <!-- END THEME CONFIG PANEL-->
        <!-- BEGIN PAGA BACKDROPS-->
        <div class="sidenav-backdrop backdrop"></div>
        <div class="preloader-backdrop">
            <div class="page-preloader">Loading</div>
        </div>
        <!-- END PAGA BACKDROPS-->
        <!-- CORE PLUGINS-->
        <style>
            .visitors-table tbody tr td:last-child {
                display: flex;
                align-items: center;
            }

            .visitors-table .progress {
                flex: 1;
            }

            .visitors-table .progress-parcent {
                text-align: right;
                margin-left: 10px;
            }
        </style>
        <script src="{{asset('assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/vendors/popper.js/dist/umd/popper.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/vendors/metisMenu/dist/metisMenu.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <!-- PAGE LEVEL PLUGINS-->
        <script src="{{asset('assets/vendors/chart.js/dist/Chart.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js')}}" type="text/javascript"></script>
        <!-- CORE SCRIPTS-->
        <script src="{{asset('assets/js/app.min.js')}}" type="text/javascript"></script>
        <!-- PAGE LEVEL SCRIPTS-->
        <script src="{{asset('assets/js/scripts/dashboard_1_demo.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/vendors/DataTables/datatables.min.js')}}" type="text/javascript"></script>

    @endguest

    </body>

    </html>
