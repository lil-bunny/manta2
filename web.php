 function: index
  docstring: This function is responsible for displaying the main admin panel page, which includes links to various sections such as menus, areas, feedbacks, connect requests, downloads, campaigns, and settings.
  purpose: The purpose of this functionality is to provide a user-friendly interface for managing and updating various aspects of the software, including menus, areas, feedbacks, and campaigns. This helps the admin to efficiently perform their tasks and maintain the smooth functioning of the software.########## MENUS SECTIONS STARTS HERE #####################
    Route::get('/menus', 'MenuController@index')->name('admin.menu');
    Route::get('/menus/add', 'MenuController@add')->name('admin.menu_add');
    Route::post('/menus/create_menu', 'MenuController@create_menu')->name('admin.create_menu');
    Route::get('/menus/edit/{id}', 'MenuController@edit')->name('admin.menu_edit');
    Route::post('/menus/update_menu/{id}', 'MenuController@update_menu')->name('admin.update_menu');
    Route::post('/menus/menu_delete/{id}', 'MenuController@menu_delete')->name('admin.menu_delete');
    ########## MENUS SECTIONS ENDS HERE #####################

    ########## AREA SECTIONS STARTS HERE #####################
    Route::get('/areas', 'AreaController@index')->name('admin.area');
    Route::get('/areas/add', 'AreaController@add')->name('admin.area_add');
    Route::post('/areas/create_area', 'AreaController@create_area')->name('admin.create_area');
    Route::get('/areas/edit/{id}', 'AreaController@edit')->name('admin.area_edit');
    Route::post('/areas/update_area/{id}', 'AreaController@update_area')->name('admin.update_area');
    Route::post('/areas/area_delete/{id}', 'AreaController@area_delete')->name('admin.area_delete');
    Route::get('/campaign_generate', 'AreaController@campaign_generate_pdf')->name('admin.campaign_generate');
    Route::get('/areas/fetch_poi/{id}', 'AreaController@fetch_poi')->name('admin.fetch_poi');
    Route::post('/areas/add_poi', 'AreaController@add_poi')->name('admin.add_poi');
    Route::get('/areas/view_poi/{id}', 'AreaController@view_poi')->name('admin.view_poi');
    ########## AREA SECTIONS ENDS HERE #####################

    ########## FEEDBACKS SECTIONS STARTS HERE #####################
    Route::get('/feedbacks', 'FeedbackController@index')->name('admin.feedback');
    Route::get('/feedbacks/edit/{id}', 'FeedbackController@edit')->name('admin.feedback_edit');
    Route::post('/feedbacks/update_feedback/{id}', 'FeedbackController@update_feedback')->name('admin.update_feedback');
    Route::post('/feedbacks/feedback_delete/{id}', 'FeedbackController@feedback_delete')->name('admin.feedback_delete');
    ########## FEEDBACKS SECTIONS ENDS HERE #####################

    ########## CONNECT REQUESTS SECTIONS STARTS HERE #####################
    Route::get('/connect_requests', 'ConnectRequestController@index')->name('admin.connect_request');
    Route::get('/connect_requests/view/{id}', 'ConnectRequestController@view')->name('admin.connect_request_view');
    Route::post('/connect_requests/connect_request_delete/{id}', 'ConnectRequestController@connect_request_delete')->name('admin.connect_request_delete');
    ########## CONNECT REQUESTS SECTIONS ENDS HERE #####################

    ########## DOWNLOAD SECTIONS STARTS HERE #####################
    Route::get('/downloads', 'DownloadController@index')->name('admin.download');
    Route::get('/downloads/view/{id}', 'DownloadController@view')->name('admin.download_view');
    Route::post('/downloads/download_delete/{id}', 'DownloadController@download_delete')->name('admin.download_delete');
    ########## DOWNLOAD SECTIONS STARTS HERE #####################

    ########## CAMPAIGN SECTIONS STARTS HERE #####################
    Route::get('/campaign_search', 'CampaignController@index')->name('admin.campaign_search');
    Route::post('/review_campaign', 'CampaignController@review_campaign')->name('admin.review_campaign');
    ########## CAMPAIGN SECTIONS ENDS HERE #####################

    ########## SETTINGS SECTIONS STARTS HERE #####################
    Route::get('/settings', 'SettingController@index')->name('admin.setting');
    Route::post('/update_settings', 'SettingController@update_setting')->name('admin.update_setting');
    ########## SETTINGS SECTIONS STARTS HERE #####################
});
