<div class="card-footer row pb-2 bg-white-500" >

<div class="shortcuts row no-gutters align-items-center d-none d-md-flex">
    @foreach(Util::getAccountGroundMenuList(null,'name',null) as $key=>$val)
    <a href="/license/{!!$license_id!!}/{!!$key!!}" class="@if($GLOBALS['urls'][3]===$key){!!'active'!!}@endif shortcut-button btn btn-icon mx-1 @if($key>2) hidden-md @endif @if($key>6) hidden-lg @endif ">
        {!! Util::getAccountGroundMenuList($key,'icon',null) !!}
    </a>
    @endforeach
</div>
<div class="hidden-lg-other pt-2">
    <a href="/"><span class=" px-3">Tasoyaaan</span></a>
</div>
<div class="add-shortcut-menu-button dropdown px-1 px-sm-3">
    <div class="dropdown-toggle btn btn-icon" role="button"
         id="dropdownShortcutMenu"
         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="icon icon-star text-amber-600"></i>
    </div>
    <div class="dropdown-menu" aria-labelledby="dropdownShortcutMenu">
        
        @if(isset($license_id) and $license_id)
        @foreach(Util::getAccountGroundMenuList(null,'name',null) as $key=>$val)
        <a class="@if($GLOBALS['urls'][3]===$key){!!'active'!!}@endif dropdown-item" href="/license/{!!$license_id!!}/{!!$key!!}">
            <div class="row no-gutters align-items-center justify-content-between flex-nowrap">
                <div class="row no-gutters align-items-center flex-nowrap">
                    {!! Util::getAccountGroundMenuList($key,'icon',null) !!}
                    <span class="px-3">{!!$val!!}</span>
                </div>
            </div>
        </a>
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