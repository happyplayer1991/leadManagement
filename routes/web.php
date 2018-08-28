<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Route::group(array('prefix' => 'api/v1', 'middleware' => []), function () {
//     // Custom route added to standard Resource
//     Route::get('example/foo', 'ExampleController@foo');

//     // Standard Resource route
//    Route::resource('example', 'ItemController@testdata');
// });

Route::get('/', 'PagesController@index');
Route::get('converter',function(){
    return view('layouts.converter');
});
Route::post('converter','CommentController@jsonToCsv');

//Route::get('converter1',function(){
//    return view('layouts.converter1');
//});
//Route::post('converter1','CommentController@jsonToCsvConvert');

Route::get('download',function(){
    return view('layouts.download');
});
Route::post('registerUsers','CommentController@registerUsersToCSV');

Route::get('leadsImportExport',function(){
    return view('layouts.leadsImportExport');
});
Route::post('leadsDetailsImport','CommentController@leadsDetailsImportToCSV');
Route::get('leadsExcelFormat','CommentController@leadsCsvFormat');
Route::post('leadsDetailsExport','CommentController@leadsDetailsExportToCSV');
Route::post('/currency','UsersController@currency');

Route::get('/addquotations', function(){
    return view('layouts.addquotations');
});

Route::get('/invoice',function(){
    return view('layouts.invoice');
});
Route::get('/edit',function(){
    return view('taxs.edit');
});

Route::get('/addtax',function(){
    return view('layouts.addtax');
});
Route::get('/viewquotation',function(){
    return view('layouts.viewquotation');
});
Route::get('/viewinvoice',function(){
    return view('layouts.viewinvoice');
});
Route::get('intrestedlead',function(){
    return view('layouts.intrestedlead');
});
Route::get('intrestedquote',function(){
    return view('layouts.intrestedquote');
});
Route::get('intrestedinvoice',function(){
    return view('layouts.intrestedinvoice');
});
Route::get('emailAddress',function(){
    return view('layouts.emailAddress');
});
Route::get('/invoicepopover',function(){
    return view('invoices.invoicepopover');
});
Route::get('/reportview',function(){
    return view('layouts.reportview');
});
Route::get('/reportview1',function(){
    return view('layouts.reportview1');
});
Route::get('/timeline',function(){
    return view('layouts.timeline');
});
//Route::get('/sms',function(){
//    return view('layouts.sms');
//});
// Route::get('/months',function(){
//     return view('layouts.pipeline');
// });
Route::get('pipeline','PipelineController@index')->name('layouts.pipeline');
Route::get('intrestedlead/{id}','LeadsController@leadCount');
Route::get('intrestedquote/{id}','LeadsController@quoteCount');
Route::get('intrestedinvoice/{id}','LeadsController@invoiceCount');
Route::get('/emailAddress/{id}','InvoicesController@viewEmail')->name('layouts.emailAddress');
Route::post('/emailAddress/{id}','InvoicesController@emailAddress')->name('invoice.emailAddress');
Route::get('/sms/{id}','LeadsController@viewSms')->name('layouts.sms');
Route::post('/sms','LeadsController@sms')->name('sms');
Route::get('/email/{id}','LeadsController@sendEmail')->name('layouts.email');
Route::post('/email','LeadsController@email')->name('email');
Route::get('/addNotes/{id}','NotesController@viewNotes')->name('layouts.addNotes');
Route::get('/addQuotation/{id}','QuotationController@createQuotation')->name('quotations.createQuotation');
Route::post('/payed/{id}','InvoicesController@update')->name('invoice.update');


Route::post('/announcement/{id}','AnnouncementController@store')->name('announcement.scrolltext');
Route::get('unpublish/{id}','AnnouncementController@unpublish');
Route::get('publish/{id}','AnnouncementController@publish');

Route::group(['prefix' => 'layouts'], function () {
    Route::get('/edit/{id}','QuotationController@edit')->name('layouts.edit');
});

Route::get('ajax', 'LeadsController@ajax_data');

Route::get('/{company}/new-lead', 'LeadsController@newLeadForUnknownUser');
Route::get('/login', function () {
    return redirect('/');
});
Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'RegisterController@saveData');
Route::get('/logout', 'Auth\LoginController@logout');
Route::post('/subscription','LeadsController@subscription');
Route::get('/paypalform', 'LeadsController@paypalForm');

Route::group(['middleware' => ['auth', 'revalidate']], function () {
    /**
     * Main
     */
    Route::get('dashboard', 'PagesController@dashboard')->name('pages.dashboard');

    Route::get('/paypal','LeadsController@paypalSucess');
    Route::get('/paypalCancel','LeadsController@paypalCancel');
    /** Reports-pdfview */
    Route::get('reportview',array('as'=>'pdfview','uses'=>'ItemController@pdfview'));
    Route::get('reportview1',array('as'=>'pdfview_activity','uses'=>'ItemController@pdfview_activity'));

    Route::get('leadspdf', 'ItemController@leadspdf')->name('layouts.leadspdf');
    Route::get('activitiespdf', 'ItemController@activitiespdf')->name('layouts.activitiespdf');

    Route::get('sendbasicemail/{id}', array('as'=>'sendbasicemail','uses'=>'MailController@basicEmail'));

    Route::get('/report','DashboardController@dashboard')->name('dashboard.dashboard');
    Route::post('/report','DashboardController@dashboard')->name('dashboard.dashboard');
    Route::get('/interest','ClientsController@leadInterest')->name('lead.interest');


    Route::resource('controlpanel', 'UsersController');
    /**
     * Users
     */
    Route::group(['prefix' => 'users'], function () {
        Route::get('/data', 'UsersController@anyData')->name('users.data');
        Route::get('/taskdata/{id}', 'UsersController@taskData')->name('users.taskdata');
        Route::get('/leaddata/{id}', 'UsersController@leadData')->name('users.leaddata');
        Route::get('/clientdata/{id}', 'UsersController@clientData')->name('users.clientdata');
        Route::get('/delete/{id}','UsersController@dropUser')->name('users.delete');
    });
    Route::resource('users', 'UsersController');

    Route::resource('notes', 'NotesController');
    Route::resource('emailAddress', 'InvoicesController');

    /**
     * Roles
     */
    Route::resource('roles', 'RolesController');
    /**
     * Clients
     */
    Route::group(['prefix' => 'clients'], function () {
        Route::get('/data', 'ClientsController@anyData')->name('clients.data');
        Route::post('/create/cvrapi', 'ClientsController@cvrapiStart');
        Route::post('/notes/{id}', 'NotesController@store');
        Route::post('/upload/{id}', 'DocumentsController@upload');
        Route::patch('/updateassign/{id}', 'ClientsController@updateAssign');
        Route::post('/detail', 'ClientsController@clientDetail');
        Route::post('/storeData', 'ClientsController@storeLeadData');
        Route::post('/updateData', 'ClientsController@updateLeadData');
        Route::get('/drop/{id}', 'ClientsController@drop');
        Route::patch('/dropLead','ClientsController@dropLead');
        Route::get('{id}/view','ClientsController@viewLead');
        Route::patch('/viewLead' ,'ClientsController@viewLead');
        Route::get('/oppurtunity', 'ClientsController@oppurtunity');
        Route::post('/convertToOppurtunity', 'ClientsController@convertToOppurtunity');
        Route::post('/returnLead/{id}','ClientsController@returnLead');
        Route::post('/follow_up/{id}', 'ActivityController@clientFollowup');
        Route::post('/quotations/create/{id}', 'ClientsController@quotations');
    });

    // adding source for clients
    Route::post('clients/addsource', 'ClientsController@addsource');
    Route::post('clients/{id}/addsource', 'ClientsController@addsource');
    Route::get('/stateuser', 'ClientsController@stateUsers');

    Route::resource('clients', 'ClientsController');

    Route::resource('documents', 'DocumentsController');

    // update password
    Route::post('/UpdatePassword/{id}','UsersController@UpdatePassword');


    /**
     * Tasks
     */
    Route::group(['prefix' => 'tasks'], function () {
        Route::get('/data', 'TasksController@anyData')->name('tasks.data');
        Route::patch('/updatestatus/{id}', 'TasksController@updateStatus');
        Route::patch('/updateassign/{id}', 'TasksController@updateAssign');
        Route::post('/updatetime/{id}', 'TasksController@updateTime');
        Route::post('/invoice/{id}', 'TasksController@invoice');
        Route::post('/comments/{id}', 'CommentController@store');
    });
    Route::resource('tasks', 'TasksController');

    /**
     * Leads
     */
   
    Route::group(['prefix' => 'leads'], function () {
        Route::get('/data', 'LeadsController@anyData')->name('leads.data');
        Route::patch('/updateassign/{id}', 'LeadsController@updateAssign');
        Route::post('/notes/{id}', 'NotesController@store');
        Route::post('/storeData', 'LeadsController@storeLeadData');
        Route::patch('/updatestatus/{id}', 'LeadsController@updateStatus');
        Route::patch('/updatefollowup/{id}', 'LeadsController@updateFollowup')->name('leads.followup');
        Route::post('/detail/{id}', 'LeadsController@leadDetail');
        Route::post('/follow_create/{id}', 'LeadsController@follow_create');
        Route::post('/follow_up/{id}', 'LeadsController@leadFollowup');
        Route::get('/oppurtunity/{id}/{status}', 'LeadsController@oppurtunity');
        Route::post('/opportunity','LeadsController@oppurtunity');
        Route::get('/quote','LeadsController@quote');
        Route::post('/convertToOppurtunity', 'LeadsController@convertToOppurtunity');
        Route::get('/drop/{id}', 'LeadsController@drop');
        Route::patch('/dropLead','LeadsController@dropLead');
        Route::post('/returnLead/{id}','LeadsController@returnLead');
        Route::post('/assign_user/{id}','LeadsController@userAssign');
        Route::post('/getCustomers', 'LeadsController@getCustomers');
        Route::post('/getContacts', 'LeadsController@getContacts');
        Route::post('/getAllLeads', 'LeadsController@getAllLeads');
    });
    Route::resource('leads', 'LeadsController');

    Route::resource('otherclients', 'OtherLeadsController');

    Route::get('/interestView', 'LeadsController@productInterest')->name('interestView.interestView');

    /**
     * Settings
     */
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', 'SettingsController@index')->name('settings.index');
        Route::patch('/permissionsUpdate', 'SettingsController@permissionsUpdate');
        Route::patch('/overall', 'SettingsController@updateOverall');
        Route::post('/custom', 'SettingsController@updateCustomSettings');
    });


    Route::group(['prefix'=>'quotations'],function (){
        Route::post('/update/{id}','QuotationController@update');
        Route::post('/updateStatus/{id}','QuotationController@updateStatus');
        Route::post('/popover','QuotationController@quotationPopover');
    });


    Route::resource('quotations','QuotationController');

    /**
     * Departments
     */


    Route::resource('departments', 'DepartmentsController');


    /**
     * Locations
     */

    Route::get('locations/data', 'LocationsController@anyData')->name('locations.data');



    Route::resource('locations', 'LocationsController');


    /**
     * Projects
     */

    Route::get('projects/data', 'ProjectsController@anyData')->name('projects.data');



    Route::resource('projects', 'ProjectsController');





    /**
     * sources
     */


    Route::get('sources/data','SourceController@anyData')->name('sources.data');

    Route::resource('sources','SourceController');


    /**
     *  Activities Routes
     */

    Route::resource('activities', 'ActivityController');

        
     Route::group(['prefix' => 'activities'], function () {
        Route::get('/test','ActivityController@test');
        Route::get('/createActivity/{id}','ActivityController@createActivity');
        Route::post('/storeData','ActivityController@clientDetail');
        Route::post('/follow_up/{id}', 'ActivityController@clientFollowup');

    });

     Route::resource('calendar','CalendarController');
     Route::get('calendar', 'CalendarController@calendarView')->name('calendar.index');

    Route::get('search','SearchController@searchQuery');





    Route::get('finishtype', 'LeadsController@finish_type');



    Route::get('notifications','NotificationsController@getNotifications');

    /**
     * Sources
     */

    Route::get('sources/data', 'SourceController@anyData')->name('sources.data');

    Route::get('sourcetype', 'SourceController@sourceDetails');







    // Route::post('sources/addsource', 'SourceController@addsource');


    //Products

    Route::group(['prefix' => 'products'],function(){

        Route::post('/storeData','ProductsController@storeData');
        Route::get('/edit','ProductsController@edit');
        Route::post('/update','ProductsController@update');
        Route::get('/delete/{id}','ProductsController@destroy')->name('product.delete');

    });
    Route::resource('products','ProductsController');




    /**
     * Integrations
     */
    Route::group(['prefix' => 'integrations'], function () {
        Route::get('Integration/slack', 'IntegrationsController@slack');
    });
    Route::resource('integrations', 'IntegrationsController');

    /**
     * Notifications
     */
    Route::group(['prefix' => 'notifications'], function () {
        Route::get('/getall', 'NotificationsController@getAll')->name('notifications.get');
        Route::post('/read', 'NotificationsController@Read');
        Route::get('/markall', 'NotificationsController@markAll')->name('notification.asread');
        Route::get('/{id}', 'NotificationsController@markRead')->name('notification.read');
    });
    /**Targets and Pipelines*/
    Route::post('/target','TargetController@store');

    /**
     * Invoices
     */
    Route::group(['prefix' => 'invoices'], function () {
        Route::get('/create/{id}','InvoicesController@create')->name('invoice.create');
        Route::post('/updatepayment/{id}', 'InvoicesController@updatePayment')->name('invoice.payment.date');
        Route::post('/reopenpayment/{id}', 'InvoicesController@reopenPayment')->name('invoice.payment.reopen');
        Route::post('/sentinvoice/{id}', 'InvoicesController@updateSentStatus')->name('invoice.sent');
        Route::post('/reopensentinvoice/{id}', 'InvoicesController@updateSentReopen')->name('invoice.sent.reopen');
        Route::post('/newitem/{id}', 'InvoicesController@newItem')->name('invoice.new.item');
    });
    Route::resource('invoices', 'InvoicesController');

    Route::resource('taxs','TaxController');
    Route::get('/delete/{id}','TaxController@destroy')->name('taxs.delete');
});

Route::post('/leads', 'LeadsController@store')->name('leads.store');