<x-app-layout>
    @section('title', "Creation d'un administrateur")

    <x-vex-container>
        <x-brandcrumb title="Edit users">
            <li class="nk-block-tools-opt d-none d-sm-block">
                <x-vex-link href="{{ route('supper.users-list') }}" class="btn btn-dim btn-outline-primary">
                    <x-vex-icon class="ni-arrow-long-left" />
                    <span>All users</span>
                </x-vex-link>
            </li>
        </x-brandcrumb>

        <x-vex-containt>
            <form action="{{ route('supper.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row  gy-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <div class="form-control-wrap">
                                <input
                                        type="text"
                                        class="form-control @error('name') error @enderror"
                                        id="name"
                                        value="{{ old('name') ?? $user->name }}"
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
                                        value="{{ old('lastName') ?? $user->lastName }}"
                                        name="lastName"
                                        placeholder="laste name"
                                >
                                @error('lastName')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="country">Country</label>
                            <div class="form-control-wrap">
                                <select class="form-control js-select2 @error('country') error @enderror" data-search="on" id="country" name="country">
                                    <option value="{{ $user->country->id ?? "" }}" class="bg-gray-400 text-md">
                                        {{ $user->country->countryName ?? " " }}
                                    </option>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <div class="form-control-wrap">
                                <input
                                        type="email"
                                        class="form-control @error('email') error @enderror"
                                        id="email"
                                        value="{{ old('email') ?? $user->email }}"
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
                                        value="{{ old('phones') ?? $user->phones }}"
                                        name="phones"
                                        placeholder="phones"
                                >
                                @error('phones')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="images">Picture</label>
                            <div class="form-control-wrap">
                                <input
                                        type="file"
                                        class="form-control @error('images') error @enderror"
                                        id="images"
                                        value="{{ old('images') ?? $user->images }}"
                                        name="images"
                                        placeholder="images"
                                >
                                @error('images')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-dim btn-outline-primary">
                        <x-vex-icon class="ni-save"/>
                        <span>Update Users</span>
                    </button>
                </div>
            </form>
        </x-vex-containt>

    </x-vex-container>
</x-app-layout>
