<script>

function editCapacity(capacity_id) {

    $('#CapacityForm')[0].reset();
    $('#personArea').hide();
    $('#kinouArea').hide();
    $('#preview img').attr('src','');

    var title = '';
    var data = '';

    if(capacity_id){
        title = 'テーブル編集';
        axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getCapacity', {
          params: {
            capacity_id: capacity_id
          }
        })
        .then(function (response) {
          result = response.data;
          if(!ajaxCheckPublic(result)){return;}
          putDataCapacityForm(result,title);
        })
        .catch(function (error) {
          ajaxCheckError(error); return;
        });
    }else{
        title = 'テーブル登録';
        $('#CapacityFormId').val('');
        $('#CapacityModalLabel').html(title);
        $('#CapacityFormdescription').val('');
        $('#CapacityFormprivate').prop("checked",false);
        $('#CapacityFormyukabori').prop("checked",false);
        $('#CapacityFormnonesmoking').prop("checked",true);
        $('#CapacityFormsheet').prop("checked",false);
        $('#personArea').hide();
        $('#numberArea').hide();
        $('#kinouArea').hide();
        $('#CapacityFormpic').val('');
        $('#preview img').attr('src','');
        $('#CapacityModal').modal('show');
    }   
}



var typeNames = {
    1:'カウンター',
    2:'テーブル席',
    3:'お座敷'
};

function putDataCapacityForm(result,title) {
    
    $('#CapacityFormId').val(result.id);
    $('#CapacityFormtype').val(result.type);
    $('#CapacityFormperson').val(result.person);
    $('#CapacityFormnumber').val(result.number);
    if(result.private===1) $('#CapacityFormprivate').prop("checked",true);
    if(result.yukabori===1) $('#CapacityFormyukabori').prop("checked",true);
    if(result.nonesmoking===1) $('#CapacityFormnonesmoking').prop("checked",true);
    if(result.sheet===1) $('#CapacityFormsheet').prop("checked",true);
    $('#CapacityFormprice').val(result.price);
    $('#CapacityFormdescription').val(result.description);
    $('#CapacityFormpic').val('');
    if(isset(result.pic)){
        $('#preview img').attr('src','/storage/uploads/contents/{!!$content->id!!}/capacity/' + result.id + '/' + add_filename(result.pic,'250'));
    }
    $('#CapacityModalLabel').html(title);
    if(result.type===1){
        $('#personArea').hide();
        $('#numberArea').show();
        $('#kinouArea').show();
    }else if(result.type>=2 && result.type<=3){
        $('#personArea').show();
        $('#numberArea').show();
        $('#kinouArea').show();
    }
    $('#personAreaTitle').html(typeNames[result.type]);
    $('#CapacityModal').modal('show');
    return;
}

$('#CapacityFormtype').change(function(){
    var type = parseInt($('#CapacityFormtype').val());
    if(type===1){
        $('#personArea').hide();
        $('#numberArea').show();
        $('#kinouArea').show();
    }else if(type>=2 && type<=3){
        $('#personArea').show();
        $('#numberArea').show();
        $('#kinouArea').show();
    }
    $('#personAreaTitle').html(typeNames[type]);
});


</script>