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

    <div class="row" id="message"></div>

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="dashboard-list-box margin-top-0">
                <h4 class="gray">Profile Details</h4>
                <div class="dashboard-list-box-static">
                    <div class="edit-profile-photo">
                        <img src="{{ asset('assets/images/profile.jpg') }}" id="preview" alt="Photo de profile">
                        <div class="change-photo-btn">
                            <div class="photoUpload">
                                <span><i class="fa fa-upload"></i></span>
                                <input type="file" class="upload" name="images" id="images" />
                            </div>
                        </div>
                    </div>
                    <form class="updateDetails" method="post">
                        <div class="my-profile">
                            <label for="name">Name</label>
                            <input
                                type="text"
                                value="{{ auth()->user()->name ?? "" }}"
                                name="name"
                                id="name"
                            >
                            <label for="lastName">Last Name</label>
                            <input
                                type="text"
                                value="{{ auth()->user()->lastName ?? "" }}"
                                name="lastName"
                                id="lastName"
                            >
                            <label for="email">Email</label>
                            <input
                                value="{{ auth()->user()->email ?? "" }}"
                                type="email"
                                name="email"
                                id="email"
                                disabled
                            >
                            <label for="phones">Phone</label>
                            <input
                                value="{{ auth()->user()->phones ?? "" }}"
                                type="text"
                                name="phones"
                                id="phones"
                            >
                            <label for="alternativeNumber">Alternative Number</label>
                            <input
                                value="{{ auth()->user()->company->alternativeNumber ?? "" }}"
                                type="text"
                                name="alternativeNumber"
                                id="alternativeNumber"
                            >
                            <label for="companyName">Company Name</label>
                            <input
                                value="{{ auth()->user()->company->companyName ?? "" }}"
                                type="text"
                                name="companyName"
                                id="companyName"
                            >
                            <label for="email">Company Email</label>
                            <input
                                value="{{ auth()->user()->company->email ?? "" }}"
                                type="email"
                                name="companyEmail"
                                id="companyEmail"
                            >
                            <label for="address">Company Address</label>
                            <input
                                value="{{ auth()->user()->company->address ?? "" }}"
                                type="text"
                                name="address"
                                id="address"
                            >
                            <label for="companyWebsite">Company Website</label>
                            <input
                                value="{{ auth()->user()->company->website ?? "" }}"
                                type="url"
                                name="companyWebsite"
                                id="companyWebsite"
                            >
                            <label for="country">Country</label>
                            <select type="text" name="country" id="country" value="{{ auth()->user()->company->country}}">
                                <option value="{{ auth()->user()->company->country}}">{{ auth()->user()->company->country}}</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->countryCode }}">
                                        {{ $country->countryName }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="city"> City</label>
                            <input
                                value="{{ auth()->user()->company->city ?? "" }}"
                                type="text"
                                name="city"
                                id="city"
                            >
                        </div>
                        <button type="submit" class="button margin-top-15">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="dashboard-list-box margin-top-0">
                <h4 class="gray">Change Password</h4>
                <div class="dashboard-list-box-static">
                    <div class="my-profile">
                        <form method="post" class="submitPassword">
                            <label for="oldPassword" class="margin-top-0">Current Password</label>
                            <input
                                type="password"
                                name="oldPassword"
                                id="oldPassword"
                            >
                            <label for="password">New Password</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                            >
                            <label for="password_confirmation">Confirm New Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                            >
                            <span class="text-sm-left small" id="message1"></span> <br>
                            <button type="submit" class="button margin-top-15" id="updatePassword">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#password, #password_confirmation').on('keyup', function () {
            if ($('#password').val() === $('#password_confirmation').val()) {
                $('#message1').html('Le mot de passe correspond').css('color', 'green');
                $('#updatePassword').prop('disabled', false);
            } else {
                $('#message1').html('Le mot de passe ne correspond pas').css('color', 'red');
                $('#updatePassword').prop('disabled', true);
            }
        })

        $(document).on("click", "#password_confirmation", function () {
            $(document).on('submit', '.submitPassword', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('organiser.profile.store') }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        swal(`${response.messages}`);
                    }
                });
            });
        })

        $(document).ready(function () {
            $(document).on('submit', '.updateDetails', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('organiser.company.update') }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        if (response.status === 'success'){
                            swal(`${response.messages}`);
                        } else {
                            swal(`${response.messages}`);
                        }
                    }
                });
            });
        });

        $('#images').on('change', function () {
            const image = $("#images")[0].files[0]
            const fd = new FormData();
            fd.append('image',image);

            $.ajax({
                type: '',
                url: 'POST',
                data: fd,
                processData: false,
                contentType: false,
                success: function (response){

                }
            })
        })
    </script>
@endsection