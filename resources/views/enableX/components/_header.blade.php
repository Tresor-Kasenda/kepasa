<div class="site-header">
    <nav class="navbar navbar-light">
        <div class="navbar-left">
            <a class="navbar-brand" href="https://kepasa.africa/logo3.png" target="_blank">
                <div class="logo"></div>
            </a>
            <div class="toggle-button dark sidebar-toggle-first float-xs-left hidden-md-up">
                <span class="hamburger"></span>
            </div>
            <div class="toggle-button dark float-xs-right hidden-md-up" data-toggle="collapse"
                 data-target="#collapse-1">
                <span class="more"></span>
            </div>
        </div>
        <div class="navbar-right navbar-toggleable-sm collapse" id="collapse-1">
            <div class="toggle-button light sidebar-toggle-second float-xs-left hidden-sm-down">
                <span class="hamburger"></span>
            </div>
            <ul class="nav navbar-nav float-md-right">
                <li class="nav-item pad-top-18" id="rec-notification" style=" display: none;">
                    <i class="fa fa-circle blink-image" style="color:red;">
                        <span style="font-family:Titillium Web;font-size: 16px;padding-left: 5px;text-transform: uppercase;line-height: 25px;">Rec</span>
                    </i>
                </li>
                <li class="nav-item pad-top-18">
                    <label><i class="far fa-clock"></i></label>
                    <label id="duration-label" style="font-weight: bold;">00:00:00</label>
                </li>
                <li class="nav-item dropdown">
                    <span class="vcx_bar text-danger" id="exit_meeting" title="Sign Out" onclick="hangUp()">
                        <i class="fa fa-power-off mr-0-5"></i>Sign Out
                    </span>
                </li>
                <li class="nav-item dropdown" >
                    <span style="color:white;" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-power-off mr-0-5"></i>
                        End Meeeting
                    </span>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="nav-item hidden-sm-down">
                    <a class="nav-link toggle-fullscreen" href="#">
                        <i class="ti-fullscreen"></i>
                    </a>
                </li>
                <li class="nav-item pad-top-18" style="display: none;">
                    <h4></h4>
                    <h4 class="meeting-title"></h4>
                </li>
                <li class="nav-item pad-top-18" >
                    <h4></h4>
                </li>
            </ul>
        </div>
    </nav>
</div>
