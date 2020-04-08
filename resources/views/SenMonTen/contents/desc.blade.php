<?php
$tags = '';
//logger($content_tags);
if($content_tags){
    $key = 1;
    while(true){
        if($key > 60) break;
        $column = 'tag' . $key;
        if($content_tags->$column){
            $tags .= '<strong>' .UtilYoyaku::getNewContentTagIcon($GLOBALS['yoyaku_type_id'], $key, null). '<span class="text-blue-grey-800 f14 pr-2">' . UtilYoyaku::getNewContentTag($GLOBALS['yoyaku_type_key'], $key) . '</span></strong>';
            //logger('key_name: '.$GLOBALS['yoyaku_type_key']);
            //logger('key: '.$key);
            //logger('in: '.$column);
            //logger('tags: '.$tags);
        }else{
            //logger('out: '.$column);
        }
        $key++;
    }
}
?>
<div class="p-2 row" id="desc-tab">

    <div class="col-sm-12 mb-2">
        <div class="card">
            <div class="card-body p-0" style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_02.jpeg')">
                <div class="bg-mask-hard pb-10">
	                    <p class="h4 center"><strong>
                            <span class="introduce-title-circle-red" style="z-index:1 !important;">{!!$content->name!!}</span>
                        </strong></p>
                        
                        @if($tags)
                        <p class="center">
                          {!!$tags!!}
                        </p>
                        @endif

                        @if($content->shop_down===9)
                        <br />
                        <p class="h5 center"><strong>
                            現在、{!!$GLOBALS['yoyaku_type_name']!!}サービスを行っておりません。<br />
                            <span class="text-blue">確認: {!!date('Y/m/d', strtotime($content->updated_at))!!}</span>
                        </strong></p>
                        @elseif($owner->csv and $content->recommend_number===0)
                        <br />
                        <p class="h5 center"><strong>
                            ショップ情報未確認
                        </strong></p>
                        @endif
                        @if($content->description)
                        <br />
                        <p class="h6 center"><strong>
                            {!!nl2br($content->description)!!}
                        </strong></p>
                        @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 mb-2">
        <div class="card pb-4">
            <div class="card-body row center" id="searchRecommends">
              @include('include/recommend_more')
            </div>
            <p class="center">
              <button onClick="recommendExists('contents', {!!$content->id!!}, 1)" class="btn btn-outline-info">
                <strong>投稿</strong>
              </button>
              @if( $recommends->hasMorePages() and !empty($recommends) )
              <span id="pageMore">
              <button class="btn btn-outline-info" onclick="loading();ajaxPaginationMoreRecommend('{!!$recommends->nextPageUrl()!!}');return false;" >
                  <strong>もっと</strong>
              </button>
              </span>
              @endif
            </p>
        </div>
    </div>

    @if($owner->csv===1)
    <div id="" class="col-12 mb-2">
        <div class="card p-0 m-0">
            <div class="card-body p-0" style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_05.jpeg')">
                <div class="bg-mask-hard f14 p-10">
                    <p class="f14pb-2 center">
                        <span class="text-info"><strong>ご予約はこちらから</strong></span>
                    </p>
                    <p class="center">
                      <span class="text-success"><strong>{!!nl2br($content->tell)!!}</strong></span>
                    </p>
                    @forelse($stations as $station)
                    <?php
                    $minits_work = floor($station->station_distance/90);
                    if($minits_work<1) $minits_work = 1;
                    ?>
                    <p class="center">
                    <span class="text-blue-grey-500 "><strong>{!!$station->station_name.'駅('.$station->line_name.')'!!} {!!'徒歩'.$minits_work.'分'!!}{!!'('.$station->station_distance.'m)'!!}</strong></span>
                    </p>
                    @empty
                    <p class="center">
                    <span class="text-blue-grey-500 "><strong>最寄駅遠い。車がお勧め！</strong></span>
                    </p>
                    @endforelse
                    
                </div>
            </div>
        </div>
    </div>
                  
    @elseif( !($content->service===62 or $content->service===69 or $content->service===101 or $content->service===91) )
    <div class="col-sm-12 mb-2">
        <div class="card">
            <div class="card-body p-0" style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_05.jpeg')">
                <div class="bg-mask-hard p-10">

                <?php
                $week = ["sun", "mon", "tue", "wed", "thu", "fri", "sat"];
                $weekname_jp = ["sun"=>"日曜日", "mon"=>"月曜日", "tue"=>"火曜日", "wed"=>"水曜日", "thu"=>"木曜日", "fri"=>"金曜日", "sat"=>"土曜日", "New_Year_Holiday"=>"年末年始", "public_holiday"=>"祝日"];
                $days = date('Y-m-d');
                if(
                  strtotime($days) === strtotime(date("Y") . "/12/30") or
                  strtotime($days) === strtotime(date("Y") . "/12/31") or
                  strtotime($days) === strtotime(date("Y", strtotime('1 year')) . "/1/1") or
                  strtotime($days) === strtotime(date("Y", strtotime('1 year')) . "/1/2") or
                  strtotime($days) === strtotime(date("Y", strtotime('1 year')) . "/1/3")
                ){
                  $weekname = 'New_Year_Holiday';
                }elseif(HolidayDateTime::isHoliday(date("Y", strtotime($days)), date("m", strtotime($days)), date("d", strtotime($days)))){
                  $weekname = 'public_holiday';
                }else{
                  $datetime = new DateTime($days);
                  $weekname = $week[(int)$datetime->format('w')];
                }
                //($days . ' ' . $weekname);
                $colum_off = $weekname . '_off';
                $colum_start = $weekname . '_start';
                $colum_end = $weekname . '_end';
                $colum_start_junbi = $weekname . '_start_junbi';
                $colum_end_junbi = $weekname . '_end_junbi';
                $colum_end_nextday = $weekname . '_end_nextday';
                $cut = 3;
            
                $open_now = false;
                $DT_now = new DateTime(date('Y-m-d H:i:s'));
                $DT_start = new DateTime(date('Y-m-d') . ' ' . $content_calendar->$colum_start);
                if($colum_end_nextday){
                    $DT_end = new DateTime(date('Y-m-d', strtotime('+1 day')) . ' ' . $content_calendar->$colum_end);
                }else{
                    $DT_end = new DateTime(date('Y-m-d') . ' ' . $content_calendar->$colum_end);
                }
                if(!$content_calendar->$colum_off){
                    if($content_calendar->open_24){
                        $open_now = true;
                    }elseif($content_calendar->$colum_start_junbi){
                        $DT_start_junbi = new DateTime(date('Y-m-d') . ' ' . $content_calendar->$colum_start_junbi);
                        $DT_end_junbi = new DateTime(date('Y-m-d') . ' ' . $content_calendar->$colum_end_junbi);
                        if( 
                            ($DT_now >= $DT_start and $DT_now <= $DT_start_junbi) or
                            ($DT_now >= $DT_end_junbi and $DT_now <= $DT_end)
                        ){
                            $open_now = true;
                        }
                    }else{
                        //logger('in?');
                        //logger($DT_now->format('Y-m-d H:i:s'));
                        //logger($DT_start->format('Y-m-d H:i:s'));
                        //logger($DT_end->format('Y-m-d H:i:s'));
                        if( 
                            
                            ($DT_now >= $DT_start and $DT_now <= $DT_end)
                        ){
                            $open_now = true;
                        }
                    }
                }
                ?>
                <p class="h5 pb-2 center">
                    @if( $open_now )
                    {!!UtilYoyaku::getNewMenuSenMonTenIcon($content->service,'s-6')!!} <span class="text-success">営業中</span>
                    @else
                    {!!UtilYoyaku::getNewMenuSenMonTenIcon($content->service,'s-6')!!} <span class="text-warning">閉店中</span>
                    @endif
                </p>
                <p class="center f14">
                  <span class="pr-2">本日：{!!date('m月d日')!!} ({!!$weekname_jp[$weekname]!!})</span>
                  @if($content_calendar->$colum_off)
                  <span class="text-warning">お休み</span>
                  @elseif($content_calendar->open_24)
                  <span class="text-warning">24時間営業</span>
                  @elseif($content_calendar->$colum_start_junbi)
                  <span>
                    営業時間
                    <?php $str = $content_calendar->$colum_start; ?>
                    {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                    <?php $str = $content_calendar->$colum_start_junbi; ?>
                    {{ substr( $str , 0 , strlen($str)-$cut ) }}
                    <?php $str = $content_calendar->$colum_end_junbi; ?>
                    {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                    <?php $str = $content_calendar->$colum_end; ?>
                    @if($content_calendar->$colum_end_nextday)
                    (翌日)
                    @endif
                    {{ substr( $str , 0 , strlen($str)-$cut ) }}
                  </span>
                  @else
                  <span>
                    営業時間
                    <?php $str = $content_calendar->$colum_start; ?>
                    {{ substr( $str , 0 , strlen($str)-$cut ) }} - 
                    <?php $str = $content_calendar->$colum_end; ?>
                    @if($content_calendar->$colum_end_nextday)
                    (翌日)
                    @endif
                    {{ substr( $str , 0 , strlen($str)-$cut ) }}
                  </span>
                  @endif
                </p>

                <p class="center f14 text-blue-900"><strong>TEL: @if($content->tell){!!$content->tell!!}@else{!!'未登録'!!}@endif</strong></p>
                
                @forelse($stations as $station)
                <?php
                $minits_work = floor($station->station_distance/90);
                if($minits_work<1) $minits_work = 1;
                ?>
                <p class="center">
                <span class="text-blue-grey-500 "><strong>{!!$station->station_name.'駅('.$station->line_name.')'!!} {!!'徒歩'.$minits_work.'分'!!}{!!'('.$station->station_distance.'m)'!!}</strong></span>
                </p>
                @empty
                <p class="center">
                <span class="text-blue-grey-500 "><strong>最寄駅遠い。車がお勧め！</strong></span>
                </p>
                @endforelse

                </div>
            </div>
        </div>
    </div>
    @endif


    <div class="col-sm-12 mb-2">
        <div class="card">
            <div class="card-body row pt-6 pb-1">
            
                <div class="col-sm-4 px-2 border-bottom">
                    <div class="row">
                        <div class="col-12 pb-4">
                            <p class="h5 center">
                                <span class="introduce-title-modan-red"><strong>
                                @if($content->service===91)
                                面接会場
                                @else
                                所在地
                                @endif
                                </strong></span>
                            </p>
                        </div>
  
                        <div class="col-sm-6 center">
                            <img src="{!!Util::getPic('place', null, $place_owner->pic, $content->id, 250, null)!!}" style="max-width:150px;max-height:150px;">
                        </div>
                        <div class="col-sm-6 pt-2 center">
                            <p class="text-success">{!!$place_owner->name!!}</p>
                            <p>{!!$content->address!!}</p>
                            <p>{!!mb_strimwidth($place_owner->description, 0, 200, "...")!!}</p>
                            <p><a class="text-blue-500" href="https://maps.google.com/maps?q={!!$content->address!!}" target="_blank" >マップ</a></p>
                        </div>
                    </div>
                </div>

                @if($owner->csv===1)
                <div class="col-sm-6 pt-sm border-bottom pb-4">
                    <p class="h5 center">
                        <span class="introduce-title-modan-red"><strong>
                        運営
                        </strong></span>
                    </p>
                    <p class="center pt-6">
                        <span class="text-info">会社: </span>
                        <span>{!!$content->name !!}</span>
                        <br />
                        <br />
                        <span class="text-info">ご予約: </span>
                        <span>{!!$content->tell!!}</span>
                        <br />
                        <br />
                        <span class="text-info">所在地: </span>
                            {!!$content->country_area_address_other!!}
                        </span>
                        <br />
                        <br />
                        <span class="text-info">ホームページ: </span>
                            <a class="text-blue-500" href="{!!$content->homepage!!}" target="_blank" >{!!$content->homepage!!}</a>
                        </span>

                    </p>
                </div>


                @else
                <div class="col-sm-4 pt-sm border-bottom pb-4">
                    @if( !($content->service===91) )
                    <p class="h5 center">
                        <span class="introduce-title-modan-red"><strong>
                        タイプ
                        </strong></span>
                    </p>

                    <p class="h6 center pt-4">
                        <span class="text-info"><strong>
                        ご予約時間
                        </strong></span>
                    </p>
                    <p class="center">
                        利用時間の{!!Util::ToMin($content->last_time_yoyaku)!!}分前まで予約をお願いします。<br />
                        最終受付は閉店{!!Util::ToMin($content->last_time_order)!!}分前となります。
                    </p>
                    @else
                    <p class="h5 center">
                        <span class="introduce-title-modan-red"><strong>
                        募集職種
                        </strong></span>
                    </p>
                    <div class="p-4">
                    <ul>
                    @foreach(Util::getRecruitType('summary', null, null) as $summary_key=>$summary_name)
                      <?php $count = true; ?>
                      @foreach(Util::getRecruitType('desc', $summary_key, null) as $desc_key=>$desc_name)
                        <?php $column = 'type' . $desc_key; ?>
                        @if($content_recruit_types->$column)
                          @if($count)
                          <?php $count = false; ?>
                          <li class="f14">{!!$summary_name!!}</li>
                          <ul>
                          @endif
                          <li>{!!$desc_name!!}</li>
                        @endif
                      @endforeach
                      @if(!$count)
                      </ul>
                      @endif
                    @endforeach
                    </ul>
                    </div>
                    @endif
                </div>

                <div class="col-sm-4 pt-sm border-bottom pb-4">
                    <p class="h5 center">
                        <span class="introduce-title-modan-red"><strong>
                        運営
                        </strong></span>
                    </p>
                    <p class="center pt-6">
                        <span class="text-info">会社: </span>
                        <span>{!!$company->name !!}</span>
                        <br />
                        <br />
                        <span class="text-info">問い合わせ: </span>
                        <span>{!!$company->tell!!}</span>
                        <br />
                        <br />
                        <span class="text-info">所在地: </span>
                        <span>{!!Util::getCountryAreaName($company->country_area_id)!!}
                            {!!Util::getCountryAreaOneName($company->country_area_address_one)!!}
                            {!!Util::getCountryAreaTwoName($company->country_area_address_two)!!}
                            {!!$company->country_area_address_other!!}
                        </span>
                        <br />
                        <br />
                        <span class="text-info">ホームページ: </span>
                        <span><a class="text-blue-300" href="{!!$company->homepage!!}">{!!$company->homepage!!}</a></span>
                    </p>
                </div>
                @endif
                
            </div>
        </div>
    </div>



    @if($content['steps'])
    <div class="col-sm-12 mb-2">
        <div class="card">
            <div class="card-body row">
                <?php $rightLeft = true; ?>
                @foreach($content['steps'] as $step)
                @if($step->pic)
                    @if($rightLeft)
                    <?php $rightLeft = false; ?>
                    <div class="col-sm-6 pb-8 mb-2">
                        <img src="/storage/uploads/contents/{!!$content->id!!}/step/{!!$step->id!!}/{!!Util::addFilename($step->pic,'1600')!!}" width="100%" style="max-width:1600px;" />
                    </div>
                    <div class="col-sm-6 pb-8 mb-2">
		                <p class="h4 center"><strong>
                          <span class="introduce-title-circle-green" style="z-index:1 !important;">{!!$step->title!!}</span>
                        </strong></p>

                        <p class="h6 center"><strong>
                          <span>{!!nl2br($step->description)!!}</span>
                        </strong></p>
                    </div>
                    @else
                    <?php $rightLeft = true; ?>
                    <div class="col-sm-6 pb-8 mb-2">
		                <p class="h4 center"><strong>
                          <span class="introduce-title-circle-green" style="z-index:1 !important;">{!!$step->title!!}</span>
                        </strong></p>
        
                        <p class="h6 center"><strong>
                          <span>{!!nl2br($step->description)!!}</span>
                        </strong></p>
                    </div>
                    <div class="col-sm-6 pb-8 mb-2">
                        <img src="/storage/uploads/contents/{!!$content->id!!}/step/{!!$step->id!!}/{!!Util::addFilename($step->pic,'1600')!!}" width="100%" style="max-width:1600px;" />
                    </div>
                    @endif
                @else
                    <div class="col-xl-12 pb-8 mb-2">
		                <p class="h3 center"><strong>
                          <span class="introduce-title-circle-green" style="z-index:1 !important;">{!!$step->title!!}</span>
                        </strong></p>
        
                        <br /><br /><br />
        
                        <p class="h5 center"><strong>
                          <span>{!!nl2br($step->description)!!}</span>
                        </strong></p>
                    </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif


    @if($owner->csv===1)
    <div class="col-sm-6 mb-2">
        <div class="card pt-4">
            <div class="card-body">
                <p class="h5 center">
                    <span class="introduce-title-stripe"><strong>
                    営業カレンダー
                    </strong></span>
                </p>
                <p class="center pt-4">
                  未登録
                </p>
            </div>
        </div>
    </div>


    @elseif( !($content->service===62 or $content->service===69 or $content->service===101 or $content->service===91) )

        @include('SenMonTen/contents/include/open_shejule')

    @endif






<style>
.c-title{
    font-weight: 500 !important;
    font-size: 20px !important;
}
.c-subtitle{
    font-weight: 500 !important;
    font-size: 16px !important;
}
</style>


@if($owner->csv===1)

@elseif($content->service===39 or $content->service===85 or $content->service===89)
<div class="col-sm-6 mb-2">
    <div class="card pt-4">  
        <p class="h5 center">
                <span class="introduce-title-stripe"><strong>
                割引率
                </strong></span>
        </p>
        <div class="p-4 center">
            @if($content_cancel_calendar->hour1) <p> 1時間以上のご利用： {!! 100 - $content_cancel_calendar->hour1 !!}% OFF </p> @endif
            @if($content_cancel_calendar->hour1) <p> 2時間以上のご利用： {!! 100 - $content_cancel_calendar->hour2 !!}% OFF </p> @endif
            @if($content_cancel_calendar->hour1) <p> 3時間以上のご利用： {!! 100 - $content_cancel_calendar->hour3 !!}% OFF </p> @endif
            @if($content_cancel_calendar->hour1) <p> 4時間以上のご利用： {!! 100 - $content_cancel_calendar->hour4 !!}% OFF </p> @endif
            @if($content_cancel_calendar->hour1) <p> 5時間以上のご利用： {!! 100 - $content_cancel_calendar->hour5 !!}% OFF </p> @endif
            @if($content_cancel_calendar->hour1) <p> 6時間以上のご利用： {!! 100 - $content_cancel_calendar->hour6 !!}% OFF </p> @endif
            @if($content_cancel_calendar->hour1) <p> 7時間以上のご利用： {!! 100 - $content_cancel_calendar->hour7 !!}% OFF </p> @endif
            @if($content_cancel_calendar->hour1) <p> 8時間以上のご利用： {!! 100 - $content_cancel_calendar->hour8 !!}% OFF </p> @endif
            @if($content_cancel_calendar->hour1) <p> 9時間以上のご利用： {!! 100 - $content_cancel_calendar->hour9 !!}% OFF </p> @endif
            @if($content_cancel_calendar->hour1) <p> 10時間以上のご利用：{!! 100 - $content_cancel_calendar->hour10 !!}% OFF</p> @endif
            @if($content_cancel_calendar->hour1) <p> 11時間以上のご利用：{!! 100 - $content_cancel_calendar->hour11 !!}% OFF</p> @endif
            @if($content_cancel_calendar->hour1) <p> 12時間以上のご利用：{!! 100 - $content_cancel_calendar->hour12 !!}% OFF</p> @endif
            @if($content_cancel_calendar->day2)  <p> 1日以上のご利用：   {!! 100 - $content_cancel_calendar->day2 !!}% OFF  </p> @endif
            @if($content_cancel_calendar->day3)  <p> 2日以上のご利用：   {!! 100 - $content_cancel_calendar->day3 !!}% OFF  </p> @endif
        </div>
    </div>
</div>
@endif






























@if($owner->csv===1)
<div class="col-sm-6 mb-2">
        <div class="card">
            <div class="card-body">
                <p class="h5 center">
                    <span class="introduce-title-stripe"><strong>
                    キャンセル料
                    </strong></span>
                </p>
                <p class="center pt-4">
                  未登録
                </p>
            </div>
        </div>
    </div>

@elseif( !($content->service===91) )
<div class="col-sm-6 mb-2">
<div class="card pt-4">  
    <p class="h5 center">
        <span class="introduce-title-stripe"><strong>
        キャンセル料
        </strong></span>
    </p>
    <div class="p-4 center">
        @if($content_cancel_calendar->today) <p>当日  {!!$content_cancel_calendar->today !!}%</p> @endif
        @if($content_cancel_calendar->day1 ) <p>前日  {!!$content_cancel_calendar->day1 !!}%</p> @endif
        @if($content_cancel_calendar->day2 ) <p>2日前 {!!$content_cancel_calendar->day2 !!}%</p> @endif
        @if($content_cancel_calendar->day3 ) <p>3日前 {!!$content_cancel_calendar->day3 !!}%</p> @endif
        @if($content_cancel_calendar->day4 ) <p>4日前 {!!$content_cancel_calendar->day4 !!}%</p> @endif
        @if($content_cancel_calendar->day5 ) <p>5日前 {!!$content_cancel_calendar->day5 !!}%</p> @endif
        @if($content_cancel_calendar->day6 ) <p>6日前 {!!$content_cancel_calendar->day6 !!}%</p> @endif
        @if($content_cancel_calendar->day7 ) <p>7日前 {!!$content_cancel_calendar->day7 !!}%</p> @endif
        @if($content_cancel_calendar->day8 ) <p>8日前 {!!$content_cancel_calendar->day8 !!}%</p> @endif
        @if($content_cancel_calendar->day9 ) <p>9日前 {!!$content_cancel_calendar->day9 !!}%</p> @endif
        @if($content_cancel_calendar->day10) <p>1日前 {!!$content_cancel_calendar->day10 !!}%</p> @endif
        @if($content_cancel_calendar->day11) <p>11日前 {!!$content_cancel_calendar->day11 !!}%</p> @endif
        @if($content_cancel_calendar->day12) <p>12日前 {!!$content_cancel_calendar->day12 !!}%</p> @endif
        @if($content_cancel_calendar->day13) <p>13日前 {!!$content_cancel_calendar->day13 !!}%</p> @endif
        @if($content_cancel_calendar->day14) <p>14日前 {!!$content_cancel_calendar->day14 !!}%</p> @endif
        @if($content_cancel_calendar->day15) <p>15日前 {!!$content_cancel_calendar->day15 !!}%</p> @endif

    </div>
</div>
</div>
@endif






</div>

