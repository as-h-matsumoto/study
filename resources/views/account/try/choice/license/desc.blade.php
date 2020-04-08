@extends('account/layouts/default')

{{-- Page title --}}
@section('title') 中小企業診断士 過去問題選択 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')
<div id="profile" class="page-layout simple right-sidebar">

  <div class="page-content-wrapper">

  @include('account/include/header')

  <div class="page-content p-2 mb-2">
    <div class="card">
      <div class="card-body">
        
        <div class="m-4">
            <p class="h4 center pb-10">{!!$license->name!!}　過去問受験</p>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'name' => 'action', 'method' => 'post', 'class' => 'row', 'files'=> true)) !!}

          <div class="form-group col-sm-6 col-xl-3 center pb-6">
              <label class="form-control-label"><i class="icon icon-star text-red-700"></i> <strong>年度</strong></label>
              <select class="custom-select mt-2" name="year">
                  @for ($i = 2018; $i >= 2017; $i--)
                  <option value="{!!$i!!}" >{!!$i!!}</option>
                  @endfor
              </select>
          </div>
          <div class="form-group col-sm-6 col-xl-3 center pb-6">
              <label class="form-control-label"><i class="icon icon-star text-red-700"></i> <strong>タイプ</strong></label>
              <select class="custom-select mt-2" name="type">
                  <option value="1">練習問題</option>
                  <option value="2">模擬試験</option>
              </select>
          </div>

          <div class="form-group col-sm-6 col-xl-6 center pb-6" >
              <label class="pl-4"><i class="icon icon-star text-red-700"></i> <strong>科目</strong></label>
              <select class="custom-select  mt-2" name="subject">
                @foreach($license_examination_subject as $key=>$val)
                  <option class="" value="{{$val->id}}">{{$val->name}} ({!!$val->license_phase.'次試験'!!})</option>
                @endforeach
              </select>
          </div>
          
        </form>
      </div>
    </div>
  </div>

  <div class="page-content-footer">
      <p class="right">
          <button class="btn btn-outline-info" onclick="loading();document.action.submit();return false;" >
              <strong>Ｔｒｙ</strong>
          </button>
      </p>
  </div>
  
  @include('owner/include/footer')
  @include('include/footer')

  </div>

</div>
@stop



{{-- footer scripts --}}
@section('footer_scripts')
@stop


