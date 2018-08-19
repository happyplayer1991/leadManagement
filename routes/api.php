<?php

use Illuminate\Http\Request;
use App\Models\Lead;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    Route::get('logout', 'Api\LoginController@logout');
    Route::post('login', 'Api\LoginController@login');
    Route::get('leads', 'Api\LeadController@leads');
    Route::get('opportunities', 'Api\LeadController@opportunities');
    Route::get('quote', 'Api\LeadController@quotations');
    Route::get('won', 'Api\LeadController@won');
    Route::post('movelead/{id}', 'Api\LeadController@moveLead');
    Route::get('leads/{id}', 'Api\LeadController@show');
    Route::post('leads', 'Api\LeadController@create');
    Route::post('leads/{id}/edit', 'Api\LeadController@edit');
    Route::post('leads/{id}/miniedit', 'Api\LeadController@miniedit');
    Route::post('leads/drop/{id}', 'Api\LeadController@drop');
    Route::get('mobileleads', 'Api\LeadController@contactLeads');
    Route::post('activities', 'Api\ActivityController@create');
    Route::post('activityComplete/{id}', 'Api\ActivityController@completeActivity');
    Route::get('activityleads', 'Api\ActivityController@leads');
    Route::get('todaysTask', 'Api\ActivityController@weekActivities');
    Route::get('users/{id}', 'Api\UserController@show');
    Route::post('users/{id}/edit', 'Api\UserController@edit');
    Route::get('roles', 'Api\UserController@roles');
    Route::get('quotations', 'Api\QuotationController@quotations');
    Route::get('quotation/{id}', 'Api\QuotationController@show');
    Route::post('quotation/approved/{id}', 'Api\QuotationController@approved');
    Route::post('quotation/rejected/{id}', 'Api\QuotationController@rejected');
    Route::get('activities', 'Api\ActivityController@activities');
    Route::get('activities/{id}', 'Api\ActivityController@show');
    Route::get('invoices', 'Api\InvoiceController@invoices');
    Route::get('invoices/{id}', 'Api\InvoiceController@show');
    Route::get('interestProducts', 'Api\LeadController@interested_product');
    Route::get('industries', 'Api\LeadController@listAllIndustries');
    Route::get('leadtype', 'Api\LeadController@leadType');
    Route::get('leadstatus', 'Api\LeadController@leadStatus');
    Route::get('users', 'Api\LeadController@users');
    Route::get('leadsource', 'Api\LeadController@leadSource');
    Route::get('activitytype', 'Api\ActivityController@activity_type');
    Route::get('dropstatus', 'Api\LeadController@dropStatus');
    Route::get('products', 'Api\ProductController@show');
    Route::get('notification','Api\NotificationController@getAll');
    Route::post('notificationRead/{id}','Api\NotificationController@markRead');
    Route::get('taxs', 'Api\TaxController@tax');
    Route::get('currency', 'Api\QuotationController@currency');
    Route::post('newquotation','Api\QuotationController@newQuotation');
    Route::get('quotenumber','Api\QuotationController@quoteNumber');
    Route::get('leaddetails','Api\LeadController@leadDetails');

// Route::get('leads', function() {
//     // If the Content-Type and Accept headers are set to 'application/json', 
//     // this will return a JSON structure. This will be cleaned up later.


//     return Lead::all();
// });

// Route::post('leads', function(Request $request) {
//     return response()->json(['name' => 'test']);
// });
//ORDER BY Country ASC, CustomerName DESC;
	Route::get('/test', function (Request $request) {
		return response()->json(['hello' => 'test','status' => '201']);
             return response()->json(['name' => 'test']);
        });




// // Route::get('/test',function(){
// //      return "ok"; 
// // });

// Route::get('login','LeadsController@dropLead');

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');
