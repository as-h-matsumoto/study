@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 問題テーマ作成 @parent
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

          <div class="form-group col-sm-4">
              <label class="form-control-label"><i class="icon icon-star text-red-700"></i> <strong>年度</strong></label>
              <select class="custom-select mt-2" name="year">
                  <?php $year = date('Y'); $selected = date("Y",strtotime("-2 year")); $year_last = $year - 20; ?>
                  @for ($i = $year; $i > $year_last; $i--)
                  <option value="{!!$i!!}" @if($selected == $i) selected @endif >{!!$i!!}</option>
                  @endfor
                  <option value="origin">オリジナル</option>
              </select>
          </div>

          <div class="form-group col-sm-4">
              <label class="form-control-label"><i class="icon icon-star text-red-700"></i> <strong>フェーズ</strong></label>
              <select class="custom-select mt-2" name="phase">
                  <option value="2" selected >二次試験</option>
              </select>
          </div>
          
          <div class="form-group col-sm-4" >
              <label class="pl-4"><i class="icon icon-star text-red-700"></i> <strong>科目</strong></label>
              <select class="custom-select mt-2" name="subject">
                @foreach($license_examination_subject as $key=>$val)
                  <option value="{{$val->id}}" @if($key===7) selected @endif >{{$val->name}}</option>
                @endforeach
              </select>
          </div>
          
          <div class="form-group col-sm-12 pb-6" >
            <label class="pl-4 form-control-lg"><i class="icon icon-star text-red-700"></i><strong>問題テーマ</strong></label>
            <textarea name="question" class="form-control form-control-lg" style="height:200px" >{!! old('question') !!}</textarea>
            @if ($errors->has('question'))
            <span class="help-block has-error"><strong>{{ $errors->first('question') }}</strong></span>
            @endif
          </div>

          <div class="form-group col-xl-6 center">
              <div>
                <label class=" form-control-label"><strong>図１</strong></label>
                <input accept="image/*" type="file" id="figure1" name="figure1" />
              </div>
              <div>
                <img id="viewfigure1" src="" style="width:100%;" />
              </div>
          </div>

          <div class="form-group col-xl-6 center">
              <div>
                <label class="form-control-label"><strong>図２</strong></label>
                <input accept="image/*" type="file" class="" id="figure2" name="figure2" />
              </div>
              <div>
                <img id="viewfigure2" src="" style="width:100%;" />
              </div>
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

<script>
$(document).ready(function(){

  $('#figure1').on('change', function (e) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $("#viewfigure1").attr('src', e.target.result);
      }
      reader.readAsDataURL(e.target.files[0]);
  });
  
  $('#figure2').on('change', function (e) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $("#viewfigure2").attr('src', e.target.result);
      }
      reader.readAsDataURL(e.target.files[0]);
  });

});
</script>

@stop


