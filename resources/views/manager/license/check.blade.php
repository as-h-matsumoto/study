@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') 資格学習の解答や配点のチェック @parent
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

        @include('manager/include/header')

        <div class="page-content">

        @if($license_question->total()===0)
        <div class="card py-20">
            <div class="card-body center">
                <p class="h4 text-blue-grey-500">
                    チェックする問題がありません。
                </p>
            </div>
        </div>
        @endif

        @if($license_question->total())
        <table class="a">
        <thead>
         <tr>
          <th>試験名</th><th>年度+フェーズ</th><th>科目+問題</th><th>設問と解答</th>
         </tr>
        <thead>
        <tbody id="searchContents">
            @include('manager/include/license_check')
        </tbody>
        </table>
        @endif
        
        <div class="page-content-footer">
            <p class="center">
            @if( $license_question->total() and $license_question->hasMorePages() )
            <span id="pageMore">
                <button class="btn btn-outline-info" onclick="loading();ajaxPaginationMore('{!!$license_question->nextPageUrl()!!}');return false;" >
                <strong>もっと</strong>
                </button>
            </span>
            @endif
            </p>
        </div>

        @include('manager/include/footer')
        @include('include/footer')

        </div>

    </div>

</div>

@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script>

function changePoints(content_id) {

  var points = $('#contentPoint'+content_id).val();

  axios.post('/manager/license/change/contents/points', {
    content_id: content_id,
    points: points
  })
  .then(function (response) {
    if(!ajaxCheckPublic(response.data)){return;}
    $('#loading').hide();
    infoNotify('更新しました');
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });
};

</script>
@stop
