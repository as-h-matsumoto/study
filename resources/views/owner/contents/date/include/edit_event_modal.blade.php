<div class="modal fade" id="modalEvent" tabindex="-1" role="dialog" aria-labelledby="modalEventLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEventLabel">@if($content->service===91){!!'面接受付編集'!!}@else{!!'予約受付編集'!!}@endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'modalEventForm', 'name' => 'modalEventForm', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}

                @if( !($content->service===91) )
                <div class="form-group col-sm-6">
                    <label for="modalEventFormstatus" class="form-control-label text-info">予約受付状況</label>
                    <select class="custom-select mt-5" name="status" id="modalEventFormstatus" style="width:100%" >
                        <option value=>変更しない</option>
                        @foreach(Util::getContentDateStatus(null,'name',null) as $key=>$val)
                        @if( $key===5 or $key===7 or $key===8 )
                        <option value="{!!$key!!}">{!!$val!!}</option>
                        @endif
                        @endforeach
                    </select>
                    <br />
                    <span class="f14">現在 ：<span id="nowStatus" ></span></span><br />
                    <span>予約受付状況はシステムが適切なステータスに変更してくれます。</span>
                    <span>一度ステータスを変更してしまうと元に戻せません。</span>
                </div>
                <div class="form-group col-sm-6">
                    <label for="modalEventFormpercent" class="form-control-label text-info">割引／割増設定:</label>
                    <input class="form-control form-control-lg center" type="number" value="" name="percent" id="modalEventFormpercent" max="500" min="1" />
                    <span class="help-block">例：120(20％増し), 400(20%引き)</span>
                </div>
                @endif
                
                <div class="form-group col-6 pr-0">
                    <label for="modalEventFormstartDate" class="form-control-label text-info">開始日</label>
                    <input class="form-control form-control-lg" type="date" value="" name="startDate" id="modalEventFormstartDate" step="1500" style="width:100%" />
                </div>
                <div class="form-group col-6">
                    <label for="modalEventFormstartTime" class="form-control-label text-info">開始時間</label>
                    <input class="form-control form-control-lg" type="time" value="" name="startTime" id="modalEventFormstartTime" step="1500" style="width:100%" />
                </div>
                <div class="form-group col-6 pr-0">
                    <label for="modalEventFormendDate" class="form-control-label text-info">終了日</label>
                    <input class="form-control form-control-lg" type="date" value="" name="endDate" id="modalEventFormendDate" step="1500" style="width:100%" />
                </div>
                <div class="form-group col-6">
                    <label for="modalEventFormendTime" class="form-control-label text-info">終了時間</label>
                    <input class="form-control form-control-lg" type="time" value="" name="endTime" id="modalEventFormendTime" step="1500" style="width:100%" />
                </div>

@if($content->service===69)
<div class="form-group col-sm-6">
    <label for="modalEventFormto_tour" class="form-control-label text-info mb-6">目的地エリア</label>
    <select class="custom-select" name="modalEventFormto_tour" id="modalEventFormto_tour" style="width:100%" >
        @foreach(Util::getCountryAreasJp() as $town)
        <option id="totour{!!$town->ken_id!!}" value="{!!$town->ken_id!!}" >{!!$town->name!!}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-sm-6">
    <label for="modalEventFormfrom_tour" class="form-control-label text-info mb-6">出発地エリア</label>
    <select class="custom-select" name="from_tour" id="modalEventFormfrom_tour" style="width:100%" >
        <option value="0">現地集合</option>
        @foreach(Util::getCountryAreasJp() as $town)
        <option id="fromtour{!!$town->ken_id!!}" value="{!!$town->ken_id!!}">{!!$town->name!!}</option>
        @endforeach
    </select>
</div>
@endif

<!-- menus -->
@if($content->service===15)
<div class="form-group col-sm-12">
    <div id="modalEventFormMenuAreaPublic" class="row pt-1">
    </div>
    <div id="modalEventFormMenuAreaLunch" class="row pt-1">
    </div>
</div>
@elseif($content->service===39 or $content->service===85 or $content->service===89 or $content->service===91 )
@else
<div class="form-group col-sm-12">
    <label for="" class="form-control-label text-info">メニュー選択</label>
    <div id="modalEventFormMenuAreaPublic" class="row pt-1">
    </div>
</div>
@endif

@if( !($content->service===62) )
<!-- capacities -->
<div class="form-group col-sm-12">
    <label for="" class="form-control-label text-info">{!!UtilYoyaku::getNewContentCapacity($content->service)!!}選択</label>
    <div id="modalEventFormCapacityAreaPublic" class="row pt-1">
    </div>
    <span class="help-block text-danger">※{!!UtilYoyaku::getNewContentCapacity($content->service)!!}は、登録した数より多くできません。<a class="text-info" target="_blank" href="/owner/contents/{!!$content->id!!}/capacity/edit">{!!UtilYoyaku::getNewContentCapacity($content->service)!!}を変更ください。</a></span>
</div>
@endif

@if($content->service===62 or $content->service===69 or $content->service===101 or $content->service===91)
<div class="form-group col-sm-12">
    <label for="modalEventFormdescription" class="form-control-label">
        @if($content->service===62){!!'レッスン内容'!!}
        @elseif($content->service===69){!!'ツアー内容'!!}
        @elseif($content->service===101){!!'チケット内容'!!}
        @elseif($content->service===91){!!'面接スケジュール'!!}
        @endif
    </label>
    <textarea max="2000" class="form-control form-control-lg" name="description" id="modalEventFormdescription"></textarea>
</div>
@endif

@if( !($content->service===91) )
<div class="form-group col-sm-12">
    <label for="modalEventFormpayment" class="form-control-label text-info">支払い設定</label>
    <select class="custom-select" name="payment" id="modalEventFormpayment" style="width:100%" >
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

@endif
                
                <input type="hidden" name="content_date_id" id="modalEventFormcontent_date_id" value="">
                    
                </form>
            </div>
            <div class="modal-footer">
                <a id="deleteModalEvent" href="javascript:void(0)" class="btn" ><strong>{!!Util::getIcon('delete','s-4','grey')!!} 削除</strong></a>
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button id="postModalEvent" class="btn btn-outline-info" ><strong>編集</strong></button>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="deleteModalEventRelation" tabindex="-1" role="dialog" aria-labelledby="deleteModalEventRelationLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalEventRelationLabel">関連するスケジュールの削除</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body py-6">
            <p>
            このスケジュールと一緒に作成したその他のスケジュールも削除しますか？<br />
            ※ご予約者がいる場合は、対象のスケジュールを削除せずにスキップします。
            </p>
            {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'deleteModalEventRelationForm', 'name' => 'deleteModalEventRelationForm', 'method' => 'post', 'class' => '', 'files'=> false)) !!}
            <input type="hidden" name="deleteModalEventFormcontent_date_create_number" id="deleteModalEventFormcontent_date_create_number" value="">
            
            </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <a id="postDeleteEventRelation" href="javascript:void(0)" class="btn" ><strong>削除</strong></a>
            </div>
        </div>
    </div>
</div>