@extends('account/layouts/default')

{{-- Page title --}}
@section('title') {!!$license->name!!} 資格学習 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')

@include('include/question_css')

@stop

{{-- content --}}
@section('content')

<div id="profile" class="page-layout simple right-sidebar">

  <div class="page-content-wrapper">

  @include('license/include/header')
    
  <div class="page-content mb-2">

    <div class="card p-2 center">
      <div class="card-title"><a href="/license/{!!$license->id!!}/getLicensestudyArea">出題科目学習</a></div>
      <div class="card-body">
        <p>出題内容から学習していきます。一般的な学習方法です。</p>
      </div>
    </div>

    <div class="card p-2 center">
      <div class="card-title"><a href="/license/{!!$license->id!!}/question/1/">過去問学習</a></div>
      <div class="card-body">
        <p>過去問から学習していきます。</p>
      </div>
    </div>

    <div class="card p-2 center">
      <div class="card-title"><a href="/license/{!!$license->id!!}/getLicenseMustReadList">一読リスト</a></div>
      <div class="card-body">
        <p>
          企業診断士は常に社会の動向をつかみその動向によって最適な経営改善を立案しなければいけません。<br />
          そのため、試験では内閣府が公開している資料の中から出題されるパターンが多々あります。<br />
          ここにリスト化してある白書は、試験に出題される傾向にあるものです。企業経営にも役立つ資料なので一読しておきましょう。
        </p>
      </div>
    </div>

    <div class="card p-2 center">
      <div class="card-title"><a href="/license/{!!$license->id!!}/getLicenseHotWords">ホットワード</a></div>
      <div class="card-body">
        <p>
          毎年、その年の話題となったワードが出題される光景にあります。<br />
          このホットワードには、それらのキーワードをできる限り掲載したいと思っています。
        </p>
      </div>
    </div>

    <div class="card p-2 center">
      <div class="card-title">
        <a href="/license/{!!$license->id!!}/getLicenseStatistics">中小企業診断士 統計</a>
      </div>
      <div class="card-body">
        <p class="">2009年度 から 2018年度 までの平均合格率や、年度別の試験合格率、一次試験合格率、二次試験合格率などをまとめています。</p>
        <table class="a">
          <thead>
           <tr>
            <th>平均申込者数</th><th>平均試験合格者数</th><th>平均合格率</th>
           </tr>
          </thead><thead>
          </thead><tbody>
            <tr><td>20030</td><td>950</td><td>4.7%</td>
          </tr></tbody>
        </table>
      </div>
    </div>

    <div class="card p-2 center">
      <div class="card-title">
        <span></span>
        <span><a href="/license/{!!$license->id!!}/getLicenseTest">試験日程</a></span>
      </div>
      <div class="card-body">
        <p class="">2019年度 1次試験 8月4日（土）・5（日）<span id="phase1"></span></p>
        <p class="">2019年度 2次試験 10月21日（日）<span id="phase2"></span></p>
        <p class="">2020年度 1次試験 7月中旬の土曜日・日曜日の2日間 <span id="phase1next"></span></p>
      </div>
    </div>
    
    <div class="card p-2 center">
      <div class="card-title">
        <span><a href="/license/{!!$license->id!!}/getLicenseSchedule">学習スケジュール</a></span>
      </div>
      <div class="card-body">
        <p class="">学習スケジュールを作ることで、各科目に必要な学習時間や、合格までに必要な期間を明確にできます。</p>
        <p class=""><a href="">中小企業診断士学習スケジュール</a>をコピーして利用ください。</p>
        <iframe src="https://docs.google.com/spreadsheets/d/1RwqX5d5ll2RzgjPGycFv8fQxCfZe8rA72y6u1IGHQFs/edit?usp=sharing" name="sample" width="100%" height="500">
          この部分はインラインフレームを使用しています。
        </iframe>
      </div>
    </div>

    <div class="card p-2 center">
      <div class="card-title">
        <a href="/license/{!!$license->id!!}/getLicenseData">試験データ</a>
      </div>
      <div class="card-body">
        <p class="">最新年度の試験データです。過去の試験データは↑のページにあります。</p>
        <?php 
        $license_id = $license->id;
        $year = 2018;
        ?>
        @include('include/licenseData')
      </div>
    </div>
    
    @include('license/include/footer')

    @include('include/footer')

  </div>
</div>

@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script>

time();
function time(){
    var now = new Date();
    // 試験日
    var phase1 = new Date('2019-08-04 09:00:00');
    var phase2 = new Date('2019-10-21 09:00:00');
    var phase1next = new Date('2020-07-18 09:00:00');
    // phase1
    var diff = (phase1.getTime() - now.getTime()) / 1000;
    // 日時の計算と端数切り捨て
    var daysLeft = Math.floor(diff / (24 * 60 * 60));
    if(daysLeft < 0){
        document.getElementById("phase1").innerHTML = ("終了");
    }else{
        var hoursLeft = (Math.floor(diff / (60 * 60))) % 24;
        var minitesLeft = (Math.floor(diff / 60)) % 60;
        var secondsLeft = Math.floor(diff) % 60;
        // 二桁表示
        minitesLeft = ("0" + minitesLeft).slice(-2)
        secondsLeft = ("0" + secondsLeft).slice(-2)
        // 出力
        document.getElementById("phase1").innerHTML = ("<span class=\"text-red-400\"><strong>あと「" + daysLeft + "日と" + hoursLeft + "時間" + minitesLeft + "分" + secondsLeft + "秒」</strong></span>");
    }
    // phase2
    var diff = (phase2.getTime() - now.getTime()) / 1000;
    // 日時の計算と端数切り捨て
    var daysLeft = Math.floor(diff / (24 * 60 * 60));
    if(daysLeft < 0){
        document.getElementById("phase2").innerHTML = ("終了");
    }else{
        var hoursLeft = (Math.floor(diff / (60 * 60))) % 24;
        var minitesLeft = (Math.floor(diff / 60)) % 60;
        var secondsLeft = Math.floor(diff) % 60;
        // 二桁表示
        minitesLeft = ("0" + minitesLeft).slice(-2)
        secondsLeft = ("0" + secondsLeft).slice(-2)
        // 出力
        document.getElementById("phase2").innerHTML = ("<span class=\"text-red-400\"><strong>あと「" + daysLeft + "日と" + hoursLeft + "時間" + minitesLeft + "分" + secondsLeft + "秒」</strong></span>");
    }
    // phase1next
    var diff = (phase1next.getTime() - now.getTime()) / 1000;
    // 日時の計算と端数切り捨て
    var daysLeft = Math.floor(diff / (24 * 60 * 60));
    if(daysLeft < 0){
        document.getElementById("phase1next").innerHTML = ("終了");
    }else{
        var hoursLeft = (Math.floor(diff / (60 * 60))) % 24;
        var minitesLeft = (Math.floor(diff / 60)) % 60;
        var secondsLeft = Math.floor(diff) % 60;
        // 二桁表示
        minitesLeft = ("0" + minitesLeft).slice(-2)
        secondsLeft = ("0" + secondsLeft).slice(-2)
        // 出力
        document.getElementById("phase1next").innerHTML = ("<span class=\"text-red-400\"><strong>あと「" + daysLeft + "日と" + hoursLeft + "時間" + minitesLeft + "分" + secondsLeft + "秒」</strong></span>");
    }
}
setInterval('time()',500);

</script>

@stop
