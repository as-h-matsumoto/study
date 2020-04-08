

function putMenusAndCapacities(event) {

    var menus = JSON.parse(event.menus_desc);
    var menus_summary = JSON.parse(event.menus_summary);

    var capacities = JSON.parse(event.capacities_desc);
    var capacities_summary = JSON.parse(event.capacities_summary);

    var insert = '';
    var description = '';
    var name = '';
    var type = '';
    var title = '';

    @if($content->service===91)
    insert += '<table class="table table-hover">';
    insert += '<thead>';
    insert += '<tr><th>面接ルーム</th></tr>';
    insert += '</thead>';
    insert += '<tbody>';
    $.each(capacities,function(index,capacity){
        switch({!!$content->service!!}){
            case 91: summary='capacities_summary'; dnop='number'; unop='number'; break;
        }
        name = (isset(capacity.name)) ? capacity.name : getCapacityType('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}', capacity.type);
        description = (isset(capacity.description)) ? capacity.description : '';
        insert += '<tr>';
        insert += '<th scope="row">';

        insert += '<div class="row">';
        insert += '<div class="col-4 pl-4 pr-0">';
        if(isset(capacity.pic)){
            insert += '<img class="pr-2 pb-1" src="/storage/uploads/contents/{!!$content->id!!}/capacity/' + capacity.id + '/' + add_filename(capacity.pic,'250') + '" width="100%">';
        }else{
            insert += '<img class="pr-2" src="/storage/global/img/capa_{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}1_250.jpeg" width="100%">';
        }
        insert += '</div>';

        insert += '<div class="col-8 pl-0 center">';

        if(name) insert += '<br /><span class="f14">' + name + '</span><br /><br />';
        
        insert += '<a tabindex="0" class="p-0 m-0" role="button" data-toggle="popover" ';
        insert += 'data-placement="top" data-trigger="focus" title="' + name + '" ';
        insert += 'data-img="" ';
        insert += 'data-content="' + description + '">';
        insert += truncate(capacity.description, 30) + '</a>';

        insert += '</div>';





        insert += '</th>';
        insert += '</tr>';
    });
    insert += '</tbody>';
    insert += '</table>';



    @else



    insert += '<table class="table table-hover">';
    insert += '<thead>';
    insert += '<tr><th style="width:60%">メニュー</th><th>料金</th><th>個数</th></tr>';
    insert += '</thead>';
    insert += '<tbody>';
    $.each(menus,function(index,menu){
        switch('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'){
            case 'food':  summary='menus_summary'; dnop='number'; unop=(menu.type===1)?'number':'person'; break;
            case 'lesson':  summary='menus_summary'; dnop='number'; unop='person'; break;
            case 'spasalon':  summary='menus_summary'; dnop='simultaneously'; unop='person'; break;
            case 'tour':  summary='menus_summary'; dnop='number'; unop='person'; break;
            case 'ticket':  summary='menus_summary'; dnop='number'; unop='number'; break;
            case 'hairsalon':  summary='menus_summary'; dnop='simultaneously'; unop='person'; break;
            case 'stay':  summary='menus_summary'; dnop='number'; unop='person'; break;
            case 'divination':  summary='menus_summary'; dnop='simultaneously'; unop='person'; break;
        }
        name = (isset(menu.name)) ? menu.name : '';
        description = (isset(menu.description)) ? menu.description : '';

        insert += '<tr>';
        insert += '<th scope="row">';



        insert += '<div class="row">';
        insert += '<div class="col-4 pl-4 pr-0">';
        if(isset(menu.pic)){
            insert += '<img class="pr-2 pb-1" src="/storage/uploads/contents/{!!$content->id!!}/menu/' + menu.id + '/' + add_filename(menu.pic, '250') + '" width="100%">';
        }else{
            insert += '<img class="pr-2" src="/storage/global/img/{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}1_250.jpeg" width="100%">';
        }
        insert += '</div>';
        insert += '<div class="col-8 pl-0 center">';
        if({!!$content->service!!}===15){
                var type_name = (menu.type==1) ? '単品' : 'コース';
                insert += '<span class="pr-1 text-info">[' + type_name + ']</span>';
        }
        if(menu.time>=2){
            insert += '<span class="">';
            switch('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'){
                case 'food': insert += '制限'; break;
                case 'lesson': insert += 'レッスン'; break;
                case 'spasalon': insert += '施術'; break;
                case 'tour': insert += 'ツアー'; break;
                case 'ticket': insert += '開催'; break;
                case 'hairsalon': insert += '施術'; break;
                case 'stay': insert += '宿泊'; break;
                case 'divination': insert += '占い'; break;
            }
            insert += (menu.time<=29) ? '期間' : '時間';
            insert += menu.time;
            insert += (menu.time<=29) ? '日' : '分';
            insert += '</span>';
        }
        if(menu.person>=2) insert += '<span class="">(' + menu.person + '名様～)</span>';

        if(name) insert += '<p><span class="f14 text-success">' + name + '</span></p>';
        
        insert += '<a tabindex="0" role="button" data-toggle="popover" ';
        insert += 'data-placement="top" data-trigger="focus" title="' + name + '" ';
        insert += 'data-img="" ';
        insert += 'data-content="' + description + '">';
        insert += truncate(menu.description, 30) + '</a>';



        insert += '</th>';
        insert += '<td>&yen;' + menus_summary[menu.id].price + '</td>';
        insert += '<td>' + menus_summary[menu.id][unop] + '</td>';
        insert += '</tr>';
    });
    $.each(capacities,function(index,capacity){
        switch('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'){
            case 'food':  summary='capacities_summary'; dnop='number'; unop='number'; break;
            case 'active':  summary='capacities_summary'; dnop=(capacity.type<=4)?'number':'person'; unop=dnop; break;
            case 'stay':  summary='capacities_summary'; dnop='number'; unop='number'; break;
            case 'studio': summary='capacities_summary'; dnop='number'; unop='number'; break;
            case 'kaigi': summary='capacities_summary'; dnop='number'; unop='number'; break;
            case 'recruit': summary='capacities_summary'; dnop='number'; unop='number'; break;
        }
        name = (isset(capacity.name)) ? capacity.name : getCapacityType('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}', capacity.type);
        description = (isset(capacity.description)) ? capacity.description : '';
        insert += '<tr>';
        insert += '<th scope="row">';


        insert += '<div class="row">';
        insert += '<div class="col-4 pl-4 pr-0">';
        if(isset(capacity.pic)){
            insert += '<img class="pr-2 pb-1" src="/storage/uploads/contents/{!!$content->id!!}/capacity/' + capacity.id + '/' + add_filename(capacity.pic,'250') + '" width="100%">';
        }else{
            insert += '<img class="pr-2" src="/storage/global/img/capa_{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}1_250.jpeg" width="100%">';
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

        if(name) insert += '<br /><span class="f14">' + name + '</span><br />';

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



        insert += '</th>';
        insert += '<td>&yen;' + capacities_summary[capacity.id].price + '</td>';
        insert += '<td>' + capacities_summary[capacity.id][unop] + '</td>';
        insert += '</tr>';
    });
    insert += '</tbody>';
    insert += '</table>';
    @endif
    
    return insert;

}

// service 2,10,11 only
@include('owner/contents/date/include/put_usetime_js')

