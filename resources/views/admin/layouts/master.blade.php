@php use Illuminate\Support\Facades\Storage; @endphp
    <!DOCTYPE html>
<html lang="{{ Str::replace('_', '-', App::getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(Storage::url($settings->favicon)) }}"/>
    <title>
        @yield('title')
    </title>
    <link rel="stylesheet" href="{{ asset('back/node_modules/morrisjs/morris.css') }}"/>
    <link rel="stylesheet" href="{{ asset('back/node_modules/toast-master/css/jquery.toast.css') }}"/>
    <link rel="stylesheet" href="{{ asset('back/css/style.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('back/css/pages/dashboard1.css') }}"/>
    @yield('css')
</head>
<body class="skin-default-dark fixed-layout">
<!-- Preloader - style you can find in spinners.css -->
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">
            {{ $settings->translate->where('lang', session('locale'))->first()->title }}
        </p>
    </div>
</div>
<!-- Main wrapper - style you can find in pages.scss -->
<div id="main-wrapper">
    <!-- Topbar header - style you can find in pages.scss -->
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <!-- Logo -->
            <div class="navbar-header d-flex justify-content-center align-items-center">
                <a class="navbar-brand d-inline-block" href="{{ route('admin.index') }}" style="width: 30%">
                    <!-- Light Logo text -->
                    <img src="{{ asset(Storage::url($settings->logo)) }}" class="light-logo w-100"
                         alt="{{ $settings->translate->where('lang', session('locale'))->first()->title }}"/>
                </a>
            </div>
            <!-- End Logo -->
            <div class="navbar-collapse">
                <!-- toggle and nav items -->
                <ul class="navbar-nav me-auto">
                    <!-- This is  -->
                    <li class="nav-item">
                        <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark"
                           href="javascript:void(0)">
                            <i class="ti-menu"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark"
                           href="javascript:void(0)">
                            <i class="icon-menu"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- End Topbar header -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    @include('admin.layouts.sidebar')
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Container fluid  -->
        <div class="container-fluid">
            @yield('content')
        </div>
        <!-- End Container fluid  -->
    </div>
    <!-- End Page wrapper  -->
    <!-- footer -->
    <footer class="footer">
        © {{ date('Y') == 2024 ? 2024 : '2024 -' . date('Y') }}
        <a target="_blank" href="">
            {{ $settings->translate->where('lang', session('locale'))->first()->title }}
        </a>
    </footer>
    <!-- End footer -->
</div>
<!-- End Wrapper -->
<!-- All Jquery -->
<script src="{{ asset("back/node_modules/jquery/dist/jquery.min.js") }}"></script>
<!-- Bootstrap popper Core JavaScript -->
<script src="{{ asset("back/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js") }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset("back/js/perfect-scrollbar.jquery.min.js") }}"></script>
<!--Wave Effects -->
<script src="{{ asset("back/js/waves.js") }}"></script>
<!--Menu sidebar -->
<script src="{{ asset("back/js/sidebarmenu.js") }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset("back/js/custom.min.js") }}"></script>
<!-- This page plugins -->
<!--morris JavaScript -->
<script src="{{ asset("back/node_modules/raphael/raphael-min.js") }}"></script>
<script src="{{ asset("back/node_modules/morrisjs/morris.min.js") }}"></script>
<script src="{{ asset("back/node_modules/jquery-sparkline/jquery.sparkline.min.js") }}"></script>
<!-- Popup message jquery -->
<script src="{{ asset("back/node_modules/toast-master/js/jquery.toast.js") }}"></script>
<!-- Chart JS -->
<script src="{{ asset("back/js/dashboard1.js") }}"></script>
<script src="{{ asset("back/node_modules/toast-master/js/jquery.toast.js") }}"></script>
@yield('js')
</body>
</html>
