@php use Illuminate\Support\Facades\Storage; @endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!-- Favicon icon -->
    <link rel="icon" sizes="16x16" href="{{ asset(Storage::url($settings->favicon)) }}"/>
    <title>
        Qeydiyyat
    </title>
    <link rel="stylesheet" href="{{ asset("back/css/pages/login-register-lock.css") }}"/>
    <link rel="stylesheet" href="{{ asset("back/css/style.min.css") }}"/>
</head>

<body class="skin-default card-no-border">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label"></p>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<section id="wrapper">
    <div class="login-register" style="background-image:url({{ asset("back/images/background/login-register.jpg")}});">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="loginform" action="{{ route('register') }}"
                      method="POST">
                    @csrf
                    <input type="hidden" name="role" value="2"/>
                    <h3 class="text-center m-b-20">
                        Qeydiyyat
                    </h3>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                   value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Ad"/>
                        </div>
                    </div>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail"/>
                        </div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="new-password" placeholder="Şifrə"/>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required autocomplete="new-password"
                                   placeholder="Təkrar Şifrə"/>
                        </div>
                    </div>
                    <div class="form-group text-center p-b-20">
                        <div class="col-xs-12">
                            <button type="submit"
                                    class="btn btn-info btn-lg w-100 btn-rounded text-uppercase waves-effect waves-light text-white">
                                Qeydiyyat
                            </button>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            Hesabınız var? <a href="{{ route('login') }}" class="text-info m-l-5"><b>
                                    Giriş
                                </b></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ asset("back/node_modules/jquery/dist/jquery.min.js")}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset("back/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js")}}"></script>
<script type="text/javascript">
    $(function() {
        $(".preloader").fadeOut();
    });
    $(function() {
        $('[data-bs-toggle="tooltip"]').tooltip()
    });
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
</script>
</body>
</html>
