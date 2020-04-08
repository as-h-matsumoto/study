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
                    <span class="px-3">ユーザ登録</span>
                </div>
            </a>

            
            @else
            <a class="dropdown-item" href="/account/try/history">
                <div class="row no-gutters align-items-center flex-nowrap">
                    <i class="icon-account-settings text-red-700" style="margin-left:1px;"></i>
                    <span class="px-3">過去問受験履歴</span>
                </div>
            </a>
            @if(Auth::user()->owner)
            <a class="dropdown-item" href="/owner">
                <div class="row no-gutters align-items-center flex-nowrap">
                    <i class="icon-store text-green-700"></i>
                    <span class="px-3">問題登録</span>
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

    <div class="toolbar-separator"></div>

    <button id="right-area-recommends" type="button" class="quick-panel-button btn btn-icon" data-fuse-bar-toggle="quick-panel-sidebar">
        <i class="icon icon-format-list-bulleted"></i>
    </button>

</div>
</div>
