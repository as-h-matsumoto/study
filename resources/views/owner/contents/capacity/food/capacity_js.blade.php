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
    tmpPc += '<div class="card clcard row">';

    tmpPc += '<div class="hidden-xs">';
    tmpPc += '<div class="card-block-me p-0">';
    tmpPc += '<div>';
    tmpPc += '<a><img src="' + pic_src + '" width="100%" style="max-width:250px !important;"></a>';    
    tmpPc += '</div>';
    main += '<div class="border-bottom pt-2 px-2 pb-0 center">';
    if(use_number) main += '<p class="text-success">[ご利用席]</p>';

    main += '<p class=" text-blue-grey-800"><strong>';
    if(use_number){
        main += capacity.person + '名様用' + getCapacityType('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}', capacity.type) + ' (数:' + use_number + '席利用)';
    }else{
        main += capacity.person + '名様用' + getCapacityType('{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}', capacity.type) + ' (数:' + capacity.number + '席)';
    }
    @if($GLOBALS['urls'][1]==='owner')
    if(capacity.delete_flug===1){main += '<br /><span class="pr-2 text-warning ">削除予定</span>'};
    @endif
    main += '</strong></p>';

    if(capacity.nonesmoking===1){main += '<span class="pr-2 text-info ">禁煙</span>'};
    if(capacity.sheet===1){main += '<span class="pr-2 text-info ">シート</span>'};
    if(capacity.private===1){main += '<span class="pr-2 text-info ">個室</span>'};
    if(capacity.yukabori===1){main += '<span class="pr-2 text-info ">床堀席</span>'};
    if(capacity.nonesmoking===1 || capacity.sheet===1 || capacity.private===1 || capacity.yukabori===1) main += '<br />';
    
    if(capacity.price>0){main += '<span>有料: </span><span class="text-warning f14">&yen;'+capacity.price+'</span>'};
    main += '</div>';
    if(isset(capacity.description)){
    main += '<div class="p-2 center text-blue-grey-800" style="min-height:50px;">';
    main += '<a tabindex="0" class="btn-header" role="button"';
    main += ' data-toggle="popover"';
    main += ' data-placement="top"';
    main += ' data-trigger="focus"';
    main += ' data-content="' + capacity.description + '"><strong>';
    main += truncate(capacity.description, 60);
    main += '</strong></a>';
    main += '</div>';
    }
    
    tmpPc += main;
    tmpPc += '</div>';
    tmpPc += '</div>';

    //<!-- smartphone -->
    tmpSmartPhone += '<div class="hidden-xs-other">';
    tmpSmartPhone += '<div class="card-block-me p-0 m-0 row">';
    tmpSmartPhone += '<div class="col-4 p-0">';
    tmpSmartPhone += '<a><img src="' + pic_src + '" width="100%" style="max-width:120px !important;"></a>';
    tmpSmartPhone += '</div>';
    tmpSmartPhone += '<div class="col-8">';
    tmpSmartPhone += main;
    tmpSmartPhone += '</div>';
    tmpSmartPhone += '</div>';
    tmpSmartPhone += '</div>';
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