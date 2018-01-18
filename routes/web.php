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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/log/out', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/');
});


Auth::routes();

/** USER ROUTES */
Route::get('/user/activateSellerAccount/{id}', 'PlanController@activateSellerAccount');
/** PLAN USER END */

Route::get('/home', 'HomeController@index')->name('home');





/*
 * --------- API ROUTES ---------- *
 * --------- API ROUTES ---------- *
 * --------- API ROUTES ---------- *
 */

/** BUSINESS ROUTES */
Route::get('/business', 'BusinessController@index')->name('business');
Route::get('/business/signup', 'BusinessController@signup')->name('business/signup');
Route::get('/business/manageBusiness', 'BusinessController@manageBusiness');
Route::get('/business/viewStore/{id}', 'BusinessController@viewStore');
Route::get('/business/viewStore/{id}/about', 'BusinessController@about');
Route::get('/business/viewStore/{id}/contact', 'BusinessController@contact');
Route::get('/business/viewService/{planId}', 'BusinessController@viewService');
Route::post('/business/delete/{id}', 'BusinessController@deleteBusiness');
Route::post('/business/createAccount', 'BusinessController@createBusinessAccount');
Route::post('/business/create', 'BusinessController@createBusiness');
Route::post('/business/updatePhoto/{businessId}', 'BusinessController@updateBusinessPhoto');
Route::post('/business/updateLogo/{businessId}', 'BusinessController@updateBusinessLogo');
Route::put('/business/update/{id}', 'BusinessController@updateBusiness');
Route::put('/business/deactivate/{id}', 'BusinessController@deactivateBusiness');
Route::put('/business/activate/{id}', 'BusinessController@activateBusiness');
Route::put('/business/suspend/{id}', 'BusinessController@suspendBusiness');
Route::delete('/business/deletePhoto/{businessId}', 'BusinessController@deleteBusinessPhoto');
Route::delete('/business/deleteLogo/{businessId}', 'BusinessController@deleteBusinessLogo');
/** BUSINESS ROUTES END */


/** SUBSCRIPTION SERVICE ROUTES */
Route::post('/subscriptionService/create', 'SubscriptionServiceController@createSubscriptionService');
Route::put('/subscriptionService/update/{id}', 'SubscriptionServiceController@updateSubscriptionService');
Route::put('/subscriptionService/deactivate/{id}', 'SubscriptionServiceController@deactivateSubscriptionService');
Route::put('/subscriptionService/activate/{id}', 'SubscriptionServiceController@activateSubscriptionService');
Route::delete('/subscriptionService/delete/{id}', 'SubscriptionServiceController@deleteSubscriptionService');

/** SUBSCRIPTION SERVICE ROUTES END */


/** CUSTOMER ROUTES */
Route::post('/customer/create', 'CustomerController@createCustomer');
Route::put('/customer/update/{id}', 'CustomerController@updateBusiness');
Route::put('/customer/deactivate/{id}', 'CustomerController@deactivateBusiness');
Route::put('/customer/activate/{id}', 'CustomerController@activateBusiness');
Route::put('/customer/suspend/{id}', 'CustomerController@suspendBusiness');
Route::delete('/customer/delete/{id}', 'CustomerController@deleteBusiness');

/** CUSTOMER ROUTES END */


/** SUBSCRIPTION ROUTES */
Route::get('/subscription/subscribe/{planId}', 'SubscriptionController@showSubscriptionForm')->name('chooseSubscription');
Route::get('/subscription/subscribed', 'SubscriptionController@subscribed');
Route::post('/subscription/subscribe', 'SubscriptionController@createSubscription');
Route::post('/subscription/create', 'BusinessController@createBusiness');
Route::put('/subscription/update/{id}', 'BusinessController@updateBusiness');
Route::put('/subscription/deactivate/{id}', 'BusinessController@deactivateBusiness');
Route::put('/subscription/activate/{id}', 'BusinessController@activateBusiness');
Route::put('/subscription/suspend/{id}', 'BusinessController@suspendBusiness');
Route::delete('/subscription/delete/{id}', 'BusinessController@deleteBusiness');

/** SUBSCRIPTION ROUTES END */


/** PLAN ROUTES */
Route::get('/plan/chooseAccountPlan', 'PlanController@showChooseAccountForm');
Route::get('/plan/createAppPlans', 'PlanController@storeAppPlansLocally');
Route::get('/plan/managePlans', 'PlanController@managePlans');

Route::post('/plan/createPlan', 'PlanController@createServicePlan');
Route::post('/plan/featuredPhoto/{id}', 'PlanController@updateFeaturedPhoto');
Route::post('/plan/galleryPhoto/{id}', 'PlanController@updateGalleryPhotos');

Route::put('/plan/update/{id}', 'PlanController@updatePlan');

Route::delete('/plan/delete/{id}', 'PlanController@deletePlan');
Route::delete('/plan/featuredPhoto/{id}', 'PlanController@deleteFeaturedPhoto');
Route::delete('/plan/galleryPhoto/{id}', 'PlanController@deleteGalleryPhoto');
/** PLAN ROUTES END */

/** LOCATION ROUTES */
Route::get('/location', 'LocationController@getLocations');
/** LOCATION ROUTES END */

/** ACCOUNT ROUTES */
Route::get('/account', 'AccountController@index');
Route::get('/account/subscriptions', 'AccountController@subscriptions');
/** ACCOUNT ROUTES END */