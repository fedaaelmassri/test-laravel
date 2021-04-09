<!doctype html>
<html lang="ar">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>  Oculux   | نسيت كلمة المرور</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="#" type="image/x-icon">
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
                     alt=""></a>
        </div>
        <div class="card forgot-pass">
            <div class="body">
                <p class="lead mb-3"> إعادة تعيين كلمة المرور</p>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                               autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group ">
                        <input id="password" type="password" placeholder="ادخل كلمة المرور"
                               class="form-control @error('password') is-invalid @enderror" name="password" required
                               autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <input type="password" class="form-control round"
                               id="password-confirm" name="password_confirmation" required
                               placeholder="تأكيد كلمة المرور">
                    </div>

                    <div class="form-group">
                        <div class="btn btn-primary btn-round btn-block">
                            <button type="submit" class="btn btn-primary">
                                تغيير كلمة المرور
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/vendorscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/mainscripts.bundle.js')}}"></script>

</body>
</html>


