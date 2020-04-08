<div class="card p-2">
  <div class="card-body">
    <?php
      //$sta = UtilLicense::getLicenseScheduleStatistics();
      $summary = UtilLicense::getLicenseScheduleStatisticsSummary();
      $person = UtilLicense::getLicenseScheduleStatisticsPerson();
      $area = UtilLicense::getLicenseScheduleStatisticsArea();
      $work = UtilLicense::getLicenseScheduleStatisticsWork();
      $subject = UtilLicense::getLicenseScheduleStatisticsSubject();
      $th = '';
      $td = '';
    ?>
    @foreach($license_schedule_statistics as $statistics)
    <div class="card p-2 border-bottom mb-2">
      <div class="card-body">
      <p class="display-3">{!!$statistics->license_year.'年度'!!} {!!$statistics->license_phase.'次試験'!!}
      <br />受験者数・合格統計値</p>

      <?php
      $th = '';
      $td = '';
      foreach($summary as $key=>$val){
        $th .= '<th>'.$val.'</th>';
        if($statistics->$key){
          $tdv = $statistics->$key;
        }else{
          $tdv = '-';
        }
        $td .= '<td>'.$tdv.'</td>';
      }
      $th .= '<th>合格率</th>';
      $td .= '<td>'.round($statistics->passing_number/$statistics->number_of_applicants*100,1).'%</td>';
      ?>
      <br /><br />
      <p class="display-4">要約</p>
      <table class="a">
        <thead>
         <tr>
          {!!$th!!}
         </tr>
        <thead>
        <tbody>
          {!!$td!!}
        </tbody>
      </table>


      <?php
      $line = [];
      $sta_save = [];
      foreach($person as $key=>$val){
        if(strpos($key, 'pass_')!==false){
          $k = $key;
          $line_key = str_replace('pass_', '', $key);
          $line[$line_key] .= '<td>'.$statistics->$k.'</td>';
          if(!$sta_save[$line_key] or !$statistics->$k){
            $ana = 0;
          }else{
            $ana = round($statistics->$k/$sta_save[$line_key]*100,1);
          }
          $line[$line_key] .= '<td>'.$ana.'</td>';
        }else{
          $line[$key] = '<th>'.$val.'</th>' . '<td>'.$statistics->$key.'</td>';
          $sta_save[$key] = $statistics->$key;
        }
      }
      ?>
      <br /><br />
      <p class="display-4">性別、年齢別</p>
      <table class="a">
        <thead>
          <tr>
            <th>タイプ</th><th>申込者数</th><th>合格者数</th><th>合格率</th>
          </tr>
        <thead>
        <tbody>
          @foreach($line as $l)
          <tr>{!!$l!!}</tr>
          @endforeach
        </tbody>
      </table>


      <?php
      $line = [];
      $sta_save = [];
      foreach($area as $key=>$val){
        if(strpos($key, 'pass_')!==false){
          $k = $key;
          $line_key = str_replace('pass_', '', $key);
          $line[$line_key] .= '<td>'.$statistics->$k.'</td>';
          if(!$sta_save[$line_key] or !$statistics->$k){
            $ana = 0;
          }else{
            $ana = round($statistics->$k/$sta_save[$line_key]*100,1);
          }
          $line[$line_key] .= '<td>'.$ana.'</td>';
        }else{
          $line[$key] = '<th>'.$val.'</th>' . '<td>'.$statistics->$key.'</td>';
          $sta_save[$key] = $statistics->$key;
        }
      }
      ?>
      <br /><br />
      <p class="display-4">受験エリア別</p>
      <table class="a">
        <thead>
          <tr>
            <th>タイプ</th><th>申込者数</th><th>合格者数</th><th>合格率</th>
          </tr>
        <thead>
        <tbody>
          @foreach($line as $l)
          <tr>{!!$l!!}</tr>
          @endforeach
        </tbody>
      </table>


      <?php
      $line = [];
      $sta_save = [];
      foreach($work as $key=>$val){
        if(strpos($key, 'pass_')!==false){
          $k = $key;
          $line_key = str_replace('pass_', '', $key);
          $line[$line_key] .= '<td>'.$statistics->$k.'</td>';
          if(!$sta_save[$line_key] or !$statistics->$k){
            $ana = 0;
          }else{
            $ana = round($statistics->$k/$sta_save[$line_key]*100,1);
          }
          $line[$line_key] .= '<td>'.$ana.'</td>';
        }else{
          $line[$key] = '<th>'.$val.'</th>' . '<td>'.$statistics->$key.'</td>';
          $sta_save[$key] = $statistics->$key;
        }
      }
      ?>
      <br /><br />
      <p class="display-4">職種別</p>
      <table class="a">
        <thead>
          <tr>
            <th>タイプ</th><th>申込者数</th><th>合格者数</th><th>合格率</th>
          </tr>
        <thead>
        <tbody>
          @foreach($line as $l)
          <tr>{!!$l!!}</tr>
          @endforeach
        </tbody>
      </table>


      @if($statistics->license_phase===1)
      <?php
      $line = [];
      $sta_save = [];
      foreach($subject as $key=>$val){
        if(strpos($key, 'pass_')!==false){
          
          $k = $key;
          $line_key = str_replace('pass_', '', $key);
          if(isset($line[$line_key])){
            if(isset($statistics->$k)){
              $staKe = $statistics->$k;
            }else{
              $staKe = '-';
            }
            $line[$line_key] .= '<td>'.$staKe.'</td>';
            if(!$sta_save[$line_key] or !$staKe){
              $ana = 0;
            }else{
              $ana = round($statistics->$k/$sta_save[$line_key]*100,1);
            }
            $line[$line_key] .= '<td>'.$ana.'</td>';
          }
        }else{
          $line[$key] = '<th>'.$val.'</th>' . '<td>'.$statistics->$key.'</td>';
          $sta_save[$key] = $statistics->$key;
        }
      }
      ?>
      <br /><br />
      <p class="display-4">科目別</p>
      <table class="a">
        <thead>
          <tr>
            <th>タイプ</th><th>申込者数</th><th>合格者数</th><th>合格率</th>
          </tr>
        <thead>
        <tbody>
          @foreach($line as $l)
          <tr>{!!$l!!}</tr>
          @endforeach
        </tbody>
      </table>
      @endif
      </div>
    </div>
    @endforeach
  </div>
</div>