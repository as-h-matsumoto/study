@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 予約受付スケジュール登録 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
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
                <button class="f11-sm btn btn-info mb-2-sm-over"><i class="icon icon-pen s-4"></i><strong class="">予約受付</strong></button>
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
@include('owner/contents/date/include/edit_event_modal') <!-- service 1,2,10,11 対応 -->

@if($content->service===62 or $content->service===69 or $content->service===101 or $content->service===91)
    @include('owner/contents/date/include/create_event_modal') <!-- service 1,2,10,11 対応 -->
@else
    @include('owner/contents/date/include/edit_first_modal') <!-- service 1,2,10,11 対応 -->
@endif

@stop


{{-- footer scripts --}}
@section('footer_scripts')
@include('include/calendar_js')
@if($content->service===62 or $content->service===69 or $content->service===101 or $content->service===91)
@else
    @include('owner/profile/include/openClose_js')
@endif


<script>
@if($content->service===62 or $content->service===69 or $content->service===101 or $content->service===91)
function selectMenuFunction(menu_id)
{
    $.when(
        $('.mycheckbox').prop("checked",false)
    ).done(function(){
        $('#publicMenu'+menu_id).prop("checked",true);
    });
}
@endif



</script>

@stop
