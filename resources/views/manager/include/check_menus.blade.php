
    @foreach($menus as $menu)
    <tr id="deleContent{!!$menu->content_id!!}Menu{!!$menu->id!!}">
        <td><a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$menu->content_id!!}/menu/{!!$menu->id!!}/desc" target="_blank" ><img title="{{$menu->name}}" class="profile-image avatar huge page-header-img-m"
                src="/storage/uploads/contents/{!!$menu->content_id!!}/menu/{!!$menu->id!!}/{!!Util::addFilename($menu->pic,'250')!!}" style="max-width:180px;"></a></td>
        <td>
            <span class="text-blue-800">{!!UtilYoyaku::getNewMenuSenMonTen($menu['content_service'])!!}</span>
            <br /><span>{!! $menu['content_name'] !!}</span>
            <br /><span>{!! $menu->name !!}</span></td>
        <td>
        {!! Form::open(array('url' => '', 'id' => 'content'.$menu->content_id.'Menu'.$menu->id, 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}
        <input type="hidden" name="content_id" value="{!!$menu->content_id!!}">
        <input type="hidden" name="content_menu_id" value="{!!$menu->id!!}">
        @foreach(Util::getContentMenuTag($menu['content_service'],null) as $key=>$val)
        <?php $column = 'tag' . $key; ?>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="contentTag{!!$key!!}" value="{!!$column!!}" @if( isset($menu['content_menu_tags']) and $menu['content_menu_tags']->$column) checked @endif />
                <span class="checkbox-icon"></span>
                <span class="form-check-description">{!!$val!!}</span>
            </label>
        </div>
        @endforeach
        </form>
        </td>
        <td>
          <button type="button" class="btn bg-green-200 text-auto" onClick="loading(); postContentMenuTags({!!$menu->content_id!!},{!!$menu->id!!});" >登録</button>
        </td>
    </tr>
    @endforeach