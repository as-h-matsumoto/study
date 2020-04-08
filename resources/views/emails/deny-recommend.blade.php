@extends('emails/layouts/default')

@section('title') @stop

@section('content')
<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>{!! $user['name'] !!} 様</strong>
<br />
<strong>Coordiy予約でございます。</strong>
</p>


<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
{!! $user['name'] !!} さんの「{!!$recoItem['name']!!}」へ投稿いただいた感想の修正のお願いです。
<br />
以下のポイントを抑えているかご確認ください。
<br />
<ul>
 <li>感想を書いた対象についてコメントしているか。</li>
 <li>感想を書いた対象の写真をアップしているか。</li>
</ul>
<br />

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
感想の修正は<a href="https://account.coordiy.com/recommends">こちら</a>から行えます。<br />
よろしくお願い申し上げます。
</p>
@stop

