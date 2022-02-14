<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main-color.css') }}" id="colors">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    @yield('styles')
</head>
<body>
    <div id="wrapper">
        @include('organisers.components._header')
        <div class="clearfix"></div>
        <div id="dashboard">
            @include('organisers.partials._main')
            <div class="dashboard-content">
                <main>
                    @yield('content')
                </main>
            </div>
        </div>
        @include('organisers.components._footer')
    </div>
    @include('apps.partials.scripts._scripts')
    @include('sweetalert::alert')
    @yield('scripts')
</body>
</html>
