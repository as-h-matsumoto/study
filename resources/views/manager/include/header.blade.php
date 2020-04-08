<?php
$title = '';
if(!$GLOBALS['urls'][2]){
    $title = 'ホーム';
}elseif($GLOBALS['urls'][2]==='owner'){
    $title = 'オーナー管理';
}
?>
<div class="page-header light-fg d-flex flex-column justify-content-center justify-content-lg-end p-6"
    style="background-image: url('{{Util::getPic('user', true, Auth::user()->back_pic, Auth::user()->id, 1600, false)}}')" >

    <div class="flex-column row flex-lg-row align-items-center align-items-lg-end no-gutters justify-content-between">
        <div class="user-info flex-column row flex-lg-row no-gutters align-items-center">
              <img title="{{Auth::user()->name}}" class="profile-image avatar huge mr-6" src="{{Util::getPic('user', false, Auth::user()->pic, Auth::user()->id, 400, false)}}">
            <div class="name h2 my-6">{{$title}}</div>
        </div>

    </div>
</div>