@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') チェックコンテンツ @parent
@stop


@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')
<div id="project-dashboard" class="page-layout simple full-width">

    @include('manager/include/header')

    <div class="page-content p-4 bg-white-500">

    <div class="card mb-2">
      <div class="card-body row" id="searchRecommends">
        @include('manager/include/recommend_more')
      </div>
      <div class="card-footer">
        @if( $recommends->hasMorePages() and !empty($recommends) )
        <span id="pageMore">
        <button class="btn btn-outline-info" onclick="loading();ajaxPaginationMoreRecommend('{!!$recommends->nextPageUrl()!!}');return false;" >
            <strong>もっと</strong>
        </button>
        </span>
        @endif
      </div>
    </div>

    </div>
</div>

<div class="modal fade" id="modelRecommendPics" tabindex="-1" role="dialog" aria-labelledby="modelRecommendPicsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelRecommendPicsLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modelRecommendPicsBody" class="modal-body row" >
            </div>
        </div>
    </div>
</div>

@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script>




function permitRecommend(recommend_id) {
  axios.post('/manager/recommends/check', {
    recommend_id: recommend_id
  })
  .then(function (response) {
    var result = response.data;
    if(!ajaxCheckPublic(result)){return;}
    $('#reco'+recommend_id).remove();
    $('#loading').hide();
    infoNotify('許可しました。');
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });
};

</script>
@stop
