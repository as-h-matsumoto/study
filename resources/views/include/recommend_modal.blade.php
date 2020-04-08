<div class="modal fade" id="modelThanksRecommend" tabindex="-1" role="dialog" aria-labelledby="modelThanksRecommendLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelThanksRecommendLabel">学習メモを追加しました。</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <p>学習メモは<a href="/account/recommend">こちら</a>から確認や編集ができます。</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modelRecommendPost" tabindex="-1" role="dialog" aria-labelledby="modelRecommendPostLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="modelRecommendPostLabel">学習メモ</h5>
                <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'recommendForm', 'name' => 'recommendForm', 'method' => 'post', 'class' => 'row', 'files'=> true)) !!}
                    <input type="hidden" id="recommendId" value="">

                    <div class="form-group col-sm-12">
                        <label for="recommend" class="form-control-label"><strong>メモ</strong></label>
                        <textarea max="3000" class="form-control form-control-lg" name="recommend" id="recommend" style="height:140px;"></textarea>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="row mb-2">
                          <div class="col-sm-12">
                            <label for="recommendPics" class="btn form-control-label f14 text-blue-700 float-left"><strong>参考図</strong></label>
                            <input accept="image/*" type="file" class="" id="recommendPics" name="recommendPics[]" multiple />
                            <span class=" pt-4" id="recommend_progress_bar"><span class="percent" style="padding:0px 60px;">0%</span></span>
                            <small class="f10">複数可</small>
                          </div>
                          <div id="recommendImagesArea" class="row p-2">
                          </div>
                          <div id="recommendNewImagesArea" class="row p-2">
                          </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="sub_name" class="form-control-label"><strong>引用名</strong></label>
                        <input id="sub_name" type="text" class="form-control form-control-lg" name="sub_name" />
                        <input id="sub_url" type="text" class="form-control form-control-lg" name="sub_url" />
                    </div>
                    
                    <div class="form-group col-sm-12">
                        <label for="description" class="form-control-label">重要度</label>
                        <div id="rateYo"></div>
                    </div>
                    
                    <input type="hidden" class="" name="table_name" id="table_name" value="" />
                    <input type="hidden" class="" name="table_id" id="table_id" value="" />
                    <input type="hidden" class="" name="table_type" id="table_type" value="" />
                    
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <span id="submitHtmlRecommend">
                <button class="btn btn-outline-info" onClick="loading(); postRecommend();" ><strong> メモ投稿</strong></button>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modelRecommendExists" tabindex="-1" role="dialog" aria-labelledby="modelRecommendExistsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelRecommendExistsLabel">既存の学習メモを編集できます。</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modelRecommendExistsMessage" class="modal-body" >
              <p>過去のメモ投稿したものを編集するか、新しくメモ投稿するか、ご選択ください。</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <a href="/account/recommend" ><button class="btn btn-outline-info"><strong> 編集</strong></button></a>
                <span id="modelRecommendExistsButton"></span>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modelRecommendPics" tabindex="-1" role="dialog" aria-labelledby="modelRecommendPicsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelRecommendPicsLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modelRecommendPicsBody" class="modal-body row" >
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modelRecommendDelete" tabindex="-1" role="dialog" aria-labelledby="modelRecommendDeleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelRecommendDeleteLabel">学習メモ削除</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modelRecommendPicsBody" class="modal-body" >
                <p>学習メモを削除します。一度削除すると元に戻すことはできません。</p>
            </div>

            <input type="hidden" class="form-control" id="recommend-id" value="" >

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <a href="javascript:void(0)" onclick="loading();deleteRecommendRecommend();return false;" >
                <button type="button" class="btn">削除</button>
                </a>
            </div>
        </div>
    </div>
</div>

