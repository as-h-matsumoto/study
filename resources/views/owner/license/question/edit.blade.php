@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 問題作成 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')

@stop

{{-- content --}}
@section('content')
<div id="profile" class="page-layout simple right-sidebar">

  <div class="page-content-wrapper">

  @include('owner/license/question/include/header')
    
  <div class="page-content">
    <div class="card">
      <div class="card-body ">

        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'name' => 'action', 'method' => 'post', 'class' => 'row', 'files'=> true)) !!}

          <div class="form-group col-sm-12" >
            <label class="pl-4 form-control-lg"><i class="icon icon-star text-red-700"></i><strong>問題</strong></label>
            <textarea name="question" class="form-control form-control-lg" style="height:200px" >{!! old('question',$license_question->question) !!}</textarea>
            @if ($errors->has('question'))
            <span class="help-block has-error"><strong>{{ $errors->first('question') }}</strong></span>
            @endif
          </div>

          <div class="form-group col-sm-12" >
            <label class="pl-4"> <strong>参考図</strong></label>
          </div>
          
          <div class="form-group col-xl-6 center">
              <div>
                <label class=" form-control-label"><strong>図１</strong></label>
                <input accept="image/*" type="file" id="figure1" name="figure1" />
              </div>
              <div>
                <img id="viewfigure1" src="@if($license_question->figure1){{Util::getPicLicenseQuestionFigure($license_question->figure1, $license->id, $license_question->id)}}@endif" style="width:100%;" />
              </div>
          </div>

          <div class="form-group col-xl-6 center">
              <div>
                <label class="form-control-label"><strong>図２</strong></label>
                <input accept="image/*" type="file" class="" id="figure2" name="figure2" />
              </div>
              <div>
                <img id="viewfigure2" src="@if($license_question->figure2){{Util::getPicLicenseQuestionFigure($license_question->figure2, $license->id, $license_question->id)}}@endif" style="width:100%;" />
              </div>
          </div>

          <div class="form-group col-sm-12" >
              <label class="pl-4"> <strong>注記</strong></label>
              <input type="text" name="note" class="form-control form-control-lg" value="{!! old('note',$license_question->note) !!}" />
              @if ($errors->has('note'))
              <span class="help-block has-error"><strong>{{ $errors->first('note') }}</strong></span>
              @endif
          </div>
          
        </form>

      </div>

    </div>

    <div class="page-content-footer row">
      <div class="col-sm-6">
        <p class="left">
            <a href="/owner/license/{!!$license->id!!}/question/{!!$license_question->id!!}/show" class="btn btn-outline-info" >
                問題確認
            </a>
        </p>
      </div>
      <div class="col-sm-6">
        <p class="right">
            <button class="btn btn-outline-info" onclick="loading();document.action.submit();return false;" >
                登録
            </button>
        </p>
      </div>
    </div>
    @include('owner/include/footer')
    @include('include/footer')
  </div>

  </div>
  
</div>

@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script>
$(document).ready(function(){

  $('#figure1').on('change', function (e) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $("#viewfigure1").attr('src', e.target.result);
      }
      reader.readAsDataURL(e.target.files[0]);
  });
  
  $('#figure2').on('change', function (e) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $("#viewfigure2").attr('src', e.target.result);
      }
      reader.readAsDataURL(e.target.files[0]);
  });

});
</script>

@stop
