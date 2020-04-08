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
    <label for="name"><i class="icon icon-star text-red-700"></i> チケット名</label>
    <input class="form-control form-control-lg" type="text" value="" name="name" id="name"/>
</div>

<div class="form-group col-sm-6">
    <label for="time" class="form-control-label mb-6"><i class="icon icon-star text-red-700"></i> 開催時間</label>
    <input class="form-control form-control-lg center" type="number" id="time" name="time" min="1" max="99999" />
    <span class="help-block">例：2時間:120分、6時間:360分、12時間:720分、1日:1440分。</span>
</div>

<div class="form-group col-sm-6" >
    <label for="number" class="form-control-label"><i class="icon icon-star text-red-700"></i> チケット枚数</label>
    <input class="form-control form-control-lg center" type="number" value="10" name="number" id="number" min="1" max="99999" />
    <span class="help-block">ベースとなる枚数を設定ください。開催するごとに枚数を変更できます。</span>
</div>

<div class="form-group col-sm-6" >
    <label for="person" class="form-control-label mb-6">最低予約人数</label>
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
    <br /><span class="help-block">ベースとなる数を設定ください。日程ごとに最低予約人数を変更できます。</span>
</div>

<div class="form-group col-sm-6">
    <label for="price"><i class="icon icon-star text-red-700"></i> 料金</label>
    <input class="form-control form-control-lg center" type="number" value="" name="price" id="price" min="1" max="99999999" />
    <span class="help-block">税抜き価格(ベースとなる料金を設定ください。日程ごとに料金を変更できます。)</span>
</div>

<div class="form-group col-sm-12">
    <label for="description" class="form-control-label">概要</label>
    <textarea max="1000" class="form-control form-control-lg" name="description" id="description"></textarea>
    <span class="help-block">チケットの概要だけ記入ください。開催場所や催しの詳細は予約受付登録時に登録します。</span>
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
