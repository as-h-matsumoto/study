<?php
//if( !($content->service===4 or $content->service===6 or $content->service===7) ){
if( isset($menu) ){
    $title_name_one = $menu->name;
}else{
    $title_name_one = $content->name;
}
?>
@extends('SenMonTen/iframe/layouts/default')

{{-- Page title --}}
@section('title') {!!$title_name_one!!} 予約カレンダー @parent
@stop


@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="{!!$title_name_one!!} の予約ページです。">
<meta name="keywords" content="{!!$title_name_one!!}">
<meta property="og:site_name" content="Coordiy予約">
<meta property="og:title" content="Coordiy予約">
<meta property="og:description" content="{!!$title_name_one!!} の予約ページです。">
<meta property="og:image" content="/storage/assets/img/logo_new_1600.png">
<meta property="og:url" content="{!!$_SERVER['HTTP_HOST']!!}">
<meta property="og:locale" content="ja_JP">
<meta property="og:type" content="website">
@stop

{{-- page level styles --}}
@section('header_styles')

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
</style>

<style>
.table.table-hover.contentDesc tbody th,.table.table-hover.contentDesc tbody td{
    padding:0 !important;
    padding: 2px 4px !important;
    text-align:center!important;
    font-size: 11px;
}
</style>
@stop

{{-- content --}}
@section('content')

<div id="profile" class="page-layout simple right-sidebar">

    <!-- CONTENT -->
    <div class="page-content">

        @include('SenMonTen/iframe/include/calendar')

    </div>

</div>

@include('include/recommend_modal')
@include('SenMonTen/contents/date/include/modal')
@stop

{{-- footer scripts --}}
@section('footer_scripts')

@include('include/calendar_js')



@stop
