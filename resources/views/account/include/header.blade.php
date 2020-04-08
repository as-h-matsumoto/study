<?php
$title = '';
$title_second = '';
if($GLOBALS['urls'][2]==='try'){
    if($GLOBALS['urls'][3]==='history'){
        $title = '過去問受験履歴';
        $key = 'try/history';
    }elseif($GLOBALS['urls'][3]==='choice'){
        $title = '過去問受験';
        $key = 'try/choice/license';
    }
}elseif($GLOBALS['urls'][2]==='profile'){
    $title = '登録情報';
    $key = $GLOBALS['urls'][2];
}elseif($GLOBALS['urls'][2]==='recommend'){
    $title = '学習メモ';
    $key = $GLOBALS['urls'][2];
}elseif($GLOBALS['urls'][2]==='favorite'){
    $title = '補習リスト';
    $key = $GLOBALS['urls'][2];
}elseif($GLOBALS['urls'][2]==='messages'){
    $title = 'メッセージ';
    $key = $GLOBALS['urls'][2];
}
?>
<div id="page-header" class="page-header"
    style="background-image: url('{{Util::getPic('user', true, Auth::user()->back_pic, Auth::user()->id, 1600, false)}}')" >
    <div class="user-info center">
        <br />
        <br />
        <br />
        <span>{!! Util::getAccountMenuList($key,'icon','s-14') !!}  </span>
        <span class="name">
            <span class="f24">
                {{$title}}
            </span>
        </span>
    </div>
</div>

