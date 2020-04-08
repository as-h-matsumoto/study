@extends('layouts/default')

{{-- Page title --}}
@section('title') 特定商取引法の表示 @parent
@stop

@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="Coordiy予約の特定商取引法のページです。">
<meta name="keywords" content="予約,予約管理,特定商取引法">
<meta property="og:site_name" content="Coordiy予約">
<meta property="og:title" content="Coordiy予約">
<meta property="og:description" content="Coordiy予約の特定商取引法のページです。">
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
<div class="page-content p-6">

<h1>特定商取引法の表示</h1>
       <p>
       オーナ様が販売者としてCoordiy予約をご利用になる際に必要な料金等をご案内します。
       </p>

       <h2>役務の内容</h2>
       <p>
       販売者に対してCoordiy予約上で商品や役務を販売する場を提供します。
       </p>

       <h2>役務の対価</h2>
       <p>
       商品を販売する際、ネット決済をご利用の場合には販売手数料として決済金額の4％+40円～がかかります。
       </p>

       <h2>役務の対価の支払い方法・支払時期</h2>
       <p>Coordiy予約を通じて発生したお客様の売上は、売上の締め日にお振り込み対象の合計金額が1万円以上ある場合に、ご指定いただいている銀行口座にお振り込みいたします。
       <br />合計金額が1万円に満たない場合は、次回入金に繰り越しされます。
       <br />通常は月末を売上の締め日とし、40日後にお振り込みいたします。
       <br />お振り込み対象の合計金額は、ご予約者にサービスが提供されたものが対象となります。
       <br />また振込の際、振込手数料として450円を売上より差し引かせていただきます。
       <br />なお、振込日が営業日ではない場合は、翌営業日にお振り込みいたします。
       <br />その他に、決済手数料・返金などによって相殺する金額が発生した場合も、お振り込み金額から差し引かせていただき、残金をお振り込みいたします。</p>

       <h2>役務提供事業者</h2>
       <p>
株式会社コーディ<br />
東京都江東区東陽3-23-26 東陽町コーポラス3F<br />
03-3527-9249
       </p>

       <h2>代表者</h2>
       <p>
       代表取締役　松本 裕次
       </p>

       <h2>そのほかの注意事項</h2>
       <p>
       サービスの予約受付ルールは<a class="text-blue-400" href="/cmn/terms/owner">こちら</a>もご確認ください。
       </p>

       <h2>動作環境</h2>
       <p>
       <a class="text-blue-400" href="/cmn/browser">こちら</a>をご覧ください。
       </p>


</div>

@include('include/footer')
</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')

@stop

