<a href="{{ route('organiser.index') }}" class="dashboard-responsive-nav-trigger">
    <i class="fa fa-reorder"></i>
    Dashboard Navigation
</a>
<div class="dashboard-nav">
    <div class="dashboard-nav-inner">
        <ul>
            <li class="{{ Request::url() === route('organiser.index') ? 'active' : '' }}">
                <a href="{{ route('organiser.index') }}">
                    <i class="sl sl-icon-settings"></i> Dashboard
                </a>
            </li>
        </ul>
        <ul data-submenu-title="Listings">
            <li class="{{ Request::url() === route('organiser.events.index') ? 'active' : '' }}">
                <a href="{{ route('organiser.events.index') }}">
                    <i class="sl sl-icon-list"></i> Event
                </a>
            </li>
            <li class="{{ Request::url() === route('organiser.bookings.index') ? 'active' : '' }}">
                <a href="{{ route('organiser.bookings.index') }}">
                    <i class="sl sl-icon-wallet"></i> Bookings
                </a>
            </li>
            <li class="{{ Request::url() === route('organiser.images.index') ? 'active' : '' }}">
                <a href="{{ route('organiser.images.index') }}">
                    <i class="sl sl-icon-picture"></i> Event images
                </a>
            </li>
        </ul>
        <ul data-submenu-title="Account">
            <li class="{{ Request::url() === route('organiser.profile') ? 'active' : '' }}">
                <a href="{{ route('organiser.profile') }}">
                    <i class="sl sl-icon-user"></i> My Profile
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
