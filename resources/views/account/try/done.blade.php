@extends('account/layouts/default')

{{-- Page title --}}
@section('title') 解答確認 @parent
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

        <!-- 試験概要 -->
        <div class="card">
            <div class="card-body center">
                <div class="py-6">
                    <p class="font-area">{!!$license_question_try_master->license_year.'年度'!!} {!!$license_question_try_master->schedule_name!!} &nbsp;&nbsp; {!!$license_question_try_master->subject_name!!}</p>
                </div>
                <div>
                    <p class="font-area">
                    @if( $license_question_try_master->master_type===1 ) 
                    練習問題を終了します。
                    @else
                    模擬試験を終了します。
                    @endif
                    <br />
                    <br />
                    問題なければ「採点」をクリックしてください。
                    </p>
                </div>
            </div>
        </div>


        <!-- 解答一覧 -->
        <div class="card">
            <div class="card-body">
                <div class="py-6">
                    <p class="font-area center">解答一覧</p>
                </div>
<?php
        /*
        $all_answer[$ans->license_question_id][$ans->license_question_contents_id] = $ans->license_question_contents_answer_id;
        $all_subject[$subj->id] = $subj;
        $all_question[$subj->id][$q->id]['ques'] = $q;
        $all_question[$subj->id][$q->id]['cont'] = License_question_contents::where('license_question_id',$q->id)->get();
        */
?>

            @foreach($all_question as $subject_id=>$a)
              @if($license_question_try_master->license_examination_subject_id > 99990000) <h4>{!!$all_subject[$subject_id]->name!!}</h4> @endif
              <p>
              @foreach($a as $question_id=>$b)
              <a href="/account/try/master/{!!$license_question_try_master->try_master_id!!}/license/{!!$license_question_try_master->license_id!!}/question/{!!$question_id!!}">
              <button class="btn btn-outline-info mb-2">
                {!!'問'.$b!!} @if(isset($all_answer[$question_id])) <span>済み</span> @else <span class="text-red-800">未</span> @endif
              </button>
              </a>
              @endforeach
              </p>
            @endforeach

            </div>
        </div>


        <!-- 解答ボタン -->
        <div class="card">
            <div class="card-body center py-10">

                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'name' => 'action', 'method' => 'post', 'class' => '', 'files'=> false)) !!}
                <button class="f20 btn btn-outline-info" onclick="loading();document.action.submit();return false;" >
                採点
                </button>
                </form>

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
