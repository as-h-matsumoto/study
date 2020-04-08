@extends('emails/layouts/default')

@section('title') @stop

@section('content')

<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>{!! $user->name !!} 様</strong>
<br />
<strong>Coordiy予約でございます。</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
{!!$content->name!!}への求人エントリーについて、{!!$owner->name!!}様より以下の以下のメッセージが届いておりますのでご確認ください。
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
--------------<br />
ご連絡内容<br />
--------------<br />
{!! nl2br($email) !!}
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
何卒よろしくお願い申し上げます。
</p>

@stop
