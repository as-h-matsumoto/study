<div class="modal fade" id="modelThanksMessage" tabindex="-1" role="dialog" aria-labelledby="modelThanksMessageLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelThanksMessageLabel">メッセージを送りました。</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <p>メッセージの内容や返答は<a class="text-info" href="/account/messages" >こちら</a>からご確認いただけます。</p>
            </div>
        </div>
    </div>
</div>

@if(isset($content))
<div class="modal fade" id="modelMessagePost" tabindex="-1" role="dialog" aria-labelledby="modelMessagePostLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="modelMessagePostLabel">{!!$content->name!!}へメッセージ</h5>
                <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'messageForm', 'name' => 'messageForm', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}
                    <input type="hidden" name="content_id" value="{!!$content->id!!}">

                    @if(Auth::check() and Auth::user()->id===1)
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="all_users" value="1"/>
                            <span class="checkbox-icon"></span>
                            <span class="form-check-description">all_users</span>
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="all_owners" value="1"/>
                            <span class="checkbox-icon"></span>
                            <span class="form-check-description">all_owners</span>
                        </label>
                    </div>
                    @endif

                    <div class="form-group col-sm-12">
                        <label for="message" class="form-control-label"><strong>メッセージ</strong></label>
                        <textarea max="2000" class="form-control form-control-lg" name="message" id="message" style="height:140px;"></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); postMessage();" ><strong>{!!Util::getIcon('add','s-4','green')!!} 送信</strong></button>
            </div>
        </div>
    </div>
</div>
@endif

<div class="modal fade" id="modelMessageDelete" tabindex="-1" role="dialog" aria-labelledby="modelMessageDeleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelMessageDeleteLabel">投稿削除</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <p>選択したメッセージを削除します。</p>
                <p>削除したメッセージは二度と見ることはできません。</p>
                <p>問題なければ削除を選択してください。</p>
            </div>

            <input type="hidden" class="form-control" id="recommend-id" value="" >

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <a href="javascript:void(0)" class="btn" onclick="loading();messageDelete();return false;" >
                  削除
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalMessageUp" tabindex="-1" role="dialog" aria-labelledby="modalMessageUpLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMessageUpLabel">メッセージ詳細</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div id="userArea">

              </div>
              <div id="messageArea">

              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">閉じる</button>
                <span id="messageReplyArea">
                </span>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modelMessageReply" tabindex="-1" role="dialog" aria-labelledby="modelMessageReplyLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="modelMessageReplyLabel">メッセージ返信</h5>
                <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="userAreaReply">

                </div>
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'messageReplyForm', 'name' => 'messageReplyForm', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}
                    <input type="hidden" name="user_id" id="messageReply_user_id" value="">

                    <div class="form-group col-sm-12">
                        <label for="message" class="form-control-label"><strong>メッセージ</strong></label>
                        <textarea max="2000" class="form-control form-control-lg" name="message" id="message" style="height:140px;"></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); postMessageReply();" ><strong>{!!Util::getIcon('add','s-4','green')!!} 送信</strong></button>
            </div>
        </div>
    </div>
</div>


@if(Auth::check() and Auth::user()->owner===1)
<div class="modal fade" id="upMessageOwnerToAdminModal" tabindex="-1" role="dialog" aria-labelledby="upMessageOwnerToAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="upMessageOwnerToAdminModal">お問合せ</h5>
                <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'modelOwnerToAdminMessageFrom', 'name' => 'modelOwnerToAdminMessageFrom', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}
                    <div class="form-group col-sm-12">
                        <label for="message" class="form-control-label"><strong>お問合せ内容</strong></label>
                        <textarea max="2000" class="form-control form-control-lg" name="message" id="ownerToAdminMessagemessage" style="height:140px;"></textarea>
                    </div>
                </form>
                <p>ご質問、お問い合わせはこちらからご連絡ください。</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); postOwnerToAdminMessage();" ><strong>{!!Util::getIcon('add','s-4','green')!!} 送信</strong></button>
            </div>
        </div>
    </div>
</div>
@endif



@if(Auth::check())
<div class="modal fade" id="upMessageCustomerToAdminModal" tabindex="-1" role="dialog" aria-labelledby="upMessageCustomerToAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="upMessageCustomerToAdminModal">お問合せ</h5>
                <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'modelCustomerToAdminMessageFrom', 'name' => 'modelCustomerToAdminMessageFrom', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}
                    <div class="form-group col-sm-12">
                        <label for="message" class="form-control-label"><strong>お問合せ内容</strong></label>
                        <textarea max="2000" class="form-control form-control-lg" name="message" id="customerToAdminMessagemessage" style="height:140px;"></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); postCustomerToAdminMessage();" ><strong>{!!Util::getIcon('add','s-4','green')!!} 送信</strong></button>
            </div>
        </div>
    </div>
</div>
@endif