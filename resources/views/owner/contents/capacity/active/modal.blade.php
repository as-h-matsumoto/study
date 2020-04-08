<?php /*
CapacityFormname
CapacityFormtype
CapacityFormperson
CapacityFormnumber
CapacityFormdescription
CapacityFormpic
*/ ?>
<div class="form-group col-8">
    <label for="CapacityFormname" class="form-control-label"><i class="icon icon-star text-red-700"></i> アクティブスペース名</label>
    <input class="form-control" type="text" value="" name="name" id="CapacityFormname" />
</div>
<div class="form-group col-4 pr-1 center">
    <label for="CapacityFormtype" class="form-control-label"><i class="icon icon-star text-red-700"></i> タイプ</label>
    <select class="custom-select mt-2" name="type" id="CapacityFormtype">
        <option value=>選択</option>
        @foreach(Util::getCapacityType($content->service,null) as $key=>$val)
        <option value="{!!$key!!}">{!!$val!!}</option>
        @endforeach
    </select>
</div>

<div id="personArea" class="form-group col-4 px-1 center" style="display:none;">
    <label for="CapacityFormperson" class="form-control-label"><i class="icon icon-star text-red-700"></i> 許容人数</label>
    <input class="form-control form-control-lg center" type="number" value="" name="person" id="CapacityFormperson" min="1" />
</div>
<div id="numberArea" class="form-group col-4 px-1 center" style="display:none;">
    <label id="CapacityFormnumberLabel" for="CapacityFormnumber" class="form-control-label"><i class="icon icon-star text-red-700"></i> 台数</label>
    <input class="form-control form-control-lg center" type="number" value="" name="number" id="CapacityFormnumber" min="1" />
</div>
<div id="timeArea" class="form-group col-4 pl-1 center">
    <label for="CapacityFormtime" class="form-control-label"><i class="icon icon-star text-red-700"></i> 料金計算(分)</label>
    <input class="form-control form-control-lg center" type="number" value="" name="time" id="CapacityFormtime" min="1" />
    <span class="help-block">例：2時間:120分、6時間:360分、12時間:720分、1日:1440分</span>
</div>
<div class="form-group col pl-1 center">
    <label for="CapacityFormprice" class="form-control-label"><i class="icon icon-star text-red-700"></i> 料金<span id="priceTime" class="f10"></span></label>
    <input class="form-control form-control-lg center" type="number" value="" name="price" id="CapacityFormprice" min="1" />
</div>

<div id="activeType8" class="form-group col-12 py-2 my-0" style="display:none;">
    <span class="help-block" >※すべて利用のタイプを選択した場合、利用時間は一日中のみとなります。また、すべて利用のタイプはひとつだけ作成できます。<span>
</div>

<div class="form-group col-12 py-2 my-0">
    <span class="help-block" >※3時間パックなどの割引設定は店舗単位で設定できます。設定は<a href="/owner/contents/{!!$content->id!!}/desc/edit">こちら</a>。<span>
</div>

<div class="form-group col-sm-12">
    <label for="CapacityFormdescription" class="form-control-label">特徴</label>
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