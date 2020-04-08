@extends('emails/layouts/default')

@section('title') @stop

@section('content')
<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>オーナー様</strong>
<br />
<strong>Coordiy予約でございます。</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
ワンクリック登録イベントにお申込いただき誠にありがとうございます。
<br />
<br />
ワンクリック登録のお申込内容は以下のとおりです。<br />
Email: {!!$event->email!!}<br />
Url: {!!$event->url!!}
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
先行順で登録を進めてまいりますので今しばらくお待ちください。<br />
何卒よろしくお願い申し上げます。
</p>
@stop