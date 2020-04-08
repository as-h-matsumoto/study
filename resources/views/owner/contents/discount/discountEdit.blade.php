@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 割引設定 @parent
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
              割引の適用方法は、以下の時間軸のご利用になる場合に「基本料金のxx%」の料金を適用します。<br />
              たとえば、基本料金が30分6000円に設定されている場合、「3時間以上」に80を設定すると30分4800円が適用されます。この場合3時間利用すると&yen;36000 -> &yen;28800となります。<br /><br />
              また、「3時間以上」に80を設定し、「6時間以上」に60を設定すると、30分3600円が適用されます。この場合6時間利用すると&yen;72000 -> &yen;43200となります。<br /><br />
              割引を設定しない場合は、そのまま「これで登録」を選択してください。
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
                    <input type="number" name="hour1" class="form-control form-control-lg center" id="hour1" value="{!! old('hour1',$content_discount->hour1) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="name">1時間以上</label>
                    @if ($errors->has('hour1'))<span class="help-block has-error"><strong>{{ $errors->first('hour1') }}</strong></span>@endif
                </div>
                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="hour2" class="form-control form-control-lg center" id="hour2" value="{!! old('hour2',$content_discount->hour2) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="name">2時間以上</label>
                    @if ($errors->has('hour2'))<span class="help-block has-error"><strong>{{ $errors->first('hour2') }}</strong></span>@endif
                </div>
                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="hour3" class="form-control form-control-lg center" id="hour3" value="{!! old('hour3',$content_discount->hour3) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="name">3時間以上</label>
                    @if ($errors->has('hour3'))<span class="help-block has-error"><strong>{{ $errors->first('hour3') }}</strong></span>@endif
                </div>
                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="hour4" class="form-control form-control-lg center" id="hour4" value="{!! old('hour4',$content_discount->hour4) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="name">4時間以上</label>
                    @if ($errors->has('hour4'))<span class="help-block has-error"><strong>{{ $errors->first('hour4') }}</strong></span>@endif
                </div>
                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="hour5" class="form-control form-control-lg center" id="hour5" value="{!! old('hour5',$content_discount->hour5) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="name">5時間以上</label>
                    @if ($errors->has('hour5'))<span class="help-block has-error"><strong>{{ $errors->first('hour5') }}</strong></span>@endif
                </div>
                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="hour6" class="form-control form-control-lg center" id="hour6" value="{!! old('hour6',$content_discount->hour6) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="name">6時間以上</label>
                    @if ($errors->has('hour6'))<span class="help-block has-error"><strong>{{ $errors->first('hour6') }}</strong></span>@endif
                </div>
                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="hour7" class="form-control form-control-lg center" id="hour7" value="{!! old('hour7',$content_discount->hour7) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="name">7時間以上</label>
                    @if ($errors->has('hour7'))<span class="help-block has-error"><strong>{{ $errors->first('hour7') }}</strong></span>@endif
                </div>
                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="hour8" class="form-control form-control-lg center" id="hour8" value="{!! old('hour8',$content_discount->hour8) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="name">8時間以上</label>
                    @if ($errors->has('hour8'))<span class="help-block has-error"><strong>{{ $errors->first('hour8') }}</strong></span>@endif
                </div>
                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="hour9" class="form-control form-control-lg center" id="hour9" value="{!! old('hour9',$content_discount->hour9) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="name">9時間以上</label>
                    @if ($errors->has('hour9'))<span class="help-block has-error"><strong>{{ $errors->first('hour9') }}</strong></span>@endif
                </div>
                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="hour10" class="form-control form-control-lg center" id="hour10" value="{!! old('hour10',$content_discount->hour10) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="name">10時間以上</label>
                    @if ($errors->has('hour10'))<span class="help-block has-error"><strong>{{ $errors->first('hour10') }}</strong></span>@endif
                </div>
                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="hour11" class="form-control form-control-lg center" id="hour11" value="{!! old('hour11',$content_discount->hour11) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="name">11時間以上</label>
                    @if ($errors->has('hour11'))<span class="help-block has-error"><strong>{{ $errors->first('hour11') }}</strong></span>@endif
                </div>
                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="hour12" class="form-control form-control-lg center" id="hour12" value="{!! old('hour12',$content_discount->hour12) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="name">12時間以上</label>
                    @if ($errors->has('hour12'))<span class="help-block has-error"><strong>{{ $errors->first('hour12') }}</strong></span>@endif
                </div>
                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="day2" class="form-control form-control-lg center" id="day2" value="{!! old('day2',$content_discount->day2) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="name">2日目以降</label>
                    @if ($errors->has('day2'))<span class="help-block has-error"><strong>{{ $errors->first('day2') }}</strong></span>@endif
                </div>
                <div class="form-group col-sm-3 col-6">
                    <input type="number" name="day3" class="form-control form-control-lg center" id="day3" value="{!! old('day3',$content_discount->day3) !!}" min="0" max="100" />
                    <label class="pl-2 f14 center" for="name">3日目以降</label>
                    @if ($errors->has('day3'))<span class="help-block has-error"><strong>{{ $errors->first('day3') }}</strong></span>@endif
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
