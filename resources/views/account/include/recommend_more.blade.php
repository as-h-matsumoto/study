
@forelse ($recommends as $recommend)
<div id="reco{{$recommend->id}}" class="col-sm card rlcard ml-2 mb-2">
    <div class="card-block-me p-0 pt-1 row">
        <div class="col-12 center">
         <span class="text-success">{!!mb_strimwidth($recommend->content_name, 0, 36, "..")!!}</span><br />
        </div>
        <div class="col-sm-12 pl-2 pt-2 border_top border_bottom center" style="min-height:90px;">
          <p>
          @if($recommend->recommend)
          <a tabindex="0" class="btn-header" role="button"
            data-toggle="popover"
            data-placement="top"
            data-trigger="focus"
            data-content="{!!$recommend->recommend!!}">
            {!!mb_strimwidth($recommend->recommend, 0, 180, '...')!!}
          </a>
          @endif
          </p>
          @if($recommend->sub_name and $recommend->sub_url)
          <p>引用：<a href="{!!$recommend->sub_url!!}">{!!$recommend->sub_name!!}</a></p>
          @endif
          
        </div>
    </div>

    <div class="card-actions row pb-0 mb-0">
      <a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($recommend->content_service)!!}/contents/{!!$recommend->table_id!!}/desc"><button class="action-btn action-btn-footer px-1"><i title="学習メモ詳細へ" class="icon icon-checkbox-multiple-marked-outline s-4"></i></button></a>
      @if($recommend->pic)<button class="action-btn action-btn-footer " title="投稿写真" onClick="loading(); moreRecommendPics({!!$recommend->id!!},{!!$recommend->user_id!!},'{!!$recommend->user_name!!}')" ><small>投稿写真</small><i class="icon-picture text-purple-700 s-4"></i></button>@endif
      <button class="action-btn action-btn-footer" title="編集" onClick="loading(); recommendEdit({!!$recommend->id!!},'{!!$recommend->content_name!!}')" ><small>編集</small>{!!Util::getIcon('edit','s-4','blue')!!}</button>
      <a href="javascript:void(0)" data-toggle="modal" data-target="#modelRecommendDelete" data-whatever="{!!$recommend->id!!}" ><button class="action-btn action-btn-footer"><small>削除</small><i class="icon icon-trash text-grey-600 s-4" title="削除" alt="削除"></i></button></a>
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

@if( !empty($recommends) and $recommends->hasMorePages() and $recommends->currentPage()>1 )
<script>
$(document).ready(function () {

var insert = '';
insert += '<button class="btn btn-outline-info" ';
insert += ' onclick="loading();';
insert += ' ajaxPaginationMoreRecommend(\'';
insert += ' {!!$recommends->nextPageUrl()!!}';
insert += '\');return false;" >';
insert += '<strong">もっと</strong>';
insert += '</button>';

document.getElementById('pageMore').innerHTML = insert;

});
</script>
@elseif(!empty($recommends) and !$recommends->hasMorePages() and $recommends->currentPage()>1)

<script>
$('#pageMore').html('<span>-</span>');
</script>

@endif