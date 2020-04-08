
loading();
$('#modalEventFormcontent_date_id').val(event.id);

@if( !($content->service===91) )
var nowStatus = '';
nowStatus += getContentDateStatus(event.status,'name',null,null);
nowStatus += getContentDateStatus(event.status,'icon','s-4',null);
$('#nowStatus').html(nowStatus);
if(event.hand_status===1){
    $('#modalEventFormstatus').val(event.status);
}else{
    $('#modalEventFormstatus').val('999');
}
if(event.percent>=1){
    $('#modalEventFormpercent').val(event.percent);
}else{
    $('#modalEventFormpercent').val('');
}
$('#modalEventFormpayment').val(event.payment);
@endif

$('#modalEventFormstartDate').val(event.start.format("YYYY-MM-DD"));
$('#modalEventFormstartTime').val(event.start.format("HH:mm"));

$('#modalEventFormendDate').val(event.end.format("YYYY-MM-DD"));
$('#modalEventFormendTime').val(event.end.format("HH:mm"));

@if($content->service===62 or $content->service===69 or $content->service===101 or $content->service===91 )
$('#modalEventFormdescription').val(event.description);
@endif

@if($content->service===69)
$('#totour' + event.to_tour).attr("selected",true);
$('#fromtour' + event.from_tour).attr("selected",true);
@endif

//menu
@if( !($content->service===39 or $content->service===85 or $content->service===89 or $content->service===91) )
menuPutEvent(event);
@endif

//capacity
@if( $content->service===69 or $content->service===101 )
@elseif( !($content->service===62) )
capacityPutEvent(event);
@endif

$('#modalEvent').modal('show');
