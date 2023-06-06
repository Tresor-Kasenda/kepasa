@php use App\Enums\CityPromotedEnum; @endphp
<x-app-layout>
    @section('title', "City details")

    <x-vex-container>
        <x-brandcrumb title="Detail City">
            <x-vex-link href="{{ route('supper.country-list') }}" class="btn btn-dim btn-outline-primary">
                <x-vex-icon class="ni-arrow-long-left"/>
                <span>All countries</span>
            </x-vex-link>
        </x-brandcrumb>

        @if($city->promoted === CityPromotedEnum::NOTPROMOTED)
            <div class="alert alert-icon alert-danger" role="alert">
                <em class="icon ni ni-alert-circle"></em>
                <strong>Warning</strong>. This city is not promoted.
            </div>
        @endif

        <x-vex-containt>
            <div class="card-inner-group">
                <div class="card-inner">
                    <div id="carouselExConInd" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-md">
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/'. $city->image) }}" class="d-block w-100" alt="carousel">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('storage/'. $city->image) }}" class="d-block w-100" alt="carousel">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('storage/'. $city->image) }}" class="d-block w-100" alt="carousel">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExConInd" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExConInd" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
                <div class="card-inner">
                    <h6 class="overline-title mb-2">Short Details</h6>
                    <div class="row g-3">
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">City Name:</span>
                            <span>{{ $city->cityName }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Latitude:</span>
                            <span>{{ $city->latitude }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Longitude:</span>
                            <span>{{ $city->longitude }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Facts:</span>
                            <span>{{ $city->facts }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Overview:</span>
                            <span>{{ $city->onverview }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Currency</span>
                            <span>{{ $city->currency }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Languages</span>
                            <span>{{ $city->languages }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Population</span>
                            <span>{{ $city->population }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Popular City</span>
                            <span>{{ $city->popularCity }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Mayor</span>
                            <span>{{ $city->mayor }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <span class="sub-text">Promoted:</span>
                            <span class="lead-text {{ $city->promoted === 'promotion' ? 'text-success' : 'text-danger' }}">
                                {{ $city->promoted }}
                            </span>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <span class="sub-text">Description</span>
                            <span>
                                {{ $city->history ?? "" }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </x-vex-containt>

    </x-vex-container>
</x-app-layout>