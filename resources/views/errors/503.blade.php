@extends('layouts/default')
<?php
$schema=null;
?>

{{-- Page title --}}
@section('title') ５０３エラー @parent
@stop


@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="５０３エラー">
<meta name="keywords" content="５０３エラー">
<meta property="og:site_name" content="Coordiy予約">
<meta property="og:title" content="Coordiy予約">
<meta property="og:description" content="５０３エラー">
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
<div id="error-404" class="d-flex flex-column align-items-center justify-content-center">

    <div class="content">

        <div class="error-code display-1 text-center">503</div>

        <div class="message h4 text-center text-muted">ただいま、大変込み合っております。大変申し訳ございませんが、改めて、アクセスいただきますよう、お願い申し上げます。</div>


        <a class="back-link d-block text-center text-primary" href="/">トップへ</a>

    </div>
</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')


@stop
