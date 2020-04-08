@extends('yoyaku/layouts/default')

{{-- Page title --}}
@section('title'){!!'サイトマップ'!!} @parent
@stop


@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="Coordiy予約のサイトマップです。">
<meta name="keywords" content="予約,予約管理,Coordiy予約,予約ルール">
<meta property="og:site_name" content="Coordiy予約">
<meta property="og:title" content="サイトマップ">
<meta property="og:description" content="Coordiy予約のサイトマップです。">
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
<div class="page-content row">

<?php $count = 0; ?>
@foreach($country_area as $area)
    <div class="card col-sm-6 col-lg-4">
        <div class="card-body">
            <h1>{!!$area->name!!}</h1>
            @foreach($services as $key=>$service)
                <p><a class="pr-2" href="/yoyaku/sitemap/desc?country_area_id={!!$area->ken_id!!}&yoyaku_type_id={!!$key!!}">{!!$area->name!!}の{!!$service!!}</a></p>
                <?php $count++; ?>
                <?php
                    $tags = UtilYoyaku::getNewContentTag($key,null);
                ?>
                @foreach($tags as $tag_key=>$tag)
                <?php //if($tag_key>=40) break; ?>
                <?php $count++; ?>
                <p><a class="pr-2" href="/yoyaku/sitemap/desc?country_area_id={!!$area->ken_id!!}&yoyaku_type_id={!!$key!!}&yoyaku_type_tag_id={!!$tag_key!!}">{!!$area->name!!}の{!!$tag!!}のタグがある{!!$service!!}</a></p>
                @endforeach
            @endforeach
        </div>
    </div>
@endforeach


    <div class="card col-12">
        <div class="card-body">
            <p class="h3">合計: {!!$count!!}ページ</p>
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
