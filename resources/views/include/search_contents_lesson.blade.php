

@forelse($contents as $content)
@forelse($content->menus as $menu)
<div id="{{$content->id}}-{!!$menu->id!!}" class="col-sm">
    <div class="card lcard row" >

      <div class="card-block-me p-0 m-0 row">

          <div class="col-4 p-0">
            <span class="type_box" >{!!UtilYoyaku::getNewContentTagIcon($content->service, $key, null)!!}</span>
            <a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/menu/{!!menu.id!!}/desc"><img class="card-img-top" src="{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content->id, 400)}}" width="100%" style="max-width:160px;"></a>
          </div>
          <div class="col-8 pl-0 pb-1">

            <div class="center">
              <h5 class="border-bottom">
                <span class="f14 text-blue-grey-800"><strong>{!!Util::truncateHeaderName($content->name,'smartphone')!!}</strong></span>
              </h5>
              <span>
                <i class="icon icon-map-marker-radius s-4 text-red-600"></i> {!!Util::getCountryAreaName($content->country_area)!!}{!!Util::getCountryAreaOneName($content->country_area_address_one)!!}
              </span>
            </div>

            <div class="center">
              <span class="rating pl-2">
                {!! Util::recommend_star($content->recommend_point, 12) !!}
                <span class="number f11">{!!round($content->recommend_point, 2)!!}</span>
              </span>
            </div>

            @if($menu['content_date'])
            <div class="center">
              <span class="f11 pr-2">{!!Util::getDayJp($content['content_date']->start)!!}</span>
              <span class="f11">{!!date('H:i', strtotime($content['content_date']->start))!!} ~ <strong class="f11" style="color: {!!$content['content_date']->color!!};" >{!!$content['content_date']->title!!}</strong></span>
            </div>
            @endif

            <div class="center">
              <?php
              $kikan = '';
              switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
                case 'lesson': $kikan .= 'レッスン'; break;
                case 'tour': $kikan .= 'ツアー'; break;
                case 'ticket': $kikan .= '開催'; break;
              }
              $kikan .= ($menu->time<=29) ? '期間' : '時間' . ' ';
              $kikan .= $menu->time;
              $kikan .= ($menu->time<=29) ? '日' : '分';
              ?>
              <span class="pr-1">{!!$kikan!!}</span>

              @if($menu->person>=2)<span class="">{!!$menu->person . '名様～'!!}</span>@endif
            </div>

          </div>
          <div class="col-12">
            <div class="p-4">
              @if($content->description)
              <a tabindex="0" class="btn-header" role="button"
                data-toggle="popover"
                data-placement="top"
                data-trigger="focus"
                data-content="{!!$content->description!!}">
                {!!mb_strimwidth($content->description, 0, 30, '...')!!}
              </a>
              @endif
            </div>
          </div>
      </div>

      <div class="card-actions"><a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/desc"><button class="action-btn action-btn-footer px-1"><i title="詳細へ" class="icon icon-checkbox-multiple-marked-outline s-4"></i></button></a><button class="action-btn action-btn-footer px-1" title="いいね" ><small >{!!$content->good_number!!}</small><i class="icon-thumb-up-outline text-green-700 s-4"></i></button><button class="action-btn action-btn-footer px-1" title="う～ん" ><small >{!!$content->bad_number!!}</small><i class="icon-thumb-down-outline text-primary-200 s-4"></i></button><button title="コメント件数" class="action-btn action-btn-footer hidden-xs-other px-1" style=""><i class="icon-comment-text-outline s-3 text-accent-700"></i><span class="f11">{!!$content->recommend_number!!}件</span></button>
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
