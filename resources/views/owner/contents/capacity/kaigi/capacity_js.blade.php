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
    if(use_number) main += '<p class="text-success">[ご利用会議室]</p>';
    main += '<h4><strong>' + truncate(capacity.name, 60) + '</strong></h4>';
    main += '</div>';
    main += '<div class="p-2 center">';
    main += '<span class=" pr-1">広:' + capacity.area + 'cm2</span>';
    main += '<span class=" pr-1">高:' + capacity.height + 'cm</span>';
    if(capacity.person) main += '<br /><span class=" pr-1">許容人数:' + capacity.person + '名</span>';
    if(capacity.least_time) main += '<br /><span class=" pr-1">最低利用時間' + capacity.least_time + 'h~</span>';
    if(use_number){
        main += '<span class="">利用数:' + use_number + '室</span>';
    }else{
        main += '<span class="">数:' + capacity.number + '室</span>';
    }
    main += '<br /><span class="f14 pr-2 text-blue-900">&yen;' + capacity.price + '<span class="">('+capacity.time+'分)</span></span>';
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