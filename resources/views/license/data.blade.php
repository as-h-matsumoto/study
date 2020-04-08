@extends('account/layouts/default')

{{-- Page title --}}
@section('title') {!!$license->name!!} 試験データ @parent
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

    <?php
    $license_id = $license->id;
    $years = [2018,2017,2016,2015,2014,2013,2012,2011];
    ?>
    @foreach($years as $year)
      <div class="card py-8">
        <div class="card-title px-2">
           <p class="center">{!!$year.'年度'!!} 試験データ</p>
        </div>
      </div>
      @include('include/licenseData')
    @endforeach

    @include('license/include/footer')

    @include('include/footer')

  </div>
</div>

@stop

{{-- footer scripts --}}
@section('footer_scripts')

@stop
