@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 会社カレンダー編集 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
<style>
.mycheckbox {
    border-radius:5px;

    border: solid 1px #efefef;

    background-color:#fff;
    white-space: nowrap;
    overflow:hidden;

    width:20px;
    height:20px;
}
</style>
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

              @include('owner/profile/include/public_calendar_formbody')

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

@include('owner/profile/include/openClose_js')

@stop
