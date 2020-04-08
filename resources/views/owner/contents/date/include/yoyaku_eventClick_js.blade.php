var insert;

$('#modalEventFormcontent_date_user_id').val(event.id);
//---------
//edit form 
//---------
var start = new Date(event.start.format('YYYY'), event.start.format('MM'), event.start.format('DD'), 0, 0, 0);
var end   = new Date(event.end.format('YYYY'), event.end.format('MM'), event.end.format('DD'), 0, 0, 0);
//利用時間
var nextDay = '';
if(
    start.getTime() < end.getTime()
){
    nextDay = event.end.format("YYYY年MM月DD日");
}
var cancel_on = '';
if(event.goin===9) cancel_on = '<span class="text-warning">キャンセルのご予約</span><br />';
$('#startEnd').html(
  cancel_on
  + '<span>'
  + event.start.format("YYYY年MM月DD日")
  + ' '
  + event.start.format("HH:mm")
  + '~'
  + nextDay
  + event.end.format("HH:mm")
  + '</span>');


//予約ID
$('#yoyakuId').html('<span class="pr-2"><span class="text-info">' + event.yoyaku_id + '</span><br /><span class="f11">このIDをCoordiy予約の画面から確認してください。</span>');

//利用者概要
if(isset(event.user.pic)){
    var pic_user = '/storage/uploads/users/' + event.user.id + '/' + add_filename(event.user.pic,'250');
}else{
    var pic_user = '/storage/global/img/user'+Math.floor(Math.random() * 6) + 1;+'_250.jpeg';
}
$('#username').html('<span class="pr-2"><img class="avater" title="' + event.user.name + '" alt="' + event.user.name + '" src="' + pic_user + '" /></span><span>' + event.user.name + '</span>');




//利用人数
@if(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!=='recruit')
$('#joinnumber').html('<span>ご利用人数：'+ event.join_user_number +'名様</span>');
@endif

//利用条件
@if($content->service===15)
var mustValue = '';
if(event.nonesmoking===1) mustValue += '<span class="pr-2 text-success">禁煙</span><br />';
if(event.private===1) mustValue += '<span class="pr-2 text-success">個室</span><br />';
if(event.sheet===1) mustValue += '<span class="pr-2 text-success">シート・ソファー席</span>';
if(isset(mustValue)){
    $('#usermust').html(mustValue);
}else{
    $('#usermust').html('なし');
}
@endif

//利用時間
@if($content->service===39 or $content->service===85 or $content->service===89)
insert = putUseTime(event.use_time_desc);
$('#usetime').html(insert);
@endif

//利用メニューとキャパシティ
insert = putMenusAndCapacities(event);
$('#selectMenusAndCapacities').html(insert);

//利用料金
@if(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!=='recruit')
var pay = '';
console.log(event.goin);
if(event.goin===2){
    pay = '<span class="text-success">お支払い： &yen;' + event.payment_sum + '(支払い済み)<br />(&yen;' + event.price_sum + ' :税抜き)</span>';
}else if(event.goin===1){
    pay = '<span class="text-danger">お支払い： &yen;' + event.payment_sum + '(未払い)<br />(&yen;' + event.price_sum + ' :税抜き)</span>';
}else if(event.goin===9){
    var cancel_price = (event.cancel_price>=1) ? event.cancel_price : 0;
    pay = '<span class="text-grey-500">キャンセル料 &yen;' + cancel_price + '</span>';
}
$('#payment').html(pay);
@endif

$('#to_user_id').val(event.user.id);
if(event.goin===9){
    $('#goinYoyakuCancelOwner').hide();
}else{
    $('#goinYoyakuCancelOwner').show();
}

if(event.onOff===1){
    $('#offUser').show();
    $('#onUser').hide();
}else{
    $('#offUser').hide();
    $('#onUser').show();
}


$('[data-toggle="popover"]').popover();
$('#modalEvent').modal('show');