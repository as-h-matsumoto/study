@forelse ($recommends as $recommend)
<div id="recoRight{{$recommend->id}}" class="list-group-item two-line">
    <div class="list-item-content">
        <h3><strong><a href="{!!$recommend->url!!}">{!!mb_strimwidth($recommend->title, 0, 36, "..")!!}</a></strong></h3>
        <span>{{ Util::convert_to_fuzzy_time($recommend->updated_at) }}</span> <span title="{!!$recommend->point!!}" alt="{!!$recommend->point!!}">{!!Util::recommend_star($recommend->point,12)!!}</span>
        <p>{!!mb_strimwidth($recommend->recommend, 0, 180, '...')!!}</p>
        @if($recommend->sub_name and $recommend->sub_url)
        <p>引用：<a href="{!!$recommend->sub_url!!}">{!!$recommend->sub_name!!}</a></p>
        @endif
        <p>
        @if($recommend->pic)<button class="action-btn action-btn-footer " title="参考図" onClick="loading(); moreRecommendPics({!!$recommend->id!!},{!!$recommend->user_id!!},'{!!$recommend->user_name!!}')" ><small>参考図投稿</small><i class="icon-picture text-purple-700 s-4"></i></button>@endif
        @if($recommend->user_id === Auth::user()->id)
        <button class="action-btn action-btn-footer" title="編集" onClick="loading(); recommendEdit({!!$recommend->id!!},'{!!$recommend->title!!}')" ><small>編集</small>{!!Util::getIcon('edit','s-4','blue')!!}</button>
        <a href="javascript:void(0)" data-toggle="modal" data-target="#modelRecommendDelete" data-whatever="{!!$recommend->id!!}" ><button class="action-btn action-btn-footer"><small>削除</small><i class="icon icon-trash text-grey-600 s-4" title="削除" alt="削除"></i></button></a>
        @endif
        </p>
    </div>
</div>
@empty
<div class="col-sm-12">
  <p class="py-20">
    <span>
      どんどん学習メモを追加しましょう。
      <br />
      学習メモの数だけ合格に近づきます。
    </span>
  </p>
</div>
@endforelse

@if( $recommends->hasMorePages() )
<script>
$(document).ready(function () {
  var insert = '';
  insert += '<button class="btn btn-outline-info" ';
  insert += ' onclick="loading();';
  insert += ' ajaxPaginationMoreRecommendRIght(\'';
  insert += ' {!!$recommends->nextPageUrl()!!}';
  insert += '\');return false;" >';
  insert += '<strong>もっと</strong>';
  insert += '</button>';
  document.getElementById('rightRecommendPageMore').innerHTML = insert;
});
</script>
@else
<script>
  $('#rightRecommendPageMore').html('<span>-</span>');
</script>
@endif

<script>
$('#rightRecommendNumber').html('('+{!!$recommends->total()!!}+')');
</script>