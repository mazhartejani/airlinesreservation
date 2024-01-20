<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property='og:title' content="{{ config('app.name', 'Software Architecture Project') }}" />
    <meta property='og:description' content='Software Architecture Project' />
    <meta property='og:type' content='website' />
    <meta property='og:site_name' content='Software Architecture Project' />
    <meta property='og:locale' content='en_US' />
    <meta name='author' content='Mazhar Hussain (893479)'>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            background-image: url('bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .form-select, .form-control {
            line-height: 2 !important
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                    <ul class="navbar-nav me-auto">
                        @if(auth()->user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('flights.create') }}">{{ __('Flight') }}</a>
                        </li>    
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('getAllTickets') }}">{{ __('Tickets') }}</a>
                        </li> 
                        @endif                
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reserveTicketForm') }}">{{ __('Reservation') }}</a>
                        </li>  
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('upgradeSeatForm') }}">{{ __('Upgrade Seat') }}</a>
                        </li>  
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('flightSearchForm') }}">{{ __('Flight Search') }}</a>
                        </li>   
                    </ul>
                    @endauth

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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('ticketsHistory') }}">
                                        {{ __('Booking History') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
