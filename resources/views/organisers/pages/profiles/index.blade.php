@extends('layouts.organiser')

@section('title', "Modification des informations de l'organteur d'evenement")

@section('content')
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>My Profile</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('organiser.organiser.index') }}">Home</a></li>
                        <li><a href="{{ route('organiser.profile.index') }}">Dashboard</a></li>
                        <li>My Profile</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="dashboard-list-box margin-top-0">
                <h4 class="gray">Profile Details</h4>
                <div class="dashboard-list-box-static">
                    <form action="" enctype="multipart/form-data">
                        <div class="edit-profile-photo">
                            <img src="{{ asset('assets/images/profile.jpg') }}" alt="Photo de profile">
                            <div class="change-photo-btn">
                                <div class="photoUpload">
                                    <span><i class="fa fa-upload"></i> Upload Photo</span>
                                    <input type="file" class="upload" />
                                </div>
                            </div>
                        </div>

                        <div class="my-profile">
                            <label>Your Name</label>
                            <input value="Tom Perrin" type="text">
                            <label>Phone</label>
                            <input value="(123) 123-456" type="text">
                            <label>Email</label>
                            <input value="tom@example.com" type="text">
                            <label>Notes</label>
                            <textarea name="notes" id="notes" cols="30" rows="10"></textarea>
                            <label><i class="fa fa-twitter"></i> Twitter</label>
                            <input placeholder="https://www.twitter.com/" type="text">

                            <label><i class="fa fa-facebook-square"></i> Facebook</label>
                            <input placeholder="https://www.facebook.com/" type="text">

                            <label><i class="fa fa-google-plus"></i> Google+</label>
                            <input placeholder="https://www.google.com/" type="text">
                        </div>

                        <button class="button margin-top-15">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="dashboard-list-box margin-top-0">
                <h4 class="gray">Change Password</h4>
                <div class="dashboard-list-box-static">
                    <div class="my-profile">
                        <label class="margin-top-0">Current Password</label>
                        <input type="password">

                        <label>New Password</label>
                        <input type="password">

                        <label>Confirm New Password</label>
                        <input type="password">

                        <button class="button margin-top-15">Change Password</button>
                    </div>

                </div>
            </div>
        </div>

@endsection


