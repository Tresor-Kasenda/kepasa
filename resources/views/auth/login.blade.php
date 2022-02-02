@extends('layouts.front')

@section('title', "Authentification and enregistrement")

@section('content')
    <div class="container margin-top-40">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="style-1">
                    <ul class="tabs-nav">
                        <li class="">
                            <a href="#tab1">Log In</a>
                        </li>
                        <li>
                            <a href="#tab2">Register</a>
                        </li>
                    </ul>
                    <div class="tabs-container alt">
                        <div class="tab-content mb-4" id="tab1" style="display: none;">
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
                                        <a href="#" >Lost Your Password?</a>
                                    </span>
                                </p>

                                <div class="form-row">
                                    <button type="submit" class="button border margin-top-5">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-content mb-4" id="tab2" style="display: none;">
                            <form method="post" class="register" action="{{ route('register') }}">
                                @csrf
                                <p class="form-row form-row-wide">
                                    <label for="username">
                                        Register As
                                        <select class="input-text" name="type" id="username" required>
                                            <option value="organiser">Event Organiser</option>
                                            <option value="customer">Customer</option>
                                        </select>
                                    </label>
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
                                </p>
                                <p class="form-row form-row-wide">
                                    <label for="phones">
                                        Contact:
                                        <input
                                            type="text"
                                            class="input-text"
                                            name="phones"
                                            id="phones"
                                            required
                                            value="{{ old('phones') }}"
                                        />
                                    </label>
                                </p>
                                <p class="form-row form-row-wide">
                                    <label for="password1">
                                        Password:
                                        <input
                                            class="input-text"
                                            type="password"
                                            name="password1"
                                            id="password1"
                                            required
                                            autocomplete="new-password"
                                        />
                                    </label>
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
                                </p>
                                <button type="submit" class="button border fw margin-top-10">
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
