@extends('emails/layouts/default')

@section('title') @stop

@section('content')

<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>{!! $owner->name !!} 様</strong>
<br />
<strong>Coordiy予約でございます。</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
{!!$user->name!!}様から {!!$content->name!!}への面接のご予約を承りましたのでご連絡いたします。<br />
<br />
--------------<br />
面接開始日時： {!!date('Y-m-d H:i', strtotime($content_date_user->start))!!}<br />
終了予定日時： {!!date('Y-m-d H:i', strtotime($content_date_user->end))!!}<br />
--------------
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
ご予約の詳細は<a href="https://www.coordiy.com/owner/contents/{!!$content->id!!}/date/yoyaku">こちら</a>からいつでもご確認できます。<br />
受付の際は、ご予約者様のスマフォなどの端末から予約IDを確認ください。<br />
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
何卒よろしくお願いいたします。
</p>

@stop
