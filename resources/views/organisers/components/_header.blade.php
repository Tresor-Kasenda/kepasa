<header id="header-container" class="fixed fullwidth dashboard">
    <div id="header" class="not-sticky">
        <div class="container">
            <div class="left-side">
                <div id="logo">
                    <a href="{{ route('organiser.index') }}" class="dashboard-logo">
                        @if(auth()->user()->featureImage)
                            <img src="{{ asset('storage/'.auth()->user()->featureImage->path) }}" alt="{{ auth()->user()->name }}">
                        @else
                            <img src="{{ asset('assets/images/logo.png') }}" alt="{{ auth()->user()->name }}">
                        @endif
                    </a>
                </div>
                <div class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
                    </button>
                </div>
                <nav id="navigation" class="style-1">
                    <ul id="responsive"></ul>
                </nav>
                <div class="clearfix"></div>
            </div>
            <div class="right-side">
                <div class="header-widget">
                    <div class="user-menu">
                        <div class="user-name">
                            <span>
                                @if(auth()->user()->featureImage)
                                    <img src="{{ asset('storage/'. auth()->user()->featureImage->path) }}" alt="{{ auth()->id() }}">
                                @endif
                            </span>{{ auth()->user()->name. " " . auth()->user()->last_name }}</div>
                        <ul>
                            <li>
                                <a href="{{ route('organiser.index') }}">
                                    <i class="sl sl-icon-settings"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('organiser.profile') }}">
                                    <i class="fa fa-calendar-check-o"></i>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout').submit();">
                                    <i class="sl sl-icon-power"></i> Logout
                                </a>
                                <form id="logout" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('organiser.event.create') }}" class="button border with-icon">
                        Add Event
                        <i class="sl sl-icon-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
