<?php


Route::group(['prefix' => 'SenMonTen', 'namespace' => 'SenMonTen', 'middleware' => ['AllPutData']], function()
{

  Route::get('/', function () { return redirect()->to('/SenMonTen/占い'); });

  Route::group(array('prefix' => '{service_name}', 'middleware' => ['AllSenMonTenPutData']), function () {

    Route::group(['prefix' => 'cmn'], function()
    {
        Route::get('terms/owner', function () { return view('SenMonTen.cmn.terms_owner'); });
        Route::get('terms/customer', function () { return view('SenMonTen.cmn.terms_customer'); });
    });

    Route::get('/', 'SenMonTenController@index');
  
    Route::get('/map', 'SenMonTenController@index_map');
    Route::get('/map/json', 'SenMonTenController@ajaxMapContents_new');

    Route::get('sitemap', 'SenMonTenController@sitemap');
    Route::get('sitemap/desc', 'SenMonTenController@sitemap_desc');

    Route::get('/owner/register', 'SenMonTenController@getRegister');
    Route::post('/owner/register', 'SenMonTenController@postRegister');
  
    Route::group(array('prefix' => 'contents/{content_id}','middleware' => ['CheckContentExists']), function () {
  
      Route::get('desc', 'SenMonTenController@getContentDesc');
      Route::get('iframeCalendar', 'SenMonTenController@getIframeCalendar');
      Route::get('desc/entry', 'SenMonTenController@getContentDescEntry');
  
      Route::get('getStep', 'SenMonTenController@getStep');
      Route::get('getSteps', 'SenMonTenController@getSteps');
      Route::get('getDate', 'SenMonTenController@getDate');
      Route::get('getDateOne', 'SenMonTenController@getDateOne');
  
      Route::get('getMenu', 'SenMonTenController@getMenu');
      Route::get('getMenuStep', 'SenMonTenController@getMenuStep');
  
      Route::get('getMenus', 'SenMonTenController@getMenus');
      Route::get('getMenuSelect', 'SenMonTenController@getMenuSelect');
      Route::get('getMenusSelect', 'SenMonTenController@getMenusSelect');
      Route::get('getMenusSelectStay', function () { return ['err'=>1,'message'=>'データはありません。']; });
      Route::post('getMenusSelectStay', 'SenMonTenController@getMenusSelectStay');
  
      Route::get('getCapacity', 'SenMonTenController@getCapacity');
      Route::get('getDateCapacities', 'SenMonTenController@getDateCapacities');
      Route::get('getCapacities', 'SenMonTenController@getCapacities');
      
      Route::get('getDateUsers', 'SenMonTenController@getDateUsers');
      Route::get('getMedias', 'SenMonTenController@getMedias');
      
      //service 2,10,11 only
      Route::get('getUseTimes', 'SenMonTenController@getUseTimes');
  
      Route::group(array('prefix' => 'menu/{menu_id}','middleware' => ['CheckContentMenuExists']), function () {
  
        Route::get('desc', 'SenMonTenController@getContentMenuDesc');
        Route::get('getDateMenu', 'SenMonTenController@getDateMenu');
      });

    });

  });
  
});


