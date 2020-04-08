<?php

Route::group(['prefix' => 'license', 'namespace' => 'license', 'middleware' => ['AllPutData']], function()
{

  Route::group(['prefix' => 'try'], function () {

      Route::get('question', 'LicenseController@getTryChoiceLicense');
  
  });

  Route::get('/', 'LicenseController@index');

  Route::get('/search_learning', 'LicenseController@getSerachLearning');

  Route::group(['prefix' => 'regi', 'middleware' => ['auth','verified']], function()
  {
    Route::get('getSubPartsWiki', 'LicenseController@getSubPartsWiki');
    Route::post('postSubPartsWiki', 'LicenseController@postSubPartsWiki');
    Route::get('getSubPartsLiterature', 'LicenseController@getSubPartsLiterature');
    Route::post('postSubPartsLiterature', 'LicenseController@postSubPartsLiterature');
    Route::get('getSubPartsSummary', 'LicenseController@getSubPartsSummary');
    Route::post('postSubPartsSummary', 'LicenseController@postSubPartsSummary');
    Route::get('getSubPartsMemo', 'LicenseController@getSubPartsMemo');
    Route::post('postSubPartsMemo', 'LicenseController@postSubPartsMemo');

    Route::get('getSubPartsView', 'LicenseController@getSubPartsView');
    Route::post('postSubPartsView', 'LicenseController@postSubPartsView');
    
    Route::get('getDescPartLearning', 'LicenseController@getDescPartLearning');
    Route::post('postDescPartLearning', 'LicenseController@postDescPartLearning');
  });

  Route::group(['prefix' => '{license_id}', 'middleware' => ['CheckLicense']], function()
  {

    Route::get('/', 'LicenseController@redirect');
    Route::get('top', 'LicenseController@top');
    Route::get('getLicenseStudyMap', 'LicenseController@getLicenseStudyMap');
    Route::get('getLicensestudyArea', 'LicenseController@getLicensestudyArea');
    Route::get('getLicenseMustReadList', 'LicenseController@getLicenseMustReadList');
    Route::get('getLicenseHotWords', 'LicenseController@getLicenseHotWords');
    Route::get('getLicenseStatistics', 'LicenseController@getLicenseStatistics');
    Route::get('getLicenseData', 'LicenseController@getLicenseData');
    Route::get('getLicenseSchedule', 'LicenseController@getLicenseSchedule');
    Route::get('getLicenseTest', 'LicenseController@getLicenseTest');

    Route::group(['prefix' => 'question/{license_question_id}', 'middleware' => ['CheckLicenseQuestion']], function()
    {
      Route::get('/', 'LicenseController@getLicenseQuestion');

      Route::get('/learning', 'LicenseController@getLicenseQuestionLearning');
      Route::post('/learning', 'LicenseController@postLicenseQuestionLearning')->middleware('auth','verified');

      Route::get('/learning/delete', 'LicenseController@getLicenseQuestionLearningDelete');
      Route::post('/learning/delete', 'LicenseController@postLicenseQuestionLearningDelete')->middleware('auth','verified');

      Route::group(['prefix' => 'regi', 'middleware' => ['auth','verified']], function()
      {
        Route::get('getLicenseQuestionCommentary', 'LicenseController@getLicenseQuestionCommentary');
        Route::post('postLicenseQuestionCommentary', 'LicenseController@postLicenseQuestionCommentary');
        Route::get('getLicenseQuestionLogic', 'LicenseController@getLicenseQuestionLogic');
        Route::post('postLicenseQuestionLogic', 'LicenseController@postLicenseQuestionLogic');
      });
      
    });

  });
  
});


