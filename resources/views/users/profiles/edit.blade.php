@extends('layouts.front')

@section('content')
    <div class="clearfix"></div>

    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="event-profile-titlebar">
                        <div class="event-profile-avatar">
                            <img
                                @if(auth()->event()->profile->image == null)
                                    src="{{ asset('assets/images/profile.jpg') }}"
                                    alt="{{ auth()->event()->name ?? "" }}"
                                @else
                                    src="{{ asset('storage/'.auth()->event()->profile->image) }}"
                                    alt="{{ auth()->event()->name ?? "" }}"
                                @endif
                            >
                        </div>
                        <div class="event-profile-name">
                            <a href="{{ route('event.home.index') }}">
                                <h2>{{ auth()->event()->name ?? "" }}  {{ auth()->event()->lastName ?? "" }}</h2>
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
                        <li><i class="sl sl-icon-phone"></i> {{ auth()->event()->phones ?? "" }}</li>
                        <li><i class="fa fa-envelope-o"></i> <a href="#">{{ auth()->event()->email ?? "" }}</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-8 col-md-8 padding-left-30">
                <form action="{{ route('event.home.update', auth()->event()->key) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <label>First Name</label>
                            <input type="text" name="name" id="name" value="{{ auth()->event()->name ?? "" }}">
                        </div>

                        <div class="col-md-6">
                            <label>Last Name</label>
                            <input type="text" name="lastName" id="lastName" value="{{ auth()->event()->lastName ?? "" }}">
                        </div>

                        <div class="col-md-6">
                            <label>E-Mail Address</label>
                            <input type="text" name="email" id="email" value="{{ auth()->event()->email ?? "" }}">
                        </div>

                        <div class="col-md-6">
                            <label>Phone</label>
                            <input type="tel" name="phones" id="phones" value="{{ auth()->event()->profile->phones ?? "" }}">
                        </div>

                        <div class="col-md-6">
                            <label>Alternantive Phone</label>
                            <input type="tel" name="alternativePhones" id="alternativePhones" value="{{ auth()->event()->profile->alternativePhones ?? "" }}">
                        </div>

                        <div class="col-md-6">
                            <label>City</label>
                            <input type="text" name="city" id="city" value="{{ auth()->event()->profile->city ?? "" }}">
                        </div>

                        <div class="col-md-12">
                            <h5>Country</h5>
                            <select class="chosen-select-no-single" id="country" value="{{ auth()->event()->profile->country ?? "" }}" name="country" >
                                <option value="{{ auth()->event()->profile->country ?? "" }}">
                                    {{ auth()->event()->profile->country ?? "" }}
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
                                   name="image"
                                   id="image"
                                   data-title="Click or Drag in your images(Max size: 10MB)">
                        </div>
                    </div>

                    <button type="submit" id="submit" class="button margin-top-15">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
