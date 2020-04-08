<?php
$title = '';
$title_second = '';

if($GLOBALS['urls'][1]==='license'){
    if($GLOBALS['urls'][3]==='top'){
        $title = '資格学習';
    }elseif($GLOBALS['urls'][3]==='getLicenseStudyMap'){
        $title = '学習マップ';
    }elseif($GLOBALS['urls'][3]==='getLicensestudyArea'){
        $title = '科目学習';
    }elseif($GLOBALS['urls'][3]==='getLicenseMustReadList'){
        $title = '一読リスト';
    }elseif($GLOBALS['urls'][3]==='getLicenseHotWords'){
        $title = 'ホットワード';
    }elseif($GLOBALS['urls'][3]==='getLicenseData'){
        $title = '試験データ';
    }elseif($GLOBALS['urls'][3]==='getLicenseStatistics'){
        $title = '資格合格率';
    }elseif($GLOBALS['urls'][3]==='getLicenseSchedule'){
        $title = '学習スケジュール';
    }elseif($GLOBALS['urls'][3]==='getLicenseTest'){
        $title = '試験スケジュール';
    }else{
        $title = '資格学習';
    }
}
?>
<div id="page-header" class="page-header {{Util::monthClassNameReturn()}}" >
    <div class="user-info center">
        
        <br />
        <br />
        <span class="name f30">
            <span class="pr-4">{!! Util::getAccountGroundMenuList($GLOBALS['urls'][3],'icon','s-14') !!}</span>
            <span>{!!Util::truncateHeaderName($license->name,'page')!!}</span>
            <span>{{$title}}</span>
        </span>

    </div>

</div>


