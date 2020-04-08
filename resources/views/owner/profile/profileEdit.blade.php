@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') オーナープロフィール編集 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')

<style>
#main_progress_bar, #back_progress_bar{
  margin: 10px 0;
  padding: 3px;
  border: 1px solid #000;
  font-size: 14px;
  clear: both;
  opacity: 0;
  -moz-transition: opacity 1s linear;
  -o-transition: opacity 1s linear;
  -webkit-transition: opacity 1s linear;
}
#main_progress_bar.loading, #back_progress_bar.loading{
  opacity: 1.0;
}
#main_progress_bar .percent, #back_progress_bar percent{
  background-color: #99ccff;
  height: auto;
  width: 0;
}
</style>

@stop

{{-- content --}}
@section('content')
<div id="profile" class="page-layout simple right-sidebar">

    <div class="page-content-wrapper">

        @include('owner/include/header')
    
        <div class="page-content p-2 mb-2">
        <div class="card">
        <div class="card-body">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'name' => 'action', 'method' => 'post', 'class' => ' row', 'files'=> true)) !!}

    <div class="form-group col-sm-6">
        <label for="company_code" class="mb-5"><i class="icon icon-star text-red-700"></i> 法人区分</label>
        {!! Form::select('company_code', $company_code, $company['company_code'],['class' => 'form-control form-control-lg', 'id' => 'company_code']) !!}
        @if ($errors->has('company_code'))
            <span class="help-block has-error">
                <strong>{{ $errors->first('company_code') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-sm-6">
        <label for="registerFormInputName"><i class="icon icon-star text-red-700"></i> 屋号</label>
        <input type="text" name="name" class="form-control form-control-lg" id="registerFormInputName" value="{!! old('name',$company['name']) !!}" required />
        @if ($errors->has('name'))
            <span class="help-block has-error">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-sm-4">
        <label><i class="icon icon-star text-red-700"></i> 都道府県</label>
        <select onChange="countryAreaChangeFunc()" id="country-area" name="country-area" class="form-control form-control-lg"></select>
        @if($errors->has('country-area'))<span class="help-block has-error">{{ $errors->first('country-area') }}</span>@endif
    </div>
    <div class="form-group col-sm-4">
        <label><i class="icon icon-star text-red-700"></i> 市区</label>    
        <select onChange="countryAreaAddressOneChangeFunc()" id="country-area-address-one" name="country-area-address-one" class="form-control form-control-lg"></select>
        @if($errors->has('country-area-address-one'))<span class="help-block has-error">{{ $errors->first('country-area-address-one') }}</span>@endif
    </div>
    <div class="form-group col-sm-4">
        <label><i class="icon icon-star text-red-700"></i> 町村</label>
        <select id="country-area-address-two" name="country-area-address-two" class="form-control form-control-lg"></select>
        @if($errors->has('country-area-address-two'))<span class="help-block has-error">{{ $errors->first('country-area-address-two') }}</span>@endif
    </div>
    <div class="form-group col-sm-12">
        <input class="form-control form-control-lg" name="country-area-address-other" type="text" value="{!! Input::old('country-area-address-other',$company->country_area_address_other) !!}" >
        <label class="ml-6"> 上記以外の住所を入力してください。</label>
        @if($errors->has('country-area-address-other'))<span class="help-block has-error">{{ $errors->first('country-area-address-other') }}</span>@endif
    </div>

    <div class="form-group col-sm-6">
        <label for="homepage"><i class="icon icon-star text-red-700"></i> ホームページ(例：http://aaa.com)</label>
        <input type="text" name="homepage" class="form-control form-control-lg" id="homepage" value="{!! old('homepage',$company['homepage']) !!}" required />
        @if ($errors->has('homepage'))
            <span class="help-block has-error">
                <strong>{{ $errors->first('homepage') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-sm-6">
        <label for="tell"><i class="icon icon-star text-red-700"></i> 代表電話番号(例：03-1234-5678)</label>
        <input type="text" name="tell" class="form-control form-control-lg" id="tell" value="{!! old('tell',$company['tell']) !!}" required />
        @if ($errors->has('tell'))
            <span class="help-block has-error">
                <strong>{{ $errors->first('tell') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-sm-12">
        <label for="description"><i class="icon icon-star text-red-700"></i> 会社紹介</label>
        <textarea style="height:200px;" name="description" class="form-control form-control-lg" id="description" />{!! old('description',$company['description']) !!}</textarea>
        @if ($errors->has('description'))
            <span class="help-block has-error">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>


<div class="form-group col-sm-6 center">
    <div class="row mb-2">
      <div class="col-sm-6">
        <label for="mainPic" class="btn form-control-label f14 text-blue-700"><strong>メイン写真アップ</strong></label>
        <input accept="image/*" type="file" class="" id="mainPic" name="mainPic" />
        <br /><span class="pt-4 mt-4" id="main_progress_bar"><span class="percent" style="padding:0px 50px;">0%</span></span>
      </div>
      <div id="mainpreview" class="col-sm-6">
        <img src="@if($company->pic){!!Util::getPic('company', null, $company->pic, Utilowner::getOwnerId(), 400, null)!!}@endif" style="width:120px;" />
      </div>
    </div>
</div>

<div class="form-group col-sm-6 center">
    <div class="row mb-2">
      <div class="col-sm-6">
        <label for="backPic" class="btn form-control-label f14 text-blue-700"><strong>バック写真アップ</strong></label>
        <input accept="image/*" type="file" class="" id="backPic" name="backPic" />
        <br /><span class="pt-4 mt-4" id="back_progress_bar"><span class="percent" style="padding:0px 50px;">0%</span></span>
      </div>
      <div id="backpreview" class="col-sm-6">
        <img src="@if($company->back_pic){!!Util::getPic('company', true, $company->back_pic, Utilowner::getOwnerId(), 400, null)!!}@endif" style="width:120px;" />
      </div>
    </div>
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
</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script>
function MainhandleFileSelect(evt) {
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
    document.getElementById('main_progress_bar').className = 'loading';
  };
  var file = evt.target.files[0];
  reader.onload = (function(theFile) {
      return function(e) {
          progress.style.width = '100%';
          progress.textContent = '100%';
          setTimeout("document.getElementById('main_progress_bar').className='';", 2000);
          // Render thumbnail.
          $('#mainpreview img').attr('src',e.target.result);
      };
  })(file);
  reader.readAsDataURL(file);
}
document.getElementById('mainPic').addEventListener('change', MainhandleFileSelect, false);


function BackhandleFileSelect(evt) {
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
    document.getElementById('back_progress_bar').className = 'loading';
  };
  var file = evt.target.files[0];
  reader.onload = (function(theFile) {
      return function(e) {
          progress.style.width = '100%';
          progress.textContent = '100%';
          setTimeout("document.getElementById('back_progress_bar').className='';", 2000);
          // Render thumbnail.
          $('#backpreview img').attr('src',e.target.result);
      };
  })(file);
  reader.readAsDataURL(file);
}
document.getElementById('backPic').addEventListener('change', BackhandleFileSelect, false);
</script>

@include('owner/include/company_js')
@include('owner/include/company_country_js')

@stop
