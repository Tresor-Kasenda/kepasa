<form action="" method="post">
    @csrf
    <input type="hidden" name="title" value="{{ $event->title ?? "" }}">
    <button type="submit">
        <span class="message-by">
            <i class="sl sl-icon-camrecorder"></i>
            Join
        </span>
    </button>
</form>
