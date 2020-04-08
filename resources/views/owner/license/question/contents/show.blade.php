@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 問題 @parent
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

  @include('owner/license/question/include/header')
    
  <div class="page-content mb-2">

    <div class="card p-2">
      <div class="card-body ">

        @include('owner/license/question/contents/include/header')

        <div class="row" >
        
          <div class="col-12 py-10 border-top border-bottom">
            <p class="font-area pb-2"><strong>
                設問 {{$license_question_contents->number}}
            </strong></p>
            <p class="font-area">
                {!!nl2br($license_question_contents->question)!!}
            </p>
          </div>

          @if($license_question_contents->figure1 or $license_question_contents->figure2)
          <div class="col-12 py-10 border-bottom">
            @if($license_question_contents->figure1)
            <p class="center ">
              <img src="{{Util::getPicLicenseQuestionContentsFigure($license_question_contents->figure1, $license->id, $license_question->id, $license_question_contents->id)}}" style="width:100%; max-width:900px;" />
            </p>
            @endif
            @if($license_question_contents->figure2)
            <p class="center">
              <img src="{{Util::getPicLicenseQuestionContentsFigure($license_question_contents->figure2, $license->id, $license_question->id, $license_question_contents->id)}}" style="width:100%; max-width:900px;" />
            </p>
            @endif
          </div>
          @endif

          @if($license_question_contents->note)
          <div class="col-12 py-10 border-bottom">
            <p class="font-area">
                {!!nl2br($license_question_contents->note)!!}
            </p>
          </div>
          @endif
          
          <div class="col-12 py-10 border-bottom">
            <p class="font-area"><strong>
              【解答郡】
            </strong></p>
            @foreach($license_question_contents_answer as $key=>$answer)
            <p class="font-area">
                <strong>{{Util::getAnswerNumber($key)}}</strong> &nbsp; {!!$answer->answer!!}
            </p>
            @endforeach
          </div>

          <div class="col-12 pt-10">
            <p class="font-area"><a class="text-blue-400" href="javascript:void(0)" onClick="answerDisplayFunc({{$license_question_contents->id}})">
              【答】確認する
            </a></p>
            @foreach($license_question_contents_answer as $key=>$answer)
            @if($answer->id === $license_question_contents->license_question_contents_answer_id)
            <p id="answerDisplay{{$license_question_contents->id}}" class="font-area" style="display:none;">
                <strong>{{Util::getAnswerNumber($key)}}</strong>
            </p>
            @endif
            @endforeach
          </div>

        </div>
      </div>
    </div>

    <div class="page-content-footer row border-bottom">
      <div class="col-sm-6">
        <p class="font-area left">
            @if($license_question_contents->number>=2)
            <a href="/owner/license/{{$license->id}}/question/{{$license_question->id}}/contents/{{$before_license_question_contents_id}}/show" class="pr-10" >
                前の設問
            </a>
            @endif
        </p>
      </div>
      <div class="col-sm-6">
        <p class="font-area right">
            @if($next_license_question_contents_id)
            <a href="/owner/license/{{$license->id}}/question/{{$license_question->id}}/contents/{{$next_license_question_contents_id}}/show" class="pl-10" >
                次の設問
            </a>
            @endif
        </p>
      </div>
    </div>
    <div class="page-content-footer row border-bottom">
      <div class="col-sm-6">
        <p class="font-area left">
            @if($license_question->number>=2)
            <a href="/owner/license/{{$license->id}}/question/{{$before_license_question_id}}/show" class="pr-10" >
                前の問題
            </a>
            @endif
        </p>
      </div>
      <div class="col-sm-6">
        <p class="font-area right">
            @if($last_question_number !== $license_question->number)
            <a href="/owner/license/{{$license->id}}/question/{{$next_license_question_id}}/show" class="pl-10" >
                次の問題
            </a>
            @endif
        </p>
      </div>
    </div>
    <div class="page-content-footer row">
      <div class="col-sm-12">
        <p class="font-area left">
            <a class="pr-4" href="/owner/license/{{$license->id}}/question/{{$license_question->id}}/edit" class="pr-10" >
                問題編集
            </a>
            <a class="pr-4" href="/owner/license/{{$license->id}}/question/create" class="pr-10" >
                問題登録
            </a>
            <a class="pr-4" href="/owner/license/{{$license->id}}/question/{{$license_question->id}}/contents/{{$license_question_contents->id}}/edit" class="pr-10" >
                設問編集
            </a>
            <a class="" href="/owner/license/{{$license->id}}/question/{{$license_question->id}}/contents/create" class="pr-10" >
                設問登録
            </a>
        </p>
      </div>
    </div>

    

    @include('owner/include/footer')
    @include('include/footer')

  </div>
</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')


@stop
