<?php
$tmp1 = explode('-', $content_date_last_start);
$tmp2 = explode('-', $last_day);
$aa = $tmp1[0];
$bb = $tmp1[1];
$cc = $tmp1[2];
$dd = $tmp2[0];
$ee = $tmp2[1];
$ff = $tmp2[2];
?>
var clickDate = new Date(date.format('YYYY'), date.format('MM'), date.format('DD'), 0, 0, 0);
var content_date_last_start = new Date({!!$aa!!}, {!!$bb!!}, {!!$cc!!}, 0, 0, 0);
var last_day = new Date({!!$dd!!}, {!!$ee!!}, {!!$ff!!}, 0, 0, 0);
//console.log(clickDate);
//console.log(content_date_last_start);
//console.log(last_day);
if(
    clickDate.getTime() > content_date_last_start.getTime() &&
    clickDate.getTime() <= last_day.getTime()
){
    @if( !($content->service===39 or $content->service===85 or $content->service===89) )
    menuPut();
    @endif
    @if( !($content->service===69 or $content->service===101) )
    capacityPut();
    @endif
    $('#FirstContentDateFormstart').val(date.format('YYYY-MM-DD'));
    $('#modalFirstContentDate').modal('show');
}else{
    @if($content->calendar_flug===1)
    longNotify('予約受付カレンダーは翌々月末まで作成できます。<br />翌日から翌々月末までの期間を選択してください。');
    @endif
    //console.log('out 1'); 
}