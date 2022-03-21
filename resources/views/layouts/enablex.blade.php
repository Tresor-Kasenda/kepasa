<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('enableX/assets/plugins/bootstrap4/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="{{ asset('enableX/assets/plugins/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/minimal/minimal.css">
    <link rel="stylesheet" href="{{ asset('enableX/css/jquery-confirm.min.css') }}">
    <link href='//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('enableX/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('enableX/css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('enableX/css/joinedRoom.css') }}"/>
    <link rel="stylesheet" href="{{ asset('enableX/css/new-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('enableX/css/chat.css') }}" />
    <style type="text/css">

        .site-header .navbar-brand .logo {
            width: 146px;
            height: 45px;
            background: url(https://kepasa.africa/logo3.png) no-repeat;
            background-size: cover;
        }
        span.nav-link {
            cursor: pointer;
            position: relative;
            color: #ff6600 !important;
            background: #2AD2C9!important;
        }
    </style>
    <title>{{ config('app.name') }} | @yield('title')</title>
</head>
<body class="fixed-sidebar fixed-header fixed-footer skin-default sidebar-closed">
    @yield('content')
    @include('enableX.partials.scripts')
</body>
</html>
