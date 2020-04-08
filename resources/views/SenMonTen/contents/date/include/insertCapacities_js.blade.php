<script>
function insertCapacities(event, content_date_users, capacities, request_time)
{

    //console.log(event);
    var insert = '';
    var description = '';
    var name = '';
    var type = '';
    var title = '';
    var person = '';

    var summary;
    var dnop;
    var unop;

    insert += '<div class="col-sm-12">';
    insert += '<div class="box_title bg-blue-grey-50 text-auto"><strong>利用する @if($content->service===81){!!'宿泊ルームや施設'!!}@else{!!'メニュー'!!}@endif にチェックを入れてください。</strong></div>';
    insert += '<div class="box_srcollbar">';

    var date_capacities_summary = JSON.parse(event.capacities_summary);
    //console.log(date_capacities_summary);

    $.each(capacities,function(index,capacity){
        if(capacity.delete_flug===1) return true;
        if('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='stay' && capacity.type===2 && capacity.price===0){
            return true;
        }

        //check sum of number or person
        name = (isset(capacity.name)) ? capacity.name : getCapacityType('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}', capacity.type);
        description = (isset(capacity.description)) ? capacity.description : '';

        insert += '<div class="row border_bottom f12 py-2">';
        insert += '<div class="col-9 pr-0">';
        
        insert += '<div class="row">';
        insert += '<div class="col-4 pl-4 pr-0">';
        if(isset(capacity.pic)){
            insert += '<img class="pr-2 pb-1" src="/storage/uploads/contents/{!!$content->id!!}/capacity/' + capacity.id + '/' + add_filename(capacity.pic,'250') + '" width="100%">';
        }else{
            insert += '<img class="pr-2" src="/storage/global/img/capa_{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}1_400.jpeg" width="100%">';
        }
        insert += '<div class="pl-2">';
        if('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='stay' && capacity.type===1){
            if(capacity.person>=1) insert += '<span class="pr-1">' + capacity.person + '名様向け</span><br />';
        }

        insert += '</div>';
        insert += '</div>';
        insert += '<div class="col-8 pl-0 center">';
        var type_name = (isset(getCapacityType('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}', capacity.type))) ? getCapacityType('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}', capacity.type) : '';
            if(type_name){
                insert += '<span class="pr-1 text-success">[' + type_name + ']</span>';
            }

        var use_number = 0;
        if(isset(content_date_users)){
            
            $.each(content_date_users,function(i,active_user){
                
                // check user done
                @if($content->service===39 or $content->service===85 or $content->service===89)
                    var active_user_end = moment(active_user.end);
                    
                    if( active_user_end.format('YYYY-MM-DD HH:mm:ss') <= request_time.format('YYYY-MM-DD HH:mm:ss') ) return true;
                @endif

                capacities_summary = JSON.parse(active_user.capacities_summary);
                $.each(capacities_summary,function(ii,capacity_summary){
                    if(capacity_summary.id === capacity.id){
                        switch('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'){
                            case 'active':  summary='capacities_summary'; dnop=(capacity_summary.type<=4)?'number':'person'; unop=dnop; break;
                            case 'stay':  summary='capacities_summary'; dnop='number'; unop='number'; break; //dnop 4room 用意, unop 1room 利用
                            case 'studio': summary='capacities_summary'; dnop='number'; unop='number'; break;
                            case 'kaigi': summary='capacities_summary'; dnop='number'; unop='number'; break;
                        }
                        use_number += capacity_summary[unop];
                    }
                });
            });
        }
        switch('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'){
            case 'active':  summary='capacities_summary'; dnop=(capacity.type<=4)?'number':'person'; unop=dnop; break;
            case 'stay':  summary='capacities_summary'; dnop='number'; unop='number'; break;
            case 'studio': summary='capacities_summary'; dnop='number'; unop='number'; break;
            case 'kaigi': summary='capacities_summary'; dnop='number'; unop='number'; break;
        }

        //console.log('capacity.id: ' + capacity.id + ' dnop: ' + dnop);
        //console.log('date_capacities_summary: ');
        //console.log(date_capacities_summary);
        //console.log('date_capacities_summary[capacity.id][dnop]: ' + date_capacities_summary[capacity.id][dnop]);
        //console.log('use_number: ' + use_number);
        
        var ans = date_capacities_summary[capacity.id][dnop] - use_number;
        if('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='stay' && capacity.type===2){
        }else if('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='active' && capacity.type===8){
            //console.log('in?');
            ans = 100;
        }else if(ans<=0){ insert += '<span class="text-danger" title="終了" alt="終了">※終了</span>';
        }else if(ans<=5){ insert += '<span class="text-danger" title="残り'+ans+'" alt="残り'+ans+'">※残り'+ans+'</span>';
        //}else{ insert += '<span title="残り'+ans+'" alt="残り'+ans+'">※</span>';
        }
        
        if(name) insert += '<br /><span class="f14">' + name + '</span><br />';

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
        
        var getNnameValue = getNname('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}',capacity);
        var Nname = getNnameValue.Nname;
        insert += getNnameValue.insert;
        
        insert += '</div>';

        insert += '<div class="col-12 center pt-2">';
        insert += '<a tabindex="0" class="p-0 m-0" role="button" data-toggle="popover" ';
        insert += 'data-placement="top" data-trigger="focus" title="' + name + '" ';
        insert += 'data-img="" ';
        insert += 'data-content="' + description + '">';
        insert += truncate(capacity.description, 30) + '</a>';
        insert += '</div>';
        insert += '</div>';
        insert += '</div>';
        insert += '<div class="col center">';
        

        @if($content->service===81)
        insert += '<p class="pt-10"><label>利用</label><br /><input class="mycheckbox" type="checkbox" name="capacityId' + capacity.id + '" value="'+capacity.id+'"  /></p>';

        @else
        var disabled = (ans<=0) ?'disabled':'';
        var pt10 = '';
        if(unop==='number'){
            insert += '<p><label>利用数</label><br /><input class="center" type="number" name="capacityNumber' + capacity.id + '" value="1" min="1" max="' + ans + '" style="width:50px !important;" '+disabled+' /></th>';
        }else{
            pt10 = 'pt-10';
        }
        insert += '<p class="'+pt10+'"><label>利用</label><br /><input class="mycheckbox" type="checkbox" name="capacityId' + capacity.id + '" value="'+capacity.id+'" '+disabled+' /></th></tr>';
        insert += '</p>';
        @endif


        insert += '</div>';
        insert += '</div>';
    });


    insert += '</div>';
    insert += '</div>';

    return insert;
}

</script>




