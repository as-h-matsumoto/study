<script type="text/javascript">

if(Cookies.get('country_area_id')===undefined){
  Cookies.set('country_area_id', '1406', { expires: 30 });
}




function countryAreaChangeFunc() {
  $('#country-area-address-one').html('<option>loading</option>');
  var country_area_id = $('[name=country-area] option:selected').val();
  Cookies.set('country_area_id', country_area_id, { expires: 30 });
  axios.get('/get_country_area_ones', {
    params: {
      country_area_id: country_area_id
    }
  })
  .then(function (response) {
    result = response.data;
    var Insert = '';
    $.each(result,function(index,val){
      Insert = Insert + '<option value="' + val.id + '">' + val.name + '</option>';
    });
    $('#country-area-address-one').html(Insert);
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });
};

function countryAreaAddressOneChangeFunc() {
  var country_area_address_one_id = $('[name=country-area-address-one] option:selected').val();
  //console.log(country_area_address_one_id);
  Cookies.set('country_area_address_one_id', country_area_address_one_id, { expires: 30 });
};



$(document).ready(function () {

  $('#country-area').html('<option>loading</option>');
  axios.get('/get_country_areas', {
    params: {
      country_id: 392
    }
  })
  .then(function (response) {
    result = response.data;
    var Insert = '';
    var selected=Cookies.get('country_area_id');
    $.each(result,function(index,val){
      if(parseInt(selected) == parseInt(val.id)){
        Insert = Insert + '<option value="' + val.id + '" selected="selected" >' + val.name + '</option>';
      }else{
        Insert = Insert + '<option value="' + val.id + '" >' + val.name + '</option>';
      }
    });
    $('#country-area').html(Insert);
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });

  $('#country-area-address-one').html('<option>loading</option>');
  axios.get('/get_country_area_ones', {
    params: {
      country_area_id: Cookies.get('country_area_id'),
    }
  })
  .then(function (response) {
    result = response.data;
    var Insert = '<option value="0" >すべて</option>';
    var selected=Cookies.get('country_area_address_one_id');
    $.each(result,function(index,val){
      if(parseInt(selected) == parseInt(val.id)){
        Insert = Insert + '<option value="' + val.id + '" selected="selected" >' + val.name + '</option>';
      }else{
        Insert = Insert + '<option value="' + val.id + '" >' + val.name + '</option>';
      }
    });
    $('#country-area-address-one').html(Insert);
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });

});


</script>