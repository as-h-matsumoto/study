@foreach($contents as $content)
    <tr id="deleContent{!!$content->id!!}">
        <td>
          <a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/desc" target="_blank" ><img title="{{$content->name}}" class="profile-image avatar huge page-header-img-m" src="{{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content->id, 400)}}" style="max-width:180px;"></a>
          <br />
          <p><a class="text-blue-600" href="/owner/contents/{!!$content->id!!}/top" target="_blank" >オーナー編集</a></p>
          <p class="f11">リコメンドポイント: {!!$content->recommend_point!!}</p>
          <p class="f11">リコメンド件数: {!!$content->recommend_number!!}</p>
          <p class="f11"><a class="text-blue-600" href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/desc" target="_blank" >リコメンド登録</a></p>
        </td>
        <td>
            <span><strong class="text-red-500">{!! $content->name !!}</strong></span><br />
            <span><strong class="text-red-500">{!! $content->tell !!}</strong></span><br />
            <span class="text-blue-800 pr-2">{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}</span>
            <span>
            @if(isset($content->country_area_id)) <?php $country_area = Util::getCountryAreaName($content->country_area_id); ?>{!!$country_area!!} @endif
            @if(isset($content->country_area_address_one)) <?php $country_area_address_one = Util::getCountryAreaOneName($content->country_area_address_one); ?> {!!$country_area_address_one!!} @endif
            @if(isset($content->country_area_address_two)) <?php $country_area_address_two = Util::getCountryAreaTwoName($content->country_area_address_two); ?> {!!$country_area_address_two!!} @endif
            </span>
            @if($content->homepage)<br /><a class="text-blue" href="{!!$content->homepage!!}" target="_blank">ホームページ</a>@endif
            <br />
            <p class="h3"><a class="text-blue" href="https://www.google.co.jp/search?q={!!UtilYoyaku::getNewMenuSenMonTen($content->service) . ' ' . $content->name . ' ' . $country_area . ' ' . $country_area_address_one . ' ' . $country_area_address_two!!}&sourceid=chrome&ie=UTF-8" target="_blank">google検索</a></p>
        </td>
        <td>
        {!! Form::open(array('url' => '', 'id' => 'content' . $content->id, 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}
        @foreach(UtilYoyaku::getNewContentTag($content->service,null,null) as $key=>$val)
        <input type="hidden" name="content_id" value="{!!$content->id!!}">
        <?php $column = 'tag' . $key; ?>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="contentTag{!!$key!!}" value="{!!$column!!}" @if( isset($content['content_tags']->$column) and $content['content_tags']->$column) checked @endif />
                <span class="checkbox-icon"></span>
                <span class="form-check-description f11">{!!$val!!}</span>
            </label>
        </div>
        @endforeach
        </form>
        </td>
        <td>
          <a href="javascript:void(0)" id="postContentShopdown{!!$content->id!!}" class="text-blue-800" onClick="postContentShopdown({!!$content->id!!});" >@if($content->shop_down===9) 営業停止 @else 営業 @endif </a>
          <br /><br />
          <a href="javascript:void(0)" id="postContentOpen{!!$content->id!!}" class="text-blue-800" onClick="postContentOpen({!!$content->id!!});" >@if($content->admin_open) サービスマッチ @else サービスミス @endif </a>
          <br /><br />
          <a href="javascript:void(0)" class="text-blue-800" onClick="loading(); postContentTags({!!$content->id!!});" >タグ更新</a>
        </td>
        
    </tr>
@endforeach

@if( $contents->hasMorePages() and !empty($contents) and $contents->currentPage()>1 )
<script>
$(document).ready(function () {
var insert = '';
insert += '<button class="btn btn-outline-info" ';
insert += ' onclick="loading();';
insert += ' ajaxPaginationContentsMore(\'';
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
