<?php /*
CapacityFormname
CapacityFormtype
CapacityFormperson
CapacityFormnumber
CapacityFormdescription
CapacityFormpic
*/ ?>

<div class="form-group col-4 pr-1 center">
    <label for="CapacityFormtype" class="form-control-label"><i class="icon icon-star text-red-700"></i> タイプ</label>
    <select class="custom-select mt-5" name="type" id="CapacityFormtype">
        <option value=>選択</option>
        @foreach(Util::getCapacityType($content->service,null) as $key=>$val)
        <option value="{!!$key!!}">{!!$val!!}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-4 px-1 center">
    <label for="CapacityFormnumber" class="form-control-label"><i class="icon icon-star text-red-700"></i> 台数</label>
    <input class="form-control form-control-lg center" type="number" value="" name="number" id="CapacityFormnumber" min="1" />
</div>
<div class="form-group col-sm-4 center">
    <label for="kinou" class="form-control-label">機能</label>
    <div class="form-check form-check-inline mt-5">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="private" id="CapacityFormprivate" value="1"/>
            <span class="checkbox-icon"></span>
            <span class="form-check-description">個室</span>
        </label>
    </div>
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