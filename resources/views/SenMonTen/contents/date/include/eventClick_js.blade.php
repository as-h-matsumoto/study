<script>
//console.log(event);
//console.log(event.status);
function eventClickFunc(event){
    
    if(event.status>=1 && event.status<=3){

        @if( !($content->service===81 or $content->service===91) )
        loading();
        @endif

        axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getDateUsers', {
          params: {
            content_date_id: event.id
          }
        })
        .then(function (response) {
            if(!ajaxCheckPublic(response.data)){return;}

            @if($content->service===15)
            putMenus(event, response.data.content_date_users_oneDate, event.start);
            @endif

            @if($content->service===65 or $content->service===77 or $content->service===90)
            putMenus(event, response.data.content_date_users_30min, event.start);
            @endif

            @if($content->service===39 or $content->service===85 or $content->service===89)
            putCapacities(event, response.data.content_date_users_30min, event.start);
            @endif

            @if($content->service===62 or $content->service===69 or $content->service===101)
            putMenu(event, response.data.content_date_users_oneDate);
            @endif

            @if( !($content->service===62 or $content->service===69 or $content->service===101 or $content->service===81) )
            putStarts(event, response.data.content_date_users_oneDate, response.data.dateTotalCapacities);
            @endif

            @if($content->service===39 or $content->service===85 or $content->service===89)
            putUsetimes(event.start.format('YYYY-MM-DD HH:mm:ss'), event.end.format('YYYY-MM-DD HH:mm:ss'));
            @endif

            @if($content->service===81)
            $('#selectMenuFormperson').val('');
            $('#selectMenuFormstart').html('<span>'+event.start.format('YYYY年MM月DD日 HH:mm')+'</span>');
            $('#selectMenuFormend').html('<span>'+event.end.format('YYYY年MM月DD日 HH:mm')+'</span>');
            $('#selectMenuFormnonesmoking').prop("checked",true);
            @endif

            $('#modalYoyakuOrderEventEnd').val(event.end.format('YYYY-MM-DD HH:mm:ss'));
            $('#modalSelectMenuId').val(event.id);
            $('#modalYoyakuOrder').modal('show');
            $("#calendar-view").fullCalendar("refetchEvents");
        })
        .catch(function (error) {
            ajaxCheckError(error); return;
        });

    }

}





function putStarts(event, content_date_users, dateTotalCapacities) {

        var color;
        var message;
        var status;
        var last_yayoku = '{!!$content->last_time_yoyaku!!}';
        var last_order = '{!!$content->last_time_order!!}';
        var last_yoyaku_minitus = ToMin(last_yayoku);
        var last_order_minitus = ToMin(last_order);

        //console.log(dateTotalCapacities);
        //console.log(content_date_users);
        //console.log('event.start: ' + event.start.format('YYYY-MM-DD HH:mm:ss'));

        var insert = '';
        var sHour = moment(event.start.format('YYYY-MM-DD HH:mm:ss'));
        var end1 = moment(event.end.format('YYYY-MM-DD HH:mm:ss'));
        var end2 = moment(event.end.format('YYYY-MM-DD HH:mm:ss'));
        var eHour = end1.add(-last_order_minitus, 'm');
        var yHour = end2.add(-last_yoyaku_minitus, 'm');
        var firstgoin = true;
        while(true){
            //console.log('sHour: ' + sHour.format('YYYY-MM-DD HH:mm:ss'));
            //console.log('eHour: ' + eHour.format('YYYY-MM-DD HH:mm:ss'));
            //console.log('yHour: ' + yHour.format('YYYY-MM-DD HH:mm:ss'));
            if(sHour.format('YYYY-MM-DD HH:mm:ss') > eHour.format('YYYY-MM-DD HH:mm:ss') || sHour.format('YYYY-MM-DD HH:mm:ss') > yHour.format('YYYY-MM-DD HH:mm:ss') ){
                break;
            }
            status = usedCapacities(content_date_users, sHour, dateTotalCapacities);
            //console.log('status: ' + status);
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
        $('#selectMenuFormstart').html(insert);

}

function usedCapacities(content_date_users, start, dateTotalCapacities){
    var start_plus = moment(start.format('YYYY-MM-DD HH:mm:ss'));
    start_plus.add(30, 'm');
    var status;
    var user_start;
    var user_end;
    var sum_person = 0;
    var sum_number = 0;
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
                @if( $content->service===15 or
                     $content->service===81 or
                     $content->service===65 or
                     $content->service===77 or
                     $content->service===90
                )
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

// service 4,6,7
function putMenu(event,content_date_users) {

    axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getMenuSelect', {
      params: {
        id: event.id
      }
    })
    .then(function (response) {
        var menu = response.data;
        if(!ajaxCheckPublic(menu)){return;}

        $('#selectMenuFormname').html(menu.name);

        var pic = '';
        if(isset(menu.pic)){
            pic += '<img class="" src="/storage/uploads/contents/{!!$content->id!!}/menu/' + menu.id + '/' + add_filename(menu.pic,'250') + '" width="200">';
        }else{
            pic += '<img class="" src="/storage/global/img/{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}1_250.jpeg" width="200">';
        }
        $('#selectMenuFormMenuPic').html(pic);
        
        $('#selectMenuFormstart').html(event.start.format('YYYY年MM月DD日 HH:mm'));
        var start_plus = moment(event.start.format('YYYY-MM-DD'));
        var end_plus = moment(event.end.format('YYYY-MM-DD'));
        var daydiff = end_plus.diff(start_plus, 'days');
        if(daydiff>=1){
            $('#selectMenuFormend').html(event.end.format('MM月DD日 HH:mm'));
        }else{
            $('#selectMenuFormend').html(event.end.format('HH:mm'));
        }
        
        var date_menus_summary = JSON.parse(event.menus_summary);
        var use_number = 0;
        if(isset(content_date_users)){
            $.each(content_date_users,function(i,active_user){
                menus_summary = JSON.parse(active_user.menus_summary);
                $.each(menus_summary,function(ii,menu_summary){
                    if(menu_summary.id === menu.id){
                        switch('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'){
                            case 'lesson':  summary='menus_summary'; dnop='number'; unop='person'; break;
                            case 'tour':  summary='menus_summary'; dnop='number'; unop='person'; break;
                            case 'ticket':  summary='menus_summary'; dnop='number'; unop='number'; break;
                        }
                        use_number += menu_summary[unop];
                    }
                });
            });
        }



        switch('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'){
            case 'lesson':  summary='menus_summary'; dnop='number'; unop='person'; break;
            case 'tour':  summary='menus_summary'; dnop='number'; unop='person'; break;
            case 'ticket':  summary='menus_summary'; dnop='number'; unop='number'; break;
        }
        var ans = date_menus_summary[menu.id][dnop] - use_number;
        var zan = '';
        if(ans<=0){ zan += '<span class="text-danger" title="終了" alt="終了">※終了</span>';
        }else if(ans<=5){ zan += '<span class="text-warning" title="残り'+ans+'" alt="残り'+ans+'">※残り'+ans+'</span>';
        }else{ zan += '<span class="text-info" title="残り'+ans+'" alt="残り'+ans+'">※残り'+ans+'</span>'; }
        $('#selectMenuFormzan').html(zan);

        var price = '';
        if(event.percent>=1 && event.percent < 100){
            price += '<del class="f14">&yen;' + menu.price + '</del>-><span class="f14 text-red-600">&yen;' + parseInt(menu.price*(event.percent/100))+ '</span>';
        }else if(event.percent>=100){
            price += '<span class="f14">&yen;' + parseInt(menu.price*(event.percent/100)) + '</span>';
        }else{
            price += '<span class="f14">&yen;' + menu.price + '</span>';
        }
        $('#selectMenuFormprice').html(price);
        
        @if($content->service===69)
        var to = (isset(event.to_tour_name)) ? event.to_tour_name : '現地集合' ;
        $('#selectMenuFormto_tour').html(to);
        var from = (isset(event.from_tour_name)) ? event.from_tour_name : '現地集合' ;
        $('#selectMenuFormfrom_tour').html(from);
        @endif


        $('#selectMenuFormdescription').html(event.description);
        
    
      $('#loading').hide();
      $('[data-toggle="popover"]').popover();
    
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

}


function putMenus(event,content_date_users,request_time) {

    axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getMenusSelect', {
      params: {
        id: event.id,
        time: request_time
      }
    })
    .then(function (response) {
      menus = response.data;
      if(!ajaxCheckPublic(menus)){return;}

      var insert = insertMenus(event, content_date_users, menus, request_time);
      $('#selectMenuFormMenuArea').html(insert);
      $('#loading').hide();
      $('[data-toggle="popover"]').popover();

    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

}

function putCapacities(event,content_date_users,request_time) {

    axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getMenusSelect', {
      params: {
        id: event.id,
        time: request_time
      }
    })
    .then(function (response) {
      if(!ajaxCheckPublic(response.data)){return;}
      capacities = response.data;

      var insert = insertCapacities(event, content_date_users, capacities, request_time);
      $('#selectMenuFormMenuArea').html(insert);
      $('#loading').hide();
      $('[data-toggle="popover"]').popover();

    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

}

@if($content->service===39 or $content->service===85 or $content->service===89)
function putUsetimes(time_start,time_end) {

    var min = 30;
    var insert = '';
    var time_start_plus = moment(time_start);
    var time_end_plus = moment(time_end);

    while(true){
        //console.log('startplus: ' + startPlus.format('YYYY-MM-DD HH:mm:ss'));
        //console.log('end      : ' + end.format('YYYY-MM-DD HH:mm:ss'));
        if( time_start_plus.format('YYYY-MM-DD HH:mm:ss') < time_end_plus.format('YYYY-MM-DD HH:mm:ss') ){
            insert += '<option value="'+min+'" >'+min+'分</option>';
            min += 30;
            time_start_plus.add(30, 'm');
        }else{
            break;
        }
    }

    insert += '<option value="2" >2日間</option>';
    insert += '<option value="3" >3日間</option>';
    $('#selectMenuFormuse_time').html(insert);
    
}
@endif

</script>