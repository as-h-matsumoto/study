
<?php
if(Auth::check()){
    $name=Auth::user()->name;
    $pic=Util::getPic('user', false, Auth::user()->pic, Auth::user()->id, 400, null);
}else{
    $name='ゲスト';
    $pic=Util::getPic('user', false, false, false, 400, null);
}
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

                        @if(isset($license_id) and $license_id)
                        @foreach(Util::getAccountGroundMenuList(null,'name',null) as $key=>$val)
                        @if($key==='getLicenseStudyMap')
                        @else
                        <a href="/license/{!!$license_id!!}/{!!$key!!}" class="@if($GLOBALS['urls'][3]===$key){!!'active'!!}@endif shortcut-button btn btn-icon mx-1 @if($key>2) hidden-md @endif @if($key>6) hidden-lg @endif ">
                            {!! Util::getAccountGroundMenuList($key,'icon',null) !!}
                        </a>
                        @endif
                        @endforeach
                        @endif

                    </div>

                    <div class="hidden-lg-other">
                        <a href="/"><i class="icon icon-home"></i></a>
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
                            
                            @if(isset($license_id) and $license_id)
                            @foreach(Util::getAccountGroundMenuList(null,'name',null) as $key=>$val)
                            @if($key==='getLicenseStudyMap')
                            @else
                            <a class="@if($GLOBALS['urls'][3]===$key){!!'active'!!}@endif dropdown-item" href="/license/{!!$license_id!!}/{!!$key!!}">
                                <div class="row no-gutters align-items-center justify-content-between flex-nowrap">
                                    <div class="row no-gutters align-items-center flex-nowrap">
                                        {!! Util::getAccountGroundMenuList($key,'icon',null) !!}
                                        <span class="px-3">{!!$val!!}</span>
                                    </div>
                                </div>
                            </a>
                            @endif
                            @endforeach
                            @elseif(!$GLOBALS['urls'][2])
                            @else
                            <a class="active dropdown-item" href="/license/1/top">
                                <div class="row no-gutters align-items-center justify-content-between flex-nowrap">
                                    <div class="row no-gutters align-items-center flex-nowrap">
                                        <i class="icon icon-star text-amber-600"></i>
                                        <span class="px-3">中小企業診断士</span>
                                    </div>
                                </div>
                            </a>
                            @endif

                        </div>

                    </div>

                </div>

            </div>
        </div>

        @include('layouts/global_grandmenu_right')
        
    </div>
</nav>