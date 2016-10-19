<!DOCTYPE html>
<html>
<head>
    <title>{{$title or "LeadMark"}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Leadmark">
    <meta name="keywords" content="leadmark">
    <meta name="author" content="Mayor">

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- STYLESHEETS -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/etlinefont.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/flexslider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/owl.carousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/owl.theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/animate.css')}}">
    {{--<link rel="stylesheet" type="text/css" href="/css/material-kit.css">--}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">



    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>


    <!-- FAVICON -->
    <link rel="shortcut icon" href="{{asset('images/favicon/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/favicon/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/favicon/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/favicon/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('images/favicon/apple-touch-icon-57-precomposed.png')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('sweetalert\dist\sweetalert2.css')}}">
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    @yield('head')
</head>
<body>
    @include('partials.navigation')

    @yield('content')
<!-- PRELOADER -->
<div class="site-loader">
    <span></span>
    <p>Loading</p>
</div>
<!-- PRELOADER END -->

{{--including the footer--}}
    @include('partials.footer')
{{--including the modals--}}
    @include('partials.modals')


{{--including default scripts--}}
    @include('partials.scripts')
    @include('partials.flashdata')
{{--For extra scripts--}}
@yield('scripts')
</body>
</html>