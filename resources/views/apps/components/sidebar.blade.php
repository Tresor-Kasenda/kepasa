<div>
    @foreach($events as $event)
        <li>
            <div class="widget-content">
                <div class="widget-thumb">
                    <a href="{{ route('events.show', ['detail' => $event->key]) }}">
                        <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->title }}">
                    </a>
                </div>
                <div class="widget-text">
                    <h5>
                        <a href="{{ route('events.show', ['detail' => $event->key]) }}">{{ strtoupper($event->title) ?? "" }}</a>
                    </h5>
                    <span>{{ $event->date ?? "" }}</span>
                </div>
                <div class="clearfix"></div>
            </div>
        </li>
    @endforeach
</div>
