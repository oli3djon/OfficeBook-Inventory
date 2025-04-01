<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="/favicon.ico" rel="icon" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="OfficeBook {{ config('itlux.release') }}">
    <meta name="keywords" content="OfficeBook by ITLux">
    <meta name="Copyright" Content="ITLux.com.ua">
    <link REV=made href='mailto:info@itlux.com.ua'>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <title><?=$settings['2']?> | {{ config('itlux.name') }}</title>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/DataTables/DataTables-1.10.18/css/jquery.dataTables.css">
    <link rel="stylesheet" href="/css/office.css">
</head>

<body >
<nav class="navbar fixed-top navbar-expand-lg navbar-dark badge-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('office') }}">OfficeBook</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                @if ($settings[6] == 1)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('office-contacts') }}">Контакты </a>
                </li>
                @endif
                @if ($settings[5] == 1)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('office-inventorys') }}">Имущество</a>
                </li>
                @endif

            </ul>

            <ul class="navbar-nav nav-flex-icons">
                @if (Gate::allows('adminpanel'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin') }}">Админка</a>
                    </li>
                @endif
                <li class="nav-item">
                    @if (Auth::guest())
                        <a href="{{ route('login') }}"><button class="btn btn btn-light my-2 my-sm-0" type="submit">Вход</button></a>
                    @else
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" ><button class="btn btn btn-outline-light my-2 my-sm-0" type="submit">Выход</button></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<div style="min-height: 50px;"></div>
<!-- Footer -->
<footer class="py-lg-3 bg-dark fixed-bottom">
    <div class="container">
        <p class="m-0 text-center text-white">&copy; {{ config('itlux.release') }} <a href="http://itlux.com.ua" target="_blank">ITLux.com.ua</a></p>
    </div>
</footer>

<script src="/js/jquery-3.3.1.slim.min.js"></script>
<script src="/js/bootstrap.min.js" ></script>
<script src="/DataTables/DataTables-1.10.18/js/jquery.dataTables.js"></script>
<script src="/js/office.js"></script>

@include('layouts.analytics')

</body>
</html>