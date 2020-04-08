@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') ご予約ルール @parent
@stop


@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="Coordiy予約のご予約ルールページです。">
<meta name="keywords" content="予約,予約管理,Coordiy予約,予約ルール">
<meta property="og:site_name" content="Coordiy予約">
<meta property="og:title" content="Coordiy予約">
<meta property="og:description" content="Coordiy予約のご予約ルールページです。">
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

<h1>ご予約ルール</h1>

<p>ご予約ルールは、ご利用者様が予約する際のルールや、厳守する事項が明記されております。</p>
<p>これらの内容は、Coordiy予約を利用されるすべての方に適用されます。</p>

<ul>
<li>予約について</li>
<li>ご予約時のお支払いについて</li>
<li>キャンセルについて</li>
<li>お店に出向いた時の手続きについて</li>
</ul>

<h3>予約について</h3>
<p>
ご予約は、オーナー様が予約受付を行っている日時から、ご利用開始時間、ご利用メニュー、個数などを選択し、ご予約することができます。
</p>

<h3>ご予約時のお支払いについて</h3>
<p>
ご予約時のお支払いは、それぞれのお店やチケットなどの各コンテンツによって、ネット決済、もしくは、予約受付のみの場合があります。<br /><br />
ネット決済の場合は、クレジットカードを登録してお支払いください。<br />
クレジットカード番号などのカード情報はCoordiy予約では一切保有せず、カード決済会社PAYJPで管理していますので、お客様の安全はより高いものになります。<br /><br />
予約受付のみの場合は、ご予約のみとなりますので、お店や会場などで直接お支払いください。
</p>

<h3>キャンセルについて</h3>
<p>
もし、ご予約日時にどうしてもお客様のご都合がつかなくなった場合、ご予約をキャンセルすることができます。<br />
ただし、ネット決済によるお支払いがお済の場合、キャンセル料がかかる場合がございます。<br />
キャンセル料は、各コンテンツに記載されておりますので必ずご確認いただけますようお願い申し上げます。<br /><br />
また、天災や、雨天に影響を強く受けるサービスや、一身上の都合により急遽サービス提供が難しくなった場合など、社会通念上キャンセルが許される場合のみオーナー様からキャンセルとさせていただく場合がございまのであらかじめご了承ください。<br />
オーナー様からのキャンセルはすべて料金は発生いたしません。<br />
ネット決済済みの場合は支払いキャンセルとさせていただきます。
</p>

<h3>お店に出向いた時の手続きについて</h3>
<p>
ご予約が完了しますと、予約者様に予約IDが発行されます。（オーナー様にもメールが届きます。）<br />
予約IDはCoordiy予約の予約履歴からいつでも確認することができます。<br />
この予約IDをお客様のスマートフォンなどの電子端末からお店や会場でご提示いただけますようお願いいたします。<br />
この予約IDを印刷してご提示する場合は、ご予約者とお越しになった方の同一性が保たれない場合があるため、コンテンツによっては許可されない場合がございます。必ずオーナー様にご確認ください。
</p>

</div>

@include('owner/include/footer')
@include('include/footer')
</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')

@stop
