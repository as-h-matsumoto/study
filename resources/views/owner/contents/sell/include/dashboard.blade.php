<div class="row px-3" id="dashboard-tab" >

            <div class="col-12 col-sm-4 col-xl-4 p-3">
                <div class="card">
                    <div class="py-2 pl-4 row">
                        <div class="col">
                            <span class="h6">総売上げ(サービス提供済み)</span>
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
                            <span class="h6">顧客数</span>
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
                            <span class="h6">次回入金額({!!$content->name!!}分)</span>
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