<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main-color.css') }}" id="colors">
    @yield('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="wrapper">
        @include('organisers.components._header')
        <div class="clearfix"></div>
        <div id="dashboard">
            @include('organisers.partials._main')
            <div class="dashboard-content">
                {{ $slot }}
            </div>
        </div>
        @include('organisers.components._footer')
    </div>
    @include('apps.partials.scripts._scripts')
    @include('sweetalert::alert')
    @yield('scripts')
</body>
</html>
