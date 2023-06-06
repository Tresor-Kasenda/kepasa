<x-event-layout>
    @section('title', "Creation of images for every event")

    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>Add images to events</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li>
                            <a href="{{ route('event.images.index') }}">
                                <i class="fa fa-fast-backward"></i>
                                Back to images
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="row" id="message">
        @include('organisers.partials._flash')
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div id="add-listing">
                <div class="add-listing-section">
                    <div class="add-listing-headline">
                        <h3><i class="sl sl-icon-doc"></i>Ajouter une images</h3>
                    </div>
                    <form action="{{ route('event.images.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row with-forms">
                            <div class="col-md-6">
                                <h5>Event Lists</h5>
                                <select class="chosen-select-no-single" name="event_id" id="event_id" >
                                    <option label="blank">Select Event</option>
                                    @foreach($events as $event)
                                        <option value="{{ $event->id }}">{{ $event->title ?? "" }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <h5>Images</h5>
                                <input
                                    type="file"
                                    class="search-field"
                                    name="image"
                                    id="image"
                                    value="{{ old('image' ?? $image->image) }}"
                                    placeholder="select image"
                                >
                            </div>

                            <button type="submit" class="button preview">Save image</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-event-layout>
