@extends('emails/layouts/default')

@section('title') @stop

@section('content')

<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>{!! $user->name !!} さん</strong>
<br />
<strong>資格問題ＣＯＯＤです。</strong>
</p>


<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
学習メモを登録しました。<br /><br />
<br />
==============<br />
{!! nl2br($recommend) !!}<br />
==============<br />
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
学習メモは<a href="/account/recommend">こちら</a>からいつでもご確認できます。
</p>
@stop
