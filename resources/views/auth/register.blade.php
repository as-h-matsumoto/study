@extends('layouts/default')

{{-- Page title --}}
@section('title') アカウント登録 中小企業診断士 過去問受験 科目学習 @parent
@stop


@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="Coord アカウント登録ページです。">
<meta property="og:site_name" content="Coord">
<meta property="og:title" content="アカウント登録">
<meta property="og:description" content="Coord アカウント登録ページです。">
<meta property="og:image" content="/storage/assets/img/logo_new_1600.png">
<meta property="og:url" content="{!!$_SERVER['HTTP_HOST']!!}">
<meta property="og:locale" content="ja_JP">
<meta property="og:type" content="website">
@stop

{{-- page level styles --}}
@section('header_styles')

@stop

{{-- content --}}
@section('content')
<div id="register-v2" class="row no-gutters">

    @include('auth/include/left')

    <div class="form-wrapper col-12 col-md-auto d-flex justify-content-center p-4 p-md-0">

        <div class="form-content md-elevation-8 h-100 bg-white text-auto py-16 py-md-32 px-12">



            <div class="h5 mt-8"><i class="icon icon-face text-red-500"></i><strong>アカウント作成</strong></div>

@if(Session::has('message'))
    <div class="alert alert-info">{{Session::get('message')}}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <form name="registerForm" novalidate class="mt-8" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                <div class="form-group mb-4">
                    <label>お名前</label>
                    <input type="text" name="name" class="form-control" aria-describedby="nameHelp" value="{{ old('name') }}" required />
                    @if ($errors->has('name'))
                        <span class="help-block has-error">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <label>メールアドレス</label>
                    <input type="email" name="email" class="form-control" aria-describedby="emailHelp" value="{{ old('email') }}" required/>
                    @if ($errors->has('email'))
                        <span class="help-block has-error">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <label>パスワード</label>
                    <input type="password" name="password" class="form-control" name="password" />
                    @if ($errors->has('password'))
                        <span class="help-block has-error">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <label>パスワード (確認)</label>
                    <input type="password" name="password_confirmation" class="form-control" name="password_confirmation" required/>
                </div>

                <div class="terms-conditions row align-items-center justify-content-center pt-4 mb-8">
                    <div class="form-check mr-1 mb-1">
                        <label class="form-check-label">
                            <input style="margin-top:14px;" type="checkbox" class="" aria-label="Remember Me" name="ok-terms" required/>
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

                <button type="submit" id="submit" class="btn btn-block btn-outline-info">
                    アカウント作成
                </button>

            </form>

            <div
                class="login d-flex flex-column flex-sm-row align-items-center justify-content-center mt-8 mb-6 mx-auto">
                <span class="text mr-sm-2">アカウントをお持ちですか?</span>
                <a class="link text-info" href="/login">ログインページ</a>
            </div>

        </div>
    </div>
</div>

@stop

{{-- footer scripts --}}
@section('footer_scripts')

@stop

