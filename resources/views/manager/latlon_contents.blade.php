@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') コンテンツの緯度経度登録 @parent
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

    <div class="page-content row">
        <div class="card col-12">
            <div class="card-body p-10">

                <p class="h3 center">コンテンツの緯度経度登録</p>

                <p class="h4 center"><a class=" text-blue-500" href="/manager/latlon/function">処理実行</a></p>
            </div>
        </div>
    </div>

</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script>


</script>
@stop
