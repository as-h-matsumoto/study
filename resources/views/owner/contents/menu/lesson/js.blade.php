
<script>

function menuModal(menu_id) {

    if(menu_id){
        axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getMenu', {
          params: {
            menu_id: menu_id
          }
        })
        .then(function (response) {
          result = response.data;
          if(!ajaxCheckPublic(result)){return;}
          putDataMenuForm(result);
        })
        .catch(function (error) {
          ajaxCheckError(error); return;
        });
    }else{
        $('#modal-menu-id').val('');
        $('#menuModalLabel').html('メニュー登録');
        $('#type').prop("selected",false);
        $('#name').val('');
        $('#price').val('');
        $('#person').val('');
        $('#number').val('');
        $('#time').val('');
        $('#description').val('');
        $('#formPic').val('');
        $('#preview img').attr('src','');
        $('#menuModal').modal('show');
        return;
    }   
}


function putDataMenuForm(result) {
    $('#menuModalLabel').html('メニュー編集');
    $('#modal-menu-id').val(result.id);
    $('#type').val(result.type);
    $('#name').val(result.name);
    $('#price').val(result.price);
    $('#person').val(result.person);
    $('#number').val(result.number);
    $('#time').val(result.time);
    $('#description').val(result.description);
    $('#formPic').val('');
    if(isset(result.pic)){
        $('#preview img').attr('src','/storage/uploads/contents/{!!$content->id!!}/menu/' + result.id + '/' + add_filename(result.pic,'250'));
    }else{
        $('#preview img').attr('src','');
    }
    $('#menuModal').modal('show');
}


function postMenu() {

    var menu_id = $('#modal-menu-id').val();
    var addUrl = (isset(menu_id)) ? 'edit' : 'new';
    
    var form = document.getElementById("menuForm");
    var form_data = new FormData(form);

    axios.post('/owner/contents/{!!$content->id!!}/menu/edit/{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}/' + addUrl, form_data)
    .then(function (response) {
        var result = response.data;
        if(!ajaxCheckPublic(result)){return;}
        if(menu_id) $('#menu'+menu_id).remove();
        var insert = createMenu(result.menu);
        $('#menusArea').append(insert);
        $('#none-menu').remove();
        $('#menuModal').modal('hide');
        $('#loading').hide();
        if(menu_id){
            if(result.use===1){
                $('#warningModal').modal('show');
            }else{
                $('[data-toggle="popover"]').popover();
                successNotify('変更しました。');
            }
        }else{
            addMenuToDate(result.menu);
        }
        
    })
    .catch(function (error) {
        $('#menuModal').modal('hide');
        ajaxCheckError(error); return;
    });

}









</script>