@extends('layouts.app')

@section('title', "Creation de categorie")

@section('content')
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between g-3">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Article</h3>
                </div>
                <div class="nk-block-head-content">
                    <a href="{{ route('supper.category.index') }}" class="btn btn-outline-light btn-sm bg-white d-none d-sm-inline-flex">
                        <em class="icon ni ni-arrow-left"></em>
                        <span>Back</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="nk-block">
            <div class="card">
                <div class="card-aside-wrap">
                    <div class="card-inner card-inner-lg">
                        <form action="{{ route('supper.category.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="name">Name category</label>
                                <div class="form-control-wrap">
                                    <input
                                        type="text"
                                        class="form-control @error('name') error @enderror"
                                        id="name"
                                        value="{{ old('name') }}"
                                        name="name"
                                        placeholder="category"
                                    >
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Save category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
