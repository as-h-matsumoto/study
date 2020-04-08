<aside id="aside" class="aside aside-left"
    data-fuse-bar="aside" data-fuse-bar-media-step="md"
    data-fuse-bar-position="left">
    <div class="aside-content-wrapper">

    <div class="aside-content">

        <div class="aside-toolbar">

            <div class="logo">
                <span class="logo-icon"><a class="logo-word-i" href="/account">My</a></span><span class="logo-text"><a class="logo-word" href="/account">マイページ</a></span>
            </div>
            <button id="toggle-fold-aside-button" type="button" class="btn btn-icon d-none d-lg-block"
                    data-fuse-aside-toggle-fold>
                <i class="icon icon-backburger"></i>
            </button>

        </div>

        <ul class="nav flex-column custom-scrollbar" id="sidenav" data-children=".nav-item"> 

            @foreach(Util::getAccountMenuList(null,'name',null) as $key=>$val)
            <?php
            $active = false;
            $href='';
            if($key=='try/choice/license'){
                if($GLOBALS['urls'][3] == 'choice' or $GLOBALS['urls'][3] == 'master') $active = true;
            }
            if($key=='try/history'){
                if($GLOBALS['urls'][2] == 'try' and $GLOBALS['urls'][3] == 'history') $active = true;
            }
            
            if($key=='license' or $key=='license/try/question'){
                $href='/'.$key;
            }else{
                $href='/account/'.$key;
            }
            ?>
            
            <li class="nav-item">
                <a class="nav-link ripple @if($GLOBALS['urls'][2]===$key or $active) active @elseif($GLOBALS['urls'][1]==='license' and $key==='license') active @endif " href="{!!$href!!}" data-page-url="{!!$href!!}">
                    {!!Util::getAccountMenuList($key,'icon','s-5')!!}
                    <span>{!!$val!!}</span>
                </a>
            </li> 
            @endforeach
            <li class="nav-item">
                <a class="nav-link ripple" href="javascript:void(0)" @if(Auth::check()) onClick="upMessageCustomerToAdminModal()" @else onClick="warningNotify('ログインしてください。')" @endif >
                    <i class="icon icon-contacts s-5 text-warning"></i>
                    <span>お問い合せ</span>
                </a>
            </li> 
            
        </ul>
    </div>
</div>
    </aside>