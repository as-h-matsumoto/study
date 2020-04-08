@extends('manager/layouts/default')

{{-- Page title --}}
@section('title') チェックコンテンツメニュー @parent
@stop


@section('meta')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- content --}}
@section('content')
<div id="project-dashboard" class="page-layout simple full-width">

    @include('manager/include/header')

    <div class="page-content row">
        <div class="card col-sm-4">
            <div class="card-body">
                <a class="btn btn-outline-info" href="/manager/contents/menu/check?type=contents">一般オーナーコンテンツメニュー</a>
                {!! Form::open(array('url' => '', 'id' => 'menu_name', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}
                    <input type="text" name="menu_public" value="">
                    <a onClick="searchContentPublicName" ><i class="icon icon-search-web"></i></a>
                </form>
            </div>
        </div>
        <div class="card col-sm-4">
            <div class="card-body">
                <a class="btn btn-outline-info" href="/manager/contents/menu/check?type=csv">csvオーナーコンテンツメニュー</a>
                {!! Form::open(array('url' => '', 'id' => 'menu_name', 'method' => 'post', 'class' => 'row', 'files'=> false)) !!}
                    <input type="text" name="menu_csv" value="">
                    <a onClick="searchContentCSVName" ><i class="icon icon-search-web"></i></a>
                </form>
            </div>
        </div>
    </div>

    <div class="page-content p-4" style="overflow-y:scroll;">
    
        <p class="h3" ><strong>{!!UtilYoyaku::getNewMenuSenMonTen($service)!!} メニューチェック</strong></p>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>コンテンツメニュー</th>
                <th>コンテンツメニュー名</th>
                <th>コンテンツメニュータグ</th>
                <th>ACTION</th>
            </tr>
            </thead>
            <tbody id="searchMenus">
        
            @include('manager/include/check_menus')
        
            </tbody>
        </table>
        <div class="page-content-footer">
            <p class="right" id="pageMoreMenus">
                @if( !empty($menus) and $menus->hasMorePages() )
                <button class="btn btn-outline-info" onclick="loading();ajaxPaginationMenusMore('{!!$menus->nextPageUrl()!!}');return false;" >
                    <strong>もっと</strong>
                </button>
                @endif
            </p>
        </div>

    </div>
</div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')

<script>


function postContentMenuTags(content_id,content_menu_id){

    var form = document.getElementById("content" + content_id + 'Menu' + content_menu_id);
    var form_data = new FormData(form);

    axios.post('/manager/contents/menu/check', form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){return;}
        $('#deleContent' + content_id + 'Menu' + content_menu_id).remove();
        $('#loading').hide();
        successNotify('登録しました。');
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });
}



function ajaxPaginationContentsMore(url) {
    axios.get(url)
    .then(function (response) {
      if(!ajaxCheckPublic(response.data)){return;}
      if(isset(response.data)){
        $('#searchContents').append(response.data);
      }else{
        $('#pageMoreContents').html('');
      }
      $('#loading').hide();
    })
    .catch(function (error) {
      $('#pageMoreContents').remove();
      ajaxCheckError(error); return;
    });
}

function ajaxPaginationMenusMore(url) {
    axios.get(url)
    .then(function (response) {
      if(!ajaxCheckPublic(response.data)){return;}
      if(isset(response.data)){
        $('#searchMenus').append(response.data);
      }else{
        $('#pageMore').html('');
      }
      $('#loading').hide();
    })
    .catch(function (error) {
      $('#pageMore').remove();
      ajaxCheckError(error); return;
    });
}



function searchContentPublicName(){

    var searchWords = $('input[name="content_public"]').val();

    if(!searchWords){
        $('#loading').hide();
        return;
    }

    axios.get('/manager/contents/check', {
      params: {
        ajax: 1,
        type: 'public',
        searchWords: searchWords
      }
    })
    .then(function (response) {
      //console.log('in?')
      //console.log(response)
      if(isset(response.data)){
        var more = '';
        more += '<button class="btn btn-outline-info" ';
        more += ' onclick="loading();';
        more += ' ajaxPaginationContentsMore(\'';
        more += '/manager/contents/check?page=2';
        more += '\');return false;" >';
        more += '<strong>もっと</strong>';
        more += '</button>';
        document.getElementById('pageMore').innerHTML = more;
        document.getElementById('searchContents').innerHTML = response.data;
        //$('#searchContents').html(response.data);
      }else{
        $('#searchContents').html('<div class="col-sm-12 center"><p class="f18">見つかりませんでした。</p></div>');
      }
      $('#loading').hide();
    })
    .catch(function (error) {
      ajaxCheckError(error); return;
    });

}




function searchContentCSVName(){

   //console.log('searchContentCSVName on');

    var searchWords = $('input[name="content_csv"]').val();
    if(!searchWords){
        $('#loading').hide();
        return;
    }

    axios.get('/manager/contents/check', {
      params: {
        ajax: 1,
        type: 'csv',
        searchWords: searchWords
      }
    })
    .then(function (response) {
      //console.log('in?')
     //console.log(response)
      if(isset(response.data)){
        var more = '';
        more += '<button class="btn btn-outline-info" ';
        more += ' onclick="loading();';
        more += ' ajaxPaginationContentsMore(\'';
        more += '/manager/contents/check?page=2&searchWords='+searchWords;
        more += '\');return false;" >';
        more += '<strong>もっと</strong>';
        more += '</button>';
        document.getElementById('pageMore').innerHTML = more;
        document.getElementById('searchContents').innerHTML = response.data;
        //$('#searchContents').html(response.data);
      }else{
        $('#searchContents').html('<div class="col-sm-12 center"><p class="f18">見つかりませんでした。</p></div>');
      }
      $('#loading').hide();
    })
    .catch(function (error) {
      ajaxCheckError(error); return;
    });


}

</script>
@stop
