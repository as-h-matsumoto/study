<?php
if( isset($_SERVER['HTTP_USER_AGENT']) ){
    $browser = strtolower($_SERVER['HTTP_USER_AGENT']);
    // ユーザーエージェントの情報を基に判定
    $browser_check = false;
    if (strstr($browser , 'edge')) {
        //logger('ご使用のブラウザはEdgeです。');
    } elseif (strstr($browser , 'trident') || strstr($browser , 'msie')) {
        echo '<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>';
        //logger('ご使用のブラウザはInternet Explorerです。');
        //header('Location: //www.coordiy.com/cmn/browser');
        $browser_check = true;
    } elseif (strstr($browser , 'chrome')) {
        //echo('ご使用のブラウザはGoogle Chromeです。');
    } elseif (strstr($browser , 'firefox')) {
        //echo('ご使用のブラウザはFirefoxです。');
    } elseif (strstr($browser , 'safari')) {
        //echo('ご使用のブラウザはSafariです。');
    } elseif (strstr($browser , 'opera')) {
        //echo('ご使用のブラウザはOperaです。');
    } else {
        $browser_check = true;
        //echo('知らん。');
        //header('Location: //www.coordiy.com/cmn/browser');
    }
}
?>
@if($browser_check)
  <div class="center p-6 text-warning h3">
    <p>このブラウザーは対応していません。<p>
    <p><a href="/cmn/browser" class="text-blue-300">こちら</a>を確認いただき、対応しているブラウザーをご利用ください。<p>
  </div>
@endif