
<script type="text/javascript">

@if($content->service===62 or $content->service===69 or $content->service===101)
var showYoyakuFirstCount = 1;
function showYoyakuFirst(number){

    loading();

    $.when(
        yoyaku_first_tab_hide()
    ).done(function(){
        $('#yoyaku_first_tab_'+number).show();
        $('#loading').hide();
    });

}
function yoyaku_first_tab_hide(){
    $('div[id ^= yoyaku_first_tab_]').each(function(){
            $(this).hide();
    });
}
@else
var showYoyakuFirstCount = 1;
function showYoyakuFirst(number){

    loading();

    if(number === 0){
        $('#yoyaku_first_tab_0').show('slow');
        $("#yoyaku_first_0").addClass("active");
        $('#yoyaku_first_tab_1').hide();
        $("#yoyaku_first_1").removeClass("active");
    }else if(number === 1){
        $('#yoyaku_first_tab_0').hide();
        $("#yoyaku_first_0").removeClass("active");
        $('#yoyaku_first_tab_1').show('slow');
        $("#yoyaku_first_1").addClass("active");
    }

    $('#loading').hide();

}
@endif


var showOwnerYoyakuDateCapacitiesCount = true;
function showOwnerYoyakuDateCapacities(number){

    loading();

    $('#showOwnerYoyakuDateMenusTab_'+number).hide();
    $('#showOwnerYoyakuDateUsersTab_'+number).hide();
    $('#showOwnerYoyakuDateCapacitiesTab_'+number).show('slow');

    $("#showOwnerYoyakuDateMenus_"+number).removeClass("active");
    $("#showOwnerYoyakuDateUsers_"+number).removeClass("active");
    $("#showOwnerYoyakuDateCapacities_"+number).addClass("active");

    $('#loading').hide();

}

var showOwnerYoyakuDateMenusCount = true;
function showOwnerYoyakuDateMenus(number){
    
    if(showOwnerYoyakuDateMenusCount) loading();

    showOwnerYoyakuDateMenusCount = false;
    
    // menus どのタイプのメニューも残数を時間ごとに計算する必要がある。
    var event_id = $('#yoyaku_first_dateid_'+number).val();
    var day = $('#yoyaku_first_day').val();
    
    axios.get('/owner/contents/{!!$content->id!!}/getDateUsers', {
      params: {
        day: day,
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

        $.each(response.data.data,function(index,data){

            @if(
                $content->service===65 or
                $content->service===77 or
                $content->service===90
            )
            putMenus(index, data.event, data.content_date_users_30min, data.event.start);
            @elseif(
                $content->service===15 or
                $content->service===62 or
                $content->service===69 or
                $content->service===101 or
                $content->service===81 or
                $content->service===91
            )
            putMenus(index, data.event, data.content_date_users_oneDate, data.event.start);
            @endif

        });

    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

    $('#showOwnerYoyakuDateMenusTab_'+number).show('slow');
    $('#showOwnerYoyakuDateUsersTab_'+number).hide();
    $('#showOwnerYoyakuDateCapacitiesTab_'+number).hide();

    $("#showOwnerYoyakuDateMenus_"+number).addClass("active");
    $("#showOwnerYoyakuDateUsers_"+number).removeClass("active");
    $("#showOwnerYoyakuDateCapacities_"+number).removeClass("active");

}

var showOwnerYoyakuDateUsersCount = true;
function showOwnerYoyakuDateUsers(number){

    if(showOwnerYoyakuDateUsersCount) loading();

    showOwnerYoyakuDateUsersCount = false;
    
    // menus どのタイプのメニューも残数を時間ごとに計算する必要がある。
    var event_id = $('#yoyaku_first_dateid_'+number).val();
    var day = $('#yoyaku_first_day').val();
    
    axios.get('/owner/contents/{!!$content->id!!}/getDateUsers', {
      params: {
        day: day,
        content_date_id: null,
        request_start: null
      }
    })
    .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}

        if(!response.data.active_user) {
            infoNotify('まだ'+date.format('MM月DD日')+'のご予約者はいません。');
            return;
        }

        $.each(response.data.data,function(index,data){

            putUsers(index, data.event, data.content_date_users_oneDate);

        });
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

    $('#showOwnerYoyakuDateMenusTab_'+number).hide();
    $('#showOwnerYoyakuDateUsersTab_'+number).show('slow');
    $('#showOwnerYoyakuDateCapacitiesTab_'+number).hide();

    $("#showOwnerYoyakuDateMenus_"+number).removeClass("active");
    $("#showOwnerYoyakuDateUsers_"+number).addClass("active");
    $("#showOwnerYoyakuDateCapacities_"+number).removeClass("active");

    $('#loading').hide();

}

$(document).ready(function () {
    //$('#calendar-tab').hide();
});
</script>







<script>



function putStarts(index, content_date, content_date_users, dateTotalCapacities) {

        var color;
        var message;
        var status;
        //var last_yayoku = '{!!$content->last_time_yoyaku!!}';
        //var last_order = '{!!$content->last_time_order!!}';
        //var last_yoyaku_minitus = ToMin(last_yayoku);
        //var last_minitus = 30;


        //console.log('putStarts');
        //console.log(content_date);
        //console.log(dateTotalCapacities);
        //console.log(content_date_users);
        content_date.start = moment(content_date.start);
        content_date.end = moment(content_date.end);
        //console.log('event.start: ' + content_date.start.format('YYYY-MM-DD HH:mm:ss'));

        var insert = '';
        var sHour = moment(content_date.start.format('YYYY-MM-DD HH:mm:ss'));
        var eHour= moment(content_date.end.format('YYYY-MM-DD HH:mm:ss'));
        //var end2 = moment(content_date.end.format('YYYY-MM-DD HH:mm:ss'));
        var eHour = eHour.add(-30, 'm');
        //var yHour = end2.add(-last_yoyaku_minitus, 'm');
        var firstgoin = true;
        while(true){
            //console.log('sHour: ' + sHour.format('YYYY-MM-DD HH:mm:ss'));
            //console.log('eHour: ' + eHour.format('YYYY-MM-DD HH:mm:ss'));
            //console.log('yHour: ' + yHour.format('YYYY-MM-DD HH:mm:ss'));
            if(sHour.format('YYYY-MM-DD HH:mm:ss') > eHour.format('YYYY-MM-DD HH:mm:ss')){
                break;
            }
            //console.log('before status logic');
            status = usedCapacities(content_date_users, sHour, dateTotalCapacities);
            //console.log('status: ' + status);
            //status = 1;
            if( status===4 ){ color='bg-grey-300';message='キャンセル待ち';
            }else if( status===3 ){color='bg-red-100';message='残りわずか';
            }else if( status==2 ){color='bg-orange-100';message='残り中';
            }else{color='bg-green-100';message='';
            }
            insert += '<option class="f11 ' + color + '" value="' + sHour.format('YYYY-MM-DD HH:mm:ss') + '">' + sHour.format('MM月DD日 HH:mm') + ' ' + message + '</option>';
            //console.log(message);
            //count--;
            //if(count===0) return;
            sHour.add(30, 'm');
        }
        $('#selectYoyakuDateStart_'+index).html(insert);

}

function usedCapacities(content_date_users, start, dateTotalCapacities){
    var start_plus = moment(start.format('YYYY-MM-DD HH:mm:ss'));
    start_plus.add(30, 'm');
    var status;
    var user_start;
    var user_end;
    var sum_person = 0;
    var sum_number = 0;
    //console.log('hree');
    //console.log(content_date_users);
    //console.log('start: ' + start.format('YYYY-MM-DD HH:mm:ss'));
    //console.log('end: ' + start_plus.format('YYYY-MM-DD HH:mm:ss'));
    $.each(content_date_users,function(index,content_date_user){
        var start_tmp = content_date_user.start.split(' ');
        user_start = moment(start_tmp[0] + 'T' + start_tmp[1]);
        var end_tmp = content_date_user.end.split(' ');
        user_end = moment(end_tmp[0] + 'T' + end_tmp[1]);
        //console.log('order:    ' + start.format('YYYY-MM-DD HH:mm:ss'));
        //console.log('user_end: ' + user_end.format('YYYY-MM-DD HH:mm:ss'));
        //->where('end', '>', date('Y-m-d H:i:s', strtotime($DT_startPlus->format('Y-m-d H:i:s'))))
        //->where('start', '<', date('Y-m-d H:i:s', strtotime($DT_end->format('Y-m-d H:i:s'))))
        //if( !($DT_request_date >= $DT_request_date_tostart && $DT_request_date <= $DT_request_date_toclose_lastorder) ){
        if( 
            (
                user_start.format('YYYY-MM-DD HH:mm:ss') <= start.format('YYYY-MM-DD HH:mm:ss') &&
                user_start.format('YYYY-MM-DD HH:mm:ss') <= start_plus.format('YYYY-MM-DD HH:mm:ss')
            )
            &&
            (
                user_end.format('YYYY-MM-DD HH:mm:ss') >= start.format('YYYY-MM-DD HH:mm:ss') &&
                user_end.format('YYYY-MM-DD HH:mm:ss') >= start_plus.format('YYYY-MM-DD HH:mm:ss')
            )
        ){

            //console.log('in start users');
            @if(
                $content->service===15 or
                $content->service===39 or 
                $content->service===65 or 
                $content->service===77 or 
                $content->service===81 or 
                $content->service===85 or 
                $content->service===89 or
                $content->service===91 or
                $content->service===90
            )
            var capacities_summary = JSON.parse(content_date_user.capacities_summary);
            var capacities_desc = JSON.parse(content_date_user.capacities_desc);
            //console.log('capacities_summary: ');
            //console.log(capacities_summary);
            //console.log('capacities_desc: ');
            //console.log(capacities_desc);
            //return 1;
            $.each(capacities_desc,function(i,capacity_desc){
                //console.log(capacity_desc)
                @if( $content->service===15 or $content->service===81 )
                    sum_person += capacity_desc.person*capacities_summary[capacity_desc.id]['number'];
                @elseif($content->service===39)
                    if(capacity_desc.type>=5){
                        sum_person += capacities_summary[capacity_desc.id]['person'];
                    }else{
                        sum_number += capacities_summary[capacity_desc.id]['number'];
                    }
                @else
                    //console.log('this in?');
                    sum_number += capacities_summary[capacity_desc.id]['number'];
                @endif
            });
            @else
            var menus_summary = JSON.parse(content_date_user.menus_summary);
            var menus_desc = JSON.parse(content_date_user.menus_desc);
            //console.log(menus_summary);
            //console.log(menus_desc);
            //return 1;
            $.each(menus_desc,function(i,menu_desc){
                @if($content->service===62 or $content->service===65 or $content->service===69 or $content->service===77 or $content->service===90)
                    sum_person += menus_summary[menu_desc['id']]['person'];
                @elseif($content->service===101)
                    sum_number += menus_summary[menu_desc['id']]['number'];
                @endif
            });
            @endif
        }
    });

    //console.log('dateTotalCapacities');
    //console.log(dateTotalCapacities);
    //console.log('全体平均予約人数チェック service: ' + {!!$content->service!!});
    //console.log('sum_capacity_number: ' + dateTotalCapacities.number);
    //console.log('sum_capacity_person: ' + dateTotalCapacities.person);
    //console.log('sum_person: ' + sum_person);
    //console.log('sum_number: ' + sum_number);
  
    var ans_person;
    var ans_number;
    var waru8;
    var waru2;
    var content_capacity;
    @if($content->service===39)
      content_capacity = dateTotalCapacities.person;
      waru8 = content_capacity/8;
      waru2 = content_capacity/2;
      if( content_capacity < sum_person ){
        //console.log('service2->person: err キャパ以上に予約した');
        ans_person = 4;
      }else if( content_capacity === sum_person ){
        //console.log('service2->person: キャンセル待ち：残り0%');
        ans_person = 4;
      }else if( waru8 > content_capacity-sum_person ){
        //console.log('service2->person: 残りわずか(残り20%未満)');
        ans_person = 3;
      }else if( waru2 > content_capacity-sum_person ){
        //console.log('service2->person: 残り中(残り50%未満)');
        ans_person = 2;
      }else{
        //console.log('service2->person: 受付中(残り50%以上)');
        ans_person = 1;
      }
      content_capacity = dateTotalCapacities.number;
      waru8 = content_capacity/8;
      waru2 = content_capacity/2;
      if( content_capacity < sum_number ){
        //console.log('service2->number: err キャパ以上に予約した');
        ans_number = 4;
      }else if( content_capacity === sum_number ){
        //console.log('service2->number: キャンセル待ち：残り0%');
        ans_number = 4;
      }else if( waru8 > content_capacity-sum_number ){
        //console.log('service2->number: 残りわずか(残り20%未満)');
        ans_number = 3;
      }else if( waru2 > content_capacity-sum_number ){
        //console.log('service2->number: 残り中(残り50%未満)');
        ans_number = 2;
      }else{
        //console.log('service2->number: 受付中(残り50%以上)');
        ans_number = 1;
      }
      //console.log('ans_person: ' + ans_person);
      //console.log('ans_number: ' + ans_number);
      if( ans_person===4 && ans_number===4) return 4;
      if( ans_person===4 && ans_number===3) return 3;
      if( ans_person===4 && ans_number===2) return 3;
      if( ans_person===4 && ans_number===1) return 2;
      if( ans_person===3 && ans_number===4) return 3;
      if( ans_person===3 && ans_number===3) return 3;
      if( ans_person===3 && ans_number===2) return 3;
      if( ans_person===3 && ans_number===1) return 2;
      if( ans_person===2 && ans_number===4) return 3;
      if( ans_person===2 && ans_number===3) return 3;
      if( ans_person===2 && ans_number===2) return 2;
      if( ans_person===2 && ans_number===1) return 2;
      if( ans_person===1 && ans_number===4) return 3;
      if( ans_person===1 && ans_number===3) return 2;
      if( ans_person===1 && ans_number===2) return 2;
      if( ans_person===1 && ans_number===1) return 1;
    @elseif($content->service===15 or $content->service===62 or $content->service===65 or $content->service===69 or $content->service===77 or $content->service===81 or $content->service===90)
        content_capacity = dateTotalCapacities.person;
        waru8 = content_capacity/8;
        waru2 = content_capacity/2;
        if( content_capacity < sum_person ) return 4;
        if( content_capacity === sum_person ) return 4;
        if( waru8 > content_capacity-sum_person ) return 3;
        if( waru2 > content_capacity-sum_person ) return 2;
        return 1;
    @elseif( $content->service===101 or $content->service===85 or $content->service===89 or $content->service===91 )
        content_capacity = dateTotalCapacities.number;
        waru8 = content_capacity/8;
        waru2 = content_capacity/2;
        if( content_capacity < sum_number ) return 4;
        if( content_capacity === sum_number ) return 4;
        if( waru8 > content_capacity-sum_number ) return 3;
        if( waru2 > content_capacity-sum_number ) return 2;
        return 1;
    @endif

}


function putMenus(index, event,content_date_users,request_time) {

    axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getMenusSelect', {
      params: {
        id: event.id,
        time: request_time
      }
    })
    .then(function (response) {
      if(!ajaxCheckPublic(response.data)){return;}
      menus = response.data;
      //console.log(menus);

      var insert = insertMenus(event, content_date_users, menus, request_time);
      $('#menuTable_'+index).html(insert);
      $('#loading').hide();
      $('[data-toggle="popover"]').popover();

    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

}

function putCapacities(index, event, content_date_users, request_time) {

    //console.log('event.id: ' + event.id);
    axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getDateCapacities', {
      params: {
        content_date_id: event.id
      }
    })
    .then(function (response) {
      if(!ajaxCheckPublic(response.data)){return;}
      capacities = response.data;
      //console.log(capacities);

      var insert = insertCapacities(event, content_date_users, capacities, request_time);
      $('#capacityTable_'+index).html(insert);
      $('#loading').hide();
      $('[data-toggle="popover"]').popover();

    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

}


function putUsers(index, event, content_date_users) {

    var insert = insertUsers(event, content_date_users);
    $('#userTable_'+index).html(insert);
    $('#loading').hide();
    $('[data-toggle="popover"]').popover();

}





$(document).ready(function () {

    @if(
        $content->service===15 or
        $content->service===39 or
        $content->service===65 or
        $content->service===77 or
        $content->service===85 or
        $content->service===89 or
        $content->service===90
    )
    $('#selectYoyakuDateStart_0').change(function(){

        loading();

        var event_id = $('#yoyaku_first_dateid_0').val();
        var request_start = $('#selectYoyakuDateStart_0').val();
        request_start = moment(request_start);
        axios.get('/owner/contents/{!!$content->id!!}/getDateUsers', {
          params: {
            day: null,
            content_date_id: event_id,
            request_start: request_start.format('YYYY-MM-DD HH:mm:ss')
          }
        })
        .then(function (response) {
            if(!ajaxCheckPublic(response.data)){return;}

            //console.log(response.data);
            if(!response.data.active_user) {
                infoNotify('まだ'+date.format('MM月DD日')+'のご予約者はいません。');
                return;
            }
    
            var data = response.data.data[0];
            @if(
                $content->service===15 or
                $content->service===39 or
                $content->service===85 or
                $content->service===89
            )
            putCapacities(0, data.event, data.content_date_users_30min, data.event.start);
            @elseif(
                $content->service===65 or
                $content->service===77 or
                $content->service===90
            )
            putMenus(0, data.event, data.content_date_users_30min, data.event.start);
            @endif

        })
        .catch(function (error) {
            ajaxCheckError(error); return;
        });
        
    });

    $('#selectYoyakuDateStart_1').change(function(){

        loading();

        var event_id = $('#yoyaku_first_dateid_1').val();
        var request_start = $('#selectYoyakuDateStart_1').val();
        request_start = moment(request_start);
        axios.get('/owner/contents/{!!$content->id!!}/getDateUsers', {
          params: {
            day: null,
            content_date_id: event_id,
            request_start: request_start.format('YYYY-MM-DD HH:mm:ss')
          }
        })
        .then(function (response) {
            if(!ajaxCheckPublic(response.data)){return;}

            //console.log(response.data);
            if(!response.data.active_user) {
                infoNotify('まだ'+date.format('MM月DD日')+'のご予約者はいません。');
                return;
            }
    
            var data = response.data.data[0];
            @if(
                $content->service===15 or
                $content->service===39 or
                $content->service===85 or
                $content->service===89
            )
            putCapacities(1, data.event, data.content_date_users_30min, data.event.start);
            @elseif(
                $content->service===65 or
                $content->service===77 or
                $content->service===90
            )
            putMenus(1, data.event, data.content_date_users_30min, data.event.start);
            @endif
            
        })
        .catch(function (error) {
            ajaxCheckError(error); return;
        });
        
    });
    @endif

    
        

});




</script>