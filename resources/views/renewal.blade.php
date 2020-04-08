@extends('layouts/default')

{{-- Page title --}}
@section('title') Renewal To Coordiy Platform @parent
@stop

@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="サービスをリニューアルします。">
<meta name="keywords" content="Coordiy Platform">
<meta property="og:site_name" content="Coordiy : コーディ">
<meta property="og:title" content="Coordiy : コーディ">
<meta property="og:description" content="サービスをリニューアルします。">
<meta property="og:image" content="/storage/assets/img/logo_new_1600.png">
<meta property="og:url" content="{!!$_SERVER['HTTP_HOST']!!}">
<meta property="og:locale" content="ja_JP">
<meta property="og:type" content="website">
@stop

{{-- page level styles --}}
@section('header_styles')
<style>
h2, h3, h4, h5 {
    padding-top: 30px !important;
}
</style>
@stop

{{-- content --}}
@section('content')
<div class="page-layout simple full-width">
<div class="page-content px-6 pt-2">


    <div class="row" >
        <div class="card col-sm-12 mb-2">
            <div class="card-body">
                <div class="pt-4">
                    <p class="display-1 center">Renew to
                      <span
                         class="txt-rotate"
                         data-period="2000"
                         data-rotate='[ "platform.", "Global X platform!"]'></span>
                    </p>
                </div>
            </div>
        </div>


        <div class="card col-sm-12 mb-2">
            <div class="card-body">
                <div class="pt-4">
		            <p class="h2 center">
                        <span class="">リニューアルについて</span>
                    </p>

                    <br />

                    <p class="h4 center">
                        Coordiy予約、Coordiy予約、ベンリ、コメンディはリニューアルします。
                        <br /><br />
                        すでにご利用のオーナーは、引き続きご利用いただけます。
                        <br /><br />
                        再開は２０１９/２月ごろを予定しております。
                    </p>
                </div>
            </div>
        </div>

    
    </div>
</div>


@include('include/footer')
</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script>
var TxtRotate = function(el, toRotate, period) {
  this.toRotate = toRotate;
  this.el = el;
  this.loopNum = 0;
  this.period = parseInt(period, 10) || 2000;
  this.txt = '';
  this.tick();
  this.isDeleting = false;
};

TxtRotate.prototype.tick = function() {
  var i = this.loopNum % this.toRotate.length;
  var fullTxt = this.toRotate[i];

  if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
  } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
  }

  this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

  var that = this;
  var delta = 300 - Math.random() * 100;

  if (this.isDeleting) { delta /= 2; }

  if (!this.isDeleting && this.txt === fullTxt) {
    delta = this.period;
    this.isDeleting = true;
  } else if (this.isDeleting && this.txt === '') {
    this.isDeleting = false;
    this.loopNum++;
    delta = 500;
  }

  setTimeout(function() {
    that.tick();
  }, delta);
};

window.onload = function() {
  var elements = document.getElementsByClassName('txt-rotate');
  for (var i=0; i<elements.length; i++) {
    var toRotate = elements[i].getAttribute('data-rotate');
    var period = elements[i].getAttribute('data-period');
    if (toRotate) {
      new TxtRotate(elements[i], JSON.parse(toRotate), period);
    }
  }
  // INJECT CSS
  var css = document.createElement("style");
  css.type = "text/css";
  css.innerHTML = ".txt-rotate > .wrap { border-right: 0.08em solid #666 }";
  document.body.appendChild(css);
};

</script>

@stop
