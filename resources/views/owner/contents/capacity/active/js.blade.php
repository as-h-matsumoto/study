
<script>

function editCapacity(capacity_id) {

    $('#CapacityForm')[0].reset();
    $('#preview img').attr('src','');

    var title = '';
    var data = '';

    if(capacity_id){
        title = '{!!UtilYoyaku::getNewContentCapacity($content->service)!!}編集';
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
        $('#CapacityModalLabel').html('{!!UtilYoyaku::getNewContentCapacity($content->service)!!}登録');
        $('#CapacityFormtype').val('');
        $('#CapacityFormprice').val('');
        $('#CapacityFormperson').val('');
        $('#CapacityFormnumber').val('');
        $('#CapacityFormtime').val('');
        $('#priceTime').html('(xx分)');
        $('#CapacityFormdescription').val('');
        $('#CapacityFormpic').val('');
        $('#preview img').attr('src','');
        $('#CapacityModal').modal('show');
    }   
}

function putDataCapacityForm(result) {
    $('#CapacityFormId').val(result.id);
    $('#CapacityModalLabel').html('{!!UtilYoyaku::getNewContentCapacity($content->service)!!}編集');
    $('#CapacityFormname').val(result.name);
    $('#CapacityFormtype').val(result.type);
    $('#CapacityFormtime').val(result.time);
    $('#priceTime').html('('+result.time+'分)');
    $('#activeType8').hide();
    if(result.type===8){
        $('#personArea').hide();
        $('#numberArea').hide();
        $('#timeArea').hide();
        $('#priceTime').html('(一日)');
        $('#activeType8').show();
    }else if(result.type<=4){
        $('#personArea').hide();
        $('#numberArea').show();
        if(result.type===3){
            $('#CapacityFormnumberLabel').html('コート数');
        }else{
            $('#CapacityFormnumberLabel').html('台数');
        }
    }else if(result.type>=5){
        $('#personArea').show();
        $('#numberArea').hide();
    }
    $('#CapacityFormprice').val(result.price);
    $('#CapacityFormperson').val(result.person);
    $('#CapacityFormnumber').val(result.number);
    $('#CapacityFormdescription').val(result.description);
    $('#CapacityFormpic').val('');
    if(isset(result.pic)) $('#preview img').attr('src','/storage/uploads/contents/{!!$content->id!!}/capacity/' + result.id + '/' + add_filename(result.pic,'250'));
    $('#CapacityModal').modal('show');
    return;
}


$('#CapacityFormtype').change(function(){
    var type = parseInt($('#CapacityFormtype').val());
    
    //$('#priceTime').html('(30分)');
    $('#activeType8').hide();
    $('#timeArea').show();
    if(type===8){
        $('#personArea').hide();
        $('#numberArea').hide();
        $('#timeArea').hide();
        $('#priceTime').html('(一日)');
        $('#activeType8').show();
    }else if(type<=4){
        $('#personArea').hide();
        $('#numberArea').show();
        if(type===3){
            $('#CapacityFormnumberLabel').html('コート数');
        }else{
            $('#CapacityFormnumberLabel').html('台数');
        }
    }else if(type>=5){
        $('#personArea').show();
        $('#numberArea').hide();
    }
});


$('#CapacityFormtime').change(function(){
    var time = parseInt($('#CapacityFormtime').val());
    $('#priceTime').html('('+time+'分)');
});

</script>
