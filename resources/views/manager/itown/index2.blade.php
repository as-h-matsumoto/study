@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') オーナーリクエスト @parent
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

    
    <div class="py-8">
    <p class="h1 center">iタウンページ</p>
    <!--
        <p class="h4 center"><a class="text-info" href="/manager/itown_check_fax">fax整理</a></p>
        <p class="h4 center"><a class="text-info" href="/manager/itown_check_tellspace">tellspace整理</a></p>
        <p class="h4 center"><a class="text-info" href="/manager/itown_check_simple">単純整理</a></p>
        <p class="h4 center"><a class="text-info" href="/manager/itown_check_same">重複整理</a></p>
        <p class="h4 center"><a class="text-info" href="/manager/itown_check_beautysalon">美容整理</a></p>
        -->
    </div>


<table class="table table-hover">
    <thead>
    <tr>
        <th>id</th>
        <th>area</th>
        <th style=" max-wight:80px !important;">type_key</th>
        <th style=" max-wight:80px !important;">type_value</th>
        <th style="font-weight:900;min-wight:280px !important;">name</th>
        <!-- <th>post_code</th> -->
        <th>address</th>
        <th>tell</th>
        <th>action</th>
    </tr>
    </thead>
    <tbody>

@foreach($itowns as $itown)
{!! Form::open(array('url' => '', 'id' => 'itown'.$itown->id, 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}
    <tr id="tr{!!$itown->id!!}">
        <td> {!!$itown->id!!}
             <input type="hidden" name="id" value="{!!$itown->id!!}" />
        </td>
        <td> {!!$itown->area!!}</td>
        <td style=" max-wight:80px !important;"> <input style=" max-wight:80px !important;" type="text" name="type_key" value="{!!$itown->type_key!!}" /></td>
        <td style=" max-wight:80px !important;"> <textarea style=" max-wight:60px !important;" name="type_value">{!!$itown->type_value!!}</textarea></td>
        <td style="min-wight:280px !important;"> <textarea name="name" style="height:60px; font-weight:900;min-wight:280px !important; font-size:18px;">{!!$itown->name!!}</textarea></td>
        <!-- <td> {!!$itown->post_code!!}</td> -->
        <td> {!!$itown->address!!}</td>
        <td> <textarea name="tell">{!!$itown->tell!!}</textarea></td>
        <td> 
            <a class="btn" onClick="itown_edit({!!$itown->id!!})">edit</a>
            <a class="btn" onClick="itown_delete({!!$itown->id!!})">delete</a>
        </td>
    </tr>
</form>
@endforeach

    </tbody>
</table>


<div class="right">


</div>
</form>


    </div>
</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')


<script>
function itown_edit(itown_id){

   //console.log(itown_id);

    var form = document.getElementById("itown" + itown_id);
    var form_data = new FormData(form);

   //console.log(form);

    axios.post('/manager/itown_edit', form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}

        successNotify('変更しました。');
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });
}

function itown_delete(itown_id){

    var form = document.getElementById("itown" + itown_id);
    var form_data = new FormData(form);

    axios.post('/manager/itown_delete', form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}
        $('#tr' + itown_id).remove();
        successNotify('削除しました。');
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });
}
</script>

@stop
