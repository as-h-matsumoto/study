@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') サイトマップ作成 @parent
@stop


@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')
<div id="project-dashboard" class="page-layout simple full-width">

    @include('manager/include/header')

    <div class="page-content p-4 bg-white-500 " style="overflow-y:scroll;">

      <h1>サイトマップ作成</h1>

      <span class="pr-2 pb-2"><a href="/manager/create/sitemap/yoyaku" class="btn btn-outline-info">予約サイトマップ作成</a></span><span class="pr-2 pb-2"><a class="btn btn-outline-info" href="/storage/sitemap.xml" target="_blank" >予約サイトマップ確認</a></span>
      <br /><br />
      <span class="pr-2 pb-2"><a href="/manager/create/sitemap/yoyakug" class="btn btn-outline-info">予約サイトマップG作成</a></span><span class="pr-2 pb-2"><a class="btn btn-outline-info" href="/storage/sitemap_g.xml" target="_blank" >予約サイトマップG確認</a></span>

    </div>

</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')

@stop
