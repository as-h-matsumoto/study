@forelse($kijis as $kiji)

<div id="{{$kiji->id}}" class="col-sm">
    <div class="card lcard row" >

      <div class="card-block-me p-0 m-0 row">
          <div class="col-4 p-0">
            <a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/kiji/{!!$kiji->id!!}/desc">
              <img class="card-img-top" src="{{Util::getPicKiji(UtilYoyaku::getNewMenuSenMonTenKey($kiji->service), false, $kiji->pic, $kiji->id, 250, false)}}" width="100%" style="max-width:160px;">
            </a>
          </div>
          <div class="col-8 pl-0 pb-1">
            <div class="center">
              <h5 class="border-bottom py-2">
                <a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/kiji/{!!$kiji->id!!}/desc">
                  <span class="text-blue-grey-500"><strong>{!!$content['company']->name!!}</strong></span>
                </a>
              </h5>
              <div class="border-bottom pb-2 center">
                <i class="icon icon-map-marker-radius s-4 text-red-600"></i> {!!Util::getCountryAreaName($kiji->country_area_id)!!}{!!Util::getCountryAreaOneName($kiji->country_area_address_one)!!}{!!Util::getCountryAreaTwoName($kiji->country_area_address_two)!!}
                <br />
                @if($kiji->station_name)
                <span class="f11 text-blue-grey-500"><strong>最寄駅：{!!$kiji->station_name.'駅'!!}{!!'徒歩'.$minits_work.'分'!!}</strong></span>
                @else
                <span class="f11 text-blue-grey-500"><strong>最寄駅遠い。車がお勧め！</strong></span>
                @endif
                @if($kiji->tell)
                <br /><span class="f11">{!!$kiji->tell!!}</span>
                @endif
              </div>
            </div>
            <div class="center">
              <span class="rating pl-2">
                {!! Util::recommend_star($kiji->recommend_point, 12) !!}
                <span class="number f11">{!!round($kiji->recommend_point, 2)!!}</span>
              </span>
            </div>
            <div class="center">
              <span class=" text-info pr-2">採用形態</span>
              @if($content['menu']->recruit_type_1) <span class="pr-1">・正社員</span> @endif
              @if($content['menu']->recruit_type_2) <span class="pr-2">・派遣</span> @endif
              @if($content['menu']->recruit_type_3) <span>・バイト</span> @endif
              <br />

              @if(isset($kiji->recruit_status_id))
              <span class="f13">ステータス: </span><span class="text-info f13">{!!Util::contentRecruitEntry($kiji->recruit_status_id,'name',null,null)!!}</span>
              @endif

              @if($kiji->description)
              @if(isset($kiji->recruit_status_id)) <br /> @endif
              <a tabindex="0" class="btn-header" role="button"
                data-toggle="popover"
                data-placement="top"
                data-trigger="focus"
                data-content="{!!$kiji->description!!}">
                {!!mb_strimwidth($kiji->description, 0, 30, '...')!!}
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

      <div class="card-actions"><a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$kiji->id!!}/desc"><button class="action-btn action-btn-footer px-1"><i title="詳細へ" class="icon icon-checkbox-multiple-marked-outline s-4"></i></button></a><button class="action-btn action-btn-footer px-1" title="いいね" onClick="loading(); niceBad('contents', {!!$kiji->id!!}, 'good', 'Content')" ><small id="niceContentgood{!!$kiji->id!!}">{!!$kiji->good_number!!}</small><i class="icon-thumb-up-outline text-green-700 s-4"></i></button><button class="action-btn action-btn-footer px-1" title="う～ん" onClick="loading(); niceBad('contents', {!!$kiji->id!!}, 'bad', 'Content')"><small id="niceContentbad{!!$kiji->id!!}">{!!$kiji->bad_number!!}</small><i class="icon-thumb-down-outline text-primary-200 s-4"></i></button><button title="コメント件数" class="action-btn action-btn-footer hidden-xs-other px-1" style=""><i class="icon-comment-text-outline s-3 text-accent-700"></i><span class="f11">{!!$kiji->recommend_number!!}件</span></button><span class="action-btn action-btn-footer float-right border-left  px-1" id="favorite-contents-{!!$kiji->id!!}">@if($kiji->favo)<a onClick="loading(); favorite('contents', {!!$kiji->id!!}, 'delete')"><i class="icon icon-star s-4 text-red-600" title="お気に入り解除" alt="お気に入り解除"></i></a>@else<a onClick="loading(); favorite('contents', {!!$kiji->id!!}, 'add')"><i class="icon icon-star s-4 text-yellow-600" title="お気に入り登録" alt="お気に入り登録"></i></a>@endif</span></div>

    </div>
</div>


@empty
@endforelse





@if( $kijis->hasMorePages() and !empty($kijis) and $kijis->currentPage()>1 )
<script>
$(document).ready(function () {
    var insert = '';
    insert += '<button class="btn btn-outline-info" ';
    insert += ' onclick="loading();';
    insert += ' ajaxPaginationMore(\'';
    insert += ' {!!$kijis->nextPageUrl()!!}';
    insert += '\');return false;" >';
    insert += '<strong>もっと</strong>';
    insert += '</button>';
    document.getElementById('pageMore').innerHTML = insert;
});
</script>
@elseif(!$kijis->hasMorePages() and $kijis->currentPage()>1)
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
