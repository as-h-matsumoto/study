<?php
if(Auth::check()){
    $name=Auth::user()->name;
    $pic=Util::getPic('user', false, Auth::user()->pic, Auth::user()->id, 400, null);
}else{
    $name='ゲスト';
    $pic=Util::getPic('user', false, false, false, 400, null);
}
$site_top_url = '/owner';
$site_name = 'オーナー';
?>

<nav id="toolbar" class="fixed-top bg-white">

    <div class="row no-gutters align-items-center flex-nowrap">

        <div class="col">

            <div class="row no-gutters align-items-center flex-nowrap">

                <button type="button" class="toggle-aside-button btn btn-icon d-block d-lg-none"
                        data-fuse-bar-toggle="aside">
                    <i class="icon icon-menu"></i>
                </button>

                <div class="toolbar-separator d-block d-lg-none"></div>

                <div class="shortcuts-wrapper row no-gutters align-items-center px-0 px-sm-2">

                    <div class="shortcuts row no-gutters align-items-center d-none d-md-flex">

                        <?php $countnum = 1; ?>
                        
                        @foreach(Util::getOwnerMenuList(null,'key',null) as $key=>$val)
                        <a href="{!!Util::getOwnerMenuList($key,'url',null)!!}" class="@if($GLOBALS['urls'][2]===Util::getOwnerMenuList($key,'key',null)){!!'active'!!}@elseif(!$GLOBALS['urls'][2]) @if($key===1){!!'active'!!}@endif @endif shortcut-button btn btn-icon mx-1 @if($countnum>2) hidden-md @endif @if($countnum>6) hidden-lg @endif @if($countnum>9) hidden-xl @endif ">
                            {!!Util::getOwnerMenuList($key,'icon',null)!!}
                        </a>
                        <?php $countnum++; ?>
                        @endforeach
                        
                    </div>

                    <div class="hidden-lg-other">
                        <a href="{!!$site_top_url!!}"><span class="pl-2 px-1 px-sm-3"><img src="/storage/assets/img/yoyaku_logo_400.png" height="20px;" /></span></a>
                    </div>

                    <div class="add-shortcut-menu-button dropdown px-1 px-sm-3">

                        @if(
                            $GLOBALS['urls'][2]==='cmn' or
                            $GLOBALS['urls'][2]==='introduce' or
                            $GLOBALS['urls'][2]==='manual' or
                            $GLOBALS['urls'][2]==='help'
                        )
                        @else
                        <div class="dropdown-toggle btn btn-icon" role="button"
                             id="dropdownShortcutMenu"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon icon-star text-amber-600"></i>
                        </div>
                        @endif
                        

                        <div class="dropdown-menu" aria-labelledby="dropdownShortcutMenu">
                            @foreach( Util::getOwnerMenuList(null,'key',null) as $key=>$val )
                            <a class="@if($GLOBALS['urls'][2]===Util::getOwnerMenuList($key,'key',null)){!!'active'!!}@elseif(!$GLOBALS['urls'][2]) @if($key===1){!!'active'!!}@endif @endif dropdown-item" href="{!!Util::getOwnerMenuList($key,'url',null)!!}">
                                <div class="row no-gutters align-items-center justify-content-between flex-nowrap">
                                    <div class="row no-gutters align-items-center flex-nowrap">
                                        {!!Util::getOwnerMenuList($key,'icon',null)!!}
                                        <span class="px-3">{!!Util::getOwnerMenuList($key,'name',null)!!}</span>
                                    </div>
                                </div>
                            </a>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts/global_grandmenu_right')
        
    </div>
</nav>