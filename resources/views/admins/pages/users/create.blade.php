@extends('layouts.app')

@section('title', "Creation d'un administrateur")

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Create admin</h3>
                    </div>
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li class="preview-item">
                                        <a href="{{ route('supper.admins.index') }}" class="btn btn-outline-secondary btn-sm d-none d-sm-inline-flex">
                                            <em class="icon ni ni-arrow-left"></em>
                                            <span>Back</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <div class="card">
                    <div class="card-aside-wrap">
                        <div class="card-inner card-inner-lg">
                            <form action="{{ route('supper.admins.store') }}" method="post">
                                @csrf
                                <div class="row  gy-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="name">Name</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control @error('name') error @enderror"
                                                    id="name"
                                                    value="{{ old('name') }}"
                                                    name="name"
                                                    placeholder="name"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="lastName">Laste name</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control @error('lastName') error @enderror"
                                                    id="lastName"
                                                    value="{{ old('lastName') }}"
                                                    name="lastName"
                                                    placeholder="laste name"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="email">Email</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="email"
                                                    class="form-control @error('email') error @enderror"
                                                    id="email"
                                                    value="{{ old('email') }}"
                                                    name="email"
                                                    placeholder="email"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="phones">Phones</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control @error('phones') error @enderror"
                                                    id="phones"
                                                    value="{{ old('phones') }}"
                                                    name="phones"
                                                    placeholder="phones"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="password">Password</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="password"
                                                    class="form-control @error('password') error @enderror"
                                                    id="password"
                                                    name="password"
                                                    placeholder="password"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="password_confirmation">Password</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="password"
                                                    class="form-control @error('password_confirmation') error @enderror"
                                                    id="password_confirmation"
                                                    name="password_confirmation"
                                                    placeholder="password confirmation"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Save admin</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
