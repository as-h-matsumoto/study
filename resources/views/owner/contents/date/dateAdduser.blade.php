@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 新規予約登録 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
<style>
.mycheckbox {
    border-radius:5px;
    vertical-align:middle !important;
    display:inline;

    border: solid 1px #efefef;

    background-color:#fff;
    white-space: nowrap;
    overflow:hidden;

    width:22px;
    height:22px;
}
.table.table-hover.contentDesc tbody th,.table.table-hover.contentDesc tbody td{
    padding:0 !important;
    padding: 2px 4px !important;
    text-align:center!important;
    font-size: 11px;
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
                <button class="f11-sm btn mb-2-sm-over"><i class="icon icon-account s-4"></i><strong class="">予約状況</strong></button>
            </a>
            <a href="/owner/contents/{!!$content->id!!}/date/edit">
                <button class="f11-sm btn mb-2-sm-over"><i class="icon icon-pen s-4"></i><strong class="">予約受付</strong></button>
            </a>
            <a href="/owner/contents/{!!$content->id!!}/date/adduser">
                <button class="f11-sm btn btn-info mb-2-sm-over" style="line-height:12px;"><i class="icon icon-account-plus s-4"></i><strong class="">新規予約</strong></button>
            </a>
        </p>
    </div>

    @include('owner/include/footer')
    @include('include/footer')

</div>
@include('owner/contents/include/modal')

@include('SenMonTen/contents/date/include/modal')


@stop

{{-- footer scripts --}}
@section('footer_scripts')

@include('include/calendar_js')

<script>
document.getElementById( 'findOwnersUser' ).onclick = function( e )
{
    findOwnersUser();
};
function findOwnersUser(){

    var inputSearch = $('#ownersUserSearch').val();
    if(!inputSearch) return;
    //console.log(inputSearch);
    inputSearch = inputSearch.replace( /-/g , "" );
    //console.log(inputSearch)
    if(isNaN(inputSearch)) infoNotify('数字とハイフン(-)のみ有効です。');
    //console.log(inputSearch.length)
    if( !(inputSearch.length>=5 && inputSearch.length<=11) ) infoNotify('番号数字の5-11桁で検索してください。');
    moreOwnersUser(inputSearch);

}

function moreOwnersUser(searchTel){
    //console.log(searchTel);
  axios.get('/owner/contents/{!!$content->id!!}/date/adduser/search', {
    params: {
      searchTel: searchTel
    }
  })
  .then(function (response) {
    if(!ajaxCheckPublic(response.data)){return;}
    //console.log(response.data);
    if(isset(response.data)){
      var more = '';
      $.each(response.data,function(index,user){
        more += '<p class="center">';
        more += '<a href="javascript:void(0)" onclick="loading();putOwnersUser('+user.id+');return false;" >';
        more += '<span class="pr-2">お名前: '+user.name+'</span>';
        more += '<span class="pr-2">TEL: '+user.tell+'</span>';
        more += '<span class="text-warning"> << 選択</span>';
        more += '</a>';
        more += '</p>';
      });
      $('#searchAnsArea').html(more);
    }else{
      $('#searchAnsArea').html('<p class=" center f18 text-warning">見つかりませんでした。</p>');
    }
    $('#loading').hide();
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });
}

function putOwnersUser(user_id){
  axios.get('/owner/contents/{!!$content->id!!}/date/adduser/getOwnersUser', {
    params: {
      user_id: user_id
    }
  })
  .then(function (response) {
    if(!ajaxCheckPublic(response.data)){return;}
    //console.log(response.data);
    if(isset(response.data)){
      var user = response.data;
      $('#ownersUserId').val(user.id);
      $('#ownersUserTel').val(user.tell);
      $('#ownersUserName').val(user.name);
      $('#ownersUserDescription').val(user.description);
    }else{
        infoNotify('もう一度お試しください。');
    }
    $('#loading').hide();
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });
}
</script>

@stop
