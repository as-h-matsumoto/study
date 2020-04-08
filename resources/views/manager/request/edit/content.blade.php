@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') Request Edit Content @parent
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



    <div class="page-content p-4 bg-white-500 " style="overflow-y:scroll;">

<table class="table table-hover">
    <thead>
    <tr>
        <th>リクエストid</th>
        <th>コンテンツ名</th>
        <th>ユーザー名</th>
        <th>ACTION</th>
    </tr>
    </thead>
    <tbody>

    @foreach($request_edit_contents as $request_edit_content)
    {!! Form::open(array('url' => '', 'id' => 'request'.$request_edit_content->id, 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}
    <input type="hidden" name="request_edit_content_id" value="{!!$request_edit_content->id!!}">
    <input type="hidden" name="content_id" value="{!!$request_edit_content['content']->id!!}">
    <input type="hidden" name="user_id" value="{!!$request_edit_content['user']->id!!}">
    <tr id="dele'request{!!$request_edit_content!!}">
        <td>{!!$request_edit_content->id!!}</td>
        <td>{!!$request_edit_content['content']->name!!}</td>
        <td>{!!$request_edit_content['user']->name!!}</td>
        <td>
          <button type="button" class="btn bg-green-200 text-auto" onClick="loading(); " >許可</button>
        </td>
    </tr>
    </form>
    @endforeach

    </tbody>
</table>

    </div>









</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script>
function postContentTags(content_id){

    var form = document.getElementById("content" + content_id);
    var form_data = new FormData(form);

    axios.post('/manager/contents/check', form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}

        $('#deleContent' + content_id).remove();
        $('#loading').hide();
        successNotify('登録しました。');
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });
}

function postContentMenuTags(content_id,content_menu_id){

    var form = document.getElementById("content" + content_id + 'Menu' + content_menu_id);
    var form_data = new FormData(form);

    axios.post('/manager/contents/menu/check', form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}
        $('#deleContent' + content_id + 'Menu' + content_menu_id).remove();
        $('#loading').hide();
        successNotify('登録しました。');
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });
}
</script>
@stop
