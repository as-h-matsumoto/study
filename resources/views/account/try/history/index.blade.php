@extends('account/layouts/default')

{{-- Page title --}}
@section('title') 過去問受験履歴 @parent
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

        @if(count($license_question_try_masters)===0)
        <div class="card">
            <div class="card-body center">
                <p class="h5">
                    学習履歴はありません。
                </p>
            </div>
        </div>
        <div class="card">
            <div class="card-body center">
                <p class="h5">
                    問題にチャレンジするなら<a href="/account/try/history" class="pl-2 text-blue-600">こちら</a>
                </p>
                <p class="h5">
                    試験内容の学習は<a href="" class="pl-2 text-blue-600">こちら</a>
                </p>
            </div>
        </div>
        @endif

        <!-- CONTENT -->
        <div id="searchContents" class="page-content row">

            @include('include/search_try_history')
    
        </div>
        
        <div class="page-content-footer">
            <p class="right" id="pageMore">
                @if( !empty($license_question_try_masters) and $license_question_try_masters->hasMorePages() )
                <?php exit; ?>
                <button class="btn btn-outline-info" onclick="loading();ajaxPaginationMore('{!!$license_question_try_masters->nextPageUrl()!!}');return false;" >
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
