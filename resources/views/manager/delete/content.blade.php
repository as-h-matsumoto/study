@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') チェックコンテンツ @parent
@stop


@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')
<div id="project-dashboard" class="page-layout simple full-width">

    @include('manager/include/header')

    <div class="page-content p-2 mb-2">
    <div class="card">
    <div class="card-body">

{!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'name' => 'action', 'method' => 'post', 'class' => ' row', 'files'=> false)) !!}

    <div class="form-group col-sm-6">
    　<label>content_service</label>
      <input class="form-control form-control-lg" id="service" name="service" type="number" value="" >
    </div>

    <div class="form-group col-sm-6">
      <label>content_id</label>
      <input class="form-control form-control-lg" id="id" name="id" type="number" value="" >
    </div>
    </form>

        

    </div>
    </div>
    </div>

    <div class="page-content-footer">
        <p class="right">
            <a href="javascript:void(0)" class="btn" onclick="loading();document.action.submit();return false;"  >
                <strong class="text-grey-800">削除</strong>
            </a>
        </p>
    </div>

</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')

@stop
