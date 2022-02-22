<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ route('admin.admin.index') }}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('assets/images/logo.png') }}" srcset="{{ asset('assets/images/logo.png') }} 2x" alt="logo">
                <img class="logo-dark logo-img" src="{{ asset('assets/images/logo.png') }}" srcset="{{ asset('assets/images/logo.png') }} 2x" alt="logo-dark">
                <img class="logo-small logo-img logo-img-small" src="{{ asset('assets/images/logo.png') }}" srcset="{{ asset('assets/images/logo.png') }} 2x" alt="logo-small">
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
                    @include('supervisor.partials.navLink', [
                        'route' => route('admin.admin.index'),
                        'name' => 'Administration',
                        'icon' => 'ni-grid-fill-c'
                    ])
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Administration</h6>
                    </li>
                    @include('admins.partials.navLink', [
                        'route' => route('admin.eventsCountries.index'),
                        'name' => 'Events by Country',
                        'icon' => 'ni-globe'
                    ])
                    @include('supervisor.partials.navLink', [
                        'route' => route('admin.eventsAdmins.index'),
                        'name' => 'All events',
                        'icon' => 'ni-panel-fill'
                    ])
                    @include('admins.partials.navLink', [
                        'route' => route('admin.eventsOrganisers.index'),
                        'name' => 'Event by organiser',
                        'icon' => 'ni-users-fill'
                    ])
                    @include('admins.partials.navLink', [
                        'route' => route('admin.cityMedia.index'),
                        'name' => 'City Media',
                        'icon' => 'ni-map-pin-fill'
                    ])
                </ul>
            </div>
        </div>
    </div>
</div>
