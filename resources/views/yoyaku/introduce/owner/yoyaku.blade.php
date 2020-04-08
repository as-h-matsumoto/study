@extends('yoyaku/layouts/default')

{{-- Page title --}}
@section('title') 特化型予約管理サービス @stop


@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="Coordiy予約は完全無料の特化型予約管理サイトです。飲食店、遊び、レッスン・学び、スパ・エステサロン、ツアー、チケット、ヘアーサロン、旅館・ホテル、スタジオ、会議室、求人面接などの予約管理ができます。">
<meta name="keywords" content="予約,予約管理,Coordiy予約">
<meta property="og:site_name" content="Coordiy予約">
<meta property="og:title" content="特化型予約管理サービス">
<meta property="og:description" content="Coordiy予約は完全無料の特化型予約管理サイトです。飲食店、遊び、レッスン・学び、スパ・エステサロン、ツアー、チケット、ヘアーサロン、旅館・ホテル、スタジオ、会議室、求人面接などの予約管理ができます。">
<meta property="og:image" content="/storage/assets/img/yoyaku_logo_1600.png">
<meta property="og:url" content="{!!$_SERVER['HTTP_HOST']!!}">
<meta property="og:locale" content="ja_JP">
<meta property="og:type" content="website">
@stop

{{-- page level styles --}}
@section('header_styles')
<style>
[data-aos][data-aos][data-aos-duration='50'],body[data-aos-duration='50'] [data-aos]{transition-duration:50ms}[data-aos][data-aos][data-aos-delay='50'],body[data-aos-delay='50'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='50'].aos-animate,body[data-aos-delay='50'] [data-aos].aos-animate{transition-delay:50ms}[data-aos][data-aos][data-aos-duration='100'],body[data-aos-duration='100'] [data-aos]{transition-duration:.1s}[data-aos][data-aos][data-aos-delay='100'],body[data-aos-delay='100'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='100'].aos-animate,body[data-aos-delay='100'] [data-aos].aos-animate{transition-delay:.1s}[data-aos][data-aos][data-aos-duration='150'],body[data-aos-duration='150'] [data-aos]{transition-duration:.15s}[data-aos][data-aos][data-aos-delay='150'],body[data-aos-delay='150'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='150'].aos-animate,body[data-aos-delay='150'] [data-aos].aos-animate{transition-delay:.15s}[data-aos][data-aos][data-aos-duration='200'],body[data-aos-duration='200'] [data-aos]{transition-duration:.2s}[data-aos][data-aos][data-aos-delay='200'],body[data-aos-delay='200'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='200'].aos-animate,body[data-aos-delay='200'] [data-aos].aos-animate{transition-delay:.2s}[data-aos][data-aos][data-aos-duration='250'],body[data-aos-duration='250'] [data-aos]{transition-duration:.25s}[data-aos][data-aos][data-aos-delay='250'],body[data-aos-delay='250'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='250'].aos-animate,body[data-aos-delay='250'] [data-aos].aos-animate{transition-delay:.25s}[data-aos][data-aos][data-aos-duration='300'],body[data-aos-duration='300'] [data-aos]{transition-duration:.3s}[data-aos][data-aos][data-aos-delay='300'],body[data-aos-delay='300'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='300'].aos-animate,body[data-aos-delay='300'] [data-aos].aos-animate{transition-delay:.3s}[data-aos][data-aos][data-aos-duration='350'],body[data-aos-duration='350'] [data-aos]{transition-duration:.35s}[data-aos][data-aos][data-aos-delay='350'],body[data-aos-delay='350'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='350'].aos-animate,body[data-aos-delay='350'] [data-aos].aos-animate{transition-delay:.35s}[data-aos][data-aos][data-aos-duration='400'],body[data-aos-duration='400'] [data-aos]{transition-duration:.4s}[data-aos][data-aos][data-aos-delay='400'],body[data-aos-delay='400'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='400'].aos-animate,body[data-aos-delay='400'] [data-aos].aos-animate{transition-delay:.4s}[data-aos][data-aos][data-aos-duration='450'],body[data-aos-duration='450'] [data-aos]{transition-duration:.45s}[data-aos][data-aos][data-aos-delay='450'],body[data-aos-delay='450'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='450'].aos-animate,body[data-aos-delay='450'] [data-aos].aos-animate{transition-delay:.45s}[data-aos][data-aos][data-aos-duration='500'],body[data-aos-duration='500'] [data-aos]{transition-duration:.5s}[data-aos][data-aos][data-aos-delay='500'],body[data-aos-delay='500'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='500'].aos-animate,body[data-aos-delay='500'] [data-aos].aos-animate{transition-delay:.5s}[data-aos][data-aos][data-aos-duration='550'],body[data-aos-duration='550'] [data-aos]{transition-duration:.55s}[data-aos][data-aos][data-aos-delay='550'],body[data-aos-delay='550'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='550'].aos-animate,body[data-aos-delay='550'] [data-aos].aos-animate{transition-delay:.55s}[data-aos][data-aos][data-aos-duration='600'],body[data-aos-duration='600'] [data-aos]{transition-duration:.6s}[data-aos][data-aos][data-aos-delay='600'],body[data-aos-delay='600'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='600'].aos-animate,body[data-aos-delay='600'] [data-aos].aos-animate{transition-delay:.6s}[data-aos][data-aos][data-aos-duration='650'],body[data-aos-duration='650'] [data-aos]{transition-duration:.65s}[data-aos][data-aos][data-aos-delay='650'],body[data-aos-delay='650'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='650'].aos-animate,body[data-aos-delay='650'] [data-aos].aos-animate{transition-delay:.65s}[data-aos][data-aos][data-aos-duration='700'],body[data-aos-duration='700'] [data-aos]{transition-duration:.7s}[data-aos][data-aos][data-aos-delay='700'],body[data-aos-delay='700'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='700'].aos-animate,body[data-aos-delay='700'] [data-aos].aos-animate{transition-delay:.7s}[data-aos][data-aos][data-aos-duration='750'],body[data-aos-duration='750'] [data-aos]{transition-duration:.75s}[data-aos][data-aos][data-aos-delay='750'],body[data-aos-delay='750'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='750'].aos-animate,body[data-aos-delay='750'] [data-aos].aos-animate{transition-delay:.75s}[data-aos][data-aos][data-aos-duration='800'],body[data-aos-duration='800'] [data-aos]{transition-duration:.8s}[data-aos][data-aos][data-aos-delay='800'],body[data-aos-delay='800'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='800'].aos-animate,body[data-aos-delay='800'] [data-aos].aos-animate{transition-delay:.8s}[data-aos][data-aos][data-aos-duration='850'],body[data-aos-duration='850'] [data-aos]{transition-duration:.85s}[data-aos][data-aos][data-aos-delay='850'],body[data-aos-delay='850'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='850'].aos-animate,body[data-aos-delay='850'] [data-aos].aos-animate{transition-delay:.85s}[data-aos][data-aos][data-aos-duration='900'],body[data-aos-duration='900'] [data-aos]{transition-duration:.9s}[data-aos][data-aos][data-aos-delay='900'],body[data-aos-delay='900'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='900'].aos-animate,body[data-aos-delay='900'] [data-aos].aos-animate{transition-delay:.9s}[data-aos][data-aos][data-aos-duration='950'],body[data-aos-duration='950'] [data-aos]{transition-duration:.95s}[data-aos][data-aos][data-aos-delay='950'],body[data-aos-delay='950'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='950'].aos-animate,body[data-aos-delay='950'] [data-aos].aos-animate{transition-delay:.95s}[data-aos][data-aos][data-aos-duration='1000'],body[data-aos-duration='1000'] [data-aos]{transition-duration:1s}[data-aos][data-aos][data-aos-delay='1000'],body[data-aos-delay='1000'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1000'].aos-animate,body[data-aos-delay='1000'] [data-aos].aos-animate{transition-delay:1s}[data-aos][data-aos][data-aos-duration='1050'],body[data-aos-duration='1050'] [data-aos]{transition-duration:1.05s}[data-aos][data-aos][data-aos-delay='1050'],body[data-aos-delay='1050'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1050'].aos-animate,body[data-aos-delay='1050'] [data-aos].aos-animate{transition-delay:1.05s}[data-aos][data-aos][data-aos-duration='1100'],body[data-aos-duration='1100'] [data-aos]{transition-duration:1.1s}[data-aos][data-aos][data-aos-delay='1100'],body[data-aos-delay='1100'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1100'].aos-animate,body[data-aos-delay='1100'] [data-aos].aos-animate{transition-delay:1.1s}[data-aos][data-aos][data-aos-duration='1150'],body[data-aos-duration='1150'] [data-aos]{transition-duration:1.15s}[data-aos][data-aos][data-aos-delay='1150'],body[data-aos-delay='1150'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1150'].aos-animate,body[data-aos-delay='1150'] [data-aos].aos-animate{transition-delay:1.15s}[data-aos][data-aos][data-aos-duration='1200'],body[data-aos-duration='1200'] [data-aos]{transition-duration:1.2s}[data-aos][data-aos][data-aos-delay='1200'],body[data-aos-delay='1200'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1200'].aos-animate,body[data-aos-delay='1200'] [data-aos].aos-animate{transition-delay:1.2s}[data-aos][data-aos][data-aos-duration='1250'],body[data-aos-duration='1250'] [data-aos]{transition-duration:1.25s}[data-aos][data-aos][data-aos-delay='1250'],body[data-aos-delay='1250'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1250'].aos-animate,body[data-aos-delay='1250'] [data-aos].aos-animate{transition-delay:1.25s}[data-aos][data-aos][data-aos-duration='1300'],body[data-aos-duration='1300'] [data-aos]{transition-duration:1.3s}[data-aos][data-aos][data-aos-delay='1300'],body[data-aos-delay='1300'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1300'].aos-animate,body[data-aos-delay='1300'] [data-aos].aos-animate{transition-delay:1.3s}[data-aos][data-aos][data-aos-duration='1350'],body[data-aos-duration='1350'] [data-aos]{transition-duration:1.35s}[data-aos][data-aos][data-aos-delay='1350'],body[data-aos-delay='1350'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1350'].aos-animate,body[data-aos-delay='1350'] [data-aos].aos-animate{transition-delay:1.35s}[data-aos][data-aos][data-aos-duration='1400'],body[data-aos-duration='1400'] [data-aos]{transition-duration:1.4s}[data-aos][data-aos][data-aos-delay='1400'],body[data-aos-delay='1400'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1400'].aos-animate,body[data-aos-delay='1400'] [data-aos].aos-animate{transition-delay:1.4s}[data-aos][data-aos][data-aos-duration='1450'],body[data-aos-duration='1450'] [data-aos]{transition-duration:1.45s}[data-aos][data-aos][data-aos-delay='1450'],body[data-aos-delay='1450'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1450'].aos-animate,body[data-aos-delay='1450'] [data-aos].aos-animate{transition-delay:1.45s}[data-aos][data-aos][data-aos-duration='1500'],body[data-aos-duration='1500'] [data-aos]{transition-duration:1.5s}[data-aos][data-aos][data-aos-delay='1500'],body[data-aos-delay='1500'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1500'].aos-animate,body[data-aos-delay='1500'] [data-aos].aos-animate{transition-delay:1.5s}[data-aos][data-aos][data-aos-duration='1550'],body[data-aos-duration='1550'] [data-aos]{transition-duration:1.55s}[data-aos][data-aos][data-aos-delay='1550'],body[data-aos-delay='1550'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1550'].aos-animate,body[data-aos-delay='1550'] [data-aos].aos-animate{transition-delay:1.55s}[data-aos][data-aos][data-aos-duration='1600'],body[data-aos-duration='1600'] [data-aos]{transition-duration:1.6s}[data-aos][data-aos][data-aos-delay='1600'],body[data-aos-delay='1600'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1600'].aos-animate,body[data-aos-delay='1600'] [data-aos].aos-animate{transition-delay:1.6s}[data-aos][data-aos][data-aos-duration='1650'],body[data-aos-duration='1650'] [data-aos]{transition-duration:1.65s}[data-aos][data-aos][data-aos-delay='1650'],body[data-aos-delay='1650'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1650'].aos-animate,body[data-aos-delay='1650'] [data-aos].aos-animate{transition-delay:1.65s}[data-aos][data-aos][data-aos-duration='1700'],body[data-aos-duration='1700'] [data-aos]{transition-duration:1.7s}[data-aos][data-aos][data-aos-delay='1700'],body[data-aos-delay='1700'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1700'].aos-animate,body[data-aos-delay='1700'] [data-aos].aos-animate{transition-delay:1.7s}[data-aos][data-aos][data-aos-duration='1750'],body[data-aos-duration='1750'] [data-aos]{transition-duration:1.75s}[data-aos][data-aos][data-aos-delay='1750'],body[data-aos-delay='1750'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1750'].aos-animate,body[data-aos-delay='1750'] [data-aos].aos-animate{transition-delay:1.75s}[data-aos][data-aos][data-aos-duration='1800'],body[data-aos-duration='1800'] [data-aos]{transition-duration:1.8s}[data-aos][data-aos][data-aos-delay='1800'],body[data-aos-delay='1800'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1800'].aos-animate,body[data-aos-delay='1800'] [data-aos].aos-animate{transition-delay:1.8s}[data-aos][data-aos][data-aos-duration='1850'],body[data-aos-duration='1850'] [data-aos]{transition-duration:1.85s}[data-aos][data-aos][data-aos-delay='1850'],body[data-aos-delay='1850'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1850'].aos-animate,body[data-aos-delay='1850'] [data-aos].aos-animate{transition-delay:1.85s}[data-aos][data-aos][data-aos-duration='1900'],body[data-aos-duration='1900'] [data-aos]{transition-duration:1.9s}[data-aos][data-aos][data-aos-delay='1900'],body[data-aos-delay='1900'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1900'].aos-animate,body[data-aos-delay='1900'] [data-aos].aos-animate{transition-delay:1.9s}[data-aos][data-aos][data-aos-duration='1950'],body[data-aos-duration='1950'] [data-aos]{transition-duration:1.95s}[data-aos][data-aos][data-aos-delay='1950'],body[data-aos-delay='1950'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='1950'].aos-animate,body[data-aos-delay='1950'] [data-aos].aos-animate{transition-delay:1.95s}[data-aos][data-aos][data-aos-duration='2000'],body[data-aos-duration='2000'] [data-aos]{transition-duration:2s}[data-aos][data-aos][data-aos-delay='2000'],body[data-aos-delay='2000'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2000'].aos-animate,body[data-aos-delay='2000'] [data-aos].aos-animate{transition-delay:2s}[data-aos][data-aos][data-aos-duration='2050'],body[data-aos-duration='2050'] [data-aos]{transition-duration:2.05s}[data-aos][data-aos][data-aos-delay='2050'],body[data-aos-delay='2050'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2050'].aos-animate,body[data-aos-delay='2050'] [data-aos].aos-animate{transition-delay:2.05s}[data-aos][data-aos][data-aos-duration='2100'],body[data-aos-duration='2100'] [data-aos]{transition-duration:2.1s}[data-aos][data-aos][data-aos-delay='2100'],body[data-aos-delay='2100'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2100'].aos-animate,body[data-aos-delay='2100'] [data-aos].aos-animate{transition-delay:2.1s}[data-aos][data-aos][data-aos-duration='2150'],body[data-aos-duration='2150'] [data-aos]{transition-duration:2.15s}[data-aos][data-aos][data-aos-delay='2150'],body[data-aos-delay='2150'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2150'].aos-animate,body[data-aos-delay='2150'] [data-aos].aos-animate{transition-delay:2.15s}[data-aos][data-aos][data-aos-duration='2200'],body[data-aos-duration='2200'] [data-aos]{transition-duration:2.2s}[data-aos][data-aos][data-aos-delay='2200'],body[data-aos-delay='2200'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2200'].aos-animate,body[data-aos-delay='2200'] [data-aos].aos-animate{transition-delay:2.2s}[data-aos][data-aos][data-aos-duration='2250'],body[data-aos-duration='2250'] [data-aos]{transition-duration:2.25s}[data-aos][data-aos][data-aos-delay='2250'],body[data-aos-delay='2250'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2250'].aos-animate,body[data-aos-delay='2250'] [data-aos].aos-animate{transition-delay:2.25s}[data-aos][data-aos][data-aos-duration='2300'],body[data-aos-duration='2300'] [data-aos]{transition-duration:2.3s}[data-aos][data-aos][data-aos-delay='2300'],body[data-aos-delay='2300'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2300'].aos-animate,body[data-aos-delay='2300'] [data-aos].aos-animate{transition-delay:2.3s}[data-aos][data-aos][data-aos-duration='2350'],body[data-aos-duration='2350'] [data-aos]{transition-duration:2.35s}[data-aos][data-aos][data-aos-delay='2350'],body[data-aos-delay='2350'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2350'].aos-animate,body[data-aos-delay='2350'] [data-aos].aos-animate{transition-delay:2.35s}[data-aos][data-aos][data-aos-duration='2400'],body[data-aos-duration='2400'] [data-aos]{transition-duration:2.4s}[data-aos][data-aos][data-aos-delay='2400'],body[data-aos-delay='2400'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2400'].aos-animate,body[data-aos-delay='2400'] [data-aos].aos-animate{transition-delay:2.4s}[data-aos][data-aos][data-aos-duration='2450'],body[data-aos-duration='2450'] [data-aos]{transition-duration:2.45s}[data-aos][data-aos][data-aos-delay='2450'],body[data-aos-delay='2450'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2450'].aos-animate,body[data-aos-delay='2450'] [data-aos].aos-animate{transition-delay:2.45s}[data-aos][data-aos][data-aos-duration='2500'],body[data-aos-duration='2500'] [data-aos]{transition-duration:2.5s}[data-aos][data-aos][data-aos-delay='2500'],body[data-aos-delay='2500'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2500'].aos-animate,body[data-aos-delay='2500'] [data-aos].aos-animate{transition-delay:2.5s}[data-aos][data-aos][data-aos-duration='2550'],body[data-aos-duration='2550'] [data-aos]{transition-duration:2.55s}[data-aos][data-aos][data-aos-delay='2550'],body[data-aos-delay='2550'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2550'].aos-animate,body[data-aos-delay='2550'] [data-aos].aos-animate{transition-delay:2.55s}[data-aos][data-aos][data-aos-duration='2600'],body[data-aos-duration='2600'] [data-aos]{transition-duration:2.6s}[data-aos][data-aos][data-aos-delay='2600'],body[data-aos-delay='2600'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2600'].aos-animate,body[data-aos-delay='2600'] [data-aos].aos-animate{transition-delay:2.6s}[data-aos][data-aos][data-aos-duration='2650'],body[data-aos-duration='2650'] [data-aos]{transition-duration:2.65s}[data-aos][data-aos][data-aos-delay='2650'],body[data-aos-delay='2650'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2650'].aos-animate,body[data-aos-delay='2650'] [data-aos].aos-animate{transition-delay:2.65s}[data-aos][data-aos][data-aos-duration='2700'],body[data-aos-duration='2700'] [data-aos]{transition-duration:2.7s}[data-aos][data-aos][data-aos-delay='2700'],body[data-aos-delay='2700'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2700'].aos-animate,body[data-aos-delay='2700'] [data-aos].aos-animate{transition-delay:2.7s}[data-aos][data-aos][data-aos-duration='2750'],body[data-aos-duration='2750'] [data-aos]{transition-duration:2.75s}[data-aos][data-aos][data-aos-delay='2750'],body[data-aos-delay='2750'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2750'].aos-animate,body[data-aos-delay='2750'] [data-aos].aos-animate{transition-delay:2.75s}[data-aos][data-aos][data-aos-duration='2800'],body[data-aos-duration='2800'] [data-aos]{transition-duration:2.8s}[data-aos][data-aos][data-aos-delay='2800'],body[data-aos-delay='2800'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2800'].aos-animate,body[data-aos-delay='2800'] [data-aos].aos-animate{transition-delay:2.8s}[data-aos][data-aos][data-aos-duration='2850'],body[data-aos-duration='2850'] [data-aos]{transition-duration:2.85s}[data-aos][data-aos][data-aos-delay='2850'],body[data-aos-delay='2850'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2850'].aos-animate,body[data-aos-delay='2850'] [data-aos].aos-animate{transition-delay:2.85s}[data-aos][data-aos][data-aos-duration='2900'],body[data-aos-duration='2900'] [data-aos]{transition-duration:2.9s}[data-aos][data-aos][data-aos-delay='2900'],body[data-aos-delay='2900'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2900'].aos-animate,body[data-aos-delay='2900'] [data-aos].aos-animate{transition-delay:2.9s}[data-aos][data-aos][data-aos-duration='2950'],body[data-aos-duration='2950'] [data-aos]{transition-duration:2.95s}[data-aos][data-aos][data-aos-delay='2950'],body[data-aos-delay='2950'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='2950'].aos-animate,body[data-aos-delay='2950'] [data-aos].aos-animate{transition-delay:2.95s}[data-aos][data-aos][data-aos-duration='3000'],body[data-aos-duration='3000'] [data-aos]{transition-duration:3s}[data-aos][data-aos][data-aos-delay='3000'],body[data-aos-delay='3000'] [data-aos]{transition-delay:0}[data-aos][data-aos][data-aos-delay='3000'].aos-animate,body[data-aos-delay='3000'] [data-aos].aos-animate{transition-delay:3s}[data-aos][data-aos][data-aos-easing=linear],body[data-aos-easing=linear] [data-aos]{transition-timing-function:cubic-bezier(.25,.25,.75,.75)}[data-aos][data-aos][data-aos-easing=ease],body[data-aos-easing=ease] [data-aos]{transition-timing-function:ease}[data-aos][data-aos][data-aos-easing=ease-in],body[data-aos-easing=ease-in] [data-aos]{transition-timing-function:ease-in}[data-aos][data-aos][data-aos-easing=ease-out],body[data-aos-easing=ease-out] [data-aos]{transition-timing-function:ease-out}[data-aos][data-aos][data-aos-easing=ease-in-out],body[data-aos-easing=ease-in-out] [data-aos]{transition-timing-function:ease-in-out}[data-aos][data-aos][data-aos-easing=ease-in-back],body[data-aos-easing=ease-in-back] [data-aos]{transition-timing-function:cubic-bezier(.6,-.28,.735,.045)}[data-aos][data-aos][data-aos-easing=ease-out-back],body[data-aos-easing=ease-out-back] [data-aos]{transition-timing-function:cubic-bezier(.175,.885,.32,1.275)}[data-aos][data-aos][data-aos-easing=ease-in-out-back],body[data-aos-easing=ease-in-out-back] [data-aos]{transition-timing-function:cubic-bezier(.68,-.55,.265,1.55)}[data-aos][data-aos][data-aos-easing=ease-in-sine],body[data-aos-easing=ease-in-sine] [data-aos]{transition-timing-function:cubic-bezier(.47,0,.745,.715)}[data-aos][data-aos][data-aos-easing=ease-out-sine],body[data-aos-easing=ease-out-sine] [data-aos]{transition-timing-function:cubic-bezier(.39,.575,.565,1)}[data-aos][data-aos][data-aos-easing=ease-in-out-sine],body[data-aos-easing=ease-in-out-sine] [data-aos]{transition-timing-function:cubic-bezier(.445,.05,.55,.95)}[data-aos][data-aos][data-aos-easing=ease-in-quad],body[data-aos-easing=ease-in-quad] [data-aos]{transition-timing-function:cubic-bezier(.55,.085,.68,.53)}[data-aos][data-aos][data-aos-easing=ease-out-quad],body[data-aos-easing=ease-out-quad] [data-aos]{transition-timing-function:cubic-bezier(.25,.46,.45,.94)}[data-aos][data-aos][data-aos-easing=ease-in-out-quad],body[data-aos-easing=ease-in-out-quad] [data-aos]{transition-timing-function:cubic-bezier(.455,.03,.515,.955)}[data-aos][data-aos][data-aos-easing=ease-in-cubic],body[data-aos-easing=ease-in-cubic] [data-aos]{transition-timing-function:cubic-bezier(.55,.085,.68,.53)}[data-aos][data-aos][data-aos-easing=ease-out-cubic],body[data-aos-easing=ease-out-cubic] [data-aos]{transition-timing-function:cubic-bezier(.25,.46,.45,.94)}[data-aos][data-aos][data-aos-easing=ease-in-out-cubic],body[data-aos-easing=ease-in-out-cubic] [data-aos]{transition-timing-function:cubic-bezier(.455,.03,.515,.955)}[data-aos][data-aos][data-aos-easing=ease-in-quart],body[data-aos-easing=ease-in-quart] [data-aos]{transition-timing-function:cubic-bezier(.55,.085,.68,.53)}[data-aos][data-aos][data-aos-easing=ease-out-quart],body[data-aos-easing=ease-out-quart] [data-aos]{transition-timing-function:cubic-bezier(.25,.46,.45,.94)}[data-aos][data-aos][data-aos-easing=ease-in-out-quart],body[data-aos-easing=ease-in-out-quart] [data-aos]{transition-timing-function:cubic-bezier(.455,.03,.515,.955)}[data-aos^=fade][data-aos^=fade]{opacity:0;transition-property:opacity,transform}[data-aos^=fade][data-aos^=fade].aos-animate{opacity:1;transform:translate(0)}[data-aos=fade-up]{transform:translateY(100px)}[data-aos=fade-down]{transform:translateY(-100px)}[data-aos=fade-right]{transform:translate(-100px)}[data-aos=fade-left]{transform:translate(100px)}[data-aos=fade-up-right]{transform:translate(-100px,100px)}[data-aos=fade-up-left]{transform:translate(100px,100px)}[data-aos=fade-down-right]{transform:translate(-100px,-100px)}[data-aos=fade-down-left]{transform:translate(100px,-100px)}[data-aos^=zoom][data-aos^=zoom]{opacity:0;transition-property:opacity,transform}[data-aos^=zoom][data-aos^=zoom].aos-animate{opacity:1;transform:translate(0) scale(1)}[data-aos=zoom-in]{transform:scale(.6)}[data-aos=zoom-in-up]{transform:translateY(100px) scale(.6)}[data-aos=zoom-in-down]{transform:translateY(-100px) scale(.6)}[data-aos=zoom-in-right]{transform:translate(-100px) scale(.6)}[data-aos=zoom-in-left]{transform:translate(100px) scale(.6)}[data-aos=zoom-out]{transform:scale(1.2)}[data-aos=zoom-out-up]{transform:translateY(100px) scale(1.2)}[data-aos=zoom-out-down]{transform:translateY(-100px) scale(1.2)}[data-aos=zoom-out-right]{transform:translate(-100px) scale(1.2)}[data-aos=zoom-out-left]{transform:translate(100px) scale(1.2)}[data-aos^=slide][data-aos^=slide]{transition-property:transform}[data-aos^=slide][data-aos^=slide].aos-animate{transform:translate(0)}[data-aos=slide-up]{transform:translateY(100%)}[data-aos=slide-down]{transform:translateY(-100%)}[data-aos=slide-right]{transform:translateX(-100%)}[data-aos=slide-left]{transform:translateX(100%)}[data-aos^=flip][data-aos^=flip]{backface-visibility:hidden;transition-property:transform}[data-aos=flip-left]{transform:perspective(2500px) rotateY(-100deg)}[data-aos=flip-left].aos-animate{transform:perspective(2500px) rotateY(0)}[data-aos=flip-right]{transform:perspective(2500px) rotateY(100deg)}[data-aos=flip-right].aos-animate{transform:perspective(2500px) rotateY(0)}[data-aos=flip-up]{transform:perspective(2500px) rotateX(-100deg)}[data-aos=flip-up].aos-animate{transform:perspective(2500px) rotateX(0)}[data-aos=flip-down]{transform:perspective(2500px) rotateX(100deg)}[data-aos=flip-down].aos-animate{transform:perspective(2500px) rotateX(0)}
/*# sourceMappingURL=aos.css.map*/
</style>
@stop

{{-- content --}}
@section('content')
<div class="page-layout simple full-width">
<div class="page-content-wrapper">

    <div id="page-header-introduce" class="page-header-introduce mb-2"
        style="background-image: url('/storage/global/img/introduce/customer_kaigi_1600.jpeg');" >
        <div class="user-info bg-mask pt-10">
            <div data-aos="fade-up" data-aos-duration="3000">
                <p class="center">
                    <img src="/storage/assets/img/yoyaku_logo_400.png" title="Coordiy予約" alt="Coordiy予約" style="max-width:250px;" />
                </p>
                <p class="h3 center">
                    <span class="introduce-title-circle-green"><strong>
                        スマートな予約
                    </strong></span>
                    <br />
                    <span class="h5"><strong>
                        特化型予約管理サイト
                    </strong></span>
                    <!--
                    <br />
                    <a href="/storage/global/pdf/Coordiy予約_owner_rev4.pdf" class="h5 text-blue" target="_blank"><strong>
                        PDF資料ダウンロード
                    </strong></a>
                    -->
                </p>
            </div> 
        </div>  
    </div>
    <div class="page-content row">

        <div class="card col-12 div-introduce border-bottom py-8 mb-2">
            <div class="card-body row">
                <div class="col-xl-6" data-aos="fade-right" data-aos-duration="3000">
                    <img src="/storage/global/img/introduce/adbataze+plus.jpg" width="100%" style="max-width:1600px;" />
                </div>
                <div class="col-xl-6 pb-8">
		            <p class="h3 center"><strong>
                        <span class="introduce-title-modan">理想の予約管理サービス</span>
                    </strong></p>

                    <br /><br /><br />

                    <p class="h5 center"><strong>
                        予約端末導入、電話連携、アプリ・サイト連携、初期費用、一切必要ありません。
                        <br /><br />
                        <span class="text-red-700">月額500円（1店舗）ですべての機能が利用できます。</span>
                        <br /><br />
                        また、モバイル端末ひとつで、すべての予約管理を、スマートにこなします。
                    </strong></p>
                </div>
            </div>
        </div>

    

        <div class="col-12 border-bottom"
            style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_01.jpeg')">
            <div class="bg-mask-hard py-10">
                <div class="col-xl-12 mb-2" data-aos="fade-down" data-aos-duration="3000">
		            <p class="h3 center"><strong>
                    <span class="introduce-title-circle">各サービスの機能は次からご確認ください。</span>
                    </strong></p>
                </div>
            </div>
        </div>

        <div class="col-12 border-bottom mb-2"
            style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_01.jpeg')">

            <div class="bg-mask-hard row pt-10 px-6">

                <div class="col-md-6 col-xl-3 page-header mb-2 p-0"
                    style="background-image: url('/storage/global/img/introduce/main_food_400.jpeg')">
                    <a href="/yoyaku/introduce/owner/food" title="飲食店・レストラン 予約管理" alt="飲食店・レストラン 予約管理">
                        <div class="bg-mask-light">
                            <p class="h5 center" style="padding-top:60px;"><strong>
		                        <span class="">飲食店</span><br />
                                <span class="">レストラン</span>
                            </strong></p>
                        </div>
                    </a>
                </div>
    
                <div class="col-md-6 col-xl-3 page-header mb-2 p-0"
                    style="background-image: url('/storage/global/img/introduce/main_active_400.jpeg')">
                    <a href="/yoyaku/introduce/owner/active" title="レジャー・スポーツ 予約管理" alt="レジャー・スポーツ 予約管理">
                        <div class="bg-mask-light">
                            <p class="h5 center" style="padding-top:60px;"><strong>
		                        <span class="">レジャー</span><br />
                                <span class="">スポーツ</span>
                            </strong></p>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3 page-header mb-2 p-0"
                    style="background-image: url('/storage/global/img/introduce/main_lesson_400.jpeg')">
                    <a href="/yoyaku/introduce/owner/lesson" title="スクール・レッスン 予約管理" alt="スクール・レッスン 予約管理">
                        <div class="bg-mask-light">
                            <p class="h5 center" style="padding-top:60px;"><strong>
		                        <span class="">スクール</span><br />
                                <span class="">レッスン</span>
                            </strong></p>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3 page-header mb-2 p-0"
                    style="background-image: url('/storage/global/img/introduce/main_tour_400.jpeg')">
                    <a href="/yoyaku/introduce/owner/tour" title="ツアー・旅行 予約管理" alt="ツアー・旅行 予約管理">
                        <div class="bg-mask-light">
                            <p class="h5 center" style="padding-top:60px;"><strong>
		                        <span class="">ツアー</span><br />
                                <span class="">旅行</span>
                            </strong></p>
                        </div>
                    </a>
                </div>

                <div class="col-md-6  col-xl-3 page-header mb-2 p-0"
                    style="background-image: url('/storage/global/img/introduce/main_spasalon_400.jpeg')">
                    <a href="/yoyaku/introduce/owner/spasalon" title="エステ・美容 予約管理" alt="エステ・美容 予約管理">
                        <div class="bg-mask-light">
                            <p class="h5 center" style="padding-top:60px;"><strong>
		                        <span class="">エステ</span><br />
                                <span class="">美容</span>
                            </strong></p>
                        </div>
                    </a>
                </div>

                <div class="col-md-6  col-xl-3 page-header mb-2 p-0"
                    style="background-image: url('/storage/global/img/introduce/main_hairsalon_400.jpeg')">
                    <a href="/yoyaku/introduce/owner/hairsalon" title="ヘアーサロン・美容院 予約管理" alt="ヘアーサロン・美容院 予約管理">
                        <div class="bg-mask-light">
                            <p class="h5 center" style="padding-top:60px;"><strong>
		                        <span class="">ヘアーサロン</span><br />
                                <span class="">美容院</span>
                            </strong></p>
                        </div>
                    </a>
                </div>

                <div class="col-md-6  col-xl-3 page-header mb-2 p-0"
                    style="background-image: url('/storage/global/img/introduce/main_stay_400.jpeg')">
                    <a href="/yoyaku/introduce/owner/stay" title="旅館・ホテル 予約管理" alt="旅館・ホテル 予約管理">
                        <div class="bg-mask-light">
                            <p class="h5 center" style="padding-top:60px;"><strong>
		                        <span class="">旅館</span><br />
                                <span class="">ホテル</span>
                            </strong></p>
                        </div>
                    </a>
                </div>



                <div class="col-md-6  col-xl-3 page-header mb-2 p-0"
                    style="background-image: url('/storage/global/img/introduce/main_studio_400.jpeg')">
                    <a href="/yoyaku/introduce/owner/studio" title="スタジオ 予約管理" alt="スタジオ 予約管理">
                        <div class="bg-mask-light">
                            <p class="h5 center" style="padding-top:60px;"><strong>
		                        <span class="">スタジオ</span>
                            </strong></p>
                        </div>
                    </a>
                </div>

                <div class="col-md-6  col-xl-3 page-header mb-2 p-0"
                    style="background-image: url('/storage/global/img/introduce/main_kaigi_400.jpeg')">
                    <a href="/yoyaku/introduce/owner/kaigi" title="会議室 予約管理" alt="会議室 予約管理">
                        <div class="bg-mask-light">
                            <p class="h5 center" style="padding-top:60px;"><strong>
		                        <span class="">会議室</span>
                            </strong></p>
                        </div>
                    </a>
                </div>


                <div class="col-md-6  col-xl-3 page-header mb-2 p-0"
                    style="background-image: url('/storage/global/img/introduce/main_recruit_400.jpeg')">
                    <a href="/yoyaku/introduce/owner/recruit" title="求人・面接 予約管理" alt="求人・面接 予約管理">
                        <div class="bg-mask-light">
                            <p class="h5 center" style="padding-top:60px;"><strong>
		                        <span class="">求人・面接</span><br />
                                <span class="">リクルート</span>
                            </strong></p>
                        </div>
                    </a>
                </div>

                <div class="col-md-6  col-xl-3 page-header mb-2 p-0"
                    style="background-image: url('/storage/global/img/introduce/main_divination_1600.jpeg')">
                    <a href="/yoyaku/introduce/owner/divination" title="占い" alt="占い">
                        <div class="bg-mask-light">
                            <p class="h5 center" style="padding-top:60px;"><strong>
		                        <span class="">占い</span>
                            </strong></p>
                        </div>
                    </a>
                </div>



            </div>
        </div>
    </div>
</div>



</div>

@include('yoyaku/include/footer')
@include('include/footer')
</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')
<script>
!function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?exports.AOS=t():e.AOS=t()}(this,function(){return function(e){function t(n){if(o[n])return o[n].exports;var i=o[n]={exports:{},id:n,loaded:!1};return e[n].call(i.exports,i,i.exports,t),i.loaded=!0,i.exports}var o={};return t.m=e,t.c=o,t.p="dist/",t(0)}([function(e,t,o){"use strict";function n(e){return e&&e.__esModule?e:{"default":e}}var i=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var o=arguments[t];for(var n in o)Object.prototype.hasOwnProperty.call(o,n)&&(e[n]=o[n])}return e},a=o(1),r=(n(a),o(5)),c=n(r),u=o(6),s=n(u),d=o(7),f=n(d),l=o(8),m=n(l),p=o(9),b=n(p),v=o(10),g=n(v),y=o(13),w=n(y),h=[],k=!1,x=document.all&&!window.atob,j={offset:120,delay:0,easing:"ease",duration:400,disable:!1,once:!1,startEvent:"DOMContentLoaded"},O=function(){var e=arguments.length<=0||void 0===arguments[0]?!1:arguments[0];return e&&(k=!0),k?(h=(0,g["default"])(h,j),(0,b["default"])(h,j.once),h):void 0},_=function(){h=(0,w["default"])(),O()},z=function(){h.forEach(function(e,t){e.node.removeAttribute("data-aos"),e.node.removeAttribute("data-aos-easing"),e.node.removeAttribute("data-aos-duration"),e.node.removeAttribute("data-aos-delay")})},A=function(e){return e===!0||"mobile"===e&&m["default"].mobile()||"phone"===e&&m["default"].phone()||"tablet"===e&&m["default"].tablet()||"function"==typeof e&&e()===!0},E=function(e){return j=i(j,e),h=(0,w["default"])(),A(j.disable)||x?z():(document.querySelector("body").setAttribute("data-aos-easing",j.easing),document.querySelector("body").setAttribute("data-aos-duration",j.duration),document.querySelector("body").setAttribute("data-aos-delay",j.delay),"DOMContentLoaded"===j.startEvent&&["complete","interactive"].indexOf(document.readyState)>-1?O(!0):"load"===j.startEvent?window.addEventListener(j.startEvent,function(){O(!0)}):document.addEventListener(j.startEvent,function(){O(!0)}),window.addEventListener("resize",(0,s["default"])(O,50,!0)),window.addEventListener("orientationchange",(0,s["default"])(O,50,!0)),window.addEventListener("scroll",(0,c["default"])(function(){(0,b["default"])(h,j.once)},99)),document.addEventListener("DOMNodeRemoved",function(e){var t=e.target;t&&1===t.nodeType&&t.hasAttribute&&t.hasAttribute("data-aos")&&(0,s["default"])(_,50,!0)}),(0,f["default"])("[data-aos]",_),h)};e.exports={init:E,refresh:O,refreshHard:_}},function(e,t){},,,,function(e,t,o){"use strict";function n(e,t,o){var n=!0,a=!0;if("function"!=typeof e)throw new TypeError(c);return i(o)&&(n="leading"in o?!!o.leading:n,a="trailing"in o?!!o.trailing:a),r(e,t,{leading:n,maxWait:t,trailing:a})}function i(e){var t="undefined"==typeof e?"undefined":a(e);return!!e&&("object"==t||"function"==t)}var a="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol?"symbol":typeof e},r=o(6),c="Expected a function";e.exports=n},function(e,t){"use strict";function o(e,t,o){function n(t){var o=b,n=v;return b=v=void 0,O=t,y=e.apply(n,o)}function a(e){return O=e,w=setTimeout(d,t),_?n(e):y}function r(e){var o=e-h,n=e-O,i=t-o;return z?x(i,g-n):i}function u(e){var o=e-h,n=e-O;return!h||o>=t||0>o||z&&n>=g}function d(){var e=j();return u(e)?f(e):void(w=setTimeout(d,r(e)))}function f(e){return clearTimeout(w),w=void 0,A&&b?n(e):(b=v=void 0,y)}function l(){void 0!==w&&clearTimeout(w),h=O=0,b=v=w=void 0}function m(){return void 0===w?y:f(j())}function p(){var e=j(),o=u(e);if(b=arguments,v=this,h=e,o){if(void 0===w)return a(h);if(z)return clearTimeout(w),w=setTimeout(d,t),n(h)}return void 0===w&&(w=setTimeout(d,t)),y}var b,v,g,y,w,h=0,O=0,_=!1,z=!1,A=!0;if("function"!=typeof e)throw new TypeError(s);return t=c(t)||0,i(o)&&(_=!!o.leading,z="maxWait"in o,g=z?k(c(o.maxWait)||0,t):g,A="trailing"in o?!!o.trailing:A),p.cancel=l,p.flush=m,p}function n(e){var t=i(e)?h.call(e):"";return t==f||t==l}function i(e){var t="undefined"==typeof e?"undefined":u(e);return!!e&&("object"==t||"function"==t)}function a(e){return!!e&&"object"==("undefined"==typeof e?"undefined":u(e))}function r(e){return"symbol"==("undefined"==typeof e?"undefined":u(e))||a(e)&&h.call(e)==m}function c(e){if("number"==typeof e)return e;if(r(e))return d;if(i(e)){var t=n(e.valueOf)?e.valueOf():e;e=i(t)?t+"":t}if("string"!=typeof e)return 0===e?e:+e;e=e.replace(p,"");var o=v.test(e);return o||g.test(e)?y(e.slice(2),o?2:8):b.test(e)?d:+e}var u="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol?"symbol":typeof e},s="Expected a function",d=NaN,f="[object Function]",l="[object GeneratorFunction]",m="[object Symbol]",p=/^\s+|\s+$/g,b=/^[-+]0x[0-9a-f]+$/i,v=/^0b[01]+$/i,g=/^0o[0-7]+$/i,y=parseInt,w=Object.prototype,h=w.toString,k=Math.max,x=Math.min,j=Date.now;e.exports=o},function(e,t){"use strict";function o(e,t){r.push({selector:e,fn:t}),!c&&a&&(c=new a(n),c.observe(i.documentElement,{childList:!0,subtree:!0,removedNodes:!0})),n()}function n(){for(var e,t,o=0,n=r.length;n>o;o++){e=r[o],t=i.querySelectorAll(e.selector);for(var a,c=0,u=t.length;u>c;c++)a=t[c],a.ready||(a.ready=!0,e.fn.call(a,a))}}Object.defineProperty(t,"__esModule",{value:!0});var i=window.document,a=window.MutationObserver||window.WebKitMutationObserver,r=[],c=void 0;t["default"]=o},function(e,t){"use strict";function o(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(t,"__esModule",{value:!0});var n=function(){function e(e,t){for(var o=0;o<t.length;o++){var n=t[o];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}return function(t,o,n){return o&&e(t.prototype,o),n&&e(t,n),t}}(),i=function(){function e(){o(this,e)}return n(e,[{key:"phone",value:function(){var e=!1;return function(t){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(t)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(t.substr(0,4)))&&(e=!0)}(navigator.userAgent||navigator.vendor||window.opera),e}},{key:"mobile",value:function(){var e=!1;return function(t){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(t)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(t.substr(0,4)))&&(e=!0)}(navigator.userAgent||navigator.vendor||window.opera),e}},{key:"tablet",value:function(){return this.mobile()&&!this.phone()}}]),e}();t["default"]=new i},function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var o=function(e,t,o){var n=e.node.getAttribute("data-aos-once");t>e.position?e.node.classList.add("aos-animate"):"undefined"!=typeof n&&("false"===n||!o&&"true"!==n)&&e.node.classList.remove("aos-animate")},n=function(e,t){var n=window.pageYOffset,i=window.innerHeight;e.forEach(function(e,a){o(e,i+n,t)})};t["default"]=n},function(e,t,o){"use strict";function n(e){return e&&e.__esModule?e:{"default":e}}Object.defineProperty(t,"__esModule",{value:!0});var i=o(11),a=n(i),r=function(e,t){return e.forEach(function(e,o){e.node.classList.add("aos-init"),e.position=(0,a["default"])(e.node,t.offset)}),e};t["default"]=r},function(e,t,o){"use strict";function n(e){return e&&e.__esModule?e:{"default":e}}Object.defineProperty(t,"__esModule",{value:!0});var i=o(12),a=n(i),r=function(e,t){var o=0,n=0,i=window.innerHeight,r={offset:e.getAttribute("data-aos-offset"),anchor:e.getAttribute("data-aos-anchor"),anchorPlacement:e.getAttribute("data-aos-anchor-placement")};switch(r.offset&&!isNaN(r.offset)&&(n=parseInt(r.offset)),r.anchor&&document.querySelectorAll(r.anchor)&&(e=document.querySelectorAll(r.anchor)[0]),o=(0,a["default"])(e).top,r.anchorPlacement){case"top-bottom":break;case"center-bottom":o+=e.offsetHeight/2;break;case"bottom-bottom":o+=e.offsetHeight;break;case"top-center":o+=i/2;break;case"bottom-center":o+=i/2+e.offsetHeight;break;case"center-center":o+=i/2+e.offsetHeight/2;break;case"top-top":o+=i;break;case"bottom-top":o+=e.offsetHeight+i;break;case"center-top":o+=e.offsetHeight/2+i}return r.anchorPlacement||r.offset||isNaN(t)||(n=t),o+n};t["default"]=r},function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var o=function(e){for(var t=0,o=0;e&&!isNaN(e.offsetLeft)&&!isNaN(e.offsetTop);)t+=e.offsetLeft-("BODY"!=e.tagName?e.scrollLeft:0),o+=e.offsetTop-("BODY"!=e.tagName?e.scrollTop:0),e=e.offsetParent;return{top:o,left:t}};t["default"]=o},function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var o=function(e){e=e||document.querySelectorAll("[data-aos]");var t=[];return[].forEach.call(e,function(e,o){t.push({node:e})}),t};t["default"]=o}])});
//# sourceMappingURL=aos.js.map
AOS.init();
</script>
@stop
