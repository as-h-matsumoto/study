@extends('account/layouts/default')

{{-- Page title --}}
@section('title') {!!$content->name!!}のご予約詳細 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')

<div id="project-dashboard" class="page-layout simple">

    <div class="page-content-wrapper">

        <!-- HEADER -->
        @include('account/include/header')
        <!-- / HEADER -->

        <!-- CONTENT -->
        <div class="page-content p-2 row">
        
        <div class="col-sm-12" style="padding:0 30px;">
        <div class="card">
        <div class="card-body p-0">
            <div id="page-header-custom-yoyaku" class="page-header p-4 row"
                style="background-image: url('{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), true, $content->back_pic, $content->id, 1600)}}')" >
                    <div class="user-info col-md-8 col-sm-12 center-sm">
                        <div class="pt-4 hidden-xs"></div>
                        <span>
                              <img title="{{$content->name}}" class="profile-image avatar huge page-header-img-m" src="{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content->id, 400)}}">
                            <br class="hidden-sm-over" />
                            <span class="name">
                                <span class="f24">
                                  {!!Util::truncateHeaderName($content->name,'page')!!}
                                </span>
                                <br />
                                <span>
                                  <i class="icon icon-map-marker-radius s-4 text-red-A700" title="エリア" alt="エリア"></i> {!!Util::getCountryAreaName($content->country_area_id)!!} {!!Util::getCountryAreaOneName($content->country_area_address_one)!!}
                                </span>
                            </span>
                        </span>
                    </div>
                    
                    <div id="page-header-actions-yoyaku" class="actions col-md-4 col-sm-12 center-sm" style="top:-20px !important;">
                        <p style="line-height:40px; padding-top:0 !important;">
                            <a class="btn-header bg-grey-200 mb-1 px-2 py-1 mx-1" onClick="loading(); niceBad('contents', {!!$content->id!!}, 'good', 'Content')" title="いいね">
                              <small id="niceContentgood{!!$content->id!!}">{!!$content->good_number!!}</small><i class="icon-thumb-up-outline text-green-700 s-4"></i>
                            </a>
                            <a class="btn-header bg-grey-200 mb-1 px-2 py-1 mx-1" onClick="loading(); niceBad('contents', {!!$content->id!!}, 'bad', 'Content')" title="う～ん">
                              <small id="niceContentbad{!!$content->id!!}">{!!$content->bad_number!!}</small><i class="icon-thumb-down-outline text-primary-200 s-4"></i>
                            </a>
                            <a class="btn-header bg-grey-200 mb-1 px-2 py-1 mx-1" title="リコメンド">
                              <i class="icon-comment-text-outline text-accent-700 s-4"></i><small>{!!$content->recommends_number!!}件</small>
                            </a>
                            <a class="btn-header bg-grey-200 mb-1 px-2 py-1 mx-1" id="favorite-contents-{!!$content->id!!}">
                            @if($content->favo)
                              <span onClick="loading(); favorite('contents', {!!$content->id!!}, 'delete')">
                                <i class="icon icon-star s-4 text-red-600" title="お気に入り解除" alt="お気に入り解除"></i>
                              </span>
                            @else
                              <span onClick="loading(); favorite('contents', {!!$content->id!!}, 'add')">
                                <i class="icon icon-star s-4 text-yellow-600" title="お気に入り登録" alt="お気に入り登録"></i>
                              </span>
                            @endif
                            </a>
                            <a onClick="upMessageModal()" class="btn-header bg-grey-200 mb-1 px-2 py-1 mx-1" title="メッセージを送る">
                              <i class="icon-contact-mail text-blue-700 s-4"></i>
                            </a>
                            <a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/desc" class="btn-header bg-grey-200  mb-1 px-2 py-1 mx-1" title="詳細" target="_blank" >
                              <i class="icon-search-web text-green-700 s-4"></i><small>詳細</small>
                            </a>
                        </p>
                    </div>
            </div>
        </div>
        </div>
        </div>


        <?php
        $whatDayTime = Util::getWhatDaytime($content_date_user->start, $content_date_user->end);
        ?>

        @if( !($content->service===91) )
        <div class="col-sm-12 mb-2">
        <div class="card">
        <div class="card-body center @if($whatDayTime['done'] or $content_date_user->goin===9) bg-grey-200 @endif ">
          <label for="yoyakusite-yoyaku-id" style="font-weight:700;" >予約ID</label>
          <p id="yoyakusite-yoyaku-id" class="yoyakusite-yoyaku-id text-info f20" style="font-weight:700;">{!!$content_date_user->yoyaku_id!!}</p>
          @if($whatDayTime['done'])
          <p>こちらの予約は終了しました。</p>
          @elseif($content_date_user->goin===9)
          <p>こちらの予約はキャンセルされました。</p>
          @else
          <p class="f18" style="font-weight:700;">ご利用日時: {!!date('Y/m/d H:i', strtotime($content_date_user->start))!!} ~ {!!date('Y/m/d H:i', strtotime($content_date_user->end))!!} <br /><span class="text-success">あと@if($whatDayTime['days']!==0){!!$whatDayTime['days'].'日と'!!}@endif{!!$whatDayTime['hour']!!}時間</span> </p>
          <p class="f18" style="font-weight:700;">
            <span>ご利用人数: {!!$content_date_user->join_user_number!!}名様<span>
            <span> / </span>
            <span>利用条件:
              @if($content_date_user->private)<span>個室</span>@endif
              @if($content_date_user->nonesmoking)<span>禁煙</span>@endif
              @if($content_date_user->sheet)<span>シート／ソファー席</span>@endif
            </span>
          </p>
          <p>
          @if($content_date_user->goin===9)
            <span>キャンセル料: &yen;{!!$content_date_user->cancel_price!!} </span><span class="12">(税込み)</span>
          @else
            <span>&yen;{!!$content_date_user->payment_sum!!}<span><span class="12">(税込み)</span>
          @endif

          @if($content_date_user->goin===2)
            <span class="text-success"> 支払い済み</span>
          @elseif($content_date_user->goin===1)
            <span class="text-danger"> 未払い</span>
            <span> 現地でお支払いください。</span>
          @elseif($content_date_user->goin===9)
            <span class="text-danger"> キャンセル</span>
          @endif
          </p>

          <span class="">こちらをお店にご提示ください。</span>
          @endif
        </div>
        </div>
        </div>


        @else
        <div class="col-sm-12 mb-2">
        <div class="card">
        <div class="card-body center @if( $content_date_user->recruit_status_id >8 ) bg-grey-200 @endif ">
          <label style="font-weight:700;" >エントリー先</label>
          <p class=" text-info f20" style="font-weight:700;">{!!$company->name!!}</p>

          <label for="yoyakusite-yoyaku-id" style="font-weight:700;" >エントリーID</label>
          <p id="yoyakusite-yoyaku-id" class="yoyakusite-yoyaku-id text-info f20" style="font-weight:700;">{!!$content_date_user->yoyaku_id!!}</p>
          @if($content_date_user->recruit_status_id >8)
          <p>こちらのリクルート面接は終了しています。</p>
          @elseif($content_date_user->recruit_status_id===0)
          <p>現在書類選考中です。結果のメールをお待ちください。</p>
          @else
            @if($content_date_user->content_date_id===0)
            <p class="f18" style="font-weight:700;">{!!Util::contentRecruitEntry($content_date_user->recruit_status_id,'name',null,null)!!}のご予約を<a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content_date_user->content_id!!}/desc" class="text-blue-500">こちら</a>からお願いします。 </p>
            @elseif(!$whatDayTime['done'])
            <p class="f18" style="font-weight:700;">次の面接日時: {!!date('Y/m/d H:i', strtotime($content_date_user->start))!!} ~ {!!date('Y/m/d H:i', strtotime($content_date_user->end))!!} <br /><span class="text-success">あと@if($whatDayTime['days']!==0){!!$whatDayTime['days'].'日と'!!}@endif{!!$whatDayTime['hour']!!}時間</span> </p>
            <span class="">ご提示を求められた際はこちらをお出しください。</span>
            @else
            <p>現在選考中です。結果のメールをお待ちください。</p>
            @endif
          @endif
        </div>
        </div>
        </div>
        @endif


        <div class="col-sm-12 mb-2">
        <div class="card">
        <div class="card-header">
        @if( !($content->service===91) )
        ご予約メニュー・席・所在地
        @else
        面接会場、面接ルーム
        @endif
        </div>
        <div id="menusAndCapacities" class="row pt-2 px-6">

            @include('account/include/content_address_index')

            @include('account/include/content_company_index')
           
        </div>
        </div>
        </div>




        </div> <!-- page-content -->

        @if( !($content->service===91) )
        <div class="page-content-footer">
            <p class="right" >
                @if( !($whatDayTime['done'] or $content_date_user->goin===9) )
                <a href="javascript:void(0)" class="btn" onclick="loading();cancelStart();return false;" >
                    <i class="icon icon-cancel text-danger-700 s-4"></i> <strong>この予約をキャンセルする</strong>
                </a>
                @endif
            </p>
        </div>
        @endif

        @include('account/include/footer')
        @include('include/footer')

    </div>

</div>

<div class="modal fade" id="modalCancelYoyaku" tabindex="-1" role="dialog" aria-labelledby="modalCancelYoyakuLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCancelYoyakuLabel">キャンセル処理</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>キャンセル処理を行います。</p>
                <div id="modalCancelYoyakuMessage"></div>
                <div id="modalCancelYoyakuCancelTable"></div>
                <div id="modalCancelYoyakuMessageSub"></div>
                <div><p>また、キャンセルしてもこのご予約内容はいつでもご確認いただけます。</p></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">やめる</button>
                <a id="postModalEvent" href="javascript:void(0)" class="btn" onclick="loading();cancelDone();return false;" ><strong>{!!Util::getIcon('cancel','s-4','grey')!!} キャンセル</strong></a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCancelYoyakuDone" tabindex="-1" role="dialog" aria-labelledby="modalCancelYoyakuDoneLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCancelYoyakuDoneLabel">キャンセル処理完了</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-6 center">
                <p class="display-4" >キャンセルいたしました。</p>
                <div id="modalCancelYoyakuDoneMessage"></div>
            </div>
        </div>
    </div>
</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script>

function cancelStart() {

    axios.get('/account/yoyaku/history/{!!$content_date_user->id!!}/cancelStart')
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}

        $('#modalCancelYoyakuMessage').html('<p>' + result.cancel_message + '</p>');
        $('#modalCancelYoyakuMessageSub').html('<p>' + result.cancel_message_sub + '</p>');
        
        var content_cancel_calendar = result.content_cancel_calendar;
        if(content_cancel_calendar){
          var insert = '';
          insert += '<div class="col-sm-12 mb-2">';
          insert += '<div class="card">';
          insert += '<div class="card-body table-div p-0">';
          insert += '<table class="table table-hover mb-0 pb-0 center">';
          insert += '<thead class="bg-primary-50 text-auto">';
          insert += '<tr><th style="min-width:100px !important;">キャンセル日</th><th>キャンセル料(支払額の割合)</th></tr>';
          insert += '</thead>';
          insert += '<tbody>';
          insert += '<tr><th scope="row" class="py-1 text-info">当日  </th><td class="py-1">' + content_cancel_calendar.today + '%</td></tr>';
          insert += '<tr><th scope="row" class="py-1 text-info">前日  </th><td class="py-1">' + content_cancel_calendar.day1  + '%</td></tr>';
          insert += '<tr><th scope="row" class="py-1 text-info">2日前 </th><td class="py-1">' + content_cancel_calendar.day2  + '%</td></tr>';
          insert += '<tr><th scope="row" class="py-1 text-info">3日前 </th><td class="py-1">' + content_cancel_calendar.day3  + '%</td></tr>';
          insert += '<tr><th scope="row" class="py-1 text-info">4日前 </th><td class="py-1">' + content_cancel_calendar.day4  + '%</td></tr>';
          insert += '<tr><th scope="row" class="py-1 text-info">5日前 </th><td class="py-1">' + content_cancel_calendar.day5  + '%</td></tr>';
          insert += '<tr><th scope="row" class="py-1 text-info">6日前 </th><td class="py-1">' + content_cancel_calendar.day6  + '%</td></tr>';
          insert += '<tr><th scope="row" class="py-1 text-info">7日前 </th><td class="py-1">' + content_cancel_calendar.day7  + '%</td></tr>';
          insert += '<tr><th scope="row" class="py-1 text-info">8日前 </th><td class="py-1">' + content_cancel_calendar.day8  + '%</td></tr>';
          insert += '<tr><th scope="row" class="py-1 text-info">9日前 </th><td class="py-1">' + content_cancel_calendar.day9  + '%</td></tr>';
          insert += '<tr><th scope="row" class="py-1 text-info">10日前</th><td class="py-1">' + content_cancel_calendar.day10 + '%</td></tr>';
          insert += '<tr><th scope="row" class="py-1 text-info">11日前</th><td class="py-1">' + content_cancel_calendar.day11 + '%</td></tr>';
          insert += '<tr><th scope="row" class="py-1 text-info">12日前</th><td class="py-1">' + content_cancel_calendar.day12 + '%</td></tr>';
          insert += '<tr><th scope="row" class="py-1 text-info">13日前</th><td class="py-1">' + content_cancel_calendar.day13 + '%</td></tr>';
          insert += '<tr><th scope="row" class="py-1 text-info">14日前</th><td class="py-1">' + content_cancel_calendar.day14 + '%</td></tr>';
          insert += '<tr><th scope="row" class="py-1 text-info">15日前</th><td class="py-1">' + content_cancel_calendar.day15 + '%</td></tr>';
          insert += '<tr><th scope="row" class="py-1 text-info">16日前～</th><td class="py-1">0%</td></tr>';
          insert += '</tbody>';
          insert += '</table>';
          insert += '</div>';
          insert += '</div>';
          insert += '</div>';
          insert += '</div>';
          $('#modalCancelYoyakuCancelTable').html(insert);
        }

        $('#modalCancelYoyaku').modal('show');
        $('#loading').hide();
        return;

    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });
    
}

function cancelDone() {

    $('#modalCancelYoyaku').modal('hide');

    axios.post('/account/yoyaku/history/{!!$content_date_user->id!!}/cancelDone')
    .then(function (response) {
        result = response.data;
        $('#loading').hide();
        //console.log(result);
        if(!ajaxCheckPublic(result)){;return;}
        //$('#modalFirstContentDate').modal('hide');
        successNotify(result.message);
        $('#modalCancelYoyakuDone').modal('show');
        setTimeout("location.reload()",2000);
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });
    
}



</script>


@if( $content_date_user->content_date_id!==0 )

@if( !($content->service===39 or $content->service===85 or $content->service===89 or $content->service===91) )
    @include('owner/contents/menu/' . UtilYoyaku::getNewMenuSenMonTenSummary($content->service) . '/menu_js')
@endif
@if( !($content->service===62 or $content->service===69 or $content->service===101) )
    @include('owner/contents/capacity/' . UtilYoyaku::getNewMenuSenMonTenSummary($content->service) . '/capacity_js')
@endif
<script type="text/javascript">        
$(document).ready(function () {

    axios.get('/account/yoyaku/history/{!!$content_date_user->id!!}/getContentDateUser')
    .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}
        var content_date_user = response.data.content_date_user;
        var insert = '';
        var number = 0;
        var unop;



        @if( !($content->service===62 or $content->service===69 or $content->service===101) )
        var capacities = JSON.parse(content_date_user.capacities_desc);
        var capacities_summary = JSON.parse(content_date_user.capacities_summary);
        $.each(capacities,function(index,capacity){
            switch('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'){
                case 'food': unop=(capacity.type===1)?'number':'person'; break;
                case 'active': unop=(capacity.type<=4)?'number':'person'; break;
                case 'spasalon': unop='person'; break;
                case 'hairsalon': unop='person'; break;
                case 'stay': unop='person'; break;
                case 'studio': unop='number'; break;
                case 'kaigi': unop='number'; break;
                case 'divination': unop='person'; break;
            }
            number = (capacities_summary[capacity.id][unop]) ? capacities_summary[capacity.id][unop] : 1 ;
            insert = createCapacity(capacity, number);
            $('#menusAndCapacities').prepend(insert);
        });
        @endif


        @if( !($content->service===39 or $content->service===85 or $content->service===89 or $content->service===91) )
        var menus = JSON.parse(content_date_user.menus_desc);
        var menus_summary = JSON.parse(content_date_user.menus_summary);
        $.each(menus,function(index,menu){
            switch('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'){
                case 'food': unop=(menu.type===1)?'number':'person'; break;
                case 'lesson': unop='person'; break;
                case 'spasalon': unop='person'; break;
                case 'tour': unop='person'; break;
                case 'ticket': unop='number'; break;
                case 'hairsalon': unop='person'; break;
                case 'stay': unop='person'; break;
                case 'divination': unop='person'; break;
            }
            number = (menus_summary[menu.id][unop]) ? menus_summary[menu.id][unop] : 1 ;
            insert = createMenu(menu, number);
            $('#menusAndCapacities').prepend(insert);
        });
        @endif

        
        $('[data-toggle="popover"]').popover();
        $('#loading').hide();


    })
    .catch(function (error) {
        //console.log('err yoyakuGetMenus');
        ajaxCheckError(error); return;
    });
    
});
</script>
@endif





@stop
