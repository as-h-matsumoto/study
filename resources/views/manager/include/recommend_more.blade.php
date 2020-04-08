
@forelse ($recommends as $recommend)



<div id="reco{{$recommend->id}}" class="col-sm card rcard ml-2 mb-2">
    <div class="card-block-me p-0 pt-1 row">
        <div class="col-3">
          <img class="avater center" src="{!!Util::getPic('user', null, $recommend->user_pic, $recommend->user_id, 400, false)!!}" title="{!!$recommend->user_name!!}" alt="{!!$recommend->user_name!!}" style="width:50px;height:40px;" >
        </div>
        <div class="col-9 center">
         <span class="text-success">{!!mb_strimwidth($recommend->user_name, 0, 22, "..")!!}</span><br />
         <span>{{ Util::convert_to_fuzzy_time($recommend->updated_at) }}</span> <span title="{!!$recommend->point!!}" alt="{!!$recommend->point!!}">{!!Util::recommend_star($recommend->point,16)!!}</span>
        </div>
        <div class="col-sm-12 pl-2 pt-2 border_top border_bottom center">
          <p>
          @if($recommend->recommend)
            <a tabindex="0" class="btn-header" role="button"
            data-toggle="popover"
            data-placement="top"
            data-trigger="focus"
            data-content="{!!$recommend->recommend!!}">
            {!!mb_strimwidth($recommend->recommend, 0, 38, '...')!!}
          </a>
          @else
          <span>ノーコメント</span>
          @endif
          </p>
          <!-- <p><a onClick="" >もっと</a></p> -->
        </div>
    </div>

    <div class="card-actions">
      @if($recommend->pic)
      <button class="action-btn action-btn-footer " title="投稿写真" onClick="loading(); moreRecommendPics({!!$recommend->id!!},{!!$recommend->user_id!!},'{!!$recommend->user_name!!}')" ><small>投稿写真</small><i class="icon-picture text-purple-700 s-4"></i></button>
      @endif
      <button class="action-btn action-btn-footer" title="いいね" onClick="loading(); niceBad('recommends', {!!$recommend->id!!}, 'good', 'Recommend')" ><small id="niceRecommendgood{!!$recommend->id!!}">{!!$recommend->good_number!!}</small><i class="icon-thumb-up-outline text-green-700 s-4"></i></button>
      <button class="action-btn action-btn-footer" title="う～ん" onClick="loading(); niceBad('recommends', {!!$recommend->id!!}, 'bad', 'Recommend')"><small id="niceRecommendbad{!!$recommend->id!!}">{!!$recommend->bad_number!!}</small><i class="icon-thumb-down-outline text-primary-200 s-4"></i></button>
      <button class="action-btn action-btn-footer" title="許可" onClick="loading(); permitRecommend({!!$recommend->id!!})"><small>許可</small></button>
    </div>
      


</div>
@empty
<div class="col-sm-12">
  <p class="p20">
    <span>
      まだ感想がありません。
      <br />
      感想を投稿すると200ポイントをプレゼント！
    </span>
  </p>
</div>
@endforelse

@if( $recommends->hasMorePages() and !empty($recommends) and $recommends->currentPage()>1 )
<script>
$(document).ready(function () {

var insert = '';
insert += '<button class="btn btn-outline-info" ';
insert += ' onclick="loading();';
insert += ' ajaxPaginationMoreRecommend(\'';
insert += ' {!!$recommends->nextPageUrl()!!}';
insert += '\');return false;" >';
insert += '<strong>もっと</strong>';
insert += '</button>';

document.getElementById('pageMore').innerHTML = insert;

});
</script>
@elseif(!$recommends->hasMorePages() and $recommends->currentPage()>1)

<script>
$('#pageMore').html('<span>-</span>');
</script>

@endif