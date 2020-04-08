<script>
function createStep(step){

    var title_name = step.title;
    var insert = '';

    insert += '<div id="step'+step.id+'" class="col-sm-4">';
    insert += '<h5 class="border-bottom text-info center">'+title_name+' @if($GLOBALS['urls'][1]==='owner')<span onClick="stepModal('+step.id+')" class="pl-2"><i class="icon icon-lead-pencil text-blue-500 s-4" title="'+title_name+'編集" alt="'+title_name+'編集"></i></span> <span class="px-1"> | </span> <span class="text-right" onClick="deleteStep('+step.id+')"><i class="icon icon-trash text-grey-500 s-4" title="'+title_name+'削除" alt="'+title_name+'削除"></i></span>@endif </h5>';
    insert += '<div class="row pt-2">';
    if(isset(step.pic)){
        insert += '<div class="col-4">';
        insert += '<img src="/storage/uploads/contents/{!!$content->id!!}/step/' +step.id+ '/' + add_filename(step.pic,'250') + '" width=100%" style="max-width:160px;">';
        insert += '</div>';
        insert += '<div class="col-6 center">';
        if(isset(step.description)){
            insert += '<p>';
            insert += nl2br(truncate(step.description, 3000));
            insert += '</p>';
        }
        insert += '</div>';
    }else{
        insert += '<div class="col-12 center">';
        if(isset(step.description)){
            insert += '<p>';
            insert += nl2br(truncate(step.description, 3000));
            insert += '</p>';
        }
        insert += '</div>';
    }
    insert += '</div>';
    insert += '</div>';

    
    return insert;

}
</script>