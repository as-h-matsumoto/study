


<div class="modal fade" id="modalYoyakuDayclickEvent" tabindex="-1" role="dialog" aria-labelledby="modalYoyakuDayclickEventLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <input type="hidden" name="yoyaku_first_day" id="yoyaku_first_day" value="">

            <div class="modal-header">
                <h5 class="modal-title" id="modalYoyakuDayclickEventLabel"><span class="modalYoyakuDayclickEventDay"></span> 予約状況</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        
            <ul class="nav nav-tabs border-bottom mb-4">
                <li id="yoyaku_first_0" class="nav-item active ">
                    <button onClick="showYoyakuFirst(0);" class="nav-link btn btn-outline-info" >
                        <span class="yoyaku_first_start_0"></span>
                        <span> ~ </span>
                        <span class="yoyaku_first_end_0"></span>
                    </button>
                </li>
                <li id="yoyaku_first_1" class="nav-item ">
                    <button onClick="showYoyakuFirst(1);" class="nav-link btn btn-outline-info">
                        <span class="yoyaku_first_start_1"></span>
                        <span> ~ </span>
                        <span class="yoyaku_first_end_1"></span>
                    </button>
                </li>
            </ul>

            <div class="tab-content p-0">
                <div id="yoyaku_first_tab_0" class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <p class="h5 center">
                                <span class="yoyaku_first_start_0"></span>
                                <span> ~ </span>
                                <span class="yoyaku_first_end_0"></span>
                            </p>
                        </div>
                        <div class="card-body p-0">
                            <input type="hidden" name="yoyaku_first_dateid_0" id="yoyaku_first_dateid_0" value="">

                            <ul class="nav nav-tabs border-bottom mb-4">
                                @if(
                                    $content->service===15 or
                                    $content->service===39 or
                                    $content->service===81 or
                                    $content->service===85 or
                                    $content->service===89
                                )
                                <li id="showOwnerYoyakuDateCapacities_0" class="nav-item active ">
                                    <button onClick="showOwnerYoyakuDateCapacities(0);" class="nav-link btn btn-outline-info">
                                    @if(
                                        $content->service===15 or
                                        $content->service===81
                                    )
                                    キャパシティ
                                    @else
                                    メニュー
                                    @endif
                                    </button>
                                </li>
                                @endif
                                @if(
                                    $content->service===15 or
                                    $content->service===62 or
                                    $content->service===65 or
                                    $content->service===69 or
                                    $content->service===101 or
                                    $content->service===77 or
                                    $content->service===81 or
                                    $content->service===91 or
                                    $content->service===90
                                )
                                <li id="showOwnerYoyakuDateMenus_0" class="nav-item ">
                                    <button onClick="showOwnerYoyakuDateMenus(0);" class="nav-link btn btn-outline-info">メニュー</button>
                                </li>
                                @endif
                                <li id="showOwnerYoyakuDateUsers_0" class="nav-item ">
                                    <button onClick="showOwnerYoyakuDateUsers(0);" class="nav-link btn btn-outline-info">ご予約者</button>
                                </li>
                            </ul>
    
                            <div class="tab-content p-0">
                                <div class="row pb-4" id="showOwnerYoyakuDateCapacitiesTab_0">
                                    @if(
                                        $content->service===15 or
                                        $content->service===39 or
                                        $content->service===85 or
                                        $content->service===89
                                    )
                                    <div class="col-12 center mb-4">
                                        {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'modalYoyakuDayclickEventSelectTimeForm', 'name' => 'modalYoyakuDayclickEventSelectTimeForm', 'method' => 'post', 'class' => 'form-row align-items-center', 'files'=> false)) !!}
                                        <div class="col-auto center pb-4 border-bottom">
                                            <label class="mr-sm-2" for="selectYoyakuDateStart_0" class="text-info">確認時間</label>
                                            <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="selectYoyakuDateStart_0" id="selectYoyakuDateStart_0">
                                            </select>
                                        </div>
                                        </form>
                                    </div>
                                    @endif
                                    <div id="capacityTable_0" class="col-12">
                                    </div>
                                </div>
        
                                <div class="mb-4" id="showOwnerYoyakuDateMenusTab_0" style="display:none;">
                                    @if(
                                        $content->service===65 or
                                        $content->service===77 or
                                        $content->service===90
                                    )
                                    <div class="col-12 center mb-4">
                                        {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'modalYoyakuDayclickEventSelectTimeForm', 'name' => 'modalYoyakuDayclickEventSelectTimeForm', 'method' => 'post', 'class' => 'form-row align-items-center', 'files'=> false)) !!}
                                        <div class="col-auto center pb-4 border-bottom">
                                            <label class="mr-sm-2" for="selectYoyakuDateStart_0" class="text-info">確認時間</label>
                                            <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="selectYoyakuDateStart_0" id="selectYoyakuDateStart_0">
                                            </select>
                                        </div>
                                        </form>
                                    </div>
                                    @endif
                                    <div id="menuTable_0" class="col-12">
                                    </div>
                                </div>
        
                                <div class="row mb-4" id="showOwnerYoyakuDateUsersTab_0" style="display:none;">
                                    <div id="userTable_0" class="col-12">
                                    </div>
                                </div>
        
                            </div>
                        </div>
                    </div>
                </div>
    
    
                <div id="yoyaku_first_tab_1" class="modal-body" style="display:none;">
                    <div class="card">
                        <div class="card-header">
                            <p class="h5 center">
                                <span class="yoyaku_first_start_1">
                                11:00
                                </span>
                                <span> ~ </span>
                                <span class="yoyaku_first_end_1">
                                15:00
                                </span>
                            </p>
                        </div>
                        <div class="card-body p-0">
                            <input type="hidden" name="yoyaku_first_dateid_1" id="yoyaku_first_dateid_1" value="">
    
                            <ul class="nav nav-tabs border-bottom mb-4">
                                @if(
                                    $content->service===15 or
                                    $content->service===39 or
                                    $content->service===81 or
                                    $content->service===85 or
                                    $content->service===89
                                )
                                <li id="showOwnerYoyakuDateCapacities_1" class="nav-item active ">
                                    <button onClick="showOwnerYoyakuDateCapacities(1);" class="nav-link btn btn-outline-info">
                                    @if(
                                        $content->service===15 or
                                        $content->service===81
                                    )
                                    キャパシティ
                                    @else
                                    メニュー
                                    @endif
                                    </button>
                                </li>
                                @endif
                                @if(
                                    $content->service===15 or
                                    $content->service===62 or
                                    $content->service===65 or
                                    $content->service===69 or
                                    $content->service===101 or
                                    $content->service===77 or
                                    $content->service===81 or
                                    $content->service===91 or
                                    $content->service===90
                                )
                                <li id="showOwnerYoyakuDateMenus_1" class="nav-item ">
                                    <button onClick="showOwnerYoyakuDateMenus(1);" class="nav-link btn btn-outline-info">メニュー</button>
                                </li>
                                @endif
                                <li id="showOwnerYoyakuDateUsers_1" class="nav-item ">
                                    <button onClick="showOwnerYoyakuDateUsers(1);" class="nav-link btn btn-outline-info">ご予約者</button>
                                </li>
                            </ul>
    
                            <div class="tab-content p-0">
                                <div class="row pb-4" id="showOwnerYoyakuDateCapacitiesTab_1">
                                    @if(
                                        $content->service===15 or
                                        $content->service===39 or
                                        $content->service===85 or
                                        $content->service===89
                                    )
                                    <div class="col-12 center mb-4">
                                        {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'modalYoyakuDayclickEventSelectTimeForm', 'name' => 'modalYoyakuDayclickEventSelectTimeForm', 'method' => 'post', 'class' => 'form-row align-items-center', 'files'=> false)) !!}
                                        <div class="col-auto center pb-4 border-bottom">
                                            <label class="mr-sm-2" for="selectYoyakuDateStart_1" class="text-info">確認時間</label>
                                            <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="selectYoyakuDateStart_1" id="selectYoyakuDateStart_1">
                                            </select>
                                        </div>
                                        </form>
                                    </div>
                                    @endif
                                    <div id="capacityTable_1" class="col-12">
                                    </div>
                                </div>
        
                                <div class="mb-4" id="showOwnerYoyakuDateMenusTab_1" style="display:none;">
                                    @if(
                                        $content->service===65 or
                                        $content->service===77 or
                                        $content->service===90
                                    )
                                    <div class="col-12 center mb-4">
                                        {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'modalYoyakuDayclickEventSelectTimeForm', 'name' => 'modalYoyakuDayclickEventSelectTimeForm', 'method' => 'post', 'class' => 'form-row align-items-center', 'files'=> false)) !!}
                                        <div class="col-auto center pb-4 border-bottom">
                                            <label class="mr-sm-2" for="selectYoyakuDateStart_1" class="text-info">確認時間</label>
                                            <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="selectYoyakuDateStart_1" id="selectYoyakuDateStart_1">
                                            </select>
                                        </div>
                                        </form>
                                    </div>
                                    @endif
                                    <div id="menuTable_1" class="col-12">
                                    </div>
                                </div>
        
                                <div class="row mb-4" id="showOwnerYoyakuDateUsersTab_1" style="display:none;">
                                    <div id="userTable_1" class="col-12">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






