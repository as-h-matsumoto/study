@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 会社情報 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')
<div id="profile" class="page-layout simple right-sidebar">

    <div class="page-content-wrapper">

        @include('owner/include/header')
    
        <div class="page-content center">
        <div class="card my-2"
        style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_02.jpeg')">
        <div class="card-body p-0 bg-mask-hard" style="max-width:400px; ">

<table class="table table-hover">
    <thead class="">
        <tr>
            <th class="text-info" style="min-width:100px !important;"><strong>項目</strong></th>
            <th class="text-info text-center"><strong>登録内容</strong></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">法人区分</th>
            <td>{!!Util::getCompanyCodeName($company->company_code)!!}</td>
        </tr>
        <tr>
            <th scope="row">法人名</th>
            <td>{!!$company->name!!}</td>
        </tr>
        <tr>
            <th scope="row">所在地</th>
            <td>{!!Util::getCountryAreaName($company->country_area)!!} {!!Util::getCountryAreaOneName($company->country_area_address_one)!!} {!!Util::getCountryAreaTwoName($company->country_area_address_two)!!} {!!$company->country_area_address_other!!}</td>
        </tr>
        <tr>
            <th scope="row">ホームページ</th>
            <td>{!!$company->homepage!!}</td>
        </tr>
        <tr>
            <th scope="row">代表電話番号</th>
            <td>{!!$company->tell!!}</td>
        </tr>
        <tr>
            <th scope="row">会社紹介</th>
            <td>{!!nl2br($company->description)!!}</td>
        </tr>
        <tr>
            <th scope="row">利用コンテンツ</th>
            <td>
            @foreach(UtilYoyaku::getNewMenuSenMonTenKey(null) as $key=>$val)
                @if($owner_services->$val)<span class="pr-2">{!! UtilYoyaku::getNewMenuSenMonTenIcon($key,'s-4') !!} {!! UtilYoyaku::getNewMenuSenMonTen($key) !!}  </span> @endif
            @endforeach
            </td>
        </tr>
        
        <tr>
            <th scope="row">イメージ</th>
            <td>
                @if($company->pic)
                  <img class="" src="{!!Util::getPic('company', null, $company->pic, Utilowner::getOwnerId(), 400, null)!!}" height="120" />
                @endif
                @if($company->back_pic)
                  <img class="" src="{!!Util::getPic('company', true, $company->back_pic, Utilowner::getOwnerId(), 400, null)!!}"  height="120" />
                @endif
            </td>
        </tr>

    </tbody>
</table>

        </div>
        </div>
        </div>


        <div class="page-content-footer">
            <p class="right">
                <a href="/owner/profile/edit" >
                    <button class="btn btn-outline-info"><strong>編集</strong></button>
                </a>
            </p>
        </div>

    @include('owner/include/footer')
        @include('include/footer')
    
    </div>
</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')
@stop
