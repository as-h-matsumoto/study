<script>

function createCapacity(capacity, use_number){

    var tmpPc = '';
    var main = '';
    var public = '';
    var tmpSmartPhone = '';
    
    var pic_src = '';
    if(isset(capacity.pic)){
        pic_src += '/storage/uploads/contents/{!!$content->id!!}/capacity/' + capacity.id + '/' + add_filename(capacity.pic,'250');
    }else{
        pic_src += '/storage/global/img/capa_{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}1_250.jpeg';
    }
    
    //<!-- pc -->
    tmpPc += '<div id="capacity' + capacity.id + '" class="col-sm item">';
    tmpPc += '<div class="card rcard row">';
    
    tmpPc += '<div class="card-block-me p-0">';
    tmpPc += '<div class="center">';
    tmpPc += '<a><img src="' + pic_src + '" width="100%" style="max-width:250px !important;"></a>';
    tmpPc += '</div>';
    main += '<div class="border-bottom center pt-2" style="min-height: 40px">';
    if(use_number) main += '<p class="text-success">[ご利用宿泊ルーム]</p>';
    main += '<h4><strong>' + truncate(capacity.name, 60) + '</strong></h4>';
    main += '</div>';
    main += '<div class="p-2 center">';
    main += '<span class="pr-1 text-success">[' + getCapacityType('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}', capacity.type) + ']</span><br />';
    if(capacity.person<20) main += '<span class=" pr-1">' + capacity.person + '様向け</span>';
    if(use_number){
        //main += '<span class="">' + use_number + '室利用</span><br />';
    }else{
        if(capacity.type===2){
            //main += '<span class="">' + capacity.number + 'スペース</span><br />';
        }else{
            main += '<span class="">' + capacity.number + '部屋</span><br />';
        }
    }
    if(capacity.type===2 && capacity.use_only_public===0) main += '<span class="">宿泊者のみ</span><br />';
    main += '<span class=" pr-1">広:' + capacity.area + 'cm2</span>';
    main += '<span class=" pr-1">高:' + capacity.height + 'cm</span><br />';
    if(capacity.kids===1) main += '<span class="pr-2 text-info ">子供可</span>';
    if(capacity.yoji===1) main += '<span class="pr-2 text-info ">幼児可</span>';
    if(capacity.baby===1) main += '<span class="pr-2 text-info ">赤子可</span>';
    if(capacity.kids===1 || capacity.yoji===1 || capacity.baby===1) main += '<br />';

    if(capacity.nonesmoking===1) main += '<span class="pr-2 text-info ">禁煙</span>';
    if(capacity.bus===1) main += '<span class="pr-2 text-info ">専用風呂</span>';
    if(capacity.toilet===1) main += '<span class="pr-2 text-info ">専用トイレ</span>';
    if(capacity.nonesmoking===1 || capacity.bus===1 || capacity.toilet===1) main += '<br />';

    if(capacity.hotspring===1) main += '<span class="pr-2 text-info ">温泉付お部屋</span>';
    if(capacity.refrigerator===1) main += '<span class="pr-2 text-info ">専用冷蔵庫</span>';
    if(capacity.net===1) main += '<span class="pr-2 text-info ">ネット</span>';
    if(capacity.hotspring===1 || capacity.refrigerator===1 || capacity.net===1) main += '<br />';
    if(capacity.price>=1){
        main += '<span class="f13 pr-2 text-blue-900">&yen;' + capacity.price + '</span>';
    }else{
        main += '<span class="f13 pr-2 text-blue-900">メニュー料金のみ</span>';
    }
    if(capacity.type===2 && capacity.price>=1) main += '<span class="f13 pr-2 text-blue-900"><span>宿泊者:</span>&yen;' + capacity.price_stay + '</span>';
    @if($GLOBALS['urls'][1]==='owner')
    if(capacity.delete_flug===1){main += '<br /><span class="pr-2 text-warning ">削除予定</span>'};
    @endif
    main += '</div>';

    main += '<div class=" pl-1 pb-2 center text-blue-grey-800" style="min-height:50px;">';
    if(isset(capacity.description)){
    main += '<a tabindex="0" class="btn-header" role="button"';
    main += ' data-toggle="popover"';
    main += ' data-placement="top"';
    main += ' data-trigger="focus"';
    main += ' data-content="' + capacity.description + '"><strong>';
    main += truncate(capacity.description, 60);
    main += '</strong></a>';
    }
    main += '</div>';
    tmpPc += main;
    tmpPc += '</div>';

    @if($GLOBALS['urls'][1]==='owner')
    public += '<div class="card-actions">';
    public += '<a href="javascript:void(0)" class="pb-4" onClick="editCapacity(' + capacity.id + ');"><button class="action-btn action-btn-footer"><i class="icon icon-lead-pencil text-blue-600" title="編集" alt="編集"></i></button></a>';
    public += '<a href="javascript:void(0)" data-toggle="modal" data-target="#deleteCapacityModal" data-whatever="' + capacity.id + '" ><button class="action-btn action-btn-footer"><i class="icon icon-trash text-grey-600" title="削除" alt="削除"></i></button></a>';
    public += '</div>';
    @endif
    tmpSmartPhone += public;
    tmpSmartPhone += '</div>';
    tmpSmartPhone += '</div>';

    return tmpPc + tmpSmartPhone;

}

</script>