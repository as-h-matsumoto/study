
<div class="form-group col-4 px-4">
    <label for="CapacityFormtype" class="form-control-label"><i class="icon icon-star text-red-700"></i> タイプ</label>
    <select class="custom-select mt-5" name="type" id="CapacityFormtype" style="width:100%">
        @foreach(Util::getCapacityType($content->service,null) as $key=>$val)
        <option value="{!!$key!!}">{!!$val!!}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-8">
    <label for="CapacityFormname" class="form-control-label"><i class="icon icon-star text-red-700"></i> ルーム名、または、共有スペース名</label>
    <input class="form-control form-control-lg center" type="text" value="" name="name" id="CapacityFormname" />
</div>

<div class="form-group col-4">
    <label for="person" class="form-control-label"><i class="icon icon-star text-red-700"></i> 何名用<span id="personAreaTitle"></span>:</label>
    <select class="custom-select mt-5" name="person" id="CapacityFormperson" style="width:100%" >
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
        <option value="10000">20名様以上</option>
    </select>
</div>
<div class="form-group col-4 px-2">
    <label for="CapacityFormarea" class="form-control-label"><i class="icon icon-star text-red-700"></i> 平米数</label>
    <input class="form-control form-control-lg center" type="number" value="" name="area" id="CapacityFormarea" min="1" style="width:100%" />
</div>
<div class="form-group col-4 px-4">
    <label for="CapacityFormheight" class="form-control-label"><i class="icon icon-star text-red-700"></i> 高さ(cm)</label>
    <input class="form-control form-control-lg center" type="number" value="" name="height" id="CapacityFormheight" min="1" style="width:100%" />
    <span class="help-block" >野外の場合0か空白<span>
</div>

<div class="form-group col-12 mb-0">
    <span class="help-block text-warning" >宿泊ルーム料金を0にしてメニューに含めた場合は、そのルームを選択するとディナーメニューも選択しなければ予約できなくなります。<span>
</div>
<div class="form-group col-6">
    <label for="CapacityFormprice" class="form-control-label">料金</label>
    <input class="form-control form-control-lg center" type="number" value="" name="price" id="CapacityFormprice" min="1" />
    <span class="help-block" >メニュー料金と合算されます。メニュー料金にお部屋代が含まれる場合は0か空白。<span>
</div>

<div class="form-group col-6">
    <label for="CapacityFormnumber" class="form-control-label">お部屋/スペース数</label>
    <input class="form-control form-control-lg center" type="number" value="" name="number" id="CapacityFormnumber" min="1" />
    <span class="help-block" >同一タイプのお部屋/スペースが複数ある場合に入力<span>
</div>

<div id="selectPublicAreaPermit" class="form-group col-6 mb-2" style="display:none;">
    <label for="CapacityFormuse_only_public" class="form-control-label">この共有スペースのみの利用</label>
    <select class="custom-select mt-5" name="use_only_public" id="CapacityFormuse_only_public" style="width:100%">
        <option value="0">宿泊者のみ利用可</option>
        <option value="1">宿泊者以外も利用可</option>
    </select>
</div>
<div id="selectPublicAreaPrice" class="form-group col-6 mb-2" style="display:none;">
    <label for="CapacityFormprice_stay" class="form-control-label">宿泊者料金</label>
    <input class="form-control form-control-lg center" type="number" value="" name="price_stay" id="CapacityFormprice_stay" min="1" />
</div>
<div id="selectPublicAreaMessage" class="col-12 mb-6" style="display:none;">
    <span class="help-block text-info">宿泊者以外も利用できる場合、宿泊者の料金はこちらに登録してください。宿泊者以外の料金は「料金」に登録してください。<span>
</div>

<div class="form-group col-sm-12">
    <label for="kinou" class="form-control-label">機能</label>
    <div id="CapacityFormkidsArea" class="form-check form-check-inline mt-5" style="display:none;">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="kids" id="CapacityFormkids" value="1" />
            <span class="checkbox-icon"></span>
            <span class="form-check-description">子供可(~10才未満)</span>
        </label>
    </div>
    <div id="CapacityFormyojiArea" class="form-check form-check-inline mt-5" style="display:none;">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="yoji" id="CapacityFormyoji" value="1" />
            <span class="checkbox-icon"></span>
            <span class="form-check-description">幼児可(~6才未満)</span>
        </label>
    </div>
    <div id="CapacityFormbabyArea" class="form-check form-check-inline mt-5" style="display:none;">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="baby" id="CapacityFormbaby" value="1" />
            <span class="checkbox-icon"></span>
            <span class="form-check-description">赤子可(~1才未満)</span>
        </label>
    </div>
    <div class="form-check form-check-inline mt-5">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="nonesmoking" id="CapacityFormnonesmoking" value="1" />
            <span class="checkbox-icon"></span>
            <span class="form-check-description">禁煙</span>
        </label>
    </div>
    <div class="form-check form-check-inline mt-5">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="bus" id="CapacityFormbus" value="1"/>
            <span class="checkbox-icon"></span>
            <span class="form-check-description">お風呂</span>
        </label>
    </div>
    <div class="form-check form-check-inline mt-5">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="toilet" id="CapacityFormtoilet" value="1"/>
            <span class="checkbox-icon"></span>
            <span class="form-check-description">トイレ</span>
        </label>
    </div>
    <div class="form-check form-check-inline mt-5">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="hotspring" id="CapacityFormhotspring" value="1"/>
            <span class="checkbox-icon"></span>
            <span class="form-check-description">温泉</span>
        </label>
    </div>
    <div class="form-check form-check-inline mt-5">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="refrigerator" id="CapacityFormrefrigerator" value="1"/>
            <span class="checkbox-icon"></span>
            <span class="form-check-description">冷蔵庫</span>
        </label>
    </div>
    <div class="form-check form-check-inline mt-5">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="net" id="CapacityFormnet" value="1"/>
            <span class="checkbox-icon"></span>
            <span class="form-check-description">ネット</span>
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