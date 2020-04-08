<div class="row" >
  
  <div class="col-12 pb-6 @if($license_question->figure1 or $license_question->figure2 or $license_question->note) border-bottom @endif ">
    <p class="font-area">
      {!!nl2br($license_question->question)!!}
    </p>
  </div>

  @if($license_question->figure1 or $license_question->figure2)
  <div class="col-12 py-10 @if($license_question->note) border-bottom @endif ">
    @if($license_question->figure1)
    <p class="center ">
      <img src="{{Util::getPicLicenseQuestionFigure($license_question->figure1, $license->id, $license_question->id)}}" style="width:100%; max-width:900px;" />
    </p>
    @endif
    @if($license_question->figure2)
    <p class="center">
      <img src="{{Util::getPicLicenseQuestionFigure($license_question->figure2, $license->id, $license_question->id)}}" style="width:100%; max-width:900px;" />
    </p>
    @endif
  </div>
  @endif

  @if($license_question->note)
  <div class="col-12 py-10">
    <p class="center font-area">
      {{$license_question->note}}
    </p>
  </div>
  @endif

</div>