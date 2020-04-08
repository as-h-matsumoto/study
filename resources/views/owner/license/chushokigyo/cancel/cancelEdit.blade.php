@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') キャンセル料登録・編集 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')
<div id="project-dashboard" class="page-layout simple full-width">

    @include('owner/contents/include/header')
    
    <div class="page-content p-2 mb-2">

        <div class="card">
            <div class="card-body">
            <p class="read pb-8">
              支払決済機能をご利用の場合のみキャンセル料が有効となります。<br />
              キャンセル料がかかる場合は料金に対する割合を％で入力してください。（例: 料金の40％をキャンセル料とする場合は40と入力）<br />
              キャンセル料がかからない場合は0です。<br />
              当日キャンセル料は100%から変更できません。
            </p>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'name' => 'action', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}
            
                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="today" class="form-control form-control-lg center" id="today" value="100" disabled min="0" max="100" />
                    <label class="pl-2 f14 center" for="name">当日キャンセル料</label>
                </div>
            
                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="day1" class="form-control form-control-lg center" id="day1" value="{!! old('day1',$content_cancel_calendar->day1) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="day1">前日キャンセル料</label>
                    @if ($errors->has('day1'))
                    <span class="help-block has-error">
                        <strong>{{ $errors->first('day1') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="day2" class="form-control form-control-lg center" id="day2" value="{!! old('day2',$content_cancel_calendar->day2) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="day2">２日前キャンセル料</label>
                    @if ($errors->has('day2'))
                    <span class="help-block has-error">
                        <strong>{{ $errors->first('day2') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="day3" class="form-control form-control-lg center" id="day3" value="{!! old('day3',$content_cancel_calendar->day3) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="day3">３日前キャンセル料</label>
                    @if ($errors->has('day3'))
                    <span class="help-block has-error">
                        <strong>{{ $errors->first('day3') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="day4" class="form-control form-control-lg center" id="day4" value="{!! old('day4',$content_cancel_calendar->day4) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="day4">４日前キャンセル料</label>
                    @if ($errors->has('day4'))
                    <span class="help-block has-error">
                        <strong>{{ $errors->first('day4') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="day5" class="form-control form-control-lg center" id="day5" value="{!! old('day5',$content_cancel_calendar->day5) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="day5">５日前キャンセル料</label>
                    @if ($errors->has('day5'))
                    <span class="help-block has-error">
                        <strong>{{ $errors->first('day5') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="day6" class="form-control form-control-lg center" id="day6" value="{!! old('day6',$content_cancel_calendar->day6) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="day6">６日前キャンセル料</label>
                    @if ($errors->has('day6'))
                    <span class="help-block has-error">
                        <strong>{{ $errors->first('day6') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="day7" class="form-control form-control-lg center" id="day7" value="{!! old('day7',$content_cancel_calendar->day7) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="day7">７日前キャンセル料</label>
                    @if ($errors->has('day7'))
                    <span class="help-block has-error">
                        <strong>{{ $errors->first('day7') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="day8" class="form-control form-control-lg center" id="day8" value="{!! old('day8',$content_cancel_calendar->day8) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="day8">８日前キャンセル料</label>
                    @if ($errors->has('day8'))
                    <span class="help-block has-error">
                        <strong>{{ $errors->first('day8') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="day9" class="form-control form-control-lg center" id="day9" value="{!! old('day9',$content_cancel_calendar->day9) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="day9">９日前キャンセル料</label>
                    @if ($errors->has('day9'))
                    <span class="help-block has-error">
                        <strong>{{ $errors->first('day9') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="day10" class="form-control form-control-lg center" id="day10" value="{!! old('day10',$content_cancel_calendar->day10) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="day10">１０日前キャンセル料</label>
                    @if ($errors->has('day10'))
                    <span class="help-block has-error">
                        <strong>{{ $errors->first('day10') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="day11" class="form-control form-control-lg center" id="day11" value="{!! old('day11',$content_cancel_calendar->day11) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="day11">１１日前キャンセル料</label>
                    @if ($errors->has('day11'))
                    <span class="help-block has-error">
                        <strong>{{ $errors->first('day11') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="day12" class="form-control form-control-lg center" id="day12" value="{!! old('day12',$content_cancel_calendar->day12) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="day12">１２日前キャンセル料</label>
                    @if ($errors->has('day12'))
                    <span class="help-block has-error">
                        <strong>{{ $errors->first('day12') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="day13" class="form-control form-control-lg center" id="day13" value="{!! old('day13',$content_cancel_calendar->day13) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="day13">１３日前キャンセル料</label>
                    @if ($errors->has('day13'))
                    <span class="help-block has-error">
                        <strong>{{ $errors->first('day13') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="day14" class="form-control form-control-lg center" id="day14" value="{!! old('day14',$content_cancel_calendar->day14) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="day14">１４日前キャンセル料</label>
                    @if ($errors->has('day14'))
                    <span class="help-block has-error">
                        <strong>{{ $errors->first('day14') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="day15" class="form-control form-control-lg center" id="day15" value="{!! old('day15',$content_cancel_calendar->day15) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="day15">１５日前キャンセル料</label>
                    @if ($errors->has('day15'))
                    <span class="help-block has-error">
                        <strong>{{ $errors->first('day15') }}</strong>
                    </span>
                    @endif
                </div>
        
            </form>

            </div>
        </div>

        

    </div>

    <div class="page-content-footer">
        <p class="right">
            <button class="btn btn-outline-info" onclick="loading();document.action.submit();return false;" >
                <strong>登録</strong>
            </button>
        </p>
    </div>

    @include('owner/include/footer')
    @include('include/footer')

</div>
@include('owner/contents/include/modal')

@stop

{{-- footer scripts --}}
@section('footer_scripts')
@stop
