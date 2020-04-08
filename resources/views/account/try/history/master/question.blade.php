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

  @include('account/try/license/include/historyLicenseQuestionHeader')
    
  <div class="page-content mb-2">

    <div class="card p-2">

      <div class="border-bottom">
        @foreach($license_examination_subjects as $key=>$lss)
        <a href="/account/try/history/master/{!!$license_question_try_master->id!!}/license/{!!$license_question->license_id!!}/question/{!!$license_examination_subjects_questions[$lss->id]!!}">
        <button class="btn btn-outline-info mb-2">
          {!!$lss->name!!}
        </button>
        </a>
        @endforeach
        @foreach($license_questions as $key=>$lq)
        <a href="/account/try/history/master/{!!$license_question_try_master->id!!}/license/{!!$license_question->license_id!!}/question/{!!$lq->id!!}">
        <button class="btn @if($lq->id === $license_question->id) active bold @endif btn-outline-info f14 mb-2">
          {!!'問'.$lq->number!!}
          @if($license_question->license_phase === 1)
          @if($question_all[$lq->id]===1)
          <i class="icon icon-check s-4 text-green-300"></i>
          @elseif($question_all[$lq->id]===2)
          <i class="icon icon-triangle-outline s-4 text-yellow-300"></i>
          @else
          <i class="icon icon-close s-4 text-red-300"></i>
          @endif
          @endif
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
            <p class="font-area center"><strong>
              【解答郡】
            </strong></p>
            <div class="row">
            <div class="col-sm-12" >
            
              @foreach($license_question_contents_answers[$content->id] as $k=>$an)
              
              <div class="form-row align-items-center cp_ipcheck">
                <div class="col-sm-1 right pr-6">
                  @if($content->license_question_contents_answer_id === $an->id)
                  <span class="f20">正解</span>
                  @endif
                  @if(isset($license_question_try_answers[$content->id]) and ($license_question_try_answers[$content->id] === $an->id) )
                    @if($content->license_question_contents_answer_id === $an->id)
                    <br />
                    @endif
                  <span class="f20">解答</span>
                  @endif
                  @if( isset( $license_question_try_answers[$content->id] ) and ( $content->license_question_contents_answer_id === $license_question_try_answers[$content->id] ) and ( $license_question_try_answers[$content->id] === $an->id ) )
                  <i class="icon icon-check s-6 text-green-300"></i>
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
            @elseif($license_question->license_phase === 2)
            <p class="font-area center"><strong>
              【解答】
            </strong></p>
            <div class="row">
            <div class="col-sm-12" >
              <div class="form-row align-items-center cp_ipcheck">
              @if( !empty($license_question_try_answers) and isset($license_question_try_answers[$content->id]) )
                <p class="font-area center">{!!$license_question_try_answers[$content->id]!!}}</p>
              @else
                <p class="font-area center">未回答</p>
              @endif
              </div>
            </div>
            </div>
            @endif
          </div>
          @endforeach
          
        </div>
      </div>

    </div>

    <div class="card center">

      <div class="card-title">

          <p class="font-area center"><strong>
              【解説】
          </strong></p>

      </div>

      <div class="card-body">
      
        <p class="font-area">
      
        解説内容

        </p>

      </div>

    </div>

    @include('include/question_learning_space')

    @include('owner/include/footer')
    @include('include/footer')

  </div>
</div>

@include('include/question_learning_space_modal')

@stop

{{-- footer scripts --}}
@section('footer_scripts')

@include('include/question_learning_space_js')

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
