var attendanceApp = angular.module("userJoinListApp",[]);
attendanceApp.controller("userJoinListController",function($scope) {

    let render  =  `
<div class="rh-search-sort">
    <div class="pcr__search" >
        <input type="search" ng-model="q" id="" class="pcr__searchfield" placeholder="Search">
    </div>
    <div ng-click="orderByMe()" class="sort-participants" title="Sort">
        <i class="fa" ng-class="class"></i>
    </div>
</div>
<div id="pcr__participants_list">
    <div ng-if="attendee.length > 0">
        <div class="pcr__participant"
             ng-repeat="attn in attendee |  orderBy:'username':reverse | filter:q as results track by $index">
            <p title="{{attn.fullName}}">
                <strong>{{attn.username}}</strong>
            </p>
            <div class="status">
                <a href="javascript:void(0);" class="pm-this-user" id="chat_{{attn.clientId}}"
                   data-pmcid="{{attn.clientId}}" title="Start chat with {{attn.fullName}}">
                        <span class="chat-icon" data-pmcid="{{attn.clientId}}">
                            <i class="fa fa-comment" data-pmcid="{{attn.clientId}}"></i></span>
                    <span class="tag tag-danger pm-notification hide-this" data-pmcid="{{attn.clientId}}"
                          id="chat-tag-{{attn.clientId}}">0</span>
                </a>
                <span  class="line-icon {{attn.lineIconClass}}" >
                        <span class="chat-icon" onclick="audioMuteUser(this)" title="Unmuted"  id="audioMute{{attn.clientId}}"><i class="fa fa-microphone fa-fw"></i> </span>
                    </span>
                <span class="line-icon {{attn.lineIconClass}}">
                        <span class="chat-icon " onclick="videoMuteUser(this)" title="Unmuted"  id="videoMute{{attn.clientId}}"><i class="fa fa-video fa-fw"></i></span>
                    </span>
                <span class="line-icon cursor-normal">
                        <span class="chat-icon" title="Share"  id="shareIcon{{attn.clientId}}"><i class="fa fa-desktop fa-fw"></i></span>
                    </span>
            </div>
        </div>
    </div>

    <div ng-if="attendee.length === 0">
        <div class="no-particpants">No participants to show.</div>
    </div>
</div>`;

    $scope.updateAttendanceLayout = function(data){
        $scope.attendanceTemplate = {url: render};
        $scope.attendee = data.user_list;
        $scope.isModerator = data.is_mod;
    }

    $scope.class='fa-sort-alpha-down'
    $scope.reverse = true;
    $scope.orderByMe = function(x) {
        if ($scope.class === "fa-sort-alpha-down")
            $scope.class = "fa-sort-alpha-up";
        else
            $scope.class = "fa-sort-alpha-down";
        $scope.reverse = !$scope.reverse ;
    }
    $scope.hide  = true;
    $scope.show = function(x) {
        $scope.hide = !$scope.hide ;
    }
    $scope.updateAttendanceLayout([]);
});
