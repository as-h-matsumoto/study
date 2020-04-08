<?php
$title = '';
$title_second = '';
$edit_url = '';
$link_name = '';
$create = '';
if($GLOBALS['urls'][4]==='golist'){
    //$edit_url = '/owner/contents/' . $content->id . '/capacity/edit';
    //$link_name = UtilYoyaku::getNewContentCapacity($content->service) . '登録・編集へ <i class="icon icon-chevron-right"></i>';
}elseif($GLOBALS['urls'][4]==='capacity'){
    if( !($content->service===69 or $content->service===101) ){
        $create .= '<button class="btn btn-info" onClick="editCapacity(null)" >';
        $create .= '<strong> ' . UtilYoyaku::getNewContentCapacity($content->service) . '追加</strong>';
        $create .= '</button>';
    }
    //if(($content->service===85 or $content->service===89 or $content->service===39)){
    //    $edit_url = '/owner/contents/' . $content->id . '/discount/edit';
    //    $link_name = '割引設定へ <i class="icon icon-chevron-right"></i>';
    //}else{
    //    $edit_url = '/owner/contents/' . $content->id . '/menu/edit';
    //    $link_name = 'メニュー登録へ <i class="icon icon-chevron-right"></i>';
    //}
}elseif($GLOBALS['urls'][4]==='discount'){
    //$edit_url = '/owner/contents/' . $content->id . '/desc/edit';
    //$link_name = '概要登録へ <i class="icon icon-chevron-right"></i>';
}elseif($GLOBALS['urls'][4]==='menu'){
    //$edit_url = '/owner/contents/' . $content->id . '/desc/edit';
    //$link_name = '概要登録へ <i class="icon icon-chevron-right"></i>';
    $create .= '<button class="btn btn-info" onClick="menuModal(null);" >';
    $create .= '<strong>メニュー作成</strong>';
    $create .= '</button>';
}elseif($GLOBALS['urls'][4]==='desc'){
    //if($content->service===91){
    //    $edit_url = '/owner/contents/' . $content->id . '/date/edit';
    //    $link_name = '面接日時登録へ <i class="icon icon-chevron-right"></i>';
    //}else{
    //    $edit_url = '/owner/contents/' . $content->id . '/cancel/edit';
    //    $link_name = 'キャンセル料設定へ <i class="icon icon-chevron-right"></i>';                
    //}
}elseif($GLOBALS['urls'][4]==='cancel'){
    //$edit_url = '/owner/contents/' . $content->id . '/date/edit';
    //$link_name = '予約受付登録へ <i class="icon icon-chevron-right"></i>';
}elseif($GLOBALS['urls'][4]==='date'){
}elseif($GLOBALS['urls'][4]==='sell'){
}elseif($GLOBALS['urls'][4]==='recruit'){
}
?>
<div id="page-header-custom" class="page-header p-6 row"
    style="background-image: url('{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), true, $content->back_pic, $content->id, 1600)}}')" >

        <div class="user-info col-md-8 col-sm-12 pt-4 center-sm">
            <span>
                <img title="{{$content->name}}" class="profile-image avatar huge page-header-img-m" src="{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content->id, 400)}}">
                <br class="hidden-sm-over" />
                <span class="name">
                    <span>
                    {!!Util::truncateHeaderName($content->name,'page')!!}
                    </span>
                    <br />
                    <span class="f24">
                    @if($GLOBALS['urls'][4]==='date')
                        @if($GLOBALS['urls'][5]==='yoyaku')
                        予約状況確認
                        @elseif($GLOBALS['urls'][5]==='edit')
                        予約受付編集
                        @elseif($GLOBALS['urls'][5]==='adduser')
                        新規予約登録
                        @endif
                    @else
                        @if($GLOBALS['urls'][4]==='capacity')
                        {!!Util::getOwnerContentEditMenuList($GLOBALS['urls'][4],'icon','s-7') . '&ensp;' . UtilYoyaku::getNewContentCapacity($content->service)!!}
                        @else
                        {!!Util::getOwnerContentEditMenuList($GLOBALS['urls'][4],'icon','s-7') . '&ensp;' . Util::getOwnerContentEditMenuList($GLOBALS['urls'][4],'name',null)!!}
                        @endif
                    @endif
                    </span>
                </span>
            </span>
        </div>
        
        @if($GLOBALS['urls'][4]!=='show')
        <div id="page-header-actions" class="actions actions-header col-md-4 col-sm-12 ">
            <p class="center" style="line-height:0 !important;">

                @if($GLOBALS['urls'][4]==='date')
                    @if($GLOBALS['urls'][5]==='edit')
                    <a href="/owner/contents/{!!$content->id!!}/date/yoyaku">
                        <button class="f11-sm btn mb-2-sm-over"><i class="icon icon-account s-4"></i><strong class="">予約状況</strong></button>
                    </a>
                    <a href="/owner/contents/{!!$content->id!!}/date/edit">
                        <button class="f11-sm btn btn-info mb-2-sm-over"><i class="icon icon-pen s-4"></i><strong class="">予約受付</strong></button>
                    </a>
                    <a href="/owner/contents/{!!$content->id!!}/date/adduser">
                        <button class="f11-sm btn mb-2-sm-over" style="line-height:12px;"><i class="icon icon-account-plus s-4"></i><strong class="">新規予約</strong></button>
                    </a>
                    @elseif($GLOBALS['urls'][5]==='yoyaku')
                    <a href="/owner/contents/{!!$content->id!!}/date/yoyaku">
                        <button class="f11-sm btn btn-info mb-2-sm-over"><i class="icon icon-account s-4"></i><strong class="">予約状況</strong></button>
                    </a>
                    <a href="/owner/contents/{!!$content->id!!}/date/edit">
                        <button class="f11-sm btn mb-2-sm-over"><i class="icon icon-pen s-4"></i><strong class="">予約受付</strong></button>
                    </a>
                    <a href="/owner/contents/{!!$content->id!!}/date/adduser">
                        <button class="f11-sm btn mb-2-sm-over" style="line-height:12px;"><i class="icon icon-account-plus s-4"></i><strong class="">新規予約</strong></button>
                    </a>
                    @elseif($GLOBALS['urls'][5]==='adduser')
                    <a href="/owner/contents/{!!$content->id!!}/date/yoyaku">
                        <button class="f11-sm btn mb-2-sm-over"><i class="icon icon-account s-4"></i><strong class="">予約状況</strong></button>
                    </a>
                    <a href="/owner/contents/{!!$content->id!!}/date/edit">
                        <button class="f11-sm btn mb-2-sm-over"><i class="icon icon-pen s-4"></i><strong class="">予約受付</strong></button>
                    </a>
                    <a href="/owner/contents/{!!$content->id!!}/date/adduser">
                        <button class="f11-sm btn btn-info mb-2-sm-over" style="line-height:12px;"><i class="icon icon-account-plus s-4"></i><strong class="">新規予約</strong></button>
                    </a>
                    @endif
                @elseif($GLOBALS['urls'][4]!=='sell' and $GLOBALS['urls'][5]==='edit')
                {!!$create!!}
                @endif

            </p>
        </div>
        @endif

</div>