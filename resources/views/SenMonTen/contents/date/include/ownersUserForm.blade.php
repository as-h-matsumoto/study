@if( $GLOBALS['urls'][1]==='owner' and $GLOBALS['urls'][5]==='adduser' )
<input type="hidden" value="1" name="ownersUser" id="ownersUser" />
<input type="hidden" value="" name="ownersUserId" id="ownersUserId" />
<input type="text" name="dummy1" style="display:none;">
<input type="text" name="dummy2" style="display:none;">
<div class="form-group col-sm-12">
    <label for="" class="form-control-label text-info"><span class="pr-2">ご予約者様検索(TEL)</span><a href="javascript:void(0)" class="btn btn-info float-right" id="findOwnersUser" >検索</a></label>
    <input class="form-control form-control-lg" type="search" name="ownersUserSearch" id="ownersUserSearch" placeholder="電話番号" aria-label="090-1928-9874" />
</div>
<div id="searchAnsArea" class="col-sm-12">
</div>
<div class="form-group col-sm-6">
    <label for="ownersUserTel" class="form-control-label text-info">ご予約者様TEL</label>
    <input class="form-control form-control-lg" type="tel" value="" name="ownersUserTel" id="ownersUserTel" />
</div>
<div class="form-group col-sm-6">
    <label for="ownersUserName" class="form-control-label text-info">ご予約者様お名前</label>
    <input class="form-control form-control-lg" type="text" value="" name="ownersUserName" id="ownersUserName" />
</div>
<div class="form-group col-sm-12">
    <label for="ownersUserDescription" class="form-control-label text-info">ご予約者様メモ</label>
    <textarea class="form-control form-control-lg" value="" name="ownersUserDescription" id="ownersUserDescription" ></textarea>
</div>
@endif