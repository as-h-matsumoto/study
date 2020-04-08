<script>
function upMessageModal() {
  
    $('#message').val('');
    $('#modelMessagePost').modal('show');

}

function postMessage() {

    var form = document.getElementById("messageForm");
    var form_data = new FormData(form);

    axios.post('/account/messages/post', form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}

        $('#loading').hide();
        $('#modelMessagePost').modal('hide');
        longNotify('送信しました。<br />送信メッセージや返答は<br />「メッセージ」で確認できます。');
        
    })
    .catch(function (error) {
        $('#modelMessagePost').modal('hide');
        ajaxCheckError(error); return;
    });
}



@if(Auth::check() and Auth::user()->owner===1)
function upMessageOwnerToAdminModal() {
  
  $('#ownerToAdminMessagemessage').val('');
  $('#upMessageOwnerToAdminModal').modal('show');

}

function postOwnerToAdminMessage() {

  var form = document.getElementById("modelOwnerToAdminMessageFrom");
  var form_data = new FormData(form);

  axios.post('/owner/support/contact', form_data)
  .then(function (response) {
      result = response.data;
      if(!ajaxCheckPublic(result)){return;}

      $('#loading').hide();
      $('#upMessageOwnerToAdminModal').modal('hide');
      longNotify('送信しました。<br />送信メッセージや返答は<br />「メッセージ」で確認できます。');
      
  })
  .catch(function (error) {
      $('#upMessageOwnerToAdminModal').modal('hide');
      ajaxCheckError(error); return;
  });
}
@endif





@if(Auth::check())
function upMessageCustomerToAdminModal() {
  
    $('#customerToAdminMessagemessage').val('');
    $('#upMessageCustomerToAdminModal').modal('show');

}

function postCustomerToAdminMessage() {

    var form = document.getElementById("modelCustomerToAdminMessageFrom");
    var form_data = new FormData(form);
  
    axios.post('/account/support/contact', form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}
  
        $('#loading').hide();
        $('#upMessageCustomerToAdminModal').modal('hide');
        longNotify('送信しました。<br />送信メッセージや返答は<br />「メッセージ」で確認できます。');
        
    })
    .catch(function (error) {
        $('#upMessageCustomerToAdminModal').modal('hide');
        ajaxCheckError(error); return;
    });
}
@endif

</script>
