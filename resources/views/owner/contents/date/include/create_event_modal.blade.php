<div class="modal fade" id="modalCreateEvent" tabindex="-1" role="dialog" aria-labelledby="modalCreateEventLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateEvent">@if($content->service===91){!!'面接受付登録'!!}@else{!!'予約受付登録'!!}@endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'createEventForm', 'name' => 'createEventForm', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}



                <div class="form-group col-6 pr-0">
                    <label for="createEventFormstartDate" class="form-control-label text-info">開始日</label>
                    <input class="form-control form-control-lg" type="date" value="" name="startDate" id="createEventFormstartDate" step="1500" style="width:100%" />
                </div>
                <div class="form-group col-6">
                    <label for="createEventFormstartTime" class="form-control-label text-info">開始時間</label>
                    <input class="form-control form-control-lg" type="time" value="" name="startTime" id="createEventFormstartTime" step="1500" style="width:100%" />
                </div>

                @if($content->service===91)
                <div class="form-group col-6 pr-0">
                    <label for="createEventFormendDate" class="form-control-label text-info">終了日</label>
                    <input class="form-control form-control-lg" type="date" value="" name="endDate" id="createEventFormendDate" step="1500" style="width:100%" />
                </div>
                <div class="form-group col-6">
                    <label for="createEventFormendTime" class="form-control-label text-info">終了時間</label>
                    <input class="form-control form-control-lg" type="time" value="" name="endTime" id="createEventFormendTime" step="1500" style="width:100%" />
                </div>
                @endif

@if($content->service===69)
<div class="form-group col-sm-6">
    <label for="createEventFormto_tour" class="form-control-label text-info mb-6">目的地エリア</label>
    <select class="custom-select" name="createEventFormto_tour" id="createEventFormto_tour" style="width:100%" >
        @foreach(Util::getCountryAreasJp() as $town)
        <option value="{!!$town->ken_id!!}">{!!$town->name!!}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-sm-6">
    <label for="createEventFormfrom_tour" class="form-control-label text-info mb-6">出発地エリア</label>
    <select class="custom-select" name="createEventFormfrom_tour" id="createEventFormfrom_tour" style="width:100%" >
        <option value="0">現地集合</option>
        @foreach(Util::getCountryAreasJp() as $town)
        <option value="{!!$town->ken_id!!}">{!!$town->name!!}</option>
        @endforeach
    </select>
</div>
@endif

<div class="form-group col-sm-12">
    <label for="createEventFormregularly" class="form-control-label text-info">開催間隔</label>
    <select class="custom-select" name="createEventFormregularly" id="createEventFormregularly" style="width:100%" >
        <option value="1">一度だけ</option>
        <option value="2">毎週</option>
        <option value="3">平日</option>
        <option value="4">毎日</option>
    </select>
</div>

@if( !($content->service===91) )
<!-- menus -->
<div class="form-group col-sm-12">
    <label for="" class="form-control-label text-info">{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}メニュー選択</label>
    <div id="createEventFormMenuArea" class="row pt-1">
    </div>
</div>
@endif

@if($content->service===91)
<!-- capacities -->
<div class="form-group col-sm-12">
    <label for="" class="form-control-label text-info">{!!UtilYoyaku::getNewContentCapacity($content->service)!!}選択</label>
    <div id="createEventFormCapacityArea" class="row pt-1">
    </div>
</div>
@endif

<div class="form-group col-sm-12">
    <label for="createEventFormdescription" class="form-control-label">
        @if($content->service===62){!!'レッスン内容'!!}
        @elseif($content->service===69){!!'ツアー内容'!!}
        @elseif($content->service===101){!!'チケット内容'!!}
        @elseif($content->service===91){!!'面接スケジュール'!!}
        @endif
        {!!'詳細'!!}</label>
    <textarea max="2000" class="form-control form-control-lg" name="createEventFormdescription" id="createEventFormdescription"></textarea>
    @if($content->service===91)<span>面接会場への行きかた、当日のスケジュールなどを記載してください。</span>@endif
</div>

@if( !($content->service===91) )
<div class="form-group col-sm-12">
    <label for="createEventFormpayment" class="form-control-label text-info">支払い設定</label>
    <select class="custom-select" name="createEventFormpayment" id="createEventFormpayment" style="width:100%" >
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
@endif
                    
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button id="postCreateEvent" class="btn btn-outline-info" ><strong>予約受付開始</strong></button>
            </div>
        </div>
    </div>
</div>

