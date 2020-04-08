
<script>

function editCapacity(capacity_id) {

    $('#CapacityForm')[0].reset();
    $('#preview img').attr('src','');

    var title = '';
    var data = '';

    if(capacity_id){
        axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getCapacity', {
          params: {
            capacity_id: capacity_id
          }
        })
        .then(function (response) {
          result = response.data;
          if(!ajaxCheckPublic(result)){return;}
          putDataCapacityForm(result);
        })
        .catch(function (error) {
          ajaxCheckError(error); return;
        });
    }else{
        $('#CapacityFormId').val('');
        $('#CapacityModalLabel').html('面接ルーム登録');
        $('#CapacityFormperson').val('');
        $('#CapacityFormnumber').val('');
        $('#CapacityFormdescription').val('');
        $('#CapacityFormpic').val('');
        $('#preview img').attr('src','');
        $('#CapacityModal').modal('show');
    }   
}

function putDataCapacityForm(result) {
    $('#CapacityFormId').val(result.id);
    $('#CapacityModalLabel').html('面接ルーム編集');
    $('#CapacityFormname').val(result.name);
    $('#CapacityFormperson').val(result.person);
    $('#CapacityFormnumber').val(result.number);
    $('#CapacityFormdescription').val(result.description);
    $('#CapacityFormpic').val('');
    if(isset(result.pic)) $('#preview img').attr('src','/storage/uploads/contents/{!!$content->id!!}/capacity/' + result.id + '/' + add_filename(result.pic,'250'));
    $('#CapacityModal').modal('show');
    return;
}



</script>
