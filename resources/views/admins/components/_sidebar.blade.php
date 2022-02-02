<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ route('supper.dashboard.index') }}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('assets/admins/images/logo.png') }}" srcset="{{ asset('assets/admins/images/logo.png') }} 2x" alt="logo">
                <img class="logo-dark logo-img" src="{{ asset('assets/admins/images/logo.png') }}" srcset="{{ asset('assets/admins/images/logo.png') }} 2x" alt="logo-dark">
                <img class="logo-small logo-img logo-img-small" src="{{ asset('assets/admins/images/logo.png') }}" srcset="{{ asset('assets/admins/images/logo.png') }} 2x" alt="logo-small">
            </a>
        </div>
        <div class="nk-menu-trigger mr-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu">
                <em class="icon ni ni-arrow-left"></em>
            </a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu">
                <em class="icon ni ni-menu"></em>
            </a>
        </div>
    </div>
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    @include('admins.partials.navLink', [
                        'route' => route('supper.dashboard.index'),
                        'name' => 'Dashboard',
                        'icon' => 'ni-grid-alt'
                    ])
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Administration</h6>
                    </li>
                    @include('admins.partials.navLink', [
                        'route' => route('supper.events.listens'),
                        'name' => 'Events',
                        'icon' => 'ni-swap-alt'
                    ])
                    @include('admins.partials.navLink', [
                        'route' => route('supper.events.country'),
                        'name' => 'Events Country',
                        'icon' => 'ni-location'
                    ])
                    @include('admins.partials.navLink', [
                        'route' => route('supper.organisers.index'),
                        'name' => 'Organisers',
                        'icon' => 'ni-spark'
                    ])
                    @include('admins.partials.navLink', [
                        'route' => route('supper.admins.index'),
                        'name' => 'Admins',
                        'icon' => 'ni-user-circle'
                    ])
                    @include('admins.partials.navLink', [
                        'route' => route('supper.countries.listens'),
                        'name' => 'Countries',
                        'icon' => 'ni-map'
                    ])
                    @include('admins.partials.navLink', [
                        'route' => route('supper.billing.index'),
                        'name' => 'Billings',
                        'icon' => 'ni-wallet-saving'
                    ])
                </ul>
            </div>
        </div>
    </div>
</div>
