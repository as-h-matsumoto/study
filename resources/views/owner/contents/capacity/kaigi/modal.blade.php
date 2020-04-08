<?php /*
CapacityFormname
CapacityFormtype
CapacityFormprice
CapacityFormarea
CapacityFormheight
CapacityFormnumber
CapacityFormdescription
CapacityFormpic
*/ ?>
<div class="form-group col-12 mt-4">
    <label for="CapacityFormname" class="form-control-label"><i class="icon icon-star text-red-700"></i> 会議室名</label>
    <input class="form-control" type="text" value="" name="name" id="CapacityFormname" />
</div>
<div class="form-group col-4">
    <label for="CapacityFormarea" class="form-control-label"><i class="icon icon-star text-red-700"></i> 平米数</label>
    <input class="form-control form-control-lg center" type="number" value="" name="area" id="CapacityFormarea" min="1" />
</div>
<div class="form-group col-4">
    <label for="CapacityFormheight" class="form-control-label"><i class="icon icon-star text-red-700"></i> 高さ(cm)</label>
    <input class="form-control form-control-lg center" type="number" value="" name="height" id="CapacityFormheight" min="1" />
</div>
<div class="form-group col-4">
    <label for="CapacityFormperson" class="form-control-label"><i class="icon icon-star text-red-700"></i> 許容人数</label>
    <input class="form-control form-control-lg center" type="number" value="" name="person" id="CapacityFormperson" min="1" />
</div>
<div id="timeArea" class="form-group col-4 pl-1 center">
    <label for="CapacityFormtime" class="form-control-label"><i class="icon icon-star text-red-700"></i> 料金計算(分)</label>
    <input class="form-control form-control-lg center" type="number" value="" name="time" id="CapacityFormtime" min="1" />
</div>
<div class="form-group col-8">
    <label for="CapacityFormprice" class="form-control-label"><i class="icon icon-star text-red-700"></i> 料金<span id="priceTime" class="f10"></span></label>
    <input class="form-control form-control-lg center" type="number" value="" name="price" id="CapacityFormprice" min="1" />
</div>
<div class="form-group col-8 mb-0 pb-0">
    <label for="CapacityFormnumber" class="form-control-label">室数</label>
    <input class="form-control form-control-lg center" type="number" value="" name="number" id="CapacityFormnumber" min="1" />
    <span class="help-block" >同一タイプの議室が複数ある場合に入力<span>
</div>
<div class="form-group col-4 mb-0 pb-0">
    <label for="CapacityFormleast_time" class="form-control-label">最低利用時間(1h)</label>
    <input class="form-control form-control-lg center" type="number" value="" name="least_time" id="CapacityFormleast_time" min="1" />
</div>

<div class="form-group col-12 py-0 my-0">
    <span class="help-block" >※3時間パックなどの割引設定は店舗単位で設定できます。設定は<a href="/owner/contents/{!!$content->id!!}/desc/edit">こちら</a>。<span>
</div>

<div class="form-group col-sm-12">
    <label for="CapacityFormdescription" class="form-control-label">特徴：</label>
    <textarea max="1000" class="form-control form-control-lg" name="description" id="CapacityFormdescription"></textarea>
</div>
<div class="form-group col-sm-12">
    <div class="row mb-2">
      <div class="col-sm-6 center">
        <label for="CapacityFormpic" class="btn form-control-label f14 text-blue-700"><strong>写真アップ</strong></label>
        <input accept="image/*" type="file" class="" id="CapacityFormpic" name="pic" /><br />
        <span class="pt-4 mt-4" id="Capacity_progress_bar"><span class="percent" style="padding:0px 100px;">0%</span></span>
      </div>
      <div id="preview" class="col-sm-6 center">
        <img src="" style="width:120px;" />
      </div>
    </div>
</div>