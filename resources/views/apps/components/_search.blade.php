@foreach($events as $event)
    <div class="col-lg-4 col-md-6">
        <a href="{{ route('event.show', $event->key) }}" class="listing-item-container">
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
            </div>
        </a>
    </div>
@endforeach
