<?php $net_yoyaku = false; ?>
@forelse($contents as $content)
<?php
$minits_work = floor($content->station_distance/90);
if($minits_work<1) $minits_work = 1;
?>
@if($content->service===91)
<div id="{{$content->id}}" class="col-sm">
    <div class="card lcard row" >

      <div class="card-block-me p-0 m-0 row">
          <div class="col-4 p-0">
            <a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/contents/{!!$content->id!!}/desc">
              <span class="type_box" >{!!UtilYoyaku::getNewMenuSenMonTenIcon($content->service)!!}</span>
              <img class="card-img-top" src="{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content->id, 400)}}" width="100%" style="max-width:160px;">
            </a>
          </div>
          <div class="col-8 pl-0 pb-1">
            <div class="center">
              <h5 class="border-bottom py-2">
                <a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/contents/{!!$content->id!!}/desc">
                  <span class="text-blue-grey-500"><strong>{!!$content['company']->name!!} {!!Util::truncateHeaderName($content->name,'smartphone')!!}</strong></span>
                </a>
              </h5>
              <div class="border-bottom pb-2 center">
                <i class="icon icon-map-marker-radius s-4 text-red-600"></i> {!!Util::getCountryAreaName($content->country_area_id)!!}{!!Util::getCountryAreaOneName($content->country_area_address_one)!!}{!!Util::getCountryAreaTwoName($content->country_area_address_two)!!}
                <br />
                @if($content->station_name)
                <span class="text-blue-grey-500"><strong>最寄駅：{!!$content->station_name.'駅'!!}{!!'徒歩'.$minits_work.'分'!!}</strong></span>
                @else
                <span class="text-blue-grey-500"><strong>最寄駅遠い。車がお勧め！</strong></span>
                @endif
                @if($content->tell)
                <br /><span class="f11">{!!$content->tell!!}</span>
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
              <span class=" text-info pr-2">採用形態</span>
              @if($content['menu']->recruit_type_1) <span class="pr-1">・正社員</span> @endif
              @if($content['menu']->recruit_type_2) <span class="pr-2">・派遣</span> @endif
              @if($content['menu']->recruit_type_3) <span>・バイト</span> @endif
              <br />

              @if(isset($content->recruit_status_id))
              <span class="f13">ステータス: </span><span class="text-info f13">{!!Util::contentRecruitEntry($content->recruit_status_id,'name',null,null)!!}</span>
              @endif

              @if($content->description)
              @if(isset($content->recruit_status_id)) <br /> @endif
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
          <div class="col-12">
              <p class=" text-info center pb-4">募集職種</p>
              @if($content['content_recruit_types'])
              <ul>
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

      <div class="card-actions"><a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/contents/{!!$content->id!!}/desc"><button class="action-btn action-btn-footer px-1"><i title="詳細へ" class="icon icon-checkbox-multiple-marked-outline s-4"></i></button></a><button class="action-btn action-btn-footer px-1" title="いいね" onClick="loading(); niceBad('contents', {!!$content->id!!}, 'good', 'Content')" ><small id="niceContentgood{!!$content->id!!}">{!!$content->good_number!!}</small><i class="icon-thumb-up-outline text-green-700 s-4"></i></button><button class="action-btn action-btn-footer px-1" title="う～ん" onClick="loading(); niceBad('contents', {!!$content->id!!}, 'bad', 'Content')"><small id="niceContentbad{!!$content->id!!}">{!!$content->bad_number!!}</small><i class="icon-thumb-down-outline text-primary-200 s-4"></i></button><button title="コメント件数" class="action-btn action-btn-footer hidden-xs-other px-1" style=""><i class="icon-comment-text-outline s-3 text-accent-700"></i><span class="f11">{!!$content->recommend_number!!}件</span></button><span class="action-btn action-btn-footer float-right border-left  px-1" id="favorite-contents-{!!$content->id!!}">@if($content->favo)<a onClick="loading(); favorite('contents', {!!$content->id!!}, 'delete')"><i class="icon icon-star s-4 text-red-600" title="お気に入り解除" alt="お気に入り解除"></i></a>@else<a onClick="loading(); favorite('contents', {!!$content->id!!}, 'add')"><i class="icon icon-star s-4 text-yellow-600" title="お気に入り登録" alt="お気に入り登録"></i></a>@endif</span></div>

    </div>
</div>



@elseif($content->service===62 or $content->service===69 or $content->service===101)
<div id="{{$content->id}}-{!!$content->menu_id!!}" class="col-sm">
    <div class="card lcard row" >

      <div class="card-block-me p-0 m-0 row">

          <div class="col-4 p-0">
            <a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/contents/{!!$content->id!!}/menu/{!!$content->menu_id!!}/desc">
              <span class="type_box" >{!!UtilYoyaku::getNewMenuSenMonTenIcon($content->service)!!}</span>
              <img class="card-img-top" src="{{Util::getPicMenu(null, null, $content->pic, $content->id, 400, $content->menu_id)}}" width="100%" style="max-width:160px;">
            </a>
          </div>
          <div class="col-8 pl-0 pb-1">
            <div class="center">
              <h5 class="border-bottom py-2">
                <a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/contents/{!!$content->id!!}/menu/{!!$content->menu_id!!}/desc">
                  <span class="text-blue-grey-500"><strong>{!!$content->name!!} | {!!$content->menu_name!!}</strong></span>
                </a>
              </h5>
              <div class="border-bottom pb-2 center">
                @if($content->service===62)
                  <i class="icon icon-map-marker-radius s-4 text-red-600"></i> {!!Util::getCountryAreaName($content->country_area_id)!!}{!!Util::getCountryAreaOneName($content->country_area_address_one)!!}
                  <br />
                  @if($content->station_name)
                  <span class="text-blue-grey-500"><strong>最寄駅：{!!$content->station_name.'駅'!!}{!!'徒歩'.$minits_work.'分'!!}</strong></span>
                  @else
                  <span class="text-blue-grey-500"><strong>最寄駅遠い。車がお勧め！</strong></span>
                  @endif
                @else
                  <i class="icon icon-map-marker-radius s-4 text-red-600"></i>
                  <span class="pr-2">行先: {!!Util::getCountryAreaName($content['content_date']->to_tour)!!}</span>
                  <span>出発元: @if($content['content_date']->from_tour===0){!!'現地集合'!!}@else{!!Util::getCountryAreaName($content['content_date']->from_tour)!!}@endif</span>
                @endif
                @if($content->tell)
                  <br /><span class="text-blue-800">TEL:{!!$content->tell!!}</span>
                @endif
              </div>
            </div>

              @if($content->station_name)
              <span class="f11 text-blue-grey-500"><strong>最寄駅：{!!$content->station_name.'駅'!!}{!!'徒歩'.$minits_work.'分'!!}</strong></span>
              @else
              <span class="f11 text-blue-grey-500"><strong>最寄駅遠い。車がお勧め！</strong></span>
              @endif
              @if($content->tell)
              <br /><span class="f11 text-blue-800">TEL:{!!$content->tell!!}</span>
              @endif
              
            <div class="center">
              <span class="rating pl-2">
                {!! Util::recommend_star($content->recommend_point, 12) !!}
                <span class="number f11">{!!round($content->recommend_point, 2)!!}</span>
              </span>
            </div>

            @if($content['content_date'])
            <?php $net_yoyaku = true; ?>
            <div class="center">
              <span class="f11 pr-2">{!!Util::getDayJp($content['content_date']->start)!!}</span>
              <span class="f11">{!!date('H:i', strtotime($content['content_date']->start))!!} ~ <strong class="f11" style="color: {!!$content['content_date']->color!!};" >{!!$content['content_date']->title!!}</strong></span>
            </div>
            @endif

            <div class="center">
              <p>





              <?php
              $kikan = '';
              switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
                case 'lesson': $kikan .= 'レッスン'; break;
                case 'tour': $kikan .= 'ツアー'; break;
                case 'ticket': $kikan .= '開催'; break;
              }
              $kikan .= ($content->time<=29) ? '期間' : '時間' . ' ';
              $kikan .= $content->time;
              $kikan .= ($content->time<=29) ? '日' : '分';
              ?>
              <span class="pr-1">{!!$kikan!!}</span>
              @if($content->person>=2)<span class="">{!!$content->person . '名様～'!!}</span>@endif
              <span class=" pr-1">枠:{!!$content->number . '名'!!}</span>
              @if($content['content_date'] and ($content['content_date']->percent>1 and $content['content_date']->percent<100))
              <br /><del>&yen;{!!$content->price!!}</del><span class="px-2">-></span>
              <span class="f14 text-orange-A700">&yen;{!!$content->price * $content['content_date']->percent!!}</span>
              @else
              <br /><span class="f14 text-orange-A700">&yen;{!!$content->price!!}</span>
              @endif              
              </p>
            </div>

          </div>
          <div class="col-12">
            <div class="p-4">
              <p class="text-blue-grey-700">
              @if($content->description)
              <a tabindex="0" class="btn-header" role="button"
                data-toggle="popover"
                data-placement="top"
                data-trigger="focus"
                data-content="{!!$content->description!!}">
                {!!mb_strimwidth($content->description, 0, 160, '...')!!}
              </a>
              @endif
              </p>
            </div>
          </div>
      </div>

      <div class="card-actions"><a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/contents/{!!$content->id!!}/desc"><button class="action-btn action-btn-footer px-1"><i title="詳細へ" class="icon icon-checkbox-multiple-marked-outline s-4"></i></button></a><button class="action-btn action-btn-footer px-1" title="いいね" ><small >{!!$content->good_number!!}</small><i class="icon-thumb-up-outline text-green-700 s-4"></i></button><button class="action-btn action-btn-footer px-1" title="う～ん" ><small >{!!$content->bad_number!!}</small><i class="icon-thumb-down-outline text-primary-200 s-4"></i></button><button title="コメント件数" class="action-btn action-btn-footer hidden-xs-other px-1" style=""><i class="icon-comment-text-outline s-3 text-accent-700"></i><span class="f11">{!!$content->recommend_number!!}件</span></button>
      </div>

    </div>
</div>



@else
<div id="{{$content->id}}" class="col-sm">
    <div class="card ccard row" >
      <!-- pc -->
      <div class="hidden-xs">
        <div class="card-block-me p-0">
            <a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/contents/{!!$content->id!!}/desc">
              <span class="type_box" >{!!UtilYoyaku::getNewMenuSenMonTenIcon($content->service)!!}</span>
              <img src="{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content->id, 400)}}" width="100%">
            </a>
            <div class="center">
              <h5 class="border-bottom py-2">
                <a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/contents/{!!$content->id!!}/desc">
                  <span class="text-blue-grey-500"><strong>{!!Util::truncateHeaderName($content->name,'pc')!!}</strong></span>
                </a>
              </h5>
            </div>
            <div class="border-bottom pb-2 center">
              <i class="icon icon-map-marker-radius s-4 text-red-600"></i> {!!Util::getCountryAreaName($content->country_area_id)!!}{!!Util::getCountryAreaOneName($content->country_area_address_one)!!}{!!Util::getCountryAreaTwoName($content->country_area_address_two)!!}
              <br />
              @if($content->station_name)
              <span class="text-blue-grey-500"><strong>最寄駅：{!!$content->station_name.'駅'!!}{!!'徒歩'.$minits_work.'分'!!}</strong></span>
              @else
              <span class="text-blue-grey-500"><strong>最寄駅遠い。車がお勧め！</strong></span>
              @endif
              @if($content->tell)
              <br /><span class="text-blue-800">TEL:{!!$content->tell!!}</span>
              @endif
            </div>
            <div class="center">
              <span class="rating pl-1">
                {!! Util::recommend_star($content->recommend_point, 12) !!}
                <span class="number f11">{!!round($content->recommend_point, 2)!!}</span>
              </span>
              <button class="action-btn px-1" ><i class="icon icon-comment-text-outline s-3 text-accent-700 f11"></i><span class="f11">{!!$content->recommend_number!!}</span><span class="f11">件</span></button>
            </div>

            <div class="center">
              @if($content->price_min)
              <span class="pl-2 pr-2 text-info">&yen;{!!$content->price_min!!}~</span>
              @endif
              @if($content['content_date'])
              <?php $net_yoyaku = true; ?>
              <br />
              <span class="f11">{!!Util::getDayJp($content['content_date']->start)!!}</span> <span class="f11">{!!date('H:i', strtotime($content['content_date']->start))!!}~ <strong class="f11" style="color: {!!$content['content_date']->color!!};" >{!!$content['content_date']->title!!}</strong></span>
              @endif
            </div>

            <?php $content_user = DB::table('users')->select('csv')->where('id',$content->user_id)->first(); ?>
            @if($content_user->csv===1)
            <div>
              <p class="center f11">
                <a class="text-blue-900" href="/yoyaku/request/edit/content?content_id={!!$content->id!!}">編集</a>
              </p>
            </div>
            @endif
        </div>
      </div>

      <!-- smartphone -->
      <div class="hidden-xs-other">
        <div class="card-block-me p-0 m-0 row">
            <div class="col-4 p-0">
              <span class="type_box" >{!!UtilYoyaku::getNewMenuSenMonTenIcon($content->service)!!}</span>
              <a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/contents/{!!$content->id!!}/desc"><img class="card-img-top" src="{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content->id, 400)}}" width="100%" style="max-width:108px;"></a>
            </div>
            <div class="col-8 pl-0 pb-1">
              <div class="center">
                <h5 class="border-bottom py-2">
                  <a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/contents/{!!$content->id!!}/desc">
                    <span class="text-blue-grey-500"><strong>{!!Util::truncateHeaderName($content->name,'smartphone')!!}</strong></span>
                  </a>
                </h5>
                <div class="border-bottom pb-2 center">
                  <i class="icon icon-map-marker-radius s-4 text-red-600"></i> {!!Util::getCountryAreaName($content->country_area)!!}{!!Util::getCountryAreaOneName($content->country_area_address_one)!!}{!!Util::getCountryAreaTwoName($content->country_area_address_two)!!}
                  <br />
                  @if($content->station_name)
                  <span class="text-blue-grey-500"><strong>最寄駅：{!!$content->station_name.'駅'!!}{!!'徒歩'.$minits_work.'分'!!}</strong></span>
                  @else
                  <span class="text-blue-grey-500"><strong>最寄駅遠い。車がお勧め！</strong></span>
                  @endif
                  @if($content->tell)
                  <br /><span class="text-blue-800">TEL:{!!$content->tell!!}</span>
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
                @if($content->price_min)
                <span class="pl-2 pr-2 text-info">&yen;{!!$content->price_min!!}~</span>
                @endif
                @if($content['content_date'])
                <?php $net_yoyaku = true; ?>
                <span class="f11">{!!Util::getDayJp($content['content_date']->start)!!}</span> <span class="f11">{!!date('H:i', strtotime($content['content_date']->start))!!}~ <strong class="f11" style="color: {!!$content['content_date']->color!!};" >{!!$content['content_date']->title!!}</strong></span>
                @endif
              </div>
              @if($content_user->csv===1)
              <div>
                <p class="center f11">
                  <a class="text-blue-900" href="/yoyaku/request/edit/content?content_id={!!$content->id!!}">編集</a>
                </p>
              </div>
              @endif
            </div>
        </div>
      </div>

      <div class="card-actions"><a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/contents/{!!$content->id!!}/desc"><button class="action-btn action-btn-footer px-1"><i title="詳細へ" class="icon icon-checkbox-multiple-marked-outline s-4"></i></button></a><button class="action-btn action-btn-footer px-1" title="いいね" onClick="loading(); niceBad('contents', {!!$content->id!!}, 'good', 'Content')" ><small id="niceContentgood{!!$content->id!!}">{!!$content->good_number!!}</small><i class="icon-thumb-up-outline text-green-700 s-4"></i></button><button class="action-btn action-btn-footer px-1" title="う～ん" onClick="loading(); niceBad('contents', {!!$content->id!!}, 'bad', 'Content')"><small id="niceContentbad{!!$content->id!!}">{!!$content->bad_number!!}</small><i class="icon-thumb-down-outline text-primary-200 s-4"></i></button><button title="コメント件数" class="action-btn action-btn-footer hidden-xs-other px-1" style=""><i class="icon-comment-text-outline s-3 text-accent-700"></i><span class="f11">{!!$content->recommend_number!!}件</span></button><span class="action-btn action-btn-footer float-right border-left  px-1" id="favorite-contents-{!!$content->id!!}">@if($content->favo)<a onClick="loading(); favorite('contents', {!!$content->id!!}, 'delete')"><i class="icon icon-star s-4 text-red-600" title="お気に入り解除" alt="お気に入り解除"></i></a>@else<a onClick="loading(); favorite('contents', {!!$content->id!!}, 'add')"><i class="icon icon-star s-4 text-yellow-600" title="お気に入り登録" alt="お気に入り登録"></i></a>@endif</span>
      </div>

    </div>
</div>
@endif



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

@if($net_yoyaku)
<script>
  document.getElementById('pageInfo').style.display = 'none';
</script>
@else
<script>
  document.getElementById('pageInfo').style.display = '';
</script>
@endif
