@extends('layouts/default')

{{-- Page title --}}
@section('title') コーディ @parent
@stop

@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="コーディのホスティングウェブ一覧です。">
<meta name="keywords" content="予約,予約管理,Coordiy予約">
<meta property="og:site_name" content="Coordiy : コーディ">
<meta property="og:title" content="Coordiy : コーディ">
<meta property="og:description" content="コーディのホスティングウェブ一覧です。">
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
<div class="page-content px-6 pt-2">

    <div id="page-header-introduce" class="mb-2"
        style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_02.jpeg');" >
        <div class="bg-mask p-4">
                <p class="center">
                    <img src="/storage/assets/img/logo_new_400.png" title="Coordiy" alt="Coordiy" style="width:100%;max-width:300px;" />
                </p>
        </div>  
    </div>

    <div class="row" >




        <div class="card col-sm-6 col-lg-4 col-xl-3 mb-2">
            <div class="card-body">
                <a href="/yoyaku">
                <div class="center">
                    <img class="center" src="/storage/assets/img/yoyaku_logo_400.png" width="100%" />
                </div>
                <div class="pt-4">
		            <p class="h4 center"><strong>
                        <span class="introduce-title-modan text-teal-700">予約管理サービス</span>
                    </strong></p>

                    <br />

                    <p class="h6 center"><strong>
                        予約端末導入、電話連携、アプリ・サイト連携、初期費用・運用費用、一切必要ありません。
                        <br /><br />
                        モバイル端末ですべての予約管理をスマートにこなします。
                    </strong></p>
                </div>
                </a>
            </div>
        </div>

        <div class="card col-sm-6 col-lg-4 col-xl-3 mb-2">
            <div class="card-body">
                <a href="/SenMonTen">
                <div class="center">
                    <img class="center" src="/storage/assets/img/uranai_senmonten_logo_400.png" width="100%" />
                </div>
                <div class="pt-4">
		            <p class="h4 center"><strong>
                        <span class="introduce-title-modan text-teal-700">Coordiy予約</span>
                    </strong></p>

                    <br />

                    <p class="h6 center"><strong>
                        Coordiy予約
                    </strong></p>
                </div>
                </a>
            </div>
        </div>

        <div class="card col-sm-6 col-lg-4 col-xl-3 mb-2">
            <div class="card-body">
                <a href="/benri">
                <div class="pt-4">
		            <p class="h4 center"><strong>
                        <span class="introduce-title-modan text-teal-700">ベンリー</span>
                    </strong></p>

                    <br />

                    <p class="h6 center"><strong>
                        便利なツールサイト
                    </strong></p>
                </div>
                </a>
            </div>
        </div>

        <div class="card col-sm-6 col-lg-4 col-xl-3 mb-2">
            <div class="card-body">
                <a href="/speak">
                <div class="pt-4">
		            <p class="h4 center"><strong>
                        <span class="introduce-title-modan text-teal-700">コメンディ</span>
                    </strong></p>

                    <br />

                    <p class="h6 center"><strong>
                        コメントしてお金を稼ぐサイト
                    </strong></p>
                </div>
                </a>
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
