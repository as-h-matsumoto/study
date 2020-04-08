@extends('emails/layouts/default')

@section('title') @stop

@section('content')

<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>{!! $owner->name !!} 様</strong>
<br />
<strong>Coordiy予約でございます。</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:16px;line-height:1.5em;">
{!!$user->name!!}様から {!!$content->name!!}へのご予約を承りましたのでご連絡いたします。<br />
つきましては、予約IDを発行しましたのでご確認ください。<br />
次の予約IDはお客様を特定するためのIDです。従業員様以外に見られないように大切に保管してください。<br />
<br />
--------------<br />
予約ID：    {!!$content_date_user->yoyaku_id!!}<br />
ご利用日時： {!!date('Y-m-d H:i', strtotime($content_date_user->start))!!}<br />
--------------
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
ご予約の詳細は<a href="https://www.coordiy.com/owner/contents/{!!$content->id!!}/date/yoyaku">こちら</a>からいつでもご確認できます。<br />
受付の際は、ご予約者様のスマフォなどの端末から予約IDを確認ください。<br />
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
何卒よろしくお願い申し上げます。
</p>

@stop
