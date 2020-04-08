@forelse($contents as $content)
<?php
if($GLOBALS['urls'][1]==='owner'){
  $link = '/owner/contents/' . $content->id . '/top';
}else{
  $link = '/SenMonTen/'.UtilYoyaku::getNewMenuSenMonTen($content->service).'/contents/' . $content->id . '/desc';
}
?>
<div id="{{$content->id}}" class="col-sm">
    <div class="card ccard row" >
      <!-- pc -->
      <div class="hidden-xs">
        <div class="card-block-me p-0">
            <span class="">
              <span class="type_box" >{!!UtilYoyaku::getNewMenuSenMonTenIcon($content->service, null)!!}</span>
              <a href="{!!$link!!}" target="_blank" ><img src="{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content->id, 400)}}" width="100%"></a>
            </span>
            <div class="center">
              <h5 class="border-bottom">
                <span class="f14 text-blue-grey-800"><strong>{!!Util::truncateHeaderName($content->name,'pc')!!}</strong></span>
              </h5>
            </div>
            <div class="center">
              <span>
                <i class="icon icon-map-marker-radius s-4 text-red-600"></i> {!!Util::getCountryAreaName($content->country_area_id)!!}{!!Util::getCountryAreaOneName($content->country_area_address_one)!!}{!!Util::getCountryAreaTwoName($content->country_area_address_two)!!}
              </span>
            </div>
            <div class="center">
              <span class="rating pl-1">
                {!! Util::recommend_star($content->recommend_point, 12) !!}
                <span class="number f11">{!!round($content->recommend_point, 2)!!}</span>
              </span>
              <button class="action-btn px-1" ><i class="icon icon-comment-text-outline s-3 text-accent-700 f11"></i><span class="f11">{!!$content->recommend_number!!}</span><span class="f11">件</span></button>
            </div>

            <div class="center">

              @if(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!=='recruit')
              <span class="pl-2 pr-2 f12 text-info">&yen;{!!$content->price_min!!}~</span>
              @endif

              @if($content['content_date'])
                <br />
                <span class="f11">{!!Util::getDayJp($content['content_date']->start)!!}</span> <span class="f11">{!!date('H:i', strtotime($content['content_date']->start))!!}~ <strong class="f11" style="color: {!!$content['content_date']->color!!};" >{!!$content['content_date']->title!!}</strong></span>
              @endif
            </div>
        </div>
      </div>

      <!-- smartphone -->
      <div class="hidden-xs-other">
        <div class="card-block-me p-0 m-0 row">
            <div class="col-4 p-0">
              <span class="type_box" >{!!UtilYoyaku::getNewMenuSenMonTenIcon($content->service, null)!!}</span>
              <a href="{!!$link!!}" target="_blank" ><img class="card-img-top" src="{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content->id, 400)}}" width="100%" style="max-width:108px;"></a>
            </div>
            <div class="col-8 pl-0 pb-1">
              <div class="center">
                <h5 class="border-bottom">
                  <span class="f14 text-blue-grey-800"><strong>{!!Util::truncateHeaderName($content->name,'smartphone')!!}</strong></span>
                </h5>
                <span>
                  <i class="icon icon-map-marker-radius s-4 text-red-600"></i> {!!Util::getCountryAreaName($content->country_area)!!}{!!Util::getCountryAreaOneName($content->country_area_address_one)!!}{!!Util::getCountryAreaTwoName($content->country_area_address_two)!!}
                </span>
              </div>
              <div class="center">
                <span class="rating pl-2">
                  {!! Util::recommend_star($content->recommend_point, 12) !!}
                  <span class="number f11">{!!round($content->recommend_point, 2)!!}</span>
                </span>
              </div>
              <div class="center">
                @if(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!=='recruit')
                <span class="px-2 f12 text-info">&yen;{!!$content->price_min!!}~</span>
                @endif
                @if($content['content_date'])
                <span class="f11">{!!Util::getDayJp($content['content_date']->start)!!}</span> <span class="f11">{!!date('H:i', strtotime($content['content_date']->start))!!}~ <strong class="f11" style="color: {!!$content['content_date']->color!!};" >{!!$content['content_date']->title!!}</strong></span>
                @endif
              </div>
            </div>
        </div>
      </div>

      <div class="card-actions"><a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/desc"><button class="action-btn action-btn-footer px-1"><i title="詳細へ" class="icon icon-checkbox-multiple-marked-outline s-4"></i></button></a><button class="action-btn action-btn-footer px-1" title="いいね" onClick="loading(); niceBad('contents', {!!$content->id!!}, 'good', 'Content')" ><small id="niceContentgood{!!$content->id!!}">{!!$content->good_number!!}</small><i class="icon-thumb-up-outline text-green-700 s-4"></i></button><button class="action-btn action-btn-footer px-1" title="う～ん" onClick="loading(); niceBad('contents', {!!$content->id!!}, 'bad', 'Content')"><small id="niceContentbad{!!$content->id!!}">{!!$content->bad_number!!}</small><i class="icon-thumb-down-outline text-primary-200 s-4"></i></button><button title="コメント件数" class="action-btn action-btn-footer hidden-xs-other px-1" style=""><i class="icon-comment-text-outline s-3 text-accent-700"></i><span class="f11">{!!$content->recommend_number!!}件</span></button><span class="action-btn action-btn-footer float-right border-left  px-1" id="favorite-contents-{!!$content->id!!}">@if($content->favo)<a onClick="loading(); favorite('contents', {!!$content->id!!}, 'delete')"><i class="icon icon-star s-4 text-red-600" title="お気に入り解除" alt="お気に入り解除"></i></a>@else<a onClick="loading(); favorite('contents', {!!$content->id!!}, 'add')"><i class="icon icon-star s-4 text-yellow-600" title="お気に入り登録" alt="お気に入り登録"></i></a>@endif</span>
      </div>

    </div>
</div>

@empty
@endforelse


@if( !empty($contents) and $contents->hasMorePages() and $contents->currentPage()>1 )
<script>
$(document).ready(function () {
var insert = '';
insert += '<button class="btn btn-outline-info" ';
insert += ' onclick="loading();';
insert += ' ajaxPaginationMore(\'';
insert += ' {!!$contents->nextPageUrl()!!}';
insert += '\');return false;" >';
insert += '<strong>もっと</strong>';
insert += '</button>';
document.getElementById('pageMore').innerHTML = insert;
});
</script>
@elseif(!empty($contents) and !$contents->hasMorePages() and $contents->currentPage()>1)
<script>
$('#pageMore').html('');
</script>
@endif
