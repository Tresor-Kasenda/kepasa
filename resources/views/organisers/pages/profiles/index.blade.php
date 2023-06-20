<x-organiser-layout>

    @section('title', "Profile information")

    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>My Profile</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('organiser.index') }}">Home</a></li>
                        <li><a href="{{ route('organiser.profile') }}">Dashboard</a></li>
                        <li>My Profile</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="row" id="message">
        @include('organisers.partials._flash')
    </div>

    <div class="style-1 mt-2">
        <ul class="tabs-nav" x-data="{ organiserTab: $persist('profile') }">
            <li @click.prevent="organiserTab='profile'" :class="organiserTab === 'profile' ? 'active' : ''">
                <a href="#profile" @click.prevent="organiserTab='profile'" :class="organiserTab === 'profile' ? 'active' : ''">
                    <i class="sl sl-icon-user"></i>
                    Update Profile
                </a>
            </li>
            <li @click.prevent="organiserTab='company'" :class="organiserTab === 'company' ? 'active' : ''">
                <a href="#company" @click.prevent="organiserTab='company'" :class="organiserTab === 'company' ? 'active' : ''">
                    <i class="sl sl-icon-pin"></i>
                    Company
                </a>
            </li>
            <li @click.prevent="organiserTab='password'" :class="organiserTab === 'password' ? 'active' : ''">
                <a href="#password" @click.prevent="organiserTab='password'" :class="organiserTab === 'password' ? 'active' : ''">
                    <i class="sl sl-icon-pin"></i>
                    Update password
                </a>
            </li>
        </ul>

        <div class="tabs-container mb-2">
            <div class="tab-content mb-2" id="profile" :class="organiserTab === 'profile' ? 'active' : ''">
                <div class="dashboard-list-box margin-top-0 mb-3" style="margin-bottom: 2%">
                    <h4 class="gray">Profile Details</h4>
                    <div class="dashboard-list-box-static">
                        <div class="edit-profile-photo">
                            @if(auth()->user()->featureImage)
                            <img
                                    src="{{ asset('storage/'.auth()->user()->featureImage->path) }}"
                                    id="{{ auth()->user()->name }}"
                                    alt="Photo de profile">
                            @else
                                <img
                                    src="{{ asset('assets/images/profile.jpg') }}"
                                    id="preview"
                                    alt="Photo de profile">
                            @endif
                            <div class="change-photo-btn">
                                <div class="photoUpload">
                                    <span><i class="fa fa-upload"></i></span>
                                    <input type="file" class="upload" name="avatar" id="avatar"/>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('organiser.profile.update', auth()->id()) }}" class="updateDetails" method="post">
                            @csrf
                            <div class="row with-forms">
                                <div class="col-md-6">
                                    <h5>Name</h5>
                                    <input
                                        type="text"
                                        value="{{ old('name') ?? auth()->user()->name }}"
                                        name="name"
                                        id="name"
                                    >
                                    @error('name')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror

                                    <h5>Last Name</h5>
                                    <input
                                        type="text"
                                        value="{{ old('last_name') ?? auth()->user()->last_name }}"
                                        name="last_name"
                                        id="last_name"
                                    >
                                    @error('last_name')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror

                                    <h5>Email</h5>
                                    <input
                                        value="{{ auth()->user()->email ?? "" }}"
                                        type="email"
                                        name="email"
                                        id="email"
                                    >
                                    @error('email')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-6">
                                    <h5>Phone</h5>
                                    <input
                                        value="{{ old('phones') ?? auth()->user()->phones }}"
                                        type="text"
                                        name="phones"
                                        id="phones"
                                    >
                                    @error('phones')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror

                                    <h5>Country</h5>
                                    <select type="text" name="country" id="country">
                                        <option value="{{ auth()->user()->country->id ?? "" }}">
                                            {{ auth()->user()->country->country_name ?? "" }}
                                        </option>
                                        @foreach(\App\Models\Country::all() as $country)
                                            <option value="{{ $country->id ?? ""  }}">
                                                {{ $country->country_name ?? ""  }}
                                            </option>"
                                        @endforeach
                                    </select>
                                    @error('country')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror

                                    <h5> City</h5>
                                    <input
                                        value="{{ old('city') }}"
                                        type="text"
                                        name="city"
                                        id="city"
                                    >
                                    @error('city')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <button type="submit" class="button margin-top-15">
                                Update Profile
                                <i class="sl sl-icon-arrow-right-circle"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tab-content mb-2" id="company" :class="organiserTab === 'company' ? 'active' : ''">
                <div class="dashboard-list-box margin-top-0" style="margin-bottom: 2%">
                    <h4 class="gray">Update Company</h4>
                    <div class="dashboard-list-box-static">
                        <form action="{{ route('organiser.profile.update.company', auth()->id()) }}" class="updateDetails" method="post">
                            @csrf
                            <div class="row with-forms">
                                <div class="col-md-6">
                                    <h5>Company Name</h5>
                                    <input
                                        value="{{ old('company_name') ?? auth()->user()->company->company_name }}"
                                        type="text"
                                        name="company_name"
                                        id="company_name"
                                        placeholder="company name"
                                    >
                                    @error('company_name')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror

                                    <h5>Company Address</h5>
                                    <input
                                        value="{{ old('address') ?? auth()->user()->company->address }}"
                                        type="text"
                                        name="address"
                                        id="address"
                                        placeholder="address"
                                    >
                                    @error('address')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror

                                    <h5>Company Phones</h5>
                                    <input
                                        value="{{ old('phonesCompany') ?? auth()->user()->company->phones }}"
                                        type="text"
                                        name="phonesCompany"
                                        id="phonesCompany"
                                        placeholder="phone number"
                                    >
                                    @error('phonesCompany')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror

                                    <h5>Company Email</h5>
                                    <input
                                        value="{{ old('emailCompany') ?? auth()->user()->company->email }}"
                                        type="email"
                                        name="emailCompany"
                                        id="emailCompany"
                                        placeholder="email Company"
                                    >
                                    @error('emailCompany')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6">
                                    <h5>Company Website</h5>
                                    <input
                                        value="{{ old('website') ?? auth()->user()->company->website }}"
                                        type="text"
                                        name="website"
                                        id="website"
                                        placeholder="https://www.facebook.com/"
                                    >
                                    @error('website')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror

                                    <h5><i class="fa fa-facebook-square"></i> Company Social media</h5>
                                    <input
                                        value="{{ old('social_media') ?? auth()->user()->company->social_media }}"
                                        type="text"
                                        name="social_media"
                                        id="social_media"
                                        placeholder="https://www.facebook.com/"
                                    >
                                    @error('social_media')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror

                                    <h5>Country</h5>
                                    <select type="text" name="countryCompany" id="countryCompany">
                                        <option value="{{ auth()->user()->country->id ?? ""}}">{{ auth()->user()->country->country_name ?? "" }}</option>
                                        @foreach(\App\Models\Country::all() as $country)
                                            <option value="{{ $country->id }}">
                                                {{ $country->country_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('countryCompany')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror

                                    <h5> City</h5>
                                    <input
                                        value="{{ old('cityName') ?? auth()->user()->company->city }}"
                                        type="text"
                                        name="cityName"
                                        id="cityName"
                                        placeholder="city name"
                                    >
                                    @error('cityName')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <button type="submit" class="button margin-top-15">
                                Update Company
                                <i class="sl sl-icon-arrow-right-circle"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tab-content mb-2" id="password" :class="organiserTab === 'password' ? 'active' : ''">
                <div class="dashboard-list-box margin-top-0" style="margin-bottom: 2%">
                    <h4 class="gray">Change Password</h4>
                    <div class="dashboard-list-box-static">
                        <div class="my-profile">
                            <form action="{{ route('organiser.profile.update', auth()->id()) }}" method="post" class="submitPassword">
                                @csrf
                                @method('PUT')
                                <div class="row with-forms">
                                    <div class="col-md-6">
                                        <h5>Company Email</h5>
                                        <input
                                            value="{{ old('userEmail') ?? auth()->user()->email }}"
                                            type="email"
                                            name="userEmail"
                                            id="userEmail"
                                        >
                                        @error('userEmail')<span style="font-size: 13px;color: rgba(255,0,0,0.76);font-weight: 500;">{{ $message }}</span>@enderror

                                        <h5>Current Password</h5>
                                        <input
                                            type="password"
                                            name="oldPassword"
                                            id="oldPassword"
                                        >

                                    </div>
                                    <div class="col-md-6">
                                        <h5>New Password</h5>
                                        <input
                                            type="password"
                                            name="password"
                                            id="password"
                                        >
                                        <h5>Confirm New Password</h5>
                                        <input
                                            type="password"
                                            name="password_confirmation"
                                            id="password_confirmation"
                                        >
                                    </div>
                                </div>

                                <button type="submit" class="button margin-top-15" id="updatePassword">
                                    Change Password
                                    <i class="sl sl-icon-arrow-right-circle"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script type="text/javascript">
            const images = document.querySelector('#avatar');
            images.addEventListener('change', () => {
                let form  = new FormData();
                let files  = images.files[0]
                form.append('avatar',files);

                previewImage(files)

                fetch(`{{ route('organiser.profile.upload') }}`, {
                    method: 'POST',
                    body: form,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                })
                    .then((response) => {
                        if (response.status === 200) {
                            Swal("Congrats!", `${response.message}`, "success");
                        }
                    })
                    .catch((error) => {
                        Swal("Congrats!", `${error}`, "success");
                    });
            })

            function previewImage(file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    let preview = document.getElementById('preview');
                    preview.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        </script>
    @endsection
</x-organiser-layout>
