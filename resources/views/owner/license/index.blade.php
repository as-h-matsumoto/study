@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 資格 @parent
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

    @if( empty($license) )
        <div class="card mt-2">
            <div class="card-body center">
                <p class="h4 text-blue-grey-500">
                    登録されいている資格はありません。
                </p>
            </div>
        </div>
    @endif
    
    <div id="searchContents" class="page-content row">

        @include('include/search_licenses')

    </div>

    <div class="page-content-footer">
        <p class="right" id="pageMore">
            @if( !empty($licenses) and $licenses->hasMorePages() )
            <button class="btn btn-outline-info" onclick="loading();ajaxPaginationMore('{!!$licenses->nextPageUrl()!!}');return false;" >
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
