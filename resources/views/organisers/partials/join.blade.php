<form action="" method="post" class="d-inline">
    @csrf
    <input type="hidden" name="title" value="{{ $event->title ?? "" }}">
    <button type="submit">
        <i class="sl sl-icon-camrecorder"></i> Join
    </button>
</form>
