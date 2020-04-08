@extends('layouts/default')

{{-- Page title --}}
@section('title') 対応ブラウザー @parent
@stop


@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="Coordiy予約の対応ブラウザー一覧ページです。">
<meta name="keywords" content="予約,予約管理,対応ブラウザー">
<meta property="og:site_name" content="Coordiy予約">
<meta property="og:title" content="Coordiy予約">
<meta property="og:description" content="Coordiy予約の対応ブラウザー一覧ページです。">
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
<div class="page-content table-div p-6">

<h1>対応ブラウザー</h1>

<p>対応ブラウザーは以下の通りです。対応しているブラウザーからCoordiy予約をご利用ください。</p>

<table class="table">
    <thead>
        <tr>
            <th>ブラウザー</th>
            <th>対応状況</th>
            <th>対応予定</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">Internet exproler</th>
            <td class="f20">×</td>
            <td>なし</td>
        </tr>
        <tr>
            <th scope="row">chrome</th>
            <td class="f20">○</td>
            <td>永続対応</td>
        </tr>
        <tr>
            <th scope="row">Firefox</th>
            <td class="f20">○</td>
            <td>永続対応</td>
        </tr>
        <tr>
            <th scope="row">Safari</th>
            <td class="f20">○</td>
            <td>永続対応</td>
        </tr>
        <tr>
            <th scope="row">Opera</th>
            <td class="f20">○</td>
            <td>永続対応</td>
        </tr>
        <tr>
            <th scope="row">Edge</th>
            <td class="f20">○</td>
            <td>永続対応</td>
        </tr>
    </tbody>
</table>



</div>

@include('include/footer')
</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')

@stop
