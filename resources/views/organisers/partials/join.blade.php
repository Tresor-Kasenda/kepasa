<form action="{{ route('organiser.enable.token') }}" method="post" class="d-inline">
    @csrf
    @if(auth()->user()->role_id == 3)
        <input type="hidden" name="key" value="{{ $event->id ?? "" }}">
        <input type="hidden" name="name" value="{{ auth()->user()->key ?? "" }}">
        <input type="hidden" name="reference" value="{{ $event->onlineEvent->reference ?? "" }}">
        <button type="submit">
            <i class="sl sl-icon-camrecorder"></i> Join
        </button>
    @endif
</form>
