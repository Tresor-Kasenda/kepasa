<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">
<head>
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/admins/css/dashlite.css') }}">
    @yield('styles')
</head>

<body class="nk-body bg-lighter npc-general has-sidebar">
    <div>
        <div class="nk-app-root">
            <div class="nk-main">
                @include('supervisor.components._sidebar')
                <div class="nk-wrap">
                    @include('supervisor.components._header')
                    <div class="nk-content">
                        <div class="container-fluid">
                            @yield('content')
                        </div>
                    </div>
                    @include('supervisor.components._footer')
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/admins/js/bundle.js') }}"></script>
    <script src="{{ asset('assets/admins/js/scripts.js') }}"></script>
    @include('sweetalert::alert')
    @yield('scripts')
</body>
</html>
