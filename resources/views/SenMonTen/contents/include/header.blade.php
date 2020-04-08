

<div id="page-header-custom" class="sm-page-header-lg page-header p-6 row"
    style="background-image: url('{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), true, $content->back_pic, $content->id, 1600)}}')" >
        <div class="user-info col-md-8 col-sm-12 pt-4 center-sm">
            <span>
                <img title="{{$content->name}}" class="profile-image avatar huge page-header-img-m" src="{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content->id, 250)}}">
                <br class="hidden-sm-over" />
                <span>
                    <span class="name f24">
                      {!!Util::truncateHeaderName($content->name,'page')!!}
                    </span>
                    @if( !($content->service===62 or $content->service===69 or $content->service===101) )
                    <br />
                    <span class="name mt-1">
                      <i class="icon icon-map-marker-radius s-4 text-red-A700" title="エリア" alt="エリア"></i> <a class="text-white-500" href="/yoyaku?country_area_id={!!$content->country_area_id!!}" title="都道府県" alt="都道府県">{!!Util::getCountryAreaName($content->country_area_id)!!}</a> >> <a class="text-white-500" href="/yoyaku?country_area_id={!!$content->country_area_id!!}&country_area_address_one_custom_id={!!$content->country_area_address_one!!}" title="市区" alt="市区">{!!Util::getCountryAreaOneName($content->country_area_address_one)!!}</a> >> <a class="text-white-500" href="/yoyaku?country_area_id={!!$content->country_area_id!!}&country_area_address_one_custom_id={!!$content->country_area_address_one!!}&country_area_address_two_custom_id={!!$content->country_area_address_two!!}" title="町村" alt="町村">{!!Util::getCountryAreaTwoName($content->country_area_address_two)!!}</a>
                    </span>
                    @endif
                </span>
            </span>
        </div>

        <div id="page-header-actions" class="actions actions-header col-md-4 col-sm-12 center pt-4">
            <p>
                <a href="javascript:void(0)" class="mb-1 p-1 mr-1 bg-white-500" onClick="loading(); niceBad('contents', {!!$content->id!!}, 'good', 'Content')" title="いいね">
                  <small id="niceContentgood{!!$content->id!!}">{!!$content->good_number!!}</small><i class="icon-thumb-up-outline text-green-700 s-4"></i>
                </a>
                <a href="javascript:void(0)" class="mb-1 p-1 mr-1 bg-white-500" onClick="loading(); niceBad('contents', {!!$content->id!!}, 'bad', 'Content')" title="う～ん">
                  <small id="niceContentbad{!!$content->id!!}">{!!$content->bad_number!!}</small><i class="icon-thumb-down-outline text-primary-200 s-4"></i>
                </a>
                <a href="javascript:void(0)" class="mb-1 p-1 mr-1 bg-white-500" title="リコメンド">
                  <i class="icon-comment-text-outline text-accent-700 s-4"></i><small>{!!$content->recommend_number!!}件</small>
                </a>
                <a href="javascript:void(0)" class="mb-1 p-1 mr-1 bg-white-500" id="favorite-contents-{!!$content->id!!}">
                @if($content->favo)
                  <span onClick="loading(); favorite('contents', {!!$content->id!!}, 'delete')">
                    <i class="icon icon-star s-4 text-red-600" title="お気に入り解除" alt="お気に入り解除"></i>
                  </span>
                @else
                  <span onClick="loading(); favorite('contents', {!!$content->id!!}, 'add')">
                    <i class="icon icon-star s-4 text-yellow-600" title="お気に入り登録" alt="お気に入り登録"></i>
                  </span>
                @endif
                </a>
                <a href="javascript:void(0)" onClick="upMessageModal()" class="mb-1 p-1 mr-1 bg-white-500" title="メッセージを送る">
                  <i class="icon-contact-mail text-blue-700 s-4"></i>
                </a>
            </p>
        </div>

</div>