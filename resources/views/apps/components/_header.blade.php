<header id="header-container">
    <div id="header">
        <div class="container">
            <div class="left-side">
                <div id="logo">
                    <a href="{{ route('home.index') }}">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Kepas">
                    </a>
                    @if(config('app.env') == 'production')
                        @php
                            $ip = request()->ip();
                            $location = \Stevebauman\Location\Facades\Location::get($ip);
                            session()->put([
                                'city' => $location->cityName
                            ]);
                        @endphp
                        <div class="margin-top-8 font-weight-bold">{{ $location->cityName ?? "" }}</div>
                    @endif
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
                    @auth
                        @if(auth()->user()->role_id == 1)
                            <a href="{{ route('supper.dashboard.index') }}" class="button {{ Request::url() === route('user.home.index') ? 'current' : '' }}">
                                Profile <i class="sl sl-icon-user"></i>
                            </a>
                        @endif
                        @if(auth()->user()->role_id == 4)
                            <a
                                href="{{ route('user.home.index') }}"
                                class="button {{ Request::url() === route('user.home.index') ? 'current' : '' }}">
                                Profile <i class="sl sl-icon-user"></i>
                            </a>
                        @endif
                        @if(auth()->user()->role_id == 3)
                            <a href="{{ route('organiser.organiser.index') }}" class="button {{ Request::url() === route('organiser.organiser.index') ? 'current' : '' }}">
                                Profile <i class="sl sl-icon-user"></i>
                            </a>
                        @endif
                        <a href="{{ route('logout') }}" class="sign-in popup-with-zoom-anim mr-5" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="sl sl-icon-logout"></i>
                            <span>Sign out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="sign-in {{ Request::url() === route('login') ? 'current' : '' }}">
                            <i class="sl sl-icon-login"></i> Sign In
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>
