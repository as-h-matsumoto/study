@extends('owner/layouts/default')
<?php $cut = 3; ?>

{{-- Page title --}}
@section('title') 会社カレンダー @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')
<div id="profile" class="page-layout simple right-sidebar">

    <div class="page-content-wrapper">

        @include('owner/include/header')
    
        <div class="page-content center">
        <div class="card my-2"
        style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_02.jpeg')">
        <div class="card-body p-0 bg-mask-hard" style="max-width:400px; ">

<table class="table table-hover">
    <thead class="text-auto">
        <tr>
            <th class="text-info text-center" style="width:33%;"><strong>項目</strong></th>
            <th class="text-info text-center" style="width:33%;"><strong>午前営業時間</strong></th>
            <th class="text-info text-center" style="width:33%;"><strong>午後営業時間</strong></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th class="text-center" scope="row">年中無休</th>
            <td colspan="2" class="cen">@if($company_calendar->non_off) はい @else いいえ @endif</td>
        </tr>
        <tr>
            <th class="text-center" scope="row">２４時間営業</th>
            <td colspan="2">@if($company_calendar->open_24) はい @else いいえ @endif</td>
        </tr>
        <tr>
            <th class="text-center" scope="row">月曜日</th>
            @if($company_calendar->mon_off)
            <td colspan="2">お休み</td>
            @elseif($company_calendar->mon_start_junbi)
            <td>
                <?php $str = $company_calendar->mon_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->mon_start_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            <td>
                <?php $str = $company_calendar->mon_end_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->mon_end; ?>
                @if($company_calendar->mon_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            @else
            <td colspan="2">
                <?php $str = $company_calendar->mon_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->mon_end; ?>
                @if($company_calendar->mon_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            @endif
        </tr>
        <tr>
            <th class="text-center" scope="row">火曜日</th>
            @if($company_calendar->tue_off)
            <td colspan="2">お休み</td>
            @elseif($company_calendar->tue_start_junbi)
            <td>
                <?php $str = $company_calendar->tue_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->tue_start_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            <td>
                <?php $str = $company_calendar->tue_end_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->tue_end; ?>
                @if($company_calendar->tue_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            @else
            <td colspan="2">
                <?php $str = $company_calendar->tue_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->tue_end; ?>
                @if($company_calendar->tue_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            @endif
        </tr>
        <tr>
            <th class="text-center" scope="row">水曜日</th>
            @if($company_calendar->wed_off)
            <td colspan="2">お休み</td>
            @elseif($company_calendar->wed_start_junbi)
            <td>
                <?php $str = $company_calendar->wed_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->wed_start_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            <td>
                <?php $str = $company_calendar->wed_end_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->wed_end; ?>
                @if($company_calendar->wed_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            @else
            <td colspan="2">
                <?php $str = $company_calendar->wed_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->wed_end; ?>
                @if($company_calendar->wed_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            @endif
        </tr>
        <tr>
            <th class="text-center" scope="row">木曜日</th>
            @if($company_calendar->thu_off)
            <td colspan="2">お休み</td>
            @elseif($company_calendar->thu_start_junbi)
            <td>
                <?php $str = $company_calendar->thu_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->thu_start_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            <td>
                <?php $str = $company_calendar->thu_end_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->thu_end; ?>
                @if($company_calendar->thu_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            @else
            <td colspan="2">
                <?php $str = $company_calendar->thu_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->thu_end; ?>
                @if($company_calendar->thu_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            @endif
        </tr>
        <tr>
            <th class="text-center" scope="row">金曜日</th>
            @if($company_calendar->fri_off)
            <td colspan="2">お休み</td>
            @elseif($company_calendar->fri_start_junbi)
            <td>
                <?php $str = $company_calendar->fri_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->fri_start_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            <td>
                <?php $str = $company_calendar->fri_end_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->fri_end; ?>
                @if($company_calendar->fri_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            @else
            <td colspan="2">
                <?php $str = $company_calendar->fri_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->fri_end; ?>
                @if($company_calendar->fri_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            @endif
        </tr>
        <tr>
            <th class="text-center" scope="row">土曜日</th>
            @if($company_calendar->sat_off)
            <td colspan="2">お休み</td>
            @elseif($company_calendar->sat_start_junbi)
            <td>
                <?php $str = $company_calendar->sat_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->sat_start_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            <td>
                <?php $str = $company_calendar->sat_end_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->sat_end; ?>
                @if($company_calendar->sat_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            @else
            <td colspan="2">
                <?php $str = $company_calendar->sat_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->sat_end; ?>
                @if($company_calendar->sat_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            @endif
        </tr>
        <tr>
            <th class="text-center" scope="row">日曜日</th>
            @if($company_calendar->sun_off)
            <td colspan="2">お休み</td>
            @elseif($company_calendar->sun_start_junbi)
            <td>
                <?php $str = $company_calendar->sun_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->sun_start_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            <td>
                <?php $str = $company_calendar->sun_end_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->sun_end; ?>
                @if($company_calendar->sun_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            @else
            <td colspan="2">
                <?php $str = $company_calendar->sun_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->sun_end; ?>
                @if($company_calendar->sun_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            @endif
        </tr>
        <tr>
            <th class="text-center" scope="row">祝日</th>
            @if($company_calendar->public_holiday_off)
            <td colspan="2">お休み</td>
            @elseif($company_calendar->public_holiday_start_junbi)
            <td>
                <?php $str = $company_calendar->public_holiday_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->public_holiday_start_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            <td>
                <?php $str = $company_calendar->public_holiday_end_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->public_holiday_end; ?>
                @if($company_calendar->public_holiday_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            @else
            <td colspan="2">
                <?php $str = $company_calendar->public_holiday_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->public_holiday_end; ?>
                @if($company_calendar->public_holiday_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            @endif
        </tr>
        <tr>
            <th class="text-center" scope="row">年末年始（１２・３０－１・３）</th>
            @if($company_calendar->New_Year_Holiday_off)
            <td colspan="2">お休み</td>
            @elseif($company_calendar->New_Year_Holiday_start_junbi)
            <td>
                <?php $str = $company_calendar->New_Year_Holiday_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->New_Year_Holiday_start_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            <td>
                <?php $str = $company_calendar->New_Year_Holiday_end_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->New_Year_Holiday_end; ?>
                @if($company_calendar->New_Year_Holiday_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            @else
            <td colspan="2">
                <?php $str = $company_calendar->New_Year_Holiday_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $company_calendar->New_Year_Holiday_end; ?>
                @if($company_calendar->New_Year_Holiday_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
            </td>
            @endif
        </tr>
    </tbody>
</table>
        </div>
        </div>
        </div>


        <div class="page-content-footer">
            <p class="right">
                <a href="/owner/calendar/edit" >
                    <button class="btn btn-outline-info"><strong>編集</strong></button>
                </a>
            </p>
        </div>
        @include('owner/include/footer')
        @include('include/footer')

    </div>
</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')
@stop
