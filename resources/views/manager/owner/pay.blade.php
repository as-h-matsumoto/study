@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') オーナーネット決済 @parent
@stop


@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')
<div id="project-dashboard" class="page-layout simple full-width">

    @include('manager/include/header')

    <div class="page-content p-4 bg-white-500 " style="overflow-y:scroll;">

    <div class="py-8">
        <p>ネット決済許可処理</p>
    </div>

{!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'name' => 'action', 'method' => 'post', 'class' => 'form-horizontal row-border', 'files'=> false)) !!}
<table class="table table-hover">
    <thead>
    <tr>
        <th>user</th>
        <th>法人名</th>
        <th>業種</th>
        <th>所在地</th>
        <th>ホームページ</th>
        <th>代表電話番号</th>
        <th>代表Emailアドレス</th>
        <th>担当者名</th>
        <th>担当者Email</th>
        <th>担当者電話番号</th>
        <th>ACTION</th>
    </tr>
    </thead>
    <tbody>

@foreach($companies as $user_id=>$val)
    <tr>
        <td>
            {!!$val['user']->id!!}<br />
            {!!$val['user']->name!!}<br />
            {!!$val['user']->email!!}
        </td>
      <td>{!! Util::getCompanyCodeName($val['company']->company_code) !!}　{!! $val['company']->name !!}</td>
      <td>{!! Util::getCompanyTypeFirstName($val['company']->company_type_first) !!}<br />
          {!! Util::getCompanyTypeSecondName($val['company']->company_type_second) !!}
      </td>
      <td>{!! Util::getCountryAreaName($val['company']->country_area) !!}<br />
          {!! Util::getCountryAreaOneName($val['company']->country_area_address_one) !!}<br />
          {!! Util::getCountryAreaTwoName($val['company']->country_area_address_two) !!}<br />
          {!! $val['company']->country_area_address_other !!}
      </td>
      <td><a class="text-blue-700" href="{!! $val['company']->homepage !!}">{!! $val['company']->homepage !!}</a></td>
      <td>{!! $val['company']->tell !!}</td>
      <td>{!! $val['company']->email !!}</td>
      <td>{!! $val['company']->in_charge_of_staff_name !!}</td>
      <td>{!! $val['company']->in_charge_of_staff_email !!}</td>
      <td>{!! $val['company']->in_charge_of_staff_tell !!}</td>
      <td>
        <SELECT name="companyRequest{!!$val['company']->id!!}">
            <OPTION value="255|{!!$val['company']->id!!}|{!!$val['company']->user_id!!}">--</OPTION>
            <OPTION value="0|{!!$val['company']->id!!}|{!!$val['company']->user_id!!}"> 非承認(mail)</OPTION>
            <OPTION value="1|{!!$val['company']->id!!}|{!!$val['company']->user_id!!}"> 承認(mail)</OPTION>
        </SELECT>
      </td>
    </tr>
  @endforeach

    </tbody>
</table>

<div class="right">
<button type="submit" class="submit-button btn btn-outline-info" aria-label="LOG IN">
    処理
</button>
</div>
</form>


    </div>
</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')
@stop
