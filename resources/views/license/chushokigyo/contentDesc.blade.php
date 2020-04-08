@extends('SenMonTen/layouts/default')

{{-- Page title --}}
@section('title'){!!$content->name!!} @parent
@stop

@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="{!!$content->name!!}のページです。お店のご予約をしたり、口コミ、営業時間、メニューなどの店舗情報も確認できます。">
<meta property="og:site_name" content="Coordiy予約">
<meta property="og:title" content="{!!$content->name!!}">
<meta property="og:description" content="{!!$content->name!!}のページです。お店のご予約をしたり、口コミ、営業時間、メニューなどの店舗情報も確認できます。">
<meta property="og:image" content="/storage/assets/img/logo_new_1600.png">
<meta property="og:url" content="{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), true, $content->back_pic, $content->id, 1600)}}">
<meta property="og:locale" content="ja_JP">
<meta property="og:type" content="website">
@stop

{{-- page level styles --}}
@section('header_styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<style>
.mycheckbox {
    border-radius:5px;
    vertical-align:middle !important;
    display:inline;

    border: solid 1px #efefef;

    background-color:#fff;
    white-space: nowrap;
    overflow:hidden;

    width:22px;
    height:22px;
}
#recommend_progress_bar {
  margin: 10px 0;
  padding: 3px;
  border: 1px solid #000;
  font-size: 14px;
  clear: both;
  opacity: 0;
  -moz-transition: opacity 1s linear;
  -o-transition: opacity 1s linear;
  -webkit-transition: opacity 1s linear;
}
#recommend_progress_bar.loading {
  opacity: 1.0;
}
#recommend_progress_bar .percent {
  background-color: #99ccff;
  height: auto;
  width: 0;
}
#recommendImagesArea .thumb{
    max-width:180px;
    min-width:180px;
}
</style>

<style>
.table.table-hover.contentDesc tbody th,.table.table-hover.contentDesc tbody td{
    padding:0 !important;
    padding: 2px 4px !important;
    text-align:center!important;
    font-size: 11px;
}
</style>

@if($content->service===91)
<style>
.recaptcha{ text-align: center; }
.g-recaptcha {
    display: inline-block;
}
</style>
<script src='https://www.google.com/recaptcha/api.js'></script>
@endif
@stop

{{-- content --}}
@section('content')

<div id="profile" class="page-layout simple right-sidebar tabbed">

    <div class="page-content-wrapper">

    @include('SenMonTen/contents/include/header')

    <!-- CONTENT -->
    <div class="page-content">
        <div class="p-0" style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_03.jpeg')">
        <ul class="nav nav-tabs px-0 bg-mask-hard">

            <li id="showDesc" class="nav-item active">
                <a onClick="showDesc();" class="nav-link px-sm-2 text-blue-grey-800">お店</a>
            </li>

            @if(isset($contentMenuDesc))
            <li class="nav-item">
                <a class="nav-link px-sm-2 text-blue-grey-800" href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/contents/{!!$content->id!!}/desc">
                    店舗詳細
                </a>
            </li>
            @endif

            @if( !($content->service===39 or $content->service===85 or $content->service===89 or $content->service===91) )
            <li id="showMenus" class="nav-item">
                <a onClick="showMenus();" class="nav-link px-sm-2 text-blue-grey-800">@if(isset($contentMenuDesc)){!!'その他'!!}@endif{!!'メニュー'!!}</a>
            </li>
            @endif

            @if( !($content->service===69 or $content->service===101) )
            <li id="showCapacity" class="nav-item">
                <a onClick="showCapacity();" class="nav-link px-sm-2 text-blue-grey-800">{!!UtilYoyaku::getNewContentCapacity($content->service)!!}</a>
            </li>
            @endif

            <li id="showPhotos" class="nav-item">
                <a onClick="showPhotos();" class="nav-link px-sm-2 text-blue-grey-800">写真</a>
            </li>

            @if($owner->csv!==1)
            @if( !($content->service===69 or $content->service===101) )
            <li id="mapRedirect" class="nav-item">
                <a class="nav-link px-sm-2 text-blue-grey-800" href="https://maps.google.com/maps/search/?api=1&query={!!$content->address!!},{!!$content->name!!}" target="_blank">
                    マップ
                </a>
            </li>
            @endif
            @endif

            <?php $showCalenderFlug = true; ?>
            <?php $closeFlug = false; ?>
            <li id="showCalendar" class="nav-item">
                <a onClick="showCalendar();" class="nav-link px-sm-2 text-blue-grey-800">
                @if($content->service===91)
                    @if(!$content->owner_open)
                    <?php $closeFlug = true; ?>
                    エントリー
                    @elseif( !isset($content_date_user->recruit_status_id) or empty($content_date_user) or $content_date_user->recruit_status_id===0 or $content_date_user->recruit_status_id>=9)
                    <?php $showCalenderFlug = false; ?>
                    エントリー
                    @else
                    面接予約
                    @endif
                @else
                    予約
                @endif
                </a>
            </li>

            @if(!isset($contentMenuDesc))
            @if( $content->service!==91 )
            <li id="showRecruit" class="nav-item">
                <a onClick="showRecruit();" class="nav-link px-sm-2 text-blue-grey-800">求人</a>
            </li>
            @endif
            @endif

        </ul>
        </div>
        <div class="tab-content p-0" id="myTabContent">

            @if(isset($contentMenuDesc))
            @include('SenMonTen/contents/menuDesc')
            @else
            @include('SenMonTen/contents/desc')
            @endif

            @if( !($content->service===39 or $content->service===85 or $content->service===89 or $content->service===91) )
            @include('SenMonTen/contents/menu')
            @endif

            @if( !($content->service===69 or $content->service===101) )
            @include('SenMonTen/contents/capacity')
            @endif

            @if($closeFlug)
                @include('SenMonTen/contents/close')
            @elseif($showCalenderFlug)
                @include('SenMonTen/contents/calendar')
            @else
                @include('SenMonTen/contents/entry')
            @endif

            @include('SenMonTen/contents/photo')

            @if( $contents )
            @include('SenMonTen/contents/recruit')
            @endif

        </div>
    </div>

    <div class="page-content-footer">
        <p class="right">
        </p>
    </div>

    @include('SenMonTen/include/footer')
    @include('include/footer')



</div>

@include('include/recommend_modal')
@include('SenMonTen/contents/date/include/modal')
@stop

{{-- footer scripts --}}
@section('footer_scripts')

@if($showCalenderFlug)
    @include('include/calendar_js')
@else
    @include('SenMonTen/contents/include/entry_js')
@endif


<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
@include('include/recommend_js')

<script type="text/javascript">

var showCalendarCount = 1;
function showCalendar(){
    loading();
    $('#desc-tab').hide();
    $('#menus-tab').hide();
    $('#capacity-tab').hide();
    $('#photos-videos-tab-pane').hide();
    $('#recruits-tab').hide();
    $('#calendar-tab').show('slow');

    $("#showCalendar").addClass("active");
    $("#showMenus").removeClass("active");
    $("#showCapacity").removeClass("active");
    $("#showPhotos").removeClass("active");
    $("#showDesc").removeClass("active");
    $('#showRecruit').removeClass("active");

    $('#loading').hide();
    
}

function showDesc(){
    loading();
    $('#desc-tab').show('slow');
    $('#menus-tab').hide();
    $('#capacity-tab').hide();
    $('#photos-videos-tab-pane').hide();
    $('#recruits-tab').hide();
    $('#calendar-tab').hide();

    $("#showCalendar").removeClass("active");
    $("#showMenus").removeClass("active");
    $("#showCapacity").removeClass("active");
    $("#showPhotos").removeClass("active");
    $("#showDesc").addClass("active");
    $('#showRecruit').removeClass("active");

    $('#loading').hide();
}

var showCapacityCount = 1;
function showCapacity(){
    loading();
    $('#desc-tab').hide();
    $('#menus-tab').hide();
    $('#capacity-tab').show('slow');
    $('#photos-videos-tab-pane').hide();
    $('#recruits-tab').hide();
    $('#calendar-tab').hide();

    $("#showCalendar").removeClass("active");
    $("#showMenus").removeClass("active");
    $("#showCapacity").addClass("active");
    $("#showPhotos").removeClass("active");
    $("#showDesc").removeClass("active");
    $('#showRecruit').removeClass("active");

    if(showCapacityCount){
        showCapacityCount = false;
        @if($content->service===69 or $content->service===101)
        @else
        capacity_js();
        @endif
    }else{
        $('#loading').hide();
    }
}

var showMenusCount = 1;
function showMenus(){
    loading();
    $('#desc-tab').hide();
    $('#menus-tab').show('slow');
    $('#capacity-tab').hide();
    $('#photos-videos-tab-pane').hide();
    $('#recruits-tab').hide();
    $('#calendar-tab').hide();

    $("#showCalendar").removeClass("active");
    $("#showMenus").addClass("active");
    $("#showCapacity").removeClass("active");
    $("#showPhotos").removeClass("active");
    $("#showDesc").removeClass("active");
    $('#showRecruit').removeClass("active");

    if(showMenusCount){
        showMenusCount = false;
        menu_js();
    }else{
        $('#loading').hide();
    }

}

var showPhotosCount = 1;
function showPhotos(){
    loading();
    $('#desc-tab').hide();
    $('#menus-tab').hide();
    $('#capacity-tab').hide();
    $('#photos-videos-tab-pane').show('slow');
    $('#recruits-tab').hide();
    $('#calendar-tab').hide();

    $("#showCalendar").removeClass("active");
    $("#showMenus").removeClass("active");
    $("#showCapacity").removeClass("active");
    $("#showPhotos").addClass("active");
    $("#showDesc").removeClass("active");
    $('#showRecruit').removeClass("active");

    if(showPhotosCount){
        showPhotosCount = false;
        photoJs();
    }else{
        $('#loading').hide();
    }
}

@if( $contents )
var showRecruitCount = 1;
function showRecruit(){
    loading();
    $('#desc-tab').hide();
    $('#menus-tab').hide();
    $('#capacity-tab').hide();
    $('#photos-videos-tab-pane').hide();
    $('#recruits-tab').show('slow');
    $('#calendar-tab').hide();

    $("#showCalendar").removeClass("active");
    $("#showMenus").removeClass("active");
    $("#showCapacity").removeClass("active");
    $("#showPhotos").removeClass("active");
    $("#showDesc").removeClass("active");
    $('#showRecruit').addClass("active");

    $('#loading').hide();
}
@endif



$(document).ready(function () {
    //$('#calendar-tab').hide();
});
</script>


@if($content->service===69 or $content->service===101)
<script type="text/javascript">        
</script>
@else
@include('owner/contents/capacity/' . UtilYoyaku::getNewMenuSenMonTenSummary($content->service) . '/capacity_js')
<script type="text/javascript">        
function capacity_js()
{

    axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getCapacities')
    .then(function (response) {
        result = response.data;
        //console.log(result);
        if(!ajaxCheckPublic(result)){return;}
        var insert;
        if(result.length >= 1){
            $.each(result,function(index,capacity){
                insert = createCapacity(capacity, false);
                $('#capacity-tab').append(insert);
            });
            $('[data-toggle="popover"]').popover();
        }else{
            $('#capacityNone').show();
        }
        $('#loading').hide();
    })
    .catch(function (error) {
        //console.log('err yoyakuGetCapacities');
        ajaxCheckError(error); return;
    });

}
</script>
@endif



@if( !($content->service===39 or $content->service===85 or $content->service===89 or $content->service===91) )
    @include('owner/contents/menu/' . UtilYoyaku::getNewMenuSenMonTenSummary($content->service) . '/menu_js')
    
    @if($content->service===62 or $content->service===69 or $content->service===101)
    @include('owner/contents/menu/include/menu_step_js')
    @endif
    <script type="text/javascript">        
    function menu_js()
    {
    
        axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getMenus')
        .then(function (response) {
            result = response.data;
            if(!ajaxCheckPublic(result)){return;}
            var insert;
            if(result.length >= 1){
                $.each(result,function(index,menu){
                    insert = createMenu(menu, null);
                    $('#menus-tab').append(insert);
                });
                $('[data-toggle="popover"]').popover();
            }else{
                $('#menuNone').show();
            }
            $('#loading').hide();
        })
        .catch(function (error) {
            //console.log('err yoyakuGetMenus');
            ajaxCheckError(error); return;
        });
    
    }
    </script>
@endif

@include('SenMonTen/contents/photo/js')




@if($content->service===91)
<script> function recaptchaCallback(param) { if(param) { document.getElementById('submit').disabled = ""; } } </script>
@endif

@stop
