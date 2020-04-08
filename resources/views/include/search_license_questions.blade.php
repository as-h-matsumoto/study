@forelse($license_questions as $license_question)
<?php
if($GLOBALS['urls'][1]==='owner'){
  $link = '/owner/license/' . $license_question->license_id . '/question/' . $license_question->id . '/edit';
}else{
  $link = '/license/' . $license_question->license_id . '/question/' . $license_question->id . '';
}

/*
      'license_question.id',
      'license_question.user_id',
      'license_question.license_id',
      'license_question.license_schedule_id',
      'license_question.license_question_answer_id',
      'license_question.license_examination_subject_id',
      'license_question.level',
      'license_question.number',
      'license_question.question',
      'license_question.figure1',
      'license_question.figure2',
      'license_question.note1',
      'license_question.note2',
      'license_question.note3',
      'license_question.note4',
      'license_question.commentary',
      'license_question.recommend_number',
      'license_question.recommend_point',
      'license_question.good_number',
      'license_question.bad_number',
      'license_question.created_at',
      'license_question.updated_at',
      'license_schedule.license_year',
      'license_schedule.license_phase',
      'license_schedule.name as schedule_name',
      'license_schedule.start as schedule_start',
      'license_schedule.end as schedule_end',
      'license_examination_subject.name as subject_name',
      'license_examination_subject.about as subject_about'
*/
?>

<div id="{{$license_question->id}}" class="col-sm-12 mb-2">
    <div class="card" >
      <div class="card-block-me pb-0">
          <a href="{!!$link!!}" target="_blank">
          <span class="">
            <span class="type_box" ><i class="icon icon-question-mark-circle s-6 text-red-600"></i></span>
          </span>
          <div class="row">
            <div class="col-sm-6">
              <p class="f20 right">
                {!!$license_question->license_year.'年度'!!} &nbsp; {!!$license_question->license_phase.'次試験'!!}
              </p>
            </div>
            <div class="col-sm-6">
              <p class="f20 left">
                <strong>{!!$license_question->subject_name!!} &nbsp; {!!'第'.$license_question->number.'問'!!}</strong>
              </p>
            </div>
          </div>
          </a>
          <div class="center">
              <p class=""> {{ mb_strimwidth($license_question->question, 0, 300, "...") }} </p>
          </div>
      </div>

      <div class="card-actions">
        <button class="action-btn action-btn-footer">
          <a href="/owner/license/{{$license_question->license_id}}/question/{{$license_question->id}}/show"><i title="詳細へ" class="icon icon-checkbox-multiple-marked-outline s-6"></i></a>
        </button>
        <button class="action-btn action-btn-footer" title="いいね" onClick="loading(); niceBad('license_question', {!!$license_question->id!!}, 'good', 'License_question')" >
         <span id="niceLicense_questiongood{!!$license_question->id!!}">{!!$license_question->good_number!!}</span><i class="icon-thumb-up-outline text-green-700 s-6"></i>
        </button>
        <button class="action-btn action-btn-footer" title="う～ん" onClick="loading(); niceBad('license_question', {!!$license_question->id!!}, 'bad', 'License_question')">
         <span id="niceLicense_questionbad{!!$license_question->id!!}">{!!$license_question->bad_number!!}</span><i class="icon-thumb-down-outline text-primary-200 s-6"></i>
        </button>
        <span class="action-btn action-btn-footer float-right border-left" id="favorite-license_question-{!!$license_question->id!!}">
          @if($license_question->favo)
          <a onClick="loading(); favorite('license_question', {!!$license_question->id!!}, 'delete')"><i class="icon icon-content-save-all s-6 text-red-600" title="お気に入り解除" alt="お気に入り解除"></i></a>
          @else
          <a onClick="loading(); favorite('license_question', {!!$license_question->id!!}, 'add')"><i class="icon icon-content-save-all s-6 text-yellow-600" title="お気に入り登録" alt="お気に入り登録"></i></a>
          @endif
        </span>
      </div>

    </div>
</div>

@empty
@endforelse

@if( !empty($license_questions) and $license_questions->hasMorePages() and $license_questions->currentPage()>1 )
<script>
$(document).ready(function () {
var insert = '';
insert += '<button class="btn btn-outline-info" ';
insert += ' onclick="loading();';
insert += ' ajaxPaginationMore(\'';
insert += ' {!!$license_questions->nextPageUrl()!!}';
insert += '\');return false;" >';
insert += '<strong>もっと</strong>';
insert += '</button>';
document.getElementById('pageMore').innerHTML = insert;
});
</script>
@elseif(!empty($license_questions) and !$license_questions->hasMorePages() and $license_questions->currentPage()>1)
<script>
$('#pageMore').html('');
</script>
@endif
