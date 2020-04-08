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

    @include('owner/license/question/include/header')

    @include('owner/license/question/contents/include/header')

    @if( empty($license_question_contents) )
        <div class="card">
            <div class="card-body center">
                <p class="h4 text-blue-grey-500">
                    コンテンツはありません。
                </p>
            </div>
        </div>
    @endif
    
    <div id="searchContents" class="page-content row">

        @include('include/search_license_question_contents')

    </div>

    <div class="page-content-footer">
        <p class="right" id="pageMore">
            @if( !empty($license_question_contents) and $license_question_contents->hasMorePages() )
            <button class="btn btn-outline-info" onclick="loading();ajaxPaginationMore('{!!$license_question_contents->nextPageUrl()!!}');return false;" >
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
