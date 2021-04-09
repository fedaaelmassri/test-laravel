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
    <title>@yield('title','لوحة التحكم')</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="#" type="image/x-icon">

    <!-- VENDOR CSS -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Tajawal:400,500,700&display=swap&subset=arabic">
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/animate-css/vivify.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/toastr/toastr.min.css')}}">
    @yield('css')
    <link rel="stylesheet" href="{{asset('assets/css/site.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script src="{{ asset('js/dropzone.js') }}" type="text/javascript"></script>


</head>

 
<body class="theme-cyan light_version ltr">
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

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<div id="wrapper">
    <div id="wrapper">
        @include('template.header')
        @include('template.sidebar')
    </div>
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Oculux</li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                            </ol>
                        </nav>
                    </div>
                    @yield('btn')
                </div>
            </div>
            @yield('content')
        </div>
    </div>
</div>

<div id="particles-js"></div>

<script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/vendorscripts.bundle.js')}}"></script>
<script src="{{asset('assets/vendor/toastr/toastr.min.js')}}"></script>
@yield('js')
<script src="{{asset('assets/bundles/mainscripts.bundle.js')}}"></script>

<script>
        var url = '{{URL::to('/')}}';
        @if (session('message'))
    var type = "{{session('alert-type')}}";
    switch (type) {
        case 'success':
            toastr.success("{{ session('message') }}");
            break;
        case 'error':
            toastr.error("{{ session('message') }}");
            break;
    }
    @endif
</script>


<script>

  
</script>
</body>
</html>
