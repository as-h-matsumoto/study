@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 問題概要編集 @parent
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

        {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'name' => 'action', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}

          <div class="form-group col-sm-6 col-xl-4 center pb-6">
              <label class="form-control-label"><i class="icon icon-star text-red-700"></i> 年度</label>
              <select class="custom-select mt-2" name="year">
                  <?php $year = date('Y'); $year_last = $year - 20; ?>
                  @for ($i = $year; $i > $year_last; $i--)
                  <option value="{!!$i!!}" @if($i===$license_schedule->license_year) selected @endif >{!!$i!!}</option>
                  @endfor
                  <option value="9999">オリジナル</option>
              </select>
          </div>

          <div class="form-group col-sm-6 col-xl-4 center pb-6">
              <label class="form-control-label"><i class="icon icon-star text-red-700"></i> フェーズ</label>
              <select class="custom-select mt-2" name="phase">
                  <option value="1" @if(1===$license_schedule->license_phase) selected @endif >一次試験</option>
                  <option value="2" @if(2===$license_schedule->license_phase) selected @endif >二次試験</option>
              </select>
          </div>
          
          <div class="form-group col-sm-6 col-xl-4 center pb-6" >
              <label class="pl-4"><i class="icon icon-star text-red-700"></i> 科目</label>
              <select class="custom-select mt-2" name="subject">
                @foreach($license_examination_subject as $key=>$val)
                  <option value="{{$val->id}}" @if($val->id===$license_question->license_examination_subject_id) selected @endif >{{$val->name}}</option>
                @endforeach
              </select>
          </div>

          <div class="form-group col-sm-6 col-xl-4 center pb-6">
              <label class="form-control-label"><i class="icon icon-star text-red-700"></i> 問題</label>
              <select class="custom-select mt-2" name="number">
                  @for($y = 1; $y <= 100; $y++)
                  <option value="{!!$y!!}" @if($y===$license_question->number) selected @endif >問題 {!!$y!!}</option>
                  @endfor
              </select>
          </div>

        </form>
      </div>
    </div>
  </div>

  <div class="page-content-footer row">
    <div class="col-sm-6">
      <p class="left">
          <a href="/owner/license/{!!$license->id!!}/question/{!!$license_question->id!!}/edit" class="btn btn-outline-info" >
              <strong>問題編集</strong>
          </a>
      </p>
    </div>
    <div class="col-sm-6">
      <p class="right">
          <button class="btn btn-outline-info" onclick="loading();document.action.submit();return false;" >
              <strong>登録</strong>
          </button>
      </p>
    </div>
  </div>
  
  @include('owner/include/footer')
  @include('include/footer')

  </div>
  
</div>
@stop



{{-- footer scripts --}}
@section('footer_scripts')
@stop


