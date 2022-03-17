<?php
    session_start();
    include "../connectDB.php";
    include "data.php";

    $sql = "SELECT * FROM classRoom WHERE roomID = '".$_GET['roomId']."'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($query);

    $roomID= $row['roomID'];
    $_SESSION['roomID'] = $roomID;
    if($_GET['token']!=''){
?>

<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <title>Vinco virtual classroom</title>
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <link rel="shortcut icon" href="../assets/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/plugins/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/plugins/animate.css/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/minimal/minimal.css">
    <link rel="stylesheet" href="../css/jquery-confirm.min.css">
    <link href='//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/core.css">
    <link rel="stylesheet" href="../css/sweetalert.css">
    <link rel="stylesheet" href="../css/joinedRoom.css" />
    <link rel="stylesheet" href="../css/new-ui.css">
    <link rel="stylesheet" href="../css/chat.css" />
    <script type="text/javascript">
        var autoload = setInterval(function() {
            $('#load').load('data.php').fadeIn('slow');
        }, 1000);

    </script>
</head>
<body class="fixed-sidebar fixed-header fixed-footer skin-default sidebar-closed">
    <div class="wrapper">
        <div class="preloader"></div>
        <!-- Sidebar -->
        <div class="site-overlay"></div>
        <div class="site-sidebar" style="background-color: #0d47a1;">
            <div class="custom-scroll custom-scroll-light">
                <ul class="sidebar-menu" id="first_sidebar">
                    <li>
                        <a href="#" class="" style="cursor: default;">
                            <span id="user-name-div" class="s-text text-center"></span>
                        </a>
                    </li>
                    <li>
                        <div id="local_div" style="padding:1rem 0;"><img src="../img/VincoIogo.svg" width="100%" style="padding:1rem 0;display:none;" style="background-color: #0d47a1;"></div>
                    </li>
                </ul>
                <div id="participants-chats-rch">
                    <div id="sidebar-pcr-container">
                        <div id="pcr__participants-list">
                            <ul id="pcr__topmenu" class="nav nav-tabs" role="tablist">
                                <li class="nav-item participants" title="Participants list">
                                    <a class="nav-link active" id="pcr__participants-tab" data-toggle="tab" href="#pcr__participants" role="tab" aria-controls="pcr__participants" aria-selected="true"> <i class="fa fa-users"></i></a>
                                </li>
                                <li class="nav-item chats" title="Group chat">
                                    <a class="nav-link" id="pcr__chats-tab" data-toggle="tab" href="#pcr__chats" role="tab" aria-controls="pcr__chats" aria-selected="true">
                                        <i class="fas fa-comments"></i>
                                        <span class="tag tag-danger top" id="chat-tag">0</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="pcr__participants" class="tab-pane show active" role="tabpanel" aria-labelledby="pcr__participants-tab">
                                    <div ng-app="userJoinListApp">
                                        <div id="attendance-layout" ng-controller="userJoinListController">
                                            <div ng-include="attendanceTemplate.url"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="pcr__chats" class="tab-pane fade public-chats-list " role="tabpanel" aria-labelledby="pcr__chats-tab">
                                    <h3 class="group-chat-label text-center">Group Chat</h3>
                                    <div class="chat-list-container">
                                        <div id="chat" class="chat-messages"></div>
                                    </div>
                                    <div class="scw-form">
                                        <form>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="chat-text-area" placeholder="Type here..." onkeyup="sendChat(event)" aria-describedby="basic-addon1">
                                                <span class="input-group-addon" id="basic-addon1">
                                                    <label for="file_upload_public">
                                                        <i class="fa fa-paperclip fa-lg" aria-hidden="true"></i>
                                                    </label>
                                                    <input type="file" class="file-input hide" name="file_upload" id="file_upload_public">
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="pm-list-container"></div>

                    </div>
                </div>
                <ul class="sidebar-menu" id="third_sidebar">
                    <li>
                        <a class="nav-link b-r-0" target="_blank" style="border-left: none !important;">
                            &copy; <script>
                                document.write(new Date().getFullYear())

                            </script> Ngoma Digitech
                        </a>
                    </li>
                </ul>
            </div>
            <a class="sidebar-toggle" href="javascript:void(0);" id="sidebar-toggle" title="">
                <i class="fas fa-angle-double-right"></i>
            </a>
        </div>


        <div class="template-options">
            <div class="custom-scroll custom-scroll-dark">
                <div class="scw-header clearfix">
                    <div class="float-xs-left">
                        <strong>Settings</strong>
                    </div>
                </div>
                <div class="settings-tab">
                    <form>
                        <div class="row setting-heading">
                            <div class="col-sm-12">
                                <h5 id="switch_devices_txt">Switch Devices</h5>
                            </div>
                        </div>
                        <div class="dvc_selection">
                            <div class="form-group">
                                <div id="preview-camera" class="">
                                    <!-- <p class="my-1"><strong>Selected camera preview:</strong></p> -->
                                    <video id="preview-video" playsinline autoplay></video>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-video fa-fw"></i></div>
                                    <select id="cam" class="form-control">
                                    </select>
                                    <div class="input-group-addon" title="Refresh video devices" onclick="vcxSettings.syncVideoDevices()"><i class="fas fa-sync"></i></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-microphone fa-fw"></i></div>
                                    <select id="mic" class="form-control">
                                    </select>
                                    <div class="input-group-addon" title="Refresh audio devices" onclick="vcxSettings.syncAudioDevices()"><i class="fas fa-sync"></i></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group" style="text-align: right;">
                                    <button id="btn-device-apply" class="btn btn-success w-min-md">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="dropdown-divider mar-top"></div>
                    <form>
                        <div class="row setting-heading">
                            <div class="col-sm-12">
                                <h5> Participants on Screen </h5>
                            </div>
                        </div>
                        <div class="at_selection">
                            <div class="row">
                                <div class="col-sm-9 col-xs-9">
                                    <select id="selected" class="at_options form-control" style="width:100%; height: 35px;">
                                    </select>
                                </div>
                                <div class="col-sm-3 col-xs-3">
                                    <button id="btn-at-selection-apply" class="btn btn-success w-min-xs" onclick="setActiveTalker('selected')">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="dropdown-divider  mar-top"></div>
                    <form>
                        <div class="row setting-heading">
                            <div class="col-sm-12">
                                <h5>Receive Video Quality</h5>
                            </div>
                        </div>
                        <div class="quality_selection">
                            <div class="row ">
                                <div class="col-sm-9 col-xs-9">
                                    <select id="video-quality" class="form-control" style="width:100%;height: 35px;">
                                    </select>
                                </div>
                                <div class="col-sm-3 col-xs-3">
                                    <button id="btn-quality-selection-apply" class="btn btn-success w-min-xs" onclick="setReceiveVideoQuality('video-quality')">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="dropdown-divider mar-top"></div>
                    <div class="row setting-heading">
                        <div class="col-sm-4">
                            <h5>Enable Stats</h5>
                        </div>
                        <div class="col-md-8">
                            <label class="switch">
                                <input type="checkbox" id="stats_enable" name="stats">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="end.php" method="POST" enctype="multipart/form-data">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" id="exampleModalLongTitle">End Meeting?</h5>

                        </div>
                        <div id="load"></div>
                        <div class="modal-body">
                            Are you sure you want to end this meeting?
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary">No</button>
        </form>
    </div>


    <div class="site-header">
        <nav class="navbar navbar-dark">
            <div class="navbar-left" style="background-color:rgba(13,71,161,0.5);">
                <a class="navbar-brand" href="../../../images/Ticket Key/Ticketkeylogo.svg" target="_blank">
                    <div class="logo">
                        <img src="../img/vinco.svg" style="margin-top: -2rem; height: 8rem; margin-left: -2rem;">

                    </div>
                </a>
                <div class="toggle-button dark sidebar-toggle-first float-xs-left hidden-md-up">
                    <span class="hamburger"></span>
                </div>
                <div class="toggle-button dark float-xs-right hidden-md-up" data-toggle="collapse" data-target="#collapse-1">
                    <span class="more"></span>
                </div>
            </div>
            <div class="navbar-right navbar-toggleable-sm collapse" id="collapse-1">
                <div class="toggle-button light sidebar-toggle-second float-xs-left hidden-sm-down" style="color:white;">
                    <span class="hamburger"></span>
                </div>
                <ul class="nav navbar-nav float-md-right">
                    <li class="nav-item pad-top-18" id="rec-notification" style=" display: none;">
                        <i class="fa fa-circle blink-image" style="color:red;"><span style="font-family:Titillium Web;font-size: 16px;padding-left: 5px;text-transform: uppercase;line-height: 25px;">Rec</span></i>
                    </li>
                    <li class="nav-item pad-top-18" style="font-weight: bold;color:white;">
                        <label><i class="far fa-clock"></i></label>
                        <label id="duration-label" style="font-weight: bold;color:white;">00:00:00</label>
                    </li>
                    <li class="nav-item dropdown">
                        <span class="vcx_bar" id="exit_meeting" title="Sign Out" onclick="hangUp()" style="color:white;">
                            <i class="fa fa-power-off mr-0-5"></i>
                            Sign Out </span>
                    </li>


                    <li class="nav-item dropdown">
                        <span style="color:white;" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-power-off mr-0-5"></i>
                            End Meeeting </span>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item hidden-sm-down">
                        <a class="nav-link toggle-fullscreen" href="#">
                            <i class="ti-fullscreen"></i>
                        </a>
                    </li>
                    <li class="nav-item pad-top-18" style="color:white;display: none;">
                        <h4 class="meeting-title">


                        </h4>
                    </li>
                    <li class="nav-item pad-top-18" style="color:white;">
                        <h5>

                            <?php
                           echo $_GET['room'];

                           ?>
                        </h5>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="site-content" id="video-container">
        <!-- Content -->
        <div class="content-area">
            <div class="container-fluid px-0 relative" id="testDiv">
                <div class="only-par-msg alert alert-danger-fill alert-dismissible  fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 id="availabilty_msg">No one joined this Session</h4>
                </div>
                <div class="only-mod-msg alert alert-danger-fill alert-dismissible  fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="watermark text-center">
                    <img class="img-fluid" id="water-mark-image" src="../img/VincoIogo.svg">
                </div>
                <div class="confo-container conf-visible" style="display: none;">
                    <div id="layout_manager" class="" style="height: 100%;width:100%;"></div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <!-------------- for mob--------------------->
        <nav class="nav nav-1 border-top-gray">
            <div class="row no-gutter">
                <div class="col-md-12" style="display:flex;flex-direction: row;" id="control-panel">
                    <span class="nav-link pad-20-30" id="audio_mute_btn" title="Mute" onclick="audioMute()"><span><i class="fa fa-microphone fa-fw"></i></span><br>Mute</span>
                    <span class="nav-link pad-20-30" id="video_mute_btn" title="Stop" onclick="videoMute();"><span><i class="fa fa-video fa-fw"></i></span><br>Stop</span>
                    <span class="nav-link pad-20-30" id="share_screen_btn" title="Start Share" onclick="screenShare();"><span><i class="fa fa-desktop fa-fw SSicon"></i></span><br>Share</span>
                    <span class="nav-link pad-20-30" id="whiteboard_open" title="Open Whiteboad">
                        <span><i class="fas fa-chalkboard fa-fw CBicon" id="startStreaming"></i></span><br>
                        <div class="whiteboard">Whiteboard</div>
                    </span>
                    <!--<span class="nav-link pad-20-30 toggle-button-second" id="chat_btn" title="Chat"><span><i-->
                    <!--class="far fa-comments fa-fw "></i><span class="tag tag-danger top" id="chat-tag">0</span></span><br>Chat</span>-->
                    <span class="nav-link pad-20-30" id="private_chat_btn" style="display:none;" title="Chat" onclick="vcxSettings.showPvtChat()">
                        <counter class="tag tag-danger footer-counter hide-this" id="pvt_chat-tag">&nbsp;</counter>
                        <span><i class="far fa-comments fa-fw"></i></span>
                        <br>
                        <div id="pvt_chat_txt">Chat</div>
                    </span>
                    <span class="nav-link pad-20-30" id="recording_btn" title="Start Record" onclick="startRoomRec();">
                        <span><i class="fa fa-circle fa-fw"></i></span><br>
                        <div id="record_text">Record</div>
                    </span>
                    <span class="nav-link pad-20-30" id="mute_all" title="Mute All" onclick="muteUnmuteAll();"><span><i class="fa fa-microphone fa-fw "></i></span><br>Mute All</span>
                    <span class="nav-link pad-20-30" id="invite_btn" title="Invite"><span><i class="far fa-envelope fa-fw"></i></span><br>Invite</span>
                    <!--<span class="nav-link pad-20-30" id="feedback_btn" title="Feedback"><span><i-->
                    <!--class="far fa-edit fa-fw"></i></span><br>Feedback</span>-->
                    <span class="nav-link pad-20-30 to-toggle-settings" id="settings_panel" title="Settings">
                        <span><i class="fas fa-cog fa-fw"></i></span><br>
                        <div class="settings_txt">Settings</div>
                    </span>
                </div>
            </div>
        </nav>
    </footer>
    </div>
    </div>
    <div class="modal fade" id="invite-dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: #0275d8;color: #fff;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Send Invite</h4>
                </div>
                <div class="modal-body">
                    <div class="m-item">
                        <div class="invite_msg col-sm-12" style="text-align: center;">
                            Invite another participant by entering their Email ID below
                        </div>
                        <div class="invite_selection">
                            <div class="row padd">
                                <div class="col-sm-8">
                                    <input id="invite-email" class="form-control" type="text" placeholder="Enter Email Address" style="width: 100%;height: 35px;" />
                                </div>
                                <div class="col-sm-4">
                                    <button id="btn-invite" class="btn btn-success w-min-md">Send
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="email-chat-dialog" tabindex="-1" role="dialog" aria-labelledby="email-chat-dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: #0275d8;color: #fff;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="chat-dialog-label">Send Chat Transcript</h4>
                </div>
                <div class="modal-body">
                    <div class="m-item">
                        <div class="invite_msg col-sm-12">
                            Send Chat Transcript to:
                        </div>
                        <div class="invite_selection">
                            <div class="row padd">
                                <div class="col-sm-8">
                                    <input id="send-chat-email" class="form-control" type="text" placeholder="Enter Email Address" style="width: 100%;height: 35px;" />
                                </div>
                                <div class="col-sm-4">
                                    <button id="btn-send-chat" class="btn btn-success w-min-md">Send
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="feedback-dialog" tabindex="-1" role="dialog" aria-labelledby="feedbackLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: #0275d8;color: #fff;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="feedbackLabel">Your Feedback</h4>
                </div>
                <div class="modal-body">
                    <div class="m-item">
                        <!--<div class="invite_msg col-sm-12" style="text-align: center;">-->
                        <!--You may invite new participants to join your ongoing Conference using the following form:-->
                        <!--</div>-->
                        <div class="feedback_form ">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <strong>How is your Call ?</strong>
                                </div>
                                <div class='col-sm-12 form-group'>
                                    <ul id='stars'>
                                        <li class='star' title='Poor' data-value='1'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Fair' data-value='2'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Good' data-value='3'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Excellent' data-value='4'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='WOW!!!' data-value='5'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="form-group col-sm-12 display-flex" id="attach_log_check">
                                    <input type="checkbox" id="attach_logs" class="icheck" checked> <label for="attach_logs" class="text-black" style="padding-left: 10px;">Attach Browser Console Log for qaulity diagnosis</label>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <div class="form-group"><strong>Audio Issues</strong></div>
                                        <div class="form-group  display-flex">
                                            <input type="checkbox" id="audio_not_present" class="icheck"> <label for="audio_not_present" class="text-black" style="padding-left: 10px;">I cannot hear anyone</label>
                                        </div>
                                        <div class="form-group  display-flex">
                                            <input type="checkbox" id="audio_was_bad" class="icheck"> <label for="audio_was_bad" class="text-black" style="padding-left: 10px;">Poor Audio Quality</label>
                                        </div>
                                        <div class="form-group  display-flex">
                                            <input type="checkbox" id="other_participant_not_hear_me" class="icheck"> <label for="other_participant_not_hear_me" class="text-black" style="padding-left: 10px;">Others cannot hear me</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group"><strong>Video Issues</strong></div>
                                        <div class="form-group  display-flex">
                                            <input type="checkbox" id="video_not_present" class="icheck"> <label for="video_not_present" class="text-black" style="padding-left: 10px;">I cannot see anyone</label>
                                        </div>
                                        <div class="form-group  display-flex">
                                            <input type="checkbox" id="video_is_bad" class="icheck"> <label for="video_is_bad" class="text-black" style="padding-left: 10px;">Poor Video quality </label>
                                        </div>
                                        <div class="form-group  display-flex">
                                            <input type="checkbox" id="other_participant_not_see_me" class="icheck"> <label for="other_participant_not_see_me" class="text-black" style="padding-left: 10px;">Others cannot see me</label>
                                        </div>
                                    </div>
                                </div>
                                <div class=" form-group col-sm-12 text-center" style="margin-top:20px;">
                                    <button id="send_feedback" class="btn btn-success w-min-md">Send
                                    </button>
                                    <button id="cancel_feedback" class="btn btn-danger w-min-md">Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="extension-dialog" tabindex="-1" role="dialog" aria-labelledby="extensionLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 450px;">
            <div class="modal-content">
                <div class="modal-header" style="background: #0275d8;color: #fff;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="extensionLabel">Install Screen Share Extension</h4>
                </div>
                <div class="modal-body">
                    <p>If You haven't downloaded the screen share extension.</p>
                    Click <a target="_blank" href='https://chrome.google.com/webstore/detail/vcloudx-screen-sharing/apedaiecomcfkjdjbnkfcdafaikkdkeo'>here</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS -->
    <script type="text/javascript" src="../assets/plugins/jquery/jquery-1.12.3.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/tether/js/tether.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/bootstrap4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/detectmobilebrowser/detectmobilebrowser.js"></script>
    <script type="text/javascript" src="../assets/plugins/jscrollpane/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="../assets/plugins/jscrollpane/mwheelIntent.js"></script>
    <script type="text/javascript" src="../assets/plugins/toastr/toastr.min.js"></script>
    <script type="text/javascript" src="../js/icheck.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mobile-detect/1.4.4/mobile-detect.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/jquery-fullscreen-plugin/jquery.fullscreen-min.js"></script>
    <script type="text/javascript" src="../js/jquery-confirm.min.js"></script>
    <script type="text/javascript" src="../js/angular.min.js"></script>
    <script type="text/javascript" src="../js/lang_change.js?>"></script>
    <script type="text/javascript" src="../js/vcxLayout.js"></script>
    <script type="text/javascript" src="../js/sweetalert.js"></script>
    <script type="text/javascript" src="../js/EnxRtc.js"></script>
    <script type="text/javascript" src="../js/EnxWb.js"></script>
    <script type="text/javascript" src="../js/moment.min.js"></script>
    <script type="text/javascript" src="../util/logger/Logger.js"></script>
    <script type="text/javascript" src="../js/util.js"></script>
    <script type="text/javascript" src="../js/vcx_settings.js"></script>
    <script type="text/javascript" src="../js/error.js"></script>
    <script type="text/javascript" src="../js/joinedRoom.js"></script>
    <script type="text/javascript" src="../js/RoomLayout.js"></script>
    <script type="text/javascript" src="../js/settings.js"></script>
    <script type="text/javascript" src="../js/app.js"></script>
    <script type="text/javascript" src="../js/scrollbar.js"></script>
    <script type="text/javascript" src="../js/pm.js"></script>
</body>
</html>
<?php

}else{

   header('location:../index.php?error=false');
}

?>
