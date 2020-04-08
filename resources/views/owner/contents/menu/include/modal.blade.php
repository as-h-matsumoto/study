<div class="modal fade" id="addMenuToDateModal" tabindex="-1" role="dialog" aria-labelledby="addMenuToDateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMenuToDateModalLabel">予約スケジュールへメニューを追加する</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>作成したメニュー「<span id="addMenuToDateModalnewMenuName"></span>」を予約受付メニューにも追加しますか？</p>
                @if($content->service===15)
                <p class="pt-4">特定の日に追加する場合は「追加しない」を選択し、予約受付スケジュールから特定の日を選択してメニューを編集してください。</p>
                <p class="pt-4 text-info">今までランチメニューを設けていない場合で、ランチメニューに追加すると、ランチ時間に選択できるメニューは今回作成したメニューだけになりますのでご注意ください。</p>
                <div id="allAddTypeMenu" class="pt-4 center" style="display:none;">
                  <p class="pt-2"><button type="button" class="btn" data-dismiss="modal">追加しない</button></p>
                  <p class="pt-2"><button class="btn btn-outline-info" onClick="loading(); addMenuToDateDo(1);" ><strong>ランチメニュー、通常メニューに追加する</strong></button></p>
                  <p class="pt-2"><button class="btn btn-outline-info" onClick="loading(); addMenuToDateDo(3);" ><strong>通常メニューだけに追加する</strong></button></p>
                  <p class="pt-2"><button class="btn btn-outline-info" onClick="loading(); addMenuToDateDo(2);" ><strong>ランチメニューだけに追加する</strong></button></p>
                </div>
                @endif
                <div id="publicTypeMenu" class="pt-4 center" style="display:none;">
                  <p class="pt-2"><button type="button" class="btn" data-dismiss="modal">追加しない</button></p>
                  <p class="pt-2"><button class="btn btn-outline-info" onClick="loading(); addMenuToDateDo(3);" ><strong>追加する</strong></button></p>
                </div>
            </div>
            <input type="hidden" class="form-control" id="addMenuToDatemenuId" value="" >
        </div>
    </div>
</div>

<div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="warningModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="warningModalLabel">メニュー変更時の注意</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>メニューを正常に変更しました。</p>
                <p class="pt-4">ただし、このメニューは利用予定がございました。</p>
                <p class="pt-4 text-info">ご利用者様は変更前のメニューを期待しておりますので、もし、変更後の内容でサービスを提供する場合は、利用者に変更内容をご理解いただくようご対応お願いいたします。</p>
            </div>
        </div>
    </div>
</div>