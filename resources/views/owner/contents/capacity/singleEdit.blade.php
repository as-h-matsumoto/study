@extends('owner/layouts/default')

{{-- Page title --}}
@section('title') 所在地・目的地登録 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
<style>
  #Capacity_progress_bar {
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
  #Capacity_progress_bar.loading {
    opacity: 1.0;
  }
  #Capacity_progress_bar .percent {
    background-color: #99ccff;
    height: auto;
    width: 0;
  }
</style>
@stop

{{-- content --}}
@section('content')
<div id="project-dashboard" class="page-layout simple tabbed">

    @include('owner/contents/include/header')
    
    <div class="page-content">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link btn" id="" data-toggle="tab" href="#place" role="tab" aria-controls="place" aria-expanded="true">{!!Util::getCountryAreaOneName($content->country_area_address_one)!!}店舗</a>
            </li>
        </ul>

        <div class="tab-content p-0 pt-1" id="myTabContent">

            <div role="tabpanel" class="tab-pane fade show active p-0 bg-white-500" id="place" aria-labelledby="place-tab">

                <table class="table table-hover pb-0 mb-0">
                <thead class="bg-primary-50">
                    <tr id="PlaceOwner">
                        <th colspan="1" id="PlaceOwnerPic" class="center text-auto" scope="row">
                            <img src="{!!Util::getPic('place', null, $place_owner->pic, $content->id, 400, null)!!}" width="120">
                        </th>
                        <th colspan="4" id="" class="center text-auto" scope="row">
                            <strong id="PlaceOwnerName">
                            店舗名：{!!$place_owner->name!!}
                            </strong>
                            <br />
                            <span id="PlaceOwnerCapacity">
                            パーキング: {!!$place_owner->parking!!}台
                            </span>
                            <br />
                            <span id="PlaceOwnerBaseComment">
                            店舗概要：{!!$place_owner->description!!}
                            </span>
                        </th>
                        <th colspan="1" id="" class="center" scope="row">
                            <a href="javascript:void(0)" onClick="modalPlaceOwner()">{!!Util::getIcon('edit_table',null,'blue')!!}</a>
                        </th>
                    </tr>
                </thead>
                </table>

                <div class="card ">
                <div id="CapacityArea" class="card-body py-2 px-6 row ">

                </div>
                </div>

            </div>
        </div>
    </div>

    <div class="page-content-footer">
        <p class="right">
            @if($content->service===85 or $content->service===89 or $content->service===39)
            <a href="/owner/contents/{!!$content->id!!}/discount/edit" >
                <button class="btn btn-outline-info"><strong>割引設定へ <i class="icon icon-chevron-right"></i></strong></button>
            </a>
            @else
            <a href="/owner/contents/{!!$content->id!!}/menu/edit" >
                <button class="btn btn-outline-info"><strong>メニュー登録へ <i class="icon icon-chevron-right"></i></strong></button>
            </a>
            @endif
            
        </p>
    </div>

    @include('owner/include/footer')
    @include('include/footer')

</div>


@include('owner/contents/capacity/include/place_owner_modal')

<div class="modal fade" id="CapacityModal" tabindex="-1" role="dialog" aria-labelledby="CapacityModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CapacityModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'CapacityForm', 'name' => 'CapacityForm', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}

                    @include('owner/contents/capacity/' . UtilYoyaku::getNewMenuSenMonTenSummary($content->service) . '/modal')

                    <input type="hidden" class="" name="capa_id" id="CapacityFormId" value="" />
                    
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); postCapacity();" ><strong>{!!Util::getIcon('add','s-4','green')!!} 登録</strong></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteCapacityModal" tabindex="-1" role="dialog" aria-labelledby="deleteCapacityModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCapacityModalLabel">削除処理</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <p>選択したスペース、もしくは、設備を削除します。</p>
                <p>選択したスペース、もしくは、設備を削除すると、完全に見れなくなります。</p>

            </div>

            <input type="hidden" class="form-control" id="capacity-id" value="" >

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); deleteCapacity();" ><strong>{!!Util::getIcon('add','s-4','green')!!} 削除</strong></button>
            </div>
        </div>
    </div>
</div>

@include('owner/contents/include/modal')

<div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="warningModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="warningModalLabel">設備変更時の注意</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>設備を正常に変更しました。</p>
                <p class="pt-4">ただし、この設備は利用予定がございました。</p>
                <p class="pt-4 text-info">ご利用者様は変更前の設備を期待しておりますので、もし、変更後の内容でサービスを提供する場合は、利用者に変更内容をご理解いただくようご対応お願いいたします。</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addCapacityToDateModal" tabindex="-1" role="dialog" aria-labelledby="addCapacityToDateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCapacityToDateModalLabel">予約スケジュールへメニューを追加する</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>作成した設備「<span id="addCapacityToDateModalnewMenuName"></span>」を予約受付メニューにも追加しますか？</p>
                <p class="pt-4">特定の日に追加する場合は「追加しない」を選択し、予約受付スケジュールから特定の日を選択してメニューを編集してください。</p>
                <div class="pt-4 center">
                  <p class="pt-2"><button type="button" class="btn" data-dismiss="modal">追加しない</button></p>
                  <p class="pt-2"><button class="btn btn-outline-info" onClick="loading(); addCapacityToDateDo();" ><strong>追加する</strong></button></p>
                </div>
            </div>
            <input type="hidden" class="form-control" id="addCapacityToDatemenuId" value="" >
        </div>
    </div>
</div>
@stop









{{-- footer scripts --}}
@section('footer_scripts')
@include('owner/contents/capacity/include/place_owner_js')
@include('owner/contents/capacity/' . UtilYoyaku::getNewMenuSenMonTenSummary($content->service) . '/js')
@include('owner/contents/capacity/' . UtilYoyaku::getNewMenuSenMonTenSummary($content->service) . '/capacity_js')

<script type="text/javascript" src="/storage/assets/plugin/jquery.dragsort.js"></script>
<script type="text/javascript">
$('#CapacityArea').dragsort({
    drop_exchange:0,
    onDrag:function(item){
        //console.log('drag!',item);
    },
    onDragStart:function(item){
        //console.log('drag start!',item);
    },
    onContact:function(item,exitem){
        //console.log("contact! DRAGGED",item,"TOUCHED",exitem);
    },
    onExchange:function(item,exitem){
        //console.log("exchange! DRAGGED",item,"REPLACED",exitem);
    },
    onDrop:function(item){
        //console.log('drop!',item);
        //var a = $("#CapacityArea").children("div").attr("id");
        var a = [];
        $('#CapacityArea').children().each(function(){
          a.push($(this).attr('id')); 
        });
        //console.log(a);
        axios.post('/owner/contents/{!!$content->id!!}/capacity/edit/postElementNumber', {
            element_number: a
        })
        .then(function (response) {
            result = response.data;
            if(!ajaxCheckPublic(result)){return;}
            //console.log('ok');
        })
        .catch(function (error) {
            //console.log('err capacity sort');
            //ajaxCheckError(error); return;
        });
    }
});
</script>


<script type="text/javascript">
/*
//
// capa area //
//
*/
function CapacityhandleFileSelect(evt) {
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
    document.getElementById('Capacity_progress_bar').className = 'loading';
  };
  var file = evt.target.files[0];
  reader.onload = (function(theFile) {
      return function(e) {
          progress.style.width = '100%';
          progress.textContent = '100%';
          setTimeout("document.getElementById('Capacity_progress_bar').className='';", 2000);
          // Render thumbnail.
          $('#preview img').attr('src',e.target.result);
      };
  })(file);
  reader.readAsDataURL(file);
}
document.getElementById('CapacityFormpic').addEventListener('change', CapacityhandleFileSelect, false);




function postCapacity() {


    var capa_id = $('#CapacityFormId').val();
    var addUrl = (isset(capa_id)) ? 'edit' : 'new';

    var form = document.getElementById("CapacityForm");
    var form_data = new FormData(form);

    axios.post('/owner/contents/{!!$content->id!!}/capacity/edit/{!!UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!!}/' + addUrl, form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}
        if(isset(capa_id)) $('#capacity' + capa_id).remove();
        var capacity = createCapacity(result.capacity);
        $('#CapacityArea').prepend(capacity);
        $('#CapacityModal').modal('hide');
        $('[data-toggle="popover"]').popover();
        $('#loading').hide();
        successNotify('登録しました。');
        if(result.ans===1) $('#warningModal').modal('show');
        if(result.ans===2){
            $('#addCapacityToDateModal').modal('show');
            $('#addCapacityToDateModalnewMenuName').html(result.capacity.name);
            $('#addCapacityToDatemenuId').val(result.capacity.id);
        } 
    })
    .catch(function (error) {
        $('#CapacityModal').modal('hide');
        ajaxCheckError(error); return;
    });

}


function addCapacityToDateDo()
{

    var capacity_id = $('#addCapacityToDatemenuId').val();
    axios.post('/owner/contents/{!!$content->id!!}/capacity/edit/postAddCapacityToDate', {
        capacity_id: capacity_id
    })
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}
        $('#addCapacityToDateModal').modal('hide');
        $('#loading').hide();
        successNotify('追加しました。');
    })
    .catch(function (error) {
        $('#addMenuToDateModal').modal('hide');
        ajaxCheckError(error); return;
    });

}


function deleteCapacity() {

    var capacity_id = $('#capacity-id').val();
    if(!isset(capacity_id)){
        $('#loading').hide();
        warningNotify('err: 問合せ:admin@coordiy.com');
    }

    axios.post('/owner/contents/{!!$content->id!!}/capacity/delete', {
        capacity_id: capacity_id
    })
    .then(function (response) {
        result = response.data;
        //console.log(result);
        if(!ajaxCheckPublic(result)){return;}
        $("#capacity" + capacity_id).remove()
        $('#deleteCapacityModal').modal('hide');
        $('#loading').hide();
        successNotify('削除しました。');
    })
    .catch(function (error) {
        $('#deleteCapacityModal').modal('hide');
        ajaxCheckError(error); return;
    });

}

$(document).ready(function () {

    axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getCapacities')
    .then(function (response) {
        result = response.data;
        //console.log(result);
        if(!ajaxCheckPublic(result)){return;}
        var insert;
        $.each(result,function(index,capacity){
            insert = createCapacity(capacity, false);
            $('#CapacityArea').append(insert);
        });
        $('[data-toggle="popover"]').popover();
    })
    .catch(function (error) {
        //console.log('err getCapacity');
        ajaxCheckError(error); return;
    });

    $('#deleteCapacityModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var capacity_id = button.data('whatever') // Extract info from data-* attributes
        $('#capacity-id').val(capacity_id);
    });

});
/*
//
// end capa area //
//
*/
</script>



@stop
