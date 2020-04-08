<script type="text/javascript">

function countryAreaChangeFunc() {
  loading();
  $('#country-area-address-one-custom').html('<option>loading</option>');
  var country_area_id = $('[name=country-area] option:selected').val();
  Cookies.set('country_area_id', country_area_id, { expires: 30 });
  Cookies.set('country_area_address_one_custom_id', 0, { expires: 30 });
  Cookies.set('country_area_address_two_custom_id', 0, { expires: 30 });
  @if($GLOBALS['urls'][1]==='SenMonTen' and $GLOBALS['urls'][3]==='map')
  var type_redirect_url = '/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/map';
  @else
  var type_redirect_url = '/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}';
  @endif
  window.location.href = type_redirect_url+'?country_area_id=' + country_area_id;
  return;
};

function countryAreaAddressOneChangeFunc() {

  loading();

  $('#country-area-address-two-custom').html('<option>loading</option>');
  var country_area_id = $('[name=country-area] option:selected').val();
  var country_area_address_one_custom_id = $('[name=country-area-address-one-custom] option:selected').val();
  if(!country_area_address_one_custom_id) country_area_address_one_custom_id = 0;
  Cookies.set('country_area_address_one_custom_id', country_area_address_one_custom_id, { expires: 30 });
  Cookies.set('country_area_address_two_custom_id', 0, { expires: 30 });
  @if($GLOBALS['urls'][1]==='SenMonTen' and $GLOBALS['urls'][3]==='map')
  var type_redirect_url = '/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/map';
  @else
  var type_redirect_url = '/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}';
  @endif
  window.location.href = type_redirect_url+'?country_area_id=' + country_area_id + '&country_area_address_one_custom_id='+country_area_address_one_custom_id;
  return;
  /*
  axios.get('/get_country_area_twos_custom', {
    params: {
      country_area_address_one_custom_id: country_area_address_one_custom_id
    }
  })
  .then(function (response) {
    result = response.data;
    var Insert = '<option value="0" >すべて</option>';
    $.each(result,function(index,val){
      Insert = Insert + '<option value="' + val.town_id + '">' + val.town_name + '</option>';
    });
    $('#country-area-address-two-custom').html(Insert);
    @if($GLOBALS['urls'][3]!=='map')
    var yoyaku_type_tag_id = $('[name=yoyaku-type-tag] option:selected').val();
    if(!yoyaku_type_tag_id) yoyaku_type_tag_id = 0;
    moreContents(yoyaku_type_tag_id,country_area_id,country_area_address_one_custom_id,0);
    //yoyakuHeaderUpdate(yoyaku_type_tag_id,country_area_address_one_custom_id,0);
    @endif
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });
  */
};

function countryAreaAddressTwoChangeFunc() {

  loading();
  
  var country_area_id = $('[name=country-area] option:selected').val();
  var country_area_address_one_custom_id = $('[name=country-area-address-one-custom] option:selected').val();
  var country_area_address_two_custom_id = $('[name=country-area-address-two-custom] option:selected').val();
  if(!country_area_address_two_custom_id) country_area_address_two_custom_id = 0;
  Cookies.set('country_area_address_two_custom_id', country_area_address_two_custom_id, { expires: 30 });
  @if($GLOBALS['urls'][1]==='SenMonTen' and $GLOBALS['urls'][3]==='map')
  var type_redirect_url = '/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}/map';
  @else
  var type_redirect_url = '/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}';
  @endif
  window.location.href = type_redirect_url+'?country_area_id=' + country_area_id +
      '&country_area_address_one_custom_id='+country_area_address_one_custom_id +
      '&country_area_address_two_custom_id='+country_area_address_two_custom_id;
  return;
  /*
  @if($GLOBALS['urls'][3]!=='map')
    var yoyaku_type_tag_id = $('[name=yoyaku-type-tag] option:selected').val();
    if(!yoyaku_type_tag_id) yoyaku_type_tag_id = 0;
    moreContents(yoyaku_type_tag_id,country_area_id,country_area_address_one_custom_id,country_area_address_two_custom_id);
    //yoyakuHeaderUpdate(yoyaku_type_tag_id,country_area_address_one_custom_id,country_area_address_two_custom_id);
  @endif
  */
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
    var Insert = '<option value="0" >全国</option>';
    var selected={!!$GLOBALS['country_area_id']!!};
    //console.log(selected);
    $.each(result,function(index,val){
      if(parseInt(selected) == parseInt(val.ken_id)){
        Insert = Insert + '<option value="' + val.ken_id + '" selected="selected" >' + val.name + '</option>';
      }else{
        Insert = Insert + '<option value="' + val.ken_id + '" >' + val.name + '</option>';
      }
    });
    $('#country-area').html(Insert);

    //
    //one
    //
    @if($GLOBALS['country_area_id'])
    $('#country-area-address-one-custom').html('<option>loading</option>');
    axios.get('/get_country_area_ones_custom', {
      params: {
        country_area_id: {!!$GLOBALS['country_area_id']!!}
      }
    })
    .then(function (response) {
      var result = response.data;
      var Insert = '<option value="0" >すべて</option>';
      var selected={!!$GLOBALS['country_area_address_one_id']!!};
      $.each(result,function(index,val){
        if(parseInt(selected) == parseInt(val.city_id)){
          Insert = Insert + '<option value="' + val.city_id + '" selected="selected" >' + val.city_name + '</option>';
        }else{
          Insert = Insert + '<option value="' + val.city_id + '" >' + val.city_name + '</option>';
        }
      });
      $('#country-area-address-one-custom').html(Insert);
      
      //
      //two
      //
      @if($GLOBALS['country_area_address_one_id'])
      $('#country-area-address-two-custom').html('<option>loading</option>');
      axios.get('/get_country_area_twos_custom', {
        params: {
          country_area_address_one_custom_id: {!!$GLOBALS['country_area_address_one_id']!!}
        }
      })
      .then(function (response) {
        var result = response.data;
        var Insert = '<option value="0" >すべて</option>';  
        var selected={!!$GLOBALS['country_area_address_two_id']!!};
        $.each(result,function(index,val){
          if(parseInt(selected) == parseInt(val.town_id)){
            Insert = Insert + '<option value="' + val.town_id + '" selected="selected" >' + val.town_name + '</option>';
          }else{
            Insert = Insert + '<option value="' + val.town_id + '" >' + val.town_name + '</option>';
          }
        });
        $('#country-area-address-two-custom').html(Insert);
      })
      .catch(function (error) {
        ajaxCheckError(error); return;
      });
      @endif

    })
    .catch(function (error) {
      ajaxCheckError(error); return;
    });
    @endif

  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });

});


</script>