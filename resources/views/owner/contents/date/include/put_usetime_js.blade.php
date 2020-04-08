
// service 2,10,11 only
function putUseTime(use_time_desc) {

    var insert = '';

    use_time_desc = JSON.parse(use_time_desc);
    //console.log('use_time_desc: ');
    //console.log(use_time_desc);
    if(isset(use_time_desc[3])){
        //console.log('3day');
        insert += '<table class="table table-hover">';
        insert += '<tbody class="">';
        //today
        for (  var i = 1;  i <= 3;  i++  ) {
            insert += '<tr>';
            insert += '<th scope="row" class="p-0">'+i+'日目</th>';
            insert += '';
            insert += '<td class="p-0 center pt-2">';
            $.each(use_time_desc[i].use_start_end,function(index,use_start_end){
                var use_start = moment(use_start_end.use_start);
                var use_end = moment(use_start_end.use_end);
                insert += '<p>'+use_start.format('MM月DD日 HH:mm')+' ~ '+use_end.format('MM月DD日 HH:mm')+'</p>';
            });
            insert += '</td>'
            insert += '<td class="p-0 pt-2 text-right">';
            insert += '<span>利用時間: <span>'+use_time_desc[i].use_time+'</span>分</span>'
            insert += '</td>'
            insert += '</tr>';
        }
        insert += '<tr><th scope="row" class="p-0 text-right" colspan="2">合計</th><td class="p-0 text-right">利用時間: <span>'+use_time_desc['total_use_time']+'</span>分</td></tr>';
        insert += '</tbody>';
        insert += '</table>';
    }else if(isset(use_time_desc[2])){
        //console.log('2day');
        insert += '<table class="table table-hover">';
        insert += '<tbody>';
        //today
        for (  var i = 1;  i <= 2;  i++  ) {
            insert += '<tr>';
            insert += '<th scope="row" class="p-0"'+i+'日目</th>';
            insert += '';
            insert += '<td class="p-0 center pt-2">';
            $.each(use_time_desc[i].use_start_end,function(index,use_start_end){
                var use_start = moment(use_start_end.use_start);
                var use_end = moment(use_start_end.use_end);
                insert += '<p>'+use_start.format('MM月DD日 HH:mm')+' ~ '+use_end.format('MM月DD日 HH:mm')+'</p>';
            });
            insert += '</td>'
            insert += '<td class="p-0 pt-2 text-right">';
            insert += '<span>利用時間: <span>'+use_time_desc[i].use_time+'</span>分</span>'
            insert += '</td>'
            insert += '</tr>';
        }
        insert += '<tr><th scope="row" class="p-0 text-right" colspan="2">合計</th><td class="p-0 text-right">利用時間: <span>'+use_time_desc['total_use_time']+'</span>分</td></tr>';
        insert += '</tbody>';
        insert += '</table>';
    }else{
        //console.log('today');
        insert += '<table class="table table-hover">';
        insert += '<tbody>';
        insert += '<tr><th scope="row">利用時間</th>';
        insert += '<td>';
        $.each(use_time_desc[1].use_start_end,function(index,use_start_end){
            var use_start = moment(use_start_end.use_start);
            var use_end = moment(use_start_end.use_end);
            insert += '<p>'+use_start.format('MM月DD日 HH:mm')+' ~ '+use_end.format('MM月DD日 HH:mm')+'</p>';
        });
        insert += '</td>'
        insert += '<td><span>'+use_time_desc['total_use_time']+'</span>分利用</td></tr>';
        insert += '</tbody>';
        insert += '</table>';
    }
    return insert;
}