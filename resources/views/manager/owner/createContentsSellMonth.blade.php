@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') コンテンツごとの月間売上げ表作成 @parent
@stop


@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')
<div id="project-dashboard" class="page-layout simple full-width">
    @include('manager/include/header')
    <div class="page-content p-2" >

        <div class="page-content-header" style="">
            <h4>月初処理一覧</h4>
        </div>

        <div id="monthFuncView" class="row">
        
            <div class="card m-4" style="width: 30rem;">
                {!! Form::open(array('url' => '/manager/owner/createContentsSellMonth', 'name' => 'action1', 'method' => 'post', 'class' => '', 'files'=> false)) !!}
                <div class="card-body">
                    <h4 class="card-title text-info">月間売上表作成</h4>
                    <h6 class="card-subtitle mb-2 text-muted">サービス提供済みのみ</h6>
                    <p class="card-text">
                    全コンテンツの月間売上げ表作成します。<br />
                    <br />
                    よろしいですか?
                    </p>
                    <a href="javascript:void(0)" class="btn" onclick="document.action1.submit();return false;" >
                    作成
                    </a>
                </div>
                </form>
            </div>

            <div class="card m-4" style="width: 30rem;">
                <div class="card-body">
                    <h4 class="card-title text-info">翌々月予約受付作成依頼</h4>
                    <h6 class="card-subtitle mb-2 text-muted">手動</h6>
                    <code id="pc0" class="card-text">
                    </code>
                    <a href="javascript:void(0)" class="card-link" onclick="" >
                    貼り付けて利用
                    </a>
                </div>
            </div>

        </div>


    </div>
</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')
<script id="ct0" type="text/plain">
    <p>
    オーナー様。<br />
    本日で{!!date('m月')!!}になり、新しい月を迎えましたので、
    翌々月( {!!date('Y年m月', strtotime( '+2 month ' . date('Y-m-d')));!!} ) の予約受付スケジュールを作成できるようになりました。<br /><br />
    今月もオーナー様の利益に貢献させていただけるように最善を尽くしてまいります。<br />
    Coordiy予約より。
    </p>
    <p>
    <a class="text-info" href="/owner/contents">予約受付スケジュール作成する</a>
    </p>
</script>

<script>
$(document).ready(function () {
    document.getElementById('pc0').textContent = document.getElementById('ct0').textContent;
});
</script>
@stop
