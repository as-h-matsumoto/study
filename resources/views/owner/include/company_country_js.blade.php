<script type="text/javascript">



function countryAreaChangeFunc() {
  $('#country-area-address-one').html('<option>loading</option>');
  var country_area_id = $('[name=country-area] option:selected').val();
  axios.get('/get_country_area_ones', {
    params: {
      country_area_id: country_area_id
    }
  })
  .then(function (response) {
    result = response.data;
    var Insert = '';
    $.each(result,function(index,val){
      Insert = Insert + '<option value="' + val.city_id + '">' + val.city_name + '</option>';
    });
    $('#country-area-address-one').html(Insert);
    $('#country-area-address-two').html('<option></option>');
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });
};

function countryAreaAddressOneChangeFunc() {
  $('#country-area-address-two').html('<option>loading</option>');
  var country_area_address_one_id = $('[name=country-area-address-one] option:selected').val();
  axios.get('/get_country_area_twos', {
    params: {
      country_area_address_one_id: country_area_address_one_id
    }
  })
  .then(function (response) {
    result = response.data;
    var Insert = '';
    $.each(result,function(index,val){
      Insert = Insert + '<option value="' + val.town_id + '">' + val.town_name + '</option>';
    });
    $('#country-area-address-two').html(Insert);
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });
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
    @if($company->country_area)
    var selected='{!!$company->country_area!!}';
    @else
    var selected=13;
    @endif
    $.each(result,function(index,val){
      if(selected == val.ken_id){
        Insert = Insert + '<option value="' + val.ken_id + '" selected="selected" >' + val.name + '</option>';
      }else{
        Insert = Insert + '<option value="' + val.ken_id + '" >' + val.name + '</option>';
      }
    });
    $('#country-area').html(Insert);

    $('#country-area-address-one').html('<option>loading</option>');
    axios.get('/get_country_area_ones', {
      params: {
        country_area_id: selected
      }
    })
    .then(function (response) {
      result = response.data;
      var Insert = '';
      @if($company->country_area_address_one)
      var selected='{!!$company->country_area_address_one!!}';
      @else
      var selected=13101;
      @endif
      $.each(result,function(index,val){
        if(selected == val.city_id){
          Insert = Insert + '<option value="' + val.city_id + '" selected="selected" >' + val.city_name + '</option>';
        }else{
          Insert = Insert + '<option value="' + val.city_id + '" >' + val.city_name + '</option>';
        }
      });
      $('#country-area-address-one').html(Insert);


      $('#country-area-address-two').html('<option>loading</option>');
      axios.get('/get_country_area_twos', {
        params: {
          country_area_address_one_id: selected
        }
      })
      .then(function (response) {
        result = response.data;
        var Insert = '';
        var selected='{!!$company->country_area_address_two!!}';
        $.each(result,function(index,val){
          if(selected == val.town_id){
            Insert = Insert + '<option value="' + val.town_id + '" selected="selected" >' + val.town_name + '</option>';
          }else{
            Insert = Insert + '<option value="' + val.town_id + '" >' + val.town_name + '</option>';
          }
        });
        $('#country-area-address-two').html(Insert);
      })
      .catch(function (error) {
        ajaxCheckError(error); return;
      });

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