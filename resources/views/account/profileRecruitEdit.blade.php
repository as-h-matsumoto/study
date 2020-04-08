@extends('account/layouts/default')

{{-- Page title --}}
@section('title') 詳細プロフィール編集 @parent
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


<div id="project-dashboard" class="page-layout simple">

    <div class="page-content-wrapper">

        <!-- HEADER -->
        @include('account/include/header')
        <!-- / HEADER -->

        <!-- CONTENT -->
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
      <label><i class="icon icon-star text-red-700"></i> <strong>苗字 (例：佐藤)</strong></label>
      @if($errors->has('name_first'))<span class="help-block has-error">{{ $errors->first('name_first') }}</span>@endif
      <input class="form-control form-control-lg" name="name_first" type="text" autofocus value="{!! old('name_first',$user_recruit->name_first) !!}" >
    </div>
    <div class="form-group col-sm-6">
      <label><i class="icon icon-star text-red-700"></i> <strong>名前 (例：ひろみ)</strong></label>
      @if($errors->has('name_second'))<span class="help-block has-error">{{ $errors->first('name_second') }}</span>@endif
      <input class="form-control form-control-lg" name="name_second" type="text" autofocus value="{!! old('name_second',$user_recruit->name_second) !!}" >
    </div>

    <div class="form-group col-sm-6">
      <label><i class="icon icon-star text-red-700"></i> <strong>所在地</strong></label>
      <div class="row">
        <div class="col-1">
          <label class="h4">〒</label>
        </div>
        <div class="col-10">
          <input class="form-control form-control-lg" name="postal_code" type="text" value="{!! old('postal_code',$user_recruit->postal_code) !!}" >
        </div>
      </div>
      @if($errors->has('country-area'))<span class="help-block has-error">{{ $errors->first('country-area') }}</span>@endif
      <select onChange="countryAreaChangeFunc()" id="country-area" name="country-area" class="form-control form-control-lg"></select>
      @if($errors->has('country-area-address-one'))<span class="help-block has-error">{{ $errors->first('country-area-address-one') }}</span>@endif
      <select onChange="countryAreaAddressOneChangeFunc()" id="country-area-address-one" name="country-area-address-one" class="form-control form-control-lg" style="width:100%;"></select>
      @if($errors->has('country-area-address-two'))<span class="help-block has-error">{{ $errors->first('country-area-address-two') }}</span>@endif
      <select id="country-area-address-two" name="country-area-address-two" class="form-control form-control-lg" style="width:100%;"></select>
      
      @if($errors->has('country-area-address-other'))<span class="help-block has-error">{{ $errors->first('country-area-address-other') }}</span>@endif
      <input class="form-control form-control-lg" name="country-area-address-other" type="text" value="{!! old('country-area-address-other',$user_recruit->country_area_address_other) !!}" style="width:100%;" >
      <span class="help-block">以外の住所</span>
    </div>

    <div class="form-group col-sm-6">
          <label><i class="icon icon-star text-red-700"></i> <strong>最終学歴</strong></label>
          @if($errors->has('career'))<span class="help-block has-error">{{ $errors->first('career') }}</span>@endif
          <textarea class="form-control form-control-lg" name="career" style="min-height:160px;" >{!! old('career',$user_recruit->career) !!}</textarea>
    </div>

    <div class="form-group col-sm-6">
      <label><i class="icon icon-star text-red-700"></i> <strong>生年月日</strong></label>
      @if($errors->has('dob'))<span class="help-block has-error">{{ $errors->first('dob') }}</span>@endif
      <input class="form-control form-control-lg" type="date" name="dob" value="{!! date("Y-m-d", strtotime(old('dob',$user_recruit->dob))) !!}">
    </div>

    <div class="form-group col-sm-6">
          <label><i class="icon icon-star text-red-700"></i><strong> Tell(例：090-1234-5679)</strong> </label>
          @if($errors->has('tell'))<span class="help-block has-error">{{ $errors->first('tell') }}</span>@endif
          <input class="form-control form-control-lg" type="text" name="tell" value="{!! old('tell',$user_recruit->tell) !!}">
    </div>

    <div class="form-group col-sm-6">
          <label><strong>ご自身のSNS</strong></label>
          @if($errors->has('sns'))<span class="help-block has-error">{{ $errors->first('sns') }}</span>@endif
          <input class="form-control form-control-lg" type="url" name="sns" value="{!! old('sns',$user_recruit->sns) !!}">
    </div>

    <div class="form-group col-sm-6">
      <label for="personality" class="form-control-label"><strong>性別</strong></label>
      <select class="custom-select mt-5" name="personality" id="personality" style="width:100%">
          <option value='1' @if( old('personality',$user_recruit->personality) ) checked @endif >男性</option>
          <option value='2' @if( old('personality',$user_recruit->personality) ) checked @endif >女性</option>
      </select>
    </div>
    <div class="form-group col-sm-6">
      <label for="privite_status" class="form-control-label"><strong>ステータス</strong></label>
      <select class="custom-select mt-5" name="privite_status" id="privite_status" style="width:100%">
          <option value='1' @if( old('privite_status',$user_recruit->privite_status) ) checked @endif >未婚</option>
          <option value='2' @if( old('privite_status',$user_recruit->privite_status) ) checked @endif >既婚</option>
      </select>
    </div>

    <div class="form-group col-sm-6 center">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label for="mainPic" class="btn form-control-label f14 text-blue-700"><strong>顔写真アップ</strong></strong></label>
            <input accept="image/*" type="file" class="" id="mainPic" name="mainPic" />
            <br /><span class="pt-4 mt-4" id="main_progress_bar"><span class="percent" style="padding:0px 50px;">0%</span></span>
          </div>
          <div id="mainpreview" class="col-sm-6">
            <img src="@if($user_recruit->pic){!!Util::getPic('user', null, $user_recruit->pic, $user_recruit->id, 400, null)!!}@endif" style="width:120px;" />
          </div>
        </div>
    </div>

    <div class="form-group col-sm-6">
          <label><strong>職歴</strong></label>
          @if($errors->has('experience'))<span class="help-block has-error">{{ $errors->first('experience') }}</span>@endif
          <textarea class="form-control form-control-lg" name="experience" style="min-height:200px;" >{!! old('experience',$user_recruit->experience) !!}</textarea>
    </div>

    <div class="form-group col-sm-6">
          <label><strong>貢献できると考える能力</strong></label>
          @if($errors->has('description'))<span class="help-block has-error">{{ $errors->first('description') }}</span>@endif
          <textarea class="form-control form-control-lg" name="description" style="min-height:200px;" >{!! old('description',$user_recruit->description) !!}</textarea>
    </div>

</form>

        </div>
        </div>
        </div>
        <!-- / CONTENT -->

        <div class="page-content-footer">
            <p class="right">
                <button class="btn btn-outline-info" onclick="loading();document.action.submit();return false;"  >
                    <strong>登録</strong>
                </button>
            </p>
        </div>

        @include('account/include/footer')
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
</script>
@include('include/user_recruit_country_js')

@stop
