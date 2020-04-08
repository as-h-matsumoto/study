@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') コンテンツタイプ選択 @parent
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
    
    <div class="page-content p-2 mb-2">
    <div class="card">
    <div class="card-body">

        <div class="col-sm-12 my-4">
          <h4 class="text-center">作成するコンテンツタイプを選択してください。</h4>
        </div>

        <div class="bg-white-500 row p-4">
        @foreach(UtilYoyaku::getNewMenuSenMonTenKey(null) as $key=>$val)
        @if($owner_service->$val)
        <div class="col-sm center">
          <div class="ml-2 mr-2 mb-2">
          <a href="/owner/contents/create/second?service={{$key}}" style="text-decoration: none;" >
            <button type="button" class="btn" style="height:60px; width:200px;">
              {!! UtilYoyaku::getNewMenuSenMonTenIcon($key,null) !!} {!! UtilYoyaku::getNewMenuSenMonTen($key) !!}
            </button>
          </a>
          </div>
        </div>
        @endif
        @endforeach
        </div>

    </div>
    </div>
    </div>

    <div class="page-content-footer">
        <p class="right">
        </p>
    </div>

    @include('owner/include/footer')
    @include('include/footer')

</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')

@stop
