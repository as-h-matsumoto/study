@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') チェックコンテンツカスタム @parent
@stop


@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop


{{-- content --}}
@section('content')
<div id="project-dashboard" class="page-layout simple full-width">

    @include('manager/include/header')

    <div class="page-content">


<?php
$count = 1;
$country_areas = DB::table('country_area')
  ->select('ken_id','name')
  ->where('country_id',392)
  ->get();
$services = UtilYoyaku::getNewMenuSenMonTen(null);
?>
    <p>
    @foreach($country_areas as $country_area)
        <?php
        $count++;
        $kens = DB::table('city_address')
          ->select('city_id','city_name')
          ->where('ken_id',$country_area->ken_id)
          ->get();
          //logger('kens?');
        ?>
        @foreach($kens as $ken)
        <?php $count++; ?>
            @foreach($services as $service_id=>$service_name)
            <?php $count++; ?>
            <a class="pr-2" href="/manager/contents/check/custom?country_area_id={!!$country_area->ken_id!!}&country_area_address_one_id={!!$ken->city_id!!}&yoyaku_type_id={!!$service_id!!}" >
              {!!$country_area->name!!}{!!$ken->city_name!!}の{!!$service_name!!}
            </a>
            @endforeach
        @endforeach
    @endforeach
    </p>
    <p>合計:{!!$count!!}件対応</p>
    </div>





    <div class="page-content p-4" style="overflow-y:scroll;">

        <p class="h3" ><strong>コンテンツチェック</strong></p>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>コンテンツ</th>
                <th style="width:150px !important;">コンテンツ名</th>
                <th>コンテンツタグ</th>
                <th>ACTION</th>
            </tr>
            </thead>
            <tbody id="searchContents">
        
        
            </tbody>
        </table>

        <div class="page-content-footer">
        </div>

    </div>





</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script>
function postContentTags(content_id){

    var form = document.getElementById("content" + content_id);
    var form_data = new FormData(form);

    axios.post('/manager/contents/check', form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}

        $('#deleContent' + content_id).remove();
        $('#loading').hide();
        successNotify('登録しました。');
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

}









</script>
@stop
