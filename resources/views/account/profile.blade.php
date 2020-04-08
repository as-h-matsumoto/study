@extends('account/layouts/default')

{{-- Page title --}}
@section('title') プロフィール @parent
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

        @include('account/include/header')
        <!-- / HEADER -->

        <!-- CONTENT -->
        <div class="page-content">

        <div class="card"
        style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_02.jpeg')">
        <div class="card-body p-0 bg-mask-hard">

<table class="table table-hover">
    <thead class="">
        <tr>
            <th class="text-info text-center" style="min-width:100px;"><strong>項目</strong></th>
            <th class="text-info text-center"><strong>内容</strong></th>
        </tr>
    </thead>


    <tbody>
        <tr>
            <th scope="row" class="text-info text-center">Eメール</th>
            <td class="text-center">{!!Auth::user()->email!!}</td>
        </tr>
        <tr>
            <th scope="row" class="text-info text-center">お名前</th>
            <td class="text-center">{!!Auth::user()->name!!}</td>
        </tr>
        <tr>
            <th scope="row" class="text-info text-center">イメージ</th>
            <td class="text-center">
                @if(Auth::user()->pic)
                  <img class="" src="{!!Util::getPic('user', null, Auth::user()->pic, Auth::user()->id, 400, null)!!}" height="160" />
                @endif
                @if(Auth::user()->back_pic)
                  <img class="" src="{!!Util::getPic('user', true, Auth::user()->back_pic, Auth::user()->id, 400, null)!!}"  height="160" />
                @endif
            </td>
        </tr>

    </tbody>
</table>
            </div>
            </div>
            <div class="page-content-footer">
                <p class="right">
                    <a href="/account/profile/edit" >
                        <button class="btn btn-outline-info"><strong>プロフィール編集</strong></button>
                    </a>
                </p>
            </div>

        


        <div class="card mt-2"
        style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_02.jpeg')">
        <div class="card-body p-0 bg-mask-hard">

<table class="table table-hover">
    <thead class="">
        <tr>
            <th colspan="2" class="text-info text-center" style="min-width:80px;"><strong>詳細プロフィール</strong></th>
        </tr>
        <tr>
            <th class="text-info text-center" style="min-width:100px;"><strong>項目</strong></th>
            <th class="text-info text-center"><strong>内容</strong></th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <th scope="row" class="text-info text-center">苗字</th>
            <td class="text-center">{!!$user_recruit->name_first!!}</td>
        </tr>
        <tr>
            <th scope="row" class="text-info text-center">名前</th>
            <td class="text-center">{!!$user_recruit->name_second!!}</td>
        </tr>
        <tr>
            <?php $personality = ($user_recruit->personality===1) ? '男性' : '女性' ; ?>
            <th scope="row" class="text-info text-center">性別</th>
            <td class="text-center">{!!$personality!!}</td>
        </tr>
        <tr>
            <?php $privite_status = ($user_recruit->privite_status===1) ? '未婚' : '既婚' ; ?>
            <th scope="row" class="text-info text-center">ステータス</th>
            <td class="text-center">{!!$user_recruit->privite_status!!}</td>
        </tr>
        <tr>
            <th scope="row" class="text-info text-center">住所</th>
            <td class="text-center">
                〒{!!Util::getCountryAreaName($user_recruit->postal_code)!!} 
                {!!Util::getCountryAreaName($user_recruit->country_area)!!} 
                {!!Util::getCountryAreaOneName($user_recruit->country_area_address_one)!!} 
                {!!Util::getCountryAreaTwoName($user_recruit->country_area_address_two)!!} 
                {!!$user_recruit->country_area_address_other!!}
            </td>
        </tr>
        <tr>
            <th scope="row" class="text-info text-center">生年月日</th>
            <td class="text-center">@if($user_recruit->dob)
                {!!date('Y年m月d日', strtotime($user_recruit->dob))!!} {!!Util::birthday($user_recruit->dob)!!}才
                @endif
            </td>
        </tr>
        <tr>
            <th scope="row" class="text-info text-center">sns</th>
            <td class="text-center">{!!$user_recruit->sns!!}</td>
        </tr>
        <tr>
            <th scope="row" class="text-info text-center">電話番号</th>
            <td class="text-center">{!!$user_recruit->tell!!}</td>
        </tr>
        <tr>
            <th scope="row" class="text-info text-center">学歴</th>
            <td class="text-center">{!!nl2br($user_recruit->career)!!}</td>
        </tr>
        <tr>
            <th scope="row" class="text-info text-center">職歴</th>
            <td class="text-center">{!!nl2br($user_recruit->experience)!!}</td>
        </tr>
        <tr>
            <th scope="row" class="text-info text-center">貢献できると考える能力</th>
            <td class="text-center">{!!nl2br($user_recruit->description)!!}</td>
        </tr>
        <tr>
            <th scope="row" class="text-info text-center">顔写真</th>
            <td class="text-center">
                @if($user_recruit->pic)
                  <img class="" src="{!!Util::getPic('user', null, $user_recruit->pic, $user_recruit->user_id, 400, null)!!}" height="160" />
                @endif
            </td>
        </tr>

    </tbody>
</table>
            </div>
            </div>

            <div class="page-content-footer">
                <p class="right">
                    <a href="/account/profile/recruit/edit" >
                        <button class="btn btn-outline-info"><strong>詳細プロフィール編集</strong></button>
                    </a>
                </p>
            </div>




        </div>

        
        @include('account/include/footer')
        @include('include/footer')

    </div>

</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')
@stop
