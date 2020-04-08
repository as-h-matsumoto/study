@extends('emails/layouts/default')

@section('title') @stop

@section('content')

<p style="font-family:Roboto,sans-serif;color:#666666;font-size:20px;line-height:1.5em;">
<strong>{!! $company->name !!} 様</strong>
<br />
<strong>Coordiy予約でございます。</strong>
</p>


<p style="font-family:Roboto,sans-serif;color:#74787e;font-size:18px;line-height:1.5em;">
オーナーリクエストを以下のとおり承りました。
<br />
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
リクエスト内容を確認させていただきまして改めてご連絡させていただきます。
<br />
通常であれば２栄病日以内で登録が完了いたしますので少々お待ちください。
<br />
よろしくお願い申し上げます。
</p>

@stop



