<header id="header-container" class="fixed fullwidth dashboard">
    <div id="header" class="not-sticky">
        <div class="container">
            <div class="left-side">
                <div id="logo">
                    <a href="{{ route('event.index') }}">
                        @if(auth()->event()->company->images)
                            <img src="{{ asset('storage/'.auth()->event()->company->images) }}" alt="{{ auth()->event()->name }}">
                        @else
                            <img src="{{ asset('assets/images/logo.png') }}" alt="{{ auth()->event()->name }}">
                        @endif
                    </a>
                    <a href="{{ route('event.index') }}" class="dashboard-logo">
                        @if(auth()->event()->company->images)
                            <img src="{{ asset('storage/'.auth()->event()->company->images) }}" alt="{{ auth()->event()->name }}">
                        @else
                            <img src="{{ asset('assets/images/logo.png') }}" alt="{{ auth()->event()->name }}">
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
                    <div class="event-menu"></div>
                    <a href="{{ route('event.events.create') }}" class="button border with-icon">
                        Add Event
                        <i class="sl sl-icon-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
