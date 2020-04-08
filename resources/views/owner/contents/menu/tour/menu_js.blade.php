<script>
function createMenu(menu, use_number){

    var tmpPc = '';
    var main = '';
    var public = '';
    var tmpSmartPhone = '';
    
    var pic_src = '';
    if(isset(menu.pic)){
        pic_src += '/storage/uploads/contents/{!!$content->id!!}/menu/' + menu.id + '/' + add_filename(menu.pic,'250');
    }else{
        pic_src += '/storage/global/img/{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}1_250.jpeg';
    }

    //<!-- pc -->
    tmpPc += '<div id="menu' + menu.id + '" class="col-sm item">';
    tmpPc += '<div class="card rcard row">';
    tmpPc += '<div class="card-block-me p-0">';
    tmpPc += '<div class="center">';
    tmpPc += '<a @if($GLOBALS['urls'][1]==='SenMonTen') href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/menu/'+menu.id+'/desc" @endif >';
    tmpPc += '<img src="'+pic_src+'" width=100%" style="max-width:250px !important;">';
    tmpPc += '</a>';
    tmpPc += '</div>';
    main += '<div class="border-bottom center pt-2" style="min-height: 40px">';
    if(use_number) main += '<p class="text-success">[ご利用ツアー]</p>';
    main += '<a @if($GLOBALS['urls'][1]==='SenMonTen') href="/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/menu/'+menu.id+'/desc" @endif >';
    main += '<h4><strong>' + truncate(menu.name, 60) + '</strong></h4>';
    main += '</a>';
    main += '</div>';
    main += '<div class="p-2 center">';
    main += '<span class="pr-1 text-info">';
    main += 'ツアー日数: ' + menu.time + '分';
    main += '</span>';
    if(use_number){
        main += '<br /><span class="pr-1 text-green-500">ご利人数: ' + use_number + '名様</span>';
    }else{
        main += '<br /><span class=" pr-1">枠:' + menu.number + '名</span>';
        main += '<span class=" pr-1">申込:～' + menu.person + '名から</span>';
    }
    main += '<br /><span class="f14 text-orange-A700">&yen;' + menu.price + '<span>～</span></span>';
    @if($GLOBALS['urls'][1]==='owner')
    if(menu.delete_flug===1){main += '<br /><span class="pr-2 text-warning">削除予定</span>'};
    @endif
    main += '</div>';
    main += '<div class="pl-1 pb-2 center text-blue-grey-800" style="min-height:50px;">';
    if(isset(menu.description)){
    main += '<a tabindex="0" class="btn-header" role="button"';
    main += ' data-toggle="popover"';
    main += ' data-placement="top"';
    main += ' data-trigger="focus"';
    main += ' data-content="' + menu.description + '"><strong>';
    main += truncate(menu.description, 300);
    main += '</strong></a>';
    }
    main += '</div>';
    tmpPc += main;
    tmpPc += '</div>';
    

    @if($GLOBALS['urls'][1]==='owner')

    public += '<div id="stepArea'+menu.id+'" class="col-12 my-4">';
    if(isset(menu.steps)){
    $.each(menu.steps,function(index,step){
        public += createMenuStep(menu.id, step);
    });
    }else{
        <?php
        switch (UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
          case 'lesson': $title_name = 'ステップ'; break;
          case 'tour': $title_name = 'スケジュール'; break;
          case 'ticket': $title_name = 'Gポイント'; break;
        }
        ?>
        public += '<div class="center border-top border-bottom p-2">';
        public += '<p id="noneStep" class="center text-warning">{!!$title_name!!}が未登録です。</p>';
        public += '</div>';
    }
    public += '</div>';

    public += '<div class="card-actions">';
    public += '<button class="action-btn action-btn-footer" onClick="menuModal(' + menu.id + ');"><i class="icon icon-lead-pencil text-blue-600" title="編集" alt="編集"></i></button>';
    public += '<button class="action-btn action-btn-footer" onClick="menuStepModal('+menu.id+',null);"><i class="icon icon-debug-step-over text-green-500" title="ステップ追加" alt="ステップ追加"></i></button>';
    public += '<button class="action-btn action-btn-footer" data-toggle="modal" data-target="#deleteMenuModal" data-whatever="' + menu.id + '" ><i class="icon icon-trash text-grey-600" title="削除" alt="削除"></i></button>';
    public += '</div>';
    @endif
    tmpSmartPhone += public;
    tmpSmartPhone += '</div>';
    tmpSmartPhone += '</div>';
    
    return tmpPc + tmpSmartPhone;

}
</script>