@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') オーナーインポート @parent
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

    <div class="py-8">
        <p class="center h3">オーナーインポート</p>
        <p class="center">
            <a href="/storage/global/csv/itown_import_format.csv" class="h5 text-blue" target="_blank"><strong>
                import_format.csv
            </strong></a>
        </p>
    </div>

{!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'name' => 'action', 'method' => 'post', 'class' => 'form-horizontal row-border', 'files'=> true)) !!}
<div class="form-group col-xl-12 center">
        <label for="csv" class="btn form-control-label f14 text-blue-700"><strong>csv</strong></label>
        <input type="file" class="" id="csv" name="csv" />
</div>
<button type="submit" class="submit-button btn btn-outline-info" aria-label="action">
    処理
</button>
</form>

<div class="right">

</div>
</form>


    </div>
</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')
@stop
