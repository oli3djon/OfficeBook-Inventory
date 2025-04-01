<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="OfficeBook {{ config('itlux.release') }}">
    <meta name="keywords" content="OfficeBook by ITLux">
    <meta name="Copyright" Content="ITLux.com.ua">
    <link REV=made href='mailto:info@itlux.com.ua'>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title><?=$settings['2']?> | {{ config('itlux.name') }}</title>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap/examples/sign-in/signin.css">
    <link rel="stylesheet" href="/mdbootstrap/css/mdb.min.css" >
    <link rel="stylesheet" href="/css/officeup.css" >
</head>

<body class="text-center" data-vide-bg="/img/office/video/office1.mp4">

<nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
    <div class="container">

        <a class="navbar-brand" href="{{ route('office') }}">
            <strong>OfficeBook</strong>
        </a>

        <ul class="navbar-nav nav-flex-icons">

            <li class="nav-item">
                <a href="/office/contacts" class="nav-link border border-light rounded" > Контакты </a>
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