
<div id="page-header" class="sm-page-header-lg page-header p-6 row {{Util::monthClassNameReturn()}}" >
  <div class="user-info col-12 center">
    <span>
      <span><i class="icon icon-book-open-page-variant s-20"></i></span>
      <br class="hidden-sm-over" />
      <span class="name pl-4">
          <span class="f24">
          @if(!$GLOBALS['urls'][2])
              オーナーホーム
          @elseif($GLOBALS['urls'][4] === 'question' and !$GLOBALS['urls'][5])
              {{$license->name}} &nbsp; 問題一覧
              <a href="/owner/license/{{$license->id}}/question/create" > 
                      <button class="btn btn-outline-info">問題登録</button>
              </a>
              <br />
              <form action="/owner/license/{!!$license->id!!}/question">
                  <div class="form-row">
                      <div class="form-group col-md-3">
                          <label for="subject" class="pb-2">科目</label>
                          <select name="subject" id="subject" class="form-control">
                              <option value="">すべて</option>
                              @foreach($license_examination_subjects as $subject)
                              <option value="{!!$subject->id!!}">{!!$subject->name.'('.$subject->license_phase.'次)'!!}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="form-group col-md-3">
                          <label for="year" class=" pb-2">年度</label>
                          <select id="year" name="year" class="form-control">
                              <?php $year = date('Y'); $selected = date("Y",strtotime("-1 year")); $year_last = 2011; ?>
                              @for ($i = $year; $i > $year_last; $i--)
                              <option value="{!!$i!!}" @if($selected == $i) selected @endif >{!!$i!!}</option>
                              @endfor
                          </select>
                      </div>
                      <div class="form-group col-md-3 pt-10">
                          <button class="btn btn-outline-info" onclick="loading();document.action.submit();return false;" >
                            <i class="icon icon-search-web"></i>検索
                          </button>
                      </div>
                  </div>
              </form>
              
          @elseif($GLOBALS['urls'][4] === 'question' and $GLOBALS['urls'][6]  ==='contents')
              {{$license->name}} &nbsp;
              <br />
              <a href="/owner/license/{{$license->id}}/question/create" > 
                <button class="btn btn-primary">問題登録</button>
              </a>
              <br />
              @if($GLOBALS['urls'][7]  ==='create')
              <strong>設問登録</strong>
              @elseif($GLOBALS['urls'][8]  ==='edit')
              <strong>設問編集</strong>
              @elseif($GLOBALS['urls'][8]  ==='show')
              <strong>設問詳細</strong>
              @endif
          @elseif($GLOBALS['urls'][3] === 'question' and $GLOBALS['urls'][4])
              {{$license->name}} &nbsp; 資格選択
              <div class="center">
                <a href="/owner/license/{!!$license->id!!}/question/theme/create"><button class="btn btn-outline-info">問題テーマ作成</button></a>
              </div>
          @elseif($GLOBALS['urls'][2] === 'license')
              資格選択
              <div class="center">
                <a href="/owner/license/{!!$license->id!!}/question/theme/create"><button class="btn btn-outline-info">問題テーマ作成</button></a>
              </div>
          @elseif($GLOBALS['urls'][2] === 'profile')
              オーナー登録情報
          @elseif($GLOBALS['urls'][2] === 'bank')
              入金口座
          @elseif($GLOBALS['urls'][2] === 'pay')
              ネット決済
          @endif
          </span>
          <br />
          @if(strpos($_SERVER["REQUEST_URI"], '/show')!==false)
          <span class="f24">
              <a href="javascript:void(0)" class="mb-1 p-1 mr-1" onClick="loading(); niceBad('license_question', {!!$license_question->id!!}, 'good', 'Content')" title="いいね">
                <small class="f14" id="niceQuestiongood{!!$license_question->id!!}">{!!$license_question->good_number!!}</small><i class="icon-thumb-up text-green-700 s-4"></i>
              </a>
              <a href="javascript:void(0)" class="mb-1 p-1 mr-1" onClick="loading(); niceBad('license_question', {!!$license_question->id!!}, 'bad', 'Content')" title="う～ん">
                <small class="f14" id="niceQuestionbad{!!$license_question->id!!}">{!!$license_question->bad_number!!}</small><i class="icon-thumb-down text-primary-200 s-4"></i>
              </a>
              <a href="javascript:void(0)" class="mb-1 p-1 mr-1" title="リコメンド">
                <i class="icon-comment-text text-accent-700 s-4"></i><small class="f14">{!!$license_question->recommend_number!!}件</small>
              </a>
              <a href="javascript:void(0)" class="mb-1 p-1 mr-1" id="favorite-license_question-{!!$license_question->id!!}">
              @if($license_question->favo)
                <span onClick="loading(); favorite('license_question', {!!$license_question->id!!}, 'delete')">
                  <i class="icon icon-star s-6 text-red-600" title="お気に入り解除" alt="お気に入り解除"></i>
                </span>
              @else
                <span onClick="loading(); favorite('license_question', {!!$license_question->id!!}, 'add')">
                  <i class="icon icon-star s-6 text-yellow-600" title="お気に入り登録" alt="お気に入り登録"></i>
                </span>
              @endif
              </a>
          </span>
          @endif
      </span>
    </span>
  </div>
</div>
