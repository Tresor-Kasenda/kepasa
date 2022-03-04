<a
    href="{{ asset('storage/'.$event->image) }}"
    data-background-image="{{ asset('storage/'.$event->image) }}"
    class="item mfp-gallery" title="{{ $event->title ?? "" }}"
></a>
