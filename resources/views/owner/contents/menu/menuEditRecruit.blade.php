@extends('owner/layouts/default')
{{-- Page title --}}
@section('title') メニュー登録 @parent
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

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{!! Form::open(array('url' => $_SERVER["REQUEST_URI"].'/recruit', 'name' => 'action', 'method' => 'post', 'class' => ' row', 'files'=> false)) !!}

    <div class="form-group col-sm-6">
        <label class="pb-3"><i class="icon icon-star text-red-700"></i> 最大面接回数</label>
        @if($errors->has('use_test_level'))<span class="help-block has-error">{{ $errors->first('use_test_level') }}</span>@endif
        <select onChange="levelChangeFunc()" class="form-control form-control-lg center" name="use_test_level" id="use_test_level">
            <option value="1" @if(is_array(old('use_test_level')) && in_array(1, old('use_test_level'))) checked @endif @if($content_recruit->use_test_level===1) selected @endif >1回</option>
            <option value="2" @if(is_array(old('use_test_level')) && in_array(2, old('use_test_level'))) checked @endif @if($content_recruit->use_test_level===2) selected @endif >2回</option>
            <option value="3" @if(is_array(old('use_test_level')) && in_array(3, old('use_test_level'))) checked @endif @if($content_recruit->use_test_level===3) selected @endif >3回</option>
            <option value="4" @if(is_array(old('use_test_level')) && in_array(4, old('use_test_level'))) checked @endif @if($content_recruit->use_test_level===4) selected @endif >4回</option>
            <option value="5" @if(is_array(old('use_test_level')) && in_array(5, old('use_test_level'))) checked @endif @if($content_recruit->use_test_level===5) selected @endif >5回</option>
            <option value="6" @if(is_array(old('use_test_level')) && in_array(6, old('use_test_level'))) checked @endif @if($content_recruit->use_test_level===6) selected @endif >6回</option>
            <option value="7" @if(is_array(old('use_test_level')) && in_array(7, old('use_test_level'))) checked @endif @if($content_recruit->use_test_level===7) selected @endif >7回</option>
            <option value="8" @if(is_array(old('use_test_level')) && in_array(8, old('use_test_level'))) checked @endif @if($content_recruit->use_test_level===8) selected @endif >8回</option>
        </select>
        <span class="help-block">最大の面接回数(書類選考を抜く)を選んでください。</span>
    </div>

    <div class="form-group col-sm-6">
        <label for="time" class="form-control-label mb-6">面接時間</label>
        <select class="custom-select" name="time" id="time" style="width:100%">
            <option value="30"  @if(is_array(old('time')) && in_array(30, old('time')))  checked @endif @if($content_recruit->time===30) selected @endif >30分</option>
            <option value="60"  @if(is_array(old('time')) && in_array(60, old('time')))  checked @endif @if($content_recruit->time===60) selected @endif >1時間</option>
            <option value="90"  @if(is_array(old('time')) && in_array(90, old('time')))  checked @endif @if($content_recruit->time===90) selected @endif >1時間30分</option>
            <option value="120" @if(is_array(old('time')) && in_array(120, old('time'))) checked @endif @if($content_recruit->time===120) selected @endif >2時間</option>
            <option value="150" @if(is_array(old('time')) && in_array(150, old('time'))) checked @endif @if($content_recruit->time===150) selected @endif >2時間30分</option>
            <option value="180" @if(is_array(old('time')) && in_array(180, old('time'))) checked @endif @if($content_recruit->time===180) selected @endif >3時間</option>
            <option value="210" @if(is_array(old('time')) && in_array(210, old('time'))) checked @endif @if($content_recruit->time===210) selected @endif >3時間30分</option>
            <option value="240" @if(is_array(old('time')) && in_array(240, old('time'))) checked @endif @if($content_recruit->time===240) selected @endif >4時間</option>
            <option value="270" @if(is_array(old('time')) && in_array(270, old('time'))) checked @endif @if($content_recruit->time===270) selected @endif >4時間30分</option>
            <option value="300" @if(is_array(old('time')) && in_array(300, old('time'))) checked @endif @if($content_recruit->time===300) selected @endif >5時間</option>
            <option value="330" @if(is_array(old('time')) && in_array(330, old('time'))) checked @endif @if($content_recruit->time===330) selected @endif >5時間30分</option>
            <option value="360" @if(is_array(old('time')) && in_array(360, old('time'))) checked @endif @if($content_recruit->time===360) selected @endif >6時間</option>
            <option value="390" @if(is_array(old('time')) && in_array(390, old('time'))) checked @endif @if($content_recruit->time===390) selected @endif >6時間30分</option>
            <option value="420" @if(is_array(old('time')) && in_array(420, old('time'))) checked @endif @if($content_recruit->time===420) selected @endif >7時間</option>
            <option value="450" @if(is_array(old('time')) && in_array(450, old('time'))) checked @endif @if($content_recruit->time===450) selected @endif >7時間30分</option>
            <option value="480" @if(is_array(old('time')) && in_array(480, old('time'))) checked @endif @if($content_recruit->time===480) selected @endif >8時間</option>
        </select>
    </div>

    <div class="form-group col-sm-12">
        <label><i class="icon icon-star text-red-700"></i> 採用形態</label>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="recruit_type[]" value="1" @if(is_array(old('recruit_type')) && in_array(1, old('recruit_type'))) checked @endif @if($content_recruit->recruit_type_1) checked @endif />
                <span class="checkbox-icon"></span>
                <span class="form-check-description">正社員</span>
            </label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="recruit_type[]" value="2" @if(is_array(old('recruit_type')) && in_array(2, old('recruit_type'))) checked @endif @if($content_recruit->recruit_type_2) checked @endif />
                <span class="checkbox-icon"></span>
                <span class="form-check-description">派遣</span>
            </label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="recruit_type[]" value="3" @if(is_array(old('recruit_type')) && in_array(3, old('recruit_type'))) checked @endif @if($content_recruit->recruit_type_3) checked @endif />
                <span class="checkbox-icon"></span>
                <span class="form-check-description">バイト</span>
            </label>
        </div>  
    </div>

    <?php $openType=[]; ?>
    <div class="form-group col-sm-12">
        <label><i class="icon icon-star text-red-700"></i> 募集職種</label>
        @foreach(Util::getRecruitType('summary', null, null) as $summary_key=>$summary_name)
        <button class="btn btn-info mb-2" type="button"
            data-target="#type{!!$summary_key!!}"
            data-toggle="collapse" aria-expanded="false" aria-controls="type{!!$summary_key!!}">
            {!!$summary_name!!}
        </button>
        <div class="collapse mb-2" id="type{!!$summary_key!!}">
            <div class="card">
                <div class="card-body">
                    @foreach(Util::getRecruitType('desc', $summary_key, null) as $desc_key=>$desc_name)
                    <?php $column = 'type' . $desc_key; ?>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="type[]" value="{!!$desc_key!!}" @if(is_array(old('type')) && in_array($desc_key, old('type'))) checked @endif @if($content_recruit_types->$column) checked <?php $openType[] = 'type'.$summary_key; ?> @endif />
                            <span class="checkbox-icon"></span>
                            <span class="form-check-description">{!!$desc_name!!}</span>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>        
        @endforeach
        <br />
        <span class="help-block">募集する職種にチェックを入れてください。</span>
    </div>

    <div class="col-sm-12">
        <p class="text-info f20">メール文の$から始まるものは次のように変換されます。</p>
        <ul>
        <li class=""><span class="">「$user_name」はエントリー者のお名前に変換されます。</span></li>
        <li class=""><span class="">「$old_step」は前回行ったテスト名（書類選考・１次面接など）に変換されます。</span></li>
        <li class=""><span class="">「$new_step」は次回行うテスト名に変換されます。</span></li>
        <li class=""><span class="">「$yoyaku」は面接予約受付ページリンクに変換されます。</span></li>
        </ul>
    </div>

    <div id="paper" class="form-group col-sm-12">
        <label> 書類選考エントリーの返答メール</label>
        @if($errors->has('paper'))<span class="help-block has-error">{{ $errors->first('paper') }}</span>@endif
        <textarea id="emailExample0" class="form-control form-control-lg" name="paper" style="height:200px;" >{!! old('paper',$content_recruit->paper) !!}</textarea>
        <a href="#" class="text-info" onClick="getExampleEmail(0)">テンプレート利用</a>
    </div>

    <div id="step1" class="form-group col-sm-12" >
        <label> 1次面接のお願いメール</label>
        @if($errors->has('step1'))<span class="help-block has-error">{{ $errors->first('step1') }}</span>@endif
        <textarea id="emailExample1" class="form-control form-control-lg" name="step1" style="height:200px;" >{!! old('step1',$content_recruit->step1) !!}</textarea>
        <a href="#" class="text-info" onClick="getExampleEmail(1)">テンプレート利用</a>
    </div>

    <div id="step2" class="form-group col-sm-12" style="display:none;">
        <label> 2次面接のお願いメール</label>
        @if($errors->has('step2'))<span class="help-block has-error">{{ $errors->first('step2') }}</span>@endif
        <textarea id="emailExample2" class="form-control form-control-lg" name="step2" style="height:200px;" >{!! old('step2',$content_recruit->step2) !!}</textarea>
    </div>

    <div id="step3" class="form-group col-sm-12" style="display:none;">
        <label> 3次面接のお願いメール</label>
        @if($errors->has('step3'))<span class="help-block has-error">{{ $errors->first('step3') }}</span>@endif
        <textarea id="emailExample1" class="form-control form-control-lg" name="step3" style="height:200px;" >{!! old('step3',$content_recruit->step3) !!}</textarea>
    </div>

    <div id="step4" class="form-group col-sm-12" style="display:none;">
        <label> 4次面接のお願いメール</label>
        @if($errors->has('step4'))<span class="help-block has-error">{{ $errors->first('step4') }}</span>@endif
        <textarea id="emailExample4" class="form-control form-control-lg" name="step4" style="height:200px;" >{!! old('step4',$content_recruit->step4) !!}</textarea>
    </div>

    <div id="step5" class="form-group col-sm-12" style="display:none;">
        <label> 5次面接のお願いメール</label>
        @if($errors->has('step5'))<span class="help-block has-error">{{ $errors->first('step5') }}</span>@endif
        <textarea id="emailExample5" class="form-control form-control-lg" name="step5" style="height:200px;" >{!! old('step5',$content_recruit->step5) !!}</textarea>
    </div>

    <div id="step6" class="form-group col-sm-12" style="display:none;">
        <label> 6次面接のお願いメール</label>
        @if($errors->has('step6'))<span class="help-block has-error">{{ $errors->first('step6') }}</span>@endif
        <textarea id="emailExample6" class="form-control form-control-lg" name="step6" style="height:200px;" >{!! old('step6',$content_recruit->step6) !!}</textarea>
    </div>

    <div id="step7" class="form-group col-sm-12" style="display:none;">
        <label> 7次面接のお願いメール</label>
        @if($errors->has('step7'))<span class="help-block has-error">{{ $errors->first('step7') }}</span>@endif
        <textarea id="emailExample7" class="form-control form-control-lg" name="step7" style="height:200px;" >{!! old('step7',$content_recruit->step7) !!}</textarea>
    </div>

    <div id="step8" class="form-group col-sm-12" style="display:none;">
        <label> 8次面接のお願いメール</label>
        @if($errors->has('step8'))<span class="help-block has-error">{{ $errors->first('step8') }}</span>@endif
        <textarea id="emailExample8" class="form-control form-control-lg" name="step8" style="height:200px;" >{!! old('step8',$content_recruit->step8) !!}</textarea>
    </div>

    <div id="adoption" class="form-group col-sm-12">
        <label> 採用連絡メール</label>
        @if($errors->has('adoption'))<span class="help-block has-error">{{ $errors->first('adoption') }}</span>@endif
        <textarea id="emailExample9" class="form-control form-control-lg" name="adoption" style="height:200px;" >{!! old('adoption',$content_recruit->adoption) !!}</textarea>
        <a href="#" class="text-info" onClick="getExampleEmail(9)">テンプレート利用</a>
    </div>

    <div id="rejection" class="form-group col-sm-12" >
        <label> 不採用連絡メール</label>
        @if($errors->has('rejection'))<span class="help-block has-error">{{ $errors->first('rejection') }}</span>@endif
        <textarea id="emailExample10" class="form-control form-control-lg" name="rejection" style="height:200px;">{!! old('rejection',$content_recruit->rejection) !!}</textarea>
        <a href="#" class="text-info" onClick="getExampleEmail(10)">テンプレート利用</a>
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

@stop


{{-- footer scripts --}}
@section('footer_scripts')


<script>


function getExampleEmail(number) {
    
    axios.get('/owner/contents/{!!$content->id!!}/menu/edit/recruit/getExampleEmail', {
      params: {
        number: number
      }
    })
    .then(function (response) {
      if(!ajaxCheckPublic(response.data)){return;}
      $('#emailExample'+number).val(response.data);
    })
    .catch(function (error) {
      ajaxCheckError(error); return;
    });
}


$(document).ready(function () {

    levelChangeDo({!!$content_recruit->use_test_level!!});

    @foreach($openType as $key=>$val)
    $('#{!!$val!!}').show();
    @endforeach
    
});

function levelChangeFunc(){
    var level = $('#use_test_level').val();
    level = parseInt(level);
    levelChangeDo(level);
}


function levelChangeDo(level){
    switch (level){
        case 1: 
            $('#step1').show();
            $('#step2').hide();
            $('#step3').hide();
            $('#step4').hide();
            $('#step5').hide();
            $('#step6').hide();
            $('#step7').hide();
            $('#step8').hide();
            break;
        case 2:
            $('#step1').show();
            $('#step2').show();
            $('#step3').hide();
            $('#step4').hide();
            $('#step5').hide();
            $('#step6').hide();
            $('#step7').hide();
            $('#step8').hide();
            break;
        case 3:
            $('#step1').show();
            $('#step2').show();
            $('#step3').show();
            $('#step4').hide();
            $('#step5').hide();
            $('#step6').hide();
            $('#step7').hide();
            $('#step8').hide();
            break;
        case 4:
            $('#step1').show();
            $('#step2').show();
            $('#step3').show();
            $('#step4').show();
            $('#step5').hide();
            $('#step6').hide();
            $('#step7').hide();
            $('#step8').hide();
            break;
        case 5:
            $('#step1').show();
            $('#step2').show();
            $('#step3').show();
            $('#step4').show();
            $('#step5').show();
            $('#step6').hide();
            $('#step7').hide();
            $('#step8').hide();
            break;
        case 6:
            $('#step1').show();
            $('#step2').show();
            $('#step3').show();
            $('#step4').show();
            $('#step5').show();
            $('#step6').show();
            $('#step7').hide();
            $('#step8').hide();
            break;
        case 7:
            $('#step1').show();
            $('#step2').show();
            $('#step3').show();
            $('#step4').show();
            $('#step5').show();
            $('#step6').show();
            $('#step7').show();
            $('#step8').hide();
            break;
        case 8:
            $('#step1').show();
            $('#step2').show();
            $('#step3').show();
            $('#step4').show();
            $('#step5').show();
            $('#step6').show();
            $('#step7').show();
            $('#step8').show();
            break;
    }
}
</script>

@stop
