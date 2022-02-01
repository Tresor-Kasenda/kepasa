<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main-color.css') }}" id="colors">
</head>
<body>
    <div id="wrapper">
        @include('apps.components._header')
        <main>
            @yield('content')
        </main>
    </div>
    @include('apps.components._footer')
    @include('apps.partials.scripts._scripts')
    @yield('scripts')
</body>
</html>
