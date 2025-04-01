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
Auth::routes();

Route::get('/', 'Index\HomeController@index')->middleware(['IPAccess'])->name('home');

//Офисный портал
Route::group(array('prefix' => 'office', 'middleware' => ['IPAccess']), function () {

    Route::get('/', 'Office\StartController@index')->name('office');
    Route::get('/contacts', 'Office\ContactsController@contacts')->name('office-contacts');
    Route::get('/contact/{id}', 'Office\ContactsController@contact');
    Route::get('/inventorys', 'Office\InventorysController@inventorys')->name('office-inventorys');

});

//Админпанель
Route::group(array('prefix' => 'admin', 'middleware' => ['IPAccess', 'auth', 'AdminPanel']), function () {

    Route::get('/', 'Admin\StartController@index')->name('admin');
    
    //Сотрудники
    Route::get('/peoples/{id?}', 'Admin\PeopleController@peoples')->where('id', '[0-9]+')->middleware(['People']);
    Route::match(['get', 'post'], '/peopleadd/', 'Admin\PeopleController@add')->middleware(['PeopleEdit']);
    Route::match(['get', 'post'], '/peopleedit/{id?}', 'Admin\PeopleController@edit')->middleware(['PeopleEdit']);
    Route::match(['get', 'post'], '/people/{id}', 'Admin\PeopleController@people')->where('id', '[0-9]+')->middleware(['People']);
    Route::get('/peopledel/{id?}', 'Admin\PeopleController@del')->middleware(['PeopleDel']);
    
    //Имущество
    Route::get('/inventorys/{id?}', 'Admin\InventoryController@inventorys')->middleware(['Inventory']);
    Route::match(['get', 'post'], '/inventoryadd/{id?}', 'Admin\InventoryController@add')->middleware(['InventoryEdit']);
    Route::match(['get', 'post'], '/inventory/{id?}', 'Admin\InventoryController@inventory');
    Route::match(['get', 'post'], '/inventoryedit/{id?}', 'Admin\InventoryController@inventoryedit')->middleware(['InventoryEdit']);
    Route::get('/inventdel/{id}', 'Admin\InventoryController@del')->middleware(['InventoryDel']);
    Route::get('/inventoryrun/{run}/{id}', 'Admin\InventoryController@inventoryrun')->where('id', '[0-9]+')->middleware(['InventoryEdit']);
    
    //Пользователии
    Route::get('/users', 'Admin\UsersController@index')->middleware(['Root']);
    Route::match(['get', 'post'], '/user/{id?}', 'Admin\UsersController@user')->middleware(['Root']);
    Route::match(['get', 'post'], '/userprofile', 'Admin\UsersController@userprofile');
    Route::match(['get', 'post'], '/role/{id}', 'Admin\UsersController@role')->middleware(['Root']);
    Route::match(['get', 'post'], '/roleadd', 'Admin\UsersController@roleadd')->middleware(['Root']);
    Route::get('/roledel/{id}', 'Admin\UsersController@roledel')->middleware(['Root']);
    Route::match(['get', 'post'], '/setings', 'Admin\SetingsController@index')->name('admin-setings')->middleware(['Root']);
    Route::match(['get', 'post'], '/userpass', 'Admin\UsersController@userpass')->where('id', '[0-9]+');
    Route::match(['get', 'post'], '/userpassall/{id}', 'Admin\UsersController@userpassall')->where('id', '[0-9]+')->middleware(['Root']);
    

    //Справочники - Места хранения
    Route::get('/points', 'Admin\PointController@points')->middleware(['Point']);
    Route::match(['get', 'post'], '/pointadd', 'Admin\PointController@add')->middleware(['Point']);
    Route::match(['get', 'post'], '/point/{id?}', 'Admin\PointController@point')->where('id', '[0-9]+')->middleware(['PointEdit']);;
    Route::get('/pointdel/{id}', 'Admin\PointController@del')->where('id', '[0-9]+')->middleware(['PointDel']);;
    Route::match(['get', 'post'], '/pointin/{id}', 'Admin\PointController@in')->where('id', '[0-9]+')->middleware(['Inventory']);

    //Справочники - Адресса
    Route::get('/addresses', 'Admin\AddressController@addresses');
    Route::match(['get', 'post'], '/addressadd', 'Admin\AddressController@add')->middleware(['AddressesEdit']);
    Route::match(['get', 'post'], '/address/{id?}', 'Admin\AddressController@address')->where('id', '[0-9]+')->middleware(['AddressesEdit']);
    Route::get('/addressdel/{id}', 'Admin\AddressController@del')->where('id', '[0-9]+')->middleware(['AddressesDel']);
    Route::get('/addressin/{id?}', 'Admin\AddressController@in')->where('id', '[0-9]+')->middleware(['People']);

    //Справочники - Группы техники
    Route::get('/groups', 'Admin\GroupController@groups')->middleware(['Group']);
    Route::match(['get', 'post'], '/groupadd', 'Admin\GroupController@add')->middleware(['GroupEdit']);
    Route::match(['get', 'post'], '/group/{id?}', 'Admin\GroupController@group')->middleware(['GroupEdit']);
    Route::get('/groupdel/{id}', 'Admin\GroupController@del')->where('id', '[0-9]+')->middleware(['GroupDel']);

    //Справочники - Группы почты рабочей
    Route::match(['get', 'post'], '/mailworks', 'Admin\MailworkController@mailworks')->middleware(['Mailwork']);
    Route::match(['get', 'post'], '/mailwork/{id?}', 'Admin\MailworkController@mailwork')->middleware(['Mailwork']);
    Route::get('/mailworkdel/{id}', 'Admin\MailworkController@del')->where('id', '[0-9]+')->middleware(['MailworkDel']);
    Route::get('/mailworkpeopledel/{id}', 'Admin\MailworkController@mailworkpeopledel')->where('id', '[0-9]+')->middleware(['PeopleEdit']);

    //Спаравочеики - Должностя
    Route::match(['get', 'post'], '/positions', 'Admin\PositionController@positions')->middleware(['Position']);
    Route::match(['get', 'post'], '/positionadd', 'Admin\PositionController@add')->middleware(['PositionEdit']);
    Route::match(['get', 'post'], '/position/{id?}', 'Admin\PositionController@position')->where('id', '[0-9]+')->middleware(['Position']);
    Route::get('/positiondel/{id}', 'Admin\PositionController@del')->where('id', '[0-9]+')->middleware(['PositionDel']);
    Route::get('/positionoff/{id}', 'Admin\PositionController@positionoff')->where('id', '[0-9]+')->middleware(['PeopleEdit']);

    //Истрия
    Route::get('/history/{typedoc}/{id}', 'Admin\HistoryController@history')->where('typedoc', '[0-9]+')->where('id', '[0-9]+')->middleware(['History']);
    Route::match(['get', 'post'], '/historys/', 'Admin\HistoryController@historys')->middleware(['History']);

    //Настройки
    Route::match(['get', 'post'], '/settings', 'Admin\SettingsController@index')->middleware(['Root']);
    Route::get('/ipdel/{id}', 'Admin\SecurityController@ipdel')->where('id', '[0-9]+')->middleware(['Root']);
    Route::match(['get', 'post'], '/security', 'Admin\SecurityController@index')->middleware(['Root']);
    
    //Импорт и экспорт
    Route::match(['get', 'post'], '/import/', 'Admin\ImportController@import')->where(['file' => '[A-Za-z0-9-.xlsx]'])->middleware(['Root']);
    Route::match(['get', 'post'], '/export/', 'Admin\ExportController@index')->middleware(['InventoryEdit']);

    //Доступ закрыт
    Route::match(['get', 'post'], '/accessrole', 'Admin\AccessController@accessrole')->middleware(['Root']);
    Route::get('/accessdenied', 'Admin\AccessController@denied');

});

//Почта
Route::get('/mailtest', 'MailtestController@send');


//Route::get('/admin', 'Admin\StartController@index')->name('admin');
