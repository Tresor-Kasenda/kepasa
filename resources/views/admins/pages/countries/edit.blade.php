<x-app-layout>
    @section('title', "Ville du pays")

    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Edition de {{ $city->cityName }}</h3>
                    </div>
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li class="preview-item">
                                        <a href="{{ route('supper.countries.index') }}" class="btn btn-outline-secondary btn-sm d-none d-sm-inline-flex">
                                            <em class="icon ni ni-arrow-left"></em>
                                            <span>Back</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <div class="card">
                    <div class="card-aside-wrap">
                        <div class="card-inner card-inner-lg">
                            <form action="{{ route('supper.countries.update', $city->cityName ) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="cityName">city Name</label>
                                            <div class="form-control-wrap">
                                                <input
                                                        type="text"
                                                        class="form-control @error('cityName') error @enderror"
                                                        id="cityName"
                                                        value="{{ old('cityName') ?? $city->cityName }}"
                                                        name="cityName"
                                                        placeholder="city name"
                                                >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="facts">facts</label>
                                            <div class="form-control-wrap">
                                                <input
                                                        type="text"
                                                        class="form-control @error('facts') error @enderror"
                                                        id="facts"
                                                        value="{{ old('facts') ?? $city->facts }}"
                                                        name="facts"
                                                        placeholder="facts"
                                                >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="overview">overview</label>
                                            <div class="form-control-wrap">
                                                <input
                                                        type="text"
                                                        class="form-control @error('overview') error @enderror"
                                                        id="overview"
                                                        value="{{ old('overview') ?? $city->overview }}"
                                                        name="overview"
                                                        placeholder="overview"
                                                >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="currency">currency</label>
                                            <div class="form-control-wrap">
                                                <input
                                                        type="text"
                                                        class="form-control @error('currency') error @enderror"
                                                        id="currency"
                                                        value="{{ old('currency') ?? $city->currency }}"
                                                        name="currency"
                                                        placeholder="currency"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="languages">languages</label>
                                            <div class="form-control-wrap">
                                                <input
                                                        type="text"
                                                        class="form-control @error('languages') error @enderror"
                                                        id="languages"
                                                        value="{{ old('languages') ?? $city->languages }}"
                                                        name="languages"
                                                        placeholder="languages"
                                                >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="population">population</label>
                                            <div class="form-control-wrap">
                                                <input
                                                        type="text"
                                                        class="form-control @error('population') error @enderror"
                                                        id="population"
                                                        value="{{ old('population') ?? $city->population }}"
                                                        name="population"
                                                        placeholder="population"
                                                >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="popularCity">popularCity</label>
                                            <div class="form-control-wrap">
                                                <input
                                                        type="text"
                                                        class="form-control @error('popularCity') error @enderror"
                                                        id="popularCity"
                                                        value="{{ old('popularCity') ?? $city->popularCity }}"
                                                        name="popularCity"
                                                        placeholder="popularCity"
                                                >
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="mayor">mayor</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                                type="text"
                                                                class="form-control @error('mayor') error @enderror"
                                                                id="mayor"
                                                                value="{{ old('mayor') ?? $city->mayor }}"
                                                                name="mayor"
                                                                placeholder="mayor"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="promoted">promoted</label>
                                                    <div class="form-control-wrap ">
                                                        <div class="form-control-select">
                                                            <select class="form-control" id="promoted" name="promoted">
                                                                <option value="{{ $city->promoted }}">{{ $city->promoted }}</option>
                                                                <option value="promotion">promotion</option>
                                                                <option value="notPromoted">notPromoted</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="history">history</label>
                                            <div class="form-control-wrap">
                                                <textarea
                                                        class="form-control form-control-sm @error('history') error @enderror"
                                                        id="history"
                                                        name="history"
                                                        placeholder="Write history of your city"
                                                >{{ $city->history }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-md btn-outline-primary">Update city</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
