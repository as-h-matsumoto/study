$(function () {
  $('#modalEvent').on('hide.bs.modal', function () {
    $('#modalEventFormMenuAreaPublic').html('');
    $('#modalEventFormMenuAreaLunch').html('');
    $('#modalEventFormCapacityAreaPublic').html('');
  })
});

function postModalEvent() {

    loading();

    var form = document.getElementById("modalEventForm");
    var form_data = new FormData(form);

    axios.post('/owner/contents/{!!$content->id!!}/date/edit/oneDate', form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){$("#calendar-view").fullCalendar("refetchEvents");return;}
        $('#loading').hide();
        $('#modalEvent').modal('hide');
        successNotify('変更しました。');
        $('#modalEventFormMenuAreaPublic').html('');
        $('#modalEventFormMenuAreaLunch').html('');
        $('#modalEventFormCapacityAreaPublic').html('');
        $("#calendar-view").fullCalendar("refetchEvents");
    })
    .catch(function (error) {
        $('#modalEvent').modal('hide');
        ajaxCheckError(error); return;
    });

}

function deleteModalEvent() {

    loading();
    $('#modalEvent').modal('hide');

    var form = document.getElementById("modalEventForm");
    var form_data = new FormData(form);

    axios.post('/owner/contents/{!!$content->id!!}/date/edit/oneDate/delete', form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){$("#calendar-view").fullCalendar("refetchEvents");return;}

        if(result.action===1){
            $('#deleteModalEventFormcontent_date_create_number').val(result.content_date_create_number);
            $('#deleteModalEventRelation').modal('show');
        }else if(result.action===0){
            successNotify('削除しました。');
        }

        $('#loading').hide();
        $("#calendar-view").fullCalendar("refetchEvents");
    })
    .catch(function (error) {
        $('#modalEvent').modal('hide');
        ajaxCheckError(error); return;
    });

}



function postDeleteEventRelation() {

    loading();
    $('#deleteModalEventRelation').modal('hide');

    var form = document.getElementById("deleteModalEventRelationForm");
    var form_data = new FormData(form);

    axios.post('/owner/contents/{!!$content->id!!}/date/edit/oneDate/relation/delete', form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){$("#calendar-view").fullCalendar("refetchEvents");return;}

        if(result.action===1){
            successNotify('ご予約者がいるスケジュール以外削除しました。');
        }else if(result.action===0){
            successNotify('削除しました。');
        }
        location.reload();
        //$('#loading').hide();
        //$("#calendar-view").fullCalendar("refetchEvents");
    })
    .catch(function (error) {
        $('#modalEvent').modal('hide');
        ajaxCheckError(error); return;
    });

}



function menuPutEvent(event) {

    var menus = JSON.parse(event.menu_ids);
    var menus_summary = JSON.parse(event.menus_summary);
    var lunchs = JSON.parse(event.lunch_ids);
    var lunch = false;
    if(lunchs.length){
        lunch = true;
        var lunchs_summary = JSON.parse(event.lunchs_summary);
    }

    axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getMenus')
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}
  
        var checked = '';

        var insert = '';
        var description = '';
        var name = '';
        var type = '';
        var title = '';
        //console.log(result);

        insert += '<div class="col-sm-12">';
        insert += '<div class="box_title bg-blue-grey-50 text-auto"><strong>利用するメニューにチェックを入れてください。</strong></div>';
        insert += '<div class="box_srcollbar">';
        $.each(result,function(index,menu){
            if(menu.delete_flug===1) return true;

            name = (isset(menu.name)) ? menu.name : '';
            description = (isset(menu.description)) ? menu.description : '';

            insert += '<div class="row border_bottom">';

            insert += '<div class="@if($content->service===62 or $content->service===69 or $content->service===101){!!'col-8'!!}@else{!!'col-9'!!}@endif pr-0 pt-2 center">';
            insert += '<div class="row">';
            insert += '<div class="@if($content->service===62 or $content->service===69 or $content->service===101){!!'col-sm-12 mb-2'!!}@else{!!'col-4 pl-4'!!}@endif pr-0 pt-2">';
            if(isset(menu.pic)){
                insert += '<img class="pr-2 pb-1" src="/storage/uploads/contents/{!!$content->id!!}/menu/' + menu.id + '/' + add_filename(menu.pic, '250') + '" width="100%" style="max-width:150px;">';
            }else{
                insert += '<img class="pr-2" src="/storage/global/img/{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}1_250.jpeg" width="100%" style="max-width:150px;">';
            }
            insert += '</div>';
            insert += '<div class="@if($content->service===62 or $content->service===69 or $content->service===101){!!'col-sm-12'!!}@else{!!'col-8 pl-0'!!}@endif center">';
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
                insert += '<p>';
                if(event.percent>=1 && event.percent < 100){
                    insert += '<del class="f14">&yen;' + menu.price + '</del>-><span class="f14 text-red-600">&yen;' + parseInt(menu.price*(event.percent/100))+ '</span>';
                }else if(event.percent>=100){
                    insert += '<span class="f14">&yen;' + parseInt(menu.price*(event.percent/100)) + '</span>';
                }else{
                    insert += '<span class="f14">&yen;' + menu.price + '</span>';
                }
                insert += '</p>';
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

            @if($content->service===62 or $content->service===69 or $content->service===101)
            if(menu.price>=1){
                var price = (isset(menus_summary[menu.id])) ? menus_summary[menu.id].price : menu.price;
                insert += '<p><label>料金</label><br /><input class="" type="number" name="publicMenuPrice' + menu.id + '" value="'+price+'" min="1" style="width:50px !important;" /></p>';
            }
            @endif

            @if($content->service===65 or $content->service===77 or $content->service===90)
                var simultaneously = (isset(menus_summary[menu.id])) ? menus_summary[menu.id].simultaneously : menu.simultaneously;
                insert += '<p><label class="f10">同時施術人数</label><br /><input class="" type="number" name="publicMenuSimultaneously' + menu.id + '" value="'+simultaneously+'" min="1" style="width:50px !important;" /></p>';
            @endif

            if(
                ( '{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='food' && menu.type===2 ) ||
                ( '{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='lesson' ) ||
                ( '{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='tour' )
            ){
                var person = (isset(menus_summary[menu.id])) ? menus_summary[menu.id].person : menu.person;
                insert += '<p><label class="f10">最低申込人数</label><br /><input class="" type="number" name="publicMenuPerson' + menu.id + '" value="'+person+'" min="1" style="width:50px !important;" /></p>';
            }

            if(
                ( '{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='food' ) ||
                ( '{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='lesson' ) ||
                ( '{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='tour' ) ||
                ( '{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='ticket' ) ||
                ( '{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='stay' )
            ){
                var number = (isset(menus_summary[menu.id])) ? menus_summary[menu.id].number : menu.number;
                var Nname = '';
                switch('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'){
                    case 'food': Nname += '提供'; break;
                    case 'lesson': Nname += '枠'; break;
                    case 'tour': Nname += '枠'; break;
                    case 'ticket': Nname += '枚'; break;
                    case 'stay': Nname += '提供'; break;
                }
                insert += '<p><label>'+Nname+'数</label><br /><input class="" type="number" name="publicMenuNumber' + menu.id + '" value="'+number+'" min="1" style="width:50px !important;" /></p>';
            }

            var checked = (menus.includes(menu.id)) ? 'checked' : '';
            insert += '<p><label><strong>選択</strong></label><br /><input @if($content->service===62 or $content->service===69 or $content->service===101) onclick="selectMenuFunction('+menu.id+')" @endif class="mycheckbox" type="checkbox" name="publicMenu' + menu.id + '" id="publicMenu' + menu.id + '" value="'+menu.id+'" ' + checked + ' /></p>';
    
            insert += '</div>';
            insert += '</div>';

        });
        insert += '</div>';
        insert += '</div>';
        $('#modalEventFormMenuAreaPublic').html(insert);


        @if($content->service===15)
        if(lunch){
        insert = '<div class="col-sm-12 mt-4">';
        insert += '<div class="box_title bg-blue-grey-50 text-auto"><strong>利用するランチメニューにチェックを入れてください。</strong></div>';
        insert += '<div class="box_srcollbar">';
        $.each(result,function(index,menu){
            if(menu.delete_flug===1) return true;

            name = (isset(menu.name)) ? menu.name : '';
            description = (isset(menu.description)) ? menu.description : '';

            insert += '<div class="row border_bottom">';

            insert += '<div class="col-9 pr-0 pt-2">';
            insert += '<div class="row">';
            insert += '<div class="col-4 pl-4 pr-0 pt-2 center">';
            if(isset(menu.pic)){
                insert += '<img class="pr-2 pb-1" src="/storage/uploads/contents/{!!$content->id!!}/menu/' + menu.id + '/' + add_filename(menu.pic, '250') + '" width="100%" style="max-width:150px;">';
            }else{
                insert += '<img class="pr-2" src="/storage/global/img/{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}1_250.jpeg" width="100%" style="max-width:150px;">';
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

            if(menu.price>=1){
                insert += '<p>';
                if(event.percent>=1 && event.percent < 100){
                    insert += '<del class="f14">&yen;' + menu.price + '</del>-><span class="f14 text-red-600">&yen;' + parseInt(menu.price*(event.percent/100))+ '</span>';
                }else if(event.percent>=100){
                    insert += '<span class="f14">&yen;' + parseInt(menu.price*(event.percent/100)) + '</span>';
                }else{
                    insert += '<span class="f14">&yen;' + menu.price + '</span>';
                }
                insert += '</p>';
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
            var person = (isset(lunchs_summary[menu.id])) ? lunchs_summary[menu.id].person : menu.person;
            insert += '<p><label class="f10">最低申込人数</label><br /><input class="" type="number" name="lunchMenuPerson' + menu.id + '" value="'+person+'" min="1" style="width:50px !important;" /></p>';
            var number = (isset(lunchs_summary[menu.id])) ? lunchs_summary[menu.id].number : menu.number;
            insert += '<p><label>提供数</label><br /><input class="" type="number" name="lunchMenuNumber' + menu.id + '" value="'+number+'" min="1" style="width:50px !important;" /></p>';

            var checked = (lunchs.includes(menu.id)) ? 'checked' : '';
            insert += '<p><label><strong>選択</strong></label><br /><input @if($content->service===62 or $content->service===69 or $content->service===101) onclick="selectMenuFunction('+menu.id+')" @endif class="mycheckbox" type="checkbox" name="lunchMenu' + menu.id + '" id="lunchMenu' + menu.id + '" value="'+menu.id+'" ' + checked + ' /></p>';
    
            insert += '</div>';
            insert += '</div>';

        });

        insert += '</div>';
        insert += '<span class="help-block"><span class="text-red-500">※</span>10:30~15:00の間、且つ、この時間内で営業している時間だけ選択したメニューが予約できます。</span>';
        insert += '</div>';
        $('#modalEventFormMenuAreaLunch').html(insert);
        }
        @endif

        $('#loading').hide();
        $('[data-toggle="popover"]').popover();

    })
    .catch(function (error) {
      $ajaxCheckError(error); return;
    });
}


function capacityPutEvent(event) {

    var capacities = JSON.parse(event.capacity_ids);
    var capacities_summary = JSON.parse(event.capacities_summary);

    axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getCapacities')
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}

        var checked = '';

        var insert = '';
        var description = '';
        var name = '';
        var type = '';
        var title = '';
        //console.log(capacities);
        //console.log(capacities_summary);
    
        insert += '<div class="col-sm-12">';
        insert += '<div class="box_title bg-blue-grey-50 text-auto"><strong>利用する{!!UtilYoyaku::getNewContentCapacity($content->service)!!}にチェックを入れてください。</strong></div>';
        insert += '<div class="box_srcollbar">';
        $.each(result,function(index,capacity){
            if(capacity.delete_flug===1) return true;

            name = (isset(capacity.name)) ? capacity.name : getCapacityType('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}', capacity.type);
            description = (isset(capacity.description)) ? capacity.description : '';

            insert += '<div class="row border_bottom f12 py-2">';

            insert += '<div class="col-9 pr-0 pt-2">';
            insert += '<div class="row">';
            insert += '<div class="col-4 pl-4 pr-0 pt-2 center">';
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

            if(capacity.price>=1){ 
                insert += '<p>';
                if(event.percent>=1 && event.percent < 100){
                    insert += '<del class="f14">&yen;' + capacity.price + '</del>-><span class="f14 text-red-600">&yen;' + parseInt(capacity.price*(event.percent/100))+ '</span>';
                }else if(event.percent>=100){
                    insert += '<span class="f14">&yen;' + parseInt(capacity.price*(event.percent/100)) + '</span>';
                }else{
                    insert += '<span class="f14">&yen;' + capacity.price + '</span>';
                }
                insert += '</p>';
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
            insert += truncate(capacity.description, 30) + '</a></div>';

            insert += '</div>';
            insert += '</div>';

            insert += '<div class="col p-0 pt-2 pr-2 center">';
            
            if('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='active' && capacity.type!==8 && capacity.type>=5){
                var person = (isset(capacities_summary[capacity.id])) ? capacities_summary[capacity.id].person : capacity.person;
                insert += '<p><label class="f10">収容人数</label><br /><input class="" type="number" name="publicCapacityPerson' + capacity.id + '" value="'+person+'" min="1" style="width:50px !important;" /></p>';
            }
            if(
                !( ('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='active' && capacity.type>=5) || ('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='stay' && capacity.type===2 ) )
            ){
                var number = (isset(capacities_summary[capacity.id])) ? capacities_summary[capacity.id].number : capacity.number;
                insert += '<p><label>'+Nname+'数</label><br /><input class="" type="number" name="publicCapacityNumber' + capacity.id + '" value="'+number+'" min="1" style="width:50px !important;" /></p>';
            }
            var checked = (capacities.includes(capacity.id)) ? 'checked' : '';
            insert += '<p><label><strong>選択</strong></label><br /><input class="mycheckboxcapacity" type="checkbox" name="publicCapacity' + capacity.id + '" value="'+capacity.id+'" ' + checked + ' /></p>';
    
            insert += '</div>';
            insert += '</div>';

        });
        insert += '</div>';
        insert += '</div>';

        $('#modalEventFormCapacityAreaPublic').html(insert);
        $('#loading').hide();
        $('[data-toggle="popover"]').popover();

    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

}




