@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') ホーム @parent
@stop


@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
<link type="text/css" rel="stylesheet" href="/storage/assets/vendor/nvd3/build/nv.d3.min.css" />
<style>
.nvtooltip{color:#fff;}
.nvd3 g.nv-groups path.nv-line {
  stroke-width: 8px;
}
</style>
@stop

{{-- content --}}
@section('content')
<div id="project-dashboard" class="page-layout simple full-width">

    @include('manager/include/header')

    <div class="page-content p-4">

        <div class="row">

            <div class="col-12 col-sm-4 col-xl-4 p-3">
                <div class="card">
                    <div class="py-2 pl-4 row">
                        <div class="col">
                            <span class="h6">総売り上げ</span>
                        </div>
                    </div>

                    <div class="d-flex flex-column align-items-center justify-content-center" style="padding: 32px 0 61px 0;">
                        <div class="h1 text-danger">&yen; {!!number_format($sellAlltime)!!}</div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-sm-4 col-xl-4 p-3">
                <div class="card">
                    <div class="py-2 pl-4 row">
                        <div class="col">
                            <span class="h6">ユーザ数</span>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center justify-content-center" style="padding: 11px 0 21px 0;">
                        <div class="h1 text-info">Customer: {!!$customerAll!!}</div>
                        <div class="h1 text-success">Owner: {!!$ownerAll!!}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-xl-4 p-3">
                <div class="card">
                    <div class="py-2 pl-4 row">
                        <div class="col">
                            <span class="h6">Coordiy予約の売上げ</span>
                        </div>
                    </div>
                    <div class="pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                        <div class="h1 text-warning">&yen; {!!number_format($yoyaku_sell)!!}</div>
                    </div>
                    <div class="p-4 bg-light row no-gutters align-items-center">
                        <span class="text-muted">先々月:</span>
                        <span class="ml-2">&yen; {!!number_format($yoyaku_sell_before)!!}</span>
                    </div>
                </div>
            </div>

            <div class="col-12 p-3">
                <div class="h5 mb-3 mt-12">売上げチャート</div>
        
                <div class="card mb-12">
                    <div class="card-header">
                        <button id="month-sell-btn" class="btn btn-outline-info float-right" onClick="changeSeelWeekToMonth()" >日時：今月</button>
                        <button id="week-sell-btn" class="btn btn-outline-info float-right mr-4" onClick="changeSeelMonthToWeek()" >日時：今週</button>
                    </div>
                    <div id="month-sell" style="height:460px;">
                        <svg></svg>
                    </div>
                    <div id="week-sell" style="height:460px;">
                        <svg></svg>
                    </div>
                </div>
            </div>
    
            <div class="col-12 col-sm-6 p-3">
                <div class="h5 mb-3">売上げ件数チャート</div>
        
                <div class="card">
                    <div class="card-header">
                        <button id="month-sell-number-btn" class="btn btn-outline-info float-right" onClick="changeSeelNumberWeekToMonth()" >日時：今月</button>
                        <button id="week-sell-number-btn" class="btn btn-outline-info float-right mr-4" onClick="changeSeelNumberMonthToWeek()" >日時：今週</button>
                    </div>
                    <div id="month-sell-number" style="height:460px;">
                        <svg></svg>
                    </div>
                    <div id="week-sell-number" style="height:460px;">
                        <svg></svg>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 p-3">
                <div class="h5 mb-3">顧客件数チャート</div>
        
                <div class="card">
                    <div class="card-header">
                        <button id="month-customer-btn" class="btn btn-outline-info float-right" onClick="changeCustomerWeekToMonth()" >日時：今月</button>
                        <button id="week-customer-btn" class="btn btn-outline-info float-right mr-4" onClick="changeCustomerMonthToWeek()" >日時：今週</button>
                    </div>
                    <div id="month-customer" style="height:460px;">
                        <svg></svg>
                    </div>
                    <div id="week-customer" style="height:460px;">
                        <svg></svg>
                    </div>
                </div>
            </div>


        </div>  

    </div>

    <div class="page-content-footer">
        <p class="right">
            <a class="btn btn-outline-info" href="/manager/gengo/master/add" target="_blank" >元号マスター作成</a>
            <a class="btn btn-outline-info" href="/manager/gengo/year/add" target="_blank" >元号の年登録</a>
        </p>
    </div>

    @include('include/footer')

</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script type="text/javascript" src="/storage/assets/vendor/d3/d3.min.js"></script>
<script type="text/javascript" src="/storage/assets/vendor/nvd3/build/nv.d3.min.js"></script>
@include('owner/include/chart/sell_js')
@include('owner/include/chart/sellNumber_js')
@include('owner/include/chart/customer_js')

@stop
