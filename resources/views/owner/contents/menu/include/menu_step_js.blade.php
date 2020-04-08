<script>
function createMenuStep(menu_id, step){

    var insert = '';
    @if($content->service===62)
        var title_name = 'ステップ';
    @elseif($content->service===69)
        var title_name = 'スケジュール';
    @elseif($content->service===101)
        var title_name = 'Gポイント';
    @endif

    insert += '<div id="step'+step.id+'">';
    insert += '<h5 class="border-bottom text-info center">'+step.title+' @if($GLOBALS['urls'][1]==='owner')<span onClick="menuStepModal('+menu_id+', '+step.id+')" class="pl-2"><i class="icon icon-lead-pencil text-blue-500 s-4" title="'+step.title+'編集" alt="'+step.title+'編集"></i></span> <span class="px-1"> | </span> <span class="text-right" onClick="deleteMenuStep('+menu_id+', '+step.id+')"><i class="icon icon-trash text-grey-500 s-4" title="'+step.title+'削除" alt="'+step.title+'削除"></i></span>@endif </h5>';
    insert += '<div class="row pt-2">';
    if(isset(step.pic)){
        insert += '<div class="col-4">';
        insert += '<img src="/storage/uploads/contents/{!!$content->id!!}/menu/' +menu_id+ '/step/' +step.id+ '/' + add_filename(step.pic,'250') + '" width=100%" style="max-width:160px;">';
        insert += '</div>';
        insert += '<div class="col-6 center">';
        if(isset(step.description)){
            insert += '<p>';
            insert += nl2br(truncate(step.description, 600));
            insert += '</p>';
        }
        insert += '</div>';
    }else{
        insert += '<div class="col-12 center">';
        if(isset(step.description)){
            insert += '<p>';
            insert += nl2br(truncate(step.description, 600));
            insert += '</p>';
        }
        insert += '</div>';
    }
    insert += '</div>';
    insert += '</div>';

    
    return insert;

}
</script>