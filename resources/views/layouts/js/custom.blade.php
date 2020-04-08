<script type="text/javascript">

$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
function loading(){ $('#loading').show();}
moment.locale('ja');

$('form').submit(function(){ loading(); });

function answerDisplayFunc(key = null){ $('#answerDisplay'+key).toggle(); }

function getDayJp(time)
{
  var time = moment(time);
  var current   = moment();
  var DT_time = moment(time.format('Y-m-d 00:00:00'));
  var DT_current = moment(time.format('Y-m-d 00:00:00'));

  var ans = DT_time.diff(DT_current, 'days'); // 365

 //console.log(ans);
  return;
  
  //if(ans===0){
  //  return '本日';
  //}elseif(ans===1){
  //  return '明日';
  //}elseif(ans===2){
  //  return '明後日';
  //}else{
  //  return time.format('m/d');
  //}
  //return '';

}



function getNname(serviceSummary,capacity)
{
  var Nname = '';
  var insert = '';
  switch(serviceSummary){
    case 'food': Nname = '席'; insert = '<span>(席料)</span>'; break;
    case 'active':
        if(capacity.type===8){Nname = ''; insert = '<span>(すべて/1日)</span>';
        }else if(capacity.type===3){Nname = 'コート'; insert = '<span>(1コート/'+capacity.time+'分)</span>';
        }else if(capacity.type<=4){Nname = '台'; insert = '<span>(1台/'+capacity.time+'分)</span>';
        }else{Nname = ''; insert = '('+capacity.time+'分)';}
        break;
    //case 'stay':  Nname = 'ルーム'; insert = '('+time+'分)'; break;
    case 'studio': Nname = 'スタジオ'; insert = '('+capacity.time+'分)'; break;
    case 'kaigi': Nname = '部屋'; insert = '('+capacity.time+'分)'; break;
    case 'spasalon': Nname = '施術スペース'; insert = ''; break;
    case 'hairsalon': Nname = '美容スペース'; insert = ''; break;
    case 'divination': Nname = '占いスペース'; insert = ''; break;
  }
  return {'Nname':Nname,'insert':insert};
}



function getMenuType(service, key)
{
  switch (service){
    case 'food': tag = {1:'単品',2:'コース',9:'その他メニュー'}; break;
    case 'active': tag = {1:'',2:'',9:'その他メニュー'}; break;
    case 'experience': tag = {1:'',2:'',9:'その他メニュー'}; break;
    case 'lesson': tag = {1:'趣味',2:'スポーツ',3:'学習',4:'演奏',40:'その他レッスン・学び'}; break;
    case 'spasalon': tag = {1:'マッサージ',2:'フェイススパ',3:'ボディスパ',4:'フェイススパ',5:'ヘッドスパ',9:'その他スパメニュー'}; break;
    case 'tour': tag = {1:'',2:'',9:''}; break;
    case 'ticket': tag = {1:'',2:'',9:''}; break;
    case 'hairsalon': tag = {1:'カット',2:'カラーリング',9:'その他美容メニュー'}; break;
    case 'stay': tag = {1:'ディナー',2:'ランチ',3:'朝食',9:'その他メニュー'}; break;
    case 'studio': tag = {1:'',2:'',9:''}; break;
    case 'kaigi': tag = {1:'',2:'',9:''}; break;
    case 'hotel': tag = {1:'',2:'',9:''}; break;
    case 'recruit': tag = {}; break;
    case 'divination': tag = {1: '姓名判断',2: '手相占い',3: '人相占い',4: '印相占い',5: '夢占い',6: '風水',7: 'ヴァーストゥ・シャーストラ',8: '家相',9: '周易',10:'六壬神課',11:'奇門遁甲',12:'ルーン占い',13:'タロット占い',14:'ジプシー占い',15:'カード占い',16:'水晶占い',17:'ダウジング',18:'御神籤',19:'阿弥陀籤',20:'辻占い',21:'ジオマンシー',22:'ポエ占い',23:'四柱推命',24:'紫微斗数',25:'星座占い',26:'占星術',27:'西洋占星術',28:'数秘術',29:'九星気学',30:'算命学',31:'0学占い',32:'六星占術',33:'動物占い',34:'その他占い'}; break;
    default: return '';
  }

  if(key){
    return tag[key];
  }else{
    return tag;
  }

}



function getCapacityType(service, key)
{
  var tag;
  switch (service){
    case 'food': tag = {1:'カウンター席',2:'テーブル席',3:'お座敷',4:'レンタル', 9:'その他飲食店設備'}; break;
    case 'active': tag = {1:'ダーツ',2:'卓球',3:'テニス',4:'‎ビリヤード',5:'‎ボルダリング',6:'‎ジム',7:'‎プール',8:'すべて',9:'その他アクティブ'}; break;
    case 'experience': tag = {1:'お仕事',2:'美活動',3:'趣味',4:'演奏',5:'スポーツ',6:'学習',9:'その他体験'}; break;
    case 'lesson': tag = {1:'趣味',2:'演奏',3:'スポーツ',4:'学習',9:'その他レッスン・学び'}; break;
    case 'spasalon': tag = {1:'マッサージ',2:'ボディスパ',3:'フェイススパ',4:'ネイル',9:'その他スパスペース'}; break;
    case 'tour': tag = {}; break;
    case 'ticket': tag = {}; break;
    case 'hairsalon': tag = {1:'カット席',2:'カラーリング席',3:'カット／カラーリング兼用',9:'その他美容スペース'}; break;
    case 'stay': tag = {1:'宿泊ルーム',2:'共有スペース'}; break;
    case 'studio': tag = {1:'撮影',2:'音楽',3:'ライブ',4:'キッチン',9:'その他スタジオ'}; break;
    case 'kaigi': tag = {}; break;
    case 'hotel': tag = {}; break;
    case 'recruit': tag = {}; break;
    case 'divination': tag = {}; break;
    default: return '';
  }

  if(key){
    if(isset(tag[key])){
      return tag[key];
    }else{
      return '';
    }
  }else{
    return tag;
  }

}

function getCapacityTypeIcon(service, key, size)
{

  switch (service){
    case 'food': tag = {}; break;
    case 'active': tag = {}; break;
    case 'experience': tag = {}; break;
    case 'lesson': tag = {}; break;
    case 'spasalon': tag = {}; break;
    case 'tour': tag = {}; break;
    case 'ticket': tag = {}; break;
    case 'hairsalon': tag = {}; break;
    case 'stay': tag = {}; break;
    case 'studio': tag = {
      1: '<i class="icon icon-camcorder-box ' + size + ' text-grey-800" title="撮影スタジオ" alt="撮影スタジオ"></i>',
      2: '<i class="icon icon-music-box-outline ' + size + ' text-blue-500" title="音楽スタジオ" alt="音楽スタジオ"></i>',
      3: '<i class="icon icon-music ' + size + ' text-red-500" title="ライブスタジオ" alt="ライブスタジオ"></i>',
      4: '<i class="icon icon-food ' + size + ' text-orange-500" title="キッチンスタジオ" alt="キッチンスタジオ"></i>',
      5: '<i class="icon icon-folder-star ' + size + ' text-purple-500" title="その他スタジオ" alt="その他スタジオ"></i>'
      }
      break;
    case 'kaigi': tag = {}; break;
    case 'hotel': tag = {}; break;
    case 'recruit': tag = {}; break;
    case 'divination': tag = {}; break;
    default: return '';
  }
  
  if(key){
    if(isset(tag[key])){
      return tag[key];
    }else{
      return '';
    }
  }else{
    return tag;
  }

}


function getContentDateStatus(key,type,size)
{
  if(type==='name'){
    var tag = {
      0: '非表示',
      1: '受付中',
      2: '残り中',
      3: '残りわずか',
      4: 'キャンセル待ち',
      5: '受付終了',
      6: '満員',
      7: '中止',
      8: '延期',
      9: '終了',
      10: '貸切'
    };
  }else if(type==='icon'){
    var tag = {
      0: '<i class="icon icon-stop ' + size + ' text-grey-400" title="非表示" alt="非表示"></i>',
      1: '<i class="icon icon-circle ' + size + ' text-green-600" title="受付中" alt="受付中"></i>',
      2: '<i class="icon icon-alert ' + size + ' text-orange-900" title="残り中" alt="残り中"></i>',
      3: '<i class="icon icon-alert ' + size + ' text-yellow-500" title="残りわずか" alt="残りわずか"></i>',
      4: '<i class="icon icon-skip-next ' + size + ' text-blue-400" title="Cancel待ち" alt="Cancel待ち"></i>',
      5: '<i class="icon icon-barley ' + size + ' text-grey-600" title="受付終了" alt="受付終了"></i>',
      6: '<i class="icon icon-timer-sand-full ' + size + ' text-grey-500" title="満員" alt="満員"></i>',
      7: '<i class="icon icon-stop-circle ' + size + ' text-grey-700" title="中止" alt="中止"></i>',
      8: '<i class="icon icon-sleep ' + size + ' text-grey-800" title="延期" alt="延期"></i>',
      9: '<i class="icon icon-cancel ' + size + ' text-grey-400" title="終了" alt="終了"></i>',
      10: '<i class="icon icon-stop-circle ' + size + ' text-purple-700" title="貸切" alt="貸切"></i>'
    };
  }else if(type==='color'){
    var tag = {
      0: '#bdbdbd',
      1: '#00c853',
      2: '#E65100',
      3: '#fdd835',
      4: '#607D8B',
      5: '#37474f',
      6: '#9E9E9E',
      7: '#616161',
      8: '#424242',
      9: '#bdbdbd',
      10: '#7B1FA2'
    };
  }

  if(key){
    return tag[key];
  }else{
    return tag;
  }

}


function ToMin(time){
  var data = time.split(':');
  var minitus = parseInt(data[1], 10);
  var hour = parseInt(data[0], 10);
  minitus += hour*60;
  return minitus;
}

var formatDate = function (date, format) {
  if (!format) format = 'YYYY-MM-DD hh:mm:ss.SSS';
  format = format.replace(/YYYY/g, date.getFullYear());
  format = format.replace(/MM/g, ('0' + (date.getMonth() + 1)).slice(-2));
  format = format.replace(/DD/g, ('0' + date.getDate()).slice(-2));
  format = format.replace(/hh/g, ('0' + date.getHours()).slice(-2));
  format = format.replace(/mm/g, ('0' + date.getMinutes()).slice(-2));
  format = format.replace(/ss/g, ('0' + date.getSeconds()).slice(-2));
  if (format.match(/S/g)) {
    var milliSeconds = ('00' + date.getMilliseconds()).slice(-3);
    var length = format.match(/S/g).length;
    for (var i = 0; i < length; i++) format = format.replace(/S/, milliSeconds.substring(i, i + 1));
  }
  return format;
};



function recommend_star(point, size){
    var star = '';
    if(point<0.3){
     star='<i class="f' + size + ' icon-star-outline text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i>';
    }else if(point>=0.3 && point<0.7){
     star='<i class="f' + size + ' icon-star-half text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i>';
    }else if(point>=0.7 && point<1.3){
     star='<i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i>';
    }else if(point>=1.3 && point<1.7){
     star='<i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star-half text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i>';
    }else if(point>=1.7 && point<2.3){
     star='<i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i>';
    }else if(point>=2.3 && point<2.7){
     star='<i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star-half text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i>';
    }else if(point>=2.7 && point<3.3){
     star='<i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i>';
    }else if(point>=3.3 && point<3.7){
     star='<i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star-half text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i>';
    }else if(point>=3.7 && point<4.3){
     star='<i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star-outline text-amber-600"></i>';
    }else if(point>=4.3 && point<4.7){
     star='<i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star-half text-amber-600"></i>';
    }else if(point>=4.7){
     star='<i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star text-amber-600"></i><i class="f' + size + ' icon-star text-amber-600"></i>';
    }
    return star;
}










function ajaxCheckPublic(result) {
    if(result==='mustLogin'){
        var message = 'ログインが必要です。';
        $('#loading').hide();
        infoNotify(message);
        return;
    }else if(result==='mustPlace'){
        var message = '先に活動場所を登録してください。';
        $('#loading').hide();
        infoNotify(message);
        return;
    }else if(result==='max'){
        var message = 'これ以上登録できません。';
        $('#loading').hide();
        infoNotify(message);
        return;
    }else if(result==='doNo'){
        var message = 'すでに登録済みです。';
        $('#loading').hide();
        infoNotify(message);
        return;
    }else if(result==='doNoPleseDelete'){
        var message = 'すでに登録済みです。';
        $('#loading').hide();
        infoNotify(message);
        return;
    }else if(result==='ng'){
        var message = 'err: 問合せ:admin@coordiy.com';
        $('#loading').hide();
        warningNotify(message);
        return;
    }else if(result.err===1){
       //console.log('ajaxcheck');
        $('#loading').hide();
        warningNotify(result.message);
        return;
    }else if(result.err===2){
        $('.modal').modal('hide');
        $('#loading').hide();
        $('#modalErrorMessageLabel').html('<span>'+result.title+'</span>');
        $('#modalErrorMessageMessage').html('<span>'+result.message+'</span>');
        $('#modalErrorMessage').modal('show');
        return;
    }else if(result.err===3){
      $('#loading').hide();
      longNotify(result.message);
      return;
    }else if(result.err===9){
      $('#loading').hide();
      warningNotify(result.message);
      location.href='/';
      return;
    }
    return 1;
}



function isset(data){
    if(data === "" || data === null || data === undefined || Object.keys(data).length === 0){
        return false;
    }else{
        return true;
    }
};

function add_filename(filename,add) {
  var a = filename.split(/\.(?=[^.]+$)/);
  var result = a[0] + '_' + add + '.' + a[1];
  return result;
}

//changeSizeGoogleImage
function changeSizeGoogleImage(url,size) {
    var resize = 'h' + size + '-k';
    //console.log('in');
    //console.log(url);
    result = url.replace( /w5000-k/g , resize );
    return result;
}

function nl2br(str) {
    if( !isset(str) ) return '';
    str = str.replace(/\r\n/g, "<br />");
    str = str.replace(/(\n|\r)/g, "<br />");
    return str;
}
function nl2brBack(str) {
    if( !isset(str) ) return '';
    str = str.replace(/<br>/g, "\r\n");
    return str;
}

function ajaxPaginationMore(url) {
    axios.get(url)
    .then(function (response) {
      if(!ajaxCheckPublic(response.data)){return;}
      if(isset(response.data)){
        $('#searchContents').append(response.data);
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



@if(isset($GLOBALS['yoyaku_type_id']))
function moreContentsWords(searchWords){
  axios.get('/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}', {
    params: {
      ajax: 1,
      searchWords: searchWords
    }
  })
  .then(function (response) {
    //console.log('in?')
    //console.log(response.data)
    if(isset(response.data)){
      var more = '';
      more += '<button class="btn btn-outline-info" ';
      more += ' onclick="loading();';
      more += ' ajaxPaginationMore(\'';
      more += '/SenMonTen/{!!$GLOBALS['yoyaku_type_name']!!}?page=2&searchWords='+searchWords;
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
@endif




function ajaxPaginationMoreRecommend(url) {
    axios.get(url)
    .then(function (response) {
      if(!ajaxCheckPublic(response.data)){return;}
      if(isset(response.data)){
        $('#searchRecommends').append(response.data);
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


function ajaxPaginationMoreRecommendRIght(url) {
    axios.get(url)
    .then(function (response) {
      if(!ajaxCheckPublic(response.data)){return;}
      if(isset(response.data)){
        $('#rightRecommendPutArea').append(response.data);
      }else{
        $('#rightRecommendPageMore').html('');
      }
      $('#loading').hide();
    })
    .catch(function (error) {
      $('#rightRecommendPageMore').remove();
      ajaxCheckError(error); return;
    });
}




var reader;
var progress = document.querySelector('.percent');
function abortRead() {
  reader.abort();
}
function errorHandler(evt) {
  switch(evt.target.error.code) {
    case evt.target.error.NOT_FOUND_ERR:
      alert('File Not Found!');
      break;
    case evt.target.error.NOT_READABLE_ERR:
      alert('File is not readable');
      break;
    case evt.target.error.ABORT_ERR:
      break; // noop
    default:
      alert('An error occurred reading this file.');
  };
}
function updateProgress(evt) {
  // evt is an ProgressEvent.
  if (evt.lengthComputable) {
    var percentLoaded = Math.round((evt.loaded / evt.total) * 100);
    // Increase the progress bar length.
    if (percentLoaded < 100) {
      progress.style.width = percentLoaded + '%';
      progress.textContent = percentLoaded + '%';
    }
  }
}



function truncate(str, size, suffix) {
    if (!str) str = '';
    if (!size) size = 32;
    if (!suffix) suffix = '...';
    var b = 0;
    for (var i = 0;  i < str.length; i++) {
        b += str.charCodeAt(i) <= 255 ? 1 : 2;
        if (b > size) {
            return str.substr(0, i) + suffix;
        }
    }
    return str;
}


function timeEdit(time) {

    if(!isset(time)){
        return '';
    }

    var ans = '';

    var a = time.charAt(0);
    var b = time.charAt(1);
    var c = time.charAt(3);
    var d = time.charAt(4);

    if( !(a==='0' && b==='0') ){
      if(a!=='0'){
        ans += a + b + '時間';
      }else{
        ans += b + '時間';
      }
    }

    if( !(c==='0' && d==='0') ){
      if(c!=='0'){
        ans += c + d + '分';
      }else{
        ans += d + '分';
      }
    }
    return ans;
}

function niceBad(table, id, type, key) {
  axios.post('/nice', {
    table: table,
    id: id,
    type: type
  })
  .then(function (response) {
    var result = response.data;
    $('#loading').hide();
    if(!ajaxCheckPublic(result)){return;}
    $("#nice" + key + type + id).html(result);
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });
};

function ajaxCheckError(error) {
  //console.log(error.response);
  switch( error.response.status ) {
    case 401: infoNotify('先に<a href="/login"><u>ログイン</u></a>してください。'); break;
    case 403: infoNotify('先に<a href="/login"><u>ログイン</u></a>してください。'); break;
    //case 404: infoNotify('ページが見つかりません。'); break;
    case 413: infoNotify('投稿データが大きすぎます。');break;
    case 422: infoNotify('登録内容を確認してください。');break;
    case 500: infoNotify('もう一度アクセスしてください。'); break;
    case 501: infoNotify('もう一度アクセスしてください。'); break;
    case 502: infoNotify('混雑しています。申し訳ございません。'); break;
    case 503: infoNotify('混雑しています。申し訳ございません。'); break;
    case 504: infoNotify('混雑しています。申し訳ございません。'); break;
  }
  $('#loading').hide();
}

function favorite_rich(table, id, type) {
  axios.post('/favorite', {
    table: table,
    id: id,
    type: type
  })
  .then(function (response) {
    var result = response.data;
    $('#loading').hide();
    if(!ajaxCheckPublic(result)){return;}
    var a = '';
    var message = '';
    if(type==='add'){
        a += '<a href="javascript:void(0)" onClick="loading(); favorite(\'' + table + '\', ' + id + ', \'delete\')">';
        a += '<i class="icon icon-content-save-all s-6 text-red-600" title="補習リスト解除" alt="補習リスト解除"></i>&nbsp;補習リスト解除</a>';
        message = '補習リストに追加しました。';
    }else if(type==='delete'){
        a += '<a href="javascript:void(0)" onClick="loading(); favorite(\'' + table + '\', ' + id + ', \'add\')">';
        a += '<i class="icon icon-content-save-all s-6 text-yellow-600" title="補習リスト追加" alt="補習リスト追加"></i>&nbsp;補習リスト追加</a>';
        message = '補習リストを解除しました。';
    }

    $("#favorite-" + table + '-' + id).html(a);
    infoNotify(message);
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });
}

function favorite(table, id, type) {
  axios.post('/favorite', {
    table: table,
    id: id,
    type: type
  })
  .then(function (response) {
    var result = response.data;
    $('#loading').hide();
    if(!ajaxCheckPublic(result)){return;}
    var a = '';
    if(type==='add'){
        a += '<a onClick="loading(); favorite(\'' + table + '\', ' + id + ', \'delete\')">';
        a += '<i class="icon icon-content-save-all s-6 text-red-600" title="補習リスト解除" alt="補習リスト解除"></i></a>';
    }else if(type==='delete'){
        a += '<a onClick="loading(); favorite(\'' + table + '\', ' + id + ', \'add\')">';
        a += '<i class="icon icon-content-save-all s-6 text-yellow-600" title="補習リスト追加" alt="補習リスト追加"></i></a>';
    }
    $("#favorite-" + table + '-' + id).html(a);
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });
}


function successNotify(message){
  new PNotify({
      text    : message,
      confirm : {
        confirm: true,
        buttons: [{text    : '☒',addClass: 'btn btn-link text-white-500',click   : function (notice){notice.remove();}},null]
      },
      buttons : {closer : false,sticker: false},animate : {animate  : true,in_class : 'slideInDown',out_class: 'slideOutUp'},
      addclass: 'success'
  });
};
function warningNotify(message){
  new PNotify({
      text    : message,
      confirm : {
          confirm: true,
          buttons: [{text    : '☒',addClass: 'btn btn-link text-white-500',click   : function (notice){notice.remove();}},null]
      },
      buttons : {closer : false,sticker: false},animate : {animate  : true,in_class : 'slideInDown',out_class: 'slideOutUp'},
      addclass: 'warning'
  });
}
function infoNotify(message){
  new PNotify({
      text    : message,
      confirm : {
          confirm: true,
          buttons: [{text    : '☒',addClass: 'btn btn-link text-white-500',click   : function (notice){notice.remove();}},null]
      },
      buttons : {closer : false,sticker: false},animate : {animate  : true,in_class : 'slideInDown',out_class: 'slideOutUp'},
      addclass: 'bg-blue-600 text-auto'
  });
}
function longNotify(message){
  new PNotify({
      text    : message,
      confirm : {
          confirm: true,
          buttons: [{text    : '☒',addClass: 'btn btn-link text-white-500',click   : function (notice){notice.remove();}},null]
      },
      buttons : {closer : false,sticker: false},animate : {animate  : true,in_class : 'slideInDown',out_class: 'slideOutUp'},
      addclass: 'bg-blue-600 text-auto longMessage',
      stack: {"dir1":"down", "dir2":"right", "push":"top"}
  });
}


function getNotAlreadyMessage(){
  //message
  axios.get('/getNotAlreadyMessage')
  .then(function (response) {
    var insert = '';
    if(isset(response.data.data)){
      $.each(response.data.data,function(index,message){
        insert += '<a class="dropdown-item" href="/account/messages?request_type=user&user_id='+message.target_user_id+'">';
        insert += '<div class="row no-gutters align-items-center flex-nowrap">';
        insert += '<i class="icon icon-email-open-outline"></i>';
        var updated_at = message.updated_at.replace( ' ', 'T' );
        updated_at += '+09:00';
        insert += '<span class="px-3">'+truncate(message.target_user_name,10)+'さんからメッセージ('+moment(updated_at).fromNow()+')</span>';
        insert += '</div>';
        insert += '</a>';
      });
      insert += '<a class="dropdown-item" href="/account/messages?request_type=receive">';
      insert += '<div class="row no-gutters align-items-center flex-nowrap">';
      insert += '<i class="icon icon-email-open-outline"></i>';
      insert += '<span class="px-3">その他'+response.data.total+'件の既読メッセージ</span>';
      insert += '</div>';
      insert += '</a>';
      $('#notAlreadyMessages').html(insert);
      $('#notAlreadyMessagesExists').addClass('text-orange-500');
    }else{
      insert += '<a class="dropdown-item" href="javascript:void(0)">';
      insert += '<div class="row no-gutters align-items-center flex-nowrap">';
      insert += '<i class="icon icon-email-open-outline"></i>';
      insert += '<span class="px-3">新しいメッセージはありません</span>';
      insert += '</div>';
      insert += '</a>';
      $('#notAlreadyMessages').html(insert);
      $('#notAlreadyMessagesExists').removeClass('text-orange-500');
    }
    $('#loading').hide();
  })
  .catch(function (error) {
    ajaxCheckError(error); return;
  });
}



$(document).ready(function () {

  getNotAlreadyMessage();
  setInterval('getNotAlreadyMessage()', 300000);

  if(window.innerWidth>900){
    $('.font-area').addClass('f24');
  }else if(window.innerWidth>750){
    $('.font-area').addClass('f20');
  }else{
    $('.font-area').addClass('f18');
  }

  //setTimeout(function(){
  setInterval(function(){
    $('.ui-pnotify').hide('slow', function(){ $('.ui-pnotify').remove(); });
  }, 3000);

  var right_recommend_count = true;
  $('#right-area-recommends').click(function(){
      if(!right_recommend_count) return;
      loading();
      right_recommend_count = false;
      axios.get('/account/recommend/right')
      .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}
        if(isset(response.data)){
          $('#rightRecommendPutArea').html(response.data);
          $('#loading').hide();
        }else{
          $('#rightRecommendPageMore').html('');
          $('#loading').hide();
        }
      })
      .catch(function (error) {
        ajaxCheckError(error); return;
      })
  });
  
  $('#right-area-recommends-update').click(function(){
      loading();
      right_recommend_count = false;
      axios.get('/account/recommend/right')
      .then(function (response) {
        if(!ajaxCheckPublic(response.data)){return;}
        if(isset(response.data)){
          $('#rightRecommendPutArea').html(response.data);
          $('#loading').hide();
        }else{
          $('#rightRecommendPageMore').html('');
          $('#loading').hide();
        }
      })
      .catch(function (error) {
        ajaxCheckError(error); return;
      })
  });
  
  var quick_panel_title = '';
  quick_panel_title += '<div class="list-group-item two-line">';
  quick_panel_title += '<div class="text-muted">';
  quick_panel_title += '<div class="h1"> 学習メモ<span id="rightRecommendNumber"></span></div>';
  quick_panel_title += '<div id="right-area-recommends-update"><p class="center"><a href="javascript:void(0)">更新</a></p></div>';
  quick_panel_title += '</div></div>';
  $('#quick-panel-title').html(quick_panel_title);

});



$(function(){
  $('a[href^="#"]').click(function(){
    var speed = 500;
    var href= $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top;
    position -= 60;
    $("html, body").animate({scrollTop:position}, speed, "swing");
    return false;
  });
});





</script>
