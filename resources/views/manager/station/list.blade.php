@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') 駅リスト @parent
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

    <div class="page-content p-4 bg-white-500 " style="overflow-y:scroll;">

        <div class="card">
            <div class="card-body">
                {!! Form::open(array('url' => '', 'id' => 'search_station', 'method' => 'post', 'class' => '', 'files'=> false)) !!}
                    <br />
                    <label for="search_station" >名前検索</label>
                    <input type="text" name="search_station" value="">
                    <a href="javascript:void(0)" onClick="loading(); searchStationName();" ><i class="icon icon-search-web"></i></a>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <a href="/manager/station/distance">コンテンツと駅の距離測定とアップデート</a>
            </div>
        </div>

{!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'name' => 'action', 'method' => 'post', 'class' => 'form-horizontal row-border', 'files'=> false)) !!}
<table class="table table-hover">
    <thead>
    <tr>
        <th>station_name</th>
        <th>post</th>
        <th>lon</th>
        <th width="70">lat</th>
    </tr>
    </thead>
    <tbody>

@foreach($stations as $station)
    <tr>
        <td>
            {!!$station->station_name!!}
        </td>
        <td>
            {!!$station->post!!}
        </td>
        <td>
            {!!$station->lon!!}
        </td>
        <td>
            {!!$station->lat!!}
        </td>
    </tr>
@endforeach

    </tbody>
</table>

<div class="right">
<button type="submit" class="submit-button btn btn-outline-info" aria-label="LOG IN">
    処理
</button>
</div>
</form>


    </div>
</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script>
function searchStationName(){

    var searchWords = $('input[name="search_station"]').val();
    if(!searchWords){
        $('#loading').hide();
        return;
    }

    location.href='/manager/station/import/list?searchWords='+searchWords;
    return;

}
</script>
@stop
