@extends('account/layouts/default')

{{-- Page title --}}
@section('title') お気に入り @parent
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

        @include('account/include/header')

        <div class="page-content">

        @if(count($license_questions)===0)
        <div class="card py-20">
            <div class="card-body center">
                <p class="h4 text-blue-grey-500">
                    補習リストはありません。
                </p>
            </div>
        </div>
        @endif

        @if(count($license_questions)!==0)
        <div id="searchContents" class="page-content row py-2 px-6">

            @include('include/search_license_questions')
    
        </div>
        @endif
    
        <div class="page-content-footer">
            <p class="right" id="pageMore">
                @if( !empty($license_questions) and $license_questions->hasMorePages() )
                <button class="btn btn-outline-info" onclick="loading();ajaxPaginationMore('{!!$license_questions->nextPageUrl()!!}');return false;" >
                    <strong>もっと</strong>
                </button>
                @endif
            </p>
        </div>

        @include('account/include/footer')
        @include('include/footer')

        </div>

    </div>

</div>

@stop

{{-- footer scripts --}}
@section('footer_scripts')


@stop
