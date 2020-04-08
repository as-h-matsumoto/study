<script>
function stepModal(){
  $('#stepModal').modal('show');
}

function deleteQuestionLearning(learning_id){
  axios.post('/license/{{$license_question->license_id}}/question/{!!$license_question->id!!}/learning/delete', {
    learning_id: learning_id
  })
  .then(function (response) {
    if(!ajaxCheckPublic(response.data)){return;}
    $('#learning'+learning_id).remove();
    infoNotify('削除しました。');
    $('#loading').hide();
  })
  .catch(function (error) {
    console.log(error);
    ajaxCheckError(error); return;
  });
}

document.getElementById( 'findLearning' ).onclick = function( e )
{
  loading();
  findLearning();
};
function findLearning(){

    var inputSearch = $('#learningSearch').val();
    if(!inputSearch) return;
    moreLearning(inputSearch);

}

function moreLearning(searchWord){
  axios.get('/account/learning/search', {
    params: {
      searchWord: searchWord
    }
  })
  .then(function (response) {
    if(!ajaxCheckPublic(response.data)){return;}
    //console.log(response.data);
    if(isset(response.data)){
      var more = '';
      count = 1;
      $.each(response.data,function(index,learning){
        if( count===3 ){
          $('#searchTotalNumber').html('<p class=" center f18 text-warning">検索数：' + learning.searchinfo.totalhits + '</p>');
          $.each(learning.search,function(index,val){
            more = '';
            more += '<p class="center pb-4">';
            more += '<a href="javascript:void(0)" onclick="loading();putLicenseQuestionLearning('+val.pageid+',\''+val.title+'\');return false;" >';
            more += '<strong>'+val.title+'</strong>';
            more += '</a>';
            more += '<br /><span class="pr-2">'+val.snippet+'</span>';
            more += '<br /><span class="pr-2">更新: '+moment(val.timestamp).format('YYYY/MM/DD')+'</span>';
            more += '</p>';
            $('#searchAnsArea').append(more);
            more = '';
          });
        }
        count++;
      });
    }else{
      $('#searchAnsArea').html('<p class=" center f18 text-warning">見つかりませんでした。</p>');
    }
    $('#loading').hide();
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });
}


function putLicenseQuestionLearning(pageid, title){
  axios.post('/license/{{$license_question->license_id}}/question/{!!$license_question->id!!}/learning', {
      pageid: pageid,
      title: title
  })
  .then(function (response) {
    if(!ajaxCheckPublic(response.data)){return;}
    var insert = '';
    insert += '<button class="btn btn-outline-info fuse-ripple-ready">';
    insert += '<a target="_blank" ';
    insert += 'href="https://ja.wikipedia.org/?curid='+response.data.pageid+'">';
    insert += response.data.name;
    insert += '</a></button>';
    $('#putLearningArea').prepend(insert);
    infoNotify('ＷＩＫＩと連携しました。');
    $('#stepModal').modal('hide');
    $('#loading').hide();
  })
  .catch(function (error) {
    console.log(error);
    ajaxCheckError(error); return;
  });
}

</script>
