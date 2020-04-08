@extends('layouts/default')

{{-- Page title --}}
@section('title') パスワードリセット 中小企業診断士 過去問受験 科目学習 @parent
@stop


@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="Coordパスワードリセットページです。">
<meta property="og:site_name" content="Coord">
<meta property="og:title" content="Coord">
<meta property="og:description" content="Coordパスワードリセットページです。">
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

    <div class="form-wrapper col-12 col-md-auto d-flex justify-content-center p-4 p-md-0">

        <div class="form-content md-elevation-8 h-100 bg-white text-auto py-16 py-md-32 px-12">

            <div class="h5 mt-8"><i class="icon icon-login-variant text-red-500"></i><strong>パスワードリセット</strong></div>

            <form name="loginForm" novalidate class="mt-8" method="POST" action="{{ route('password.update') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group mb-4{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label>メールアドレス</label>
                    <input type="email" name="email" class="form-control" aria-describedby="emailHelp" value="{{ $email ?? old('email') }}" required autofocus />
                    
                    @if ($errors->has('email'))
                        <span class="help-block has-error">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group mb-4{{ $errors->has('password') ? ' has-error' : '' }}">
                    
                    <label>新しいパスワード</label>
                    <input type="password" name="password" class="form-control" value="" required />
                    
                    @if ($errors->has('password'))
                        <span class="help-block has-error">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group mb-4{{ $errors->has('email') ? ' has-error' : '' }}">
                    
                    <label>パスワード確認</label>
                    <input type="password" name="password_confirmation" class="form-control" required />
                    
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block has-error">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="center">
                <button type="submit" class="submit-button btn btn-outline-info btn-block" aria-label="パスワードリセットリンク送信">
                    パスワードリセットリンク送信
                </button>
                </div>

            </form>

            <div class="separator">
                <span class="text">または、</span>
            </div>

            <div class="center">
                <a href="{{ route('login') }}" class="forgot-password text-secondary mb-4">ログイン</a>
            </div>
            <div class="center">
                <a class="link text-secondary" href="{{ route('register') }}">アカウント登録</a>
            </div>

        </div>
    </div>
</div>



@stop

{{-- footer scripts --}}
@section('footer_scripts')

@stop