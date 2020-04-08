<?php
  $pageTitle = '';
  $capaName = '';
  $CheckNameSummary = '';
  $CheckNameDesc = '';
  switch ($GLOBALS['urls'][5]){
    case 'food':
        $pageTitle = '飲食店・レストラン';
        $capacity = UtilYoyaku::getContentServices(1,'capacityFooterButton',null);
        $menu = true;
        break;
    case 'active':
        $pageTitle = 'レジャー・スポーツ';
        $capacity = UtilYoyaku::getContentServices(2,'capacityFooterButton',null);
        $menu = false;
        break;
    case 'experience':
        $pageTitle = '体験';
        $capacity = UtilYoyaku::getContentServices(3,'capacityFooterButton',null);
        $menu = true;
        break;
    case 'lesson':
        $pageTitle = 'スクール・レッスン';
        $capacity = UtilYoyaku::getContentServices(4,'capacityFooterButton',null);
        $menu = true;
        break;
    case 'spasalon':
        $pageTitle = 'スパ・エステ';
        $capacity = UtilYoyaku::getContentServices(5,'capacityFooterButton',null);
        $menu = true;
        break;
    case 'tour':
        $pageTitle = 'ツアー';
        $capacity = null;
        $menu = true;
        break;
    case 'ticket':
        $pageTitle = 'チケット';
        $capacity = null;
        $menu = true;
        break;
    case 'hairsalon':
        $pageTitle = 'ヘアーサロン・美容院';
        $capacity = UtilYoyaku::getContentServices(8,'capacityFooterButton',null);
        $menu = true;
        break;
    case 'stay':
        $pageTitle = '旅館・ホテル';
        $capacity = UtilYoyaku::getContentServices(9,'capacityFooterButton',null);
        $menu = true;
        break;
    case 'studio':
        $pageTitle = 'スタジオ';
        $capacity = UtilYoyaku::getContentServices(10,'capacityFooterButton',null);
        $menu = false;
        break;
    case 'kaigi':
        $pageTitle = '会議室';
        $capacity = UtilYoyaku::getContentServices(11,'capacityFooterButton',null);
        $menu = false;
        break;
  }
?>


@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') {!!$pageTitle!!} オーナーマニュアル @parent
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
            {!!$pageTitle!!}
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
                <ul>
                    <li><a href="#contentCreate">1.店舗（コンテンツ）作成</a></li>
                    <li><a href="#golist">2.所在地</a></li>
                    @if($capacity)
                    <li><a href="#capacity">3.{!!$capacity!!}登録</a></li>
                    @endif
                    @if($menu)
                    <li><a href="#menu">4.メニュー登録</a></li>
                    @endif
                    <li><a href="#desc">5.概要登録</a></li>
                    @if(!$menu)
                    <li><a href="#cancel">6.割引登録</a></li>
                    @endif
                    <li><a href="#cancel">7.キャンセル料登録</a></li>
                    <li><a href="#date">8.予約受付登録</a></li>
                    <li><a href="#yoyaku">9.予約確認</a></li>
                </ul>
            </p>

            <h4 id="contentCreate" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">1.店舗（コンテンツ）作成</h2>
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



            <h4 id="golist" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">2.所在地／目的地</h2>
            <p>
                <img src="" width="100%" />
            </p>
            <p>
                <ul>
                    <li>コンテンツメニューから「所在地／目的地」を開きます。</li>
                    <li>店舗を店舗名、または、住所で検索します。</li>
                    <li>検索結果をマップ上から選択し、必要に応じて住所を変更を行い登録します。</li>
                </ul>
            </p>

            @if($capacity)
            <h4 id="capacity" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">3.{!!$capacity!!}登録</h2>
            <p>
                <ul>
                    <li>コンテンツメニューから「施設設備」を開きます。</li>
                    <li>「{!!$capacity!!}追加」を選択します。</li>
                    <li>実態に合わせて{!!$capacity!!}を登録します。</li>
                </ul>
            </p>
            @endif

            @if($menu)
            <h4 id="menu" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">4.メニュー登録</h2>
            <p>
                <ul>
                    <li>コンテンツメニューから「メニュー」を開きます。</li>
                    <li>「メニュー追加」を選択します。</li>
                    <li>実態に合わせメニューを登録します。</li>
                </ul>
            </p>
            @endif

            <h4 id="desc" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">5.概要登録</h2>
            <p>
                <ul>
                    <li>コンテンツメニューから「概要」を開きます。</li>
                    <li>実態に合わせ概要を登録します。</li>
                </ul>
            </p>

            @if(!$menu)
            <h4 id="cancel" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">6.割引</h2>
            <p>
                <ul>
                    <li>コンテンツメニューから「割引設定」を開きます。</li>
                    <li>実態に合わせ割引料を登録します。</li>
                </ul>
            </p>
            @endif

            <h4 id="cancel" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">7.キャンセル料登録</h2>
            <p>
                <ul>
                    <li>コンテンツメニューから「キャンセル料」を開きます。</li>
                    <li>実態に合わせキャンセル料を登録します。</li>
                </ul>
            </p>

            <h4 id="date" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">8.予約受付登録</h2>
            <p>
                <ul>
                    <li>コンテンツメニューから「予約管理」を開きます。</li>
                    <li>予約受付を開始する日をカレンダーで選択します。</li>
                    <li>予約受付内容を入力し「予約受付開始」を選択します。</li>
                </ul>
            </p>

            <h4 id="yoyaku" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">9.予約確認</h2>
            <p>
                <ul>
                    <li>コンテンツメニューから「掲載確認」を開きます。</li>
                    <li>個々のご予約を確認する場合はイベントをクリックして確認します。</li>
                    <li>各日程の予約数やメニュー残数を確認するには確認したい日のカレンダーをクリックします。</li>
                    <li>電話で予約を入れる場合はカレンダーをクリックした後に「新規予約」をクリックして登録します。</li>
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

