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

        @if(
            $content->service===15 or
            $content->service===81
        )
        $('#yoyaku_first_tab_0').show('slow');
        $("#yoyaku_first_0").addClass("active");
        $('#yoyaku_first_tab_1').hide();
        $("#yoyaku_first_1").removeClass("active");
        $('#showOwnerYoyakuDateMenusTab_0').hide();
        $('#showOwnerYoyakuDateUsersTab_0').hide();
        $('#showOwnerYoyakuDateCapacitiesTab_0').show('slow');
        $("#showOwnerYoyakuDateMenus_0").removeClass("active");
        $("#showOwnerYoyakuDateUsers_0").removeClass("active");
        $("#showOwnerYoyakuDateCapacities_0").addClass("active");
        @elseif(
            $content->service===39 or
            $content->service===85 or
            $content->service===89
        )
        $('#yoyaku_first_tab_0').show('slow');
        $("#yoyaku_first_0").addClass("active");
        $('#yoyaku_first_tab_1').hide();
        $("#yoyaku_first_1").removeClass("active");
        $('#showOwnerYoyakuDateUsersTab_0').hide();
        $('#showOwnerYoyakuDateCapacitiesTab_0').show('slow');
        $("#showOwnerYoyakuDateUsers_0").removeClass("active");
        $("#showOwnerYoyakuDateCapacities_0").addClass("active");
        @elseif(
            $content->service===62 or
            $content->service===65 or
            $content->service===69 or
            $content->service===101 or
            $content->service===77 or
            $content->service===91 or
            $content->service===90
        )
        $('#yoyaku_first_tab_0').show('slow');
        $("#yoyaku_first_0").addClass("active");
        $('#yoyaku_first_tab_1').hide();
        $("#yoyaku_first_1").removeClass("active");
        $('#showOwnerYoyakuDateMenusTab_0').show('slow');
        $('#showOwnerYoyakuDateUsersTab_0').hide();
        $("#showOwnerYoyakuDateMenus_0").addClass("active");
        $("#showOwnerYoyakuDateUsers_0").removeClass("active");
        @endif

        $('#yoyaku_first_day').val(date.format('YYYY-MM-DD'));
        $('#yoyaku_first_1').hide();

        $('.modalYoyakuDayclickEventDay').html(date.format('YYYY年MM月DD日'));



        $.each(response.data.data,function(index,data){

            //console.log(data);

            $('#yoyaku_first_dateid_'+index).val(data.event.id);
            $('.yoyaku_first_start_'+index).html(moment(data.event.start).format('HH:mm'));
            $('.yoyaku_first_end_'+index).html(moment(data.event.end).format('HH:mm'));
            
            @if(
                $content->service===15 or
                $content->service===39 or
                $content->service===65 or
                $content->service===77 or
                $content->service===85 or
                $content->service===89 or
                $content->service===90
            )
            putStarts(index, data.event, data.content_date_users_oneDate, data.dateTotalCapacities);
            @else
            $('#modalDateYoyakuStart_'+index).val(moment(data.event.start).format('HH:mm'));
            $('#modalDateYoyakuEnd_'+index).val(moment(data.event.end).format('HH:mm'));
            @endif

            @if(
                $content->service===15 or
                $content->service===39 or
                $content->service===85 or
                $content->service===89
            )
            putCapacities(index, data.event, data.content_date_users_30min, data.event.start);
            @elseif(
                $content->service===81
            )
            putCapacities(index, data.event, data.content_date_users_oneDate, data.event.start);
            @endif

            @if(
                $content->service===65 or
                $content->service===77 or
                $content->service===90
            )
            putMenus(index, data.event, data.content_date_users_30min, data.event.start);
            @elseif(
                $content->service===62 or
                $content->service===69 or
                $content->service===101 or
                $content->service===81 or
                $content->service===91
            )
            putMenus(index, data.event, data.content_date_users_oneDate, data.event.start);
            @endif
            
            if(index === 1) $('#yoyaku_first_1').show();

        });

        $('#modalYoyakuDayclickEvent').modal('show');
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

}else{
    //longNotify('予約受付カレンダーは翌々月末まで作成できます。<br />翌日から翌々月末までの期間を選択してください。');
}

