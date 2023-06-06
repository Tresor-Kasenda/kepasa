<a href="#" class="dashboard-responsive-nav-trigger">
    <i class="fa fa-reorder"></i>
    Dashboard Navigation
</a>
<div class="dashboard-nav">
    <div class="dashboard-nav-inner">
        <ul data-submenu-title="Main">
            <li class="{{ Request::url() === route('event.index') ? 'active' : '' }}">
                <a href="{{ route('event.index') }}">
                    <i class="sl sl-icon-settings"></i> Dashboard
                </a>
            </li>
        </ul>
        <ul data-submenu-title="Listings">
            <li class="{{ Request::url() === route('event.events.index') ? 'active' : '' }}">
                <a href="{{ route('event.events.index') }}">
                    <i class="sl sl-icon-list"></i> Event
                </a>
            </li>
            <li class="{{ Request::url() === route('event.bookings.index') ? 'active' : '' }}">
                <a href="{{ route('event.bookings.index') }}">
                    <i class="sl sl-icon-wallet"></i> Bookings
                </a>
            </li>
            <li class="{{ Request::url() === route('event.images.index') ? 'active' : '' }}">
                <a href="{{ route('event.images.index') }}">
                    <i class="sl sl-icon-picture"></i> Event images
                </a>
            </li>
        </ul>
        <ul data-submenu-title="Account">
            <li class="{{ Request::url() === route('event.profile.index') ? 'active' : '' }}">
                <a href="{{ route('event.profile.index') }}">
                    <i class="sl sl-icon-event"></i> My Profile
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="sl sl-icon-power"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
