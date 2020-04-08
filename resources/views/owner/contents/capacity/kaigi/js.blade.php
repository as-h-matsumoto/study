
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
        $('#CapacityModalLabel').html('会議室登録');
        $('#CapacityFormtime').val('');
        $('#priceTime').html('(xx分)');
        $('#CapacityFormperson').val('');
        $('#CapacityFormarea').val('');
        $('#CapacityFormheight').val('');
        $('#CapacityFormnumber').val(1);
        $('#CapacityFormleast_time').val('');
        $('#CapacityFormdescription').val('');
        $('#CapacityFormpic').val('');
        $('#preview img').attr('src','');
        $('#CapacityModal').modal('show');
    }   
}

function putDataCapacityForm(result) {
    
    $('#CapacityFormId').val(result.id);
    $('#CapacityModalLabel').html('会議室編集');
    $('#CapacityFormname').val(result.name);
    $('#CapacityFormtime').val(result.time);
    $('#priceTime').html('('+result.time+'分)');
    $('#CapacityFormprice').val(result.price);
    $('#CapacityFormperson').val(result.person);
    $('#CapacityFormarea').val(result.area);
    $('#CapacityFormheight').val(result.height);
    $('#CapacityFormnumber').val(result.number);
    if(result.least_time>=1) $('#CapacityFormleast_time').val(result.least_time);
    $('#CapacityFormdescription').val(result.description);
    $('#CapacityFormpic').val('');
    if(isset(result.pic)) $('#preview img').attr('src','/storage/uploads/contents/{!!$content->id!!}/capacity/' + result.id + '/' + add_filename(result.pic,'250'));
    $('#CapacityModal').modal('show');
    return;
}


$('#CapacityFormtime').change(function(){
    var time = parseInt($('#CapacityFormtime').val());
    $('#priceTime').html('('+time+'分)');
});

</script>
