@forelse($licenses as $license)
<div id="{{$license->id}}" class="col-sm" >
    <div class="card py-8" >
        <div class="card-body center">
            <a href="/license/{!!$license->id!!}/top">
            <p >
              {!!$license->name!!}
            </p>
            </a>
        </div>
    </div>
</div>
@empty
@endforelse

@if( !empty($licenses) and $licenses->hasMorePages() and $licenses->currentPage()>1 )
<script>
$(document).ready(function () {
var insert = '';
insert += '<button class="btn btn-outline-info" ';
insert += ' onclick="loading();';
insert += ' ajaxPaginationMore(\'';
insert += ' {!!$licenses->nextPageUrl()!!}';
insert += '\');return false;" >';
insert += '<strong>もっと</strong>';
insert += '</button>';
document.getElementById('pageMore').innerHTML = insert;
});
</script>
@elseif(!empty($licenses) and !$licenses->hasMorePages() and $licenses->currentPage()>1)
<script>
$('#pageMore').html('');
</script>
@endif
