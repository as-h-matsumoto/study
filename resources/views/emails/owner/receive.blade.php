@extends('emails/layouts/default')

@section('title') @stop

@section('content')
<p>オーナーリクエストが着てます。</p>

<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>管理者様</strong>
<br />
<strong>オーナーリクエストが着てます。</strong>
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
<?php $a = DB::table('company_code')->select('name')->find($company->company_code); ?>
<span>法人区分：{!!$a->name!!} </span><br />
<span>法人名：{!! $company->name !!}</span><br />

<span>業種：
<?php $a = DB::table('company_type_first')->select('name')->find($company->company_type_first); ?>
{!! $a->name !!} , 
<?php $a = DB::table('company_type_second')->select('name')->find($company->company_type_second); ?>
{!! $a->name !!}
</span><br />
<span>所在地：
{!!Util::getCountryAreaName($company->country_area)!!} {!!Util::getCountryAreaOneName($company->country_area_address_one)!!} {!!Util::getCountryAreaTwoName($company->country_area_address_two)!!} {!!$company->country_area_address_other!!}
</span><br />
<span>ホームページ：{!! $company->url !!}</span><br />
<span>代表電話番号：{!! $company->tell !!}</span><br />
<span>代表Emailアドレス：{!! $company->email !!}</span><br />
<span>担当者名：****** </span><br />
<span>担当者Email：****** </span><br />
<span>担当者電話番号：****** </span><br />
</p>

<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
<a href="https://account.coordiy.com/manager/owner/request">yoyaku.site</a>
</p>
@stop



