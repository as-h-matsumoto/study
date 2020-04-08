@extends('account/layouts/default')

{{-- Page title --}}
@section('title') 問題開始 @parent
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

                <p class="font-area">{!!$license_question_try_master->license_year.'年度'!!} {!!$license_question_try_master->schedule_name!!} &nbsp;&nbsp; {!!$license_question_try_master->subject_name!!}</p>

                </div>

                <div class="pb-10">
                @if( $license_question_try_master->master_type===1 ) 
                <p class="font-area">
                練習問題を開始します。
                <br />
                <br />
                試験時間は無制限です。
                <br />
                しっかりと問題の意図を汲み取り、理論や仕組みを理解しましょう。
                </p>
                @else
            
                <p class="font-area">
                模擬試験を開始します。
                <br />
                <br />
                ・試験時間は {!!$license_question_try_master->subject_time!!} です。「問題開始」をクリックすると時間がカウントされます。
                <br />
                ・時間が過ぎると自動的に試験は終了し、採点されます。
                </p>
                @endif

                </div>

                <div class="pb-10 center">
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'name' => 'action', 'method' => 'post', 'class' => '', 'files'=> false)) !!}
                <button class="f20 btn btn-outline-info" onclick="loading();document.action.submit();return false;" >
                試験開始
                </button>
                </form>
                </div>
            </div>
        </div>

        <div class="card py-8">
            <div class="card-title px-2">
               <p class="center">実際の試験データはこちらからご確認いただけます。</p>
            </div>
        </div>
        @include('include/licenseData')

        @include('account/include/footer')
        @include('include/footer')

        </div>

    </div>

</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')


@stop
