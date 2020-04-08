@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') コンテンツ概要登録 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
<style>
#main_progress_bar, #back_progress_bar{
  margin: 10px 0;
  padding: 3px;
  border: 1px solid #000;
  font-size: 14px;
  clear: both;
  opacity: 0;
  -moz-transition: opacity 1s linear;
  -o-transition: opacity 1s linear;
  -webkit-transition: opacity 1s linear;
}
#main_progress_bar.loading, #back_progress_bar.loading{
  opacity: 1.0;
}
#main_progress_bar .percent, #back_progress_bar percent{
  background-color: #99ccff;
  height: auto;
  width: 0;
}

#menu_step_progress_bar {
  margin: 10px 0;
  padding: 3px;
  border: 1px solid #000;
  font-size: 14px;
  clear: both;
  opacity: 0;
  -moz-transition: opacity 1s linear;
  -o-transition: opacity 1s linear;
  -webkit-transition: opacity 1s linear;
}
#menu_step_progress_bar.loading {
  opacity: 1.0;
}
#menu_step_progress_bar .percent {
  background-color: #99ccff;
  height: auto;
  width: 0;
}

</style>
@stop

{{-- content --}}
@section('content')
<div id="project-dashboard" class="page-layout simple full-width">

    @include('owner/contents/include/header')
    
    <div class="page-content p-2 mb-2">

        <div class="card pt-4">
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
            


                


                <div class="form-group col-sm-6 col-xl-4" >
                    <input type="text" name="name" class="form-control form-control-lg" id="name" value="{!! old('name',$content->name) !!}" />
                    <label class="pl-4" for="name"><i class="icon icon-star text-red-700"></i> {!! UtilYoyaku::getNewMenuSenMonTen($content->service) !!}名</label>
                    @if ($errors->has('name'))
                    <span class="help-block has-error"><strong>{{ $errors->first('name') }}</strong></span>
                    @endif
                </div>
            
                @if($content->service===15)
                <div class="form-group col-sm-6 col-xl-4">
                    <input type="number" name="allUseNumber" class="form-control form-control-lg center" id="allUseNumber" value="{!! old('allUseNumber',$content->allUseNumber) !!}" min="1" />
                    <label class="pl-4" for="price"><i class="icon icon-star text-red-700"></i> 貸切可能ご利用人数（最大：{!!$capacity_total!!}）</label>
                    <span class="help-block">貸切に対応しない場合は空白</span>
                    @if ($errors->has('allUseNumber'))
                    <span class="help-block has-error"><strong>{{ $errors->first('allUseNumber') }}</strong></span>
                    @endif
                </div>
                @endif

                <div class="form-group col-sm-6 col-xl-4">
                    <input type="time" name="last_time_yoyaku" class="form-control form-control-lg center" id="last_time_yoyaku" value="{!! old('last_time_yoyaku',$content->last_time_yoyaku) !!}" />
                    <label class="pl-4" for="last_time_yoyaku"><i class="icon icon-star text-red-700"></i> 利用時間のx分前まで予約受付する</label>
                    <span class="help-block">20分より短くできません。予約を受け付けてから準備できるまでの平均時間を登録してください。</span>
                    @if ($errors->has('last_time_yoyaku'))
                    <span class="help-block has-error"><strong>{{ $errors->first('last_time_order') }}</strong></span>
                    @endif
                </div>

                <div class="form-group col-sm-6 col-xl-4">
                    <input type="time" name="last_time_order" class="form-control form-control-lg center" id="last_time_order" value="{!! old('last_time_order',$content->last_time_order) !!}" />
                    <label class="pl-4" for="last_time_order"><i class="icon icon-star text-red-700"></i> @if($content->service===15){!!'ラストオーダー'!!}@else{!!'営業終了前の最終予約受付時間'!!}@endif</label>
                    <span class="help-block">初期値は営業終了時間の2時間前です。（4時間前に変更する場合は04:00と入力）。</span>
                    @if ($errors->has('last_time_order'))
                    <span class="help-block has-error"><strong>{{ $errors->first('last_time_order') }}</strong></span>
                    @endif
                </div>

                <div class="form-group col-sm-6 col-xl-4">
                    <input type="url" name="homepage" class="form-control form-control-lg center" id="homepage" value="{!! old('homepage',$content->homepage) !!}" />
                    <label class="pl-4" for="homepage">オリジナルサイト</label>
                    <span class="help-block">例 : http://test.com</span>
                    @if ($errors->has('homepage'))
                    <span class="help-block has-error"><strong>{{ $errors->first('homepage') }}</strong></span>
                    @endif
                </div>

                <div class="form-group col-sm-6 col-xl-4">
                    <input type="url" name="tell" class="form-control form-control-lg center" id="tell" value="{!! old('tell',$content->tell) !!}" />
                    <label class="pl-4" for="tell">お問合せ先電話番号</label>
                    <span class="help-block">例 : 03-2093-2093</span>
                    @if ($errors->has('tell'))
                    <span class="help-block has-error"><strong>{{ $errors->first('tell') }}</strong></span>
                    @endif
                </div>


                <div class="clearfix">　　</div>
                @if($content->service===91)
                <div class="form-group col-sm-4">
                    <label><i class="icon icon-star text-red-700"></i> 給与形態</label>
                    <select id="salary_type" name="salary_type" class="form-control form-control-lg center">
                        <option value="1">時給</option>
                        <option value="2">月給</option>
                    </select>
                    @if($errors->has('country-area-address-two'))<span class="help-block has-error">{{ $errors->first('country-area-address-two') }}</span>@endif
                </div>

                <div class="form-group col-sm-4 mt-5">
                    <input type="number" name="salary_min" class="form-control form-control-lg center" id="salary_min" value="{!! old('salary_min',$content->salary_min) !!}" min="737" min="2000000" />
                    <label class="pl-4" for="salary_min"><i class="icon icon-star text-red-700"></i> 最小給与</label>
                    @if ($errors->has('salary_min'))
                    <span class="help-block has-error"><strong>{{ $errors->first('salary_min') }}</strong></span>
                    @endif
                </div>

                <div class="form-group col-sm-4 mt-5">
                    <input type="number" name="salary_max" class="form-control form-control-lg center" id="salary_max" value="{!! old('salary_max',$content->salary_max) !!}" min="737" min="2000000" />
                    <label class="pl-4" for="salary_max"><i class="icon icon-star text-red-700"></i> 最大給与</label>
                    @if ($errors->has('salary_max'))
                    <span class="help-block has-error"><strong>{{ $errors->first('salary_max') }}</strong></span>
                    @endif
                </div>
                @endif




                
                
                @if($content->service===81)
                <div class=" col-sm-12 mb-6 mt-8 pt-4 border-top">
                    <p class="h5 center"><strong>子供・幼児・赤子の取り扱い</strong></p>
                    <p class="center">
                      <span class="help-block text-info">※子供料金・幼児料金・赤子料金(以下、子供料金)について</span><br />
                      <span class="help-block center">通常価格のパーセンテージで登録してください。(80を登録すると通常価格10000であれば8000となります。)</span>
                    </p>
                </div>
                <div class="form-group col-sm-6 col-xl-3">
                    <div class="form-check form-check-inline mt-5">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="kids" id="kids" value="1" @if($content->kids===1){!!'checked'!!}@endif />
                            <span class="checkbox-icon"></span>
                            <span class="form-check-description">子供(~10才未満)を1名としてカウント</span>
                        </label>
                    </div>
                </div>
                <div class="form-group col-sm-6 col-xl-3">
                    <input type="number" name="price_kids" class="form-control form-control-lg center" id="price_kids" value="{!! old('price_kids',$content->price_kids) !!}" min="1" min="200" />
                    <label class="pl-4" for="price">子供料金(~10才未満)</label>
                    @if ($errors->has('price_kids'))
                    <span class="help-block has-error"><strong>{{ $errors->first('price_kids') }}</strong></span>
                    @endif
                </div>

                <div class="form-group col-sm-6 col-xl-3">
                    <div class="form-check form-check-inline mt-5">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="yoji" id="yoji" value="1" />
                            <span class="checkbox-icon"></span>
                            <span class="form-check-description">幼児(~6才未満)を1名としてカウント</span>
                        </label>
                    </div>
                </div>
                <div class="form-group col-sm-6 col-xl-3">
                    <input type="number" name="price_yoji" class="form-control form-control-lg center" id="price_yoji" value="{!! old('price_yoji',$content->price_yoji) !!}" min="1" min="200" />
                    <label class="pl-4" for="price">幼児料金(~6才未満)</label>
                    @if ($errors->has('price_yoji'))
                    <span class="help-block has-error"><strong>{{ $errors->first('price_yoji') }}</strong></span>
                    @endif
                </div>

                <div class="form-group col-sm-6 col-xl-3">
                    <div class="form-check form-check-inline mt-5">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="baby" id="baby" value="1" />
                            <span class="checkbox-icon"></span>
                            <span class="form-check-description">赤子(~1才未満)を1名としてカウント</span>
                        </label>
                    </div>
                </div>
                <div class="form-group col-sm-6 col-xl-3">
                    <input type="number" name="price_baby" class="form-control form-control-lg center" id="price_baby" value="{!! old('price_baby',$content->price_baby) !!}" min="1" min="200" />
                    <label class="pl-4" for="price">赤子料金(~1才未満)</label>
                    @if ($errors->has('price_baby'))
                    <span class="help-block has-error"><strong>{{ $errors->first('price_baby') }}</strong></span>
                    @endif
                </div>
                @endif




                <div class="form-group col-sm-12 mt-4 mb-12">
                    <label class="pl-4" for="description"><i class="icon icon-star text-red-700"></i> {!! UtilYoyaku::getNewMenuSenMonTen($content->service) !!}の概要</label>
                    <textarea name="description" class="form-control form-control-lg" id="description" style="min-height: 200px;" />{!! old('description',$content->description) !!}</textarea>
                    @if ($errors->has('description'))
                    <span class="help-block has-error"><strong>{{ $errors->first('description') }}</strong></span>
                    @endif
                    <a href="javascript:void(0)" class="f14 text-blue-500" onClick="descExample()">サンプルを利用</a>
                </div>



<div class="form-group col-xl-6 center">
    <div class="row mb-2">
      <div class="col-sm-6">
        <label for="mainPic" class="btn form-control-label f14 text-blue-700"><strong>メイン写真アップ</strong></label>
        <input accept="image/*" type="file" class="" id="mainPic" name="mainPic" />
        <br /><span class="pt-4 mt-4" id="main_progress_bar"><span class="percent" style="padding:0px 50px;">0%</span></span>
      </div>
      <div id="mainpreview" class="col-sm-6">
        <img src="@if($content->pic){{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content->id, 400)}}@endif" style="width:120px;" />
      </div>
    </div>
</div>

<div class="form-group col-xl-6 center">
    <div class="row mb-2">
      <div class="col-sm-6">
        <label for="backPic" class="btn form-control-label f14 text-blue-700"><strong>バック写真アップ</strong></label>
        <input accept="image/*" type="file" class="" id="backPic" name="backPic" />
        <br /><span class="pt-4 mt-4" id="back_progress_bar"><span class="percent" style="padding:0px 50px;">0%</span></span>
      </div>
      <div id="backpreview" class="col-sm-6">
        <img src="@if($content->back_pic){{Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), true, $content->back_pic, $content->id, 400)}}@endif" style="width:120px;" />
      </div>
    </div>
</div>

        
            </form>

            </div>
        </div>

        <div class="card pt-4">
            <div class="card-block-me p-0 m-0 row">
                <div id="stepArea" class="card-body row">
                    <div class="center col-12 py-4">
                        <p class="text-warning ">
                        Gポイントが登録されていません。<br />
                        Gポイントは訴求力がとても高い機能です。必ず登録することをお勧めします。<br />
                        左下の<i class="icon icon-debug-step-over text-green-500 s-6" title="Gポイント追加" alt="Gポイント追加"></i>から登録できます。
                        </p>
                    </div>
                </div>
                
            </div>
            <div class="card-actions">
                <button onClick="stepModal(null)" class="action-btn action-btn-footer"><i class="icon icon-debug-step-over text-green-500 s-7 px-6" title="Gポイント追加" alt="Gポイント追加"></i></button>
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


<div class="modal fade" id="stepModal" tabindex="-1" role="dialog" aria-labelledby="stepModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stepModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'stepForm', 'name' => 'stepForm', 'method' => 'post', 'class' => 'row', 'files'=> true)) !!}

                    <input type="hidden" class="form-control" name="step_id" id="stepFormId" value="" >


<div class="form-group col-sm-12">
    <label for="title" class="form-control-label">Gポイントタイトル</label>
    <input type="text" max="40" class="form-control form-control-lg" name="title" id="stepTitle">
</div>

<div class="form-group col-sm-12">
    <label for="description" class="form-control-label">Gポイント詳細</label>
    <textarea max="1000" class="form-control form-control-lg" name="description" id="stepDescription"></textarea>
</div>

<div class="form-group col-sm-12 center">
    <div class="row mb-2">
      <div class="col-sm-6">
        <label for="stepFormPic" class="btn form-control-label f14 text-blue-700"><strong>Gポイント写真アップ</strong></label>
        <input accept="image/*" type="file" class="" id="stepFormPic" name="pic" />
        <br /><span class="pt-4 mt-4" id="menu_step_progress_bar"><span class="percent" style="padding:0px 50px;">0%</span></span>
      </div>
      <div id="steppreview" class="col-sm-6">
        <img src="" style="width:120px;" />
      </div>
    </div>
</div>

                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); postStep();" ><strong>{!!Util::getIcon('add','s-4','green')!!} 登録</strong></button>
            </div>
        </div>
    </div>
</div>

@stop

{{-- footer scripts --}}
@section('footer_scripts')

@include('owner/contents/desc/include/js_step_insert')
@include('owner/contents/desc/include/js_step')




<script>


function descExample() {
    axios.get('/owner/contents/{!!$content->id!!}/desc/descExample')
    .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}
        var description = response.data;
        $('#description').val(description);
    })
    .catch(function (error) {
      ajaxCheckError(error); return;
    });
}
    
$(document).ready(function () {

    //content steps
    axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getSteps')
    .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}
        var steps = response.data;
  
        var insert = '';
        if(isset(steps)){
            $.each(steps,function(index,step){
                insert += createStep(step);
            });
            $('#stepArea').html(insert);
        }
    })
    .catch(function (error) {
      ajaxCheckError(error); return;
    });

});




function MainhandleFileSelect(evt) {
  // Reset progress indicator on new file selection.
  progress.style.width = '0%';
  progress.textContent = '0%';
  reader = new FileReader();
  reader.onerror = errorHandler;
  reader.onprogress = updateProgress;
  reader.onabort = function(e) {
    alert('File read cancelled');
  };
  reader.onloadstart = function(e) {
    document.getElementById('main_progress_bar').className = 'loading';
  };
  var file = evt.target.files[0];
  reader.onload = (function(theFile) {
      return function(e) {
          progress.style.width = '100%';
          progress.textContent = '100%';
          setTimeout("document.getElementById('main_progress_bar').className='';", 2000);
          // Render thumbnail.
          $('#mainpreview img').attr('src',e.target.result);
      };
  })(file);
  reader.readAsDataURL(file);
}
document.getElementById('mainPic').addEventListener('change', MainhandleFileSelect, false);


function BackhandleFileSelect(evt) {
  // Reset progress indicator on new file selection.
  progress.style.width = '0%';
  progress.textContent = '0%';
  reader = new FileReader();
  reader.onerror = errorHandler;
  reader.onprogress = updateProgress;
  reader.onabort = function(e) {
    alert('File read cancelled');
  };
  reader.onloadstart = function(e) {
    document.getElementById('back_progress_bar').className = 'loading';
  };
  var file = evt.target.files[0];
  reader.onload = (function(theFile) {
      return function(e) {
          progress.style.width = '100%';
          progress.textContent = '100%';
          setTimeout("document.getElementById('back_progress_bar').className='';", 2000);
          // Render thumbnail.
          $('#backpreview img').attr('src',e.target.result);
      };
  })(file);
  reader.readAsDataURL(file);
}
document.getElementById('backPic').addEventListener('change', BackhandleFileSelect, false);

function MenuStephandleFileSelect(evt) {
  // Reset progress indicator on new file selection.
  progress.style.width = '0%';
  progress.textContent = '0%';
  reader = new FileReader();
  reader.onerror = errorHandler;
  reader.onprogress = updateProgress;
  reader.onabort = function(e) {
    alert('File read cancelled');
  };
  reader.onloadstart = function(e) {
    document.getElementById('menu_step_progress_bar').className = 'loading';
  };
  var file = evt.target.files[0];
  reader.onload = (function(theFile) {
      return function(e) {
          progress.style.width = '100%';
          progress.textContent = '100%';
          setTimeout("document.getElementById('menu_step_progress_bar').className='';", 2000);
          // Render thumbnail.
          $('#steppreview img').attr('src',e.target.result);
      };
  })(file);
  reader.readAsDataURL(file);
}
document.getElementById('stepFormPic').addEventListener('change', MenuStephandleFileSelect, false);

<?php 
$message_on = null;
$messages = '';
if(!$content->pic){
  $message_on = true;
  $messages = 'イメージ';
}
if(!$content->description){
  if($message_on){
    $messages = $messages . 'や概要';
  }else{
    $message_on = true;
    $messages = $messages . '概要';
  }
}
?>
@if($message_on)
infoNotify('{!! UtilYoyaku::getNewMenuSenMonTen($content->service) !!}{!!'の'!!}{!!$messages!!}を登録してください。');
@endif

</script>




@stop
