<aside id="aside" class="aside aside-left"
    data-fuse-bar="aside" data-fuse-bar-media-step="md"
    data-fuse-bar-position="left">
    <div class="aside-content-wrapper">

    <div class="aside-content">

        <div class="aside-toolbar">

            <div class="logo">
                <span class="logo-icon"><a class="logo-word-i" href="/owner">オ</a></span><span class="logo-text"><a class="logo-word" href="/owner">問題作成</a></span>
            </div>
            <button id="toggle-fold-aside-button" type="button" class="btn btn-icon d-none d-lg-block"
                    data-fuse-aside-toggle-fold>
                <i class="icon icon-backburger"></i>
            </button>

        </div>

        <ul class="nav flex-column custom-scrollbar" id="sidenav" data-children=".nav-item"> 

            @foreach(Util::getOwnerMenuList(null,'key',null) as $key=>$val)
            <li class="nav-item">
                <a class="nav-link ripple
                @switch($val)
                  @case($GLOBALS['urls'][4])
                    active
                    @break
                  @case($GLOBALS['urls'][3])
                    active
                    @break
                  @case($GLOBALS['urls'][2])
                    @if($val === 'license')
                      @if(!$GLOBALS['urls'][3]) active @endif
                    @else
                    active
                    @endif
                    @break
                  @default
                    @break
                @endswitch
                @if(!$GLOBALS['urls'][2] and $val==='home') active @endif
                "
                  href="{!!Util::getOwnerMenuList($key,'url',null)!!}" data-page-url="/{!!Util::getOwnerMenuList($key,'url',null)!!}">
                    {!!Util::getOwnerMenuList($key,'icon','s-5')!!}
                    <span>{!!Util::getOwnerMenuList($key,'name',null)!!}</span>
                </a>
            </li> 
            @endforeach

        </ul>
    </div>
</div>
    </aside>