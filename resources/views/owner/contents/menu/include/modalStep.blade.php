
<?php
switch (UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
  case 'lesson': $title_name = 'ステップ'; break;
  case 'tour': $title_name = 'スケジュール'; break;
  case 'ticket': $title_name = 'Gポイント'; break;
}
?>



<div class="form-group col-sm-12">
    <label for="title" class="form-control-label">{!!$title_name!!}タイトル</label>
    <input type="text" max="40" class="form-control form-control-lg" name="title" id="stepTitle">
</div>

<div class="form-group col-sm-12">
    <label for="description" class="form-control-label">{!!$title_name!!}詳細</label>
    <textarea max="1000" class="form-control form-control-lg" name="description" id="stepDescription"></textarea>
</div>

<div class="form-group col-sm-12 center">
    <div class="row mb-2">
      <div class="col-sm-6">
        <label for="stepFormPic" class="btn form-control-label f14 text-blue-700"><strong>{!!$title_name!!}写真アップ</strong></label>
        <input accept="image/*" type="file" class="" id="stepFormPic" name="pic" />
        <br /><span class="pt-4 mt-4" id="menu_step_progress_bar"><span class="percent" style="padding:0px 50px;">0%</span></span>
      </div>
      <div id="steppreview" class="col-sm-6">
        <img src="" style="width:120px;" />
      </div>
    </div>
</div>