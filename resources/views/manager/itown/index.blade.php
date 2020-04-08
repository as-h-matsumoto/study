

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

    <a href="/manager/itown/fgets">iTownページスクレイプ</a>

    
    <div class="py-8">
       
        <!-- <p class="h1 center">iタウンページ</p>
        <p class="h4 center"><a class="text-info" href="/manager/itown_check_fax">fax整理</a></p>
        <p class="h4 center"><a class="text-info" href="/manager/itown_check_tellspace">tellspace整理</a></p>
        <p class="h4 center"><a class="text-info" href="/manager/itown_check_simple">単純整理</a></p>
        <p class="h4 center"><a class="text-info" href="/manager/itown_check_same">重複整理</a></p>
        <p class="h4 center"><a class="text-info" href="autysalon">美容整理</a></p>
        <p class="h4 center"><a class="text-info" href="/manager/itown_check_bokujo">牧場整理</a></p>
        -->
        <p class="h4 center"><a class="text-info" href="/manager/itown_get_service">bussinesstypeからservice判定</a></p>\
        <p class="h4 center"><a class="text-info" href="/manager/itown_get_alldata_form_address">アドレスからdata取得</a></p>
        <p class="h4 center"><a class="text-info" href="/manager/itown_to_contents">コンテンツ作成</a></p>
        
    </div>


<table class="table table-hover">
    <thead>
    <tr>
        <th>id</th>
        <th>bussiness_type</th>
        <th>name</th>
        <th>post_code</th>
        <th>address</th>
        <th>tell/fax</th>
        <th>homepage/itown_url/email</th>
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
        <td> {!!$itown->bussiness_type!!}</td>
        <td> {!!$itown->name!!}</td>
        <td> {!!$itown->post_code!!}</td>
        <td> {!!$itown->address!!}</td>
        <td> {!!$itown->tell!!}<br />{!!$itown->fax!!}</td>
        <td> {!!$itown->homepage!!}<br />{!!$itown->itown_url!!}<br />{!!$itown->paing!!}<br />{!!$itown->email!!}</td>
        <td> <a class="btn" onClick="itown_delete({!!$itown->id!!})">delete</a></td>
    </tr>
</form>
@endforeach

    </tbody>
</table>


<div class="right">

@if ($itowns->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($itowns->onFirstPage())
            <li class="page-item disabled"><span class="page-link">@lang('pagination.previous')</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $itowns->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($itowns->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $itowns->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">@lang('pagination.next')</span></li>
        @endif
    </ul>
@endif


</div>
</form>


    </div>
</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script>
function itown_edit(itown_id){

    var form = document.getElementById("itown" + itown_id);
    var form_data = new FormData(form);

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
