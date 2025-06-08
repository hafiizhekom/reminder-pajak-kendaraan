<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
</head>
<body>
<style>
    .btn-table{
        margin:5px;
    }

    label{
        margin-right:2px;
    }
</style>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">Menu</div>

                            <div class="card-body">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active"  href="{{url('home')}}">Dashboard</a>
                                </li>
                                @if(auth()->user()->superadmin)
                                    <li class="nav-item">
                                        <a class="nav-link active"  href="{{url('user')}}">User</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link active"  href="{{url('vehicle')}}">Vehicle</a>
                                </li>
                                @if(auth()->user()->superadmin)
                                    <li class="nav-item">
                                        <a class="nav-link active"  href="{{url('reminder')}}">Reminder</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active"  href="{{url('reminder/history')}}">Reminder History</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active"  href="{{url('sms')}}">SMS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active"  href="{{url('sms/history')}}">Outbox</a>
                                    </li>
                                @endif
                                
                            </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">{{$page}}</div>

                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                        
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>