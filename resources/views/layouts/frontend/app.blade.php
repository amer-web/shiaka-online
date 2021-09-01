<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{asset('favicon.ico')}}" rel="shortcut icon">
    <!-- Base Google Font for Web-app -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <!-- Google Fonts for Banners only -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,800" rel="stylesheet">
    <!-- Bootstrap 4 -->
    {{-- <link rel="stylesheet" href="{{asset('assets-frontend/css/bootstrap.min.css')}}"> --}}
    <!-- <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.1.3/css/bootstrap.min.css"
        integrity="sha384-Jt6Tol1A2P9JBesGeCxNrxkmRFSjWCBW1Af7CSQSKsfMVQCqnUVWhZzG0puJMCK6" crossorigin="anonymous"> -->
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="{{asset('assets-frontend/css/fontawesome.min.css')}}">
    <!-- Ion-Icons 4 -->
    <link rel="stylesheet" href="{{asset('assets-frontend/css/ionicons.min.css')}}">
    <!-- Animate CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets-frontend/css/animate.min.css')}}">
    <!-- Owl-Carousel -->
    <link rel="stylesheet" href="{{asset('assets-frontend/css/owl.carousel.min.css')}}">
    <!-- Jquery-Ui-Range-Slider -->
    <link rel="stylesheet" href="{{asset('assets-frontend/css/jquery-ui-range-slider.min.css')}}">
    <!-- Utility -->
    <link rel="stylesheet" href="{{asset('assets-frontend/css/utility.css')}}">
    <!-- Main -->
    <link rel="stylesheet" href="{{asset('assets-frontend/css/bundle.css')}}">
    <!-- Styles -->

</head>
<body>
    <div id="app">
        @include('layouts.frontend.main-header')
        @yield('content')
        @include('layouts.frontend.footer')
    </div>



    <!-- app /- -->
    <!--[if lte IE 9]>
<div class="app-issue">
    <div class="vertical-center">
        <div class="text-center">
            <h1>You are using an outdated browser.</h1>
            <span>This web app is not compatible with following browser. Please upgrade your browser to improve your security and experience.</span>
        </div>
    </div>
</div>
<style> #app {
    display: none;
} </style>
<![endif]-->
    <!-- NoScript -->
    <noscript>
        <div class="app-issue">
            <div class="vertical-center">
                <div class="text-center">
                    <h1>JavaScript is disabled in your browser.</h1>
                    <span>Please enable JavaScript in your browser or upgrade to a JavaScript-capable browser to
                        register for Groover.</span>
                </div>
            </div>
        </div>
        <style>
            #app {
                display: none;
            }
        </style>
    </noscript>
    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
        window.ga = function () {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('send', 'pageview')
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async defer></script>
    <!-- Modernizr-JS -->
    <script type="text/javascript" src="{{asset('assets-frontend/js/vendor/modernizr-custom.min.js')}}"></script>
    <!-- NProgress -->
    <script type="text/javascript" src="{{asset('assets-frontend/js/nprogress.min.js')}}"></script>
    <!-- jQuery -->
    <script type="text/javascript" src="{{asset('assets-frontend/js/jquery.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script type="text/javascript" src="{{asset('assets-frontend/js/bootstrap.min.js')}}"></script>
    <!-- Popper -->
    <script type="text/javascript" src="{{asset('assets-frontend/js/popper.min.js')}}"></script>
    <!-- ScrollUp -->
    <script type="text/javascript" src="{{asset('assets-frontend/js/jquery.scrollUp.min.js')}}"></script>
    <!-- Elevate Zoom -->
    <script type="text/javascript" src="{{asset('assets-frontend/js/jquery.elevatezoom.min.js')}}"></script>
    <!-- jquery-ui-range-slider -->
    <script type="text/javascript" src="{{asset('assets-frontend/js/jquery-ui.range-slider.min.js')}}"></script>
    <!-- jQuery Slim-Scroll -->
    <script type="text/javascript" src="{{asset('assets-frontend/js/jquery.slimscroll.min.js')}}"></script>
    <!-- jQuery Resize-Select -->
    <script type="text/javascript" src="{{asset('assets-frontend/js/jquery.resize-select.min.js')}}"></script>
    <!-- jQuery Custom Mega Menu -->
    <script type="text/javascript" src="{{asset('assets-frontend/js/jquery.custom-megamenu.min.js')}}"></script>
    <!-- jQuery Countdown -->
    <script type="text/javascript" src="{{asset('assets-frontend/js/jquery.custom-countdown.min.js')}}"></script>
    <!-- Owl Carousel -->
    <script type="text/javascript" src="{{asset('assets-frontend/js/owl.carousel.min.js')}}"></script>
    <!-- Main -->
    <script type="text/javascript" src="{{asset('assets-frontend/js/app.js')}}"></script>
    <script src="{{ asset('js/app.js') }}" ></script>
</body>
</html>