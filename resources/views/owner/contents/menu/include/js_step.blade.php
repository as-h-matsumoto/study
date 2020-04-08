
<script>

function menuStepModal(menu_id, step_id) {
    if(step_id){
        axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getMenuStep', {
          params: {
            menu_id: menu_id,
            step_id: step_id
          }
        })
        .then(function (response) {
            if(!ajaxCheckPublic(response.data)){return;}
            step = response.data;
        
            $('#modalMenuId').val(menu_id);
            $('#modalMenuStepId').val(step_id);
            $('#menuStepModalLabel').html('ステップ編集');
            $('#stepTitle').val(step.title);
            $('#stepDescription').val(step.description);
            $('#stepFormPic').val('');
            if(isset(step.pic)){
                $('#steppreview img').attr('src','/storage/uploads/contents/{!!$content->id!!}/menu/' + menu_id + '/step/' +step.id+ '/' + add_filename(step.pic,'250'));
            }else{
                $('#steppreview img').attr('src','');
            }
            $('#menuStepModal').modal('show');
            return;
        })
        .catch(function (error) {
          ajaxCheckError(error); return;
        });
    }else{
        $('#modalMenuId').val(menu_id);
        $('#modalMenuStepId').val('');
        $('#menuStepModalLabel').html('ステップ登録');
        $('#stepTitle').val('');
        $('#stepDescription').val('');
        $('#stepFormPic').val('');
        $('#steppreview img').attr('src','');
        $('#menuStepModal').modal('show');
        return;
    }   
}


function postMenuStep() {

    var menu_id = $('#modalMenuId').val();
    var step_id = $('#modalMenuStepId').val();
    var addUrl = (isset(step_id)) ? 'edit' : 'new';
    
    var form = document.getElementById("menuStepForm");
    var form_data = new FormData(form);

    axios.post('/owner/contents/{!!$content->id!!}/menu/step/' + addUrl, form_data)
    .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}
        var steps = response.data;

        //console.log(steps);
        
        $('#stepArea'+menu_id).html('');

        var insert = '';
        $.each(steps,function(index,step){
            insert += createMenuStep(menu_id, step);
        });
        $('#stepArea'+menu_id).html(insert);
        
        $('#menuStepModal').modal('hide');
        $('#loading').hide();
        
        if(step_id){
            successNotify('ステップを変更しました。');
        }else{
            successNotify('ステップを登録しました。');
        }
    })
    .catch(function (error) {
        $('#menuStepModal').modal('hide');
        ajaxCheckError(error); return;
    });

}









</script>