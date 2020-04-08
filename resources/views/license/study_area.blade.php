@extends('account/layouts/default')

{{-- Page title --}}
@section('title') {!!$license->name!!} 科目学習 @parent
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

  @include('license/include/header')

  <div class="page-content mb-2">

    @include('license/include/study_area')

    @include('license/include/footer')

    @include('include/footer')

  </div>

</div>

@include('license/include/study_area_modal')
@include('include/question_learning_space_modal')

@stop

{{-- footer scripts --}}
@section('footer_scripts')

@include('license/include/study_area_js')

@stop
