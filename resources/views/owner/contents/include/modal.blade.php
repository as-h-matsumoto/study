<div class="modal fade" id="modalContentDeleteConfirm" tabindex="-1" role="dialog" aria-labelledby="modalContentDeleteConfirmLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalContentDeleteConfirmLabel">{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}コンテンツ削除</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalContentDeleteConfirmMessage">
            <p>
            本当に「{!!$content->name!!}」を削除しますか？<br />
            削除すると二度と閲覧できなくなりデータは消滅します。
            </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                {!! Form::open(array('url' => '/owner/contents/'.$content->id.'/delete', 'name' => 'deleteAction', 'method' => 'post', 'class' => ' ', 'files'=> false)) !!}
                <input type="hidden" name="delete_content_id" id="delete_content_id" >
                <a href="javascript:void(0)" class="btn" onclick="loading();document.deleteAction.submit();return false;" >
                    <strong class="text-grey-800">削除</strong>
                </a>
                </form>
            </div>
        </div>
    </div>
</div>