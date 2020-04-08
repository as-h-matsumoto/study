<div class="modal fade" id="modalFirstContentDate" tabindex="-1" role="dialog" aria-labelledby="modalFirstContentDateLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFirstContentDateLabel">初期予約受付スケジュール登録</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'firstContentDateForm', 'name' => 'firstContentDateForm', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}






<div class="form-group col-sm-12">
    <label for="FirstContentDateFormstart" class="form-control-label text-info">ご予約受付け開始日:</label>
    <input class="form-control form-control-lg" type="date" value="" name="FirstContentDateFormstart" id="FirstContentDateFormstart" min="1" />
</div>
<div class="form-group col-sm-12">
    <label for="calendar" class="form-control-label text-info">営業日カレンダー登録:</label>
    <div class="form-check form-check-inline">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="FirstContentDateFormcalendar" id="FirstContentDateFormcalendar" value="1" checked />
            <span class="checkbox-icon"></span>
            <span class="form-check-description">会社営業カレンダーにあわせる</span>
        </label>
    </div>
    <div id="FirstContentDateFormCalendarArea" class="pt-1">
          <div class="box_title bg-blue-grey-50 text-auto"><strong><span class="help-block">会社営業時間と異なる場合は、チェックをはずし、営業時間を変更してください。</span>@if($content->service===81)<br /><span class="help-block">開始・終了はチェックイン・チェックアウト時間を登録してください。</span>@endif</strong></div>
          <div class="box_srcollbar row" style="margin:0 0px;">
          @include('owner/contents/date/include/openClose_modal')
          </div>
    </div>
</div>


<div class="col-sm-12">
<span class="help-block text-danger">※以下の内容は、後から日にちごとに変更できます。</span>
</div>

<!-- menus -->
@if($content->service===15)
<div class="form-group col-sm-12">
    <label for="" class="form-control-label text-info">メニュー選択:ランチメニューと通常メニューを分けますか？</label>
    <select class="custom-select" name="FirstContentDateFormMenuTypeSelect" id="FirstContentDateFormMenuTypeSelect" style="width:100%" >
        <option value="1">分けない</option>
        <option value="2">分ける</option>
    </select>
    <div id="FirstContentDateFormMenuAreaPublic" class="row pt-1">
    </div>
    <div id="FirstContentDateFormMenuAreaLunch" class="row pt-1">
    </div>
    <span class="help-block text-danger">※:ランチメニューと通常メニューを分け他としても提供数はスケジュール単位となります。昼と夜の営業を分けた場合は提供数も分かれますが、10:00~23:00営業のように続けて営業するする場合提供数は分かれません。</span>
</div>
@elseif($content->service===39 or $content->service===85 or $content->service===89)
@else
<div class="form-group col-sm-12">
    <label for="" class="form-control-label text-info">メニュー選択</label>
    <div id="FirstContentDateFormMenuAreaPublic" class="row pt-1">
    </div>
</div>
@endif

<!-- capacities -->
@if( !($content->service===69 or $content->service===101) )
<div class="form-group col-sm-12">
    <label for="" class="form-control-label text-info">{!!UtilYoyaku::getNewContentCapacity($content->service)!!}選択</label>
    <div id="FirstContentDateFormCapacityAreaPublic" class="row pt-1">
    </div>
    <span class="help-block text-danger">※{!!UtilYoyaku::getNewContentCapacity($content->service)!!}は、登録した数より多くできません。<a class="text-info" target="_blank" href="/owner/contents/{!!$content->id!!}/capacity/edit">{!!UtilYoyaku::getNewContentCapacity($content->service)!!}を変更ください。</a></span>
</div>
@endif

<div class="form-group col-sm-12">
    <label for="FirstContentDateFormpayment" class="form-control-label text-info">支払い設定</label>
    <select class="custom-select" name="FirstContentDateFormpayment" id="FirstContentDateFormpayment" style="width:100%" >
        <option value="">選択してください。</option>
        @if($owner_pay_status)<option value="1">ネット決済利用</option>@endif
        <option value="2">予約受付のみ</option>
    </select>
    <br />
    <span class="help-block">
        <!-- オーナー登録後、3ヶ月間は「予約受付のみ」となります。<br /> -->
        「予約受付のみ」を選択した場合、いつキャンセルになったとしてもキャンセル料は発生しません。<br />
        機会損失を防ぐためにも「ネット決済」を推奨いたします。
    </span>
</div>

<div class="form-group col-sm-12">
    <label for="" class="form-control-label text-info">同意事項</label>
    <p>「<a class="text-info" target="_blank" href="/cmn/terms">利用規約</a>」「<a class="text-info" target="_blank" href="/yoyaku/cmn/terms/owner">オーナー様向け利用規約</a>」をご確認ください。</p>
    <div class="form-check form-check-inline mt-2">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="anderstand" id="anderstand" value="1" />
            <span class="checkbox-icon"></span>
            <span class="form-check-description">上記「利用規約」「オーナー様向け利用規約」の内容を確認しましたので同意します。</span>
        </label>
    </div>
</div>





                    
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button id="postFirstContentDate" class="btn btn-outline-info" ><strong>予約受付開始</strong></button>
            </div>
        </div>
    </div>
</div>

