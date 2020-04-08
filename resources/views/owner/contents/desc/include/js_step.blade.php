
<script>

function stepModal(step_id) {
    if(step_id){
        axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getStep', {
          params: {
            step_id: step_id
          }
        })
        .then(function (response) {
            if(!ajaxCheckPublic(response.data)){return;}
            step = response.data;
        
            $('#stepFormId').val(step_id);
            $('#stepModalLabel').html('Gポイント編集');
            $('#stepTitle').val(step.title);
            $('#stepDescription').val(step.description);
            $('#stepFormPic').val('');
            if(isset(step.pic)){
                $('#steppreview img').attr('src','/storage/uploads/contents/{!!$content->id!!}/step/' +step.id+ '/' + add_filename(step.pic,'250'));
            }else{
                $('#steppreview img').attr('src','');
            }
            $('#stepModal').modal('show');
            return;
        })
        .catch(function (error) {
          ajaxCheckError(error); return;
        });
    }else{
        $('#stepFormId').val('');
        $('#stepModalLabel').html('Gポイント登録');
        $('#stepTitle').val('');
        $('#stepDescription').val('');
        $('#stepFormPic').val('');
        $('#steppreview img').attr('src','');
        $('#stepModal').modal('show');
        return;
    }   
}


function postStep() {

    var step_id = $('#stepFormId').val();
    var addUrl = (isset(step_id)) ? 'edit' : 'new';
    
    var form = document.getElementById("stepForm");
    var form_data = new FormData(form);

    axios.post('/owner/contents/{!!$content->id!!}/desc/step/' + addUrl, form_data)
    .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}
        var steps = response.data;

        //console.log(steps);
        
        $('#stepArea').html('');

        var insert = '';
        $.each(steps,function(index,step){
            insert += createStep(step);
        });
        $('#stepArea').html(insert);
        
        $('#stepModal').modal('hide');
        $('#loading').hide();
        
        if(step_id){
            successNotify('ステップを変更しました。');
        }else{
            successNotify('ステップを登録しました。');
        }
    })
    .catch(function (error) {
        $('#stepModal').modal('hide');
        ajaxCheckError(error); return;
    });

}


function deleteStep(step_id) {

    loading();

    axios.post('/owner/contents/{!!$content->id!!}/desc/step/delete', {
        step_id: step_id
    })
    .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}
        var steps = response.data;
        //console.log(steps);
        
        $('#stepArea').html('');

        var insert = '';
        $.each(steps,function(index,step){
            insert += createStep(step);
        });
        $('#stepArea').html(insert);
        
        $('#loading').hide();
        successNotify('削除しました。');
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

}








</script>