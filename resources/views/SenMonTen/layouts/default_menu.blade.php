<aside id="aside" class="aside aside-left"
    data-fuse-bar="aside" data-fuse-bar-media-step="md"
    data-fuse-bar-position="left">
    <div class="aside-content-wrapper">

    <div class="aside-content bg-primary-500 text-auto">

        <div class="aside-toolbar">
            <div class="logo">
                @if($GLOBALS['yoyaku_type_id']===90)
                <span class="logo-icon-yoyaku"><a class="logo-word" href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}?yoyaku_type_tag_id=0&country_area_id=0">ヨ</a></span><span class="logo-text"><a class="logo-word" href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}?yoyaku_type_tag_id=0&country_area_id=0">{!!$GLOBALS['yoyaku_type_name']!!}</a></span>
                @else
                <span class="logo-icon-yoyaku"><a class="logo-word" href="/yoyaku">ヨ</a></span><span class="logo-text"><a class="logo-word" href="/yoyaku">Coordiy予約</a></span>
                @endif
            </div>
            <button id="toggle-fold-aside-button" type="button" class="btn btn-icon d-none d-lg-block"
                    data-fuse-aside-toggle-fold>
                <i class="icon icon-backburger"></i>
            </button>
        </div>

        <ul class="nav flex-column custom-scrollbar" id="sidenav" data-children=".nav-item"> 
        
            @if($GLOBALS['yoyaku_type_id']===90)
            <li class="nav-item">
                <a class="nav-link ripple @if(isset($GLOBALS['yoyaku_type_tag_id']) and $GLOBALS['yoyaku_type_tag_id']===0){!!'active-yoyaku'!!}@endif " href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}?yoyaku_type_tag_id=0" data-page-url="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}?yoyaku_type_tag_id=0">
                    <i class="icon icon-all-inclusive text-green-800"></i>
                    <span>すべて</span>
                </a>
            </li>
            @endif
            @foreach(UtilYoyaku::getNewContentTag($GLOBALS['yoyaku_type_key'],null) as $key=>$val)
            <li class="nav-item">
                <a class="nav-link ripple @if(isset($GLOBALS['yoyaku_type_tag_id']) and $GLOBALS['yoyaku_type_tag_id']==$key){!!'active-yoyaku'!!}@endif " href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}?yoyaku_type_tag_id={!!$key!!}" data-page-url="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}?yoyaku_type_tag_id={!!$key!!}">
                    {!!UtilYoyaku::getNewContentTagIcon($GLOBALS['yoyaku_type_id'],$key,null)!!}
                    <span>{!! $val !!}</span>
                </a>
            </li>
            @endforeach            
        </ul>
    </div>
</div>
    </aside>