<?php
Route::group(['prefix' => 'account', 'namespace' => 'account', 'middleware' => ['auth','verified','AllPutData'] ] , function()
{

    Route::get('/', function () { return redirect()->to('/license/1/'); });

    Route::get('recommend', 'AccountController@getRecommend');
    Route::get('recommend/right', 'AccountController@getRecommendRight');
    Route::get('recommend/exists', 'AccountController@getRecommendExists');
    Route::get('recommend/edit', function () { return ['err'=>1,'message'=>'データはありません。']; });
    Route::post('recommend/edit', 'AccountController@postRecommendEdit');
    Route::get('recommend/ajaxGetRecommend', 'AccountController@ajaxGetRecommend');

    Route::post('recommend/delete/pic', 'AccountController@postRecommendDeletePic');
    Route::post('recommend/delete/recommend', 'AccountController@postRecommendDeleteRecommend');

    Route::get('messages', 'AccountController@getMessages');
    Route::get('messages/oneMessage', 'AccountController@getOneMessage');
    Route::get('messages/post', function () { return ['err'=>1,'message'=>'データはありません。']; });
    Route::post('messages/post', 'AccountController@postMessage');
    Route::post('messages/reply', 'AccountController@postMessageReply');
    Route::post('messages/already', 'AccountController@postMessageAlready');
    Route::post('messages/delete', 'AccountController@postMessageDelete');

    Route::post('support/contact', 'AccountController@postSupportContact');

    Route::group(['prefix' => 'learning'], function()
    {

        Route::get('/', 'AccountTryController@index');

        Route::get('/search', 'AccountTryController@getSerachLearning');

        Route::group(['prefix' => '{learning_id}', 'middleware' => ['CheckLearning']], function()
        {

            
        });
        
    });

    Route::group(['prefix' => 'try'], function () {

        Route::group(['prefix' => 'history'], function () {

            Route::get('/', 'AccountTryController@getTryHistory');

            Route::group(['prefix' => 'master/{try_master_id}', 'middleware' => ['CheckTryMasterExists']], function () {

                Route::get('score', 'AccountTryController@getTryHistoryScore');

                Route::group(['prefix' => 'license/{license_id}/question/{license_question_id}', 'middleware' => ['CheckLicenseQuestion']], function () {

                    Route::get('/', 'AccountTryController@getTryHistoryLicenseQuestion');
                    Route::post('/', 'AccountTryController@postTryHistoryLicenseQuestion');

                    Route::post('/learning/create', 'AccountTryController@postLicenseQuestionLearning');
                    Route::post('/learning/region', 'AccountTryController@postLicenseQuestionLearningRegion');

                });

            });
        
        });

        Route::group(['prefix' => 'choice'], function () {

            Route::get('license', 'AccountTryController@getTryChoiceLicense');

            Route::group(['prefix' => 'license/{license_id}', 'middleware' => ['CheckLicense']], function () {

                Route::get('desc', 'AccountTryController@getTryChoiceLicenseDesc');
                Route::post('desc', 'AccountTryController@postTryChoiceLicenseDesc');

            });
        
        });

        Route::group(['prefix' => 'master/{try_master_id}', 'middleware' => ['CheckTryMasterExists']], function () {

            Route::get('start', 'AccountTryController@getTryStart');
            Route::post('start', 'AccountTryController@postTryStart');

            Route::group(['prefix' => 'license/{license_id}/question/{license_question_id}', 'middleware' => ['CheckLicenseQuestion']], function () {

                Route::get('/', 'AccountTryController@getTryLicenseQuestion');
                Route::post('/', 'AccountTryController@postTryLicenseQuestion');

            });

            Route::get('done', 'AccountTryController@getTryDone');
            Route::post('done', 'AccountTryController@postTryDone');

        });

    });

    Route::get('favorite', 'AccountController@getFavorite');
    Route::post('favorite', function () { return ['err'=>1,'message'=>'データはありません。']; });

    Route::get('profile', 'AccountController@getProfile');
    Route::post('profile', function () { return ['err'=>1,'message'=>'データはありません。']; });

    Route::get('profile/edit', 'AccountController@getProfileEdit');
    Route::post('profile/edit', 'AccountController@postProfileEdit');

    Route::get('profile/recruit/edit', 'AccountController@getProfileRecruitEdit');
    Route::post('profile/recruit/edit', 'AccountController@postProfileRecruitEdit');

});
