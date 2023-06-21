<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">
<head>
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Une partie d'administration pour la gestion d'un {{ config('app.name') }}">
    <link rel="stylesheet" href="{{ asset('assets/admins/css/dashlite.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admins/css/skins/theme-green.css') }}">
    @yield('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ui-clean">
    <div>
        <div class="nk-app-root">
            <div class="nk-main">
                @include('admins.components._sidebar')
                <div class="nk-wrap">
                    @include('admins.components._header')
                    <div class="nk-content">
                        <div class="container-fluid">
                            {{ $slot }}
                        </div>
                    </div>
                    @include('admins.components._footer')
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/admins/js/bundle.js') }}"></script>
    <script src="{{ asset('assets/admins/js/scripts.js') }}"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @include('sweetalert::alert')
    @yield('scripts')
</body>
</html>
