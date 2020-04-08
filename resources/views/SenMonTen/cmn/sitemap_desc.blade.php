<?php
if($yoyaku_type_tag_name){
    $title=$country_area_name.'の'.$yoyaku_type_tag_name.'のタグがある'.$yoyaku_type_name;
}else{
    $title=$country_area_name.'の'.$yoyaku_type_name.' '.count($contents).'件';
}
?>
@extends('SenMonTen/layouts/default')

{{-- Page title --}}
@section('title') {!!$title!!} {!!count($contents)!!}件 @parent
@stop


@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="{!!$title!!} 一覧です。">
<meta name="keywords" content="予約,予約管理,Coordiy予約,予約ルール">
<meta property="og:site_name" content="{!!$GLOBALS['yoyaku_type_name']!!}Coordiy予約">
<meta property="og:title" content="{!!$title!!}">
<meta property="og:description" content="{!!$title!!} 一覧です。">
<meta property="og:image" content="/storage/assets/img/logo_new_1600.png">
<meta property="og:url" content="{!!$_SERVER['HTTP_HOST']!!}">
<meta property="og:locale" content="ja_JP">
<meta property="og:type" content="website">
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')


<div class="page-layout simple full-width">
<div class="page-content">


    <div class="card">
        <div class="card-body row">
            <div class="col-12 mb-10">
                <h1>{!!$title!!} {!!count($contents)!!}件</h1>
            </div>
            @foreach($contents as $content)
            <div class="col-sm-6 col-lg-4">

                <p>
                    <a class="pr-2" href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/contents/{!!$content->id!!}/desc">
                        @if($yoyaku_type_id===4 or $yoyaku_type_id===6 or $yoyaku_type_id===7)
                            {!!$content->menu_name!!} | {!!$content->name!!}
                        @else
                            {!!$content->name!!}
                        @endif
                    </a>
                </p>
            </div>
            @endforeach
        </div>
    </div>



</div>
@include('SenMonTen/include/footer')
@include('include/footer')
</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')

@stop
