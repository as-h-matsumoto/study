<?php
$tmp = explode('?',$_SERVER["REQUEST_URI"]);
$GLOBALS['urls'] = explode('/',$tmp[0]);
if(!isset($GLOBALS['urls'][1])){
  $GLOBALS['urls'][1]=null;
}
if(!isset($GLOBALS['urls'][2])){
  $GLOBALS['urls'][2]=null;
}
if(!isset($GLOBALS['urls'][3])){
  $GLOBALS['urls'][3]=null;
}
if(!isset($GLOBALS['urls'][4])){
  $GLOBALS['urls'][4]=null;
}
if(!isset($GLOBALS['urls'][5])){
  $GLOBALS['urls'][5]=null;
}
if(!isset($GLOBALS['urls'][6])){
  $GLOBALS['urls'][6]=null;
}
?>