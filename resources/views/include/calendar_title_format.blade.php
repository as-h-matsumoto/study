function titleFormat(title, name){

    var full = {
        'January': '1月',
        'February': '2月',
        'March': '3月',
        'April': '4月',
        'May': '5月',
        'June': '6月',
        'July': '7月',
        'August': '8月',
        'September': '9月',
        'October': '10月',
        'November': '11月',
        'December': '12月'
    };
    
    var short = {
        'Jan': '1月',
        'Feb': '2月',
        'Mar': '3月',
        'Apr': '4月',
        'May': '5月',
        'Jun': '6月',
        'Jul': '7月',
        'Aug': '8月',
        'Sep': '9月',
        'Oct': '10月',
        'Nov': '11月',
        'Dec': '12月'
    };
    
    //console.log(title);
    
    title = title.replace(/,/g, '');
    title = title.split(' ');
    //console.log(title);
    
    if(name=='month'){
        //February 2018
        //console.log('month');
        var a = title[1] + '年' + full[title[0]];
        //console.log(a);
    
    }else if(name=='agendaWeek'){
        //Feb 11 – 17, 2018
        //console.log('agendaWeek');
        //console.log(title[3]);
        //console.log(isNaN(title[3]));
    
        if(!isNaN(title[2])){
            var a = title[2] + '年' + short[title[0]] + title[1] + '日' + title[3] + title[6] + '年' + short[title[4]] + title[5] + '日';
        }else if(!isNaN(title[3])){
            var a = title[4] + '年' + short[title[0]] + title[1] + title[2] + title[3] + '日';
        }else{
            var a = title[5] + '年' + short[title[0]] + title[1] + title[2] + short[title[3]] + title[4] + '日';
        }
        //console.log(a);
    
    }else if(name=='agendaDay'){
        //February 13, 2018
        //console.log('agendaDay');
        var a = title[2] + '年' + full[title[0]] + title[1] + '日';
        //console.log(a);
    
    }
    return a;

}
