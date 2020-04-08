<?php


Route::pattern('id', '[0-9]+');
Route::pattern('content_id', '[0-9]+');
Route::pattern('country_id', '[0-9]+');


# error
Route::get('/err404', 'CmnController@err404')->name('404');

# google auth
Route::get('/d4zmvxpq.htm', function () { return 'SVxr4RII61igknBrqMe7'; });

#common
Route::group(['prefix' => 'cmn', 'middleware' => ['AllPutData']], function()
{
    Route::get('terms', function () { return view('cmn.terms'); });
    Route::get('isms', function () { return view('cmn.isms'); });
    Route::get('privacy', function () { return view('cmn.privacy'); });
    Route::get('photo_credit', function () { return view('cmn.photo_credit'); });
    Route::get('browser', function () { return view('cmn.browser'); });
    Route::get('update', function () { return view('cmn.update'); });
    Route::get('buy', function () { return view('cmn.buy'); });
    Route::post('/contact', 'CmnController@contact');
});


#event
/*
Route::group(['prefix' => 'event'], function()
{
    Route::post('/113', 'CmnController@postEvent113');
});
*/







#ajax
Route::get('/get_country_areas', 'CmnController@ajaxGetCountryAreas');
Route::get('/get_country_area_ones', 'CmnController@ajaxGetCountryAreaOnes');
Route::get('/get_country_area_ones_custom', 'CmnController@ajaxGetCountryAreaOnesCustom');
Route::get('/get_country_area_twos_custom', 'CmnController@ajaxGetCountryAreaTwosCustom');
Route::get('/get_country_area_twos', 'CmnController@ajaxGetCountryAreaTwos');
Route::get('/get_company_type_second', 'CmnController@ajaxGetCompanyTypeSecond');

Route::get('/get_yoyaku_type', 'CmnController@ajaxGetYoyakuType');
Route::get('/get_yoyaku_type_tag', 'CmnController@ajaxGetYoyakuTypeTag');

Route::get('getNotAlreadyMessage', 'CmnController@getNotAlreadyMessage');

Route::get('/cmn/recommend/pics', 'CmnController@getRecommendPics');


Route::group([ 'middleware' => ['auth'] ] , function()
{
    Route::post('/favorite', 'CmnController@ajaxPostFavorite');
    Route::get('/nice', 'CmnController@ajaxGetNice');
    Route::post('/nice', 'CmnController@ajaxPostNice');
});


Route::get('/paypal/food/comfirm/done', 'PaypalController@foodYoyakuComfirmDone');
Route::get('/paypal/active/comfirm/done', 'PaypalController@foodYoyakuComfirmDone');
Route::get('/paypal/experience/comfirm/done', 'PaypalController@foodYoyakuComfirmDone');
Route::get('/paypal/lesson/comfirm/done', 'PaypalController@foodYoyakuComfirmDone');
Route::get('/paypal/spasalon/comfirm/done', 'PaypalController@foodYoyakuComfirmDone');
Route::get('/paypal/tour/comfirm/done', 'PaypalController@foodYoyakuComfirmDone');
Route::get('/paypal/ticket/comfirm/done', 'PaypalController@foodYoyakuComfirmDone');
Route::get('/paypal/hairsalon/comfirm/done', 'PaypalController@foodYoyakuComfirmDone');
Route::get('/paypal/stay/comfirm/done', 'PaypalController@foodYoyakuComfirmDone');
Route::get('/paypal/studio/comfirm/done', 'PaypalController@foodYoyakuComfirmDone');
Route::get('/paypal/kaigi/comfirm/done', 'PaypalController@foodYoyakuComfirmDone');
Route::get('/paypal/divination/comfirm/done', 'PaypalController@foodYoyakuComfirmDone');


