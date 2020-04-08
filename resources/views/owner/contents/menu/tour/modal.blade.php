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
    <label for="name"><i class="icon icon-star text-red-700"></i> ツアー名</label>
    <input class="form-control form-control-lg" type="text" value="" name="name" id="name"/>
</div>

<div class="form-group col-sm-6">
    <label for="time" class="form-control-label mb-6"><i class="icon icon-star text-red-700"></i> ツアー日程</label>
    <select class="custom-select" name="time" id="time" style="width:100%">
        <option value="240">半日</option>
        <option value="480">日帰り</option>
        <option value="2880">2日</option>
        <option value="4320">3日</option>
        <option value="5760">4日</option>
        <option value="7200">5日</option>
        <option value="8640">6日</option>
        <option value="10080">7日</option>
        <option value="11520">8日</option>
        <option value="12960">9日</option>
        <option value="14400">10日</option>
        <option value="15840">11日</option>
        <option value="17280">12日</option>
        <option value="18720">13日</option>
        <option value="20160">14日</option>
        <option value="21600">15日</option>
        <option value="23040">16日</option>
        <option value="24480">17日</option>
        <option value="25920">18日</option>
        <option value="27360">19日</option>
        <option value="28800">20日</option>
        <option value="30240">21日</option>
        <option value="31680">22日</option>
        <option value="33120">23日</option>
        <option value="34560">24日</option>
        <option value="36000">25日</option>
        <option value="37440">26日</option>
        <option value="38880">27日</option>
        <option value="40320">28日</option>
    </select>
</div>







<div class="form-group col-sm-6" >
    <label for="number" class="form-control-label"><i class="icon icon-star text-red-700"></i> 人数枠</label>
    <input class="form-control form-control-lg center" type="number" value="10" name="number" id="number" min="1" max="99999" />
    <span class="help-block">ベースとなる人数枠を設定ください。日程ごとに人数枠を変更できます。</span>
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
    <span class="help-block">ツアーの概要だけ記入ください。出発元や観光スケジュール、宿泊スケジュールなどの詳細は予約受付登録時に登録します。</span>
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
