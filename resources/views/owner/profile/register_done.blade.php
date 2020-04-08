@extends('layouts/default')

{{-- Page title --}}
@section('title') オーナーリクエスト受付完了 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')
<div id="register-v2" class="row no-gutters">

    <div class="intro col-12 col-md">

        <div
            class="d-flex flex-column align-items-center align-items-md-start text-center text-md-left py-16 py-md-32 px-12">

            <div class="logo bg-secondary my-8">
                <span>予</span>
            </div>

            <div class="title">
                Coordiy予約<br />
                オーナー登録
            </div>

            <div class="description">
            <p class="pt-12 f20">
                オーナー登録誠にありがとうございます。
            </p>
            </div>

        </div>
    </div>

    <div class="form-wrapper col-12 col-md-auto d-flex justify-content-center p-4 p-md-0">

        <div class="form-content md-elevation-8 h-100 bg-white text-auto py-16 py-md-32 px-12">

            <div class="title h4 mt-8">オーナーリクエスト受付完了</div>

            <div class="description mt-8">
              <p class="mb-4">オーナーリクエストを承りました。</p>
              <p class="mb-4">ご登録のEmailへお送りしておりますのでご確認ください。</p>
              <p class="mb-4">登録は数分で完了いたしますので少々お待ちください。</p>
              <p class="mb-4">ご登録内容に誤りがある場合はもう一度<a href="">オーナーリクエスト</a>をお願いします。</p>
            </div>

        </div>
    </div>
</div>

@stop

{{-- footer scripts --}}
@section('footer_scripts')

@stop

