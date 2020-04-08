<script type="text/javascript">

function yoyakuComfirm() {

    var form = document.getElementById("selectMenuForm");
    var form_data = new FormData(form);

    axios.post('/account/yoyaku/contents/{!!$content->id!!}/{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}/comfirm', form_data)
    .then(function (response) {
        result = response.data;
        //console.log('this in');
       //console.log(result);
        if(!ajaxCheckPublic(result)){return;}
       //console.log('this out');

        var now = moment(Date());
        $('#modalComfirmNow').html(now.format('YYYY年MM月DD日 HH:mm'));

        @if( $GLOBALS['urls'][1]==='owner' and $GLOBALS['urls'][5]==='adduser' )
        $('#modalComfirmOwnerUserName').html(result.owners_user.name);
        $('#modalComfirmOwnerUserTel').html(result.owners_user.tell);
        $('#modalComfirmOwnerUserDescription').html(result.owners_user.description);
        @endif

        @if($content->service===39 or $content->service===85 or $content->service===89)
        var insert = putUseTime(result.content_date_user.use_time_desc);
        $('#modalComfirmUsetime').html(insert);
        @endif

        $('#modalYoyakuOrder').modal('hide');
        $('#content_date_users_id').val(result.content_date_user.id);
        $('#modalComfirmStart').html(moment(result.content_date_user.start).format('YYYY年MM月DD日 HH:mm'));

        @if(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!=='recruit')
        $('#modalComfirmNumber').html(result.content_date_user.join_user_number + '名様');
        @endif
        
        var discount = 0;
        @if($content->service===39 or $content->service===85 or $content->service===89)
        if(result.discount>=1) discount = result.discount;
        @endif

        @if(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!=='recruit')
        var insert = insertMenuDone( result.content_date_user, discount );
        $('#modalComfirmMenuArea').html(insert);
        @endif

        @if($content->service===15 or $content->service===81)
        insert = '';
        if(result.content_date_user.private === 1) insert += ' 個室 ';
        if(result.content_date_user.nonesmoking === 1) insert += ' 禁煙 ';
        if(result.content_date_user.sheet === 1) insert += ' シート／ソファー席 ';
        if(result.content_date_user.allUse === 1) insert += ' 貸切利用 ';
        if( !(result.content_date_user.private===1 || result.content_date_user.nonesmoking === 1 || result.content_date_user.sheet === 1 || result.content_date_user.allUse === 1) ){
            insert += ' なし ';
        }
        $('#modalComfirmMust').html(insert);
        @endif

        @if(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!=='recruit')
        if(isset(result.content_date_user.message)){
            $('#modalComfirmInfo').html(result.content_date_user.message);
        }else{
            $('#modalComfirmInfo').html('なし');
        }
        @endif
        
        @if(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!=='recruit')
        $('#modalComfirmPrice').html('&yen;' + result.content_date_user.payment_sum + '(税込み)');
        @endif

        <?php
        if(Auth::check()){
            $auth_user_id = Utilowner::getOwnerId();   
        }
        ?>
        @if($content->service===91)
            $('#bottonNoPayJp').show();
        @elseif(Auth::check() and $content->user_id === $auth_user_id)
            $('#formPayJp').hide();
            $('#formNoPayJp').show();
            $('#bottonNoPayJp').show();
        @else
            if(result.content_date_user.payment_sum == 0 ){
              $('#formPayJp').hide();
              $('#formNoPayJp').show();
              $('#bottonNoPayJp').show();
            }else if(result.payment===1){
              $('#formPayJp').show();
              $('#formNoPayJp').hide();
              $('#bottonNoPayJp').hide();
              var paypal_link = '<a class="btn btn-info" href="'+result.paypal_link+'">ペイパルでお支払いをして予約する</a>';
              $('#paypalArea').html(paypal_link);
            }else if(result.payment===2){
              $('#formPayJp').hide();
              $('#formNoPayJp').show();
              $('#bottonNoPayJp').show();
            }else{
             //console.log('paypal_link go 3');
            }
        @endif
        
        $('#loading').hide();
        $('#modalComfirm').modal('show');
        $('[data-toggle="popover"]').popover();
    })
    .catch(function (error) {
        $('#loading').hide();
        ajaxCheckError(error); return;
    });
    
}



function insertMenuDone(content_date_user, discount) {

    var menus = JSON.parse(content_date_user.menus_desc);
    var menus_summary = JSON.parse(content_date_user.menus_summary);
    var capacities = JSON.parse(content_date_user.capacities_desc);
    var capacities_summary = JSON.parse(content_date_user.capacities_summary);

    var insert = '';
    var description = '';
    var name = '';
    var type = '';
    var title = '';
    
    insert += '<table class="table table-hover">';
    insert += '<thead>';
    insert += '<tr><th >メニュー</th><th>料金</th><th><span>数</span>@if($content->service===39 or $content->service===85 or $content->service===89)<span>/利用時間</span>@endif</th></tr>';
    insert += '</thead>';
    insert += '<tbody>';
    if(isset(menus_summary)){ //menus start

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
    }// menus end


    //capa
    //----
    if(isset(capacities_summary)){ //capacities start
    //tyep8 is active2 only
    var type8 = false;
    $.each(capacities,function(index,capacity){
        switch('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'){
            case 'food':  summary='capacities_summary'; dnop='number'; unop='number'; break;
            case 'active':  summary='capacities_summary'; dnop=(capacity.type<=4)?'number':'person'; unop=dnop; break;
            case 'stay':  summary='capacities_summary'; dnop='number'; unop='number'; break;
            case 'studio': summary='capacities_summary'; dnop='number'; unop='number'; break;
            case 'kaigi': summary='capacities_summary'; dnop='number'; unop='number'; break;
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
        }else{
            insert += '<span class="f14">&yen;' + capacities_summary[capacity.id].price + '</span>';
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
        insert += truncate(capacity.description, 1000) + '</a>';
        insert += '</div>';

        insert += '</th>';

        

        @if($content->service===39 or $content->service===85 or $content->service===89)
        if('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'==='active' && capacity.type===8){
            type8 = true;
            insert += '<td>&yen;' + capacities_summary[capacity.id].price+ '</td>';
        }else{
            use_time_desc = JSON.parse(content_date_user.use_time_desc);
            var price_minitsu = capacity.price / capacity.time;
            var price_use = parseInt(price_minitsu * use_time_desc['total_use_time'] * capacities_summary[capacity.id][unop]);
            if(discount>=1){
                insert += '<td>';
                insert += '<del>' + price_use + '</del>';
                insert += '<br /><span> ↓ </span><br />';
                insert += '<span class="text-orange-600">' + parseInt(price_use * (discount/100)) + '</span>';
                insert += '</td>';
            }else{
                insert += '<td>&yen;' + price_use + '</td>';
            }
            insert += '<td>';
            insert += capacities_summary[capacity.id][unop] + '/' + use_time_desc['total_use_time']  + '分</td>';
            insert += '</td>';
        }
        @else
            insert += '<td>&yen;' + capacities_summary[capacity.id].price + '</td>';
            insert += '<td>' + capacities_summary[capacity.id][unop] + '</td>';
        @endif
        
        insert += '</tr>';
    });
    } //capacities end



    insert += '<tr>';
    insert += '<th scope="row" class="center">合計';
    insert += '</th>';
    @if($content->service===39 or $content->service===85 or $content->service===89)
    if(type8){
        insert += '<td colspan="2">&yen;' + content_date_user.price_sum + '(税抜き)</td>'; 
    }else if(discount>=1){
        insert += '<td colspan="2">';
        insert += '<span class="text-orange-600 f14">&yen;' + content_date_user.price_sum + '<br />(時間割適用:税抜き)</span>';
        insert += '</td>';
    }else{
        insert += '<td colspan="2">&yen;' + content_date_user.price_sum + '(税抜き)</td>'; 
    }
    @else
    insert += '<td colspan="2">&yen;' + content_date_user.price_sum + '(税抜き)</td>';
    @endif
    insert += '</tr>';
    insert += '</tbody>';
    insert += '</table>';
    return insert;

}



function backModalYoyakuOrder(){

    $('#modalComfirm').modal('hide');
    $('#modalYoyakuOrder').modal('show');
    $('#loading').hide();

}



function yoyakuComfirmDone() {

    //var content_date_users_id = $('#content_date_users_id').val();
    var form = document.getElementById("yoyakuComfirmDone");
    var form_data = new FormData(form);
    //form_data.append('rating', rating);

    axios.post('/account/yoyaku/contents/{!!$content->id!!}/{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}/comfirm/done', form_data)
    .then(function (response) {
        result = response.data;
       //console.log(result);
        if(!ajaxCheckPublic(result)){return;}
        $('#modalComfirm').modal('hide');
        successNotify('ご予約が完了しました。');
        $('#loading').hide();
        //$('#modalYoyakuDone').modal('show');
        //console.log(result);
        if(result==='owners_yoyaku'){
            location.href='/owner/contents/{!!$content->id!!}/date/yoyaku';
        }else{
            location.href='/account/yoyaku/history/'+result+'/show';
        }
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

}


function redirect(result){
    location.href='/account/yoyaku/history/'+result+'/show';
}


@if($content->service===81)
function seachMenuAndPut() {
    //console.log('in seachMenuAndPut');

    var form = document.getElementById("selectMenuForm");
    var form_data = new FormData(form);

    axios.post('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getMenusSelectStay', form_data)
    .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}
        //console.log(response.data);

        var menus = response.data.menus;
        var capacities = response.data.capacities;

        var insert = insertCapacities(response.data.content_date, response.data.content_date_users_oneDate, capacities, null);
        $('#selectMenuFormCapacityArea').html(insert);

        var insert = insertMenus(response.data.content_date, response.data.content_date_users_oneDate, menus, null);
        $('#selectMenuFormMenuArea').html(insert);

        $('#loading').hide();
        $('[data-toggle="popover"]').popover();
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });
}
document.getElementById('selectMenuFormnonesmoking').addEventListener('change', seachMenuAndPut, false);
@endif



$(document).ready(function () {

    @if($content->service===81)
    $("input[name='selectMenuFormperson']").blur(function(){
        var person = $('#selectMenuFormperson').val();
        //console.log('person: ' + person);
        var pinsert = '';
        for (var i = 1;  i <= person;  i++  ) {
            if(i>=2){
                pinsert += '<div class="col-12">';
                pinsert += '<hr class="py-2">';
                pinsert += '</div>';
            }
            if(i===1){
                <?php
                if(Auth::check() and Auth::user()->dob){
                    $now = date("Ymd"); 
                    $birth = str_replace('-', '', Auth::user()->dob);
                    $old = floor(($now-$birth)/10000);
                }else{
                    $old=40;
                }
                
                ?>
                pinsert += '<div class="col-8">';
                pinsert += '<label for="selectMenuFormPersonDescName'+i+'" class="form-control-label f14">お名前</label>';
                pinsert += '<input class="form-control form-control-lg center" type="text" value="@if(Auth::check()){!!Auth::user()->name!!}@endif" name="selectMenuFormPersonDescName'+i+'" id="selectMenuFormPersonDescName'+i+'" />';
                pinsert += '</div>';
                pinsert += '<div class="col-4">';
                pinsert += '<label for="selectMenuFormPersonDescOld'+i+'" class="form-control-label f14">年齢</label>';
                pinsert += '<input onChange="seachMenuAndPut()" class="form-control form-control-lg center" type="number" value="{!!$old!!}" name="selectMenuFormPersonDescOld'+i+'" id="selectMenuFormPersonDescOld'+i+'" min="0" /> ';
                pinsert += '</div>';
            }else{
                pinsert += '<div class="col-8">';
                pinsert += '<label for="selectMenuFormPersonDescName'+i+'" class="form-control-label f14">お名前</label>';
                pinsert += '<input class="form-control form-control-lg center" type="text" value="" name="selectMenuFormPersonDescName'+i+'" id="selectMenuFormPersonDescName'+i+'" />';
                pinsert += '</div>';
                pinsert += '<div class="col-4">';
                pinsert += '<label for="selectMenuFormPersonDescOld'+i+'" class="form-control-label f14">年齢</label>';
                pinsert += '<input onChange="seachMenuAndPut()" class="form-control form-control-lg center" type="number" value="40" name="selectMenuFormPersonDescOld'+i+'" id="selectMenuFormPersonDescOld'+i+'" min="0" /> ';
                pinsert += '</div>';
            }
        }
        $('#selectMenuFormPersonDescArea').html(pinsert);
        //console.log('put');
        seachMenuAndPut();
    });
    @endif


    @if($content->service===15)
    $("input[name='selectMenuFormperson']").blur(function(){
        //console.log('check selectMenuFormperson');
        @if($content->allUseNumber)
            var person = $('#selectMenuFormperson').val();
            if(person >= {!!$content->allUseNumber!!}){
                $('#allUseForm').show();
            }else{
                $('#allUseForm').hide();
            }
        @endif
    });
    @endif

    $('#selectMenuFormstart').change(function(){

        loading();

        @if($content->service===39 or $content->service===85 or $content->service===89)
        var request_start = $('#selectMenuFormstart').val();
        var event_end = $('#modalYoyakuOrderEventEnd').val();
        putUsetimes(request_start, event_end);
        @endif

        //
        // re putMenus
        // menus どのタイプのメニューも残数を時間ごとに計算する必要がある。
        var event_id = $('#modalSelectMenuId').val();
        var request_start = $('#selectMenuFormstart').val();
        request_start = moment(request_start);
        axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getDateUsers', {
          params: {
            content_date_id: event_id,
            request_start: request_start.format('YYYY-MM-DD HH:mm:ss')
          }
        })
        .then(function (response) {
            if(!ajaxCheckPublic(response.data)){return;}
            @if($content->service===39 or $content->service===65 or $content->service===77 or $content->service===85 or $content->service===89 or $content->service===90)
            var content_date_users = response.data.content_date_users_30min;
            @else
            var content_date_users = response.data.content_date_users_oneDate;
            @endif
            
            axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getDateOne', {
              params: {
                content_date_id: event_id
              }
            })
            .then(function (response) {
                if(!ajaxCheckPublic(response.data)){return;}
                var event = response.data;
                putMenus(event,content_date_users,request_start);
                $('#loading').hide();
            })
            .catch(function (error) {
                ajaxCheckError(error); return;
            });
        })
        .catch(function (error) {
            ajaxCheckError(error); return;
        });
        
    });        

});

// service 2,10,11 only
@include('owner/contents/date/include/put_usetime_js')

</script>
