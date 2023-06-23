<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPage;
use App\Http\Controllers\UserRegisterLogin;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\Reseller_Add_Sales;
use App\Http\Controllers\AllRefillSalesController;
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

//* HOME PAGE
Route::get('/', [LandingPage::class, 'HomePage'])->name('HomePage');
Route::get('/About', [LandingPage::class, 'about_us'])->name('about_us');
Route::get('/features', [LandingPage::class, 'feature'])->name('feature');
Route::get('/sign-up', [LandingPage::class, 'sign_up'])->name('sign_up');
Route::get('/log-in', [LandingPage::class, 'login'])->name('login');
Route::get('/privacy', [LandingPage::class, 'privacy'])->name('privacy');
Route::get('/terms', [LandingPage::class, 'terms'])->name('terms');
Route::get('/contact', [LandingPage::class, 'contact'])->name('contact');

//*register User
Route::post('/Register-account', [UserRegisterLogin::class, 'register'])->name('register');
//* login user
Route::post('/log-in', [UserRegisterLogin::class, 'log_in'])->name('log_in');
Route::post('/login', [UserRegisterLogin::class, 'login'])->name('login');

//* logout
Route::get('/logout', [LandingPage::class, 'logout'])->name('logout');

//* dashboard
Route::get('/dashboard', [dashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/Sales', [dashboardController::class, 'getsalesmonth'])->name('getsalesmonth');


//* My-service
Route::get('/My-service', [dashboardController::class, 'MyService'])->name('MyService');

//* save_product
Route::post('/save_product', [ProductController::class, 'saving_product'])->name('saving_product');
Route::get('/Add-Stock/{id}', [ProductController::class, 'AddingStocks'])->name('AddingStocks');

//* ResellerRequest
// Route::get('/dashboard', [ResellerRequestController::class, 'getREsellerRequest'])->name('getREsellerRequest');

//* add stocks
Route::post('/Update', [ProductController::class, 'updateStocks'])->name('updateStocks');

//*delete product
Route::get('/del-product/{id}', [ProductController::class, 'delStocks'])->name('delStocks');

//* orders
Route::get('/orders', [OrderController::class, 'orders'])->name('orders');
//? transactionKeys
Route::get('/orders/Request', [OrderController::class, 'Request'])->name('Request');
Route::get('/orders/ToReceive', [OrderController::class, 'ToReceive'])->name('ToReceive');
Route::get('/orders/Completed', [OrderController::class, 'Completed'])->name('Completed');
Route::get('/orders/cancelled', [OrderController::class, 'cancelled'])->name('cancelled');
//*Accept order
Route::get('/orders/Request/Accept/{id}/quantity/{qty}/productID/{pdtID}', [OrderController::class, 'AcceptOrder'])->name('AcceptOrder');

//*CompleteAddSale
Route::get('/CompleteAddSale', [OrderController::class, 'CompleteAddSale'])->name('CompleteAddSale');



//* Applicants
Route::get('/applicant', [ApplicantController::class, 'applicantRequest'])->name('applicantRequest');

//* SearchResellerReq
Route::get('/RequestNotification/{id}', [ApplicantController::class, 'RequestNotification'])->name('RequestNotification');

//* /present products
Route::post('/searchPresentProduct', [ProductController::class, 'searchPresentProduct'])->name('searchPresentProduct');


//* OrderController Submit-Product-Request - SubmitRefillRequest
Route::post('/SubmitProductRequest', [OrderController::class, 'SubmitProductRequest'])->name('SubmitProductRequest');
Route::post('/Submit-Refill-Request', [OrderController::class, 'SubmitRefillRequest'])->name('SubmitRefillRequest');

//* accept applicant request
Route::get('/applicant/Request/Accept/{id}', [ApplicantController::class, 'AcceptApplicant'])->name('AcceptApplicant');
Route::get('/applicant/Request/Decline/{id}', [ApplicantController::class, 'DeclineApplicant'])->name('DeclineApplicant');


//***************************//
Route::get('/GetProductPrice', [ProductController::class, 'ResellerProductPrice'])->name('ResellerProductPrice');
Route::post('/add-to-sale', [Reseller_Add_Sales::class, 'RessellerProductAddToSales'])->name('RessellerProductAddToSales');


//* refillrequest
Route::get('/Refill-request', [dashboardController::class, 'refillrequest'])->name('refillrequest');
//* refilltoreceive
Route::get('/Refill-process', [AllRefillSalesController::class, 'refilltoreceive'])->name('refilltoreceive');
//* refilltocompleted
Route::get('/Refill-completed', [AllRefillSalesController::class, 'refilltocompleted'])->name('refilltocompleted');


//*adminsales AddProductSales - AddRefillSalesAdmin

Route::post('/Add-Product-Sales', [AllRefillSalesController::class, 'AddProductSales'])->name('AddProductSales');
Route::post('/Add-Refill-Sales-Admin', [AllRefillSalesController::class, 'AddRefillSalesAdmin'])->name('AddRefillSalesAdmin');
//*client AddRefillSale
Route::post('Add-Refill-Sale', [AllRefillSalesController::class, 'AddRefillSale'])->name('AddRefillSale');

//*refill status update 
Route::get('/Refill-request/Request/Accept/{ref_ID}', [AllRefillSalesController::class, 'AcceptRequest'])->name('AcceptRequest');
Route::post('/Refill-request/Request/complete', [AllRefillSalesController::class, 'CompleteRequest'])->name('CompleteRequest');

// *settings
Route::get('/Settings', [dashboardController::class, 'Settings'])->name('Settings');
