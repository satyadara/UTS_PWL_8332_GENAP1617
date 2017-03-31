<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap -->
    {!! Html::style('css/bootstrap.min.css')!!}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- Summernote -->
    {!! Html::style('css/summernote.css')!!}
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('js/moment.js') }}"></script> -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.min.js')}}"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/summernote.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/summernote.js')}}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {!! Html::style('css/font-awesome.min.css') !!}
    <!-- {!! Html::style('css/bootstrap-datetimepicker.min.css') !!} -->
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>


</head>
<body style="overflow-x: hidden;">
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top ">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Digital Invader') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li>
                                <a href=" {{ url('profil')}} ">
                                    {{ Auth::user()->name }}
                                </a>
                            <li>
                                
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POSt" style="display: none ;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
                    </ul>
                    <form class="navbar-form navbar-left" role="search" method="GET" action="{{ url('mencari/topik') }}">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="cari sesuatu ?" required name="kunci">
                        </div>
                        <button type="submit" class="btn btn-default">Cari</button>
                    </form>
                </div>
            </div>
        </nav>

        @yield('content')
        
    </div>

    <div class="footer panel panel-info ">
        <div class="row panel-heading">
            <div class="col-md-6">
                <p>Created by :</p>
                <p>- Satya Syahputra ( 15070332 )</p>
            </div>
            <div class="col-md-6">
                <p>Supported by : </p>
                <p>- Laravel 5.4</p>
                <p>- Bootstrap 3.3.7</p>
            </div>
            </div>
        </div>
    </div>
    
</body>

</html>
