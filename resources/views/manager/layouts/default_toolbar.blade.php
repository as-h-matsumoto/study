<?php
if(Auth::check()){
    $name=Auth::user()->name;
    $pic=Util::getPic('user', false, Auth::user()->pic, Auth::user()->id, 400, null);
}else{
    $name='ゲスト';
    $pic=Util::getPic('user', false, false, false, 400, null);
}
$site_top_url = '/manager';
$site_name = '管理者';
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

               
                    </div>

                    <div class="hidden-lg-other">
                        <a href="{!!$site_top_url!!}"><span class="pl-2 px-1 px-sm-3">管理者</span></a>
                    </div>

                    <div class="add-shortcut-menu-button dropdown px-1 px-sm-3">


                        <div class="dropdown-toggle btn btn-icon" role="button"
                             id="dropdownShortcutMenu"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon icon-star text-amber-600"></i>
                        </div>

                        <div class="dropdown-menu" aria-labelledby="dropdownShortcutMenu">



                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts/global_grandmenu_right')
        
    </div>
</nav>