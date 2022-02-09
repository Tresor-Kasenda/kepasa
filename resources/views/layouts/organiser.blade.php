<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main-color.css') }}" id="colors">
    @laravelPWA
    @yield('styles')
</head>
<body>
    <div id="wrapper">
        @include('organisers.components._header')
        <div class="clearfix"></div>
        <div id="dashboard">
            <a href="#" class="dashboard-responsive-nav-trigger">
                <i class="fa fa-reorder"></i> Dashboard Navigation
            </a>
            <div class="dashboard-nav">
                <div class="dashboard-nav-inner">
                    <ul data-submenu-title="Main">
                        <li class="{{ Request::url() === route('organiser.organiser.index') ? 'active' : '' }}">
                            <a href="{{ route('organiser.organiser.index') }}">
                                <i class="sl sl-icon-settings"></i> Dashboard
                            </a>
                        </li>
                    </ul>
                    <ul data-submenu-title="Listings">
                        <li>
                            <a href="">
                                <i class="sl sl-icon-star"></i> Event
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="sl sl-icon-wallet"></i> Billing
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="sl sl-icon-plus"></i> Event images
                            </a>
                        </li>
                    </ul>
                    <ul data-submenu-title="Account">
                        <li class="{{ Request::url() === route('organiser.profile.index') ? 'active' : '' }}">
                            <a href="{{ route('organiser.profile.index') }}">
                                <i class="sl sl-icon-user"></i> My Profile
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="sl sl-icon-power"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="dashboard-content">
                <main>
                    @yield('content')
                </main>
            </div>
        </div>

        @include('organisers.components._footer')
    </div>
    @include('apps.partials.scripts._scripts')
    @yield('scripts')
</body>
</html>
