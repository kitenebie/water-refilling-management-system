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
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\announcementController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\Member;
use App\Models\AddressFee;
use Illuminate\Notifications\Notification;
use Sabberworm\CSS\Settings;
use App\Http\Controllers\refillCostController;
use App\Http\Controllers\rangeSalesController;
use App\Http\Controllers\ResellerRequestController;
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

//* HOME PAGE loader
Route::get('/', [LandingPage::class, 'HomePage'])->name('HomePage');
Route::get('/About', [LandingPage::class, 'about_us'])->name('about_us');
Route::get('/features', [LandingPage::class, 'feature'])->name('feature');
Route::get('/sign-up', [LandingPage::class, 'sign_up'])->name('sign_up');
Route::get('/log-in', [LandingPage::class, 'login'])->name('login');
Route::get('/privacy', [LandingPage::class, 'privacy'])->name('privacy');
Route::get('/terms', [LandingPage::class, 'terms'])->name('terms');
Route::get('/contact', [LandingPage::class, 'contact'])->name('contact');
Route::get('/loader', [LandingPage::class, 'loader'])->name('loader');

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
Route::get('/Complete/{id}/pymt/{pyment}', [OrderController::class, 'CompleteAddSale'])->name('CompleteAddSale');

//*Cancelorders
Route::get('/orders/Request/Decline/{id}', [OrderController::class, 'Decline'])->name('Decline');
Route::get('/Refill-request/Request/Decline/{id}', [AllRefillSalesController::class, 'Decline'])->name('Decline');


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
Route::get('/applicant/Request/Accept/{id}/email/{mail}', [ApplicantController::class, 'AcceptApplicant'])->name('AcceptApplicant');
Route::get('/applicant/Request/Decline/{id}/email/{mail}', [ApplicantController::class, 'DeclineApplicant'])->name('DeclineApplicant');
Route::get('/Activate-my-account-Token/{Token}', [ApplicantController::class, 'ActivateWithToken'])->name('ActivateWithToken');

//***************************//
Route::get('/GetProductPrice', [ProductController::class, 'ResellerProductPrice'])->name('ResellerProductPrice');
Route::post('/add-to-sale', [Reseller_Add_Sales::class, 'RessellerProductAddToSales'])->name('RessellerProductAddToSales');


//* refillrequest
Route::get('/Refill-request', [dashboardController::class, 'refillrequest'])->name('refillrequest');
//* refilltoreceive
Route::get('/Refill-process', [AllRefillSalesController::class, 'refilltoreceive'])->name('refilltoreceive');
//* refilltocompleted
Route::get('/Refill-completed', [AllRefillSalesController::class, 'refilltocompleted'])->name('refilltocompleted');
//* refilltocancelled
Route::get('/Refill-cancelled', [AllRefillSalesController::class, 'refilltocancelled'])->name('refilltocancelled');


//*adminsales AddProductSales - AddRefillSalesAdmin

Route::post('/Add-Product-Sales', [AllRefillSalesController::class, 'AddProductSales'])->name('AddProductSales');
Route::post('/Add-Refill-Sales-Admin', [AllRefillSalesController::class, 'AddRefillSalesAdmin'])->name('AddRefillSalesAdmin');
//*client AddRefillSale
Route::post('Add-Refill-Sale', [AllRefillSalesController::class, 'AddRefillSale'])->name('AddRefillSale');

//*refill status update
Route::get('/Refill-request/Request/Accept/{ref_ID}', [AllRefillSalesController::class, 'AcceptRequest'])->name('AcceptRequest');
Route::get('/Refill-request/Request/complete/{ID}/{Quantity}/{Amount}/{pyment}', [AllRefillSalesController::class, 'CompleteRequest'])->name('CompleteRequest');

// *settings
Route::get('/Settings', [dashboardController::class, 'Settings'])->name('Settings');


//*notification getNotificationByUser
Route::get('/Save_Reseller_Stocks', [NotificationController::class, 'Save_Reseller_Stocks'])->name('Save_Reseller_Stocks');
Route::get('/getNotificationByUser', [NotificationController::class, 'getNotificationByUser'])->name('getNotificationByUser');
Route::get('/test', [NotificationController::class, 'test'])->name('test');

//*settings getloginInfo
Route::post('/update-Profile', [SettingsController::class, 'updateProfile'])->name('updateProfile');
Route::get('/getloginInfo-Profile', [SettingsController::class, 'getloginInfo'])->name('getloginInfo');

// UpdatePrice updateLimitStocks
Route::post('/Update-Price', [SettingsController::class, 'UpdatePrice'])->name('UpdatePrice');
Route::post('/update-Limit-Stocks', [SettingsController::class, 'updateLimitStocks'])->name('updateLimitStocks');

//* announcement Announcement_remove
Route::post('/post-announcement', [announcementController::class, 'Announcement_Post'])->name('Announcement_Post');
Route::get('/remove-announcement/{announce_Code}', [announcementController::class, 'Announcement_remove'])->name('Announcement_remove');
Route::get('/get-announcement', [announcementController::class, 'get_annoucement'])->name('get_annoucement');

//count_notif
Route::get('/count_notif', [announcementController::class, 'count_notif'])->name('count_notif');

//selectedMonthYearSale
// Route::post('/submitFindSaleyear', [AllRefillSalesController::class, 'submitFindSaleyear'])->name('submitFindSaleyear');
//get_toReceive_orders : get_completed_orders
Route::get('/get-orders-report', [PDFController::class,'get_toReceive_orders'])->name('get_toReceive_orders');
Route::get('/get-completed-report', [PDFController::class,'get_completed_orders'])->name('get_completed_orders');

//refill : get_toReceive_refill : get_complete_refill
Route::get('/get-refill-report', [PDFController::class,'get_toReceive_refill'])->name('get_toReceive_refill');
Route::get('/get-complete-refill-report', [PDFController::class,'get_complete_refill'])->name('get_complete_refill');

Route::post('/submitFindSaleyear', [AllRefillSalesController::class, 'submitFindSaleyear'])->name('submitFindSaleyear');
Route::get('/getyearlyReport/{year}', [PDFController::class, 'getyearlyReport'])->name('getyearlyReport');

Route::get('/notify',[NotificationController::class, 'ShowPostNotification'])->name('ShowPostNotification');
Route::get("/productPrices/{data}", [ProductController::class, 'productPrices'])->name('productPrices');

//saveAddressFee
Route::post('/save-Address-Fee', [AddressFee::class,'saveAddressFee'])->name('saveAddressFee');
Route::get('/Address-Delete/{id}', [AddressFee::class,'DeleteAddressFee'])->name('DeleteAddressFee');
Route::get('/download-Sales/{year}', [PDFController::class, 'downloadSales'])->name('downloadSales');
Route::get('/download-refill/{year}', [PDFController::class, 'downloadRefill'])->name('downloadRefill');

//members
Route::get('/members', [Member::class,'members'])->name('members');


//refillcost
Route::post('/save-RefillCost', [refillCostController::class,'RefillCost'])->name('RefillCost');


//forgot pwd - recover_Account - /Change-My-Password/
Route::get('/forgot-password', [UserRegisterLogin::class, 'forgot_pwd'])->name('forgot_pwd');
Route::post('/recover-Account', [UserRegisterLogin::class, 'recover_Account'])->name('recover_Account');
Route::get('/Change-My-Password/{email}/{pwd}', [UserRegisterLogin::class, 'change_pwd'])->name('change_pwd');


route::post('getAllBetweenSales', [rangeSalesController::class, 'getAllBetweenSales'])->name('getAllBetweenSales');
// submitFindSaleyearReseller
route::post('SellerWalkIngetAllBetweenSales', [rangeSalesController::class, 'SellerWalkIngetAllBetweenSales'])->name('SellerWalkIngetAllBetweenSales');
route::post('submitFindSaleyearReseller', [rangeSalesController::class, 'submitFindSaleyearReseller'])->name('submitFindSaleyearReseller');

// update_change
route::post('update_change', [OrderController::class, 'update_change'])->name('update_change');

//update_changeRefill
route::post('update_changeRefill', [ResellerRequestController::class, 'update_changeRefill'])->name('update_changeRefill');

// restoration restore-address/1 /restore-product/
Route::get('/restore-address/{id}', [SettingsController::class, 'restoreAddress'])->name('restoreAddress');
Route::get('/restore-product/{id}', [SettingsController::class, 'restoreProduct'])->name('restoreProduct');

//showSalesTbl Sales-report/
Route::get('/Sales-report/{start}/{end}', [rangeSalesController::class, 'showSalesTbl'])->name('showSalesTbl');
Route::get('/refill-report/{start}/{end}', [rangeSalesController::class, 'showrefillTbl'])->name('showrefillTbl');
///refill-report/ ProductreportBetween
Route::get('/refill-report-pdf/{start}/{end}', [PDFController::class, 'RefillreportBetween'])->name('RefillreportBetween');
Route::get('/Sales-report-pdf/{start}/{end}', [PDFController::class, 'ProductreportBetween'])->name('ProductreportBetween');
