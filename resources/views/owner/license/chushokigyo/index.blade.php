@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') コンテンツ管理 @parent
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

    @if( empty($contents) and empty($contents_recruit) )
        <div class="card mt-2">
            <div class="card-body center">
                <p class="h4 text-blue-grey-500">
                    コンテンツはありません。
                </p>
            </div>
        </div>
    @endif
    
    <div id="searchContents" class="page-content row py-2 px-6">

        @include('include/search_contents')

    </div>

    <div class="page-content-footer">
        <p class="right" id="pageMore">
            @if( !empty($contents) and $contents->hasMorePages() )
            <button class="btn btn-outline-info" onclick="loading();ajaxPaginationMore('{!!$contents->nextPageUrl()!!}');return false;" >
                <strong>もっと</strong>
            </button>
            @endif
        </p>
    </div>
    @include('owner/include/footer')
    @include('include/footer')

</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')
@stop
