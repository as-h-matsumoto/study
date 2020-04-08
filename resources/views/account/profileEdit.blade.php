@extends('account/layouts/default')

{{-- Page title --}}
@section('title') プロフィール編集 @parent
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
      <label><i class="icon icon-star text-red-700 s-4"></i><strong>ニックネーム</strong></label>
      @if($errors->has('name'))<span class="help-block has-error">{{ $errors->first('name') }}</span>@endif
      <input class="form-control form-control-lg" name="name" type="text" autofocus value="{!! old('name',Auth::user()->name) !!}" >
    </div>

    <div class="form-group col-sm-6">
      <label><strong>パスワード(変更しない場合は未入力)</strong></label>
      @if($errors->has('password'))<span class="help-block has-error">{{ $errors->first('password') }}</span>@endif
      <input class="form-control form-control-lg" name="password" type="password" value="" >
    </div>



    <div class="form-group col-sm-12">
      <label><strong>Eメール</strong></label>
      @if($errors->has('email'))<span class="help-block has-error">{{ $errors->first('email') }}</span>@endif
      <input class="form-control form-control-lg" id="email" name="email" type="email" autofocus value="{!! old('email',Auth::user()->email) !!}" >
    </div>

    
<div class="form-group col-sm-6 center">
    <div class="row mb-2">
      <div class="col-sm-6">
        <label for="mainPic" class="btn form-control-label f14 text-blue-700"><strong>メイン写真アップ</strong></label>
        <input accept="image/*" type="file" class="" id="mainPic" name="mainPic" />
        <br /><span class="pt-4 mt-4" id="main_progress_bar"><span class="percent" style="padding:0px 50px;">0%</span></span>
      </div>
      <div id="mainpreview" class="col-sm-6">
        <img src="@if(Auth::user()->pic){!!Util::getPic('user', null, Auth::user()->pic, Auth::user()->id, 400, null)!!}@endif" style="width:120px;" />
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
        <img src="@if(Auth::user()->back_pic){!!Util::getPic('user', true, Auth::user()->back_pic, Auth::user()->id, 400, null)!!}@endif" style="width:120px;" />
      </div>
    </div>
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

@include('include/default_country_js')

@stop
