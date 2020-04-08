@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') 距離チェック @parent
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

    <div class="page-content p-4 bg-white-500 " style="overflow-y:scroll;">

        <div class="card">
            <div class="card-body">
            ok
            </div>
        </div>

    </div>
</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')
@stop
