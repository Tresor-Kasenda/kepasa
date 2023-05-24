@extends('layouts.front')

@section('title', "Forgot password")

@section('content')
    <div class="container margin-top-40">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="style-1">
                    <ul class="tabs-nav">
                        <li>
                            <a href="#tab1">{{ __('Confirm Password') }}</a>
                        </li>
                    </ul>
                    <div class="tabs-container alt">
                        <div class="tab-content mb-4" id="tab1" style="display: none;">

                            <form method="post" class="login" action="{{ route('password.confirm') }}" style="margin-bottom: 5%">
                                @csrf
                                <p class="form-row form-row-wide">
                                    <label for="password">
                                        {{ __('Password') }} :
                                        <input
                                            type="text"
                                            class="input-text @error('password') is-invalid @enderror"
                                            name="password"
                                            id="password"
                                            value="{{ old('password') }}"
                                            required autocomplete="current-password"
                                        />
                                    </label>
                                    @if (Route::has('password.request'))
                                        <span class="lost_password">
                                            <a href="{{ route('password.request') }}" >
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        </span>
                                    @endif
                                    @error('email')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                                </p>
                                <div class="form-row">
                                    <button type="submit" class="button border margin-top-5">
                                        {{ __('Confirm Password') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection
