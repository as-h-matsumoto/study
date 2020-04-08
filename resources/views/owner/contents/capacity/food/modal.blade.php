<?php /*
CapacityFormtype
CapacityFormperson
CapacityFormnumber
CapacityFormprivate
CapacityFormyukabori
CapacityFormdescription
CapacityFormpic
*/ ?>
<div class="form-group col">
    <label for="type" class="form-control-label"><i class="icon icon-star text-red-700"></i> タイプ:</label>
    <select class="custom-select mt-5" name="type" id="CapacityFormtype">
        <option value=>選択してください。</option>
        @foreach(Util::getCapacityType($content->service,null) as $key=>$val)
        @if($key!==4)
        <option value="{!!$key!!}">{!!$val!!}</option>
        @endif
        @endforeach
    </select>
</div>
<div id="personArea" class="form-group col-5">
    <label for="person" class="form-control-label"><i class="icon icon-star text-red-700"></i> 何名用<span id="personAreaTitle"></span>:</label>
    <select class="custom-select mt-5" name="person" id="CapacityFormperson" >
        <option value="1">1名様用</option>
        <option value="2">2名様用</option>
        <option value="4">4名様用</option>
        <option value="6">6名様用</option>
        <option value="8">8名様用</option>
        <option value="10">10名様用</option>
        <option value="12">12名様用</option>
        <option value="14">14名様用</option>
        <option value="16">16名様用</option>
        <option value="18">18名様用</option>
        <option value="20">20名様用</option>
    </select>
</div>
<div id="numberArea" class="form-group col">
    <label for="number" class="form-control-label"><i class="icon icon-star text-red-700"></i> <span id="numberAreaTitle">数</span>:</label>
    <input class="form-control form-control-lg" type="number" value="" name="number" id="CapacityFormnumber" min="1" />
</div>
<div id="kinouArea" class="form-group col-sm-12">
    <label for="kinou" class="form-control-label">機能</label>
    <div class="form-check form-check-inline mt-5">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="nonesmoking" id="CapacityFormnonesmoking" value="1" />
            <span class="checkbox-icon"></span>
            <span class="form-check-description">禁煙</span>
        </label>
    </div>
    <div class="form-check form-check-inline mt-5">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="sheet" id="CapacityFormsheet" value="1"/>
            <span class="checkbox-icon"></span>
            <span class="form-check-description">シート／ソファー</span>
        </label>
    </div>
    <div class="form-check form-check-inline mt-5">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="private" id="CapacityFormprivate" value="1"/>
            <span class="checkbox-icon"></span>
            <span class="form-check-description">個室</span>
        </label>
    </div>    
    <div class="form-check form-check-inline mt-5">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="yukabori" id="CapacityFormyukabori" value="1"/>
            <span class="checkbox-icon"></span>
            <span class="form-check-description">床堀席</span>
        </label>
    </div>
</div>
<div class="form-group col-sm-12">
    <label for="price" class="form-control-label">使用料：</label>
    <input class="form-control form-control-lg" type="number" value="" name="price" id="CapacityFormprice" min="1" max="99999999" />
    <span class="help-block">席料がある場合はこちらに税抜き額を登録してください。</span>
</div>
<div class="form-group col-sm-12">
    <label for="description" class="form-control-label">特徴：</label>
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
        <p id="imgUpAns" class="center"></p>
      </div>
    </div>
</div>

