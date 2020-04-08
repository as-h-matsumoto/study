@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') コンテンツ名登録 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')
<div id="project-dashboard" class="page-layout simple full-width">

    @include('owner/include/header')
    
    <div class="page-content bg-white-500 p-4">

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
    
        <div class="form-group col-sm-12 mt-8">
            <input type="text" name="name" class="form-control form-control-lg" id="name" value="{!! old('name') !!}" />
            <label class="pl-4" for="name"><i class="icon icon-star text-red-700"></i> {!! UtilYoyaku::getNewMenuSenMonTen($service) !!}名</label>
            @if ($errors->has('name'))
            <span class="help-block has-error">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>

    </form>

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


@stop

{{-- footer scripts --}}
@section('footer_scripts')

@stop
