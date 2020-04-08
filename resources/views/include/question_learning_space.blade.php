<div class="card pt-4">
  <div class="card-block-me">
    <div class="pb-4">
      <p class="font-area center">
        <span><strong>【学習スペース】</strong></span>
      </p>
    </div>

    <div class="row mb-4">

      <div class="card col-sm-12 center">
        <div class="card-title">
          <a href="javascript:void(0)" onClick="stepModal()" class="f14 pr-10">
            <i class="icon icon-wikipedia text-black-500 s-6" title="ＷＩＫＩ連携" alt="ＷＩＫＩ連携"></i> ＷＩＫＩ連携
          </a>
          @if($license_question->favo)
          <span id="favorite-license_question-{!!$license_question->id!!}" class="f14">
            <a href="javascript:void(0)" onClick="loading(); favorite_rich('license_question', {!!$license_question->id!!}, 'delete')">
              <i class="icon icon-content-save-all s-6 text-red-600" title="補習リスト解除" alt="補習リスト解除"></i> 補習リスト解除
            </a>
          </span>
          @else
          <span id="favorite-license_question-{!!$license_question->id!!}" class="f14">
            <a href="javascript:void(0)" onClick="loading(); favorite_rich('license_question', {!!$license_question->id!!}, 'add')">
              <i class="icon icon-content-save-all s-6 text-yellow-600" title="補習リスト追加" alt="補習リスト追加"></i> 補習リスト追加
            </a>
          </span>
          @endif
        </div>
        <div class="card-body">
          <p id="putLearningArea" class="font-area">
          @if($learnings)
          @foreach($learnings as $learning)
          <button id="learning{!!$learning->id!!}" class="btn btn-outline-info">
            <a class="pr-2" target="_blank" href="https://ja.wikipedia.org/?curid={{$learning->pageid}}">{!!$learning->name!!}</a>
            <a href="javascript:void(0)" onClick="deleteQuestionLearning({!!$learning->id!!})" ><i class="icon icon-trash text-gray-500 s-4"></i></a>
          </button>
          @endforeach
          @else
          参考資料が登録されていません。
          @endif
          </p>
        </div>
      </div>
  
      <div class="card col-sm-12">
        <div class="card-title center">
          <button onClick="recommendExists('license_question', {!!$license_question->id!!}, 1)" class="btn btn-outline-info">
              学習メモ追加
          </button>
        </div>
        <div class="card-body row center" id="searchRecommends">
          @include('include/recommend_more')
        </div>
        <div class="card-body">
          <p class="center">
            
            @if( $recommends->hasMorePages() and !empty($recommends) )
            <span id="pageMore">
            <button class="btn btn-outline-info" onclick="loading();ajaxPaginationMoreRecommend('{!!$recommends->nextPageUrl()!!}');return false;" >
                <strong>もっと</strong>
            </button>
            </span>
            @endif
          </p>
        </div>
      </div>

    </div>
  </div>
</div>