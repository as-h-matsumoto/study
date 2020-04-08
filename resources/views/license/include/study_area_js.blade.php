
<script>

function summaryShow(desc_parts_id) {
  $('#summary'+desc_parts_id).toggle();
}

$(document).ready(function () {

  $('#modelmemoRegi').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var part_id = button.data('whatever') // Extract info from data-* attributes
    $('#memo-part-id').val(part_id);
    var memo = $('#memo'+part_id).html();
    var memo = memo.replace( /<br>/g, '' );
    $('#memo').val(memo);
  });

  $('#modelwikiRegi').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var part_id = button.data('whatever') // Extract info from data-* attributes
    $('#wiki-part-id').val(part_id);
  });

  $('#modelliteratureRegi').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var part_id = button.data('whatever') // Extract info from data-* attributes
    $('#literature-part-id').val(part_id);
  });

  $('#modelsummaryRegi').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var part_id = button.data('whatever') // Extract info from data-* attributes
    $('#summary-part-id').val(part_id);
    var summary = $('#summary'+part_id).html();
    var summary = summary.replace( /<br>/g, '' );
    $('#summary').val(summary);
  });

  $('#stepModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var part_id = button.data('whatever') // Extract info from data-* attributes
    $('#descPartId').val(part_id);
  });
  
});


function onView(desc_parts_id) {
  loading();
  axios.post('/license/regi/postSubPartsView', {
    desc_parts_id: desc_parts_id
  }).then(function (response) {
      result = response.data;
      var messageview = '';
      if(!ajaxCheckPublic(result)){return;}
      if(result=='on'){
        $("#view"+desc_parts_id).html('表示On');
        messageview = '「表示On」にしました。';
      }else{
        $("#view"+desc_parts_id).html('表示Off');
        messageview = '「表示Off」にしました。';
      }
      $('#loading').hide();
      longNotify(messageview);
  })
  .catch(function (error) {
      $('#loading').hide();
      $('#modelmemoRegi').modal('hide');
      ajaxCheckError(error); return;
  });

}


function memoRegi() {

  var form = document.getElementById("memoRegiForm");
  var id = $("#memo-part-id").val();
  var form_data = new FormData(form);
  form_data.append('desc_parts_id', id);
  form_data.append('subject_id', {!!$license_examination_subject_id!!});
  
  axios.post('/license/regi/postSubPartsMemo', form_data)
  .then(function (response) {
      result = response.data;
      if(!ajaxCheckPublic(result)){return;}
      $("#memo"+id).html(result);
      $('#loading').hide();
      $('#modelmemoRegi').modal('hide');
      longNotify('登録しました。');
  })
  .catch(function (error) {
      $('#loading').hide();
      $('#modelmemoRegi').modal('hide');
      ajaxCheckError(error); return;
  });

}


function literatureRegi() {

  var form = document.getElementById("literatureRegiForm");
  var id = $("#literature-part-id").val();
  var form_data = new FormData(form);
  form_data.append('desc_parts_id', id);
  
  axios.post('/license/regi/postSubPartsLiterature', form_data)
  .then(function (response) {
      result = response.data;
      if(!ajaxCheckPublic(result)){return;}
      $("#literature"+id).html(result);
      $('#loading').hide();
      $('#modelliteratureRegi').modal('hide');
      longNotify('登録しました。');
  })
  .catch(function (error) {
      $('#loading').hide();
      $('#modelliteratureRegi').modal('hide');
      ajaxCheckError(error); return;
  });

}

function summaryRegi() {

  var form = document.getElementById("summaryRegiForm");
  var id = $("#summary-part-id").val();
  var form_data = new FormData(form);
  form_data.append('desc_parts_id', id);
  
  axios.post('/license/regi/postSubPartsSummary', form_data)
  .then(function (response) {
      result = response.data;
      if(!ajaxCheckPublic(result)){return;}
      $("#summary"+id).html(result);
      $('#loading').hide();
      $('#modelsummaryRegi').modal('hide');
      longNotify('登録しました。');
  })
  .catch(function (error) {
      $('#loading').hide();
      $('#modelsummaryRegi').modal('hide');
      ajaxCheckError(error); return;
  });

}





//
//  wiki regi
//


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
      $('#searchAnsArea').html('');
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

  var descPartId = $("#descPartId").val();

  axios.post('/license/regi/postDescPartLearning', {
    descPartId: descPartId,
    pageid: pageid,
    title: title
  })
  .then(function (response) {
    if(!ajaxCheckPublic(response.data)){return;}
    var insert = '';
    insert += '<a class="pr-2" target="_blank" ';
    insert += 'href="https://ja.wikipedia.org/?curid='+pageid+'">';
    insert += title+'(wiki)</a>';
    $('#wiki'+descPartId).html(insert);
    infoNotify('WIKIと連携しました。');
    $('#stepModal').modal('hide');
    $('#loading').hide();
  })
  .catch(function (error) {
    console.log(error);
    ajaxCheckError(error); return;
  });
}

function deleteQuestionLearning(learning_id){
  axios.post('/license/regi/postDescPartLearning/delete', {
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


</script>
