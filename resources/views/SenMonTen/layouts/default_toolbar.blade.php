<?php
if(Auth::check()){
    $name=Auth::user()->name;
    $pic=Util::getPic('user', false, Auth::user()->pic, Auth::user()->id, 80, null);
}else{
    $name='ゲスト';
    $pic=Util::getPic('user', false, false, false, 80, null);
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
                        @if($GLOBALS['yoyaku_type_id']===90)
                        <a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/?yoyaku_type_tag_id=0" title="すべて" alt="すべて" class="@if(isset($GLOBALS['yoyaku_type_tag_id']) and $GLOBALS['yoyaku_type_tag_id']===0){!!'active'!!}@endif shortcut-button btn btn-icon mx-1">
                            <i class="icon icon-all-inclusive text-green-800"></i>
                        </a>
                        @endif
                        @foreach(UtilYoyaku::getNewContentTag($GLOBALS['yoyaku_type_key'],null) as $key=>$val)
                        <a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/?yoyaku_type_tag_id={!!$key!!}" title="{!!$val!!}" alt="{!!$val!!}" class="@if(isset($GLOBALS['yoyaku_type_tag_id']) and $GLOBALS['yoyaku_type_tag_id']===$key){!!'active'!!}@endif shortcut-button btn btn-icon mx-1 @if($key>2) hidden-md @endif @if($key>6) hidden-lg @endif ">
                            {!! UtilYoyaku::getNewContentTagIcon($GLOBALS['yoyaku_type_id'], $key, null) !!}
                        </a>
                        @endforeach                        
                    </div>

                    <div class="hidden-lg-other">
                        @if($GLOBALS['yoyaku_type_id']===90)
                        <a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}?yoyaku_type_tag_id=0&country_area_id=0"><span class=""><img src="/storage/assets/img/{!!$GLOBALS['yoyaku_type_key']!!}_senmonten_logo_400.png" height="22px;" /></span></a>
                        @endif
                    </div>

                    <div class="add-shortcut-menu-button dropdown px-1 px-sm-3">

                        <div class="dropdown-toggle btn btn-icon" role="button"
                             id="dropdownShortcutMenu"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon icon-star text-amber-600"></i>
                        </div>

                        <div class="dropdown-menu" aria-labelledby="dropdownShortcutMenu">

                            @if($GLOBALS['yoyaku_type_id']===90)
                            <a class="@if(isset($GLOBALS['yoyaku_type_tag_id']) and $GLOBALS['yoyaku_type_tag_id']===0){!!'active'!!}@endif dropdown-item" href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/?yoyaku_type_tag_id=0">
                                <div class="row no-gutters align-items-center justify-content-between flex-nowrap">
                                    <div class="row no-gutters align-items-center flex-nowrap">
                                        <i class="icon icon-all-inclusive text-green-800"></i>
                                        <span class="px-3">すべて</span>
                                    </div>
                                </div>
                            </a>
                            @endif
                            @foreach(UtilYoyaku::getNewContentTag($GLOBALS['yoyaku_type_key'],null) as $key=>$val)
                            <a class="@if(isset($GLOBALS['yoyaku_type_tag_id']) and $GLOBALS['yoyaku_type_tag_id']===$key){!!'active'!!}@endif dropdown-item" href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/?yoyaku_type_tag_id={!!$key!!}">
                                <div class="row no-gutters align-items-center justify-content-between flex-nowrap">
                                    <div class="row no-gutters align-items-center flex-nowrap">
                                        {!!UtilYoyaku::getNewContentTagIcon($GLOBALS['yoyaku_type_id'],$key,null)!!}
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



        <div class="col-auto">

            <div class="row no-gutters align-items-center justify-content-end">

                <div class="user-menu-button dropdown">

                    <div class="dropdown-toggle ripple row align-items-center no-gutters px-2 px-sm-4" role="button"
                         id="dropdownUserMenu"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar-wrapper">
                            <img class="avatar" src="{!!$pic!!}">
                            <i class="status text-green icon-checkbox-marked-circle s-4"></i>
                        </div>
                        <span class="username mx-3 d-none d-md-block">{{$name}}</span>
                    </div>
                    

                    <div class="dropdown-menu py-0" aria-labelledby="dropdownUserMenu">

                        @if(!Auth::check())
                        <a class="dropdown-item" href="/login">
                            <div class="row no-gutters align-items-center flex-nowrap">
                                <i class="icon-login-variant text-danger"></i>
                                <span class="px-3">ログイン</span>
                            </div>
                        </a>
                        <a class="dropdown-item" href="/register">
                            <div class="row no-gutters align-items-center flex-nowrap">
                                <i class="icon-account-card-details text-warning"></i>
                                <span class="px-3">アカウント登録</span>
                            </div>
                        </a>

                        
                        @else
                        <a class="dropdown-item" href="/account/profile">
                            <div class="row no-gutters align-items-center flex-nowrap">
                                <i class="icon-account-settings text-red-700" style="margin-left:1px;"></i>
                                <span class="px-3">プロフィール</span>
                            </div>
                        </a>
                        @if(Auth::user()->owner)
                        <a class="dropdown-item" href="/owner">
                            <div class="row no-gutters align-items-center flex-nowrap">
                                <i class="icon-store text-green-700"></i>
                                <span class="px-3">オーナーページ</span>
                            </div>
                        </a>
                        @endif
                        @if(Auth::user()->id===1)
                        <a class="dropdown-item" href="/manager">
                            <div class="row no-gutters align-items-center flex-nowrap">
                                <i class="icon-security-home text-yellow-700"></i>
                                <span class="px-3">管理者ページ</span>
                            </div>
                        </a>
                        @endif

                        <div class="dropdown-divider"></div>

                        <form name="formLogout" class="form-horizontal" method="POST" action="{{ route('logout') }}">
                            {{ csrf_field() }}
                            <a class="dropdown-item" onclick="document.formLogout.submit();return false;">
                                <div class="row no-gutters align-items-center flex-nowrap">
                                    <i class="icon-logout"></i>
                                    <span class="px-3">ログアウト</span>
                                </div>
                            </a>
                        </form>

                        
                        @endif

                    </div>
                    
                </div>

                <div class="toolbar-separator"></div>

                <div class="message-menu-button dropdown">

                    <div class="dropdown-toggle ripple row align-items-center no-gutters px-2 px-sm-4" role="button"
                         id="dropdownMessageMenu"
                         data-toggle="dropdown" >
                        <i id="notAlreadyMessagesExists" class="icon icon-email-variant s-5"></i>
                    </div>

                    <div id="notAlreadyMessages" class="dropdown-menu" aria-labelledby="dropdownMessageMenu">
                    </div>
                </div>

            </div>
        </div>
    </div>
</nav>