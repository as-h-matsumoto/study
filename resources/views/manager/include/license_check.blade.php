

@foreach($license_question as $question)
<tr>
  <td>{!!$question->license_name!!}</td>
  <td>{!!$question->license_year!!} {!!$question->schedule_name!!}</td>
  <td>{!!$question->subject_name!!} {!!'問題'.$question->license_question_number!!}</td>
  <td>
  @foreach($contents[$question->license_question_id] as $content)
    {!!'設問'.$content->number!!} &nbsp; <input id="contentPoint{!!$content->id!!}" type="text" value="{!!$content->points!!}" style="width:20px;" />点&nbsp;
    @foreach($answers[$content->id] as $k=>$ans)
      @if($ans->id === $content->license_question_contents_answer_id)
      <strong><span class="pr-2">{{Util::getAnswerNumber($k)}}</span></strong>
      @else
      <span class="pr-2">{{Util::getAnswerNumber($k)}}</span>
      @endif
    @endforeach
    &nbsp;<a href="javascript:void(0)" onClick="loading(); changePoints({!!$content->id!!})">更新</a>
    <br />
  @endforeach
  </td>
</tr>
@endforeach

@if( !empty($license_question) and $license_question->hasMorePages() and $license_question->currentPage()>1 )
<script>
$(document).ready(function () {
var insert = '';
insert += '<button class="btn btn-outline-info" ';
insert += ' onclick="loading();';
insert += ' ajaxPaginationMore(\'';
insert += ' {!!$license_question->nextPageUrl()!!}';
insert += '\');return false;" >';
insert += '<strong>もっと</strong>';
insert += '</button>';
document.getElementById('pageMore').innerHTML = insert;
});
</script>
@elseif(!empty($license_question) and !$license_question->hasMorePages() and $license_question->currentPage()>1)
<script>
$('#pageMore').html('');
</script>
@endif
