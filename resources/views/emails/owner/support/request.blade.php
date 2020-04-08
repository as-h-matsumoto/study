@extends('emails/layouts/default')
@section('title') @stop
@section('content')

<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>{!! $company->name !!} 様</strong>
<br />
<strong>Coordiy予約でございます。</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
サポートのご検討をいただき誠にありがとうございます。<br />
専門スタッフよりご連絡させていただきますので少々お待ちください。
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:16px;line-height:1.5em;">
<strong>メディア制作サポート</strong>
@foreach($support_spot as $key=>$spot)
<br />
{!!$spot['name']!!} : <span>@if($spot['price']){!!'&yen;' .number_format($spot['price'])!!}@else{!!'無料'!!}@endif</span>@if($spot['ex'])<span>/１件</span>@endif
@endforeach
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:16px;line-height:1.5em;">
<strong>運用サポート</strong>
<br />
<span>ブロンズ: 無料</span>
<br />
<span>シルバー: &yen;1,280</span>
<br />
<span>ゴールド: &yen;4,980</span>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
2営業日以内にはご連絡させていただきますので少々おまちください。<br />
何卒よろしくお願い申し上げます。
</p>

@stop