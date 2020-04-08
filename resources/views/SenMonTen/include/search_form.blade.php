            <!-- SEARCH -->
	        <form name="searchYoyakuForm">
                <input type="text" name="dummy1" style="display:none;">
                <input type="text" name="dummy2" style="display:none;">
                <div class="input-group page-header-search-input mb-2 mr-sm-2 bg-white-500">
                    <div class="input-group-addon p-1"><i class="icon icon-map-marker-radius text-red-700 s-6" title="エリア" alt="エリア"></i></div>
                    <select onChange="countryAreaChangeFunc()" id="country-area" name="country-area" class="form-control mr-2" title="都道府県" alt="都道府県">
                    </select>
                    <select onChange="countryAreaAddressOneChangeFunc()" id="country-area-address-one-custom" name="country-area-address-one-custom" class="form-control mr-2 " title="市区" alt="市区">
                    </select>
                    <select onChange="countryAreaAddressTwoChangeFunc()" id="country-area-address-two-custom" name="country-area-address-two-custom" class="form-control" title="町村" alt="町村">
                    </select>
                </div>
                <div class="input-group page-header-search-input mb-2 mr-sm-2 bg-white-500">
                    <div class="input-group-addon"><a href="javascript:void(0)" class="" id="findContents" ><i class="icon icon-magnify s-6 p-1 bg-blue-50"></i></a></div>
                    <input id="search-name" name="search-name" type="search" class="form-control" placeholder="店名、趣味名など" aria-label="店名、アクティブ名、チケット名など" style="min-width:140px;" />
                    <a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}" class="@shortcut-button btn btn-icon p-1 @if($GLOBALS['urls'][3]!=='map') active @endif ">
                        <i class="icon icon-view-dashboard text-red-A700" title="リスト表示" alt="リスト表示"></i>
                    </a>
                    <a href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($GLOBALS['yoyaku_type_id'])!!}/map" class="@shortcut-button btn btn-icon p-1 @if($GLOBALS['urls'][3]==='map') active @endif " onClick="loading();">
                        <i class="icon icon-map-marker-plus text-red-A700" title="マップ表示" alt="マップ表示"></i>
                    </a>
                </div>
            </form>
            <!-- / SEARCH -->