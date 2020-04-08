<?php

Route::group(['prefix' => 'yoyaku', 'namespace' => 'yoyaku', 'middleware' => ['AllPutData']], function()
{

  Route::get('/', 'YoyakuController@getIntroduceOwner');

  Route::get('/register', 'YoyakuController@getRegister');

  Route::get('request/edit/content', 'YoyakuController@getRequestEditContent');
  Route::post('request/edit/content', 'YoyakuController@postRequestEditContent');

  Route::group(['prefix' => 'cmn'], function()
  {
      Route::get('terms/owner', function () { return view('yoyaku.cmn.terms_owner'); });
      Route::get('terms/customer', function () { return view('yoyaku.cmn.terms_customer'); });
  });

  Route::group(['prefix' => 'introduce'], function()
  {
  
      Route::get('/', function () { return view('yoyaku.introduce.yoyaku'); })->name('yoyaku');
  
      Route::group(['prefix' => 'owner'], function()
      {
  
          Route::get('/', 'YoyakuController@getIntroduceOwner');
  
          Route::get('/food', 'YoyakuController@getIntroduceOwnerFood');
          Route::get('/active', 'YoyakuController@getIntroduceOwnerActive');
          Route::get('/experience', 'YoyakuController@getIntroduceOwnerExperience');
          Route::get('/lesson', 'YoyakuController@getIntroduceOwnerLesson');
          Route::get('/spasalon', 'YoyakuController@getIntroduceOwnerSpasalon');
          Route::get('/tour', 'YoyakuController@getIntroduceOwnerTour');
          Route::get('/ticket', 'YoyakuController@getIntroduceOwnerTicket');
          Route::get('/hairsalon', 'YoyakuController@getIntroduceOwnerHairsalon');
          Route::get('/stay', 'YoyakuController@getIntroduceOwnerStay');
          Route::get('/studio', 'YoyakuController@getIntroduceOwnerStudio');
          Route::get('/kaigi', 'YoyakuController@getIntroduceOwnerKaigi');
          Route::get('/recruit', 'YoyakuController@getIntroduceOwnerRecruit');
          Route::get('/divination', 'YoyakuController@getIntroduceOwnerDivination');
      
      });
  
  });


});


