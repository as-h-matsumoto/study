@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') 記事登録 @parent
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

    <p class="h2 center">記事登録</p>

    <div class="py-8">
        <p class="h4 center"><a class="text-info" href="/manager/kiji/">一覧確認</a></p>\
        <p class="h4 center"><a class="text-info" href="/manager/kiji/edit">記事編集</a></p>
        <p class="h4 center"><a class="text-info" href="/manager/kiji/create">作成</a></p>
    </div>


<table class="table table-hover">
    <thead>
    <tr>
        <th>id</th>
        <th>content_id<br />service</th>
        <th>title</th>
        <th>summary</th>
        <th>to_shop</th>
        <th>in_shop</th>
        <th>in_service</th>
        <th>finish</th>
        <th>pic_build</th>
        <th>pic_out_shop</th>
        <th>pic_in_shop_1</th>
        <th>pic_in_shop_2</th>
        <th>pic_service_1</th>
        <th>pic_service_2</th>
        <th>action</th>
    </tr>
    </thead>
    <tbody>

@foreach($kijis as $kiji)
{!! Form::open(array('url' => '', 'id' => 'kiji'.$kiji->id, 'method' => 'post', 'class' => 'row', 'files'=> true)) !!}
    <tr id="tr{!!$kiji->id!!}">
        <td> {!!$kiji->id!!}
             <input type="hidden" name="id" value="{!!$kiji->id!!}" />
        </td>
        <td>{!!$kiji->content_id!!}<br />{!!$kiji->service!!}</td>
        <td style="max-wight:120px !important;"> <textarea name="title"   style="min-wight:100px !important;" placeholder="title">{!!$kiji->title!!}</textarea></td>
        <td style="max-wight:120px !important;"> <textarea name="summary" style="min-wight:100px !important;" placeholder="summary">{!!$kiji->summary!!}</textarea></td>
        <td style="max-wight:120px !important;"> <textarea name="to_shop" style="min-wight:100px !important;" placeholder="to_shop">{!!$kiji->to_shop!!}</textarea></td>
        <td style="max-wight:120px !important;"> <textarea name="in_shop" style="min-wight:100px !important;" placeholder="in_shop">{!!$kiji->in_shop!!}</textarea></td>
        <td style="max-wight:120px !important;"> <textarea name="in_service" style="min-wight:100px !important;" placeholder="in_service">{!!$kiji->in_service!!}</textarea></td>
        <td style="max-wight:120px !important;"> <textarea name="finish" style="min-wight:100px !important;" placeholder="finish">{!!$kiji->finish!!}</textarea></td>
        <td>pic_build<input accept="image/*" type="file" class="" name="pic_build" /></td>
        <td>pic_out_shop<input accept="image/*" type="file" class="" name="pic_out_shop" /></td>
        <td>pic_in_shop_1<input accept="image/*" type="file" class="" name="pic_in_shop_1" /></td>
        <td>pic_in_shop_2<input accept="image/*" type="file" class="" name="pic_in_shop_2" /></td>
        <td>pic_service_1<input accept="image/*" type="file" class="" name="pic_service_1" /></td>
        <td>pic_service_2<input accept="image/*" type="file" class="" name="pic_service_2" /></td>
        <td>
            <input type="checkbox" name="open" value="1" />open <br />
            <a class="btn" onClick="kiji_edit({!!$kiji->id!!})">edit</a>
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
function kiji_edit(kiji_id){

   //console.log(kiji_id);

    var form = document.getElementById("kiji" + kiji_id);
    var form_data = new FormData(form);

    axios.post('/manager/kiji/create', form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}

        successNotify('登録しました。');
        location.href='/manager/kiji';
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });
}

</script>

@stop
