@if ($message = Session::get('success'))
    <div class="notification success closeable">
        <p><span>Success!</span> {{ $message }}.</p>
        <a class="close" href="#"></a>
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="notification error closeable">
        <p><span>Error!</span> {{ $message }}.</p>
        <a class="close" href="#"></a>
    </div>
@endif
@if ($message = Session::get('warning'))
    <div class="notification warning closeable">
        <p><span>Warning!</span> {{ $message }}.</p>
        <a class="close" href="#"></a>
    </div>
@endif
@if ($message = Session::get('info'))
    <div class="notification notice closeable">
        <p><span>Notice!</span>{{ $message }}</p>
        <a class="close" href="#"></a>
    </div>
@endif
@if ($errors->any())
    <div class="notification danger closeable">
        <p><span>Notice!</span>Check the following errors :(</p>
        <a class="close" href="#"></a>
    </div>
@endif
