

@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') 記事一覧 @parent
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

    <p class="h2 center">記事一覧</p>

    
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
    </tr>
    </thead>
    <tbody>

@foreach($kijis as $kiji)
    <tr id="tr{!!$kiji->id!!}">
        <td>{!!$kiji->id!!}</td>
        <td>{!!$kiji->content_id!!}<br />{!!$kiji->service!!}</td>
        <td>{!!nl2br($kiji->title)!!}</td>
        <td>{!!nl2br($kiji->summary)!!}</td>
        <td>{!!nl2br($kiji->to_shop)!!}</td>
        <td>{!!nl2br($kiji->in_shop)!!}</td>
        <td>{!!nl2br($kiji->in_service)!!}</td>
        <td>{!!nl2br($kiji->finish)!!}</td>
        <td>pic_build    <br /><img src="/storage/uploads/kijis/{!!$kiji->id!!}/{!!$kiji->pic_build!!}" /></td>
        <td>pic_out_shop <br /><img src="/storage/uploads/kijis/{!!$kiji->id!!}/{!!$kiji->pic_out_shop!!}" /></td>
        <td>pic_in_shop_1<br /><img src="/storage/uploads/kijis/{!!$kiji->id!!}/{!!$kiji->pic_in_shop_1!!}" /></td>
        <td>pic_in_shop_2<br /><img src="/storage/uploads/kijis/{!!$kiji->id!!}/{!!$kiji->pic_in_shop_2!!}" /></td>
        <td>pic_service_1<br /><img src="/storage/uploads/kijis/{!!$kiji->id!!}/{!!$kiji->pic_service_1!!}" /></td>
        <td>pic_service_2<br /><img src="/storage/uploads/kijis/{!!$kiji->id!!}/{!!$kiji->pic_service_2!!}" /></td>
    </tr>
</form>
@endforeach

    </tbody>
</table>


<div class="right">

@if ($kijis->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($kijis->onFirstPage())
            <li class="page-item disabled"><span class="page-link">@lang('pagination.previous')</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $kijis->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($kijis->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $kijis->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
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

@stop
