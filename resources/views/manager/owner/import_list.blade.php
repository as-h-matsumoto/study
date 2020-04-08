@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') オーナーリクエスト @parent
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
                {!! Form::open(array('url' => '', 'id' => 'content_csv', 'method' => 'post', 'class' => '', 'files'=> false)) !!}
                    <br />
                    <label for="content_csv" >名前検索</label>
                    <input type="text" name="content_csv" value="">
                    <a href="javascript:void(0)" onClick="loading(); searchContentCSVName();" ><i class="icon icon-search-web"></i></a>
                </form>
            </div>
        </div>

{!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'name' => 'action', 'method' => 'post', 'class' => 'form-horizontal row-border', 'files'=> false)) !!}
<table class="table table-hover">
    <thead>
    <tr>
        <th>user</th>
        <th>所在地</th>
        <th>ホームページ<br />
            電話番号</th>
        <th width="70">利用サービス</th>
        <th>ACTION</th>
    </tr>
    </thead>
    <tbody>

@foreach($owners as $owner)
    <tr>
        <td>
            {!!$owner->id!!}<br />
            {!!$owner->name!!}<br />
            {!!$owner->email!!}<br />
            {!!$owner->csv_password!!}
        </td>
      <td>{!! Util::getCountryAreaName($owner['company']->country_area) !!}<br />
          {!! Util::getCountryAreaOneName($owner['company']->country_area_address_one) !!}<br />
          {!! Util::getCountryAreaTwoName($owner['company']->country_area_address_two) !!}<br />
          {!! $owner['company']->country_area_address_other !!}
      </td>
      <td>
          <a class="text-blue-700" href="{!! $owner['company']->homepage !!}">{!! $owner['company']->homepage !!}</a>
          <br /><span>{!! $owner['company']->tell !!}</span>
      </td>
      <td>
      service
      </td>
      <td>
        <SELECT name="companyRequest{!!$owner->id!!}">
            <OPTION value="255|{!!$owner->id!!}">--</OPTION>
            <OPTION value="0|{!!$owner->id!!}">非承認(mail)</OPTION>
            <OPTION value="1|{!!$owner->id!!}">承認(mail)</OPTION>
        </SELECT>
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
function searchContentCSVName(){

    var searchWords = $('input[name="content_csv"]').val();
    if(!searchWords){
        $('#loading').hide();
        return;
    }

    location.href='/manager/owner/import/list?searchWords='+searchWords;
    return;

}
</script>
@stop
