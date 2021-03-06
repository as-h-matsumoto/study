<?php /*
CapacityFormname
CapacityFormtype
CapacityFormperson
CapacityFormnumber
CapacityFormdescription
CapacityFormpic
*/ ?>
<div class="form-group col-12 mt-4">
    <label for="CapacityFormname" class="form-control-label"><i class="icon icon-star text-red-700"></i> 面接ルーム名</label>
    <input class="form-control" type="text" value="" name="name" id="CapacityFormname" />
</div>
<div class="form-group col-6 px-1 center">
    <label for="CapacityFormperson" class="form-control-label"><i class="icon icon-star text-red-700"></i> 許容人数</label>
    <input class="form-control form-control-lg center" type="number" value="" name="person" id="CapacityFormperson" min="1" style="width:100%" />
</div>
<div class="form-group col-6 px-1 center">
    <label for="CapacityFormnumber" class="form-control-label"><i class="icon icon-star text-red-700"></i> ルーム数</label>
    <input class="form-control form-control-lg center" type="number" value="" name="number" id="CapacityFormnumber" min="1" style="width:100%" />
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