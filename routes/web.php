<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/******* Auth *******/
Route::group([
    'middleware' => 'web',
    'namespace' => 'Admin',
], function () {
    Route::any('/', 'AuthController@login');
    Route::any('/login', 'AuthController@login')->name('login.show');
    Route::get('/register', 'AuthController@showRegister');
    Route::get('/confirm', 'AuthController@confirmEmail');
    Route::get('/confirm-email', 'AuthController@showSendConfirm');
    Route::post('/send-confirm', 'AuthController@sendHashConfirm');
    Route::get('/reset-password', 'AuthController@showResetPassword');
    Route::post('/reset-password', 'AuthController@resetPassword');
    Route::post('/register', 'AuthController@register');
    Route::get('/logout', 'AuthController@logout');
});

/******* Admin page *******/
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => 'web'
], function () {

    Route::get('index', 'IndexController@index');

    Route::get('world/{packet_url}', 'WorldController@clientList');
    Route::get('standart', 'WorldController@standart');

    Route::resource('shop', 'ShopController');
    Route::resource('faq', 'FaqController');


    Route::get('support', 'SupportController@index')->name('support.index');
    Route::get('support/{id}', 'SupportController@edit')->name('support.edit');

    Route::group([
        'prefix' => 'profile'
    ], function () {
        Route::get('/', 'ProfileController@myProfile');
        Route::get('edit', 'ProfileController@edit');
        Route::get('{id}', 'ProfileController@profile');
        Route::post('edit', 'ProfileController@update');
        Route::post('/password/edit', 'ProfileController@editPassword');
        Route::post('/money/edit', 'ProfileController@editMoney');
        Route::post('/status/edit', 'ProfileController@editStatus');
        Route::post('/activate', 'ProfileController@activateUser');
        Route::post('/profit/edit', 'ProfileController@editProfit');
    });

    Route::group([
        'prefix' => 'packet'
    ], function () {
        Route::get('paybox', 'PacketController@generatePayBoxCode');
        Route::get('paybox/success/{id}', 'PacketController@acceptUserPacketPaybox');
        Route::post('user', 'PacketController@sendResponseAddPacket');
        Route::post('user/balance', 'PacketController@buyPacketFromBalance');
        Route::delete('user', 'PacketController@cancelResponsePacket');
        Route::get('user/active', 'PacketController@activeUserPacket');
        Route::get('user/inactive', 'PacketController@inactiveUserPacket');
        Route::post('user/inactive', 'PacketController@acceptInactiveUserPacket');
        Route::delete('user/inactive', 'PacketController@deleteInactiveUserPacket');
        Route::get('robot/month', 'IndexController@profitRobotAfterMonth');
        Route::get('robot/day', 'IndexController@deleteInactiveUserPacketAfterDay');
        Route::get('{id}', 'PacketController@getPacketById');
    });

    Route::group([
        'prefix' => 'request'
    ], function () {
        Route::post('/', 'UserRequestController@sendResponseAddRequest');
        Route::post('send-money', 'UserRequestController@sendMoneyToAccount');
        Route::get('/', 'UserRequestController@inactiveUserRequest');
        Route::get('accept', 'UserRequestController@activeUserRequest');
        Route::get('delete', 'UserRequestController@getDeletedUserRequest');
        Route::get('send', 'UserRequestController@showSendRequest');
        Route::get('send-account', 'UserRequestController@showSendAccount');
        Route::post('inactive', 'UserRequestController@acceptInactiveUserRequest');
        Route::delete('inactive', 'UserRequestController@deleteInactiveUserRequest');
    });

    Route::group([
        'prefix' => 'shareholder'
    ], function () {
        Route::get('/', 'ShareHolderController@index');
        Route::get('user', 'ShareHolderController@showAddUserShare');
        Route::post('user', 'ShareHolderController@addUserShare');
        Route::get('robot', 'ShareHolderController@robot');
    });

    Route::group([
        'prefix' => 'shareholder2'
    ], function () {
        Route::get('/', 'ShareHolder2Controller@index');
        Route::get('user', 'ShareHolder2Controller@showAddUserShare');
        Route::post('user', 'ShareHolder2Controller@addUserShare');
        Route::get('robot', 'ShareHolder2Controller@robot');
    });

    Route::group([
        'prefix' => 'speaker'
    ], function () {
        Route::get('/', 'SpeakerController@index');
        Route::get('user', 'SpeakerController@showAddUserSpeaker');
        Route::post('user', 'SpeakerController@addUserSpeaker');
        Route::delete('{id}', 'SpeakerController@deleteUserSpeaker');
    });

    Route::group([
        'prefix' => 'ajax'
    ], function () {
        Route::get('document', 'UserDocumentController@getUserDocumentList');
        Route::post('document', 'UserDocumentController@saveDocumentList');
        Route::post('document/confirm', 'UserDocumentController@confirmUserDocument');
        Route::post('document/confirm-by-admin', 'UserDocumentController@confirmUserDocumentByAdmin');
        Route::post('user/confirm/valid-document', 'UserDocumentController@confirmUserDocument');
        Route::delete('document/confirm', 'UserDocumentController@deleteConfirmUserDocument');
    });

    Route::get('document/confirm', 'UserDocumentController@getConfirmDocumentList');

    Route::get('cron/career', 'IndexController@robotCareer');

    Route::group([
        'prefix' => 'office'
    ], function () {
        Route::get('/', 'OfficeController@index');
        Route::get('robot', 'OfficeController@robotClearAfterMonthProfit');
        Route::get('user', 'OfficeController@showAddUserOffice');
        Route::get('user/{id}', 'OfficeController@showAddUserOffice');
        Route::post('user', 'OfficeController@addUserOffice');
        Route::delete('{id}', 'OfficeController@deleteUserOffice');
    });

    Route::group([
        'prefix' => 'binar'
    ], function () {
        Route::get('robot', 'IndexController@robotBinarProfit');
        Route::get('/', 'BinarStructureController@index');
        Route::get('child', 'BinarStructureController@getChildList');
        Route::get('config', 'BinarStructureController@showConfig');
        Route::post('config', 'BinarStructureController@editIsLeftConfig');
    });

    Route::group([
        'prefix' => 'speaker'
    ], function () {
        Route::get('/', 'SpeakerController@index');
        Route::get('user', 'SpeakerController@showAddUserSpeaker');
        Route::post('user', 'SpeakerController@addUserSpeaker');
        Route::delete('{id}', 'SpeakerController@deleteUserSpeaker');
    });

    Route::group([
        'prefix' => 'structure'
    ], function () {
        Route::get('/', 'StructureController@index');
        Route::get('child/{user_id}/{level}', 'StructureController@getChildList');
    });

    Route::group([
        'prefix' => 'balance'
    ], function () {
        Route::get('/', 'BalanceController@index');
        Route::get('{url}', 'BalanceController@index');
        Route::post('paybox', 'BalanceController@addBalance');
    });


    Route::group([
        'prefix' => 'online'
    ], function () {
        Route::get('/', 'OnlineController@index');
        Route::get('history', 'OnlineController@showHistory');
        Route::post('confirm', 'OnlineController@confirmBasket');
        Route::post('unit/{id}', 'OnlineController@setProductUnit');
        Route::post('{id}', 'OnlineController@addProductToBasket');
        Route::delete('{id}', 'OnlineController@deleteProductFromBasket');
    });

    Route::group([
        'prefix' => 'instagram'
    ], function () {
        Route::post('send', 'InstagramController@sendRequest');
        Route::post('send/partner', 'InstagramController@sendRequestPartner');
        Route::post('accept', 'InstagramController@acceptRequest');
        Route::post('reject', 'InstagramController@rejectRequest');
        Route::get('partners/request', 'InstagramController@showInstagramRequest');
        Route::get('corporative/request', 'InstagramController@showInstagramRequestCorporative');
        Route::get('recommend/request', 'InstagramController@showInstagramRequestRecommend');
        Route::get('partners', 'InstagramController@index');
        Route::get('corporative', 'InstagramController@showCorporative');
        Route::get('recommend', 'InstagramController@showRecommend');
    });

    Route::resource('instagram', 'InstagramController');
    Route::resource('group', 'GroupController');
    Route::resource('user-group', 'UserGroupController');
    
    Route::get('/orders', 'OrderController@index');
    
    Route::get('basket', 'OnlineController@showBasket');

    Route::get('document', 'UserDocumentController@index');
    Route::get('document/{user_id}', 'UserDocumentController@index');
    Route::get('presentation', 'PresentationController@index');
    Route::get('our-document', 'PresentationController@showDocumentList');

    Route::get('call-friend', 'IndexController@callFriend');
    Route::get('operation', 'OperationController@index');
    Route::get('accounting', 'OperationController@accountingList');
    Route::get('accounting/autobonus', 'OperationController@AutoBonusList');
    Route::get('accounting/homebonus', 'OperationController@HomeBonusList');

    Route::post('page/is_show', 'PageController@changeIsShow');
    Route::resource('page', 'PageController');

    Route::post('contact/is_show', 'ContactController@changeIsShow');
    Route::resource('contact', 'ContactController');

    Route::post('partner/is_show', 'PartnerController@changeIsShow');
    Route::resource('partner', 'PartnerController');

    Route::post('about/is_show', 'AboutController@changeIsShow');
    Route::resource('about', 'AboutController');

    Route::post('education/is_show', 'EducationController@changeIsShow');
    Route::resource('education', 'EducationController');

    Route::post('slider/is_show', 'SliderController@changeIsShow');
    Route::resource('slider', 'SliderController');

    Route::post('blog/is_show', 'BlogController@changeIsShow');
    Route::resource('blog', 'BlogController');

    Route::post('news/is_show', 'NewsController@changeIsShow');
    Route::resource('news', 'NewsController');

    Route::post('doc/is_show', 'DocController@changeIsShow');
    Route::resource('doc', 'DocController');

    Route::post('project/is_show', 'ProjectController@changeIsShow');
    Route::resource('project', 'ProjectController');

    Route::post('city/is_show', 'CityController@changeIsShow');
    Route::resource('city', 'CityController');

    Route::post('country/is_show', 'CountryController@changeIsShow');
    Route::resource('country', 'CountryController');


    Route::post('client/is_show', 'ClientController@changeIsBan');
    Route::resource('client', 'ClientController');
    Route::post('client/share', 'ClientController@editIntersHolderStatus')->name('client.share');

    Route::post('video/is_show', 'VideoController@changeIsBan');
    Route::resource('video', 'VideoController');
    Route::post('user/is_show', 'UserController@changeIsBan');
    Route::resource('user', 'UserController');

    Route::any('password', 'UserController@password');

    Route::resource('packet-item', 'PacketItemController');
    Route::resource('product', 'ProductController');
    Route::resource('category', 'CategoryController');
    Route::resource('brand', 'BrandController');
    Route::resource('news-category', 'NewsCategoryController');
    Route::resource('representative', 'RepresentativeController');
});

/******* Main page *******/
Route::group([
    'middleware' => 'web'
], function () {
    Route::get('image/delete/{file_name}', 'ImageController@deleteImage');
    Route::post('image/upload', 'ImageController@uploadImage');
    Route::post('image/upload/doc', 'ImageController@uploadDocument');
    Route::post('images/upload', 'ImageController@uploadMultipleImages');
    Route::get('media/{file_name}', 'ImageController@getImage')->where('file_name', '.*');
});

Route::group([
    'prefix' => 'smartpay',
], function () {
    Route::post('create_order', 'SmartPayController@createOrder')->name('smartpay_create_order');
    Route::post('callback', 'SmartPayController@callback')->name('smartpay_callback');
    Route::post('create_order_product', 'SmartPayController@createOrderProduct')->name('smartpay_create_order_product');
    Route::post('callback_product', 'SmartPayController@callbackProduct')->name('smartpay_callback_product');
    Route::post('create_order_partner_product', 'SmartPayController@createOrderPartnerProduct')->name('smartpay_create_order_partner_product');
    Route::post('callback_partner_product', 'SmartPayController@callbackPartnerProduct')->name('smartpay_callback_partner_product');
    Route::post('fail', 'SmartPayController@fail')->name('smartpay_fail');
    Route::get('return', 'SmartPayController@return')->name('smartpay_return');
});

/******* Index *******/
Route::group([
    'middleware' => 'web',
    'namespace' => 'Index',
], function () {
    Route::get('/', 'IndexController@index');
    Route::get('/opportunity', 'IndexController@opportunity');
    Route::get('gallery', 'IndexController@gallery')->name('gallery.show');
    Route::get('gallery-detail/{id}', 'IndexController@galleryDetail')->name('gallery-detail.show');
    Route::get('city', 'IndexController@getCityListByCountry');
    Route::get('video', 'IndexController@video');
    Route::get('contact', 'IndexController@contact')->name('contact.show');
    Route::post('contact', 'IndexController@sendMessage');
    Route::get('coming-soon', 'IndexController@comingSoon')->name('coming-soon');
    Route::get('news', 'NewsController@newsList');
    Route::post('review/store', 'ReviewController@store');
    Route::get('shop', 'ShopController@index')->name('shop.show');
    Route::get('basket', 'BasketController@show')->name('basket.show');
    Route::get('faq', 'FaqController@show')->name('faq.show');
    Route::post('faq/opportunity-faq-store', 'FaqController@opportunityFaqStore')->name('faq.opportunity.save');
    Route::get('representative', 'RepresentativeController@show')->name('representative.show');
    Route::get('favorite/show-user-item', 'FavoriteController@showUserItems')->name('favorite.showUserItem');
    Route::resource('review', 'ReviewController');
    Route::get('about_us/administration', 'AboutController@showCompanyAdministration');
    Route::get('about_us/guide', 'AboutController@showCompanyGuide');
    Route::get('about_us/leaders', 'AboutController@showCompanyLeaders');
    Route::post('basket/is-ajax', 'BasketController@isAjax')->name('basket.isAjax');
    Route::post('favorite/is-ajax', 'FavoriteController@isAjax')->name('favorite.isAjax');
    Route::get('shop/{category_id}', 'ShopController@index')->name('shop.show.category');
    Route::get('product/{id}', 'ProductController@detail')->name('product.detail');
    Route::get('education/{url}', 'IndexController@getEducationById');
    Route::get('project/{url}', 'IndexController@getProjectById');
    Route::get('news/{url}', 'NewsController@getNewsById');
    Route::get('file/{file_name}', 'IndexController@showFile')->where('file_name', '.*');
    Route::get('{about_url}', 'IndexController@getAboutById');
    Route::get('{user_id}/{user_name}', 'IndexController@redirectToRegister');

});
