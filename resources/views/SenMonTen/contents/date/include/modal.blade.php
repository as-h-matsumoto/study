@if($content->service===91)
@if(isset($content_date_user->recruit_status_id))
<div class="modal fade" id="modalYoyakuOrder" tabindex="-1" role="dialog" aria-labelledby="modalYoyakuOrderLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalYoyakuOrderLabel">{!!Util::contentRecruitEntry($content_date_user->recruit_status_id,'name',null,null)!!}のご予約</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'selectMenuForm', 'name' => 'selectMenuForm', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}

                <input type="hidden" value="" name="modalSelectMenuId" id="modalSelectMenuId" />
                <input type="hidden" value="" name="modalYoyakuOrderEventEnd" id="modalYoyakuOrderEventEnd" />

                <div class="form-group col-sm-12">
                    <label for="selectMenuFormstart" class="form-control-label text-info">面接予約日時</label>
                    <select class="form-control form-control-lg  mt-4" name="selectMenuFormstart" id="selectMenuFormstart"></select>
                </div>
                                
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); yoyakuComfirm();" ><strong>この日時で面接予約</strong></button>
            </div>
        </div>
    </div>
</div>
@endif



@elseif($content->service===62 or $content->service===69 or $content->service===101)
<div class="modal fade" id="modalYoyakuOrder" tabindex="-1" role="dialog" aria-labelledby="modalYoyakuOrderLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalYoyakuOrderLabel">ご予約</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body row">
                        <div id="selectMenuFormMenuPic" class="col-sm-6 center">
                        </div>
                        <div class="col-sm-6 center">
                            <h3 id="selectMenuFormname" class="text-success"></h3>
                        </div>
                        <div class="col-sm-12 center">
                            <p class="">
                                <span id="selectMenuFormstart"></span>
                                <span> ~ </span>
                                <span id="selectMenuFormend"></span>
                            </p>
                            @if($content->service===69)
                            <p>
                                <span>目的地エリア: </span><span id="selectMenuFormto_tour"></span><br />
                                <span>出発地エリア: </span><span id="selectMenuFormfrom_tour"></span><br />
                                <span>詳細に詳しく記載があります。</span>
                            </p>
                            @endif
                            <p>
                                <span class="pr-1">料金:</span>
                                <span class="pr-2 text-warning" id="selectMenuFormprice"></span>
                                <span id="selectMenuFormzan"></span>
                            </p>
                        </div>
                    </div>
                </div>
            
                <div class="card">
                    <div class="card-header">{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}詳細</div>
                    <div class="card-body row">
                        <div id="selectMenuFormdescription" class="col-sm-12 center"></div>
                    </div>
                </div>
                
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'selectMenuForm', 'name' => 'selectMenuForm', 'method' => 'post', 'class' => '', 'files'=> false)) !!}

                <input type="hidden" value="" name="modalSelectMenuId" id="modalSelectMenuId" />

                @include('SenMonTen/contents/date/include/ownersUserForm')
                
                @if($content->service===101)
                <div class="form-group col-sm-12">
                    <label for="selectMenuFormnumber" class="form-control-label text-info">ご利用枚数</label>
                    <input class="form-control form-control-lg center" type="number" value="1" name="selectMenuFormnumber" id="selectMenuFormnumber" min="1" />
                </div>
                @else
                <div class="form-group col-sm-12">
                    <label for="selectMenuForperson" class="form-control-label text-info">ご利用人数</label>
                    <input class="form-control form-control-lg center" type="number" value="1" name="selectMenuFormperson" id="selectMenuFormperson" min="1" />
                </div>
                @endif
                
                <div class="form-group col-sm-12">
                    <label for="selectMenuForminfo" class="form-control-label text-info">連絡事項</label>
                    <textarea class="form-control form-control-lg" name="selectMenuForminfo" id="selectMenuForminfo" style="height:100px;" /></textarea>
                    <span class="help-block f14">ご質問やお伝えしたいことなどご入力ください。</span>
                </div>
                
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); yoyakuComfirm();" ><strong>この内容で最終確認</strong></button>
            </div>
        </div>
    </div>
</div>

@else

<div class="modal fade" id="modalYoyakuOrder" tabindex="-1" role="dialog" aria-labelledby="modalYoyakuOrderLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalYoyakuOrderLabel">メニュー選択</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'selectMenuForm', 'name' => 'selectMenuForm', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}

                <input type="hidden" value="" name="modalSelectMenuId" id="modalSelectMenuId" />
                <input type="hidden" value="" name="modalYoyakuOrderEventEnd" id="modalYoyakuOrderEventEnd" />

                @include('SenMonTen/contents/date/include/ownersUserForm')

                @if($content->service===81)
                <div class="form-group col-sm-6">
                    <label for="selectMenuFormstart" class="form-control-label text-info">チェックイン</label>
                    <p class="mt-4" id="selectMenuFormstart"></p>
                </div>
                <div class="form-group col-sm-6">
                    <label for="selectMenuFormend" class="form-control-label text-info">チェックアウト</label>
                    <p class="mt-4" id="selectMenuFormend"></p>
                </div>
                @else
                <div class="form-group col-sm-6">
                    <label for="selectMenuFormstart" class="form-control-label text-info">ご利用日時</label>
                    <select class="form-control form-control-lg  mt-4" name="selectMenuFormstart" id="selectMenuFormstart"></select>
                </div>
                @endif


                @if($content->service===65 or $content->service===77 or $content->service===90)
                <div class="form-group col-sm-6">
                    <input class="" type="hidden" value="1" name="selectMenuFormperson" id="selectMenuFormperson" min="1" />
                </div>
                @else
                <div class="form-group @if($content->service===81){!!'col-sm-8'!!}@else{!!'col-sm-6'!!}@endif ">
                    <label for="selectMenuForperson" class="form-control-label text-info">ご利用人数</label>
                    <input class="form-control form-control-lg center" type="number" value="1" name="selectMenuFormperson" id="selectMenuFormperson" min="1" />
                    @if($content->service===81)
                    <span class="help-block">
                    {!!'子供(~10才未満)は一名としてカウントし'!!}@if($content->kids){!!'ます。'!!}@else{!!'ません。'!!}@endif<br />
                    {!!'幼児(~6才未満)は一名としてカウントし'!!}@if($content->yoji){!!'ます。'!!}@else{!!'ません。'!!}@endif<br />
                    {!!'赤子(~1才未満)は一名としてカウントし'!!}@if($content->baby){!!'ます。'!!}@else{!!'ません。'!!}@endif<br />
                    </span>
                    @endif
                </div>
                @endif
                @if($content->service===81)
                <div class="form-group col-sm-4">
                    <label for="" class="form-control-label text-info">利用条件</label>
                    <div class="form-check form-check-inline mt-5">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="selectMenuFormnonesmoking" id="selectMenuFormnonesmoking" value="1" />
                            <span class="checkbox-icon"></span>
                            <span class="form-check-description">禁煙</span>
                        </label>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <label for="selectMenuForperson" class="form-control-label text-info">ご利用者様情報</label>
                    <div id="selectMenuFormPersonDescArea" class="row pt-1"><div class="col-12"><p class="f14 text-warning">ご利用人数を入力してください。</p></div></div>
                </div>
                @endif
                
                @if($content->service===15)
                <div class="form-group col-sm-12">
                    <label for="" class="form-control-label text-info">利用条件</label>
                    <div class="form-check form-check-inline mt-5">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="selectMenuFormnonesmoking" id="selectMenuFormnonesmoking" value="1" />
                            <span class="checkbox-icon"></span>
                            <span class="form-check-description">禁煙</span>
                        </label>
                    </div>
                    <div class="form-check form-check-inline mt-5">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="selectMenuFormprivate" id="selectMenuFormprivate" value="1"/>
                            <span class="checkbox-icon"></span>
                            <span class="form-check-description">個室</span>
                        </label>
                    </div>
                    <div class="form-check form-check-inline mt-5">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="selectMenuFormsheet" id="selectMenuFormsheet" value="1"/>
                            <span class="checkbox-icon"></span>
                            <span class="form-check-description">シート／ソファー</span>
                        </label>
                    </div>
                </div>
                @endif
                
                @if($content->service===39 or $content->service===85 or $content->service===89)
                <div class="form-group col-sm-6">
                    <label for="selectMenuFormuse_time" class="form-control-label text-info">ご利用時間</label>
                    <select class="form-control form-control-lg mt-4" name="selectMenuFormuse_time" id="selectMenuFormuse_time"></select>
                </div>
                @endif
                
                @if($content->service===81)
                <div class="form-group col-sm-12">
                    <label for="" class="form-control-label text-info">ご利用の宿泊ルーム、または、施設</label>
                    <div id="selectMenuFormCapacityArea" class="row pt-1"><div class="col-12"><p class="f14 text-warning">ご利用人数を入力してください。</p></div></div>
                    @if($content->service===15)
                    <span class="help-block f14">コースはご利用人数とご利用数が同じになります。</span><br />
                    <span class="help-block f14">時間帯でメニューが変わる場合があります。</span>
                    @endif
                </div>
                @endif

                <div class="form-group col-sm-12">
                    <label for="" class="form-control-label text-info">ご利用メニュー</label>
                    <div id="selectMenuFormMenuArea" class="row pt-1"><div class="col-12"><p class="f14 text-warning">ご利用人数を入力してください。</p></div></div>
                    @if($content->service===15)
                    <span class="help-block f14">コースはご利用人数とご利用数が同じになります。</span><br />
                    <span class="help-block f14">時間帯でメニューが変わる場合があります。</span>
                    @endif
                </div>
                
                @if($content->service===15)
                <div id="allUseForm" class="form-group col-sm-12" style="display:none;">
                    <label for="" class="form-control-label text-info">貸切利用</label>
                    <div class="form-check form-check-inline mt-5">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="selectMenuFormallUse" id="selectMenuFormallUse" value="1"/>
                            <span class="checkbox-icon"></span>
                            <span class="form-check-description">貸切</span>
                        </label>
                    </div>
                    <div>
                        <span class="help-block f14">貸切利用が可能な人数です。他のご予約者様がいなければ貸切が可能です。貸切条件を入れる場合はチェックを入れてください。テーブルなどの状況によっては自動で貸切になる場合もあります。</span>
                    </div>
                </div>
                @endif
                
                <div class="form-group col-sm-12">
                    <label for="selectMenuForminfo" class="form-control-label text-info">連絡事項</label>
                    <textarea class="form-control form-control-lg" name="selectMenuForminfo" id="selectMenuForminfo" style="height:100px;" /></textarea>
                    <span class="help-block f14">ご質問やお伝えしたいことなどご入力ください。</span>
                </div>
                
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); yoyakuComfirm();" ><strong>この内容で最終確認</strong></button>
            </div>
        </div>
    </div>
</div>
@endif


@if(Auth::check())
@if($content->service===91)

<div class="modal fade" id="modalComfirm" tabindex="-1" role="dialog" aria-labelledby="modalComfirmLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalComfirmLabel">ご予約内容確認</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                
                <div class="col-6 mb-4">
                    <p>
                      <span class="text-info">ご予約日時</span><br />
                      <span id="modalComfirmNow"></span>
                    </p>
                </div>

                <div class="col-6 mb-4">
                    <p>
                      <span class="text-info">面接日時</span><br />
                      <span id="modalComfirmStart"></span>
                    </p>
                </div>

                
                {!! Form::open(array('url' => '/account/yoyaku/contents/' . $content->id . '/' . UtilYoyaku::getNewMenuSenMonTenSummary($content->service) . '/comfirm/done', 'name' => 'action', 'id'=>'yoyakuComfirmDone', 'method' => 'post', 'class' => 'row center pt-4', 'files'=> false)) !!}
                <input type="hidden" value="" name="content_date_users_id" id="content_date_users_id" />
                </form>

            </div>

            <div class="modal-footer">
                <button class="btn" onClick="loading(); backModalYoyakuOrder();" ><strong>{!!Util::getIcon('edit','s-4','grey')!!} 戻って修正する</strong></button>
                <button id="bottonNoPayJp" class="btn btn-outline-info" onClick="loading(); yoyakuComfirmDone();" style="display:none;" ><strong>この内容で面接を予約する</strong></button>
            </div>
        </div>
    </div>
</div>

@else
<div class="modal fade" id="modalComfirm" tabindex="-1" role="dialog" aria-labelledby="modalComfirmLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalComfirmLabel">ご予約内容確認</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">

                @include('SenMonTen/contents/date/include/ownersUserFormComfirm')
                
                <div class="col-6 mb-4">
                    <p>
                      <span class="text-info">ご予約日時</span><br />
                      <span id="modalComfirmNow"></span>
                    </p>
                </div>

                <div class="col-6 mb-4">
                    <p>
                      <span class="text-info">ご利用日時</span><br />
                      <span id="modalComfirmStart"></span>
                    </p>
                </div>

                <div class="col-6 mb-4">
                    <p>
                      <span class="text-info">ご利用人数</span><br />
                      <span id="modalComfirmNumber"></span>
                    </p>
                </div>
                <div class="col-6 mb-4">
                    <p>
                      <span class="text-info">連絡事項</span><br />
                      <span id="modalComfirmInfo"></span>
                    </p>
                </div>
                @if($content->service===15 or $content->service===81)
                <div class="col-6 mb-4">
                    <p>
                      <span class="text-info">利用条件</span><br />
                      <span id="modalComfirmMust"></span>
                    </p>
                </div>
                @endif
                @if($content->service===39 or $content->service===85 or $content->service===89)
                <div class="col-12 mb-4">
                    <p>
                      <span class="text-info">ご利用時間</span><br />
                      <div id="modalComfirmUsetime"></div>
                    </p>
                </div>
                @endif
                
                <div class="col-sm-12 mb-4">
                    <p>
                      <span class="text-info center">ご利用メニュー</span><br />
                      <div id="modalComfirmMenuArea">
                      </div>
                    </p>
                </div>
                <div class="col-sm-12 mb-8 center">
                    <p>
                      <span class="text-info" title="支払い総額が50円未満の場合、支払い手数料として50円かかります。">お支払い金額</span><br />
                      <div id="modalComfirmPrice">
                      </div>
                    </p>
                </div>
                
                {!! Form::open(array('url' => '/account/yoyaku/contents/' . $content->id . '/' . UtilYoyaku::getNewMenuSenMonTenSummary($content->service) . '/comfirm/done', 'name' => 'action', 'id'=>'yoyakuComfirmDone', 'method' => 'post', 'class' => 'row center pt-4', 'files'=> false)) !!}
                <div id="formPayJp" class="col-sm-12 center mb-0 pb-0" style="display:none;">
                    <p class="text-info">予約概要</p>
                    <p>こちらの予約はネット決済が必要です。<br /><span class="f11">お支払いはペイパルとなります。</span></p>
                    <span id="paypalArea"></span>
                </div>
                <div id="formNoPayJp" class="col-sm-12 center" style="display:none;">
                    <p class="text-info">予約概要</p>
                    <?php
                    if(Auth::check()){
                        $auth_user_id = Utilowner::getOwnerId();
                    }
                    ?>
                    @if($content->user_id === $auth_user_id)
                    <p>オーナー自身で予約する場合は、予約受付のみとなります。</p>
                    @else
                    <p>
                    こちらは予約のみです。<br />お支払いは店舗で直接お支払いください。<br />キャンセルの際はキャンセル処理をお願いいたします。
		            </p>
                    @endif
                </div>
                <input type="hidden" value="" name="content_date_users_id" id="content_date_users_id" />
                </form>

            </div>

            <div class="modal-footer">
                <button class="btn" onClick="loading(); backModalYoyakuOrder();" ><strong>{!!Util::getIcon('edit','s-4','grey')!!} 戻って修正する</strong></button>
                <button id="bottonNoPayJp" class="btn btn-outline-info" onClick="loading(); yoyakuComfirmDone();" style="display:none;" ><strong>この内容で予約する</strong></button>
            </div>
        </div>
    </div>
</div>
@endif

<div class="modal fade" id="modalYoyakuDone" tabindex="-1" role="dialog" aria-labelledby="modalYoyakuDoneLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalYoyakuDoneLabel">ご予約承りました。</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-6 center">
                <p class="display-3" >ご予約誠にありがとうございました。</p>
            </div>
        </div>
    </div>
</div>
@endif
