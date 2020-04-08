@extends('layouts/default')

{{-- Page title --}}
@section('title') ログイン 中小企業診断士 過去問受験 科目学習 @parent
@stop


@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="Coordログインページです。">
<meta property="og:site_name" content="Coord">
<meta property="og:title" content="Coord">
<meta property="og:description" content="Coordログインページです。">
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

<div id="login-v2" class="row no-gutters">

    @include('auth/include/left')

    <div class="form-wrapper col-12 col-md-auto d-flex justify-content-center p-4 p-md-0 pb-10">

        <div class="form-content md-elevation-8 h-100 bg-white text-auto py-16 py-md-32 px-12">

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

            <div class="h5 mt-8"><i class="icon icon-login-variant text-red-500"></i><strong>ログイン</strong></div>

            <form name="loginForm" novalidate class="mt-8" method="POST" action="/login">
                {{ csrf_field() }}
                <input type="hidden" name="remember" value="1" />

                <div class="form-group mb-4{{ $errors->has('email') ? ' has-error' : '' }}">
                    
                    <label><strong>Email アドレス</strong></label>
                    <input type="email" name="email" class="form-control"  aria-describedby="emailHelp"   value="{{ old('email') }}" required />
                    
                    @if ($errors->has('email'))
                        <span class="help-block has-error">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group mb-4{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label><strong>パスワード</strong></label>
                    <input type="password" name="password" class="form-control" id="loginFormInputPassword" placeholder="Password" required />
                    @if ($errors->has('password'))
                        <span class="help-block has-error">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="center">
                <button type="submit" class="submit-button btn btn-outline-info btn-block" aria-label="LOG IN">
                    ログイン
                </button>
                </div>
            </form>

            <div class="separator">
                <span class="text">または、</span>
            </div>

            <div class="center p-4">
                <a href="{{ route('password.request') }}" class="forgot-password text-secondary mb-4">パスワード再発行</a>
            </div>
            <div class="center pb-10">
                <a class="link text-secondary" href="/register">アカウント登録</a>
            </div>

        </div>
    </div>
</div>



@stop

{{-- footer scripts --}}
@section('footer_scripts')

@stop