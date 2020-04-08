<?php
  $pageTitle = '';
  $capaName = '';
  $CheckNameSummary = '';
  $CheckNameDesc = '';
  switch ($contents[0]->service){
    case 15:
        $pageTitle = '飲食店・レストラン';
        $shop = '店舗';
        $capaCheck = 'テーブルの利用状況、在庫の状況';
        $capaOver  = 'オーバー予約と、オーバー注文';
        $CheckNameSummary = 'テーブル、注文、在庫';
        $CheckNameDesc = 'テーブル利用状況、注文状況、在庫数';
        $discountName  = 'ハッピーアワータイム';
        $customerLike  = "利用頻度、好み、アレルギー";
        $capa_desc = '最適な顧客配置<br />テーブル・カウンター・個室の利用状況確認<br />改装などによる縮小営業にもスマート対応';
        $info_send = '混雑状況配信<br />メニュー残数配信<br />個室があいているかなども配信';
        $mainPic = '/storage/global/img/introduce/main_food_1600.jpeg';
        $customerPic = '/storage/global/img/introduce/customer_food_1600.jpeg';
        $service_func = '<tr><th scope="row">レジ機能</th><td>近日予定</td><td class="h1">×</td><td></td></tr>
                         <tr><th scope="row">POS連携</th><td>近日予定</td><td class="h1">×</td><td></td></tr>';
        break;
    case 39:
        $pageTitle = 'レジャー・スポーツ';
        $shop = '店舗';
        $capaCheck = 'アクティブスペースの利用状況、テーブル台やコートなどの状況';
        $capaOver  = 'オーバー予約';
        $CheckNameSummary = 'アクティブスペース';
        $CheckNameDesc = 'アクティブスペースから、ビリヤード台、ダーツ台、コートなどの利用状況';
        $discountName  = '割引デイ';
        $customerLike  = "利用頻度、好み";
        $capa_desc = '利用状況確認<br />改装などによる縮小営業にもスマート対応';
        $info_send = '混雑状況配信';
        $mainPic = '/storage/global/img/introduce/main_active_1600.jpeg';
        $customerPic = '/storage/global/img/introduce/customer_active_1600.jpeg';
        $service_func = '<tr><th scope="row">メニュー管理</th><td>一日券・時間サービス対応</td><td class="h1">×</td><td></td></tr>';
        break;
    case 39:
        $pageTitle = '体験';
        $shop = 'お店';
        $capaCheck = '';
        $capaOver  = '';
        $CheckNameSummary = '';
        $CheckNameDesc = '';
        $discountName  = '';
        $customerLike  = "";
        $capa_desc = '利用状況確認<br />改装などによる縮小営業にもスマート対応';
        $info_send = '混雑状況配信';
        $mainPic = '/storage/global/img/introduce/main_experience_1600.jpeg';
        $customerPic = '/storage/global/img/introduce/customer_experience_1600.jpeg';
        $service_func = '';
        break;
    case 62:
        $pageTitle = 'スクール・レッスン';
        $shop = 'スクール';
        $capaCheck = '参加枠の状況';
        $capaOver  = 'オーバー予約';
        $CheckNameSummary = '参加枠';
        $CheckNameDesc = '参加枠';
        $discountName  = '割引デイ';
        $customerLike  = "利用頻度、好み";
        $capa_desc = '利用状況確認<br />改装などによる縮小営業にもスマート対応';
        $info_send = '混雑状況配信';
        $mainPic = '/storage/global/img/introduce/main_lesson_1600.jpeg';
        $customerPic = '/storage/global/img/introduce/customer_lesson_1600.jpeg';
        $service_func = '';
        break;
    case 65:
        $pageTitle = 'スパ・エステ';
        $shop = '店舗';
        $capaCheck = 'メニューの状況';
        $capaOver  = 'オーバー予約';
        $CheckNameSummary = 'メニュー';
        $CheckNameDesc = 'メニュー利用状況数';
        $discountName  = '割引デイ';
        $customerLike  = "利用頻度、好み";
        $capa_desc = '利用状況確認<br />改装などによる縮小営業にもスマート対応';
        $info_send = '混雑状況配信';
        $mainPic = '/storage/global/img/introduce/main_spasalon_1600.jpeg';
        $customerPic = '/storage/global/img/introduce/customer_spasalon_1600.jpeg';
        $service_func = '';
        break;
    case 69:
        $pageTitle = 'ツアー';
        $shop = '店舗';
        $capaCheck = '申込の状況';
        $capaOver  = 'オーバー予約';
        $CheckNameSummary = '残り参加枠';
        $CheckNameDesc = '残り参加枠数';
        $discountName  = '割引デイ';
        $customerLike  = "利用頻度、好み";
        $capa_desc = '利用状況確認<br />改装などによる縮小営業にもスマート対応';
        $info_send = '残り枠配信';
        $mainPic = '/storage/global/img/introduce/main_tour_1600.jpeg';
        $customerPic = '/storage/global/img/introduce/customer_tour_1600.jpeg';
        $service_func = '';
        break;
    case 7:
        $pageTitle = 'チケット';
        $shop = '店舗';
        $capaCheck = '申込の状況';
        $capaOver  = 'オーバー予約';
        $CheckNameSummary = 'チケット';
        $CheckNameDesc = 'チケット残数';
        $discountName  = '割引デイ';
        $customerLike  = "利用頻度、好み";
        $capa_desc = '利用状況確認<br />改装などによる縮小営業にもスマート対応';
        $info_send = '残り枚数配信';
        $mainPic = '/storage/global/img/introduce/main_ticket_1600.jpeg';
        $customerPic = '/storage/global/img/introduce/customer_ticket_1600.jpeg';
        $service_func = '';
        break;
    case 77:
        $pageTitle = 'ヘアーサロン・美容院';
        $shop = 'サロン';
        $capaCheck = 'ご利用利用状況';
        $capaOver  = 'オーバー予約';
        $CheckNameSummary = '施術席';
        $CheckNameDesc = '施術席状況、注文状況、在庫数';
        $discountName  = '割引デイ';
        $customerLike  = "利用頻度、好み";
        $capa_desc = '利用状況確認<br />改装などによる縮小営業にもスマート対応';
        $info_send = '混雑状況配信';
        $mainPic = '/storage/global/img/introduce/main_hairsalon_1600.jpeg';
        $customerPic = '/storage/global/img/introduce/customer_hairsalon_1600.jpeg';
        $service_func = '';
        break;
    case 81:
        $pageTitle = '旅館・ホテル';
        $shop = '旅館・ホテル';
        $capaCheck = '宿泊ルームの利用状況、メニュー在庫の状況';
        $capaOver  = 'オーバー予約と、オーバー注文';
        $CheckNameSummary = '宿泊ルーム、注文、在庫';
        $CheckNameDesc = '宿泊ルーム利用状況、メニュー注文状況';
        $discountName  = '割引デイ';
        $customerLike  = "利用頻度、好み、アレルギー";
        $capa_desc = '宿泊ルーム利用状況確認<br />温泉・プールなどの混雑状況確認<br />改装などによる縮小営業にもスマート対応';
        $info_send = '空き状況配信<br />メニュー残数配信';
        $mainPic = '/storage/global/img/introduce/main_stay_1600.jpeg';
        $customerPic = '/storage/global/img/introduce/customer_stay_1600.jpeg';
        $service_func = '';
        break;
    case 85:
        $pageTitle = 'スタジオ';
        $shop = 'スタジオ';
        $capaCheck = 'スタジオの利用状況';
        $capaOver  = 'オーバー予約';
        $CheckNameSummary = 'スタジオ';
        $CheckNameDesc = 'スタジオ利用状況';
        $discountName  = '割引デイ';
        $customerLike  = "利用頻度、好み";
        $capa_desc = '利用状況確認<br />改装などによる縮小営業にもスマート対応';
        $info_send = '空き状況配信';
        $mainPic = '/storage/global/img/introduce/main_studio_1600.jpeg';
        $customerPic = '/storage/global/img/introduce/customer_studio_1600.jpeg';
        $service_func = '';
        break;
    case 89:
        $pageTitle = '会議室';
        $shop = '会議室';
        $capaCheck = '会議室の利用状況';
        $capaOver  = 'オーバー予約';
        $CheckNameSummary = '会議室';
        $CheckNameDesc = '会議室利用状況';
        $discountName  = '割引デイ';
        $customerLike  = "利用頻度、好み、アレルギー";
        $capa_desc = '利用状況確認<br />改装などによる縮小営業にもスマート対応';
        $info_send = '空き状況配信';
        $mainPic = '/storage/global/img/introduce/main_kaigi_1600.jpeg';
        $customerPic = '/storage/global/img/introduce/customer_kaigi_1600.jpeg';
        $service_func = '';
        break;
    case 90:
        $pageTitle = '占い';
        $shop = '占い';
        $capaCheck = 'ご予約状況';
        $capaOver  = 'オーバー予約';
        $CheckNameSummary = '占い';
        $CheckNameDesc = 'ご予約状況';
        $discountName  = '割引デイ';
        $customerLike  = "利用頻度、好み、アレルギー";
        $capa_desc = '利用状況確認<br />改装などによる縮小営業にもスマート対応';
        $info_send = '空き状況配信';
        $mainPic = '/storage/global/img/introduce/main_divination_1600.jpeg';
        $customerPic = '/storage/global/img/introduce/customer_divination_1600.jpeg';
        $service_func = '';
        break;
    }
?>



@extends('yoyaku/layouts/default')

{{-- Page title --}}
@section('title'){!!$pageTitle!!} 予約管理 @parent
@stop


@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="{!!$pageTitle!!}の予約管理紹介ページです。Coordiy予約を利用するとネット予約受付、混雑状況の自動常時配信など、無料で利用できて利益を増やすことが可能です。">
<meta name="keywords" content="Coordiy予約,飲食,予約管理">
<meta property="og:site_name" content="Coordiy予約">
<meta property="og:title" content="{!!$pageTitle!!}の予約管理">
<meta property="og:description" content="{!!$pageTitle!!}の予約管理紹介ページです。Coordiy予約を利用するとネット予約受付、混雑状況の自動常時配信など、無料で利用できて利益を増やすことが可能です。">
<meta property="og:image" content="{!!$mainPic!!}">
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
<script src='https://www.google.com/recaptcha/api.js'></script>
@stop

{{-- content --}}
@section('content')
<div class="page-layout simple full-width">
<div class="page-content-wrapper">

    <div id="page-header-introduce" class="page-header-introduce mb-2"
        style="background-image: url('{!!$mainPic!!}')" >
        <div class="user-info bg-mask pt-10">
            <div data-aos="fade-up" data-aos-duration="3000">
                <br />
                <p class="center">
                    <img src="/storage/assets/img/yoyaku_logo_400.png" title="Coordiy予約" alt="Coordiy予約" style="max-width:250px;" />
                </p>
                <p class="h3 center">
                    <span class="introduce-title-circle-green"><strong>
                        {!!$pageTitle!!}
                    </span></strong>
                    <br />
                    <span class="h3"><strong>
                        予約管理
                    </strong></span>
                </p>
            </div>  
        </div>  
    </div>

    <div class="page-content row">
            
        <div class="card col-12 div-introduce border-bottom mb-2"
            style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_02.jpeg')">
            <div class="card-body bg-mask-hard py-8 row">
                <div class="col-xl-6 mb-10" data-aos="fade-right" data-aos-duration="3000">
                    <img src="/storage/global/img/introduce/everywhere_1600.jpg" width="100%" style="max-width:1600px;" />
                </div>
                <div class="col-xl-6">
		            <p class="h3 center"><strong>
                        <span class="introduce-title-modan">理想の予約管理サービス</span>
                    </strong></p>

                    <br /><br />

                    <p class="h5 center"><strong>
                        予約端末導入、電話連携、アプリ・サイト連携、初期費用、一切必要ありません。
                        <br /><br />
                        月額500円（1店舗）ですべての機能が利用できます。
                        <br /><br />
                        また、モバイル端末ひとつで、すべての予約管理を、スマートにこなします。
                    </strong></p>
                </div>
            </div>
        </div>

        <div class="card col-12 div-introduce border-bottom mb-2">
            <div class="card-body py-8 row">
                <div class="col-xl-6">
                    <div class="row">
                        <div class="col-12">
		                <p class="h3 center"><strong>
                          <span class="introduce-title-kagi-kakko">メディア掲載を標準サポート</span>
                        </strong></p>
  
                        <br /><br />
                        </div>
  
                        <div class="col-sm-9">
                        <p class="h5 center"><strong>
                          {!!$shop!!}を登録すると、予約管理だけではなく、メディア掲載が自動で行われます。<br /><br />
                          {!!$shop!!}を登録するだけでも効果があります。<br /><br />
                          同時に求人広告もできるのもポイント！<br /><br />
                          掲載内容はデモメディアをご覧ください。
                        </strong></p>
                        </div>
  
                        @include('include/search_contents')

                    </div>
                </div>
                <div class="col-xl-6" data-aos="fade-right" data-aos-duration="3000" style="">
                    <img src="/storage/global/img/introduce/adbataze+plus.jpg" width="100%" style="max-width:1600px;" />
                </div>
            </div>
        </div>

        <div class="card col-12 border-bottom mb-2">
            <div class="card-body py-8 row mt-4">
                <div class="col-12 pb-6 center">
                    <a href="/yoyaku/register"><button class="btn btn-outline-info f30"><strong>早速、無料で利用する</strong></button></a>
                </div>
            </div>
        </div>

        <div class="card col-12 div-introduce border-bottom mb-2"
            style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_01.jpeg')">
            <div class="card-body bg-mask-hard py-8 row">
                <div class="col-xl-12 pb-8 mb-2" data-aos="fade-up" data-aos-duration="3000">
		            <p class="h3 center"><strong>
                        <span class="introduce-title-circle">Coordiy予約の予約管理アルゴリズム</span>
                    </strong></p>

                    <br /><br />
                    <p class="h5 center"><strong>
                        Coordiy予約の予約管理アルゴリズムは、{!!$capaCheck!!}を適切に理解し、適切な予約を行います。<br /><br />
                        {!!$capaOver!!}の心配は、もう必要ありません。
                    </strong></p>
                </div>
            </div>
        </div>

        <div class="card col-12 div-introduce border-bottom mb-2">
            <div class="card-body py-8 row">
                <div class="col-xl-6 mb-10" data-aos="fade-right" data-aos-duration="3000">
                    <img src="/storage/global/img/introduce/ontime_1600.jpg" width="100%" style="max-width:1600px;" />
                </div>
                <div class="col-xl-6">
		            <p class="h3 center"><strong>
                        <span class="introduce-title-modan">{!!$CheckNameSummary!!}をリアルタイム確認</span>
                    </strong></p>
                    
                    <br /><br /><br />
                    <p class="h5"><strong>
                        ひとつのカレンダー上で{!!$CheckNameDesc!!}をリアルタイムに把握できるので、機会損失を防ぐことが可能です。
                        <br /><br />
                        また、カスタマーにも混雑状況をオンタイムで伝えることができるのでお客様にいやな思いをさせません。
                    </strong></p>
                </div>
            </div>
        </div>

        <div class="card col-12 div-introduce border-bottom mb-2">
            <div class="card-body py-8 row">
                <div class="col-xl-6 mb-10">
		            
                    <p class="h3 center"><strong>
                        <span class="introduce-title-kagi-kakko">理想の顧客管理</span>
                    </strong></p>
                    
                    <br /><br /><br />
                    <p class="h5 center"><strong>
                        Coordiy予約の顧客管理は、お客様の{!!$customerLike!!}などをしっかり把握しています。<br /><br />
                        オーナー様は最適なおもてなしを提供することができます。
                    </strong></p>

                </div>
                <div class="col-xl-6" data-aos="fade-left" data-aos-duration="3000">
                    <img src="{!!$customerPic!!}" width="100%" style="max-width:1600px;" />
                </div>
            </div>
        </div>


        <div class="card col-12 div-introduce border-bottom mb-2"
            style="background-image: url('/storage/global/img/introduce/back_colorful_repeat_03.jpeg')">
            <div class="card-body row bg-mask-hard">
                <div class="col-xl-12 pb-8 mb-2" data-aos="fade-up" data-aos-duration="3000">
		            <p class="h3 center"><strong>
                        <span class="introduce-title-circle">機能一覧</span>
                    </strong></p>
                    <br /><br />
                    



<div class="table-responsive">
    <table class="table h5">
        <thead>
            <tr>
                <th scope="row"><strong>機能名</strong></th>
                <th scope="row"><strong>機能概要一部</strong></th>
                <th scope="row"><strong>対応</strong></th>
                <th scope="row"><strong>料金</strong></th>
            </tr>
        </thead>
        <tbody>
        <tr><th scope="row">予約管理</th><td>予約受付<br />予約キャンセル<br />予約者とのメッセージ交換<br />{!!$discountName!!}設定<br />など</td><td class="text-info h1">〇</td><td>無料</td></tr>
        <tr><th scope="row">キャパシティ管理</th><td>{!!$capa_desc!!}</td><td class="text-info h1">〇</td><td>無料</td></tr>
        <tr><th scope="row">顧客管理</th><td>顧客メモ<br />来店数<br />総利用額<br />など</td><td class="text-info h1">〇</td><td>無料</td></tr>
        <tr><th scope="row">店舗メディア</th><td>店舗ウェブサイトを自動作成</td><td class="text-info h1">〇</td><td>無料</td></tr>
        <tr><th scope="row">求人広告<br />エントリー管理・面接管理</th><td>社員やバイトの求人広告<br />面接や採用通知のスマート対応</td><td class="text-info h1">〇</td><td>無料</td></tr>
        <tr><th scope="row">ネット予約</th><td></td><td class="text-info h1">〇</td><td>無料</td></tr>
        <tr><th scope="row">ネット混在状況配信<br />(カスタマー向け)</th><td>{!!$info_send!!}</td><td class="text-info h1">〇</td><td>無料</td></tr>
        <tr><th scope="row">ネット決済</th><td>VISA<br />MASTERCARD<br />JCB<br />など</td><td class="text-info h1">〇</td><td>4％＋40円～</td></tr>
        <tr><th scope="row">集計・分析</th><td>総売り上げ<br />月間売上げ<br />週間売上げ<br />顧客数遷移<br />など</td><td class="text-info h1">〇</td><td>無料</td></tr>
        <tr><th scope="row">メッセージ機能</th><td>らくらく簡易メッセージ送付<br />メール連携</td><td class="text-info h1">〇</td><td>無料</td></tr>
        <tr><th scope="row">メール機能</th><td>予約時メール<br />利用日前日メール<br />メッセージ送信時メール</td><td class="text-info h1">〇</td><td>無料</td></tr>
        <tr><th scope="row">マルチアカウント</th><td>管理者オーナーアカウント<br />一般オーナーアカウント<br />（売上げデータ表示の制限）</td><td class="text-info h1">〇</td><td>無料</td></tr>
        <tr><th scope="row">サポート</th><td>メッセージサポート<br />電話サポート<br />メディア作成サポート</td><td class="text-info h1">〇</td><td>無料（一部有料）</td</tr>
        {!!$service_func!!}
        </tbody>
    </table>
</div>

                </div>
            </div>
        </div>


        <div class="card col-12 div-introduce border-bottom mb-2">
            <div class="card-body py-8 row">
                <div class="col-xl-6" data-aos="fade-right" data-aos-duration="3000" style="top:-20px;">
                    <img src="/storage/global/img/introduce/secure_1600.jpeg" width="100%" style="max-width:1600px;" />
                </div>
                <div class="col-xl-6">
		            <p class="h3 center"><strong>
                        <span class="introduce-title-modan">セキュリティ</span>
                    </strong></p>
                    
                    <br /><br /><br />

                    <p class="h5"><strong>
                      すべてのユーザ情報は Google Cloud Platform 内で安全に処理されされます。<br /><br />
                      また、不正ログインを未然に防ぐ2段階認証機能の利用が可能。<br /><br />
                      システム運用においては、ISMS基本方針を定め、情報保護管理を徹底しています。
                    </strong></p>
                </div>
            </div>
        </div>

        <div class="card col-12 border-bottom mb-2">
            <div class="card-body py-8 row mt-4">
                <div class="col-12 pb-6 center">
                    <a href="/yoyaku/register"><button class="btn btn-outline-info f30"><strong>早速、無料で利用する</strong></button></a>
                </div>
            </div>
        </div>

        <div class="card col-12 div-introduce border-bottom mb-2">
            <div class="card-body p-0">
                    @include('owner/support/include/support_table')
            </div>
        </div>

        <div class="card col-12 border-bottom mb-2">
            <div class="card-body py-8 row mt-4">
                <div class="col-12 pb-6 center">
                    <a href="/yoyaku/register"><button class="btn btn-outline-info f30"><strong>早速、無料で利用する</strong></button></a>
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
<script> function recaptchaCallback(param) { if(param) { document.getElementById('submit').disabled = ""; } } </script>
<script>
!function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?exports.AOS=t():e.AOS=t()}(this,function(){return function(e){function t(n){if(o[n])return o[n].exports;var i=o[n]={exports:{},id:n,loaded:!1};return e[n].call(i.exports,i,i.exports,t),i.loaded=!0,i.exports}var o={};return t.m=e,t.c=o,t.p="dist/",t(0)}([function(e,t,o){"use strict";function n(e){return e&&e.__esModule?e:{"default":e}}var i=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var o=arguments[t];for(var n in o)Object.prototype.hasOwnProperty.call(o,n)&&(e[n]=o[n])}return e},a=o(1),r=(n(a),o(5)),c=n(r),u=o(6),s=n(u),d=o(7),f=n(d),l=o(8),m=n(l),p=o(9),b=n(p),v=o(10),g=n(v),y=o(13),w=n(y),h=[],k=!1,x=document.all&&!window.atob,j={offset:120,delay:0,easing:"ease",duration:400,disable:!1,once:!1,startEvent:"DOMContentLoaded"},O=function(){var e=arguments.length<=0||void 0===arguments[0]?!1:arguments[0];return e&&(k=!0),k?(h=(0,g["default"])(h,j),(0,b["default"])(h,j.once),h):void 0},_=function(){h=(0,w["default"])(),O()},z=function(){h.forEach(function(e,t){e.node.removeAttribute("data-aos"),e.node.removeAttribute("data-aos-easing"),e.node.removeAttribute("data-aos-duration"),e.node.removeAttribute("data-aos-delay")})},A=function(e){return e===!0||"mobile"===e&&m["default"].mobile()||"phone"===e&&m["default"].phone()||"tablet"===e&&m["default"].tablet()||"function"==typeof e&&e()===!0},E=function(e){return j=i(j,e),h=(0,w["default"])(),A(j.disable)||x?z():(document.querySelector("body").setAttribute("data-aos-easing",j.easing),document.querySelector("body").setAttribute("data-aos-duration",j.duration),document.querySelector("body").setAttribute("data-aos-delay",j.delay),"DOMContentLoaded"===j.startEvent&&["complete","interactive"].indexOf(document.readyState)>-1?O(!0):"load"===j.startEvent?window.addEventListener(j.startEvent,function(){O(!0)}):document.addEventListener(j.startEvent,function(){O(!0)}),window.addEventListener("resize",(0,s["default"])(O,50,!0)),window.addEventListener("orientationchange",(0,s["default"])(O,50,!0)),window.addEventListener("scroll",(0,c["default"])(function(){(0,b["default"])(h,j.once)},99)),document.addEventListener("DOMNodeRemoved",function(e){var t=e.target;t&&1===t.nodeType&&t.hasAttribute&&t.hasAttribute("data-aos")&&(0,s["default"])(_,50,!0)}),(0,f["default"])("[data-aos]",_),h)};e.exports={init:E,refresh:O,refreshHard:_}},function(e,t){},,,,function(e,t,o){"use strict";function n(e,t,o){var n=!0,a=!0;if("function"!=typeof e)throw new TypeError(c);return i(o)&&(n="leading"in o?!!o.leading:n,a="trailing"in o?!!o.trailing:a),r(e,t,{leading:n,maxWait:t,trailing:a})}function i(e){var t="undefined"==typeof e?"undefined":a(e);return!!e&&("object"==t||"function"==t)}var a="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol?"symbol":typeof e},r=o(6),c="Expected a function";e.exports=n},function(e,t){"use strict";function o(e,t,o){function n(t){var o=b,n=v;return b=v=void 0,O=t,y=e.apply(n,o)}function a(e){return O=e,w=setTimeout(d,t),_?n(e):y}function r(e){var o=e-h,n=e-O,i=t-o;return z?x(i,g-n):i}function u(e){var o=e-h,n=e-O;return!h||o>=t||0>o||z&&n>=g}function d(){var e=j();return u(e)?f(e):void(w=setTimeout(d,r(e)))}function f(e){return clearTimeout(w),w=void 0,A&&b?n(e):(b=v=void 0,y)}function l(){void 0!==w&&clearTimeout(w),h=O=0,b=v=w=void 0}function m(){return void 0===w?y:f(j())}function p(){var e=j(),o=u(e);if(b=arguments,v=this,h=e,o){if(void 0===w)return a(h);if(z)return clearTimeout(w),w=setTimeout(d,t),n(h)}return void 0===w&&(w=setTimeout(d,t)),y}var b,v,g,y,w,h=0,O=0,_=!1,z=!1,A=!0;if("function"!=typeof e)throw new TypeError(s);return t=c(t)||0,i(o)&&(_=!!o.leading,z="maxWait"in o,g=z?k(c(o.maxWait)||0,t):g,A="trailing"in o?!!o.trailing:A),p.cancel=l,p.flush=m,p}function n(e){var t=i(e)?h.call(e):"";return t==f||t==l}function i(e){var t="undefined"==typeof e?"undefined":u(e);return!!e&&("object"==t||"function"==t)}function a(e){return!!e&&"object"==("undefined"==typeof e?"undefined":u(e))}function r(e){return"symbol"==("undefined"==typeof e?"undefined":u(e))||a(e)&&h.call(e)==m}function c(e){if("number"==typeof e)return e;if(r(e))return d;if(i(e)){var t=n(e.valueOf)?e.valueOf():e;e=i(t)?t+"":t}if("string"!=typeof e)return 0===e?e:+e;e=e.replace(p,"");var o=v.test(e);return o||g.test(e)?y(e.slice(2),o?2:8):b.test(e)?d:+e}var u="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol?"symbol":typeof e},s="Expected a function",d=NaN,f="[object Function]",l="[object GeneratorFunction]",m="[object Symbol]",p=/^\s+|\s+$/g,b=/^[-+]0x[0-9a-f]+$/i,v=/^0b[01]+$/i,g=/^0o[0-7]+$/i,y=parseInt,w=Object.prototype,h=w.toString,k=Math.max,x=Math.min,j=Date.now;e.exports=o},function(e,t){"use strict";function o(e,t){r.push({selector:e,fn:t}),!c&&a&&(c=new a(n),c.observe(i.documentElement,{childList:!0,subtree:!0,removedNodes:!0})),n()}function n(){for(var e,t,o=0,n=r.length;n>o;o++){e=r[o],t=i.querySelectorAll(e.selector);for(var a,c=0,u=t.length;u>c;c++)a=t[c],a.ready||(a.ready=!0,e.fn.call(a,a))}}Object.defineProperty(t,"__esModule",{value:!0});var i=window.document,a=window.MutationObserver||window.WebKitMutationObserver,r=[],c=void 0;t["default"]=o},function(e,t){"use strict";function o(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(t,"__esModule",{value:!0});var n=function(){function e(e,t){for(var o=0;o<t.length;o++){var n=t[o];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}return function(t,o,n){return o&&e(t.prototype,o),n&&e(t,n),t}}(),i=function(){function e(){o(this,e)}return n(e,[{key:"phone",value:function(){var e=!1;return function(t){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(t)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(t.substr(0,4)))&&(e=!0)}(navigator.userAgent||navigator.vendor||window.opera),e}},{key:"mobile",value:function(){var e=!1;return function(t){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(t)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(t.substr(0,4)))&&(e=!0)}(navigator.userAgent||navigator.vendor||window.opera),e}},{key:"tablet",value:function(){return this.mobile()&&!this.phone()}}]),e}();t["default"]=new i},function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var o=function(e,t,o){var n=e.node.getAttribute("data-aos-once");t>e.position?e.node.classList.add("aos-animate"):"undefined"!=typeof n&&("false"===n||!o&&"true"!==n)&&e.node.classList.remove("aos-animate")},n=function(e,t){var n=window.pageYOffset,i=window.innerHeight;e.forEach(function(e,a){o(e,i+n,t)})};t["default"]=n},function(e,t,o){"use strict";function n(e){return e&&e.__esModule?e:{"default":e}}Object.defineProperty(t,"__esModule",{value:!0});var i=o(11),a=n(i),r=function(e,t){return e.forEach(function(e,o){e.node.classList.add("aos-init"),e.position=(0,a["default"])(e.node,t.offset)}),e};t["default"]=r},function(e,t,o){"use strict";function n(e){return e&&e.__esModule?e:{"default":e}}Object.defineProperty(t,"__esModule",{value:!0});var i=o(12),a=n(i),r=function(e,t){var o=0,n=0,i=window.innerHeight,r={offset:e.getAttribute("data-aos-offset"),anchor:e.getAttribute("data-aos-anchor"),anchorPlacement:e.getAttribute("data-aos-anchor-placement")};switch(r.offset&&!isNaN(r.offset)&&(n=parseInt(r.offset)),r.anchor&&document.querySelectorAll(r.anchor)&&(e=document.querySelectorAll(r.anchor)[0]),o=(0,a["default"])(e).top,r.anchorPlacement){case"top-bottom":break;case"center-bottom":o+=e.offsetHeight/2;break;case"bottom-bottom":o+=e.offsetHeight;break;case"top-center":o+=i/2;break;case"bottom-center":o+=i/2+e.offsetHeight;break;case"center-center":o+=i/2+e.offsetHeight/2;break;case"top-top":o+=i;break;case"bottom-top":o+=e.offsetHeight+i;break;case"center-top":o+=e.offsetHeight/2+i}return r.anchorPlacement||r.offset||isNaN(t)||(n=t),o+n};t["default"]=r},function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var o=function(e){for(var t=0,o=0;e&&!isNaN(e.offsetLeft)&&!isNaN(e.offsetTop);)t+=e.offsetLeft-("BODY"!=e.tagName?e.scrollLeft:0),o+=e.offsetTop-("BODY"!=e.tagName?e.scrollTop:0),e=e.offsetParent;return{top:o,left:t}};t["default"]=o},function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var o=function(e){e=e||document.querySelectorAll("[data-aos]");var t=[];return[].forEach.call(e,function(e,o){t.push({node:e})}),t};t["default"]=o}])});
//# sourceMappingURL=aos.js.map
AOS.init();
</script>
@stop
