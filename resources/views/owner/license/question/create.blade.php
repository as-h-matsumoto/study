@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 問題作成 @parent
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

  @include('owner/include/header')

  <div class="page-content p-2 mb-2">
    <div class="card">
      <div class="card-body">

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

          <div class="form-group col-sm-6 col-xl-4 center pb-6">
              <label class="form-control-label"><i class="icon icon-star text-red-700"></i> <strong>年度</strong></label>
              <select class="custom-select mt-2" name="year">
                  <?php $year = date('Y'); $selected = date("Y",strtotime("-2 year")); $year_last = $year - 20; ?>
                  @for ($i = $year; $i > $year_last; $i--)
                  <option value="{!!$i!!}" @if($selected == $i) selected @endif >{!!$i!!}</option>
                  @endfor
                  <option value="origin">オリジナル</option>
              </select>
          </div>

          <div class="form-group col-sm-6 col-xl-4 center pb-6">
              <label class="form-control-label"><i class="icon icon-star text-red-700"></i> <strong>フェーズ</strong></label>
              <select class="custom-select mt-2" name="phase">
                  <option value="1" >一次試験</option>
                  <option value="2"  selected>二次試験</option>
              </select>
          </div>

          
          <div class="form-group col-sm-6 col-xl-4 center pb-6" >
              <label class="pl-4"><i class="icon icon-star text-red-700"></i> <strong>科目</strong></label>
              <select class="custom-select mt-2" name="subject">
                @foreach($license_examination_subject as $key=>$val)
                  <option value="{{$val->id}}" @if($key===10) selected @endif >{{$val->name}}</option>
                @endforeach
              </select>
          </div>
          
          <div class="form-group col-sm-6 col-xl-4 center pb-6">
              <label class="form-control-label"><i class="icon icon-star text-red-700"></i> <strong>問題</strong> </label>
              <select class="custom-select mt-2" name="number">
                  @for ($i = 1; $i <= 100; $i++)
                  <option value="{!!$i!!}">問題 {!!$i!!}</option>
                  @endfor
              </select>
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

</div>
@stop



{{-- footer scripts --}}
@section('footer_scripts')
@stop


