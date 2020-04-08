@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 資格選択 @parent
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

    @if( empty($licenses) )
        <div class="card">
            <div class="card-body center">
                <p class="h4 text-blue-grey-500">
                    登録されている資格はありません。
                </p>
            </div>
        </div>
    @endif
    
    <div id="searchLicenses" class="page-content">

        @foreach($licenses as $license)
        <div class="card">
            <div class="card-body">
            
            <a href="/owner/license/{{$license->id}}/question">
            <p class="center f24"><strong>
                    {{$license->name}}
            </strong></p>
            </a>
            <br />
            <br />
            <p>
                {{$license->about}}
            </p>
            
            </div>
        </div>
        @endforeach

    </div>

    <div class="page-content-footer">
        <p class="right" id="pageMore">
            @if( !empty($contents) and $licenses->hasMorePages() )
            <button class="btn btn-outline-info" onclick="loading();ajaxPaginationMore('{!!$contents->nextPageUrl()!!}');return false;" >
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
