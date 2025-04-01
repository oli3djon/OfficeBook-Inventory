<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="/favicon.ico" rel="icon" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content=" {{ config('itlux.release') }}">
    <meta name="keywords" content="OfficeBook by ITLux">    
    <meta name="Copyright" Content="ITLux.com.ua">
    <link REV=made href='mailto:info@itlux.com.ua'>
            
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <title><?=$settings['2']?> | {{ config('itlux.name') }}</title>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/mdbootstrap/css/mdb.min.css" >
    <link rel="stylesheet" href="/css/officeup.css" >
</head>

<body >

<nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
    <div class="container">

        <a class="navbar-brand" href="{{ route('office') }}">
            <strong>{{ config('itlux.name') }}</strong>
        </a>
        @if (Gate::allows('adminpanel'))
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin') }}">Админка</a>
                </li>
            </ul>
        @endif

        <ul class="navbar-nav nav-flex-icons">

            <li class="nav-item">
                @if (Auth::guest())
                    <a href="{{ route('login') }}" class="nav-link border btn-light rounded">Вход</a>
                @else
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link border border-light rounded">Выход</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endif
            </li>
        </ul>

    </div>
</nav>

@yield('content')

<script src="/js/jquery.min.js"></script>
<script src="/js/jquery.vide.js"></script>
<script src="/js/jquery-3.3.1.slim.min.js"></script>
<script src="/js/bootstrap.min.js" ></script>

@include('layouts.analytics')

</body>
</html>