@extends('emails/layouts/default')

@section('title') @stop

@section('content')

<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>{!! $company->name !!} 様</strong>
<br />
<strong>Coordiy予約でございます。</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
ネット決済リクエストをいただき誠にありがとうございます。<br />
ネット決済処理が完了しましたのでご連絡いたします。
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
今後は予約受付登録時の「支払い方法」のリストに「ネット決済」が加わります。<br />
既存の予約受付も「ネット決済」に変更が可能となっています。
</p>

<p>
それでは、引き続きなCoordiy予約のをご利用ください。<br />
何卒よろしくお願いお願い申し上げます。
</p>
@stop



