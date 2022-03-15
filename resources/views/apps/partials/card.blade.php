<li>
    <div class="widget-content">
        <div class="widget-thumb">
            <a href="{{ route('event.show', $event->key) }}">
                <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->title }}">
            </a>
        </div>
        <div class="widget-text">
            <h5>
                <a href="{{ route('event.show', $event->key) }}">{{ $event->title ?? "" }}</a>
            </h5>
            <span>{{ $event->date ?? "" }} to {{ $event->startTime }}</span>
        </div>
        <div class="clearfix"></div>
    </div>
</li>
