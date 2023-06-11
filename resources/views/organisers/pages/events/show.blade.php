@php use App\Enums\PaymentEnum;use App\Enums\StatusEnum; @endphp
<x-organiser-layout>
    @section('title', "Détail sur l'evenement")

    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Listens events / <span class="text-teal-dim">{{ $event->title ?? "" }}</span></h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('organiser.events-list') }}">Back to events</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    @if($event->status === StatusEnum::DEACTIVATE)
        <div class="notification error closeable">
            <p><span>Error!</span> This event is not activated for moment.  Please contact admin</p>
            <a class="close" href="#"></a>
        </div>
    @endif

    <div class="row">
        <div class="container">
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <div class="listing-slider mfp-gallery-container margin-bottom-0">
                        <a
                            href="{{ $event->getEventImages() }}"
                            data-background-image="{{ $event->getEventImages() }}"
                            class="item mfp-gallery"
                        ></a>
                        @if($event->media)
                            @foreach($event->media as $images)
                                <a
                                    href="{{ asset('storage/'.$images->image) }}"
                                    data-background-image="{{ asset('storage/'.$images->image) }}"
                                    class="item mfp-gallery" title="{{ $images->id ?? "" }}"
                                ></a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="container">
            <div class="col-lg-12 col-md-12">
                <div class="margin-top-45">
                    <div id="titlebar" class="listing-titlebar">
                        <div class="listing-titlebar-title">
                            <h2>
                                {{ strtoupper( $event->title) ?? ""  }}
                                <span class="listing-tag">{{ $event->category->name ?? "" }}</span>
                                <span
                                    class="listing-tag border-secondary">{{ $event->payment === PaymentEnum::PAID ? "PAID" : "UNPAID" }}</span>
                            </h2>
                            <span>
                            <a href="#" class="listing-address">
                                <i class="fa fa-map-marker"></i>
                                {{ $event->country->countryName ?? "" }} | {{ $event->city->cityName ?? "" }} | {{ $event->address ?? "" }}
                            </a>
                        </span>
                            <div class="listing-links-container">
                                <ul class="listing-links contact-links">
                                    <li>
                                        <a href="#" class="listing-links">
                                            <i class="fa fa-calendar"></i> Date: {{ $event->date ?? "" }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="listing-links">
                                            <i class="fa fa-calendar-check-o"></i> start
                                            Time: {{ $event->startTime ?? "" }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank" class="listing-links">
                                            <i class="fa fa-calendar-check-o"></i> end Time
                                            : {{ $event->endTime ?? "" }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <br>
                        </div>
                    </div>
                    <div id="listing-overview" class="listing-section">
                        <p>
                            {{ $event->description ?? "" }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-organiser-layout>
