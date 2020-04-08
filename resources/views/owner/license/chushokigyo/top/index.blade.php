@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') コンテンツトップ @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')

<div id="profile" class="page-layout simple right-sidebar tabbed">

    <div class="page-content-wrapper">

    @include('owner/contents/include/header')

    <!-- CONTENT -->
    <div class="page-content p-2">

        <div class="row px-3">

            <div class="card col-12 col-sm-4 col-xl-4 pt-4 pb-8 mb-2" style="min-height: 180px !important;">
                
                <div>
                    <p class="h5 center"><strong>
                        <span class="introduce-title-kagi-kakko">
                        <a href="/owner/contents/{!!$content->id!!}/desc/edit">
                            <i class="icon icon-note-text text-light-blue-900 s-5" title="概要編集" alt="概要編集"></i>
                        概要</a></span>
                    </strong></p>
                </div>
                
                <div class="mt-4">

                    <p class="center h6"><strong>{!!$content->name!!}</strong></p>
                    <br />
                    
                    <table class="center">
                    <tbody>
                        <tr>
                        <th>
                        <a href="javascript:void(0)" onclick="postOwnerOpenModal();return false;">
                            <i class="icon icon-garage-open text-blue-700 s-5" title="掲載状況" alt="掲載状況"></i>
                            掲載状況：</th>
                        </a>
                        </th>
                        <td><strong id="postOwnerOpen">
                        @if($content->owner_open)
                        <span class="text-success"><i class="icon icon-check-circle-outline s-4 text-success"></i>掲載中</span>
                        @else
                        <span class="text-danger">掲載ストップ</span>
                        @endif
                        </strong></td></tr>

                        <tr><th>
                        <a href="/owner/contents/{!!$content->id!!}/date/edit">
                            <i class="icon icon-calendar-plus text-green-700 s-5" title="予約受付営業日/開催日" alt="予約受付営業日/開催日"></i>
                        @if($content->service===91) 面接スケジュール： @else 予約スケジュール： @endif</th><td><strong>
                        </a>
                        @if($content_date)
                        <span class="text-success"><i class="icon icon-check-circle-outline s-4 text-success"></i>受付中</span>
                        @else
                        <span class="text-danger">未登録</span>
                        @endif
                        </strong></td></tr>
    
                        @if(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!=='recruit')

                        @if($content->service===85 or $content->service===89 or $content->service===39)
                        <tr><th>
                        <a href="/owner/contents/{!!$content->id!!}/discount/edit">
                            <i class="icon icon-arrow-down-bold-hexagon-outline text-amber-500 s-5" title="割引設定" alt="割引設定"></i>
                        割引スケジュール：
                        </a>
                        </th><td><strong>
                        @if($content_discount)
                        <span class="text-success"><i class="icon icon-check-circle-outline s-4 text-success"></i>登録済み</span>
                        @else
                        <span class="text-danger">未登録</span>
                        @endif
                        </strong></td></tr>
                        @endif
    
                        <tr><th>
                        <a href="/owner/contents/{!!$content->id!!}/cancel/edit">
                            <i class="icon icon-cancel text-red-800  s-5" title="キャンセル料設定" alt="キャンセル料設定"></i>
                        キャンセル料設定：
                        </a>
                        </th><td><strong>
                        @if($content_cancel_calendar)
                        <span class="text-success"><i class="icon icon-check-circle-outline s-4 text-success"></i>登録済み</span>
                        @else
                        <span class="text-danger">未登録</span>
                        @endif
                        </strong></td></tr>
    
                        @endif
    
                    </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card col-12 col-sm-4 col-xl-4 pt-4 mb-2" style="min-height: 180px !important;">
                
                <div>

                    <p class="h5 center"><strong>
                        <?php 
                        if($content->service===91){
                            $this_word = '求人応募者';
                        }else{
                            $this_word = 'ご予約者';
                        }
                        ?>
                        <span class="introduce-title-kagi-kakko">
                        @if($content->service===91)
                        <a href="/owner/contents/{!!$content->id!!}/recruit">
                        @else
                        <a href="/owner/contents/{!!$content->id!!}/date/yoyaku">
                        @endif
                            <i class="icon icon-account text-light-blue-900 s-5" title="{!!$this_word!!}確認" alt="{!!$this_word!!}確認"></i>
                        {!!$this_word!!}
                        </a></span>
                    </strong></p>
                    
                </div>
                    
                <div class="mt-4">
                    
                    <table class="center">
                    <tbody>
    
                        <tr><th>未対応者：</th><td><strong>
                        <span class="text-info">{!!$content_date_users_active!!}</span>
                        </strong></td></tr>
    
                        <tr><th>合計：</th><td><strong>
                        <span class="text-info">{!!$content_date_users_total!!}</span>
                        </strong></td></tr>
    
                    </tbody>
                    </table>
                </div>
            </div>

            <div class="card col-12 col-sm-4 col-xl-4 pt-4 mb-2" style="min-height: 210px !important;">
                
                <div>
                
                    <p class="h5 center"><strong>
                        <span class="introduce-title-kagi-kakko">
                        <a href="/owner/contents/{!!$content->id!!}/golist/edit">
                            <i class="icon icon-map-marker-plus text-red-A700 s-5" title="所在地" alt="所在地"></i>所在地
                        </a>
                        </span>
                    </strong></p>
                
                </div>
                
                <div class="mt-4">
                
                    @if( !($content->service===69 or $content->service===101) )
                    <div class="row">
                        <div class="col-sm-12 pt-2 center">
                        @if($place_owner->pic)<img src="{!!Util::getPic('place', null, $place_owner->pic, $content->id, 400, null)!!}" style="max-width:100px;" />@endif
                        <strong>
                            <p>
                            @if($content->country_area_id){!!Util::getCountryAreaName($content->country_area_id)!!} <br />@endif
                            @if($content->country_area_address_one){!!Util::getCountryAreaOneName($content->country_area_address_one)!!} <br />@endif
                            @if($content->country_area_address_two){!!Util::getCountryAreaTwoName($content->country_area_address_two)!!} <br />@endif
                            @if($content->country_area_address_other){!!$content->country_area_address_other!!} @endif
                            </p>
                            <a class="text-blue-300" href="https://maps.google.com/maps?q={!!$content->address!!} {!!$content->name!!}" target="_blank" >マップ</a>
                        </strong>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-sm-12 center">
                            <p class="text-danger"><strong>未登録</strong></p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        

<?php
if($content->service===62){
    $title_name = 'ステップ';
}elseif($content->service===69){
    $title_name = 'スケジュール';
}elseif($content->service===101){
    $title_name = 'Gポイント';
}
?>

            @if( !($content->service===39 or $content->service===85 or $content->service===89) )
            <div class="card col-12 col-sm-4 col-xl-4 pt-4 mb-2" style="min-height: 180px !important;">

                <div>
                
                    <p class="h5 center"><strong>
                        <span class="introduce-title-kagi-kakko">
                        <a href="/owner/contents/{!!$content->id!!}/menu/edit">
                            <i class="icon icon-format-list-bulleted-type text-black-500 s-5" title="メニュー設定" alt="メニュー設定"></i>
                        メニュー
                        </a>
                        </span>
                    </strong></p>
                
                </div>
                
                <div class="mt-4">

                    @if($content->service===91)
                        @if($content_menu_recruit)
                        <p class="center text-success"><i class="icon icon-check-circle-outline s-4 text-success"></i><strong>登録済み</strong></p>
                        @else
                        <p class="center text-danger"><strong>未登録</strong></p>
                        @endif
                    @else
    
                    <?php $count = 0; ?>
                    @forelse($menus as $menu)
                        <?php
                        $count++;
                        if($count>5) break;
                        ?>
                        <p class="center"><strong>{!!$menu->name!!}</strong></p>
                    @empty
                    <p class="center text-danger"><strong>未登録</strong></p>
                    @endforelse
                    <p class="center"><strong>その他トータル{!!count($menus)!!}件登録</strong></p>
    
                    @endif

                </div>

            </div>
            @endif





            @if( !($content->service===69 or $content->service===101) )
            <div class="card col-12 col-sm-4 col-xl-4 pt-4 mb-2" style="min-height: 180px !important;">
                
                <div>

                    <p class="h5 center"><strong>
                        <span class="introduce-title-kagi-kakko">
                        <a href="/owner/contents/{!!$content->id!!}/capacity/edit">
                            <i class="icon icon-store text-cyan-A700 s-5" title="施設設備登録" alt="施設設備登録"></i>
                        キャパシティ
                        </a>
                        </span>
                    </strong></p>
                
                </div>
                
                <div class="mt-4">

                    <?php $count = 0; ?>
                    @forelse($capacities as $capacity)
                        <?php
                        $count++;
                        if($count>5){
                            echo '<p class="center"><strong>...</strong></p>';
                            break;
                        }
                        ?>
                        @if($content->service===15 or $content->service===39)
                        <p class="center"><strong>{!!Util::getCapacityType($content->service, $capacity->type)!!} _N{!!$capacity->id!!}</strong></p>
                        @else
                        <p class="center"><strong>{!!$capacity->name!!}</strong></p>
                        @endif
                    @empty
                    <p class="center text-danger"><strong>未登録</strong></p>
                    @endforelse
                    <p class="center"><strong>トータル{!!count($capacities)!!}件登録</strong></p>
                </div>
            </div>
            @endif




            <div class="card col-12 col-sm-4 col-xl-4 pt-4 mb-2" style="min-height: 180px !important;">
                
                <div>
                    <p class="h5 center"><strong>
                        <span class="introduce-title-kagi-kakko">注目の登録</span>
                    </strong></p>
                
                </div>
                
                <div class="mt-4">
                
                    <table class="center">
                    <tbody>
    
                        <tr><th>
                        <a href="/owner/contents/{!!$content->id!!}/desc/edit">
                            <i class="icon icon-note-text text-light-blue-900 s-4" title="概要編集" alt="概要編集"></i>
                        GOODポイント：
                        </a>
                        </th><td><strong>
                        @if(count($content['steps'])>=2)
                        <span class="text-success">{!!count($content['steps'])!!}件登録</span>
                        @elseif(!empty($content['steps']))
                        <span class="text-warning">{!!count($content['steps'])!!}件登録</span>
                        @else
                        <span class="text-danger">未登録</span>
                        @endif
                        </strong></td></tr>
    
                        @if($content->service===62 or $content->service===69 or $content->service===101)
                            @foreach($menus as $key=>$menu)
                            <tr><th>
                            <a href="/owner/contents/{!!$content->id!!}/menu/edit">
                                <i class="icon icon-format-list-bulleted-type text-black-500 s-4" title="メニュー" alt="メニュー"></i>
                            {!!$menu->name . ' ' . $title_name!!}：
                            </a>
                            </th><td><strong>
                            @if(count($menu['steps'])>=2)
                            <span class="text-success">{!!count($menu['steps'])!!}件登録</span>
                            @elseif(!empty($content['steps']))
                            <span class="text-warning">{!!count($menu['steps'])!!}件登録</span>
                            @else
                            <span class="text-danger">未登録</span>
                            @endif
                            </strong></td></tr>
                            @endforeach
                        @endif
                        
    
                    </tbody>
                    </table>
                </div>
            </div>




            <div class="card col-12 col-sm-4 col-xl-4 pt-4 mb-2">
                
                <div>

                    <p class="h5 center"><strong>
                        <span class="introduce-title-kagi-kakko">掲載ページQRコード</span>
                    </strong></p>
                
                </div>
                
                <div class="mt-4 center">
                
                    <p class="center"><strong>掲載ページQRコードです。ドラッグ＆ドロップ、もしくは、ダウンロードをしてご利用ください。</strong></p>
                    <img class="center" style="width:150px;" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate('https://www.coordiy.com/SenMonTen/'.rawurlencode(UtilYoyaku::getNewMenuSenMonTen($content->service)).'/contents/'.$content->id.'/desc')) !!}">
                </div>

            </div>





            <div class="card col-12 col-sm-4 col-xl-4 pt-4 mb-2">
                
                <div>
                    <p class="h5 center"><strong>
                        <span class="introduce-title-kagi-kakko">掲載ページHTMLコード</span>
                    </strong></p>
                
                </div>
                
                <div class="mt-4">

                    <div class="table-div">
                        <pre style="min-height:140px;">
                            <code id="pc0"></code>
                        </pre>
                    </div>

                </div>

            </div>

            <div class="card col-12 col-sm-4 col-xl-4 pt-4 mb-2">
                
                <div>
                    <p class="h5 center"><strong>
                        <span class="introduce-title-kagi-kakko">予約カレンダー埋め込みコード</span>
                    </strong></p>
                
                </div>
                
                <div class="mt-4">
                
                    <div class="table-div">
                        <pre style="min-height:140px;">
                            <code id="pc1"></code>
                        </pre>
                    </div>

                </div>
            </div>



        </div>




        

    </div>

    <div class="page-content-footer">
        <p class="right">
        </p>
    </div>
    @include('owner/include/footer')
    @include('include/footer')

</div>

<div class="modal fade" id="postOwnerOpenModal" tabindex="-1" role="dialog" aria-labelledby="postOwnerOpenModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="postOwnerOpenModalLabel">掲載状況の変更</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="center">
                    本当に掲載状況を変更しますか？<br />
                    変更する場合は「変更する」を選択してください。
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); postOwnerOpen();" ><strong>{!!Util::getIcon('add','s-4','green')!!} 変更する</strong></button>
            </div>
        </div>
    </div>
</div>

@stop



{{-- footer scripts --}}
@section('footer_scripts')

<script type="text/javascript">


function postOwnerOpenModal() {
    $('#postOwnerOpenModal').modal('show');
}

function postOwnerOpen() {
  axios.post('/owner/contents/{!!$content->id!!}/openClose', {
    type: 1
  })
  .then(function (response) {
    if(!ajaxCheckPublic(response.data)){return;}
    if(response.data.owner_open===1){
        $('#postOwnerOpen').html('<span class="text-success"><i class="icon icon-check-circle-outline s-4 text-success"></i>掲載中</span>');
    }else{
        $('#postOwnerOpen').html('<span class="text-danger">掲載ストップ</span>');
    }
    $('#loading').hide();
    $('#postOwnerOpenModal').modal('hide');
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });
}
</script>


<script type="text/javascript">

$(document).ready(function () {
    document.getElementById('pc0').textContent = document.getElementById('ct0').textContent;
    document.getElementById('pc1').textContent = document.getElementById('ct1').textContent;
});

</script>

<script id="ct0" type="text/plain">
<a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/desc">
    <button class="btn btn-outline-info">予約受付はこちら</button>
</a></script>

<script id="ct1" type="text/plain">
<iframe 
    src="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/iframeCalendar"
    name="iframeCalendar" width="100%" height="600px">
    this page use inline frame.
</iframe></script>

@stop
