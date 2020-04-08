@extends('layouts/default')

{{-- Page title --}}
@section('title') フォトクレジット @parent
@stop

@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="Coordiy予約のフォトクレジットページです。">
<meta name="keywords" content="予約,予約管理,Coordiy予約,フォトクレジット">
<meta property="og:site_name" content="Coordiy予約">
<meta property="og:title" content="Coordiy予約">
<meta property="og:description" content="Coordiy予約のフォトクレジットページです。">
<meta property="og:image" content="/storage/assets/img/logo_new_1600.png">
<meta property="og:url" content="{!!$_SERVER['HTTP_HOST']!!}">
<meta property="og:locale" content="ja_JP">
<meta property="og:type" content="website">
@stop

{{-- page level styles --}}
@section('header_styles')
<style>
h2, h3, h4, h5 {
    padding-top: 30px !important;
}
</style>
@stop

{{-- content --}}
@section('content')
<div class="page-layout simple full-width">

<div class="page-content p-2">

<h2 class="center">フォトクレジット<br />Photo Credit</h2>
<p class="center">私たちはこのサイトに多大なる貢献をしてくださった以下のクリエイターに心より感謝いたします。</p>
<p class="center">We appreciate the following creators who made a great contribution to this site.</p>
<hr class="border-bottom my-10" />

<div id="profile">
<div class="photos-videos-tab-pane" id="photos-videos-tab-pane">
<div class="photos-videos">
    <div class="period pt-2">
        <div id="mediaAddArea" class="period-media row no-gutters">
            

            @foreach(Util::getPhotoCredit() as $photo)
            <div class="media col-sm ml-2 mb-2">
            <a href="{!!$photo['url']!!}" title="{!!$photo['title']!!}" target="_blank">
              <img class="preview w-100" src="{!!$photo['src']!!}" title="Photo credit: {!!$photo['credit']!!}" />
              <div class="title p-4 f11">{!!$photo['credit']!!}</div>
            </a>
            </div>
            @endforeach
            
            
        </div>
    </div>
</div>
</div>


</div>

@include('include/footer')
</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')

@stop
