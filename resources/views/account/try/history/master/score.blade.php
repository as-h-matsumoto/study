@extends('account/layouts/default')

{{-- Page title --}}
@section('title') スコア @parent
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

        <div class="page-content">

        <div class="card">
            <div class="card-body center">
                <div class="py-6">
                    <p class="font-area">試験結果</p>
                </div>
                @if($license_question_try_master->license_phase === 2)
                <div class="py-6">
                    <p class="font-area text-red-500">二次試験の採点は未対応です。</p>
                </div>
                @endif
            </div>
            </div>
        </div>

        <!-- 試験概要 -->
        <div class="card">
            <div class="card-body center">
                <div class="py-6">
                    <p class="font-area">{!!$license_question_try_master->license_year.'年度'!!} {!!$license_question_try_master->schedule_name!!} &nbsp;&nbsp; {!!$license_question_try_master->subject_name!!}</p>
                </div>
            </div>
        </div>


        <!-- 試験結果 -->
        <div class="card">
            <div class="card-body">
            @foreach($license_examination_subjects as $subject)
              <div class="py-6 center font-area">
              <h4 class="">{!!$subject->name!!}</h4>
              @foreach($subject_score[$subject->id] as $score)
              <p class="">
                {!!'満点: '.$score->total_score.'点、問題数: '.$score->total_question_contents.'問'!!}<br />
              </p>
              @if($license_question_try_master->license_phase === 1)
              <p class="">
                {!!'取得点数: '.$score->correct_score.'点、正解数: '.$score->correct_number.'問'!!}<br />
              </p>
              <p class="">
                {!!'正解率: '.$score->correct_rate.'%'!!}<br />
              </p>
              @endif
              @endforeach
              </div>
            @endforeach

            </div>
        </div>


        <!-- 問題詳細ページ -->
        <div class="card">
            <div class="card-body center py-10">

                <a href="/account/try/history/master/{!!$license_question_try_master->try_master_id!!}/license/{!!$license_question_try_master->license_id!!}/question/{!!$license_question_try_master->start_question_id!!}">
                <button class="f20 btn btn-outline-info" >
                詳細を確認
                </button>
                </a>

            </div>
        </div>
        

        @include('account/include/footer')
        @include('include/footer')

        </div>

    </div>

</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')


@stop
