@extends('emails/layouts/default')

@section('title') @stop

@section('content')
<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>{!!$event['name']!!}様</strong>
<br />
<strong>COORDでございます。</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
質問箱へのご質問を以下の通りうけたまわりました。
<br />
<br />
お名前: {!!$event['name']!!}<br />
Eメール: {!!$event['email']!!}<br />
電話: {!!$event['phone']!!}<br />
ご質問: {!!$event['comment']!!}
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
先行順で登録を進めてまいりますので今しばらくお待ちください。<br />
何卒よろしくお願い申し上げます。
</p>
@stop