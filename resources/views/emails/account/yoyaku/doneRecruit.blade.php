@extends('emails/layouts/default')

@section('title') @stop

@section('content')
<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>{!! $user->name !!} さん</strong>
<br />
<strong>資格問題ＣＯＯＤです。</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
{!!$content->name!!}への面接のご予約が完了しましたのでご連絡いたします。<br />
<br />
--------------<br />
面接開始日時： {!!date('Y-m-d H:i', strtotime($content_date_user->start))!!}<br />
終了予定時間： {!!date('Y-m-d H:i', strtotime($content_date_user->end))!!}<br />
--------------
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
ご予約の詳細は<a href="https://www.coordiy.com/account/yoyaku/history/{!!$content_date_user->id!!}/show">こちら</a>からいつでもご確認できます。<br />
受付の際はご予約者との同一性が必要なサービスがあるため、スマフォなどの端末から予約IDを確認させていただく場合がございますのであらかじめご了承ください。<br />
何卒よろしくお願いいたします。
</p>

@stop
