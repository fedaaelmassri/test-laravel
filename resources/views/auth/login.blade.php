<!doctype html>
     <?php
 $textdir='';
 if(App::getLocale() == 'en'){
    $textdir = 'ltr';
}elseif (App::getLocale() == 'ar')
$textdir = 'rtl';
?>
 
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="<?php echo $textdir; ?>">

<head>
    <title> Oculux | Login</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/animate-css/vivify.min.css')}}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/site.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

</head>



 
<body class="theme-cyan light_version ltr">
 
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
        <div class="bar4"></div>
        <div class="bar5"></div>
    </div>
</div>

<div class="auth-main2 particles_js">
    <div class="auth_div vivify fadeInTop">
        <div class="card">
            <div class="body">
                <div class="login-img">
                    <img class="img-fluid" src="{{asset('assets/images/login-img.png')}}"/>
                </div>
                <form method="POST" class="form-auth-small" action="{{ route('login') }}"  id="basic-form" novalidate>
                    @csrf

                    <div class="mb-3">
                        <p class="lead">Login </p>
                    </div>
                    <div class="form-group">
                        <label for="signin-email" class="control-label sr-only"> email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" placeholder="email" value="{{ old('email') }}" required
                               autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror


                    </div>
                    <div class="form-group">
                        <label for="signin-password" class="control-label sr-only">password </label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror" name="password"
                               placeholder="password " required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror


                    </div>
                    <div class="form-group clearfix">
                        <label class="fancy-checkbox element-left">
                            <input class="form-check-input" type="checkbox" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>Remember me</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-round btn-block">Login</button>
                    <div class="mt-4">

                        @if (Route::has('password.request'))
                            <span class="helper-text text-center m-b-10">
                                <a href="{{route('password.request')}}">Forgot Your Password? </a></span>



                        @endif


                        <span class="text-center helper-text" >Don't have an account?  <a href="{{ route('register') }}">Register</a></span>
                        
         
                        
                    </div>
                </form>
                <div class="pattern">
                    <span class="red"></span>
                    <span class="indigo"></span>
                    <span class="blue"></span>
                    <span class="green"></span>
                    <span class="orange"></span>
                </div>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
</div>
<!-- END WRAPPER -->

<script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/vendorscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/mainscripts.bundle.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.0.6/parsley.min.js"></script>
 <script>

    
    $(function () {
        $('#basic-form').parsley();
    });
</script>


</body>
</html>
