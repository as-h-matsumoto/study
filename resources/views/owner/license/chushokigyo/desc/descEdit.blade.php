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

<!--

CREATE TABLE `license_question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `license_id` bigint(20) UNSIGNED NOT NULL COMMENT '資格ID',
  `license_schedule_id` bigint(20) UNSIGNED NOT NULL COMMENT '資格試験日程',
  `license_question_answer_id` bigint(20) UNSIGNED NOT NULL COMMENT '資格試験問題回答ID',
  `level`
  `question` text COMMENT '資格試験問題内容',
  `commentary` text COMMENT '資格試験問題解説',
  `recommend_number` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `recommend_point` float UNSIGNED NOT NULL DEFAULT '0',
  `good_number` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `bad_number` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

＞これを手動で登録しておく。
license
　中小企業者が適切な経営の診断及び経営に関する助言を受けるに当たり、経営の診断及び経営に関する助言を行う者の選定を容易にするため、経済産業大臣が一定のレベル以上の能力を持った者を登録するための制度
　企業の成長戦略策定やその実行のためのアドバイスが主な業務。中小企業と行政・金融機関等を繋ぐパイプ役、また、専門的知識を活用しての中小企業施策の適切な活用支援等幅広い活動が求められる。
license_examination_subject (資格の試験科目の名前と目的のみ)
license_schedule（資格のすべてのスケジュール情報、2019年度の一次試験申し込み開始と終了情報、2017年度の一次試験日程など）
license_schedule_examination_subject（年度ごとの科目の詳細情報（実際はほとんど変らないため、2019年度以前はすべて同じ科目ごとの詳細を利用））
license_schedule_statistics　年度ごとの数値（年齢ごとの申し込み数と合格数、地域ごとの申込数と合格数、勤務先別申込数と合格数の一覧）
license_schedule_pass_rate　statisticsのまとめ（一次試験と二次試験の申込数、合格数、合格率、全体の合格数と合格率）

＞最初に問題を登録
license_question　各年度の各科目の問題（license_schedule_idによりいつの試験なのか特定する）

＞これを登録した段階で下の入力が現れる
license_question_answer (複数入力する必要がある。)

learning　理論が概念
learning_region　理論の上下
learning_relation 関連理論テーブル
learning_used 理論がつかわれている領域
literature　中小企業白書2009など
company credit利用
＞いったん学問を登録し、後から上下を追加できるようにする。
-->


                <div class="form-group col-sm-6 col-xl-4">
                    <label class="form-control-label"><i class="icon icon-star text-red-700"></i> 年度</label>
                    <select class="custom-select mt-2" name="year">
                        <?php $year = date('Y'); $year_last = $year - 20; ?>
                        @for ($i = $year; $i > $year_last; $i--)
                        <option value="{!!$year!!}">{!!$year!!}</option>
                        @endfor
                    </select>
                </div>

                <div class="form-group col-sm-6 col-xl-4">
                    <label class="form-control-label"><i class="icon icon-star text-red-700"></i> フェーズ</label>
                    <select class="custom-select mt-2" name="phase">
                        <option value="1">一次試験</option>
                        <option value="2">二次試験</option>
                    </select>
                </div>
            
                <div class="form-group col-sm-6 col-xl-4" >
                    <label class="pl-4" for="name"><i class="icon icon-star text-red-700"></i> 科目</label>
                    <select class="custom-select mt-2" name="phase">
                      @foreach(license_phase as $key=>$val)
                        <option value="{{$val->id}}">{{$val->name}}</option>
                      @endforeach
                    </select>
                </div>

                <div class="form-group col-sm-12" >
                    <label class="pl-4"><i class="icon icon-star text-red-700"></i> 問題</label>
                    <input type="text" name="question" class="form-control form-control-lg" value="{!! old('question',$license_question->question) !!}" />
                    @if ($errors->has('question'))
                    <span class="help-block has-error"><strong>{{ $errors->first('question') }}</strong></span>
                    @endif
                </div>

                <div class="form-group col-xl-6 center">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <label for="mainPic" class="btn form-control-label f14 text-blue-700"><strong>図１</strong></label>
                        <input accept="image/*" type="file" class="" id="mainPic" name="mainPic" />
                        <br /><span class="pt-4 mt-4" id="main_progress_bar"><span class="percent" style="padding:0px 50px;">0%</span></span>
                      </div>
                      <div id="mainpreview" class="col-sm-6">
                        <img src="@if($license_question->pic){{Util::getPicContent('license', false, $license_question->pic, $license_question->id, 400)}}@endif" style="width:120px;" />
                      </div>
                    </div>
                </div>
                
                <div class="form-group col-xl-6 center">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <label for="backPic" class="btn form-control-label f14 text-blue-700"><strong>図２</strong></label>
                        <input accept="image/*" type="file" class="" id="backPic" name="backPic" />
                        <br /><span class="pt-4 mt-4" id="back_progress_bar"><span class="percent" style="padding:0px 50px;">0%</span></span>
                      </div>
                      <div id="backpreview" class="col-sm-6">
                        <img src="@if($license_question->back_pic){{'license', true, $content->back_pic, $content->id, 400)}}@endif" style="width:120px;" />
                      </div>
                    </div>
                </div>

                @for ($i = 1; $i <= 4; $i++)
                <div class="form-group col-sm-12" >
                    <label class="pl-4"><i class="icon icon-star text-red-700"></i> 注記{{$i}}</label>
                    <input type="text" name="note{{$i}}" class="form-control form-control-lg" value="{!! old('note'.$i,$license_question->note.$i) !!}" />
                    @if ($errors->has('note'.$i))
                    <span class="help-block has-error"><strong>{{ $errors->first('note'.$i) }}</strong></span>
                    @endif
                </div>
                @endfor

                @for ($i = 1; $i <= 8; $i++)
                <div class="form-group col-sm-12" >
                    <label class="pl-4"><i class="icon icon-star text-red-700"></i> 回答{{$i}}</label>
                    <input type="text" name="answer{{$i}}" class="form-control form-control-lg" value="{!! old('answer'.$i,$license_question_answer[$i]->answer) !!}" />
                    @if ($errors->has('answer'.$i))
                    <span class="help-block has-error"><strong>{{ $errors->first('answer'.$i) }}</strong></span>
                    @endif
                </div>
                @endfor

<!--
learning　理論が概念
learning_region　理論の上下
learning_relation 関連理論テーブル
learning_used 理論がつかわれている領域
literature　中小企業白書2009など
company credit利用
-->


        
            </form>

            </div>
        </div>

        <div class="card pt-4">
            <div class="card-block-me p-0 m-0 row">
                <div id="stepArea" class="card-body row">
                    <div class="center col-12 py-4">
                        <p class="text-warning ">
                        @if($learnings)
                        参考文献が登録されていません。
                        @else
                        @foreach($learnings as $learning)
                        <a href="https://ja.wikipedia.org/?curid={{$learning->pageid}}">
                          <button class="btn btn-outline-info"><strong>{{$learning->name}}</strong></button>
                        </a>
                        @endforeach
                        @endif
                        問題に利用されている学問や理論などがあれば左下の<i class="icon icon-debug-step-over text-green-500 s-6" title="学問登録" alt="学問登録"></i>から登録してください。
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-actions">
                <
                <button onClick="stepModal(null)" class="action-btn action-btn-footer"><i class="icon icon-debug-step-over text-green-500 s-7 px-6" title="学問登録" alt="学問登録"></i></button>
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

                    <input type="hidden" class="form-control" name="license_question_id" value="{{$license_question->id}}" >

                    <div class="form-group col-sm-12">
                        <label for="" class="form-control-label text-info"><span class="pr-2">文献名：</span><a href="javascript:void(0)" class="btn btn-info float-right" id="findLearning" >検索</a></label>
                        <input class="form-control form-control-lg" type="search" name="learningSearch" id="learningSearch" placeholder="文献" aria-label="総需要など" />
                    </div>
                    <div>
                      <p id="searchTotalNumber"></p>
                    </div>
                    <div id="searchAnsArea" class="col-sm-12">
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
document.getElementById( 'findLearning' ).onclick = function( e )
{
    findLearning();
};
function findLearning(){

    var inputSearch = $('#learningSearch').val();
    if(!inputSearch) return;
    //console.log(inputSearch);
    //inputSearch = inputSearch.replace( /-/g , "" );
    //console.log(inputSearch)
    //if(isNaN(inputSearch)) infoNotify('数字とハイフン(-)のみ有効です。');
    //console.log(inputSearch.length)
    //if( !(inputSearch.length>=5 && inputSearch.length<=11) ) infoNotify('番号数字の5-11桁で検索してください。');
    moreLearning(inputSearch);

}

function moreLearning(searchWord){
    //console.log(searchTel);
  axios.get('/owner/learning/search', {
    params: {
      searchWord: searchWord
    }
  })
  .then(function (response) {
    if(!ajaxCheckPublic(response.data)){return;}
    //console.log(response.data);
    if(isset(response.data)){
      var more = '';
      count = 1;
      $.each(response.data,function(index,learning){
        if( count===3 ){
          $('#searchTotalNumber').html('<p class=" center f18 text-warning">検索数：' + learning.searchinfo.totalhits + '</p>');
          $.each(learning.search,function(index,val){
            more += '<p class="center">';
            more += '<a href="javascript:void(0)" onclick="loading();putLicenseQuestionLearning('+val.pageid+', '+val.title+', '+val.snippet+');return false;" >';
            more += '<span class="pr-2">'+val.title+'</span>';
            more += '</a>';
            more += '<br /><span class="pr-2">'+val.snippet+'</span>';
            more += '<br /><span class="pr-2">更新: '+val.timestamp+'</span>';
            more += '</p>';
            $('#searchAnsArea').html(more);
            more = '';
          });
        }
        count++;
      });
    }else{
      $('#searchAnsArea').html('<p class=" center f18 text-warning">見つかりませんでした。</p>');
    }
    $('#loading').hide();
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });
}

function putLicenseQuestionLearning(pageid, title, snippet){
  axios.get('/owner/license/{{$license->id}}/question/{!!$license_question_id!!}/date/adduser/getOwnersUser', {
    params: {
      user_id: user_id
    }
  })
  .then(function (response) {
    if(!ajaxCheckPublic(response.data)){return;}
    //console.log(response.data);
    if(isset(response.data)){
      var user = response.data;
      $('#ownersUserId').val(user.id);
      $('#ownersUserTel').val(user.tell);
      $('#ownersUserName').val(user.name);
      $('#ownersUserDescription').val(user.description);
    }else{
        infoNotify('もう一度お試しください。');
    }
    $('#loading').hide();
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });
}
</script>




@stop
