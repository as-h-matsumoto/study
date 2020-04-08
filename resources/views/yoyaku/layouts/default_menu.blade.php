<aside id="aside" class="aside aside-left"
    data-fuse-bar="aside" data-fuse-bar-media-step="md"
    data-fuse-bar-position="left">
    <div class="aside-content-wrapper">

    <div class="aside-content bg-primary-500 text-auto">

        <div class="aside-toolbar">

            <div class="logo">
                <span class="logo-icon-yoyaku"><a class="logo-word" href="/yoyaku">予</a></span><span class="logo-text"><a class="logo-word" href="/yoyaku">Coordiy予約</a></span>
                
            </div>
            <button id="toggle-fold-aside-button" type="button" class="btn btn-icon d-none d-lg-block"
                    data-fuse-aside-toggle-fold>
                <i class="icon icon-backburger"></i>
            </button>

        </div>

        <ul class="nav flex-column custom-scrollbar" id="sidenav" data-children=".nav-item">
            @foreach(Util::getContentServices(null,'key',null) as $key=>$val)
            <li class="nav-item">
                <a class="nav-link ripple" href="/yoyaku/introduce/owner/{!!$val!!}" data-page-url="/yoyaku/introduce/owner/{!!$val!!}">
                    {!! Util::getContentServices($key,'icon',null) !!}
                    <span>{!! Util::getContentServices($key,'name',null) !!}</span>
                </a>
            </li>
            @endforeach
            
        </ul>
    </div>
</div>
    </aside>