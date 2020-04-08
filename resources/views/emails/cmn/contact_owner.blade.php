@extends('emails/layouts/default')

@section('title') @stop

@section('content')
<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>オーナー様</strong>
<br />
<strong>COORDでございます。</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
トップページからお問い合わせが来ております。
<br />
<br />
お名前: {!!$event['name']!!}<br />
Eメール: {!!$event['email']!!}<br />
電話: {!!$event['phone']!!}<br />
ご質問: {!!$event['comment']!!}
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
お早めにご対応ください。<br />
何卒よろしくお願い申し上げます。
</p>
@stop