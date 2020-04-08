@extends('emails/layouts/default')

@section('title') @stop

@section('content')
<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>{!! $owner->name !!} 様</strong>
<br />
<strong>Coordiy予約でございます。</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
{!!$content->name!!}への求人エントリーを承りましたのでご連絡いたします。<br />
つきましては、求人エントリーID：を発行しましたのでご確認ください。<br />
求人エントリーIDはエントリー者を特定可能なIDです。誰にも見られないように大切に保管してください。<br />
<br />
--------------<br />
求人エントリーID：    {!!$content_date_user->yoyaku_id!!}<br />
--------------
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
エントリー内容を確認後、改めてご連絡させていただきます<br />
何卒よろしくお願い申し上げます。
</p>

@stop
