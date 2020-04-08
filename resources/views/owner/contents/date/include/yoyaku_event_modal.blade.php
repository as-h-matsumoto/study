<style>
.table.table-hover tbody tr th{
    min-width: 70px !important;
    color: #009688;
}
</style>
@if($content->service===91)
<div class="modal fade" id="modalEvent" tabindex="-1" role="dialog" aria-labelledby="modalEventLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalEventLabel">面接予約者情報</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body table-div p-0">

                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th scope="row">面接<br />日時</th>
                            <td id="startEnd" class="center"></td>
                        </tr>
                        <tr>
                            <th scope="row">面接<br />予約ID</th>
                            <td id="yoyakuId" class="center"></td>
                        </tr>
                        <tr>
                            <th scope="row">面接<br />者様</th>
                            <td id="username" class="center"></td>
                        </tr>
                        <tr class="mr-4">
                            <td colspan="2" id="selectMenusAndCapacities" class="p-0" ></td>
                        </tr>
                    </tbody>
                </table>

                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'modalEventForm', 'name' => 'modalEventForm', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}
                
                    <input type="hidden" name="content_date_user_id" id="modalEventFormcontent_date_user_id" value="">

                </form>
                
            </div>
            
            <div class="modal-footer">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <a id="goinYoyakuCancelOwner" onClick="goinYoyakuCancelOwner()" href="#yoyakuCancelOwner" class="btn" style="display:none;" ><strong>面接予約キャンセル</strong></a>
                <a onClick="goinMessageOwner()"  href="#messageOwner" class="btn btn-outline-info" ><strong>メッセージ</strong></a>
                <button id="onUser"  onClick="onOffUser()" class="btn btn-info" style="display:none;" ><strong>未受付</strong></button>
                <button id="offUser" onClick="onOffUser()" class="btn" style="display:none;" ><strong>受付済</strong></button>
            </div>

            <div id="messageOwner" style="display:none;">
                <div class="modal-body">
                    {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'messageOwnerForm', 'name' => 'messageOwnerForm', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}
                        <input type="hidden" name="user_id" id="to_user_id" value="">
                        <div class="form-group col-sm-12">
                            <label for="message" class="form-control-label">メッセージ</label>
                            <textarea max="2000" class="form-control form-control-lg" name="message" id="message" style="height:140px;"></textarea>
                            <span class="f11">メッセージとEmailが送信されます。</span>
                        </div>
                    </form>
                </div>
    
                <div class="modal-footer">
                    <button onClick="cancelMessageOwner()" type="button" class="btn">メッセージ送付をやめる</button>
                    <button class="btn btn-info" onClick="loading(); postMessageOwner();" ><strong>{!!Util::getIcon('add','s-4','green')!!} 送信</strong></button>
                </div>
            </div>

            <div id="yoyakuCancelOwner" style="display:none;">
                <div class="modal-body">
                    {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'yoyakuCancelOwnerForm', 'name' => 'yoyakuCancelOwnerForm', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}
                        <input type="hidden" name="user_id" id="to_user_id" value="">
                        <div class="form-group col-sm-12">
                            <label for="message" class="form-control-label">面接予約キャンセル理由</label>
                            <textarea max="2000" class="form-control form-control-lg" name="message" id="cancelMessage" style="height:140px;"></textarea>
                        </div>
                    </form>
                </div>
    
                <div class="modal-footer">
                    <button onClick="cancelYoyakuCancelOwner()" type="button" class="btn">面接予約キャンセルをやめる</button>
                    <button class="btn btn-info" onClick="loading(); postYoyakuCancelOwner();" ><strong>{!!Util::getIcon('add','s-4','green')!!} 送信</strong></button>
                </div>
            </div>

        </div>
    </div>
</div>




@else




<div class="modal fade" id="modalEvent" tabindex="-1" role="dialog" aria-labelledby="modalEventLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEventLabel">予約者情報</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div id="modalEventYoyakuView" >
            <div class="modal-body table-div p-0">

<table class="table table-hover">
    <tbody>
        <tr>
            <th scope="row">ご利用<br />日時</th>
            <td id="startEnd" class="center"></td>
        </tr>
        <tr>
            <th scope="row">予約ID</th>
            <td id="yoyakuId" class="center"></td>
        </tr>
        <tr>
            <th scope="row">ご利用<br />者様</th>
            <td id="username" class="center"></td>
        </tr>
        <tr>
            <th scope="row">ご利用<br />人数</th>
            <td id="joinnumber" class="center"></td>
        </tr>
        @if($content->service===39 or $content->service===85 or $content->service===89)
        <tr>
            <th scope="row">ご利用<br />時間</th>
            <td id="usetime" class="center"></td>
        </tr>
        @endif
        @if($content->service===15)
        <tr>
            <th scope="row">ご利用<br />条件</th>
            <td id="usermust" class="center"></td>
        </tr>
        @endif
        <tr>
            <th scope="row">料金</th>
            <td id="payment" class="center"></td>
        </tr>
        <tr class="mr-4">
            <td colspan="2" id="selectMenusAndCapacities" class="p-0" ></td>
        </tr>
    </tbody>
</table>

                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'modalEventForm', 'name' => 'modalEventForm', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}
                
                <input type="hidden" name="content_date_user_id" id="modalEventFormcontent_date_user_id" value="">
                    
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <a id="goinYoyakuCancelOwner" onClick="goinYoyakuCancelOwner()" href="#yoyakuCancelOwner" class="btn btn-primary px-2" style="display:none;" ><strong>予約キャンセル</strong></a>
                <a onClick="goinMessageOwner()"  href="#messageOwner" class="btn btn-outline-info px-2" ><strong>メッセージ</strong></a>
                <button id="onUser"  onClick="onOffUser()" class="btn btn-info px-2" style="display:none;" ><strong>未受付</strong></button>
                <button id="offUser" onClick="onOffUser()" class="btn btn-header bg-grey-200 px-2" style="display:none;" ><strong>受付済</strong></button>
            </div>

            <div id="messageOwner" style="display:none;">
                <div class="modal-body">
                    {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'messageOwnerForm', 'name' => 'messageOwnerForm', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}
                        <input type="hidden" name="user_id" id="to_user_id" value="">
                        <div class="form-group col-sm-12">
                            <label for="message" class="form-control-label">メッセージ</label>
                            <textarea max="2000" class="form-control form-control-lg" name="message" id="message" style="height:140px;"></textarea>
                        </div>
                    </form>
                </div>
    
                <div class="modal-footer">
                    <button onClick="cancelMessageOwner()" type="button" class="btn">メッセージ送付をやめる</button>
                    <button class="btn btn-info" onClick="loading(); postMessageOwner();" ><strong>{!!Util::getIcon('add','s-4','green')!!} 送信</strong></button>
                </div>
            </div>

            <div id="yoyakuCancelOwner" style="display:none;">
                <div class="modal-body">
                    {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'yoyakuCancelOwnerForm', 'name' => 'yoyakuCancelOwnerForm', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}
                        <input type="hidden" name="user_id" id="to_user_id" value="">
                        <div class="form-group col-sm-12">
                            <label for="message" class="form-control-label">予約キャンセル理由</label>
                            <textarea max="2000" class="form-control form-control-lg" name="message" id="cancelMessage" style="height:140px;"></textarea>
                        </div>
                    </form>
                </div>
    
                <div class="modal-footer">
                    <button onClick="cancelYoyakuCancelOwner()" type="button" class="btn">予約キャンセルをやめる</button>
                    <button class="btn btn-info" onClick="loading(); postYoyakuCancelOwner();" ><strong>{!!Util::getIcon('add','s-4','green')!!} 送信</strong></button>
                </div>
            </div>

        </div>
    </div>
</div>
@endif
