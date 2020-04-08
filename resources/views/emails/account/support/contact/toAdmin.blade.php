@extends('emails/layouts/default')

@section('title') @stop

@section('content')
<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>{!! $to_user->name !!} さん</strong>
<br />
<strong>資格問題ＣＯＯＤです。</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
{!!$auth_user->name!!}さんからお問合せが届いております。
<br />
==============<br />
{!! nl2br($words->message) !!}<br />
==============<br />
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
メッセージは<a href="/account/messages">こちら</a>からいつでもご確認できます。<br />
何卒よろしくお願い申し上げます。
</p>
@stop
