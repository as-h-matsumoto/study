<script>
function insertMenus(event, content_date_users, menus, request_time)
{

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
    insert += '<div class="box_title bg-blue-grey-50 text-auto"><strong>利用するメニューにチェックを入れてください。</strong></div>';
    insert += '<div class="box_srcollbar">';

    //menu
    var date_menus_summary = JSON.parse(event.menus_summary);
    @if($content->service===15)
    if( 
        request_time.format('YYYY-MM-DD HH:mm:ss') >= request_time.format('YYYY-MM-DD 10:00:00') &&
        request_time.format('YYYY-MM-DD HH:mm:ss') <= request_time.format('YYYY-MM-DD 15:00:00')
    ){
        var tmp = JSON.parse(event.lunchs_summary);
        if(isset(tmp)) date_menus_summary = JSON.parse(event.lunchs_summary);
    }
    @endif

   //console.log(date_menus_summary);

    $.each(menus,function(index,menu){
        if(menu.delete_flug===1) return true;

        name = (isset(menu.name)) ? menu.name : '';
        description = (isset(menu.description)) ? menu.description : '';

        insert += '<div class="row border_bottom f12 py-2">';
        insert += '<div class="col-9 pr-0">';

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


        var use_number = 0;
        //※spasalon5, hairsalon8, stay9 のmenuの残数は計算しない。キャパシティーのみのためステータス反映するだけ。 
        if(isset(content_date_users)){
            $.each(content_date_users,function(i,active_user){
                menus_summary = JSON.parse(active_user.menus_summary);
                $.each(menus_summary,function(ii,menu_summary){
                    if(menu_summary.id === menu.id){
                        switch('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}'){
                            case 'food':  summary='menus_summary'; dnop='number'; unop=(menu_summary.type===1)?'number':'person'; break;
                            case 'lesson':  summary='menus_summary'; dnop='number'; unop='person'; break;
                            case 'spasalon':  summary='menus_summary'; dnop='simultaneously'; unop='person'; break;
                            case 'tour':  summary='menus_summary'; dnop='number'; unop='person'; break;
                            case 'ticket':  summary='menus_summary'; dnop='number'; unop='number'; break;
                            case 'hairsalon':  summary='menus_summary'; dnop='simultaneously'; unop='person'; break;
                            case 'stay':  summary='menus_summary'; dnop='number'; unop='person'; break;
                            case 'divination':  summary='menus_summary'; dnop='simultaneously'; unop='person'; break;
                        }
                        use_number += menu_summary[unop];
                    }
                });
            });
        }
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

        //console.log('menu.id: ' + menu.id);
        //console.log('date_menus_summary[menu.id][dnop]: ' + date_menus_summary[menu.id][dnop]);
        //console.log('use_number: ' + use_number);
        var ans = date_menus_summary[menu.id][dnop] - use_number;
        if(ans<=0){ insert += '<span class="text-danger" title="終了" alt="終了">※終了</span>';
        }else if(ans<=5){ insert += '<span class="text-danger" title="残り'+ans+'" alt="残り'+ans+'">※残り'+ans+'</span>';
        //}else{ insert += '<span title="残り'+ans+'" alt="残り'+ans+'">残り'+ans+'</span>';
        }

        if(name) insert += '<p><span class="f14 text-success">' + name + '</span></p>';

        if(name) insert += '<p>';
        if(event.percent>=1 && event.percent < 100){
            insert += '<del class="f14">&yen;' + menu.price + '</del>-><span class="f14 text-red-600">&yen;' + parseInt(menu.price*(event.percent/100))+ '</span>';
        }else if(event.percent>=100){
            insert += '<span class="f14">&yen;' + parseInt(menu.price*(event.percent/100)) + '</span>';
        }else{
            insert += '<span class="f14">&yen;' + menu.price + '</span>';
        }
        if(name) insert += '</p>';
        insert += '<a tabindex="0" role="button" data-toggle="popover" ';
        insert += 'data-placement="top" data-trigger="focus" title="' + name + '" ';
        insert += 'data-img="" ';
        insert += 'data-content="' + description + '">';
        insert += truncate(menu.description, 30) + '</a>';
        insert += '</div>';

        insert += '</div>';
        insert += '</div>';
        insert += '<div class="col center">';

        @if($content->service===81)
        insert += '<p class="pt-10"><label>利用</label><br /><input class="mycheckbox" type="checkbox" name="menuId' + menu.id + '" value="'+menu.id+'"  /></p>';

        @else
        var disabled = (ans<=0) ?'disabled':'';
        var pt10 = '';
        if(unop==='number'){
            insert += '<p><label>利用数</label><br /><input class="center" type="number" name="menuNumber' + menu.id + '" value="1" min="1" max="' + ans + '" style="width:50px !important;" '+disabled+' /></th>';
        }else{
            pt10 = 'pt-8';
        }
        insert += '<p class="'+pt10+'"><label>利用</label><br /><input class="mycheckbox" type="checkbox" name="menuId' + menu.id + '" value="'+menu.id+'" '+disabled+'  @if($content->service===62 or $content->service===69 or $content->service===101){!!'checked'!!}@endif /></th></tr>';
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




