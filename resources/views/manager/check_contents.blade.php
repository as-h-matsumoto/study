@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') チェックコンテンツ @parent
@stop


@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')
<div id="project-dashboard" class="page-layout simple full-width">

    @include('manager/include/header')

    <div class="page-content row">

        <div class="card col-sm-4">
            <div class="card-body">
                <a class="btn btn-outline-info" href="/manager/contents/check?csv=0">一般オーナーコンテンツ</a>
                <a class="btn btn-outline-info" href="/manager/contents/check?csv=1">csvオーナーコンテンツ</a>
            </div>
        </div>
        <div class="card col-sm-4">
            <div class="card-body">
                {!! Form::open(array('url' => '', 'id' => 'country_area', 'method' => 'post', 'class' => '', 'files'=> false)) !!}
                    <select onChange="countryAreaChangeFunc()" id="country-area" name="country-area" class="form-control mr-2" title="都道府県" alt="都道府県">
                    </select>
                    <select onChange="countryAreaAddressOneChangeFunc()" id="country-area-address-one" name="country-area-address-one" class="form-control mr-2 " title="市区" alt="市区">
                    </select>
                </form>
                <?php
                    if(isset($_REQUEST["yoyaku_type_id"])){
                        $rec_yoyaku_type_id = $_REQUEST["yoyaku_type_id"];
                    }else{
                        $rec_yoyaku_type_id = 90;
                    }
                ?>
                {!! Form::open(array('url' => '', 'id' => 'country_type', 'method' => 'post', 'class' => '', 'files'=> false)) !!}
                    <select onChange="contentTyepChangeFunc()" id="content-type" name="content-type" class="form-control mr-2" title="コンテンツタイプ" alt="コンテンツタイプ">
                    <option value="0" >すべて</option>
                    @foreach(UtilYoyaku::getNewMenuSenMonTen(null) as $yoyaku_type_id=>$yoyaku_type_name)
                    <option value="{!!$yoyaku_type_id!!}" @if($rec_yoyaku_type_id == $yoyaku_type_id) selected @endif >{!!$yoyaku_type_name!!}</option>
                    @endforeach
                    </select>
                </form>
            </div>
        </div>
        <div class="card col-sm-4">
            <div class="card-body">
                {!! Form::open(array('url' => '', 'id' => 'content_csv', 'method' => 'post', 'class' => '', 'files'=> false)) !!}
                    <br />
                    <label for="content_name" >名前検索</label>
                    <input type="text" name="content_name" value="">
                    <a href="javascript:void(0)" onClick="loading(); searchContentName();" ><i class="icon icon-search-web"></i></a>
                </form>
            </div>
        </div>

        <div class="card col-12">
            <div class="card-body">
                <p class="center"><a class="text-blue-500 f20" href="/manager/latlon" >latlon</a></p>
                <p class="center"><a class="text-blue-500 f20" href="/manager/latlon/function" >add latlon</a></p>
                <p class="center"><a class="text-blue-500 f20" href="/manager/latlon/function/reverce" >add latlon reverce</a></p>
                <p class="center"><a class="text-blue-500 f20" href="/manager/station/distance" >station dictance</a></p>
            </div>
        </div>

    </div>





    <div class="page-content p-4" style="overflow-y:scroll;">

        <p class="h3" ><strong>コンテンツチェック</strong></p>

        <table class="table table-hover">
            <thead>
            <tr>
                <th style="min-width:180px !important;">コンテンツ</th>
                <th style="min-width:250px !important;">コンテンツ名</th>
                <th style="max-width:300px !important;">コンテンツタグ</th>
                <th style="min-width:100px !important;">ACTION</th>
            </tr>
            </thead>
            <tbody id="searchContents">
        
            @include('manager/include/check_contents')
        
            </tbody>
        </table>

        <div class="page-content-footer">
            <p class="right" id="pageMore">
                @if( !empty($contents) and $contents->hasMorePages() )
                <button class="btn btn-outline-info" onclick="loading();ajaxPaginationContentsMore('{!!$contents->nextPageUrl()!!}');return false;" >
                    <strong>もっと</strong>
                </button>
                @endif
            </p>
        </div>

    </div>





</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script>
function postContentTags(content_id){

    var form = document.getElementById("content" + content_id);
    var form_data = new FormData(form);

    axios.post('/manager/contents/new/check', form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}
        $('#loading').hide();
        successNotify('登録しました。');
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

}




function postContentOpen(content_id){

    axios.post('/manager/contents/edit/postOpenClose', {
        content_id: content_id
    })
    .then(function (response) {
        result = response.data;
       //console.log(result);
        if(!ajaxCheckPublic(result)){return;}
        $('#postContentOpen'+content_id).html(result);
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

}

function postContentShopdown(content_id){

    axios.post('/manager/contents/shopDown', {
        content_id: content_id
    })
    .then(function (response) {
        result = response.data;
       //console.log(result);
        if(!ajaxCheckPublic(result)){return;}
        $('#postContentShopdown'+content_id).html(result);
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

}






function ajaxPaginationContentsMore(url) {
    //console.log(url);
    axios.get(url)
    .then(function (response) {
      if(!ajaxCheckPublic(response.data)){return;}
      //console.log(response);
      if(isset(response.data)){
        $('#searchContents').append(response.data);
      }else{
        $('#pageMore').html('');
      }
      $('#loading').hide();
    })
    .catch(function (error) {
      $('#pageMore').remove();
      ajaxCheckError(error); return;
    });
}







function searchContentName(){

    var searchWords = $('input[name="content_name"]').val();
    if(!searchWords){
        $('#loading').hide();
        return;
    }

    axios.get('/manager/contents/new/check', {
      params: {
        ajax: 1,
        type: 'csv',
        searchWords: searchWords
      }
    })
    .then(function (response) {
      //console.log('in?')
      //console.log(response)
      if(isset(response.data)){
        var more = '';
        more += '<button class="btn btn-outline-info" ';
        more += ' onclick="loading();';
        more += ' ajaxPaginationContentsMore(\'';
        more += '/manager/contents/new/check?page=2&searchWords='+searchWords;
        more += '\');return false;" >';
        more += '<strong>もっと</strong>';
        more += '</button>';
        document.getElementById('pageMore').innerHTML = more;
        document.getElementById('searchContents').innerHTML = response.data;
        //$('#searchContents').html(response.data);
      }else{
        $('#searchContents').html('<div class="col-sm-12 center"><p class="f18">見つかりませんでした。</p></div>');
      }
      $('#loading').hide();
    })
    .catch(function (error) {
      ajaxCheckError(error); return;
    });


}



function countryAreaChangeFunc() {
  loading();
  var country_area_id = $('[name=country-area] option:selected').val();
  var yoyaku_type_id = $('[name=content-type] option:selected').val();
  var url = '/manager/contents/new/check?country_area_id='+country_area_id+'&yoyaku_type_id='+yoyaku_type_id;
  window.location.href = url;
  return;
};

function countryAreaAddressOneChangeFunc() {
  loading();
  var country_area_id = $('[name=country-area] option:selected').val();
  var country_area_address_one_id = $('[name=country-area-address-one] option:selected').val();
  var yoyaku_type_id = $('[name=content-type] option:selected').val();
  var url = '/manager/contents/new/check?country_area_id='+country_area_id+'&country_area_address_one_id='+country_area_address_one_id+'&yoyaku_type_id='+yoyaku_type_id;
  window.location.href = url;
  return;
};

function contentTyepChangeFunc() {
  loading();
  var country_area_id = $('[name=country-area] option:selected').val();
  var country_area_address_one_id = $('[name=country-area-address-one] option:selected').val();
  var yoyaku_type_id = $('[name=content-type] option:selected').val();
  if(isset(country_area_address_one_id)){
    var url = '/manager/contents/new/check?country_area_id='+country_area_id+'&country_area_address_one_id='+country_area_address_one_id+'&yoyaku_type_id='+yoyaku_type_id;
  }else{
    var url = '/manager/contents/new/check?country_area_id='+country_area_id+'&yoyaku_type_id='+yoyaku_type_id;
  }
  window.location.href = url;
  return;
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
    var selected=13;
    @if(isset($_REQUEST["country_area_id"]))
      selected = {!!$_REQUEST["country_area_id"]!!};
    @else
      var selected=13;
    @endif
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
    $('#country-area-address-one').html('<option>loading</option>');
    axios.get('/get_country_area_ones_custom', {
      params: {
        country_area_id: selected
      }
    })
    .then(function (response) {
      var result = response.data;
      var Insert = '<option value="0" >すべて</option>';
      @if(isset($_REQUEST["country_area_address_one_id"]))
        selected = {!!$_REQUEST["country_area_address_one_id"]!!};
      @else
        selected = 0;
      @endif
      $.each(result,function(index,val){
        if(parseInt(selected) == parseInt(val.city_id)){
          Insert = Insert + '<option value="' + val.city_id + '" selected="selected" >' + val.city_name + '</option>';
        }else{
          Insert = Insert + '<option value="' + val.city_id + '" >' + val.city_name + '</option>';
        }
      });
      $('#country-area-address-one').html(Insert);
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
@stop
