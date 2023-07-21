<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.TalinTest') }}</title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="landp/assets/images/favicon.png" type="image/png">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{ asset('landp/assets/css/bootstrap.min.css') }}">

    <!--====== Line Icons css ======-->
    <link rel="stylesheet" href="{{ asset('landp/assets/css/LineIcons.css') }}">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{ asset('landp/assets/css/magnific-popup.css') }}">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="{{ asset('landp/assets/css/slick.css') }}">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="{{ asset('landp/assets/css/animate.css') }}">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{ asset('landp/assets/css/default.css') }}">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{ asset('landp/assets/css/style.css') }}">
    @yield('styles')
</head>
<body>
  <!--====== NAVBAR PART START ======-->

    <section class="header-area">
        <div class="navbar-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="landp/assets/images/logo.png" alt="Logo">
                            </a>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarEight">
                                <ul class="navbar-nav ml-auto">
                                    <!-- Authentication Links -->
                            @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                                <li class="nav-item">
                                    <a id="navbar" href="#">
                                    {{ Auth::user()->name }}
                                </a>
                                </li>
                                <li>
                                <div class="nav-item">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- navbar area -->
    </section>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a id="nav-link" href="#">
                                    {{ Auth::user()->name }}
                                </a>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('landp/assets/plugins/jquery/jquery.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
