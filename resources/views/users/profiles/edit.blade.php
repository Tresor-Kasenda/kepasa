@extends('layouts.front')

@section('content')
    <div class="clearfix"></div>

    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="user-profile-titlebar">
                        <div class="user-profile-avatar">
                            <img src="{{ asset('storage/',auth()->user()->profile->images) }}" alt="{{ auth()->user()->name ?? "" }}">
                        </div>
                        <div class="user-profile-name">
                            <a href="{{ route('user.home.index') }}">
                                <h2>{{ auth()->user()->name ?? "" }}  {{ auth()->user()->lastName ?? "" }}</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row sticky-wrapper">
            <div class="col-lg-4 col-md-4 margin-top-0">
                <div class="boxed-widget margin-top-10 margin-bottom-50">
                    <h3>Contact</h3>
                    <ul class="listing-details-sidebar">
                        <li><i class="sl sl-icon-phone"></i> {{ auth()->user()->phones ?? "" }}</li>
                        <li><i class="fa fa-envelope-o"></i> <a href="#">{{ auth()->user()->email ?? "" }}</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-8 col-md-8 padding-left-30">
                <form action="{{ route('user.home.update', auth()->user()->key) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <label>First Name</label>
                            <input type="text" name="name" id="name" value="{{ auth()->user()->name ?? "" }}">
                        </div>

                        <div class="col-md-6">
                            <label>Last Name</label>
                            <input type="text" name="lastName" id="lastName" value="{{ auth()->user()->lastName ?? "" }}">
                        </div>

                        <div class="col-md-6">
                            <label>E-Mail Address</label>
                            <input type="text" name="email" id="email" value="{{ auth()->user()->email ?? "" }}">
                        </div>

                        <div class="col-md-6">
                            <label>Phone</label>
                            <input type="tel" name="phones" id="phones" value="{{ auth()->user()->profile->phones ?? "" }}">
                        </div>

                        <div class="col-md-6">
                            <label>Alternantive Phone</label>
                            <input type="tel" name="alternativePhones" id="alternativePhones" value="{{ auth()->user()->profile->alternativePhones ?? "" }}">
                        </div>

                        <div class="col-md-6">
                            <label>City</label>
                            <input type="text" name="city" id="city" value="{{ auth()->user()->profile->city ?? "" }}">
                        </div>

                        <div class="col-md-12">
                            <h5>Country</h5>
                            <select class="chosen-select-no-single" id="country" value="{{ auth()->user()->profile->country ?? "" }}" name="country" >
                                <option value="{{ auth()->user()->profile->country ?? "" }}">
                                    {{ auth()->user()->profile->country ?? "" }}
                                </option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->countryName }}">
                                        {{ $country->countryName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 margin-top-6">
                            <label>Image</label>
                            <input type="file"
                                   class="form-control-file text-success font-weight-bold"
                                   required name="images"
                                   id="images"
                                   data-title="Click or Drag in your images(Max size: 10MB)">
                        </div>
                    </div>

                    <button type="submit" id="submit" class="button margin-top-15">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
