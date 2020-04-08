@forelse($license_question_try_masters as $license_question_try_master)


<div id="{{$license_question_try_master->id}}" class="col-sm-12 mb-2">
    <div class="card" >
      <div class="card-block-me ">
          @if($license_question_try_master->active === 99)
          <a href="/account/try/history/master/{!!$license_question_try_master->try_master_id!!}/license/{!!$license_question_try_master->license_id!!}/question/{!!$license_question_try_master->start_question_id!!}">
          @elseif($license_question_try_master->active === 1)
          <a href="/account/try/master/{!!$license_question_try_master->try_master_id!!}/start">
          @elseif($license_question_try_master->active === 2)
          <a href="/account/try/master/{!!$license_question_try_master->try_master_id!!}/license/{!!$license_question_try_master->license_id!!}/question/{!!$license_question_try_master->start_question_id!!}">
          @endif
          <span class="">
            <span class="type_box" ><i class="icon icon-pen s-6 text-red-600"></i></span>
          </span>
          <div class="row">
            <div class="col-sm-6">
              <p class="f20 center">
              {!!$license_question_try_master->license_name!!}
              </p>

              <p class="f20 center">
                {!!$license_question_try_master->license_year.'年度'!!} &nbsp; {!!$license_question_try_master->license_phase.'次試験'!!}
              </p>

              <p class="f20 center">
                @if($license_question_try_master->step !== 9999)
                {!!$license_question_try_master->subject_name!!}</strong>
                @else
                <strong>全科目</strong>
                @endif
              </p>
            </div>
            
            <div class="col-sm-6">
              <p class="f20 center">
                @if($license_question_try_master->master_type === 1)
                  練習問題（時間制限なし）
                @elseif($license_question_try_master->master_type === 2)
                  <span class="text-red-900"><strong>模擬試験（時間制限：{!!$license_question_try_master->subject_time.'分'!!}）</strong></span>
                @endif
              </p>
              <p class="f20 center">
                @if($license_question_try_master->active === 99)
                <span>試験終了</span>
                @elseif($license_question_try_master->active === 1)
                <span class="text-blue-800">試験前</span>
                @elseif($license_question_try_master->active === 2)
                <span class="text-red-800">試験中</span>
                @endif
                <span>{{Util::convert_to_fuzzy_time($license_question_try_master->updated_at)}}</span>
              </p>
            </div>
            
          </div>
          </a>
      </div>

    </div>
</div>

@empty
@endforelse

@if( !empty($license_question_try_masters) and $license_question_try_masters->hasMorePages() and $license_question_try_masters->currentPage()>1 )
<script>
$(document).ready(function () {
var insert = '';
insert += '<button class="btn btn-outline-info" ';
insert += ' onclick="loading();';
insert += ' ajaxPaginationMore(\'';
insert += ' {!!$license_question_try_masters->nextPageUrl()!!}';
insert += '\');return false;" >';
insert += '<strong>もっと</strong>';
insert += '</button>';
document.getElementById('pageMore').innerHTML = insert;
});
</script>
@elseif(!empty($license_question_try_masters) and !$license_question_try_masters->hasMorePages() and $license_question_try_masters->currentPage()>1)
<script>
$('#pageMore').html('');
</script>
@endif
