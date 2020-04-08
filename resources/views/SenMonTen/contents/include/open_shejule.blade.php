<div class="col-sm-6 mb-2">
        <div class="card pt-4">
            <p class="h5 center">
                <span class="introduce-title-stripe"><strong>
                営業カレンダー
                </strong></span>
            </p>
            <div class="p-4 center">
                @if($content_calendar->non_off or $content_calendar->open_24)
                <p>@if($content_calendar->non_off) 年中無休 @endif  @if($content_calendar->open_24) ２４時間営業 @endif</p>
                @endif

                @if( !($content_calendar->non_off and $content_calendar->open_24) )

                <p>月曜日　
                @if($content_calendar->mon_off)
                お休み

                @elseif($content_calendar->mon_start_junbi)
                午前:
                <?php $str = $content_calendar->mon_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->mon_start_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                <span class="px-2">|</span>
                午後:　
                <?php $str = $content_calendar->mon_end_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->mon_end; ?>
                @if($content_calendar->mon_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                
                @else
                <?php $str = $content_calendar->mon_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->mon_end; ?>
                @if($content_calendar->mon_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                @endif
                </p>
                

                <p>火曜日　
                @if($content_calendar->tue_off)
                お休み

                @elseif($content_calendar->tue_start_junbi)
                午前:
                <?php $str = $content_calendar->tue_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->tue_start_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                <span class="px-2">|</span>
                午後:　
                <?php $str = $content_calendar->tue_end_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->tue_end; ?>
                @if($content_calendar->tue_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                
                @else
                <?php $str = $content_calendar->tue_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->tue_end; ?>
                @if($content_calendar->tue_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                @endif
                </p>

                <p>水曜日　
                @if($content_calendar->wed_off)
                お休み

                @elseif($content_calendar->wed_start_junbi)
                午前:
                <?php $str = $content_calendar->wed_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->wed_start_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                <span class="px-2">|</span>
                午後:　
                <?php $str = $content_calendar->wed_end_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->wed_end; ?>
                @if($content_calendar->wed_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                
                @else
                <?php $str = $content_calendar->wed_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->wed_end; ?>
                @if($content_calendar->wed_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                @endif
                </p>

                <p>木曜日　
                @if($content_calendar->thu_off)
                お休み

                @elseif($content_calendar->thu_start_junbi)
                午前:
                <?php $str = $content_calendar->thu_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->thu_start_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                <span class="px-2">|</span>
                午後:　
                <?php $str = $content_calendar->thu_end_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->thu_end; ?>
                @if($content_calendar->thu_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                
                @else
                <?php $str = $content_calendar->thu_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->thu_end; ?>
                @if($content_calendar->thu_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                @endif
                </p>


                <p>金曜日　
                @if($content_calendar->fri_off)
                お休み

                @elseif($content_calendar->fri_start_junbi)
                午前:
                <?php $str = $content_calendar->fri_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->fri_start_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                <span class="px-2">|</span>
                午後:　
                <?php $str = $content_calendar->fri_end_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->fri_end; ?>
                @if($content_calendar->fri_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                
                @else
                <?php $str = $content_calendar->fri_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->fri_end; ?>
                @if($content_calendar->fri_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                @endif
                </p>

                <p>土曜日　
                @if($content_calendar->sat_off)
                お休み

                @elseif($content_calendar->sat_start_junbi)
                午前:
                <?php $str = $content_calendar->sat_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->sat_start_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                <span class="px-2">|</span>
                午後:　
                <?php $str = $content_calendar->sat_end_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->sat_end; ?>
                @if($content_calendar->sat_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                
                @else
                <?php $str = $content_calendar->sat_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->sat_end; ?>
                @if($content_calendar->sat_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                @endif
                </p>


                <p>日曜日　
                @if($content_calendar->sun_off)
                お休み

                @elseif($content_calendar->sun_start_junbi)
                午前:
                <?php $str = $content_calendar->sun_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->sun_start_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                <span class="px-2">|</span>
                午後:　
                <?php $str = $content_calendar->sun_end_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->sun_end; ?>
                @if($content_calendar->sun_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                
                @else
                <?php $str = $content_calendar->sun_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->sun_end; ?>
                @if($content_calendar->sun_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                @endif
                </p>



                <p>祝日　
                @if($content_calendar->New_Year_Holiday_off)
                お休み

                @elseif($content_calendar->New_Year_Holiday_start_junbi)
                午前:
                <?php $str = $content_calendar->New_Year_Holiday_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->New_Year_Holiday_start_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                <span class="px-2">|</span>
                午後:　
                <?php $str = $content_calendar->New_Year_Holiday_end_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->New_Year_Holiday_end; ?>
                @if($content_calendar->New_Year_Holiday_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                
                @else
                <?php $str = $content_calendar->New_Year_Holiday_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->New_Year_Holiday_end; ?>
                @if($content_calendar->New_Year_Holiday_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                @endif
                </p>



                <p>年末年始
                @if($content_calendar->New_Year_Holiday_off)
                お休み

                @elseif($content_calendar->New_Year_Holiday_start_junbi)
                午前:
                <?php $str = $content_calendar->New_Year_Holiday_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->New_Year_Holiday_start_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                <span class="px-2">|</span>
                午後:　
                <?php $str = $content_calendar->New_Year_Holiday_end_junbi; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->New_Year_Holiday_end; ?>
                @if($content_calendar->New_Year_Holiday_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                
                @else
                <?php $str = $content_calendar->New_Year_Holiday_start; ?>
                {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                <?php $str = $content_calendar->New_Year_Holiday_end; ?>
                @if($content_calendar->New_Year_Holiday_end_nextday)
                (翌日)
                @endif
                {{ substr( $str , 0 , strlen($str)-$cut ) }}
                @endif
                </p>

                @endif

            </div>
        </div>
    </div>
