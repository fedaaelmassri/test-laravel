<!doctype html>
<html lang="ar">

<head>
    <title>Oculux | Forgot Password</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Tajawal:400,500,700&display=swap&subset=arabic">
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/animate-css/vivify.min.css')}}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/site.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
</head>

<body class="theme-cyan light_version rtl">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
        <div class="bar4"></div>
        <div class="bar5"></div>
    </div>
</div>

<div class="pattern">
    <span class="red"></span>
    <span class="indigo"></span>
    <span class="blue"></span>
    <span class="green"></span>
    <span class="orange"></span>
</div>
<div class="auth-main particles_js">
    <div class="auth_div vivify popIn">
        <div id="particles-js"></div>

        <div class="auth_brand">
            <a class="navbar-brand" href="javascript:void(0);">
                <img src="{{asset('assets/images/icon.svg')}}" width="120"
                     height="120" class="d-inline-block align-top mr-2"
                     alt="">
            </a>
        </div>


        <div class="card forgot-pass">
            <div class="body">
                <p class="lead mb-3"> إعادة تعيين كلمة المرور</p>
                <p>قٌم بادخال البريد الإلكتروني لاسترداد كلمة المرور.</p>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="form-auth-small" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-control {{ ($errors->has('email')) ? ' is-invalid' : '' }}"
                               name="email" id="email" value="{{ old('email') }}"
                               placeholder="{{ __('info@example.com') }}" autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block"> إعادة تعيين كلمة المرور</button>
                    <div class="bottom">
                        <span class="helper-text">هل تعرف كلمة المرور الخاصة بك ؟ <a href="{{route('login')}}">تسجيل الدخول</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END WRAPPER -->

<script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/vendorscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/mainscripts.bundle.js')}}"></script>

</body>
</html>

