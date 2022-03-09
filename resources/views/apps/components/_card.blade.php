<div class="carousel-item">
    <a href="{{ route('event.show',$event->key) }}" class="listing-item-container">
        <div class="listing-item">
            <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->title }}">
            @if($event->status == \App\Enums\StatusEnum::POSTPONE)
                <div class="listing-badge now-closed">{{ $event->status ?? "" }}</div>
            @endif
            <div class="listing-item-details">
                <ul>
                    <li>{{ $event->startTime }}-{{ $event->endTime }}, {{ $event->date  }}</li>
                </ul>
            </div>
            <div class="listing-item-content">
                <span class="tag">{{ strtoupper($event->category->name) ?? "" }}</span>
                <h3>
                    {{ $event->title ?? "" }}
                    @if($event->promoted == true)
                        <i class="verified-icon"></i>
                    @endif
                </h3>
                <span>{{ $event->address ?? "" }}, {{ $event->city }}</span>
            </div>
        </div>
    </a>
</div>
