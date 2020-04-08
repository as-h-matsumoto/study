<aside id="aside" class="aside aside-left"
    data-fuse-bar="aside" data-fuse-bar-media-step="md"
    data-fuse-bar-position="left">
    <div class="aside-content-wrapper">

    <div class="aside-content">

        <div class="aside-toolbar">

            <div class="logo">
                <span class="logo-icon"><a class="logo-word-i" href="">C</a></span><span class="logo-text"><a class="logo-word" href="">Coord</a></span>
                
            </div>
            <button id="toggle-fold-aside-button" type="button" class="btn btn-icon d-none d-lg-block"
                    data-fuse-aside-toggle-fold>
                <i class="icon icon-backburger"></i>
            </button>

        </div>

        <ul class="nav flex-column custom-scrollbar" id="sidenav" data-children=".nav-item"> 
        
           @foreach(Util::getDefaultMenuList(null,'name',null) as $key=>$val)
            <li class="nav-item">
                <a class="nav-link ripple" href="/{!!$key!!}" data-page-url="/{!!$key!!}">
                    {!!Util::getDefaultMenuList($key,'icon','s-5')!!}
                    <span>{!!$val!!}</span>
                </a>
            </li>
            @endforeach
            
        </ul>
    </div>
</div>
    </aside>