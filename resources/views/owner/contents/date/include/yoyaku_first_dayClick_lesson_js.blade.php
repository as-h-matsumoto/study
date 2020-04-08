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

    axios.get('/owner/contents/{!!$content->id!!}/getDateUsers', {
      params: {
        day: date.format('YYYY-MM-DD'),
        content_date_id: null,
        request_start: null
      }
    })
    .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}
        //console.log(response.data);

        if(!response.data.active_user) {
            infoNotify('まだ'+date.format('MM月DD日')+'のご予約者はいません。');
            return;
        }

        $('#yoyaku_first_day').val(date.format('YYYY-MM-DD'));
        
        var tab_link_area = '';
        var tab_content_area = '';

        $('.modalYoyakuDayclickEventDay').html(date.format('YYYY年MM月DD日'));

        $.each(response.data.data,function(index,data){

            //console.log(data);

            tab_link_area += '<li id="yoyaku_first_'+index+'" class="nav-item">';
            tab_link_area += '<button onClick="showYoyakuFirst('+index+');" class="nav-link btn btn-outline-info">';
            tab_link_area += '<span>'+truncate(data.event.menu.name,42,null)+'</span>';
            
            tab_link_area += '</button>';
            tab_link_area += '</li>';

            tab_content_area += '<div id="yoyaku_first_tab_'+index+'" class="modal-body" style="display:none;">';
            tab_content_area += '<div class="card">';
            tab_content_area += '<div class="card-header">';
            tab_content_area += '<p class="h5 center">';
            tab_content_area += '<span class="yoyaku_first_name_'+index+' pr-2"></span>';
            tab_content_area += '<span>'+moment(data.event.start).format('HH:mm')+'</span>';
            tab_content_area += '<span class="px-2">~</span>';
            tab_content_area += '<span>'+moment(data.event.end).format('HH:mm')+'</span>';
            tab_content_area += '</p>';
            tab_content_area += '</div>';
            tab_content_area += '<div class="card-body p-0">';
            tab_content_area += '<input type="hidden" name="yoyaku_first_dateid_'+index+'" id="yoyaku_first_dateid_'+index+'" value="">';
            tab_content_area += '<ul class="nav nav-tabs border-bottom mb-4">';
            tab_content_area += '<li class="nav-item active">';
            tab_content_area += '<button class="nav-link btn btn-outline-info">ご予約者</button>';
            tab_content_area += '</li>';
            tab_content_area += '</ul>';
            tab_content_area += '<div class="tab-content p-0">';
            tab_content_area += '<div class="row mb-4">';
            var userInset = insertUsers(data.event, data.content_date_users_oneDate);
            tab_content_area += '<div id="userTable_0" class="col-12">'+userInset+'</div>';
            tab_content_area += '</div>';
            tab_content_area += '</div>';
            tab_content_area += '</div>';
            tab_content_area += '</div>';
            tab_content_area += '</div>';

        });

        $('#tab-link-area').html(tab_link_area);
        $('#tab-content-area').html(tab_content_area);

        $('#loading').hide();
        $('[data-toggle="popover"]').popover();
        $('#modalYoyakuDayclickEvent').modal('show');

        $("#yoyaku_first_0").addClass("active");
        $('#yoyaku_first_tab_0').show();

    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

}else{
    //longNotify('予約受付カレンダーは翌々月末まで作成できます。<br />翌日から翌々月末までの期間を選択してください。');
}

