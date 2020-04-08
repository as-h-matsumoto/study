@extends('account/layouts/default')

{{-- Page title --}}
@section('title') 解答 {!!$license_question->subject_name!!} {!!'第'.$license_question->number.'問'!!} @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')

@include('include/question_learning_space_css')

@stop

{{-- content --}}
@section('content')

<div id="profile" class="page-layout simple right-sidebar">

  <div class="page-content-wrapper">

  @include('include/licenseQuestionHeader')
    
  <div class="page-content mb-2">

    <div class="card p-2">

      <div class="border-bottom">

        <a href="/license/{!!$license_question->license_id!!}/question/1">
        <button class="btn btn-outline-info f14 mb-2 @if($license_question->license_year === 2018) active @endif ">
          2018
        </button>
        </a>
        <a href="/license/{!!$license_question->license_id!!}/question/28">
        <button class="btn btn-outline-info f14 mb-2 @if($license_question->license_year === 2017) active @endif ">
          2017
        </button>
        </a>

        <br />

        @foreach($license_examination_subjects as $key=>$lss)
        <a href="/license/{!!$license_question->license_id!!}/question/{!!$license_examination_subjects_questions[$lss->id]!!}">
        <button class="btn btn-outline-info f14 mb-2 @if($license_question->license_examination_subject_id === $lss->id) active @endif ">
          {!!$lss->name!!}
        </button>
        </a>
        @endforeach

        <br />

        @foreach($license_questions as $key=>$lq)
        <a href="/license/{!!$license_question->license_id!!}/question/{!!$lq->id!!}">
        <button class="btn @if($lq->id === $license_question->id) active bold @endif btn-outline-info f14 mb-2">
          {!!'問'.$lq->number!!}
        </button>
        </a>
        @endforeach

      </div>

      <div class="card-body">
        <div class="row" >
          @include('include/licenseQuestionContentsHeader')
          
          @foreach($license_question_contents as $key=>$content)
          <div class="col-12 pb-4 @if(count($license_question_contents)!==$key+1) border-bottom @endif font-area center">
            @if(count($license_question_contents)>1)
            <p><strong>
              設問{{$content->number}}
            </strong></p>
            @endif
            @if($content->question)
            <p>
              {!!nl2br($content->question)!!}
            </p>
            @endif
          </div>
          @if($content->figure1 or $content->figure2)
          <div class="col-12 py-10 @if($content->note) border-bottom @endif ">
            @if($content->figure1)
            <p class="center ">
              <img src="{{Util::getPicLicenseQuestionContentsFigure($content->figure1, $license_question->license_id, $license_question->id, $content->id)}}" style="width:100%; max-width:900px;" />
            </p>
            @endif
            @if($content->figure2)
            <p class="center">
              <img src="{{Util::getPicLicenseQuestionContentsFigure($content->figure2, $license_question->license_id, $license_question->id, $content->id)}}" style="width:100%; max-width:900px;" />
            </p>
            @endif
          </div>
          @endif
          @if($content->note)
          <div class="col-12 py-10">
            <p class="font-area">
              {!!nl2br($content->note)!!}
            </p>
          </div>
          @endif
          <div class="col-12 py-4">
            @if($license_question->license_phase === 1)
            <p class="font-area center"><strong class="pr-2">
              【解答郡】
            </strong>
            <a href="javascript:void(0)" onClick="questionAnswer()">表示<a>
            </p>
            <div class="row">
            <div class="col-sm-12" >
              @foreach($license_question_contents_answers[$content->id] as $k=>$an)
              <div class="form-row align-items-center cp_ipcheck">
                <div class="col-sm-1 right pr-6">
                  @if($content->license_question_contents_answer_id === $an->id)
                  <strong id="questionAnswer" class="f24" style="display:none;">正解</strong>
                  @endif
                </div>
                <div class="col-sm-11">
                  <p id class="font-area">
                    <strong>{{Util::getAnswerNumber($k)}}</strong> &nbsp; {{$an->answer}}
                  </p>
                </div>
              </div>
              @endforeach
            </div>
            </div>
            @endif
          </div>
          @endforeach
        </div>
      </div>

    </div>

    <div class="row ">

      <div class="card center col-sm-6">
  
        <div class="card-title">
            <p class="font-area center"><strong class="pr-2">
                【解説】
            </strong>
            <a class="pr-2" href="javascript:void(0)" onClick="questionCommentary()">表示<a>
            @if(Auth::check() and Auth::user()->id === 1)
            <a href="javascript:void(0)" data-toggle="modal" data-target="#modelLogicRegi" >登録</a>
            @endif
            </p>
        </div>
  
        <div class="card-body">
          @if($license_question->commentary)
          <p id="questionCommentary" class="font-area" style="display:none;" >
          {!!nl2br($license_question->commentary)!!}
          </p>
          @else
          <p id="questionCommentary" class="font-area">未登録</p>
          @endif
        </div>
  
      </div>
  
      <div class="card center col-sm-6">
  
        <div class="card-title">
            <p class="font-area center"><strong class="pr-2">
                【解答を解くための流れ】
            </strong>
            <a class="pr-2" href="javascript:void(0)" onClick="questionLogic()">表示<a>
            @if(Auth::check() and Auth::user()->id === 1)
            <a href="javascript:void(0)" class="pr-2" data-toggle="modal" data-target="#modelLogicRegi" >登録</a>
            @endif
            </p>
        </div>
  
        <div class="card-body">
          @if($license_question->logic)
          <p id="questionLogic" class="font-area" style="display:none;" >
          {!!nl2br($license_question->logic)!!}
          </p>
          @else
          <p id="questionLogic" class="font-area">未登録</p>
          @endif
        </div>
  
      </div>

    </div>

    @include('include/question_learning_space')

    @include('owner/include/footer')
    @include('include/footer')

  </div>
</div>

@include('include/question_learning_space_modal')

<div class="modal fade" id="modelLogicRegi" tabindex="-1" role="dialog" aria-labelledby="modelLogicRegiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelLogicRegiLabel">解答を解くための流れ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => '/', 'id' => 'logicForm', 'name' => 'logicForm', 'method' => 'post', 'class' => 'row', 'files'=> true)) !!}
                    <div class="form-group col-sm-12">
                        <label><span class="pr-2">ロジック</span>
                        <textarea class="form-control form-control-lg" name="logic" id="logic" placeholder="説明分を入力" aria-label="説明分を入力" style="min-height:200px;" ></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); postLicenseQuestionLogic();" ><strong>{!!Util::getIcon('add','s-4','green')!!} 登録</strong></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modelCommentaryRegi" tabindex="-1" role="dialog" aria-labelledby="modelCommentaryRegiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelCommentaryRegiLabel">解説登録</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => '/', 'id' => 'commentaryForm', 'name' => 'commentaryForm', 'method' => 'post', 'class' => 'row', 'files'=> true)) !!}
                    <div class="form-group col-sm-12">
                        <label><span class="pr-2">解説</span>
                        <textarea class="form-control form-control-lg" name="commentary" id="commentary" placeholder="解説登録" aria-label="説明分を入力" style="min-height:200px;"></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); postLicenseQuestionCommentary();" ><strong>{!!Util::getIcon('add','s-4','green')!!} 登録</strong></button>
            </div>
        </div>
    </div>
</div>

@stop

{{-- footer scripts --}}
@section('footer_scripts')

@include('include/question_learning_space_js')


<script>

function questionAnswer() {
  $('#questionAnswer').toggle();
}

function questionCommentary() {
  $('#questionCommentary').toggle();
}

function questionLogic() {
  $('#questionLogic').toggle();
}

function postLicenseQuestionCommentary(){

  console.log('in');
  var commentary = $('#commentary').val();
  console.log(commentary);

  axios.post('/license/{{$license_question->license_id}}/question/{!!$license_question->id!!}/regi/postLicenseQuestionCommentary', {
    commentary: commentary
  })
  .then(function (response) {
    if(!ajaxCheckPublic(response.data)){return;}
    console.log(commentary);
    $('#questionLogic').val(commentary);
    infoNotify('commentaryを登録しました。');
    $('#modelCommentaryRegi').modal('hide');
    $('#loading').hide();
  })
  .catch(function (error) {
    console.log(error);
    ajaxCheckError(error); return;
  });
}


function postLicenseQuestionLogic(){

  var logic = $('#logic').val();

  axios.post('/license/{{$license_question->license_id}}/question/{!!$license_question->id!!}/regi/postLicenseQuestionLogic', {
    logic: logic
  })
  .then(function (response) {
    if(!ajaxCheckPublic(response.data)){return;}
    $('#questionLogic').val(logic);
    infoNotify('解説を登録しました。');
    $('#modelLogicRegi').modal('hide');
    $('#loading').hide();
  })
  .catch(function (error) {
    console.log(error);
    ajaxCheckError(error); return;
  });
}


</script>
@stop
