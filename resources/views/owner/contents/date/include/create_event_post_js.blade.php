function postCreateEvent() {

    loading();

    var form = document.getElementById("createEventForm");
    var form_data = new FormData(form);

    axios.post('/owner/contents/{!!$content->id!!}/date/edit/createEvent', form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){$("#calendar-view").fullCalendar("refetchEvents");return;}
        $("#calendar-view").fullCalendar("refetchEvents");
        $('#createEventFormMenuArea').html('');
        $('#modalCreateEvent').modal('hide');
        $('#loading').hide();
        successNotify('予約受付が開始されました。');
    })
    .catch(function (error) {
        $('#createEventFormMenuArea').html('');
        $('#modalCreateEvent').modal('hide');
        ajaxCheckError(error); return;
    });

}

//lesson4, tour6, ticket7 only
function menuPutTypeOnlyOne() {

    axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getMenus')
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}
  
        var insert = '';
        var description = '';
        var name = '';
        var type = '';
        var title = '';
        //console.log(result);

        insert += '<div class="col-sm-12">';
        insert += '<div class="box_title bg-blue-grey-50 text-auto"><strong>開催するメニューを選んでください。</strong></div>';
        insert += '<div class="box_srcollbar">';
        $.each(result,function(index,menu){
            if(menu.delete_flug===1) return true;

            name = (isset(menu.name)) ? menu.name : '';
            description = (isset(menu.description)) ? menu.description : '';
            insert += '<div class="row border_bottom">';

            insert += '<div class="col-8 pr-0 pt-2">';
            insert += '<div class="row">';
            insert += '<div class="col-sm-4 center pt-2">';
            if(isset(menu.pic)){
                insert += '<img class="pr-2 pb-2" src="/storage/uploads/contents/{!!$content->id!!}/menu/' + menu.id + '/' + add_filename(menu.pic, '250') + '" width="100%" style="max-width:150px;">';
            }else{
                insert += '<img class="pr-2 pb-2" src="/storage/global/img/{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}1_250.jpeg" width="100%" style="max-width:120px;">';
            }
            insert += '</div>';
            insert += '<div class="col-sm-8 pl-0 center">';
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

            if(menu.price>=1){
                insert += '<p><span class="f14">&yen;' + menu.price + '</span></p>';
            }
            insert += '<a tabindex="0" role="button" data-toggle="popover" ';
            insert += 'data-placement="top" data-trigger="focus" title="' + name + '" ';
            insert += 'data-img="" ';
            insert += 'data-content="' + description + '">';
            insert += truncate(menu.description, 30) + '</a>';
            insert += '</div>';
            insert += '</div>';
            insert += '</div>';

            insert += '<div class="col p-0 pt-2 center">';
            if(menu.price>=1){
                insert += '<p><label>料金</label><br /><input class="" type="number" name="publicMenuPrice' + menu.id + '" value="'+menu.price+'" min="1" style="width:60px !important;" /></p>';
            }
            //if(menu.person>=1 && menu.price>=1){
            if(menu.person>=1){
                insert += '<p><label class="f10">最低予約人数</label><br /><input class="" type="number" name="publicMenuPerson' + menu.id + '" value="'+menu.person+'" min="1" style="width:50px !important;" /></p>';
            }
            if(menu.number>=1){
                insert += '<p><label>枠数</label><br /><input class="" type="number" name="publicMenuNumber' + menu.id + '" value="'+menu.number+'" min="1" style="width:50px !important;" /></p>';
            }
            insert += '<p><label><strong>選択</strong></label><br /><input onclick="selectMenuFunction('+menu.id+')" class="mycheckbox" type="checkbox" name="publicMenu' + menu.id + '" id="publicMenu' + menu.id + '" value="'+menu.id+'" /></p>';
    
            insert += '</div>';
            insert += '</div>';
        });

        insert += '</div>';
        insert += '</div>';

        $('#createEventFormMenuArea').html(insert);

        $('[data-toggle="popover"]').popover();
        $('#loading').hide();

    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });
    
}


var capacityPutCount = true;
function capacityPut() {

    if(capacityPutCount){
        capacityPutCount = false;
    
    axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getCapacities')
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}

        var insert = '';
        var description = '';
        var name = '';
        var type = '';
        var title = '';
        //console.log(result);
    
        insert += '<div class="col-sm-12">';
        insert += '<div class="box_title bg-blue-grey-50 text-auto"><strong>利用する{!!UtilYoyaku::getNewContentCapacity($content->service)!!}にチェックを入れてください。</strong></div>';
        insert += '<div class="box_srcollbar">';
        $.each(result,function(index,capacity){
            if(capacity.delete_flug===1) return true;

            //check sum of number or person
            name = (isset(capacity.name)) ? capacity.name : getCapacityType('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}', capacity.type);
            description = (isset(capacity.description)) ? capacity.description : '';
    
            insert += '<div class="row border_bottom f12 py-2">';

            insert += '<div class="col-9 pr-0 pt-2">';
            insert += '<div class="row">';
            insert += '<div class="col-4 pl-4 pr-0 pt-2">';
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
            }else if(capacity.nonesmoking===0){
                insert += '<span class="f10 text-info pr-1">喫煙</span>';
            }
            if(capacity.bus>=1) insert += '<span class="f10 text-info pr-1">お風呂</span>';
            if(capacity.toilet>=1) insert += '<span class="f10 text-info pr-1">トイレ</span>';
            if(capacity.hotspring>=1) insert += '<span class="f10 text-info pr-1">温泉</span>';
            if(capacity.refrigerator>=1) insert += '<span class="f10 text-info pr-1">冷蔵庫</span>';
            if(capacity.net>=1) insert += '<span class="f10 text-info pr-1">ネット</span>';
            if(capacity.kids>=1 || capacity.yoji>=1 || capacity.baby>=1 || capacity.nonesmoking>=1 || capacity.bus>=1 || capacity.toilet>=1 || capacity.hotspring>=1 || capacity.refrigerator>=1 || capacity.net>=1 ) insert += '<br />';
            
            if(capacity.price>=1) insert += '<span class="f14">&yen;' + capacity.price + '</span>';
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
            insert += truncate(capacity.description, 30) + '</a></div>';

            insert += '</div>';
            insert += '</div>';

            insert += '<div class="col p-0 pt-2 pr-2 center">';
            if('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='active' && capacity.type!==8 && capacity.type>=5){
                insert += '<p><label>収容人数</label><br /><input class="" type="number" name="publicCapacityPerson' + capacity.id + '" value="'+capacity.person+'" min="1" style="width:50px !important;" /></p>';
            }
            if(
                !( ('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='active' && capacity.type>=5) || ('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='stay' && capacity.type===2 ) )
            ){
                insert += '<p><label>'+Nname+'数</label><br /><input class="" type="number" name="publicCapacityNumber' + capacity.id + '" value="'+capacity.number+'" min="1" style="width:50px !important;" /></p>';
            }
            insert += '<p><label><strong>選択</strong></label><br /><input class="mycheckboxcapacity" type="checkbox" name="publicCapacity' + capacity.id + '" value="'+capacity.id+'" checked /></p>';
    
            insert += '</div>';
            insert += '</div>';
        });
        insert += '</div>';
        insert += '</div>';

        $('#createEventFormCapacityArea').html(insert);
        $('[data-toggle="popover"]').popover();
        $('#loading').hide();

    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });
    }else{
        $('#loading').hide();
    }
    
}


