<script type="text/javascript">


function handleFileSelect(evt) {
  // Reset progress indicator on new file selection.
  progress.style.width = '0%';
  progress.textContent = '0%';
  reader = new FileReader();
  reader.onerror = errorHandler;
  reader.onprogress = updateProgress;
  reader.onabort = function(e) {
    alert('File read cancelled');
  };
  reader.onloadstart = function(e) {
    document.getElementById('placeOwner_progress_bar').className = 'loading';
  };
  var file = evt.target.files[0];
  reader.onload = (function(theFile) {
      return function(e) {
          progress.style.width = '100%';
          progress.textContent = '100%';
          setTimeout("document.getElementById('placeOwner_progress_bar').className='';", 2000);
          // Render thumbnail.
          $('#Ownerpreview img').attr('src',e.target.result);
      };
  })(file);
  reader.readAsDataURL(file);
}
document.getElementById('placeOwnerFormPic').addEventListener('change', handleFileSelect, false);



function modalPlaceOwner() {

    $('#placeOwnerForm')[0].reset();
    $('#Ownerpreview img').attr('src','');

    axios.get('/owner/contents/{!!$content->id!!}/capacity/edit/placeOwner')
    .then(function (response) {
      result = response.data;
      if(!ajaxCheckPublic(result)){return;}
      putDataPlaceOwnerForm(result);
    })
    .catch(function (error) {
      ajaxCheckError(error); return;
    });
  
}

function putDataPlaceOwnerForm(result) {
/*
placeOwnerFormplace_id
placeOwnerFormPic
placeOwnerFormDescription

placeOwnerFormCapacity
placeOwnerFormTell
placeOwnerFormName

console.log('put data');
console.log(result);
*/
    $('#placeOwnerFormBaseComment').val(result.description);
    $('#placeOwnerFormName').val(result.name);
    $('#placeOwnerFormParking').val(result.parking);
    if(result.pic){
        $('#Ownerpreview img').attr('src','/storage/uploads/contents/{!!$content->id!!}/place/' + add_filename(result.pic,'250'));
    }else{
        $('#Ownerpreview img').attr('src',result.pic);
    }

    $('#placeOwnerModal').modal('show');

}



function postPlaceOwner() {

    var form = document.getElementById("placeOwnerForm");
    var form_data = new FormData(form);

    axios.post('/owner/contents/{!!$content->id!!}/capacity/edit/placeOwner', form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}
        /*
        PlaceOwnerPic
        PlaceOwnerBaseComment
        PlaceOwnerCapacity
        PlaceOwnerParking
        PlaceOwnerTell
        PlaceOwnerName
        */
        //console.log(result);

        $('#PlaceOwnerBaseComment').html('店舗概要: ' + result.description);
        $('#PlaceOwnerParking').html('Parking: ' + result.parking + '専用駐車場');
        $('#PlaceOwnerName').html('店舗名: '+result.name);
        if(result.pic){
            //console.log('in pic');
            $('#PlaceOwnerPic').html('<img src="/storage/uploads/contents/{!!$content->id!!}/place/' + add_filename(result.pic,250) + '" width="120" />');
        }

        $('#placeOwnerModal').modal('hide');
        $('#loading').hide();
        successNotify('変更しました。');
    })
    .catch(function (error) {
        $('#placeOwnerModal').modal('hide');
        ajaxCheckError(error); return;
    });

}

</script>