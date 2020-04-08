@extends('layouts/default')

{{-- Page title --}}
@section('title') メール確認 中小企業診断士 過去問受験 科目学習 @parent
@stop


@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="メール確認ページです。">
<meta property="og:site_name" content="Coord">
<meta property="og:title" content="Coord">
<meta property="og:description" content="メール確認ページです。">
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

<div id="login-v2" class="row no-gutters">

    @include('auth/include/left')

    <div class="form-wrapper col-12 col-md-auto d-flex justify-content-center p-4 p-md-0">

        <div class="form-content md-elevation-8 h-100 bg-white text-auto py-16 py-md-32 px-12">

            <div class="h5 mt-8"><i class="icon icon-login-variant text-red-500"></i>メール確認</div>

            <div class="h5 mt-8">
                <p>ご登録いただいたＥメールへアカウント登録メールを送信しました。<br /><br />ご確認ください。</p>
            </div>

        </div>
        
    </div>
</div>



@stop

{{-- footer scripts --}}
@section('footer_scripts')

@stop