@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') サポート @parent
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

        @include('owner/include/header')
    
        <div class="page-content">
        <div class="row px-6 mt-2">

            <div class="card col-md-4 mb-2">
                <div class="card-block-me pt-10 center">
                    <p class="h4 introduce-title-modan"><strong>サポートレベル</strong></p>
                    <p class="h5 text-success pt-6"><strong>{!!Util::ownerSupportType($company->owner_support_type,'name')!!}</strong></p>
                    <!-- <p class="pt-3">{!!date('Y-m', strtotime(date('Y年m月') . '-1 month'))!!} のお支払いはございません。</p> -->
                </div>
            </div>

            <div class="card col-md-4 mb-2">
                <div class="card-block-me pt-10 center">
                    <p class="h4 introduce-title-modan"><strong>問い合わせ</strong></p>
                    <p class="pt-6"><button class="btn btn-outline-info" onClick="upMessageOwnerToAdminModal()" >メッセージ問い合わせ </button></p>
                    @if($company->owner_support_type>=3)
                    <p class="h5 text-info pt-4">
                        <?php $DT_now = new DateTime(date('Y-m-d H:i:s')); ?>
                        @if($company->owner_support_type>=3)
                            <?php
                            $DT_start = new DateTime(date('Y-m-d') . ' 11:00:00');
                            $DT_end = new DateTime(date('Y-m-d') . ' 17:00:00');
                            ?>
                            @if($DT_now > $DT_start and $DT_now < $DT_end)
                            <span class="text-outline-info">電話問合せ: 03-3527-9249</span>
                            <br />
                            @else
                            <span class="text-outline-info">電話問合せ時間は終了しました。</span>
                            <br />
                            @endif
                            <span>平日11:00-17:00</span>
                        @elseif($company->owner_support_type>=4)
                            <?php
                            $DT_start = new DateTime(date('Y-m-d') . ' 08:00:00');
                            $DT_end = new DateTime(date('Y-m-d') . ' 21:00:00');
                            ?>
                            @if($DT_now > $DT_start and $DT_now < $DT_end)
                            <span class="text-outline-info">電話問合せ: 03-3527-9249</span>
                            <br />
                            @else
                            <span class="text-outline-info">電話問合せ時間は終了しました。</span>
                            <br />
                            @endif
                            <span>毎日8:00-21:00</span>
                        @endif
                    </p>
                    @endif
                </div>
            </div>

            <div class="card col-md-4 mb-2">
                <div class="card-block-me pt-10 center">
                    <p class="h4 introduce-title-modan"><strong>ドキュメント</strong></p>
                    <p class="pt-6">
                        <a class="" href="/owner/cmn/terms/customer">カスタマーご予約ルール</a><br />
                        <a class="" href="/owner/cmn/terms/owner">オーナー様向けルール</a>
                    </p>
                </div>
            </div>

            @include('owner/support/include/support_table')



        </div> <!-- row end -->
        </div> <!-- page-content end -->



        <div class="page-content-footer">
            <p class="right">
            </p>
        </div>

    @include('owner/include/footer')
        @include('include/footer')

    </div>
</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script>
function postSupportBuy(support_type) {
    axios.post('/owner/support/buy', {
        support_type: support_type
    })
    .then(function (response) {
        var result = response.data;
        if(!ajaxCheckPublic(result)){return;}
        $('#loading').hide();
        longNotify('サポートのお問合せを承りました。<br />ご検討いただき誠にありがとうございます。<br />スタッフからのご連絡をお待ちください。');
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });
};
</script>

@stop
