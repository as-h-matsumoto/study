@extends('emails/layouts/default')

@section('title') @stop

@section('content')
<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>{!! $user->name !!} 様</strong>
<br />
<strong>Coordiy予約でございます。</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
ネット決済費用のご検討をいただき誠にありがとうございます。<br />
担当の者からご連絡させていただきますので少々お待ちください。
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
その他、何かご不明な点がございましたらこのメールにご返信ください。<br />
何卒よろしくお願い申し上げます。
</p>
@stop