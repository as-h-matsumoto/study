@extends('emails/layouts/default')

@section('title') @stop

@section('content')
<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>{!! $user->name !!} 様</strong>
<br />
<strong>Coordiy予約でございます。</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
オーナーリクエストをいただき誠にありがとうございます。<br />
オーナー登録が完了しましたのでご連絡いたします。
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
<a href="https://www.coordiy.com/owner/">こちら</a>のページから予約管理ができます。<br />
・コンテンツ作成<br />
・所在地／目的地登録<br />
・設備・スペース登録<br />
・メニュー登録<br />
・予約受付登録<br />
<br />
ほとんどの場合、この順番でスムーズに登録が進んで行きます。
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
また、以下の一般オーナーアカウントも発行いたしました。<br />
・オーナー名： {!!$owner_public->name!!}<br />
・ログインID： {!!$owner_public->email!!}<br />
・ログインPW： {!!$password!!}
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
一般オーナーアカウントは、売上げデータの確認ができません。<br />
その他の予約状況確認やコンテンツ管理などのオーナー処理はすべてできるアカウントです。<br />
作業員様などにご利用いただければと思います。
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
それでは、パワフルでスマートなCoordiy予約をご利用ください。<br />
何卒よろしくお願いお願い申し上げます。
</p>
@stop



