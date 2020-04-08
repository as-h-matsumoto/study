@extends('owner/layouts/default')

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
<div id="profile" class="page-layout simple right-sidebar">

    <div class="page-content-wrapper">

    @include('owner/include/header')
    
    <div class="page-content p-4">

        <div class="row">

            <div class="card col-12 col-sm-4 col-xl-3 pt-4 mb-2" style="min-height: 180px !important;">
                
                <div>
                    <p class="h5 center"><strong>
                        <span class="introduce-title-kagi-kakko">
                        <a href="/owner/contents">
                            <i class="icon icon-comment-multipe-outline  text-deep-purple-400" title="コンテンツ管理" alt="コンテンツ管理"></i>
                            お店
                        </a></span>
                    </strong></p>
                </div>
                
                <div class="mt-10">
                    <table class="center">
                    <tbody>
    
                        @if($contents_number)
                        <tr><th>登録： </th><td class=""><strong>
                        <span class="text-success f20">{!!$contents_number!!}店舗</span>
                        </strong></td></tr>
                        @else
                        <tr><th colspan="2"><strong>
                        <span class="text-warning f20">お店(コンテンツ)未登録</span>
                        </strong></th></tr>
                        @endif
    
                    </tbody>
                    </table>
                </div>

            </div>




            <div class="card col-12 col-sm-4 col-xl-3 pt-4 mb-2" style="min-height: 180px !important;">
                <div>
                    <p class="h5 center"><strong>
                        <span class="introduce-title-kagi-kakko">
                        <a href="/owner/profile">
                        <i class="icon icon-store s-5 text-green-700" title="会社情報" alt="会社情報"></i>
                            会社情報
                        </a></span>
                    </strong></p>
                </div>
                
                <div class="mt-10">
                    <table class="center">
                    <tbody>
    
                        @if($company_number > 70)
                        <tr><th>登録： </th><td><strong>
                        <span class="text-success f20">{!!$company_number!!}%</span>
                        </strong></td></tr>
                        @else
                        <tr><th colspan="2"><strong>
                        <span class="text-warning f20">{!!$company_number!!}%</span>
                        </strong></th></tr>
                        @endif
    
                    </tbody>
                    </table>
                </div>
            </div>
            

            <div class="card col-12 col-sm-4 col-xl-3 pt-4 mb-2" style="min-height: 180px !important;">
                <div>
                    <p class="h5 center"><strong>
                        <span class="introduce-title-kagi-kakko">
                        <a href="/owner/bank">
                        <i class="icon icon-bank s-5 text-blue-grey-500" title="会社口座" alt="会社口座"></i>
                            会社口座
                        </a></span>
                    </strong></p>
                </div>
                
                <div class="mt-10">
                    <table class="center">
                    <tbody>
                        @if($bank_number)
                        <tr><th><strong>
                        <span class="text-success f20">登録済み</span>
                        </strong></th></tr>
                        @else
                        <tr><th><strong>
                        <span class="text-waning f20">未登録</span>
                        </strong></th></tr>
                        @endif
                    </tbody>
                    </table>
                </div>
            </div>

            <div class="card col-12 col-sm-4 col-xl-3 pt-4 mb-2" style="min-height: 180px !important;">
                
                <div>
                    <p class="h5 center"><strong>
                        <span class="introduce-title-kagi-kakko">
                        <a href="/owner/support">
                        <i class="icon icon-crosshairs s-5 text-deep-purple-400" title="サポート" alt="サポート"></i>
                            サポート
                        </a></span>
                    </strong></p>
                </div>
                    
                <div class="mt-10">
                    <table class="center">
                    <tbody>
    
                        <tr><th><strong>
                        <span class="text-info f20">{!!$support_number!!}</span>
                        </strong></th></tr>
    
                    </tbody>
                    </table>
                </div>
            </div>
            
            <div class="col-12 col-sm-4 col-xl-4 p-3">
                <div class="card">
                    <div class="py-2 pl-4 row">
                        <div class="col">
                            <span class="h6" title="サービス提供済み" alt="サービス提供済み">総売上げ</span>
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
                            <span class="h6">総顧客数</span>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center justify-content-center" style="padding: 32px 0 61px 0;">
                        <div class="h1 text-info">{!!$customerAll!!}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-xl-4 p-3">
                <div class="card">
                    <div class="py-2 pl-4 row">
                        <div class="col">
                            <span class="h6">次回入金額</span>
                        </div>
                    </div>
                    <div class="pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                        <div class="h1 text-warning">&yen; {!!number_format($send_bank)!!}</div>
                    </div>
                    <div class="p-4 bg-light row no-gutters align-items-center">
                        <span class="text-muted">先月:</span>
                        <span class="ml-2">&yen; {!!number_format($send_bank_before)!!}</span>
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
        </p>
    </div>

    @include('owner/include/footer')
    @include('include/footer')

    </div>

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
