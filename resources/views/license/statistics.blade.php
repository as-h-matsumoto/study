@extends('account/layouts/default')

{{-- Page title --}}
@section('title') {!!$license->name!!} 合格率 受験データ統計値 @parent
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

    @include('license/include/statistics_parts')

    @include('license/include/footer')

    @include('include/footer')

  </div>
</div>

@stop

{{-- footer scripts --}}
@section('footer_scripts')

@stop
