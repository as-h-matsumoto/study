@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 求人 オーナーマニュアル @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')



<div class="page-layout simple left-sidebar-floating">

<!-- HEADER -->
<div class=""
    style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_05.jpeg')">

    <div class="p-10 d-flex flex-row align-items-center bg-mask-hard">

        <button type="button" class="sidebar-toggle-button btn btn-icon d-block d-lg-none mr-2" data-fuse-bar-toggle="demo-sidebar">
            <i class="icon icon-menu"></i>
        </button>

        <p class="h4 center">
            <img src="/storage/assets/img/yoyaku_logo_400.png" title="Coordiy予約" alt="Coordiy予約" style="max-width:250px;" />
            <br />
            求人
            <br />
            オーナーマニュアル
        </p>

    </div>
</div>
<!-- / HEADER -->

<div class="page-content-wrapper bg-white-500">

    <aside class="page-sidebar p-6" data-fuse-bar="demo-sidebar" data-fuse-bar-media-step="md" fuse-cloak>

        <div class="page-sidebar-card">
            <!-- DEMO CONTENT -->
            <div class="demo-sidebar">

                <ul class="nav flex-column">

                    <li class="subheader">１ スタートアップ</li>

                    <li class="nav-item active">
                        <a class="nav-link">１、１ クイックスタート</a>
                    </li>

<!--
                    <md-divider></md-divider>

                    <li class="subheader">２ コンテンツ 登録・編集</li>

                    <li class="nav-item">
                        <a class="nav-link">２、１ 所在地</a>
                    </li>

                    <md-divider></md-divider>

                    <li class="nav-item">
                        <a class="nav-link">２、２ キャパシティ</a>
                    </li>

                    <md-divider></md-divider>

                    <li class="nav-item">
                        <a class="nav-link">２、３ メニュー</a>
                    </li>

                    <md-divider></md-divider>

                    <li class="nav-item">
                        <a class="nav-link">２、４ 概要</a>
                    </li>

                    <md-divider></md-divider>

                    <li class="nav-item">
                        <a class="nav-link">２、５ キャンセル料</a>
                    </li>

                    <md-divider></md-divider>

                    <li class="nav-item">
                        <a class="nav-link">２、６ 予約受付</a>
                    </li>
-->

                </ul>
            </div>
            <!-- / DEMO CONTENT -->
        </div>

    </aside>

    <!-- CONTENT -->
    <div class="page-content p-6">

        <!-- DEMO CONTENT -->
        <!-- DEMO CONTENT -->
        <div class="demo-content">

            <h2 class="introduce-title-circle">クイックスタート</h2>

            <h4 class="secondary-text">前提</h4>
            <p>
                このマニュアルをご利用する前に以下の対応を完了させてください。
            </p>
            <p>
                <ul>
                    <li>ログイン</li>
                    <li>オーナー登録</li>
                </ul>
            </p>

            <h4 class="secondary-text">もくじ</h4>
            <p>
                <ol>
                    <li><a href="#contentCreate">求人（コンテンツ）作成</a></li>
                    <li><a href="#golist">所在地登録</a></li>
                    <li><a href="#capacity">面接ルーム登録</a></li>
                    <li><a href="#desc">概要登録</a></li>
                    <li><a href="#date">面接受付登録</a></li>
                    <li><a href="#yoyaku">エントリー確認</a></li>
                </ol>
            </p>

            <h4 id="contentCreate" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">1.求人（コンテンツ）作成</h2>
            <p>
                ※Coordiy予約では「店舗」を「コンテンツ」と表現しています。<br />
                ※同じサービスを行う店舗が複数ある場合は、店舗の数だけコンテンツを作成してください。<br />
            </p>
            <p>
                <ul>
                    <li>右上のプロフィールメニューから「オーナーページ」を開きます。</li>
                    <li>メニューから「コンテンツ」を開きます。</li>
                    <li>コンテンツトップエリアから「作成」選択します。</li>
                    <li>サービスタイプを選択します。</li>
                    <li>コンテンツ名（店舗名）を入力して、ページ下にある「登録」を選択します。</li>
                </ul>
            </p>



            <h4 id="golist" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">2.所在地登録</h2>
            <p>
                <img src="" width="100%" />
            </p>
            <p>
                <ul>
                    <li>コンテンツメニューから「所在地／目的地」を開きます。</li>
                    <li>面接行う場所を、会社名、または、住所で検索します。</li>
                    <li>検索結果をマップ上から選択し、必要に応じて住所を変更を行い登録します。</li>
                </ul>
            </p>

            <h4 id="capacity" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">3.面接ルーム登録</h2>
            <p>
                <ul>
                    <li>コンテンツメニューから「施設設備」を開きます。</li>
                    <li>「面接ルーム追加」を選択します。</li>
                    <li>実態に合わせて面接ルームを登録します。</li>
                </ul>
            </p>

            <h4 id="menu" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">4.概要登録</h2>
            <p>
                <ul>
                    <li>コンテンツメニューから「概要」を開きます。</li>
                    <li>面接回数、面接依頼メール、採用メールなどを登録します。</li>
                </ul>
            </p>

            <h4 id="desc" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">5.面接受付登録</h2>
            <p>
                <ul>
                    <li>コンテンツメニューから「面接受付」を開きます。</li>
                    <li>面接を行う日を、カレンダーで選択します。</li>
                    <li>面接当日のスケジュールを登録します。</li>
                </ul>
            </p>

            <h4 id="cancel" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">6.エントリー確認</h2>
            <p>
                <ul>
                    <li>コンテンツメニューから「エントリー」を開きます。</li>
                    <li>エントリー内容を確認して、面接・採用・不採用などの対応を決定します。</li>
                </ul>
            </p>

        </div>
        <!-- / DEMO CONTENT -->
        <!-- / DEMO CONTENT -->

    </div>
    <!-- / CONTENT -->
    
</div>
@include('owner/include/footer')
@include('include/footer')
</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')

@stop

