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
                            <a href="#tab1">Forgot Password</a>
                        </li>
                    </ul>
                    <div class="tabs-container alt">
                        <div class="tab-content mb-4" id="tab1" style="display: none;">

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="post" class="login" action="{{ route('password.email') }}" style="margin-bottom: 5%">
                                @csrf
                                <p class="form-row form-row-wide">
                                    <label for="email">
                                        {{ __('Email Address') }} :
                                        <input
                                            type="text"
                                            class="input-text @error('email') is-invalid @enderror"
                                            name="email"
                                            id="email"
                                            value="{{ old('email') }}"
                                            required autocomplete="email" autofocus
                                        />
                                    </label>
                                    @error('email')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                                </p>
                                <div class="form-row">
                                    <button type="submit" class="button border margin-top-5">
                                        {{ __('Send Password Reset Link') }}
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
