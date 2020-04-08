@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') API管理 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="/css/app.css"/>
@stop

{{-- content --}}
@section('content')
<div id="" class="simple full-width">
    
    <div id="app" class="page-content bg-white-500 p-4">

        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>
        <passport-personal-access-tokens></passport-personal-access-tokens>

    </div>

</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script src="/js/app.js"></script>

@stop
