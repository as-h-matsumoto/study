
@forelse ($messages as $message)
<!-- CONTACT ITEM -->
<div id="messageId{!!$message->id!!}" class="contact-item ripple row no-gutters align-items-center py-2 px-3 py-sm-4 px-sm-6 @if($message->already_read){!!'alreadyRead'!!}@endif " >
    <label class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input message-check-checked" name="messageId{!!$message->id!!}" value="{!!$message->id!!}" />
        <span class="custom-control-indicator"></span>
    </label>
    <img class="avatar mx-4" alt="Abbott" src="{!!Util::getPic('user', null, $message->target_user_pic, $message->target_user_id, 400, null)!!}" />
    <div onClick="modalMessageUp({!!$message->id!!})" class="col text-truncate font-weight-bold">
        {!! mb_strimwidth($message->message,0,30,'...') !!}
    </div>
    <div class="col job-title text-truncate px-1 d-none d-sm-flex">
        <a href="/account/messages?request_type=user&user_id={!!$message->target_user_id!!}" class="text-info" >{!! mb_strimwidth($message->target_user_name,0,50,'...') !!}</a>
    </div>
    <div class="col-1 job-title text-truncate px-1 d-none d-sm-flex">
        {!! Util::getOverTimeJp($message->updated_at) !!}
    </div>
    <div class="col-1 company text-truncate px-1 d-none d-sm-flex">
        @if($message->target_user_owner)
        オーナー
        @else
        カスタマー
        @endif
    </div>
    <div class="col-1 actions" style="min-width:30px;">
        <div class="row no-gutters">
            <button onClick type="button" class="btn btn-icon">
            </button>
        </div>
    </div>
</div>
<!-- CONTACT ITEM -->
@empty
<div class="contact-item ripple row no-gutters align-items-center py-2 px-3 py-sm-4 px-sm-6">
    <div class="col-auto">
        <p>メッセージはありません。</p>
    </div>
</div>
@endforelse



<script>


@if( !isset($GLOBALS['nofirstMessagePageView']) )

$(document).ready(function () {
    //console.log('messageMore');
    @if($messages->previousPageUrl())
    <?php
    $page = explode('/account/messages?page=',$messages->previousPageUrl());
    logger('page: '. $page[1]);
    ?>
    //console.log('previousPageUrl');
    var insert = '';
    insert += '<button type="button" class="btn btn-icon" onClick="ajaxPaginationMoreMessages({!!$page[1]!!})" >';
    insert += '<i class="icon icon-chevron-left"></i>';
    insert += '</button>';
    $('#previousPageUrl').html(insert);
    @else
    $('#previousPageUrl').html('')
    @endif

    @if($messages->nextPageUrl())
    <?php
    $page = explode('/account/messages?page=',$messages->nextPageUrl());
    logger('page: '. $page[1]);
    ?>
    //console.log('nextPageUrl');
    var insert = '';
    insert += '<button type="button" class="btn btn-icon" onClick="ajaxPaginationMoreMessages({!!$page[1]!!})" >';
    insert += '<i class="icon icon-chevron-right"></i>';
    insert += '</button>';
    $('#nextPageUrl').html(insert);
    @else
    $('#nextPageUrl').html('')
    @endif

    
    @if($messages->currentPage()<=1)
    //console.log('in <=1');
    $('#messageStart').html('1');
    $('#messageEndExists').html(' - ');
    $('#messageEnd').html('{!!$messages->count()!!}');
    @else
    //console.log('in >=2');
    <?php
    $start = 1+($messages->perPage()*($messages->currentPage()-1));
    $end = $messages->count()+($messages->perPage()*($messages->currentPage()-1));
    ?>
    $('#messageStart').html('{!!$start!!}');
    $('#messageEndExists').html(' - ');
    $('#messageEnd').html('{!!$end!!}');
    @endif

});



@else
<?php $GLOBALS['nofirstMessagePageView'] = true; ?>
@endif


</script>