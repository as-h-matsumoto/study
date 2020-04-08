@extends('account/layouts/default')

{{-- Page title --}}
@section('title') 資格学習 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')

@include('include/question_css')

@stop

{{-- content --}}
@section('content')

<div id="profile" class="page-layout simple right-sidebar">

  <div class="page-content-wrapper">

  @include('license/include/header')
    
  <div class="page-content">

    <div class="card mt-2">
        <div class="card-body center">
            <p>
                学習する資格を選択してください。
            </p>
        </div>
    </div>

    <!-- CONTENT -->
    <div id="searchContents" class="page-content row">

        @include('license/include/search_license')
    
    </div>
    
    <div class="page-content-footer">
        <p class="right" id="pageMore">
            @if( !empty($licenses) and $licenses->hasMorePages() )
            <?php exit; ?>
            <button class="btn btn-outline-info" onclick="loading();ajaxPaginationMore('{!!$licenses->nextPageUrl()!!}');return false;" >
                <strong>もっと</strong>
            </button>
            @endif
        </p>
    </div>


    @include('include/footer')

  </div>

  </div>

</div>

@stop

{{-- footer scripts --}}
@section('footer_scripts')
@stop
