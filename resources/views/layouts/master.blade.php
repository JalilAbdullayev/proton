@php use Illuminate\Support\Facades\Storage; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description"
          content="@yield('description', $settings->translated->first()->description)"/>
    <meta name="keywords" content="@yield('keywords', $settings->translated->first()->keywords)"/>
    <meta name="author" content="{{ $settings->translated->first()->author}}"/>
    <title>
        @yield('title', $settings->translated->first()->title)
    </title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset(Storage::url($settings->favicon))}}" type="image/x-icon"/>
    {{-- Fancybox --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
    />
    <!-- Fontawesom Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('front/plugins/bootstrap/bootstrap.min.css')}}"/>
    <!-- Swiper -->
    <link rel="stylesheet" href="{{ asset('front/plugins/swiper/swiper-bundle.min.css')}}"/>
    <!-- Custom Css -->
    @vite(['public/front/css/style.sass'])
</head>
<body>
<a href="#" class="btn btn-top">
    <i data-feather="arrow-up"></i>
</a>
<!-- Search modal start -->
<div class="search-modal-container">
    <div class="container">
        <form action="{{ route('search') }}">
            <div class="row align-items-center">
                <div class="col-10">
                    <div class="form-group">
                        <input type="search" name="search" placeholder="Search here" class="form-control custom-form"/>
                    </div>
                </div>
                <div class="col-2">
                    <button class="btn btn-main btn-search-form">
                        <i data-feather="search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Search modal end -->
<!-- Header start -->
@include('layouts.header')
<!-- Header end -->
@yield('content')
<!-- Footer start -->
@include('layouts.footer')
<!-- Footer end -->

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src='{{ asset('front/plugins/feather-icons/feather.min.js')}}'></script>
<script src="{{ asset('front/plugins/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{ asset('front/plugins/bootstrap/popper.min.js')}}"></script>
<script src="{{ asset('front/plugins/bootstrap/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('front/js/main.js')}}"></script>
<script>
    function sweetAlert(icon, message) {
        Swal.fire({
            icon: icon,
            timer: 1500,
            timerProgressBar: true,
            title: message,
        })
    }

    @if(session('success'))
    sweetAlert('success', '{{ session('success') }}');
    @elseif(session('error'))
    sweetAlert('error', '{{ session('error') }}')
    @endif
</script>
@yield('js')
</body>
</html>
