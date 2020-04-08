@extends('emails/layouts/default')

@section('title') @stop

@section('content')

<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>管理者 様</strong>
<br />
<strong>Coordiy予約でございます。</strong>
</p>


<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
オーナー登録がありました。
<br />
<span>法人名：{!! $company->name !!}</span><br />
<span>email{!! $user->email !!}</span><br />
<span>所在地：
{!!Util::getCountryAreaName($company->country_area)!!} {!!Util::getCountryAreaOneName($company->country_area_address_one)!!} {!!Util::getCountryAreaTwoName($company->country_area_address_two)!!} {!!$company->country_area_address_other!!}
</span><br />
<span>ホームページ：{!! $company->url !!}</span><br />
<span>代表電話番号：{!! $company->tell !!}</span><br />
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
60日後からお金を請求しますので、管理してください。
<br />
よろしくお願い申し上げます。
</p>

@stop



