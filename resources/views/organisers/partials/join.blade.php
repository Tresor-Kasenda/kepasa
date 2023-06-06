<form action="{{ route('event.enable.token') }}" method="post" class="d-inline">
    @csrf
    @if(auth()->event()->role_id == 3)
        <input type="hidden" name="key" value="{{ $event->id ?? "" }}">
        <input type="hidden" name="name" value="{{ auth()->event()->key ?? "" }}">
        <input type="hidden" name="reference" value="{{ $event->onlineEvent->reference ?? "" }}">
        <button type="submit">
            <i class="sl sl-icon-camrecorder"></i> Join
        </button>
    @endif
</form>
