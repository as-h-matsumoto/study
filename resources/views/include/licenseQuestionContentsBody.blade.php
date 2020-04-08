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

@if($license_schedule->license_phase === 1)
<div class="col-12 py-4">
  <p class="font-area"><strong>
    【解答郡】
  </strong></p>
  <?php $ans_key=''; ?>
  @foreach($answers[$content->id] as $k=>$an)
  <p id class="font-area">
      <strong>{{Util::getAnswerNumber($k)}}</strong> &nbsp; {!!$an->answer!!}
  </p>
  <?php if($an->id === $content->license_question_contents_answer_id) $ans_key = Util::getAnswerNumber($k);?>
  @endforeach
</div>
<div class="col-12">
  <p class="font-area"><a class="text-blue-400" href="javascript:void(0)" onClick="answerDisplayFunc({!!$content->id!!})">
    【答】確認する
  </a></p>
  <p id="answerDisplay{{$content->id}}" class="font-area" style="display:none;">
      <strong>{{$ans_key}}</strong>
  </p>
</div>
@else
@endif

<div class="col-12 py-10">
  <a href="/owner/license/{!!$license->id!!}/question/{!!$license_question->id!!}/contents/{!!$content->id!!}/edit"><button class="btn btn-edit">設問変更</button></a><a href="/owner/license/{!!$license->id!!}/question/{!!$license_question->id!!}/contents/{!!$content->id!!}/show"><button class="btn btn-edit">設問詳細</button></a>
</div>
@endforeach