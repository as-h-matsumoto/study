@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 顧客管理 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')
<div id="project-dashboard" class="page-layout simple full-width">

        @include('owner/include/header')
    
        <div class="page-content p-2">

            @include('owner/customer/include/customerTable')

        </div>


        <div class="page-content-footer">
            <p class="right">
            </p>
        </div>

        @include('owner/include/footer')
        @include('include/footer')

</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script type="text/javascript">

function ownersUserPost(owners_user_id){

    loading();
    var name = $('#ownersUserNameForm'+owners_user_id).val();
    var dob = $('#ownersUserDobForm'+owners_user_id).val();
    var tell = $('#ownersUserTellForm'+owners_user_id).val();
    var description = $('#ownersUserDescriptionForm'+owners_user_id).val();
    if(!isset(description)) description = '';

    var form_data = new FormData();
    form_data.append('owners_user_id', owners_user_id);
    form_data.append('name', name);
    form_data.append('dob', dob);
    form_data.append('tell', tell);
    form_data.append('description', description);
  
    axios.post('/owner/customer', form_data)
    .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}

        $('#ownersUser'+owners_user_id).removeClass('bg-blue-50');
        $('#ownersUserName'+owners_user_id).html(name);
        $('#ownersUserDob'+owners_user_id).html(dob);
        $('#ownersUserTell'+owners_user_id).html(tell);
        if(!isset(description)) description = '';
        $('#ownersUserDescription'+owners_user_id).html(nl2br(description));
        $('#ownersUserEdit'+owners_user_id).html('<a href="javascript:void(0)" onClick="ownersUserEdit('+owners_user_id+')"><i class="icon icon-pen"></i></a>');
        $('#loading').hide();
        successNotify('編集しました。');
    })
    .catch(function (error) {
      ajaxCheckError(error); return;
    });
}

function ownersUserEdit(owners_user_id){

  var ownersUserName = $('#ownersUserName'+owners_user_id).html();
  var ownersUserDob = $('#ownersUserDob'+owners_user_id).html();
  if(!isset(ownersUserDob)) ownersUserDob = '1985-04-01';
  var ownersUserTell = $('#ownersUserTell'+owners_user_id).html();
  var ownersUserDescription = $('#ownersUserDescription'+owners_user_id).html();
 //console.log(ownersUserDescription);
  if(!isset(ownersUserDescription)) ownersUserDescription = '';
 //console.log(ownersUserDescription);
  $('#ownersUserName'+owners_user_id).html('<input class="form-control" type="text" value="'+ownersUserName+'" id="ownersUserNameForm'+owners_user_id+'" />');
  $('#ownersUserDob'+owners_user_id).html('<input class="form-control" type="date" value="'+ownersUserDob+'" id="ownersUserDobForm'+owners_user_id+'" />');
  $('#ownersUserTell'+owners_user_id).html('<input class="form-control" type="tel" value="'+ownersUserTell+'" id="ownersUserTellForm'+owners_user_id+'" />');
  $('#ownersUserDescription'+owners_user_id).html('<textarea class="form-control" id="ownersUserDescriptionForm'+owners_user_id+'" >'+nl2brBack(ownersUserDescription)+'</textarea>');

  $('#ownersUserEdit'+owners_user_id).html('<a class="text-green-500" href="javascript:void(0)" onClick="ownersUserPost('+owners_user_id+')"><i class="icon icon-plus text-green-500 s-4"></i>登録</a>');

  $('#ownersUser'+owners_user_id).addClass('bg-blue-50');
  
}


$(document).ready(function () {

    axios.get('/owner/customer/get')
    .then(function (response) {
        result = response.data;
        //console.log(result);
        var insert = '';
        $.each(result.data,function(index,customer){
            insert += '<tr id="ownersUser'+customer.id+'">';
            insert += '<th id="ownersUserName'+customer.id+'" scope="row" class="text-info text-center">'+customer.name+'</th>';
            if(customer.dob == 'null'){
                var dob = '';
            }else if(!isset(customer.dob)){
                var dob = '';
            }else{
                var dob = customer.dob;
            }
            insert += '<td id="ownersUserDob'+customer.id+'" class="text-center">'+dob+'</td>';
            insert += '<td id="ownersUserTell'+customer.id+'" class="text-center">';
            if(customer.tell!=0) insert += customer.tell;
            insert += '</td>';
            insert += '<td id="ownersUserDescription'+customer.id+'" class="text-center">';
            if(isset(customer.description)) insert += nl2br(customer.description);
            insert += '</td>';
            insert += '<td class="text-center">'
            var count = false;
            $.each(customer.usedContents,function(index,content){
                if(count){
                    insert += '<br />';
                }else{
                    count = true;
                }
                insert += content.name+'</td>';
            });
            insert += '</td>'
            insert += '<td class="text-center">'+customer.updated_at_jp+'</td>';
            insert += '<td class="text-center">&yen;'+customer.payAll+'</td>';
            insert += '<td class="text-center">'+customer.usedAll+'</td>';
            insert += '<td class="text-center" id="ownersUserEdit'+customer.id+'"><a href="javascript:void(0)" onClick="ownersUserEdit('+customer.id+')"><i class="icon icon-pen"></i></a></td>';
            insert += '</tr>';
        });
        $('#customerList').append(insert);
        if(result.next_page_url){
            var more = '';
            more += '<button class="btn btn-outline-info" ';
            more += ' onclick="loading();';
            more += ' ajaxPaginationMoreCustomer(\'';
            more += result.next_page_url;
            more += '\');return false;" >';
            more += '<strong>もっと</strong>';
            more += '</button>';
            document.getElementById('more-customer').innerHTML = more;
        }else{
            document.getElementById('more-customer').innerHTML = '';
        }
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

});



function ajaxPaginationMoreCustomer(url) {
    axios.get(url)
    .then(function (response) {
        result = response.data;
        //console.log(result);
        var insert = '';
        $.each(result.data,function(index,customer){
            insert += '<tr id="ownersUser'+customer.id+'">';
            insert += '<th id="ownersUserName'+customer.id+'" scope="row" class="text-info text-center">'+customer.name+'</th>';
            insert += '<td id="ownersUserDob'+customer.id+'" class="text-center">'+customer.dob+'</td>';
            insert += '<td id="ownersUserTell'+customer.id+'" class="text-center">'+customer.tell+'</td>';
            insert += '<td id="ownersUserDescription'+customer.id+'" class="text-center">'+nl2br(customer.description)+'</td>';
            insert += '<td class="text-center">'
            var count = false;
            $.each(customer.usedContents,function(index,content){
                if(count){
                    insert += '<br />';
                }else{
                    count = true;
                }
                insert += content.name+'</td>';
            });
            insert += '</td>'
            insert += '<td class="text-center">'+customer.updated_at_jp+'</td>';
            insert += '<td class="text-center">&yen;'+customer.payAll+'</td>';
            insert += '<td class="text-center">'+customer.usedAll+'</td>';
            insert += '<td class="text-center"><span onClick="ownersUserEdit('+customer.id+')"><i class="icon icon-pen"></i></span></td>';
            insert += '</tr>';
        });
        $('#customerList').append(insert);
        if(result.next_page_url){
            var more = '';
            more += '<button class="btn btn-outline-info" ';
            more += ' onclick="loading();';
            more += ' ajaxPaginationMoreCustomer(\'';
            more += result.next_page_url;
            more += '\');return false;" >';
            more += '<strong>もっと</strong>';
            more += '</button>';
            document.getElementById('more-customer').innerHTML = more;
        }else{
            document.getElementById('more-customer').innerHTML = '';
        }
        $('#loading').hide();
    })
    .catch(function (error) {
      $('#more-customer').remove();
      ajaxCheckError(error); return;
    });
}

</script>






@stop
