<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

@include('include/recommend_public_js')

<script>

var recommendNewCount = true;
function recommendNew(table_name, table_id, table_type) {

  $('#table_name').val(table_name);
  $('#table_id').val(table_id);
  $('#table_type').val(table_type);
  
  $("#rateYo").rateYo({
    rating: 3
  });

  document.getElementById('recommendNewImagesArea').innerHTML = "";
  $('#recommendForm')[0].reset();

  $('#modelRecommendExists').modal('hide');

  $('#modelRecommendPost').modal('show');

  $('#loading').hide();

}





var recommendExistsCount = true;
function recommendExists(table_name, table_id, table_type) {

  if(recommendExistsCount){

    axios.get('/account/recommend/exists', {
      params: {
        table_name: table_name,
        table_id: table_id
      }
    })
    .then(function (response) {
      result = response.data;
      if(!ajaxCheckPublic(result)){return;}

      if(result){
        $('#modelRecommendExists').modal('show');
        recommendExistsCount = false;
        $('#modelRecommendExistsButton').append('<button type="button" class="btn bg-green-200 text-auto" onClick="loading(); recommendNew(\'' + table_name + '\', \'' + table_id + '\', \'' + table_type + '\')" >学習メモ追加</button>');
      }else{
        recommendNew(table_name, table_id, table_type);
      }
    })
    .catch(function (error) {
      ajaxCheckError(error); return;
    });
  }else{
    $('#modelRecommendExists').modal('show');
  }

}
</script>


<script>

$(document).ready(function () {

  $('#modelRecommendDelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recommend_id = button.data('whatever') // Extract info from data-* attributes
    $('#recommend-id').val(recommend_id);
  });

});

function deleteRecommendRecommend(recommend_id) {

  var recommend_id = $('#recommend-id').val();
  //console.log(recommend_id);
  if(!recommend_id){
     $('#loading').hide();
     warningNotify('err: 問合せ:admin@coordiy.com');
  }

  axios.post('/account/recommend/delete/recommend', {
    recommend_id: recommend_id
  })
  .then(function (response) {
      result = response.data;
      if(!ajaxCheckPublic(result)){return;}
      $('#reco'+recommend_id).remove();
      $('#modelRecommendDelete').modal('hide');
      $('#loading').hide();
      successNotify('学習メモを削除しました。');
  })
  .catch(function (error) {
      ajaxCheckError(error); return;
  });
}



function deleteRecommendPic(recommends_pics_id) {
  //console.log(recommends_pics_id);
  axios.post('/account/recommend/delete/pic', {
    recommends_pics_id: recommends_pics_id
  })
  .then(function (response) {
      result = response.data;
      if(!ajaxCheckPublic(result)){return;}
      $('#loading').hide();
      $('#pic'+recommends_pics_id).remove();
      successNotify('参考図を削除しました。');
  })
  .catch(function (error) {
      ajaxCheckError(error); return;
  });
}




function recommendEdit(recommend_id,title) {

  document.getElementById('recommendImagesArea').innerHTML = "";
  $('#recommendForm')[0].reset();
  
  axios.get('/account/recommend/ajaxGetRecommend', {
    params: {
      recommend_id: recommend_id
    }
  })
  .then(function (response) {
    result = response.data;
  
    $('#modelRecommendPostLabel').html(title+'の学習メモ編集');
    var rateYo = $("#rateYo").rateYo();
    rateYo.rateYo("rating", result.point);
    $('#recommend').html(result.recommend);
    $('#sub_name').val(result.sub_name);
    $('#sub_url').val(result.sub_url);
    if(isset(result.pics)){
    $.each(result.pics,function(index,pic){
      var recoPic = '';
      recoPic = recoPic + '<div id="pic' + pic.id + '" class="col-5 mb-2 ml-2">';
      recoPic = recoPic + '<div>';
      recoPic = recoPic + '<img src="/storage/uploads/users/' + recommend.user_id + '/recommend/' + recommend_id + '/' + add_filename(pic.pic,'400') + '" style="min-width:120px; max-width:120px;" />';
      recoPic = recoPic + '</div>';
      recoPic = recoPic + '<div class="image-footer">';
      recoPic = recoPic + '<span class="btn" onClick="loading(); deleteRecommendPic(' + pic.id + ');" >';
      recoPic = recoPic + '<span>削除</span>';
      recoPic = recoPic + '</span>';
      recoPic = recoPic + '</div>';
      recoPic = recoPic + '</div>';
      $("#recommendImagesArea").append(recoPic);
    });
    }

    $('#submitHtmlRecommend').html('<button class="btn btn-outline-info" onClick="loading(); postRecommend(' + recommend_id + ');" ><strong><i class="icon icon-plus-circle-outline s-4" title="追加" alt="追加"></i> 登録</strong></button>');
    $('#modelRecommendPost').modal('show');
    $('#loading').hide();

  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });

}




function postRecommend(recommend_id = '') {

  var $rateYo = $("#rateYo").rateYo();
  var rating = $rateYo.rateYo("rating");

  var form = document.getElementById("recommendForm");
  var form_data = new FormData(form);
  form_data.append('rating', rating);
  form_data.append('recommend_id', recommend_id);

  console.log('postRecomend');
  console.log('recommend_id: '+recommend_id);

  axios.post('/account/recommend/edit', form_data)
  .then(function (response) {
    console.log(response.data);
    if(!ajaxCheckPublic(response.data)){return;}
    if(recommend_id){
      $('#reco'+recommend_id).remove();
      console.log('yes recommend_id');
    }else{
      console.log('no recommend_id');
    }
    $('#searchRecommends').prepend(response.data);
    $('#modelRecommendPost').modal('hide');
    $('#loading').hide();
    successNotify('学習メモを追加しました。');
  })
  .catch(function (error) {
    $('#modelRecommendPost').modal('hide');
    ajaxCheckError(error); return;
  });

}

/*
function postRecommend() {

    var $rateYo = $("#rateYo").rateYo();
    var rating = $rateYo.rateYo("rating");

    var form = document.getElementById("recommendForm");
    var form_data = new FormData(form);
    form_data.append('rating', rating);

    axios.post('/account/recommend/edit', form_data)
    .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}
        $('#searchRecommends').append(response.data);
        $('#modelRecommendPost').modal('hide');
        $('#loading').hide();
        successNotify('学習メモを追加しました。');
    })
    .catch(function (error) {
        $('#modelRecommendPost').modal('hide');
        ajaxCheckError(error); return;
    });

}
*/

</script>