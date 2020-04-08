<script>
function insertUsers(event, content_date_users)
{

    //console.log('event');
    //console.log(event);
    //console.log('content_date_users');
    //console.log(content_date_users);
    var insert = '';
    var description = '';
    var name = '';
    var type = '';
    var title = '';
    var person = '';

    insert += '<div>';

    $.each(content_date_users,function(index,content_date_user){

        insert += '<div class="row border-bottom mb-6 mx-1 pb-4">';

        insert += '<div class="col-4 pr-0">';
        if(content_date_user.user_pic){
            insert += '<span class=""><img class="avater center" src="/storage/uploads/users/' + content_date_user.user_id + '/' + add_filename(content_date_user.user_pic,250) + '" /></span>';
        }else{
            insert += '<span class=""><img class="avater center" src="/storage/global/img/user1_80.jpeg" /></span>';
        }
        insert += '</div>';

        insert += '<div class="col-8">';
        if( {!!$content->user_id!!}===content_date_user.user_id ){
            insert += '<p class="center"><span class="text-warning"><strong>[オーナー予約]' + content_date_user.user_name + '</strong></span></p>';
        }else{
            insert += '<p class="center"><span class="text-info"><strong>' + content_date_user.user_name + '</strong></span></p>';
        }
        insert += '<p class="center"><span class="">ご利用人数： ' + content_date_user.join_user_number + '名</span><span class="">, </span>';

        var tell = (content_date_user.user_tell) ? content_date_user.user_tell : 'なし';
        insert += '<span>TEL： ' + tell + '</span></p>';

        var start = moment(content_date_user.start);
        var end = moment(content_date_user.end);
        insert += '<p class="center"><span class="">ご利用時間： ' + start.format('HH:mm') + '</span><span class="">~</span>';
        insert += '<span>' + end.format('HH:mm') + '</span></p>';
        insert += '<p class="center"><span class="text-success"><strong>予約ID ' + content_date_user.yoyaku_id + '</strong></span></p>';
        insert += '</div>';

        insert += '</div>';

    });


    

    insert += '</div>';
    
    return insert;
}

</script>




