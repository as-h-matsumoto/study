@extends('owner/layouts/default')
{{-- Page title --}}
@section('title') メニュー登録 @parent
@stop

@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
<style>

#menu_progress_bar {
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
#menu_progress_bar.loading {
  opacity: 1.0;
}
#menu_progress_bar .percent {
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

    <div id="menusArea" class="page-content row py-2 px-6">

    </div>

    <div class="page-content-footer">
        <p class="right">
            <a href="/owner/contents/{!!$content->id!!}/desc/edit" >
                <button class="btn btn-outline-info"><strong>概要登録へ <i class="icon icon-chevron-right"></i></strong></button>
            </a>
        </p>
    </div>
    @include('owner/include/footer')
    @include('include/footer')

</div>


<div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="menuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menuModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'menuForm', 'name' => 'menuForm', 'method' => 'post', 'class' => 'row', 'files'=> true)) !!}

                    @include('owner/contents/menu/' . UtilYoyaku::getNewMenuSenMonTenSummary($content->service) . '/modal')

                    <input type="hidden" class="form-control" name="modal-menu-id" id="modal-menu-id" value="" >
                    
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); postMenu();" ><strong>登録</strong></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteMenuModal" tabindex="-1" role="dialog" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMenuModalLabel">メニュー削除</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <p>選択したメニューを削除します。</p>
                <p>選択したメニューを削除すると、完全に見れなくなります。</p>

            </div>

            <input type="hidden" class="form-control" id="delete-menu-id" value="" >

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <a href="javascript:void(0)" class="btn" onClick="loading(); deleteMenu();" ><strong>削除</strong></a>
            </div>
        </div>
    </div>
</div>

@if($content->service===62 or $content->service===69 or $content->service===101)
<div class="modal fade" id="menuStepModal" tabindex="-1" role="dialog" aria-labelledby="menuStepModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menuStepModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                {!! Form::open(array('url' => $_SERVER["REQUEST_URI"], 'id' => 'menuStepForm', 'name' => 'menuStepForm', 'method' => 'post', 'class' => 'row', 'files'=> true)) !!}

                    <input type="hidden" class="form-control" name="menu_id" id="modalMenuId" value="" >
                    <input type="hidden" class="form-control" name="step_id" id="modalMenuStepId" value="" >

                    @include('owner/contents/menu/include/modalStep')

                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-outline-info" onClick="loading(); postMenuStep();" ><strong>{!!Util::getIcon('add','s-4','green')!!} 登録</strong></button>
            </div>
        </div>
    </div>
</div>
@endif

@include('owner/contents/include/modal')

@include('owner/contents/menu/include/modal')

@stop


{{-- footer scripts --}}
@section('footer_scripts')

<script type="text/javascript" src="/storage/assets/plugin/jquery.dragsort.js"></script>
<script type="text/javascript">
$('#menusArea').dragsort({
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
        var a = [];
        $('#menusArea').children().each(function(){
          a.push($(this).attr('id')); 
        });
        //console.log(a);
        axios.post('/owner/contents/{!!$content->id!!}/menu/edit/postElementNumber', {
            element_number: a
        })
        .then(function (response) {
            result = response.data;
            if(!ajaxCheckPublic(result)){return;}
            //console.log('ok');
        })
        .catch(function (error) {
            //console.log('err menu sort');
            //ajaxCheckError(error); return;
        });
    }
});
</script>





<script type="text/javascript">
/*
//
// menu area //
//
*/
function MenuhandleFileSelect(evt) {
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
    document.getElementById('menu_progress_bar').className = 'loading';
  };
  var file = evt.target.files[0];
  reader.onload = (function(theFile) {
      return function(e) {
          progress.style.width = '100%';
          progress.textContent = '100%';
          setTimeout("document.getElementById('menu_progress_bar').className='';", 2000);
          // Render thumbnail.
          $('#preview img').attr('src',e.target.result);
      };
  })(file);
  reader.readAsDataURL(file);
}
document.getElementById('formPic').addEventListener('change', MenuhandleFileSelect, false);



@if($content->service===62 or $content->service===69 or $content->service===101)
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
@endif




function deleteMenu() {

    var menu_id = $('#delete-menu-id').val();
    if(!menu_id){
        $('#loading').hide();
        warningNotify('err: 問合せ:admin@coordiy.com');
        return;
    }

    axios.post('/owner/contents/{!!$content->id!!}/menu/delete', {
        menu_id: menu_id
    })
    .then(function (response) {
        result = response.data;
        //console.log(result);
        if(!ajaxCheckPublic(result)){return;}
        $("#menu" + menu_id).remove();
        $('#deleteMenuModal').modal('hide');
        $('#loading').hide();
        successNotify('削除しました。');
    })
    .catch(function (error) {
        $('#deleteMenuModal').modal('hide');
        ajaxCheckError(error); return;
    });

}

function deleteMenuStep(menu_id, step_id) {

    loading();

    axios.post('/owner/contents/{!!$content->id!!}/menu/step/delete', {
        menu_id: menu_id,
        step_id: step_id
    })
    .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}
        var steps = response.data;
        //console.log(steps);
        
        $('#stepArea'+menu_id).html('');

        var insert = '';
        $.each(steps,function(index,step){
            insert += createMenuStep(menu_id, step);
        });
        $('#stepArea'+menu_id).html(insert);
        
        $('#loading').hide();
        successNotify('削除しました。');
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

}





function addMenuToDate(result){
    
    @if( !(
      $content->service===15 or
      $content->service===65 or
      $content->service===77 or
      $content->service===81 or
      $content->service===85 or
      $content->service===89 or
      $content->service===90
    ) )
    $('[data-toggle="popover"]').popover();
    @else
    
    var name = result.name;
    var menu_id = result.id;

    axios.get('/owner/contents/{!!$content->id!!}/menu/existMenuToDate', {
      params: {
        menu_id: menu_id
      }
    })
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}
        if(result){
            $('#addMenuToDateModal').modal('show');
            $('#addMenuToDateModalnewMenuName').html(name);
            $('#addMenuToDatemenuId').val(menu_id);
            if(result===2){
                $('#allAddTypeMenu').show();
                $('#publicTypeMenu').hide();
            }else if(result===1){
                $('#allAddTypeMenu').hide();
                $('#publicTypeMenu').show();
            }
        };
        $('[data-toggle="popover"]').popover();
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

    @endif

}


function addMenuToDateDo(action){

    var menu_id = $('#addMenuToDatemenuId').val();
    axios.post('/owner/contents/{!!$content->id!!}/menu/postAddMenuToDate', {
        menu_id: menu_id,
        action: action
    })
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}
        $('#addMenuToDateModal').modal('hide');
        $('#loading').hide();
        successNotify('追加しました。');
    })
    .catch(function (error) {
        $('#addMenuToDateModal').modal('hide');
        ajaxCheckError(error); return;
    });

}



$(document).ready(function () {

    axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getMenus')
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}
        var insert;
        if(result.length===0){
            infoNotify('次に、メニューを登録してください。');
            menuModal(null);
        }else{
            $.each(result,function(index,menu){
                insert = createMenu(menu, null);
                $('#menusArea').append(insert);
            });
            $('[data-toggle="popover"]').popover();
        }
    })
    .catch(function (error) {
        //console.log('err getMenus');
        ajaxCheckError(error); return;
    });

    $('#deleteMenuModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var menu_id = button.data('whatever') // Extract info from data-* attributes
      $('#delete-menu-id').val(menu_id);
    });
    
});
</script>
@include('owner/contents/menu/' . UtilYoyaku::getNewMenuSenMonTenSummary($content->service) . '/menu_js')
@include('owner/contents/menu/' . UtilYoyaku::getNewMenuSenMonTenSummary($content->service) . '/js')

@if($content->service===62 or $content->service===69 or $content->service===101)
@include('owner/contents/menu/include/menu_step_js')
@include('owner/contents/menu/include/js_step')
@endif

@stop
