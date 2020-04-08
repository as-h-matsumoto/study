@extends('emails/layouts/default')

@section('title') @stop

@section('content')
<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>{!! $company->name !!} 様</strong>
<br />
<strong>Coordiy予約でございます。</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
オーナーリクエストをいただき誠にありがとうございます。<br />
オーナーリクエストの内容を確認させていただきましたが、オーナー登録が難しい状況です。
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
ご登録いただいたホームページ内容をもう一度ご確認いただき改めてご登録いただければ幸いです。<br />
何卒よろしくお願いお願い申し上げます。
</p>
@stop



