@php use App\Enums\RoleEnum; @endphp
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
                        <div class="margin-top-8 font-weight-bold" style="color: white;font-weight: bold; font-size: 16px">
                            {{ $location->cityName ?? "" }}
                        </div>
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
                                class="{{ Request::url() === route('promoted.index') ? 'current' : '' }}"
                                href="{{ route('promoted.index') }}"
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
                        @if(auth()->user()->role_id == RoleEnum::ROLE_SUPER)
                            <a href="{{ route('supper.dashboard') }}" class="button {{ Request::url() === route('supper.dashboard') ? 'current' : '' }}">
                                Profile <i class="sl sl-icon-user"></i>
                            </a>
                        @endif
                        @if(auth()->user()->role_id == RoleEnum::ROLE_USERS)
                            <a
                                href=""
                                class="button">
                                Profile <i class="sl sl-icon-user"></i>
                            </a>
                        @endif
                        @if(auth()->user()->role_id == RoleEnum::ROLE_ORGANISER)
                            <a href="{{ route('organiser.index') }}" class="button {{ Request::url() === route('organiser.index') ? 'current' : '' }}">
                                Profile <i class="sl sl-icon-user"></i>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="button border with-icon">
                            <i class="sl sl-icon-login"></i> Sign In
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>
