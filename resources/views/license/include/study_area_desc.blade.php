
<ul class="nav nav-tabs px-0 bg-white-500">
@foreach($license_examination_subject as $subject)
<?php
$first = true;
$active = '';
$href = '/license/1/getLicensestudyArea?license_examination_subject_id='.$subject->id;
$expanded = '';
if($subject->id == $license_examination_subject_id){
  $active = 'active';
  $license_examination_subject_name = $subject->name;
  $href = '#';
  $expanded = 'aria-expanded="true";';
}
?>
<li class="nav-item border-bottom border-right">
  <a class="nav-link btn {!!$active!!} " href="{!!$href!!}"  >{!!$subject->name!!}</a>
</li>
@endforeach
</ul>

<div class="card">
<div class="card-title center py-10">
 {!!$license_examination_subject_name!!}
 @if( Auth::check() )
 @if( Auth::user()->study_area_history_page_url === $license_examination_subject_id )
 <br />
 <a class="f14" href="#summary{!!Auth::user()->study_area_history_page_id!!}">前回学習した項目までスキップ</a>
 @elseif( Auth::user()->study_area_history_page_url and Auth::user()->study_area_history_page_url !== $license_examination_subject_id )
 <br />
 <a class="f14" href="/license/1/getLicensestudyArea?license_examination_subject_id={!!Auth::user()->study_area_history_page_url!!}">前回学習した項目までスキップ</a>
 @endif
</div>
@foreach($license_examination_subject_desc_parts as $desc_part)
<?php 
$tmp = explode('.', $desc_part->number);
$count = count($tmp);
?>
<div class="card-body row border-bottom @if($first) border-top @endif pb-2 mb-2">
  <div class="col-sm-10">
    <p class="f20"><strong><span>{!!$desc_part->number!!}</span><span>@for($y = $count; $y >= 1; $y--) &nbsp; @endfor</span><span onClick="summaryShow({!!$desc_part->id!!})">{!!$desc_part->name!!}@if($desc_part->summary){!!'<span class="text-blue-400">(概要表示)</span>'!!}@endif</span></strong></p>
    <p id="summary{!!$desc_part->id!!}" @if($desc_part->summary) style="display:none;" @endif >@if($desc_part->summary){!!nl2br($desc_part->summary)!!}@endif</p>
    <p id="memo{!!$desc_part->id!!}">@if(isset($memo[$desc_part->id])){!!nl2br($memo[$desc_part->id])!!}@endif</p>
  </div>
  <div class="col-sm-2">
    <a href="javascript:void(0)" data-toggle="modal" data-target="#modelmemoRegi" data-whatever="{!!$desc_part->id!!}" >メモ追加</a>
    @if($desc_part->wiki_url or $desc_part->literature_url)<br /><br />@endif
    <span id="wiki{!!$desc_part->id!!}" >@if($desc_part->wiki_url) <a target="_blank" href="https://ja.wikipedia.org/?curid={!!$desc_part->wiki_url!!}" class="pr-2" >（WIKI）{!!$desc_part->wiki_name!!}</a> @endif </span>@if($desc_part->literature_url)<br />@endif
    <span id="literature{!!$desc_part->id!!}" >@if($desc_part->literature_url) <a target="_blank" href="{!!$desc_part->literature_url!!}" class="pr-2" >（参考）{!!$desc_part->literature_name!!}</a> @endif </span>
    
    @if( Auth::check() and Auth::user()->id === 1)
    <br /><br /><span>(OWNER): 
    <a href="javascript:void(0)" class="pr-2" data-toggle="modal" data-target="#stepModal" data-whatever="{!!$desc_part->id!!}" >WIKI</a>
    <a href="javascript:void(0)" class="pr-2" data-toggle="modal" data-target="#modelliteratureRegi" data-whatever="{!!$desc_part->id!!}" >引用</a>
    <a href="javascript:void(0)" class="pr-2" data-toggle="modal" data-target="#modelsummaryRegi" data-whatever="{!!$desc_part->id!!}" >まとめ</a>
    <a href="javascript:void(0)" id="view{!!$desc_part->id!!}" onClick="onView({!!$desc_part->id!!})" >@if($desc_part->view_flag){!!'表示On'!!}@else{!!'表示Off'!!}@endif</a>
    
    </span>
    @endif
  </div>
</div>
<?php $first = false; ?>
@endforeach

</div>

