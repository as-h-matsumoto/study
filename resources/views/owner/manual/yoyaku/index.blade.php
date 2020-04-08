@extends('owner/layouts/default')

{{-- Page title --}}
@section('title')オーナークイックマニュアル @parent
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
            オーナー クイックリファレンス
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

                    @include('/owner/manual/yoyaku/include/menu')

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

            <h2 class="introduce-title-circle">クイックリファレンス</h2>

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
                    <li><a href="#contentCreate">ホーム</a></li>
                    <li><a href="#golist">コンテンツ</a></li>
                    <li><a href="#capacity">カスタマー</a></li>
                    <li><a href="#menu">会社情報</a></li>
                    <li><a href="#desc">会社カレンダー</a></li>
                    <li><a href="#cancel">会社口座</a></li>
                    <li><a href="#date">ネット決済</a></li>
                    <li><a href="#yoyaku">サポート</a></li>
                </ol>
            </p>

            <h4 id="contentCreate" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">1.ホーム</h2>
            <p>
                <span>ホームはオーナートップページに当たります。</span><br />
                <span>このページでは次の内容を確認できます。</span><br />
                <ul>
                    <li>総売上額</li>
                    <li>総顧客数</li>
                    <li>次回入金額</li>
                    <li>月間売上げ額チャート</li>
                    <li>週間売上げ額チャート</li>
                    <li>月間売上げ件数チャート</li>
                    <li>週間売上げ件数チャート</li>
                    <li>月間顧客チャート</li>
                    <li>週間顧客チャート</li>
                </ul>
            </p>



            <h4 id="golist" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">2.コンテンツ</h2>
            <p>
                <span>コンテンツは、店舗管理を行うページです。</span><br />
                <span>店舗ごとの予約受付管理などもすべてこのページからスタートします。</span><br />
            </p>

            <h4 id="capacity" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">3.カスタマー</h2>
            <p>
                <span>ホームはオーナートップページに当たります。</span><br />
                <span>このページでは次の内容を確認・編集できます。</span><br />
                <ul>
                    <li>顧客名</li>
                    <li>誕生日</li>
                    <li>電話番号</li>
                    <li>顧客メモ</li>
                    <li>利用いただいたコンテンツ</li>
                    <li>最近の利用日</li>
                    <li>総支払額</li>
                    <li>総利用回数</li>
                </ul>
            </p>

            <h4 id="menu" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">4.会社情報</h2>
            <p>
                <span>会社情報は、会社登録内容の確認・編集を行うページです。</span><br />
                <span>サービス（飲食店・レストラン、スタジオなど）の追加を行う場合はこちらから登録します。</span><br />
            </p>

            <h4 id="desc" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">5.会社カレンダー</h2>
            <p>
                <span>会社カレンダーは、営業日や休日を登録するページです。</span><br />
                <span>実態にあわせて登録してください。</span><br />
            </p>

            <h4 id="cancel" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">6.会社口座</h2>
            <p>
                <span>会社口座は、Coordiy予約がカスタマーから回収した料金をオーナー様へお振込みする口座です。</span><br />
                <span>この登録がなければお振込みができませんので必ずご登録ください。</span>
            </p>

            <h4 id="date" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">7.ネット決済</h2>
            <p>
                <span>ネット決済は、お店やサービスの予約受付時にネット決済を利用する場合にネット決済利用を申請するページです。</span><br />
                <span>ネット決済を利用する場合は手数料4％+40円～がかかります。</span>
            </p>

            <h4 id="date" class="secondary-text py-6 mt-10 mb-6 introduce-title-stripe">8.サポート</h2>
            <p>
                <span>サポートは、問合せや、運用サポート依頼、メディア制作依頼を行うページです。</span>
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

