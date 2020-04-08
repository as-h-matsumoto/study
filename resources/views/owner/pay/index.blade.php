@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') ネット決済設定 @parent
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
                    <p class="h4 introduce-title-stripe"><strong>ネット決済状況</strong></p>
                    <p class="h5 text-success pt-6"><strong><img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_100x26.png" alt="PayPal Logo"></strong></p>
                </div>
            </div>

            <div class="card col-md-4 mb-2">
                <div class="card-block-me pt-10 center">
                    <p class="h4 introduce-title-stripe"><strong>ネット決済費用</strong></p>
                    <p class="h5 text-success pt-6">
                      <strong>８％＋40円</strong>
                    </p>
                </div>
            </div>

            <div class="card col-md-4 mb-2">
                <div class="card-block-me pt-10 center">
                    <p class="h4 introduce-title-stripe"><strong>ネット決済プラン</strong></p>
                    <p class=" pt-6 pb-4">
                      6%＋40円: 10,000/月<br />
                      4%＋40円: 20,000/月
                    </p>
                    <p><button onClick="loading(); postSupportBuy(21)" class="btn btn-outline-info f14" ><strong>お問合せ</strong></button></p>
                </div>
            </div>

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
        longNotify('ネット決済費用のお問合せを承りました。<br />ご検討いただき誠にありがとうございます。<br />スタッフからのご連絡をお待ちください。');
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });
};
</script>

@stop
