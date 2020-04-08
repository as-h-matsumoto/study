
<div class="modal fade" id="modelmemoRegi" tabindex="-1" role="dialog" aria-labelledby="modelmemoRegiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="modelmemoRegiLabel">memo登録</h5>
                <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'memoRegiForm', 'name' => 'memoRegiForm', 'method' => 'post', 'class' => 'row', 'files'=> true)) !!}
                    <input type="hidden" id="memo-part-id" value="">

                    <div class="form-group col-sm-12">
                        <label for="recommend" class="form-control-label"><strong>めも</strong></label>
                        <textarea id="memo" class="form-control form-control-lg" name="memo" style="height:200px;"></textarea>
                    </div>
                    
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); memoRegi();" ><strong> 登録</strong></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modelwikiRegi" tabindex="-1" role="dialog" aria-labelledby="modelwikiRegiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="modelwikiRegiLabel">wiki登録</h5>
                <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'wikiRegiForm', 'name' => 'wikiRegiForm', 'method' => 'post', 'class' => 'row', 'files'=> true)) !!}
                    <input type="hidden" id="wiki-part-id" value="">

                    <div class="form-group col-sm-12">
                        <label for="recommend" class="form-control-label"><strong>名前</strong></label>
                        <input id="name" type="text" class="form-control form-control-lg" name="name" />
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="recommend" class="form-control-label"><strong>url</strong></label>
                        <input id="url" type="text" class="form-control form-control-lg" name="url" />
                    </div>
                    
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); wikiRegi();" ><strong> 登録</strong></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modelliteratureRegi" tabindex="-1" role="dialog" aria-labelledby="modelliteratureRegiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="modelliteratureRegiLabel">引用登録</h5>
                <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'literatureRegiForm', 'name' => 'literatureRegiForm', 'method' => 'post', 'class' => 'row', 'files'=> true)) !!}
                    <input type="hidden" id="literature-part-id" value="">
                    <div class="form-group col-sm-12">
                        <label class="form-control-label"><strong>名前</strong></label>
                        <input id="name" type="text" class="form-control form-control-lg" name="name" />
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="form-control-label"><strong>url</strong></label>
                        <input id="url" type="text" class="form-control form-control-lg" name="url" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); literatureRegi();" ><strong> 登録</strong></button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modelsummaryRegi" tabindex="-1" role="dialog" aria-labelledby="modelsummaryRegiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="modelsummaryRegiLabel">summary登録</h5>
                <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'summaryRegiForm', 'name' => 'summaryRegiForm', 'method' => 'post', 'class' => 'row', 'files'=> true)) !!}
                    <input type="hidden" id="summary-part-id" value="">
                    <div class="form-group col-sm-12">
                        <label class="form-control-label"><strong>まとめ</strong></label>
                        <textarea id="summary" class="form-control form-control-lg" name="summary" style="height:200px;"></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); summaryRegi();" ><strong> 登録</strong></button>
            </div>
        </div>
    </div>
</div>
