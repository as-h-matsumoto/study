@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 会社口座 @parent
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
            <th class="text-info text-center" style="min-width:200px !important;"><strong>登録内容</strong></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">銀行</th>
            <td>@if($user_bank->bank_id){!!Util::getBankName($user_bank->bank_id)!!}@endif</td>
        </tr>
        <tr>
            <th scope="row">支店番号</th>
            <td>{!!$user_bank->shop_number!!}</td>
        </tr>
        <tr>
            <th scope="row">口座番号</th>
            <td>{!!$user_bank->main_number!!}</td>
        </tr>
        <tr>
            <th scope="row">口座名義</th>
            <td>{!!$user_bank->meigi!!}</td>
        </tr>
    </tbody>
</table>

        </div>
        </div>
        </div>


        <div class="page-content-footer">
            <p class="right">
                <a href="/owner/bank/edit" >
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
