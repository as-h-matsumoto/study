<?php $net_yoyaku = false; ?>
@forelse($contents as $content)
<?php
$minits_work = floor($content->station_distance/90);
if($minits_work<1) $minits_work = 1;
?>
<?php
$allTags = '';
$firstTag = '';
if($content['content_tags']){
    $key = 1;
    while(true){
        if($key > 60) break;
        $column = 'tag' . $key;
        if($content['content_tags']->$column){
          if($allTags){
            $allTags .= ', ' . UtilYoyaku::getNewContentTag($GLOBALS['yoyaku_type_key'], $key);
          }else{
            $firstTag = UtilYoyaku::getNewContentTagIcon($GLOBALS['yoyaku_type_id'], $key, 's-3').UtilYoyaku::getNewContentTag($GLOBALS['yoyaku_type_key'], $key);
            $allTags  = UtilYoyaku::getNewContentTag($GLOBALS['yoyaku_type_key'], $key);
          }
        }
        $key++;
    }
}
?>
@if($content->service===91) <!-- recruit, school, anther -->
<div id="{{$content->id}}" class="col-sm">
    <div class="card lcard row" >

      <div class="card-block-me p-0 m-0 row">
          <div class="col-4 p-0">
            <a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/desc">
              <img class="card-img-top" src="{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content->id, 250)}}" width="100%" style="max-width:160px;">
            </a>
          </div>
          <div class="col-8 pl-0 pb-1">
            <div class="center">
              <h5 class="border-bottom py-2">
                <a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/desc">
                  <span><strong>{!!$content['company']->name!!} {!!Util::truncateHeaderName($content->name,'smartphone')!!}</strong></span>
                </a>
              </h5>
              <div class="border-bottom pb-2 center">
                <i class="icon icon-map-marker-radius s-4 text-red-600"></i> {!!Util::getCountryAreaName($content->country_area_id)!!}{!!Util::getCountryAreaOneName($content->country_area_address_one)!!}{!!Util::getCountryAreaTwoName($content->country_area_address_two)!!}
                <br />
                
                <span class=" text-info pr-2">採用形態</span>
                @if($content['menu']->recruit_type_1) <span class="pr-1">正社員</span> @endif
                @if($content['menu']->recruit_type_2) <span class="pr-1">派遣</span> @endif
                @if($content['menu']->recruit_type_3) <span>バイト</span> @endif
                <br />

                @if($content->station_name)
                <span class="f11 text-blue-grey-500"><strong>最寄駅：{!!$content->station_name.'駅'!!}{!!'徒歩'.$minits_work.'分'!!}</strong></span>
                @else
                <span class="f11 text-blue-grey-500"><strong>最寄駅遠い。車がお勧め！</strong></span>
                @endif
                @if($content->tell)
                <br /><a href="" class="f11">{!!$content->tell!!}</a>
                @endif
              </div>
            </div>
            <div class="center">
              <span class="rating pl-2">
                {!! Util::recommend_star($content->recommend_point, 12) !!}
                <span class="number f11">{!!round($content->recommend_point, 2)!!}</span>
              </span>
            </div>
            <div class="center">
              
              <p><strong>
              <span class="pr-2">給与:</span>
              @if($content->salary_type===1)<span class="pr-1">時給</span>@else<span class="pr-1">月給</span>@endif
              <span class="">{!!$content->salary_min!!}円</span>
              <span class="px-1">~</span>
              <span class="">{!!$content->salary_max!!}円</span>
              </strong></p>

              @if(isset($content->recruit_status_id))
              <span class="f13">ステータス: </span><span class="text-info f13">{!!Util::contentRecruitEntry($content->recruit_status_id,'name',null,null)!!}</span>
              @endif

            </div>
          </div>
          <div class="col-12">
              @if($content['content_recruit_types'])
              <ul>
                <li class="f14" style="list-style-type: none"><strong>募集職種</strong></li>
              @foreach(Util::getRecruitType('summary', null, null) as $summary_key=>$summary_name)
                <?php $count = true; ?>
                @foreach(Util::getRecruitType('desc', $summary_key, null) as $desc_key=>$desc_name)
                  <?php $column = 'type' . $desc_key; ?>
                  @if($content['content_recruit_types']->$column)
                    @if($count)
                    <?php $count = false; ?>
                    <li>{!!$summary_name!!}</li>
                    <ul>
                    @endif
                    <li>{!!$desc_name!!}</li>
                  @endif
                @endforeach
                @if(!$count)
                </ul>
                @endif
              @endforeach
              </ul>
              @endif
          </div>
      </div>

      <div class="card-actions"><a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/desc"><button class="action-btn action-btn-footer px-1"><i title="詳細へ" class="icon icon-checkbox-multiple-marked-outline s-4"></i></button></a><button class="action-btn action-btn-footer px-1" title="いいね" onClick="loading(); niceBad('contents', {!!$content->id!!}, 'good', 'Content')" ><small id="niceContentgood{!!$content->id!!}">{!!$content->good_number!!}</small><i class="icon-thumb-up-outline text-green-700 s-4"></i></button><button class="action-btn action-btn-footer px-1" title="う～ん" onClick="loading(); niceBad('contents', {!!$content->id!!}, 'bad', 'Content')"><small id="niceContentbad{!!$content->id!!}">{!!$content->bad_number!!}</small><i class="icon-thumb-down-outline text-primary-200 s-4"></i></button><button title="コメント件数" class="action-btn action-btn-footer hidden-xs-other px-1" style=""><i class="icon-comment-text-outline s-3 text-accent-700"></i><span class="f11">{!!$content->recommend_number!!}件</span></button><span class="action-btn action-btn-footer float-right border-left  px-1" id="favorite-contents-{!!$content->id!!}">@if($content->favo)<a onClick="loading(); favorite('contents', {!!$content->id!!}, 'delete')"><i class="icon icon-star s-4 text-red-600" title="お気に入り解除" alt="お気に入り解除"></i></a>@else<a onClick="loading(); favorite('contents', {!!$content->id!!}, 'add')"><i class="icon icon-star s-4 text-yellow-600" title="お気に入り登録" alt="お気に入り登録"></i></a>@endif</span></div>

    </div>
</div>

@else
<div id="{{$content->id}}" class="col-sm">
    <div class="card clcard row f11" >
      <!-- pc -->
      <div class="hidden-xs">
        <div class="card-block-me p-0">
            <a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/desc">
              <img src="{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content->id, 250)}}" width="100%">
            </a>
            <div class="center">
              <div class="border-bottom pt-2 pb-1">
                  <a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/desc">
                    <h5 style="display: inline;"><strong>{!!Util::truncateHeaderName($content->name,'smartphone')!!}</strong></h5>
                  </a>
                  @if($firstTag)
                  <br />
                  <a class="f11" tabindex="0" class="btn-header" role="button"
                    data-toggle="popover"
                    data-placement="top"
                    data-trigger="focus"
                    data-content="{!!$allTags!!}">
                    {!!$firstTag!!}</a>
                  @endif
              </div>
            </div>
            <div class="border-bottom pb-2 pt-1 center">
              @if($content->shop_down===9)
              <p class="center text-warning"><strong>
                  現在、{!!$GLOBALS['yoyaku_type_name']!!}サービスを行っておりません。
              </strong></p>
              @endif

              @if($content->station_name)
              <span class="text-blue-grey-500"><strong>{!!$content->station_name.'駅'!!}{!!'徒歩'.$minits_work.'分'!!}</strong></span>
              @else
              <span class="text-blue-grey-500"><strong>最寄駅遠い。車がお勧め！</strong></span>
              @endif
              <br />

              <span class=""><i class="icon icon-map-marker-radius s-4 text-red-600"></i> {!!Util::getCountryAreaName($content->country_area_id)!!}{!!Util::getCountryAreaOneName($content->country_area_address_one)!!}{!!Util::getCountryAreaTwoName($content->country_area_address_two)!!}</span>
              <br />



              <a href="tel:{!!$content->tell!!}" class="text-blue-800">TEL:{!!$content->tell!!}</a>
            </div>
            <div class="center">
              <span class="rating pl-1">
                {!! Util::recommend_star($content->recommend_point, 12) !!}
                <span class="number f11">{!!round($content->recommend_point, 2)!!}</span>
              </span>
              <button class="action-btn px-1" ><i class="icon icon-comment-text-outline s-3 text-accent-700 f11"></i><span class="f11">{!!$content->recommend_number!!}</span><span class="f11">件</span></button>
            </div>

            <div class="center">
              @if($content->price)
              <span class="pl-2 pr-2 f12 text-info">&yen;{!!$content->price!!}~</span>
              @endif
              @if($content['content_date'])
              <?php $net_yoyaku = true; ?>
              <br />
              <span class="f11">{!!Util::getDayJp($content['content_date']->start)!!}</span> <span class="f11">{!!date('H:i', strtotime($content['content_date']->start))!!}~ <strong class="f11" style="color: {!!$content['content_date']->color!!};" >{!!$content['content_date']->title!!}</strong></span>
              @endif
            </div>
        </div>
      </div>

      <!-- smartphone -->
      <div class="hidden-xs-other">
        <div class="card-block-me p-0 m-0 row">
            <div class="col-4 p-0 center" style="min-height:140px;">
              <a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/desc">
                <img class="card-img-top" src="{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content->id, 250)}}" width="100%" style="max-width:108px;">
              </a>
              <p class="pt-2"><a href="tel:{!!$content->tell!!}" class="f11 text-blue-800">TEL:{!!$content->tell!!}</a></p>
            </div>
            <div class="col-8 pl-0 pb-1">
              <div class="center">
                <div class="border-bottom pt-2 pb-1">
                  <a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/desc">
                    <h5 style="display: inline;"><strong>{!!Util::truncateHeaderName($content->name,'smartphone')!!}</strong></h5>
                  </a>
                  @if($firstTag)
                  <br />
                  <a class="f11" tabindex="0" class="btn-header" role="button"
                    data-toggle="popover"
                    data-placement="top"
                    data-trigger="focus"
                    data-content="{!!$allTags!!}">
                    {!!$firstTag!!}</a>
                  @endif
                </div>
                <div class="border-bottom pb-2 pt-1 center">
                  @if($content->shop_down===9)
                  <p class="center text-warning"><strong>
                      現在、{!!$GLOBALS['yoyaku_type_name']!!}サービスを行っておりません。
                  </strong></p>
                  @endif
                  
                  @if($content->station_name)
                  <span class="text-blue-grey-500"><strong>{!!$content->station_name.'駅'!!}{!!'徒歩'.$minits_work.'分'!!}</strong></span>
                  @else
                  <span class="text-blue-grey-500"><strong>最寄駅遠い。車がお勧め！</strong></span>
                  @endif
                  <br />
                  <i class="f14 icon icon-map-marker-radius s-4 text-red-600"></i> {!!Util::getCountryAreaName($content->country_area)!!}{!!Util::getCountryAreaOneName($content->country_area_address_one)!!}{!!Util::getCountryAreaTwoName($content->country_area_address_two)!!}

                </div>
              </div>
              <div class="center">
                <span class="rating pl-2">
                  {!! Util::recommend_star($content->recommend_point, 12) !!}
                  <span class="number f11">{!!round($content->recommend_point, 2)!!}</span>
                </span>
              </div>
              <div class="center">
                @if($content->price)
                <span class="pl-2 pr-2 f12 text-info">&yen;{!!$content->price!!}~</span>
                @endif
                @if($content['content_date'])
                <?php $net_yoyaku = true; ?>
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
@endif



@empty
@endforelse





@if( $contents->hasMorePages() and !empty($contents) and $contents->currentPage()>1 )
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
@elseif(!$contents->hasMorePages() and $contents->currentPage()>1)
<script>
  $('#pageMore').html('');
</script>
@endif
