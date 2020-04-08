@extends('SenMonTen/layouts/default')

{{-- Page title --}}
<?php
if($GLOBALS['country_area_name']){
    $GLOBALS['country_area_name'] = str_replace('都', '', $GLOBALS['country_area_name']);
    $GLOBALS['country_area_name'] = str_replace('府', '', $GLOBALS['country_area_name']);
    $GLOBALS['country_area_name'] = str_replace('県', '', $GLOBALS['country_area_name']);
}
if($GLOBALS['country_area_address_one_name']){
    $GLOBALS['country_area_address_one_name'] = str_replace('市', '', $GLOBALS['country_area_address_one_name']);
}
$GLOBALS['orderBy_name'] = '';
if($GLOBALS['orderBy']===1){
    $GLOBALS['orderBy_name']='口コミ ランキング!';
}
?>
@if($GLOBALS['country_area_name'] and $GLOBALS['yoyaku_type_tag_name'])
<?php
    $title = $GLOBALS['country_area_name'].
        $GLOBALS['country_area_address_one_name'].
        $GLOBALS['country_area_address_two_name'].
        'の'.
        $GLOBALS['yoyaku_type_tag_name'] . ' ' . $GLOBALS['orderBy_name'];
    $description = $GLOBALS['country_area_name'].
        $GLOBALS['country_area_address_one_name'].
        $GLOBALS['country_area_address_two_name'].
        'の'.
        $GLOBALS['yoyaku_type_tag_name'] . ' ' . $GLOBALS['orderBy_name'];
        '検索ページです。';
    $content_title = $title;
?>
@elseif($GLOBALS['country_area_name'])
<?php
    $title = $GLOBALS['country_area_name'].
        $GLOBALS['country_area_address_one_name'].
        $GLOBALS['country_area_address_two_name'].
        'の占い' . ' ' . $GLOBALS['orderBy_name'];
    $description = $GLOBALS['country_area_name'].
        $GLOBALS['country_area_address_one_name'].
        $GLOBALS['country_area_address_two_name'].
        'の占い店'.
        ' ' . $GLOBALS['orderBy_name'].
        '検索ページです。';
    $content_title = $title;
?>
@elseif($GLOBALS['yoyaku_type_tag_name'])
<?php
    $title = $GLOBALS['yoyaku_type_tag_name'] . ' ' . $GLOBALS['orderBy_name'];
    $description = $GLOBALS['yoyaku_type_tag_name'].
        'を行う占い店'.
        ' ' . $GLOBALS['orderBy_name'].
        '検索ページです。';
    $content_title = '全国の' . $title;
?>
@else
<?php
    $title = '';
    $description = $GLOBALS['yoyaku_type_name'].'Coordiy予約は'.
    $GLOBALS['yoyaku_type_name'].'の専門サイトです。'.
    $GLOBALS['yoyaku_type_name'].'の口コミ、営業時間、メニューなどの確認、お店のご予約、トレンド商品の購入ができます。';
    $content_title = '全国の占い';
?>
@endif

@section('title') {!!$title!!} @parent
@stop

@section('meta')
<meta name="google-site-verification" content="iFdDprkPtv1sU5f53PCU-1qQDH5rE5x53p97R26MJkA">
<meta name="description" content="{!!$description!!}">
<meta name="keywords" content="{!!$GLOBALS['yoyaku_type_name']!!},予約">
<meta property="og:site_name" content="{!!$GLOBALS['yoyaku_type_name']!!}Coordiy予約">
<meta property="og:title" content="{!!$title!!}">
<meta property="og:description" content="{!!$description!!}">
<meta property="og:image" content="/storage/assets/img/{!!$GLOBALS['yoyaku_type_key']!!}_logo_1600.png">
<meta property="og:url" content="{!!$_SERVER['HTTP_HOST']!!}">
<meta property="og:locale" content="ja_JP">
<meta property="og:type" content="website">
@stop

{{-- page level styles --}}
@section('header_styles')

@stop

{{-- content --}}
@section('content')
<div id="project-dashboard" class="page-layout simple right-sidebar">

    <div class="page-content-wrapper">

        @include('SenMonTen/include/cover_area')
        
        <!-- Kiji -->
        <!-- 
        <div class="page-content row py-2 px-6 mt-4">
            <div class="col-12 mb-2"><p class="h4 center text-red-900"><strong class="introduce-title-box"><i class="icon icon-fire text-red-500"></i>トレンドレポート</strong></p></div>
            @if(isset($kijis))
            @include('SenMonTen/include/search_kiji')
            @else
            <div class="col-12 pt-6 pb-2"><p class="h4 center text-red-900"><strong class=""><i class="icon icon-fire text-red-500"></i>作成中！！！</strong></p></div>
            @endif
        </div>
        -->
        
        @if(!empty($contents))
        <div id="searchContents" class="page-content row py-2 px-6">
            <div class="col-12 mb-2">
                <div class="p-4">
                    <p class="h4 center"><strong class="introduce-title-stripe">{!!$content_title!!}({!!$contents->total()!!}件)</strong></p>
                    <p class="center pt-4">
                        <a class="btn text-fuse-black-800 @if($GLOBALS['orderBy']===1) active @endif"
                            href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}?orderBy=1" >
                            <strong><i class="icon icon-comment-account-outline pr-1 text-red-500 s-5"></i>口コミ ランキング!</strong>
                        </a>
                        <span class="px-2"> | </span>
                        <a class="btn text-fuse-black-800 @if($GLOBALS['orderBy']===2) active @endif"
                            href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}?orderBy=2" >
                            <strong><i class="icon icon-update pr-1 text-green-500 s-5"></i>更新順</strong>
                        </a>
                    </p>
                </div>
            </div>
            @include('SenMonTen/include/search_contents_index')
        </div>
        @else
            @if(!$contents_tokyo)
            <div class="page-content row py-2 px-6">
                <div class="card col-12">
                    <div class="card-body">
                        <p class="h4 center pb-4"><strong class="introduce-title-stripe">{!!$content_title!!}</strong></p>
                        <p class="h5 center"><strong>見つかりませんでした。検索方法を変更してみてください！</strong></p>
                    </div>
                </div>
            </div>
            @endif
        @endif

        @if($contents_tokyo)
        <div class="page-content row py-2 px-6">
            <div class="col-12 mb-4"><a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}?country_area_id=13"><p class="h4 center"><strong class="introduce-title-stripe-red">東京の{!!$GLOBALS['yoyaku_type_name']!!}({!!$contents_tokyo->total()!!}件)</strong></p></a></div>
            @foreach($contents_tokyo as $content)
                @include('SenMonTen/include/search_contents_only_value')
            @endforeach
        </div>
        @endif

        @if($contents_osaka)
        <div class="page-content row py-2 px-6">
            <div class="col-12 mb-4"><a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}?country_area_id=27"><p class="h4 center"><strong class="introduce-title-stripe-yellow">大阪の{!!$GLOBALS['yoyaku_type_name']!!}({!!$contents_osaka->total()!!}件)</strong></p></div>
            @foreach($contents_osaka as $content)
                @include('SenMonTen/include/search_contents_only_value')
            @endforeach
        </div>
        @endif

        @if($contents_nagoya)
        <div class="page-content row py-2 px-6">
            <div class="col-12 mb-4"><a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}?country_area_id=23"><p class="h4 center"><strong class="introduce-title-stripe-blue">名古屋の{!!$GLOBALS['yoyaku_type_name']!!}({!!$contents_nagoya->total()!!}件)</strong></p></a></div>
            @foreach($contents_nagoya as $content)
                @include('SenMonTen/include/search_contents_only_value')
            @endforeach
        </div>
        @endif

        @if($contents_fukuoka)
        <div class="page-content row py-2 px-6">
            <div class="col-12 mb-4"><a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}?country_area_id=40"><p class="h4 center"><strong class="introduce-title-stripe-purple">福岡の{!!$GLOBALS['yoyaku_type_name']!!}({!!$contents_fukuoka->total()!!}件)</strong></p></a></div>
            @foreach($contents_fukuoka as $content)
                @include('SenMonTen/include/search_contents_only_value')
            @endforeach
        </div>
        @endif

        @if( $contents->hasMorePages() and !empty($contents) and !$contents_fukuoka )
        <div class="page-content-footer mx-2">
            <p class="right" id="pageMore">
                
                <button class="btn btn-outline-info" onclick="loading();ajaxPaginationMore('{!!$contents->nextPageUrl()!!}');return false;" >
                    <strong>もっと</strong>
                </button>
                
            </p>
        </div>
        @endif
        
        @if($contents_fukuoka)
        <div class="page-content pt-2 px-2">
            <div class="card">
                <div class="card-body row">
                <div class="col-12 mb-4"><p class="h4 center"><strong class="">エリアで検索</strong></p></div>
                @foreach(Util::getCountryAreasJp() as $country_area_jp)
                <?php
                if(mb_strlen($country_area_jp->name)==4){
                    $country_area_jp_name = mb_substr($country_area_jp->name, 0, -1);  
                }else{
                    $country_area_jp_name = $country_area_jp->name;
                }
                ?>
                @if(strpos($country_area_jp_name, '北海道')!==false) <div class="col-12 mb-4"><p class="h5 center"><strong class="text-{!!Util::getColors(rand(1,20))!!}-700">東北エリア</strong></p></div>@endif
                @if(strpos($country_area_jp_name, '茨城県')!==false) <div class="col-12 my-4"><p class="h5 center"><strong class="text-{!!Util::getColors(rand(1,20))!!}-700">関東エリア</strong></p></div>@endif
                @if(strpos($country_area_jp_name, '新潟県')!==false) <div class="col-12 my-4"><p class="h5 center"><strong class="text-{!!Util::getColors(rand(1,20))!!}-700">中部エリア</strong></p></div>@endif
                @if(strpos($country_area_jp_name, '三重県')!==false) <div class="col-12 my-4"><p class="h5 center"><strong class="text-{!!Util::getColors(rand(1,20))!!}-700">関西エリア</strong></p></div>@endif
                @if(strpos($country_area_jp_name, '鳥取県')!==false) <div class="col-12 my-4"><p class="h5 center"><strong class="text-{!!Util::getColors(rand(1,20))!!}-700">中国エリア</strong></p></div>@endif
                @if(strpos($country_area_jp_name, '徳島県')!==false) <div class="col-12 my-4"><p class="h5 center"><strong class="text-{!!Util::getColors(rand(1,20))!!}-700">四国エリア</strong></p></div>@endif
                @if(strpos($country_area_jp_name, '福岡県')!==false) <div class="col-12 my-4"><p class="h5 center"><strong class="text-{!!Util::getColors(rand(1,20))!!}-700">九州・沖縄エリア</strong></p></div>@endif
                <div class="mb-1 col-6 col-sm-3 col-lg-2 col-xl-2">
                  <a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}?country_area_id={!!$country_area_jp->ken_id!!}" class="">
                    <i class="icon icon-map-marker-radius text-red-700 s-6"></i><strong>{!!$country_area_jp_name!!}</strong>
                  </a>
                </div>
                @endforeach
                </div>
            </div>
        </div>
        @endif

        <div class="page-content pt-2 px-2">
            <div class="card">
                <div class="card-body row">
                <div class="col-12 mb-4"><p class="h4 center"><strong class="">その他のタイプで検索</strong></p></div>
                @foreach(UtilYoyaku::getNewContentTag($GLOBALS['yoyaku_type_key'],null) as $key=>$val)
                <div class="mb-3 col-6 col-sm-3 col-lg-2 col-xl-2">
                  <a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}?yoyaku_type_tag_id={!!$key!!}" class="">
                    <strong>{!!UtilYoyaku::getNewContentTagIcon($GLOBALS['yoyaku_type_id'],$key,null)!!}{!! $val !!}</strong>
                  </a>
                </div>
                @endforeach   
                <div class="mb-3 col-6 col-sm-3 col-lg-2 col-xl-2">
                  <a href="/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}?yoyaku_type_tag_id=0" class="">
                    <strong><i class="icon icon-all-inclusive text-green-800"></i>すべて</strong>
                  </a>
                </div>
                </div>
            </div>
        </div>

        <div class="page-content py-2 px-2">
            <div class="card">
                <div class="card-body row">
                    <div class="col-sm-6 col-lg-4 col-xl-3 mb-2">
                        <a href="/SenMonTen/占い/owner/register">
                            <p class="h5"><strong>オーナー登録で注目度アップ！</strong></p>
                            <p class="">オーナー登録をすると注目度を向上できます。</p>
                        </a>
                    </div>
                    <div class="col-sm-6 col-lg-4 col-xl-3 mb-2">
                        <a href="mailto:recruit@coordiy.co.jp">
                            <p class="h5"><strong>占いライター募集</strong></p>
                            <p class="">recruit@coordiy.co.jp
                            へメールエントリーお待ちしております。
                            占いがお好きな方であれば尚良いです。
                            </p>
                        </a>
                    </div>
                    <div class="col-sm-6 col-lg-4 col-xl-3 mb-2">
                        <a href="mailto:recruit@coordiy.co.jp">
                            <p class="h5"><strong>運営サポート募集</strong></p>
                            <p class="">recruit@coordiy.co.jp
                            へメールエントリーお待ちしております。
                            コンテンツの管理などのサポートをお願いします。
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @include('SenMonTen/include/footer')
        @include('include/footer')

    </div>

    @if(false)
    @include('include/quick')
    @endif

</div>


@stop

{{-- footer scripts --}}
@section('footer_scripts')

@include('/SenMonTen/include/seach_country_js')


<script>
document.getElementById( 'findContents' ).onclick = function( e )
{
    loading();
    findContents();
};
function findContents(){

    var inputSearch = $('#search-name').val();
    //console.log(inputSearch);
    if(!inputSearch){
        $('#loading').hide();
        return;
    }   
    moreContentsWords(inputSearch);

}
</script>

<script>





function moreContents(yoyaku_type_tag_id,country_area_id,country_area_address_one_custom_id,country_area_address_two_custom_id){

    var url = '/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}'
          + '?yoyaku_type_tag_id='+yoyaku_type_tag_id
          + '&country_area_id='+country_area_id
          + '&country_area_address_one_custom_id='+country_area_address_one_custom_id
          + '&country_area_address_two_custom_id='+country_area_address_two_custom_id;
  
    axios.get(url+'&page=1')
    .then(function (response) {
      if(isset(response.data)){
         //console.log(response.data);
        var more = '';
        more += '<button class="btn btn-outline-info" ';
        more += ' onclick="loading();';
        more += ' ajaxPaginationMore(\'';
        more += url+'&page=2';
        more += '\');return false;" >';
        more += '<strong>もっと</strong>';
        more += '</button>';
        document.getElementById('pageMore').innerHTML = more;
        $('#searchContents').html(response.data);
      }else{
        $('#searchContents').html('<div class="col-sm-12 center"><p class="h3"><strong>見つかりませんでした。<strong></p></div>');
      }
      $('#loading').hide();
    })
    .catch(function (error) {
      ajaxCheckError(error); return;
    });
}
</script>
@stop
