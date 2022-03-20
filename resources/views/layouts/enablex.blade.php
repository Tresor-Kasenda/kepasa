<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sample App: Multi-party Conference using EnableX and Laravel</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('test/img/enablex.png') }}"/>
    <link rel="stylesheet" href="{{ asset('test/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('test/css/jquery.toast.css') }}">
    <link rel="stylesheet" href="{{ asset('test/css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('test/css/confo.css') }}">
    <script>
        window.site_url = '{{ url("/") }}';
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="col-md-12" style="width: 100%;height:100%;">
        <div class="video_container_div">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div id="local_video_div"></div>
                </div>
                <div class="col-md-9 col-sm-9" id="multi_video_container_div"></div>
            </div>
        </div>
        <div class="row" id="controls-div">
            <div class="controls" id="controls" style="background-color:grey;position: fixed;bottom: 0;left:0;width:100%;text-align: center">
                <img src="{{ asset('test/img/mic.png') }}" style="margin-right: 20px;cursor: pointer;" class="cus_img_icon icon-confo-mute"  onclick="audioMute()" title="Mute audio" />
                <img src="{{ asset('test/img/video.png') }}" style="margin-right: 20px;cursor: pointer;" class="cus_img_icon icon-confo-video-mute" title="Mute video" onclick="videoMute()" />
                <img src="{{ asset('test/img/end-call.png') }}" style="margin-right: 20px;cursor: pointer;" class="cus_img_icon end_call" title="End call" onclick="endCall()" />
            </div>
        </div>
    </div>
</div>

<script>
    var urlData = {
        token: '{{ $event }}',
        roomId: '{{ $room}}'
    }
</script>
<script type="text/javascript" src="{{ asset('test/js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('test/js/tether.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('test/js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('test/js/jquery.toast.js') }}"></script>
<script type="text/javascript" src="{{ asset('test/js/EnxRtc.js') }}"></script>
<script type="text/javascript" src="{{ asset('test/js/confo.js') }}"></script>
</body>
</html>
