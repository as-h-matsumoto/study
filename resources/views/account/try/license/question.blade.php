@extends('account/layouts/default')

{{-- Page title --}}
@section('title') {!!$license_question->subject_name!!} {!!'第'.$license_question->number.'問'!!}@parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')

@include('include/question_css')

@stop

{{-- content --}}
@section('content')

<div id="profile" class="page-layout simple right-sidebar">

  <div class="page-content-wrapper">

  @include('account/try/license/include/licenseQuestionHeader')
    
  <div class="page-content mb-2">

    <div class="card p-2">

      <div class="border-bottom">
      
        @foreach($license_examination_subjects as $key=>$lss)
        <a href="/account/try/master/{!!$license_question_try_master->id!!}/license/{!!$license_question->license_id!!}/question/{!!$license_examination_subjects_questions[$lss->id]!!}">
        <button class="btn btn-outline-info f14 mb-2 @if($license_question->license_examination_subject_id === $lss->id) active @endif ">
          {!!$lss->name!!}
        </button>
        </a>
        @endforeach
        
        @foreach($license_questions as $key=>$lq)
        <a href="/account/try/master/{!!$license_question_try_master->id!!}/license/{!!$license_question->license_id!!}/question/{!!$lq->id!!}">
        <button class="btn @if($lq->id === $license_question->id) active bold btn-outline-info @elseif( !isset($license_questions_try_answers[$lq->id]) ) btn-outline-info @endif f14 mb-2">
          {!!'問'.$lq->number!!}
        </button>
        </a>
        @endforeach
        
        <a href="/account/try/master/{!!$license_question_try_master->id!!}/done">
        <button class="btn bg-blue-50 f14 mb-2">
          採点
        </button>
        </a>
      </div>

      <div class="card-body">

          @include('include/licenseQuestionContentsHeader')
          
          {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'name' => 'action', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}
          
          @foreach($license_question_contents as $key=>$content)
          
          <div class="col-12 pb-4 @if(count($license_question_contents)!==$key+1) border-bottom @endif">
            @if(count($license_question_contents)>1)
            <p class="font-area"><strong>
              設問{{$content->number}}
            </strong></p>
            @endif
            @if($content->question)
            <p id class="font-area">
              {!!nl2br($content->question)!!}
            </p>
            @endif
          </div>
          <div class="col-12 py-4">
            @if($license_question->license_phase === 1)
            <p class="font-area"><strong>
              【解答郡】（最も正しいものにチェックを入れてください。）
            </strong></p>
            <div class="form-group col-sm-12" >
              @foreach($license_question_contents_answers[$content->id] as $k=>$an)
              <div class="form-row align-items-center cp_ipcheck">
                <div class="col-2 right pr-6">
                  <span class="f28">答</span><input type="checkbox" name="answer_{!!$content->id!!}_{!!$an->id!!}" class="option-input02 checkbox"
                  @if( isset($license_question_try_answers[$content->id]) and $license_question_try_answers[$content->id] == $an->id ) checked @endif />
                </div>
                <div class="col-10">
                  <p id class="font-area">
                    <strong>{{Util::getAnswerNumber($k)}}</strong> &nbsp; {{$an->answer}}
                  </p>
                </div>
              </div>
              @endforeach
            </div>
            @elseif($license_question->license_phase === 2)
            <p class="font-area"><strong>
              【解答】
            </strong></p>
            <div class="form-group col-sm-12 pb-6" >
              <?php $a = ''; if( isset($license_question_try_answers[$content->id]) ){$a = $license_question_try_answers[$content->id];} ?>
              <textarea name="answer_{!!$content->id!!}" class="form-control form-control-lg" style="height:200px" >{!! old('answer_'.$content->id, $a) !!}</textarea>
              @if ($errors->has('answer_'.$content->id))
              <span class="help-block has-error"><strong>{{ $errors->first('answer_'.$content->id) }}</strong></span>
              @endif
            </div>
            @endif
          </div>
          @endforeach
          
          </form>
        </div>
        
    </div>

    <div class="page-content-footer row" style="border-bottom: solid  2px #bbbbbb;">
      <div class="col-sm-12">
        <p class="center p-10">
          <a class="btn btn-outline-info f24" onclick="loading();document.action.submit();return false;" >
              解答して次へ
          </a>
        </p>
      </div>
    </div>

    @include('account/include/footer')
    @include('include/footer')

  </div>
</div>

@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script>
@if( strtotime($license_question_try_master->time_limit) < strtotime(date("Y-m-d H:i:s")) )
@else
time();
function time(){
    var now = new Date();
    // 来年の1月1日
    var firstDay = new Date('{!!$license_question_try_master->time_limit!!}');
    // 秒数差
    var diff = (firstDay.getTime() - now.getTime()) / 1000;
    // 日時の計算と端数切り捨て
    var daysLeft = Math.floor(diff / (24 * 60 * 60));
    var hoursLeft = (Math.floor(diff / (60 * 60))) % 24;
    var minitesLeft = (Math.floor(diff / 60)) % 60;
    var secondsLeft = Math.floor(diff) % 60;
    // 二桁表示
    minitesLeft = ("0" + minitesLeft).slice(-2)
    secondsLeft = ("0" + secondsLeft).slice(-2)
    // 出力
    document.getElementById("limit").innerHTML = ("「" + hoursLeft + "時間" + minitesLeft + "分" + secondsLeft + "秒」");
}
setInterval('time()',500);
@endif

</script>

@stop
