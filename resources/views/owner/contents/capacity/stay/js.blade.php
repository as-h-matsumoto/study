
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
        $('#CapacityModalLabel').html('ルーム・共有エリア登録');
        $('#CapacityFormtype').val(1);

        $('#CapacityFormuse_only_public').val();
        $('#CapacityFormprice_stay').val();

        $('#CapacityFormname').val('');
        $('#CapacityFormperson').val('');
        $('#CapacityFormarea').val('');
        $('#CapacityFormheight').val('');

        $('#CapacityFormkids').prop("checked",false);
        $('#CapacityFormyoji').prop("checked",false);
        $('#CapacityFormbaby').prop("checked",false);
        $('#CapacityFormnonesmoking').prop("checked",false);
        $('#CapacityFormbus').prop("checked",false);
        $('#CapacityFormnonesmoking').prop("checked",false);
        $('#CapacityFormbus').prop("checked",false);
        $('#CapacityFormtoilet').prop("checked",false);
        $('#CapacityFormhotspring').prop("checked",false);
        $('#CapacityFormrefrigerator').prop("checked",false);
        $('#CapacityFormnet').prop("checked",false);

        $('#CapacityFormprice').val('');
        $('#CapacityFormnumber').val(1);
        $('#CapacityFormdescription').val('');
        $('#CapacityFormpic').val('');
        $('#preview img').attr('src','');

        $('#selectPublicAreaPermit').hide();
        $('#selectPublicAreaPrice').hide();
        $('#selectPublicAreaMessage').hide();
        $('#CapacityFormkidsArea').show();
        $('#CapacityFormyojiArea').show();
        $('#CapacityFormbabyArea').show();
        $('#CapacityModal').modal('show');
    }
}


function putDataCapacityForm(result) {
    
    $('#CapacityFormId').val(result.id);
    $('#CapacityModalLabel').html('ルーム・共有エリア編集');
    $('#CapacityFormtype').val(result.type);
    if(result.type===1){
        $('#selectPublicAreaPermit').hide();
        $('#selectPublicAreaPrice').hide();
        $('#selectPublicAreaMessage').hide();
        $('#CapacityFormkidsArea').show();
        $('#CapacityFormyojiArea').show();
        $('#CapacityFormbabyArea').show();
    }else if(result.type===2){
        $('#selectPublicAreaPermit').show();
        $('#selectPublicAreaPrice').show();
        $('#selectPublicAreaMessage').show();
        $('#CapacityFormkidsArea').hide();
        $('#CapacityFormyojiArea').hide();
        $('#CapacityFormbabyArea').hide();
    }
    $('#CapacityFormuse_only_public').val(result.use_only_public);
    $('#CapacityFormprice_stay').val(result.price_stay);

    $('#CapacityFormname').val(result.name);
    $('#CapacityFormperson').val(result.person);
    $('#CapacityFormarea').val(result.area);
    $('#CapacityFormheight').val(result.height);
    
    if(result.kids===1) $('#CapacityFormkids').prop("checked",true);
    if(result.yoji===1) $('#CapacityFormyoji').prop("checked",true);
    if(result.baby===1) $('#CapacityFormbaby').prop("checked",true);
    if(result.nonesmoking===1) $('#CapacityFormnonesmoking').prop("checked",true);
    if(result.bus===1) $('#CapacityFormbus').prop("checked",true);
    if(result.toilet===1) $('#CapacityFormtoilet').prop("checked",true);
    if(result.hotspring===1) $('#CapacityFormhotspring').prop("checked",true);
    if(result.refrigerator===1) $('#CapacityFormrefrigerator').prop("checked",true);
    if(result.net===1) $('#CapacityFormnet').prop("checked",true);
    $('#CapacityFormprice').val(result.price);
    $('#CapacityFormnumber').val(result.number);
    $('#CapacityFormdescription').val(result.description);
    $('#CapacityFormpic').val('');
    if(isset(result.pic)){
        $('#preview img').attr('src','/storage/uploads/contents/{!!$content->id!!}/capacity/' + result.id + '/' + add_filename(result.pic,'250'));
    }
    $('#CapacityModal').modal('show');
    return;

}

$('#CapacityFormtype').change(function(){
    //console.log('in');
    var type = parseInt($('#CapacityFormtype').val());
    if(type===1){
        $('#selectPublicAreaPermit').hide();
        $('#selectPublicAreaPrice').hide();
        $('#selectPublicAreaMessage').hide();
        $('#CapacityFormkidsArea').show();
        $('#CapacityFormyojiArea').show();
        $('#CapacityFormbabyArea').show();
    }else if(type===2){
        $('#selectPublicAreaPermit').show();
        $('#selectPublicAreaPrice').show();
        $('#selectPublicAreaMessage').show();
        $('#CapacityFormkidsArea').hide();
        $('#CapacityFormyojiArea').hide();
        $('#CapacityFormbabyArea').hide();
    }
});
</script>
