<script>
function insertCapacities(event, content_date_users, capacities, request_time)
{

    //console.log('event');
    //console.log(event);
    //console.log('content_date_users');
    //console.log(content_date_users);
    //console.log('capacities');
    //console.log(capacities);
    var insert = '';
    var description = '';
    var name = '';
    var type = '';
    var title = '';
    var person = '';

    insert += '<div class="table-div">';

    var date_capacities_summary = JSON.parse(event.capacities_summary);
    //console.log(date_capacities_summary);

    var use_capacities = [];
    if(isset(content_date_users)){
        $.each(content_date_users,function(i,active_user){
            capacities_summary = JSON.parse(active_user.capacities_summary);
            $.each(capacities_summary,function(ii,capacity_summary){
                //console.log(capacity_summary);
                for (var i = 1; i <= capacity_summary['number']; i++) {
                    //use_capacities[capacity_summary['id']][i] = active_user;
                    var capa_id = capacity_summary['id'];
                    if(!isset(use_capacities[capa_id])){ use_capacities[capa_id] = []; }
                    use_capacities[capa_id].push({'user_id':active_user.user_id, 'user_name':active_user.user_name, 'user_pic':active_user.user_pic, 'join_user_number':active_user.join_user_number, 'use_time':active_user.use_time, 'start':active_user.start, 'end':active_user.end});
                }
            });
        });
    }
    
    //console.log('use_capacities');
    //console.log(use_capacities);

    $.each(capacities,function(index,capacity){

    //console.log('capacity.id: ' + capacity.id);
    //if( isset(use_capacities[capacity.id]) ) {
    //   //console.log('is set');
    //   //console.log(use_capacities[capacity.id]);
    //}
    //return;
    if('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='active' && capacity.type>=5){
        var working = 1;
    }else if('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='stay' && capacity.type===2){
        var working = 1;
    }else{
        var working = date_capacities_summary[capacity.id]['number'];
    }
    for (var i = 1; i <= working; i++) {

        if(capacity.delete_flug===1) return true;
        if('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='stay' && capacity.type===2 && capacity.price===0){
            return true;
        }

        //check sum of number or person
        name = (isset(capacity.name)) ? capacity.name : getCapacityType('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}', capacity.type);
        description = (isset(capacity.description)) ? capacity.description : '';

        var active_on = '';
        var user_data = '';
        var key = i-1;
        if( isset(use_capacities[capacity.id]) ){
            //console.log('use_capacities first on');
            if( isset(use_capacities[capacity.id][key]) ){
                //console.log('use_capacities second on');
                //console.log(use_capacities[capacity.id][key]);
                active_on = 'bg-green-50';
                if(use_capacities[capacity.id][key]['user_pic']){
                    var pic = '<span class="pr-2"><img class="avater" src="/storage/uploads/users/' + use_capacities[capacity.id][key]['user_id'] + '/' + add_filename(use_capacities[capacity.id][key]['user_pic'],80) + '" /></span>';
                }else{
                    var pic = '<span class="pr-2"><img class="avater" src="/storage/global/img/user1_80.jpeg" /></span>';
                }
                user_data = 
                    pic +
                    '<span class="pr-2">' + use_capacities[capacity.id][key]['user_name'] + '</span>' +
                    '<span>' + use_capacities[capacity.id][key]['join_user_number'] + '名様</span>';
            }
        }

        insert += '<div class="row border_bottom f12 py-2 ' + active_on + '">';

        insert += '<div class="col-4 pl-4 pr-0">';
        if(isset(capacity.pic)){
            insert += '<img class="pr-2 pb-1" src="/storage/uploads/contents/{!!$content->id!!}/capacity/' + capacity.id + '/' + add_filename(capacity.pic,'250') + '" width="100%">';
        }else{
            insert += '<img class="pr-2" src="/storage/global/img/capa_{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}1_250.jpeg" width="100%">';
        }
        insert += '</div>';

        insert += '<div class="col-8 pl-0 center">';
        var type_name = (isset(getCapacityType('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}', capacity.type))) ? getCapacityType('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}', capacity.type) : '';
            if(type_name){
                insert += '<span class="pr-1 text-success">[' + type_name + ']</span>';
            }
        if('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='stay' && capacity.type===1){
            if(capacity.person>=1) insert += '<span class="pr-1 text-success">[' + capacity.person + '名様向け]</span>';
        }else{
            if(capacity.person>=1) insert += '<span class="pr-1 text-success">[' + capacity.person + '名様向け]</span>';
        }

        if(name) insert += '<br /><span class="f14">' + name + '_'+i+'</span><br />';

        if('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='active' && capacity.type===8) insert += '<span class="text-warning">ご利用時間は無視されます。</span><br />';

        if(capacity.area>=1) insert += '<span class="f10">(w:' + capacity.area + 'cm2)</span>';
        if(capacity.height>=1) insert += '<span class="f10">(h:' + capacity.height + 'cm)</span>';
        if(capacity.least_time>=1) insert += '<span class="f10">(最低:' + capacity.least_time + 'h～)</span>';
        if(capacity.area>=1 || capacity.height>=1 || capacity.least_time>=1) insert += '<br />';

        if(capacity.kids>=1) insert += '<span class="f10 text-info pr-1" title="~10才未満">子供可</span>';
        if(capacity.yoji>=1) insert += '<span class="f10 text-info pr-1" title="~6才未満">幼児可</span>';
        if(capacity.baby>=1) insert += '<span class="f10 text-info pr-1" title="~1才未満">赤子可</span>';
        if(capacity.nonesmoking===1){
            insert += '<span class="f10 text-info pr-1">禁煙</span>';
        }else{
            insert += '<span class="f10 text-info pr-1">喫煙</span>';
        }
        if(capacity.bus>=1) insert += '<span class="f10 text-info pr-1">お風呂</span>';
        if(capacity.toilet>=1) insert += '<span class="f10 text-info pr-1">トイレ</span>';
        if(capacity.hotspring>=1) insert += '<span class="f10 text-info pr-1">温泉</span>';
        if(capacity.refrigerator>=1) insert += '<span class="f10 text-info pr-1">冷蔵庫</span>';
        if(capacity.net>=1) insert += '<span class="f10 text-info pr-1">ネット</span>';
        if(capacity.kids>=1 || capacity.yoji>=1 || capacity.baby>=1 || capacity.nonesmoking>=1 || capacity.bus>=1 || capacity.toilet>=1 || capacity.hotspring>=1 || capacity.refrigerator>=1 || capacity.net>=1 ) insert += '<br />';
        
        if(capacity.price<=0){
            insert += '<span class="text-warning">メニュー料金のみ</span>';
        }else if(event.percent>=1 && event.percent < 100){
            insert += '<del class="f14">&yen;' + capacity.price + '</del>-><span class="f14 text-red-600">&yen;' + parseInt(capacity.price*(event.percent/100))+ '</span>';
        }else if(event.percent>=100){
            insert += '<span class="f14">&yen;' + parseInt(capacity.price*(event.percent/100)) + '</span>';
        }else{
            insert += '<span class="f14">&yen;' + capacity.price + '</span>';
        }
        @if($content->service===81)
        if(capacity.type===2){
            insert += '<br /><span class="f14 text-warning">&yen;' + capacity.price_stay + '</span><span class="f10">(宿泊者)</span>';
        }
        @endif
        
        insert += '<br /><br /><p class="center">';
        insert += '<span class="text-info">ご利用者様</span>';
        insert += '</p>';
        //console.log(user_data);
        if(isset(user_data)){
            //console.log('in');
            insert += '<p class="center">';
            insert += user_data;
            insert += '</p>';
        }else{
            //console.log('out');
            insert += '<p class="center">';
            insert += '---';
            insert += '</p>';
        }
        insert += '</div>';


        insert += '</div>';

    };
    });


    insert += '</div>';

    return insert;
}

</script>




