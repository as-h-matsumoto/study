@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 所在地登録 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')


@stop

{{-- content --}}
@section('content')
<div id="project-dashboard" class="page-layout simple full-width">

    @include('owner/contents/include/header')
    
    <div class="page-content p-2 mb-2">
        <div class="card">
        <div class="card-body">

          {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'name' => 'action', 'method' => 'post', 'class' => ' row', 'files'=> false)) !!}

          <div class="form-group col-sm-12">
              <input type="text" name="zip" class="form-control form-control-lg" value="{!! old('zip',$content->zip) !!}" required />
              <label class="pl-4" for="zip"><i class="icon icon-star text-red-700"></i> 郵便番号(例:135-0016)</label>
              @if ($errors->has('zip'))
                  <span class="help-block has-error">
                      <strong>{{ $errors->first('zip') }}</strong>
                  </span>
              @endif
          </div>

    
          <div class="form-group col-sm-6 col-lg-4">
              <label><i class="icon icon-star text-red-700"></i> 都道府県</label>
              <select onChange="loading(); countryAreaChangeFunc()" id="country_area_id" name="country_area_id" class="form-control form-control-lg"></select>
              @if($errors->has('country_area_id'))<span class="help-block has-error">{{ $errors->first('country_area_id') }}</span>@endif
          </div>

          <div class="form-group col-sm-6 col-lg-4">
              <label><i class="icon icon-star text-red-700"></i> 市区</label>
              <select onChange="loading(); countryAreaAddressOneChangeFunc()" id="country_area_address_one" name="country_area_address_one" class="form-control form-control-lg"></select>
              @if($errors->has('country_area_address_one'))<span class="help-block has-error">{{ $errors->first('country_area_address_one') }}</span>@endif
          </div>

          <div class="form-group col-sm-6 col-lg-4">
              <label><i class="icon icon-star text-red-700"></i> 町村</label>
              <select id="country_area_address_two" id="country_area_address_two" name="country_area_address_two" class="form-control form-control-lg"></select>
              @if($errors->has('country_area_address_two'))<span class="help-block has-error">{{ $errors->first('country_area_address_two') }}</span>@endif
          </div>

          <div class="form-group col-sm-12">
              <input class="form-control form-control-lg" id="country_area_address_other" name="country_area_address_other" type="text" value="{!! Input::old('country_area_address_other',$content->country_area_address_other) !!}" >
              <label class="pl-4" for="country_area_address_other"><i class="icon icon-star text-red-700"></i> 上記以外の住所を入力してください。</label>
              @if($errors->has('country_area_address_other'))<span class="help-block has-error">{{ $errors->first('country_area_address_other') }}</span>@endif
          </div>

          </form>

        </div>
        </div>
        </div>

        <div class="page-content-footer">
            <p class="right">
                <button class="btn btn-outline-info" onclick="loading();document.action.submit();return false;" >
                    <strong>登録</strong>
                </button>
            </p>
        </div>

        @include('owner/include/footer')
        @include('include/footer')

</div>


@include('owner/contents/include/modal')

@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script type="text/javascript">


function countryAreaChangeFunc() {
  $('#country_area_address_one').html('<option>loading</option>');
  var country_area_id = $('[name=country_area_id] option:selected').val();
  axios.get('/get_country_area_ones', {
    params: {
      country_area_id: country_area_id
    }
  })
  .then(function (response) {
    result = response.data;
    var Insert = '';
    $.each(result,function(index,val){
      Insert += '<option value="' + val.city_id + '">' + val.city_name + '</option>';
    });
    $('#country_area_address_one').html(Insert);
    $('#country_area_address_two').html('<option></option>');
    $('#loading').hide();
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });
};

function countryAreaAddressOneChangeFunc() {
  $('#country_area_address_two').html('<option>loading</option>');
  var country_area_address_one_id = $('[name=country_area_address_one] option:selected').val();
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
    $('#country_area_address_two').html(Insert);
    $('#loading').hide();
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
    @if($content->country_area_id)
    var selected={!!$content->country_area_id!!};
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
    $('#country_area_id').html(Insert);

    @if($content->country_area_id)
    $('#country_area_address_one').html('<option>loading</option>');
    axios.get('/get_country_area_ones', {
      params: {
        country_area_id: selected
      }
    })
    .then(function (response) {
      result = response.data;
      var Insert = '';
      @if($content->country_area_address_one)
      var selected={!!$content->country_area_address_one!!};
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
      $('[name=country_area_address_one]').html(Insert);

      @if($content->country_area_address_one)
      $('#country_area_address_two').html('<option>loading</option>');
      axios.get('/get_country_area_twos', {
        params: {
          country_area_address_one_id: selected
        }
      })
      .then(function (response) {
        result = response.data;
        var Insert = '';
        @if($content->country_area_address_two)
            var selected={!!$content->country_area_address_two!!};
        @else
            var selected = 0;
        @endif
        $.each(result,function(index,val){
          if(selected == val.town_id){
            Insert = Insert + '<option value="' + val.town_id + '" selected="selected" >' + val.town_name + '</option>';
          }else{
            Insert = Insert + '<option value="' + val.town_id + '" >' + val.town_name + '</option>';
          }
        });
        $('[name=country_area_address_two]').html(Insert);
        
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


@stop
