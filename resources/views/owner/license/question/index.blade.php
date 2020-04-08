@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 問題 @parent
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

    @if( empty($license_questions) )
        <div class="card">
            <div class="card-body center">
                <p class="h4 text-blue-grey-500">
                    コンテンツはありません。
                </p>
            </div>
        </div>
    @endif
    
    <div id="searchContents" class="page-content row p-2">
        @include('include/search_license_questions')
    </div>

    <div class="page-content-footer">
        <p class="right" id="pageMore">
            @if( !empty($license_questions) and $license_questions->hasMorePages() )
            <?php $param = strstr($_SERVER["REQUEST_URI"], '?'); ?>
            <button class="btn btn-outline-info" onclick="loading();ajaxPaginationMore('{!!$license_questions->nextPageUrl().substr_replace($param, '&', 0, 1)!!}'); return false;" >
                <strong>もっと</strong>
            </button>
            @endif
        </p>
    </div>
    @include('owner/include/footer')
    @include('include/footer')

    </div>
</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')
@stop
