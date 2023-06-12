<div class="nk-sidebar nk-sidebar-fixed is-light nk-apps-sidebar is-theme" data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ route('supper.dashboard') }}" class="logo-link nk-sidebar-logo">
                <img
                        class="logo-small logo-img logo-img-small"
                        src="{{ asset('assets/images/logo.png') }}"
                        srcset="{{ asset('assets/images/logo.png') }} 2x"
                        alt="logo-small">
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
                    <x-vex-nav-link
                            href="{{ route('supper.dashboard') }}"
                            :active="request()->routeIs('supper.dashboard')"
                            icons="ni-grid-alt">
                        Dashboard
                    </x-vex-nav-link>

                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Administration</h6>
                    </li>
                    <x-vex-nav-link
                            href="{{ route('supper.invoices-list') }}"
                            :active="request()->routeIs('supper.invoices-list')"
                            icons="ni-money"
                    >
                        Billing
                    </x-vex-nav-link>

                    <x-vex-nav-link
                        href="{{ route('supper.company-lists') }}"
                        :active="request()->routeIs('supper.company-lists')"
                        icons="ni-building">
                        Company
                    </x-vex-nav-link>

                    <x-vex-nav-link
                            href="{{ route('supper.category-list') }}"
                            :active="request()->routeIs('supper.category-list')"
                            icons="ni-box">
                        Categories
                    </x-vex-nav-link>

                    <x-vex-nav-link
                            href="{{ route('supper.events.index') }}"
                            :active="request()->routeIs('supper.events.index')"
                            icons="ni-swap-alt">
                        Events
                    </x-vex-nav-link>

                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Users</h6>
                    </li>

                    <x-vex-nav-link
                            href="{{ route('supper.country-list') }}"
                            :active="request()->routeIs('supper.country-list')"
                            icons="ni-map"
                    >
                        Country
                    </x-vex-nav-link>

                    <x-vex-nav-link
                            href="{{ route('supper.users-list') }}"
                            :active="request()->routeIs('supper.users-list')"
                            icons="ni-user-round"
                    >
                        Users
                    </x-vex-nav-link>

                    <x-vex-nav-link
                            href="{{ route('supper.settings.index') }}"
                            :active="request()->routeIs('supper.settings.index')"
                            icons="ni-setting-alt"
                    >
                        Settings
                    </x-vex-nav-link>
                </ul>
            </div>
        </div>
    </div>
</div>
