@extends('emails/layouts/default')

@section('title')
<p></p>
@stop

@section('content')

<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>{!! $user['name'] !!} 様</strong>
<br />
<strong>Coordからのご連絡です。</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
{!! $user['name'] !!}さんの投稿が登録されました。</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
感想の修正は<a href="https://account.coordiy.com/recommends">こちら</a>から行えます。<br />
よろしくお願い申し上げます。
</p>
@stop

