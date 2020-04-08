@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 問題 @parent
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
    
  <div class="page-content mb-2">

    <div class="card p-2">
      <div class="card-body ">
        <div class="row" >

          @include('include/licenseQuestionContentsHeader')

          @include('include/licenseQuestionContentsBody')

        </div>
      </div>
    </div>


    <div class="page-content-footer row">
      <div class="col-sm-6">
        <p class="font-area left">
          <button class="btn btn-outline-info" >
            <a href="/owner/license/{{$license->id}}/question/{{$license_question->id}}/edit">問題編集</a>
          </button>
          <button class="btn btn-outline-info" >
            <a href="/owner/license/{{$license->id}}/question/create">問題登録</a>
          </button>
          <button class="btn btn-outline-info" >
            <a href="/owner/license/{{$license->id}}/question/{{$license_question->id}}/contents/create">設問登録</a>
          </button>
        </p>
      </div>
      <div class="col-sm-6">
        <p class="font-area right">
          @if($before_license_question_id)
          <a href="/owner/license/{{$license->id}}/question/{{$before_license_question_id}}/show">
          <button class="btn btn-outline-info" >
            前の問題
          </button></a>
          @elseif($before_subject_id)
          <a href="/owner/license/{{$license->id}}/question/{{$before_subject_id}}/show">
          <button class="btn btn-outline-info" >
            前の科目
          </button></a>
           @elseif($before_year_id)
           <a href="/owner/license/{{$license->id}}/question/{{$before_year_id}}/show">
          <button class="btn btn-outline-info" >
            前年度の問題
          </button>
          </a>
          @endif
          @if($next_license_question_id)
          <a href="/owner/license/{{$license->id}}/question/{{$next_license_question_id}}/show">
          <button class="btn btn-outline-info" >
            次の問題
          </button></a>
          @elseif($next_subject_id)
          <a href="/owner/license/{{$license->id}}/question/{{$next_subject_id}}/show">
          <button class="btn btn-outline-info" >
            次の科目
          </button></a>
          @elseif($next_year_id)
          <a href="/owner/license/{{$license->id}}/question/{{$next_year_id}}/show">
          <button class="btn btn-outline-info" >
            翌年度の問題
          </button></a>
          @endif
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
