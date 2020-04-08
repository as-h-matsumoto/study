@extends('account/layouts/default')

{{-- Page title --}}
@section('title') 学習メモ @parent
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

        @if($recommends->total()===0)
        <div class="card py-20">
            <div class="card-body center">
                <p class="h4 text-blue-grey-500">
                    学習メモはありません。<br />
                    記憶しなきゃいけないことや、疑問に思ったことをどんどんメモしましょう。<br />
                    メモすると、常に右メニューからすぐにチェックできるので自然と記憶できます。
                </p>
            </div>
        </div>
        @endif

        @if($recommends->total())
        <div id="searchRecommends" class="page-content row p-4 center">

            @include('include/recommend_more')

        </div>
        <div class="page-content-footer">
            <p class="center">
            @if( $recommends->total() and $recommends->hasMorePages() )
            <span id="pageMore">
                <button class="btn btn-outline-info" onclick="loading();ajaxPaginationMoreRecommend('{!!$recommends->nextPageUrl()!!}');return false;" >
                <strong>もっと</strong>
                </button>
            </span>
            @endif
            </p>
        </div>
        @endif

        @include('account/include/footer')
        @include('include/footer')

        </div>

    </div>

</div>

@stop

{{-- footer scripts --}}
@section('footer_scripts')

@stop
