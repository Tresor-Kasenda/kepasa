@foreach($events as $event)
    <div class="col-lg-6 col-md-12">
        <a href="{{ route('events.show', ['detail' => $event->key]) }}" class="listing-item-container">
            <div class="listing-item">
                <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->title }}">
                <div class="listing-item-content">
                    <span class="tag">{{ $event->category->name ?? "" }}</span>
                    <h3>
                        {{ strtoupper($event->title) ?? ""}}
                        @if($event->promoted == true)
                            <i class="verified-icon"></i>
                        @endif
                    </h3>
                    <span>{{ $event->address ?? "" }}, {{ $event->city ?? "" }}</span>
                </div>
                <span class="like-icon"></span>
            </div>
        </a>
    </div>
@endforeach
