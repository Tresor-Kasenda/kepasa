@extends('layouts.app')

@section('title', "Parametre de l'application")

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="components-preview wide-md mx-auto">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <div class="nk-block-between">
                                <div class="nk-block-head-content">
                                    <h3 class="nk-block-title page-title">Settings</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs">
                        <div class="col-lg-6">
                            <div class="card h-100">
                                <div class="card-inner">
                                    <div class="card-head">
                                        <h5 class="card-title">Web Store Setting</h5>
                                    </div>
                                    <form action="{{ route('supper.settings.store', auth()->user()->key) }}" method="POST" class="gy-3 form-settings">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label class="form-label" for="name">Site Name</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control @error('name') error @enderror"
                                                    id="name"
                                                    name="name"
                                                    value="{{ old('name') ?? auth()->user()->app->name }}">
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
                                                    value="{{ old('email') ?? auth()->user()->app->email }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="copyright">Site Copyright</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control @error('copyright') error @enderror"
                                                    id="copyright"
                                                    name="copyright"
                                                    value="{{ old('copyright') ?? auth()->user()->app->copyright }}">
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
                                                    value="{{ old('username') ?? auth()->user()->name }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="username">Admin lastname</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control @error('lastname') error @enderror"
                                                    id="lastname"
                                                    name="lastname"
                                                    value="{{ old('lastname') ?? auth()->user()->lastName }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="phones">Admin phones</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="tel"
                                                    class="form-control @error('phones') error @enderror"
                                                    id="phones"
                                                    name="phones"
                                                    value="{{ old('phones') ?? auth()->user()->phones }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="adminEmail">Admin email</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="email"
                                                    class="form-control @error('adminEmail') error @enderror"
                                                    id="adminEmail"
                                                    name="adminEmail"
                                                    value="{{ old('adminEmail') ?? auth()->user()->email }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-md btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card h-100">
                                <div class="card-inner">
                                    <div class="card-head">
                                        <h5 class="card-title">Update Password</h5>
                                    </div>
                                    <form action="{{ route('supper.settings.password', auth()->user()->key) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label class="form-label" for="current-password">Current password</label>
                                            <input type="password" class="form-control" id="current-password" name="current-password">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="password">New password</label>
                                            <input
                                                type="password"
                                                class="form-control @error('password') error @enderror"
                                                id="password"
                                                name="password"
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="password_confirmation">Repeat Password</label>
                                            <input
                                                type="password"
                                                class="form-control"
                                                id="password_confirmation"
                                                name="password_confirmation"
                                            >
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-md btn-primary">Update password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
