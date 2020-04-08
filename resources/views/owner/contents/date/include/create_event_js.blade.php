<?php
$tmp1 = explode('-', date('Y-m-d'));
$tmp2 = explode('-', $last_day);
$aa = $tmp1[0];
$bb = $tmp1[1];
$cc = $tmp1[2];
$dd = $tmp2[0];
$ee = $tmp2[1];
$ff = $tmp2[2];
?>
var clickDate = new Date(date.format('YYYY'), date.format('MM'), date.format('DD'), 0, 0, 0);
var today = new Date({!!$aa!!}, {!!$bb!!}, {!!$cc!!}, 0, 0, 0);
var last_day = new Date({!!$dd!!}, {!!$ee!!}, {!!$ff!!}, 0, 0, 0);
//console.log(clickDate);
//console.log(today);
//console.log(last_day);
if(
    clickDate.getTime() > today.getTime() &&
    clickDate.getTime() <= last_day.getTime()
){

    $('#createEventFormstartDate').val(date.format('YYYY-MM-DD'));
    $('#createEventFormstartTime').val('10:00');

    @if($content->service===91)
    $('#createEventFormendDate').val(date.format('YYYY-MM-DD'));
    $('#createEventFormendTime').val('17:00');
    @endif

    @if( !($content->service===91) )
    menuPutTypeOnlyOne();
    @endif

    @if( $content->service===69 or $content->service===101 )
    @elseif( $content->service===91 )
    capacityPut();
    @endif

    $('#modalCreateEvent').modal('show');

}else{
    longNotify('予約受付カレンダーは翌々月末まで作成できます。<br />翌日から翌々月末までの期間を選択してください。');
}

