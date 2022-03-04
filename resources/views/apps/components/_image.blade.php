<a
    href="{{ asset('storage/'.$image->image) }}"
    data-background-image="{{ asset('storage/'.$image->image) }}"
    class="item mfp-gallery" title="{{ $image->key ?? "" }}"
></a>
