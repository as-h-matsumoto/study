@extends('SenMonTen/layouts/default')

{{-- Page title --}}
@section('title') オーナー登録 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
<script src='https://www.google.com/recaptcha/api.js'></script>
@stop

{{-- content --}}
@section('content')
<div id="register-v2" class="row no-gutters">

    <div class="intro col-12 col-md">

        <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-left py-16 py-md-32 px-12">

            <div class="title center pt-10">
                <img src="/storage/assets/img/senmonten_logo_400.png" width="300" />
            </div>

            <div class="description center text-fuse-dark-800 mb-10">
                <br />
                <br />
                <p class="h5"><strong>
                    Coordiy予約にオーナー登録をすると、店舗の予約管理とコンテンツ拡充ができるようになり、注目度が格段にアップします。
                </strong></p>
                <br />
                <p class="h5"><strong>
                    料金は月額税込み<span class="px-2 text-red-800">５００円</span>（1店舗）です。
                </strong></p>
                <br />
                <p class="h5"><strong>
                    最初は<span class="px-2 text-red-800">６０日間無料</span>でお試しいただけます。<br />
                    格段にアップするアクセス数を是非、ご体験ください。
                </strong></p>

                <br />
                <br />
                <br />

                <p class="h5"><strong>
                    予約管理の詳細はこちら
                </strong></p>
                <p>
                    <a href="/yoyaku" title="Coordiy予約" alt="Coordiy予約">
                        <img src="/storage/global/img/advertisement/ad_coordiy_yoyaku_400.png" alt="Coordiy予約" style="max-width:200px;" />
                    </a>
                </p>

            </div>

            <div class="description row center">
                <div class="col-12 mt-10">
                    <p class="h5"><strong>
                        店舗サンプルはこちら
                    </strong></p>
                </div>
                @include('SenMonTen/include/search_contents_index_register')
            </div>

        </div>
    </div>

    <div class="form-wrapper col-12 col-md-auto d-flex justify-content-center p-4 p-md-0 center">

        <div class="form-content md-elevation-8 h-100 bg-white text-auto py-16 py-md-32 px-12">

            @if(Session::has('message'))
                <div class="alert alert-info">{{Session::get('message')}}</div>
            @endif

            <div class="h5 mt-8"><i class="icon icon-account-settings-variant text-red-500"></i><strong class="f16">オーナー登録</strong></strong></div>

            <form name="registerForm" novalidate class="mt-8" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                <input type="hidden" name="owner" value="1" />
                <input type="hidden" name="service" value="{!!$GLOBALS['yoyaku_type_id']!!}" />

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                <div class="form-group mb-4">
                    <input type="text" name="name" class="form-control" id="registerFormInputName" aria-describedby="nameHelp" value="{{ old('name') }}" required />
                    <label for="registerFormInputName"><strong class="f16">お名前</strong></label>
                    @if ($errors->has('name'))
                        <span class="help-block has-error">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <input type="email" name="email" class="form-control" id="registerFormInputEmail" aria-describedby="emailHelp" value="{{ old('email') }}" required/>
                    <label for="registerFormInputEmail"><strong class="f16">Eメールアドレス</strong></label>
                    @if ($errors->has('email'))
                        <span class="help-block has-error">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <input type="password" name="password" class="form-control" id="registerFormInputPassword" name="password" />
                    <label for="registerFormInputPassword"><strong class="f16">パスワード</strong></label>
                    @if ($errors->has('password'))
                        <span class="help-block has-error">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <input type="password" name="password_confirmation" class="form-control" id="registerFormInputPasswordConfirm" name="password_confirmation" required/>
                    <label for="registerFormInputPasswordConfirm"><strong class="f16">パスワード (確認)</label>
                </div>

                <div class="form-group mb-4">
                    <label for="company_code"><i class="icon icon-star text-red-700"></i> 法人区分</strong></label>
                    {!! Form::select('company_code', $company_code, $company['company_code'],['class' => 'form-control form-control-lg', 'id' => 'company_code']) !!}
                    @if ($errors->has('company_code'))
                        <span class="help-block has-error">
                            <strong>{{ $errors->first('company_code') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <label for="registerFormInputName"><i class="icon icon-star text-red-700"></i> <strong class="f16">会社名や屋号</strong></label>
                    <input type="text" name="company_name" class="form-control" id="registerFormInputName" aria-describedby="nameHelp" value="{!! old('company_name',$company['name']) !!}" required />
                    @if ($errors->has('company_name'))
                        <span class="help-block has-error">
                            <strong>{{ $errors->first('company_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group mb-4">
                  <label><i class="icon icon-star text-red-700"></i> <strong class="f16">所在地</strong></label>
                  @if($errors->has('country-area'))<span class="help-block has-error">{{ $errors->first('country-area') }}</span>@endif
                  <select onChange="countryAreaChangeFunc()" id="country-area" name="country-area" class="form-control form-control-lg"></select>
                  @if($errors->has('country-area-address-one'))<span class="help-block has-error">{{ $errors->first('country-area-address-one') }}</span>@endif
                  <select onChange="countryAreaAddressOneChangeFunc()" id="country-area-address-one" name="country-area-address-one" class="form-control form-control-lg"></select>
                  @if($errors->has('country-area-address-two'))<span class="help-block has-error">{{ $errors->first('country-area-address-two') }}</span>@endif
                  <select id="country-area-address-two" name="country-area-address-two" class="form-control form-control-lg"></select>
                  <label> 上記以外の住所を入力してください。</label>
                  @if($errors->has('country-area-address-other'))<span class="help-block has-error">{{ $errors->first('country-area-address-other') }}</span>@endif
                  <input class="form-control form-control-lg" name="country-area-address-other" type="text" value="{!! Input::old('country-area-address-other',$company->country_area_address_other) !!}" >
                </div>

                <div class="form-group mb-4">
                    <label for="homepage"><i class="icon icon-star text-red-700"></i> <strong class="f16">ホームページ(例：http://aaa.com)</strong></label>
                    <input type="text" name="homepage" class="form-control" id="homepage" aria-describedby="nameHelp" value="{!! old('homepage',$company['homepage']) !!}" required />
                    @if ($errors->has('homepage'))
                        <span class="help-block has-error">
                            <strong>{{ $errors->first('homepage') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <label for="tell"><i class="icon icon-star text-red-700"></i> <strong class="f16">代表電話番号(例：03-1234-5678)</strong></label>
                    <input type="text" name="tell" class="form-control" id="tell" aria-describedby="nameHelp" value="{!! old('tell',$company['tell']) !!}" required />
                    @if ($errors->has('tell'))
                        <span class="help-block has-error">
                            <strong>{{ $errors->first('tell') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="terms-conditions row align-items-center justify-content-center pt-4 mb-8">
                    <div class="form-check mr-1 mb-1">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" aria-label="Remember Me" name="ok-terms" required/>
                            <span class="checkbox-icon"></span>
                            <span>私はこの利用規約に同意します。</span>
                        </label>
                        @if ($errors->has('ok-terms'))
                        <span class="help-block has-error">
                            <strong>{{ $errors->first('ok-terms') }}</strong>
                        </span>
                    @endif
                    </div>
                    <a href="/cmn/terms" class="text-secondary mb-1" target="_blank">利用規約</a>
                </div>

                <div class="g-recaptcha" data-sitekey="{{env('RECAPTCHA_API_KRY')}}" data-callback="recaptchaCallback"></div>


                <button type="submit" class="submit-button btn btn-outline-info btn-block" aria-label="LOG IN">
                    オーナー登録
                </button>

            </form>

            <div
                class="login d-flex flex-column flex-sm-row align-items-center justify-content-center mt-8 mb-6 mx-auto">
                <span class="text mr-sm-2">オーナー登録はお済ですか？</span>
                <a class="link text-secondary" href="/owner">オーナートップページへ</a>
            </div>

        </div>
    </div>
</div>

@stop

{{-- footer scripts --}}
@section('footer_scripts')

@include('owner/include/company_js')
@include('owner/include/company_country_js')

<script> function recaptchaCallback(param) { if(param) { document.getElementById('submit').disabled = ""; } } </script>

@stop

