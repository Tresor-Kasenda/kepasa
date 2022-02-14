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
            <li class="{{ Request::url() === route('organiser.events.index') ? 'active' : '' }}">
                <a href="{{ route('organiser.events.index') }}">
                    <i class="sl sl-icon-list"></i> Event
                </a>
            </li>
            <li class="{{ Request::url() === route('organiser.billing.index') ? 'active' : '' }}">
                <a href="{{ route('organiser.billing.index') }}">
                    <i class="sl sl-icon-wallet"></i> Billing
                </a>
            </li>
            <li class="{{ Request::url() === route('organiser.images.index') ? 'active' : '' }}">
                <a href="{{ route('organiser.images.index') }}">
                    <i class="sl sl-icon-picture"></i> Event images
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
