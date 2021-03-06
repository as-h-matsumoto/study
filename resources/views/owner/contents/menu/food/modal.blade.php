<?php /*
type
name
price
person
time
number
description
pic
menu_id
*/ ?>

<div class="form-group col-sm-12">
    <label for="name"><i class="icon icon-star text-red-700"></i> メニュー名</label>
    <input class="form-control form-control-lg" type="text" value="" name="name" id="name"/>
</div>

<div class="form-group col-sm-6">
    <label for="type" class="form-control-label"><i class="icon icon-star text-red-700"></i> タイプ</label>
    <select class="custom-select" name="type" id="type" style="width:100%">
        @foreach(Util::getMenuType($content->service,null) as $key=>$val)
        <option value="{!!$key!!}">{!!$val!!}</option>
        @endforeach
    </select><br />
    <span class="f10">コースの場合ご利用人数と同数の注文となります。</span>
</div>
<div class="form-group col-sm-6" >
    <label for="person" class="form-control-label">最低予約人数</label>
    <select class="custom-select" name="person" id="person" style="width:100%">
        <option value="1">なし</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
        <option value="60">60</option>
        <option value="70">70</option>
        <option value="80">80</option>
        <option value="90">90</option>
        <option value="100">100</option>
        <option value="200">200</option>
    </select>
</div>

<div class="form-group col-sm-6">
    <label for="price"><i class="icon icon-star text-red-700"></i> 料金</label>
    <input class="form-control form-control-lg" type="number" value="" name="price" id="price" min="1" max="99999999" />
    <span class="help-block">税抜き価格</span>
</div>
<div class="form-group col-sm-6">
    <label for="time" class="mb-6">時間制限(分)</label>
    <select class="custom-select" name="time" id="time" style="width:100%">
        <option value="">なし</option>
        <option value="30">30分</option>
        <option value="60">1時間</option>
        <option value="90">1時間30分</option>
        <option value="120">2時間</option>
        <option value="150">2時間30分</option>
        <option value="180">3時間</option>
        <option value="210">3時間30分</option>
        <option value="240">4時間</option>
        <option value="270">4時間30分</option>
        <option value="300">5時間</option>
        <option value="330">5時間30分</option>
        <option value="360">6時間</option>
    </select>
</div>

<div class="form-group col-sm-6">
    <label for="number">予定ごとの提供数</label>
    <input class="form-control form-control-lg" type="number" value="" name="number" id="number" min="1" />
    <span class="help-block text-info">ランチとディナーでメニューを分けるとそれぞれの提供数となります。</span>
    <span class="help-block text-info">提供数は、あとから日程ごとに変更することができます。</span>
</div>

<div class="form-group col-sm-12">
    <label for="description" class="form-control-label">概要</label>
    <textarea max="1000" class="form-control form-control-lg" name="description" id="description"></textarea>
</div>

<div class="form-group col-sm-12 center">
    <div class="row mb-2">
      <div class="col-sm-6">
        <label for="formPic" class="btn form-control-label f14 text-blue-700"><strong>写真アップ</strong></label>
        <input accept="image/*" type="file" class="" id="formPic" name="formPic" />
        <br /><span class="pt-4 mt-4" id="menu_progress_bar"><span class="percent" style="padding:0px 50px;">0%</span></span>
      </div>
      <div id="preview" class="col-sm-6">
        <img src="" style="width:120px;" />
      </div>
    </div>
</div>
