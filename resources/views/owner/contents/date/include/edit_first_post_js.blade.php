function postFirstContentDate() {

    loading();

    var form = document.getElementById("firstContentDateForm");
    var form_data = new FormData(form);

    axios.post('/owner/contents/{!!$content->id!!}/date/edit/firstDate', form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){$("#calendar-view").fullCalendar("refetchEvents");return;}
        $("#calendar-view").fullCalendar("refetchEvents");
        $('#modalFirstContentDate').modal('hide');
        $('#loading').hide();
        successNotify('予約受付が開始されました。');
        setTimeout("location.reload(true)",1000);
    })
    .catch(function (error) {
        $('#modalFirstContentDate').modal('hide');
        ajaxCheckError(error); return;
    });

}

@if($content->service===15)
function menuChange() {
    var menuType = parseInt($('#FirstContentDateFormMenuTypeSelect').val());
    if(menuType===2){
        $('#FirstContentDateFormMenuAreaLunch').show();
    }else{
        $('#FirstContentDateFormMenuAreaLunch').hide();
    }
}
@endif

var menuPutCount = true;
function menuPut() {

    loading();

    $('#FirstContentDateFormMenuAreaLunch').hide();
    if(menuPutCount){
        menuPutCount = false;
    
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
        insert += '<div class="box_title bg-blue-grey-50 text-auto"><strong>利用するメニューにチェックを入れてください。</strong></div>';
        insert += '<div class="box_srcollbar">';
        
        $.each(result,function(index,menu){
            //console.log(menu);
            if(menu.delete_flug===1) return true;
            
            name = (isset(menu.name)) ? menu.name : '';
            description = (isset(menu.description)) ? menu.description : '';
            insert += '<div class="row border_bottom">';
            

            insert += '<div class="col-9 pr-0 pt-2">';
            insert += '<div class="row">';
            insert += '<div class="col-4 pl-4 pr-0 pt-2">';
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
            @if($content->service===65 or $content->service===77 or $content->service===90)
            insert += '<p><label class="f10">同時施術人数</label><br /><input class="" type="number" name="publicMenuSimultaneously' + menu.id + '" value="'+menu.simultaneously+'" min="1" style="width:50px !important;" /></p>';
            @endif
            if(
                ( '{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='food' && menu.type===2 ) ||
                ( '{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='lesson' ) ||
                ( '{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='tour' )
            ){
                insert += '<p><label class="f10">最低申込人数</label><br /><input class="" type="number" name="publicMenuPerson' + menu.id + '" value="'+menu.person+'" min="1" style="width:50px !important;" /></p>';
            }
            if(
                ( '{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='food' ) ||
                ( '{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='lesson' ) ||
                ( '{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='tour' ) ||
                ( '{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='ticket' ) ||
                ( '{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='stay' )
            ){
                var Nname = '';
                switch('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'){
                    case 'food': Nname += '提供'; break;
                    case 'lesson': Nname += '枠'; break;
                    case 'tour': Nname += '枠'; break;
                    case 'ticket': Nname += '枚'; break;
                    case 'stay': Nname += '提供'; break;
                }
                insert += '<p><label>'+Nname+'数</label><br /><input class="" type="number" name="publicMenuNumber' + menu.id + '" value="'+menu.number+'" min="1" style="width:50px !important;" /></p>';
            }
            insert += '<p><label><strong>選択</strong></label><br /><input class="mycheckbox" type="checkbox" name="publicMenu' + menu.id + '" id="publicMenu' + menu.id + '" value="'+menu.id+'" checked /></p>';

            insert += '</div>';
            insert += '</div>';
        });
        insert += '</div>';
        insert += '</div>';
        $('#FirstContentDateFormMenuAreaPublic').html(insert);



        @if($content->service===15)
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
            insert += '<div class="col-4 pl-4 pr-0 pt-2">';
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
            insert += '<p><label class="f10">最低申込人数</label><br /><input class="" type="number" name="lunchMenuPerson' + menu.id + '" value="'+menu.person+'" min="1" style="width:50px !important;" /></p>';
            insert += '<p><label>提供数</label><br /><input class="" type="number" name="lunchMenuNumber' + menu.id + '" value="'+menu.number+'" min="1" style="width:50px !important;" /></p>';
            insert += '<p><label><strong>選択</strong></label><br /><input class="mycheckbox" type="checkbox" name="lunchMenu' + menu.id + '" id="lunchMenu' + menu.id + '" value="'+menu.id+'" checked /></p>';
    
            insert += '</div>';
            insert += '</div>';
        });
        insert += '</div>';
        insert += '<span class="help-block"><span class="text-red-500">※</span>10:30~15:00の間、且つ、この時間内で営業している場合にこのメニューだけが表示されます。</span>';
        insert += '</div>';
        $('#FirstContentDateFormMenuAreaLunch').html(insert);
        @endif

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



var capacityPutCount = true;
function capacityPut() {

    $('#FirstContentDateFormCapacityAreaPublic').show();

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
            //console.log(capacity);
            if(capacity.delete_flug===1) return true;
            //check sum of number or person
            //console.log('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}');
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
            }else if(capacity.nonesmoking===1){
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

        $('#FirstContentDateFormCapacityAreaPublic').html(insert);
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

