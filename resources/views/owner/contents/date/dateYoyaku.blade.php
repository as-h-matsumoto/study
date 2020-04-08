@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') ご予約者確認 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
<style>
.mycheckbox {
    border-radius:5px;
    border: solid 1px #efefef;

    background-color:#fff;
    white-space: nowrap;
    overflow:hidden;

    width:20px;
    height:20px;
}
</style>
@stop

{{-- content --}}
@section('content')
<div id="project-dashboard" class="page-layout simple full-width">

    @include('owner/contents/include/header')
    
    <div class="page-content p-2">

        @include('owner/contents/date/include/calendar')

    </div>

    <div class="page-content-footer">
        <p class="right">
            <a href="/owner/contents/{!!$content->id!!}/date/yoyaku">
                <button class="f11-sm btn btn-info mb-2-sm-over"><i class="icon icon-account s-4"></i><strong class="">予約状況</strong></button>
            </a>
            <a href="/owner/contents/{!!$content->id!!}/date/edit">
                <button class="f11-sm btn mb-2-sm-over"><i class="icon icon-pen s-4"></i><strong class="">予約受付</strong></button>
            </a>
            <a href="/owner/contents/{!!$content->id!!}/date/adduser">
                <button class="f11-sm btn mb-2-sm-over" style="line-height:12px;"><i class="icon icon-account-plus s-4"></i><strong class="">新規予約</strong></button>
            </a>
        </p>
    </div>
    @include('owner/include/footer')
    @include('include/footer')

</div>
@include('owner/contents/include/modal')

@if($content->service===62 or $content->service===69 or $content->service===101)
@include('owner/contents/date/include/yoyaku_first_modal_lesson')
@else
@include('owner/contents/date/include/yoyaku_first_modal')
@endif

@include('owner/contents/date/include/yoyaku_event_modal')



@stop

{{-- footer scripts --}}
@section('footer_scripts')

@include('include/calendar_js')

<script>
$(document).ready(function () {
    axios.get('/owner/contents/{!!$content->id!!}/date/getDateYoyakuExists')
    .then(function (response) {
      if(!ajaxCheckPublic(response.data)){return;}
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });
});


function postMessageOwner() {

    var form = document.getElementById("messageOwnerForm");
    var form_data = new FormData(form);
    
    axios.post('/owner/contents/{!!$content->id!!}/date/yoyaku/message', form_data)
    .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}
        result = response.data;
        
        $('#loading').hide();
        $('#messageOwner').hide();
        successNotify('メッセージを送りました。');
        $('#to_user_id').val('');
        $('#ownerMessage').val('');
    })
    .catch(function (error) {
      ajaxCheckError(error); return;
    });

}

function cancelMessageOwner() {
    $('#messageOwner').hide();
}

function goinMessageOwner() {
    $('#messageOwner').show();
}





function postYoyakuCancelOwner() {

    var content_date_user_id = $('#modalEventFormcontent_date_user_id').val();
    var form = document.getElementById("yoyakuCancelOwnerForm");
    var form_data = new FormData(form);
    form_data.append('content_date_user_id', content_date_user_id);
    
    axios.post('/owner/contents/{!!$content->id!!}/date/yoyaku/cancel', form_data)
    .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}
        result = response.data;
        
        $('#loading').hide();
        $('#yoyakuCancelOwner').hide();
        successNotify('ご予約のキャンセルをしました。');
        setTimeout("location.reload()",1500);
    })
    .catch(function (error) {
      ajaxCheckError(error); return;
    });

}

function cancelYoyakuCancelOwner() {
    $('#yoyakuCancelOwner').hide();
}

function goinYoyakuCancelOwner() {
    $('#yoyakuCancelOwner').show();
}






function onOffUser() {

    var content_date_user_id = $('#modalEventFormcontent_date_user_id').val();
    
    axios.post('/owner/contents/{!!$content->id!!}/date/yoyaku/onOff', {
        content_date_user_id: content_date_user_id
    })
    .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}
        result = response.data;
        if(result===1){
            $('#offUser').show();
            $('#onUser').hide();
        }else{
            $('#offUser').hide();
            $('#onUser').show();
        }
    })
    .catch(function (error) {
      ajaxCheckError(error); return;
    });

}



</script>
@stop
