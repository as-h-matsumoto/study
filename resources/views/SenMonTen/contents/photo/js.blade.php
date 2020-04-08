<script type="text/javascript">        

function photoJs()
{

    axios.get('/SenMonTen/{!!UtilYoyaku::getNewMenuSenMonTen($content->service)!!}/contents/{!!$content->id!!}/getMedias')
    .then(function (response) {

        data = response.data;
        //console.log(data);
        if(!ajaxCheckPublic(data)){return;}

        if(data.length >= 1){
            $.each(data,function(index,result){
                var insert = '';
                insert += '<div class="media col-sm ml-2 mb-2">';
                insert += '<a class="" href="' + result.p1600 + '" target="_blank">';
                insert += '<img class="preview w-100" src="' + result.p250 + '"';
                insert += 'title="' + result.title + '" />';
                insert += '<div class="title p-4 f11">' + result.title + '</div>';
                insert += '</a>';
                insert += '</div>';
                $('#mediaAddArea').append(insert);
            });
        }else{
            $('#photoNone').show();
        }
        $('#loading').hide();

    });

}
</script>