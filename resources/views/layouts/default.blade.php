<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>@section('title') Coord @show</title>
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
</head>


<body class="layout layout-vertical layout-left-navigation layout-below-toolbar">

  <div id="wrapper">

    @include('layouts/default_menu')

    <div class="content-wrapper">

      @include('layouts/default_toolbar')

      <div class="content">

        @yield('content')

      </div>

    </div>

  </div>
  
@include('include/modal')
@include('include/message_modal')

@include('layouts/default_js')
@include('include/message_js')

@yield('footer_scripts')

@include('notifications')
<?php include_once(base_path().'/public/analyticstracking.php') ?>
</body>
</html>
