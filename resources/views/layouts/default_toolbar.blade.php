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

                        @foreach(Util::getDefaultMenuList(null,'name',null) as $key=>$val)
                        <a href="/{!!$key!!}" class="shortcut-button btn btn-icon mx-1 @if($key>2) hidden-md @endif @if($key>6) hidden-lg @endif ">
                            {!! Util::getDefaultMenuList($key,'icon',null) !!}
                        </a>
                        @endforeach

                    </div>

                    <div class="hidden-lg-other">
                        <a href="/"><span class="pl-2 px-1 px-sm-3">Coord</span></a>
                    </div>

                    <div class="add-shortcut-menu-button dropdown px-1 px-sm-3">

                        
                        <div class="dropdown-toggle btn btn-icon" role="button"
                             id="dropdownShortcutMenu"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon icon-star text-amber-600"></i>
                        </div>
                        

                        <div class="dropdown-menu" aria-labelledby="dropdownShortcutMenu">

                            @foreach(Util::getDefaultMenuList(null,'name',null) as $key=>$val)
                            <a class="dropdown-item" href="/{!!$key!!}">
                                <div class="row no-gutters align-items-center justify-content-between flex-nowrap">
                                    <div class="row no-gutters align-items-center flex-nowrap">
                                        {!!Util::getDefaultMenuList($key,'icon',null)!!}
                                        <span class="px-3">{!!$val!!}</span>
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