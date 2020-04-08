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
        
        @include('owner/license/question/contents/include/header')

        {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'name' => 'action', 'method' => 'post', 'class' => 'row', 'files'=> true)) !!}

          <div class="form-group col-sm-6 col-xl-4 center pb-6">
              <label class="form-control-label"><i class="icon icon-star text-red-700"></i> <strong>設問</strong> </label>
              <select class="custom-select mt-2" name="number">
                  @for ($i = 1; $i <= 10; $i++)
                  <option value="{!!$i!!}">設問 {!!$i!!}</option>
                  @endfor
              </select>
          </div>

          <div class="form-group col-sm-12" >
            <label class="pl-4 form-control-lg"><i class="icon icon-star text-red-700"></i><strong>設問</strong></label>
            <textarea name="question" class="form-control form-control-lg" style="height:200px" >{!! old('question',$license_question_contents->question) !!}</textarea>
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
                <img id="viewfigure1" src="@if($license_question_contents->figure1){{Util::getPicLicenseQuestionContentsFigure($license_question_contents->figure1, $license->id, $license_question->id, $license_question_contents->id)}}@endif" style="width:100%;" />
              </div>
          </div>

          <div class="form-group col-xl-6 center">
              <div>
                <label class="form-control-label"><strong>図２</strong></label>
                <input accept="image/*" type="file" class="" id="figure2" name="figure2" />
              </div>
              <div>
                <img id="viewfigure2" src="@if($license_question_contents->figure2){{Util::getPicLicenseQuestionContentsFigure($license_question_contents->figure2, $license->id, $license_question->id, $license_question_contents->id)}}@endif" style="width:100%;" />
              </div>
          </div>

          <div class="form-group col-sm-12" >
              <label class="pl-4"> <strong>注記</strong></label>
              <textarea name="note" class="form-control form-control-lg" >{!! old('note',$license_question_contents->note) !!}</textarea>
              @if ($errors->has('note'))
              <span class="help-block has-error"><strong>{{ $errors->first('note') }}</strong></span>
              @endif
          </div>

          <div class="form-group col-sm-12" >
              <label class="pl-4"> <strong>配点</strong></label>
              <input type="text" name="points" class="form-control form-control-lg" value="{!! old('points',$license_question_contents->points) !!}" />
              @if ($errors->has('points'))
              <span class="help-block has-error"><strong>{{ $errors->first('points') }}</strong></span>
              @endif
          </div>

          <div class="form-group col-sm-12" >
              <label class="pl-4"> <strong>解説</strong></label>
              <textarea name="commentary" class="form-control form-control-lg">{!! old('commentary',$license_question_contents->commentary) !!}</textarea>
              @if ($errors->has('commentary'))
              <span class="help-block has-error"><strong>{{ $errors->first('commentary') }}</strong></span>
              @endif
          </div>
          
          @if($license_schedule->license_phase === 1)
          <div class="form-group col-sm-12" >
              <label class="pl-4"><i class="icon icon-star text-red-700"></i> <strong>回答群（正解にチェックを入れてください。）</strong></label>
              @for ($i = 0; $i < 8; $i++)
              <div class="form-row align-items-center cp_ipcheck">
                <div class="col-2 right pr-6">
                  <span class="f20">答</span><input type="checkbox" name="license_answer{{$i}}" class="option-input02 checkbox" @if(isset($license_question_contents_answer[$i]) and $license_question_contents_answer[$i]->id === $license_question_contents->license_question_contents_answer_id) checked @endif />
                </div>
                <div class="col-10">
                  @if(isset($license_question_contents_answer[$i]))
                  <input placeholder="回答{{$i}}" type="text" name="answer{{$i}}" class="form-control form-control-lg" value="{!! old('answer'.$i,$license_question_contents_answer[$i]->answer) !!}" />
                  @else
                  <input placeholder="回答{{$i}}" type="text" name="answer{{$i}}" class="form-control form-control-lg" value="{!! old('answer'.$i) !!}" />
                  @endif
                  @if ($errors->has('answer'.$i))
                  <span class="help-block has-error"><strong>{{ $errors->first('answer'.$i) }}</strong></span>
                  @endif
                </div>
              </div>
              @endfor
          </div>
          @endif
          
        </form>

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
