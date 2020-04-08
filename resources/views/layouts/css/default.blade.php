<link type="text/css" rel="stylesheet" href="/storage/assets/icons/fuse-icon-font/style.css">
<link href="https://fonts.googleapis.com/css?family=Lato|Noto+Serif+JP|Roboto|Sawarabi+Mincho&display=swap" rel="stylesheet">
<style>
@charset "UTF-8";
/*pnotify.main.css*/
/*!
Author  : Hunter Perrin
Version : 3.2.0
Link    : http://sciactive.com/pnotify/*/
.ui-pnotify{top:36px;right:36px;position:absolute;height:auto;z-index:2}body>.ui-pnotify{position:fixed;z-index:100040}.ui-pnotify-modal-overlay{background-color:rgba(0,0,0,.4);top:0;left:0;position:absolute;height:100%;width:100%;z-index:1}body>.ui-pnotify-modal-overlay{position:fixed;z-index:100039}.ui-pnotify.ui-pnotify-in{display:block!important}.ui-pnotify.ui-pnotify-move{transition:left .5s ease,top .5s ease,right .5s ease,bottom .5s ease}.ui-pnotify.ui-pnotify-fade-slow{transition:opacity .4s linear;opacity:0}.ui-pnotify.ui-pnotify-fade-slow.ui-pnotify.ui-pnotify-move{transition:opacity .4s linear,left .5s ease,top .5s ease,right .5s ease,bottom .5s ease}.ui-pnotify.ui-pnotify-fade-normal{transition:opacity .25s linear;opacity:0}.ui-pnotify.ui-pnotify-fade-normal.ui-pnotify.ui-pnotify-move{transition:opacity .25s linear,left .5s ease,top .5s ease,right .5s ease,bottom .5s ease}.ui-pnotify.ui-pnotify-fade-fast{transition:opacity .1s linear;opacity:0}.ui-pnotify.ui-pnotify-fade-fast.ui-pnotify.ui-pnotify-move{transition:opacity .1s linear,left .5s ease,top .5s ease,right .5s ease,bottom .5s ease}.ui-pnotify.ui-pnotify-fade-in{opacity:1}.ui-pnotify .ui-pnotify-shadow{-webkit-box-shadow:0 6px 28px 0 rgba(0,0,0,.1);-moz-box-shadow:0 6px 28px 0 rgba(0,0,0,.1);box-shadow:0 6px 28px 0 rgba(0,0,0,.1)}.ui-pnotify-container{background-position:0 0;padding:.8em;height:100%;margin:0}.ui-pnotify-container:after{content:" ";visibility:hidden;display:block;height:0;clear:both}.ui-pnotify-container.ui-pnotify-sharp{-webkit-border-radius:0;-moz-border-radius:0;border-radius:0}.ui-pnotify-title{display:block;margin-bottom:.4em;margin-top:0}.ui-pnotify-text{display:block}.ui-pnotify-icon,.ui-pnotify-icon span{display:block;float:left;margin-right:.2em}.ui-pnotify.stack-bottomleft,.ui-pnotify.stack-topleft{left:25px;right:auto}.ui-pnotify.stack-bottomleft,.ui-pnotify.stack-bottomright{bottom:25px;top:auto}.ui-pnotify.stack-modal{left:50%;right:auto;margin-left:-150px}.ui-pnotify-closer,.ui-pnotify-sticker{float:right;margin-left:.2em}.ui-pnotify-history-container{position:absolute;top:0;right:18px;width:70px;border-top:none;padding:0;-webkit-border-top-left-radius:0;-moz-border-top-left-radius:0;border-top-left-radius:0;-webkit-border-top-right-radius:0;-moz-border-top-right-radius:0;border-top-right-radius:0;z-index:10000}.ui-pnotify-history-container.ui-pnotify-history-fixed{position:fixed}.ui-pnotify-history-container .ui-pnotify-history-header{padding:2px;text-align:center}.ui-pnotify-history-container button{cursor:pointer;display:block;width:100%}.ui-pnotify-history-container .ui-pnotify-history-pulldown{display:block;margin:0 auto}.ui-pnotify-history-brighttheme{background-color:#8fcedd;border:0 solid #0286a5;color:#012831}.ui-pnotify-history-brighttheme button{text-transform:uppercase;font-weight:700;padding:4px 8px;border:none;background:0 0}.ui-pnotify-history-brighttheme .ui-pnotify-history-pulldown::after{display:block;font-size:16px;line-height:14px;padding-bottom:4px;content:"⌄";text-align:center;font-weight:700;}.ui-pnotify-container{position:relative;left:0}@media (max-width:480px){.ui-pnotify-mobile-able.ui-pnotify{position:fixed;top:0;right:0;left:0;width:auto!important;font-size:1.0em;-webkit-font-smoothing:antialiased;-moz-font-smoothing:antialiased;-ms-font-smoothing:antialiased;font-smoothing:antialiased}.ui-pnotify-mobile-able.ui-pnotify .ui-pnotify-shadow{-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none;border-bottom-width:5px}.ui-pnotify-mobile-able .ui-pnotify-container{-webkit-border-radius:0;-moz-border-radius:0;border-radius:0}.ui-pnotify-mobile-able.ui-pnotify.stack-bottomleft,.ui-pnotify-mobile-able.ui-pnotify.stack-topleft{left:0;right:0}.ui-pnotify-mobile-able.ui-pnotify.stack-bottomleft,.ui-pnotify-mobile-able.ui-pnotify.stack-bottomright{left:0;right:0;bottom:0;top:auto}.ui-pnotify-mobile-able.ui-pnotify.stack-bottomleft .ui-pnotify-shadow,.ui-pnotify-mobile-able.ui-pnotify.stack-bottomright .ui-pnotify-shadow{border-top-width:5px;border-bottom-width:1px}}.ui-pnotify.ui-pnotify-nonblock-fade{opacity:.2}.ui-pnotify.ui-pnotify-nonblock-hide{display:none!important}

@media print{
    *,::after,::before{text-shadow:none!important;-webkit-box-shadow:none!important;box-shadow:none!important}
    a,a:visited{text-decoration:underline}
    abbr[title]::after{content:" (" attr(title) ")"}
    pre{white-space:pre-wrap!important}
    blockquote,pre{border:0 solid #999;page-break-inside:avoid}
    thead{display:table-header-group}
    img,tr{page-break-inside:avoid}
    h2,h3,p{orphans:3;widows:3}
    h2,h3{page-break-after:avoid}
    .navbar{display:none}
    .badge{border:0 solid #000}
    .table{border-collapse:collapse!important}
    .table td,.table th{background-color:#fff!important}
    .table-bordered td,.table-bordered th{border:1px solid #ddd!important}
}

html{-webkit-box-sizing:border-box;box-sizing:border-box;font-family:"Sawarabi Mincho", "Roboto";line-height:1.15;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;-ms-overflow-style:scrollbar;-webkit-tap-highlight-color:transparent}
*,::after,::before{-webkit-box-sizing:inherit;box-sizing:inherit}
article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}
body{margin:0;font-size:1.5rem;font-weight:400;line-height:1.5;color:#333333;background-color:#fff}
[tabindex="-1"]:focus{outline:0!important}
hr{-webkit-box-sizing:content-box;box-sizing:content-box;height:0;overflow:visible}
h1,h2,h3,h4,h5,h6{margin-top:0;margin-bottom:.5rem}
p{margin-top:0;margin-bottom:1rem}
abbr[data-original-title],abbr[title]{text-decoration:underline;text-decoration:underline dotted;cursor:help;border-bottom:0}
address{margin-bottom:1rem;font-style:normal;line-height:inherit}
dl,ol,ul{margin-top:0;margin-bottom:1rem}
ol ol,ol ul,ul ol,ul ul{margin-bottom:0}
dt{font-weight:700}
dd{margin-bottom:.5rem;margin-left:0}
blockquote{margin:0 0 1rem}
dfn{font-style:italic}
b,strong{font-weight:bolder}
small{font-size:80%}
sub,sup{position:relative;font-size:75%;line-height:0;vertical-align:baseline}
sub{bottom:-.25em}
sup{top:-.5em}
a{color:#1565C0;text-decoration:none;-webkit-text-decoration-skip:objects}
a:hover{color:#0D47A1;text-decoration:underline}
a:not([href]):not([tabindex]){color:inherit;text-decoration:none}
a:not([href]):not([tabindex]):focus,a:not([href]):not([tabindex]):hover{color:inherit;text-decoration:none}
a:not([href]):not([tabindex]):focus{outline:0}
figure{margin:0 0 1rem}
img{vertical-align:middle;border-style:none}
svg:not(:root){overflow:hidden}
[role=button],a,area,button,input,label,select,summary,textarea{-ms-touch-action:manipulation;touch-action:manipulation}
table{border-collapse:collapse}
caption{padding-top:.8rem;padding-bottom:.8rem;color:rgba(0,0,0,.38);text-align:left;caption-side:bottom}
th{text-align:left}
label{display:inline-block;margin-bottom:.5rem}
button:focus{outline:1px dotted;outline:5px auto -webkit-focus-ring-color}
button,input,optgroup,select,textarea{margin:0;font-size:inherit;line-height:inherit}
button,input{overflow:visible}
button,select{text-transform:none}
[type=reset],[type=submit],button,html [type=button]{-webkit-appearance:button}
[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner,button::-moz-focus-inner{padding:0;border-style:none}
input[type=checkbox],input[type=radio]{-webkit-box-sizing:border-box;box-sizing:border-box;padding:0}
input[type=date],input[type=datetime-local],input[type=month],input[type=time]{-webkit-appearance:listbox}
textarea{overflow:auto;resize:vertical}
fieldset{min-width:0;padding:0;margin:0;border:0}
legend{display:block;width:100%;max-width:100%;padding:0;margin-bottom:.5rem;font-size:1.5rem;line-height:inherit;color:inherit;white-space:normal}
progress{vertical-align:baseline}
[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}
[type=search]{outline-offset:-2px;-webkit-appearance:none}
[type=search]::-webkit-search-cancel-button,[type=search]::-webkit-search-decoration{-webkit-appearance:none}
::-webkit-file-upload-button{font:inherit;-webkit-appearance:button}
output{display:inline-block}
summary{display:list-item}
template{display:none}
[hidden]{display:none!important}
.h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6{margin-bottom:.8rem;font-weight:400;line-height:1.5;color:inherit}
.h1,h1{font-size:4rem}
.h2,h2{font-size:3.2rem}
.h3,h3{font-size:2.8rem}
.h4,h4{font-size:2.4rem}
.h5,h5{font-size:2rem}
.h6,h6{font-size:1.6rem}
.lead{font-size:1.25rem;font-weight:300}
.display-1{font-size:11.2rem;font-weight:300;line-height:1.5}
.display-2{font-size:5.6rem;font-weight:300;line-height:1.5}
.display-3{font-size:4.5rem;font-weight:300;line-height:1.5}
.display-4{font-size:3.4rem;font-weight:300;line-height:1.5}
hr{margin-top:1rem;margin-bottom:1rem;border:0;border-top:0 solid rgba(0,0,0,.1)}
.small,small{font-size:1.2rem;font-weight:400}
.mark,mark{padding:.2em;background-color:#fcf8e3}
.list-unstyled{padding-left:0;list-style:none}
.list-inline{padding-left:0;list-style:none}
.list-inline-item{display:inline-block}
.list-inline-item:not(:last-child){margin-right:5px}
.initialism{font-size:90%;text-transform:uppercase}
.blockquote{margin-bottom:.4rem;font-size:1.75rem}
.blockquote-footer{display:block;font-size:80%;color:#868e96}
.blockquote-footer::before{content:"\2014 \00A0"}
.img-fluid{max-width:100%;height:auto}
.img-thumbnail{padding:.25rem;background-color:#fff;border:0 solid #ddd;-webkit-border-radius:2px;border-radius:2px;-webkit-transition:all .2s ease-in-out;transition:all .2s ease-in-out;-webkit-box-shadow:0 1px 2px rgba(0,0,0,.075);box-shadow:0 1px 2px rgba(0,0,0,.075);max-width:100%;height:auto}
.figure{display:inline-block}
.figure-img{margin-bottom:.2rem;line-height:1}
.figure-caption{font-size:90%;color:#868e96}
code{padding:.2rem .4rem;font-size:90%;color:#bd4147;background-color:#f8f9fa;-webkit-border-radius:2px;border-radius:2px}
a>code{padding:0;color:inherit;background-color:inherit}
kbd{padding:.2rem .4rem;font-size:90%;color:#fff;background-color:#212529;-webkit-border-radius:2px;border-radius:2px;-webkit-box-shadow:inset 0 -.1rem 0 rgba(0,0,0,.25);box-shadow:inset 0 -.1rem 0 rgba(0,0,0,.25)}
kbd kbd{padding:0;font-size:100%;font-weight:700;-webkit-box-shadow:none;box-shadow:none}
pre code{padding:0;font-size:inherit;color:inherit;background-color:transparent;-webkit-border-radius:0;border-radius:0}
.pre-scrollable{max-height:340px;overflow-y:scroll}
.container{margin-right:auto;margin-left:auto;padding-right:15px;padding-left:15px;width:100%}
@media (min-width:576px){.container{max-width:540px}
}
@media (min-width:768px){.container{max-width:720px}
}
@media (min-width:992px){.container{max-width:960px}
}
@media (min-width:1200px){.container{max-width:1140px}
}
.container-fluid{width:100%;margin-right:auto;margin-left:auto;padding-right:15px;padding-left:15px;width:100%}
.row{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}
.no-gutters{margin-right:0;margin-left:0}
.no-gutters>.col,.no-gutters>[class*=col-]{padding-right:0;padding-left:0}
.col,.col-1,.col-10,.col-11,.col-12,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-auto,.col-lg,.col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9,.col-lg-auto,.col-md,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-auto,.col-sm,.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,.col-sm-auto,.col-xl,.col-xl-1,.col-xl-10,.col-xl-11,.col-xl-12,.col-xl-2,.col-xl-3,.col-xl-4,.col-xl-5,.col-xl-6,.col-xl-7,.col-xl-8,.col-xl-9,.col-xl-auto{position:relative;width:100%;min-height:1px;padding-right:15px;padding-left:15px}
.col{-webkit-flex-basis:0;-ms-flex-preferred-size:0;flex-basis:0;-webkit-box-flex:1;-webkit-flex-grow:1;-ms-flex-positive:1;flex-grow:1;max-width:100%}
.col-auto{-webkit-box-flex:0;-webkit-flex:0 0 auto;-ms-flex:0 0 auto;flex:0 0 auto;width:auto;max-width:none}
.col-1{-webkit-box-flex:0;-webkit-flex:0 0 8.33333%;-ms-flex:0 0 8.33333%;flex:0 0 8.33333%;max-width:8.33333%}
.col-2{-webkit-box-flex:0;-webkit-flex:0 0 16.66667%;-ms-flex:0 0 16.66667%;flex:0 0 16.66667%;max-width:16.66667%}
.col-3{-webkit-box-flex:0;-webkit-flex:0 0 25%;-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}
.col-4{-webkit-box-flex:0;-webkit-flex:0 0 33.33333%;-ms-flex:0 0 33.33333%;flex:0 0 33.33333%;max-width:33.33333%}
.col-5{-webkit-box-flex:0;-webkit-flex:0 0 41.66667%;-ms-flex:0 0 41.66667%;flex:0 0 41.66667%;max-width:41.66667%}
.col-6{-webkit-box-flex:0;-webkit-flex:0 0 50%;-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}
.col-7{-webkit-box-flex:0;-webkit-flex:0 0 58.33333%;-ms-flex:0 0 58.33333%;flex:0 0 58.33333%;max-width:58.33333%}
.col-8{-webkit-box-flex:0;-webkit-flex:0 0 66.66667%;-ms-flex:0 0 66.66667%;flex:0 0 66.66667%;max-width:66.66667%}
.col-9{-webkit-box-flex:0;-webkit-flex:0 0 75%;-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}
.col-10{-webkit-box-flex:0;-webkit-flex:0 0 83.33333%;-ms-flex:0 0 83.33333%;flex:0 0 83.33333%;max-width:83.33333%}
.col-11{-webkit-box-flex:0;-webkit-flex:0 0 91.66667%;-ms-flex:0 0 91.66667%;flex:0 0 91.66667%;max-width:91.66667%}
.col-12{-webkit-box-flex:0;-webkit-flex:0 0 100%;-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}
.order-1{-webkit-box-ordinal-group:2;-webkit-order:1;-ms-flex-order:1;order:1}
.order-2{-webkit-box-ordinal-group:3;-webkit-order:2;-ms-flex-order:2;order:2}
.order-3{-webkit-box-ordinal-group:4;-webkit-order:3;-ms-flex-order:3;order:3}
.order-4{-webkit-box-ordinal-group:5;-webkit-order:4;-ms-flex-order:4;order:4}
.order-5{-webkit-box-ordinal-group:6;-webkit-order:5;-ms-flex-order:5;order:5}
.order-6{-webkit-box-ordinal-group:7;-webkit-order:6;-ms-flex-order:6;order:6}
.order-7{-webkit-box-ordinal-group:8;-webkit-order:7;-ms-flex-order:7;order:7}
.order-8{-webkit-box-ordinal-group:9;-webkit-order:8;-ms-flex-order:8;order:8}
.order-9{-webkit-box-ordinal-group:10;-webkit-order:9;-ms-flex-order:9;order:9}
.order-10{-webkit-box-ordinal-group:11;-webkit-order:10;-ms-flex-order:10;order:10}
.order-11{-webkit-box-ordinal-group:12;-webkit-order:11;-ms-flex-order:11;order:11}
.order-12{-webkit-box-ordinal-group:13;-webkit-order:12;-ms-flex-order:12;order:12}
@media (min-width:576px){.col-sm{-webkit-flex-basis:0;-ms-flex-preferred-size:0;flex-basis:0;-webkit-box-flex:1;-webkit-flex-grow:1;-ms-flex-positive:1;flex-grow:1;max-width:100%}
.col-sm-auto{-webkit-box-flex:0;-webkit-flex:0 0 auto;-ms-flex:0 0 auto;flex:0 0 auto;width:auto;max-width:none}
.col-sm-1{-webkit-box-flex:0;-webkit-flex:0 0 8.33333%;-ms-flex:0 0 8.33333%;flex:0 0 8.33333%;max-width:8.33333%}
.col-sm-2{-webkit-box-flex:0;-webkit-flex:0 0 16.66667%;-ms-flex:0 0 16.66667%;flex:0 0 16.66667%;max-width:16.66667%}
.col-sm-3{-webkit-box-flex:0;-webkit-flex:0 0 25%;-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}
.col-sm-4{-webkit-box-flex:0;-webkit-flex:0 0 33.33333%;-ms-flex:0 0 33.33333%;flex:0 0 33.33333%;max-width:33.33333%}
.col-sm-5{-webkit-box-flex:0;-webkit-flex:0 0 41.66667%;-ms-flex:0 0 41.66667%;flex:0 0 41.66667%;max-width:41.66667%}
.col-sm-6{-webkit-box-flex:0;-webkit-flex:0 0 50%;-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}
.col-sm-7{-webkit-box-flex:0;-webkit-flex:0 0 58.33333%;-ms-flex:0 0 58.33333%;flex:0 0 58.33333%;max-width:58.33333%}
.col-sm-8{-webkit-box-flex:0;-webkit-flex:0 0 66.66667%;-ms-flex:0 0 66.66667%;flex:0 0 66.66667%;max-width:66.66667%}
.col-sm-9{-webkit-box-flex:0;-webkit-flex:0 0 75%;-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}
.col-sm-10{-webkit-box-flex:0;-webkit-flex:0 0 83.33333%;-ms-flex:0 0 83.33333%;flex:0 0 83.33333%;max-width:83.33333%}
.col-sm-11{-webkit-box-flex:0;-webkit-flex:0 0 91.66667%;-ms-flex:0 0 91.66667%;flex:0 0 91.66667%;max-width:91.66667%}
.col-sm-12{-webkit-box-flex:0;-webkit-flex:0 0 100%;-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}
.order-sm-1{-webkit-box-ordinal-group:2;-webkit-order:1;-ms-flex-order:1;order:1}
.order-sm-2{-webkit-box-ordinal-group:3;-webkit-order:2;-ms-flex-order:2;order:2}
.order-sm-3{-webkit-box-ordinal-group:4;-webkit-order:3;-ms-flex-order:3;order:3}
.order-sm-4{-webkit-box-ordinal-group:5;-webkit-order:4;-ms-flex-order:4;order:4}
.order-sm-5{-webkit-box-ordinal-group:6;-webkit-order:5;-ms-flex-order:5;order:5}
.order-sm-6{-webkit-box-ordinal-group:7;-webkit-order:6;-ms-flex-order:6;order:6}
.order-sm-7{-webkit-box-ordinal-group:8;-webkit-order:7;-ms-flex-order:7;order:7}
.order-sm-8{-webkit-box-ordinal-group:9;-webkit-order:8;-ms-flex-order:8;order:8}
.order-sm-9{-webkit-box-ordinal-group:10;-webkit-order:9;-ms-flex-order:9;order:9}
.order-sm-10{-webkit-box-ordinal-group:11;-webkit-order:10;-ms-flex-order:10;order:10}
.order-sm-11{-webkit-box-ordinal-group:12;-webkit-order:11;-ms-flex-order:11;order:11}
.order-sm-12{-webkit-box-ordinal-group:13;-webkit-order:12;-ms-flex-order:12;order:12}
}
@media (min-width:768px){.col-md{-webkit-flex-basis:0;-ms-flex-preferred-size:0;flex-basis:0;-webkit-box-flex:1;-webkit-flex-grow:1;-ms-flex-positive:1;flex-grow:1;max-width:100%}
.col-md-auto{-webkit-box-flex:0;-webkit-flex:0 0 auto;-ms-flex:0 0 auto;flex:0 0 auto;width:auto;max-width:none}
.col-md-1{-webkit-box-flex:0;-webkit-flex:0 0 8.33333%;-ms-flex:0 0 8.33333%;flex:0 0 8.33333%;max-width:8.33333%}
.col-md-2{-webkit-box-flex:0;-webkit-flex:0 0 16.66667%;-ms-flex:0 0 16.66667%;flex:0 0 16.66667%;max-width:16.66667%}
.col-md-3{-webkit-box-flex:0;-webkit-flex:0 0 25%;-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}
.col-md-4{-webkit-box-flex:0;-webkit-flex:0 0 33.33333%;-ms-flex:0 0 33.33333%;flex:0 0 33.33333%;max-width:33.33333%}
.col-md-5{-webkit-box-flex:0;-webkit-flex:0 0 41.66667%;-ms-flex:0 0 41.66667%;flex:0 0 41.66667%;max-width:41.66667%}
.col-md-6{-webkit-box-flex:0;-webkit-flex:0 0 50%;-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}
.col-md-7{-webkit-box-flex:0;-webkit-flex:0 0 58.33333%;-ms-flex:0 0 58.33333%;flex:0 0 58.33333%;max-width:58.33333%}
.col-md-8{-webkit-box-flex:0;-webkit-flex:0 0 66.66667%;-ms-flex:0 0 66.66667%;flex:0 0 66.66667%;max-width:66.66667%}
.col-md-9{-webkit-box-flex:0;-webkit-flex:0 0 75%;-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}
.col-md-10{-webkit-box-flex:0;-webkit-flex:0 0 83.33333%;-ms-flex:0 0 83.33333%;flex:0 0 83.33333%;max-width:83.33333%}
.col-md-11{-webkit-box-flex:0;-webkit-flex:0 0 91.66667%;-ms-flex:0 0 91.66667%;flex:0 0 91.66667%;max-width:91.66667%}
.col-md-12{-webkit-box-flex:0;-webkit-flex:0 0 100%;-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}
.order-md-1{-webkit-box-ordinal-group:2;-webkit-order:1;-ms-flex-order:1;order:1}
.order-md-2{-webkit-box-ordinal-group:3;-webkit-order:2;-ms-flex-order:2;order:2}
.order-md-3{-webkit-box-ordinal-group:4;-webkit-order:3;-ms-flex-order:3;order:3}
.order-md-4{-webkit-box-ordinal-group:5;-webkit-order:4;-ms-flex-order:4;order:4}
.order-md-5{-webkit-box-ordinal-group:6;-webkit-order:5;-ms-flex-order:5;order:5}
.order-md-6{-webkit-box-ordinal-group:7;-webkit-order:6;-ms-flex-order:6;order:6}
.order-md-7{-webkit-box-ordinal-group:8;-webkit-order:7;-ms-flex-order:7;order:7}
.order-md-8{-webkit-box-ordinal-group:9;-webkit-order:8;-ms-flex-order:8;order:8}
.order-md-9{-webkit-box-ordinal-group:10;-webkit-order:9;-ms-flex-order:9;order:9}
.order-md-10{-webkit-box-ordinal-group:11;-webkit-order:10;-ms-flex-order:10;order:10}
.order-md-11{-webkit-box-ordinal-group:12;-webkit-order:11;-ms-flex-order:11;order:11}
.order-md-12{-webkit-box-ordinal-group:13;-webkit-order:12;-ms-flex-order:12;order:12}
}
@media (min-width:992px){.col-lg{-webkit-flex-basis:0;-ms-flex-preferred-size:0;flex-basis:0;-webkit-box-flex:1;-webkit-flex-grow:1;-ms-flex-positive:1;flex-grow:1;max-width:100%}
.col-lg-auto{-webkit-box-flex:0;-webkit-flex:0 0 auto;-ms-flex:0 0 auto;flex:0 0 auto;width:auto;max-width:none}
.col-lg-1{-webkit-box-flex:0;-webkit-flex:0 0 8.33333%;-ms-flex:0 0 8.33333%;flex:0 0 8.33333%;max-width:8.33333%}
.col-lg-2{-webkit-box-flex:0;-webkit-flex:0 0 16.66667%;-ms-flex:0 0 16.66667%;flex:0 0 16.66667%;max-width:16.66667%}
.col-lg-3{-webkit-box-flex:0;-webkit-flex:0 0 25%;-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}
.col-lg-4{-webkit-box-flex:0;-webkit-flex:0 0 33.33333%;-ms-flex:0 0 33.33333%;flex:0 0 33.33333%;max-width:33.33333%}
.col-lg-5{-webkit-box-flex:0;-webkit-flex:0 0 41.66667%;-ms-flex:0 0 41.66667%;flex:0 0 41.66667%;max-width:41.66667%}
.col-lg-6{-webkit-box-flex:0;-webkit-flex:0 0 50%;-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}
.col-lg-7{-webkit-box-flex:0;-webkit-flex:0 0 58.33333%;-ms-flex:0 0 58.33333%;flex:0 0 58.33333%;max-width:58.33333%}
.col-lg-8{-webkit-box-flex:0;-webkit-flex:0 0 66.66667%;-ms-flex:0 0 66.66667%;flex:0 0 66.66667%;max-width:66.66667%}
.col-lg-9{-webkit-box-flex:0;-webkit-flex:0 0 75%;-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}
.col-lg-10{-webkit-box-flex:0;-webkit-flex:0 0 83.33333%;-ms-flex:0 0 83.33333%;flex:0 0 83.33333%;max-width:83.33333%}
.col-lg-11{-webkit-box-flex:0;-webkit-flex:0 0 91.66667%;-ms-flex:0 0 91.66667%;flex:0 0 91.66667%;max-width:91.66667%}
.col-lg-12{-webkit-box-flex:0;-webkit-flex:0 0 100%;-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}
.order-lg-1{-webkit-box-ordinal-group:2;-webkit-order:1;-ms-flex-order:1;order:1}
.order-lg-2{-webkit-box-ordinal-group:3;-webkit-order:2;-ms-flex-order:2;order:2}
.order-lg-3{-webkit-box-ordinal-group:4;-webkit-order:3;-ms-flex-order:3;order:3}
.order-lg-4{-webkit-box-ordinal-group:5;-webkit-order:4;-ms-flex-order:4;order:4}
.order-lg-5{-webkit-box-ordinal-group:6;-webkit-order:5;-ms-flex-order:5;order:5}
.order-lg-6{-webkit-box-ordinal-group:7;-webkit-order:6;-ms-flex-order:6;order:6}
.order-lg-7{-webkit-box-ordinal-group:8;-webkit-order:7;-ms-flex-order:7;order:7}
.order-lg-8{-webkit-box-ordinal-group:9;-webkit-order:8;-ms-flex-order:8;order:8}
.order-lg-9{-webkit-box-ordinal-group:10;-webkit-order:9;-ms-flex-order:9;order:9}
.order-lg-10{-webkit-box-ordinal-group:11;-webkit-order:10;-ms-flex-order:10;order:10}
.order-lg-11{-webkit-box-ordinal-group:12;-webkit-order:11;-ms-flex-order:11;order:11}
.order-lg-12{-webkit-box-ordinal-group:13;-webkit-order:12;-ms-flex-order:12;order:12}
}
@media (min-width:1200px){.col-xl{-webkit-flex-basis:0;-ms-flex-preferred-size:0;flex-basis:0;-webkit-box-flex:1;-webkit-flex-grow:1;-ms-flex-positive:1;flex-grow:1;max-width:100%}
.col-xl-auto{-webkit-box-flex:0;-webkit-flex:0 0 auto;-ms-flex:0 0 auto;flex:0 0 auto;width:auto;max-width:none}
.col-xl-1{-webkit-box-flex:0;-webkit-flex:0 0 8.33333%;-ms-flex:0 0 8.33333%;flex:0 0 8.33333%;max-width:8.33333%}
.col-xl-2{-webkit-box-flex:0;-webkit-flex:0 0 16.66667%;-ms-flex:0 0 16.66667%;flex:0 0 16.66667%;max-width:16.66667%}
.col-xl-3{-webkit-box-flex:0;-webkit-flex:0 0 25%;-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}
.col-xl-4{-webkit-box-flex:0;-webkit-flex:0 0 33.33333%;-ms-flex:0 0 33.33333%;flex:0 0 33.33333%;max-width:33.33333%}
.col-xl-5{-webkit-box-flex:0;-webkit-flex:0 0 41.66667%;-ms-flex:0 0 41.66667%;flex:0 0 41.66667%;max-width:41.66667%}
.col-xl-6{-webkit-box-flex:0;-webkit-flex:0 0 50%;-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}
.col-xl-7{-webkit-box-flex:0;-webkit-flex:0 0 58.33333%;-ms-flex:0 0 58.33333%;flex:0 0 58.33333%;max-width:58.33333%}
.col-xl-8{-webkit-box-flex:0;-webkit-flex:0 0 66.66667%;-ms-flex:0 0 66.66667%;flex:0 0 66.66667%;max-width:66.66667%}
.col-xl-9{-webkit-box-flex:0;-webkit-flex:0 0 75%;-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}
.col-xl-10{-webkit-box-flex:0;-webkit-flex:0 0 83.33333%;-ms-flex:0 0 83.33333%;flex:0 0 83.33333%;max-width:83.33333%}
.col-xl-11{-webkit-box-flex:0;-webkit-flex:0 0 91.66667%;-ms-flex:0 0 91.66667%;flex:0 0 91.66667%;max-width:91.66667%}
.col-xl-12{-webkit-box-flex:0;-webkit-flex:0 0 100%;-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}
.order-xl-1{-webkit-box-ordinal-group:2;-webkit-order:1;-ms-flex-order:1;order:1}
.order-xl-2{-webkit-box-ordinal-group:3;-webkit-order:2;-ms-flex-order:2;order:2}
.order-xl-3{-webkit-box-ordinal-group:4;-webkit-order:3;-ms-flex-order:3;order:3}
.order-xl-4{-webkit-box-ordinal-group:5;-webkit-order:4;-ms-flex-order:4;order:4}
.order-xl-5{-webkit-box-ordinal-group:6;-webkit-order:5;-ms-flex-order:5;order:5}
.order-xl-6{-webkit-box-ordinal-group:7;-webkit-order:6;-ms-flex-order:6;order:6}
.order-xl-7{-webkit-box-ordinal-group:8;-webkit-order:7;-ms-flex-order:7;order:7}
.order-xl-8{-webkit-box-ordinal-group:9;-webkit-order:8;-ms-flex-order:8;order:8}
.order-xl-9{-webkit-box-ordinal-group:10;-webkit-order:9;-ms-flex-order:9;order:9}
.order-xl-10{-webkit-box-ordinal-group:11;-webkit-order:10;-ms-flex-order:10;order:10}
.order-xl-11{-webkit-box-ordinal-group:12;-webkit-order:11;-ms-flex-order:11;order:11}
.order-xl-12{-webkit-box-ordinal-group:13;-webkit-order:12;-ms-flex-order:12;order:12}
}
.table{width:100%;max-width:100%;margin-bottom:.4rem;background-color:transparent}
.table td,.table th{padding:.8rem;vertical-align:top;border-top:0 solid #e9ecef}
.table thead th{vertical-align:bottom;border-bottom:0 solid #e9ecef}
.table tbody+tbody{border-top:0 solid #e9ecef}
.table .table{background-color:#fff}
.table-sm td,.table-sm th{padding:.4rem}
.table-bordered{border:0 solid #e9ecef}
.table-bordered td,.table-bordered th{border:0 solid #e9ecef}
.table-bordered thead td,.table-bordered thead th{border-bottom-width:0}
.table-striped tbody tr:nth-of-type(odd){background-color:rgba(0,0,0,.05)}
.table-hover tbody tr:hover{background-color:rgba(0,0,0,.075)}
.table-primary,.table-primary>td,.table-primary>th{background-color:#c8cacf}
.table-hover .table-primary:hover{background-color:#babdc3}
.table-hover .table-primary:hover>td,.table-hover .table-primary:hover>th{background-color:#babdc3}
.table-secondary,.table-secondary>td,.table-secondary>th{background-color:#c1e2fc}
.table-hover .table-secondary:hover{background-color:#a9d7fb}
.table-hover .table-secondary:hover>td,.table-hover .table-secondary:hover>th{background-color:#a9d7fb}
.table-success,.table-success>td,.table-success>th{background-color:#cde9ce}
.table-hover .table-success:hover{background-color:#bbe1bd}
.table-hover .table-success:hover>td,.table-hover .table-success:hover>th{background-color:#bbe1bd}
.table-info,.table-info>td,.table-info>th{background-color:#b8e2de}
.table-hover .table-info:hover{background-color:#a6dbd6}
.table-hover .table-info:hover>td,.table-hover .table-info:hover>th{background-color:#a6dbd6}
.table-warning,.table-warning>td,.table-warning>th{background-color:#ffe2b8}
.table-hover .table-warning:hover{background-color:#ffd89f}
.table-hover .table-warning:hover>td,.table-hover .table-warning:hover>th{background-color:#ffd89f}
.table-danger,.table-danger>td,.table-danger>th{background-color:#fccac7}
.table-hover .table-danger:hover{background-color:#fbb3af}
.table-hover .table-danger:hover>td,.table-hover .table-danger:hover>th{background-color:#fbb3af}
.table-light,.table-light>td,.table-light>th{background-color:#fdfdfe}
.table-hover .table-light:hover{background-color:#ececf6}
.table-hover .table-light:hover>td,.table-hover .table-light:hover>th{background-color:#ececf6}
.table-dark,.table-dark>td,.table-dark>th{background-color:#c6c8ca}
.table-hover .table-dark:hover{background-color:#b9bbbe}
.table-hover .table-dark:hover>td,.table-hover .table-dark:hover>th{background-color:#b9bbbe}
.table-active,.table-active>td,.table-active>th{background-color:rgba(0,0,0,.075)}
.table-hover .table-active:hover{background-color:rgba(0,0,0,.075)}
.table-hover .table-active:hover>td,.table-hover .table-active:hover>th{background-color:rgba(0,0,0,.075)}
.thead-inverse th{color:#fff;background-color:#212529}
.thead-default th{color:#495057;background-color:#e9ecef}
.table-inverse{color:#fff;background-color:#212529}
.table-inverse td,.table-inverse th,.table-inverse thead th{border-color:#32383e}
.table-inverse.table-bordered{border:0}
.table-inverse.table-striped tbody tr:nth-of-type(odd){background-color:rgba(255,255,255,.05)}
.table-inverse.table-hover tbody tr:hover{background-color:rgba(255,255,255,.075)}
@media (max-width:991px){.table-responsive{display:block;width:100%;overflow-x:auto;-ms-overflow-style:-ms-autohiding-scrollbar}
.table-responsive.table-bordered{border:0}
}
.form-control{display:block;width:100%;padding:0 1.6rem;font-size:1.4rem;line-height:1.78571;color:#495057;background-color:transparent;background-image:none;background-clip:padding-box;border:0 solid transparent;-webkit-border-radius:0;border-radius:0;-webkit-box-shadow:0 1px 0 0 rgba(0,0,0,.42);box-shadow:0 1px 0 0 rgba(0,0,0,.42);-webkit-transition:border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;transition:border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s,-webkit-box-shadow ease-in-out .15s}
.form-control::-ms-expand{background-color:transparent;border:0}
.form-control:focus{color:#495057;background-color:transparent;border-color:none;outline:0;-webkit-box-shadow:0 2px 0 0 #3c4252;box-shadow:0 2px 0 0 #3c4252}
.form-control::-webkit-input-placeholder{color:rgba(0,0,0,.54);opacity:1}
.form-control::-moz-placeholder{color:rgba(0,0,0,.54);opacity:1}
.form-control:-ms-input-placeholder{color:rgba(0,0,0,.54);opacity:1}
.form-control::placeholder{color:rgba(0,0,0,.54);opacity:1}
.form-control:disabled,.form-control[readonly]{background-color:transparent;opacity:1}
select.form-control:not([size]):not([multiple]){height:-webkit-calc(2.5rem + 0px);height:calc(2.5rem + 0px)}
select.form-control:focus::-ms-value{color:#495057;background-color:transparent}
.form-control-file,.form-control-range{display:block}
.col-form-label{padding-top:-webkit-calc(0 - 0px * 2);padding-top:calc(0 - 0px * 2);padding-bottom:-webkit-calc(0 - 0px * 2);padding-bottom:calc(0 - 0px * 2);margin-bottom:0}
.col-form-label-lg{padding-top:-webkit-calc(0 - 0px * 2);padding-top:calc(0 - 0px * 2);padding-bottom:-webkit-calc(0 - 0px * 2);padding-bottom:calc(0 - 0px * 2);font-size:1.6rem}
.col-form-label-sm{padding-top:-webkit-calc(0 - 0px * 2);padding-top:calc(0 - 0px * 2);padding-bottom:-webkit-calc(0 - 0px * 2);padding-bottom:calc(0 - 0px * 2);font-size:1.3rem}
.col-form-legend{padding-top:0;padding-bottom:0;margin-bottom:0;font-size:1.4rem}
.form-control-plaintext{padding-top:0;padding-bottom:0;margin-bottom:0;line-height:1.78571;border:solid transparent;border-width:0}
.form-control-plaintext.form-control-lg,.form-control-plaintext.form-control-sm,.input-group-lg>.form-control-plaintext.form-control,.input-group-lg>.form-control-plaintext.input-group-addon,.input-group-lg>.input-group-btn>.form-control-plaintext.btn,.input-group-sm>.form-control-plaintext.form-control,.input-group-sm>.form-control-plaintext.input-group-addon,.input-group-sm>.input-group-btn>.form-control-plaintext.btn{padding-right:0;padding-left:0}
.form-control-sm,.input-group-sm>.form-control,.input-group-sm>.input-group-addon,.input-group-sm>.input-group-btn>.btn{padding:0 1.6rem;font-size:1.3rem;line-height:1.78571;-webkit-border-radius:2px;border-radius:2px}
.input-group-sm>.input-group-btn>select.btn:not([size]):not([multiple]),.input-group-sm>select.form-control:not([size]):not([multiple]),.input-group-sm>select.input-group-addon:not([size]):not([multiple]),select.form-control-sm:not([size]):not([multiple]){height:-webkit-calc(2.32143rem + 0px);height:calc(2.32143rem + 0px)}
.form-control-lg,.input-group-lg>.form-control,.input-group-lg>.input-group-addon,.input-group-lg>.input-group-btn>.btn{padding:0 1.6rem;font-size:1.6rem;line-height:2.25;-webkit-border-radius:2px;border-radius:2px}
.input-group-lg>.input-group-btn>select.btn:not([size]):not([multiple]),.input-group-lg>select.form-control:not([size]):not([multiple]),.input-group-lg>select.input-group-addon:not([size]):not([multiple]),select.form-control-lg:not([size]):not([multiple]){height:-webkit-calc(2.925rem + 0px);height:calc(2.925rem + 0px)}
.form-group{margin-bottom:0}
.form-text{display:block;margin-top:.8rem}
.form-row{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-5px;margin-left:-5px}
.form-row>.col,.form-row>[class*=col-]{padding-right:5px;padding-left:5px}
.form-check{position:relative;display:block;margin-bottom:.5rem}
.form-check.disabled .form-check-label{color:rgba(0,0,0,.38)}
.form-check-label{padding-left:0;margin-bottom:0}
.form-check-input{position:absolute;margin-top:0;margin-left:0}
.form-check-input:only-child{position:static}
.form-check-inline{display:inline-block}
.form-check-inline .form-check-label{vertical-align:middle}
.form-check-inline+.form-check-inline{margin-left:.75rem}
.invalid-feedback{display:none;margin-top:.25rem;font-size:.875rem;color:#f44336}
.invalid-tooltip{position:absolute;top:100%;z-index:5;display:none;width:250px;padding:.5rem;margin-top:.1rem;font-size:.875rem;line-height:1;color:#fff;background-color:rgba(244,67,54,.8);-webkit-border-radius:.2rem;border-radius:.2rem}
.custom-select.is-valid,.form-control.is-valid,.was-validated .custom-select:valid,.was-validated .form-control:valid{border-color:#4caf50}
.custom-select.is-valid:focus,.form-control.is-valid:focus,.was-validated .custom-select:valid:focus,.was-validated .form-control:valid:focus{-webkit-box-shadow:0 0 0 .2rem rgba(76,175,80,.25);box-shadow:0 0 0 .2rem rgba(76,175,80,.25)}
.custom-select.is-valid~.invalid-feedback,.custom-select.is-valid~.invalid-tooltip,.form-control.is-valid~.invalid-feedback,.form-control.is-valid~.invalid-tooltip,.was-validated .custom-select:valid~.invalid-feedback,.was-validated .custom-select:valid~.invalid-tooltip,.was-validated .form-control:valid~.invalid-feedback,.was-validated .form-control:valid~.invalid-tooltip{display:block}
.form-check-input.is-valid+.form-check-label,.was-validated .form-check-input:valid+.form-check-label{color:#4caf50}
.custom-control-input.is-valid~.custom-control-indicator,.was-validated .custom-control-input:valid~.custom-control-indicator{background-color:rgba(76,175,80,.25)}
.custom-control-input.is-valid~.custom-control-description,.was-validated .custom-control-input:valid~.custom-control-description{color:#4caf50}
.custom-file-input.is-valid~.custom-file-control,.was-validated .custom-file-input:valid~.custom-file-control{border-color:#4caf50}
.custom-file-input.is-valid~.custom-file-control::before,.was-validated .custom-file-input:valid~.custom-file-control::before{border-color:inherit}
.custom-file-input.is-valid:focus,.was-validated .custom-file-input:valid:focus{-webkit-box-shadow:0 0 0 .2rem rgba(76,175,80,.25);box-shadow:0 0 0 .2rem rgba(76,175,80,.25)}
.custom-select.is-invalid,.form-control.is-invalid,.was-validated .custom-select:invalid,.was-validated .form-control:invalid{border-color:#f44336}
.custom-select.is-invalid:focus,.form-control.is-invalid:focus,.was-validated .custom-select:invalid:focus,.was-validated .form-control:invalid:focus{-webkit-box-shadow:0 0 0 .2rem rgba(244,67,54,.25);box-shadow:0 0 0 .2rem rgba(244,67,54,.25)}
.custom-select.is-invalid~.invalid-feedback,.custom-select.is-invalid~.invalid-tooltip,.form-control.is-invalid~.invalid-feedback,.form-control.is-invalid~.invalid-tooltip,.was-validated .custom-select:invalid~.invalid-feedback,.was-validated .custom-select:invalid~.invalid-tooltip,.was-validated .form-control:invalid~.invalid-feedback,.was-validated .form-control:invalid~.invalid-tooltip{display:block}
.form-check-input.is-invalid+.form-check-label,.was-validated .form-check-input:invalid+.form-check-label{color:#f44336}
.custom-control-input.is-invalid~.custom-control-indicator,.was-validated .custom-control-input:invalid~.custom-control-indicator{background-color:rgba(244,67,54,.25)}
.custom-control-input.is-invalid~.custom-control-description,.was-validated .custom-control-input:invalid~.custom-control-description{color:#f44336}
.custom-file-input.is-invalid~.custom-file-control,.was-validated .custom-file-input:invalid~.custom-file-control{border-color:#f44336}
.custom-file-input.is-invalid~.custom-file-control::before,.was-validated .custom-file-input:invalid~.custom-file-control::before{border-color:inherit}
.custom-file-input.is-invalid:focus,.was-validated .custom-file-input:invalid:focus{-webkit-box-shadow:0 0 0 .2rem rgba(244,67,54,.25);box-shadow:0 0 0 .2rem rgba(244,67,54,.25)}
.form-inline{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-flow:row wrap;-ms-flex-flow:row wrap;flex-flow:row wrap;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}
.form-inline .form-check{width:100%}
@media (min-width:576px){.form-inline label{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;margin-bottom:0}
.form-inline .form-group{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-flex:0;-webkit-flex:0 0 auto;-ms-flex:0 0 auto;flex:0 0 auto;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-flow:row wrap;-ms-flex-flow:row wrap;flex-flow:row wrap;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;margin-bottom:0}
.form-inline .form-control{display:inline-block;width:auto;vertical-align:middle}
.form-inline .form-control-plaintext{display:inline-block}
.form-inline .input-group{width:auto}
.form-inline .form-control-label{margin-bottom:0;vertical-align:middle}
.form-inline .form-check{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;width:auto;margin-top:0;margin-bottom:0}
.form-inline .form-check-label{padding-left:0}
.form-inline .form-check-input{position:relative;margin-top:0;margin-right:1.2rem;margin-left:0}
.form-inline .custom-control{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;padding-left:0}
.form-inline .custom-control-indicator{position:static;display:inline-block;margin-right:1.2rem;vertical-align:text-bottom}
.form-inline .has-feedback .form-control-feedback{top:0}
}
.fade{opacity:0;-webkit-transition:opacity .15s linear;transition:opacity .15s linear}
.fade.show{opacity:1}
.collapse{display:none}
.collapse.show{display:block}
tr.collapse.show{display:table-row}
tbody.collapse.show{display:table-row-group}
.collapsing{position:relative;height:0;overflow:hidden;-webkit-transition:height .35s ease;transition:height .35s ease}
.dropdown,.dropup{position:relative}
.dropdown-toggle::after{display:inline-block;width:0;height:0;margin-left:.255em;vertical-align:.255em;content:"";border-top:.3em solid;border-right:.3em solid transparent;border-left:.3em solid transparent}
.dropdown-toggle:empty::after{margin-left:0}
.dropup .dropdown-menu{margin-top:0;margin-bottom:.25rem}
.dropup .dropdown-toggle::after{border-top:0;border-bottom:.3em solid}
.dropdown-menu{position:absolute;top:100%;left:0;z-index:1000;display:none;float:left;min-width:10rem;padding:.5rem 0;margin:.25rem 0 0;font-size:1.4rem;color:#212529;text-align:left;list-style:none;background-color:#fff;background-clip:padding-box;border:0 solid rgba(0,0,0,.15);-webkit-border-radius:2px;border-radius:2px;-webkit-box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12);box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12)}
.dropdown-divider{height:0;margin:.2rem 0;overflow:hidden;border-top:1px solid rgba(0,0,0,.12)}
.dropdown-item{display:block;width:100%;padding:0 1.6rem;clear:both;font-weight:400;color:rgba(0,0,0,.87);text-align:inherit;white-space:nowrap;background:0 0;border:0}
.dropdown-item:focus,.dropdown-item:hover{color:rgba(0,0,0,.87);text-decoration:none;background-color:#f8f9fa}
.dropdown-item.active,.dropdown-item:active{color:rgba(0,0,0,.87);text-decoration:none;background-color:#f8f9fa}
.dropdown-item.disabled,.dropdown-item:disabled{color:#868e96;background-color:transparent}
.show>a{outline:0}
.dropdown-menu.show{display:block}
.dropdown-header{display:block;padding:.5rem 1.6rem;margin-bottom:0;font-size:1.3rem;color:#868e96;white-space:nowrap}
.btn-group,.btn-group-vertical{position:relative;display:-webkit-inline-box;display:-webkit-inline-flex;display:-ms-inline-flexbox;display:inline-flex;vertical-align:middle}
.btn-group-vertical>.btn,.btn-group>.btn{position:relative;-webkit-box-flex:0;-webkit-flex:0 1 auto;-ms-flex:0 1 auto;flex:0 1 auto;margin-bottom:0}
.btn-group-vertical>.btn:hover,.btn-group>.btn:hover{z-index:2}
.btn-group-vertical>.btn.active,.btn-group-vertical>.btn:active,.btn-group-vertical>.btn:focus,.btn-group>.btn.active,.btn-group>.btn:active,.btn-group>.btn:focus{z-index:2}
.btn-group .btn+.btn,.btn-group .btn+.btn-group,.btn-group .btn-group+.btn,.btn-group .btn-group+.btn-group,.btn-group-vertical .btn+.btn,.btn-group-vertical .btn+.btn-group,.btn-group-vertical .btn-group+.btn,.btn-group-vertical .btn-group+.btn-group{margin-left:0}
.btn-toolbar{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:start;-webkit-justify-content:flex-start;-ms-flex-pack:start;justify-content:flex-start}
.btn-toolbar .input-group{width:auto}
.btn-group>.btn:not(:first-child):not(:last-child):not(.dropdown-toggle){-webkit-border-radius:0;border-radius:0}
.btn-group>.btn:first-child{margin-left:0}
.btn-group>.btn:first-child:not(:last-child):not(.dropdown-toggle){-webkit-border-top-right-radius:0;border-top-right-radius:0;-webkit-border-bottom-right-radius:0;border-bottom-right-radius:0}
.btn-group>.btn:last-child:not(:first-child),.btn-group>.dropdown-toggle:not(:first-child){-webkit-border-top-left-radius:0;border-top-left-radius:0;-webkit-border-bottom-left-radius:0;border-bottom-left-radius:0}
.btn-group>.btn-group{float:left}
.btn-group>.btn-group:not(:first-child):not(:last-child)>.btn{-webkit-border-radius:0;border-radius:0}
.btn-group>.btn-group:first-child:not(:last-child)>.btn:last-child,.btn-group>.btn-group:first-child:not(:last-child)>.dropdown-toggle{-webkit-border-top-right-radius:0;border-top-right-radius:0;-webkit-border-bottom-right-radius:0;border-bottom-right-radius:0}
.btn-group>.btn-group:last-child:not(:first-child)>.btn:first-child{-webkit-border-top-left-radius:0;border-top-left-radius:0;-webkit-border-bottom-left-radius:0;border-bottom-left-radius:0}
.btn+.dropdown-toggle-split{padding-right:1.2rem;padding-left:1.2rem}
.btn+.dropdown-toggle-split::after{margin-left:0}
.btn-group-sm>.btn+.dropdown-toggle-split,.btn-sm+.dropdown-toggle-split{padding-right:1.2rem;padding-left:1.2rem}
.btn-group-lg>.btn+.dropdown-toggle-split,.btn-lg+.dropdown-toggle-split{padding-right:1.2rem;padding-left:1.2rem}
.btn-group.show .dropdown-toggle{-webkit-box-shadow:none;box-shadow:none}
.btn-group.show .dropdown-toggle.btn-link{-webkit-box-shadow:none;box-shadow:none}
.btn-group-vertical{display:-webkit-inline-box;display:-webkit-inline-flex;display:-ms-inline-flexbox;display:inline-flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;-webkit-box-align:start;-webkit-align-items:flex-start;-ms-flex-align:start;align-items:flex-start;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center}
.btn-group-vertical .btn,.btn-group-vertical .btn-group{width:100%}
.btn-group-vertical>.btn+.btn,.btn-group-vertical>.btn+.btn-group,.btn-group-vertical>.btn-group+.btn,.btn-group-vertical>.btn-group+.btn-group{margin-top:0;margin-left:0}
.btn-group-vertical>.btn:not(:first-child):not(:last-child){-webkit-border-radius:0;border-radius:0}
.btn-group-vertical>.btn:first-child:not(:last-child){-webkit-border-bottom-right-radius:0;border-bottom-right-radius:0;-webkit-border-bottom-left-radius:0;border-bottom-left-radius:0}
.btn-group-vertical>.btn:last-child:not(:first-child){-webkit-border-top-left-radius:0;border-top-left-radius:0;-webkit-border-top-right-radius:0;border-top-right-radius:0}
.btn-group-vertical>.btn-group:not(:first-child):not(:last-child)>.btn{-webkit-border-radius:0;border-radius:0}
.btn-group-vertical>.btn-group:first-child:not(:last-child)>.btn:last-child,.btn-group-vertical>.btn-group:first-child:not(:last-child)>.dropdown-toggle{-webkit-border-bottom-right-radius:0;border-bottom-right-radius:0;-webkit-border-bottom-left-radius:0;border-bottom-left-radius:0}
.btn-group-vertical>.btn-group:last-child:not(:first-child)>.btn:first-child{-webkit-border-top-left-radius:0;border-top-left-radius:0;-webkit-border-top-right-radius:0;border-top-right-radius:0}
[data-toggle=buttons]>.btn input[type=checkbox],[data-toggle=buttons]>.btn input[type=radio],[data-toggle=buttons]>.btn-group>.btn input[type=checkbox],[data-toggle=buttons]>.btn-group>.btn input[type=radio]{position:absolute;clip:rect(0,0,0,0);pointer-events:none}
.input-group{position:relative;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;width:100%}
.input-group .form-control{position:relative;z-index:2;-webkit-box-flex:1;-webkit-flex:1 1 auto;-ms-flex:1 1 auto;flex:1 1 auto;width:1%;margin-bottom:0}
.input-group .form-control:active,.input-group .form-control:focus,.input-group .form-control:hover{z-index:3}
.input-group .form-control,.input-group-addon,.input-group-btn{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}
.input-group .form-control:not(:first-child):not(:last-child),.input-group-addon:not(:first-child):not(:last-child),.input-group-btn:not(:first-child):not(:last-child){-webkit-border-radius:0;border-radius:0}
.input-group-addon,.input-group-btn{white-space:nowrap;vertical-align:middle}
.input-group-addon{padding:0 1.6rem;margin-bottom:0;font-size:1.4rem;font-weight:400;line-height:1.78571;color:#495057;text-align:center;background-color:transparent;border:0 solid transparent;-webkit-border-radius:0;border-radius:0}
.input-group-addon.form-control-sm,.input-group-sm>.input-group-addon,.input-group-sm>.input-group-btn>.input-group-addon.btn{padding:0 1.6rem;font-size:1.3rem;-webkit-border-radius:2px;border-radius:2px}
.input-group-addon.form-control-lg,.input-group-lg>.input-group-addon,.input-group-lg>.input-group-btn>.input-group-addon.btn{padding:0 1.6rem;font-size:1.6rem;-webkit-border-radius:2px;border-radius:2px}
.input-group-addon input[type=checkbox],.input-group-addon input[type=radio]{margin-top:0}
.input-group .form-control:not(:last-child),.input-group-addon:not(:last-child),.input-group-btn:not(:first-child)>.btn-group:not(:last-child)>.btn,.input-group-btn:not(:first-child)>.btn:not(:last-child):not(.dropdown-toggle),.input-group-btn:not(:last-child)>.btn,.input-group-btn:not(:last-child)>.btn-group>.btn,.input-group-btn:not(:last-child)>.dropdown-toggle{-webkit-border-top-right-radius:0;border-top-right-radius:0;-webkit-border-bottom-right-radius:0;border-bottom-right-radius:0}
.input-group-addon:not(:last-child){border-right:0}
.input-group .form-control:not(:first-child),.input-group-addon:not(:first-child),.input-group-btn:not(:first-child)>.btn,.input-group-btn:not(:first-child)>.btn-group>.btn,.input-group-btn:not(:first-child)>.dropdown-toggle,.input-group-btn:not(:last-child)>.btn-group:not(:first-child)>.btn,.input-group-btn:not(:last-child)>.btn:not(:first-child){-webkit-border-top-left-radius:0;border-top-left-radius:0;-webkit-border-bottom-left-radius:0;border-bottom-left-radius:0}
.form-control+.input-group-addon:not(:first-child){border-left:0}
.input-group-btn{position:relative;font-size:0;white-space:nowrap}
.input-group-btn>.btn{position:relative}
.input-group-btn>.btn+.btn{margin-left:0}
.input-group-btn>.btn:active,.input-group-btn>.btn:focus,.input-group-btn>.btn:hover{z-index:3}
.input-group-btn:not(:last-child)>.btn,.input-group-btn:not(:last-child)>.btn-group{margin-right:0}
.input-group-btn:not(:first-child)>.btn,.input-group-btn:not(:first-child)>.btn-group{z-index:2;margin-left:0}
.input-group-btn:not(:first-child)>.btn-group:active,.input-group-btn:not(:first-child)>.btn-group:focus,.input-group-btn:not(:first-child)>.btn-group:hover,.input-group-btn:not(:first-child)>.btn:active,.input-group-btn:not(:first-child)>.btn:focus,.input-group-btn:not(:first-child)>.btn:hover{z-index:3}
.custom-control{position:relative;display:-webkit-inline-box;display:-webkit-inline-flex;display:-ms-inline-flexbox;display:inline-flex;min-height:1.5rem;padding-left:1.5rem;margin-right:0}
.custom-control-input{position:absolute;z-index:-1;opacity:0}
.custom-control-input:checked~.custom-control-indicator{color:inherit;background-color:transparent;-webkit-box-shadow:none;box-shadow:none}
.custom-control-input:focus~.custom-control-indicator{-webkit-box-shadow:none;box-shadow:none}
.custom-control-input:active~.custom-control-indicator{color:inherit;background-color:transparent;-webkit-box-shadow:none;box-shadow:none}
.custom-control-input:disabled~.custom-control-indicator{background-color:transparent}
.custom-control-input:disabled~.custom-control-description{color:#868e96}
.custom-control-indicator{position:absolute;top:.25rem;left:0;display:block;width:1rem;height:1rem;pointer-events:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-color:transparent;background-repeat:no-repeat;background-position:center center;background-size:50% 50%;-webkit-box-shadow:none;box-shadow:none}
.custom-checkbox .custom-control-indicator{-webkit-border-radius:2px;border-radius:2px}
.custom-checkbox .custom-control-input:checked~.custom-control-indicator{background-image:none}
.custom-checkbox .custom-control-input:indeterminate~.custom-control-indicator{background-color:#3c4252;background-image:url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 4'%3E%3Cpath stroke='inherit' d='M0 2h4'/%3E%3C/svg%3E");-webkit-box-shadow:none;box-shadow:none}
.custom-radio .custom-control-indicator{-webkit-border-radius:50%;border-radius:50%}
.custom-radio .custom-control-input:checked~.custom-control-indicator{background-image:none}
.custom-controls-stacked{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column}
.custom-controls-stacked .custom-control{margin-bottom:.25rem}
.custom-controls-stacked .custom-control+.custom-control{margin-left:0}
.custom-select{display:inline-block;max-width:100%;height:-webkit-calc(2.5rem + 0px);height:calc(2.5rem + 0px);padding:0 2.4rem 0 0;line-height:1.78571;color:#495057;vertical-align:middle;background:#fff url(data:image/svg+xml,%3Csvg%20width%3D%2210px%22%20height%3D%225px%22%20viewBox%3D%227%2010%2010%205%22%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%3E%0A%20%20%20%20%3Cpolygon%20id%3D%22Shape%22%20stroke%3D%22none%22%20fill%3D%22%230%22%20fill-rule%3D%22evenodd%22%20opacity%3D%220.54%22%20points%3D%227%2010%2012%2015%2017%2010%22%3E%3C%2Fpolygon%3E%0A%3C%2Fsvg%3E) no-repeat right 0 center;background-size:right center;border:0 solid transparent;-webkit-border-radius:2px;border-radius:2px;-webkit-appearance:none;-moz-appearance:none;appearance:none}
.custom-select:focus{border-color:none;outline:0;-webkit-box-shadow:0 1px 0 0 #3c4252,inset 0 -1px 0 0 #3c4252;box-shadow:0 1px 0 0 #3c4252,inset 0 -1px 0 0 #3c4252}
.custom-select:focus::-ms-value{color:#495057;background-color:transparent}
.custom-select:disabled{color:#868e96;background-color:#e9ecef}
.custom-select::-ms-expand{opacity:0}
.custom-select-sm{height:-webkit-calc(2.32143rem + 0px);height:calc(2.32143rem + 0px);padding-top:0;padding-bottom:0;font-size:75%}
.custom-file{position:relative;display:inline-block;max-width:100%;height:3.6rem;margin-bottom:0}
.custom-file-input{min-width:14rem;max-width:100%;height:3.6rem;margin:0;opacity:0}
.custom-file-input:focus~.custom-file-control{-webkit-box-shadow:0 0 0 .075rem #fff,0 0 0 .2rem #3c4252;box-shadow:0 0 0 .075rem #fff,0 0 0 .2rem #3c4252}
.custom-file-control{position:absolute;top:0;right:0;left:0;z-index:5;height:3.6rem;padding:0 1.6rem;line-height:3.6rem;color:#495057;pointer-events:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-color:#fff;border:0 solid transparent;-webkit-border-radius:2px;border-radius:2px;-webkit-box-shadow:0 1px 0 0 rgba(0,0,0,.42);box-shadow:0 1px 0 0 rgba(0,0,0,.42)}
.custom-file-control:lang(en):empty::after{content:"Choose file..."}
.custom-file-control::before{position:absolute;top:0;right:0;bottom:0;z-index:6;display:block;height:3.6rem;padding:0 1.6rem;line-height:3.6rem;color:#fff;background-color:#e9ecef;border:0 solid transparent;-webkit-border-radius:0 2px 2px 0;border-radius:0 2px 2px 0}
.custom-file-control:lang(en)::before{content:"Browse"}
.nav{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;padding-left:0;margin-bottom:0;list-style:none}
.nav-link{display:block;padding:0 2.4rem}
.nav-link:focus,.nav-link:hover{text-decoration:none}
.nav-link.disabled{color:#868e96}
.nav-tabs{border-bottom:0 solid #ddd}
.nav-tabs .nav-item{margin-bottom:0}
.nav-tabs .nav-link{border:0 solid transparent;-webkit-border-top-left-radius:2px;border-top-left-radius:2px;-webkit-border-top-right-radius:2px;border-top-right-radius:2px}
.nav-tabs .nav-link:focus,.nav-tabs .nav-link:hover{border-color:#e9ecef #e9ecef #ddd}
.nav-tabs .nav-link.disabled{color:#868e96;background-color:transparent;border-color:transparent}
.nav-tabs .nav-item.show .nav-link,.nav-tabs .nav-link.active{color:#495057;background-color:#fff;border-color:#ddd #ddd #fff}
.nav-tabs .dropdown-menu{margin-top:0;-webkit-border-top-left-radius:0;border-top-left-radius:0;-webkit-border-top-right-radius:0;border-top-right-radius:0}
.nav-pills .nav-link{-webkit-border-radius:2px;border-radius:2px}
.nav-pills .nav-link.active,.show>.nav-pills .nav-link{color:#fff;background-color:#3c4252}
.nav-fill .nav-item{-webkit-box-flex:1;-webkit-flex:1 1 auto;-ms-flex:1 1 auto;flex:1 1 auto;text-align:center}
.nav-justified .nav-item{-webkit-flex-basis:0;-ms-flex-preferred-size:0;flex-basis:0;-webkit-box-flex:1;-webkit-flex-grow:1;-ms-flex-positive:1;flex-grow:1;text-align:center}
.tab-content>.tab-pane{display:none}
.tab-content>.active{display:block}
.navbar{position:relative;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between;padding:1.2rem 1.6rem}
.navbar>.container,.navbar>.container-fluid{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between}
.navbar-brand{display:inline-block;margin-right:1.6rem;font-size:1.6rem;line-height:inherit;white-space:nowrap}
.navbar-brand:focus,.navbar-brand:hover{text-decoration:none}
.navbar-nav{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;padding-left:0;margin-bottom:0;list-style:none}
.navbar-nav .nav-link{padding-right:0;padding-left:0}
.navbar-nav .dropdown-menu{position:static;float:none}
.navbar-text{display:inline-block;padding-top:0;padding-bottom:0}
.navbar-collapse{-webkit-flex-basis:100%;-ms-flex-preferred-size:100%;flex-basis:100%;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}
.navbar-toggler{padding:.25rem .75rem;font-size:1.6rem;line-height:1;background:0 0;border:0 solid transparent;-webkit-border-radius:2px;border-radius:2px}
.navbar-toggler:focus,.navbar-toggler:hover{text-decoration:none}
.navbar-toggler-icon{display:inline-block;width:1.5em;height:1.5em;vertical-align:middle;content:"";background:no-repeat center center;background-size:100% 100%}
@media (max-width:575px){.navbar-expand-sm>.container,.navbar-expand-sm>.container-fluid{padding-right:0;padding-left:0}
}
@media (min-width:576px){.navbar-expand-sm{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap;-webkit-box-pack:start;-webkit-justify-content:flex-start;-ms-flex-pack:start;justify-content:flex-start}
.navbar-expand-sm .navbar-nav{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row}
.navbar-expand-sm .navbar-nav .dropdown-menu{position:absolute}
.navbar-expand-sm .navbar-nav .dropdown-menu-right{right:0;left:auto}
.navbar-expand-sm .navbar-nav .nav-link{padding-right:.5rem;padding-left:.5rem}
.navbar-expand-sm>.container,.navbar-expand-sm>.container-fluid{-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap}
.navbar-expand-sm .navbar-collapse{display:-webkit-box!important;display:-webkit-flex!important;display:-ms-flexbox!important;display:flex!important}
.navbar-expand-sm .navbar-toggler{display:none}
}
@media (max-width:767px){.navbar-expand-md>.container,.navbar-expand-md>.container-fluid{padding-right:0;padding-left:0}
}
@media (min-width:768px){.navbar-expand-md{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap;-webkit-box-pack:start;-webkit-justify-content:flex-start;-ms-flex-pack:start;justify-content:flex-start}
.navbar-expand-md .navbar-nav{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row}
.navbar-expand-md .navbar-nav .dropdown-menu{position:absolute}
.navbar-expand-md .navbar-nav .dropdown-menu-right{right:0;left:auto}
.navbar-expand-md .navbar-nav .nav-link{padding-right:.5rem;padding-left:.5rem}
.navbar-expand-md>.container,.navbar-expand-md>.container-fluid{-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap}
.navbar-expand-md .navbar-collapse{display:-webkit-box!important;display:-webkit-flex!important;display:-ms-flexbox!important;display:flex!important}
.navbar-expand-md .navbar-toggler{display:none}
}
@media (max-width:991px){.navbar-expand-lg>.container,.navbar-expand-lg>.container-fluid{padding-right:0;padding-left:0}
}
@media (min-width:992px){.navbar-expand-lg{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap;-webkit-box-pack:start;-webkit-justify-content:flex-start;-ms-flex-pack:start;justify-content:flex-start}
.navbar-expand-lg .navbar-nav{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row}
.navbar-expand-lg .navbar-nav .dropdown-menu{position:absolute}
.navbar-expand-lg .navbar-nav .dropdown-menu-right{right:0;left:auto}
.navbar-expand-lg .navbar-nav .nav-link{padding-right:.5rem;padding-left:.5rem}
.navbar-expand-lg>.container,.navbar-expand-lg>.container-fluid{-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap}
.navbar-expand-lg .navbar-collapse{display:-webkit-box!important;display:-webkit-flex!important;display:-ms-flexbox!important;display:flex!important}
.navbar-expand-lg .navbar-toggler{display:none}
}
@media (max-width:1199px){.navbar-expand-xl>.container,.navbar-expand-xl>.container-fluid{padding-right:0;padding-left:0}
}
@media (min-width:1200px){.navbar-expand-xl{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap;-webkit-box-pack:start;-webkit-justify-content:flex-start;-ms-flex-pack:start;justify-content:flex-start}
.navbar-expand-xl .navbar-nav{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row}
.navbar-expand-xl .navbar-nav .dropdown-menu{position:absolute}
.navbar-expand-xl .navbar-nav .dropdown-menu-right{right:0;left:auto}
.navbar-expand-xl .navbar-nav .nav-link{padding-right:.5rem;padding-left:.5rem}
.navbar-expand-xl>.container,.navbar-expand-xl>.container-fluid{-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap}
.navbar-expand-xl .navbar-collapse{display:-webkit-box!important;display:-webkit-flex!important;display:-ms-flexbox!important;display:flex!important}
.navbar-expand-xl .navbar-toggler{display:none}
}
.navbar-expand{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap;-webkit-box-pack:start;-webkit-justify-content:flex-start;-ms-flex-pack:start;justify-content:flex-start}
.navbar-expand>.container,.navbar-expand>.container-fluid{padding-right:0;padding-left:0}
.navbar-expand .navbar-nav{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row}
.navbar-expand .navbar-nav .dropdown-menu{position:absolute}
.navbar-expand .navbar-nav .dropdown-menu-right{right:0;left:auto}
.navbar-expand .navbar-nav .nav-link{padding-right:.5rem;padding-left:.5rem}
.navbar-expand>.container,.navbar-expand>.container-fluid{-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap}
.navbar-expand .navbar-collapse{display:-webkit-box!important;display:-webkit-flex!important;display:-ms-flexbox!important;display:flex!important}
.navbar-expand .navbar-toggler{display:none}
.navbar-light .navbar-brand{color:rgba(0,0,0,.9)}
.navbar-light .navbar-brand:focus,.navbar-light .navbar-brand:hover{color:rgba(0,0,0,.9)}
.navbar-light .navbar-nav .nav-link{color:rgba(0,0,0,.5)}
.navbar-light .navbar-nav .nav-link:focus,.navbar-light .navbar-nav .nav-link:hover{color:rgba(0,0,0,.7)}
.navbar-light .navbar-nav .nav-link.disabled{color:rgba(0,0,0,.3)}
.navbar-light .navbar-nav .active>.nav-link,.navbar-light .navbar-nav .nav-link.active,.navbar-light .navbar-nav .nav-link.show,.navbar-light .navbar-nav .show>.nav-link{color:rgba(0,0,0,.9)}
.navbar-light .navbar-toggler{color:rgba(0,0,0,.5);border-color:rgba(0,0,0,.1)}
.navbar-light .navbar-toggler-icon{background-image:url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(0,0,0,0.5)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E")}
.navbar-light .navbar-text{color:rgba(0,0,0,.5)}
.navbar-dark .navbar-brand{color:#fff}
.navbar-dark .navbar-brand:focus,.navbar-dark .navbar-brand:hover{color:#fff}
.navbar-dark .navbar-nav .nav-link{color:rgba(255,255,255,.5)}
.navbar-dark .navbar-nav .nav-link:focus,.navbar-dark .navbar-nav .nav-link:hover{color:rgba(255,255,255,.75)}
.navbar-dark .navbar-nav .nav-link.disabled{color:rgba(255,255,255,.25)}
.navbar-dark .navbar-nav .active>.nav-link,.navbar-dark .navbar-nav .nav-link.active,.navbar-dark .navbar-nav .nav-link.show,.navbar-dark .navbar-nav .show>.nav-link{color:#fff}
.navbar-dark .navbar-toggler{color:rgba(255,255,255,.5);border-color:rgba(255,255,255,.1)}
.navbar-dark .navbar-toggler-icon{background-image:url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255,255,255,0.5)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E")}
.navbar-dark .navbar-text{color:rgba(255,255,255,.5)}
.card{position:relative;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:0 solid rgba(0,0,0,.125);-webkit-border-radius:0;border-radius:0}
.card-body{-webkit-box-flex:1;-webkit-flex:1 1 auto;-ms-flex:1 1 auto;flex:1 1 auto;padding:1.6rem}
.card-title{margin-bottom:.8rem}
.card-subtitle{margin-top:-.4rem;margin-bottom:0}
.card-text:last-child{margin-bottom:0}
.card-link:hover{text-decoration:none}
.card-link+.card-link{margin-left:1.6rem}
.card>.list-group:first-child .list-group-item:first-child{-webkit-border-top-left-radius:0;border-top-left-radius:0;-webkit-border-top-right-radius:0;border-top-right-radius:0}
.card>.list-group:last-child .list-group-item:last-child{-webkit-border-bottom-right-radius:0;border-bottom-right-radius:0;-webkit-border-bottom-left-radius:0;border-bottom-left-radius:0}
.card-header{padding:.8rem 1.6rem;margin-bottom:0;background-color:rgba(0,0,0,.03);border-bottom:0 solid rgba(0,0,0,.125)}
.card-header:first-child{-webkit-border-radius:0;border-radius:0}
.card-footer{padding:.8rem 1.6rem;background-color:rgba(0,0,0,.03);border-top:0 solid rgba(0,0,0,.125)}
.card-footer:last-child{-webkit-border-radius:0;border-radius:0}
.card-header-tabs{margin-right:-.8rem;margin-bottom:-.8rem;margin-left:-.8rem;border-bottom:0}
.card-header-pills{margin-right:-.8rem;margin-left:-.8rem}
.card-img-overlay{position:absolute;top:0;right:0;bottom:0;left:0;padding:1.25rem}
.card-img{width:100%;-webkit-border-radius:0;border-radius:0}
.card-img-top{width:100%;-webkit-border-top-left-radius:0;border-top-left-radius:0;-webkit-border-top-right-radius:0;border-top-right-radius:0}
.card-img-bottom{width:100%;-webkit-border-bottom-right-radius:0;border-bottom-right-radius:0;-webkit-border-bottom-left-radius:0;border-bottom-left-radius:0}
@media (min-width:576px){.card-deck{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-flow:row wrap;-ms-flex-flow:row wrap;flex-flow:row wrap;margin-right:-15px;margin-left:-15px}
.card-deck .card{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-flex:1;-webkit-flex:1 0 0;-ms-flex:1 0 0;flex:1 0 0;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;margin-right:15px;margin-left:15px}
}
@media (min-width:576px){.card-group{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-flow:row wrap;-ms-flex-flow:row wrap;flex-flow:row wrap}
.card-group .card{-webkit-box-flex:1;-webkit-flex:1 0 0;-ms-flex:1 0 0;flex:1 0 0}
.card-group .card+.card{margin-left:0;border-left:0}
.card-group .card:first-child{-webkit-border-top-right-radius:0;border-top-right-radius:0;-webkit-border-bottom-right-radius:0;border-bottom-right-radius:0}
.card-group .card:first-child .card-img-top{-webkit-border-top-right-radius:0;border-top-right-radius:0}
.card-group .card:first-child .card-img-bottom{-webkit-border-bottom-right-radius:0;border-bottom-right-radius:0}
.card-group .card:last-child{-webkit-border-top-left-radius:0;border-top-left-radius:0;-webkit-border-bottom-left-radius:0;border-bottom-left-radius:0}
.card-group .card:last-child .card-img-top{-webkit-border-top-left-radius:0;border-top-left-radius:0}
.card-group .card:last-child .card-img-bottom{-webkit-border-bottom-left-radius:0;border-bottom-left-radius:0}
.card-group .card:not(:first-child):not(:last-child){-webkit-border-radius:0;border-radius:0}
.card-group .card:not(:first-child):not(:last-child) .card-img-bottom,.card-group .card:not(:first-child):not(:last-child) .card-img-top{-webkit-border-radius:0;border-radius:0}
}
.card-columns .card{margin-bottom:.8rem}
@media (min-width:576px){.card-columns{-webkit-column-count:3;-moz-column-count:3;column-count:3;-webkit-column-gap:1.25rem;-moz-column-gap:1.25rem;column-gap:1.25rem}
.card-columns .card{display:inline-block;width:100%}
}
.breadcrumb{padding:.8rem 1.2rem;margin-bottom:1rem;list-style:none;background-color:transparent;-webkit-border-radius:2px;border-radius:2px}
.breadcrumb::after{display:block;clear:both;content:""}
.breadcrumb-item{float:left}
.breadcrumb-item+.breadcrumb-item::before{display:inline-block;padding-right:.8rem;padding-left:.8rem;color:#868e96;content:""}
.breadcrumb-item+.breadcrumb-item:hover::before{text-decoration:underline;text-decoration:none}
.breadcrumb-item.active{color:#868e96}
.pagination{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;padding-left:0;list-style:none;-webkit-border-radius:2px;border-radius:2px}
.page-item:first-child .page-link{margin-left:0;-webkit-border-top-left-radius:2px;border-top-left-radius:2px;-webkit-border-bottom-left-radius:2px;border-bottom-left-radius:2px}
.page-item:last-child .page-link{-webkit-border-top-right-radius:2px;border-top-right-radius:2px;-webkit-border-bottom-right-radius:2px;border-bottom-right-radius:2px}
.page-item.active .page-link{z-index:2;color:#fff;background-color:#3c4252;border-color:#3c4252}
.page-item.disabled .page-link{color:#868e96;pointer-events:none;background-color:#fff;border-color:#ddd}
.page-link{position:relative;display:block;padding:0 .4rem;margin-left:-1px;line-height:5.6rem;color:rgba(0,0,0,.54);background-color:#fff;border:0 solid #ddd}
.page-link:focus,.page-link:hover{color:rgba(0,0,0,.87);text-decoration:none;background-color:#e9ecef;border-color:#ddd}
.pagination-lg .page-link{padding:0 .4rem;font-size:1.6rem;line-height:2.25}
.pagination-lg .page-item:first-child .page-link{-webkit-border-top-left-radius:2px;border-top-left-radius:2px;-webkit-border-bottom-left-radius:2px;border-bottom-left-radius:2px}
.pagination-lg .page-item:last-child .page-link{-webkit-border-top-right-radius:2px;border-top-right-radius:2px;-webkit-border-bottom-right-radius:2px;border-bottom-right-radius:2px}
.pagination-sm .page-link{padding:0 .4rem;font-size:1.3rem;line-height:2.46154}
.pagination-sm .page-item:first-child .page-link{-webkit-border-top-left-radius:2px;border-top-left-radius:2px;-webkit-border-bottom-left-radius:2px;border-bottom-left-radius:2px}
.pagination-sm .page-item:last-child .page-link{-webkit-border-top-right-radius:2px;border-top-right-radius:2px;-webkit-border-bottom-right-radius:2px;border-bottom-right-radius:2px}
.badge{display:inline-block;padding:.25em .4em;font-size:86%;font-weight:400;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:baseline;-webkit-border-radius:2px;border-radius:2px}
.badge:empty{display:none}
.btn .badge{position:relative;top:-1px}
.badge-pill{padding-right:1.2rem;padding-left:1.2rem;-webkit-border-radius:1.2rem;border-radius:1.2rem}
.badge-primary{color:#fff;background-color:#3c4252}
.badge-primary[href]:focus,.badge-primary[href]:hover{color:#fff;text-decoration:none;background-color:#262a35}
.badge-secondary{color:#fff;background-color:#2196f3}
.badge-secondary[href]:focus,.badge-secondary[href]:hover{color:#fff;text-decoration:none;background-color:#0c7cd5}
.badge-success{color:#fff;background-color:#4caf50}
.badge-success[href]:focus,.badge-success[href]:hover{color:#fff;text-decoration:none;background-color:#3d8b40}
.badge-info{color:#fff;background-color:#009688}
.badge-info[href]:focus,.badge-info[href]:hover{color:#fff;text-decoration:none;background-color:#00635a}
.badge-warning{color:#111;background-color:#ff9800}
.badge-warning[href]:focus,.badge-warning[href]:hover{color:#111;text-decoration:none;background-color:#cc7a00}
.badge-danger{color:#fff;background-color:#f44336}
.badge-danger[href]:focus,.badge-danger[href]:hover{color:#fff;text-decoration:none;background-color:#ea1c0d}
.badge-light{color:#111;background-color:#f8f9fa}
.badge-light[href]:focus,.badge-light[href]:hover{color:#111;text-decoration:none;background-color:#dae0e5}
.badge-dark{color:#fff;background-color:#343a40}
.badge-dark[href]:focus,.badge-dark[href]:hover{color:#fff;text-decoration:none;background-color:#1d2124}
.jumbotron{padding:2rem 1rem;margin-bottom:2rem;background-color:#e9ecef;-webkit-border-radius:2px;border-radius:2px}
@media (min-width:576px){.jumbotron{padding:4rem 2rem}
}
.jumbotron-fluid{padding-right:0;padding-left:0;-webkit-border-radius:0;border-radius:0}
.alert{padding:1.6rem;margin-bottom:1.6rem;border:0 solid transparent;-webkit-border-radius:2px;border-radius:2px}
.alert-heading{color:inherit}
.alert-link{font-weight:700}
.alert-dismissible .close{position:relative;top:-1.6rem;right:-1.6rem;padding:1.6rem;color:inherit}
.alert-primary{color:#1f222b;background-color:#d8d9dc;border-color:#c8cacf}
.alert-primary hr{border-top-color:#babdc3}
.alert-primary .alert-link{color:#0a0b0d}
.alert-secondary{color:#114e7e;background-color:#d3eafd;border-color:#c1e2fc}
.alert-secondary hr{border-top-color:#a9d7fb}
.alert-secondary .alert-link{color:#0b3251}
.alert-success{color:#285b2a;background-color:#dbefdc;border-color:#cde9ce}
.alert-success hr{border-top-color:#bbe1bd}
.alert-success .alert-link{color:#18381a}
.alert-info{color:#004e47;background-color:#cceae7;border-color:#b8e2de}
.alert-info hr{border-top-color:#a6dbd6}
.alert-info .alert-link{color:#001b19}
.alert-warning{color:#854f00;background-color:#ffeacc;border-color:#ffe2b8}
.alert-warning hr{border-top-color:#ffd89f}
.alert-warning .alert-link{color:#523100}
.alert-danger{color:#7f231c;background-color:#fdd9d7;border-color:#fccac7}
.alert-danger hr{border-top-color:#fbb3af}
.alert-danger .alert-link{color:#551713}
.alert-light{color:#818182;background-color:#fefefe;border-color:#fdfdfe}
.alert-light hr{border-top-color:#ececf6}
.alert-light .alert-link{color:#686868}
.alert-dark{color:#1b1e21;background-color:#d6d8d9;border-color:#c6c8ca}
.alert-dark hr{border-top-color:#b9bbbe}
.alert-dark .alert-link{color:#040505}
@-webkit-keyframes progress-bar-stripes{from{background-position:1.6rem 0}
to{background-position:0 0}
}
@keyframes progress-bar-stripes{from{background-position:1.6rem 0}
to{background-position:0 0}
}
.progress{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;overflow:hidden;font-size:1.4rem;line-height:1.6rem;text-align:center;background-color:#e9ecef;-webkit-border-radius:2px;border-radius:2px;-webkit-box-shadow:none;box-shadow:none}
.progress-bar{height:1.6rem;line-height:1.6rem;color:#fff;background-color:#3c4252;-webkit-transition:width .6s ease;transition:width .6s ease}
.progress-bar-striped{background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-image:linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-size:1.6rem 1.6rem}
.progress-bar-animated{-webkit-animation:progress-bar-stripes 1s linear infinite;animation:progress-bar-stripes 1s linear infinite}
.media{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:start;-webkit-align-items:flex-start;-ms-flex-align:start;align-items:flex-start}
.media-body{-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1}
.list-group{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;padding-left:0;margin-bottom:0}
.list-group-item-action{width:100%;color:#495057;text-align:inherit}
.list-group-item-action:focus,.list-group-item-action:hover{color:#495057;text-decoration:none;background-color:#f8f9fa}
.list-group-item-action:active{color:#212529;background-color:#e9ecef}
.list-group-item{position:relative;display:block;padding:0 1.6rem;margin-bottom:0;background-color:#fff;border:0 solid rgba(0,0,0,.125)}
.list-group-item:first-child{-webkit-border-top-left-radius:2px;border-top-left-radius:2px;-webkit-border-top-right-radius:2px;border-top-right-radius:2px}
.list-group-item:last-child{margin-bottom:0;-webkit-border-bottom-right-radius:2px;border-bottom-right-radius:2px;-webkit-border-bottom-left-radius:2px;border-bottom-left-radius:2px}
.list-group-item:focus,.list-group-item:hover{text-decoration:none}
.list-group-item.disabled,.list-group-item:disabled{color:#868e96;background-color:#fff}
.list-group-item.active{z-index:2;color:#fff;background-color:#3c4252;border-color:#3c4252}
.list-group-flush .list-group-item{border-right:0;border-left:0;-webkit-border-radius:0;border-radius:0}
.list-group-flush:first-child .list-group-item:first-child{border-top:0}
.list-group-flush:last-child .list-group-item:last-child{border-bottom:0}
.list-group-item-primary{color:#1f222b;background-color:#c8cacf}
a.list-group-item-primary,button.list-group-item-primary{color:#1f222b}
a.list-group-item-primary:focus,a.list-group-item-primary:hover,button.list-group-item-primary:focus,button.list-group-item-primary:hover{color:#1f222b;background-color:#babdc3}
a.list-group-item-primary.active,button.list-group-item-primary.active{color:#fff;background-color:#1f222b;border-color:#1f222b}
.list-group-item-secondary{color:#114e7e;background-color:#c1e2fc}
a.list-group-item-secondary,button.list-group-item-secondary{color:#114e7e}
a.list-group-item-secondary:focus,a.list-group-item-secondary:hover,button.list-group-item-secondary:focus,button.list-group-item-secondary:hover{color:#114e7e;background-color:#a9d7fb}
a.list-group-item-secondary.active,button.list-group-item-secondary.active{color:#fff;background-color:#114e7e;border-color:#114e7e}
.list-group-item-success{color:#285b2a;background-color:#cde9ce}
a.list-group-item-success,button.list-group-item-success{color:#285b2a}
a.list-group-item-success:focus,a.list-group-item-success:hover,button.list-group-item-success:focus,button.list-group-item-success:hover{color:#285b2a;background-color:#bbe1bd}
a.list-group-item-success.active,button.list-group-item-success.active{color:#fff;background-color:#285b2a;border-color:#285b2a}
.list-group-item-info{color:#004e47;background-color:#b8e2de}
a.list-group-item-info,button.list-group-item-info{color:#004e47}
a.list-group-item-info:focus,a.list-group-item-info:hover,button.list-group-item-info:focus,button.list-group-item-info:hover{color:#004e47;background-color:#a6dbd6}
a.list-group-item-info.active,button.list-group-item-info.active{color:#fff;background-color:#004e47;border-color:#004e47}
.list-group-item-warning{color:#854f00;background-color:#ffe2b8}
a.list-group-item-warning,button.list-group-item-warning{color:#854f00}
a.list-group-item-warning:focus,a.list-group-item-warning:hover,button.list-group-item-warning:focus,button.list-group-item-warning:hover{color:#854f00;background-color:#ffd89f}
a.list-group-item-warning.active,button.list-group-item-warning.active{color:#fff;background-color:#854f00;border-color:#854f00}
.list-group-item-danger{color:#7f231c;background-color:#fccac7}
a.list-group-item-danger,button.list-group-item-danger{color:#7f231c}
a.list-group-item-danger:focus,a.list-group-item-danger:hover,button.list-group-item-danger:focus,button.list-group-item-danger:hover{color:#7f231c;background-color:#fbb3af}
a.list-group-item-danger.active,button.list-group-item-danger.active{color:#fff;background-color:#7f231c;border-color:#7f231c}
.list-group-item-light{color:#818182;background-color:#fdfdfe}
a.list-group-item-light,button.list-group-item-light{color:#818182}
a.list-group-item-light:focus,a.list-group-item-light:hover,button.list-group-item-light:focus,button.list-group-item-light:hover{color:#818182;background-color:#ececf6}
a.list-group-item-light.active,button.list-group-item-light.active{color:#fff;background-color:#818182;border-color:#818182}
.list-group-item-dark{color:#1b1e21;background-color:#c6c8ca}
a.list-group-item-dark,button.list-group-item-dark{color:#1b1e21}
a.list-group-item-dark:focus,a.list-group-item-dark:hover,button.list-group-item-dark:focus,button.list-group-item-dark:hover{color:#1b1e21;background-color:#b9bbbe}
a.list-group-item-dark.active,button.list-group-item-dark.active{color:#fff;background-color:#1b1e21;border-color:#1b1e21}
.close{float:right;font-size:2.1rem;font-weight:700;line-height:1;color:#000;text-shadow:0 1px 0 #fff;opacity:.5}
.close:focus,.close:hover{color:#000;text-decoration:none;opacity:.75}
button.close{padding:0;background:0 0;border:0;-webkit-appearance:none}
.modal-open{overflow:hidden}
.modal{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1050;display:none;overflow:hidden;outline:0}
.modal.fade .modal-dialog{-webkit-transition:-webkit-transform .3s ease-out;transition:-webkit-transform .3s ease-out;transition:transform .3s ease-out;transition:transform .3s ease-out,-webkit-transform .3s ease-out;-webkit-transform:translate(0,-25%);-ms-transform:translate(0,-25%);transform:translate(0,-25%)}
.modal.show .modal-dialog{-webkit-transform:translate(0,0);-ms-transform:translate(0,0);transform:translate(0,0)}
.modal-open .modal{overflow-x:hidden;overflow-y:auto}
.modal-dialog{position:relative;width:auto;margin:10px}
.modal-content{position:relative;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;background-color:#fff;background-clip:padding-box;border:0 solid rgba(0,0,0,.2);-webkit-border-radius:2px;border-radius:2px;-webkit-box-shadow:0 3px 9px rgba(0,0,0,.5);box-shadow:0 3px 9px rgba(0,0,0,.5);outline:0}
.modal-backdrop{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1040;background-color:#000}
.modal-backdrop.fade{opacity:0}
.modal-backdrop.show{opacity:.5}
.modal-header{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between;padding:15px;border-bottom:0 solid #e9ecef}
.modal-title{margin-bottom:0;line-height:1.5}
.modal-body{position:relative;-webkit-box-flex:1;-webkit-flex:1 1 auto;-ms-flex:1 1 auto;flex:1 1 auto;padding:15px}
.modal-footer{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:end;-webkit-justify-content:flex-end;-ms-flex-pack:end;justify-content:flex-end;padding:15px;border-top:0 solid #e9ecef}
.modal-footer>:not(:first-child){margin-left:.25rem}
.modal-footer>:not(:last-child){margin-right:.25rem}
.modal-scrollbar-measure{position:absolute;top:-9999px;width:50px;height:50px;overflow:scroll}
@media (min-width:576px){.modal-dialog{max-width:500px;margin:30px auto}
.modal-content{-webkit-box-shadow:0 5px 15px rgba(0,0,0,.5);box-shadow:0 5px 15px rgba(0,0,0,.5)}
.modal-sm{max-width:300px}
}
@media (min-width:992px){.modal-lg{max-width:800px}
}
.tooltip{position:absolute;z-index:1070;display:block;margin:0;font-style:normal;font-weight:400;line-height:1.5;text-align:left;text-align:start;text-decoration:none;text-shadow:none;text-transform:none;letter-spacing:normal;word-break:normal;word-spacing:normal;white-space:normal;line-break:auto;font-size:1.3rem;word-wrap:break-word;opacity:0}
.tooltip.show{opacity:.9}
.tooltip .arrow{position:absolute;display:block;width:5px;height:5px}
.tooltip.bs-tooltip-auto[x-placement^=top],.tooltip.bs-tooltip-top{padding:5px 0}
.tooltip.bs-tooltip-auto[x-placement^=top] .arrow,.tooltip.bs-tooltip-top .arrow{bottom:0}
.tooltip.bs-tooltip-auto[x-placement^=top] .arrow::before,.tooltip.bs-tooltip-top .arrow::before{margin-left:-3px;content:"";border-width:5px 5px 0;border-top-color:#000}
.tooltip.bs-tooltip-auto[x-placement^=right],.tooltip.bs-tooltip-right{padding:0 5px}
.tooltip.bs-tooltip-auto[x-placement^=right] .arrow,.tooltip.bs-tooltip-right .arrow{left:0}
.tooltip.bs-tooltip-auto[x-placement^=right] .arrow::before,.tooltip.bs-tooltip-right .arrow::before{margin-top:-3px;content:"";border-width:5px 5px 5px 0;border-right-color:#000}
.tooltip.bs-tooltip-auto[x-placement^=bottom],.tooltip.bs-tooltip-bottom{padding:5px 0}
.tooltip.bs-tooltip-auto[x-placement^=bottom] .arrow,.tooltip.bs-tooltip-bottom .arrow{top:0}
.tooltip.bs-tooltip-auto[x-placement^=bottom] .arrow::before,.tooltip.bs-tooltip-bottom .arrow::before{margin-left:-3px;content:"";border-width:0 5px 5px;border-bottom-color:#000}
.tooltip.bs-tooltip-auto[x-placement^=left],.tooltip.bs-tooltip-left{padding:0 5px}
.tooltip.bs-tooltip-auto[x-placement^=left] .arrow,.tooltip.bs-tooltip-left .arrow{right:0}
.tooltip.bs-tooltip-auto[x-placement^=left] .arrow::before,.tooltip.bs-tooltip-left .arrow::before{right:0;margin-top:-3px;content:"";border-width:5px 0 5px 5px;border-left-color:#000}
.tooltip .arrow::before{position:absolute;border-color:transparent;border-style:solid}
.tooltip-inner{max-width:200px;padding:3px 8px;color:#fff;text-align:center;background-color:#000;-webkit-border-radius:2px;border-radius:2px}
.popover{position:absolute;top:0;left:0;z-index:1060;display:block;max-width:276px;padding:1px;font-style:normal;font-weight:400;line-height:1.5;text-align:left;text-align:start;text-decoration:none;text-shadow:none;text-transform:none;letter-spacing:normal;word-break:normal;word-spacing:normal;white-space:normal;line-break:auto;font-size:1.3rem;word-wrap:break-word;background-color:#fff;background-clip:padding-box;border:0 solid rgba(0,0,0,.2);-webkit-border-radius:2px;border-radius:2px;-webkit-box-shadow:0 5px 10px rgba(0,0,0,.2);box-shadow:0 5px 10px rgba(0,0,0,.2)}
.popover .arrow{position:absolute;display:block;width:10px;height:5px}
.popover .arrow::after,.popover .arrow::before{position:absolute;display:block;border-color:transparent;border-style:solid}
.popover .arrow::before{content:"";border-width:11px}
.popover .arrow::after{content:"";border-width:11px}
.popover.bs-popover-auto[x-placement^=top],.popover.bs-popover-top{margin-bottom:10px}
.popover.bs-popover-auto[x-placement^=top] .arrow,.popover.bs-popover-top .arrow{bottom:0}
.popover.bs-popover-auto[x-placement^=top] .arrow::after,.popover.bs-popover-auto[x-placement^=top] .arrow::before,.popover.bs-popover-top .arrow::after,.popover.bs-popover-top .arrow::before{border-bottom-width:0}
.popover.bs-popover-auto[x-placement^=top] .arrow::before,.popover.bs-popover-top .arrow::before{bottom:-11px;margin-left:-6px;border-top-color:rgba(0,0,0,.25)}
.popover.bs-popover-auto[x-placement^=top] .arrow::after,.popover.bs-popover-top .arrow::after{bottom:-10px;margin-left:-6px;border-top-color:#fff}
.popover.bs-popover-auto[x-placement^=right],.popover.bs-popover-right{margin-left:10px}
.popover.bs-popover-auto[x-placement^=right] .arrow,.popover.bs-popover-right .arrow{left:0}
.popover.bs-popover-auto[x-placement^=right] .arrow::after,.popover.bs-popover-auto[x-placement^=right] .arrow::before,.popover.bs-popover-right .arrow::after,.popover.bs-popover-right .arrow::before{margin-top:-8px;border-left-width:0}
.popover.bs-popover-auto[x-placement^=right] .arrow::before,.popover.bs-popover-right .arrow::before{left:-11px;border-right-color:rgba(0,0,0,.25)}
.popover.bs-popover-auto[x-placement^=right] .arrow::after,.popover.bs-popover-right .arrow::after{left:-10px;border-right-color:#fff}
.popover.bs-popover-auto[x-placement^=bottom],.popover.bs-popover-bottom{margin-top:10px}
.popover.bs-popover-auto[x-placement^=bottom] .arrow,.popover.bs-popover-bottom .arrow{top:0}
.popover.bs-popover-auto[x-placement^=bottom] .arrow::after,.popover.bs-popover-auto[x-placement^=bottom] .arrow::before,.popover.bs-popover-bottom .arrow::after,.popover.bs-popover-bottom .arrow::before{margin-left:-7px;border-top-width:0}
.popover.bs-popover-auto[x-placement^=bottom] .arrow::before,.popover.bs-popover-bottom .arrow::before{top:-11px;border-bottom-color:rgba(0,0,0,.25)}
.popover.bs-popover-auto[x-placement^=bottom] .arrow::after,.popover.bs-popover-bottom .arrow::after{top:-10px;border-bottom-color:#fff}
.popover.bs-popover-auto[x-placement^=bottom] .popover-header::before,.popover.bs-popover-bottom .popover-header::before{position:absolute;top:0;left:50%;display:block;width:20px;margin-left:-10px;content:"";border-bottom:1px solid #f7f7f7}
.popover.bs-popover-auto[x-placement^=left],.popover.bs-popover-left{margin-right:10px}
.popover.bs-popover-auto[x-placement^=left] .arrow,.popover.bs-popover-left .arrow{right:0}
.popover.bs-popover-auto[x-placement^=left] .arrow::after,.popover.bs-popover-auto[x-placement^=left] .arrow::before,.popover.bs-popover-left .arrow::after,.popover.bs-popover-left .arrow::before{margin-top:-8px;border-right-width:0}
.popover.bs-popover-auto[x-placement^=left] .arrow::before,.popover.bs-popover-left .arrow::before{right:-11px;border-left-color:rgba(0,0,0,.25)}
.popover.bs-popover-auto[x-placement^=left] .arrow::after,.popover.bs-popover-left .arrow::after{right:-10px;border-left-color:#fff}
.popover-header{padding:8px 14px;margin-bottom:0;font-size:1.4rem;color:inherit;background-color:#f7f7f7;border-bottom:0 solid #ebebeb;-webkit-border-top-left-radius:-webkit-calc(2px - 0px);border-top-left-radius:calc(2px - 0px);-webkit-border-top-right-radius:-webkit-calc(2px - 0px);border-top-right-radius:calc(2px - 0px)}
.popover-header:empty{display:none}
.popover-body{padding:9px 14px;color:#212529}
.carousel{position:relative}
.carousel-inner{position:relative;width:100%;overflow:hidden}
.carousel-item{position:relative;display:none;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;width:100%;-webkit-transition:-webkit-transform .6s ease-in-out;transition:-webkit-transform .6s ease-in-out;transition:transform .6s ease-in-out;transition:transform .6s ease-in-out,-webkit-transform .6s ease-in-out;-webkit-backface-visibility:hidden;backface-visibility:hidden;-webkit-perspective:1000px;perspective:1000px}
.carousel-item-next,.carousel-item-prev,.carousel-item.active{display:block}
.carousel-item-next,.carousel-item-prev{position:absolute;top:0}
.carousel-item-next.carousel-item-left,.carousel-item-prev.carousel-item-right{-webkit-transform:translateX(0);-ms-transform:translateX(0);transform:translateX(0)}
.active.carousel-item-right,.carousel-item-next{-webkit-transform:translateX(100%);-ms-transform:translateX(100%);transform:translateX(100%)}
.active.carousel-item-left,.carousel-item-prev{-webkit-transform:translateX(-100%);-ms-transform:translateX(-100%);transform:translateX(-100%)}
.carousel-control-next,.carousel-control-prev{position:absolute;top:0;bottom:0;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;width:15%;color:#fff;text-align:center;opacity:.5}
.carousel-control-next:focus,.carousel-control-next:hover,.carousel-control-prev:focus,.carousel-control-prev:hover{color:#fff;text-decoration:none;outline:0;opacity:.9}
.carousel-control-prev{left:0}
.carousel-control-next{right:0}
.carousel-control-next-icon,.carousel-control-prev-icon{display:inline-block;width:20px;height:20px;background:transparent no-repeat center center;background-size:100% 100%}
.carousel-control-prev-icon{background-image:url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23FFF' viewBox='0 0 8 8'%3E%3Cpath d='M4 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E")}
.carousel-control-next-icon{background-image:url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23FFF' viewBox='0 0 8 8'%3E%3Cpath d='M1.5 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E")}
.carousel-indicators{position:absolute;right:0;bottom:10px;left:0;z-index:15;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;padding-left:0;margin-right:15%;margin-left:15%;list-style:none}
.carousel-indicators li{position:relative;-webkit-box-flex:0;-webkit-flex:0 1 auto;-ms-flex:0 1 auto;flex:0 1 auto;width:30px;height:3px;margin-right:3px;margin-left:3px;text-indent:-999px;background-color:rgba(255,255,255,.5)}
.carousel-indicators li::before{position:absolute;top:-10px;left:0;display:inline-block;width:100%;height:10px;content:""}
.carousel-indicators li::after{position:absolute;bottom:-10px;left:0;display:inline-block;width:100%;height:10px;content:""}
.carousel-indicators .active{background-color:#fff}
.carousel-caption{position:absolute;right:15%;bottom:20px;left:15%;z-index:10;padding-top:20px;padding-bottom:20px;color:#fff;text-align:center}
.align-baseline{vertical-align:baseline!important}
.align-top{vertical-align:top!important}
.align-middle{vertical-align:middle!important}
.align-bottom{vertical-align:bottom!important}
.align-text-bottom{vertical-align:text-bottom!important}
.align-text-top{vertical-align:text-top!important}
.bg-primary{background-color:#3c4252!important}
a.bg-primary:focus,a.bg-primary:hover{background-color:#262a35!important}
.bg-secondary{background-color:#2196f3!important}
a.bg-secondary:focus,a.bg-secondary:hover{background-color:#0c7cd5!important}
.bg-success{background-color:#4caf50!important}
a.bg-success:focus,a.bg-success:hover{background-color:#3d8b40!important}
.bg-info{background-color:#009688!important}
a.bg-info:focus,a.bg-info:hover{background-color:#00635a!important}
.bg-warning{background-color:#ff9800!important}
a.bg-warning:focus,a.bg-warning:hover{background-color:#cc7a00!important}
.bg-danger{background-color:#f44336!important}
a.bg-danger:focus,a.bg-danger:hover{background-color:#ea1c0d!important}
.bg-light{background-color:#f8f9fa!important}
a.bg-light:focus,a.bg-light:hover{background-color:#dae0e5!important}
.bg-dark{background-color:#343a40!important}
a.bg-dark:focus,a.bg-dark:hover{background-color:#1d2124!important}
.bg-white{background-color:#fff!important}
.bg-transparent{background-color:transparent!important}
.border{border:1px solid #e9ecef!important}
.border-0{border:0!important}
.border-top-0{border-top:0!important}
.border-right-0{border-right:0!important}
.border-bottom-0{border-bottom:0!important}
.border-left-0{border-left:0!important}
.border-primary{border-color:#3c4252!important}
.border-secondary{border-color:#2196f3!important}
.border-success{border-color:#4caf50!important}
.border-info{border-color:#009688!important}
.border-warning{border-color:#ff9800!important}
.border-danger{border-color:#f44336!important}
.border-light{border-color:#f8f9fa!important}
.border-dark{border-color:#343a40!important}
.border-white{border-color:#fff!important}
.rounded{-webkit-border-radius:2px!important;border-radius:2px!important}
.rounded-top{-webkit-border-top-left-radius:2px!important;border-top-left-radius:2px!important;-webkit-border-top-right-radius:2px!important;border-top-right-radius:2px!important}
.rounded-right{-webkit-border-top-right-radius:2px!important;border-top-right-radius:2px!important;-webkit-border-bottom-right-radius:2px!important;border-bottom-right-radius:2px!important}
.rounded-bottom{-webkit-border-bottom-right-radius:2px!important;border-bottom-right-radius:2px!important;-webkit-border-bottom-left-radius:2px!important;border-bottom-left-radius:2px!important}
.rounded-left{-webkit-border-top-left-radius:2px!important;border-top-left-radius:2px!important;-webkit-border-bottom-left-radius:2px!important;border-bottom-left-radius:2px!important}
.rounded-circle{-webkit-border-radius:50%;border-radius:50%}
.rounded-0{-webkit-border-radius:0;border-radius:0}
.clearfix::after{display:block;clear:both!important;content:""}
.d-none{display:none!important}
.d-inline{display:inline!important}
.d-inline-block{display:inline-block!important}
.d-block{display:block!important}
.d-table{display:table!important}
.d-table-cell{display:table-cell!important}
.d-flex{display:-webkit-box!important;display:-webkit-flex!important;display:-ms-flexbox!important;display:flex!important}
.d-inline-flex{display:-webkit-inline-box!important;display:-webkit-inline-flex!important;display:-ms-inline-flexbox!important;display:inline-flex!important}
@media (min-width:576px){.d-sm-none{display:none!important}
.d-sm-inline{display:inline!important}
.d-sm-inline-block{display:inline-block!important}
.d-sm-block{display:block!important}
.d-sm-table{display:table!important}
.d-sm-table-cell{display:table-cell!important}
.d-sm-flex{display:-webkit-box!important;display:-webkit-flex!important;display:-ms-flexbox!important;display:flex!important}
.d-sm-inline-flex{display:-webkit-inline-box!important;display:-webkit-inline-flex!important;display:-ms-inline-flexbox!important;display:inline-flex!important}
}
@media (min-width:768px){.d-md-none{display:none!important}
.d-md-inline{display:inline!important}
.d-md-inline-block{display:inline-block!important}
.d-md-block{display:block!important}
.d-md-table{display:table!important}
.d-md-table-cell{display:table-cell!important}
.d-md-flex{display:-webkit-box!important;display:-webkit-flex!important;display:-ms-flexbox!important;display:flex!important}
.d-md-inline-flex{display:-webkit-inline-box!important;display:-webkit-inline-flex!important;display:-ms-inline-flexbox!important;display:inline-flex!important}
}
@media (min-width:992px){.d-lg-none{display:none!important}
.d-lg-inline{display:inline!important}
.d-lg-inline-block{display:inline-block!important}
.d-lg-block{display:block!important}
.d-lg-table{display:table!important}
.d-lg-table-cell{display:table-cell!important}
.d-lg-flex{display:-webkit-box!important;display:-webkit-flex!important;display:-ms-flexbox!important;display:flex!important}
.d-lg-inline-flex{display:-webkit-inline-box!important;display:-webkit-inline-flex!important;display:-ms-inline-flexbox!important;display:inline-flex!important}
}
@media (min-width:1200px){.d-xl-none{display:none!important}
.d-xl-inline{display:inline!important}
.d-xl-inline-block{display:inline-block!important}
.d-xl-block{display:block!important}
.d-xl-table{display:table!important}
.d-xl-table-cell{display:table-cell!important}
.d-xl-flex{display:-webkit-box!important;display:-webkit-flex!important;display:-ms-flexbox!important;display:flex!important}
.d-xl-inline-flex{display:-webkit-inline-box!important;display:-webkit-inline-flex!important;display:-ms-inline-flexbox!important;display:inline-flex!important}
}
.d-print-block{display:none!important}
@media print{.d-print-block{display:block!important}
}
.d-print-inline{display:none!important}
@media print{.d-print-inline{display:inline!important}
}
.d-print-inline-block{display:none!important}
@media print{.d-print-inline-block{display:inline-block!important}
}
@media print{.d-print-none{display:none!important}
}
.embed-responsive{position:relative;display:block;width:100%;padding:0;overflow:hidden}
.embed-responsive::before{display:block;content:""}
.embed-responsive .embed-responsive-item,.embed-responsive embed,.embed-responsive iframe,.embed-responsive object,.embed-responsive video{position:absolute;top:0;bottom:0;left:0;width:100%;height:100%;border:0}
.embed-responsive-21by9::before{padding-top:42.85714%}
.embed-responsive-16by9::before{padding-top:56.25%}
.embed-responsive-4by3::before{padding-top:75%}
.embed-responsive-1by1::before{padding-top:100%}
.flex-row{-webkit-box-orient:horizontal!important;-webkit-box-direction:normal!important;-webkit-flex-direction:row!important;-ms-flex-direction:row!important;flex-direction:row!important}
.flex-column{-webkit-box-orient:vertical!important;-webkit-box-direction:normal!important;-webkit-flex-direction:column!important;-ms-flex-direction:column!important;flex-direction:column!important}
.flex-row-reverse{-webkit-box-orient:horizontal!important;-webkit-box-direction:reverse!important;-webkit-flex-direction:row-reverse!important;-ms-flex-direction:row-reverse!important;flex-direction:row-reverse!important}
.flex-column-reverse{-webkit-box-orient:vertical!important;-webkit-box-direction:reverse!important;-webkit-flex-direction:column-reverse!important;-ms-flex-direction:column-reverse!important;flex-direction:column-reverse!important}
.flex-wrap{-webkit-flex-wrap:wrap!important;-ms-flex-wrap:wrap!important;flex-wrap:wrap!important}
.flex-nowrap{-webkit-flex-wrap:nowrap!important;-ms-flex-wrap:nowrap!important;flex-wrap:nowrap!important}
.flex-wrap-reverse{-webkit-flex-wrap:wrap-reverse!important;-ms-flex-wrap:wrap-reverse!important;flex-wrap:wrap-reverse!important}
.justify-content-start{-webkit-box-pack:start!important;-webkit-justify-content:flex-start!important;-ms-flex-pack:start!important;justify-content:flex-start!important}
.justify-content-end{-webkit-box-pack:end!important;-webkit-justify-content:flex-end!important;-ms-flex-pack:end!important;justify-content:flex-end!important}
.justify-content-center{-webkit-box-pack:center!important;-webkit-justify-content:center!important;-ms-flex-pack:center!important;justify-content:center!important}
.justify-content-between{-webkit-box-pack:justify!important;-webkit-justify-content:space-between!important;-ms-flex-pack:justify!important;justify-content:space-between!important}
.justify-content-around{-webkit-justify-content:space-around!important;-ms-flex-pack:distribute!important;justify-content:space-around!important}
.align-items-start{-webkit-box-align:start!important;-webkit-align-items:flex-start!important;-ms-flex-align:start!important;align-items:flex-start!important}
.align-items-end{-webkit-box-align:end!important;-webkit-align-items:flex-end!important;-ms-flex-align:end!important;align-items:flex-end!important}
.align-items-center{-webkit-box-align:center!important;-webkit-align-items:center!important;-ms-flex-align:center!important;align-items:center!important}
.align-items-baseline{-webkit-box-align:baseline!important;-webkit-align-items:baseline!important;-ms-flex-align:baseline!important;align-items:baseline!important}
.align-items-stretch{-webkit-box-align:stretch!important;-webkit-align-items:stretch!important;-ms-flex-align:stretch!important;align-items:stretch!important}
.align-content-start{-webkit-align-content:flex-start!important;-ms-flex-line-pack:start!important;align-content:flex-start!important}
.align-content-end{-webkit-align-content:flex-end!important;-ms-flex-line-pack:end!important;align-content:flex-end!important}
.align-content-center{-webkit-align-content:center!important;-ms-flex-line-pack:center!important;align-content:center!important}
.align-content-between{-webkit-align-content:space-between!important;-ms-flex-line-pack:justify!important;align-content:space-between!important}
.align-content-around{-webkit-align-content:space-around!important;-ms-flex-line-pack:distribute!important;align-content:space-around!important}
.align-content-stretch{-webkit-align-content:stretch!important;-ms-flex-line-pack:stretch!important;align-content:stretch!important}
.align-self-auto{-webkit-align-self:auto!important;-ms-flex-item-align:auto!important;-ms-grid-row-align:auto!important;align-self:auto!important}
.align-self-start{-webkit-align-self:flex-start!important;-ms-flex-item-align:start!important;align-self:flex-start!important}
.align-self-end{-webkit-align-self:flex-end!important;-ms-flex-item-align:end!important;align-self:flex-end!important}
.align-self-center{-webkit-align-self:center!important;-ms-flex-item-align:center!important;-ms-grid-row-align:center!important;align-self:center!important}
.align-self-baseline{-webkit-align-self:baseline!important;-ms-flex-item-align:baseline!important;align-self:baseline!important}
.align-self-stretch{-webkit-align-self:stretch!important;-ms-flex-item-align:stretch!important;-ms-grid-row-align:stretch!important;align-self:stretch!important}
@media (min-width:576px){.flex-sm-row{-webkit-box-orient:horizontal!important;-webkit-box-direction:normal!important;-webkit-flex-direction:row!important;-ms-flex-direction:row!important;flex-direction:row!important}
.flex-sm-column{-webkit-box-orient:vertical!important;-webkit-box-direction:normal!important;-webkit-flex-direction:column!important;-ms-flex-direction:column!important;flex-direction:column!important}
.flex-sm-row-reverse{-webkit-box-orient:horizontal!important;-webkit-box-direction:reverse!important;-webkit-flex-direction:row-reverse!important;-ms-flex-direction:row-reverse!important;flex-direction:row-reverse!important}
.flex-sm-column-reverse{-webkit-box-orient:vertical!important;-webkit-box-direction:reverse!important;-webkit-flex-direction:column-reverse!important;-ms-flex-direction:column-reverse!important;flex-direction:column-reverse!important}
.flex-sm-wrap{-webkit-flex-wrap:wrap!important;-ms-flex-wrap:wrap!important;flex-wrap:wrap!important}
.flex-sm-nowrap{-webkit-flex-wrap:nowrap!important;-ms-flex-wrap:nowrap!important;flex-wrap:nowrap!important}
.flex-sm-wrap-reverse{-webkit-flex-wrap:wrap-reverse!important;-ms-flex-wrap:wrap-reverse!important;flex-wrap:wrap-reverse!important}
.justify-content-sm-start{-webkit-box-pack:start!important;-webkit-justify-content:flex-start!important;-ms-flex-pack:start!important;justify-content:flex-start!important}
.justify-content-sm-end{-webkit-box-pack:end!important;-webkit-justify-content:flex-end!important;-ms-flex-pack:end!important;justify-content:flex-end!important}
.justify-content-sm-center{-webkit-box-pack:center!important;-webkit-justify-content:center!important;-ms-flex-pack:center!important;justify-content:center!important}
.justify-content-sm-between{-webkit-box-pack:justify!important;-webkit-justify-content:space-between!important;-ms-flex-pack:justify!important;justify-content:space-between!important}
.justify-content-sm-around{-webkit-justify-content:space-around!important;-ms-flex-pack:distribute!important;justify-content:space-around!important}
.align-items-sm-start{-webkit-box-align:start!important;-webkit-align-items:flex-start!important;-ms-flex-align:start!important;align-items:flex-start!important}
.align-items-sm-end{-webkit-box-align:end!important;-webkit-align-items:flex-end!important;-ms-flex-align:end!important;align-items:flex-end!important}
.align-items-sm-center{-webkit-box-align:center!important;-webkit-align-items:center!important;-ms-flex-align:center!important;align-items:center!important}
.align-items-sm-baseline{-webkit-box-align:baseline!important;-webkit-align-items:baseline!important;-ms-flex-align:baseline!important;align-items:baseline!important}
.align-items-sm-stretch{-webkit-box-align:stretch!important;-webkit-align-items:stretch!important;-ms-flex-align:stretch!important;align-items:stretch!important}
.align-content-sm-start{-webkit-align-content:flex-start!important;-ms-flex-line-pack:start!important;align-content:flex-start!important}
.align-content-sm-end{-webkit-align-content:flex-end!important;-ms-flex-line-pack:end!important;align-content:flex-end!important}
.align-content-sm-center{-webkit-align-content:center!important;-ms-flex-line-pack:center!important;align-content:center!important}
.align-content-sm-between{-webkit-align-content:space-between!important;-ms-flex-line-pack:justify!important;align-content:space-between!important}
.align-content-sm-around{-webkit-align-content:space-around!important;-ms-flex-line-pack:distribute!important;align-content:space-around!important}
.align-content-sm-stretch{-webkit-align-content:stretch!important;-ms-flex-line-pack:stretch!important;align-content:stretch!important}
.align-self-sm-auto{-webkit-align-self:auto!important;-ms-flex-item-align:auto!important;-ms-grid-row-align:auto!important;align-self:auto!important}
.align-self-sm-start{-webkit-align-self:flex-start!important;-ms-flex-item-align:start!important;align-self:flex-start!important}
.align-self-sm-end{-webkit-align-self:flex-end!important;-ms-flex-item-align:end!important;align-self:flex-end!important}
.align-self-sm-center{-webkit-align-self:center!important;-ms-flex-item-align:center!important;-ms-grid-row-align:center!important;align-self:center!important}
.align-self-sm-baseline{-webkit-align-self:baseline!important;-ms-flex-item-align:baseline!important;align-self:baseline!important}
.align-self-sm-stretch{-webkit-align-self:stretch!important;-ms-flex-item-align:stretch!important;-ms-grid-row-align:stretch!important;align-self:stretch!important}
}
@media (min-width:768px){.flex-md-row{-webkit-box-orient:horizontal!important;-webkit-box-direction:normal!important;-webkit-flex-direction:row!important;-ms-flex-direction:row!important;flex-direction:row!important}
.flex-md-column{-webkit-box-orient:vertical!important;-webkit-box-direction:normal!important;-webkit-flex-direction:column!important;-ms-flex-direction:column!important;flex-direction:column!important}
.flex-md-row-reverse{-webkit-box-orient:horizontal!important;-webkit-box-direction:reverse!important;-webkit-flex-direction:row-reverse!important;-ms-flex-direction:row-reverse!important;flex-direction:row-reverse!important}
.flex-md-column-reverse{-webkit-box-orient:vertical!important;-webkit-box-direction:reverse!important;-webkit-flex-direction:column-reverse!important;-ms-flex-direction:column-reverse!important;flex-direction:column-reverse!important}
.flex-md-wrap{-webkit-flex-wrap:wrap!important;-ms-flex-wrap:wrap!important;flex-wrap:wrap!important}
.flex-md-nowrap{-webkit-flex-wrap:nowrap!important;-ms-flex-wrap:nowrap!important;flex-wrap:nowrap!important}
.flex-md-wrap-reverse{-webkit-flex-wrap:wrap-reverse!important;-ms-flex-wrap:wrap-reverse!important;flex-wrap:wrap-reverse!important}
.justify-content-md-start{-webkit-box-pack:start!important;-webkit-justify-content:flex-start!important;-ms-flex-pack:start!important;justify-content:flex-start!important}
.justify-content-md-end{-webkit-box-pack:end!important;-webkit-justify-content:flex-end!important;-ms-flex-pack:end!important;justify-content:flex-end!important}
.justify-content-md-center{-webkit-box-pack:center!important;-webkit-justify-content:center!important;-ms-flex-pack:center!important;justify-content:center!important}
.justify-content-md-between{-webkit-box-pack:justify!important;-webkit-justify-content:space-between!important;-ms-flex-pack:justify!important;justify-content:space-between!important}
.justify-content-md-around{-webkit-justify-content:space-around!important;-ms-flex-pack:distribute!important;justify-content:space-around!important}
.align-items-md-start{-webkit-box-align:start!important;-webkit-align-items:flex-start!important;-ms-flex-align:start!important;align-items:flex-start!important}
.align-items-md-end{-webkit-box-align:end!important;-webkit-align-items:flex-end!important;-ms-flex-align:end!important;align-items:flex-end!important}
.align-items-md-center{-webkit-box-align:center!important;-webkit-align-items:center!important;-ms-flex-align:center!important;align-items:center!important}
.align-items-md-baseline{-webkit-box-align:baseline!important;-webkit-align-items:baseline!important;-ms-flex-align:baseline!important;align-items:baseline!important}
.align-items-md-stretch{-webkit-box-align:stretch!important;-webkit-align-items:stretch!important;-ms-flex-align:stretch!important;align-items:stretch!important}
.align-content-md-start{-webkit-align-content:flex-start!important;-ms-flex-line-pack:start!important;align-content:flex-start!important}
.align-content-md-end{-webkit-align-content:flex-end!important;-ms-flex-line-pack:end!important;align-content:flex-end!important}
.align-content-md-center{-webkit-align-content:center!important;-ms-flex-line-pack:center!important;align-content:center!important}
.align-content-md-between{-webkit-align-content:space-between!important;-ms-flex-line-pack:justify!important;align-content:space-between!important}
.align-content-md-around{-webkit-align-content:space-around!important;-ms-flex-line-pack:distribute!important;align-content:space-around!important}
.align-content-md-stretch{-webkit-align-content:stretch!important;-ms-flex-line-pack:stretch!important;align-content:stretch!important}
.align-self-md-auto{-webkit-align-self:auto!important;-ms-flex-item-align:auto!important;-ms-grid-row-align:auto!important;align-self:auto!important}
.align-self-md-start{-webkit-align-self:flex-start!important;-ms-flex-item-align:start!important;align-self:flex-start!important}
.align-self-md-end{-webkit-align-self:flex-end!important;-ms-flex-item-align:end!important;align-self:flex-end!important}
.align-self-md-center{-webkit-align-self:center!important;-ms-flex-item-align:center!important;-ms-grid-row-align:center!important;align-self:center!important}
.align-self-md-baseline{-webkit-align-self:baseline!important;-ms-flex-item-align:baseline!important;align-self:baseline!important}
.align-self-md-stretch{-webkit-align-self:stretch!important;-ms-flex-item-align:stretch!important;-ms-grid-row-align:stretch!important;align-self:stretch!important}
}
@media (min-width:992px){.flex-lg-row{-webkit-box-orient:horizontal!important;-webkit-box-direction:normal!important;-webkit-flex-direction:row!important;-ms-flex-direction:row!important;flex-direction:row!important}
.flex-lg-column{-webkit-box-orient:vertical!important;-webkit-box-direction:normal!important;-webkit-flex-direction:column!important;-ms-flex-direction:column!important;flex-direction:column!important}
.flex-lg-row-reverse{-webkit-box-orient:horizontal!important;-webkit-box-direction:reverse!important;-webkit-flex-direction:row-reverse!important;-ms-flex-direction:row-reverse!important;flex-direction:row-reverse!important}
.flex-lg-column-reverse{-webkit-box-orient:vertical!important;-webkit-box-direction:reverse!important;-webkit-flex-direction:column-reverse!important;-ms-flex-direction:column-reverse!important;flex-direction:column-reverse!important}
.flex-lg-wrap{-webkit-flex-wrap:wrap!important;-ms-flex-wrap:wrap!important;flex-wrap:wrap!important}
.flex-lg-nowrap{-webkit-flex-wrap:nowrap!important;-ms-flex-wrap:nowrap!important;flex-wrap:nowrap!important}
.flex-lg-wrap-reverse{-webkit-flex-wrap:wrap-reverse!important;-ms-flex-wrap:wrap-reverse!important;flex-wrap:wrap-reverse!important}
.justify-content-lg-start{-webkit-box-pack:start!important;-webkit-justify-content:flex-start!important;-ms-flex-pack:start!important;justify-content:flex-start!important}
.justify-content-lg-end{-webkit-box-pack:end!important;-webkit-justify-content:flex-end!important;-ms-flex-pack:end!important;justify-content:flex-end!important}
.justify-content-lg-center{-webkit-box-pack:center!important;-webkit-justify-content:center!important;-ms-flex-pack:center!important;justify-content:center!important}
.justify-content-lg-between{-webkit-box-pack:justify!important;-webkit-justify-content:space-between!important;-ms-flex-pack:justify!important;justify-content:space-between!important}
.justify-content-lg-around{-webkit-justify-content:space-around!important;-ms-flex-pack:distribute!important;justify-content:space-around!important}
.align-items-lg-start{-webkit-box-align:start!important;-webkit-align-items:flex-start!important;-ms-flex-align:start!important;align-items:flex-start!important}
.align-items-lg-end{-webkit-box-align:end!important;-webkit-align-items:flex-end!important;-ms-flex-align:end!important;align-items:flex-end!important}
.align-items-lg-center{-webkit-box-align:center!important;-webkit-align-items:center!important;-ms-flex-align:center!important;align-items:center!important}
.align-items-lg-baseline{-webkit-box-align:baseline!important;-webkit-align-items:baseline!important;-ms-flex-align:baseline!important;align-items:baseline!important}
.align-items-lg-stretch{-webkit-box-align:stretch!important;-webkit-align-items:stretch!important;-ms-flex-align:stretch!important;align-items:stretch!important}
.align-content-lg-start{-webkit-align-content:flex-start!important;-ms-flex-line-pack:start!important;align-content:flex-start!important}
.align-content-lg-end{-webkit-align-content:flex-end!important;-ms-flex-line-pack:end!important;align-content:flex-end!important}
.align-content-lg-center{-webkit-align-content:center!important;-ms-flex-line-pack:center!important;align-content:center!important}
.align-content-lg-between{-webkit-align-content:space-between!important;-ms-flex-line-pack:justify!important;align-content:space-between!important}
.align-content-lg-around{-webkit-align-content:space-around!important;-ms-flex-line-pack:distribute!important;align-content:space-around!important}
.align-content-lg-stretch{-webkit-align-content:stretch!important;-ms-flex-line-pack:stretch!important;align-content:stretch!important}
.align-self-lg-auto{-webkit-align-self:auto!important;-ms-flex-item-align:auto!important;-ms-grid-row-align:auto!important;align-self:auto!important}
.align-self-lg-start{-webkit-align-self:flex-start!important;-ms-flex-item-align:start!important;align-self:flex-start!important}
.align-self-lg-end{-webkit-align-self:flex-end!important;-ms-flex-item-align:end!important;align-self:flex-end!important}
.align-self-lg-center{-webkit-align-self:center!important;-ms-flex-item-align:center!important;-ms-grid-row-align:center!important;align-self:center!important}
.align-self-lg-baseline{-webkit-align-self:baseline!important;-ms-flex-item-align:baseline!important;align-self:baseline!important}
.align-self-lg-stretch{-webkit-align-self:stretch!important;-ms-flex-item-align:stretch!important;-ms-grid-row-align:stretch!important;align-self:stretch!important}
}
@media (min-width:1200px){.flex-xl-row{-webkit-box-orient:horizontal!important;-webkit-box-direction:normal!important;-webkit-flex-direction:row!important;-ms-flex-direction:row!important;flex-direction:row!important}
.flex-xl-column{-webkit-box-orient:vertical!important;-webkit-box-direction:normal!important;-webkit-flex-direction:column!important;-ms-flex-direction:column!important;flex-direction:column!important}
.flex-xl-row-reverse{-webkit-box-orient:horizontal!important;-webkit-box-direction:reverse!important;-webkit-flex-direction:row-reverse!important;-ms-flex-direction:row-reverse!important;flex-direction:row-reverse!important}
.flex-xl-column-reverse{-webkit-box-orient:vertical!important;-webkit-box-direction:reverse!important;-webkit-flex-direction:column-reverse!important;-ms-flex-direction:column-reverse!important;flex-direction:column-reverse!important}
.flex-xl-wrap{-webkit-flex-wrap:wrap!important;-ms-flex-wrap:wrap!important;flex-wrap:wrap!important}
.flex-xl-nowrap{-webkit-flex-wrap:nowrap!important;-ms-flex-wrap:nowrap!important;flex-wrap:nowrap!important}
.flex-xl-wrap-reverse{-webkit-flex-wrap:wrap-reverse!important;-ms-flex-wrap:wrap-reverse!important;flex-wrap:wrap-reverse!important}
.justify-content-xl-start{-webkit-box-pack:start!important;-webkit-justify-content:flex-start!important;-ms-flex-pack:start!important;justify-content:flex-start!important}
.justify-content-xl-end{-webkit-box-pack:end!important;-webkit-justify-content:flex-end!important;-ms-flex-pack:end!important;justify-content:flex-end!important}
.justify-content-xl-center{-webkit-box-pack:center!important;-webkit-justify-content:center!important;-ms-flex-pack:center!important;justify-content:center!important}
.justify-content-xl-between{-webkit-box-pack:justify!important;-webkit-justify-content:space-between!important;-ms-flex-pack:justify!important;justify-content:space-between!important}
.justify-content-xl-around{-webkit-justify-content:space-around!important;-ms-flex-pack:distribute!important;justify-content:space-around!important}
.align-items-xl-start{-webkit-box-align:start!important;-webkit-align-items:flex-start!important;-ms-flex-align:start!important;align-items:flex-start!important}
.align-items-xl-end{-webkit-box-align:end!important;-webkit-align-items:flex-end!important;-ms-flex-align:end!important;align-items:flex-end!important}
.align-items-xl-center{-webkit-box-align:center!important;-webkit-align-items:center!important;-ms-flex-align:center!important;align-items:center!important}
.align-items-xl-baseline{-webkit-box-align:baseline!important;-webkit-align-items:baseline!important;-ms-flex-align:baseline!important;align-items:baseline!important}
.align-items-xl-stretch{-webkit-box-align:stretch!important;-webkit-align-items:stretch!important;-ms-flex-align:stretch!important;align-items:stretch!important}
.align-content-xl-start{-webkit-align-content:flex-start!important;-ms-flex-line-pack:start!important;align-content:flex-start!important}
.align-content-xl-end{-webkit-align-content:flex-end!important;-ms-flex-line-pack:end!important;align-content:flex-end!important}
.align-content-xl-center{-webkit-align-content:center!important;-ms-flex-line-pack:center!important;align-content:center!important}
.align-content-xl-between{-webkit-align-content:space-between!important;-ms-flex-line-pack:justify!important;align-content:space-between!important}
.align-content-xl-around{-webkit-align-content:space-around!important;-ms-flex-line-pack:distribute!important;align-content:space-around!important}
.align-content-xl-stretch{-webkit-align-content:stretch!important;-ms-flex-line-pack:stretch!important;align-content:stretch!important}
.align-self-xl-auto{-webkit-align-self:auto!important;-ms-flex-item-align:auto!important;-ms-grid-row-align:auto!important;align-self:auto!important}
.align-self-xl-start{-webkit-align-self:flex-start!important;-ms-flex-item-align:start!important;align-self:flex-start!important}
.align-self-xl-end{-webkit-align-self:flex-end!important;-ms-flex-item-align:end!important;align-self:flex-end!important}
.align-self-xl-center{-webkit-align-self:center!important;-ms-flex-item-align:center!important;-ms-grid-row-align:center!important;align-self:center!important}
.align-self-xl-baseline{-webkit-align-self:baseline!important;-ms-flex-item-align:baseline!important;align-self:baseline!important}
.align-self-xl-stretch{-webkit-align-self:stretch!important;-ms-flex-item-align:stretch!important;-ms-grid-row-align:stretch!important;align-self:stretch!important}
}
.float-left{float:left!important}
.float-right{float:right!important}
.float-none{float:none!important}
@media (min-width:576px){.float-sm-left{float:left!important}
.float-sm-right{float:right!important}
.float-sm-none{float:none!important}
}
@media (min-width:768px){.float-md-left{float:left!important}
.float-md-right{float:right!important}
.float-md-none{float:none!important}
}
@media (min-width:992px){.float-lg-left{float:left!important}
.float-lg-right{float:right!important}
.float-lg-none{float:none!important}
}
@media (min-width:1200px){.float-xl-left{float:left!important}
.float-xl-right{float:right!important}
.float-xl-none{float:none!important}
}
.fixed-top{position:fixed;top:0;right:0;left:0;z-index:1030}
.fixed-bottom{position:fixed;right:0;bottom:0;left:0;z-index:1030}
.sr-only{position:absolute;width:1px;height:1px;padding:0;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;-webkit-clip-path:inset(50%);clip-path:inset(50%);border:0}
.sr-only-focusable:active,.sr-only-focusable:focus{position:static;width:auto;height:auto;overflow:visible;clip:auto;white-space:normal;-webkit-clip-path:none;clip-path:none}
.w-25{width:25%!important}
.w-50{width:50%!important}
.w-75{width:75%!important}
.w-100{width:100%!important}
.h-25{height:25%!important}
.h-50{height:50%!important}
.h-75{height:75%!important}
.h-100{height:100%!important}
.mw-100{max-width:100%!important}
.mh-100{max-height:100%!important}
.m-0{margin:0!important}
.mt-0{margin-top:0!important}
.mr-0{margin-right:0!important}
.mb-0{margin-bottom:0!important}
.ml-0{margin-left:0!important}
.mx-0{margin-right:0!important;margin-left:0!important}
.my-0{margin-top:0!important;margin-bottom:0!important}
.m-1{margin:.4rem!important}
.mt-1{margin-top:.4rem!important}
.mr-1{margin-right:.4rem!important}
.mb-1{margin-bottom:.4rem!important}
.ml-1{margin-left:.4rem!important}
.mx-1{margin-right:.4rem!important;margin-left:.4rem!important}
.my-1{margin-top:.4rem!important;margin-bottom:.4rem!important}
.m-2{margin:.8rem!important}
.mt-2{margin-top:.8rem!important}
.mr-2{margin-right:.8rem!important}
.mb-2{margin-bottom:.8rem!important}
.ml-2{margin-left:.8rem!important}
.mx-2{margin-right:.8rem!important;margin-left:.8rem!important}
.my-2{margin-top:.8rem!important;margin-bottom:.8rem!important}
.m-3{margin:1.2rem!important}
.mt-3{margin-top:1.2rem!important}
.mr-3{margin-right:1.2rem!important}
.mb-3{margin-bottom:1.2rem!important}
.ml-3{margin-left:1.2rem!important}
.mx-3{margin-right:1.2rem!important;margin-left:1.2rem!important}
.my-3{margin-top:1.2rem!important;margin-bottom:1.2rem!important}
.m-4{margin:1.6rem!important}
.mt-4{margin-top:1.6rem!important}
.mr-4{margin-right:1.6rem!important}
.mb-4{margin-bottom:1.6rem!important}
.ml-4{margin-left:1.6rem!important}
.mx-4{margin-right:1.6rem!important;margin-left:1.6rem!important}
.my-4{margin-top:1.6rem!important;margin-bottom:1.6rem!important}
.m-5{margin:2rem!important}
.mt-5{margin-top:2rem!important}
.mr-5{margin-right:2rem!important}
.mb-5{margin-bottom:2rem!important}
.ml-5{margin-left:2rem!important}
.mx-5{margin-right:2rem!important;margin-left:2rem!important}
.my-5{margin-top:2rem!important;margin-bottom:2rem!important}
.m-6{margin:2.4rem!important}
.mt-6{margin-top:2.4rem!important}
.mr-6{margin-right:2.4rem!important}
.mb-6{margin-bottom:2.4rem!important}
.ml-6{margin-left:2.4rem!important}
.mx-6{margin-right:2.4rem!important;margin-left:2.4rem!important}
.my-6{margin-top:2.4rem!important;margin-bottom:2.4rem!important}
.m-7{margin:2.8rem!important}
.mt-7{margin-top:2.8rem!important}
.mr-7{margin-right:2.8rem!important}
.mb-7{margin-bottom:2.8rem!important}
.ml-7{margin-left:2.8rem!important}
.mx-7{margin-right:2.8rem!important;margin-left:2.8rem!important}
.my-7{margin-top:2.8rem!important;margin-bottom:2.8rem!important}
.m-8{margin:3.2rem!important}
.mt-8{margin-top:3.2rem!important}
.mr-8{margin-right:3.2rem!important}
.mb-8{margin-bottom:3.2rem!important}
.ml-8{margin-left:3.2rem!important}
.mx-8{margin-right:3.2rem!important;margin-left:3.2rem!important}
.my-8{margin-top:3.2rem!important;margin-bottom:3.2rem!important}
.m-9{margin:3.6rem!important}
.mt-9{margin-top:3.6rem!important}
.mr-9{margin-right:3.6rem!important}
.mb-9{margin-bottom:3.6rem!important}
.ml-9{margin-left:3.6rem!important}
.mx-9{margin-right:3.6rem!important;margin-left:3.6rem!important}
.my-9{margin-top:3.6rem!important;margin-bottom:3.6rem!important}
.m-10{margin:4rem!important}
.mt-10{margin-top:4rem!important}
.mr-10{margin-right:4rem!important}
.mb-10{margin-bottom:4rem!important}
.ml-10{margin-left:4rem!important}
.mx-10{margin-right:4rem!important;margin-left:4rem!important}
.my-10{margin-top:4rem!important;margin-bottom:4rem!important}
.m-11{margin:4.4rem!important}
.mt-11{margin-top:4.4rem!important}
.mr-11{margin-right:4.4rem!important}
.mb-11{margin-bottom:4.4rem!important}
.ml-11{margin-left:4.4rem!important}
.mx-11{margin-right:4.4rem!important;margin-left:4.4rem!important}
.my-11{margin-top:4.4rem!important;margin-bottom:4.4rem!important}
.m-12{margin:4.8rem!important}
.mt-12{margin-top:4.8rem!important}
.mr-12{margin-right:4.8rem!important}
.mb-12{margin-bottom:4.8rem!important}
.ml-12{margin-left:4.8rem!important}
.mx-12{margin-right:4.8rem!important;margin-left:4.8rem!important}
.my-12{margin-top:4.8rem!important;margin-bottom:4.8rem!important}
.p-0{padding:0!important}
.pt-0{padding-top:0!important}
.pr-0{padding-right:0!important}
.pb-0{padding-bottom:0!important}
.pl-0{padding-left:0!important}
.px-0{padding-right:0!important;padding-left:0!important}
.py-0{padding-top:0!important;padding-bottom:0!important}
.p-1{padding:.4rem!important}
.pt-1{padding-top:.4rem!important}
.pr-1{padding-right:.4rem!important}
.pb-1{padding-bottom:.4rem!important}
.pl-1{padding-left:.4rem!important}
.px-1{padding-right:.4rem!important;padding-left:.4rem!important}
.py-1{padding-top:.4rem!important;padding-bottom:.4rem!important}
.p-2{padding:.8rem!important}
.pt-2{padding-top:.8rem!important}
.pr-2{padding-right:.8rem!important}
.pb-2{padding-bottom:.8rem!important}
.pl-2{padding-left:.8rem!important}
.px-2{padding-right:.8rem!important;padding-left:.8rem!important}
.py-2{padding-top:.8rem!important;padding-bottom:.8rem!important}
.p-3{padding:1.2rem!important}
.pt-3{padding-top:1.2rem!important}
.pr-3{padding-right:1.2rem!important}
.pb-3{padding-bottom:1.2rem!important}
.pl-3{padding-left:1.2rem!important}
.px-3{padding-right:1.2rem!important;padding-left:1.2rem!important}
.py-3{padding-top:1.2rem!important;padding-bottom:1.2rem!important}
.p-4{padding:1.6rem!important}
.pt-4{padding-top:1.6rem!important}
.pr-4{padding-right:1.6rem!important}
.pb-4{padding-bottom:1.6rem!important}
.pl-4{padding-left:1.6rem!important}
.px-4{padding-right:1.6rem!important;padding-left:1.6rem!important}
.py-4{padding-top:1.6rem!important;padding-bottom:1.6rem!important}
.p-5{padding:2rem!important}
.pt-5{padding-top:2rem!important}
.pr-5{padding-right:2rem!important}
.pb-5{padding-bottom:2rem!important}
.pl-5{padding-left:2rem!important}
.px-5{padding-right:2rem!important;padding-left:2rem!important}
.py-5{padding-top:2rem!important;padding-bottom:2rem!important}
.p-6{padding:2.4rem!important}
.pt-6{padding-top:2.4rem!important}
.pr-6{padding-right:2.4rem!important}
.pb-6{padding-bottom:2.4rem!important}
.pl-6{padding-left:2.4rem!important}
.px-6{padding-right:2.4rem!important;padding-left:2.4rem!important}
.py-6{padding-top:2.4rem!important;padding-bottom:2.4rem!important}
.p-7{padding:2.8rem!important}
.pt-7{padding-top:2.8rem!important}
.pr-7{padding-right:2.8rem!important}
.pb-7{padding-bottom:2.8rem!important}
.pl-7{padding-left:2.8rem!important}
.px-7{padding-right:2.8rem!important;padding-left:2.8rem!important}
.py-7{padding-top:2.8rem!important;padding-bottom:2.8rem!important}
.p-8{padding:3.2rem!important}
.pt-8{padding-top:3.2rem!important}
.pr-8{padding-right:3.2rem!important}
.pb-8{padding-bottom:3.2rem!important}
.pl-8{padding-left:3.2rem!important}
.px-8{padding-right:3.2rem!important;padding-left:3.2rem!important}
.py-8{padding-top:3.2rem!important;padding-bottom:3.2rem!important}
.p-9{padding:3.6rem!important}
.pt-9{padding-top:3.6rem!important}
.pr-9{padding-right:3.6rem!important}
.pb-9{padding-bottom:3.6rem!important}
.pl-9{padding-left:3.6rem!important}
.px-9{padding-right:3.6rem!important;padding-left:3.6rem!important}
.py-9{padding-top:3.6rem!important;padding-bottom:3.6rem!important}
.p-10{padding:4rem!important}
.pt-10{padding-top:4rem!important}
.pr-10{padding-right:4rem!important}
.pb-10{padding-bottom:4rem!important}
.pl-10{padding-left:4rem!important}
.px-10{padding-right:4rem!important;padding-left:4rem!important}
.py-10{padding-top:4rem!important;padding-bottom:4rem!important}
.p-11{padding:4.4rem!important}
.pt-11{padding-top:4.4rem!important}
.pr-11{padding-right:4.4rem!important}
.pb-11{padding-bottom:4.4rem!important}
.pl-11{padding-left:4.4rem!important}
.px-11{padding-right:4.4rem!important;padding-left:4.4rem!important}
.py-11{padding-top:4.4rem!important;padding-bottom:4.4rem!important}
.p-12{padding:4.8rem!important}
.pt-12{padding-top:4.8rem!important}
.pr-12{padding-right:4.8rem!important}
.pb-12{padding-bottom:4.8rem!important}
.pl-12{padding-left:4.8rem!important}
.px-12{padding-right:4.8rem!important;padding-left:4.8rem!important}
.py-12{padding-top:4.8rem!important;padding-bottom:4.8rem!important}
.py-20{padding-top:8.0rem!important;padding-bottom:8.0rem!important}
.m-auto{margin:auto!important}
.mt-auto{margin-top:auto!important}
.mr-auto{margin-right:auto!important}
.mb-auto{margin-bottom:auto!important}
.ml-auto{margin-left:auto!important}
.mx-auto{margin-right:auto!important;margin-left:auto!important}
.my-auto{margin-top:auto!important;margin-bottom:auto!important}
.text-justify{text-align:justify!important}
.text-nowrap{white-space:nowrap!important}
.text-truncate{overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.text-left{text-align:left!important}
.text-right{text-align:right!important}
.text-center{text-align:center!important}
@media (min-width:576px){.text-sm-left{text-align:left!important}
.text-sm-right{text-align:right!important}
.text-sm-center{text-align:center!important}
}
@media (min-width:768px){.text-md-left{text-align:left!important}
.text-md-right{text-align:right!important}
.text-md-center{text-align:center!important}
}
@media (min-width:992px){.text-lg-left{text-align:left!important}
.text-lg-right{text-align:right!important}
.text-lg-center{text-align:center!important}
}
@media (min-width:1200px){.text-xl-left{text-align:left!important}
.text-xl-right{text-align:right!important}
.text-xl-center{text-align:center!important}
}
.text-lowercase{text-transform:lowercase!important}
.text-uppercase{text-transform:uppercase!important}
.text-capitalize{text-transform:capitalize!important}
.font-weight-normal{font-weight:400}
.font-weight-bold{font-weight:700}
.font-italic{font-style:italic}
.text-white{color:#fff!important}
.text-primary{color:#3c4252!important}
a.text-primary:focus,a.text-primary:hover{color:#262a35!important}
.text-secondary{color:#2196f3!important}
a.text-secondary:focus,a.text-secondary:hover{color:#0c7cd5!important}
.text-success{color:#4caf50!important}
a.text-success:focus,a.text-success:hover{color:#3d8b40!important}
.text-info{color:#009688!important}
a.text-info:focus,a.text-info:hover{color:#00635a!important}
.text-warning{color:#ff9800!important}
a.text-warning:focus,a.text-warning:hover{color:#cc7a00!important}
.text-danger{color:#f44336!important}
a.text-danger:focus,a.text-danger:hover{color:#ea1c0d!important}
.text-light{color:#f8f9fa!important}
a.text-light:focus,a.text-light:hover{color:#dae0e5!important}
.text-dark{color:#343a40!important}
a.text-dark:focus,a.text-dark:hover{color:#1d2124!important}
.text-muted{color:rgba(0,0,0,.38)!important}
.text-hide{font:0/0 a;color:transparent;text-shadow:none;background-color:transparent;border:0}
.visible{visibility:visible!important}
.invisible{visibility:hidden!important}
.mdc-animation-linear-out-slow-in{-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}
.mdc-animation-fast-out-slow-in{-webkit-animation-timing-function:cubic-bezier(.4,0,.2,1);animation-timing-function:cubic-bezier(.4,0,.2,1)}
.mdc-animation-fast-out-linear-in{-webkit-animation-timing-function:cubic-bezier(.4,0,1,1);animation-timing-function:cubic-bezier(.4,0,1,1)}
.md-elevation-0{-webkit-box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12);box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12)}
.md-elevation-1{-webkit-box-shadow:0 2px 1px -1px rgba(0,0,0,.2),0 1px 1px 0 rgba(0,0,0,.14),0 1px 3px 0 rgba(0,0,0,.12);box-shadow:0 2px 1px -1px rgba(0,0,0,.2),0 1px 1px 0 rgba(0,0,0,.14),0 1px 3px 0 rgba(0,0,0,.12)}
.md-elevation-2{-webkit-box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12);box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12)}
.md-elevation-3{-webkit-box-shadow:0 3px 3px -2px rgba(0,0,0,.2),0 3px 4px 0 rgba(0,0,0,.14),0 1px 8px 0 rgba(0,0,0,.12);box-shadow:0 3px 3px -2px rgba(0,0,0,.2),0 3px 4px 0 rgba(0,0,0,.14),0 1px 8px 0 rgba(0,0,0,.12)}
.md-elevation-4{-webkit-box-shadow:0 2px 4px -1px rgba(0,0,0,.2),0 4px 5px 0 rgba(0,0,0,.14),0 1px 10px 0 rgba(0,0,0,.12);box-shadow:0 2px 4px -1px rgba(0,0,0,.2),0 4px 5px 0 rgba(0,0,0,.14),0 1px 10px 0 rgba(0,0,0,.12)}
.md-elevation-5{-webkit-box-shadow:0 3px 5px -1px rgba(0,0,0,.2),0 5px 8px 0 rgba(0,0,0,.14),0 1px 14px 0 rgba(0,0,0,.12);box-shadow:0 3px 5px -1px rgba(0,0,0,.2),0 5px 8px 0 rgba(0,0,0,.14),0 1px 14px 0 rgba(0,0,0,.12)}
.md-elevation-6{-webkit-box-shadow:0 3px 5px -1px rgba(0,0,0,.2),0 6px 10px 0 rgba(0,0,0,.14),0 1px 18px 0 rgba(0,0,0,.12);box-shadow:0 3px 5px -1px rgba(0,0,0,.2),0 6px 10px 0 rgba(0,0,0,.14),0 1px 18px 0 rgba(0,0,0,.12)}
.md-elevation-7{-webkit-box-shadow:0 4px 5px -2px rgba(0,0,0,.2),0 7px 10px 1px rgba(0,0,0,.14),0 2px 16px 1px rgba(0,0,0,.12);box-shadow:0 4px 5px -2px rgba(0,0,0,.2),0 7px 10px 1px rgba(0,0,0,.14),0 2px 16px 1px rgba(0,0,0,.12)}
.md-elevation-8{-webkit-box-shadow:0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12);box-shadow:0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12)}
.md-elevation-9{-webkit-box-shadow:0 5px 6px -3px rgba(0,0,0,.2),0 9px 12px 1px rgba(0,0,0,.14),0 3px 16px 2px rgba(0,0,0,.12);box-shadow:0 5px 6px -3px rgba(0,0,0,.2),0 9px 12px 1px rgba(0,0,0,.14),0 3px 16px 2px rgba(0,0,0,.12)}
.md-elevation-10{-webkit-box-shadow:0 6px 6px -3px rgba(0,0,0,.2),0 10px 14px 1px rgba(0,0,0,.14),0 4px 18px 3px rgba(0,0,0,.12);box-shadow:0 6px 6px -3px rgba(0,0,0,.2),0 10px 14px 1px rgba(0,0,0,.14),0 4px 18px 3px rgba(0,0,0,.12)}
.md-elevation-11{-webkit-box-shadow:0 6px 7px -4px rgba(0,0,0,.2),0 11px 15px 1px rgba(0,0,0,.14),0 4px 20px 3px rgba(0,0,0,.12);box-shadow:0 6px 7px -4px rgba(0,0,0,.2),0 11px 15px 1px rgba(0,0,0,.14),0 4px 20px 3px rgba(0,0,0,.12)}
.md-elevation-12{-webkit-box-shadow:0 7px 8px -4px rgba(0,0,0,.2),0 12px 17px 2px rgba(0,0,0,.14),0 5px 22px 4px rgba(0,0,0,.12);box-shadow:0 7px 8px -4px rgba(0,0,0,.2),0 12px 17px 2px rgba(0,0,0,.14),0 5px 22px 4px rgba(0,0,0,.12)}
.md-elevation-13{-webkit-box-shadow:0 7px 8px -4px rgba(0,0,0,.2),0 13px 19px 2px rgba(0,0,0,.14),0 5px 24px 4px rgba(0,0,0,.12);box-shadow:0 7px 8px -4px rgba(0,0,0,.2),0 13px 19px 2px rgba(0,0,0,.14),0 5px 24px 4px rgba(0,0,0,.12)}
.md-elevation-14{-webkit-box-shadow:0 7px 9px -4px rgba(0,0,0,.2),0 14px 21px 2px rgba(0,0,0,.14),0 5px 26px 4px rgba(0,0,0,.12);box-shadow:0 7px 9px -4px rgba(0,0,0,.2),0 14px 21px 2px rgba(0,0,0,.14),0 5px 26px 4px rgba(0,0,0,.12)}
.md-elevation-15{-webkit-box-shadow:0 8px 9px -5px rgba(0,0,0,.2),0 15px 22px 2px rgba(0,0,0,.14),0 6px 28px 5px rgba(0,0,0,.12);box-shadow:0 8px 9px -5px rgba(0,0,0,.2),0 15px 22px 2px rgba(0,0,0,.14),0 6px 28px 5px rgba(0,0,0,.12)}
.md-elevation-16{-webkit-box-shadow:0 8px 10px -5px rgba(0,0,0,.2),0 16px 24px 2px rgba(0,0,0,.14),0 6px 30px 5px rgba(0,0,0,.12);box-shadow:0 8px 10px -5px rgba(0,0,0,.2),0 16px 24px 2px rgba(0,0,0,.14),0 6px 30px 5px rgba(0,0,0,.12)}
.md-elevation-17{-webkit-box-shadow:0 8px 11px -5px rgba(0,0,0,.2),0 17px 26px 2px rgba(0,0,0,.14),0 6px 32px 5px rgba(0,0,0,.12);box-shadow:0 8px 11px -5px rgba(0,0,0,.2),0 17px 26px 2px rgba(0,0,0,.14),0 6px 32px 5px rgba(0,0,0,.12)}
.md-elevation-18{-webkit-box-shadow:0 9px 11px -5px rgba(0,0,0,.2),0 18px 28px 2px rgba(0,0,0,.14),0 7px 34px 6px rgba(0,0,0,.12);box-shadow:0 9px 11px -5px rgba(0,0,0,.2),0 18px 28px 2px rgba(0,0,0,.14),0 7px 34px 6px rgba(0,0,0,.12)}
.md-elevation-19{-webkit-box-shadow:0 9px 12px -6px rgba(0,0,0,.2),0 19px 29px 2px rgba(0,0,0,.14),0 7px 36px 6px rgba(0,0,0,.12);box-shadow:0 9px 12px -6px rgba(0,0,0,.2),0 19px 29px 2px rgba(0,0,0,.14),0 7px 36px 6px rgba(0,0,0,.12)}
.md-elevation-20{-webkit-box-shadow:0 10px 13px -6px rgba(0,0,0,.2),0 20px 31px 3px rgba(0,0,0,.14),0 8px 38px 7px rgba(0,0,0,.12);box-shadow:0 10px 13px -6px rgba(0,0,0,.2),0 20px 31px 3px rgba(0,0,0,.14),0 8px 38px 7px rgba(0,0,0,.12)}
.md-elevation-21{-webkit-box-shadow:0 10px 13px -6px rgba(0,0,0,.2),0 21px 33px 3px rgba(0,0,0,.14),0 8px 40px 7px rgba(0,0,0,.12);box-shadow:0 10px 13px -6px rgba(0,0,0,.2),0 21px 33px 3px rgba(0,0,0,.14),0 8px 40px 7px rgba(0,0,0,.12)}
.md-elevation-22{-webkit-box-shadow:0 10px 14px -6px rgba(0,0,0,.2),0 22px 35px 3px rgba(0,0,0,.14),0 8px 42px 7px rgba(0,0,0,.12);box-shadow:0 10px 14px -6px rgba(0,0,0,.2),0 22px 35px 3px rgba(0,0,0,.14),0 8px 42px 7px rgba(0,0,0,.12)}
.md-elevation-23{-webkit-box-shadow:0 11px 14px -7px rgba(0,0,0,.2),0 23px 36px 3px rgba(0,0,0,.14),0 9px 44px 8px rgba(0,0,0,.12);box-shadow:0 11px 14px -7px rgba(0,0,0,.2),0 23px 36px 3px rgba(0,0,0,.14),0 9px 44px 8px rgba(0,0,0,.12)}
.md-elevation-24{-webkit-box-shadow:0 11px 15px -7px rgba(0,0,0,.2),0 24px 38px 3px rgba(0,0,0,.14),0 9px 46px 8px rgba(0,0,0,.12);box-shadow:0 11px 15px -7px rgba(0,0,0,.2),0 24px 38px 3px rgba(0,0,0,.14),0 9px 46px 8px rgba(0,0,0,.12)}
.mdc-elevation-transition{-webkit-transition:-webkit-box-shadow 280ms cubic-bezier(.4,0,.2,1);transition:-webkit-box-shadow 280ms cubic-bezier(.4,0,.2,1);transition:box-shadow 280ms cubic-bezier(.4,0,.2,1);transition:box-shadow 280ms cubic-bezier(.4,0,.2,1),-webkit-box-shadow 280ms cubic-bezier(.4,0,.2,1);will-change:box-shadow}
.center-block{display:block;margin-left:auto;margin-right:auto;float:none}
.left-block{display:block;margin-left:0;margin-right:auto}
.right-block{display:block;margin-left:auto;margin-right:0}
.auto-height{height:auto}
.auto-width{width:auto}
.pull-right{float:right!important}
.pull-left{float:left!important}
.inline-block{display:inline-block}
.a-align-middle{top:50%;-webkit-transform:translate(0,-50%);-ms-transform:translate(0,-50%);transform:translate(0,-50%);position:absolute!important}
.a-align-middle-center{top:50%;left:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%);position:absolute!important;text-align:center}
.a-align-middle-right{top:50%;right:0;-webkit-transform:translate(0,-50%);-ms-transform:translate(0,-50%);transform:translate(0,-50%);position:absolute!important}
.a-align-middle-left{top:50%;left:0;-webkit-transform:translate(0,-50%);-ms-transform:translate(0,-50%);transform:translate(0,-50%);position:absolute!important}
.a-align-top-left{top:0;left:0;position:absolute!important}
.a-align-top-center{top:0;left:50%;-webkit-transform:translate(-50%,0);-ms-transform:translate(-50%,0);transform:translate(-50%,0);position:absolute!important;text-align:center}
.a-align-top-right{top:0;right:0;position:absolute!important}
.a-align-bottom-left{bottom:0;left:0;position:absolute!important}
.a-align-bottom-center{bottom:0;left:50%;-webkit-transform:translate(-50%,0);-ms-transform:translate(-50%,0);transform:translate(-50%,0);position:absolute!important;text-align:center}
.a-align-bottom-right{bottom:0;right:0;position:absolute!important}
.a-align-bottom-left{bottom:0;left:0;position:absolute!important}
@media (min-width:576px){.center-block-sm{display:block;margin-left:auto;margin-right:auto;float:none}
.left-block-sm{display:block;margin-left:0;margin-right:auto}
.right-block-sm{display:block;margin-left:auto;margin-right:0}
.auto-height-sm{height:auto}
.auto-width-sm{width:auto}
.pull-right-sm{float:right!important}
.pull-left-sm{float:left!important}
.inline-block-sm{display:inline-block}
.a-align-sm-middle{top:50%;-webkit-transform:translate(0,-50%);-ms-transform:translate(0,-50%);transform:translate(0,-50%);position:absolute!important}
.a-align-sm-middle-center{top:50%;left:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%);position:absolute!important;text-align:center}
.a-align-sm-middle-right{top:50%;right:0;-webkit-transform:translate(0,-50%);-ms-transform:translate(0,-50%);transform:translate(0,-50%);position:absolute!important}
.a-align-sm-middle-left{top:50%;left:0;-webkit-transform:translate(0,-50%);-ms-transform:translate(0,-50%);transform:translate(0,-50%);position:absolute!important}
.a-align-sm-top-left{top:0;left:0;position:absolute!important}
.a-align-sm-top-center{top:0;left:50%;-webkit-transform:translate(-50%,0);-ms-transform:translate(-50%,0);transform:translate(-50%,0);position:absolute!important;text-align:center}
.a-align-sm-top-right{top:0;right:0;position:absolute!important}
.a-align-sm-bottom-left{bottom:0;left:0;position:absolute!important}
.a-align-sm-bottom-center{bottom:0;left:50%;-webkit-transform:translate(-50%,0);-ms-transform:translate(-50%,0);transform:translate(-50%,0);position:absolute!important;text-align:center}
.a-align-sm-bottom-right{bottom:0;right:0;position:absolute!important}
.a-align-sm-bottom-left{bottom:0;left:0;position:absolute!important}
}
@media (min-width:768px){.center-block-md{display:block;margin-left:auto;margin-right:auto;float:none}
.left-block-md{display:block;margin-left:0;margin-right:auto}
.right-block-md{display:block;margin-left:auto;margin-right:0}
.auto-height-md{height:auto}
.auto-width-md{width:auto}
.pull-right-md{float:right!important}
.pull-left-md{float:left!important}
.inline-block-md{display:inline-block}
.a-align-md-middle{top:50%;-webkit-transform:translate(0,-50%);-ms-transform:translate(0,-50%);transform:translate(0,-50%);position:absolute!important}
.a-align-md-middle-center{top:50%;left:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%);position:absolute!important;text-align:center}
.a-align-md-middle-right{top:50%;right:0;-webkit-transform:translate(0,-50%);-ms-transform:translate(0,-50%);transform:translate(0,-50%);position:absolute!important}
.a-align-md-middle-left{top:50%;left:0;-webkit-transform:translate(0,-50%);-ms-transform:translate(0,-50%);transform:translate(0,-50%);position:absolute!important}
.a-align-md-top-left{top:0;left:0;position:absolute!important}
.a-align-md-top-center{top:0;left:50%;-webkit-transform:translate(-50%,0);-ms-transform:translate(-50%,0);transform:translate(-50%,0);position:absolute!important;text-align:center}
.a-align-md-top-right{top:0;right:0;position:absolute!important}
.a-align-md-bottom-left{bottom:0;left:0;position:absolute!important}
.a-align-md-bottom-center{bottom:0;left:50%;-webkit-transform:translate(-50%,0);-ms-transform:translate(-50%,0);transform:translate(-50%,0);position:absolute!important;text-align:center}
.a-align-md-bottom-right{bottom:0;right:0;position:absolute!important}
.a-align-md-bottom-left{bottom:0;left:0;position:absolute!important}
}
@media (min-width:992px){.center-block-lg{display:block;margin-left:auto;margin-right:auto;float:none}
.left-block-lg{display:block;margin-left:0;margin-right:auto}
.right-block-lg{display:block;margin-left:auto;margin-right:0}
.auto-height-lg{height:auto}
.auto-width-lg{width:auto}
.pull-right-lg{float:right!important}
.pull-left-lg{float:left!important}
.inline-block-lg{display:inline-block}
.a-align-lg-middle{top:50%;-webkit-transform:translate(0,-50%);-ms-transform:translate(0,-50%);transform:translate(0,-50%);position:absolute!important}
.a-align-lg-middle-center{top:50%;left:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%);position:absolute!important;text-align:center}
.a-align-lg-middle-right{top:50%;right:0;-webkit-transform:translate(0,-50%);-ms-transform:translate(0,-50%);transform:translate(0,-50%);position:absolute!important}
.a-align-lg-middle-left{top:50%;left:0;-webkit-transform:translate(0,-50%);-ms-transform:translate(0,-50%);transform:translate(0,-50%);position:absolute!important}
.a-align-lg-top-left{top:0;left:0;position:absolute!important}
.a-align-lg-top-center{top:0;left:50%;-webkit-transform:translate(-50%,0);-ms-transform:translate(-50%,0);transform:translate(-50%,0);position:absolute!important;text-align:center}
.a-align-lg-top-right{top:0;right:0;position:absolute!important}
.a-align-lg-bottom-left{bottom:0;left:0;position:absolute!important}
.a-align-lg-bottom-center{bottom:0;left:50%;-webkit-transform:translate(-50%,0);-ms-transform:translate(-50%,0);transform:translate(-50%,0);position:absolute!important;text-align:center}
.a-align-lg-bottom-right{bottom:0;right:0;position:absolute!important}
.a-align-lg-bottom-left{bottom:0;left:0;position:absolute!important}
}
@media (min-width:1200px){.center-block-xl{display:block;margin-left:auto;margin-right:auto;float:none}
.left-block-xl{display:block;margin-left:0;margin-right:auto}
.right-block-xl{display:block;margin-left:auto;margin-right:0}
.auto-height-xl{height:auto}
.auto-width-xl{width:auto}
.pull-right-xl{float:right!important}
.pull-left-xl{float:left!important}
.inline-block-xl{display:inline-block}
.a-align-xl-middle{top:50%;-webkit-transform:translate(0,-50%);-ms-transform:translate(0,-50%);transform:translate(0,-50%);position:absolute!important}
.a-align-xl-middle-center{top:50%;left:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%);position:absolute!important;text-align:center}
.a-align-xl-middle-right{top:50%;right:0;-webkit-transform:translate(0,-50%);-ms-transform:translate(0,-50%);transform:translate(0,-50%);position:absolute!important}
.a-align-xl-middle-left{top:50%;left:0;-webkit-transform:translate(0,-50%);-ms-transform:translate(0,-50%);transform:translate(0,-50%);position:absolute!important}
.a-align-xl-top-left{top:0;left:0;position:absolute!important}
.a-align-xl-top-center{top:0;left:50%;-webkit-transform:translate(-50%,0);-ms-transform:translate(-50%,0);transform:translate(-50%,0);position:absolute!important;text-align:center}
.a-align-xl-top-right{top:0;right:0;position:absolute!important}
.a-align-xl-bottom-left{bottom:0;left:0;position:absolute!important}
.a-align-xl-bottom-center{bottom:0;left:50%;-webkit-transform:translate(-50%,0);-ms-transform:translate(-50%,0);transform:translate(-50%,0);position:absolute!important;text-align:center}
.a-align-xl-bottom-right{bottom:0;right:0;position:absolute!important}
.a-align-xl-bottom-left{bottom:0;left:0;position:absolute!important}
}
html{font-size:62.5%;line-height:1;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;height:100%;overflow-x:hidden}
body{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-flow:column nowrap;-ms-flex-flow:column nowrap;flex-flow:column nowrap;min-height:100%;overflow-x:hidden;overflow-y:auto;position:relative}
#wrapper{min-height:100%;-webkit-box-flex:1;-webkit-flex:auto;-ms-flex:auto;flex:auto}
body{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-flow:column nowrap;-ms-flex-flow:column nowrap;flex-flow:column nowrap;min-height:100%}
#wrapper{min-height:100%;-webkit-box-flex:1;-webkit-flex:auto;-ms-flex:auto;flex:auto}
body{background-color:#f5f5f5}
.layout #wrapper{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;min-height:100vh}
.layout #wrapper>.content-wrapper{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;min-height:100%;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;width:100%}
.layout #wrapper>.content-wrapper>.content{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-flex:1;-webkit-flex:1 0 auto;-ms-flex:1 0 auto;flex:1 0 auto;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column}
.layout #wrapper>.content-wrapper>.content>.page-layout{-webkit-box-flex:1;-webkit-flex:1 0 auto;-ms-flex:1 0 auto;flex:1 0 auto}
.layout #wrapper>.content-wrapper>.content{position:relative}
.layout #wrapper>.aside{z-index:1000}
.layout #wrapper>.aside>.aside-content-wrapper{overflow:hidden;width:25.6rem;min-width:25.6rem;height:100%;-webkit-transition:all .3s ease;transition:all .3s ease;position:relative}
.layout #wrapper>.aside>.aside-content-wrapper>.aside-content{-webkit-box-shadow:0 2px 4px -1px rgba(0,0,0,.2),0 4px 5px 0 rgba(0,0,0,.14),0 1px 10px 0 rgba(0,0,0,.12);box-shadow:0 2px 4px -1px rgba(0,0,0,.2),0 4px 5px 0 rgba(0,0,0,.14),0 1px 10px 0 rgba(0,0,0,.12);background:#fff;position:fixed;height:100%;width:25.6rem;top:0;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;-webkit-transition:all .3s ease;transition:all .3s ease;overflow:hidden}
.layout #wrapper>.aside>.aside-content-wrapper>.aside-content>.aside-toolbar{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;padding-left:2.4rem;padding-right:1.6rem;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;height:6.4rem;min-height:6.4rem;background-color:rgba(255,255,255,.05);-webkit-box-shadow:0 2px 1px -1px rgba(0,0,0,.2),0 1px 1px 0 rgba(0,0,0,.14),0 1px 3px 0 rgba(0,0,0,.12);box-shadow:0 2px 1px -1px rgba(0,0,0,.2),0 1px 1px 0 rgba(0,0,0,.14),0 1px 3px 0 rgba(0,0,0,.12)}
.layout #wrapper>.aside>.aside-content-wrapper>.aside-content>.aside-toolbar .logo{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}
.layout #wrapper>.aside>.aside-content-wrapper>.aside-content>.aside-toolbar .logo .logo-icon{display:block;background:#666666;width:32px;min-width:32px;height:32px;line-height:32px;text-align:center;font-size:16px;font-weight:500;-webkit-border-radius:2px;border-radius:2px}
.layout #wrapper>.aside>.aside-content-wrapper>.aside-content>.aside-toolbar .logo .logo-icon:hover{background:#111111;}
.layout #wrapper>.aside>.aside-content-wrapper>.aside-content>.aside-toolbar .logo .logo-text{margin-left:16px;font-size:1.6rem}
.layout #wrapper>.aside>.aside-content-wrapper>.aside-content>#sidenav{overflow-x:hidden;overflow-y:auto;-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap}
.layout #wrapper>.aside>.aside-content-wrapper>.aside-content>#sidenav .subheader{white-space:nowrap}
.layout #wrapper>.aside>.aside-content-wrapper>.aside-content>#sidenav .nav-link{color:inherit}
.layout #wrapper>.aside>.aside-content-wrapper>.aside-content>#sidenav .nav-link:hover{background:rgba(0,0,0,.05)}
.layout #wrapper>.aside>.aside-content-wrapper>.aside-content>#sidenav .nav-link:hover>i{color:rgba(0,0,0,.54)}
.layout #wrapper>.aside>.aside-content-wrapper>.aside-content>#sidenav .nav-link.active{font-weight:600}
.layout #wrapper>.aside>.aside-content-wrapper>.aside-content>#sidenav .nav-link.active>i{font-weight:600}
.layout #wrapper>.aside>.aside-content-wrapper>.aside-content>#sidenav .nav-link>span{white-space:nowrap}
.layout #wrapper .quick-panel-sidebar{z-index:1050}
.layout #wrapper .fuse-bar-backdrop-quick-panel-sidebar{z-index:1049}
#toolbar{-webkit-box-shadow:0 2px 1px -1px rgba(0,0,0,.2),0 1px 1px 0 rgba(0,0,0,.14),0 1px 3px 0 rgba(0,0,0,.12);box-shadow:0 2px 1px -1px rgba(0,0,0,.2),0 1px 1px 0 rgba(0,0,0,.14),0 1px 3px 0 rgba(0,0,0,.12);height:6.4rem;min-height:6.4rem;-webkit-transition:left .3s ease,right .3s ease;transition:left .3s ease,right .3s ease}
#toolbar .toolbar-separator{height:6.4rem;width:1px;background:rgba(0,0,0,.12)}
#toolbar .shortcuts-wrapper .add-shortcut-menu-button>.dropdown-toggle:after{display:none}
#toolbar .user-menu-button>.dropdown-toggle{height:6.4rem;position:relative;cursor:pointer}
#toolbar .user-menu-button>.dropdown-toggle .avatar-wrapper{position:relative}
#toolbar .user-menu-button>.dropdown-toggle .avatar-wrapper .status{position:absolute;bottom:-.4rem;right:-.4rem}
#toolbar .quick-panel-button,#toolbar .search-button,#toolbar .toggle-aside-button{height:6.4rem;width:6.4rem}
@media (max-width:575px){#toolbar .quick-panel-button,#toolbar .search-button,#toolbar .toggle-aside-button{width:4.8rem;height:4.8rem}
}
#toolbar .language-button>.dropdown-toggle{cursor:pointer;height:6.4rem}
@media (max-width:575px){#toolbar .language-button>.dropdown-toggle{width:4.8rem;height:4.8rem}
}
.layout.layout-vertical #wrapper>.content-wrapper{overflow:hidden}
.layout.layout-vertical.layout-above-toolbar #toolbar{z-index:1030}
.layout.layout-vertical.layout-above-toolbar #wrapper>aside{z-index:1021}
.layout.layout-vertical.layout-above-toolbar #wrapper #aside>.aside-content-wrapper>.aside-content{margin-top:6.4rem}
.layout.layout-vertical.layout-above-toolbar #wrapper>.content-wrapper>.content{margin-top:6.4rem}
.layout.layout-vertical.layout-below-toolbar #wrapper>aside{z-index:1030}
.layout.layout-vertical.layout-below-toolbar #wrapper>.fuse-bar-backdrop.fuse-bar-backdrop-aside{z-index:1029}
.layout.layout-vertical.layout-below-toolbar #wrapper>.content-wrapper #toolbar{z-index:1020}
.layout.layout-vertical.layout-below-toolbar #wrapper>.content-wrapper>.content{margin-top:6.4rem}
.layout.layout-vertical.layout-below-toolbar.layout-left-navigation #wrapper>.content-wrapper{-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1}
.layout.layout-vertical.layout-below-toolbar.layout-left-navigation #wrapper>.content-wrapper #toolbar{left:25.6rem;right:0}
.layout.layout-vertical.layout-below-toolbar.layout-right-navigation #wrapper>.content-wrapper{-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1}
.layout.layout-vertical.layout-below-toolbar.layout-right-navigation #wrapper>.content-wrapper #toolbar{right:25.6rem;left:0}
[class*=" icon-"],[class^=icon-],i{color:rgba(0,0,0,.54);font-size:2.4rem;height:2.4rem;line-height:2.4rem;width:2.4rem}
[class*=" icon-"].s-2,[class^=icon-].s-2,i.s-2{font-size:.8rem!important;width:.8rem!important;height:.8rem!important;line-height:.8rem!important}
[class*=" icon-"].s-3,[class^=icon-].s-3,i.s-3{font-size:1.2rem!important;width:1.2rem!important;height:1.2rem!important;line-height:1.2rem!important}
[class*=" icon-"].s-4,[class^=icon-].s-4,i.s-4{font-size:1.6rem!important;width:1.6rem!important;height:1.6rem!important;line-height:1.6rem!important}
[class*=" icon-"].s-5,[class^=icon-].s-5,i.s-5{font-size:2rem!important;width:2rem!important;height:2rem!important;line-height:2rem!important}
[class*=" icon-"].s-6,[class^=icon-].s-6,i.s-6{font-size:2.4rem!important;width:2.4rem!important;height:2.4rem!important;line-height:2.4rem!important}
[class*=" icon-"].s-7,[class^=icon-].s-7,i.s-7{font-size:2.8rem!important;width:2.8rem!important;height:2.8rem!important;line-height:2.8rem!important}
[class*=" icon-"].s-8,[class^=icon-].s-8,i.s-8{font-size:3.2rem!important;width:3.2rem!important;height:3.2rem!important;line-height:3.2rem!important}
[class*=" icon-"].s-9,[class^=icon-].s-9,i.s-9{font-size:3.6rem!important;width:3.6rem!important;height:3.6rem!important;line-height:3.6rem!important}
[class*=" icon-"].s-10,[class^=icon-].s-10,i.s-10{font-size:4rem!important;width:4rem!important;height:4rem!important;line-height:4rem!important}
[class*=" icon-"].s-11,[class^=icon-].s-11,i.s-11{font-size:4.4rem!important;width:4.4rem!important;height:4.4rem!important;line-height:4.4rem!important}
[class*=" icon-"].s-12,[class^=icon-].s-12,i.s-12{font-size:4.8rem!important;width:4.8rem!important;height:4.8rem!important;line-height:4.8rem!important}
[class*=" icon-"].s-13,[class^=icon-].s-13,i.s-13{font-size:5.2rem!important;width:5.2rem!important;height:5.2rem!important;line-height:5.2rem!important}
[class*=" icon-"].s-14,[class^=icon-].s-14,i.s-14{font-size:5.6rem!important;width:5.6rem!important;height:5.6rem!important;line-height:5.6rem!important}
[class*=" icon-"].s-15,[class^=icon-].s-15,i.s-15{font-size:6rem!important;width:6rem!important;height:6rem!important;line-height:6rem!important}
[class*=" icon-"].s-16,[class^=icon-].s-16,i.s-16{font-size:6.4rem!important;width:6.4rem!important;height:6.4rem!important;line-height:6.4rem!important}
[class*=" icon-"].s-17,[class^=icon-].s-17,i.s-17{font-size:6.8rem!important;width:6.8rem!important;height:6.8rem!important;line-height:6.8rem!important}
[class*=" icon-"].s-18,[class^=icon-].s-18,i.s-18{font-size:7.2rem!important;width:7.2rem!important;height:7.2rem!important;line-height:7.2rem!important}
[class*=" icon-"].s-19,[class^=icon-].s-19,i.s-19{font-size:7.6rem!important;width:7.6rem!important;height:7.6rem!important;line-height:7.6rem!important}
[class*=" icon-"].s-20,[class^=icon-].s-20,i.s-20{font-size:8rem!important;width:8rem!important;height:8rem!important;line-height:8rem!important}
[class*=" icon-"].s-21,[class^=icon-].s-21,i.s-21{font-size:8.4rem!important;width:8.4rem!important;height:8.4rem!important;line-height:8.4rem!important}
[class*=" icon-"].s-22,[class^=icon-].s-22,i.s-22{font-size:8.8rem!important;width:8.8rem!important;height:8.8rem!important;line-height:8.8rem!important}
[class*=" icon-"].s-23,[class^=icon-].s-23,i.s-23{font-size:9.2rem!important;width:9.2rem!important;height:9.2rem!important;line-height:9.2rem!important}
[class*=" icon-"].s-24,[class^=icon-].s-24,i.s-24{font-size:9.6rem!important;width:9.6rem!important;height:9.6rem!important;line-height:9.6rem!important}
[class*=" icon-"].s-25,[class^=icon-].s-25,i.s-25{font-size:10rem!important;width:10rem!important;height:10rem!important;line-height:10rem!important}
[class*=" icon-"].s-26,[class^=icon-].s-26,i.s-26{font-size:10.4rem!important;width:10.4rem!important;height:10.4rem!important;line-height:10.4rem!important}
[class*=" icon-"].s-27,[class^=icon-].s-27,i.s-27{font-size:10.8rem!important;width:10.8rem!important;height:10.8rem!important;line-height:10.8rem!important}
[class*=" icon-"].s-28,[class^=icon-].s-28,i.s-28{font-size:11.2rem!important;width:11.2rem!important;height:11.2rem!important;line-height:11.2rem!important}
[class*=" icon-"].s-29,[class^=icon-].s-29,i.s-29{font-size:11.6rem!important;width:11.6rem!important;height:11.6rem!important;line-height:11.6rem!important}
[class*=" icon-"].s-30,[class^=icon-].s-30,i.s-30{font-size:12rem!important;width:12rem!important;height:12rem!important;line-height:12rem!important}
[class*=" icon-"].s-31,[class^=icon-].s-31,i.s-31{font-size:12.4rem!important;width:12.4rem!important;height:12.4rem!important;line-height:12.4rem!important}
[class*=" icon-"].s-32,[class^=icon-].s-32,i.s-32{font-size:12.8rem!important;width:12.8rem!important;height:12.8rem!important;line-height:12.8rem!important}
.page-layout{position:relative;overflow:hidden;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex}
.page-layout .page-header{height:20rem;min-height:20rem;max-height:20rem}
.page-layout .page-header .breadcrumb{font-weight:500}
.page-layout .page-header .breadcrumb md-icon{margin:0}
.page-layout .page-header .breadcrumb .separator{margin:0 8px}
.page-layout .page-header .title{font-size:34px}
.page-layout .page-header-custom{height:15rem;min-height:15rem;max-height:15rem}
.page-layout .page-header-custom .title{font-size:34px}
.page-layout .page-content-wrapper{-webkit-box-flex:1;-webkit-flex:auto;-ms-flex:auto;flex:auto;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;z-index:10;overflow:hidden;position:relative}
.page-layout .page-sidebar{width:22rem;min-width:22rem;max-width:22rem}
.page-layout .page-sidebar:not(.fuse-bar){z-index:5}
.page-layout .page-content{z-index:10}
.page-layout.carded{-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column}
.page-layout.carded .top-bg{position:absolute;z-index:1;top:0;right:0;left:0;height:20rem}
.page-layout.carded .page-sidebar>.header{height:20rem;min-height:20rem;max-height:20rem}
.page-layout.carded .page-content{padding:0 3.2rem}
.page-layout .page-header-search-input{box-shadow:5px 5px 10px rgba(0,0,0,0.2);border:1px solid #eee;padding:10px!important}
@media (max-width:820px){.page-layout .page-header-search{height:20rem;min-height:20rem;max-height:20rem}
}
@media (min-width: 821px) and (max-width: 1686px){.page-layout .page-header-search{height:16rem;min-height:16rem;max-height:16rem}
}
@media (min-width:1687px){.page-layout .page-header-search{height:12rem;min-height:12rem;max-height:12rem}
}
@media (max-width:575px){.page-layout.carded .page-content{padding:0 1.6rem}
}
.page-layout.carded .page-content>.header{height:13.6rem;min-height:13.6rem;max-height:13.6rem}
.page-layout.carded .page-content>.page-content-card{margin:0;background:#fff;-webkit-box-shadow:0 4px 5px -2px rgba(0,0,0,.2),0 7px 10px 1px rgba(0,0,0,.14),0 2px 16px 1px rgba(0,0,0,.12);box-shadow:0 4px 5px -2px rgba(0,0,0,.2),0 7px 10px 1px rgba(0,0,0,.14),0 2px 16px 1px rgba(0,0,0,.12);-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1}
.page-layout.carded .page-content>.page-content-card>.toolbar{height:6.4rem;min-height:6.4rem;max-height:6.4rem;border-bottom:1px solid rgba(0,0,0,.12)}
.page-layout.carded.left-sidebar .page-content-wrapper,.page-layout.carded.right-sidebar .page-content-wrapper{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row}
.page-layout.carded.left-sidebar .page-content-wrapper .page-content,.page-layout.carded.right-sidebar .page-content-wrapper .page-content{-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1}
@media (min-width:992px){.page-layout.carded.left-sidebar .page-content{padding-left:0}
}
@media (min-width:992px){.page-layout.carded.right-sidebar .page-content{padding-right:0}
}
.page-layout.simple.full-width,.page-layout.simple.tabbed{-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column}
.page-layout.simple.left-sidebar,.page-layout.simple.right-sidebar{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row}
.page-layout.simple.left-sidebar .page-content-wrapper,.page-layout.simple.right-sidebar .page-content-wrapper{-webkit-box-shadow:0 4px 5px -2px rgba(0,0,0,.2),0 7px 10px 1px rgba(0,0,0,.14),0 2px 16px 1px rgba(0,0,0,.12);box-shadow:0 4px 5px -2px rgba(0,0,0,.2),0 7px 10px 1px rgba(0,0,0,.14),0 2px 16px 1px rgba(0,0,0,.12)}
.page-layout.simple.left-sidebar-inner,.page-layout.simple.right-sidebar-inner{-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column}
.page-layout.simple.left-sidebar-inner .page-content-wrapper,.page-layout.simple.right-sidebar-inner .page-content-wrapper{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row}
.page-layout.simple.left-sidebar-floating,.page-layout.simple.right-sidebar-floating{-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column}
.page-layout.simple.left-sidebar-floating .page-content-wrapper,.page-layout.simple.right-sidebar-floating .page-content-wrapper{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row}
.page-layout.simple.left-sidebar-floating .page-content-wrapper .page-sidebar,.page-layout.simple.right-sidebar-floating .page-content-wrapper .page-sidebar{-webkit-box-sizing:content-box;box-sizing:content-box;position:relative}
.page-layout.simple.left-sidebar-floating .page-content-wrapper .page-sidebar .page-sidebar-card,.page-layout.simple.right-sidebar-floating .page-content-wrapper .page-sidebar .page-sidebar-card{-webkit-box-shadow:0 2px 1px -1px rgba(0,0,0,.2),0 1px 1px 0 rgba(0,0,0,.14),0 1px 3px 0 rgba(0,0,0,.12);box-shadow:0 2px 1px -1px rgba(0,0,0,.2),0 1px 1px 0 rgba(0,0,0,.14),0 1px 3px 0 rgba(0,0,0,.12);background-color:#fff}
@media (max-width:991px){.page-layout.simple.left-sidebar-floating .page-content-wrapper .page-sidebar,.page-layout.simple.right-sidebar-floating .page-content-wrapper .page-sidebar{padding:0!important}
.page-layout.simple.left-sidebar-floating .page-content-wrapper .page-sidebar .page-sidebar-card,.page-layout.simple.right-sidebar-floating .page-content-wrapper .page-sidebar .page-sidebar-card{-webkit-box-shadow:none;box-shadow:none}
}
.page-layout.simple.left-sidebar-floating .page-content-wrapper .page-content,.page-layout.simple.right-sidebar-floating .page-content-wrapper .page-content{-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex}
.page-layout.simple.tabbed .page-content>.nav-tabs{padding:0 2.4rem;background-color:#fff;-webkit-box-shadow:0 1px 3px 0 rgba(0,0,0,.2),0 1px 1px 0 rgba(0,0,0,.14),0 2px 1px -1px rgba(0,0,0,.12);box-shadow:0 1px 3px 0 rgba(0,0,0,.2),0 1px 1px 0 rgba(0,0,0,.14),0 2px 1px -1px rgba(0,0,0,.12)}
.page-layout.simple.tabbed .page-content>.tab-content{padding:2.4rem}
.page-layout.blank{min-height:100%}
@media (max-width:991px){.page-layout.simple.inner-sidenav.left-sidenav>.content,.page-layout.simple.inner-sidenav.right-sidenav>.content{height:auto!important}
.page-layout.simple.inner-sidenav.left-sidenav>.content>md-sidenav,.page-layout.simple.inner-sidenav.right-sidenav>.content>md-sidenav{margin-left:0;margin-right:0}
.sidenav-open .page-layout.simple.inner-sidenav{height:100%}
}
@media (max-width:767px){.page-layout .top-bg{height:16rem}
.page-layout.carded.full-width>.center,.page-layout.carded.left-sidenav>.center,.page-layout.carded.right-sidenav>.center{margin-left:16px;margin-right:16px}
.page-layout.carded.full-width>.center .header,.page-layout.carded.left-sidenav>.center .header,.page-layout.carded.right-sidenav>.center .header{height:9.6rem;min-height:9.6rem;max-height:9.6rem}
.page-layout.carded.full-width{height:auto}
.page-layout.carded.full-width>.center .content-card .content{overflow:hidden}
.page-layout.carded.left-sidenav,.page-layout.carded.right-sidenav{height:auto}
.page-layout.carded.left-sidenav>.center .content-card .content,.page-layout.carded.right-sidenav>.center .content-card .content{overflow:hidden}
.page-layout.simple.full-width>.header,.page-layout.simple.inner-sidenav>.header{height:16rem;min-height:16rem;max-height:16rem}
.page-layout.simple.left-sidenav>.center .header,.page-layout.simple.right-sidenav>.center .header{height:16rem;min-height:16rem;max-height:16rem}
.page-layout.simple.left-sidenav,.page-layout.simple.right-sidenav{height:auto}
.page-layout.simple.left-sidenav>.center,.page-layout.simple.right-sidenav>.center{overflow:hidden}
}
.divider-vertical{height:2.4rem;width:.1rem;margin:0 .8rem;background:rgba(0,0,0,.12)}
.divider{display:block;border-top-width:1px;border-top-style:solid;margin:0;border-top-color:rgba(0,0,0,.12)}
.avatar{width:4rem;min-width:4rem;height:4rem;line-height:4rem;-webkit-border-radius:50%;border-radius:50%;font-size:1.7rem;font-weight:500;text-align:center;color:#fff;background-color:#3c4252}
.avatar.square{-webkit-border-radius:0;border-radius:0}
.avatar.small{width:2rem;min-width:2rem;height:2rem;line-height:2rem}
.avatar.big{width:7.2rem;min-width:7.2rem;height:7.2rem;line-height:7.2rem}
.avatar.huge{width:9.6rem;min-width:9.6rem;height:9.6rem;line-height:9.6rem}
.h1,.h2,.h3,.h4,.h5,.h6{margin-bottom:0}
.btn{display:inline-block;font-weight:500;text-align:center;white-space:nowrap;vertical-align:middle;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;border:0 solid transparent;padding:0 1.6rem;font-size:1.4rem;line-height:1.78571;-webkit-border-radius:2px;border-radius:2px;position:relative;min-width:8.8rem;height:3.6rem;line-height:3.6rem;outline:0;text-decoration:none;text-transform:uppercase;overflow:hidden;-webkit-box-sizing:border-box;box-sizing:border-box;-webkit-appearance:none;letter-spacing:.04em;-webkit-box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12);box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12);-webkit-transition:-webkit-box-shadow 280ms cubic-bezier(.4,0,.2,1);transition:-webkit-box-shadow 280ms cubic-bezier(.4,0,.2,1);transition:box-shadow 280ms cubic-bezier(.4,0,.2,1);transition:box-shadow 280ms cubic-bezier(.4,0,.2,1),-webkit-box-shadow 280ms cubic-bezier(.4,0,.2,1);will-change:box-shadow}
.btn:focus,.btn:hover{text-decoration:none;cursor:pointer}
.btn.focus,.btn:focus{outline:0}
.btn::-moz-focus-inner{padding:0;border:0}
.btn.disabled,.btn:disabled{-webkit-box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12);box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12);color:rgba(0,0,0,.26)!important;background:rgba(0,0,0,.12)!important;cursor:default;pointer-events:none;opacity:1}
.btn.active,.btn:active{background-image:none;outline:0;-webkit-box-shadow:0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12);box-shadow:0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12)}
.btn[class*=btn-outline-]{border-width:1px;-webkit-box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12);box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12)}
.btn[class*=btn-outline-].focus,.btn[class*=btn-outline-]:focus{-webkit-box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12);box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12)}
.btn[class*=btn-outline-].active,.btn[class*=btn-outline-]:active{-webkit-box-shadow:0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12);box-shadow:0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12)}
.btn [class*=" icon-"],.btn [class^=icon-],.btn i{vertical-align:middle}
a.btn.disabled,fieldset[disabled] a.btn{pointer-events:none}
.btn-primary{color:#fff;background-color:#3c4252;border-color:#3c4252;-webkit-box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12);box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12);-webkit-transition:-webkit-box-shadow 280ms cubic-bezier(.4,0,.2,1);transition:-webkit-box-shadow 280ms cubic-bezier(.4,0,.2,1);transition:box-shadow 280ms cubic-bezier(.4,0,.2,1);transition:box-shadow 280ms cubic-bezier(.4,0,.2,1),-webkit-box-shadow 280ms cubic-bezier(.4,0,.2,1);will-change:box-shadow;color:#fff!important}
.btn-primary:hover{color:#fff;background-color:#2c303c;border-color:#262a35;color:#fff}
.btn-primary:hover a:hover{color:#1c1e26}
.btn-primary:hover [class*=" icon-"],.btn-primary:hover [class^=icon-],.btn-primary:hover i{color:rgba(255,255,255,.87)}
.btn-primary:hover .text-muted{color:rgba(255,255,255,.5)!important}
.btn-primary:hover .form-control{color:#fff;-webkit-box-shadow:0 1px 0 0 rgba(255,255,255,.7);box-shadow:0 1px 0 0 rgba(255,255,255,.7)}
.btn-primary:hover .form-control:hover{-webkit-box-shadow:0 2px 0 0 #fff;box-shadow:0 2px 0 0 #fff}
.btn-primary:hover .form-control:focus{-webkit-box-shadow:0 2px 0 0 #3c4252;box-shadow:0 2px 0 0 #3c4252}
.btn-primary:hover .form-control::-webkit-input-placeholder{color:rgba(255,255,255,.7)}
.btn-primary:hover .form-control::-moz-placeholder{color:rgba(255,255,255,.7)}
.btn-primary:hover .form-control:-ms-input-placeholder{color:rgba(255,255,255,.7)}
.btn-primary:hover .form-control::placeholder{color:rgba(255,255,255,.7)}
.btn-primary:hover textarea.form-control{-webkit-box-shadow:inset 0 0 0 1px rgba(255,255,255,.5);box-shadow:inset 0 0 0 1px rgba(255,255,255,.5)}
.btn-primary:hover textarea.form-control:hover{-webkit-box-shadow:inset 0 0 0 2px rgba(255,255,255,.5);box-shadow:inset 0 0 0 2px rgba(255,255,255,.5)}
.btn-primary:hover textarea.form-control:focus,.btn-primary:hover textarea.form-control:focus:hover{-webkit-box-shadow:inset 0 0 0 2px #3c4252;box-shadow:inset 0 0 0 2px #3c4252}
.btn-primary:hover select.form-control{background-image:url(data:image/svg+xml,%3Csvg%20width%3D%2210px%22%20height%3D%225px%22%20viewBox%3D%227%2010%2010%205%22%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%3E%0A%20%20%20%20%3Cpolygon%20id%3D%22Shape%22%20stroke%3D%22none%22%20fill%3D%22%23ffffff%22%20fill-rule%3D%22evenodd%22%20opacity%3D%220.5%22%20points%3D%227%2010%2012%2015%2017%2010%22%3E%3C%2Fpolygon%3E%0A%3C%2Fsvg%3E)}
.btn-primary:hover select.form-control[multiple],.btn-primary:hover select.form-control[size]{-webkit-box-shadow:inset 0 0 0 1px rgba(255,255,255,.5);box-shadow:inset 0 0 0 1px rgba(255,255,255,.5)}
.btn-primary:hover select.form-control[multiple]:hover,.btn-primary:hover select.form-control[size]:hover{-webkit-box-shadow:inset 0 0 0 2px rgba(255,255,255,.5);box-shadow:inset 0 0 0 2px rgba(255,255,255,.5)}
.btn-primary:hover select.form-control[multiple]:focus,.btn-primary:hover select.form-control[multiple]:focus:hover,.btn-primary:hover select.form-control[size]:focus,.btn-primary:hover select.form-control[size]:focus:hover{-webkit-box-shadow:inset 0 0 0 2px #3c4252;box-shadow:inset 0 0 0 2px #3c4252}
.btn-primary:hover .form-group>label{color:rgba(255,255,255,.7)}
.btn-primary:hover .nav .subheader{color:rgba(255,255,255,.5)}
.btn-primary:hover .nav .nav-link{color:#fff}
.btn-primary:hover .nav .nav-link:hover{color:#3c4252}
.btn-primary:hover .nav .nav-link:hover>i{color:#3c4252}
.btn-primary:hover .custom-checkbox input[type=radio]~.custom-control-indicator:before,.btn-primary:hover .custom-checkbox input[type=radio]~.radio-icon:before,.btn-primary:hover .custom-radio input[type=radio]~.custom-control-indicator:before,.btn-primary:hover .custom-radio input[type=radio]~.radio-icon:before,.btn-primary:hover .form-check-label input[type=radio]~.custom-control-indicator:before,.btn-primary:hover .form-check-label input[type=radio]~.radio-icon:before{border-color:rgba(255,255,255,.7)}
.btn-primary:hover .custom-checkbox input[type=checkbox]~.checkbox-icon:before,.btn-primary:hover .custom-checkbox input[type=checkbox]~.custom-control-indicator:before,.btn-primary:hover .custom-radio input[type=checkbox]~.checkbox-icon:before,.btn-primary:hover .custom-radio input[type=checkbox]~.custom-control-indicator:before,.btn-primary:hover .form-check-label input[type=checkbox]~.checkbox-icon:before,.btn-primary:hover .form-check-label input[type=checkbox]~.custom-control-indicator:before{color:rgba(255,255,255,.7)}
.btn-primary:hover input[type=checkbox]:disabled~.checkbox-icon,.btn-primary:hover input[type=checkbox]:disabled~.custom-control-indicator,.btn-primary:hover input[type=checkbox]:disabled~.form-check-description,.btn-primary:hover input[type=checkbox][disabled]~.checkbox-icon,.btn-primary:hover input[type=checkbox][disabled]~.custom-control-indicator,.btn-primary:hover input[type=checkbox][disabled]~.form-check-description{color:rgba(255,255,255,.5)!important}
.btn-primary:hover .form-check.disabled .form-check-label{color:rgba(255,255,255,.5)!important}
.btn-primary:hover .custom-control-input:disabled~.custom-control-description{color:rgba(255,255,255,.5)}
.btn-primary:hover #sidenav .nav-link:hover:not(.active){background:rgba(255,255,255,.1)!important}
.btn-primary:hover #sidenav .nav-link:hover:not(.active)>i{color:rgba(255,255,255,.87)!important}
.btn-primary a:hover{color:#1c1e26}
.btn-primary [class*=" icon-"],.btn-primary [class^=icon-],.btn-primary i{color:rgba(255,255,255,.87)!important}
.btn-primary .text-muted{color:rgba(255,255,255,.5)!important}
.btn-primary .form-control{color:#fff;-webkit-box-shadow:0 1px 0 0 rgba(255,255,255,.7);box-shadow:0 1px 0 0 rgba(255,255,255,.7)}
.btn-primary .form-control:hover{-webkit-box-shadow:0 2px 0 0 #fff;box-shadow:0 2px 0 0 #fff}
.btn-primary .form-control:focus{-webkit-box-shadow:0 2px 0 0 #3c4252;box-shadow:0 2px 0 0 #3c4252}
.btn-primary .form-control::-webkit-input-placeholder{color:rgba(255,255,255,.7)}
.btn-primary .form-control::-moz-placeholder{color:rgba(255,255,255,.7)}
.btn-primary .form-control:-ms-input-placeholder{color:rgba(255,255,255,.7)}
.btn-primary .form-control::placeholder{color:rgba(255,255,255,.7)}
.btn-primary textarea.form-control{-webkit-box-shadow:inset 0 0 0 1px rgba(255,255,255,.5);box-shadow:inset 0 0 0 1px rgba(255,255,255,.5)}
.btn-primary textarea.form-control:hover{-webkit-box-shadow:inset 0 0 0 2px rgba(255,255,255,.5);box-shadow:inset 0 0 0 2px rgba(255,255,255,.5)}
.btn-primary textarea.form-control:focus,.btn-primary textarea.form-control:focus:hover{-webkit-box-shadow:inset 0 0 0 2px #3c4252;box-shadow:inset 0 0 0 2px #3c4252}
.btn-primary select.form-control{background-image:url(data:image/svg+xml,%3Csvg%20width%3D%2210px%22%20height%3D%225px%22%20viewBox%3D%227%2010%2010%205%22%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%3E%0A%20%20%20%20%3Cpolygon%20id%3D%22Shape%22%20stroke%3D%22none%22%20fill%3D%22%23ffffff%22%20fill-rule%3D%22evenodd%22%20opacity%3D%220.5%22%20points%3D%227%2010%2012%2015%2017%2010%22%3E%3C%2Fpolygon%3E%0A%3C%2Fsvg%3E)}
.btn-primary select.form-control[multiple],.btn-primary select.form-control[size]{-webkit-box-shadow:inset 0 0 0 1px rgba(255,255,255,.5);box-shadow:inset 0 0 0 1px rgba(255,255,255,.5)}
.btn-primary select.form-control[multiple]:hover,.btn-primary select.form-control[size]:hover{-webkit-box-shadow:inset 0 0 0 2px rgba(255,255,255,.5);box-shadow:inset 0 0 0 2px rgba(255,255,255,.5)}
.btn-primary select.form-control[multiple]:focus,.btn-primary select.form-control[multiple]:focus:hover,.btn-primary select.form-control[size]:focus,.btn-primary select.form-control[size]:focus:hover{-webkit-box-shadow:inset 0 0 0 2px #3c4252;box-shadow:inset 0 0 0 2px #3c4252}
.btn-primary .form-group>label{color:rgba(255,255,255,.7)}
.btn-primary .nav .subheader{color:rgba(255,255,255,.5)}
.btn-primary .nav .nav-link{color:#fff}
.btn-primary .nav .nav-link:hover{color:#3c4252}
.btn-primary .nav .nav-link:hover>i{color:#3c4252}
.btn-primary .custom-checkbox input[type=radio]~.custom-control-indicator:before,.btn-primary .custom-checkbox input[type=radio]~.radio-icon:before,.btn-primary .custom-radio input[type=radio]~.custom-control-indicator:before,.btn-primary .custom-radio input[type=radio]~.radio-icon:before,.btn-primary .form-check-label input[type=radio]~.custom-control-indicator:before,.btn-primary .form-check-label input[type=radio]~.radio-icon:before{border-color:rgba(255,255,255,.7)}
.btn-primary .custom-checkbox input[type=checkbox]~.checkbox-icon:before,.btn-primary .custom-checkbox input[type=checkbox]~.custom-control-indicator:before,.btn-primary .custom-radio input[type=checkbox]~.checkbox-icon:before,.btn-primary .custom-radio input[type=checkbox]~.custom-control-indicator:before,.btn-primary .form-check-label input[type=checkbox]~.checkbox-icon:before,.btn-primary .form-check-label input[type=checkbox]~.custom-control-indicator:before{color:rgba(255,255,255,.7)}
.btn-primary input[type=checkbox]:disabled~.checkbox-icon,.btn-primary input[type=checkbox]:disabled~.custom-control-indicator,.btn-primary input[type=checkbox]:disabled~.form-check-description,.btn-primary input[type=checkbox][disabled]~.checkbox-icon,.btn-primary input[type=checkbox][disabled]~.custom-control-indicator,.btn-primary input[type=checkbox][disabled]~.form-check-description{color:rgba(255,255,255,.5)!important}
.btn-primary .form-check.disabled .form-check-label{color:rgba(255,255,255,.5)!important}
.btn-primary .custom-control-input:disabled~.custom-control-description{color:rgba(255,255,255,.5)}
.btn-primary #sidenav .nav-link:hover:not(.active){background:rgba(255,255,255,.1)!important}
.btn-primary #sidenav .nav-link:hover:not(.active)>i{color:rgba(255,255,255,.87)!important}
.btn-primary.disabled,.btn-primary:disabled{background-color:#3c4252;border-color:#3c4252}
.btn-primary.active,.btn-primary:active,.show>.btn-primary.dropdown-toggle{color:#fff;background-color:#2c303c;background-image:none;-webkit-box-shadow:0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12);box-shadow:0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12)}
.btn-primary.active a:hover,.btn-primary:active a:hover,.show>.btn-primary.dropdown-toggle a:hover{color:#1c1e26}
.btn-primary.active [class*=" icon-"],.btn-primary.active [class^=icon-],.btn-primary.active i,.btn-primary:active [class*=" icon-"],.btn-primary:active [class^=icon-],.btn-primary:active i,.show>.btn-primary.dropdown-toggle [class*=" icon-"],.show>.btn-primary.dropdown-toggle [class^=icon-],.show>.btn-primary.dropdown-toggle i{color:rgba(255,255,255,.87)}
.btn-primary.active .text-muted,.btn-primary:active .text-muted,.show>.btn-primary.dropdown-toggle .text-muted{color:rgba(255,255,255,.5)!important}
.btn-primary.active .form-control,.btn-primary:active .form-control,.show>.btn-primary.dropdown-toggle .form-control{color:#fff;-webkit-box-shadow:0 1px 0 0 rgba(255,255,255,.7);box-shadow:0 1px 0 0 rgba(255,255,255,.7)}
.btn-primary.active .form-control:hover,.btn-primary:active .form-control:hover,.show>.btn-primary.dropdown-toggle .form-control:hover{-webkit-box-shadow:0 2px 0 0 #fff;box-shadow:0 2px 0 0 #fff}
.btn-primary.active .form-control:focus,.btn-primary:active .form-control:focus,.show>.btn-primary.dropdown-toggle .form-control:focus{-webkit-box-shadow:0 2px 0 0 #3c4252;box-shadow:0 2px 0 0 #3c4252}
.btn-primary.active .form-control::-webkit-input-placeholder,.btn-primary:active .form-control::-webkit-input-placeholder,.show>.btn-primary.dropdown-toggle .form-control::-webkit-input-placeholder{color:rgba(255,255,255,.7)}
.btn-primary.active .form-control::-moz-placeholder,.btn-primary:active .form-control::-moz-placeholder,.show>.btn-primary.dropdown-toggle .form-control::-moz-placeholder{color:rgba(255,255,255,.7)}
.btn-primary.active .form-control:-ms-input-placeholder,.btn-primary:active .form-control:-ms-input-placeholder,.show>.btn-primary.dropdown-toggle .form-control:-ms-input-placeholder{color:rgba(255,255,255,.7)}
.btn-primary.active .form-control::placeholder,.btn-primary:active .form-control::placeholder,.show>.btn-primary.dropdown-toggle .form-control::placeholder{color:rgba(255,255,255,.7)}
.btn-primary.active textarea.form-control,.btn-primary:active textarea.form-control,.show>.btn-primary.dropdown-toggle textarea.form-control{-webkit-box-shadow:inset 0 0 0 1px rgba(255,255,255,.5);box-shadow:inset 0 0 0 1px rgba(255,255,255,.5)}
.btn-primary.active textarea.form-control:hover,.btn-primary:active textarea.form-control:hover,.show>.btn-primary.dropdown-toggle textarea.form-control:hover{-webkit-box-shadow:inset 0 0 0 2px rgba(255,255,255,.5);box-shadow:inset 0 0 0 2px rgba(255,255,255,.5)}
.btn-primary.active textarea.form-control:focus,.btn-primary.active textarea.form-control:focus:hover,.btn-primary:active textarea.form-control:focus,.btn-primary:active textarea.form-control:focus:hover,.show>.btn-primary.dropdown-toggle textarea.form-control:focus,.show>.btn-primary.dropdown-toggle textarea.form-control:focus:hover{-webkit-box-shadow:inset 0 0 0 2px #3c4252;box-shadow:inset 0 0 0 2px #3c4252}
.btn-primary.active select.form-control,.btn-primary:active select.form-control,.show>.btn-primary.dropdown-toggle select.form-control{background-image:url(data:image/svg+xml,%3Csvg%20width%3D%2210px%22%20height%3D%225px%22%20viewBox%3D%227%2010%2010%205%22%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%3E%0A%20%20%20%20%3Cpolygon%20id%3D%22Shape%22%20stroke%3D%22none%22%20fill%3D%22%23ffffff%22%20fill-rule%3D%22evenodd%22%20opacity%3D%220.5%22%20points%3D%227%2010%2012%2015%2017%2010%22%3E%3C%2Fpolygon%3E%0A%3C%2Fsvg%3E)}
.btn-primary.active select.form-control[multiple],.btn-primary.active select.form-control[size],.btn-primary:active select.form-control[multiple],.btn-primary:active select.form-control[size],.show>.btn-primary.dropdown-toggle select.form-control[multiple],.show>.btn-primary.dropdown-toggle select.form-control[size]{-webkit-box-shadow:inset 0 0 0 1px rgba(255,255,255,.5);box-shadow:inset 0 0 0 1px rgba(255,255,255,.5)}
.btn-primary.active select.form-control[multiple]:hover,.btn-primary.active select.form-control[size]:hover,.btn-primary:active select.form-control[multiple]:hover,.btn-primary:active select.form-control[size]:hover,.show>.btn-primary.dropdown-toggle select.form-control[multiple]:hover,.show>.btn-primary.dropdown-toggle select.form-control[size]:hover{-webkit-box-shadow:inset 0 0 0 2px rgba(255,255,255,.5);box-shadow:inset 0 0 0 2px rgba(255,255,255,.5)}
.btn-primary.active select.form-control[multiple]:focus,.btn-primary.active select.form-control[multiple]:focus:hover,.btn-primary.active select.form-control[size]:focus,.btn-primary.active select.form-control[size]:focus:hover,.btn-primary:active select.form-control[multiple]:focus,.btn-primary:active select.form-control[multiple]:focus:hover,.btn-primary:active select.form-control[size]:focus,.btn-primary:active select.form-control[size]:focus:hover,.show>.btn-primary.dropdown-toggle select.form-control[multiple]:focus,.show>.btn-primary.dropdown-toggle select.form-control[multiple]:focus:hover,.show>.btn-primary.dropdown-toggle select.form-control[size]:focus,.show>.btn-primary.dropdown-toggle select.form-control[size]:focus:hover{-webkit-box-shadow:inset 0 0 0 2px #3c4252;box-shadow:inset 0 0 0 2px #3c4252}
.btn-primary.active .form-group>label,.btn-primary:active .form-group>label,.show>.btn-primary.dropdown-toggle .form-group>label{color:rgba(255,255,255,.7)}
.btn-primary.active .nav .subheader,.btn-primary:active .nav .subheader,.show>.btn-primary.dropdown-toggle .nav .subheader{color:rgba(255,255,255,.5)}
.btn-primary.active .nav .nav-link,.btn-primary:active .nav .nav-link,.show>.btn-primary.dropdown-toggle .nav .nav-link{color:#fff}
.btn-primary.active .nav .nav-link:hover,.btn-primary:active .nav .nav-link:hover,.show>.btn-primary.dropdown-toggle .nav .nav-link:hover{color:#3c4252}
.btn-primary.active .nav .nav-link:hover>i,.btn-primary:active .nav .nav-link:hover>i,.show>.btn-primary.dropdown-toggle .nav .nav-link:hover>i{color:#3c4252}
.btn-primary.active .custom-checkbox input[type=radio]~.custom-control-indicator:before,.btn-primary.active .custom-checkbox input[type=radio]~.radio-icon:before,.btn-primary.active .custom-radio input[type=radio]~.custom-control-indicator:before,.btn-primary.active .custom-radio input[type=radio]~.radio-icon:before,.btn-primary.active .form-check-label input[type=radio]~.custom-control-indicator:before,.btn-primary.active .form-check-label input[type=radio]~.radio-icon:before,.btn-primary:active .custom-checkbox input[type=radio]~.custom-control-indicator:before,.btn-primary:active .custom-checkbox input[type=radio]~.radio-icon:before,.btn-primary:active .custom-radio input[type=radio]~.custom-control-indicator:before,.btn-primary:active .custom-radio input[type=radio]~.radio-icon:before,.btn-primary:active .form-check-label input[type=radio]~.custom-control-indicator:before,.btn-primary:active .form-check-label input[type=radio]~.radio-icon:before,.show>.btn-primary.dropdown-toggle .custom-checkbox input[type=radio]~.custom-control-indicator:before,.show>.btn-primary.dropdown-toggle .custom-checkbox input[type=radio]~.radio-icon:before,.show>.btn-primary.dropdown-toggle .custom-radio input[type=radio]~.custom-control-indicator:before,.show>.btn-primary.dropdown-toggle .custom-radio input[type=radio]~.radio-icon:before,.show>.btn-primary.dropdown-toggle .form-check-label input[type=radio]~.custom-control-indicator:before,.show>.btn-primary.dropdown-toggle .form-check-label input[type=radio]~.radio-icon:before{border-color:rgba(255,255,255,.7)}
.btn-primary.active .custom-checkbox input[type=checkbox]~.checkbox-icon:before,.btn-primary.active .custom-checkbox input[type=checkbox]~.custom-control-indicator:before,.btn-primary.active .custom-radio input[type=checkbox]~.checkbox-icon:before,.btn-primary.active .custom-radio input[type=checkbox]~.custom-control-indicator:before,.btn-primary.active .form-check-label input[type=checkbox]~.checkbox-icon:before,.btn-primary.active .form-check-label input[type=checkbox]~.custom-control-indicator:before,.btn-primary:active .custom-checkbox input[type=checkbox]~.checkbox-icon:before,.btn-primary:active .custom-checkbox input[type=checkbox]~.custom-control-indicator:before,.btn-primary:active .custom-radio input[type=checkbox]~.checkbox-icon:before,.btn-primary:active .custom-radio input[type=checkbox]~.custom-control-indicator:before,.btn-primary:active .form-check-label input[type=checkbox]~.checkbox-icon:before,.btn-primary:active .form-check-label input[type=checkbox]~.custom-control-indicator:before,.show>.btn-primary.dropdown-toggle .custom-checkbox input[type=checkbox]~.checkbox-icon:before,.show>.btn-primary.dropdown-toggle .custom-checkbox input[type=checkbox]~.custom-control-indicator:before,.show>.btn-primary.dropdown-toggle .custom-radio input[type=checkbox]~.checkbox-icon:before,.show>.btn-primary.dropdown-toggle .custom-radio input[type=checkbox]~.custom-control-indicator:before,.show>.btn-primary.dropdown-toggle .form-check-label input[type=checkbox]~.checkbox-icon:before,.show>.btn-primary.dropdown-toggle .form-check-label input[type=checkbox]~.custom-control-indicator:before{color:rgba(255,255,255,.7)}
.btn-primary.active input[type=checkbox]:disabled~.checkbox-icon,.btn-primary.active input[type=checkbox]:disabled~.custom-control-indicator,.btn-primary.active input[type=checkbox]:disabled~.form-check-description,.btn-primary.active input[type=checkbox][disabled]~.checkbox-icon,.btn-primary.active input[type=checkbox][disabled]~.custom-control-indicator,.btn-primary.active input[type=checkbox][disabled]~.form-check-description,.btn-primary:active input[type=checkbox]:disabled~.checkbox-icon,.btn-primary:active input[type=checkbox]:disabled~.custom-control-indicator,.btn-primary:active input[type=checkbox]:disabled~.form-check-description,.btn-primary:active input[type=checkbox][disabled]~.checkbox-icon,.btn-primary:active input[type=checkbox][disabled]~.custom-control-indicator,.btn-primary:active input[type=checkbox][disabled]~.form-check-description,.show>.btn-primary.dropdown-toggle input[type=checkbox]:disabled~.checkbox-icon,.show>.btn-primary.dropdown-toggle input[type=checkbox]:disabled~.custom-control-indicator,.show>.btn-primary.dropdown-toggle input[type=checkbox]:disabled~.form-check-description,.show>.btn-primary.dropdown-toggle input[type=checkbox][disabled]~.checkbox-icon,.show>.btn-primary.dropdown-toggle input[type=checkbox][disabled]~.custom-control-indicator,.show>.btn-primary.dropdown-toggle input[type=checkbox][disabled]~.form-check-description{color:rgba(255,255,255,.5)!important}
.btn-primary.active .form-check.disabled .form-check-label,.btn-primary:active .form-check.disabled .form-check-label,.show>.btn-primary.dropdown-toggle .form-check.disabled .form-check-label{color:rgba(255,255,255,.5)!important}
.btn-primary.active .custom-control-input:disabled~.custom-control-description,.btn-primary:active .custom-control-input:disabled~.custom-control-description,.show>.btn-primary.dropdown-toggle .custom-control-input:disabled~.custom-control-description{color:rgba(255,255,255,.5)}
.btn-primary.active #sidenav .nav-link:hover:not(.active),.btn-primary:active #sidenav .nav-link:hover:not(.active),.show>.btn-primary.dropdown-toggle #sidenav .nav-link:hover:not(.active){background:rgba(255,255,255,.1)!important}
.btn-primary.active #sidenav .nav-link:hover:not(.active)>i,.btn-primary:active #sidenav .nav-link:hover:not(.active)>i,.show>.btn-primary.dropdown-toggle #sidenav .nav-link:hover:not(.active)>i{color:rgba(255,255,255,.87)!important}
.btn-link{font-weight:400;color:initial;-webkit-border-radius:0;border-radius:0;min-width:6.4rem}
.btn-link,.btn-link.active,.btn-link:active,.btn-link:disabled{background-color:transparent;-webkit-box-shadow:none;box-shadow:none}
.btn-link,.btn-link:active,.btn-link:focus{border-color:transparent;-webkit-box-shadow:none;box-shadow:none}
.btn-link:hover{border-color:transparent;background-color:rgba(0,0,0,.03)}
.btn-link:focus,.btn-link:hover{color:#1c1e26;text-decoration:underline;background-color:transparent}
.btn-link:disabled{color:#868e96}
.btn-link:disabled:focus,.btn-link:disabled:hover{text-decoration:none}
.btn-icon,.btn-link{background-color:transparent;text-decoration:none!important;-webkit-box-shadow:none;box-shadow:none}
.btn-icon.focus,.btn-icon:focus,.btn-link.focus,.btn-link:focus{-webkit-box-shadow:none;box-shadow:none}
.btn-icon.active,.btn-icon:active,.btn-link.active,.btn-link:active{-webkit-box-shadow:none;box-shadow:none}
.btn-icon.disabled,.btn-icon:disabled,.btn-link.disabled,.btn-link:disabled{background:0 0}
.btn-group-lg>.btn,.btn-lg{padding:0 1.6rem;font-size:1.6rem;line-height:2.25;-webkit-border-radius:2px;border-radius:2px;height:-webkit-calc(2.925rem + 0px);height:calc(2.925rem + 0px);line-height:-webkit-calc(2.925rem + 0px);line-height:calc(2.925rem + 0px)}
.btn-group-sm>.btn,.btn-sm{padding:0 1.6rem;font-size:1.3rem;line-height:2.46154;-webkit-border-radius:2px;border-radius:2px;height:-webkit-calc(2.32143rem + 0px);height:calc(2.32143rem + 0px);line-height:-webkit-calc(2.32143rem + 0px);line-height:calc(2.32143rem + 0px)}
.btn-icon{background:0 0;min-width:auto;min-width:initial;height:auto;line-height:normal;padding:.8rem;-webkit-border-radius:100%!important;border-radius:100%!important}
.btn-fab{line-height:5.6rem;width:5.6rem;min-width:5.6rem;height:5.6rem;min-height:5.6rem;overflow:hidden!important;display:-webkit-inline-box;display:-webkit-inline-flex;display:-ms-inline-flexbox;display:inline-flex;position:relative;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;padding:0;border:none;-webkit-border-radius:50%;border-radius:50%;-webkit-box-sizing:border-box;box-sizing:border-box}
.btn-fab.btn-sm,.btn-group-sm>.btn-fab.btn{line-height:4rem;width:4rem;min-width:4rem;height:4rem;min-height:4rem}
.btn-fab [class*=" icon-"],.btn-fab [class^=icon-],.btn-fab i{width:100%;width:100%}
.btn-block{display:block;width:100%}
.btn-block+.btn-block{margin-top:.5rem}
input[type=button].btn-block,input[type=reset].btn-block,input[type=submit].btn-block{width:100%}
.btn-group,.btn-group-vertical{-webkit-box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12);box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12)}
.btn-group-vertical>.btn,.btn-group>.btn{-webkit-box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12);box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12);display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;min-width:4rem;min-height:4rem;line-height:2.4rem}
.btn-group-vertical>.btn.active,.btn-group-vertical>.btn.focus,.btn-group-vertical>.btn:active,.btn-group-vertical>.btn:focus,.btn-group>.btn.active,.btn-group>.btn.focus,.btn-group>.btn:active,.btn-group>.btn:focus{-webkit-box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12);box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12)}
.btn-group-vertical>.btn [class*=" icon-"],.btn-group-vertical>.btn [class^=icon-],.btn-group-vertical>.btn i,.btn-group>.btn [class*=" icon-"],.btn-group>.btn [class^=icon-],.btn-group>.btn i{vertical-align:middle}
.btn-group .btn-group,.btn-group-vertical .btn-group{-webkit-box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12);box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12)}
.btn-toolbar{-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;min-height:6.4rem}
.btn-toolbar .btn-group{-webkit-box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12);box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12);margin:0 .8rem}
.btn-toolbar .btn-group:last-child:after{display:none}
.btn-toolbar .btn-group .btn{-webkit-box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12);box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12);min-width:4rem;min-height:4rem;line-height:2.4rem}
.btn-toolbar .btn-group .btn:not(.dropdown-toggle){padding:.8rem}
.btn-toolbar .btn-group .btn-group{margin:0 .8rem}
.btn-toolbar .input-group{margin:.4rem .8rem}
.btn+.dropdown-toggle-split{min-width:0}
button,input[type=button],input[type=email],input[type=image],input[type=password],input[type=search],input[type=submit],input[type=tel],input[type=text],textarea{appearance:none;-moz-appearance:none;-webkit-appearance:none;border:none;outline:0}
.form-control{padding:0;border:0 solid transparent;-webkit-box-shadow:0 1px 0 0 rgba(0,0,0,.42);box-shadow:0 1px 0 0 rgba(0,0,0,.42);-webkit-transition:-webkit-box-shadow 180ms cubic-bezier(.4,0,.2,1);transition:-webkit-box-shadow 180ms cubic-bezier(.4,0,.2,1);transition:box-shadow 180ms cubic-bezier(.4,0,.2,1);transition:box-shadow 180ms cubic-bezier(.4,0,.2,1),-webkit-box-shadow 180ms cubic-bezier(.4,0,.2,1)}
.form-control:hover{-webkit-box-shadow:0 2px 0 0 rgba(0,0,0,.87);box-shadow:0 2px 0 0 rgba(0,0,0,.87)}
.form-control:focus{-webkit-box-shadow:0 2px 0 0 #3c4252;box-shadow:0 2px 0 0 #3c4252}
label+.form-control::-webkit-input-placeholder{color:rgba(0,0,0,.54);opacity:1!important}
label+.form-control::-moz-placeholder{color:rgba(0,0,0,.54);opacity:1!important}
label+.form-control:-ms-input-placeholder{color:rgba(0,0,0,.54);opacity:1!important}
label+.form-control::placeholder{color:rgba(0,0,0,.54);opacity:1!important}
select.form-control{padding-right:24px;padding-bottom:0;-webkit-appearance:none;-moz-appearance:none;appearance:none;max-width:-webkit-calc(100% - 24px);max-width:calc(100% - 24px);background:0 0;background-repeat:no-repeat;background-position:right center;background-image:url(data:image/svg+xml,%3Csvg%20width%3D%2210px%22%20height%3D%225px%22%20viewBox%3D%227%2010%2010%205%22%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%3E%0A%20%20%20%20%3Cpolygon%20id%3D%22Shape%22%20stroke%3D%22none%22%20fill%3D%22%230%22%20fill-rule%3D%22evenodd%22%20opacity%3D%220.38%22%20points%3D%227%2010%2012%2015%2017%2010%22%3E%3C%2Fpolygon%3E%0A%3C%2Fsvg%3E);cursor:pointer}
select.form-control[multiple],select.form-control[size]{-webkit-box-shadow:inset 0 0 0 1px rgba(0,0,0,.12);box-shadow:inset 0 0 0 1px rgba(0,0,0,.12)}
select.form-control[multiple]:focus,select.form-control[size]:focus{-webkit-box-shadow:inset 0 0 0 2px #3c4252;box-shadow:inset 0 0 0 2px #3c4252}
select.form-control:not([multiple]):not([size]) option{color:#495057}
select.form-control option{padding:16px 40px;margin:0 -24px}
.col-form-label{padding-top:0;font-size:1.4rem;line-height:normal}
.col-form-label-lg{padding-top:0;line-height:normal}
.col-form-label-sm{padding-top:0;line-height:normal}
.form-control-plaintext{display:block;padding:0 1.6rem;font-size:1.4rem}
.form-control-plaintext.form-control-sm,.input-group-sm>.form-control-plaintext.form-control,.input-group-sm>.form-control-plaintext.input-group-addon,.input-group-sm>.input-group-btn>.form-control-plaintext.btn{font-size:1.3rem}
.form-control-plaintext.form-control-lg,.input-group-lg>.form-control-plaintext.form-control,.input-group-lg>.form-control-plaintext.input-group-addon,.input-group-lg>.input-group-btn>.form-control-plaintext.btn{font-size:1.6rem}
.form-control-sm,.input-group-sm>.form-control,.input-group-sm>.input-group-addon,.input-group-sm>.input-group-btn>.btn{padding:0}
.input-group-sm>.input-group-btn>select.btn:not([size]):not([multiple]),.input-group-sm>select.form-control:not([size]):not([multiple]),.input-group-sm>select.input-group-addon:not([size]):not([multiple]),select.form-control-sm:not([size]):not([multiple]){height:-webkit-calc(2.32143rem + 0px);height:calc(2.32143rem + 0px)}
.form-control-lg,.input-group-lg>.form-control,.input-group-lg>.input-group-addon,.input-group-lg>.input-group-btn>.btn{padding:0}
.form-row .form-control+.col-form-label{left:5px!important}
.form-check.disabled .form-check-label{color:rgba(0,0,0,.38)!important;cursor:not-allowed}
.form-check-label{cursor:pointer}
input[type=checkbox]:disabled~.checkbox-icon,input[type=checkbox]:disabled~.custom-control-indicator,input[type=checkbox]:disabled~.form-check-description,input[type=checkbox][disabled]~.checkbox-icon,input[type=checkbox][disabled]~.custom-control-indicator,input[type=checkbox][disabled]~.form-check-description{color:rgba(0,0,0,.38)!important}
.custom-control-input,.form-check-input{opacity:0;width:40px;height:40px;position:relative;margin-top:0;margin-left:-1.2rem}
.custom-control-input:only-child,.form-check-input:only-child{position:static}
@media (min-width:576px){.form-inline .form-check-input{margin-right:0;margin-left:-1.2rem}
.form-inline .custom-control-indicator{position:absolute}
}
.form-group{padding-top:1.6rem;margin-bottom:3.2rem}
.form-group.row>label{-webkit-transform:scale(1);-ms-transform:scale(1);transform:scale(1)}
.form-group>label{width:100%;color:rgba(0,0,0,.38);-webkit-transform:scale(.923,.923);-ms-transform:scale(.923,.923);transform:scale(.923,.923);-webkit-transform-origin:left;-ms-transform-origin:left;transform-origin:left}
.form-check,.form-group{font-size:1.6rem;will-change:opacity,transform,color;letter-spacing:.04em;position:relative;-webkit-box-sizing:border-box;box-sizing:border-box;-webkit-box-align:start;-webkit-align-items:flex-start;-ms-flex-align:start;align-items:flex-start;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap}
.form-check.md-focus input[type=date].form-control::-webkit-input-placeholder,.form-check.md-focus input[type=datetime-local].form-control::-webkit-input-placeholder,.form-check.md-focus input[type=email].form-control::-webkit-input-placeholder,.form-check.md-focus input[type=month].form-control::-webkit-input-placeholder,.form-check.md-focus input[type=number].form-control::-webkit-input-placeholder,.form-check.md-focus input[type=password].form-control::-webkit-input-placeholder,.form-check.md-focus input[type=search].form-control::-webkit-input-placeholder,.form-check.md-focus input[type=tel].form-control::-webkit-input-placeholder,.form-check.md-focus input[type=text].form-control::-webkit-input-placeholder,.form-check.md-focus input[type=time].form-control::-webkit-input-placeholder,.form-check.md-focus input[type=url].form-control::-webkit-input-placeholder,.form-check.md-focus input[type=week].form-control::-webkit-input-placeholder,.form-check.md-focus textarea.form-control::-webkit-input-placeholder,.form-group.md-focus input[type=date].form-control::-webkit-input-placeholder,.form-group.md-focus input[type=datetime-local].form-control::-webkit-input-placeholder,.form-group.md-focus input[type=email].form-control::-webkit-input-placeholder,.form-group.md-focus input[type=month].form-control::-webkit-input-placeholder,.form-group.md-focus input[type=number].form-control::-webkit-input-placeholder,.form-group.md-focus input[type=password].form-control::-webkit-input-placeholder,.form-group.md-focus input[type=search].form-control::-webkit-input-placeholder,.form-group.md-focus input[type=tel].form-control::-webkit-input-placeholder,.form-group.md-focus input[type=text].form-control::-webkit-input-placeholder,.form-group.md-focus input[type=time].form-control::-webkit-input-placeholder,.form-group.md-focus input[type=url].form-control::-webkit-input-placeholder,.form-group.md-focus input[type=week].form-control::-webkit-input-placeholder,.form-group.md-focus textarea.form-control::-webkit-input-placeholder{opacity:1}
.form-check.md-focus input[type=date].form-control::-moz-placeholder,.form-check.md-focus input[type=datetime-local].form-control::-moz-placeholder,.form-check.md-focus input[type=email].form-control::-moz-placeholder,.form-check.md-focus input[type=month].form-control::-moz-placeholder,.form-check.md-focus input[type=number].form-control::-moz-placeholder,.form-check.md-focus input[type=password].form-control::-moz-placeholder,.form-check.md-focus input[type=search].form-control::-moz-placeholder,.form-check.md-focus input[type=tel].form-control::-moz-placeholder,.form-check.md-focus input[type=text].form-control::-moz-placeholder,.form-check.md-focus input[type=time].form-control::-moz-placeholder,.form-check.md-focus input[type=url].form-control::-moz-placeholder,.form-check.md-focus input[type=week].form-control::-moz-placeholder,.form-check.md-focus textarea.form-control::-moz-placeholder,.form-group.md-focus input[type=date].form-control::-moz-placeholder,.form-group.md-focus input[type=datetime-local].form-control::-moz-placeholder,.form-group.md-focus input[type=email].form-control::-moz-placeholder,.form-group.md-focus input[type=month].form-control::-moz-placeholder,.form-group.md-focus input[type=number].form-control::-moz-placeholder,.form-group.md-focus input[type=password].form-control::-moz-placeholder,.form-group.md-focus input[type=search].form-control::-moz-placeholder,.form-group.md-focus input[type=tel].form-control::-moz-placeholder,.form-group.md-focus input[type=text].form-control::-moz-placeholder,.form-group.md-focus input[type=time].form-control::-moz-placeholder,.form-group.md-focus input[type=url].form-control::-moz-placeholder,.form-group.md-focus input[type=week].form-control::-moz-placeholder,.form-group.md-focus textarea.form-control::-moz-placeholder{opacity:1}
.form-check.md-focus input[type=date].form-control:-ms-input-placeholder,.form-check.md-focus input[type=datetime-local].form-control:-ms-input-placeholder,.form-check.md-focus input[type=email].form-control:-ms-input-placeholder,.form-check.md-focus input[type=month].form-control:-ms-input-placeholder,.form-check.md-focus input[type=number].form-control:-ms-input-placeholder,.form-check.md-focus input[type=password].form-control:-ms-input-placeholder,.form-check.md-focus input[type=search].form-control:-ms-input-placeholder,.form-check.md-focus input[type=tel].form-control:-ms-input-placeholder,.form-check.md-focus input[type=text].form-control:-ms-input-placeholder,.form-check.md-focus input[type=time].form-control:-ms-input-placeholder,.form-check.md-focus input[type=url].form-control:-ms-input-placeholder,.form-check.md-focus input[type=week].form-control:-ms-input-placeholder,.form-check.md-focus textarea.form-control:-ms-input-placeholder,.form-group.md-focus input[type=date].form-control:-ms-input-placeholder,.form-group.md-focus input[type=datetime-local].form-control:-ms-input-placeholder,.form-group.md-focus input[type=email].form-control:-ms-input-placeholder,.form-group.md-focus input[type=month].form-control:-ms-input-placeholder,.form-group.md-focus input[type=number].form-control:-ms-input-placeholder,.form-group.md-focus input[type=password].form-control:-ms-input-placeholder,.form-group.md-focus input[type=search].form-control:-ms-input-placeholder,.form-group.md-focus input[type=tel].form-control:-ms-input-placeholder,.form-group.md-focus input[type=text].form-control:-ms-input-placeholder,.form-group.md-focus input[type=time].form-control:-ms-input-placeholder,.form-group.md-focus input[type=url].form-control:-ms-input-placeholder,.form-group.md-focus input[type=week].form-control:-ms-input-placeholder,.form-group.md-focus textarea.form-control:-ms-input-placeholder{opacity:1}
.form-check.md-focus input[type=date].form-control::placeholder,.form-check.md-focus input[type=datetime-local].form-control::placeholder,.form-check.md-focus input[type=email].form-control::placeholder,.form-check.md-focus input[type=month].form-control::placeholder,.form-check.md-focus input[type=number].form-control::placeholder,.form-check.md-focus input[type=password].form-control::placeholder,.form-check.md-focus input[type=search].form-control::placeholder,.form-check.md-focus input[type=tel].form-control::placeholder,.form-check.md-focus input[type=text].form-control::placeholder,.form-check.md-focus input[type=time].form-control::placeholder,.form-check.md-focus input[type=url].form-control::placeholder,.form-check.md-focus input[type=week].form-control::placeholder,.form-check.md-focus textarea.form-control::placeholder,.form-group.md-focus input[type=date].form-control::placeholder,.form-group.md-focus input[type=datetime-local].form-control::placeholder,.form-group.md-focus input[type=email].form-control::placeholder,.form-group.md-focus input[type=month].form-control::placeholder,.form-group.md-focus input[type=number].form-control::placeholder,.form-group.md-focus input[type=password].form-control::placeholder,.form-group.md-focus input[type=search].form-control::placeholder,.form-group.md-focus input[type=tel].form-control::placeholder,.form-group.md-focus input[type=text].form-control::placeholder,.form-group.md-focus input[type=time].form-control::placeholder,.form-group.md-focus input[type=url].form-control::placeholder,.form-group.md-focus input[type=week].form-control::placeholder,.form-group.md-focus textarea.form-control::placeholder{opacity:1}
.form-check.md-focus textarea.form-control,.form-group.md-focus textarea.form-control{-webkit-box-shadow:inset 0 0 0 2px #3c4252;box-shadow:inset 0 0 0 2px #3c4252}
.form-check .form-control,.form-group .form-control{margin:0}
.form-check.has-danger .custom-checkbox .checkbox-icon,.form-check.has-danger .custom-checkbox .custom-control-indicator,.form-check.has-danger .form-check-label .checkbox-icon,.form-check.has-danger .form-check-label .custom-control-indicator,.form-check.has-success .custom-checkbox .checkbox-icon,.form-check.has-success .custom-checkbox .custom-control-indicator,.form-check.has-success .form-check-label .checkbox-icon,.form-check.has-success .form-check-label .custom-control-indicator,.form-check.has-warning .custom-checkbox .checkbox-icon,.form-check.has-warning .custom-checkbox .custom-control-indicator,.form-check.has-warning .form-check-label .checkbox-icon,.form-check.has-warning .form-check-label .custom-control-indicator,.form-group.has-danger .custom-checkbox .checkbox-icon,.form-group.has-danger .custom-checkbox .custom-control-indicator,.form-group.has-danger .form-check-label .checkbox-icon,.form-group.has-danger .form-check-label .custom-control-indicator,.form-group.has-success .custom-checkbox .checkbox-icon,.form-group.has-success .custom-checkbox .custom-control-indicator,.form-group.has-success .form-check-label .checkbox-icon,.form-group.has-success .form-check-label .custom-control-indicator,.form-group.has-warning .custom-checkbox .checkbox-icon,.form-group.has-warning .custom-checkbox .custom-control-indicator,.form-group.has-warning .form-check-label .checkbox-icon,.form-group.has-warning .form-check-label .custom-control-indicator{color:inherit!important}
.form-check:not(.has-success):not(.has-warning):not(.has-danger) .form-control:focus+label,.form-check:not(.has-success):not(.has-warning):not(.has-danger).md-focus label,.form-group:not(.has-success):not(.has-warning):not(.has-danger) .form-control:focus+label,.form-group:not(.has-success):not(.has-warning):not(.has-danger).md-focus label{color:#3c4252!important}
.form-check input[type=date].form-control,.form-check input[type=datetime-local].form-control,.form-check input[type=email].form-control,.form-check input[type=month].form-control,.form-check input[type=number].form-control,.form-check input[type=password].form-control,.form-check input[type=search].form-control,.form-check input[type=tel].form-control,.form-check input[type=text].form-control,.form-check input[type=time].form-control,.form-check input[type=url].form-control,.form-check input[type=week].form-control,.form-check textarea.form-control,.form-group input[type=date].form-control,.form-group input[type=datetime-local].form-control,.form-group input[type=email].form-control,.form-group input[type=month].form-control,.form-group input[type=number].form-control,.form-group input[type=password].form-control,.form-group input[type=search].form-control,.form-group input[type=tel].form-control,.form-group input[type=text].form-control,.form-group input[type=time].form-control,.form-group input[type=url].form-control,.form-group input[type=week].form-control,.form-group textarea.form-control{padding:0 0 8px;border:none;background:0 0;-webkit-appearance:none;-moz-appearance:none;appearance:none}
.form-check input[type=date].form-control::-webkit-input-placeholder,.form-check input[type=datetime-local].form-control::-webkit-input-placeholder,.form-check input[type=email].form-control::-webkit-input-placeholder,.form-check input[type=month].form-control::-webkit-input-placeholder,.form-check input[type=number].form-control::-webkit-input-placeholder,.form-check input[type=password].form-control::-webkit-input-placeholder,.form-check input[type=search].form-control::-webkit-input-placeholder,.form-check input[type=tel].form-control::-webkit-input-placeholder,.form-check input[type=text].form-control::-webkit-input-placeholder,.form-check input[type=time].form-control::-webkit-input-placeholder,.form-check input[type=url].form-control::-webkit-input-placeholder,.form-check input[type=week].form-control::-webkit-input-placeholder,.form-check textarea.form-control::-webkit-input-placeholder,.form-group input[type=date].form-control::-webkit-input-placeholder,.form-group input[type=datetime-local].form-control::-webkit-input-placeholder,.form-group input[type=email].form-control::-webkit-input-placeholder,.form-group input[type=month].form-control::-webkit-input-placeholder,.form-group input[type=number].form-control::-webkit-input-placeholder,.form-group input[type=password].form-control::-webkit-input-placeholder,.form-group input[type=search].form-control::-webkit-input-placeholder,.form-group input[type=tel].form-control::-webkit-input-placeholder,.form-group input[type=text].form-control::-webkit-input-placeholder,.form-group input[type=time].form-control::-webkit-input-placeholder,.form-group input[type=url].form-control::-webkit-input-placeholder,.form-group input[type=week].form-control::-webkit-input-placeholder,.form-group textarea.form-control::-webkit-input-placeholder{opacity:0;-webkit-transition:opacity 180ms ease;transition:opacity 180ms ease}
.form-check input[type=date].form-control::-moz-placeholder,.form-check input[type=datetime-local].form-control::-moz-placeholder,.form-check input[type=email].form-control::-moz-placeholder,.form-check input[type=month].form-control::-moz-placeholder,.form-check input[type=number].form-control::-moz-placeholder,.form-check input[type=password].form-control::-moz-placeholder,.form-check input[type=search].form-control::-moz-placeholder,.form-check input[type=tel].form-control::-moz-placeholder,.form-check input[type=text].form-control::-moz-placeholder,.form-check input[type=time].form-control::-moz-placeholder,.form-check input[type=url].form-control::-moz-placeholder,.form-check input[type=week].form-control::-moz-placeholder,.form-check textarea.form-control::-moz-placeholder,.form-group input[type=date].form-control::-moz-placeholder,.form-group input[type=datetime-local].form-control::-moz-placeholder,.form-group input[type=email].form-control::-moz-placeholder,.form-group input[type=month].form-control::-moz-placeholder,.form-group input[type=number].form-control::-moz-placeholder,.form-group input[type=password].form-control::-moz-placeholder,.form-group input[type=search].form-control::-moz-placeholder,.form-group input[type=tel].form-control::-moz-placeholder,.form-group input[type=text].form-control::-moz-placeholder,.form-group input[type=time].form-control::-moz-placeholder,.form-group input[type=url].form-control::-moz-placeholder,.form-group input[type=week].form-control::-moz-placeholder,.form-group textarea.form-control::-moz-placeholder{opacity:0;-webkit-transition:opacity 180ms ease;transition:opacity 180ms ease}
.form-check input[type=date].form-control:-ms-input-placeholder,.form-check input[type=datetime-local].form-control:-ms-input-placeholder,.form-check input[type=email].form-control:-ms-input-placeholder,.form-check input[type=month].form-control:-ms-input-placeholder,.form-check input[type=number].form-control:-ms-input-placeholder,.form-check input[type=password].form-control:-ms-input-placeholder,.form-check input[type=search].form-control:-ms-input-placeholder,.form-check input[type=tel].form-control:-ms-input-placeholder,.form-check input[type=text].form-control:-ms-input-placeholder,.form-check input[type=time].form-control:-ms-input-placeholder,.form-check input[type=url].form-control:-ms-input-placeholder,.form-check input[type=week].form-control:-ms-input-placeholder,.form-check textarea.form-control:-ms-input-placeholder,.form-group input[type=date].form-control:-ms-input-placeholder,.form-group input[type=datetime-local].form-control:-ms-input-placeholder,.form-group input[type=email].form-control:-ms-input-placeholder,.form-group input[type=month].form-control:-ms-input-placeholder,.form-group input[type=number].form-control:-ms-input-placeholder,.form-group input[type=password].form-control:-ms-input-placeholder,.form-group input[type=search].form-control:-ms-input-placeholder,.form-group input[type=tel].form-control:-ms-input-placeholder,.form-group input[type=text].form-control:-ms-input-placeholder,.form-group input[type=time].form-control:-ms-input-placeholder,.form-group input[type=url].form-control:-ms-input-placeholder,.form-group input[type=week].form-control:-ms-input-placeholder,.form-group textarea.form-control:-ms-input-placeholder{opacity:0;-webkit-transition:opacity 180ms ease;transition:opacity 180ms ease}
.form-check input[type=date].form-control::placeholder,.form-check input[type=datetime-local].form-control::placeholder,.form-check input[type=email].form-control::placeholder,.form-check input[type=month].form-control::placeholder,.form-check input[type=number].form-control::placeholder,.form-check input[type=password].form-control::placeholder,.form-check input[type=search].form-control::placeholder,.form-check input[type=tel].form-control::placeholder,.form-check input[type=text].form-control::placeholder,.form-check input[type=time].form-control::placeholder,.form-check input[type=url].form-control::placeholder,.form-check input[type=week].form-control::placeholder,.form-check textarea.form-control::placeholder,.form-group input[type=date].form-control::placeholder,.form-group input[type=datetime-local].form-control::placeholder,.form-group input[type=email].form-control::placeholder,.form-group input[type=month].form-control::placeholder,.form-group input[type=number].form-control::placeholder,.form-group input[type=password].form-control::placeholder,.form-group input[type=search].form-control::placeholder,.form-group input[type=tel].form-control::placeholder,.form-group input[type=text].form-control::placeholder,.form-group input[type=time].form-control::placeholder,.form-group input[type=url].form-control::placeholder,.form-group input[type=week].form-control::placeholder,.form-group textarea.form-control::placeholder{opacity:0;-webkit-transition:opacity 180ms ease;transition:opacity 180ms ease}
.form-check input[type=date].form-control.md-has-value+label,.form-check input[type=date].form-control:focus+label,.form-check input[type=datetime-local].form-control.md-has-value+label,.form-check input[type=datetime-local].form-control:focus+label,.form-check input[type=email].form-control.md-has-value+label,.form-check input[type=email].form-control:focus+label,.form-check input[type=month].form-control.md-has-value+label,.form-check input[type=month].form-control:focus+label,.form-check input[type=number].form-control.md-has-value+label,.form-check input[type=number].form-control:focus+label,.form-check input[type=password].form-control.md-has-value+label,.form-check input[type=password].form-control:focus+label,.form-check input[type=search].form-control.md-has-value+label,.form-check input[type=search].form-control:focus+label,.form-check input[type=tel].form-control.md-has-value+label,.form-check input[type=tel].form-control:focus+label,.form-check input[type=text].form-control.md-has-value+label,.form-check input[type=text].form-control:focus+label,.form-check input[type=time].form-control.md-has-value+label,.form-check input[type=time].form-control:focus+label,.form-check input[type=url].form-control.md-has-value+label,.form-check input[type=url].form-control:focus+label,.form-check input[type=week].form-control.md-has-value+label,.form-check input[type=week].form-control:focus+label,.form-check textarea.form-control.md-has-value+label,.form-check textarea.form-control:focus+label,.form-group input[type=date].form-control.md-has-value+label,.form-group input[type=date].form-control:focus+label,.form-group input[type=datetime-local].form-control.md-has-value+label,.form-group input[type=datetime-local].form-control:focus+label,.form-group input[type=email].form-control.md-has-value+label,.form-group input[type=email].form-control:focus+label,.form-group input[type=month].form-control.md-has-value+label,.form-group input[type=month].form-control:focus+label,.form-group input[type=number].form-control.md-has-value+label,.form-group input[type=number].form-control:focus+label,.form-group input[type=password].form-control.md-has-value+label,.form-group input[type=password].form-control:focus+label,.form-group input[type=search].form-control.md-has-value+label,.form-group input[type=search].form-control:focus+label,.form-group input[type=tel].form-control.md-has-value+label,.form-group input[type=tel].form-control:focus+label,.form-group input[type=text].form-control.md-has-value+label,.form-group input[type=text].form-control:focus+label,.form-group input[type=time].form-control.md-has-value+label,.form-group input[type=time].form-control:focus+label,.form-group input[type=url].form-control.md-has-value+label,.form-group input[type=url].form-control:focus+label,.form-group input[type=week].form-control.md-has-value+label,.form-group input[type=week].form-control:focus+label,.form-group textarea.form-control.md-has-value+label,.form-group textarea.form-control:focus+label{-webkit-transform:translateY(-100%) scale(.75,.75);-ms-transform:translateY(-100%) scale(.75,.75);transform:translateY(-100%) scale(.75,.75);cursor:auto}
.form-check input[type=date].form-control+label,.form-check input[type=datetime-local].form-control+label,.form-check input[type=email].form-control+label,.form-check input[type=month].form-control+label,.form-check input[type=number].form-control+label,.form-check input[type=password].form-control+label,.form-check input[type=search].form-control+label,.form-check input[type=tel].form-control+label,.form-check input[type=text].form-control+label,.form-check input[type=time].form-control+label,.form-check input[type=url].form-control+label,.form-check input[type=week].form-control+label,.form-check textarea.form-control+label,.form-group input[type=date].form-control+label,.form-group input[type=datetime-local].form-control+label,.form-group input[type=email].form-control+label,.form-group input[type=month].form-control+label,.form-group input[type=number].form-control+label,.form-group input[type=password].form-control+label,.form-group input[type=search].form-control+label,.form-group input[type=tel].form-control+label,.form-group input[type=text].form-control+label,.form-group input[type=time].form-control+label,.form-group input[type=url].form-control+label,.form-group input[type=week].form-control+label,.form-group textarea.form-control+label{position:absolute;top:16px;left:0;-webkit-transform-origin:left top;-webkit-transform:translateY(0) scale(1);-ms-transform:translateY(0) scale(1);transform:translateY(0) scale(1);-ms-transform-origin:left top;transform-origin:left top;-webkit-transition:color 180ms cubic-bezier(.4,0,.2,1),-webkit-transform 180ms cubic-bezier(.4,0,.2,1);transition:color 180ms cubic-bezier(.4,0,.2,1),-webkit-transform 180ms cubic-bezier(.4,0,.2,1);transition:transform 180ms cubic-bezier(.4,0,.2,1),color 180ms cubic-bezier(.4,0,.2,1);transition:transform 180ms cubic-bezier(.4,0,.2,1),color 180ms cubic-bezier(.4,0,.2,1),-webkit-transform 180ms cubic-bezier(.4,0,.2,1);cursor:text;pointer-events:none;margin:0;line-height:normal}
.form-check textarea.form-control,.form-group textarea.form-control{padding:4px;-webkit-box-shadow:inset 0 0 0 1px rgba(0,0,0,.12);box-shadow:inset 0 0 0 1px rgba(0,0,0,.12);-webkit-border-radius:2px;border-radius:2px}
.form-check textarea.form-control:hover,.form-group textarea.form-control:hover{-webkit-box-shadow:inset 0 0 0 2px rgba(0,0,0,.12);box-shadow:inset 0 0 0 2px rgba(0,0,0,.12)}
.form-check textarea.form-control:focus,.form-check textarea.form-control:focus:hover,.form-group textarea.form-control:focus,.form-group textarea.form-control:focus:hover{-webkit-box-shadow:inset 0 0 0 2px #3c4252;box-shadow:inset 0 0 0 2px #3c4252}
.form-check textarea.form-control+label,.form-group textarea.form-control+label{top:16px;left:0;padding:4px;bottom:auto}
.form-check textarea.form-control:focus+label,.form-group textarea.form-control:focus+label{color:#3c4252}
.form-check textarea.form-control.md-has-value+label,.form-check textarea.form-control:focus+label,.form-group textarea.form-control.md-has-value+label,.form-group textarea.form-control:focus+label{-webkit-transform:translateY(-100%) scale(.923,.923);-ms-transform:translateY(-100%) scale(.923,.923);transform:translateY(-100%) scale(.923,.923);cursor:auto}
.form-text{color:rgba(0,0,0,.38);width:100%;font-size:1.3rem}
.form-inline .form-group{min-height:0}
.form-inline .form-group>label{-webkit-box-pack:start;-webkit-justify-content:flex-start;-ms-flex-pack:start;justify-content:flex-start}
.custom-control-indicator{pointer-events:initial}
.custom-select{
    -webkit-box-shadow:0 1px 0 0 rgba(0,0,0,.42);
    box-shadow:0 1px 0 0 rgba(0,0,0,.42);
    -webkit-appearance:none;-moz-appearance:none;appearance:none;
    height:50px;
    padding-left:10px;
    padding-right:20px;
}
.dropdown-item{line-height:4.8rem;height:4.8rem}
.pagination{-webkit-box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12);box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12);display:-webkit-inline-box;display:-webkit-inline-flex;display:-ms-inline-flexbox;display:inline-flex}
.pagination .page-link{min-width:4.8rem;min-height:5.6rem;margin-left:0;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;overflow:hidden!important}
.pagination .page-link:active,.pagination .page-link:focus{background-color:transparent;color:rgba(0,0,0,.54)}
.pagination .page-item:first-child .page-link,.pagination .page-item:last-child .page-link{padding-left:1.6rem;padding-right:1.6rem}
.alert{-webkit-box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12);box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12)}
.breadcrumb{margin-bottom:1.6rem}
.breadcrumb-item>a:hover{text-decoration:none}
.breadcrumb-item+.breadcrumb-item::before{speak:none;font-style:normal;font-weight:400;font-variant:normal;text-transform:none;font-size:2rem;line-height:normal;vertical-align:middle;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}
.card{-webkit-box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12);box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12)}
.card-block{padding:.8rem 1.6rem}
.card-title{margin-top:.8rem;padding-top:.8rem;font-size:2.4rem;font-weight:400}
.card-subtitle{margin-bottom:.8rem;padding:0;font-weight:400;font-size:1.4rem}
.card-text{margin-bottom:.8rem}
.card-link{text-transform:uppercase;font-weight:500;color:#495057;margin:.8rem 0 0;padding:0 .8rem;display:inline-block;height:3.6rem;-webkit-box-sizing:border-box;box-sizing:border-box;letter-spacing:.04em;display:inline-block;text-align:center;white-space:nowrap;vertical-align:middle;line-height:2.57143;margin-left:-.8rem}
.card-link+.card-link{margin-left:.8rem}
.card-header{padding:1.2rem 1.6rem}
.card-footer{padding:1.2rem 1.6rem}
.card-group{-webkit-box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12);box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12)}
.card-group>.card{-webkit-box-shadow:none;box-shadow:none}
[class*=" card-outline-"],[class^=card-outline-]{border-style:solid;border-width:1px}
.list-group{padding:.8rem 0}
.list-group.dense{padding:.4rem 0}
.list-group.dense .list-group-item{padding:.6rem 1.6rem;min-height:4rem;line-height:1.6rem}
.list-group.dense .list-group-item>.avatar{width:36px;min-width:36px;height:36px;margin:0 2rem 0 0}
.list-group.dense .list-group-item>.avatar>img{max-width:36px;max-height:36px}
.list-group.dense .list-group-item.two-line{min-height:6rem}
.list-group.dense .list-group-item.three-line{min-height:7.6rem}
.list-group .list-group-item{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;border:none;padding:.8rem 1.6rem;min-height:4.8rem;line-height:1.6rem}
.list-group .list-group-item>.icon{margin-right:3.2rem}
.list-group .list-group-item>.avatar{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;overflow:hidden;width:40px;height:40px;margin:0 1.6rem 0 0;-webkit-border-radius:100%;border-radius:100%}
.list-group .list-group-item>.avatar>img{max-width:40px;max-height:40px}
.list-group .list-group-item>.list-item-content{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1}
.list-group .list-group-item>.secondary-container{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;margin-left:1.6rem}
.list-group .list-group-item h3{font-size:1.4rem;margin:0}
.list-group .list-group-item h4{font-size:1.3rem;font-weight:400;letter-spacing:.01em;margin:1px 0 3px}
.list-group .list-group-item p{font-size:1.3rem;font-weight:500;letter-spacing:.01em;margin:0;color:rgba(0,0,0,.54)}
.list-group .list-group-item.subheader{min-height:4.8rem;height:4.8rem;font-weight:500;font-size:13px;color:rgba(0,0,0,.54)}
.list-group .list-group-item.subheader.align-with-text{padding-left:72px}
.list-group .list-group-item.two-line{min-height:7.2rem}
.list-group .list-group-item.three-line{min-height:8.8rem;-webkit-box-align:start;-webkit-align-items:flex-start;-ms-flex-align:start;align-items:flex-start}
.list-group .list-group-item.three-line>.avatar,.list-group .list-group-item.three-line>.icon,.list-group .list-group-item.three-line>.secondary-container{margin-top:.4rem}
.list-group .list-group-item.two-line{min-height:7.2rem}
.list-group .list-group-item.three-line{min-height:8.8rem;-webkit-box-align:start;-webkit-align-items:flex-start;-ms-flex-align:start;align-items:flex-start}
.list-group .list-group-item.three-line>.avatar,.list-group .list-group-item.three-line>.icon,.list-group .list-group-item.three-line>.secondary-container{margin-top:.4rem}
@keyframes progress-bar-stripes{from{background-position:1.6rem 0}
to{background-position:0 0}
}
.progress{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;overflow:hidden;font-size:1.4rem;line-height:1.6rem;text-align:center;background-color:#e9ecef;-webkit-border-radius:2px;border-radius:2px}
.progress-bar{height:1.6rem;line-height:1.6rem;color:#fff;background-color:#3c4252;-webkit-transition:width .6s ease;transition:width .6s ease}
.progress-bar-striped{background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-image:linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-size:1.6rem 1.6rem}
.progress-bar-animated{-webkit-animation:progress-bar-stripes 1s linear infinite;animation:progress-bar-stripes 1s linear infinite}
.ui-pnotify{width:auto!important}
.ui-pnotify .ui-pnotify-container{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:start;-webkit-justify-content:flex-start;-ms-flex-pack:start;justify-content:flex-start;min-height:4.8rem!important;height:4.8rem!important;-webkit-border-radius:2px;border-radius:2px;padding:1.4rem 2.4rem}
.ui-pnotify .ui-pnotify-container .ui-pnotify-closer,.ui-pnotify.md .ui-pnotify-container .ui-pnotify-icon,.ui-pnotify.md .ui-pnotify-container .ui-pnotify-sticker,.ui-pnotify.md .ui-pnotify-container .ui-pnotify-title{display:none!important;opacity:0!important;visibility:hidden!important;width:0!important;height:0!important;padding:0!important;margin:0!important}
.ui-pnotify .ui-pnotify-container .ui-pnotify-text{white-space:nowrap;margin-right:2.4rem;line-height:2rem}
.ui-pnotify .ui-pnotify-container .ui-pnotify-action-bar{margin:0 0 0 auto !important;text-align:left!important}
.ui-pnotify .ui-pnotify-container .ui-pnotify-action-bar .btn.btn-link{padding:0;color:#f44336}
.ui-pnotify.success .ui-pnotify-container{background:#23AC0E;color:#fff}
.ui-pnotify.success .ui-pnotify-container .ui-pnotify-action-bar .btn.btn-link{padding:0;color:#fff}
.ui-pnotify.warning .ui-pnotify-container{background:#C7243A;color:#fff}
.ui-pnotify.warning .ui-pnotify-container .ui-pnotify-action-bar .btn.btn-link{padding:0;color:#fff}
.ui-pnotify.info .ui-pnotify-container{background:#fff;color:#333}
.ui-pnotify.info .ui-pnotify-container .ui-pnotify-action-bar .btn.btn-link{padding:0;color:#333}
.nav{padding:0}
.nav .subheader{height:5.6rem;min-height:5.6rem;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;font-weight:500;padding-left:2.4rem}
.nav li.nav-item{list-style:none}
.nav ul{padding:0}
.nav ul>li>.nav-link{padding-left:5.6rem}
.nav ul ul>li>.nav-link{padding-left:7.2rem}
.nav-link{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;height:4.8rem;}
.nav-link.btn{text-transform:none;text-align:left;letter-spacing:normal;line-height:normal;font-weight:400;-webkit-box-shadow:none;box-shadow:none}
.nav-link.active [class*=" icon-"],.nav-link.active [class^=icon-],.nav-link.active i,.nav-link.active:hover [class*=" icon-"],.nav-link.active:hover [class^=icon-],.nav-link.active:hover i,.nav-link:hover [class*=" icon-"],.nav-link:hover [class^=icon-],.nav-link:hover i{color:inherit}
.nav-link [class*=" icon-"],.nav-link [class^=icon-],.nav-link i{margin-right:1.6rem}
.nav-link>span{-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1}
.nav-link.with-arrow:after{speak:none;font-style:normal;font-weight:400;font-variant:normal;text-transform:none;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;content:"\ea94";transition:transform .3s ease-in-out,opacity .25s ease-in-out .1s,-webkit-transform .3s ease-in-out}
.nav-link.with-arrow:not(.collapsed):after{-webkit-transform:rotate(90deg);-ms-transform:rotate(90deg);transform:rotate(90deg)}
.nav-link.with-arrow.collapsed:after{-webkit-transform:rotate(0);-ms-transform:rotate(0);transform:rotate(0)}
.nav-fill .nav-item .nav-link{-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center}
.nav-justified .nav-item .nav-link,.nav-justified .nav-item.nav-link{-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center}
.nav-tabs .nav-link{position:relative;-webkit-box-shadow:none!important;box-shadow:none!important;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center}
.nav-tabs .nav-item.show .nav-link,.nav-tabs .nav-link.active{color:#495057;background-color:transparent}
.nav-tabs .nav-item.show .nav-link:not(.dropdown-toggle):after,.nav-tabs .nav-link.active:not(.dropdown-toggle):after{content:'';position:absolute;width:100%;left:0;right:0;bottom:0;height:2px;background-color:#3c4252}
.navbar-brand{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;height:4.8rem;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}
.navbar-text{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;height:4.8rem;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}
.input-group{-webkit-box-align:end;-webkit-align-items:end;-ms-flex-align:end;align-items:end}
.input-group .form-group{margin-bottom:0}
.input-group .input-group-addon{margin:0;padding:0}
.input-group .input-group-addon .form-check-input,.input-group .input-group-addon input[type=checkbox],.input-group .input-group-addon input[type=radio]{top:auto;bottom:0;left:10px;width:24px;height:24px}
.input-group .input-group-addon .form-check-input~.checkbox-icon,.input-group .input-group-addon .form-check-input~.custom-control-indicator,.input-group .input-group-addon .form-check-input~.radio-icon,.input-group .input-group-addon input[type=checkbox]~.checkbox-icon,.input-group .input-group-addon input[type=checkbox]~.custom-control-indicator,.input-group .input-group-addon input[type=checkbox]~.radio-icon,.input-group .input-group-addon input[type=radio]~.checkbox-icon,.input-group .input-group-addon input[type=radio]~.custom-control-indicator,.input-group .input-group-addon input[type=radio]~.radio-icon{position:absolute;top:auto;bottom:-8px}
.input-group .input-group-btn{margin:0 1.6rem}
.input-group .input-group-btn:first-child{margin-left:0}
.input-group .input-group-btn:last-child{margin-right:0}
.input-group .input-group-addon{padding-left:1.2rem;padding-right:1.2rem}
.input-group .input-group-addon:first-child{padding-left:0}
.input-group .input-group-addon:last-child{padding-right:0}
.jumbotron{-webkit-box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12);box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12)}
.table td,.table th{padding:1.6rem 1.2rem;vertical-align:middle}
.table thead th{border-bottom:1px solid #e9ecef;font-weight:500}
.bg-primary-50{background-color:#ececee!important}
.bg-primary-50.text-auto{background-color:#ececee!important}
.text-primary-50{color:#ececee!important}
.border-primary-50{border-color:#ececee!important}
.border-top-primary-50{border-top-color:#ececee!important}
.border-right-primary-50{border-right-color:#ececee!important}
.border-bottom-primary-50{border-bottom-color:#ececee!important}
.border-left-primary-50{border-left-color:#ececee!important}
.bg-primary-100{background-color:#c5c6cb!important}
.bg-primary-100.text-auto{background-color:#c5c6cb!important}
.text-primary-100{color:#c5c6cb!important}
.border-primary-100{border-color:#c5c6cb!important}
.border-top-primary-100{border-top-color:#c5c6cb!important}
.border-right-primary-100{border-right-color:#c5c6cb!important}
.border-bottom-primary-100{border-bottom-color:#c5c6cb!important}
.border-left-primary-100{border-left-color:#c5c6cb!important}
.bg-primary-200{background-color:#9ea1a9!important}
.bg-primary-200.text-auto{background-color:#9ea1a9!important}
.text-primary-200{color:#9ea1a9!important}
.border-primary-200{border-color:#9ea1a9!important}
.border-top-primary-200{border-top-color:#9ea1a9!important}
.border-right-primary-200{border-right-color:#9ea1a9!important}
.border-bottom-primary-200{border-bottom-color:#9ea1a9!important}
.border-left-primary-200{border-left-color:#9ea1a9!important}
.bg-primary-300{background-color:#7d818c!important}
.bg-primary-300.text-auto{background-color:#7d818c!important}
.text-primary-300{color:#7d818c!important}
.border-primary-300{border-color:#7d818c!important}
.border-top-primary-300{border-top-color:#7d818c!important}
.border-right-primary-300{border-right-color:#7d818c!important}
.border-bottom-primary-300{border-bottom-color:#7d818c!important}
.border-left-primary-300{border-left-color:#7d818c!important}
.bg-primary-400{background-color:#5c616f!important}
.bg-primary-400.text-auto{background-color:#5c616f!important}
.text-primary-400{color:#5c616f!important}
.border-primary-400{border-color:#5c616f!important}
.border-top-primary-400{border-top-color:#5c616f!important}
.border-right-primary-400{border-right-color:#5c616f!important}
.border-bottom-primary-400{border-bottom-color:#5c616f!important}
.border-left-primary-400{border-left-color:#5c616f!important}
.bg-primary-500{background-color:#3c4252!important}
.bg-primary-500.text-auto{background-color:#3c4252!important}
.text-primary-500{color:#3c4252!important}
.border-primary-500{border-color:#3c4252!important}
.border-top-primary-500{border-top-color:#3c4252!important}
.border-right-primary-500{border-right-color:#3c4252!important}
.border-bottom-primary-500{border-bottom-color:#3c4252!important}
.border-left-primary-500{border-left-color:#3c4252!important}
.bg-primary.text-auto{background-color:#3c4252!important}
.bg-primary{background-color:#3c4252!important}
.text-primary{color:#3c4252!important}
.border-primary{border-color:#3c4252!important}
.border-top-primary{border-top-color:#3c4252!important}
.border-right-primary{border-right-color:#3c4252!important}
.border-bottom-primary{border-bottom-color:#3c4252!important}
.border-left-primary{border-left-color:#3c4252!important}
.bg-primary-600{background-color:#353a48!important}
.bg-primary-600.text-auto{background-color:#353a48!important}
.text-primary-600{color:#353a48!important}
.border-primary-600{border-color:#353a48!important}
.border-top-primary-600{border-top-color:#353a48!important}
.border-right-primary-600{border-right-color:#353a48!important}
.border-bottom-primary-600{border-bottom-color:#353a48!important}
.border-left-primary-600{border-left-color:#353a48!important}
.bg-primary-700{background-color:#2d323e!important}
.bg-primary-700.text-auto{background-color:#2d323e!important}
.text-primary-700{color:#2d323e!important}
.border-primary-700{border-color:#2d323e!important}
.border-top-primary-700{border-top-color:#2d323e!important}
.border-right-primary-700{border-right-color:#2d323e!important}
.border-bottom-primary-700{border-bottom-color:#2d323e!important}
.border-left-primary-700{border-left-color:#2d323e!important}
.bg-primary-800{background-color:#262933!important}
.bg-primary-800.text-auto{background-color:#262933!important}
.text-primary-800{color:#262933!important}
.border-primary-800{border-color:#262933!important}
.border-top-primary-800{border-top-color:#262933!important}
.border-right-primary-800{border-right-color:#262933!important}
.border-bottom-primary-800{border-bottom-color:#262933!important}
.border-left-primary-800{border-left-color:#262933!important}
.bg-primary-900{background-color:#1e2129!important}
.bg-primary-900.text-auto{background-color:#1e2129!important}
.text-primary-900{color:#1e2129!important}
.border-primary-900{border-color:#1e2129!important}
.border-top-primary-900{border-top-color:#1e2129!important}
.border-right-primary-900{border-right-color:#1e2129!important}
.border-bottom-primary-900{border-bottom-color:#1e2129!important}
.border-left-primary-900{border-left-color:#1e2129!important}
.bg-primary-A100{background-color:#c5c6cb!important}
.bg-primary-A100.text-auto{background-color:#c5c6cb!important}
.text-primary-A100{color:#c5c6cb!important}
.border-primary-A100{border-color:#c5c6cb!important}
.border-top-primary-A100{border-top-color:#c5c6cb!important}
.border-right-primary-A100{border-right-color:#c5c6cb!important}
.border-bottom-primary-A100{border-bottom-color:#c5c6cb!important}
.border-left-primary-A100{border-left-color:#c5c6cb!important}
.bg-primary-A200{background-color:#9ea1a9!important}
.bg-primary-A200.text-auto{background-color:#9ea1a9!important}
.text-primary-A200{color:#9ea1a9!important}
.border-primary-A200{border-color:#9ea1a9!important}
.border-top-primary-A200{border-top-color:#9ea1a9!important}
.border-right-primary-A200{border-right-color:#9ea1a9!important}
.border-bottom-primary-A200{border-bottom-color:#9ea1a9!important}
.border-left-primary-A200{border-left-color:#9ea1a9!important}
.bg-primary-A400{background-color:#5c616f!important}
.bg-primary-A400.text-auto{background-color:#5c616f!important}
.text-primary-A400{color:#5c616f!important}
.border-primary-A400{border-color:#5c616f!important}
.border-top-primary-A400{border-top-color:#5c616f!important}
.border-right-primary-A400{border-right-color:#5c616f!important}
.border-bottom-primary-A400{border-bottom-color:#5c616f!important}
.border-left-primary-A400{border-left-color:#5c616f!important}
.bg-primary-A700{background-color:#2d323e!important}
.bg-primary-A700.text-auto{background-color:#2d323e!important}
.text-primary-A700{color:#2d323e!important}
.border-primary-A700{border-color:#2d323e!important}
.border-top-primary-A700{border-top-color:#2d323e!important}
.border-right-primary-A700{border-right-color:#2d323e!important}
.border-bottom-primary-A700{border-bottom-color:#2d323e!important}
.border-left-primary-A700{border-left-color:#2d323e!important}
.bg-secondary-50{background-color:#e3f2fd!important}
.bg-secondary-50.text-auto{background-color:#e3f2fd!important}
.text-secondary-50{color:#e3f2fd!important}
.border-secondary-50{border-color:#e3f2fd!important}
.border-top-secondary-50{border-top-color:#e3f2fd!important}
.border-right-secondary-50{border-right-color:#e3f2fd!important}
.border-bottom-secondary-50{border-bottom-color:#e3f2fd!important}
.border-left-secondary-50{border-left-color:#e3f2fd!important}
.bg-secondary-100{background-color:#bbdefb!important}
.bg-secondary-100.text-auto{background-color:#bbdefb!important}
.text-secondary-100{color:#bbdefb!important}
.border-secondary-100{border-color:#bbdefb!important}
.border-top-secondary-100{border-top-color:#bbdefb!important}
.border-right-secondary-100{border-right-color:#bbdefb!important}
.border-bottom-secondary-100{border-bottom-color:#bbdefb!important}
.border-left-secondary-100{border-left-color:#bbdefb!important}
.bg-secondary-200{background-color:#90caf9!important}
.bg-secondary-200.text-auto{background-color:#90caf9!important}
.text-secondary-200{color:#90caf9!important}
.border-secondary-200{border-color:#90caf9!important}
.border-top-secondary-200{border-top-color:#90caf9!important}
.border-right-secondary-200{border-right-color:#90caf9!important}
.border-bottom-secondary-200{border-bottom-color:#90caf9!important}
.border-left-secondary-200{border-left-color:#90caf9!important}
.bg-secondary-300{background-color:#64b5f6!important}
.bg-secondary-300.text-auto{background-color:#64b5f6!important}
.text-secondary-300{color:#64b5f6!important}
.border-secondary-300{border-color:#64b5f6!important}
.border-top-secondary-300{border-top-color:#64b5f6!important}
.border-right-secondary-300{border-right-color:#64b5f6!important}
.border-bottom-secondary-300{border-bottom-color:#64b5f6!important}
.border-left-secondary-300{border-left-color:#64b5f6!important}
.bg-secondary-400{background-color:#42a5f5!important}
.bg-secondary-400.text-auto{background-color:#42a5f5!important}
.text-secondary-400{color:#42a5f5!important}
.border-secondary-400{border-color:#42a5f5!important}
.border-top-secondary-400{border-top-color:#42a5f5!important}
.border-right-secondary-400{border-right-color:#42a5f5!important}
.border-bottom-secondary-400{border-bottom-color:#42a5f5!important}
.border-left-secondary-400{border-left-color:#42a5f5!important}
.bg-secondary-500{background-color:#2196f3!important}
.bg-secondary-500.text-auto{background-color:#2196f3!important}
.text-secondary-500{color:#2196f3!important}
.border-secondary-500{border-color:#2196f3!important}
.border-top-secondary-500{border-top-color:#2196f3!important}
.border-right-secondary-500{border-right-color:#2196f3!important}
.border-bottom-secondary-500{border-bottom-color:#2196f3!important}
.border-left-secondary-500{border-left-color:#2196f3!important}
.bg-secondary.text-auto{background-color:#2196f3!important}
.bg-secondary{background-color:#2196f3!important}
.text-secondary{color:#2196f3!important}
.border-secondary{border-color:#2196f3!important}
.border-top-secondary{border-top-color:#2196f3!important}
.border-right-secondary{border-right-color:#2196f3!important}
.border-bottom-secondary{border-bottom-color:#2196f3!important}
.border-left-secondary{border-left-color:#2196f3!important}
.bg-secondary-600{background-color:#1e88e5!important}
.bg-secondary-600.text-auto{background-color:#1e88e5!important}
.text-secondary-600{color:#1e88e5!important}
.border-secondary-600{border-color:#1e88e5!important}
.border-top-secondary-600{border-top-color:#1e88e5!important}
.border-right-secondary-600{border-right-color:#1e88e5!important}
.border-bottom-secondary-600{border-bottom-color:#1e88e5!important}
.border-left-secondary-600{border-left-color:#1e88e5!important}
.bg-secondary-700{background-color:#1976d2!important}
.bg-secondary-700.text-auto{background-color:#1976d2!important}
.text-secondary-700{color:#1976d2!important}
.border-secondary-700{border-color:#1976d2!important}
.border-top-secondary-700{border-top-color:#1976d2!important}
.border-right-secondary-700{border-right-color:#1976d2!important}
.border-bottom-secondary-700{border-bottom-color:#1976d2!important}
.border-left-secondary-700{border-left-color:#1976d2!important}
.bg-secondary-800{background-color:#1565c0!important}
.bg-secondary-800.text-auto{background-color:#1565c0!important}
.text-secondary-800{color:#1565c0!important}
.border-secondary-800{border-color:#1565c0!important}
.border-top-secondary-800{border-top-color:#1565c0!important}
.border-right-secondary-800{border-right-color:#1565c0!important}
.border-bottom-secondary-800{border-bottom-color:#1565c0!important}
.border-left-secondary-800{border-left-color:#1565c0!important}
.bg-secondary-900{background-color:#0d47a1!important}
.bg-secondary-900.text-auto{background-color:#0d47a1!important}
.text-secondary-900{color:#0d47a1!important}
.border-secondary-900{border-color:#0d47a1!important}
.border-top-secondary-900{border-top-color:#0d47a1!important}
.border-right-secondary-900{border-right-color:#0d47a1!important}
.border-bottom-secondary-900{border-bottom-color:#0d47a1!important}
.border-left-secondary-900{border-left-color:#0d47a1!important}
.bg-secondary-A100{background-color:#82b1ff!important}
.bg-secondary-A100.text-auto{background-color:#82b1ff!important}
.text-secondary-A100{color:#82b1ff!important}
.border-secondary-A100{border-color:#82b1ff!important}
.border-top-secondary-A100{border-top-color:#82b1ff!important}
.border-right-secondary-A100{border-right-color:#82b1ff!important}
.border-bottom-secondary-A100{border-bottom-color:#82b1ff!important}
.border-left-secondary-A100{border-left-color:#82b1ff!important}
.bg-secondary-A200{background-color:#448aff!important}
.bg-secondary-A200.text-auto{background-color:#448aff!important}
.text-secondary-A200{color:#448aff!important}
.border-secondary-A200{border-color:#448aff!important}
.border-top-secondary-A200{border-top-color:#448aff!important}
.border-right-secondary-A200{border-right-color:#448aff!important}
.border-bottom-secondary-A200{border-bottom-color:#448aff!important}
.border-left-secondary-A200{border-left-color:#448aff!important}
.bg-secondary-A400{background-color:#2979ff!important}
.bg-secondary-A400.text-auto{background-color:#2979ff!important}
.text-secondary-A400{color:#2979ff!important}
.border-secondary-A400{border-color:#2979ff!important}
.border-top-secondary-A400{border-top-color:#2979ff!important}
.border-right-secondary-A400{border-right-color:#2979ff!important}
.border-bottom-secondary-A400{border-bottom-color:#2979ff!important}
.border-left-secondary-A400{border-left-color:#2979ff!important}
.bg-secondary-A700{background-color:#2962ff!important}
.bg-secondary-A700.text-auto{background-color:#2962ff!important}
.text-secondary-A700{color:#2962ff!important}
.border-secondary-A700{border-color:#2962ff!important}
.border-top-secondary-A700{border-top-color:#2962ff!important}
.border-right-secondary-A700{border-right-color:#2962ff!important}
.border-bottom-secondary-A700{border-bottom-color:#2962ff!important}
.border-left-secondary-A700{border-left-color:#2962ff!important}
.bg-success-50{background-color:#e8f5e9!important}
.bg-success-50.text-auto{background-color:#e8f5e9!important}
.text-success-50{color:#e8f5e9!important}
.border-success-50{border-color:#e8f5e9!important}
.border-top-success-50{border-top-color:#e8f5e9!important}
.border-right-success-50{border-right-color:#e8f5e9!important}
.border-bottom-success-50{border-bottom-color:#e8f5e9!important}
.border-left-success-50{border-left-color:#e8f5e9!important}
.bg-success-100{background-color:#c8e6c9!important}
.bg-success-100.text-auto{background-color:#c8e6c9!important}
.text-success-100{color:#c8e6c9!important}
.border-success-100{border-color:#c8e6c9!important}
.border-top-success-100{border-top-color:#c8e6c9!important}
.border-right-success-100{border-right-color:#c8e6c9!important}
.border-bottom-success-100{border-bottom-color:#c8e6c9!important}
.border-left-success-100{border-left-color:#c8e6c9!important}
.bg-success-200{background-color:#a5d6a7!important}
.bg-success-200.text-auto{background-color:#a5d6a7!important}
.text-success-200{color:#a5d6a7!important}
.border-success-200{border-color:#a5d6a7!important}
.border-top-success-200{border-top-color:#a5d6a7!important}
.border-right-success-200{border-right-color:#a5d6a7!important}
.border-bottom-success-200{border-bottom-color:#a5d6a7!important}
.border-left-success-200{border-left-color:#a5d6a7!important}
.bg-success-300{background-color:#81c784!important}
.bg-success-300.text-auto{background-color:#81c784!important}
.text-success-300{color:#81c784!important}
.border-success-300{border-color:#81c784!important}
.border-top-success-300{border-top-color:#81c784!important}
.border-right-success-300{border-right-color:#81c784!important}
.border-bottom-success-300{border-bottom-color:#81c784!important}
.border-left-success-300{border-left-color:#81c784!important}
.bg-success-400{background-color:#66bb6a!important}
.bg-success-400.text-auto{background-color:#66bb6a!important}
.text-success-400{color:#66bb6a!important}
.border-success-400{border-color:#66bb6a!important}
.border-top-success-400{border-top-color:#66bb6a!important}
.border-right-success-400{border-right-color:#66bb6a!important}
.border-bottom-success-400{border-bottom-color:#66bb6a!important}
.border-left-success-400{border-left-color:#66bb6a!important}
.bg-success-500{background-color:#4caf50!important}
.bg-success-500.text-auto{background-color:#4caf50!important}
.text-success-500{color:#4caf50!important}
.border-success-500{border-color:#4caf50!important}
.border-top-success-500{border-top-color:#4caf50!important}
.border-right-success-500{border-right-color:#4caf50!important}
.border-bottom-success-500{border-bottom-color:#4caf50!important}
.border-left-success-500{border-left-color:#4caf50!important}
.bg-success.text-auto{background-color:#4caf50!important}
.bg-success{background-color:#4caf50!important}
.text-success{color:#4caf50!important}
.border-success{border-color:#4caf50!important}
.border-top-success{border-top-color:#4caf50!important}
.border-right-success{border-right-color:#4caf50!important}
.border-bottom-success{border-bottom-color:#4caf50!important}
.border-left-success{border-left-color:#4caf50!important}
.bg-success-600{background-color:#43a047!important}
.bg-success-600.text-auto{background-color:#43a047!important}
.text-success-600{color:#43a047!important}
.border-success-600{border-color:#43a047!important}
.border-top-success-600{border-top-color:#43a047!important}
.border-right-success-600{border-right-color:#43a047!important}
.border-bottom-success-600{border-bottom-color:#43a047!important}
.border-left-success-600{border-left-color:#43a047!important}
.bg-success-700{background-color:#388e3c!important}
.bg-success-700.text-auto{background-color:#388e3c!important}
.text-success-700{color:#388e3c!important}
.border-success-700{border-color:#388e3c!important}
.border-top-success-700{border-top-color:#388e3c!important}
.border-right-success-700{border-right-color:#388e3c!important}
.border-bottom-success-700{border-bottom-color:#388e3c!important}
.border-left-success-700{border-left-color:#388e3c!important}
.bg-success-800{background-color:#2e7d32!important}
.bg-success-800.text-auto{background-color:#2e7d32!important}
.text-success-800{color:#2e7d32!important}
.border-success-800{border-color:#2e7d32!important}
.border-top-success-800{border-top-color:#2e7d32!important}
.border-right-success-800{border-right-color:#2e7d32!important}
.border-bottom-success-800{border-bottom-color:#2e7d32!important}
.border-left-success-800{border-left-color:#2e7d32!important}
.bg-success-900{background-color:#1b5e20!important}
.bg-success-900.text-auto{background-color:#1b5e20!important}
.text-success-900{color:#1b5e20!important}
.border-success-900{border-color:#1b5e20!important}
.border-top-success-900{border-top-color:#1b5e20!important}
.border-right-success-900{border-right-color:#1b5e20!important}
.border-bottom-success-900{border-bottom-color:#1b5e20!important}
.border-left-success-900{border-left-color:#1b5e20!important}
.bg-success-A100{background-color:#b9f6ca!important}
.bg-success-A100.text-auto{background-color:#b9f6ca!important}
.text-success-A100{color:#b9f6ca!important}
.border-success-A100{border-color:#b9f6ca!important}
.border-top-success-A100{border-top-color:#b9f6ca!important}
.border-right-success-A100{border-right-color:#b9f6ca!important}
.border-bottom-success-A100{border-bottom-color:#b9f6ca!important}
.border-left-success-A100{border-left-color:#b9f6ca!important}
.bg-success-A200{background-color:#69f0ae!important}
.bg-success-A200.text-auto{background-color:#69f0ae!important}
.text-success-A200{color:#69f0ae!important}
.border-success-A200{border-color:#69f0ae!important}
.border-top-success-A200{border-top-color:#69f0ae!important}
.border-right-success-A200{border-right-color:#69f0ae!important}
.border-bottom-success-A200{border-bottom-color:#69f0ae!important}
.border-left-success-A200{border-left-color:#69f0ae!important}
.bg-success-A400{background-color:#00e676!important}
.bg-success-A400.text-auto{background-color:#00e676!important}
.text-success-A400{color:#00e676!important}
.border-success-A400{border-color:#00e676!important}
.border-top-success-A400{border-top-color:#00e676!important}
.border-right-success-A400{border-right-color:#00e676!important}
.border-bottom-success-A400{border-bottom-color:#00e676!important}
.border-left-success-A400{border-left-color:#00e676!important}
.bg-success-A700{background-color:#00c853!important}
.bg-success-A700.text-auto{background-color:#00c853!important}
.text-success-A700{color:#00c853!important}
.border-success-A700{border-color:#00c853!important}
.border-top-success-A700{border-top-color:#00c853!important}
.border-right-success-A700{border-right-color:#00c853!important}
.border-bottom-success-A700{border-bottom-color:#00c853!important}
.border-left-success-A700{border-left-color:#00c853!important}
.bg-info-50{background-color:#e0f2f1!important}
.bg-info-50.text-auto{background-color:#e0f2f1!important}
.text-info-50{color:#e0f2f1!important}
.border-info-50{border-color:#e0f2f1!important}
.border-top-info-50{border-top-color:#e0f2f1!important}
.border-right-info-50{border-right-color:#e0f2f1!important}
.border-bottom-info-50{border-bottom-color:#e0f2f1!important}
.border-left-info-50{border-left-color:#e0f2f1!important}
.bg-info-100{background-color:#b2dfdb!important}
.bg-info-100.text-auto{background-color:#b2dfdb!important}
.text-info-100{color:#b2dfdb!important}
.border-info-100{border-color:#b2dfdb!important}
.border-top-info-100{border-top-color:#b2dfdb!important}
.border-right-info-100{border-right-color:#b2dfdb!important}
.border-bottom-info-100{border-bottom-color:#b2dfdb!important}
.border-left-info-100{border-left-color:#b2dfdb!important}
.bg-info-200{background-color:#80cbc4!important}
.bg-info-200.text-auto{background-color:#80cbc4!important}
.text-info-200{color:#80cbc4!important}
.border-info-200{border-color:#80cbc4!important}
.border-top-info-200{border-top-color:#80cbc4!important}
.border-right-info-200{border-right-color:#80cbc4!important}
.border-bottom-info-200{border-bottom-color:#80cbc4!important}
.border-left-info-200{border-left-color:#80cbc4!important}
.bg-info-300{background-color:#4db6ac!important}
.bg-info-300.text-auto{background-color:#4db6ac!important}
.text-info-300{color:#4db6ac!important}
.border-info-300{border-color:#4db6ac!important}
.border-top-info-300{border-top-color:#4db6ac!important}
.border-right-info-300{border-right-color:#4db6ac!important}
.border-bottom-info-300{border-bottom-color:#4db6ac!important}
.border-left-info-300{border-left-color:#4db6ac!important}
.bg-info-400{background-color:#26a69a!important}
.bg-info-400.text-auto{background-color:#26a69a!important}
.text-info-400{color:#26a69a!important}
.border-info-400{border-color:#26a69a!important}
.border-top-info-400{border-top-color:#26a69a!important}
.border-right-info-400{border-right-color:#26a69a!important}
.border-bottom-info-400{border-bottom-color:#26a69a!important}
.border-left-info-400{border-left-color:#26a69a!important}
.bg-info-500{background-color:#009688!important}
.bg-info-500.text-auto{background-color:#009688!important}
.text-info-500{color:#009688!important}
.border-info-500{border-color:#009688!important}
.border-top-info-500{border-top-color:#009688!important}
.border-right-info-500{border-right-color:#009688!important}
.border-bottom-info-500{border-bottom-color:#009688!important}
.border-left-info-500{border-left-color:#009688!important}
.bg-info.text-auto{background-color:#009688!important}
.bg-info{background-color:#009688!important}
.text-info{color:#009688!important}
.border-info{border-color:#009688!important}
.border-top-info{border-top-color:#009688!important}
.border-right-info{border-right-color:#009688!important}
.border-bottom-info{border-bottom-color:#009688!important}
.border-left-info{border-left-color:#009688!important}
.bg-info-600{background-color:#00897b!important}
.bg-info-600.text-auto{background-color:#00897b!important}
.text-info-600{color:#00897b!important}
.border-info-600{border-color:#00897b!important}
.border-top-info-600{border-top-color:#00897b!important}
.border-right-info-600{border-right-color:#00897b!important}
.border-bottom-info-600{border-bottom-color:#00897b!important}
.border-left-info-600{border-left-color:#00897b!important}
.bg-info-700{background-color:#00796b!important}
.bg-info-700.text-auto{background-color:#00796b!important}
.text-info-700{color:#00796b!important}
.border-info-700{border-color:#00796b!important}
.border-top-info-700{border-top-color:#00796b!important}
.border-right-info-700{border-right-color:#00796b!important}
.border-bottom-info-700{border-bottom-color:#00796b!important}
.border-left-info-700{border-left-color:#00796b!important}
.bg-info-800{background-color:#00695c!important}
.bg-info-800.text-auto{background-color:#00695c!important}
.text-info-800{color:#00695c!important}
.border-info-800{border-color:#00695c!important}
.border-top-info-800{border-top-color:#00695c!important}
.border-right-info-800{border-right-color:#00695c!important}
.border-bottom-info-800{border-bottom-color:#00695c!important}
.border-left-info-800{border-left-color:#00695c!important}
.bg-info-900{background-color:#004d40!important}
.bg-info-900.text-auto{background-color:#004d40!important}
.text-info-900{color:#004d40!important}
.border-info-900{border-color:#004d40!important}
.border-top-info-900{border-top-color:#004d40!important}
.border-right-info-900{border-right-color:#004d40!important}
.border-bottom-info-900{border-bottom-color:#004d40!important}
.border-left-info-900{border-left-color:#004d40!important}
.bg-info-A100{background-color:#a7ffeb!important}
.bg-info-A100.text-auto{background-color:#a7ffeb!important}
.text-info-A100{color:#a7ffeb!important}
.border-info-A100{border-color:#a7ffeb!important}
.border-top-info-A100{border-top-color:#a7ffeb!important}
.border-right-info-A100{border-right-color:#a7ffeb!important}
.border-bottom-info-A100{border-bottom-color:#a7ffeb!important}
.border-left-info-A100{border-left-color:#a7ffeb!important}
.bg-info-A200{background-color:#64ffda!important}
.bg-info-A200.text-auto{background-color:#64ffda!important}
.text-info-A200{color:#64ffda!important}
.border-info-A200{border-color:#64ffda!important}
.border-top-info-A200{border-top-color:#64ffda!important}
.border-right-info-A200{border-right-color:#64ffda!important}
.border-bottom-info-A200{border-bottom-color:#64ffda!important}
.border-left-info-A200{border-left-color:#64ffda!important}
.bg-info-A400{background-color:#1de9b6!important}
.bg-info-A400.text-auto{background-color:#1de9b6!important}
.text-info-A400{color:#1de9b6!important}
.border-info-A400{border-color:#1de9b6!important}
.border-top-info-A400{border-top-color:#1de9b6!important}
.border-right-info-A400{border-right-color:#1de9b6!important}
.border-bottom-info-A400{border-bottom-color:#1de9b6!important}
.border-left-info-A400{border-left-color:#1de9b6!important}
.bg-info-A700{background-color:#00bfa5!important}
.bg-info-A700.text-auto{background-color:#00bfa5!important}
.text-info-A700{color:#00bfa5!important}
.border-info-A700{border-color:#00bfa5!important}
.border-top-info-A700{border-top-color:#00bfa5!important}
.border-right-info-A700{border-right-color:#00bfa5!important}
.border-bottom-info-A700{border-bottom-color:#00bfa5!important}
.border-left-info-A700{border-left-color:#00bfa5!important}
.bg-warning-50{background-color:#fff3e0!important}
.bg-warning-50.text-auto{background-color:#fff3e0!important}
.text-warning-50{color:#fff3e0!important}
.border-warning-50{border-color:#fff3e0!important}
.border-top-warning-50{border-top-color:#fff3e0!important}
.border-right-warning-50{border-right-color:#fff3e0!important}
.border-bottom-warning-50{border-bottom-color:#fff3e0!important}
.border-left-warning-50{border-left-color:#fff3e0!important}
.bg-warning-100{background-color:#ffe0b2!important}
.bg-warning-100.text-auto{background-color:#ffe0b2!important}
.text-warning-100{color:#ffe0b2!important}
.border-warning-100{border-color:#ffe0b2!important}
.border-top-warning-100{border-top-color:#ffe0b2!important}
.border-right-warning-100{border-right-color:#ffe0b2!important}
.border-bottom-warning-100{border-bottom-color:#ffe0b2!important}
.border-left-warning-100{border-left-color:#ffe0b2!important}
.bg-warning-200{background-color:#ffcc80!important}
.bg-warning-200.text-auto{background-color:#ffcc80!important}
.text-warning-200{color:#ffcc80!important}
.border-warning-200{border-color:#ffcc80!important}
.border-top-warning-200{border-top-color:#ffcc80!important}
.border-right-warning-200{border-right-color:#ffcc80!important}
.border-bottom-warning-200{border-bottom-color:#ffcc80!important}
.border-left-warning-200{border-left-color:#ffcc80!important}
.bg-warning-300{background-color:#ffb74d!important}
.bg-warning-300.text-auto{background-color:#ffb74d!important}
.text-warning-300{color:#ffb74d!important}
.border-warning-300{border-color:#ffb74d!important}
.border-top-warning-300{border-top-color:#ffb74d!important}
.border-right-warning-300{border-right-color:#ffb74d!important}
.border-bottom-warning-300{border-bottom-color:#ffb74d!important}
.border-left-warning-300{border-left-color:#ffb74d!important}
.bg-warning-400{background-color:#ffa726!important}
.bg-warning-400.text-auto{background-color:#ffa726!important}
.text-warning-400{color:#ffa726!important}
.border-warning-400{border-color:#ffa726!important}
.border-top-warning-400{border-top-color:#ffa726!important}
.border-right-warning-400{border-right-color:#ffa726!important}
.border-bottom-warning-400{border-bottom-color:#ffa726!important}
.border-left-warning-400{border-left-color:#ffa726!important}
.bg-warning-500{background-color:#ff9800!important}
.bg-warning-500.text-auto{background-color:#ff9800!important}
.text-warning-500{color:#ff9800!important}
.border-warning-500{border-color:#ff9800!important}
.border-top-warning-500{border-top-color:#ff9800!important}
.border-right-warning-500{border-right-color:#ff9800!important}
.border-bottom-warning-500{border-bottom-color:#ff9800!important}
.border-left-warning-500{border-left-color:#ff9800!important}
.bg-warning.text-auto{background-color:#ff9800!important}
.bg-warning{background-color:#ff9800!important}
.text-warning{color:#ff9800!important}
.border-warning{border-color:#ff9800!important}
.border-top-warning{border-top-color:#ff9800!important}
.border-right-warning{border-right-color:#ff9800!important}
.border-bottom-warning{border-bottom-color:#ff9800!important}
.border-left-warning{border-left-color:#ff9800!important}
.bg-warning-600{background-color:#fb8c00!important}
.bg-warning-600.text-auto{background-color:#fb8c00!important}
.text-warning-600{color:#fb8c00!important}
.border-warning-600{border-color:#fb8c00!important}
.border-top-warning-600{border-top-color:#fb8c00!important}
.border-right-warning-600{border-right-color:#fb8c00!important}
.border-bottom-warning-600{border-bottom-color:#fb8c00!important}
.border-left-warning-600{border-left-color:#fb8c00!important}
.bg-warning-700{background-color:#f57c00!important}
.bg-warning-700.text-auto{background-color:#f57c00!important}
.text-warning-700{color:#f57c00!important}
.border-warning-700{border-color:#f57c00!important}
.border-top-warning-700{border-top-color:#f57c00!important}
.border-right-warning-700{border-right-color:#f57c00!important}
.border-bottom-warning-700{border-bottom-color:#f57c00!important}
.border-left-warning-700{border-left-color:#f57c00!important}
.bg-warning-800{background-color:#ef6c00!important}
.bg-warning-800.text-auto{background-color:#ef6c00!important}
.text-warning-800{color:#ef6c00!important}
.border-warning-800{border-color:#ef6c00!important}
.border-top-warning-800{border-top-color:#ef6c00!important}
.border-right-warning-800{border-right-color:#ef6c00!important}
.border-bottom-warning-800{border-bottom-color:#ef6c00!important}
.border-left-warning-800{border-left-color:#ef6c00!important}
.bg-warning-900{background-color:#e65100!important}
.bg-warning-900.text-auto{background-color:#e65100!important}
.text-warning-900{color:#e65100!important}
.border-warning-900{border-color:#e65100!important}
.border-top-warning-900{border-top-color:#e65100!important}
.border-right-warning-900{border-right-color:#e65100!important}
.border-bottom-warning-900{border-bottom-color:#e65100!important}
.border-left-warning-900{border-left-color:#e65100!important}
.bg-warning-A100{background-color:#ffd180!important}
.bg-warning-A100.text-auto{background-color:#ffd180!important}
.text-warning-A100{color:#ffd180!important}
.border-warning-A100{border-color:#ffd180!important}
.border-top-warning-A100{border-top-color:#ffd180!important}
.border-right-warning-A100{border-right-color:#ffd180!important}
.border-bottom-warning-A100{border-bottom-color:#ffd180!important}
.border-left-warning-A100{border-left-color:#ffd180!important}
.bg-warning-A200{background-color:#ffab40!important}
.bg-warning-A200.text-auto{background-color:#ffab40!important}
.text-warning-A200{color:#ffab40!important}
.border-warning-A200{border-color:#ffab40!important}
.border-top-warning-A200{border-top-color:#ffab40!important}
.border-right-warning-A200{border-right-color:#ffab40!important}
.border-bottom-warning-A200{border-bottom-color:#ffab40!important}
.border-left-warning-A200{border-left-color:#ffab40!important}
.bg-warning-A400{background-color:#ff9100!important}
.bg-warning-A400.text-auto{background-color:#ff9100!important}
.text-warning-A400{color:#ff9100!important}
.border-warning-A400{border-color:#ff9100!important}
.border-top-warning-A400{border-top-color:#ff9100!important}
.border-right-warning-A400{border-right-color:#ff9100!important}
.border-bottom-warning-A400{border-bottom-color:#ff9100!important}
.border-left-warning-A400{border-left-color:#ff9100!important}
.bg-warning-A700{background-color:#ff6d00!important}
.bg-warning-A700.text-auto{background-color:#ff6d00!important}
.text-warning-A700{color:#ff6d00!important}
.border-warning-A700{border-color:#ff6d00!important}
.border-top-warning-A700{border-top-color:#ff6d00!important}
.border-right-warning-A700{border-right-color:#ff6d00!important}
.border-bottom-warning-A700{border-bottom-color:#ff6d00!important}
.border-left-warning-A700{border-left-color:#ff6d00!important}
.bg-danger-50{background-color:#ffebee!important}
.bg-danger-50.text-auto{background-color:#ffebee!important}
.text-danger-50{color:#ffebee!important}
.border-danger-50{border-color:#ffebee!important}
.border-top-danger-50{border-top-color:#ffebee!important}
.border-right-danger-50{border-right-color:#ffebee!important}
.border-bottom-danger-50{border-bottom-color:#ffebee!important}
.border-left-danger-50{border-left-color:#ffebee!important}
.bg-danger-100{background-color:#ffcdd2!important}
.bg-danger-100.text-auto{background-color:#ffcdd2!important}
.text-danger-100{color:#ffcdd2!important}
.border-danger-100{border-color:#ffcdd2!important}
.border-top-danger-100{border-top-color:#ffcdd2!important}
.border-right-danger-100{border-right-color:#ffcdd2!important}
.border-bottom-danger-100{border-bottom-color:#ffcdd2!important}
.border-left-danger-100{border-left-color:#ffcdd2!important}
.bg-danger-200{background-color:#ef9a9a!important}
.bg-danger-200.text-auto{background-color:#ef9a9a!important}
.text-danger-200{color:#ef9a9a!important}
.border-danger-200{border-color:#ef9a9a!important}
.border-top-danger-200{border-top-color:#ef9a9a!important}
.border-right-danger-200{border-right-color:#ef9a9a!important}
.border-bottom-danger-200{border-bottom-color:#ef9a9a!important}
.border-left-danger-200{border-left-color:#ef9a9a!important}
.bg-danger-300{background-color:#e57373!important}
.bg-danger-300.text-auto{background-color:#e57373!important}
.text-danger-300{color:#e57373!important}
.border-danger-300{border-color:#e57373!important}
.border-top-danger-300{border-top-color:#e57373!important}
.border-right-danger-300{border-right-color:#e57373!important}
.border-bottom-danger-300{border-bottom-color:#e57373!important}
.border-left-danger-300{border-left-color:#e57373!important}
.bg-danger-400{background-color:#ef5350!important}
.bg-danger-400.text-auto{background-color:#ef5350!important}
.text-danger-400{color:#ef5350!important}
.border-danger-400{border-color:#ef5350!important}
.border-top-danger-400{border-top-color:#ef5350!important}
.border-right-danger-400{border-right-color:#ef5350!important}
.border-bottom-danger-400{border-bottom-color:#ef5350!important}
.border-left-danger-400{border-left-color:#ef5350!important}
.bg-danger-500{background-color:#f44336!important}
.bg-danger-500.text-auto{background-color:#f44336!important}
.text-danger-500{color:#f44336!important}
.border-danger-500{border-color:#f44336!important}
.border-top-danger-500{border-top-color:#f44336!important}
.border-right-danger-500{border-right-color:#f44336!important}
.border-bottom-danger-500{border-bottom-color:#f44336!important}
.border-left-danger-500{border-left-color:#f44336!important}
.bg-danger.text-auto{background-color:#f44336!important}
.bg-danger{background-color:#f44336!important}
.text-danger{color:#f44336!important}
.border-danger{border-color:#f44336!important}
.border-top-danger{border-top-color:#f44336!important}
.border-right-danger{border-right-color:#f44336!important}
.border-bottom-danger{border-bottom-color:#f44336!important}
.border-left-danger{border-left-color:#f44336!important}
.bg-danger-600{background-color:#e53935!important}
.bg-danger-600.text-auto{background-color:#e53935!important}
.text-danger-600{color:#e53935!important}
.border-danger-600{border-color:#e53935!important}
.border-top-danger-600{border-top-color:#e53935!important}
.border-right-danger-600{border-right-color:#e53935!important}
.border-bottom-danger-600{border-bottom-color:#e53935!important}
.border-left-danger-600{border-left-color:#e53935!important}
.bg-danger-700{background-color:#d32f2f!important}
.bg-danger-700.text-auto{background-color:#d32f2f!important}
.text-danger-700{color:#d32f2f!important}
.border-danger-700{border-color:#d32f2f!important}
.border-top-danger-700{border-top-color:#d32f2f!important}
.border-right-danger-700{border-right-color:#d32f2f!important}
.border-bottom-danger-700{border-bottom-color:#d32f2f!important}
.border-left-danger-700{border-left-color:#d32f2f!important}
.bg-danger-800{background-color:#c62828!important}
.bg-danger-800.text-auto{background-color:#c62828!important}
.text-danger-800{color:#c62828!important}
.border-danger-800{border-color:#c62828!important}
.border-top-danger-800{border-top-color:#c62828!important}
.border-right-danger-800{border-right-color:#c62828!important}
.border-bottom-danger-800{border-bottom-color:#c62828!important}
.border-left-danger-800{border-left-color:#c62828!important}
.bg-danger-900{background-color:#b71c1c!important}
.bg-danger-900.text-auto{background-color:#b71c1c!important}
.text-danger-900{color:#b71c1c!important}
.border-danger-900{border-color:#b71c1c!important}
.border-top-danger-900{border-top-color:#b71c1c!important}
.border-right-danger-900{border-right-color:#b71c1c!important}
.border-bottom-danger-900{border-bottom-color:#b71c1c!important}
.border-left-danger-900{border-left-color:#b71c1c!important}
.bg-danger-A100{background-color:#ff8a80!important}
.bg-danger-A100.text-auto{background-color:#ff8a80!important}
.text-danger-A100{color:#ff8a80!important}
.border-danger-A100{border-color:#ff8a80!important}
.border-top-danger-A100{border-top-color:#ff8a80!important}
.border-right-danger-A100{border-right-color:#ff8a80!important}
.border-bottom-danger-A100{border-bottom-color:#ff8a80!important}
.border-left-danger-A100{border-left-color:#ff8a80!important}
.bg-danger-A200{background-color:#ff5252!important}
.bg-danger-A200.text-auto{background-color:#ff5252!important}
.text-danger-A200{color:#ff5252!important}
.border-danger-A200{border-color:#ff5252!important}
.border-top-danger-A200{border-top-color:#ff5252!important}
.border-right-danger-A200{border-right-color:#ff5252!important}
.border-bottom-danger-A200{border-bottom-color:#ff5252!important}
.border-left-danger-A200{border-left-color:#ff5252!important}
.bg-danger-A400{background-color:#ff1744!important}
.bg-danger-A400.text-auto{background-color:#ff1744!important}
.text-danger-A400{color:#ff1744!important}
.border-danger-A400{border-color:#ff1744!important}
.border-top-danger-A400{border-top-color:#ff1744!important}
.border-right-danger-A400{border-right-color:#ff1744!important}
.border-bottom-danger-A400{border-bottom-color:#ff1744!important}
.border-left-danger-A400{border-left-color:#ff1744!important}
.bg-danger-A700{background-color:#d50000!important}
.bg-danger-A700.text-auto{background-color:#d50000!important}
.text-danger-A700{color:#d50000!important}
.border-danger-A700{border-color:#d50000!important}
.border-top-danger-A700{border-top-color:#d50000!important}
.border-right-danger-A700{border-right-color:#d50000!important}
.border-bottom-danger-A700{border-bottom-color:#d50000!important}
.border-left-danger-A700{border-left-color:#d50000!important}
.bg-red-50{background-color:#ffebee!important}
.bg-red-50.text-auto{background-color:#ffebee!important}
.text-red-50{color:#ffebee!important}
.border-red-50{border-color:#ffebee!important}
.border-top-red-50{border-top-color:#ffebee!important}
.border-right-red-50{border-right-color:#ffebee!important}
.border-bottom-red-50{border-bottom-color:#ffebee!important}
.border-left-red-50{border-left-color:#ffebee!important}
.bg-red-100{background-color:#ffcdd2!important}
.bg-red-100.text-auto{background-color:#ffcdd2!important}
.text-red-100{color:#ffcdd2!important}
.border-red-100{border-color:#ffcdd2!important}
.border-top-red-100{border-top-color:#ffcdd2!important}
.border-right-red-100{border-right-color:#ffcdd2!important}
.border-bottom-red-100{border-bottom-color:#ffcdd2!important}
.border-left-red-100{border-left-color:#ffcdd2!important}
.bg-red-200{background-color:#ef9a9a!important}
.bg-red-200.text-auto{background-color:#ef9a9a!important}
.text-red-200{color:#ef9a9a!important}
.border-red-200{border-color:#ef9a9a!important}
.border-top-red-200{border-top-color:#ef9a9a!important}
.border-right-red-200{border-right-color:#ef9a9a!important}
.border-bottom-red-200{border-bottom-color:#ef9a9a!important}
.border-left-red-200{border-left-color:#ef9a9a!important}
.bg-red-300{background-color:#e57373!important}
.bg-red-300.text-auto{background-color:#e57373!important}
.text-red-300{color:#e57373!important}
.border-red-300{border-color:#e57373!important}
.border-top-red-300{border-top-color:#e57373!important}
.border-right-red-300{border-right-color:#e57373!important}
.border-bottom-red-300{border-bottom-color:#e57373!important}
.border-left-red-300{border-left-color:#e57373!important}
.bg-red-400{background-color:#ef5350!important}
.bg-red-400.text-auto{background-color:#ef5350!important}
.text-red-400{color:#ef5350!important}
.border-red-400{border-color:#ef5350!important}
.border-top-red-400{border-top-color:#ef5350!important}
.border-right-red-400{border-right-color:#ef5350!important}
.border-bottom-red-400{border-bottom-color:#ef5350!important}
.border-left-red-400{border-left-color:#ef5350!important}
.bg-red-500{background-color:#f44336!important}
.bg-red-500.text-auto{background-color:#f44336!important}
.text-red-500{color:#f44336!important}
.border-red-500{border-color:#f44336!important}
.border-top-red-500{border-top-color:#f44336!important}
.border-right-red-500{border-right-color:#f44336!important}
.border-bottom-red-500{border-bottom-color:#f44336!important}
.border-left-red-500{border-left-color:#f44336!important}
.bg-red.text-auto{background-color:#f44336!important}
.bg-red{background-color:#f44336!important}
.text-red{color:#f44336!important}
.border-red{border-color:#f44336!important}
.border-top-red{border-top-color:#f44336!important}
.border-right-red{border-right-color:#f44336!important}
.border-bottom-red{border-bottom-color:#f44336!important}
.border-left-red{border-left-color:#f44336!important}
.bg-red-600{background-color:#e53935!important}
.bg-red-600.text-auto{background-color:#e53935!important}
.text-red-600{color:#e53935!important}
.border-red-600{border-color:#e53935!important}
.border-top-red-600{border-top-color:#e53935!important}
.border-right-red-600{border-right-color:#e53935!important}
.border-bottom-red-600{border-bottom-color:#e53935!important}
.border-left-red-600{border-left-color:#e53935!important}
.bg-red-700{background-color:#d32f2f!important}
.bg-red-700.text-auto{background-color:#d32f2f!important}
.text-red-700{color:#d32f2f!important}
.border-red-700{border-color:#d32f2f!important}
.border-top-red-700{border-top-color:#d32f2f!important}
.border-right-red-700{border-right-color:#d32f2f!important}
.border-bottom-red-700{border-bottom-color:#d32f2f!important}
.border-left-red-700{border-left-color:#d32f2f!important}
.bg-red-800{background-color:#c62828!important}
.bg-red-800.text-auto{background-color:#c62828!important}
.text-red-800{color:#c62828!important}
.border-red-800{border-color:#c62828!important}
.border-top-red-800{border-top-color:#c62828!important}
.border-right-red-800{border-right-color:#c62828!important}
.border-bottom-red-800{border-bottom-color:#c62828!important}
.border-left-red-800{border-left-color:#c62828!important}
.bg-red-900{background-color:#b71c1c!important}
.bg-red-900.text-auto{background-color:#b71c1c!important}
.text-red-900{color:#b71c1c!important}
.border-red-900{border-color:#b71c1c!important}
.border-top-red-900{border-top-color:#b71c1c!important}
.border-right-red-900{border-right-color:#b71c1c!important}
.border-bottom-red-900{border-bottom-color:#b71c1c!important}
.border-left-red-900{border-left-color:#b71c1c!important}
.bg-red-A100{background-color:#ff8a80!important}
.bg-red-A100.text-auto{background-color:#ff8a80!important}
.text-red-A100{color:#ff8a80!important}
.border-red-A100{border-color:#ff8a80!important}
.border-top-red-A100{border-top-color:#ff8a80!important}
.border-right-red-A100{border-right-color:#ff8a80!important}
.border-bottom-red-A100{border-bottom-color:#ff8a80!important}
.border-left-red-A100{border-left-color:#ff8a80!important}
.bg-red-A200{background-color:#ff5252!important}
.bg-red-A200.text-auto{background-color:#ff5252!important}
.text-red-A200{color:#ff5252!important}
.border-red-A200{border-color:#ff5252!important}
.border-top-red-A200{border-top-color:#ff5252!important}
.border-right-red-A200{border-right-color:#ff5252!important}
.border-bottom-red-A200{border-bottom-color:#ff5252!important}
.border-left-red-A200{border-left-color:#ff5252!important}
.bg-red-A400{background-color:#ff1744!important}
.bg-red-A400.text-auto{background-color:#ff1744!important}
.text-red-A400{color:#ff1744!important}
.border-red-A400{border-color:#ff1744!important}
.border-top-red-A400{border-top-color:#ff1744!important}
.border-right-red-A400{border-right-color:#ff1744!important}
.border-bottom-red-A400{border-bottom-color:#ff1744!important}
.border-left-red-A400{border-left-color:#ff1744!important}
.bg-red-A700{background-color:#d50000!important}
.bg-red-A700.text-auto{background-color:#d50000!important}
.text-red-A700{color:#d50000!important}
.border-red-A700{border-color:#d50000!important}
.border-top-red-A700{border-top-color:#d50000!important}
.border-right-red-A700{border-right-color:#d50000!important}
.border-bottom-red-A700{border-bottom-color:#d50000!important}
.border-left-red-A700{border-left-color:#d50000!important}
.bg-pink-50{background-color:#fce4ec!important}
.bg-pink-50.text-auto{background-color:#fce4ec!important}
.text-pink-50{color:#fce4ec!important}
.border-pink-50{border-color:#fce4ec!important}
.border-top-pink-50{border-top-color:#fce4ec!important}
.border-right-pink-50{border-right-color:#fce4ec!important}
.border-bottom-pink-50{border-bottom-color:#fce4ec!important}
.border-left-pink-50{border-left-color:#fce4ec!important}
.bg-pink-100{background-color:#f8bbd0!important}
.bg-pink-100.text-auto{background-color:#f8bbd0!important}
.text-pink-100{color:#f8bbd0!important}
.border-pink-100{border-color:#f8bbd0!important}
.border-top-pink-100{border-top-color:#f8bbd0!important}
.border-right-pink-100{border-right-color:#f8bbd0!important}
.border-bottom-pink-100{border-bottom-color:#f8bbd0!important}
.border-left-pink-100{border-left-color:#f8bbd0!important}
.bg-pink-200{background-color:#f48fb1!important}
.bg-pink-200.text-auto{background-color:#f48fb1!important}
.text-pink-200{color:#f48fb1!important}
.border-pink-200{border-color:#f48fb1!important}
.border-top-pink-200{border-top-color:#f48fb1!important}
.border-right-pink-200{border-right-color:#f48fb1!important}
.border-bottom-pink-200{border-bottom-color:#f48fb1!important}
.border-left-pink-200{border-left-color:#f48fb1!important}
.bg-pink-300{background-color:#f06292!important}
.bg-pink-300.text-auto{background-color:#f06292!important}
.text-pink-300{color:#f06292!important}
.border-pink-300{border-color:#f06292!important}
.border-top-pink-300{border-top-color:#f06292!important}
.border-right-pink-300{border-right-color:#f06292!important}
.border-bottom-pink-300{border-bottom-color:#f06292!important}
.border-left-pink-300{border-left-color:#f06292!important}
.bg-pink-400{background-color:#ec407a!important}
.bg-pink-400.text-auto{background-color:#ec407a!important}
.text-pink-400{color:#ec407a!important}
.border-pink-400{border-color:#ec407a!important}
.border-top-pink-400{border-top-color:#ec407a!important}
.border-right-pink-400{border-right-color:#ec407a!important}
.border-bottom-pink-400{border-bottom-color:#ec407a!important}
.border-left-pink-400{border-left-color:#ec407a!important}
.bg-pink-500{background-color:#e91e63!important}
.bg-pink-500.text-auto{background-color:#e91e63!important}
.text-pink-500{color:#e91e63!important}
.border-pink-500{border-color:#e91e63!important}
.border-top-pink-500{border-top-color:#e91e63!important}
.border-right-pink-500{border-right-color:#e91e63!important}
.border-bottom-pink-500{border-bottom-color:#e91e63!important}
.border-left-pink-500{border-left-color:#e91e63!important}
.bg-pink.text-auto{background-color:#e91e63!important}
.bg-pink{background-color:#e91e63!important}
.text-pink{color:#e91e63!important}
.border-pink{border-color:#e91e63!important}
.border-top-pink{border-top-color:#e91e63!important}
.border-right-pink{border-right-color:#e91e63!important}
.border-bottom-pink{border-bottom-color:#e91e63!important}
.border-left-pink{border-left-color:#e91e63!important}
.bg-pink-600{background-color:#d81b60!important}
.bg-pink-600.text-auto{background-color:#d81b60!important}
.text-pink-600{color:#d81b60!important}
.border-pink-600{border-color:#d81b60!important}
.border-top-pink-600{border-top-color:#d81b60!important}
.border-right-pink-600{border-right-color:#d81b60!important}
.border-bottom-pink-600{border-bottom-color:#d81b60!important}
.border-left-pink-600{border-left-color:#d81b60!important}
.bg-pink-700{background-color:#c2185b!important}
.bg-pink-700.text-auto{background-color:#c2185b!important}
.text-pink-700{color:#c2185b!important}
.border-pink-700{border-color:#c2185b!important}
.border-top-pink-700{border-top-color:#c2185b!important}
.border-right-pink-700{border-right-color:#c2185b!important}
.border-bottom-pink-700{border-bottom-color:#c2185b!important}
.border-left-pink-700{border-left-color:#c2185b!important}
.bg-pink-800{background-color:#ad1457!important}
.bg-pink-800.text-auto{background-color:#ad1457!important}
.text-pink-800{color:#ad1457!important}
.border-pink-800{border-color:#ad1457!important}
.border-top-pink-800{border-top-color:#ad1457!important}
.border-right-pink-800{border-right-color:#ad1457!important}
.border-bottom-pink-800{border-bottom-color:#ad1457!important}
.border-left-pink-800{border-left-color:#ad1457!important}
.bg-pink-900{background-color:#880e4f!important}
.bg-pink-900.text-auto{background-color:#880e4f!important}
.text-pink-900{color:#880e4f!important}
.border-pink-900{border-color:#880e4f!important}
.border-top-pink-900{border-top-color:#880e4f!important}
.border-right-pink-900{border-right-color:#880e4f!important}
.border-bottom-pink-900{border-bottom-color:#880e4f!important}
.border-left-pink-900{border-left-color:#880e4f!important}
.bg-pink-A100{background-color:#ff80ab!important}
.bg-pink-A100.text-auto{background-color:#ff80ab!important}
.text-pink-A100{color:#ff80ab!important}
.border-pink-A100{border-color:#ff80ab!important}
.border-top-pink-A100{border-top-color:#ff80ab!important}
.border-right-pink-A100{border-right-color:#ff80ab!important}
.border-bottom-pink-A100{border-bottom-color:#ff80ab!important}
.border-left-pink-A100{border-left-color:#ff80ab!important}
.bg-pink-A200{background-color:#ff4081!important}
.bg-pink-A200.text-auto{background-color:#ff4081!important}
.text-pink-A200{color:#ff4081!important}
.border-pink-A200{border-color:#ff4081!important}
.border-top-pink-A200{border-top-color:#ff4081!important}
.border-right-pink-A200{border-right-color:#ff4081!important}
.border-bottom-pink-A200{border-bottom-color:#ff4081!important}
.border-left-pink-A200{border-left-color:#ff4081!important}
.bg-pink-A400{background-color:#f50057!important}
.bg-pink-A400.text-auto{background-color:#f50057!important}
.text-pink-A400{color:#f50057!important}
.border-pink-A400{border-color:#f50057!important}
.border-top-pink-A400{border-top-color:#f50057!important}
.border-right-pink-A400{border-right-color:#f50057!important}
.border-bottom-pink-A400{border-bottom-color:#f50057!important}
.border-left-pink-A400{border-left-color:#f50057!important}
.bg-pink-A700{background-color:#c51162!important}
.bg-pink-A700.text-auto{background-color:#c51162!important}
.text-pink-A700{color:#c51162!important}
.border-pink-A700{border-color:#c51162!important}
.border-top-pink-A700{border-top-color:#c51162!important}
.border-right-pink-A700{border-right-color:#c51162!important}
.border-bottom-pink-A700{border-bottom-color:#c51162!important}
.border-left-pink-A700{border-left-color:#c51162!important}
.bg-purple-50{background-color:#f3e5f5!important}
.bg-purple-50.text-auto{background-color:#f3e5f5!important}
.text-purple-50{color:#f3e5f5!important}
.border-purple-50{border-color:#f3e5f5!important}
.border-top-purple-50{border-top-color:#f3e5f5!important}
.border-right-purple-50{border-right-color:#f3e5f5!important}
.border-bottom-purple-50{border-bottom-color:#f3e5f5!important}
.border-left-purple-50{border-left-color:#f3e5f5!important}
.bg-purple-100{background-color:#e1bee7!important}
.bg-purple-100.text-auto{background-color:#e1bee7!important}
.text-purple-100{color:#e1bee7!important}
.border-purple-100{border-color:#e1bee7!important}
.border-top-purple-100{border-top-color:#e1bee7!important}
.border-right-purple-100{border-right-color:#e1bee7!important}
.border-bottom-purple-100{border-bottom-color:#e1bee7!important}
.border-left-purple-100{border-left-color:#e1bee7!important}
.bg-purple-200{background-color:#ce93d8!important}
.bg-purple-200.text-auto{background-color:#ce93d8!important}
.text-purple-200{color:#ce93d8!important}
.border-purple-200{border-color:#ce93d8!important}
.border-top-purple-200{border-top-color:#ce93d8!important}
.border-right-purple-200{border-right-color:#ce93d8!important}
.border-bottom-purple-200{border-bottom-color:#ce93d8!important}
.border-left-purple-200{border-left-color:#ce93d8!important}
.bg-purple-300{background-color:#ba68c8!important}
.bg-purple-300.text-auto{background-color:#ba68c8!important}
.text-purple-300{color:#ba68c8!important}
.border-purple-300{border-color:#ba68c8!important}
.border-top-purple-300{border-top-color:#ba68c8!important}
.border-right-purple-300{border-right-color:#ba68c8!important}
.border-bottom-purple-300{border-bottom-color:#ba68c8!important}
.border-left-purple-300{border-left-color:#ba68c8!important}
.bg-purple-400{background-color:#ab47bc!important}
.bg-purple-400.text-auto{background-color:#ab47bc!important}
.text-purple-400{color:#ab47bc!important}
.border-purple-400{border-color:#ab47bc!important}
.border-top-purple-400{border-top-color:#ab47bc!important}
.border-right-purple-400{border-right-color:#ab47bc!important}
.border-bottom-purple-400{border-bottom-color:#ab47bc!important}
.border-left-purple-400{border-left-color:#ab47bc!important}
.bg-purple-500{background-color:#9c27b0!important}
.bg-purple-500.text-auto{background-color:#9c27b0!important}
.text-purple-500{color:#9c27b0!important}
.border-purple-500{border-color:#9c27b0!important}
.border-top-purple-500{border-top-color:#9c27b0!important}
.border-right-purple-500{border-right-color:#9c27b0!important}
.border-bottom-purple-500{border-bottom-color:#9c27b0!important}
.border-left-purple-500{border-left-color:#9c27b0!important}
.bg-purple.text-auto{background-color:#9c27b0!important}
.bg-purple{background-color:#9c27b0!important}
.text-purple{color:#9c27b0!important}
.border-purple{border-color:#9c27b0!important}
.border-top-purple{border-top-color:#9c27b0!important}
.border-right-purple{border-right-color:#9c27b0!important}
.border-bottom-purple{border-bottom-color:#9c27b0!important}
.border-left-purple{border-left-color:#9c27b0!important}
.bg-purple-600{background-color:#8e24aa!important}
.bg-purple-600.text-auto{background-color:#8e24aa!important}
.text-purple-600{color:#8e24aa!important}
.border-purple-600{border-color:#8e24aa!important}
.border-top-purple-600{border-top-color:#8e24aa!important}
.border-right-purple-600{border-right-color:#8e24aa!important}
.border-bottom-purple-600{border-bottom-color:#8e24aa!important}
.border-left-purple-600{border-left-color:#8e24aa!important}
.bg-purple-700{background-color:#7b1fa2!important}
.bg-purple-700.text-auto{background-color:#7b1fa2!important}
.text-purple-700{color:#7b1fa2!important}
.border-purple-700{border-color:#7b1fa2!important}
.border-top-purple-700{border-top-color:#7b1fa2!important}
.border-right-purple-700{border-right-color:#7b1fa2!important}
.border-bottom-purple-700{border-bottom-color:#7b1fa2!important}
.border-left-purple-700{border-left-color:#7b1fa2!important}
.bg-purple-800{background-color:#6a1b9a!important}
.bg-purple-800.text-auto{background-color:#6a1b9a!important}
.text-purple-800{color:#6a1b9a!important}
.border-purple-800{border-color:#6a1b9a!important}
.border-top-purple-800{border-top-color:#6a1b9a!important}
.border-right-purple-800{border-right-color:#6a1b9a!important}
.border-bottom-purple-800{border-bottom-color:#6a1b9a!important}
.border-left-purple-800{border-left-color:#6a1b9a!important}
.bg-purple-900{background-color:#4a148c!important}
.bg-purple-900.text-auto{background-color:#4a148c!important}
.text-purple-900{color:#4a148c!important}
.border-purple-900{border-color:#4a148c!important}
.border-top-purple-900{border-top-color:#4a148c!important}
.border-right-purple-900{border-right-color:#4a148c!important}
.border-bottom-purple-900{border-bottom-color:#4a148c!important}
.border-left-purple-900{border-left-color:#4a148c!important}
.bg-purple-A100{background-color:#ea80fc!important}
.bg-purple-A100.text-auto{background-color:#ea80fc!important}
.text-purple-A100{color:#ea80fc!important}
.border-purple-A100{border-color:#ea80fc!important}
.border-top-purple-A100{border-top-color:#ea80fc!important}
.border-right-purple-A100{border-right-color:#ea80fc!important}
.border-bottom-purple-A100{border-bottom-color:#ea80fc!important}
.border-left-purple-A100{border-left-color:#ea80fc!important}
.bg-purple-A200{background-color:#e040fb!important}
.bg-purple-A200.text-auto{background-color:#e040fb!important}
.text-purple-A200{color:#e040fb!important}
.border-purple-A200{border-color:#e040fb!important}
.border-top-purple-A200{border-top-color:#e040fb!important}
.border-right-purple-A200{border-right-color:#e040fb!important}
.border-bottom-purple-A200{border-bottom-color:#e040fb!important}
.border-left-purple-A200{border-left-color:#e040fb!important}
.bg-purple-A400{background-color:#d500f9!important}
.bg-purple-A400.text-auto{background-color:#d500f9!important}
.text-purple-A400{color:#d500f9!important}
.border-purple-A400{border-color:#d500f9!important}
.border-top-purple-A400{border-top-color:#d500f9!important}
.border-right-purple-A400{border-right-color:#d500f9!important}
.border-bottom-purple-A400{border-bottom-color:#d500f9!important}
.border-left-purple-A400{border-left-color:#d500f9!important}
.bg-purple-A700{background-color:#a0f!important}
.bg-purple-A700.text-auto{background-color:#a0f!important}
.text-purple-A700{color:#a0f!important}
.border-purple-A700{border-color:#a0f!important}
.border-top-purple-A700{border-top-color:#a0f!important}
.border-right-purple-A700{border-right-color:#a0f!important}
.border-bottom-purple-A700{border-bottom-color:#a0f!important}
.border-left-purple-A700{border-left-color:#a0f!important}
.bg-deep-purple-50{background-color:#ede7f6!important}
.bg-deep-purple-50.text-auto{background-color:#ede7f6!important}
.text-deep-purple-50{color:#ede7f6!important}
.border-deep-purple-50{border-color:#ede7f6!important}
.border-top-deep-purple-50{border-top-color:#ede7f6!important}
.border-right-deep-purple-50{border-right-color:#ede7f6!important}
.border-bottom-deep-purple-50{border-bottom-color:#ede7f6!important}
.border-left-deep-purple-50{border-left-color:#ede7f6!important}
.bg-deep-purple-100{background-color:#d1c4e9!important}
.bg-deep-purple-100.text-auto{background-color:#d1c4e9!important}
.text-deep-purple-100{color:#d1c4e9!important}
.border-deep-purple-100{border-color:#d1c4e9!important}
.border-top-deep-purple-100{border-top-color:#d1c4e9!important}
.border-right-deep-purple-100{border-right-color:#d1c4e9!important}
.border-bottom-deep-purple-100{border-bottom-color:#d1c4e9!important}
.border-left-deep-purple-100{border-left-color:#d1c4e9!important}
.bg-deep-purple-200{background-color:#b39ddb!important}
.bg-deep-purple-200.text-auto{background-color:#b39ddb!important}
.text-deep-purple-200{color:#b39ddb!important}
.border-deep-purple-200{border-color:#b39ddb!important}
.border-top-deep-purple-200{border-top-color:#b39ddb!important}
.border-right-deep-purple-200{border-right-color:#b39ddb!important}
.border-bottom-deep-purple-200{border-bottom-color:#b39ddb!important}
.border-left-deep-purple-200{border-left-color:#b39ddb!important}
.bg-deep-purple-300{background-color:#9575cd!important}
.bg-deep-purple-300.text-auto{background-color:#9575cd!important}
.text-deep-purple-300{color:#9575cd!important}
.border-deep-purple-300{border-color:#9575cd!important}
.border-top-deep-purple-300{border-top-color:#9575cd!important}
.border-right-deep-purple-300{border-right-color:#9575cd!important}
.border-bottom-deep-purple-300{border-bottom-color:#9575cd!important}
.border-left-deep-purple-300{border-left-color:#9575cd!important}
.bg-deep-purple-400{background-color:#7e57c2!important}
.bg-deep-purple-400.text-auto{background-color:#7e57c2!important}
.text-deep-purple-400{color:#7e57c2!important}
.border-deep-purple-400{border-color:#7e57c2!important}
.border-top-deep-purple-400{border-top-color:#7e57c2!important}
.border-right-deep-purple-400{border-right-color:#7e57c2!important}
.border-bottom-deep-purple-400{border-bottom-color:#7e57c2!important}
.border-left-deep-purple-400{border-left-color:#7e57c2!important}
.bg-deep-purple-500{background-color:#673ab7!important}
.bg-deep-purple-500.text-auto{background-color:#673ab7!important}
.text-deep-purple-500{color:#673ab7!important}
.border-deep-purple-500{border-color:#673ab7!important}
.border-top-deep-purple-500{border-top-color:#673ab7!important}
.border-right-deep-purple-500{border-right-color:#673ab7!important}
.border-bottom-deep-purple-500{border-bottom-color:#673ab7!important}
.border-left-deep-purple-500{border-left-color:#673ab7!important}
.bg-deep-purple.text-auto{background-color:#673ab7!important}
.bg-deep-purple{background-color:#673ab7!important}
.text-deep-purple{color:#673ab7!important}
.border-deep-purple{border-color:#673ab7!important}
.border-top-deep-purple{border-top-color:#673ab7!important}
.border-right-deep-purple{border-right-color:#673ab7!important}
.border-bottom-deep-purple{border-bottom-color:#673ab7!important}
.border-left-deep-purple{border-left-color:#673ab7!important}
.bg-deep-purple-600{background-color:#5e35b1!important}
.bg-deep-purple-600.text-auto{background-color:#5e35b1!important}
.text-deep-purple-600{color:#5e35b1!important}
.border-deep-purple-600{border-color:#5e35b1!important}
.border-top-deep-purple-600{border-top-color:#5e35b1!important}
.border-right-deep-purple-600{border-right-color:#5e35b1!important}
.border-bottom-deep-purple-600{border-bottom-color:#5e35b1!important}
.border-left-deep-purple-600{border-left-color:#5e35b1!important}
.bg-deep-purple-700{background-color:#512da8!important}
.bg-deep-purple-700.text-auto{background-color:#512da8!important}
.text-deep-purple-700{color:#512da8!important}
.border-deep-purple-700{border-color:#512da8!important}
.border-top-deep-purple-700{border-top-color:#512da8!important}
.border-right-deep-purple-700{border-right-color:#512da8!important}
.border-bottom-deep-purple-700{border-bottom-color:#512da8!important}
.border-left-deep-purple-700{border-left-color:#512da8!important}
.bg-deep-purple-800{background-color:#4527a0!important}
.bg-deep-purple-800.text-auto{background-color:#4527a0!important}
.text-deep-purple-800{color:#4527a0!important}
.border-deep-purple-800{border-color:#4527a0!important}
.border-top-deep-purple-800{border-top-color:#4527a0!important}
.border-right-deep-purple-800{border-right-color:#4527a0!important}
.border-bottom-deep-purple-800{border-bottom-color:#4527a0!important}
.border-left-deep-purple-800{border-left-color:#4527a0!important}
.bg-deep-purple-900{background-color:#311b92!important}
.bg-deep-purple-900.text-auto{background-color:#311b92!important}
.text-deep-purple-900{color:#311b92!important}
.border-deep-purple-900{border-color:#311b92!important}
.border-top-deep-purple-900{border-top-color:#311b92!important}
.border-right-deep-purple-900{border-right-color:#311b92!important}
.border-bottom-deep-purple-900{border-bottom-color:#311b92!important}
.border-left-deep-purple-900{border-left-color:#311b92!important}
.bg-deep-purple-A100{background-color:#b388ff!important}
.bg-deep-purple-A100.text-auto{background-color:#b388ff!important}
.text-deep-purple-A100{color:#b388ff!important}
.border-deep-purple-A100{border-color:#b388ff!important}
.border-top-deep-purple-A100{border-top-color:#b388ff!important}
.border-right-deep-purple-A100{border-right-color:#b388ff!important}
.border-bottom-deep-purple-A100{border-bottom-color:#b388ff!important}
.border-left-deep-purple-A100{border-left-color:#b388ff!important}
.bg-deep-purple-A200{background-color:#7c4dff!important}
.bg-deep-purple-A200.text-auto{background-color:#7c4dff!important}
.text-deep-purple-A200{color:#7c4dff!important}
.border-deep-purple-A200{border-color:#7c4dff!important}
.border-top-deep-purple-A200{border-top-color:#7c4dff!important}
.border-right-deep-purple-A200{border-right-color:#7c4dff!important}
.border-bottom-deep-purple-A200{border-bottom-color:#7c4dff!important}
.border-left-deep-purple-A200{border-left-color:#7c4dff!important}
.bg-deep-purple-A400{background-color:#651fff!important}
.bg-deep-purple-A400.text-auto{background-color:#651fff!important}
.text-deep-purple-A400{color:#651fff!important}
.border-deep-purple-A400{border-color:#651fff!important}
.border-top-deep-purple-A400{border-top-color:#651fff!important}
.border-right-deep-purple-A400{border-right-color:#651fff!important}
.border-bottom-deep-purple-A400{border-bottom-color:#651fff!important}
.border-left-deep-purple-A400{border-left-color:#651fff!important}
.bg-deep-purple-A700{background-color:#6200ea!important}
.bg-deep-purple-A700.text-auto{background-color:#6200ea!important}
.text-deep-purple-A700{color:#6200ea!important}
.border-deep-purple-A700{border-color:#6200ea!important}
.border-top-deep-purple-A700{border-top-color:#6200ea!important}
.border-right-deep-purple-A700{border-right-color:#6200ea!important}
.border-bottom-deep-purple-A700{border-bottom-color:#6200ea!important}
.border-left-deep-purple-A700{border-left-color:#6200ea!important}
.bg-indigo-50{background-color:#e8eaf6!important}
.bg-indigo-50.text-auto{background-color:#e8eaf6!important}
.text-indigo-50{color:#e8eaf6!important}
.border-indigo-50{border-color:#e8eaf6!important}
.border-top-indigo-50{border-top-color:#e8eaf6!important}
.border-right-indigo-50{border-right-color:#e8eaf6!important}
.border-bottom-indigo-50{border-bottom-color:#e8eaf6!important}
.border-left-indigo-50{border-left-color:#e8eaf6!important}
.bg-indigo-100{background-color:#c5cae9!important}
.bg-indigo-100.text-auto{background-color:#c5cae9!important}
.text-indigo-100{color:#c5cae9!important}
.border-indigo-100{border-color:#c5cae9!important}
.border-top-indigo-100{border-top-color:#c5cae9!important}
.border-right-indigo-100{border-right-color:#c5cae9!important}
.border-bottom-indigo-100{border-bottom-color:#c5cae9!important}
.border-left-indigo-100{border-left-color:#c5cae9!important}
.bg-indigo-200{background-color:#9fa8da!important}
.bg-indigo-200.text-auto{background-color:#9fa8da!important}
.text-indigo-200{color:#9fa8da!important}
.border-indigo-200{border-color:#9fa8da!important}
.border-top-indigo-200{border-top-color:#9fa8da!important}
.border-right-indigo-200{border-right-color:#9fa8da!important}
.border-bottom-indigo-200{border-bottom-color:#9fa8da!important}
.border-left-indigo-200{border-left-color:#9fa8da!important}
.bg-indigo-300{background-color:#7986cb!important}
.bg-indigo-300.text-auto{background-color:#7986cb!important}
.text-indigo-300{color:#7986cb!important}
.border-indigo-300{border-color:#7986cb!important}
.border-top-indigo-300{border-top-color:#7986cb!important}
.border-right-indigo-300{border-right-color:#7986cb!important}
.border-bottom-indigo-300{border-bottom-color:#7986cb!important}
.border-left-indigo-300{border-left-color:#7986cb!important}
.bg-indigo-400{background-color:#5c6bc0!important}
.bg-indigo-400.text-auto{background-color:#5c6bc0!important}
.text-indigo-400{color:#5c6bc0!important}
.border-indigo-400{border-color:#5c6bc0!important}
.border-top-indigo-400{border-top-color:#5c6bc0!important}
.border-right-indigo-400{border-right-color:#5c6bc0!important}
.border-bottom-indigo-400{border-bottom-color:#5c6bc0!important}
.border-left-indigo-400{border-left-color:#5c6bc0!important}
.bg-indigo-500{background-color:#3f51b5!important}
.bg-indigo-500.text-auto{background-color:#3f51b5!important}
.text-indigo-500{color:#3f51b5!important}
.border-indigo-500{border-color:#3f51b5!important}
.border-top-indigo-500{border-top-color:#3f51b5!important}
.border-right-indigo-500{border-right-color:#3f51b5!important}
.border-bottom-indigo-500{border-bottom-color:#3f51b5!important}
.border-left-indigo-500{border-left-color:#3f51b5!important}
.bg-indigo.text-auto{background-color:#3f51b5!important}
.bg-indigo{background-color:#3f51b5!important}
.text-indigo{color:#3f51b5!important}
.border-indigo{border-color:#3f51b5!important}
.border-top-indigo{border-top-color:#3f51b5!important}
.border-right-indigo{border-right-color:#3f51b5!important}
.border-bottom-indigo{border-bottom-color:#3f51b5!important}
.border-left-indigo{border-left-color:#3f51b5!important}
.bg-indigo-600{background-color:#3949ab!important}
.bg-indigo-600.text-auto{background-color:#3949ab!important}
.text-indigo-600{color:#3949ab!important}
.border-indigo-600{border-color:#3949ab!important}
.border-top-indigo-600{border-top-color:#3949ab!important}
.border-right-indigo-600{border-right-color:#3949ab!important}
.border-bottom-indigo-600{border-bottom-color:#3949ab!important}
.border-left-indigo-600{border-left-color:#3949ab!important}
.bg-indigo-700{background-color:#303f9f!important}
.bg-indigo-700.text-auto{background-color:#303f9f!important}
.text-indigo-700{color:#303f9f!important}
.border-indigo-700{border-color:#303f9f!important}
.border-top-indigo-700{border-top-color:#303f9f!important}
.border-right-indigo-700{border-right-color:#303f9f!important}
.border-bottom-indigo-700{border-bottom-color:#303f9f!important}
.border-left-indigo-700{border-left-color:#303f9f!important}
.bg-indigo-800{background-color:#283593!important}
.bg-indigo-800.text-auto{background-color:#283593!important}
.text-indigo-800{color:#283593!important}
.border-indigo-800{border-color:#283593!important}
.border-top-indigo-800{border-top-color:#283593!important}
.border-right-indigo-800{border-right-color:#283593!important}
.border-bottom-indigo-800{border-bottom-color:#283593!important}
.border-left-indigo-800{border-left-color:#283593!important}
.bg-indigo-900{background-color:#1a237e!important}
.bg-indigo-900.text-auto{background-color:#1a237e!important}
.text-indigo-900{color:#1a237e!important}
.border-indigo-900{border-color:#1a237e!important}
.border-top-indigo-900{border-top-color:#1a237e!important}
.border-right-indigo-900{border-right-color:#1a237e!important}
.border-bottom-indigo-900{border-bottom-color:#1a237e!important}
.border-left-indigo-900{border-left-color:#1a237e!important}
.bg-indigo-A100{background-color:#8c9eff!important}
.bg-indigo-A100.text-auto{background-color:#8c9eff!important}
.text-indigo-A100{color:#8c9eff!important}
.border-indigo-A100{border-color:#8c9eff!important}
.border-top-indigo-A100{border-top-color:#8c9eff!important}
.border-right-indigo-A100{border-right-color:#8c9eff!important}
.border-bottom-indigo-A100{border-bottom-color:#8c9eff!important}
.border-left-indigo-A100{border-left-color:#8c9eff!important}
.bg-indigo-A200{background-color:#536dfe!important}
.bg-indigo-A200.text-auto{background-color:#536dfe!important}
.text-indigo-A200{color:#536dfe!important}
.border-indigo-A200{border-color:#536dfe!important}
.border-top-indigo-A200{border-top-color:#536dfe!important}
.border-right-indigo-A200{border-right-color:#536dfe!important}
.border-bottom-indigo-A200{border-bottom-color:#536dfe!important}
.border-left-indigo-A200{border-left-color:#536dfe!important}
.bg-indigo-A400{background-color:#3d5afe!important}
.bg-indigo-A400.text-auto{background-color:#3d5afe!important}
.text-indigo-A400{color:#3d5afe!important}
.border-indigo-A400{border-color:#3d5afe!important}
.border-top-indigo-A400{border-top-color:#3d5afe!important}
.border-right-indigo-A400{border-right-color:#3d5afe!important}
.border-bottom-indigo-A400{border-bottom-color:#3d5afe!important}
.border-left-indigo-A400{border-left-color:#3d5afe!important}
.bg-indigo-A700{background-color:#304ffe!important}
.bg-indigo-A700.text-auto{background-color:#304ffe!important}
.text-indigo-A700{color:#304ffe!important}
.border-indigo-A700{border-color:#304ffe!important}
.border-top-indigo-A700{border-top-color:#304ffe!important}
.border-right-indigo-A700{border-right-color:#304ffe!important}
.border-bottom-indigo-A700{border-bottom-color:#304ffe!important}
.border-left-indigo-A700{border-left-color:#304ffe!important}
.bg-blue-50{background-color:#e3f2fd!important}
.bg-blue-50.text-auto{background-color:#e3f2fd!important}
.text-blue-50{color:#e3f2fd!important}
.border-blue-50{border-color:#e3f2fd!important}
.border-top-blue-50{border-top-color:#e3f2fd!important}
.border-right-blue-50{border-right-color:#e3f2fd!important}
.border-bottom-blue-50{border-bottom-color:#e3f2fd!important}
.border-left-blue-50{border-left-color:#e3f2fd!important}
.bg-blue-100{background-color:#bbdefb!important}
.bg-blue-100.text-auto{background-color:#bbdefb!important}
.text-blue-100{color:#bbdefb!important}
.border-blue-100{border-color:#bbdefb!important}
.border-top-blue-100{border-top-color:#bbdefb!important}
.border-right-blue-100{border-right-color:#bbdefb!important}
.border-bottom-blue-100{border-bottom-color:#bbdefb!important}
.border-left-blue-100{border-left-color:#bbdefb!important}
.bg-blue-200{background-color:#90caf9!important}
.bg-blue-200.text-auto{background-color:#90caf9!important}
.text-blue-200{color:#90caf9!important}
.border-blue-200{border-color:#90caf9!important}
.border-top-blue-200{border-top-color:#90caf9!important}
.border-right-blue-200{border-right-color:#90caf9!important}
.border-bottom-blue-200{border-bottom-color:#90caf9!important}
.border-left-blue-200{border-left-color:#90caf9!important}
.bg-blue-300{background-color:#64b5f6!important}
.bg-blue-300.text-auto{background-color:#64b5f6!important}
.text-blue-300{color:#64b5f6!important}
.border-blue-300{border-color:#64b5f6!important}
.border-top-blue-300{border-top-color:#64b5f6!important}
.border-right-blue-300{border-right-color:#64b5f6!important}
.border-bottom-blue-300{border-bottom-color:#64b5f6!important}
.border-left-blue-300{border-left-color:#64b5f6!important}
.bg-blue-400{background-color:#42a5f5!important}
.bg-blue-400.text-auto{background-color:#42a5f5!important}
.text-blue-400{color:#42a5f5!important}
.border-blue-400{border-color:#42a5f5!important}
.border-top-blue-400{border-top-color:#42a5f5!important}
.border-right-blue-400{border-right-color:#42a5f5!important}
.border-bottom-blue-400{border-bottom-color:#42a5f5!important}
.border-left-blue-400{border-left-color:#42a5f5!important}
.bg-blue-500{background-color:#2196f3!important}
.bg-blue-500.text-auto{background-color:#2196f3!important}
.text-blue-500{color:#2196f3!important}
.border-blue-500{border-color:#2196f3!important}
.border-top-blue-500{border-top-color:#2196f3!important}
.border-right-blue-500{border-right-color:#2196f3!important}
.border-bottom-blue-500{border-bottom-color:#2196f3!important}
.border-left-blue-500{border-left-color:#2196f3!important}
.bg-blue.text-auto{background-color:#2196f3!important}
.bg-blue{background-color:#2196f3!important}
.text-blue{color:#2196f3!important}
.border-blue{border-color:#2196f3!important}
.border-top-blue{border-top-color:#2196f3!important}
.border-right-blue{border-right-color:#2196f3!important}
.border-bottom-blue{border-bottom-color:#2196f3!important}
.border-left-blue{border-left-color:#2196f3!important}
.bg-blue-600{background-color:#1e88e5!important}
.bg-blue-600.text-auto{background-color:#1e88e5!important}
.text-blue-600{color:#1e88e5!important}
.border-blue-600{border-color:#1e88e5!important}
.border-top-blue-600{border-top-color:#1e88e5!important}
.border-right-blue-600{border-right-color:#1e88e5!important}
.border-bottom-blue-600{border-bottom-color:#1e88e5!important}
.border-left-blue-600{border-left-color:#1e88e5!important}
.bg-blue-700{background-color:#1976d2!important}
.bg-blue-700.text-auto{background-color:#1976d2!important}
.text-blue-700{color:#1976d2!important}
.border-blue-700{border-color:#1976d2!important}
.border-top-blue-700{border-top-color:#1976d2!important}
.border-right-blue-700{border-right-color:#1976d2!important}
.border-bottom-blue-700{border-bottom-color:#1976d2!important}
.border-left-blue-700{border-left-color:#1976d2!important}
.bg-blue-800{background-color:#1565c0!important}
.bg-blue-800.text-auto{background-color:#1565c0!important}
.text-blue-800{color:#1565c0!important}
.border-blue-800{border-color:#1565c0!important}
.border-top-blue-800{border-top-color:#1565c0!important}
.border-right-blue-800{border-right-color:#1565c0!important}
.border-bottom-blue-800{border-bottom-color:#1565c0!important}
.border-left-blue-800{border-left-color:#1565c0!important}
.bg-blue-900{background-color:#0d47a1!important}
.bg-blue-900.text-auto{background-color:#0d47a1!important}
.text-blue-900{color:#0d47a1!important}
.border-blue-900{border-color:#0d47a1!important}
.border-top-blue-900{border-top-color:#0d47a1!important}
.border-right-blue-900{border-right-color:#0d47a1!important}
.border-bottom-blue-900{border-bottom-color:#0d47a1!important}
.border-left-blue-900{border-left-color:#0d47a1!important}
.bg-blue-A100{background-color:#82b1ff!important}
.bg-blue-A100.text-auto{background-color:#82b1ff!important}
.text-blue-A100{color:#82b1ff!important}
.border-blue-A100{border-color:#82b1ff!important}
.border-top-blue-A100{border-top-color:#82b1ff!important}
.border-right-blue-A100{border-right-color:#82b1ff!important}
.border-bottom-blue-A100{border-bottom-color:#82b1ff!important}
.border-left-blue-A100{border-left-color:#82b1ff!important}
.bg-blue-A200{background-color:#448aff!important}
.bg-blue-A200.text-auto{background-color:#448aff!important}
.text-blue-A200{color:#448aff!important}
.border-blue-A200{border-color:#448aff!important}
.border-top-blue-A200{border-top-color:#448aff!important}
.border-right-blue-A200{border-right-color:#448aff!important}
.border-bottom-blue-A200{border-bottom-color:#448aff!important}
.border-left-blue-A200{border-left-color:#448aff!important}
.bg-blue-A400{background-color:#2979ff!important}
.bg-blue-A400.text-auto{background-color:#2979ff!important}
.text-blue-A400{color:#2979ff!important}
.border-blue-A400{border-color:#2979ff!important}
.border-top-blue-A400{border-top-color:#2979ff!important}
.border-right-blue-A400{border-right-color:#2979ff!important}
.border-bottom-blue-A400{border-bottom-color:#2979ff!important}
.border-left-blue-A400{border-left-color:#2979ff!important}
.bg-blue-A700{background-color:#2962ff!important}
.bg-blue-A700.text-auto{background-color:#2962ff!important}
.text-blue-A700{color:#2962ff!important}
.border-blue-A700{border-color:#2962ff!important}
.border-top-blue-A700{border-top-color:#2962ff!important}
.border-right-blue-A700{border-right-color:#2962ff!important}
.border-bottom-blue-A700{border-bottom-color:#2962ff!important}
.border-left-blue-A700{border-left-color:#2962ff!important}
.bg-light-blue-50{background-color:#e1f5fe!important}
.bg-light-blue-50.text-auto{background-color:#e1f5fe!important}
.text-light-blue-50{color:#e1f5fe!important}
.border-light-blue-50{border-color:#e1f5fe!important}
.border-top-light-blue-50{border-top-color:#e1f5fe!important}
.border-right-light-blue-50{border-right-color:#e1f5fe!important}
.border-bottom-light-blue-50{border-bottom-color:#e1f5fe!important}
.border-left-light-blue-50{border-left-color:#e1f5fe!important}
.bg-light-blue-100{background-color:#b3e5fc!important}
.bg-light-blue-100.text-auto{background-color:#b3e5fc!important}
.text-light-blue-100{color:#b3e5fc!important}
.border-light-blue-100{border-color:#b3e5fc!important}
.border-top-light-blue-100{border-top-color:#b3e5fc!important}
.border-right-light-blue-100{border-right-color:#b3e5fc!important}
.border-bottom-light-blue-100{border-bottom-color:#b3e5fc!important}
.border-left-light-blue-100{border-left-color:#b3e5fc!important}
.bg-light-blue-200{background-color:#81d4fa!important}
.bg-light-blue-200.text-auto{background-color:#81d4fa!important}
.text-light-blue-200{color:#81d4fa!important}
.border-light-blue-200{border-color:#81d4fa!important}
.border-top-light-blue-200{border-top-color:#81d4fa!important}
.border-right-light-blue-200{border-right-color:#81d4fa!important}
.border-bottom-light-blue-200{border-bottom-color:#81d4fa!important}
.border-left-light-blue-200{border-left-color:#81d4fa!important}
.bg-light-blue-300{background-color:#4fc3f7!important}
.bg-light-blue-300.text-auto{background-color:#4fc3f7!important}
.text-light-blue-300{color:#4fc3f7!important}
.border-light-blue-300{border-color:#4fc3f7!important}
.border-top-light-blue-300{border-top-color:#4fc3f7!important}
.border-right-light-blue-300{border-right-color:#4fc3f7!important}
.border-bottom-light-blue-300{border-bottom-color:#4fc3f7!important}
.border-left-light-blue-300{border-left-color:#4fc3f7!important}
.bg-light-blue-400{background-color:#29b6f6!important}
.bg-light-blue-400.text-auto{background-color:#29b6f6!important}
.text-light-blue-400{color:#29b6f6!important}
.border-light-blue-400{border-color:#29b6f6!important}
.border-top-light-blue-400{border-top-color:#29b6f6!important}
.border-right-light-blue-400{border-right-color:#29b6f6!important}
.border-bottom-light-blue-400{border-bottom-color:#29b6f6!important}
.border-left-light-blue-400{border-left-color:#29b6f6!important}
.bg-light-blue-500{background-color:#03a9f4!important}
.bg-light-blue-500.text-auto{background-color:#03a9f4!important}
.text-light-blue-500{color:#03a9f4!important}
.border-light-blue-500{border-color:#03a9f4!important}
.border-top-light-blue-500{border-top-color:#03a9f4!important}
.border-right-light-blue-500{border-right-color:#03a9f4!important}
.border-bottom-light-blue-500{border-bottom-color:#03a9f4!important}
.border-left-light-blue-500{border-left-color:#03a9f4!important}
.bg-light-blue.text-auto{background-color:#03a9f4!important}
.bg-light-blue{background-color:#03a9f4!important}
.text-light-blue{color:#03a9f4!important}
.border-light-blue{border-color:#03a9f4!important}
.border-top-light-blue{border-top-color:#03a9f4!important}
.border-right-light-blue{border-right-color:#03a9f4!important}
.border-bottom-light-blue{border-bottom-color:#03a9f4!important}
.border-left-light-blue{border-left-color:#03a9f4!important}
.bg-light-blue-600{background-color:#039be5!important}
.bg-light-blue-600.text-auto{background-color:#039be5!important}
.text-light-blue-600{color:#039be5!important}
.border-light-blue-600{border-color:#039be5!important}
.border-top-light-blue-600{border-top-color:#039be5!important}
.border-right-light-blue-600{border-right-color:#039be5!important}
.border-bottom-light-blue-600{border-bottom-color:#039be5!important}
.border-left-light-blue-600{border-left-color:#039be5!important}
.bg-light-blue-700{background-color:#0288d1!important}
.bg-light-blue-700.text-auto{background-color:#0288d1!important}
.text-light-blue-700{color:#0288d1!important}
.border-light-blue-700{border-color:#0288d1!important}
.border-top-light-blue-700{border-top-color:#0288d1!important}
.border-right-light-blue-700{border-right-color:#0288d1!important}
.border-bottom-light-blue-700{border-bottom-color:#0288d1!important}
.border-left-light-blue-700{border-left-color:#0288d1!important}
.bg-light-blue-800{background-color:#0277bd!important}
.bg-light-blue-800.text-auto{background-color:#0277bd!important}
.text-light-blue-800{color:#0277bd!important}
.border-light-blue-800{border-color:#0277bd!important}
.border-top-light-blue-800{border-top-color:#0277bd!important}
.border-right-light-blue-800{border-right-color:#0277bd!important}
.border-bottom-light-blue-800{border-bottom-color:#0277bd!important}
.border-left-light-blue-800{border-left-color:#0277bd!important}
.bg-light-blue-900{background-color:#01579b!important}
.bg-light-blue-900.text-auto{background-color:#01579b!important}
.text-light-blue-900{color:#01579b!important}
.border-light-blue-900{border-color:#01579b!important}
.border-top-light-blue-900{border-top-color:#01579b!important}
.border-right-light-blue-900{border-right-color:#01579b!important}
.border-bottom-light-blue-900{border-bottom-color:#01579b!important}
.border-left-light-blue-900{border-left-color:#01579b!important}
.bg-light-blue-A100{background-color:#80d8ff!important}
.bg-light-blue-A100.text-auto{background-color:#80d8ff!important}
.text-light-blue-A100{color:#80d8ff!important}
.border-light-blue-A100{border-color:#80d8ff!important}
.border-top-light-blue-A100{border-top-color:#80d8ff!important}
.border-right-light-blue-A100{border-right-color:#80d8ff!important}
.border-bottom-light-blue-A100{border-bottom-color:#80d8ff!important}
.border-left-light-blue-A100{border-left-color:#80d8ff!important}
.bg-light-blue-A200{background-color:#40c4ff!important}
.bg-light-blue-A200.text-auto{background-color:#40c4ff!important}
.text-light-blue-A200{color:#40c4ff!important}
.border-light-blue-A200{border-color:#40c4ff!important}
.border-top-light-blue-A200{border-top-color:#40c4ff!important}
.border-right-light-blue-A200{border-right-color:#40c4ff!important}
.border-bottom-light-blue-A200{border-bottom-color:#40c4ff!important}
.border-left-light-blue-A200{border-left-color:#40c4ff!important}
.bg-light-blue-A400{background-color:#00b0ff!important}
.bg-light-blue-A400.text-auto{background-color:#00b0ff!important}
.text-light-blue-A400{color:#00b0ff!important}
.border-light-blue-A400{border-color:#00b0ff!important}
.border-top-light-blue-A400{border-top-color:#00b0ff!important}
.border-right-light-blue-A400{border-right-color:#00b0ff!important}
.border-bottom-light-blue-A400{border-bottom-color:#00b0ff!important}
.border-left-light-blue-A400{border-left-color:#00b0ff!important}
.bg-light-blue-A700{background-color:#0091ea!important}
.bg-light-blue-A700.text-auto{background-color:#0091ea!important}
.text-light-blue-A700{color:#0091ea!important}
.border-light-blue-A700{border-color:#0091ea!important}
.border-top-light-blue-A700{border-top-color:#0091ea!important}
.border-right-light-blue-A700{border-right-color:#0091ea!important}
.border-bottom-light-blue-A700{border-bottom-color:#0091ea!important}
.border-left-light-blue-A700{border-left-color:#0091ea!important}
.bg-cyan-50{background-color:#e0f7fa!important}
.bg-cyan-50.text-auto{background-color:#e0f7fa!important}
.text-cyan-50{color:#e0f7fa!important}
.border-cyan-50{border-color:#e0f7fa!important}
.border-top-cyan-50{border-top-color:#e0f7fa!important}
.border-right-cyan-50{border-right-color:#e0f7fa!important}
.border-bottom-cyan-50{border-bottom-color:#e0f7fa!important}
.border-left-cyan-50{border-left-color:#e0f7fa!important}
.bg-cyan-100{background-color:#b2ebf2!important}
.bg-cyan-100.text-auto{background-color:#b2ebf2!important}
.text-cyan-100{color:#b2ebf2!important}
.border-cyan-100{border-color:#b2ebf2!important}
.border-top-cyan-100{border-top-color:#b2ebf2!important}
.border-right-cyan-100{border-right-color:#b2ebf2!important}
.border-bottom-cyan-100{border-bottom-color:#b2ebf2!important}
.border-left-cyan-100{border-left-color:#b2ebf2!important}
.bg-cyan-200{background-color:#80deea!important}
.bg-cyan-200.text-auto{background-color:#80deea!important}
.text-cyan-200{color:#80deea!important}
.border-cyan-200{border-color:#80deea!important}
.border-top-cyan-200{border-top-color:#80deea!important}
.border-right-cyan-200{border-right-color:#80deea!important}
.border-bottom-cyan-200{border-bottom-color:#80deea!important}
.border-left-cyan-200{border-left-color:#80deea!important}
.bg-cyan-300{background-color:#4dd0e1!important}
.bg-cyan-300.text-auto{background-color:#4dd0e1!important}
.text-cyan-300{color:#4dd0e1!important}
.border-cyan-300{border-color:#4dd0e1!important}
.border-top-cyan-300{border-top-color:#4dd0e1!important}
.border-right-cyan-300{border-right-color:#4dd0e1!important}
.border-bottom-cyan-300{border-bottom-color:#4dd0e1!important}
.border-left-cyan-300{border-left-color:#4dd0e1!important}
.bg-cyan-400{background-color:#26c6da!important}
.bg-cyan-400.text-auto{background-color:#26c6da!important}
.text-cyan-400{color:#26c6da!important}
.border-cyan-400{border-color:#26c6da!important}
.border-top-cyan-400{border-top-color:#26c6da!important}
.border-right-cyan-400{border-right-color:#26c6da!important}
.border-bottom-cyan-400{border-bottom-color:#26c6da!important}
.border-left-cyan-400{border-left-color:#26c6da!important}
.bg-cyan-500{background-color:#00bcd4!important}
.bg-cyan-500.text-auto{background-color:#00bcd4!important}
.text-cyan-500{color:#00bcd4!important}
.border-cyan-500{border-color:#00bcd4!important}
.border-top-cyan-500{border-top-color:#00bcd4!important}
.border-right-cyan-500{border-right-color:#00bcd4!important}
.border-bottom-cyan-500{border-bottom-color:#00bcd4!important}
.border-left-cyan-500{border-left-color:#00bcd4!important}
.bg-cyan.text-auto{background-color:#00bcd4!important}
.bg-cyan{background-color:#00bcd4!important}
.text-cyan{color:#00bcd4!important}
.border-cyan{border-color:#00bcd4!important}
.border-top-cyan{border-top-color:#00bcd4!important}
.border-right-cyan{border-right-color:#00bcd4!important}
.border-bottom-cyan{border-bottom-color:#00bcd4!important}
.border-left-cyan{border-left-color:#00bcd4!important}
.bg-cyan-600{background-color:#00acc1!important}
.bg-cyan-600.text-auto{background-color:#00acc1!important}
.text-cyan-600{color:#00acc1!important}
.border-cyan-600{border-color:#00acc1!important}
.border-top-cyan-600{border-top-color:#00acc1!important}
.border-right-cyan-600{border-right-color:#00acc1!important}
.border-bottom-cyan-600{border-bottom-color:#00acc1!important}
.border-left-cyan-600{border-left-color:#00acc1!important}
.bg-cyan-700{background-color:#0097a7!important}
.bg-cyan-700.text-auto{background-color:#0097a7!important}
.text-cyan-700{color:#0097a7!important}
.border-cyan-700{border-color:#0097a7!important}
.border-top-cyan-700{border-top-color:#0097a7!important}
.border-right-cyan-700{border-right-color:#0097a7!important}
.border-bottom-cyan-700{border-bottom-color:#0097a7!important}
.border-left-cyan-700{border-left-color:#0097a7!important}
.bg-cyan-800{background-color:#00838f!important}
.bg-cyan-800.text-auto{background-color:#00838f!important}
.text-cyan-800{color:#00838f!important}
.border-cyan-800{border-color:#00838f!important}
.border-top-cyan-800{border-top-color:#00838f!important}
.border-right-cyan-800{border-right-color:#00838f!important}
.border-bottom-cyan-800{border-bottom-color:#00838f!important}
.border-left-cyan-800{border-left-color:#00838f!important}
.bg-cyan-900{background-color:#006064!important}
.bg-cyan-900.text-auto{background-color:#006064!important}
.text-cyan-900{color:#006064!important}
.border-cyan-900{border-color:#006064!important}
.border-top-cyan-900{border-top-color:#006064!important}
.border-right-cyan-900{border-right-color:#006064!important}
.border-bottom-cyan-900{border-bottom-color:#006064!important}
.border-left-cyan-900{border-left-color:#006064!important}
.bg-cyan-A100{background-color:#84ffff!important}
.bg-cyan-A100.text-auto{background-color:#84ffff!important}
.text-cyan-A100{color:#84ffff!important}
.border-cyan-A100{border-color:#84ffff!important}
.border-top-cyan-A100{border-top-color:#84ffff!important}
.border-right-cyan-A100{border-right-color:#84ffff!important}
.border-bottom-cyan-A100{border-bottom-color:#84ffff!important}
.border-left-cyan-A100{border-left-color:#84ffff!important}
.bg-cyan-A200{background-color:#18ffff!important}
.bg-cyan-A200.text-auto{background-color:#18ffff!important}
.text-cyan-A200{color:#18ffff!important}
.border-cyan-A200{border-color:#18ffff!important}
.border-top-cyan-A200{border-top-color:#18ffff!important}
.border-right-cyan-A200{border-right-color:#18ffff!important}
.border-bottom-cyan-A200{border-bottom-color:#18ffff!important}
.border-left-cyan-A200{border-left-color:#18ffff!important}
.bg-cyan-A400{background-color:#00e5ff!important}
.bg-cyan-A400.text-auto{background-color:#00e5ff!important}
.text-cyan-A400{color:#00e5ff!important}
.border-cyan-A400{border-color:#00e5ff!important}
.border-top-cyan-A400{border-top-color:#00e5ff!important}
.border-right-cyan-A400{border-right-color:#00e5ff!important}
.border-bottom-cyan-A400{border-bottom-color:#00e5ff!important}
.border-left-cyan-A400{border-left-color:#00e5ff!important}
.bg-cyan-A700{background-color:#00b8d4!important}
.bg-cyan-A700.text-auto{background-color:#00b8d4!important}
.text-cyan-A700{color:#00b8d4!important}
.border-cyan-A700{border-color:#00b8d4!important}
.border-top-cyan-A700{border-top-color:#00b8d4!important}
.border-right-cyan-A700{border-right-color:#00b8d4!important}
.border-bottom-cyan-A700{border-bottom-color:#00b8d4!important}
.border-left-cyan-A700{border-left-color:#00b8d4!important}
.bg-teal-50{background-color:#e0f2f1!important}
.bg-teal-50.text-auto{background-color:#e0f2f1!important}
.text-teal-50{color:#e0f2f1!important}
.border-teal-50{border-color:#e0f2f1!important}
.border-top-teal-50{border-top-color:#e0f2f1!important}
.border-right-teal-50{border-right-color:#e0f2f1!important}
.border-bottom-teal-50{border-bottom-color:#e0f2f1!important}
.border-left-teal-50{border-left-color:#e0f2f1!important}
.bg-teal-100{background-color:#b2dfdb!important}
.bg-teal-100.text-auto{background-color:#b2dfdb!important}
.text-teal-100{color:#b2dfdb!important}
.border-teal-100{border-color:#b2dfdb!important}
.border-top-teal-100{border-top-color:#b2dfdb!important}
.border-right-teal-100{border-right-color:#b2dfdb!important}
.border-bottom-teal-100{border-bottom-color:#b2dfdb!important}
.border-left-teal-100{border-left-color:#b2dfdb!important}
.bg-teal-200{background-color:#80cbc4!important}
.bg-teal-200.text-auto{background-color:#80cbc4!important}
.text-teal-200{color:#80cbc4!important}
.border-teal-200{border-color:#80cbc4!important}
.border-top-teal-200{border-top-color:#80cbc4!important}
.border-right-teal-200{border-right-color:#80cbc4!important}
.border-bottom-teal-200{border-bottom-color:#80cbc4!important}
.border-left-teal-200{border-left-color:#80cbc4!important}
.bg-teal-300{background-color:#4db6ac!important}
.bg-teal-300.text-auto{background-color:#4db6ac!important}
.text-teal-300{color:#4db6ac!important}
.border-teal-300{border-color:#4db6ac!important}
.border-top-teal-300{border-top-color:#4db6ac!important}
.border-right-teal-300{border-right-color:#4db6ac!important}
.border-bottom-teal-300{border-bottom-color:#4db6ac!important}
.border-left-teal-300{border-left-color:#4db6ac!important}
.bg-teal-400{background-color:#26a69a!important}
.bg-teal-400.text-auto{background-color:#26a69a!important}
.text-teal-400{color:#26a69a!important}
.border-teal-400{border-color:#26a69a!important}
.border-top-teal-400{border-top-color:#26a69a!important}
.border-right-teal-400{border-right-color:#26a69a!important}
.border-bottom-teal-400{border-bottom-color:#26a69a!important}
.border-left-teal-400{border-left-color:#26a69a!important}
.bg-teal-500{background-color:#009688!important}
.bg-teal-500.text-auto{background-color:#009688!important}
.text-teal-500{color:#009688!important}
.border-teal-500{border-color:#009688!important}
.border-top-teal-500{border-top-color:#009688!important}
.border-right-teal-500{border-right-color:#009688!important}
.border-bottom-teal-500{border-bottom-color:#009688!important}
.border-left-teal-500{border-left-color:#009688!important}
.bg-teal.text-auto{background-color:#009688!important}
.bg-teal{background-color:#009688!important}
.text-teal{color:#009688!important}
.border-teal{border-color:#009688!important}
.border-top-teal{border-top-color:#009688!important}
.border-right-teal{border-right-color:#009688!important}
.border-bottom-teal{border-bottom-color:#009688!important}
.border-left-teal{border-left-color:#009688!important}
.bg-teal-600{background-color:#00897b!important}
.bg-teal-600.text-auto{background-color:#00897b!important}
.text-teal-600{color:#00897b!important}
.border-teal-600{border-color:#00897b!important}
.border-top-teal-600{border-top-color:#00897b!important}
.border-right-teal-600{border-right-color:#00897b!important}
.border-bottom-teal-600{border-bottom-color:#00897b!important}
.border-left-teal-600{border-left-color:#00897b!important}
.bg-teal-700{background-color:#00796b!important}
.bg-teal-700.text-auto{background-color:#00796b!important}
.text-teal-700{color:#00796b!important}
.border-teal-700{border-color:#00796b!important}
.border-top-teal-700{border-top-color:#00796b!important}
.border-right-teal-700{border-right-color:#00796b!important}
.border-bottom-teal-700{border-bottom-color:#00796b!important}
.border-left-teal-700{border-left-color:#00796b!important}
.bg-teal-800{background-color:#00695c!important}
.bg-teal-800.text-auto{background-color:#00695c!important}
.text-teal-800{color:#00695c!important}
.border-teal-800{border-color:#00695c!important}
.border-top-teal-800{border-top-color:#00695c!important}
.border-right-teal-800{border-right-color:#00695c!important}
.border-bottom-teal-800{border-bottom-color:#00695c!important}
.border-left-teal-800{border-left-color:#00695c!important}
.bg-teal-900{background-color:#004d40!important}
.bg-teal-900.text-auto{background-color:#004d40!important}
.text-teal-900{color:#004d40!important}
.border-teal-900{border-color:#004d40!important}
.border-top-teal-900{border-top-color:#004d40!important}
.border-right-teal-900{border-right-color:#004d40!important}
.border-bottom-teal-900{border-bottom-color:#004d40!important}
.border-left-teal-900{border-left-color:#004d40!important}
.bg-teal-A100{background-color:#a7ffeb!important}
.bg-teal-A100.text-auto{background-color:#a7ffeb!important}
.text-teal-A100{color:#a7ffeb!important}
.border-teal-A100{border-color:#a7ffeb!important}
.border-top-teal-A100{border-top-color:#a7ffeb!important}
.border-right-teal-A100{border-right-color:#a7ffeb!important}
.border-bottom-teal-A100{border-bottom-color:#a7ffeb!important}
.border-left-teal-A100{border-left-color:#a7ffeb!important}
.bg-teal-A200{background-color:#64ffda!important}
.bg-teal-A200.text-auto{background-color:#64ffda!important}
.text-teal-A200{color:#64ffda!important}
.border-teal-A200{border-color:#64ffda!important}
.border-top-teal-A200{border-top-color:#64ffda!important}
.border-right-teal-A200{border-right-color:#64ffda!important}
.border-bottom-teal-A200{border-bottom-color:#64ffda!important}
.border-left-teal-A200{border-left-color:#64ffda!important}
.bg-teal-A400{background-color:#1de9b6!important}
.bg-teal-A400.text-auto{background-color:#1de9b6!important}
.text-teal-A400{color:#1de9b6!important}
.border-teal-A400{border-color:#1de9b6!important}
.border-top-teal-A400{border-top-color:#1de9b6!important}
.border-right-teal-A400{border-right-color:#1de9b6!important}
.border-bottom-teal-A400{border-bottom-color:#1de9b6!important}
.border-left-teal-A400{border-left-color:#1de9b6!important}
.bg-teal-A700{background-color:#00bfa5!important}
.bg-teal-A700.text-auto{background-color:#00bfa5!important}
.text-teal-A700{color:#00bfa5!important}
.border-teal-A700{border-color:#00bfa5!important}
.border-top-teal-A700{border-top-color:#00bfa5!important}
.border-right-teal-A700{border-right-color:#00bfa5!important}
.border-bottom-teal-A700{border-bottom-color:#00bfa5!important}
.border-left-teal-A700{border-left-color:#00bfa5!important}
.bg-green-50{background-color:#e8f5e9!important}
.bg-green-50.text-auto{background-color:#e8f5e9!important}
.text-green-50{color:#e8f5e9!important}
.border-green-50{border-color:#e8f5e9!important}
.border-top-green-50{border-top-color:#e8f5e9!important}
.border-right-green-50{border-right-color:#e8f5e9!important}
.border-bottom-green-50{border-bottom-color:#e8f5e9!important}
.border-left-green-50{border-left-color:#e8f5e9!important}
.bg-green-100{background-color:#c8e6c9!important}
.bg-green-100.text-auto{background-color:#c8e6c9!important}
.text-green-100{color:#c8e6c9!important}
.border-green-100{border-color:#c8e6c9!important}
.border-top-green-100{border-top-color:#c8e6c9!important}
.border-right-green-100{border-right-color:#c8e6c9!important}
.border-bottom-green-100{border-bottom-color:#c8e6c9!important}
.border-left-green-100{border-left-color:#c8e6c9!important}
.bg-green-200{background-color:#a5d6a7!important}
.bg-green-200.text-auto{background-color:#a5d6a7!important}
.text-green-200{color:#a5d6a7!important}
.border-green-200{border-color:#a5d6a7!important}
.border-top-green-200{border-top-color:#a5d6a7!important}
.border-right-green-200{border-right-color:#a5d6a7!important}
.border-bottom-green-200{border-bottom-color:#a5d6a7!important}
.border-left-green-200{border-left-color:#a5d6a7!important}
.bg-green-300{background-color:#81c784!important}
.bg-green-300.text-auto{background-color:#81c784!important}
.text-green-300{color:#81c784!important}
.border-green-300{border-color:#81c784!important}
.border-top-green-300{border-top-color:#81c784!important}
.border-right-green-300{border-right-color:#81c784!important}
.border-bottom-green-300{border-bottom-color:#81c784!important}
.border-left-green-300{border-left-color:#81c784!important}
.bg-green-400{background-color:#66bb6a!important}
.bg-green-400.text-auto{background-color:#66bb6a!important}
.text-green-400{color:#66bb6a!important}
.border-green-400{border-color:#66bb6a!important}
.border-top-green-400{border-top-color:#66bb6a!important}
.border-right-green-400{border-right-color:#66bb6a!important}
.border-bottom-green-400{border-bottom-color:#66bb6a!important}
.border-left-green-400{border-left-color:#66bb6a!important}
.bg-green-500{background-color:#4caf50!important}
.bg-green-500.text-auto{background-color:#4caf50!important}
.text-green-500{color:#4caf50!important}
.border-green-500{border-color:#4caf50!important}
.border-top-green-500{border-top-color:#4caf50!important}
.border-right-green-500{border-right-color:#4caf50!important}
.border-bottom-green-500{border-bottom-color:#4caf50!important}
.border-left-green-500{border-left-color:#4caf50!important}
.bg-green.text-auto{background-color:#4caf50!important}
.bg-green{background-color:#4caf50!important}
.text-green{color:#4caf50!important}
.border-green{border-color:#4caf50!important}
.border-top-green{border-top-color:#4caf50!important}
.border-right-green{border-right-color:#4caf50!important}
.border-bottom-green{border-bottom-color:#4caf50!important}
.border-left-green{border-left-color:#4caf50!important}
.bg-green-600{background-color:#43a047!important}
.bg-green-600.text-auto{background-color:#43a047!important}
.text-green-600{color:#43a047!important}
.border-green-600{border-color:#43a047!important}
.border-top-green-600{border-top-color:#43a047!important}
.border-right-green-600{border-right-color:#43a047!important}
.border-bottom-green-600{border-bottom-color:#43a047!important}
.border-left-green-600{border-left-color:#43a047!important}
.bg-green-700{background-color:#388e3c!important}
.bg-green-700.text-auto{background-color:#388e3c!important}
.text-green-700{color:#388e3c!important}
.border-green-700{border-color:#388e3c!important}
.border-top-green-700{border-top-color:#388e3c!important}
.border-right-green-700{border-right-color:#388e3c!important}
.border-bottom-green-700{border-bottom-color:#388e3c!important}
.border-left-green-700{border-left-color:#388e3c!important}
.bg-green-800{background-color:#2e7d32!important}
.bg-green-800.text-auto{background-color:#2e7d32!important}
.text-green-800{color:#2e7d32!important}
.border-green-800{border-color:#2e7d32!important}
.border-top-green-800{border-top-color:#2e7d32!important}
.border-right-green-800{border-right-color:#2e7d32!important}
.border-bottom-green-800{border-bottom-color:#2e7d32!important}
.border-left-green-800{border-left-color:#2e7d32!important}
.bg-green-900{background-color:#1b5e20!important}
.bg-green-900.text-auto{background-color:#1b5e20!important}
.text-green-900{color:#1b5e20!important}
.border-green-900{border-color:#1b5e20!important}
.border-top-green-900{border-top-color:#1b5e20!important}
.border-right-green-900{border-right-color:#1b5e20!important}
.border-bottom-green-900{border-bottom-color:#1b5e20!important}
.border-left-green-900{border-left-color:#1b5e20!important}
.bg-green-A100{background-color:#b9f6ca!important}
.bg-green-A100.text-auto{background-color:#b9f6ca!important}
.text-green-A100{color:#b9f6ca!important}
.border-green-A100{border-color:#b9f6ca!important}
.border-top-green-A100{border-top-color:#b9f6ca!important}
.border-right-green-A100{border-right-color:#b9f6ca!important}
.border-bottom-green-A100{border-bottom-color:#b9f6ca!important}
.border-left-green-A100{border-left-color:#b9f6ca!important}
.bg-green-A200{background-color:#69f0ae!important}
.bg-green-A200.text-auto{background-color:#69f0ae!important}
.text-green-A200{color:#69f0ae!important}
.border-green-A200{border-color:#69f0ae!important}
.border-top-green-A200{border-top-color:#69f0ae!important}
.border-right-green-A200{border-right-color:#69f0ae!important}
.border-bottom-green-A200{border-bottom-color:#69f0ae!important}
.border-left-green-A200{border-left-color:#69f0ae!important}
.bg-green-A400{background-color:#00e676!important}
.bg-green-A400.text-auto{background-color:#00e676!important}
.text-green-A400{color:#00e676!important}
.border-green-A400{border-color:#00e676!important}
.border-top-green-A400{border-top-color:#00e676!important}
.border-right-green-A400{border-right-color:#00e676!important}
.border-bottom-green-A400{border-bottom-color:#00e676!important}
.border-left-green-A400{border-left-color:#00e676!important}
.bg-green-A700{background-color:#00c853!important}
.bg-green-A700.text-auto{background-color:#00c853!important}
.text-green-A700{color:#00c853!important}
.border-green-A700{border-color:#00c853!important}
.border-top-green-A700{border-top-color:#00c853!important}
.border-right-green-A700{border-right-color:#00c853!important}
.border-bottom-green-A700{border-bottom-color:#00c853!important}
.border-left-green-A700{border-left-color:#00c853!important}
.bg-light-green-50{background-color:#f1f8e9!important}
.bg-light-green-50.text-auto{background-color:#f1f8e9!important}
.text-light-green-50{color:#f1f8e9!important}
.border-light-green-50{border-color:#f1f8e9!important}
.border-top-light-green-50{border-top-color:#f1f8e9!important}
.border-right-light-green-50{border-right-color:#f1f8e9!important}
.border-bottom-light-green-50{border-bottom-color:#f1f8e9!important}
.border-left-light-green-50{border-left-color:#f1f8e9!important}
.bg-light-green-100{background-color:#dcedc8!important}
.bg-light-green-100.text-auto{background-color:#dcedc8!important}
.text-light-green-100{color:#dcedc8!important}
.border-light-green-100{border-color:#dcedc8!important}
.border-top-light-green-100{border-top-color:#dcedc8!important}
.border-right-light-green-100{border-right-color:#dcedc8!important}
.border-bottom-light-green-100{border-bottom-color:#dcedc8!important}
.border-left-light-green-100{border-left-color:#dcedc8!important}
.bg-light-green-200{background-color:#c5e1a5!important}
.bg-light-green-200.text-auto{background-color:#c5e1a5!important}
.text-light-green-200{color:#c5e1a5!important}
.border-light-green-200{border-color:#c5e1a5!important}
.border-top-light-green-200{border-top-color:#c5e1a5!important}
.border-right-light-green-200{border-right-color:#c5e1a5!important}
.border-bottom-light-green-200{border-bottom-color:#c5e1a5!important}
.border-left-light-green-200{border-left-color:#c5e1a5!important}
.bg-light-green-300{background-color:#aed581!important}
.bg-light-green-300.text-auto{background-color:#aed581!important}
.text-light-green-300{color:#aed581!important}
.border-light-green-300{border-color:#aed581!important}
.border-top-light-green-300{border-top-color:#aed581!important}
.border-right-light-green-300{border-right-color:#aed581!important}
.border-bottom-light-green-300{border-bottom-color:#aed581!important}
.border-left-light-green-300{border-left-color:#aed581!important}
.bg-light-green-400{background-color:#9ccc65!important}
.bg-light-green-400.text-auto{background-color:#9ccc65!important}
.text-light-green-400{color:#9ccc65!important}
.border-light-green-400{border-color:#9ccc65!important}
.border-top-light-green-400{border-top-color:#9ccc65!important}
.border-right-light-green-400{border-right-color:#9ccc65!important}
.border-bottom-light-green-400{border-bottom-color:#9ccc65!important}
.border-left-light-green-400{border-left-color:#9ccc65!important}
.bg-light-green-500{background-color:#8bc34a!important}
.bg-light-green-500.text-auto{background-color:#8bc34a!important}
.text-light-green-500{color:#8bc34a!important}
.border-light-green-500{border-color:#8bc34a!important}
.border-top-light-green-500{border-top-color:#8bc34a!important}
.border-right-light-green-500{border-right-color:#8bc34a!important}
.border-bottom-light-green-500{border-bottom-color:#8bc34a!important}
.border-left-light-green-500{border-left-color:#8bc34a!important}
.bg-light-green.text-auto{background-color:#8bc34a!important}
.bg-light-green{background-color:#8bc34a!important}
.text-light-green{color:#8bc34a!important}
.border-light-green{border-color:#8bc34a!important}
.border-top-light-green{border-top-color:#8bc34a!important}
.border-right-light-green{border-right-color:#8bc34a!important}
.border-bottom-light-green{border-bottom-color:#8bc34a!important}
.border-left-light-green{border-left-color:#8bc34a!important}
.bg-light-green-600{background-color:#7cb342!important}
.bg-light-green-600.text-auto{background-color:#7cb342!important}
.text-light-green-600{color:#7cb342!important}
.border-light-green-600{border-color:#7cb342!important}
.border-top-light-green-600{border-top-color:#7cb342!important}
.border-right-light-green-600{border-right-color:#7cb342!important}
.border-bottom-light-green-600{border-bottom-color:#7cb342!important}
.border-left-light-green-600{border-left-color:#7cb342!important}
.bg-light-green-700{background-color:#689f38!important}
.bg-light-green-700.text-auto{background-color:#689f38!important}
.text-light-green-700{color:#689f38!important}
.border-light-green-700{border-color:#689f38!important}
.border-top-light-green-700{border-top-color:#689f38!important}
.border-right-light-green-700{border-right-color:#689f38!important}
.border-bottom-light-green-700{border-bottom-color:#689f38!important}
.border-left-light-green-700{border-left-color:#689f38!important}
.bg-light-green-800{background-color:#558b2f!important}
.bg-light-green-800.text-auto{background-color:#558b2f!important}
.text-light-green-800{color:#558b2f!important}
.border-light-green-800{border-color:#558b2f!important}
.border-top-light-green-800{border-top-color:#558b2f!important}
.border-right-light-green-800{border-right-color:#558b2f!important}
.border-bottom-light-green-800{border-bottom-color:#558b2f!important}
.border-left-light-green-800{border-left-color:#558b2f!important}
.bg-light-green-900{background-color:#33691e!important}
.bg-light-green-900.text-auto{background-color:#33691e!important}
.text-light-green-900{color:#33691e!important}
.border-light-green-900{border-color:#33691e!important}
.border-top-light-green-900{border-top-color:#33691e!important}
.border-right-light-green-900{border-right-color:#33691e!important}
.border-bottom-light-green-900{border-bottom-color:#33691e!important}
.border-left-light-green-900{border-left-color:#33691e!important}
.bg-light-green-A100{background-color:#ccff90!important}
.bg-light-green-A100.text-auto{background-color:#ccff90!important}
.text-light-green-A100{color:#ccff90!important}
.border-light-green-A100{border-color:#ccff90!important}
.border-top-light-green-A100{border-top-color:#ccff90!important}
.border-right-light-green-A100{border-right-color:#ccff90!important}
.border-bottom-light-green-A100{border-bottom-color:#ccff90!important}
.border-left-light-green-A100{border-left-color:#ccff90!important}
.bg-light-green-A200{background-color:#b2ff59!important}
.bg-light-green-A200.text-auto{background-color:#b2ff59!important}
.text-light-green-A200{color:#b2ff59!important}
.border-light-green-A200{border-color:#b2ff59!important}
.border-top-light-green-A200{border-top-color:#b2ff59!important}
.border-right-light-green-A200{border-right-color:#b2ff59!important}
.border-bottom-light-green-A200{border-bottom-color:#b2ff59!important}
.border-left-light-green-A200{border-left-color:#b2ff59!important}
.bg-light-green-A400{background-color:#76ff03!important}
.bg-light-green-A400.text-auto{background-color:#76ff03!important}
.text-light-green-A400{color:#76ff03!important}
.border-light-green-A400{border-color:#76ff03!important}
.border-top-light-green-A400{border-top-color:#76ff03!important}
.border-right-light-green-A400{border-right-color:#76ff03!important}
.border-bottom-light-green-A400{border-bottom-color:#76ff03!important}
.border-left-light-green-A400{border-left-color:#76ff03!important}
.bg-light-green-A700{background-color:#64dd17!important}
.bg-light-green-A700.text-auto{background-color:#64dd17!important}
.text-light-green-A700{color:#64dd17!important}
.border-light-green-A700{border-color:#64dd17!important}
.border-top-light-green-A700{border-top-color:#64dd17!important}
.border-right-light-green-A700{border-right-color:#64dd17!important}
.border-bottom-light-green-A700{border-bottom-color:#64dd17!important}
.border-left-light-green-A700{border-left-color:#64dd17!important}
.bg-lime-50{background-color:#f9fbe7!important}
.bg-lime-50.text-auto{background-color:#f9fbe7!important}
.text-lime-50{color:#f9fbe7!important}
.border-lime-50{border-color:#f9fbe7!important}
.border-top-lime-50{border-top-color:#f9fbe7!important}
.border-right-lime-50{border-right-color:#f9fbe7!important}
.border-bottom-lime-50{border-bottom-color:#f9fbe7!important}
.border-left-lime-50{border-left-color:#f9fbe7!important}
.bg-lime-100{background-color:#f0f4c3!important}
.bg-lime-100.text-auto{background-color:#f0f4c3!important}
.text-lime-100{color:#f0f4c3!important}
.border-lime-100{border-color:#f0f4c3!important}
.border-top-lime-100{border-top-color:#f0f4c3!important}
.border-right-lime-100{border-right-color:#f0f4c3!important}
.border-bottom-lime-100{border-bottom-color:#f0f4c3!important}
.border-left-lime-100{border-left-color:#f0f4c3!important}
.bg-lime-200{background-color:#e6ee9c!important}
.bg-lime-200.text-auto{background-color:#e6ee9c!important}
.text-lime-200{color:#e6ee9c!important}
.border-lime-200{border-color:#e6ee9c!important}
.border-top-lime-200{border-top-color:#e6ee9c!important}
.border-right-lime-200{border-right-color:#e6ee9c!important}
.border-bottom-lime-200{border-bottom-color:#e6ee9c!important}
.border-left-lime-200{border-left-color:#e6ee9c!important}
.bg-lime-300{background-color:#dce775!important}
.bg-lime-300.text-auto{background-color:#dce775!important}
.text-lime-300{color:#dce775!important}
.border-lime-300{border-color:#dce775!important}
.border-top-lime-300{border-top-color:#dce775!important}
.border-right-lime-300{border-right-color:#dce775!important}
.border-bottom-lime-300{border-bottom-color:#dce775!important}
.border-left-lime-300{border-left-color:#dce775!important}
.bg-lime-400{background-color:#d4e157!important}
.bg-lime-400.text-auto{background-color:#d4e157!important}
.text-lime-400{color:#d4e157!important}
.border-lime-400{border-color:#d4e157!important}
.border-top-lime-400{border-top-color:#d4e157!important}
.border-right-lime-400{border-right-color:#d4e157!important}
.border-bottom-lime-400{border-bottom-color:#d4e157!important}
.border-left-lime-400{border-left-color:#d4e157!important}
.bg-lime-500{background-color:#cddc39!important}
.bg-lime-500.text-auto{background-color:#cddc39!important}
.text-lime-500{color:#cddc39!important}
.border-lime-500{border-color:#cddc39!important}
.border-top-lime-500{border-top-color:#cddc39!important}
.border-right-lime-500{border-right-color:#cddc39!important}
.border-bottom-lime-500{border-bottom-color:#cddc39!important}
.border-left-lime-500{border-left-color:#cddc39!important}
.bg-lime.text-auto{background-color:#cddc39!important}
.bg-lime{background-color:#cddc39!important}
.text-lime{color:#cddc39!important}
.border-lime{border-color:#cddc39!important}
.border-top-lime{border-top-color:#cddc39!important}
.border-right-lime{border-right-color:#cddc39!important}
.border-bottom-lime{border-bottom-color:#cddc39!important}
.border-left-lime{border-left-color:#cddc39!important}
.bg-lime-600{background-color:#c0ca33!important}
.bg-lime-600.text-auto{background-color:#c0ca33!important}
.text-lime-600{color:#c0ca33!important}
.border-lime-600{border-color:#c0ca33!important}
.border-top-lime-600{border-top-color:#c0ca33!important}
.border-right-lime-600{border-right-color:#c0ca33!important}
.border-bottom-lime-600{border-bottom-color:#c0ca33!important}
.border-left-lime-600{border-left-color:#c0ca33!important}
.bg-lime-700{background-color:#afb42b!important}
.bg-lime-700.text-auto{background-color:#afb42b!important}
.text-lime-700{color:#afb42b!important}
.border-lime-700{border-color:#afb42b!important}
.border-top-lime-700{border-top-color:#afb42b!important}
.border-right-lime-700{border-right-color:#afb42b!important}
.border-bottom-lime-700{border-bottom-color:#afb42b!important}
.border-left-lime-700{border-left-color:#afb42b!important}
.bg-lime-800{background-color:#9e9d24!important}
.bg-lime-800.text-auto{background-color:#9e9d24!important}
.text-lime-800{color:#9e9d24!important}
.border-lime-800{border-color:#9e9d24!important}
.border-top-lime-800{border-top-color:#9e9d24!important}
.border-right-lime-800{border-right-color:#9e9d24!important}
.border-bottom-lime-800{border-bottom-color:#9e9d24!important}
.border-left-lime-800{border-left-color:#9e9d24!important}
.bg-lime-900{background-color:#827717!important}
.bg-lime-900.text-auto{background-color:#827717!important}
.text-lime-900{color:#827717!important}
.border-lime-900{border-color:#827717!important}
.border-top-lime-900{border-top-color:#827717!important}
.border-right-lime-900{border-right-color:#827717!important}
.border-bottom-lime-900{border-bottom-color:#827717!important}
.border-left-lime-900{border-left-color:#827717!important}
.bg-lime-A100{background-color:#f4ff81!important}
.bg-lime-A100.text-auto{background-color:#f4ff81!important}
.text-lime-A100{color:#f4ff81!important}
.border-lime-A100{border-color:#f4ff81!important}
.border-top-lime-A100{border-top-color:#f4ff81!important}
.border-right-lime-A100{border-right-color:#f4ff81!important}
.border-bottom-lime-A100{border-bottom-color:#f4ff81!important}
.border-left-lime-A100{border-left-color:#f4ff81!important}
.bg-lime-A200{background-color:#eeff41!important}
.bg-lime-A200.text-auto{background-color:#eeff41!important}
.text-lime-A200{color:#eeff41!important}
.border-lime-A200{border-color:#eeff41!important}
.border-top-lime-A200{border-top-color:#eeff41!important}
.border-right-lime-A200{border-right-color:#eeff41!important}
.border-bottom-lime-A200{border-bottom-color:#eeff41!important}
.border-left-lime-A200{border-left-color:#eeff41!important}
.bg-lime-A400{background-color:#c6ff00!important}
.bg-lime-A400.text-auto{background-color:#c6ff00!important}
.text-lime-A400{color:#c6ff00!important}
.border-lime-A400{border-color:#c6ff00!important}
.border-top-lime-A400{border-top-color:#c6ff00!important}
.border-right-lime-A400{border-right-color:#c6ff00!important}
.border-bottom-lime-A400{border-bottom-color:#c6ff00!important}
.border-left-lime-A400{border-left-color:#c6ff00!important}
.bg-lime-A700{background-color:#aeea00!important}
.bg-lime-A700.text-auto{background-color:#aeea00!important}
.text-lime-A700{color:#aeea00!important}
.border-lime-A700{border-color:#aeea00!important}
.border-top-lime-A700{border-top-color:#aeea00!important}
.border-right-lime-A700{border-right-color:#aeea00!important}
.border-bottom-lime-A700{border-bottom-color:#aeea00!important}
.border-left-lime-A700{border-left-color:#aeea00!important}
.bg-yellow-50{background-color:#fffde7!important}
.bg-yellow-50.text-auto{background-color:#fffde7!important}
.text-yellow-50{color:#fffde7!important}
.border-yellow-50{border-color:#fffde7!important}
.border-top-yellow-50{border-top-color:#fffde7!important}
.border-right-yellow-50{border-right-color:#fffde7!important}
.border-bottom-yellow-50{border-bottom-color:#fffde7!important}
.border-left-yellow-50{border-left-color:#fffde7!important}
.bg-yellow-100{background-color:#fff9c4!important}
.bg-yellow-100.text-auto{background-color:#fff9c4!important}
.text-yellow-100{color:#fff9c4!important}
.border-yellow-100{border-color:#fff9c4!important}
.border-top-yellow-100{border-top-color:#fff9c4!important}
.border-right-yellow-100{border-right-color:#fff9c4!important}
.border-bottom-yellow-100{border-bottom-color:#fff9c4!important}
.border-left-yellow-100{border-left-color:#fff9c4!important}
.bg-yellow-200{background-color:#fff59d!important}
.bg-yellow-200.text-auto{background-color:#fff59d!important}
.text-yellow-200{color:#fff59d!important}
.border-yellow-200{border-color:#fff59d!important}
.border-top-yellow-200{border-top-color:#fff59d!important}
.border-right-yellow-200{border-right-color:#fff59d!important}
.border-bottom-yellow-200{border-bottom-color:#fff59d!important}
.border-left-yellow-200{border-left-color:#fff59d!important}
.bg-yellow-300{background-color:#fff176!important}
.bg-yellow-300.text-auto{background-color:#fff176!important}
.text-yellow-300{color:#fff176!important}
.border-yellow-300{border-color:#fff176!important}
.border-top-yellow-300{border-top-color:#fff176!important}
.border-right-yellow-300{border-right-color:#fff176!important}
.border-bottom-yellow-300{border-bottom-color:#fff176!important}
.border-left-yellow-300{border-left-color:#fff176!important}
.bg-yellow-400{background-color:#ffee58!important}
.bg-yellow-400.text-auto{background-color:#ffee58!important}
.text-yellow-400{color:#ffee58!important}
.border-yellow-400{border-color:#ffee58!important}
.border-top-yellow-400{border-top-color:#ffee58!important}
.border-right-yellow-400{border-right-color:#ffee58!important}
.border-bottom-yellow-400{border-bottom-color:#ffee58!important}
.border-left-yellow-400{border-left-color:#ffee58!important}
.bg-yellow-500{background-color:#ffeb3b!important}
.bg-yellow-500.text-auto{background-color:#ffeb3b!important}
.text-yellow-500{color:#ffeb3b!important}
.border-yellow-500{border-color:#ffeb3b!important}
.border-top-yellow-500{border-top-color:#ffeb3b!important}
.border-right-yellow-500{border-right-color:#ffeb3b!important}
.border-bottom-yellow-500{border-bottom-color:#ffeb3b!important}
.border-left-yellow-500{border-left-color:#ffeb3b!important}
.bg-yellow.text-auto{background-color:#ffeb3b!important}
.bg-yellow{background-color:#ffeb3b!important}
.text-yellow{color:#ffeb3b!important}
.border-yellow{border-color:#ffeb3b!important}
.border-top-yellow{border-top-color:#ffeb3b!important}
.border-right-yellow{border-right-color:#ffeb3b!important}
.border-bottom-yellow{border-bottom-color:#ffeb3b!important}
.border-left-yellow{border-left-color:#ffeb3b!important}
.bg-yellow-600{background-color:#fdd835!important}
.bg-yellow-600.text-auto{background-color:#fdd835!important}
.text-yellow-600{color:#fdd835!important}
.border-yellow-600{border-color:#fdd835!important}
.border-top-yellow-600{border-top-color:#fdd835!important}
.border-right-yellow-600{border-right-color:#fdd835!important}
.border-bottom-yellow-600{border-bottom-color:#fdd835!important}
.border-left-yellow-600{border-left-color:#fdd835!important}
.bg-yellow-700{background-color:#fbc02d!important}
.bg-yellow-700.text-auto{background-color:#fbc02d!important}
.text-yellow-700{color:#fbc02d!important}
.border-yellow-700{border-color:#fbc02d!important}
.border-top-yellow-700{border-top-color:#fbc02d!important}
.border-right-yellow-700{border-right-color:#fbc02d!important}
.border-bottom-yellow-700{border-bottom-color:#fbc02d!important}
.border-left-yellow-700{border-left-color:#fbc02d!important}
.bg-yellow-800{background-color:#f9a825!important}
.bg-yellow-800.text-auto{background-color:#f9a825!important}
.text-yellow-800{color:#f9a825!important}
.border-yellow-800{border-color:#f9a825!important}
.border-top-yellow-800{border-top-color:#f9a825!important}
.border-right-yellow-800{border-right-color:#f9a825!important}
.border-bottom-yellow-800{border-bottom-color:#f9a825!important}
.border-left-yellow-800{border-left-color:#f9a825!important}
.bg-yellow-900{background-color:#f57f17!important}
.bg-yellow-900.text-auto{background-color:#f57f17!important}
.text-yellow-900{color:#f57f17!important}
.border-yellow-900{border-color:#f57f17!important}
.border-top-yellow-900{border-top-color:#f57f17!important}
.border-right-yellow-900{border-right-color:#f57f17!important}
.border-bottom-yellow-900{border-bottom-color:#f57f17!important}
.border-left-yellow-900{border-left-color:#f57f17!important}
.bg-yellow-A100{background-color:#ffff8d!important}
.bg-yellow-A100.text-auto{background-color:#ffff8d!important}
.text-yellow-A100{color:#ffff8d!important}
.border-yellow-A100{border-color:#ffff8d!important}
.border-top-yellow-A100{border-top-color:#ffff8d!important}
.border-right-yellow-A100{border-right-color:#ffff8d!important}
.border-bottom-yellow-A100{border-bottom-color:#ffff8d!important}
.border-left-yellow-A100{border-left-color:#ffff8d!important}
.bg-yellow-A200{background-color:#ff0!important}
.bg-yellow-A200.text-auto{background-color:#ff0!important}
.text-yellow-A200{color:#ff0!important}
.border-yellow-A200{border-color:#ff0!important}
.border-top-yellow-A200{border-top-color:#ff0!important}
.border-right-yellow-A200{border-right-color:#ff0!important}
.border-bottom-yellow-A200{border-bottom-color:#ff0!important}
.border-left-yellow-A200{border-left-color:#ff0!important}
.bg-yellow-A400{background-color:#ffea00!important}
.bg-yellow-A400.text-auto{background-color:#ffea00!important}
.text-yellow-A400{color:#ffea00!important}
.border-yellow-A400{border-color:#ffea00!important}
.border-top-yellow-A400{border-top-color:#ffea00!important}
.border-right-yellow-A400{border-right-color:#ffea00!important}
.border-bottom-yellow-A400{border-bottom-color:#ffea00!important}
.border-left-yellow-A400{border-left-color:#ffea00!important}
.bg-yellow-A700{background-color:#ffd600!important}
.bg-yellow-A700.text-auto{background-color:#ffd600!important}
.text-yellow-A700{color:#ffd600!important}
.border-yellow-A700{border-color:#ffd600!important}
.border-top-yellow-A700{border-top-color:#ffd600!important}
.border-right-yellow-A700{border-right-color:#ffd600!important}
.border-bottom-yellow-A700{border-bottom-color:#ffd600!important}
.border-left-yellow-A700{border-left-color:#ffd600!important}
.bg-amber-50{background-color:#fff8e1!important}
.bg-amber-50.text-auto{background-color:#fff8e1!important}
.text-amber-50{color:#fff8e1!important}
.border-amber-50{border-color:#fff8e1!important}
.border-top-amber-50{border-top-color:#fff8e1!important}
.border-right-amber-50{border-right-color:#fff8e1!important}
.border-bottom-amber-50{border-bottom-color:#fff8e1!important}
.border-left-amber-50{border-left-color:#fff8e1!important}
.bg-amber-100{background-color:#ffecb3!important}
.bg-amber-100.text-auto{background-color:#ffecb3!important}
.text-amber-100{color:#ffecb3!important}
.border-amber-100{border-color:#ffecb3!important}
.border-top-amber-100{border-top-color:#ffecb3!important}
.border-right-amber-100{border-right-color:#ffecb3!important}
.border-bottom-amber-100{border-bottom-color:#ffecb3!important}
.border-left-amber-100{border-left-color:#ffecb3!important}
.bg-amber-200{background-color:#ffe082!important}
.bg-amber-200.text-auto{background-color:#ffe082!important}
.text-amber-200{color:#ffe082!important}
.border-amber-200{border-color:#ffe082!important}
.border-top-amber-200{border-top-color:#ffe082!important}
.border-right-amber-200{border-right-color:#ffe082!important}
.border-bottom-amber-200{border-bottom-color:#ffe082!important}
.border-left-amber-200{border-left-color:#ffe082!important}
.bg-amber-300{background-color:#ffd54f!important}
.bg-amber-300.text-auto{background-color:#ffd54f!important}
.text-amber-300{color:#ffd54f!important}
.border-amber-300{border-color:#ffd54f!important}
.border-top-amber-300{border-top-color:#ffd54f!important}
.border-right-amber-300{border-right-color:#ffd54f!important}
.border-bottom-amber-300{border-bottom-color:#ffd54f!important}
.border-left-amber-300{border-left-color:#ffd54f!important}
.bg-amber-400{background-color:#ffca28!important}
.bg-amber-400.text-auto{background-color:#ffca28!important}
.text-amber-400{color:#ffca28!important}
.border-amber-400{border-color:#ffca28!important}
.border-top-amber-400{border-top-color:#ffca28!important}
.border-right-amber-400{border-right-color:#ffca28!important}
.border-bottom-amber-400{border-bottom-color:#ffca28!important}
.border-left-amber-400{border-left-color:#ffca28!important}
.bg-amber-500{background-color:#ffc107!important}
.bg-amber-500.text-auto{background-color:#ffc107!important}
.text-amber-500{color:#ffc107!important}
.border-amber-500{border-color:#ffc107!important}
.border-top-amber-500{border-top-color:#ffc107!important}
.border-right-amber-500{border-right-color:#ffc107!important}
.border-bottom-amber-500{border-bottom-color:#ffc107!important}
.border-left-amber-500{border-left-color:#ffc107!important}
.bg-amber.text-auto{background-color:#ffc107!important}
.bg-amber{background-color:#ffc107!important}
.text-amber{color:#ffc107!important}
.border-amber{border-color:#ffc107!important}
.border-top-amber{border-top-color:#ffc107!important}
.border-right-amber{border-right-color:#ffc107!important}
.border-bottom-amber{border-bottom-color:#ffc107!important}
.border-left-amber{border-left-color:#ffc107!important}
.bg-amber-600{background-color:#ffb300!important}
.bg-amber-600.text-auto{background-color:#ffb300!important}
.text-amber-600{color:#ffb300!important}
.border-amber-600{border-color:#ffb300!important}
.border-top-amber-600{border-top-color:#ffb300!important}
.border-right-amber-600{border-right-color:#ffb300!important}
.border-bottom-amber-600{border-bottom-color:#ffb300!important}
.border-left-amber-600{border-left-color:#ffb300!important}
.bg-amber-700{background-color:#ffa000!important}
.bg-amber-700.text-auto{background-color:#ffa000!important}
.text-amber-700{color:#ffa000!important}
.border-amber-700{border-color:#ffa000!important}
.border-top-amber-700{border-top-color:#ffa000!important}
.border-right-amber-700{border-right-color:#ffa000!important}
.border-bottom-amber-700{border-bottom-color:#ffa000!important}
.border-left-amber-700{border-left-color:#ffa000!important}
.bg-amber-800{background-color:#ff8f00!important}
.bg-amber-800.text-auto{background-color:#ff8f00!important}
.text-amber-800{color:#ff8f00!important}
.border-amber-800{border-color:#ff8f00!important}
.border-top-amber-800{border-top-color:#ff8f00!important}
.border-right-amber-800{border-right-color:#ff8f00!important}
.border-bottom-amber-800{border-bottom-color:#ff8f00!important}
.border-left-amber-800{border-left-color:#ff8f00!important}
.bg-amber-900{background-color:#ff6f00!important}
.bg-amber-900.text-auto{background-color:#ff6f00!important}
.text-amber-900{color:#ff6f00!important}
.border-amber-900{border-color:#ff6f00!important}
.border-top-amber-900{border-top-color:#ff6f00!important}
.border-right-amber-900{border-right-color:#ff6f00!important}
.border-bottom-amber-900{border-bottom-color:#ff6f00!important}
.border-left-amber-900{border-left-color:#ff6f00!important}
.bg-amber-A100{background-color:#ffe57f!important}
.bg-amber-A100.text-auto{background-color:#ffe57f!important}
.text-amber-A100{color:#ffe57f!important}
.border-amber-A100{border-color:#ffe57f!important}
.border-top-amber-A100{border-top-color:#ffe57f!important}
.border-right-amber-A100{border-right-color:#ffe57f!important}
.border-bottom-amber-A100{border-bottom-color:#ffe57f!important}
.border-left-amber-A100{border-left-color:#ffe57f!important}
.bg-amber-A200{background-color:#ffd740!important}
.bg-amber-A200.text-auto{background-color:#ffd740!important}
.text-amber-A200{color:#ffd740!important}
.border-amber-A200{border-color:#ffd740!important}
.border-top-amber-A200{border-top-color:#ffd740!important}
.border-right-amber-A200{border-right-color:#ffd740!important}
.border-bottom-amber-A200{border-bottom-color:#ffd740!important}
.border-left-amber-A200{border-left-color:#ffd740!important}
.bg-amber-A400{background-color:#ffc400!important}
.bg-amber-A400.text-auto{background-color:#ffc400!important}
.text-amber-A400{color:#ffc400!important}
.border-amber-A400{border-color:#ffc400!important}
.border-top-amber-A400{border-top-color:#ffc400!important}
.border-right-amber-A400{border-right-color:#ffc400!important}
.border-bottom-amber-A400{border-bottom-color:#ffc400!important}
.border-left-amber-A400{border-left-color:#ffc400!important}
.bg-amber-A700{background-color:#ffab00!important}
.bg-amber-A700.text-auto{background-color:#ffab00!important}
.text-amber-A700{color:#ffab00!important}
.border-amber-A700{border-color:#ffab00!important}
.border-top-amber-A700{border-top-color:#ffab00!important}
.border-right-amber-A700{border-right-color:#ffab00!important}
.border-bottom-amber-A700{border-bottom-color:#ffab00!important}
.border-left-amber-A700{border-left-color:#ffab00!important}
.bg-orange-50{background-color:#fff3e0!important}
.bg-orange-50.text-auto{background-color:#fff3e0!important}
.text-orange-50{color:#fff3e0!important}
.border-orange-50{border-color:#fff3e0!important}
.border-top-orange-50{border-top-color:#fff3e0!important}
.border-right-orange-50{border-right-color:#fff3e0!important}
.border-bottom-orange-50{border-bottom-color:#fff3e0!important}
.border-left-orange-50{border-left-color:#fff3e0!important}
.bg-orange-100{background-color:#ffe0b2!important}
.bg-orange-100.text-auto{background-color:#ffe0b2!important}
.text-orange-100{color:#ffe0b2!important}
.border-orange-100{border-color:#ffe0b2!important}
.border-top-orange-100{border-top-color:#ffe0b2!important}
.border-right-orange-100{border-right-color:#ffe0b2!important}
.border-bottom-orange-100{border-bottom-color:#ffe0b2!important}
.border-left-orange-100{border-left-color:#ffe0b2!important}
.bg-orange-200{background-color:#ffcc80!important}
.bg-orange-200.text-auto{background-color:#ffcc80!important}
.text-orange-200{color:#ffcc80!important}
.border-orange-200{border-color:#ffcc80!important}
.border-top-orange-200{border-top-color:#ffcc80!important}
.border-right-orange-200{border-right-color:#ffcc80!important}
.border-bottom-orange-200{border-bottom-color:#ffcc80!important}
.border-left-orange-200{border-left-color:#ffcc80!important}
.bg-orange-300{background-color:#ffb74d!important}
.bg-orange-300.text-auto{background-color:#ffb74d!important}
.text-orange-300{color:#ffb74d!important}
.border-orange-300{border-color:#ffb74d!important}
.border-top-orange-300{border-top-color:#ffb74d!important}
.border-right-orange-300{border-right-color:#ffb74d!important}
.border-bottom-orange-300{border-bottom-color:#ffb74d!important}
.border-left-orange-300{border-left-color:#ffb74d!important}
.bg-orange-400{background-color:#ffa726!important}
.bg-orange-400.text-auto{background-color:#ffa726!important}
.text-orange-400{color:#ffa726!important}
.border-orange-400{border-color:#ffa726!important}
.border-top-orange-400{border-top-color:#ffa726!important}
.border-right-orange-400{border-right-color:#ffa726!important}
.border-bottom-orange-400{border-bottom-color:#ffa726!important}
.border-left-orange-400{border-left-color:#ffa726!important}
.bg-orange-500{background-color:#ff9800!important}
.bg-orange-500.text-auto{background-color:#ff9800!important}
.text-orange-500{color:#ff9800!important}
.border-orange-500{border-color:#ff9800!important}
.border-top-orange-500{border-top-color:#ff9800!important}
.border-right-orange-500{border-right-color:#ff9800!important}
.border-bottom-orange-500{border-bottom-color:#ff9800!important}
.border-left-orange-500{border-left-color:#ff9800!important}
.bg-orange.text-auto{background-color:#ff9800!important}
.bg-orange{background-color:#ff9800!important}
.text-orange{color:#ff9800!important}
.border-orange{border-color:#ff9800!important}
.border-top-orange{border-top-color:#ff9800!important}
.border-right-orange{border-right-color:#ff9800!important}
.border-bottom-orange{border-bottom-color:#ff9800!important}
.border-left-orange{border-left-color:#ff9800!important}
.bg-orange-600{background-color:#fb8c00!important}
.bg-orange-600.text-auto{background-color:#fb8c00!important}
.text-orange-600{color:#fb8c00!important}
.border-orange-600{border-color:#fb8c00!important}
.border-top-orange-600{border-top-color:#fb8c00!important}
.border-right-orange-600{border-right-color:#fb8c00!important}
.border-bottom-orange-600{border-bottom-color:#fb8c00!important}
.border-left-orange-600{border-left-color:#fb8c00!important}
.bg-orange-700{background-color:#f57c00!important}
.bg-orange-700.text-auto{background-color:#f57c00!important}
.text-orange-700{color:#f57c00!important}
.border-orange-700{border-color:#f57c00!important}
.border-top-orange-700{border-top-color:#f57c00!important}
.border-right-orange-700{border-right-color:#f57c00!important}
.border-bottom-orange-700{border-bottom-color:#f57c00!important}
.border-left-orange-700{border-left-color:#f57c00!important}
.bg-orange-800{background-color:#ef6c00!important}
.bg-orange-800.text-auto{background-color:#ef6c00!important}
.text-orange-800{color:#ef6c00!important}
.border-orange-800{border-color:#ef6c00!important}
.border-top-orange-800{border-top-color:#ef6c00!important}
.border-right-orange-800{border-right-color:#ef6c00!important}
.border-bottom-orange-800{border-bottom-color:#ef6c00!important}
.border-left-orange-800{border-left-color:#ef6c00!important}
.bg-orange-900{background-color:#e65100!important}
.bg-orange-900.text-auto{background-color:#e65100!important}
.text-orange-900{color:#e65100!important}
.border-orange-900{border-color:#e65100!important}
.border-top-orange-900{border-top-color:#e65100!important}
.border-right-orange-900{border-right-color:#e65100!important}
.border-bottom-orange-900{border-bottom-color:#e65100!important}
.border-left-orange-900{border-left-color:#e65100!important}
.bg-orange-A100{background-color:#ffd180!important}
.bg-orange-A100.text-auto{background-color:#ffd180!important}
.text-orange-A100{color:#ffd180!important}
.border-orange-A100{border-color:#ffd180!important}
.border-top-orange-A100{border-top-color:#ffd180!important}
.border-right-orange-A100{border-right-color:#ffd180!important}
.border-bottom-orange-A100{border-bottom-color:#ffd180!important}
.border-left-orange-A100{border-left-color:#ffd180!important}
.bg-orange-A200{background-color:#ffab40!important}
.bg-orange-A200.text-auto{background-color:#ffab40!important}
.text-orange-A200{color:#ffab40!important}
.border-orange-A200{border-color:#ffab40!important}
.border-top-orange-A200{border-top-color:#ffab40!important}
.border-right-orange-A200{border-right-color:#ffab40!important}
.border-bottom-orange-A200{border-bottom-color:#ffab40!important}
.border-left-orange-A200{border-left-color:#ffab40!important}
.bg-orange-A400{background-color:#ff9100!important}
.bg-orange-A400.text-auto{background-color:#ff9100!important}
.text-orange-A400{color:#ff9100!important}
.border-orange-A400{border-color:#ff9100!important}
.border-top-orange-A400{border-top-color:#ff9100!important}
.border-right-orange-A400{border-right-color:#ff9100!important}
.border-bottom-orange-A400{border-bottom-color:#ff9100!important}
.border-left-orange-A400{border-left-color:#ff9100!important}
.bg-orange-A700{background-color:#ff6d00!important}
.bg-orange-A700.text-auto{background-color:#ff6d00!important}
.text-orange-A700{color:#ff6d00!important}
.border-orange-A700{border-color:#ff6d00!important}
.border-top-orange-A700{border-top-color:#ff6d00!important}
.border-right-orange-A700{border-right-color:#ff6d00!important}
.border-bottom-orange-A700{border-bottom-color:#ff6d00!important}
.border-left-orange-A700{border-left-color:#ff6d00!important}
.bg-deep-orange-50{background-color:#fbe9e7!important}
.bg-deep-orange-50.text-auto{background-color:#fbe9e7!important}
.text-deep-orange-50{color:#fbe9e7!important}
.border-deep-orange-50{border-color:#fbe9e7!important}
.border-top-deep-orange-50{border-top-color:#fbe9e7!important}
.border-right-deep-orange-50{border-right-color:#fbe9e7!important}
.border-bottom-deep-orange-50{border-bottom-color:#fbe9e7!important}
.border-left-deep-orange-50{border-left-color:#fbe9e7!important}
.bg-deep-orange-100{background-color:#ffccbc!important}
.bg-deep-orange-100.text-auto{background-color:#ffccbc!important}
.text-deep-orange-100{color:#ffccbc!important}
.border-deep-orange-100{border-color:#ffccbc!important}
.border-top-deep-orange-100{border-top-color:#ffccbc!important}
.border-right-deep-orange-100{border-right-color:#ffccbc!important}
.border-bottom-deep-orange-100{border-bottom-color:#ffccbc!important}
.border-left-deep-orange-100{border-left-color:#ffccbc!important}
.bg-deep-orange-200{background-color:#ffab91!important}
.bg-deep-orange-200.text-auto{background-color:#ffab91!important}
.text-deep-orange-200{color:#ffab91!important}
.border-deep-orange-200{border-color:#ffab91!important}
.border-top-deep-orange-200{border-top-color:#ffab91!important}
.border-right-deep-orange-200{border-right-color:#ffab91!important}
.border-bottom-deep-orange-200{border-bottom-color:#ffab91!important}
.border-left-deep-orange-200{border-left-color:#ffab91!important}
.bg-deep-orange-300{background-color:#ff8a65!important}
.bg-deep-orange-300.text-auto{background-color:#ff8a65!important}
.text-deep-orange-300{color:#ff8a65!important}
.border-deep-orange-300{border-color:#ff8a65!important}
.border-top-deep-orange-300{border-top-color:#ff8a65!important}
.border-right-deep-orange-300{border-right-color:#ff8a65!important}
.border-bottom-deep-orange-300{border-bottom-color:#ff8a65!important}
.border-left-deep-orange-300{border-left-color:#ff8a65!important}
.bg-deep-orange-400{background-color:#ff7043!important}
.bg-deep-orange-400.text-auto{background-color:#ff7043!important}
.text-deep-orange-400{color:#ff7043!important}
.border-deep-orange-400{border-color:#ff7043!important}
.border-top-deep-orange-400{border-top-color:#ff7043!important}
.border-right-deep-orange-400{border-right-color:#ff7043!important}
.border-bottom-deep-orange-400{border-bottom-color:#ff7043!important}
.border-left-deep-orange-400{border-left-color:#ff7043!important}
.bg-deep-orange-500{background-color:#ff5722!important}
.bg-deep-orange-500.text-auto{background-color:#ff5722!important}
.text-deep-orange-500{color:#ff5722!important}
.border-deep-orange-500{border-color:#ff5722!important}
.border-top-deep-orange-500{border-top-color:#ff5722!important}
.border-right-deep-orange-500{border-right-color:#ff5722!important}
.border-bottom-deep-orange-500{border-bottom-color:#ff5722!important}
.border-left-deep-orange-500{border-left-color:#ff5722!important}
.bg-deep-orange.text-auto{background-color:#ff5722!important}
.bg-deep-orange{background-color:#ff5722!important}
.text-deep-orange{color:#ff5722!important}
.border-deep-orange{border-color:#ff5722!important}
.border-top-deep-orange{border-top-color:#ff5722!important}
.border-right-deep-orange{border-right-color:#ff5722!important}
.border-bottom-deep-orange{border-bottom-color:#ff5722!important}
.border-left-deep-orange{border-left-color:#ff5722!important}
.bg-deep-orange-600{background-color:#f4511e!important}
.bg-deep-orange-600.text-auto{background-color:#f4511e!important}
.text-deep-orange-600{color:#f4511e!important}
.border-deep-orange-600{border-color:#f4511e!important}
.border-top-deep-orange-600{border-top-color:#f4511e!important}
.border-right-deep-orange-600{border-right-color:#f4511e!important}
.border-bottom-deep-orange-600{border-bottom-color:#f4511e!important}
.border-left-deep-orange-600{border-left-color:#f4511e!important}
.bg-deep-orange-700{background-color:#e64a19!important}
.bg-deep-orange-700.text-auto{background-color:#e64a19!important}
.text-deep-orange-700{color:#e64a19!important}
.border-deep-orange-700{border-color:#e64a19!important}
.border-top-deep-orange-700{border-top-color:#e64a19!important}
.border-right-deep-orange-700{border-right-color:#e64a19!important}
.border-bottom-deep-orange-700{border-bottom-color:#e64a19!important}
.border-left-deep-orange-700{border-left-color:#e64a19!important}
.bg-deep-orange-800{background-color:#d84315!important}
.bg-deep-orange-800.text-auto{background-color:#d84315!important}
.text-deep-orange-800{color:#d84315!important}
.border-deep-orange-800{border-color:#d84315!important}
.border-top-deep-orange-800{border-top-color:#d84315!important}
.border-right-deep-orange-800{border-right-color:#d84315!important}
.border-bottom-deep-orange-800{border-bottom-color:#d84315!important}
.border-left-deep-orange-800{border-left-color:#d84315!important}
.bg-deep-orange-900{background-color:#bf360c!important}
.bg-deep-orange-900.text-auto{background-color:#bf360c!important}
.text-deep-orange-900{color:#bf360c!important}
.border-deep-orange-900{border-color:#bf360c!important}
.border-top-deep-orange-900{border-top-color:#bf360c!important}
.border-right-deep-orange-900{border-right-color:#bf360c!important}
.border-bottom-deep-orange-900{border-bottom-color:#bf360c!important}
.border-left-deep-orange-900{border-left-color:#bf360c!important}
.bg-deep-orange-A100{background-color:#ff9e80!important}
.bg-deep-orange-A100.text-auto{background-color:#ff9e80!important}
.text-deep-orange-A100{color:#ff9e80!important}
.border-deep-orange-A100{border-color:#ff9e80!important}
.border-top-deep-orange-A100{border-top-color:#ff9e80!important}
.border-right-deep-orange-A100{border-right-color:#ff9e80!important}
.border-bottom-deep-orange-A100{border-bottom-color:#ff9e80!important}
.border-left-deep-orange-A100{border-left-color:#ff9e80!important}
.bg-deep-orange-A200{background-color:#ff6e40!important}
.bg-deep-orange-A200.text-auto{background-color:#ff6e40!important}
.text-deep-orange-A200{color:#ff6e40!important}
.border-deep-orange-A200{border-color:#ff6e40!important}
.border-top-deep-orange-A200{border-top-color:#ff6e40!important}
.border-right-deep-orange-A200{border-right-color:#ff6e40!important}
.border-bottom-deep-orange-A200{border-bottom-color:#ff6e40!important}
.border-left-deep-orange-A200{border-left-color:#ff6e40!important}
.bg-deep-orange-A400{background-color:#ff3d00!important}
.bg-deep-orange-A400.text-auto{background-color:#ff3d00!important}
.text-deep-orange-A400{color:#ff3d00!important}
.border-deep-orange-A400{border-color:#ff3d00!important}
.border-top-deep-orange-A400{border-top-color:#ff3d00!important}
.border-right-deep-orange-A400{border-right-color:#ff3d00!important}
.border-bottom-deep-orange-A400{border-bottom-color:#ff3d00!important}
.border-left-deep-orange-A400{border-left-color:#ff3d00!important}
.bg-deep-orange-A700{background-color:#dd2c00!important}
.bg-deep-orange-A700.text-auto{background-color:#dd2c00!important}
.text-deep-orange-A700{color:#dd2c00!important}
.border-deep-orange-A700{border-color:#dd2c00!important}
.border-top-deep-orange-A700{border-top-color:#dd2c00!important}
.border-right-deep-orange-A700{border-right-color:#dd2c00!important}
.border-bottom-deep-orange-A700{border-bottom-color:#dd2c00!important}
.border-left-deep-orange-A700{border-left-color:#dd2c00!important}
.bg-brown-50{background-color:#efebe9!important}
.bg-brown-50.text-auto{background-color:#efebe9!important}
.text-brown-50{color:#efebe9!important}
.border-brown-50{border-color:#efebe9!important}
.border-top-brown-50{border-top-color:#efebe9!important}
.border-right-brown-50{border-right-color:#efebe9!important}
.border-bottom-brown-50{border-bottom-color:#efebe9!important}
.border-left-brown-50{border-left-color:#efebe9!important}
.bg-brown-100{background-color:#d7ccc8!important}
.bg-brown-100.text-auto{background-color:#d7ccc8!important}
.text-brown-100{color:#d7ccc8!important}
.border-brown-100{border-color:#d7ccc8!important}
.border-top-brown-100{border-top-color:#d7ccc8!important}
.border-right-brown-100{border-right-color:#d7ccc8!important}
.border-bottom-brown-100{border-bottom-color:#d7ccc8!important}
.border-left-brown-100{border-left-color:#d7ccc8!important}
.bg-brown-200{background-color:#bcaaa4!important}
.bg-brown-200.text-auto{background-color:#bcaaa4!important}
.text-brown-200{color:#bcaaa4!important}
.border-brown-200{border-color:#bcaaa4!important}
.border-top-brown-200{border-top-color:#bcaaa4!important}
.border-right-brown-200{border-right-color:#bcaaa4!important}
.border-bottom-brown-200{border-bottom-color:#bcaaa4!important}
.border-left-brown-200{border-left-color:#bcaaa4!important}
.bg-brown-300{background-color:#a1887f!important}
.bg-brown-300.text-auto{background-color:#a1887f!important}
.text-brown-300{color:#a1887f!important}
.border-brown-300{border-color:#a1887f!important}
.border-top-brown-300{border-top-color:#a1887f!important}
.border-right-brown-300{border-right-color:#a1887f!important}
.border-bottom-brown-300{border-bottom-color:#a1887f!important}
.border-left-brown-300{border-left-color:#a1887f!important}
.bg-brown-400{background-color:#8d6e63!important}
.bg-brown-400.text-auto{background-color:#8d6e63!important}
.text-brown-400{color:#8d6e63!important}
.border-brown-400{border-color:#8d6e63!important}
.border-top-brown-400{border-top-color:#8d6e63!important}
.border-right-brown-400{border-right-color:#8d6e63!important}
.border-bottom-brown-400{border-bottom-color:#8d6e63!important}
.border-left-brown-400{border-left-color:#8d6e63!important}
.bg-brown-500{background-color:#795548!important}
.bg-brown-500.text-auto{background-color:#795548!important}
.text-brown-500{color:#795548!important}
.border-brown-500{border-color:#795548!important}
.border-top-brown-500{border-top-color:#795548!important}
.border-right-brown-500{border-right-color:#795548!important}
.border-bottom-brown-500{border-bottom-color:#795548!important}
.border-left-brown-500{border-left-color:#795548!important}
.bg-brown.text-auto{background-color:#795548!important}
.bg-brown{background-color:#795548!important}
.text-brown{color:#795548!important}
.border-brown{border-color:#795548!important}
.border-top-brown{border-top-color:#795548!important}
.border-right-brown{border-right-color:#795548!important}
.border-bottom-brown{border-bottom-color:#795548!important}
.border-left-brown{border-left-color:#795548!important}
.bg-brown-600{background-color:#6d4c41!important}
.bg-brown-600.text-auto{background-color:#6d4c41!important}
.text-brown-600{color:#6d4c41!important}
.border-brown-600{border-color:#6d4c41!important}
.border-top-brown-600{border-top-color:#6d4c41!important}
.border-right-brown-600{border-right-color:#6d4c41!important}
.border-bottom-brown-600{border-bottom-color:#6d4c41!important}
.border-left-brown-600{border-left-color:#6d4c41!important}
.bg-brown-700{background-color:#5d4037!important}
.bg-brown-700.text-auto{background-color:#5d4037!important}
.text-brown-700{color:#5d4037!important}
.border-brown-700{border-color:#5d4037!important}
.border-top-brown-700{border-top-color:#5d4037!important}
.border-right-brown-700{border-right-color:#5d4037!important}
.border-bottom-brown-700{border-bottom-color:#5d4037!important}
.border-left-brown-700{border-left-color:#5d4037!important}
.bg-brown-800{background-color:#4e342e!important}
.bg-brown-800.text-auto{background-color:#4e342e!important}
.text-brown-800{color:#4e342e!important}
.border-brown-800{border-color:#4e342e!important}
.border-top-brown-800{border-top-color:#4e342e!important}
.border-right-brown-800{border-right-color:#4e342e!important}
.border-bottom-brown-800{border-bottom-color:#4e342e!important}
.border-left-brown-800{border-left-color:#4e342e!important}
.bg-brown-900{background-color:#3e2723!important}
.bg-brown-900.text-auto{background-color:#3e2723!important}
.text-brown-900{color:#3e2723!important}
.border-brown-900{border-color:#3e2723!important}
.border-top-brown-900{border-top-color:#3e2723!important}
.border-right-brown-900{border-right-color:#3e2723!important}
.border-bottom-brown-900{border-bottom-color:#3e2723!important}
.border-left-brown-900{border-left-color:#3e2723!important}
.bg-brown-A100{background-color:#d7ccc8!important}
.bg-brown-A100.text-auto{background-color:#d7ccc8!important}
.text-brown-A100{color:#d7ccc8!important}
.border-brown-A100{border-color:#d7ccc8!important}
.border-top-brown-A100{border-top-color:#d7ccc8!important}
.border-right-brown-A100{border-right-color:#d7ccc8!important}
.border-bottom-brown-A100{border-bottom-color:#d7ccc8!important}
.border-left-brown-A100{border-left-color:#d7ccc8!important}
.bg-brown-A200{background-color:#bcaaa4!important}
.bg-brown-A200.text-auto{background-color:#bcaaa4!important}
.text-brown-A200{color:#bcaaa4!important}
.border-brown-A200{border-color:#bcaaa4!important}
.border-top-brown-A200{border-top-color:#bcaaa4!important}
.border-right-brown-A200{border-right-color:#bcaaa4!important}
.border-bottom-brown-A200{border-bottom-color:#bcaaa4!important}
.border-left-brown-A200{border-left-color:#bcaaa4!important}
.bg-brown-A400{background-color:#8d6e63!important}
.bg-brown-A400.text-auto{background-color:#8d6e63!important}
.text-brown-A400{color:#8d6e63!important}
.border-brown-A400{border-color:#8d6e63!important}
.border-top-brown-A400{border-top-color:#8d6e63!important}
.border-right-brown-A400{border-right-color:#8d6e63!important}
.border-bottom-brown-A400{border-bottom-color:#8d6e63!important}
.border-left-brown-A400{border-left-color:#8d6e63!important}
.bg-brown-A700{background-color:#5d4037!important}
.bg-brown-A700.text-auto{background-color:#5d4037!important}
.text-brown-A700{color:#5d4037!important}
.border-brown-A700{border-color:#5d4037!important}
.border-top-brown-A700{border-top-color:#5d4037!important}
.border-right-brown-A700{border-right-color:#5d4037!important}
.border-bottom-brown-A700{border-bottom-color:#5d4037!important}
.border-left-brown-A700{border-left-color:#5d4037!important}
.bg-grey-50{background-color:#fafafa!important}
.bg-grey-50.text-auto{background-color:#fafafa!important}
.text-grey-50{color:#fafafa!important}
.border-grey-50{border-color:#fafafa!important}
.border-top-grey-50{border-top-color:#fafafa!important}
.border-right-grey-50{border-right-color:#fafafa!important}
.border-bottom-grey-50{border-bottom-color:#fafafa!important}
.border-left-grey-50{border-left-color:#fafafa!important}
.bg-grey-100{background-color:#f5f5f5!important}
.bg-grey-100.text-auto{background-color:#f5f5f5!important}
.text-grey-100{color:#f5f5f5!important}
.border-grey-100{border-color:#f5f5f5!important}
.border-top-grey-100{border-top-color:#f5f5f5!important}
.border-right-grey-100{border-right-color:#f5f5f5!important}
.border-bottom-grey-100{border-bottom-color:#f5f5f5!important}
.border-left-grey-100{border-left-color:#f5f5f5!important}
.bg-grey-200{background-color:#eee!important}
.bg-grey-200.text-auto{background-color:#eee!important}
.text-grey-200{color:#eee!important}
.border-grey-200{border-color:#eee!important}
.border-top-grey-200{border-top-color:#eee!important}
.border-right-grey-200{border-right-color:#eee!important}
.border-bottom-grey-200{border-bottom-color:#eee!important}
.border-left-grey-200{border-left-color:#eee!important}
.bg-grey-300{background-color:#e0e0e0!important}
.bg-grey-300.text-auto{background-color:#e0e0e0!important}
.text-grey-300{color:#e0e0e0!important}
.border-grey-300{border-color:#e0e0e0!important}
.border-top-grey-300{border-top-color:#e0e0e0!important}
.border-right-grey-300{border-right-color:#e0e0e0!important}
.border-bottom-grey-300{border-bottom-color:#e0e0e0!important}
.border-left-grey-300{border-left-color:#e0e0e0!important}
.bg-grey-400{background-color:#bdbdbd!important}
.bg-grey-400.text-auto{background-color:#bdbdbd!important}
.text-grey-400{color:#bdbdbd!important}
.border-grey-400{border-color:#bdbdbd!important}
.border-top-grey-400{border-top-color:#bdbdbd!important}
.border-right-grey-400{border-right-color:#bdbdbd!important}
.border-bottom-grey-400{border-bottom-color:#bdbdbd!important}
.border-left-grey-400{border-left-color:#bdbdbd!important}
.bg-grey-500{background-color:#9e9e9e!important}
.bg-grey-500.text-auto{background-color:#9e9e9e!important}
.text-grey-500{color:#9e9e9e!important}
.border-grey-500{border-color:#9e9e9e!important}
.border-top-grey-500{border-top-color:#9e9e9e!important}
.border-right-grey-500{border-right-color:#9e9e9e!important}
.border-bottom-grey-500{border-bottom-color:#9e9e9e!important}
.border-left-grey-500{border-left-color:#9e9e9e!important}
.bg-grey.text-auto{background-color:#9e9e9e!important}
.bg-grey{background-color:#9e9e9e!important}
.text-grey{color:#9e9e9e!important}
.border-grey{border-color:#9e9e9e!important}
.border-top-grey{border-top-color:#9e9e9e!important}
.border-right-grey{border-right-color:#9e9e9e!important}
.border-bottom-grey{border-bottom-color:#9e9e9e!important}
.border-left-grey{border-left-color:#9e9e9e!important}
.bg-grey-600{background-color:#757575!important}
.bg-grey-600.text-auto{background-color:#757575!important}
.text-grey-600{color:#757575!important}
.border-grey-600{border-color:#757575!important}
.border-top-grey-600{border-top-color:#757575!important}
.border-right-grey-600{border-right-color:#757575!important}
.border-bottom-grey-600{border-bottom-color:#757575!important}
.border-left-grey-600{border-left-color:#757575!important}
.bg-grey-700{background-color:#616161!important}
.bg-grey-700.text-auto{background-color:#616161!important}
.text-grey-700{color:#616161!important}
.border-grey-700{border-color:#616161!important}
.border-top-grey-700{border-top-color:#616161!important}
.border-right-grey-700{border-right-color:#616161!important}
.border-bottom-grey-700{border-bottom-color:#616161!important}
.border-left-grey-700{border-left-color:#616161!important}
.bg-grey-800{background-color:#424242!important}
.bg-grey-800.text-auto{background-color:#424242!important}
.text-grey-800{color:#424242!important}
.border-grey-800{border-color:#424242!important}
.border-top-grey-800{border-top-color:#424242!important}
.border-right-grey-800{border-right-color:#424242!important}
.border-bottom-grey-800{border-bottom-color:#424242!important}
.border-left-grey-800{border-left-color:#424242!important}
.bg-grey-900{background-color:#212121!important}
.bg-grey-900.text-auto{background-color:#212121!important}
.text-grey-900{color:#212121!important}
.border-grey-900{border-color:#212121!important}
.border-top-grey-900{border-top-color:#212121!important}
.border-right-grey-900{border-right-color:#212121!important}
.border-bottom-grey-900{border-bottom-color:#212121!important}
.border-left-grey-900{border-left-color:#212121!important}
.bg-grey-1000{background-color:#000!important}
.bg-grey-1000.text-auto{background-color:#000!important}
.text-grey-1000{color:#000!important}
.border-grey-1000{border-color:#000!important}
.border-top-grey-1000{border-top-color:#000!important}
.border-right-grey-1000{border-right-color:#000!important}
.border-bottom-grey-1000{border-bottom-color:#000!important}
.border-left-grey-1000{border-left-color:#000!important}
.bg-grey-A100{background-color:#fff!important}
.bg-grey-A100.text-auto{background-color:#fff!important}
.text-grey-A100{color:#fff!important}
.border-grey-A100{border-color:#fff!important}
.border-top-grey-A100{border-top-color:#fff!important}
.border-right-grey-A100{border-right-color:#fff!important}
.border-bottom-grey-A100{border-bottom-color:#fff!important}
.border-left-grey-A100{border-left-color:#fff!important}
.bg-grey-A200{background-color:#eee!important}
.bg-grey-A200.text-auto{background-color:#eee!important}
.text-grey-A200{color:#eee!important}
.border-grey-A200{border-color:#eee!important}
.border-top-grey-A200{border-top-color:#eee!important}
.border-right-grey-A200{border-right-color:#eee!important}
.border-bottom-grey-A200{border-bottom-color:#eee!important}
.border-left-grey-A200{border-left-color:#eee!important}
.bg-grey-A400{background-color:#bdbdbd!important}
.bg-grey-A400.text-auto{background-color:#bdbdbd!important}
.text-grey-A400{color:#bdbdbd!important}
.border-grey-A400{border-color:#bdbdbd!important}
.border-top-grey-A400{border-top-color:#bdbdbd!important}
.border-right-grey-A400{border-right-color:#bdbdbd!important}
.border-bottom-grey-A400{border-bottom-color:#bdbdbd!important}
.border-left-grey-A400{border-left-color:#bdbdbd!important}
.bg-grey-A700{background-color:#616161!important}
.bg-grey-A700.text-auto{background-color:#616161!important}
.text-grey-A700{color:#616161!important}
.border-grey-A700{border-color:#616161!important}
.border-top-grey-A700{border-top-color:#616161!important}
.border-right-grey-A700{border-right-color:#616161!important}
.border-bottom-grey-A700{border-bottom-color:#616161!important}
.border-left-grey-A700{border-left-color:#616161!important}
.bg-blue-grey-50{background-color:#eceff1!important}
.bg-blue-grey-50.text-auto{background-color:#eceff1!important}
.text-blue-grey-50{color:#eceff1!important}
.border-blue-grey-50{border-color:#eceff1!important}
.border-top-blue-grey-50{border-top-color:#eceff1!important}
.border-right-blue-grey-50{border-right-color:#eceff1!important}
.border-bottom-blue-grey-50{border-bottom-color:#eceff1!important}
.border-left-blue-grey-50{border-left-color:#eceff1!important}
.bg-blue-grey-100{background-color:#cfd8dc!important}
.bg-blue-grey-100.text-auto{background-color:#cfd8dc!important}
.text-blue-grey-100{color:#cfd8dc!important}
.border-blue-grey-100{border-color:#cfd8dc!important}
.border-top-blue-grey-100{border-top-color:#cfd8dc!important}
.border-right-blue-grey-100{border-right-color:#cfd8dc!important}
.border-bottom-blue-grey-100{border-bottom-color:#cfd8dc!important}
.border-left-blue-grey-100{border-left-color:#cfd8dc!important}
.bg-blue-grey-200{background-color:#b0bec5!important}
.bg-blue-grey-200.text-auto{background-color:#b0bec5!important}
.text-blue-grey-200{color:#b0bec5!important}
.border-blue-grey-200{border-color:#b0bec5!important}
.border-top-blue-grey-200{border-top-color:#b0bec5!important}
.border-right-blue-grey-200{border-right-color:#b0bec5!important}
.border-bottom-blue-grey-200{border-bottom-color:#b0bec5!important}
.border-left-blue-grey-200{border-left-color:#b0bec5!important}
.bg-blue-grey-300{background-color:#90a4ae!important}
.bg-blue-grey-300.text-auto{background-color:#90a4ae!important}
.text-blue-grey-300{color:#90a4ae!important}
.border-blue-grey-300{border-color:#90a4ae!important}
.border-top-blue-grey-300{border-top-color:#90a4ae!important}
.border-right-blue-grey-300{border-right-color:#90a4ae!important}
.border-bottom-blue-grey-300{border-bottom-color:#90a4ae!important}
.border-left-blue-grey-300{border-left-color:#90a4ae!important}
.bg-blue-grey-400{background-color:#78909c!important}
.bg-blue-grey-400.text-auto{background-color:#78909c!important}
.text-blue-grey-400{color:#78909c!important}
.border-blue-grey-400{border-color:#78909c!important}
.border-top-blue-grey-400{border-top-color:#78909c!important}
.border-right-blue-grey-400{border-right-color:#78909c!important}
.border-bottom-blue-grey-400{border-bottom-color:#78909c!important}
.border-left-blue-grey-400{border-left-color:#78909c!important}
.bg-blue-grey-500{background-color:#607d8b!important}
.bg-blue-grey-500.text-auto{background-color:#607d8b!important}
.text-blue-grey-500{color:#607d8b!important}
.border-blue-grey-500{border-color:#607d8b!important}
.border-top-blue-grey-500{border-top-color:#607d8b!important}
.border-right-blue-grey-500{border-right-color:#607d8b!important}
.border-bottom-blue-grey-500{border-bottom-color:#607d8b!important}
.border-left-blue-grey-500{border-left-color:#607d8b!important}
.bg-blue-grey.text-auto{background-color:#607d8b!important}
.bg-blue-grey{background-color:#607d8b!important}
.text-blue-grey{color:#607d8b!important}
.border-blue-grey{border-color:#607d8b!important}
.border-top-blue-grey{border-top-color:#607d8b!important}
.border-right-blue-grey{border-right-color:#607d8b!important}
.border-bottom-blue-grey{border-bottom-color:#607d8b!important}
.border-left-blue-grey{border-left-color:#607d8b!important}
.bg-blue-grey-600{background-color:#546e7a!important}
.bg-blue-grey-600.text-auto{background-color:#546e7a!important}
.text-blue-grey-600{color:#546e7a!important}
.border-blue-grey-600{border-color:#546e7a!important}
.border-top-blue-grey-600{border-top-color:#546e7a!important}
.border-right-blue-grey-600{border-right-color:#546e7a!important}
.border-bottom-blue-grey-600{border-bottom-color:#546e7a!important}
.border-left-blue-grey-600{border-left-color:#546e7a!important}
.bg-blue-grey-700{background-color:#455a64!important}
.bg-blue-grey-700.text-auto{background-color:#455a64!important}
.text-blue-grey-700{color:#455a64!important}
.border-blue-grey-700{border-color:#455a64!important}
.border-top-blue-grey-700{border-top-color:#455a64!important}
.border-right-blue-grey-700{border-right-color:#455a64!important}
.border-bottom-blue-grey-700{border-bottom-color:#455a64!important}
.border-left-blue-grey-700{border-left-color:#455a64!important}
.bg-blue-grey-800{background-color:#37474f!important}
.bg-blue-grey-800.text-auto{background-color:#37474f!important}
.text-blue-grey-800{color:#37474f!important}
.border-blue-grey-800{border-color:#37474f!important}
.border-top-blue-grey-800{border-top-color:#37474f!important}
.border-right-blue-grey-800{border-right-color:#37474f!important}
.border-bottom-blue-grey-800{border-bottom-color:#37474f!important}
.border-left-blue-grey-800{border-left-color:#37474f!important}
.bg-blue-grey-900{background-color:#263238!important}
.bg-blue-grey-900.text-auto{background-color:#263238!important}
.text-blue-grey-900{color:#263238!important}
.border-blue-grey-900{border-color:#263238!important}
.border-top-blue-grey-900{border-top-color:#263238!important}
.border-right-blue-grey-900{border-right-color:#263238!important}
.border-bottom-blue-grey-900{border-bottom-color:#263238!important}
.border-left-blue-grey-900{border-left-color:#263238!important}
.bg-blue-grey-A100{background-color:#cfd8dc!important}
.bg-blue-grey-A100.text-auto{background-color:#cfd8dc!important}
.text-blue-grey-A100{color:#cfd8dc!important}
.border-blue-grey-A100{border-color:#cfd8dc!important}
.border-top-blue-grey-A100{border-top-color:#cfd8dc!important}
.border-right-blue-grey-A100{border-right-color:#cfd8dc!important}
.border-bottom-blue-grey-A100{border-bottom-color:#cfd8dc!important}
.border-left-blue-grey-A100{border-left-color:#cfd8dc!important}
.bg-blue-grey-A200{background-color:#b0bec5!important}
.bg-blue-grey-A200.text-auto{background-color:#b0bec5!important}
.text-blue-grey-A200{color:#b0bec5!important}
.border-blue-grey-A200{border-color:#b0bec5!important}
.border-top-blue-grey-A200{border-top-color:#b0bec5!important}
.border-right-blue-grey-A200{border-right-color:#b0bec5!important}
.border-bottom-blue-grey-A200{border-bottom-color:#b0bec5!important}
.border-left-blue-grey-A200{border-left-color:#b0bec5!important}
.bg-blue-grey-A400{background-color:#78909c!important}
.bg-blue-grey-A400.text-auto{background-color:#78909c!important}
.text-blue-grey-A400{color:#78909c!important}
.border-blue-grey-A400{border-color:#78909c!important}
.border-top-blue-grey-A400{border-top-color:#78909c!important}
.border-right-blue-grey-A400{border-right-color:#78909c!important}
.border-bottom-blue-grey-A400{border-bottom-color:#78909c!important}
.border-left-blue-grey-A400{border-left-color:#78909c!important}
.bg-blue-grey-A700{background-color:#455a64!important}
.bg-blue-grey-A700.text-auto{background-color:#455a64!important}
.text-blue-grey-A700{color:#455a64!important}
.border-blue-grey-A700{border-color:#455a64!important}
.border-top-blue-grey-A700{border-top-color:#455a64!important}
.border-right-blue-grey-A700{border-right-color:#455a64!important}
.border-bottom-blue-grey-A700{border-bottom-color:#455a64!important}
.border-left-blue-grey-A700{border-left-color:#455a64!important}
.bg-white-500{background-color:#fff!important}
.bg-white-500.text-auto{background-color:#fff!important}
.text-white-500{color:#fff!important}
.border-white-500{border-color:#fff!important}
.border-top-white-500{border-top-color:#fff!important}
.border-right-white-500{border-right-color:#fff!important}
.border-bottom-white-500{border-bottom-color:#fff!important}
.border-left-white-500{border-left-color:#fff!important}
.bg-white.text-auto{background-color:#fff!important}
.bg-white{background-color:#fff!important}
.text-white{color:#fff!important}
.border-white{border-color:#fff!important}
.border-top-white{border-top-color:#fff!important}
.border-right-white{border-right-color:#fff!important}
.border-bottom-white{border-bottom-color:#fff!important}
.border-left-white{border-left-color:#fff!important}
.bg-black-500{background-color:#000!important}
.bg-black-500.text-auto{background-color:#000!important}
.text-black-500{color:#000!important}
.border-black-500{border-color:#000!important}
.border-top-black-500{border-top-color:#000!important}
.border-right-black-500{border-right-color:#000!important}
.border-bottom-black-500{border-bottom-color:#000!important}
.border-left-black-500{border-left-color:#000!important}
.bg-black.text-auto{background-color:#000!important}
.bg-black{background-color:#000!important}
.text-black{color:#000!important}
.border-black{border-color:#000!important}
.border-top-black{border-top-color:#000!important}
.border-right-black{border-right-color:#000!important}
.border-bottom-black{border-bottom-color:#000!important}
.border-left-black{border-left-color:#000!important}
.source .hll{background-color:#ffc}
.source .c{color:#999}
.source .k{color:#069}
.source .o{color:#555}
.source .cm{color:#999}
.source .cp{color:#099}
.source .c1{color:#999}
.source .cs{color:#999}
.source .gd{background-color:#fcc;border:1px solid #c00}
.source .ge{font-style:italic}
.source .gr{color:red}
.source .gh{color:#030}
.source .gi{background-color:#cfc;border:1px solid #0c0}
.source .go{color:#aaa}
.source .gp{color:#009}
.source .gu{color:#030}
.source .gt{color:#9c6}
.source .kc{color:#069}
.source .kd{color:#069}
.source .kn{color:#069}
.source .kp{color:#069}
.source .kr{color:#069}
.source .kt{color:#078}
.source .m{color:#f60}
.source .s{color:#d44950}
.source .na{color:#4f9fcf}
.source .nb{color:#366}
.source .nc{color:#0a8}
.source .no{color:#360}
.source .nd{color:#99f}
.source .ni{color:#999}
.source .ne{color:#c00}
.source .nf{color:#c0f}
.source .nl{color:#99f}
.source .nn{color:#0cf}
.source .nt{color:#2f6f9f}
.source .nv{color:#033}
.source .ow{color:#000}
.source .w{color:#bbb}
.source .mf{color:#f60}
.source .mh{color:#f60}
.source .mi{color:#f60}
.source .mo{color:#f60}
.source .sb{color:#c30}
.source .sc{color:#c30}
.source .sd{font-style:italic;color:#c30}
.source .s2{color:#c30}
.source .se{color:#c30}
.source .sh{color:#c30}
.source .si{color:#a00}
.source .sx{color:#c30}
.source .sr{color:#3aa}
.source .s1{color:#c30}
.source .ss{color:#fc3}
.source .bp{color:#366}
.source .vc{color:#033}
.source .vg{color:#033}
.source .vi{color:#033}
.source .il{color:#f60}
.source .css .nt+.nt,.source .css .o,.source .css .o+.nt{color:#999}
.source .language-bash::before{color:#009;content:"$ ";-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}
.source .language-powershell::before{color:#009;content:"PM> ";-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}
@media (max-width:767px){.doc .example>.source-preview-wrapper>.preview{padding:1.6rem}
}
#mail .search-bar{height:5.6rem;background:#fff;-webkit-box-shadow:0 4px 5px -2px rgba(0,0,0,.2),0 7px 10px 1px rgba(0,0,0,.14),0 2px 16px 1px rgba(0,0,0,.12);box-shadow:0 4px 5px -2px rgba(0,0,0,.2),0 7px 10px 1px rgba(0,0,0,.14),0 2px 16px 1px rgba(0,0,0,.12)}
#mail .search-bar .sidebar-toggle-button{width:5.6rem;height:5.6rem;-webkit-border-radius:0!important;border-radius:0!important;border-right:1px solid rgba(0,0,0,.12)}
#mail .search-bar .search-bar-input{height:5.6rem;color:rgba(0,0,0,.54);border:none;outline:0}
#mail .thread-list .no-threads{background:#fafafa;width:100%;text-align:center;padding:32px;font-size:20px}
#mail .thread-list .thread{background:#fafafa;position:relative;border-bottom:1px solid rgba(0,0,0,.12);cursor:pointer}
#mail .thread-list .thread.unread{background:#fff}
#mail .thread-list .thread.unread .info .name,#mail .thread-list .thread.unread .info .subject{font-weight:700}
#mail .thread-list .thread.unread .info .message .labels{background:#fff}
#mail .thread-list .thread.selected{background:#fff8e1}
#mail .thread-list .thread.selected .info .message .labels{background:#fff8e1}
#mail .thread-list .thread .info .name{font-size:1.5rem;font-weight:500;padding-bottom:.8rem}
#mail .thread-list .thread .info .name .avatar{background:#039be5}
#mail .thread-list .thread .info .name .has-attachment{margin-left:.8rem;-webkit-transform:rotate(90deg);-ms-transform:rotate(90deg);transform:rotate(90deg)}
#mail .thread-list .thread .info .message{position:relative;color:rgba(0,0,0,.54)}
#mail .thread-list .thread .info .message .labels{position:absolute;background:#fafafa;top:0;right:0;padding-left:6px}
#mail .thread-list .thread .info .message .labels .label:first-child{margin-left:0}
#mail .thread-list .thread .time{text-align:center}
#mail .thread-list .thread .actions .icon-label,#mail .thread-list .thread .actions .icon-star{color:#ffc107}
#contacts .page-header{height:7.6rem;min-height:7.6rem;max-height:7.6rem}
#contacts .page-header .search-wrapper{max-width:24rem}
#contacts .page-content-wrapper .page-content{padding:2.4rem 9rem 2.4rem 0}
#contacts .page-content-wrapper .page-content .contacts-list{width:100%}
#contacts .page-content-wrapper .page-content .contacts-list .contacts-list-header{border-bottom:1px solid rgba(0,0,0,.12)}
#contacts .page-content-wrapper .page-content .contacts-list .contact-item{position:relative;border-bottom:1px solid rgba(0,0,0,.12);cursor:pointer}
#contacts .page-content-wrapper .page-content .contacts-list .contact-item .actions .icon-star{color:#ffc107}
#todo .search-bar{height:5.6rem;background:#fff;-webkit-box-shadow:0 4px 5px -2px rgba(0,0,0,.2),0 7px 10px 1px rgba(0,0,0,.14),0 2px 16px 1px rgba(0,0,0,.12);box-shadow:0 4px 5px -2px rgba(0,0,0,.2),0 7px 10px 1px rgba(0,0,0,.14),0 2px 16px 1px rgba(0,0,0,.12)}
#todo .search-bar .sidebar-toggle-button{width:5.6rem;height:5.6rem;-webkit-border-radius:0!important;border-radius:0!important;border-right:1px solid rgba(0,0,0,.12)}
#todo .search-bar .search-bar-input{height:5.6rem;color:rgba(0,0,0,.54);border:none;outline:0}
#todo .todo-items{background:#fafafa}
#todo .todo-items .todo-item{border-bottom:1px solid rgba(0,0,0,.08)}
#todo .todo-items .todo-item .tags .tag{background-color:rgba(0,0,0,.08);color:#000}
#todo .todo-items .todo-item .tags .tag .tag-color{width:.8rem;height:.8rem;-webkit-border-radius:50%;border-radius:50%}
#todo .todo-items .todo-item.completed{background:#eee}
#todo .todo-items .todo-item.completed .notes,#todo .todo-items .todo-item.completed .title{color:rgba(0,0,0,.54);text-decoration:line-through}
#todo .todo-items .todo-item.selected{background:#fff8e1}
#todo .todo-items .todo-item .info .title{font-size:1.5rem;font-weight:500}
#todo .todo-items .todo-item .buttons .icon-alert-circle{color:#e53935}
#todo .todo-items .todo-item .buttons .icon-star{color:#ffc107}
#chat{position:absolute;top:0;right:0;left:0;bottom:0}
#chat .page-content{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;max-width:1400px}
#chat .page-content>.page-content-card{background:url(/storage/assets/images/patterns/rain-grey.png)}
#chat .page-content>.page-content-card>.left-sidebar{position:relative;overflow:hidden;width:40rem;background:#fff;border-right:1px solid rgba(0,0,0,.12)}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views{height:100%}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views .view{height:100%}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views .view>.content{overflow-x:hidden;overflow-y:auto}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #chats-view .toolbar{background-color:#f3f4f5;color:rgba(0,0,0,.87)}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #chats-view .toolbar .toolbar-top{border-bottom:1px solid rgba(0,0,0,.08);height:6.4rem}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #chats-view .toolbar .toolbar-top .avatar-wrapper{cursor:pointer}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #chats-view .toolbar .toolbar-top .avatar-wrapper .status{position:absolute;top:2.8rem;left:2.8rem;-webkit-border-radius:50%;border-radius:50%}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #chats-view .toolbar .toolbar-bottom{border-bottom:1px solid rgba(0,0,0,.08);background-color:#fafafa;height:6.4rem}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #chats-view .toolbar .toolbar-bottom .search-wrapper{height:3.6rem;background-color:#fff}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #chats-view>.content .chat-list .contact{min-height:8.8rem}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #chats-view>.content .chat-list .contact .last-message{max-width:180px;margin-bottom:0}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #chats-view>.content .chat-list .contact .last-message-time{white-space:nowrap;font-size:1.3rem}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #chats-view>.content .chat-list .contact.unread .last-message,#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #chats-view>.content .chat-list .contact.unread .last-message-time,#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #chats-view>.content .chat-list .contact.unread .name{font-weight:500}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #chats-view>.content .chat-list .contact .unread-message-count{-webkit-border-radius:50%;border-radius:50%;text-align:center;width:24px;height:24px;line-height:24px}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #contacts-view>.toolbar .toolbar-top{height:6.4rem}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #contacts-view>.toolbar .toolbar-bottom{height:6.4rem}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #contacts-view>.toolbar .toolbar-bottom .search-wrapper{height:3.6rem;background-color:#fff}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #contacts-view>.content .contact-list .contact{position:relative;height:8.8rem;min-height:8.8rem}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #contacts-view>.content .contact-list .contact .mood{font-size:1.3rem}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #user-view>.toolbar{height:30rem}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #user-view>.toolbar .toolbar-top{height:6.4rem}
#chat .page-content>.page-content-card>.left-sidebar #chat-left-sidebar-views #user-view>.toolbar .toolbar-bottom .search-wrapper{height:3.6rem;background-color:#fff}
#chat .page-content>.page-content-card>.content{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex}
#chat .page-content>.page-content-card>.content #chat-content-views{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1}
#chat .page-content>.page-content-card>.content #chat-content-views>.view{-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;background:-webkit-gradient(linear,left top,left bottom,from(rgba(255,255,255,.8)),color-stop(20%,rgba(255,255,255,.6)),color-stop(20%,rgba(255,255,255,.8)));background:-webkit-linear-gradient(top,rgba(255,255,255,.8) 0,rgba(255,255,255,.6) 20%,rgba(255,255,255,.8));background:linear-gradient(to bottom,rgba(255,255,255,.8) 0,rgba(255,255,255,.6) 20%,rgba(255,255,255,.8))}
#chat .page-content>.page-content-card>.content #chat-content-views #start-view .big-circle{background:-webkit-gradient(linear,left top,left bottom,from(rgba(255,255,255,.8)),color-stop(20%,rgba(255,255,255,.6)),color-stop(20%,rgba(255,255,255,.8)));background:-webkit-linear-gradient(top,rgba(255,255,255,.8) 0,rgba(255,255,255,.6) 20%,rgba(255,255,255,.8));background:linear-gradient(to bottom,rgba(255,255,255,.8) 0,rgba(255,255,255,.6) 20%,rgba(255,255,255,.8));-webkit-border-radius:50%;border-radius:50%;width:300px;height:300px;line-height:300px;text-align:center}
#chat .page-content>.page-content-card>.content #chat-content-views #start-view .app-title{font-weight:500}
#chat .page-content>.page-content-card>.content #chat-content-views #chat-view .toolbar{-webkit-box-flex:1;-webkit-flex:1 0 auto;-ms-flex:1 0 auto;flex:1 0 auto;background-color:#f3f4f5;border-bottom:1px solid rgba(0,0,0,.08);height:6.4rem;max-height:6.4rem}
#chat .page-content>.page-content-card>.content #chat-content-views #chat-view .chat-content{-webkit-box-flex:1;-webkit-flex:1 1 100%;-ms-flex:1 1 100%;flex:1 1 100%;overflow-x:hidden;overflow-y:auto}
#chat .page-content>.page-content-card>.content #chat-content-views #chat-view .chat-content .chat-messages .message-row .bubble{position:relative;padding:.6rem .7rem .8rem .9rem;background-color:#fff;-webkit-box-shadow:0 1px .5px rgba(0,0,0,.13);box-shadow:0 1px .5px rgba(0,0,0,.13);-webkit-border-radius:6px;border-radius:6px}
#chat .page-content>.page-content-card>.content #chat-content-views #chat-view .chat-content .chat-messages .message-row .bubble:before{background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAmCAMAAADp2asXAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAADGUExURQAAAP////b29vn5+f///wAAAP///wAAAAAAAP///9ra2v////j4+PHx8fv7++Hh4fHx8f////////////////39/QAAAP////////z8/P////39/f39/fz8/P////////////z8/P////////////z8/P////////////v7+/Hx8f///9bW1vz8/K2trf////39/f39/WJiYgAAAExMTFtbWwAAAN3d3cjIyPr6+vX19QAAAO7u7vz8/NTU1Ofn5zMzM////zGPlXsAAABBdFJOUwAcm/kREh4CCDWL1SneR6TfAQffhMYK/A5nRrLWfRc5DW2ih5f+19Kn+9v4g/1LCJuXHwQUKgahcXS6DNnlDMMKKzPoTgAAAKBJREFUKM+V08USwmAQA+C/0NIWd3d3d8/7vxTMcIPkQK7f7CG7s8bQAOY/SCuwFYQU1P+eiCqIK2gpWCmoCrAgoKQgJ8CHgIqAMjg0MxxSQ3DogEMWFBZtUPAHYGB1CyDQWE6AH7BrfXzlAxGAQhECTGAmwN1Okz0Gb/LW4fEItIfrOfNELMh3tck7u+PhcT2zQ7l77/K8iY8yJwV3BeYFqpc/uSyPGdAAAAAASUVORK5CYII=);content:'';position:absolute;left:-1.1rem;bottom:.3rem;width:1.2rem;height:1.9rem;background-position:50% 50%;background-repeat:no-repeat;background-size:contain}
#chat .page-content>.page-content-card>.content #chat-content-views #chat-view .chat-content .chat-messages .message-row .bubble .message{white-space:pre-wrap}
#chat .page-content>.page-content-card>.content #chat-content-views #chat-view .chat-content .chat-messages .message-row .bubble .time{font-size:1.1rem}
#chat .page-content>.page-content-card>.content #chat-content-views #chat-view .chat-content .chat-messages .message-row.user{-webkit-box-align:end;-webkit-align-items:flex-end;-ms-flex-align:end;align-items:flex-end}
#chat .page-content>.page-content-card>.content #chat-content-views #chat-view .chat-content .chat-messages .message-row.user .avatar{-webkit-box-ordinal-group:3;-webkit-order:2;-ms-flex-order:2;order:2;margin:0 0 0 16px}
#chat .page-content>.page-content-card>.content #chat-content-views #chat-view .chat-content .chat-messages .message-row.user .bubble{margin-left:auto;background-color:#e8f5e9;border:1px solid #dfebe0;-webkit-box-ordinal-group:2;-webkit-order:1;-ms-flex-order:1;order:1}
#chat .page-content>.page-content-card>.content #chat-content-views #chat-view .chat-content .chat-messages .message-row.user .bubble:before{right:-11px;left:auto;background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAmCAMAAADp2asXAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAD2UExURQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAGRsXAAAANzwzNPmxNrtyau5oIWRedDkwNntyczgwdfpyJ+/n97wzsLWtNjsytvwzczfvtPmxau6nNjqxtrtyio1KtzwzNjryAAAANzwzgAAANzwzK7Aor/Us9Lnw8vevAAAAMzevtbpxrvMrX+IdwAAAEROOi45Lr3MrZGjf9LoxX+MctnqydLkwhgYGMzfv9vuyQAAANzwzNvuy9zxy7vMu7XGqNvtzKKykwAAANruzKq6nLnMriQkGMXXuL3PsNjsySgzKAAAANLkw83fvd3vy9z4xtzwzRpFmIEAAABQdFJOUwAXChEGBAMBAgwhDvJ7k0YqMc0Zmwj6apf2kjU0+dkw/swh/CP9j2Wr2gndvaYeBRoxQg6gUPt/FaHJGdTj9A9k7XQLeE6iFcN12xkSt9r4NKizowAAAMFJREFUKM+V0sdywlAMBVDbMX7PQCihQ+iQ0HsJvfem/P/PwBIzugu0PXNnNNJVyPmhsIPhhoB2COwIGuLdhAcl3AhCBoBoHUC6BCBbA0C/EkBFB5D/FjxQwQYg1RI8UKINgDoSAPUlAPqUAMgfAEBfXsEDBV0+Hogi4Zhg4THj9YwHoqEBYOrgYTI3GVgMNn8r+Qq94k9yZNosW/3Hy9VuTjWfHkOX6367bGZUU7de66ieHZrO1OGg8Z1WTgYAFLgD5S1PCkzo1B0AAAAASUVORK5CYII=)}
#chat .page-content>.page-content-card>.content #chat-content-views #chat-view .chat-footer{-webkit-box-flex:1;-webkit-flex:1 0 auto;-ms-flex:1 0 auto;flex:1 0 auto;min-height:6.4rem;max-height:9.6rem;background-color:#f3f4f5;border-top:1px solid rgba(0,0,0,.08)}
#chat .page-content>.page-content-card .avatar-wrapper{position:relative}
#chat .page-content>.page-content-card .avatar-wrapper .status{position:absolute;top:28px;left:28px;-webkit-border-radius:50%;border-radius:50%}
#chat .page-content>.page-content-card .avatar-wrapper .status.online{color:#4caf50}
#chat .page-content>.page-content-card .avatar-wrapper .status.online:before{content:"\ea7a"}
#chat .page-content>.page-content-card .avatar-wrapper .status.do-not-disturb{color:#f44336}
#chat .page-content>.page-content-card .avatar-wrapper .status.do-not-disturb:before{content:"\eb59"}
#chat .page-content>.page-content-card .avatar-wrapper .status.away{background-color:#ffc107;color:#fff}
#chat .page-content>.page-content-card .avatar-wrapper .status.away:before{content:"\eaae"}
#chat .page-content>.page-content-card .avatar-wrapper .status.offline{color:#4caf50;background-color:#fff}
#chat .page-content>.page-content-card .avatar-wrapper .status.offline:before{content:"\ea7c"}
#project-dashboard .page-header{height:16rem;min-height:16rem;max-height:16rem}
#project-dashboard .page-header .project-selection .selected-project{background:rgba(0,0,0,.12);color:#fff}
#project-dashboard .page-header .project-selection .project-selector{margin-left:.1rem;background:rgba(0,0,0,.12);overflow:hidden}
#project-dashboard .page-header .project-selection .project-selector i{color:#fff}
#project-dashboard .page-content .tab-content .widget-group .widget .widget-header{height:5.5rem}
#project-dashboard .page-content .tab-content #home-tab-pane .widget-group .widget .widget-content .title{font-size:7.2rem;line-height:7.2rem}
#project-dashboard .page-content .tab-content #home-tab-pane .widget-group .widget .widget-content .sub-title{font-weight:500}
#project-dashboard .page-content .tab-content #home-tab-pane #widget5-main-chart{height:42rem}
#project-dashboard .page-content .tab-content #home-tab-pane #widget5-supporting-charts .chart-wrapper{height:5rem}
#project-dashboard .page-content .tab-content #home-tab-pane #widget6-main-chart{height:40rem}
#project-dashboard .page-content .widget-group .widget .widget-header{height:5.5rem}
#project-dashboard .page-content #budget-summary-tab-pane #widget8-main-chart{height:40rem}
#project-dashboard .page-content #budget-summary-tab-pane #widget9-remaining .chart-wrapper,#project-dashboard .page-content #budget-summary-tab-pane #widget9-totalSpent .chart-wrapper,#project-dashboard .page-content #budget-summary-tab-pane #widget9-weeklySpent .chart-wrapper{height:5rem}
#project-dashboard .page-sidebar{width:25rem;min-width:25rem;background:#eee}
#project-dashboard .page-sidebar .widget-group .widget-now .widget-content .month{font-size:2.4rem}
#project-dashboard .page-sidebar .widget-group .widget-now .widget-content .day{font-size:7.2rem;line-height:8.8rem}
#project-dashboard .page-sidebar .widget-group .widget-now .widget-content .year{font-size:2.4rem}
#project-dashboard .page-sidebar .widget-group .widget-weather .today-weather>span{font-weight:300;font-size:4.5rem;line-height:6.4rem}
#server-dashboard .page-content .widget-group .widget .widget-header{height:5.5rem}
#server-dashboard .page-content .widget-group .widget.widget2,#server-dashboard .page-content .widget-group .widget.widget3,#server-dashboard .page-content .widget-group .widget.widget4,#server-dashboard .page-content .widget-group .widget.widget5{height:170px;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column}
#server-dashboard .page-content .widget-group .widget.widget2 .widget-content,#server-dashboard .page-content .widget-group .widget.widget3 .widget-content,#server-dashboard .page-content .widget-group .widget.widget4 .widget-content,#server-dashboard .page-content .widget-group .widget.widget5 .widget-content{-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1}
#server-dashboard .page-content #widget1-main-chart{height:32rem}
#server-dashboard .page-content #widget4-main-chart{height:5rem}
#server-dashboard .page-content #widget6-main-chart{height:14rem}
#e-commerce-products .page-content>.header .search-wrapper{max-width:48rem}
#e-commerce-products #e-commerce-products-table .product-image{width:5.2rem;height:5.2rem;border:1px solid rgba(0,0,0,.12)}
#e-commerce-product>.page-header{height:12rem;min-height:12rem;max-height:12rem}
#e-commerce-product>.page-content #product-images-tab-pane .product-image{position:relative;width:100px;min-height:100px;border:1px solid rgba(0,0,0,.12)}
#e-commerce-orders .page-content>.header .search-wrapper{max-width:48rem}
#e-commerce-orders #e-commerce-orders-table .product-image{width:5.2rem;height:5.2rem;border:1px solid rgba(0,0,0,.12)}
#calendar .page-header{position:relative;background-size:100% auto;background-position:0 50%;background-repeat:no-repeat;background-color:#fafafa;color:#fff}
#calendar .page-header:before{content:'';position:absolute;top:0;right:0;bottom:0;left:0;z-index:1;background:rgba(0,0,0,.45)}
#calendar .page-header.Jan{background-image:url(/storage/assets/images/backgrounds/january25.jpg);background-position:0 45%}
#calendar .page-header.Feb{background-image:url(/storage/assets/images/backgrounds/february25.jpg);background-position:0 50%}
#calendar .page-header.Mar{background-image:url(/storage/assets/images/backgrounds/march25.jpg);background-position:0 45%}
#calendar .page-header.Apr{background-image:url(/storage/assets/images/backgrounds/april25.jpg);background-position:0 48%}
#calendar .page-header.May{background-image:url(/storage/assets/images/backgrounds/may25.jpg);background-position:0 47%}
#calendar .page-header.Jun{background-image:url(/storage/assets/images/backgrounds/june25.jpg);background-position:0 48%}
#calendar .page-header.Jul{background-image:url(/storage/assets/images/backgrounds/july25.jpg);background-position:0 3%}
#calendar .page-header.Aug{background-image:url(/storage/assets/images/backgrounds/august25.jpg);background-position:0 61%}
#calendar .page-header.Sep{background-image:url(/storage/assets/images/backgrounds/september25.jpg);background-position:0 58%}
#calendar .page-header.Oct{background-image:url(/storage/assets/images/backgrounds/october25.jpg);background-position:0 50%}
#calendar .page-header.Nov{background-image:url(/storage/assets/images/backgrounds/november25.jpg);background-position:0 46%}
#calendar .page-header.Dec{background-image:url(/storage/assets/images/backgrounds/december25.jpg);background-position:0 43%}
#calendar .page-header #add-event-button{position:absolute;right:2.4rem;bottom:2rem;z-index:99}
#calendar .page-header .header-content{height:100%}
#calendar .page-header .header-content .header-top{z-index:2}
#calendar .page-header .header-content .header-bottom{z-index:2}
#calendar .page-content #calendar-view.fc .fc-widget-header{border:none;color:rgba(0,0,0,.54)}
#calendar .page-content #calendar-view.fc .fc-widget-header .fc-day-header{text-align:left;border:none;font-weight:500;padding:.8rem}
#calendar .page-content #calendar-view.fc .fc-widget-content{color:rgba(0,0,0,.54)}
#calendar .page-content #calendar-view.fc .fc-widget-content .fc-day-grid-container .fc-day-grid .fc-day-number{text-align:left;padding:.8rem 8px 0 .8rem}
#calendar .page-content #calendar-view.fc .fc-widget-content .fc-time-grid-container{overflow:hidden;height:auto!important}
#calendar .page-content #calendar-view.fc .fc-widget-content .fc-time-grid-container .fc-axis{font-weight:500;border:none}
#calendar .page-content #calendar-view.fc .fc-day-grid-event{margin:.4rem .8rem 0;padding:.2rem .4rem;font-size:1.3rem;color:#fff}
#calendar .page-content #calendar-view.fc .fc-time-grid-event{color:#fff}
#calendar .page-content #calendar-view.fc .fc-agenda-view .fc-widget-header .fc-day-header{border:1px solid #ddd;line-height:5rem;font-size:1.7rem}
#calendar .page-content #calendar-view.fc .fc-agenda-view>table>tbody>tr>td.fc-widget-content{border:none}
#calendar .page-content #calendar-view.fc .fc-agenda-view .fc-minor .fc-widget-content{border-top:none}
#calendar .page-content #calendar-view.fc .fc-agenda-view .fc-day,#calendar .page-content #calendar-view.fc .fc-agenda-view .fc-week{height:10rem!important}
#calendar .page-content #calendar-view.fc .fc-agenda-view .fc-widget-content{height:5rem}
#calendar .page-content #calendar-view.fc .fc-agenda-view .fc-axis{padding-left:2.4rem}
#profile .page-header.Jan{background:url(/storage/assets/images/backgrounds/january25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header.Feb{background:url(/storage/assets/images/backgrounds/february25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header.Mar{background:url(/storage/assets/images/backgrounds/march25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header.Apr{background:url(/storage/assets/images/backgrounds/april25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header.May{background:url(/storage/assets/images/backgrounds/may25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header.Jun{background:url(/storage/assets/images/backgrounds/june25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header.Jul{background:url(/storage/assets/images/backgrounds/july25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header.Aug{background:url(/storage/assets/images/backgrounds/august25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header.Sep{background:url(/storage/assets/images/backgrounds/september25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header.Oct{background:url(/storage/assets/images/backgrounds/october25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header.Nov{background:url(/storage/assets/images/backgrounds/november25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header.Dec{background:url(/storage/assets/images/backgrounds/december25.png) 0 45% no-repeat;background-size:100% auto}

#profile .page-header-custom.Jan{background:url(/storage/assets/images/backgrounds/january25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header-custom.Feb{background:url(/storage/assets/images/backgrounds/february25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header-custom.Mar{background:url(/storage/assets/images/backgrounds/march25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header-custom.Apr{background:url(/storage/assets/images/backgrounds/april25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header-custom.May{background:url(/storage/assets/images/backgrounds/may25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header-custom.Jun{background:url(/storage/assets/images/backgrounds/june25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header-custom.Jul{background:url(/storage/assets/images/backgrounds/july25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header-custom.Aug{background:url(/storage/assets/images/backgrounds/august25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header-custom.Sep{background:url(/storage/assets/images/backgrounds/september25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header-custom.Oct{background:url(/storage/assets/images/backgrounds/october25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header-custom.Nov{background:url(/storage/assets/images/backgrounds/november25.png) 0 45% no-repeat;background-size:100% auto}
#profile .page-header-custom.Dec{background:url(/storage/assets/images/backgrounds/december25.png) 0 45% no-repeat;background-size:100% auto}
#profile #timeline-tab-pane .timeline .timeline-item .post-media .media-img,#profile #timeline-tab-pane .timeline .timeline-item .post-media iframe{max-width:100%}
#profile .photos-videos-tab-pane .period .period-media .media{position:relative;width:200px; max-width:170px;min-width:170px;}
#profile .photos-videos-tab-pane .period .period-media .media .title{position:absolute;bottom:0;left:0;right:0;z-index:10;background:rgba(0,0,0,.54);color:#fff}
#login{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-flex:1;-webkit-flex:1 0 auto;-ms-flex:1 0 auto;flex:1 0 auto;width:100%;min-height:100%;background:url(/storage/assets/images/backgrounds/march.jpg) no-repeat;background-size:cover;background-attachment:fixed;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}
#login .form-wrapper{width:38.4rem;max-width:38.4rem;background:#fff;text-align:center}
#login .form-wrapper .logo{width:12.8rem;height:12.8rem;line-height:12.8rem;font-size:8.6rem;font-weight:500;margin:3.2rem auto;color:#fff;-webkit-border-radius:2px;border-radius:2px}
#login .form-wrapper .title{font-size:1.7rem}
#login .form-wrapper form{width:100%;text-align:left}
#login .form-wrapper form .remember-forgot-password .remember-me{font-size:1.3rem}
#login .form-wrapper form .remember-forgot-password .forgot-password{font-size:1.3rem;font-weight:500}
#login .form-wrapper form .submit-button{width:22rem}
#login .form-wrapper .register{font-weight:500;font-size:1.3rem}
#login .form-wrapper .separator{font-size:1.5rem;font-weight:600;margin:2.4rem auto 1.6rem;position:relative;overflow:hidden;width:10rem;color:rgba(0,0,0,.54);text-align:center}
#login .form-wrapper .separator .text{display:inline-block;vertical-align:baseline;position:relative;padding:0 .8rem;z-index:9999}
#login .form-wrapper .separator .text:after,#login .form-wrapper .separator .text:before{content:'';display:block;width:3rem;position:absolute;top:1rem;border-top:1px solid rgba(0,0,0,.12)}
#login .form-wrapper .separator .text:before{right:100%}
#login .form-wrapper .separator .text:after{left:100%}
#login .form-wrapper .btn.facebook,#login .form-wrapper .btn.google{width:19.2rem;text-transform:none;color:#fff;font-size:1.3rem}
#login .form-wrapper .btn.facebook i,#login .form-wrapper .btn.google i{color:#fff;margin:0 .8rem 0 0}
#login .form-wrapper .btn.google{background-color:#d73d32}
#login .form-wrapper .btn.facebook{background-color:#3f5c9a}
@media (max-width:767px){#login .form-wrapper{padding:1.6rem;padding:2.4rem;width:100%}
#login .form-wrapper form .btn{width:95%}
#login .form-wrapper btn.facebook,#login .form-wrapper btn.google{width:80%}
}
#login-v2{-webkit-box-flex:1;-webkit-flex:1 0 auto;-ms-flex:1 0 auto;flex:1 0 auto;width:100%;height:100%;background:url(/storage/assets/images/backgrounds/march.jpg) no-repeat;background-size:cover;background-attachment:fixed}
#login-v2 .intro .logo{width:12.8rem;height:12.8rem;line-height:12.8rem;font-size:8.6rem;font-weight:500;color:#fff;-webkit-border-radius:2px;border-radius:2px;text-align:center}
#login-v2 .intro .title{font-size:4.2rem;font-weight:300}
#login-v2 .intro .description{font-size:1.4rem;max-width:60rem}
#login-v2 .form-wrapper .form-content{width:41.6rem;max-width:100%}
#login-v2 .form-wrapper .form-content form{width:100%;text-align:left}
#login-v2 .form-wrapper .form-content form .remember-forgot-password .remember-me{font-size:1.3rem}
#login-v2 .form-wrapper .form-content form .remember-forgot-password .forgot-password{font-size:1.3rem;font-weight:500}
#login-v2 .form-wrapper .form-content .register{font-weight:500;font-size:1.3rem}
#login-v2 .form-wrapper .form-content .separator{font-size:1.5rem;font-weight:600;margin:2.4rem auto 1.6rem;position:relative;overflow:hidden;width:10rem;color:rgba(0,0,0,.54);text-align:center}
#login-v2 .form-wrapper .form-content .separator .text{display:inline-block;vertical-align:baseline;position:relative;padding:0 .8rem;z-index:9999}
#login-v2 .form-wrapper .form-content .separator .text:after,#login-v2 .form-wrapper .form-content .separator .text:before{content:'';display:block;width:3rem;position:absolute;top:1rem;border-top:1px solid rgba(0,0,0,.12)}
#login-v2 .form-wrapper .form-content .separator .text:before{right:100%}
#login-v2 .form-wrapper .form-content .separator .text:after{left:100%}
#login-v2 .form-wrapper .form-content .btn.facebook,#login-v2 .form-wrapper .form-content .btn.google{width:19.2rem;text-transform:none;color:#fff;font-size:1.3rem}
#login-v2 .form-wrapper .form-content .btn.facebook i,#login-v2 .form-wrapper .form-content .btn.google i{color:#fff;margin:0 .8rem 0 0}
#login-v2 .form-wrapper .form-content .btn.google{background-color:#d73d32}
#login-v2 .form-wrapper .form-content .btn.facebook{background-color:#3f5c9a}
@media (max-width:767px){#login-v2 .form-wrapper form .btn{width:95%}
#login-v2 .form-wrapper .btn.facebook,#login-v2 .form-wrapper .btn.google{width:80%}
}
#register{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-flex:1;-webkit-flex:1 0 auto;-ms-flex:1 0 auto;flex:1 0 auto;width:100%;min-height:100%;background:url(/storage/assets/images/backgrounds/march.jpg) no-repeat;background-size:cover;background-attachment:fixed;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}
#register .form-wrapper{width:38.4rem;max-width:38.4rem;background:#fff;text-align:center}
#register .form-wrapper .logo{width:12.8rem;height:12.8rem;line-height:12.8rem;font-size:8.6rem;font-weight:500;margin:3.2rem auto;color:#fff;-webkit-border-radius:2px;border-radius:2px}
#register .form-wrapper .title{font-size:1.7rem}
#register .form-wrapper form{width:100%;text-align:left}
#register .form-wrapper form .terms-conditions{font-size:1.3rem}
#register .form-wrapper form .terms-conditions .form-check{font-size:1.3rem}
#register .form-wrapper form .submit-button{width:22rem}
#register .form-wrapper .login{font-weight:500;font-size:1.3rem}
@media (max-width:767px){#register .form-wrapper{padding:1.6rem;width:100%}
#register .form-wrapper form .btn{width:95%}
#register .form-wrapper .btn.facebook,#register .form-wrapper .btn.google{width:80%}
}
#register-v2{-webkit-box-flex:1;-webkit-flex:1 0 auto;-ms-flex:1 0 auto;flex:1 0 auto;width:100%;height:100%;background:url(/storage/assets/images/backgrounds/march.jpg) no-repeat;background-size:cover;background-attachment:fixed}
#register-v2 .intro .logo{width:12.8rem;height:12.8rem;line-height:12.8rem;font-size:8.6rem;font-weight:500;color:#fff;-webkit-border-radius:2px;border-radius:2px;text-align:center}
#register-v2 .intro .title{font-size:4.2rem;font-weight:300}
#register-v2 .intro .description{font-size:1.4rem;max-width:60rem}
#register-v2 .form-wrapper .form-content{width:41.6rem;max-width:100%}
#register-v2 .form-wrapper .form-content .logo{width:12.8rem;height:12.8rem;line-height:12.8rem;font-size:8.6rem;font-weight:500;margin:3.2rem auto;color:#fff;-webkit-border-radius:2px;border-radius:2px}
#register-v2 .form-wrapper .form-content form{width:100%;text-align:left}
#register-v2 .form-wrapper .form-content form .terms-conditions{font-size:1.3rem}
#register-v2 .form-wrapper .form-content form .terms-conditions .form-check{font-size:1.3rem}
#register-v2 .form-wrapper .form-content .login{font-weight:500;font-size:1.3rem}
@media (max-width:767px){#register-v2 .form-wrapper form .btn{width:95%}
#register-v2 .form-wrapper .btn.facebook,#register-v2 .form-wrapper .btn.google{width:80%}
}
#forgot-password{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-flex:1;-webkit-flex:1 0 auto;-ms-flex:1 0 auto;flex:1 0 auto;width:100%;min-height:100%;background:url(/storage/assets/images/backgrounds/march.jpg) no-repeat;background-size:cover;background-attachment:fixed;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}
#forgot-password .form-wrapper{width:38.4rem;max-width:38.4rem;background:#fff;text-align:center}
#forgot-password .form-wrapper .logo{width:12.8rem;height:12.8rem;line-height:12.8rem;font-size:8.6rem;font-weight:500;margin:3.2rem auto;color:#fff;-webkit-border-radius:2px;border-radius:2px}
#forgot-password .form-wrapper .title{font-size:1.7rem}
#forgot-password .form-wrapper form{width:100%;text-align:left}
#forgot-password .form-wrapper form .submit-button{width:22rem}
@media (max-width:767px){#forgot-password .form-wrapper{padding:1.6rem;padding:2.4rem;width:100%}
#forgot-password .form-wrapper form .btn{width:95%}
}
#reset-password{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-flex:1;-webkit-flex:1 0 auto;-ms-flex:1 0 auto;flex:1 0 auto;width:100%;min-height:100%;background:url(/storage/assets/images/backgrounds/march.jpg) no-repeat;background-size:cover;background-attachment:fixed;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}
#reset-password .form-wrapper{width:38.4rem;max-width:38.4rem;background:#fff;text-align:center}
#reset-password .form-wrapper .logo{width:12.8rem;height:12.8rem;line-height:12.8rem;font-size:8.6rem;font-weight:500;margin:3.2rem auto;color:#fff;-webkit-border-radius:2px;border-radius:2px}
#reset-password .form-wrapper .title{font-size:1.7rem}
#reset-password .form-wrapper form{width:100%;text-align:left}
#reset-password .form-wrapper form .submit-button{width:22rem}
@media (max-width:767px){#reset-password .form-wrapper{padding:1.6rem;padding:2.4rem;width:100%}
#reset-password .form-wrapper form .btn{width:95%}
}
#lock-screen{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-flex:1;-webkit-flex:1 0 auto;-ms-flex:1 0 auto;flex:1 0 auto;width:100%;min-height:100%;background:url(/storage/assets/images/backgrounds/march.jpg) no-repeat;background-size:cover;background-attachment:fixed;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}
#lock-screen .form-wrapper{width:38.4rem;max-width:38.4rem;background:#fff}
#lock-screen .form-wrapper .avatar-container{position:relative}
#lock-screen .form-wrapper .avatar-container i{position:absolute;bottom:-4px;right:-6px}
#lock-screen .form-wrapper .title{font-size:1.7rem}
#lock-screen .form-wrapper .subtitle{font-size:1.3rem;color:rgba(0,0,0,.54)}
#lock-screen .form-wrapper form{width:100%;text-align:left}
#lock-screen .form-wrapper form .submit-button{width:22rem}
#lock-screen .form-wrapper .message{font-weight:500}
@media (max-width:767px){#lock-screen .form-wrapper{padding:1.6rem;padding:2.4rem;width:100%}
#lock-screen .form-wrapper form .btn{width:95%}
}
#coming-soon{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;width:100%;min-height:100%;background:url(/storage/assets/images/backgrounds/march.jpg) no-repeat;background-size:cover;background-attachment:fixed;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}
#coming-soon .form-wrapper{width:38.4rem;max-width:38.4rem;background:#fff;text-align:center}
#coming-soon .form-wrapper .logo{width:12.8rem;height:12.8rem;line-height:12.8rem;font-size:8.6rem;font-weight:500;margin:3.2rem auto;color:#fff;-webkit-border-radius:2px;border-radius:2px}
#coming-soon .form-wrapper .title{font-size:1.7rem}
#coming-soon .form-wrapper .subtitle{text-align:center;max-width:30rem;font-size:1.5rem}
#coming-soon .form-wrapper .timer>div{text-align:center}
#coming-soon .form-wrapper .timer>div .value{font-size:3.4rem}
#coming-soon .form-wrapper .timer>div .type{color:rgba(0,0,0,.54)}
#coming-soon .form-wrapper form{width:100%;text-align:left}
#coming-soon .form-wrapper form .message{font-weight:500}
#coming-soon .form-wrapper form .submit-button{width:22rem}
@media (max-width:767px){#coming-soon .form-wrapper{width:100%}
#coming-soon .form-wrapper form .btn{width:95%}
}
#maintenance{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;width:100%;min-height:100%;background:url(/storage/assets/images/backgrounds/march.jpg) no-repeat;background-size:cover;background-attachment:fixed;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center}
#maintenance .form-wrapper{width:38.4rem;max-width:38.4rem;background:#fff;text-align:center}
#maintenance .form-wrapper .logo{width:12.8rem;height:12.8rem;line-height:12.8rem;font-size:8.6rem;font-weight:500;margin:3.2rem auto;color:#fff;-webkit-border-radius:2px;border-radius:2px}
#maintenance .form-wrapper .title{font-size:1.7rem}
#maintenance .form-wrapper .subtitle{text-align:center;max-width:30rem;font-size:1.5rem}
@media (max-width:767px){#maintenance .form-wrapper{padding:1.6rem;padding:2.4rem;width:100%}
}
#error-404{-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1}
#error-404 .content{width:90%;max-width:51.2rem}
#error-404 .content .error-code{font-weight:500}
#error-404 .content .search{height:5.6rem;line-height:5.6rem}
#error-404 .content .search input{background:0 0}
#error-404 .content .back-link{font-size:1.5rem}
#error-500{-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1}
#error-500 .content{width:90%;max-width:51.2rem}
#error-500 .content .error-code{font-weight:500}
#error-500 .content .report-link{font-size:1.5rem}
#search .page-header .search-bar{max-width:78rem}
#search .page-header .search-bar .search-input{font-size:2.4rem}
#search .tab-content .result-info{border-bottom:1px solid rgba(0,0,0,.12)}
#search .tab-content .result-info .pager .page-info{font-weight:500}
#search .tab-content #classic-tab-pane .results{border-bottom:1px solid rgba(0,0,0,.12);max-width:51.2rem}
#search .tab-content #classic-tab-pane .results .result-item .title{font-weight:500;cursor:pointer}
#search .tab-content #classic-tab-pane .results .result-item .url{color:#4caf50}
#search .tab-content #emails-tab-pane .results .result-item{position:relative;max-width:78rem;border-bottom:1px solid rgba(0,0,0,.12)}
#search .tab-content #emails-tab-pane .results .result-item .info{overflow:hidden}
#search .tab-content #emails-tab-pane .results .result-item .info .name{font-size:1.5rem;font-weight:500}
.nvd3-doc #line-chart{height:45rem}
.nvd3-doc #stacked-area-chart{height:45rem}
.nvd3-doc #sparkline-chart{height:45rem}
.nvd3-doc #historical-bar-chart{height:45rem}
.nvd3-doc #multi-bar-horizontal-chart{height:45rem}
.nvd3-doc #pie-chart{height:50rem}
.nvd3-doc #donut-chart{height:25rem}
.nvd3-doc #scatter-chart{height:45rem}
table.dataTable{width:100%!important;margin:0 auto;clear:both;border-collapse:separate;border-spacing:0}
table.dataTable td,table.dataTable th{vertical-align:middle}
table.dataTable tfoot th,table.dataTable thead th{font-weight:700;padding:2rem .8rem}
table.dataTable thead td,table.dataTable thead th{border-bottom:1px solid rgba(0,0,0,.12)}
table.dataTable thead td:active,table.dataTable thead th:active{outline:0}
table.dataTable tfoot td,table.dataTable tfoot th{border-top:1px solid rgba(0,0,0,.12)}
table.dataTable thead th:first-child{padding-left:24px}
table.dataTable thead .sorting,table.dataTable thead .sorting_asc,table.dataTable thead .sorting_desc{background:0 0}
table.dataTable thead .sorting .table-header .column-title,table.dataTable thead .sorting_asc .table-header .column-title,table.dataTable thead .sorting_desc .table-header .column-title{cursor:pointer}
table.dataTable thead .sorting .table-header .column-title:after,table.dataTable thead .sorting_asc .table-header .column-title:after,table.dataTable thead .sorting_desc .table-header .column-title:after{position:relative;font-weight:400;margin-left:10px;top:2px;font-size:16px}
table.dataTable thead .sorting .table-header .column-title:after{content:'\ef55'}
table.dataTable thead .sorting_asc .table-header .column-title:after{content:'\ef51'}
table.dataTable thead .sorting_desc .table-header .column-title:after{content:'\ef52'}
table.dataTable thead .sorting_asc:before,table.dataTable thead .sorting_desc:after{opacity:1}
table.dataTable thead .sorting_asc_disabled:before,table.dataTable thead .sorting_desc_disabled:after{opacity:0}
table.dataTable tbody tr{background-color:transparent}
table.dataTable tbody tr.selected{background-color:#b0bed9;color:rgba(0,0,0,.87)}
table.dataTable tbody tr td:first-child{padding-left:24px}
table.dataTable tbody td,table.dataTable tbody th{padding:16px 8px}
table.dataTable.display tbody td,table.dataTable.display tbody th,table.dataTable.row-border tbody td,table.dataTable.row-border tbody th{border-top:1px solid rgba(0,0,0,.12)}
table.dataTable.display tbody tr:first-child td,table.dataTable.display tbody tr:first-child th,table.dataTable.row-border tbody tr:first-child td,table.dataTable.row-border tbody tr:first-child th{border-top:none}
table.dataTable.cell-border tbody td,table.dataTable.cell-border tbody th{border-top:1px solid rgba(0,0,0,.12);border-right:1px solid rgba(0,0,0,.12)}
table.dataTable.cell-border tbody tr td:first-child,table.dataTable.cell-border tbody tr th:first-child{border-left:1px solid rgba(0,0,0,.12)}
table.dataTable.cell-border tbody tr:first-child td,table.dataTable.cell-border tbody tr:first-child th{border-top:none}
table.dataTable.display tbody tr.odd,table.dataTable.stripe tbody tr.odd{background-color:rgba(0,0,0,.0235)}
table.dataTable.display tbody tr.odd.selected,table.dataTable.stripe tbody tr.odd.selected{background-color:#acbad4}
table.dataTable.display tbody tr:hover,table.dataTable.hover tbody tr:hover{background-color:rgba(0,0,0,.036)}
table.dataTable.display tbody tr:hover.selected,table.dataTable.hover tbody tr:hover.selected{background-color:#aab7d1}
table.dataTable.display tbody tr>.sorting_1,table.dataTable.display tbody tr>.sorting_2,table.dataTable.display tbody tr>.sorting_3,table.dataTable.order-column tbody tr>.sorting_1,table.dataTable.order-column tbody tr>.sorting_2,table.dataTable.order-column tbody tr>.sorting_3{background-color:rgba(0,0,0,.02)}
table.dataTable.display tbody tr.selected>.sorting_1,table.dataTable.display tbody tr.selected>.sorting_2,table.dataTable.display tbody tr.selected>.sorting_3,table.dataTable.order-column tbody tr.selected>.sorting_1,table.dataTable.order-column tbody tr.selected>.sorting_2,table.dataTable.order-column tbody tr.selected>.sorting_3{background-color:#acbad5}
table.dataTable.display tbody tr.odd>.sorting_1,table.dataTable.order-column.stripe tbody tr.odd>.sorting_1{background-color:rgba(0,0,0,.054)}
table.dataTable.display tbody tr.odd>.sorting_2,table.dataTable.order-column.stripe tbody tr.odd>.sorting_2{background-color:rgba(0,0,0,.047)}
table.dataTable.display tbody tr.odd>.sorting_3,table.dataTable.order-column.stripe tbody tr.odd>.sorting_3{background-color:rgba(0,0,0,.039)}
table.dataTable.display tbody tr.odd.selected>.sorting_1,table.dataTable.order-column.stripe tbody tr.odd.selected>.sorting_1{background-color:#a6b4cd}
table.dataTable.display tbody tr.odd.selected>.sorting_2,table.dataTable.order-column.stripe tbody tr.odd.selected>.sorting_2{background-color:#a8b5cf}
table.dataTable.display tbody tr.odd.selected>.sorting_3,table.dataTable.order-column.stripe tbody tr.odd.selected>.sorting_3{background-color:#a9b7d1}
table.dataTable.display tbody tr.even>.sorting_1,table.dataTable.order-column.stripe tbody tr.even>.sorting_1{background-color:rgba(0,0,0,.02)}
table.dataTable.display tbody tr.even>.sorting_2,table.dataTable.order-column.stripe tbody tr.even>.sorting_2{background-color:rgba(0,0,0,.012)}
table.dataTable.display tbody tr.even>.sorting_3,table.dataTable.order-column.stripe tbody tr.even>.sorting_3{background-color:rgba(0,0,0,.004)}
table.dataTable.display tbody tr.even.selected>.sorting_1,table.dataTable.order-column.stripe tbody tr.even.selected>.sorting_1{background-color:#acbad5}
table.dataTable.display tbody tr.even.selected>.sorting_2,table.dataTable.order-column.stripe tbody tr.even.selected>.sorting_2{background-color:#aebcd6}
table.dataTable.display tbody tr.even.selected>.sorting_3,table.dataTable.order-column.stripe tbody tr.even.selected>.sorting_3{background-color:#afbdd8}
table.dataTable.display tbody tr:hover>.sorting_1,table.dataTable.order-column.hover tbody tr:hover>.sorting_1{background-color:rgba(0,0,0,.082)}
table.dataTable.display tbody tr:hover>.sorting_2,table.dataTable.order-column.hover tbody tr:hover>.sorting_2{background-color:rgba(0,0,0,.075)}
table.dataTable.display tbody tr:hover>.sorting_3,table.dataTable.order-column.hover tbody tr:hover>.sorting_3{background-color:rgba(0,0,0,.063)}
table.dataTable.display tbody tr:hover.selected>.sorting_1,table.dataTable.order-column.hover tbody tr:hover.selected>.sorting_1{background-color:#a2aec7}
table.dataTable.display tbody tr:hover.selected>.sorting_2,table.dataTable.order-column.hover tbody tr:hover.selected>.sorting_2{background-color:#a3b0c9}
table.dataTable.display tbody tr:hover.selected>.sorting_3,table.dataTable.order-column.hover tbody tr:hover.selected>.sorting_3{background-color:#a5b2cb}
table.dataTable.no-footer{border-bottom:1px solid rgba(0,0,0,.12)}
table.dataTable.nowrap td,table.dataTable.nowrap th{white-space:nowrap}
table.dataTable.compact thead td,table.dataTable.compact thead th{padding:4px 17px 4px 4px}
table.dataTable.compact tfoot td,table.dataTable.compact tfoot th{padding:4px}
table.dataTable.compact tbody td,table.dataTable.compact tbody th{padding:4px}
table.dataTable td.dt-left,table.dataTable th.dt-left{text-align:left}
table.dataTable td.dataTables_empty,table.dataTable td.dt-center,table.dataTable th.dt-center{text-align:center}
table.dataTable td.dt-right,table.dataTable th.dt-right{text-align:right}
table.dataTable td.dt-justify,table.dataTable th.dt-justify{text-align:justify}
table.dataTable td.dt-nowrap,table.dataTable th.dt-nowrap{white-space:nowrap}
table.dataTable tfoot td.dt-head-left,table.dataTable tfoot th.dt-head-left,table.dataTable thead td.dt-head-left,table.dataTable thead th.dt-head-left{text-align:left}
table.dataTable tfoot td.dt-head-center,table.dataTable tfoot th.dt-head-center,table.dataTable thead td.dt-head-center,table.dataTable thead th.dt-head-center{text-align:center}
table.dataTable tfoot td.dt-head-right,table.dataTable tfoot th.dt-head-right,table.dataTable thead td.dt-head-right,table.dataTable thead th.dt-head-right{text-align:right}
table.dataTable tfoot td.dt-head-justify,table.dataTable tfoot th.dt-head-justify,table.dataTable thead td.dt-head-justify,table.dataTable thead th.dt-head-justify{text-align:justify}
table.dataTable tfoot td.dt-head-nowrap,table.dataTable tfoot th.dt-head-nowrap,table.dataTable thead td.dt-head-nowrap,table.dataTable thead th.dt-head-nowrap{white-space:nowrap}
table.dataTable tbody td.dt-body-left,table.dataTable tbody th.dt-body-left{text-align:left}
table.dataTable tbody td.dt-body-center,table.dataTable tbody th.dt-body-center{text-align:center}
table.dataTable tbody td.dt-body-right,table.dataTable tbody th.dt-body-right{text-align:right}
table.dataTable tbody td.dt-body-justify,table.dataTable tbody th.dt-body-justify{text-align:justify}
table.dataTable tbody td.dt-body-nowrap,table.dataTable tbody th.dt-body-nowrap{white-space:nowrap}
table.dataTable,table.dataTable td,table.dataTable th{-webkit-box-sizing:content-box;box-sizing:content-box}
.dataTables_wrapper{position:relative;clear:both;zoom:1}
.dataTables_wrapper .row{width:100%;margin:0}
.dataTables_wrapper .row [class*=" col-"],.dataTables_wrapper .row [class^=col]{padding:0}
.dataTables_wrapper .dataTables_length{float:left}
.dataTables_wrapper .dataTables_length select{margin:0 1.2rem;border:1px solid rgba(0,0,0,.12);padding:4px 8px}
.dataTables_wrapper .dataTables_filter{float:right;text-align:right}
.dataTables_wrapper .dataTables_filter input{margin-left:.5em;border:1px solid rgba(0,0,0,.12);padding:4px 8px}
.dataTables_wrapper .dataTables_filter input[type=search]{-webkit-border-radius:3px;border-radius:3px}
.dataTables_wrapper .dataTables_filter,.dataTables_wrapper .dataTables_length{padding:0 .8rem;height:6.4rem;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center}
.dataTables_wrapper .dataTables_info{height:6.4rem;line-height:6.4rem;padding:0 .8rem;float:left;font-weight:600}
.dataTables_wrapper .pagination{-webkit-box-shadow:none;box-shadow:none}
.dataTables_wrapper .dataTables_paginate{padding:0 .8rem;height:6.4rem;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;float:right}
.dataTables_wrapper .dataTables_paginate>.pagination{margin:0}
.dataTables_wrapper .dataTables_paginate .paginate_button{-webkit-box-sizing:border-box;box-sizing:border-box;display:inline-block;min-width:1.5em;padding:.5em 1em;margin-left:2px;text-align:center;text-decoration:none!important;cursor:pointer;color:inherit!important;border:1px solid transparent;-webkit-border-radius:2px;border-radius:2px}
.dataTables_wrapper .dataTables_paginate .paginate_button.current,.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{color:inherit!important;border:1px solid #979797}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled,.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active,.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover{cursor:default;color:#666!important;border:1px solid transparent;background:0 0;-webkit-box-shadow:none;box-shadow:none}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover{color:inherit!important;border:1px solid #111}
.dataTables_wrapper .dataTables_paginate .paginate_button:active{outline:0;-webkit-box-shadow:inset 0 0 3px #111;box-shadow:inset 0 0 3px #111}
.dataTables_wrapper .dataTables_paginate .ellipsis{padding:0 1em}
.dataTables_wrapper .dataTables_processing{position:absolute;top:50%;left:50%;width:100%;height:40px;margin-left:-50%;margin-top:-25px;padding-top:20px;text-align:center;font-size:1.2em;background-color:#fff;background:-webkit-gradient(linear,left top,right top,color-stop(0,transparent),color-stop(25%,rgba(0,0,0,.9)),color-stop(75%,rgba(0,0,0,.9)),color-stop(100%,rgba(255,255,255,0)));background:-webkit-linear-gradient(left,transparent 0,rgba(0,0,0,.9) 25%,rgba(0,0,0,.9) 75%,transparent 100%);background:-webkit-gradient(linear,left top,right top,from(transparent),color-stop(25%,rgba(0,0,0,.9)),color-stop(75%,rgba(0,0,0,.9)),to(transparent));background:linear-gradient(to right,transparent 0,rgba(0,0,0,.9) 25%,rgba(0,0,0,.9) 75%,transparent 100%)}
.dataTables_wrapper .dataTables_scroll{clear:both}
.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody{-webkit-overflow-scrolling:touch}
.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>tbody>tr>td,.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>tbody>tr>th,.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>thead>tr>td,.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>thead>tr>th{vertical-align:middle}
.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>tbody>tr>td>div.dataTables_sizing,.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>tbody>tr>th>div.dataTables_sizing,.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>thead>tr>td>div.dataTables_sizing,.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>thead>tr>th>div.dataTables_sizing{height:0;overflow:hidden;margin:0!important;padding:0!important}
.dataTables_wrapper.no-footer .dataTables_scrollBody{border-bottom:1px solid rgba(0,0,0,.12)}
.dataTables_wrapper.no-footer div.dataTables_scrollBody>table,.dataTables_wrapper.no-footer div.dataTables_scrollHead>table{border-bottom:none}
.dataTables_wrapper:after{visibility:hidden;display:block;content:"";clear:both;height:0}
@media (max-width:1199px){.dataTables_wrapper .dataTables_info,.dataTables_wrapper .dataTables_paginate{float:none;text-align:center}
.dataTables_wrapper .dataTables_paginate{margin-top:.5em}
}
@media (max-width:767px){.dataTables_wrapper .dataTables_filter,.dataTables_wrapper .dataTables_length{float:none;text-align:center}
.dataTables_wrapper .dataTables_filter{margin-top:.5em}
}
table.dataTable.dtr-inline.collapsed>tbody>tr>td.child,table.dataTable.dtr-inline.collapsed>tbody>tr>td.dataTables_empty,table.dataTable.dtr-inline.collapsed>tbody>tr>th.child{cursor:default!important}
table.dataTable.dtr-inline.collapsed>tbody>tr>td.child:before,table.dataTable.dtr-inline.collapsed>tbody>tr>td.dataTables_empty:before,table.dataTable.dtr-inline.collapsed>tbody>tr>th.child:before{display:none!important}
table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child,table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child{position:relative;padding-left:40px;cursor:pointer}
table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before{top:9px;left:4px;height:15px;line-height:15px;width:15px;display:block;position:absolute;color:#fff;-webkit-box-sizing:content-box;box-sizing:content-box;text-align:center;-webkit-border-radius:50%;border-radius:50%;top:50%;margin-top:-7px;left:8px;color:rgba(0,0,0,.54);background:0 0;border:none;-webkit-box-shadow:0 0 0 2px rgba(0,0,0,.54);box-shadow:0 0 0 2px rgba(0,0,0,.54);font-weight:700;content:'+';background-color:transparent}
table.dataTable.dtr-inline.collapsed>tbody>tr.parent>td:first-child:before,table.dataTable.dtr-inline.collapsed>tbody>tr.parent>th:first-child:before{content:'-';background-color:transparent}
table.dataTable.dtr-inline.collapsed>tbody>tr.child ul{display:block}
table.dataTable.dtr-inline.collapsed>tbody>tr.child ul li{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:start;-webkit-justify-content:flex-start;-ms-flex-pack:start;justify-content:flex-start;border-bottom:1px solid rgba(0,0,0,.12);padding:8px 0}
table.dataTable.dtr-inline.collapsed>tbody>tr.child ul li:first-child{padding-top:0}
table.dataTable.dtr-inline.collapsed>tbody>tr.child ul li:last-child{border-bottom:none;padding-bottom:0}
table.dataTable.dtr-inline.collapsed>tbody>tr.child ul li .dtr-title{margin-right:8px}
table.dataTable.dtr-inline.collapsed>tbody>tr.child td:before{display:none}
table.dataTable.dtr-inline.collapsed.compact>tbody>tr>td:first-child,table.dataTable.dtr-inline.collapsed.compact>tbody>tr>th:first-child{padding-left:27px}
table.dataTable.dtr-inline.collapsed.compact>tbody>tr>td:first-child:before,table.dataTable.dtr-inline.collapsed.compact>tbody>tr>th:first-child:before{top:5px;left:4px;height:14px;width:14px;-webkit-border-radius:14px;border-radius:14px;line-height:14px;text-indent:3px}
table.dataTable.dtr-column>tbody>tr>td.control,table.dataTable.dtr-column>tbody>tr>th.control{position:relative;cursor:pointer}
table.dataTable.dtr-column>tbody>tr>td.control:before,table.dataTable.dtr-column>tbody>tr>th.control:before{top:50%;left:50%;height:16px;width:16px;margin-top:-10px;margin-left:-10px;display:block;position:absolute;color:#fff;-webkit-box-sizing:content-box;box-sizing:content-box;text-align:center;-webkit-border-radius:50%;border-radius:50%;top:50%;margin-top:-7px;left:8px;color:rgba(0,0,0,.54);background:0 0;border:none;-webkit-box-shadow:0 0 0 2px rgba(0,0,0,.54);box-shadow:0 0 0 2px rgba(0,0,0,.54);font-weight:700;content:'+';background-color:transparent}
table.dataTable.dtr-column>tbody>tr.parent td.control:before,table.dataTable.dtr-column>tbody>tr.parent th.control:before{content:'-';background-color:transparent}
table.dataTable>tbody>tr.child{padding:.5em 1em}
table.dataTable>tbody>tr.child:hover{background:0 0!important}
table.dataTable>tbody>tr.child ul.dtr-details{display:inline-block;list-style-type:none;margin:0;padding:0}
table.dataTable>tbody>tr.child ul.dtr-details li{border-bottom:1px solid #efefef;padding:.5em 0}
table.dataTable>tbody>tr.child ul.dtr-details li:first-child{padding-top:0}
table.dataTable>tbody>tr.child ul.dtr-details li:last-child{border-bottom:none}
table.dataTable>tbody>tr.child span.dtr-title{display:inline-block;min-width:75px;font-weight:700}
div.dtr-modal{position:fixed;-webkit-box-sizing:border-box;box-sizing:border-box;top:0;left:0;height:100%;width:100%;z-index:100;padding:10em 1em}
div.dtr-modal div.dtr-modal-display{position:absolute;top:0;left:0;bottom:0;right:0;width:50%;height:50%;overflow:auto;margin:auto;z-index:102;overflow:auto;background-color:#f5f5f7;border:1px solid #000;-webkit-border-radius:.5em;border-radius:.5em;-webkit-box-shadow:0 12px 30px rgba(0,0,0,.6);box-shadow:0 12px 30px rgba(0,0,0,.6)}
div.dtr-modal div.dtr-modal-content{position:relative;padding:1em}
div.dtr-modal div.dtr-modal-close{position:absolute;top:6px;right:6px;width:22px;height:22px;border:1px solid #eaeaea;background-color:#f9f9f9;text-align:center;-webkit-border-radius:3px;border-radius:3px;cursor:pointer;z-index:12}
div.dtr-modal div.dtr-modal-close:hover{background-color:#eaeaea}
div.dtr-modal div.dtr-modal-background{position:fixed;top:0;left:0;right:0;bottom:0;z-index:101;background:rgba(0,0,0,.6)}
@media screen and (max-width:767px){div.dtr-modal div.dtr-modal-display{width:95%}
}
body #aside .aside-toolbar{-webkit-transition:padding .3s ease;transition:padding .3s ease}
@media (min-width:992px){body.layout-below-toolbar.layout-left-navigation.fuse-aside-collapsed #wrapper>.content-wrapper #toolbar{left:6.4rem!important}
}
@media (max-width:991px){body.layout-below-toolbar.layout-left-navigation #wrapper>.content-wrapper #toolbar{left:0!important}
.smmt40{padding-top:90px}
}
@media (min-width:992px){body.layout-below-toolbar.layout-right-navigation.fuse-aside-collapsed #wrapper>.content-wrapper #toolbar{right:6.4rem!important}
}
@media (max-width:991px){body.layout-below-toolbar.layout-right-navigation #wrapper>.content-wrapper #toolbar{right:0!important}
}
body.fuse-aside-collapsed #aside .aside-content-wrapper,body.fuse-aside-collapsed #aside .aside-content-wrapper>.aside-content{width:6.4rem!important;min-width:6.4rem!important}
body.fuse-aside-collapsed #aside .aside-content-wrapper>.aside-content>.aside-toolbar{padding-left:1.6rem!important}
body.fuse-aside-collapsed #aside #sidenav .subheader:before{content:'';display:block;position:absolute;min-width:1.6rem;border-top:2px solid rgba(0,0,0,.12)}
body.fuse-aside-collapsed #aside #sidenav .subheader>span{opacity:0;-webkit-transition:opacity .2s ease;transition:opacity .2s ease}
body.fuse-aside-collapsed #aside #sidenav .nav-link>span{opacity:0;-webkit-transition:opacity .2s ease;transition:opacity .2s ease}
body.fuse-aside-collapsed #aside #sidenav .nav-item .collapse.show{display:none}
body.fuse-aside-expanded.layout-left-navigation #aside .aside-content-wrapper{margin-left:0}
body.fuse-aside-expanded.layout-right-navigation #aside .aside-content-wrapper{margin-right:0}
body.fuse-aside-expanded #sidenav .subheader>span{opacity:1}
body.fuse-aside-expanded #sidenav .nav-link>span{opacity:1}
body.fuse-aside-folded #aside{width:6.4rem}
body.fuse-aside-folded #aside .aside-content-wrapper{position:absolute}
body.layout-left-navigation #aside .aside-content-wrapper>.aside-content{left:0}
body.layout-left-navigation #toggle-fold-aside-button{-webkit-transform:rotate(0);-ms-transform:rotate(0);transform:rotate(0)}
body.layout-left-navigation.fuse-aside-folded #toggle-fold-aside-button{-webkit-transform:rotate(180deg);-ms-transform:rotate(180deg);transform:rotate(180deg)}
body.layout-right-navigation #aside .aside-content-wrapper>.aside-content{right:0}
body.layout-right-navigation #toggle-fold-aside-button{-webkit-transform:rotate(180deg);-ms-transform:rotate(180deg);transform:rotate(180deg)}
body.layout-right-navigation.fuse-aside-folded #toggle-fold-aside-button{-webkit-transform:rotate(0);-ms-transform:rotate(0);transform:rotate(0)}
body #toggle-fold-aside-button{-webkit-transition:-webkit-transform .3s ease-in-out .1s;transition:-webkit-transform .3s ease-in-out .1s;transition:transform .3s ease-in-out .1s;transition:transform .3s ease-in-out .1s,-webkit-transform .3s ease-in-out .1s}
.custom-scrollbar{position:relative}
nvd3{display:block;width:100%;height:100%}
nvd3.remove-x-lines .nv-x .tick line{display:none}
nvd3.remove-y-lines .nv-y .tick line{display:none}
nvd3.remove-line-stroke .nv-groups path.nv-line{stroke-width:0!important}
nvd3.remove-opacity .nv-groups .nv-group{fill-opacity:1!important}
nvd3.show-line-points .nv-line .nv-scatter .nv-groups .nv-point{fill-opacity:1!important;stroke-opacity:1!important}
.nvd3 line.nv-guideline{stroke:rgba(0,0,0,.54)}
.nvd3 .nv-groups .nv-point.hover{stroke-width:3px!important;fill-opacity:1!important;stroke-opacity:1!important}
.nvtooltip{background:0 0;color:#fff;padding:0;border:none}
.nvtooltip.gravity-n:after{display:block;position:absolute;content:'';width:0;height:0;left:50%;bottom:100%;margin-left:-5px;border:5px solid transparent;border-bottom-color:rgba(0,0,0,.87)}
.nvtooltip.gravity-s:after{display:block;position:absolute;content:'';width:0;height:0;top:100%;left:50%;margin-left:-5px;border:5px solid transparent;border-top-color:rgba(0,0,0,.87)}
.nvtooltip.gravity-e:after{display:block;position:absolute;content:'';width:0;height:0;top:50%;right:0;margin-top:-6px;margin-right:-11px;border:6px solid transparent;border-left-color:rgba(0,0,0,.87)}
.nvtooltip.gravity-w:after{display:block;position:absolute;content:'';width:0;height:0;top:50%;margin-top:-6px;margin-left:-11px;border:6px solid transparent;border-right-color:rgba(0,0,0,.87)}
.nvtooltip table{background:rgba(0,0,0,.87);padding:8px 12px;margin:0;-webkit-border-radius:2px;border-radius:2px;border-collapse:initial}
.nvtooltip table tbody tr td.legend-color-guide div{border:none}
.nvtooltip table tbody tr td:last-child{padding-right:0}


.modal-dialog-centered{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center;min-height:calc(100% - (.5rem * 2))}
.modal-dialog-centered{min-height:calc(100% - (1.75rem * 2))}


.fuse-ripple-ready{position:relative;overflow:hidden;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-tap-highlight-color:transparent}.fuse-ripple{position:absolute;border-radius:50%;top:0;left:0;opacity:0;background:rgba(0,0,0,.12);pointer-events:none}.fuse-ripple-input-wrapper .fuse-ripple-input{padding:0;-webkit-appearance:none;border:none;font-style:inherit;outline:0;background:0 0;color:inherit}.no-ripple .fuse-ripple{display:none!important;visibility:hidden!important;opacity:0!important}[data-fuse-bar].fuse-bar{position:absolute!important;box-shadow:0 0 12px 0 rgba(0,0,0,.25);z-index:1021;display:block;text-align:left;overflow:auto;transition:transform .3s ease;display:block;background-color:#fff}[data-fuse-bar].fuse-bar.fuse-bar-open{visibility:visible;opacity:1}[data-fuse-bar].fuse-bar.fuse-bar-closed{visibility:hidden;opacity:0}[data-fuse-bar].fuse-bar.fixed-position{position:fixed}[data-fuse-bar].fuse-bar.position-bottom,[data-fuse-bar].fuse-bar.position-top{max-height:100%}[data-fuse-bar].fuse-bar.position-left,[data-fuse-bar].fuse-bar.position-right{max-width:90%}[data-fuse-bar].fuse-bar.position-right{top:0;bottom:0;right:0;left:auto;transform:translate3D(100%,0,0)}[data-fuse-bar].fuse-bar.position-left{top:0;bottom:0;left:0;right:auto;transform:translate3D(-100%,0,0)}[data-fuse-bar].fuse-bar.position-top{top:0;bottom:auto;left:0;right:0;transform:translate3D(0,-100%,0)}[data-fuse-bar].fuse-bar.position-bottom{top:auto;bottom:0;left:0;right:0;transform:translate3D(0,100%,0)}.fuse-bar-backdrop{position:absolute;top:0;right:0;left:0;bottom:0;z-index:1020;background:rgba(0,0,0,.54)}@media (max-width:767px){[data-fuse-bar-media-step=sm]{position:absolute!important;visibility:hidden}}@media (max-width:991px){[data-fuse-bar-media-step=md]{position:absolute!important;visibility:hidden}}@media (max-width:1199px){[data-fuse-bar-media-step=lg]{position:absolute!important;visibility:hidden}}

</style>