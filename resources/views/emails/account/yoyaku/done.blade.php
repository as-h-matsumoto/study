@extends('emails/layouts/default')

@section('title') @stop

@section('content')
<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>{!! $user->name !!} 様</strong>
<br />
<strong>資格問題ＣＯＯＤです。</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
{!!$content->name!!}へのご予約が完了しましたのでご連絡いたします。<br />
つきましては、予約IDを発行しましたのでご確認ください。<br />
次の予約IDは誰にも見られないように大切に保管ください。受付の際に必要となります。<br />
<br />
--------------<br />
予約ID：    {!!$content_date_user->yoyaku_id!!}<br />
ご利用日時： {!!date('Y-m-d H:i', strtotime($content_date_user->start))!!}<br />
--------------
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
ご予約の詳細は<a href="https://www.coordiy.com/account/yoyaku/history/{!!$content_date_user->id!!}/show">こちら</a>からいつでもご確認できます。<br />
受付の際はご予約者との同一性が必要なサービスがあるため、スマフォなどの端末から予約IDを確認させていただく場合がございますのであらかじめご了承ください。<br />
何卒よろしくお願いいたします。
</p>

@stop
