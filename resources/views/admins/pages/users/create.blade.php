<x-app-layout>
    @section('title', "Creation d'un administrateur")

    <x-vex-container>
        <x-brandcrumb title="Create users">
            <li class="nk-block-tools-opt d-none d-sm-block">
                <x-vex-link href="{{ route('supper.users-list') }}" class="btn btn-dim btn-outline-primary">
                    <x-vex-icon class="ni-arrow-long-left" />
                    <span>All users</span>
                </x-vex-link>
            </li>
        </x-brandcrumb>
        <div class="nk-block">
            <div class="card card-bordered">
                <div class="card-inner">
                    <form action="{{ route('supper.users.store') }}" method="post" class="form-validate">
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
                                        @error('name')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

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
                                        @error('lastName')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

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
                                        @error('password')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
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
                                        @error('email')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

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
                                        @error('phones')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="country">Country</label>
                                    <div class="form-control-wrap">
                                        <select class="form-control @error('country') error @enderror" class="countries" id="country" name="country">
                                            <option value="default_option">Selected country</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}">
                                                    {{ $country->countryName }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('country')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-dim btn-outline-primary">
                                <x-vex-icon class="ni-save"/>
                                <span>Save Users</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-vex-container>
</x-app-layout>


