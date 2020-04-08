<script>

/*
//
// menu area //
//
*/
function RecommendhandleFileSelect(evt) {

    document.getElementById('recommendNewImagesArea').innerHTML = "";

    progress.style.width = '0%';
    progress.textContent = '0%';
    document.getElementById('recommend_progress_bar').className = 'loading';

    var start_number = 0;
    var files = evt.target.files;
    for (var i = 0, f; f = files[i]; i++) {

        var reader = new FileReader();
        reader.onerror = errorHandler;
        reader.onprogress = updateProgress;
        reader.onabort = function(e) {
          alert('File read cancelled');
        };
        
        reader.onloadstart = function(e) {
          start_number++;
          //console.log('onloadstart:' + start_number);
        };
        reader.onloadend = function(e) {
          start_number--;
          //console.log('onloadend');
          progress.style.width = '100%';
          progress.textContent = '100%';
          //setTimeout("document.getElementById('recommend_progress_bar').className='';", 200);
          document.getElementById('recommend_progress_bar').className='';
          if(start_number!==0){
            progress.style.width = '0%';
            progress.textContent = '0%';
            document.getElementById('recommend_progress_bar').className = 'loading';
          }
        };

        reader.onload = (function(theFile) {
            return function(e) {
                //console.log('onload');
                // Render thumbnail.
                var div = document.createElement('div');
                div.classList.add("col-5");
                div.classList.add("ml-2");
                div.classList.add("mb-2");
                div.innerHTML = ['<img class="thumb" src="', e.target.result,
                                  '" title="', escape(theFile.name), '" style="min-width:120px; max-width:120px;" />'].join('');
                document.getElementById('recommendNewImagesArea').insertBefore(div, null);
            };
        })(f);

        reader.readAsDataURL(f);

    }
}
document.getElementById('recommendPics').addEventListener('change', RecommendhandleFileSelect, false);



function moreRecommendPics(recommend_id,user_id,user_name) {

    axios.get('/cmn/recommend/pics', {
      params: {
        recommend_id: recommend_id
      }
    })
    .then(function (response) {
      result = response.data;
      if(!ajaxCheckPublic(result)){return;}
      $("#modelRecommendPicsBody").html('');
      $('#modelRecommendPicsLabel').html('参考図');
      $.each(result,function(index,a){
          var recoPics = '';
          recoPics = recoPics + '<div class="col-5 ml-2 mb-2">';
          recoPics = recoPics + '<img src="/storage/uploads/users/' + user_id + '/recommend/' + recommend_id + '/' + add_filename(a.pic,'400') + '" style="min-width:120px; max-width:120px;" title="投稿：' + user_name + ' ' + a.updated_at + '" />';
          recoPics = recoPics + '</div>';
          $("#modelRecommendPicsBody").append(recoPics);
      });
      $('#loading').hide();
      $('#modelRecommendPics').modal('show');
    })
    .catch(function (error) {
      ajaxCheckError(error); return;
    });
    
}

</script>