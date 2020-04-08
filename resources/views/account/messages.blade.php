
<?php $GLOBALS['nofirstMessagePageView'] = true; ?>
@extends('account/layouts/default')

{{-- Page title --}}
@section('title') メッセージ @parent
@stop


@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')

<div class="content custom-scrollbar">

    <!-- HEADER -->
    @include('account/include/header')
    <!-- / HEADER -->

    <div id="contacts" class="page-layout simple left-sidebar-floating"
        style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_02.jpeg')">


        <!-- CONTENT -->
        <div class="page-content-wrapper bg-mask-hard">
                            <aside class="page-sidebar p-6" data-fuse-bar="contacts-sidebar" data-fuse-bar-media-step="md">
                                <div class="page-sidebar-card">
                                    <!-- SIDENAV HEADER -->
                                    <div class="header p-4">

                                        <!-- USER -->
                                        <div class="row no-gutters align-items-center">
                                            <img class="avatar mr-4" alt="{!!Auth::user()->name!!}" src="{!!Util::getPic('user', null, Auth::user()->pic, Auth::user()->id, 400, null)!!}">
                                            <span class="font-weight-bold">{!! mb_strimwidth(Auth::user()->name,0,20,'...') !!}</span>
                                        </div>
                                        <!-- / USER -->

                                    </div>
                                    <!-- / SIDENAV HEADER -->

                                    <div class="divider"></div>

                                    <!-- SIDENAV CONTENT -->
                                    <div class="content">

                                        <ul class="nav flex-column">
                                            <li class="nav-item @if($request_type==='receive'){!!'active'!!}@endif ">
                                                <a class="nav-link ripple active" href="/account/messages?request_type=receive">
                                                    <span>すべてのメッセージ</span>
                                                </a>
                                            </li>

                                            <div class="divider"></div>

                                            <li class="nav-item @if($request_type==='send'){!!'active'!!}@endif ">
                                                <a class="nav-link ripple active" href="/account/messages?request_type=send">
                                                    <span>送信メッセージ</span>
                                                </a>
                                            </li>

                                            <div class="divider"></div>

                                            @if($user)
                                            <li class="nav-item @if($request_type==='user'){!!'active'!!}@endif ">
                                                <a class="nav-link ripple" href="/account/messages?request_type=user&user_id={!!$user->id!!}">
                                                    <span class="pl-2">{!! mb_strimwidth($user->name,0,20,'...') !!}</span>
                                                </a>
                                            </li>
                                            @endif

                                            
                                        </ul>
                                    </div>
                                    <!-- / SIDENAV CONTENT -->
                                </div>
                            </aside>

                            <!-- CONTENT -->
                            <div class="page-content p-4 p-sm-6">
                                <!-- CONTACT LIST -->
                                <div class="contacts-list card" style="min-height:500px">

                                    <!-- CONTACT LIST HEADER -->
                                    <div class="contacts-list-header py-4 mx-0">

                                        
                                <!-- CONTENT TOOLBAR -->
                                <div class="toolbar row no-gutters align-items-center px-3 px-sm-6">

                                    <div class="col">

                                        <div class="row no-gutters align-items-center">

                                            <div class="col-auto">

                                                <label class="custom-control custom-checkbox">
                                                    <input id="checkAllMessages" type="checkbox" class="custom-control-input" value="1" />
                                                    <span class="custom-control-indicator"></span>
                                                </label>

                                            </div>

                                            <div class="action-buttons col">

                                                <div class="row no-gutters align-items-center flex-nowrap d-none d-xl-flex">

                                                    <div class="divider-vertical"></div>

                                                    <button onClick="messageAlreadyRead()" type="button" class="btn btn-icon" aria-label="open" title="既読">
                                                        <i class="icon icon-email-open-outline text-green-500"></i>
                                                    </button>

                                                    <div class="divider-vertical()"></div>

                                                    <button data-toggle="modal" data-target="#modelMessageDelete" type="button" class="btn btn-icon" aria-label="delete" title="削除">
                                                        <i class="icon icon-delete text-blue-500"></i>
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-auto">

                                        <div class="row no-gutters align-items-center">

                                            <span class="page-info px-2 d-sm-block"><span id="messageStart">1</span><span id="messageEndExists">@if($messages->count()) - @endif</span><span id="messageEnd">{!!$messages->count()!!}</span> of {!!$messages->total()!!}</span>

                                            <a id="previousPageUrl" >
                                            </a>

                                            <a id="nextPageUrl">
                                            @if($messages->nextPageUrl())
                                            <button type="button" class="btn btn-icon" onClick="ajaxPaginationMoreMessages(2)" >
                                                <i class="icon icon-chevron-right"></i>
                                            </button>
                                            @endif
                                            </a>

<div class="dropdown">
    <a class="dropdown-toggle" type="" id="messageMenuButton"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="icon icon-message-settings-variant text-red-600"></i>
    </a>
    <div class="dropdown-menu" aria-labelledby="messageMenuButton">

                            <a class="dropdown-item fuse-ripple-ready" onClick="messageAlreadyRead()" >
                                <div class="row no-gutters align-items-center justify-content-between flex-nowrap">
                                    <div class="row no-gutters align-items-center flex-nowrap">
                                        <i class="icon icon-email-open-outline text-green-500" title="既読" alt="既読"></i>
                                        <span class="px-3">既読</span>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item fuse-ripple-ready" data-toggle="modal" data-target="#modelMessageDelete" >
                                <div class="row no-gutters align-items-center justify-content-between flex-nowrap">
                                    <div class="row no-gutters align-items-center flex-nowrap">
                                        <i class="icon icon-delete text-blue-500" title="削除" alt="削除"></i>
                                        <span class="px-3">削除</span>
                                    </div>
                                </div>
                            </a>

    </div>
</div>

                                        </div>
                                    </div>
                                </div>

                                

                                    </div>
                                    <!-- / CONTACT LIST HEADER -->
                                    <div id="messagesArea">

                                    @include('account/include/messages_more')

                                    </div>
                                    <!-- Message Area -->

                                </div>
                                <!-- / CONTACT LIST -->
                            </div>
                            <!-- / CONTENT -->

    </div>

    @include('account/include/footer')
    @include('include/footer')

</div>

@stop

{{-- footer scripts --}}
@section('footer_scripts')


<script>





function messageReplyModal(user_id) {

    $.when(
        $('#modalMessageUp').modal('hide')
    ).done(function(){
        $('#messageReply_user_id').val(user_id);
        var userArea = $('#userArea').html();
        $('#userAreaReply').html(userArea);
        
        $('#modelMessageReply').modal('show');
    });

}



function postMessageReply() {

    var form = document.getElementById("messageReplyForm");
    var form_data = new FormData(form);

    axios.post('/account/messages/reply', form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}

        $('#loading').hide();
        $('#modelMessageReply').modal('hide');
        longNotify('送信しました。<br />送信メッセージや返答は<br />「メッセージ」で確認できます。');
    })
    .catch(function (error) {
        $('#loading').hide();
        $('#modelMessageReply').modal('hide');
        ajaxCheckError(error); return;
    });
}




function modalMessageUp(messeges_notread_id) {

    loading();

    //console.log('messeges_notread_id: '+messeges_notread_id);
    axios.get('/account/messages/oneMessage', {
        params: {
            messeges_notread_id: messeges_notread_id
        }
    })
    .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}
        var message = response.data.message;
        var user = response.data.user;
        
        $('#modalMessageUp').modal('show');

        if(message.all_users===0 && message.all_owners===0 && message.user_id!=={!!Auth::user()->id!!}){
            var insert = '';
            insert += '<button id="messageReplyModal" class="btn btn-outline-info" onclick="messageReplyModal('+message.user_id+');return false;" >';
            insert += '返信';
            insert += '</button>';
            $('#messageReplyArea').html(insert);
        }else{
            $('#messageReplyArea').html('');
        }

        var insert = '';
        insert += '<div class="text-truncate font-weight-bold border-bottom pb-4 mb-4">';
        insert += '<img class="avatar mr-2" alt="Abbott" src="'+user.user_pic+'" />';
        insert += truncate(user.name,30,null);
        insert += '</div>';
        $('#userArea').html(insert);
        
        $('#messageArea').html(message.message.replace(/\r?\n/g, '<br>'));

        $('#modalMessageUp').modal('show');
        $('#loading').hide();
    })
    .catch(function (error) {
      $('#loading').hide();
      ajaxCheckError(error); return;
    });

}


function messageAlreadyRead() {
    var messages = $('[class="custom-control-input message-check-checked"]:checked').map(function(){
        //$(this)でjQueryオブジェクトが取得できる。val()で値をvalue値を取得。
        return $(this).val();
    }).get();
    //console.log(messages);
    if(isset(messages)){
        axios.post('/account/messages/already', {
            messages: messages
        })
        .then(function (response) {
            result = response.data;
            if(!ajaxCheckPublic(result)){return;}
            $.each(messages,function(index,id){
                if($('#messageId'+id).hasClass('alreadyRead')){
                    $('#messageId'+id).removeClass('alreadyRead');
                }else{
                    $('#messageId'+id).addClass('alreadyRead');
                }
            });
            $('#loading').hide();
        })
        .catch(function (error) {
            $('#loading').hide();
            ajaxCheckError(error); return;
        });
    }else{
        $('#loading').hide();
        infoNotify('既読にするメッセージにチェックを入れてください。');
    }
}

function messageDelete() {
    var messages = $('[class="custom-control-input message-check-checked"]:checked').map(function(){
        //$(this)でjQueryオブジェクトが取得できる。val()で値をvalue値を取得。
        return $(this).val();
    }).get();
    //console.log(messages);
    if(isset(messages)){
        axios.post('/account/messages/delete', {
            messages: messages
        })
        .then(function (response) {
            result = response.data;
            if(!ajaxCheckPublic(result)){return;}
            $.each(messages,function(index,id){
                $('#messageId'+id).remove();
            });
            $('#loading').hide();
            $('#modelMessageDelete').modal('hide');
        })
        .catch(function (error) {
            $('#loading').hide();
            ajaxCheckError(error); return;
        });
    }else{
        $('#loading').hide();
        infoNotify('削除するメッセージにチェックを入れてください。');
    }
}

function checkAllMessages() {

    var data = $('#checkAllMessages').prop('checked');
    $('.custom-control-input').prop('checked', data);
    
}
document.getElementById('checkAllMessages').addEventListener('change', checkAllMessages, false);

function ajaxPaginationMoreMessages(page) {
    loading();

    axios.get('/account/messages?page='+page)
    .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}
        $('#messagesArea').html(response.data);
        $('#loading').hide();
    })
    .catch(function (error) {
      $('#loading').hide();
      ajaxCheckError(error); return;
    });
}



</script>
@stop
