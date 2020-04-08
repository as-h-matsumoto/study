<?php
Route::group(['prefix' => 'manager', 'namespace' => 'manager', 'middleware' => ['auth','verified','CheckManager','AllPutData']], function()
{

    Route::get('/', 'ManagerController@dashboard');

    Route::get('/createImage400', 'ManagerController@createImage400');
    
    Route::get('/createImage400', 'ManagerController@createImage400');

    //
    //ManagerEditContentController
    //
    //Route::get('/station/import', 'ManagerEditContentController@getImportStations');
    //Route::post('/station/import', 'ManagerEditContentController@postImportStations');
    Route::get('/station/list', 'ManagerEditContentController@getStationList');
    Route::get('/station/distance', 'ManagerEditContentController@getStationsDistance');
    //Route::get('/station_line/import', 'ManagerEditContentController@getImportStationLine');
    //Route::post('/station_line/import', 'ManagerEditContentController@postImportStationLine');
    Route::get('/station_line/list', 'ManagerEditContentController@getStationLineList');
    //Route::get('/getAddressOther', 'ManagerEditContentController@getAddressOther');
    //Route::get('/getAddressOtherPut', 'ManagerEditContentController@getAddressOtherPut');
    Route::get('/latlon', 'ManagerEditContentController@getLatlon');
    Route::get('/latlon/function', 'ManagerEditContentController@postLatlon');
    Route::get('/latlon/function/reverce', 'ManagerEditContentController@postLatlonReverce');

    Route::get('/contents/new/check', 'ManagerEditContentController@getCheckContentNew');
    Route::post('/contents/new/check', 'ManagerEditContentController@postCheckContentNew');

    Route::get('/contents/edit/postOpenClose', 'ManagerEditContentController@getOpenClose');
    Route::post('/contents/edit/postOpenClose', 'ManagerEditContentController@postOpenClose');

    Route::get('/contents/menu/check', 'ManagerEditContentController@getCheckContentMenu');
    Route::post('/contents/menu/check', 'ManagerEditContentController@postCheckContentMenu');

    Route::get('/contents/shopDown', 'ManagerEditContentController@getShopDown');
    Route::post('/contents/shopDown', 'ManagerEditContentController@postShopDown');


    
    //
    //ManagerLicenseController
    //
    Route::get('/license/check', 'ManagerLicenseController@getLicenseQuestionContentsAnswerAndPoint');
    Route::post('/license/check', 'ManagerLicenseController@postLicenseQuestionContentsAnswerAndPoint');

    Route::get('/license/change/contents/points', 'ManagerLicenseController@getChangeLicenseQuestionContentsPoint');
    Route::post('/license/change/contents/points', 'ManagerLicenseController@postChangeLicenseQuestionContentsPoint');

    Route::get('/license/getDescParts', 'ManagerLicenseController@getDescParts');
    Route::post('/license/postDescParts', 'ManagerLicenseController@postDescParts');
    
    Route::get('/license/testLicense', 'ManagerLicenseController@testLicense');

    Route::get('/license/updateWikiUrlDescParts', 'ManagerLicenseController@updateWikiUrlDescParts');
    


    //
    //ManagerItownController
    //
    Route::get('/itown', 'ManagerItownController@getItown');
    //Route::get('/itown_value', 'ManagerItownController@getItownValue');
    //Route::get('/itown_check_same', 'ManagerItownController@getItownCheckSame');
    //Route::get('/itown_check_beautysalon', 'ManagerItownController@getItownCheckBeautysalon');
    //Route::get('/itown_check_bokujo', 'ManagerItownController@getItownCheckBokujo');
    //Route::get('/itown_check_fax', 'ManagerItownController@getItownCheckFax');
    //Route::get('/itown_check_simple', 'ManagerItownController@getItownCheckSimple');
    //Route::get('/itown_check_tellspace', 'ManagerItownController@getItownCheckTellSpace');
    //
    Route::get('/itown_to_contents', 'ManagerItownController@getItownToContents');
    //Route::post('/itown_delete', 'ManagerItownController@postItownDelete');
    Route::post('/itown_edit', 'ManagerItownController@postItownEdit');
    Route::get('/itown_get_alldata_form_address', 'ManagerItownController@getAlldataformAddress');
    Route::get('/itown_get_service', 'ManagerItownController@getServiceFormBussinessType');
    
    
    





    //
    //ManagerController
    //
    //Route::get('/gengo/year/add', 'ManagerController@getGengoYearAdd');
    //Route::get('/gengo/master/add', 'ManagerController@getGengoMasterAdd');
    Route::get('/request/edit/content', 'ManagerController@getRequestEditContent');

    Route::get('/create/sitemap', 'ManagerController@createSitemap');
    Route::get('/create/sitemap/yoyaku', 'ManagerController@createYoyakuSitemap2');
    Route::get('/create/sitemap/yoyakug', 'ManagerController@createYoyakuSitemap2g');
    
    Route::get('/create/sitemap/coord', 'ManagerController@createCoordSitemap');

    


    Route::get('/owner/request', 'ManagerController@getRequestOwner');
    Route::post('/owner/request', 'ManagerController@postRequestOwner');

    Route::get('/owner/pay', 'ManagerController@getPayOwner');
    Route::post('/owner/pay', 'ManagerController@postPayOwner');

    Route::get('/owner/import', 'ManagerController@getImportOwner');
    Route::post('/owner/import', 'ManagerController@postImportOwner');

    Route::get('/owner/import/list', 'ManagerController@getImportOwnerList');
    Route::post('/owner/import/list', 'ManagerController@postImportOwnerList');



    Route::get('/recommends/check', 'ManagerController@getCheckRecommends');
    Route::post('/recommends/check', 'ManagerController@postCheckRecommends');

    Route::get('/delete/content', 'ManagerController@getDeleteTrushOfContent');
    Route::post('/delete/content', 'ManagerController@postDeleteTrushOfContent');

    Route::get('/owner/createContentsSellMonth', 'ManagerController@getCreateContentsSellMonth');
    Route::post('/owner/createContentsSellMonth', 'ManagerController@postCreateContentsSellMonth');

    Route::get('/ajaxGetSellWeek', 'OwnerController@ajaxGetSellWeek');
    Route::get('/ajaxGetSellMonth', 'OwnerController@ajaxGetSellMonth');

    Route::get('/ajaxGetSellNumberWeek', 'OwnerController@ajaxGetSellNumberWeek');
    Route::get('/ajaxGetSellNumberMonth', 'OwnerController@ajaxGetSellNumberMonth');

    Route::get('/ajaxGetCustomerWeek', 'OwnerController@ajaxGetCustomerWeek');
    Route::get('/ajaxGetCustomerMonth', 'OwnerController@ajaxGetCustomerMonth');

    
});