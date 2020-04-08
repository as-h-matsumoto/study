<style type="text/css">

.bg-mask {
  height: 100%;
  background: rgba(255,255,255,0.8);
}
.bg-mask-light {
  height: 100%;
  background: rgba(255,255,255,0.6);
}
.bg-mask-hard {
  height: 100%;
  background: rgba(255,255,255,0.9);
}

@media (max-width:635px){
  .px-sm-2{
    padding-left: 0 !important;
    padding-right: 0 !important;
    padding-left: 6px !important;
    padding-right: 6px !important;
    font-size: 12px;
  }
  .page-layout .page-header-search-custom{
    height:22rem;min-height:22rem;max-height:22rem
  }
}
@media (min-width: 636px) and (max-width: 1189px){
  .page-layout .page-header-search-custom{
    height:12rem;min-height:12rem;max-height:12rem
  }
}
@media (min-width: 1190px) and (max-width: 1686px){
  .page-layout .page-header-search-custom{
    height:7rem;min-height:7rem;max-height:7rem
  }
}
@media (min-width:1687px){
  .page-layout .page-header-search-custom{
    height:6rem;min-height:7rem;max-height:7rem
  }
}

@media (max-width:575px){
  .page-layout .page-header-search-custom-benri-year{
    height:17rem;min-height:17rem;max-height:17rem
  }
}
@media (min-width:1687px){
  .page-layout .page-header-search-custom-benri-year{
    height:6rem;min-height:7rem;max-height:7rem
  }
}

.bg-green-50{
  transition-property: all;
  transition-duration: 1s
}


.introduce-title {
    position: relative;
    color: #158b2b;
    padding: 10px 0;
    text-align: center;
    margin: 1.5em 0;
    
}
.introduce-title:before {
    content: "";
    position: absolute;
    top: -18px;
    left: 50%;
    width: 150px;
    height: 98px;
    border-radius: 50%;
    border: 5px solid #a6ddb0;
    border-left-color: transparent;
    border-right-color: transparent;
    -moz-transform: translateX(-50%);
    -webkit-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    transform: translateX(-50%);
}

.introduce-title-modan {
  position: relative;
  display: inline-block;
  padding: 0 45px;   
}
.introduce-title-modan:before, .introduce-title-modan:after {
  content: '';
  position: absolute;
  top: 50%;
  display: inline-block;
  width: 44px;
  height: 2px;
  background-color: #1976D2;
  -moz-transform: rotate(-60deg);
  -webkit-transform: rotate(-60deg);
  -ms-transform: rotate(-60deg);
  transform: rotate(-60deg);
}
.introduce-title-modan:before {left:0;}
.introduce-title-modan:after {right: 0;}


.introduce-title-modan-red {
  position: relative;
  display: inline-block;
  padding: 0 45px;   
}
.introduce-title-modan-red:before, .introduce-title-modan-red:after {
  content: '';
  position: absolute;
  top: 50%;
  display: inline-block;
  width: 44px;
  height: 2px;
  background-color: #E53935;
  -moz-transform: rotate(-60deg);
  -webkit-transform: rotate(-60deg);
  -ms-transform: rotate(-60deg);
  transform: rotate(-60deg);
}
.introduce-title-modan-red:before {left:0;}
.introduce-title-modan-red:after {right: 0;}


.introduce-title-stripe {
  position: relative;
}
.introduce-title-stripe:after {
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 7px;
  background: -webkit-repeating-linear-gradient(-45deg, #6ad1c8, #6ad1c8 2px, #fff 2px, #fff 4px);
  background: repeating-linear-gradient(-45deg, #6ad1c8, #6ad1c8 2px, #fff 2px, #fff 4px);
}

.introduce-title-stripe-red {
  position: relative;
}
.introduce-title-stripe-red:after {
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 7px;
  background: -webkit-repeating-linear-gradient(-45deg, #D32F2F, #D32F2F 2px, #fff 2px, #fff 4px);
  background: repeating-linear-gradient(-45deg, #D32F2F, #D32F2F 2px, #fff 2px, #fff 4px);
}

.introduce-title-stripe-blue {
  position: relative;
}
.introduce-title-stripe-blue:after {
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 7px;
  background: -webkit-repeating-linear-gradient(-45deg, #1976D2, #1976D2 2px, #fff 2px, #fff 4px);
  background: repeating-linear-gradient(-45deg, #1976D2, #1976D2 2px, #fff 2px, #fff 4px);
}

.introduce-title-stripe-yellow {
  position: relative;
}
.introduce-title-stripe-yellow:after {
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 7px;
  background: -webkit-repeating-linear-gradient(-45deg, #FDD835 , #FDD835  2px, #fff 2px, #fff 4px);
  background: repeating-linear-gradient(-45deg, #FDD835 , #FDD835  2px, #fff 2px, #fff 4px);
}

.introduce-title-stripe-purple {
  position: relative;
}
.introduce-title-stripe-purple:after {
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 7px;
  background: -webkit-repeating-linear-gradient(-45deg, #7B1FA2 , #7B1FA2  2px, #fff 2px, #fff 4px);
  background: repeating-linear-gradient(-45deg, #7B1FA2 , #7B1FA2  2px, #fff 2px, #fff 4px);
}

.introduce-title-line{
  position: relative;
  padding: 0.25em 0;
}
.introduce-title-line:after {
  content: "";
  display: block;
  height: 4px;
  background: -moz-linear-gradient(to right, rgb(255, 186, 115), #ffb2b2);
  background: -webkit-linear-gradient(to right, rgb(255, 186, 115), #ffb2b2);
  background: linear-gradient(to right, rgb(255, 186, 115), #ffb2b2);
}

.introduce-title-box{
  position: relative;
  padding: 0.25em 1em;
  border-top: solid 2px black;
  border-bottom: solid 2px black;
}
.introduce-title-box:before, .introduce-title-box:after{
  content: '';
  position: absolute;
  top: -7px;
  width: 2px;
  height: -webkit-calc(100% + 14px);
  height: calc(100% + 14px);
  background-color: black;
}
.introduce-title-box:before {left: 7px;}
.introduce-title-box:after  {right: 7px;}

.introduce-title-kagi-kakko {
  position: relative;
  line-height: 1.4;
  padding:0.25em 1em;
  display: inline-block;
}

.introduce-title-kagi-kakko:before,.introduce-title-kagi-kakko:after{ 
  content:'';
  width: 20px;
  height: 30px;
  position: absolute;
  display: inline-block;
}

.introduce-title-kagi-kakko:before{
  border-left: solid 1px #ff5722;
  border-top: solid 1px #ff5722;
  top:0;
  left: 0;
}

.introduce-title-kagi-kakko:after{
  border-right: solid 1px #ff5722;
  border-bottom: solid 1px #ff5722;
  bottom:0;
  right: 0;
}

.introduce-title-toji-kakko {
  position: relative;
  line-height: 1.4;
  padding:0.25em 1em;
  display: inline-block;
  top:0;
}

a.active{
  color: black;
  border-bottom: solid 2px black;
}
.introduce-title-toji-kakko:before,h1:after{ 
  position: absolute;
  top: 0;
  content:'';
  width: 8px;
  height: 100%;
  display: inline-block;
}
.introduce-title-toji-kakko:before{
  border-left: solid 1px black;
  border-top: solid 1px black;
  border-bottom: solid 1px black;
  left: 0;
}
.introduce-title-toji-kakko:after{
  content: '';
  border-top: solid 1px black;
  border-right: solid 1px black;
  border-bottom: solid 1px black;
  right: 0;
}

.introduce-title-circle {
  position: relative;
  color: #333333;
  display: inline-block;
  margin: 47px 0;
  text-shadow: 0 0 2px white;
}
.introduce-title-circle:before {
  content: "";
  position: absolute;
  background: #a9e1ff;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  top: 50%;
  border: dashed 1px white;
  left: 50%;
  -moz-transform: translate(-50%,-50%);
  -webkit-transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
  transform: translate(-50%,-50%);
  z-index: -1;
  box-shadow: 0px 0px 0px 5px #a9e1ff;
}

.introduce-title-circle-green {
  position: relative;
  color: #333333;
  display: inline-block;
  margin: 47px 0;
  text-shadow: 0 0 2px white;
}
.introduce-title-circle-green:before {
  content: "";
  position: absolute;
  background: #80CBC4;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  top: 50%;
  border: dashed 1px white;
  left: 50%;
  -moz-transform: translate(-50%,-50%);
  -webkit-transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
  transform: translate(-50%,-50%);
  z-index: -1;
  box-shadow: 0px 0px 0px 5px #80CBC4;
}

.introduce-title-circle-red {
  position: relative;
  color: #333333;
  display: inline-block;
  margin: 47px 0;
  text-shadow: 0 0 2px white;
}
.introduce-title-circle-red:before {
  content: "";
  position: absolute;
  background: #E53935;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  top: 50%;
  border: dashed 1px white;
  left: 50%;
  -moz-transform: translate(-50%,-50%);
  -webkit-transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
  transform: translate(-50%,-50%);
  z-index: -1;
  box-shadow: 0px 0px 0px 5px #E53935;
}

.recaptcha{ text-align: center; }
.g-recaptcha {
  display: inline-block;
}

.div-introduce {
  min-height:500px;
}

.introduce-title-line {
  position: relative;
  padding: 0.25em 0;
}
.introduce-title-line:after {
  content: "";
  display: block;
  height: 4px;
  background: -moz-linear-gradient(to right, rgb(255, 186, 115), #ffb2b2);
  background: -webkit-linear-gradient(to right, rgb(255, 186, 115), #ffb2b2);
  background: linear-gradient(to right, rgb(255, 186, 115), #ffb2b2);
}




.page-header-introduce {
    height: 40rem !important;
    min-height: 40rem !important;
    max-height: 40rem !important;
    padding: 0 !important;
}


.table-div{
  overflow: auto;
  white-space: nowrap;
}


.help-block {
  font-size:12px;
  color:#999999;
}
pre {
  background-color:#efefef;
  border: solid 2px #bbbbbb;
}

.fc-sun {background-color:#FFEBEE;}
.fc-sat {background-color:#E3F2FD;}

.btn-edit{background-color:transparent;background-image:none;border-color:#D9D9D9}
.btn-edit:hover{font-weight: 700;background-color:#F6F6F6;border-color:#D9D9D9}
.btn-edit:hover a:hover{font-weight: 700;}
.btn-outline-info{;background-color:transparent;background-image:none;border-color:#E9E9E9}
.btn-outline-info:hover{font-weight: 700;border-color:#bbbbbb}
.btn-outline-info:hover a:hover{font-weight: 700;}
.btn-outline-info.btn-outline-info-active{background-color:#E7E7E7;border-color:#E7E7E7}
.btn-outline-info.btn-outline-info-active a{color:#E3F3FF}
.btn-outline-info:hover i,.btn-outline-info:hover [class^="icon-"],.btn-outline-info:hover [class*=" icon-"]{}
.btn-info{color:#fff;background-color:#009688;border-color:#009688;-webkit-box-shadow:0px 3px 1px -2px rgba(0,0,0,0.2) , 0px 2px 2px 0px rgba(0,0,0,0.14) , 0px 1px 5px 0px rgba(0,0,0,0.12);box-shadow:0px 3px 1px -2px rgba(0,0,0,0.2) , 0px 2px 2px 0px rgba(0,0,0,0.14) , 0px 1px 5px 0px rgba(0,0,0,0.12);-webkit-transition:-webkit-box-shadow 280ms cubic-bezier(0.4, 0, 0.2, 1);transition:-webkit-box-shadow 280ms cubic-bezier(0.4, 0, 0.2, 1);-o-transition:box-shadow 280ms cubic-bezier(0.4, 0, 0.2, 1);transition:box-shadow 280ms cubic-bezier(0.4, 0, 0.2, 1);transition:box-shadow 280ms cubic-bezier(0.4, 0, 0.2, 1), -webkit-box-shadow 280ms cubic-bezier(0.4, 0, 0.2, 1);will-change:box-shadow;color:#fff!important}
.btn-info:hover{color:#fff;background-color:#007065;border-color:#00635a;color:#fff}
.btn-info:hover a:hover{color:#E3F3FF}
.btn-info:hover i,.btn-info:hover [class^="icon-"],
.btn-info:hover [class*=" icon-"]{color:rgba(255,255,255,0.87)}

.yoyaku-history-desc-header {
  height: 26rem !important;
  min-height: 26rem !important;
  max-height: 26rem !important;
  padding: 0 !important;
}

.payButton{
  -webkit-appearance: none;
  border-radius: 2px;
  display: inline-block;
  padding: .5em 1em;
  font-size: 12px;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  cursor: pointer;
  border: 1px solid #2FA0DC;
  color: #fff;
  background-color: #198fcc;
}

.shortcut-button.active {
  border-bottom: solid 2px #bbbbbb;
  background-color: #FFF8E1;
}
.shortcut-button:hover {
  border-bottom: solid 2px #bbbbbb;
  background-color: #FFF8E1;
}

.dropdown-item.active {
  border-bottom: solid 2px #bbbbbb;
  background-color: #FFF8E1;
}
.dropdown-item:hover {
  border-bottom: solid 2px #bbbbbb;
  background-color: #FFF8E1;
}


.modal {
    padding-right: 0px !important;
    overflow-y: auto;
    max-height: 90%;
}
.modal-open {
    padding-right: 0px !important;
}

.avater{
  width:  50px;       /* ※縦横を同値に */
  height: 50px;       /* ※縦横を同値に */
  border-radius: 50%;  /* 角丸半径を50%にする(=円形にする) */
  background-position: center center;  /* 横長画像の左上を基準に表示 */
  display: inline-block;
}

.page-header-search-input a.active{
  border-bottom: solid 2px #bbbbbb;
  background-color: #FFF8E1;
}
.coordiy-border{
  border: solid 1px #efefef;
  border-radius: 2px;
  padding:10px;
}
#CapacityFormpic, #placeOwnerFormPic, #formPic, #mainPic, #backPic, #recommendPics, #stepFormPic {
    filter:alpha(opacity=0);
    -moz-opacity: 0;
    opacity: 0;
    background-image: url("/storage/global/img/1.png");
    position: absolute;
    left: -9999px;
}
.btn-header{
    background-color: white !important;
    filter:alpha(opacity=90) !important;
    -moz-opacity: 0.9 !important;
    opacity: 0.9 !important;
}
.btn-header:hover{
    background-color: #eeeeee !important;
}
@media (min-width:576px){
.m-sm-2{margin:.8rem!important}
.mt-sm-2{margin-top:.8rem!important}
.mr-sm-2{margin-right:.8rem!important}
.mb-sm-2{margin-bottom:.8rem!important}
.ml-sm-2{margin-left:.8rem!important}
.mx-sm-2{margin-right:.8rem!important;margin-left:.8rem!important}
.my-sm-2{margin-top:.8rem!important;margin-bottom:.8rem!important}
}


.alreadyRead{
  background-color: #777777;
}



.card .card-body .nav-tabs .nav-item a{
  border: solid 1px #888888;
}
.card .card-body .nav-tabs .nav-item.active a, .card .card-body .nav-tabs .nav-item a:hover{
  font-weight: 600;
  color: #455A64;
  border-bottom: solid 3px #333333;

}



.border_top{ border-top: solid 1px #eeeeee;}
.border_bottom{border-bottom: solid 1px #eeeeee;}
.border_left{border-left: solid 1px #eeeeee;}
.border_right{border-right: solid 1px #eeeeee;}
.border_both{
  border-top: solid 1px #efefef;
  border-bottom: solid 1px #eeeeee;
  padding-top: 10px;
}
.page-content-header{
  line-height: 60px !important;
  background-color: #efefef;
}
.page-content-footer{
  min-height: 60px;
  background-color: #fefefe;
  padding: 4px 12px;
}
.page-content-footer p{
  line-height: 60px !important;
}

.user-info{
  margin-top: 40px;
  padding: 20px;
} 


.content-footer{
  padding:20px 20px 0 20px;
  font-size:12px;
  color:#fff;
  background-color: #888888;
}
.content-footer p a{
  color:#fff;
}

.has-error{color: #c41411;}
.user-info span, .user-info span span, .user-info span a{
  display:inline-block;
  vertical-align:middle !important;
}
.actions p{
  position:relative;
  top: 40%;
}
.center{ margin: 0 auto !important; text-align:center !important; vertical-align:middle !important; }
.right{ margin: 0 auto !important; text-align:right !important; vertical-align:middle !important; }
.left{ margin: 0 auto !important; text-align:left !important; vertical-align:middle !important; }

.type_box{
    display:inline-block;
    background-color: white;
    padding: 4px 7px;
    position: absolute;
    left: 5px;
    border-radius: 5px;
    top: 8px;
    //color: white;
    font-weight: bold;
    opacity:0.7;
}

.noimage_box{
    position: absolute;
    top: 10px;
    background-color: white;
    padding: 26px 14px;
    border-radius: 5px;
    //color: white;
    font-weight: bold;
    opacity:0.7;
}
.noimage_box_recruit{
    position: absolute;
    top: 10px;
    background-color: white;
    padding: 26px 14px;
    border-radius: 5px;
    //color: white;
    font-weight: bold;
    opacity:0.7;
}

.noimage_box_light{
    font-size: 8px;
    position: absolute;
    top: 18px;
    background-color: white;
    padding: 12px 8px;
    border-radius: 4px;
    //color: white;
    font-weight: bold;
    opacity:0.7;
}

.introduce_image_box{
    min-width: 100px;
    font-size: 30px;
    position: absolute;
    top: 60px;
    left: 50px;
    background-color: white;
    padding: 12px 8px;
    border-radius: 4px;
    color: black;
    font-weight: bold;
    opacity:0.7;
}


.clear-view {
    background-color: white;
    padding: 4px 7px;
    border-radius: 5px;
    opacity:0.7;
    font-weight: bold;
}


.logo-word-i:link{
   color: #fff !important;
}
.logo-word-i:visited{
    color: #fff !important;
}
.logo-word-i:hover{
    color: #fff !important;
}
.logo-word-i:active{
    color: #fff !important;
}

font-size:1.5rem;

.bold{font-weight: bold;}
.f12{font-size:1.2rem !important;} /* small */
.f14{font-size:1.4rem !important;}
.f16{/*1.5rem 標準*/}
.f18{font-size:1.6rem !important;}
.f20{font-size:1.7rem !important;}
.f22{font-size:1.8rem !important;}
.f24{font-size:1.9rem !important;}
.f26{font-size:2.0rem !important;}
.f28{font-size:2.1rem !important;}
.f30{font-size:2.2rem !important;}
.card-block-me{
    padding:10px;
}
.action-btn{
    background-color:#fff;
}
.action-btn:hover{
    background-color:#efefef;
}
.card-actions{
    border-top: solid 1px #efefef;
}
.action-btn-footer{
    padding: 8px 6px;
    border-right: solid 1px #efefef;
}
.border-bottom{
    border-bottom: solid 1px #efefef;
}
.border-top{
    border-top: solid 1px #efefef;
}
.border-left{
    border-left: solid 1px #efefef;
}
.border-right{
    border-right: solid 1px #efefef;
}


@media (max-width: 575px) {
  .pt-sm {
    padding-top:16px !important;
  }
  .hidden-xs {
    display: none !important;
  }
  .ccard {
    margin-bottom: 10px;
    border-radius: 2px;
  }
  .clcard {
    margin-bottom: 10px;
    border-radius: 2px;
  }
  .rcard {
    margin-bottom: 10px;
    border-radius: 2px;
  }
  .rlcard {
    margin-bottom: 10px;
    border-radius: 2px;
  }
  .mcard {
    margin-bottom: 10px;
    border-radius: 2px;
  }
  .lcard {
    margin-bottom: 10px;
    border-radius: 2px;
  }
}
@media (max-width: 768px) {
  .sm-page-header-lg {
    height: 26rem !important;
    min-height: 26rem !important;
    max-height: 26rem !important;
    padding: 0 !important;
  }
  .sm-page-header {
    height: 25rem !important;
    min-height: 25rem !important;
    max-height: 25rem !important;
    padding: 0 !important;
  }
  .sm-page-header-yoyaku {
    height: 23rem !important;
    min-height: 23rem !important;
    max-height: 23rem !important;
    padding: 0 !important;
  }
  .sm-page-header-light {
    height: 19rem !important;
    min-height: 19rem !important;
    max-height: 19rem !important;
    padding: 0 !important;
  }
  .actions {
    position:relative;
  }
  .actions-header {
    top: -20px !important;
  }
  .page-header-img-m {
    margin-bottom: 10px;
  }
  .center-sm {
    margin: 0 auto !important;
    text-align:center !important;
    vertical-align:middle !important;
  }
  .h2-sm-over{
    font-size:18px;
  }
  .f11-sm {
    font-size:11px !important;
    padding: 0 !important;
    padding: 1px !important;
    line-height:12px;
  }
}

@media (min-width: 576px) {
  .pt-sm {
  }
  .f11-sm {
  }
  .h2-sm-over{
    font-size:30px;
  } 
  .hidden-xs-other {
    display: none !important;
  }
  .page-header-search-input {
    max-width: 300px;
  }
  .ccard {
    border-radius: 2px;
    margin-bottom: 10px;
    min-width: 160px !important;
    max-width: 160px !important;
  }
  .clcard {
    border-radius: 2px;
    margin-bottom: 10px;
    min-width: 200px !important;
    max-width: 200px !important;
  }
  .rcard {
    border-radius: 2px;
    margin-bottom: 10px;
    min-width: 240px !important;
    max-width: 240px !important;
  }
  .rlcard {
    border-radius: 2px;
    margin-bottom: 10px;
    min-width: 300px !important;
    max-width: 300px !important;
  }
  .mcard {
    border-radius: 2px;
    margin-bottom: 10px;
    min-height: 180px !important;
    min-width: 380px !important;
    max-width: 380px !important;
  }
  .lcard {
    border-radius: 2px;
    margin-bottom: 10px;
    min-height: 160px !important;
    min-width: 490px !important;
    max-width: 490px !important;
  }
}

@media (min-width: 768px) {
  .hidden-sm-over {
    display: none !important;
  }
  .mb-1-sm-over {
    margin-bottom: 2px !important;
  }
  .mb-2-sm-over {
    margin-bottom: 4px !important;
  }
  .page-header-img-m {
    margin-right: 16px;
  }
  .sm-page-header-light {
    height: 19rem !important;
    min-height: 19rem !important;
    max-height: 19rem !important;
    padding: 0 !important;
  }
}

@media (min-width: 545px) and (max-width: 768px) {
  .hidden-sm {
    display: none !important;
  }
}

@media (min-width: 768px) and (max-width: 992px) {
  .hidden-md {
    display: none !important;
  }
}

@media (min-width: 992px) {
  .hidden-lg-other {
    display: none !important;
  }
}
@media (min-width: 992px) and (max-width: 1280px) {
  .hidden-lg {
    display: none !important;
  }
}

@media (min-width: 1280px) and (max-width: 1520px) {
  .hidden-xl {
    display: none !important;
  }
}

@media (min-width: 1520px) {
  .hidden-zl {
    display: none !important;
  }
}

.page-header {
  background-size: 100% !important;
  background-repeat: no-repeat;
}

.active-yoyaku {
  background-color:#cccccc;
  color: #333333 !important;
  font-weight:900;
}
.active-yoyaku:hover {
  color: #fff !important;
  font-weight:900;
}
input:disabled {
  background-color:#bbbbbb !important;
}




#page-header-custom .user-info span span.name, #page-header-custom-yoyaku .user-info span span.name{
    color:#ffffff;
    font-weight:900;
    background-color: #000000;
    filter:alpha(opacity=100);
    -moz-opacity: 1.0;
    opacity: 0.8;
    border-radius: 4px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    padding: 6px;
}  





/* Absolute Center Spinner */
#loading {
  position: fixed;
  z-index: 1051;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
#loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
#loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

#loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}


/* Absolute Center Spinner */
#loading2 {
  position: fixed;
  z-index: 1051;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
#loading2:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
#loading2:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

#loading2:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}


.box_srcollbar {
  overflow-y: auto;
  overflow-x: hidden;
  max-height:300px;
  border:1px solid #eeeeee;
}
.box_title{
  border:0 1px 1px 1px solid #eeeeee;
  padding:5px;
  font-size:14px;
}

.modal-content {
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}
.modal-header {
    padding:9px 15px;
    border-bottom:1px solid #eee;
    background-color: #f4fbff;
    color: black;
    font-weight: 900;
}
.modal-header button {
    color: black;
}
.modal-title-tab {
  background-color:#fff;
  padding:12px 16px;
  border-bottom:1px solid #eee;
  border-right:1px solid #eee;
  box-shadow: 1px 1px 2px #bbb;
}
.modal-title-tab:hover, .modal-title-tab.active {
  font-weight:900;
  background-color:#eee;
}

.longMessage{
  min-height: 120px !important;
  padding-top: 30px !important;
}

.mycheckbox {
    border-radius:5px;

    border: solid 1px #efefef;

    background-color:#fff;
    white-space: nowrap;
    overflow:hidden;

    width:20px;
    height:20px;
}
.mycheckboxcapacity {
    border-radius:5px;

    border: solid 1px #efefef;

    background-color:#fff;
    white-space: nowrap;
    overflow:hidden;

    width:20px;
    height:20px;
}
.mycheckboxgolist {
    border-radius:5px;

    border: solid 1px #efefef;

    background-color:#fff;
    white-space: nowrap;
    overflow:hidden;

    width:20px;
    height:20px;
}
.cp_ipcheck {
	width: 90%;
	margin: 2em auto;
	text-align: left;
}
@keyframes click-wave {
	0% {
		position: relative;
		width: 30px;
		height: 30px;
		opacity: 0.35;
	}
	100% {
		width: 200px;
		height: 200px;
		margin-top: -80px;
		margin-left: -80px;
		opacity: 0;
	}
}
.cp_ipcheck .option-input02 {
	position: relative;
	top: 13.33333px;
	right: 0;
	bottom: 0;
	left: 0;
	width: 30px;
	height: 30px;
	margin-right: 0.5rem;
	cursor: pointer;
	transition: all 0.15s ease-out 0s;
	color: #ffffff;
	border: none;
	outline: none;
	background: #d7cbcb;
	-webkit-appearance: none;
	        appearance: none;
}
.cp_ipcheck .option-input02:hover {
	background: #d6a9a9;
}
.cp_ipcheck .option-input02:checked {
	background: #da3c41;
}
.cp_ipcheck .option-input02:checked::before {
	font-size: 20px;
	line-height: 30px;
	position: absolute;
	display: inline-block;
	width: 30px;
	height: 30px;
	content: '✔';
	text-align: center;
}
.cp_ipcheck .option-input02:checked::after {
	position: relative;
	display: block;
	content: '';
	-webkit-animation: click-wave 0.65s;
	        animation: click-wave 0.65s;
	background: #da3c41;
}
.cp_ipcheck .option-input02.radio {
	border-radius: 50%;
}
.cp_ipcheck .option-input02.radio::after {
	border-radius: 50%;
}
.cp_ipcheck label {
	line-height: 40px;
	display: block;
}
.cp_ipcheck .option-input02:disabled {
	cursor: not-allowed;
	background: #b8b7b7;
}
.cp_ipcheck .option-input02:disabled::before {
	font-size: 20px;
	line-height: 30px;
	position: absolute;
	display: inline-block;
	width: 30px;
	height: 30px;
	content: '✖︎';
	text-align: center;
}
</style>