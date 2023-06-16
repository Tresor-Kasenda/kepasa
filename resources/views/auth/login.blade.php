@extends('layouts.front')

@section('title', "Authentication an Registration")

@section('content')
    <div class="container margin-top-40">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="style-1" x-data="{ currentTab: $persist('login') }">
                    <ul class="tabs-nav">
                        <li @click.prevent="currentTab='login'" :class="currentTab === 'login' ? 'active' : ''">
                            <a href="#login" @click.prevent="currentTab='login'" :class="currentTab === 'login' ? 'active' : ''">Log In</a>
                        </li>
                        <li @click.prevent="currentTab='register'" :class="currentTab === 'register' ? 'active' : ''">
                            <a href="#register" @click.prevent="currentTab='register'" :class="currentTab === 'register' ? 'active' : ''">Register</a>
                        </li>
                    </ul>
                    <div class="tabs-container alt">
                        <div class="tab-content mb-4" id="login"  style="display: none;" :class="currentTab === 'login' ? 'active' : ''">
                            <form method="post" class="login" action="{{ route('login') }}">
                                @csrf
                                <p class="form-row form-row-wide">
                                    <label for="email">
                                        Email :
                                        <input
                                            type="text"
                                            class="input-text"
                                            name="email"
                                            id="email"
                                            value="{{ old('email') }}"
                                        />
                                    </label>
                                    @error('email')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                                </p>
                                <p class="form-row form-row-wide">
                                    <label for="password">
                                        Password:
                                        <input
                                            class="input-text"
                                            type="password"
                                            name="password"
                                            id="password"
                                        />
                                    </label>
                                    <span class="lost_password">
                                        <a href="{{ route('password.request') }}" >Lost Your Password?</a>
                                    </span>
                                </p>
                                <div class="form-row">
                                    <button type="submit" class="button border margin-top-5">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-content mb-4" id="register" style="display: none;" :class="currentTab === 'register' ? 'active' : ''">
                            <form method="post" class="register" action="{{ route('register') }}">
                                @csrf
                                <p class="form-row form-row-wide">
                                    <label for="role">
                                        Register As
                                        <select class="input-text" name="role" id="role" required>
                                            @foreach(\App\Models\Role::query()->whereIn('id',[2,3])->get() as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    @error('role')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                                </p>
                                <p class="form-row form-row-wide">
                                    <label for="name">
                                        Username:
                                        <input
                                            type="text"
                                            class="input-text"
                                            name="name"
                                            id="name"
                                            value="{{ old('name') }}"
                                        />
                                    </label>
                                    @error('name')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                                </p>
                                <p class="form-row form-row-wide">
                                    <label for="lastName">
                                        Last Name:
                                        <input
                                            type="text"
                                            class="input-text"
                                            name="lastName"
                                            id="lastName"
                                            required
                                            value="{{ old('lastName') }}"
                                        />
                                    </label>
                                    @error('lastName')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                                </p>
                                <p class="form-row form-row-wide">
                                    <label for="email">
                                        Email Address:
                                        <input
                                            type="text"
                                            class="input-text"
                                            name="email"
                                            id="email"
                                            value="{{ old('email') }}"
                                        />
                                    </label>
                                    @error('email')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                                </p>
                                <p class="form-row form-row-wide">
                                    <label for="role">
                                        Select Your Country
                                        <select class="input-text" name="country" id="country" required>
                                            <option value="default">Select Your Country</option>
                                            @foreach(\App\Models\Country::all() as $country)
                                                <option value="{{ $country->id ?? "" }}">{{ $country->country_name ?? "" }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    @error('country')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                                </p>
                                <p class="form-row form-row-wide">
                                    <label for="phones">
                                        Phone Number:
                                        <input
                                            type="text"
                                            class="input-text"
                                            name="phones"
                                            id="phones"
                                            required
                                            value="{{ old('phones') }}"
                                        />
                                    </label>
                                    @error('phones')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                                </p>
                                <p class="form-row form-row-wide">
                                    <label for="password">
                                        Password:
                                        <input
                                            class="input-text"
                                            type="password"
                                            name="password"
                                            id="password"
                                            required
                                            autocomplete="new-password"
                                        />
                                    </label>
                                    @error('password')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                                </p>
                                <p class="form-row form-row-wide">
                                    <label for="password_confirmation">
                                        Repeat Password:
                                        <input
                                            class="input-text"
                                            type="password"
                                            name="password_confirmation"
                                            id="password_confirmation"
                                        />
                                    </label>
                                    <span class="lost_password">
                                        You have a account <a href="{{ route('login') }}" >Login</a>
                                    </span>
                                    @error('password_confirmation')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                                </p>
                                <button type="submit" class="button border fw margin-top-10" style="justify-content: center">
                                    Register
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection
