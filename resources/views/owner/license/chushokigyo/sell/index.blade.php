@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 売上げ @parent
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

<div id="profile" class="page-layout simple right-sidebar tabbed">

    <div class="page-content-wrapper">

    @include('owner/contents/include/header')

    <!-- CONTENT -->
    <div class="page-content">
        <ul class="nav nav-tabs">

            <li id="showDashboard" class="nav-item active">
                <button onClick="showDashboard();" class="nav-link btn-outline-info">ダッシュボード</button>
            </li>

            <li id="showSell" class="nav-item">
                <button onClick="showSell();" class="nav-link btn btn-outline-info">売上げ一覧</button>
            </li>

        </ul>
        <div class="tab-content p-0" id="myTabContent">

            @include('owner/contents/sell/include/dashboard')

            @include('owner/contents/sell/include/sell')

        </div>
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

<script type="text/javascript" src="/storage/assets/vendor/d3/d3.min.js"></script>
<script type="text/javascript" src="/storage/assets/vendor/nvd3/build/nv.d3.min.js"></script>
@include('owner/contents/sell/include/chart/sell_js')
@include('owner/contents/sell/include/chart/sellNumber_js')
@include('owner/contents/sell/include/chart/customer_js')

<script type="text/javascript">

var showDashboardCount = 1;
function showDashboard(){
    loading();
    $('#dashboard-tab').show();
    $('#sell-tab').hide();

    $("#showDashboard").addClass("active");
    $("#showSell").removeClass("active");
    $('#loading').hide();

    if(showDashboardCount){
        showDashboardCount=0;

    }
}









var showSellCount=1;
function showSell(){
    loading();
    $('#dashboard-tab').hide();
    $('#sell-tab').show();
    $('#customer-tab').hide();

    $("#showDashboard").removeClass("active");
    $("#showSell").addClass("active");
    $("#showCustomer").removeClass("active");
    $('#loading').hide();

    if(showSellCount){
        showSellCount=0;
        axios.get('/owner/contents/{!!$content->id!!}/sell/sell')
        .then(function (response) {
            result = response.data;
            //console.log(result);
            var insert = '';
            $.each(result.data,function(index,customer){
                insert += '<tr>';
                insert += '<th scope="row text-info">'+customer['name']+'</th>';
                insert += '<td>'+customer['start_jp']+'~</td>';
                insert += '<td>&yen;'+customer['price_sum_cunm']+'</td>';
                insert += '<td>'+customer['status_jp']+'</td>';
                insert += '</tr>';
            });
            $('#sellList').append(insert);
            if(result.next_page_url){
                var more = '';
                more += '<button class="btn btn-outline-info" ';
                more += ' onclick="loading();';
                more += ' ajaxPaginationMoreSell(\'';
                more += result.next_page_url;
                more += '\');return false;" >';
                more += '<strong>もっと</strong>';
                more += '</button>';
                document.getElementById('more-sell').innerHTML = more;
            }else{
                document.getElementById('more-sell').innerHTML = '';
            }
        })
        .catch(function (error) {
            ajaxCheckError(error); return;
        });
    }
}

function ajaxPaginationMoreSell(url) {
    axios.get(url)
    .then(function (response) {
        result = response.data;
        //console.log(result);
        var insert = '';
        $.each(result.data,function(index,customer){
            insert += '<tr>';
            insert += '<th scope="row text-info">'+customer['name']+'</th>';
            insert += '<td>'+customer['start_jp']+'</td>';
            insert += '<td>&yen;'+customer['price_sum']+'</td>';
            insert += '<td>'+customer['status_jp']+'</td>';
            insert += '</tr>';
        });
        $('#sellList').append(insert);
        if(result.next_page_url){
            var more = '';
            more += '<button class="btn btn-outline-info" ';
            more += ' onclick="loading();';
            more += ' ajaxPaginationMoreSell(\'';
            more += result.next_page_url;
            more += '\');return false;" >';
            more += '<strong>もっと</strong>';
            more += '</button>';
            document.getElementById('more-sell').innerHTML = more;
        }else{
            document.getElementById('more-sell').innerHTML = '';
        }
        $('#loading').hide();
    })
    .catch(function (error) {
      $('#more-sell').remove();
      ajaxCheckError(error); return;
    });
}














$(document).ready(function () {
    
});
</script>

@stop
