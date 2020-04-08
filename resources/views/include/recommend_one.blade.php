
@foreach($recommends as $recommend)
<div id="reco{{$recommend->id}}" class="col-sm card rlcard mx-2 mb-2">
    <div class="card-block-me p-0 pt-1 row">
      @if($recommend->user_id === Auth::user()->id)
        <div class="col-3">
          <img class="avater center" src="{!!Util::getPic('user', null, $recommend->user_pic, $recommend->user_id, 400, false)!!}" title="{!!$recommend->user_name!!}" alt="{!!$recommend->user_name!!}" style="width:50px;height:40px;" >
        </div>
        <div class="col-9 center">
         <span class="text-success"><a href="{!!$recommend->url!!}">{!!mb_strimwidth($recommend->title, 0, 22, "..")!!}</a></span><br />
         <span>{{ Util::convert_to_fuzzy_time($recommend->updated_at) }}</span> <span title="{!!$recommend->point!!}" alt="{!!$recommend->point!!}">{!!Util::recommend_star($recommend->point,16)!!}</span>
        </div>
      @else
        <div class="col-12 center">
          <span class="text-success"><a href="{!!$recommend->url!!}">{!!mb_strimwidth($recommend->title, 0, 22, "..")!!}</a></span><br />
          <span>{{ Util::convert_to_fuzzy_time($recommend->updated_at) }}</span> <span title="{!!$recommend->point!!}" alt="{!!$recommend->point!!}">{!!Util::recommend_star($recommend->point,16)!!}</span>
        </div>
      @endif
        <div class="col-sm-12 pl-2 pt-2 border_top border_bottom center" style="min-height:90px; max-height:90px;">
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

    <div class="card-actions">
        @if($recommend->pic)<button class="action-btn action-btn-footer " title="参考図" onClick="loading(); moreRecommendPics({!!$recommend->id!!},{!!$recommend->user_id!!},'{!!$recommend->user_name!!}')" ><small>参考図投稿</small><i class="icon-picture text-purple-700 s-4"></i></button>@endif
        @if($recommend->user_id === Auth::user()->id)
        <button class="action-btn action-btn-footer" title="編集" onClick="loading(); recommendEdit({!!$recommend->id!!},'{!!$recommend->title!!}')" ><small>編集</small>{!!Util::getIcon('edit','s-4','blue')!!}</button>
        <a href="javascript:void(0)" data-toggle="modal" data-target="#modelRecommendDelete" data-whatever="{!!$recommend->id!!}" ><button class="action-btn action-btn-footer"><small>削除</small><i class="icon icon-trash text-grey-600 s-4" title="削除" alt="削除"></i></button></a>
        @else
        <button class="action-btn action-btn-footer" title="いいね" onClick="loading(); niceBad('recommends', {!!$recommend->id!!}, 'good', 'Recommend')" ><small id="niceRecommendgood{!!$recommend->id!!}">{!!$recommend->good_number!!}</small><i class="icon-thumb-up-outline text-green-700 s-4"></i></button>
        <button class="action-btn action-btn-footer" title="う～ん" onClick="loading(); niceBad('recommends', {!!$recommend->id!!}, 'bad', 'Recommend')"><small id="niceRecommendbad{!!$recommend->id!!}">{!!$recommend->bad_number!!}</small><i class="icon-thumb-down-outline text-primary-200 s-4"></i></button>
        @endif
    </div>
</div>
@endforeach
