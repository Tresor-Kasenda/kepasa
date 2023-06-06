<x-app-layout>
    @section('title', "Ville du pays")

    <x-vex-container>
        <x-brandcrumb title="Edit {{ $city->cityName }}">
            <x-vex-link href="{{ route('supper.country-list') }}" class="btn btn-dim btn-outline-primary">
                <x-vex-icon class="ni-arrow-long-left"/>
                <span>All countries</span>
            </x-vex-link>
        </x-brandcrumb>

        <x-vex-containt>
            <form action="{{ route('supper.country-city.update', $city->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row  gy-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="cityName">City name</label>
                            <div class="form-control-wrap">
                                <input
                                        type="text"
                                        class="form-control @error('cityName') error @enderror"
                                        id="cityName"
                                        value="{{ old('cityName') ?? $city->cityName }}"
                                        name="cityName"
                                        placeholder="city name"
                                >
                                @error('cityName')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="facts">Facts</label>
                            <div class="form-control-wrap">
                                <input
                                        type="text"
                                        class="form-control @error('facts') error @enderror"
                                        id="facts"
                                        value="{{ old('facts') ?? $city->facts  }}"
                                        name="facts"
                                        placeholder="facts"
                                >
                                @error('facts')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="overview">Overview</label>
                            <div class="form-control-wrap">
                                <input
                                        type="text"
                                        class="form-control @error('overview') error @enderror"
                                        id="overview"
                                        value="{{ old('overview') ?? $city->overview }}"
                                        name="overview"
                                        placeholder="overview"
                                >
                                @error('overview')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="currency">Currency</label>
                            <div class="form-control-wrap">
                                <input
                                        type="text"
                                        class="form-control @error('currency') error @enderror"
                                        id="currency"
                                        value="{{ old('currency') ?? $city->currency  }}"
                                        name="currency"
                                        placeholder="currency"
                                >
                                @error('currency')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="country_code">Country Code</label>
                            <div class="form-control-wrap">
                                <input
                                        type="text"
                                        class="form-control @error('country_code') error @enderror"
                                        id="country_code"
                                        value="{{ old('country_code') ?? $city->countryCode  }}"
                                        name="country_code"
                                        placeholder="country code"
                                >
                                @error('country_code')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="language">Language</label>
                            <div class="form-control-wrap">
                                <input
                                        type="text"
                                        class="form-control @error('language') error @enderror"
                                        id="language"
                                        value="{{ old('language') ?? $city->languages }}"
                                        name="language"
                                        placeholder="language"
                                >
                                @error('language')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="population">Population</label>
                            <div class="form-control-wrap">
                                <input
                                        type="text"
                                        class="form-control @error('population') error @enderror"
                                        id="population"
                                        value="{{ old('population') ?? $city->population }}"
                                        name="population"
                                        placeholder="population"
                                >
                                @error('population')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="popular_city">Popular City</label>
                            <div class="form-control-wrap">
                                <input
                                        type="text"
                                        class="form-control @error('popular_city') error @enderror"
                                        id="popular_city"
                                        value="{{ old('popular_city') ?? $city->popularCity }}"
                                        name="popular_city"
                                        placeholder="popular_city"
                                >
                                @error('popular_city')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="mayor">Mayor</label>
                            <div class="form-control-wrap">
                                <input
                                        type="text"
                                        class="form-control @error('mayor') error @enderror"
                                        id="mayor"
                                        value="{{ old('mayor') ?? $city->mayor }}"
                                        name="mayor"
                                        placeholder="mayor"
                                >
                                @error('mayor')
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
                                        value="{{ old('images') }}"
                                        name="images"
                                        placeholder="images"
                                >
                                @error('images')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="history">History</label>
                            <div class="form-control-wrap">
                                <textarea
                                        class="form-control form-control-sm @error('history') error @enderror"
                                        id="history"
                                        name="history"
                                        placeholder="Write your message"
                                >{{ old('history') ?? $city->history }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="custom-control custom-switch mt-1">
                            <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    data-id=""
                                    id="promoted"
                                    name="promoted">
                            <label class="custom-control-label" for="promoted">Promoted</label>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-dim btn-outline-primary">
                        <x-vex-icon class="ni-save"/>
                        <span>Update City</span>
                    </button>
                </div>
            </form>
        </x-vex-containt>

    </x-vex-container>
</x-app-layout>
