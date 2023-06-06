<div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ml-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu">
                    <em class="icon ni ni-menu"></em>
                </a>
            </div>
            <div class="nk-header-brand d-xl-none">
                <a href="{{ route('admin.admin.index') }}" class="logo-link">
                    <img class="logo-light logo-img" src="{{ asset('assets/images/logo.png') }}" srcset="{{ asset('assets/images/logo.png') }} 2x" alt="logo">
                    <img class="logo-dark logo-img" src="{{ asset('assets/images/logo.png') }}" srcset="{{ asset('assets/images/logo.png') }} 2x" alt="logo-dark">
                </a>
            </div>

            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown event-dropdown">
                        <a href="#" class="dropdown-toggle mr-n1" data-toggle="dropdown">
                            <div class="event-toggle">
                                <div class="event-avatar sm">
                                    <em class="icon ni ni-event-alt"></em>
                                </div>
                                <div class="event-info d-none d-xl-block">
                                    <div class="event-status event-status-active">{{ auth()->event()->name }}</div>
                                    <div class="event-name dropdown-indicator">{{ auth()->event()->email }}</div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                            <div class="dropdown-inner event-card-wrap bg-lighter d-none d-md-block">
                                <div class="event-card">
                                    <div class="event-avatar">
                                        <span>{{ substr(auth()->event()->name, 0,2) }}</span>
                                    </div>
                                    <div class="event-info">
                                        <span class="lead-text">{{ auth()->event()->name }}</span>
                                        <span class="sub-text">{{ auth()->event()->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <em class="icon ni ni-signout"></em>
                                            <span>Sign out</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
