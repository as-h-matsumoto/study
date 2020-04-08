@extends('emails/layouts/default')
@section('title') @stop
@section('content')

<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>管理者 様</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
ワンクリック登録イベントにお申込がありましたのでご対応お願いいたします。
<br />
ワンクリック登録のお申込内容は以下のとおりです。
Email: {!!$event->email!!}<br />
Url: {!!$event->url!!}
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
先行順で登録を進めていると伝えています。<br />
何卒よろしくお願い申し上げます。
</p>

@stop