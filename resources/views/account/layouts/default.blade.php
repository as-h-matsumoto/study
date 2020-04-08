@include('layouts/mustFirst')
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>@section('title') coord @show</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta http-equiv="content-style-type" content="text/css">
<meta http-equiv="content-script-type" content="text/javascript">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta name="csrf-token" content="{{ csrf_token() }}" />

@yield('meta')

<link rel="alternate" hreflang="ja" />

@include('layouts/default_css')

<!-- header_styles -->
@yield('header_styles')

<link rel="shortcut icon" href="/storage/global/img/favicon.ico"/>
<link rel="icon" href="/storage/global/img/favicon.ico" />
@include('include/question_learning_space_css')
</head>


<body class="layout layout-vertical layout-left-navigation layout-below-toolbar @if( ($GLOBALS['urls'][3] == 'master' and is_numeric($GLOBALS['urls'][4])) or ($GLOBALS['urls'][4] == 'master' and is_numeric($GLOBALS['urls'][5])) ) fuse-aside-folded fuse-aside-collapsed @endif ">

  <div id="wrapper">

  @include('account/layouts/account_menu')

    <div class="content-wrapper">

      @include('account/layouts/default_toolbar')

      <div class="content">
      
        @yield('content')

      </div>

    </div>

  </div>
  
@include('include/modal')
@include('include/message_modal')
@include('include/recommend_modal')

@include('layouts/default_js')
@include('include/message_js')
@include('include/recommend_js')

@yield('footer_scripts')
@include('include/quick')

@include('notifications')
<?php include_once(base_path().'/public/analyticstracking.php') ?>
</body>
</html>
