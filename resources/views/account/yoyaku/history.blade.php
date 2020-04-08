@extends('account/layouts/default')

{{-- Page title --}}
@section('title') ご予約履歴 @parent
@stop


@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')

<div id="project-dashboard" class="page-layout simple">

    <div class="page-content-wrapper">

        <!-- HEADER -->
        @include('account/include/header')
        <!-- / HEADER -->

        @if(empty($contents))
        <div class="card mt-2">
            <div class="card-body center">
                <p class="h4 text-blue-grey-500">
                    ご予約履歴はありません。
                </p>
            </div>
        </div>
        @endif

        <!-- CONTENT -->
        <div id="searchContents" class="page-content row py-2 px-6">

            @include('account/include/search_contents_yoyaku_history')
    
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

        @include('account/include/footer')
        @include('include/footer')

    </div>

</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')


@stop
