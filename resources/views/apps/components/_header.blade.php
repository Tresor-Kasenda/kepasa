<header id="header-container">
    <div id="header">
        <div class="container">
            <div class="left-side">
                <div id="logo">
                    <a href="{{ route('home.index') }}">
                        <img src="" alt="">
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
                    <ul id="responsive">
                        <li>
                            <a
                                class="{{ Request::url() === route('home.index') ? 'current' : '' }}"
                                href="{{ route('home.index') }}"
                            >Home</a>
                        </li>
                        <li>
                            <a
                                class="{{ Request::url() === route('fee.index') ? 'current' : '' }}"
                                href="{{ route('fee.index') }}"
                            >Event Creation Fee</a>
                        </li>
                        <li>
                            <a
                                class="{{ Request::url() === route('promotion.request') ? 'current' : '' }}"
                                href="{{ route('promotion.request') }}"
                            >Promote your City</a>
                        </li>
                        <li>
                            <a
                                class="{{ Request::url() === route('event.index') ? 'current' : '' }}"
                                href="{{ route('event.index') }}"
                            >Events</a>
                        </li>
                    </ul>
                </nav>
                <div class="clearfix"></div>
            </div>
            <div class="right-side">
                <div class="header-widget">
                    <a href="{{ route('login') }}" class="sign-in {{ Request::url() === route('login') ? 'current' : '' }}">
                        <i class="sl sl-icon-login"></i> Sign In
                    </a>
                    <a href="#" class="button border with-icon">
                        Create event <i class="sl sl-icon-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
