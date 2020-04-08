@extends('account/layouts/default')

{{-- Page title --}}
@section('title') {!!$license->name!!} 試験日程 @parent
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

    @include('license/include/test')

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
