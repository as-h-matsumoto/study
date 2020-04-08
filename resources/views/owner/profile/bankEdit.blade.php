@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 会社口座編集 @parent
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
    
        <div class="page-content p-2 mb-2">
        <div class="card">
        <div class="card-body">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'name' => 'action', 'method' => 'post', 'class' => ' row', 'files'=> false)) !!}

    <div class="form-group col-sm-6">
        <label for="bank_id"><i class="icon icon-star text-red-700"></i> 銀行</label>
        {!! Form::select('bank_id', $bank, $user_bank->bank_id, ['class' => 'form-control form-control-lg mt-4', 'id' => 'bank_id', 'name' => 'bank_id'] ) !!}
        @if ($errors->has('bank_id'))
        <span class="help-block has-error">
            <strong>{{ $errors->first('bank_id') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group col-sm-6">
        <label for="shop_number"><i class="icon icon-star text-red-700"></i> 支店番号</label>
        <input class="form-control form-control-lg" type="text" name="shop_number" value="{!! Input::old('shop_number',$user_bank->shop_number) !!}">
        @if ($errors->has('shop_number'))
        <span class="help-block has-error">
            <strong>{{ $errors->first('shop_number') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group col-sm-6">
        <input class="form-control form-control-lg" type="text" name="main_number" value="{!! Input::old('main_number',$user_bank->main_number) !!}">
        <label class="pl-5" for="main_number"><i class="icon icon-star text-red-700"></i> 口座番号</label>
        @if ($errors->has('main_number'))
        <span class="help-block has-error">
            <strong>{{ $errors->first('main_number') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group col-sm-6">
        <input class="form-control form-control-lg" type="text" name="meigi" value="{!! Input::old('meigi',$user_bank->meigi) !!}">
        <label class="pl-5" for="meigi"><i class="icon icon-star text-red-700"></i> 口座名義（例：株式会社a 代表 山田太朗)</label>
        @if ($errors->has('meigi'))
        <span class="help-block has-error">
            <strong>{{ $errors->first('meigi') }}</strong>
        </span>
        @endif
    </div>

</form>

        </div>
        </div>
        </div>

        <div class="page-content-footer">
            <p class="right">
                <button class="btn btn-outline-info" onclick="loading();document.action.submit();return false;" >
                    <strong>登録</strong>
                </button>
            </p>
        </div>

        @include('owner/include/footer')
        @include('include/footer')

    </div>
</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')

@include('owner/include/company_js')
@include('owner/include/company_country_js')

@stop
