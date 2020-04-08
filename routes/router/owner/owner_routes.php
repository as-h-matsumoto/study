<?php
Route::group(['prefix' => 'owner', 'namespace' => 'owner', 'middleware' => ['auth','verified','AllPutData','CheckLoginOwner']], function()
{
    
    Route::group(['prefix' => 'cmn'], function()
    {
        Route::get('terms/owner', function () { return view('owner.cmn.terms_owner'); });
        Route::get('terms/customer', function () { return view('owner.cmn.terms_customer'); });
    });

    Route::get('/company_type_first', 'OwnerController@ajaxGetCompanyTypeFirst');
    Route::get('/company_type_second', 'OwnerController@ajaxGetCompanyTypeSecond');

    Route::group([ 'middleware' => ['CheckOwnerDone'] ], function ()
    {
        Route::get('/register', 'OwnerController@getRegister');
        Route::post('/register', 'OwnerController@postRegister');
        Route::get('/register/done', function () { return view('owner.profile.register_done'); });
    });

    Route::group([ 'middleware' => ['CheckOwner'] ], function ()
    {

        Route::group(['prefix' => 'learning', 'namespace' => 'learning'], function()
        {

            Route::get('/', 'OwnerLearningController@index');

            Route::get('/search', 'OwnerLearningController@getSerachLearning');

            Route::group(['prefix' => '{learning_id}', 'middleware' => ['CheckLearning']], function()
            {

                
            });
            
        });


        Route::group(['prefix' => 'license', 'namespace' => 'license'], function()
        {

            Route::get('/', 'OwnerLicenseController@index');
            Route::get('/question', 'OwnerLicenseController@question');

            Route::group(['prefix' => '{license_id}', 'middleware' => ['CheckLicense']], function()
            {

                Route::group(['prefix' => 'question', 'namespace' => 'question'], function()
                {

                    Route::group(['prefix' => 'theme'], function()
                    {

                        Route::get('/create', 'OwnerLicenseQuestionController@getCreateLicenseQuestionTheme');
                        Route::post('/create', 'OwnerLicenseQuestionController@postCreateLicenseQuestionTheme');
                        
                        Route::group(['prefix' => '{license_question_theme_id}', 'middleware' => ['CheckLicenseQuestionTheme']], function () {
    
                            Route::get('/createedit', 'OwnerLicenseQuestionController@getCreateEditLicenseQuestionTheme');
                            Route::post('/createedit', 'OwnerLicenseQuestionController@postCreateEditLicenseQuestionTheme');

                        });

                    });
    
                    Route::get('/', 'OwnerLicenseQuestionController@indexLicenseQuestion');
        
                    Route::get('/create', 'OwnerLicenseQuestionController@getCreateLicenseQuestion');
                    Route::post('/create', 'OwnerLicenseQuestionController@postCreateLicenseQuestion');
            
                    Route::group(['prefix' => '{license_question_id}', 'middleware' => ['CheckLicenseQuestionOwner']], function () {
        
                        Route::get('/show', 'OwnerLicenseQuestionController@showLicenseQuestion');

                        Route::get('/createedit', 'OwnerLicenseQuestionController@getCreateEditLicenseQuestion');
                        Route::post('/createedit', 'OwnerLicenseQuestionController@postCreateEditLicenseQuestion');
        
                        Route::get('/edit', 'OwnerLicenseQuestionController@getEditLicenseQuestion');
                        Route::post('/edit', 'OwnerLicenseQuestionController@postEditLicenseQuestion');
                        
                        Route::post('/openClose', 'OwnerLicenseQuestionController@openCloseLicenseQuestion');
                        Route::post('/delete', 'OwnerLicenseQuestionController@deleteLicenseQuestion');
                        
                        Route::group(['prefix' => 'contents', 'namespace' => 'contents'], function()
                        {
            
                            Route::get('/', 'OwnerLicenseQuestionContentsController@indexLicenseQuestionContents');
                
                            Route::get('/create', 'OwnerLicenseQuestionContentsController@getCreateLicenseQuestionContents');
                            Route::post('/create', 'OwnerLicenseQuestionContentsController@postCreateLicenseQuestionContents');
                    
                            Route::group(['prefix' => '{license_question_contents_id}'], function () {
                
                                Route::get('/show', 'OwnerLicenseQuestionContentsController@showLicenseQuestionContents');
        
                                Route::get('/createedit', 'OwnerLicenseQuestionContentsController@getCreateEditLicenseQuestionContents');
                                Route::post('/createedit', 'OwnerLicenseQuestionContentsController@postCreateEditLicenseQuestionContents');
                
                                Route::get('/edit', 'OwnerLicenseQuestionContentsController@getEditLicenseQuestionContents');
                                Route::post('/edit', 'OwnerLicenseQuestionContentsController@postEditLicenseQuestionContents');
                    
                            });
                
                        });
            
                    });
        
                });
                
            });
            
        });

        Route::get('/', 'OwnerController@index')->middleware('CheckOwnerSuperReturnRedirect');

        Route::group([ 'middleware' => ['CheckOwnerSuperReturnAjax'] ], function ()
        {
            Route::get('/ajaxGetSellWeek', 'OwnerController@ajaxGetSellWeek');
            Route::get('/ajaxGetSellMonth', 'OwnerController@ajaxGetSellMonth');
    
            Route::get('/ajaxGetSellNumberWeek', 'OwnerController@ajaxGetSellNumberWeek');
            Route::get('/ajaxGetSellNumberMonth', 'OwnerController@ajaxGetSellNumberMonth');
    
            Route::get('/ajaxGetCustomerWeek', 'OwnerController@ajaxGetCustomerWeek');
            Route::get('/ajaxGetCustomerMonth', 'OwnerController@ajaxGetCustomerMonth');

        });

        Route::get('/customer', 'OwnerController@getCustomerIndex');
        Route::post('/customer', 'OwnerController@postCustomer');
        Route::get('/customer/get', 'OwnerController@getCustomerData');
        
        Route::get('/pay', 'OwnerController@getPay');
        Route::post('/pay', 'OwnerController@postPay');

        Route::get('/profile', 'OwnerController@getProfile');
        Route::get('/profile/edit', 'OwnerController@getProfileEdit');
        Route::post('/profile/edit', 'OwnerController@postProfileEdit');

        Route::get('/api', 'OwnerController@getApi');

        Route::get('/calendar', 'OwnerController@getCalendar');
        Route::get('/calendar/edit', 'OwnerController@getCalendarEdit');
        Route::post('/calendar/edit', 'OwnerController@postCalendarEdit');

        Route::get('/bank', 'OwnerController@getBank');
        Route::get('/bank/edit', 'OwnerController@getBankEdit');
        Route::post('/bank/edit', 'OwnerController@postBankEdit');

        Route::get('/support', 'OwnerController@getSupport');
        Route::post('/support/buy', 'OwnerController@postSupportBuy');
        Route::post('/support/contact', 'OwnerController@postSupportContact');

        Route::group(['prefix' => 'contents'], function ()
        {
    
            Route::get('/', 'OwnerContentsController@index');
            //作成したコンテンツ一覧(検索付き(service, update, order))＋詳細ボタンと申込一覧ボタンをつける
    
            Route::get('/create/first', 'OwnerContentsController@getCreateFirst');//contents.serviceをプルタウンで選ばせる
            Route::get('/create/second', 'OwnerContentsController@getCreateSecond');
            Route::post('/create/second', 'OwnerContentsController@postCreateSecond');
            //redirect to contents/{id}/show
    
            Route::group(['prefix' => '{id}', 'middleware' => ['CheckContentOwner']], function () {

                Route::get('/top', 'OwnerContentsController@getTop');

                Route::get('/openClose', 'OwnerContentsController@getOpenClose');
                Route::post('/openClose', 'OwnerContentsController@openClose');

                Route::get('/getDayDates', 'OwnerContentsController@getDayDates');
                Route::get('/getDateUsers', 'OwnerContentsController@getDateUsers');

                //Route::get('/getDateYoyakuMenus', 'OwnerContentsController@getDateYoyakuMenus');
                //Route::get('/getDateYoyakuUsers', 'OwnerContentsController@getDateYoyakuUsers');
                
                Route::group(['prefix' => 'delete'], function ()
                {
                    Route::post('/', 'OwnerContentsController@deleteContent');
                });

                Route::group(['prefix' => 'golist', 'middleware' => ['CheckPermitGolistEdit']], function ()
                {

                    Route::get('/edit', 'OwnerContentsGolistController@getGolistEdit');
                    Route::post('/edit', 'OwnerContentsGolistController@postGolistEdit');
                    
                });

                Route::group(['prefix' => 'capacity'], function ()
                {

                    Route::post('/delete', 'OwnerContentsCapacityController@postCapacityDelete');

                    Route::group(['prefix' => 'edit'], function ()
                    {

                        Route::get('/', 'OwnerContentsCapacityController@getCapacityEdit');
    
                        Route::get('/placeOwner', 'OwnerContentsCapacityController@getPlaceOwner');
                        Route::post('/placeOwner', 'OwnerContentsCapacityController@postPlaceOwner');

                        Route::post('/postElementNumber', 'OwnerContentsCapacityController@postElementNumber');
                        Route::post('/postAddCapacityToDate', 'OwnerContentsCapacityController@postAddCapacityToDate');
                        
                        Route::post('/food/new', 'OwnerContentsCapacityFoodController@postCapacityNew');
                        Route::post('/food/edit', 'OwnerContentsCapacityFoodController@postCapacityEdit');

                        Route::post('/active/new', 'OwnerContentsCapacityActiveController@postCapacityNew');
                        Route::post('/active/edit', 'OwnerContentsCapacityActiveController@postCapacityEdit');

                        Route::post('/lesson/new', 'OwnerContentsCapacityLessonController@postCapacityNew');
                        Route::post('/lesson/edit', 'OwnerContentsCapacityLessonController@postCapacityEdit');

                        Route::post('/spasalon/new', 'OwnerContentsCapacitySpasalonController@postCapacityNew');
                        Route::post('/spasalon/edit', 'OwnerContentsCapacitySpasalonController@postCapacityEdit');

                        Route::post('/hairsalon/new', 'OwnerContentsCapacityHairsalonController@postCapacityNew');
                        Route::post('/hairsalon/edit', 'OwnerContentsCapacityHairsalonController@postCapacityEdit');

                        Route::post('/stay/new', 'OwnerContentsCapacityStayController@postCapacityNew');
                        Route::post('/stay/edit', 'OwnerContentsCapacityStayController@postCapacityEdit');

                        Route::post('/studio/new', 'OwnerContentsCapacityStudioController@postCapacityNew');
                        Route::post('/studio/edit', 'OwnerContentsCapacityStudioController@postCapacityEdit');

                        Route::post('/kaigi/new', 'OwnerContentsCapacityKaigiController@postCapacityNew');
                        Route::post('/kaigi/edit', 'OwnerContentsCapacityKaigiController@postCapacityEdit');
                        
                        Route::post('/recruit/new', 'OwnerContentsCapacityRecruitController@postCapacityNew');
                        Route::post('/recruit/edit', 'OwnerContentsCapacityRecruitController@postCapacityEdit');

                        Route::post('/divination/new', 'OwnerContentsCapacityDivinationController@postCapacityNew');
                        Route::post('/divination/edit', 'OwnerContentsCapacityDivinationController@postCapacityEdit');

                        Route::post('/uranai/new', 'OwnerContentsCapacityDivinationController@postCapacityNew');
                        Route::post('/uranai/edit', 'OwnerContentsCapacityDivinationController@postCapacityEdit');


                    });

                });

                Route::group(['prefix' => 'menu'], function ()
                {
                    
                    Route::get('/existMenuToDate', 'OwnerContentsMenuController@existMenuToDate');
                    Route::post('/postAddMenuToDate', 'OwnerContentsMenuController@postAddMenuToDate');
                    Route::post('/delete', 'OwnerContentsMenuController@deleteMenu');

                    Route::post('/step/new', 'OwnerContentsMenuController@postMenuStepNew');
                    Route::post('/step/edit', 'OwnerContentsMenuController@postMenuStepEdit');
                    Route::post('/step/delete', 'OwnerContentsMenuController@deleteMenuStep');

                    Route::group(['prefix' => 'edit'], function ()
                    {

                        Route::get('/', 'OwnerContentsMenuController@getMenuEdit');

                        Route::post('/postElementNumber', 'OwnerContentsMenuController@postElementNumber');

                        Route::post('/food/new', 'OwnerContentsMenuFoodController@postMenuNew');
                        Route::post('/food/edit', 'OwnerContentsMenuFoodController@postMenuEdit');

                        Route::post('/tour/new', 'OwnerContentsMenuTourController@postMenuNew');
                        Route::post('/tour/edit', 'OwnerContentsMenuTourController@postMenuEdit');

                        Route::post('/stay/new', 'OwnerContentsMenuStayController@postMenuNew');
                        Route::post('/stay/edit', 'OwnerContentsMenuStayController@postMenuEdit');

                        Route::post('/ticket/new', 'OwnerContentsMenuTicketController@postMenuNew');
                        Route::post('/ticket/edit', 'OwnerContentsMenuTicketController@postMenuEdit');

                        Route::post('/studio/new', 'OwnerContentsMenuStudioController@postMenuNew');
                        Route::post('/studio/edit', 'OwnerContentsMenuStudioController@postMenuEdit');
                        
                        Route::post('/kaigi/new', 'OwnerContentsMenuKaigiController@postMenuNew');
                        Route::post('/kaigi/edit', 'OwnerContentsMenuKaigiController@postMenuEdit');

                        Route::post('/hairsalon/new', 'OwnerContentsMenuHairsalonController@postMenuNew');
                        Route::post('/hairsalon/edit', 'OwnerContentsMenuHairsalonController@postMenuEdit');

                        Route::post('/spasalon/new', 'OwnerContentsMenuSpasalonController@postMenuNew');
                        Route::post('/spasalon/edit', 'OwnerContentsMenuSpasalonController@postMenuEdit');

                        Route::post('/lesson/new', 'OwnerContentsMenuLessonController@postMenuNew');
                        Route::post('/lesson/edit', 'OwnerContentsMenuLessonController@postMenuEdit');
                        
                        Route::post('/recruit', 'OwnerContentsMenuRecruitController@postMenu');
                        Route::get('/recruit/getExampleEmail', 'OwnerContentsMenuRecruitController@getExampleEmail');
                        Route::post('/recruit', 'OwnerContentsMenuRecruitController@postMenu');
                        Route::post('/recruit', 'OwnerContentsMenuRecruitController@postMenu');

                        Route::post('/divination/new', 'OwnerContentsMenuDivinationController@postMenuNew');
                        Route::post('/divination/edit', 'OwnerContentsMenuDivinationController@postMenuEdit');
                    
                    });

                });

                Route::group(['prefix' => 'desc'], function () {
    
                    Route::get('/edit', 'OwnerContentsDescController@getDescEdit');
                    Route::post('/edit', 'OwnerContentsDescController@postDescEdit');

                    Route::get('/descExample', 'OwnerContentsDescController@descExample');

                    Route::post('/step/new', 'OwnerContentsDescController@postStepNew');
                    Route::post('/step/edit', 'OwnerContentsDescController@postStepEdit');
                    Route::post('/step/delete', 'OwnerContentsDescController@deleteStep');

                });

                Route::group(['prefix' => 'discount'], function () {
    
                    Route::get('/edit', 'OwnerContentsDiscountController@getDiscountEdit');
                    Route::post('/edit', 'OwnerContentsDiscountController@postDiscountEdit');

                });

                Route::group(['prefix' => 'cancel'], function () {
    
                    Route::get('/edit', 'OwnerContentsCancelController@getCancelEdit');
                    Route::post('/edit', 'OwnerContentsCancelController@postCancelEdit');

                });

                Route::group(['prefix' => 'calendar'], function ()
                {

                    Route::get('/edit', 'OwnerContentsCalendarController@getCalendarEdit');
                    Route::post('/edit', 'OwnerContentsCalendarController@postCalendarEdit');
                    Route::get('/eventshow', 'OwnerContentsCalendarController@index');
                    Route::post('/addevent', 'OwnerContentsCalendarController@addEvent');
                    Route::post('/editevent', 'OwnerContentsCalendarController@editEvent');
                    Route::post('/dragevent', 'OwnerContentsCalendarController@dragEvent');
                    Route::post('/deleteevent', 'OwnerContentsCalendarController@deleteEvent');
                    Route::post('/deleterepeatevent', 'OwnerContentsCalendarController@deleteRepeatEvent');
                    Route::post('/repeat', 'OwnerContentsCalendarController@getRepeat');
                    Route::post('/calculateondate', 'OwnerContentsCalendarController@calculateOnDate');
                    Route::post('/calculatesummary', 'OwnerContentsCalendarController@calculateSummary');

                });
    
                Route::group(['prefix' => 'date'], function () {
                
                    Route::get('/getDateEdit', 'OwnerContentsDateController@getDateEdit');
                    Route::get('/getDateYoyaku', 'OwnerContentsDateController@getDateYoyaku');
                    Route::get('/getDateYoyakuExists', 'OwnerContentsDateController@getDateYoyakuExists');
                    
                    Route::get('/getContentMenus', 'OwnerContentsDateController@getContentMenus');
                    Route::get('/getYoyakuActiveUsers', 'OwnerContentsDateController@getYoyakuActiveUsers');
                    

                    Route::post('/addevent', 'OwnerContentsDateController@addEvent');
                    Route::post('/dragevent', 'OwnerContentsDateController@dragEvent');
                    Route::post('/deleteevent', 'OwnerContentsDateController@deleteEvent');

                    Route::group(['prefix' => 'edit'], function ()

                    {
                        Route::get('/', 'OwnerContentsDateController@getEdit');

                        Route::post('/resizeDate', 'OwnerContentsDateController@postResizeDate');
                        
                        Route::post('/oneDate', 'OwnerContentsDateController@postOneDate');
                        Route::post('/oneDate/delete', 'OwnerContentsDateController@postOneDateDelete');
                        Route::post('/oneDate/relation/delete', 'OwnerContentsDateController@postOneRelationDateDelete');

                        Route::post('/firstDate', 'OwnerContentsDateController@postFirstDate');
                        Route::post('/createEvent', 'OwnerContentsDateController@createEvent');

                    });

                    Route::group(['prefix' => 'yoyaku'], function ()
                    {

                        Route::get('/', 'OwnerContentsDateController@getYoyaku');      
                        Route::post('/message', 'OwnerContentsDateController@postMessage');
                        Route::post('/cancel', 'OwnerContentsDateController@postYoyakuCancel');
                        Route::post('/onOff', 'OwnerContentsDateController@postOnOff');

                    });

                    Route::group(['prefix' => 'adduser'], function ()
                    {

                        Route::get('/', 'OwnerContentsDateController@getAdduser');
                        Route::get('/search', 'OwnerContentsDateController@getAdduserSearch');
                        Route::get('/getOwnersUser', 'OwnerContentsDateController@getOwnersUser');

                    });

                });

                Route::group(['prefix' => 'sell', ], function () {

                    Route::get('/', 'OwnerContentsSellController@index')->middleware('CheckOwnerSuperReturnRedirect');
                    Route::get('/sell', 'OwnerContentsSellController@getSell')->middleware('CheckOwnerSuperReturnRedirect');

                    Route::group([ 'middleware' => ['CheckOwnerSuperReturnAjax'] ], function ()
                    {
                        Route::get('/ajaxGetSellWeek', 'OwnerContentsSellController@ajaxGetSellWeek');
                        Route::get('/ajaxGetSellMonth', 'OwnerContentsSellController@ajaxGetSellMonth');
    
                        Route::get('/ajaxGetSellNumberWeek', 'OwnerContentsSellController@ajaxGetSellNumberWeek');
                        Route::get('/ajaxGetSellNumberMonth', 'OwnerContentsSellController@ajaxGetSellNumberMonth');
    
                        Route::get('/ajaxGetCustomerWeek', 'OwnerContentsSellController@ajaxGetCustomerWeek');
                        Route::get('/ajaxGetCustomerMonth', 'OwnerContentsSellController@ajaxGetCustomerMonth');
                    });

                });

                Route::group(['prefix' => 'recruit', ], function () {

                    Route::get('/', 'OwnerContentsRecruitController@index');
                    Route::get('/changeStatus', 'OwnerContentsRecruitController@getChangeStatus');
                    Route::post('/changeStatus', 'OwnerContentsRecruitController@postChangeStatus');

                });
    
            });

        });
    });  
});
