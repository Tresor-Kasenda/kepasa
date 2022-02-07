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
                            <h2>{{ auth()->user()->name ?? "" }}  {{ auth()->user()->lastName ?? "" }}</h2>
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
                <form action="" method="post" enctype="multipart/form-data">
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
                                @include('apps.components._country')
                            </select>
                        </div>

                        <div class="col-md-12 margin-top-6">
                            <label>Image</label>
                            <input type="file"
                                   class="form-control-file text-success font-weight-bold"
                                   required name="images" multiple
                                   id="images"
                                   onchange="readUrl(this)"
                                   data-title="Click or Drag in your images(Max size: 10MB)">
                        </div>
                    </div>

                    <button type="submit" id="submit" class="button margin-top-15">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#submit').on('click', function (e) {
                e.preventDefault();
                let name = $('#name').val()
                let firstName = $('#firstName').val()
                let email = $('#email').val()
                let phones = $('#phones').val()
                let alternativePhone = $('#alternativePhones').val()
                let city = $('#city').val()
                let country = $('#country').val()
                let picture = $('#images').val()
                let key = `{{ auth()->user()->key }}`

                $.ajax({
                    type: 'update',
                    url: ``,
                    data: {_key: key, name: name, firstname: firstName, email: email, phones: phones, alternativePhone: alternativePhone, country: country, city: city},
                    dataType: "json",
                    success: function(response){

                    },
                    error: function (error) {

                    }
                })
            })
        })

        function readUrl(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = e => {
                    let imgData = e.target.result;
                    let imgName = input.files[0].name;
                    input.setAttribute("data-title", imgName);
                    console.log(e.target.result);
                };
                return reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
