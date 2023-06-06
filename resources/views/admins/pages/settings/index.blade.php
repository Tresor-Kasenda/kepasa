@php use App\Models\Country; @endphp
<x-app-layout>
    @section('title', "Parametre de l'application")

    <x-vex-container>
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between g-3">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Users /
                        <strong class="text-primary small">
                            {{ auth()->event()->name." ". auth()->event()->lastName }}
                        </strong>
                    </h3>
                    <div class="nk-block-des text-soft">
                        <ul class="list-inline">
                            <li>User ID: <span class="text-base">{{ auth()->event()->id }}</span></li>
                            <li>Last Login: <span class="text-base">15 Feb, 2019 01:02 PM</span></li>
                        </ul>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <a href="{{ route('supper.dashboard') }}" class="btn btn-outline-light btn-dim bg-white d-none d-sm-inline-flex">
                        <em class="icon ni ni-arrow-left"></em>
                        <span>Back</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="nk-block">
            <div class="card">
                <div class="card-aside-wrap">
                    <div class="card-content" x-data="{ currentTable: $persist('personal') }">
                        <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a
                                        class="nav-link"
                                        data-bs-toggle="tab"
                                        href="#personal"
                                        aria-selected="true"
                                        @click.prevent="currentTable='personal'"
                                        :class="currentTable === 'personal' ? 'active' : ''"
                                        role="tab">
                                    <em class="icon ni ni-event-circle"></em>
                                    <span>Personal</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a
                                        class="nav-link"
                                        data-bs-toggle="tab"
                                        href="#settings"
                                        aria-selected="true"
                                        @click.prevent="currentTable='settings'"
                                        :class="currentTable === 'settings' ? 'active' : ''"
                                        role="tab">
                                    <em class="icon ni ni-setting-alt"></em>
                                    <span>Settings</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a
                                        class="nav-link"
                                        data-bs-toggle="tab"
                                        href="#password"
                                        aria-selected="true"
                                        @click.prevent="currentTable='password'"
                                        :class="currentTable === 'password' ? 'active' : ''"
                                        role="tab">
                                    <em class="icon ni ni-eye-fill"></em>
                                    <span>Password</span>
                                </a>
                            </li>
                            <li class="nav-item nav-item-trigger d-xxl-none">
                                <a href="#" class="toggle btn btn-icon btn-trigger" data-target="userAside">
                                    <em class="icon ni ni-event-list-fill"></em>
                                </a>
                            </li>
                        </ul>
                        <div class="card-inner">
                            <div class="tab-content">
                                <div class="tab-pane" :class="currentTable === 'personal' ? 'active' : ''" id="personal" role="tabpanel">
                                    <div class="nk-block">
                                        <form action="{{ route('supper.admins.change', auth()->event()) }}" method="POST" class="gy-3 form-settings">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="name">Name</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                    type="text"
                                                                    class="form-control @error('name') error @enderror"
                                                                    id="name"
                                                                    name="name"
                                                                    value="{{ old('name') ?? auth()->event()->name }}">
                                                            @error('name')
                                                            <span class="error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label" for="phones">Phones numbers</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                    type="text"
                                                                    class="form-control @error('phones') error @enderror"
                                                                    id="phones"
                                                                    name="phones"
                                                                    value="{{ old('phones') ?? auth()->event()->phones }}">
                                                            @error('phones')
                                                            <span class="error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="country">Country</label>
                                                        <div class="form-control-wrap">
                                                            <select class="form-control @error('country') error @enderror" class="countries" id="country" name="country">
                                                                <option value="default_option">Selected country</option>
                                                                <option value="{{ auth()->event()->country->id ?? "" }}" class="bg-gray-400 text-md">{{ auth()->event()->country->countryName ?? " " }}</option>
                                                                @foreach($countries as $country)
                                                                    <option value="{{ $country->id }}">
                                                                        {{ $country->countryName }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('country')
                                                            <span class="error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="lastName">last name</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                    type="text"
                                                                    class="form-control @error('lastName') error @enderror"
                                                                    id="lastName"
                                                                    name="lastName"
                                                                    value="{{ old('lastName') ?? auth()->event()->lastName }}">
                                                            @error('lastName')
                                                            <span class="error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="email">Email</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                    type="email"
                                                                    class="form-control @error('email') error @enderror"
                                                                    id="email"
                                                                    name="email"
                                                                    value="{{ old('email') ?? auth()->event()->email }}">
                                                            @error('email')
                                                            <span class="error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label" for="phone">Other phones number</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-control-wrap">
                                                                <input
                                                                        type="email"
                                                                        class="form-control @error('phone') error @enderror"
                                                                        id="phone"
                                                                        name="phone"
                                                                        value="{{ old('phone') }}">
                                                                @error('phone')
                                                                <span class="error">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-outline-primary btn-dim">
                                                    <x-vex-icon class="ni-save"/>
                                                    <span>Update Users</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" :class="currentTable === 'settings' ? 'active' : ''" id="settings" role="tabpanel">
                                    <div class="nk-block">
                                        <form action="{{ route('supper.settings.store', auth()->event()) }}" method="POST" class="gy-3 form-settings">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="name">Site Name</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                    type="text"
                                                                    class="form-control @error('name') error @enderror"
                                                                    id="name"
                                                                    name="name"
                                                                    value="{{ old('name') ?? auth()->event()->app->name }}">
                                                            @error('name')
                                                            <span class="error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="email">Site Email</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                    type="email"
                                                                    class="form-control @error('email') error @enderror"
                                                                    id="email"
                                                                    name="email"
                                                                    value="{{ old('email') ?? auth()->event()->app->email }}">
                                                            @error('email')
                                                            <span class="error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="copyright">Site Copyright</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                    type="text"
                                                                    class="form-control @error('copyright') error @enderror"
                                                                    id="copyright"
                                                                    name="copyright"
                                                                    value="{{ old('copyright') ?? auth()->event()->app->copyright }}">
                                                            @error('copyright')
                                                            <span class="error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="username">Admin name</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                    type="text"
                                                                    class="form-control @error('username') error @enderror"
                                                                    id="copyright"
                                                                    name="username"
                                                                    value="{{ old('username') ?? auth()->event()->name }}">
                                                            @error('username')
                                                            <span class="error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-outline-primary btn-dim">
                                                    <x-vex-icon class="ni-save"/>
                                                    <span>Update Settings</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" :class="currentTable === 'password' ? 'active' : ''" id="password" role="tabpanel">
                                    <div class="nk-block">
                                        <form action="{{ route('supper.settings.password', auth()->event()) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="email">Email</label>
                                                        <div class="form-control-wrap">
                                                            <input
                                                                    type="email"
                                                                    class="form-control @error('email') error @enderror"
                                                                    id="email"
                                                                    name="email"
                                                                    value="{{ old('email') }}">
                                                            @error('email')
                                                            <span class="error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="current_password">Current password</label>
                                                        <input
                                                                type="password"
                                                                class="form-control"
                                                                id="current_password"
                                                                name="current_password">
                                                        @error('current_password')
                                                        <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="password">New password</label>
                                                        <input
                                                                type="password"
                                                                class="form-control @error('password') error @enderror"
                                                                id="password"
                                                                name="password"
                                                        >
                                                        @error('password')
                                                        <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="password_confirmation">Repeat Password</label>
                                                        <input
                                                                type="password"
                                                                class="form-control"
                                                                id="password_confirmation"
                                                                name="password_confirmation"
                                                        >
                                                        @error('password_confirmation')
                                                        <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-3">
                                                <button type="submit" class="btn btn-outline-primary btn-dim">
                                                    <x-vex-icon class="ni-save"/>
                                                    <span>Update password</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-aside card-aside-right event-aside toggle-slide toggle-slide-right toggle-break-xxl toggle-screen-xxl" data-content="userAside" data-toggle-screen="xxl" data-toggle-overlay="true" data-toggle-body="true">
                        <div class="card-inner-group" data-simplebar="init">
                            <div class="simplebar-wrapper" style="margin: 0px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;">
                                            <div class="simplebar-content" style="padding: 0px;">
                                                <div class="card-inner">
                                                    <div class="event-card event-card-s2">
                                                        <div class="event-avatar lg bg-primary">
                                                            <span>{{ substr(auth()->event()->name, 0,2) }}</span>
                                                        </div>
                                                        <div class="event-info">
                                                            <div class="badge bg-outline-light rounded-pill ucap">{{ auth()->event()->role->name }}</div>
                                                            <h5>{{ auth()->event()->name . "-" . auth()->event()->lastName }}</h5>
                                                            <span class="sub-text">{{ auth()->event()->email }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-inner card-inner-sm">
                                                    <ul class="btn-toolbar justify-center gx-1">
                                                        <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-shield-off"></em></a></li>
                                                        <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-mail"></em></a></li>
                                                        <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-download-cloud"></em></a></li>
                                                        <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-bookmark"></em></a></li>
                                                    </ul>
                                                </div>
                                                <div class="card-inner">
                                                    <div class="row text-center">
                                                        <div class="col-4">
                                                            <div class="profile-stats">
                                                                <span class="amount">23</span>
                                                                <span class="sub-text">Total Order</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="profile-stats">
                                                                <span class="amount">20</span>
                                                                <span class="sub-text">Complete</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="profile-stats">
                                                                <span class="amount">3</span>
                                                                <span class="sub-text">Progress</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-inner">
                                                    <h6 class="overline-title-alt mb-2">Additional</h6>
                                                    <div class="row g-3">
                                                        <div class="col-6">
                                                            <span class="sub-text">User ID:</span>
                                                            <span>UD003054</span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="sub-text">Last Login:</span>
                                                            <span>15 Feb, 2019 01:02 PM</span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="sub-text">Role:</span>
                                                            <span class="lead-text text-success">{{ auth()->event()->role->name }}</span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="sub-text">Register At:</span>
                                                            <span>{{ auth()->event()->created_at->format('Y m d') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: auto; height: 890px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar" style="height: 403px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-vex-container>

</x-app-layout>