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
    <input class="form-control form-control-lg center" type="text" value="" name="name" id="name"/>
</div>

<div class="form-group col-sm-12">
    <label for="type" class="form-control-label mb-5"><i class="icon icon-star text-red-700"></i> タイプ</label>
    <select class="custom-select" name="type" id="type" style="width:100%">
        @foreach(Util::getMenuType($content->service,null) as $key=>$val)
        <option value="{!!$key!!}">{!!$val!!}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    <label for="price"><i class="icon icon-star text-red-700"></i> 料金</label>
    <input class="form-control form-control-lg center" type="number" value="" name="price" id="price" min="1" max="99999999" />
    <span class="help-block">税抜き価格</span>
</div>

<div class="form-group col-sm-6">
    <label for="number"><i class="icon icon-star text-red-700"></i> 日程ごとの提供数</label>
    <input class="form-control form-control-lg center" type="number" value="" name="number" id="number" min="1" />
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
