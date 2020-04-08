<script type="text/javascript">

function company_type_firstChangeFunc() {
  $('#company_type_second').html('<option>loading</option>');
  var company_type_first = $('[name=company_type_first] option:selected').val();
  axios.get('/owner/company_type_second', {
    params: {
        company_type_first: company_type_first
    }
  })
  .then(function (response) {
    result = response.data;
    var Insert = '';
    $.each(result,function(index,val){
        Insert = Insert + '<option value="' + val.id + '">' + val.name + '</option>';
    });
    $('#company_type_second').html(Insert);
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });

};

  


$(document).ready(function () {
  $('#company_type_first').html('<option>loading</option>');
  axios.get('/owner/company_type_first', {
    params: {
        company_type_first: company_type_first
    }
  })
  .then(function (response) {
    result = response.data;
    var Insert = '';
    @if($company['company_type_first'])
    var selected='{!!$company['company_type_first']!!}';
    @else
    var selected=1;
    @endif
    $.each(result,function(index,val){
      if(selected == val.id){
        Insert = Insert + '<option value="' + val.id + '" selected="selected" >' + val.name + '</option>';
      }else{
        Insert = Insert + '<option value="' + val.id + '" >' + val.name + '</option>';
      }
    });
    $('#company_type_first').html(Insert);

    $('#company_type_second').html('<option>loading</option>');
    axios.get('/owner/company_type_second', {
      params: {
          company_type_first: selected
      }
    })
    .then(function (response) {
      result = response.data;
      var Insert = '';
      var selected='{!!$company['company_type_second']!!}';
      $.each(result,function(index,val){
        if(selected == val.id){
          Insert = Insert + '<option value="' + val.id + '" selected="selected" >' + val.name + '</option>';
        }else{
          Insert = Insert + '<option value="' + val.id + '" >' + val.name + '</option>';
        }
      });
      $('#company_type_second').html(Insert);
    })
    .catch(function (error) {
      ajaxCheckError(error); return;
    });


  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });

});

</script>
