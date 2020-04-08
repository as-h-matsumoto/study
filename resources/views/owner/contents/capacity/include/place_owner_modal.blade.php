<style>
  #placeOwner_progress_bar {
    margin: 10px 0;
    padding: 3px;
    border: 1px solid #000;
    font-size: 14px;
    clear: both;
    opacity: 0;
    -moz-transition: opacity 1s linear;
    -o-transition: opacity 1s linear;
    -webkit-transition: opacity 1s linear;
  }
  #placeOwner_progress_bar.loading {
    opacity: 1.0;
  }
  #placeOwner_progress_bar .percent {
    background-color: #99ccff;
    height: auto;
    width: 0;
  }
</style>

<div class="modal fade" id="placeOwnerModal" tabindex="-1" role="dialog" aria-labelledby="placeOwnerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="placeOwnerModalLabel">所在地</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'placeOwnerForm', 'name' => 'placeOwnerForm', 'method' => 'post', 'class' => ' ', 'files'=> false)) !!}
            <div class="form-group">
                <input class="form-control form-control-lg" type="text" value="name" name="name" id="placeOwnerFormName"/>
                <label for="placeOwnerFormName">所在地名</label>
            </div>
            <div class="form-group">
                <input class="form-control form-control-lg" type="number" value="" name="parking" id="placeOwnerFormParking" min="0" />
                <label for="placeOwnerFormParking">専用パーキング台数</label>
            </div>
            <div class="form-group">
                <textarea max="3000" class="form-control form-control-lg" name="description" id="placeOwnerFormBaseComment"></textarea>
                <label for="placeOwnerFormBaseComment" class="form-control-label">所在地の説明</label>
            </div>

<div class="form-group">
    <div class="row mb-2">
      <div class="col-sm-6">
        <label for="placeOwnerFormPic" class="btn form-control-label f14 text-blue-700 float-left mr-6"><strong>写真アップ</strong></label>
        <input accept="image/*" type="file" class="" id="placeOwnerFormPic" name="pic" />
        <span class="pt-4 mt-4" id="placeOwner_progress_bar"><span class="percent" style="padding:0px 100px;">0%</span></span>
      </div>
      <div id="Ownerpreview" class="col-sm-6">
        <img src="" style="width:120px;" />
      </div>
    </div>
</div>


            </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); postPlaceOwner();" ><strong>登録</strong></button>
           </div>
        </div>
    </div>
</div>