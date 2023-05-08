<?php

use App\Http\Controllers\AccessControlController;
use App\Http\Controllers\AcController;
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\FcController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ManagmentController;
use App\Http\Controllers\RcController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RequisitionController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\SysInfoController;
use App\Http\Controllers\SystemBootController;
use App\Http\Controllers\UserManagmentController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

// Blades information.
/** 
 * Blades are in use of bootstrap 5.
 * Tailwind for version 2.0.0.
 * U.X and seamlessnes to be tested and feedback analysed.
 * Above is a must do before deployment/launch.
 * Log file to be auto generated.
 */

// Routes information.
/**
 * Route to boot and reboot. This route is protected and secure.
 * Encryption files will be provided on a need to know basis.
 * Middlewares are governed by a mandatory access control.
 * Tokens will act as private keys.
 * Expiry is set to 24hrs.
 */

// Controller information.
/**
 * Grouped in classes.
 * Functions to be well defined.
 * Data to be passed in methods.
 * Methods limited to get,post,patch.
 * Post and patch are named.
 * Granular permissions to govern access.
 * Mask of methods implimentation.
 * Logs of encrypted files.
 * Middlewares to protect methods.
 * J.S Promises used to catch request and compute data.
 * No methods to access the database class. 
 * But if need be to perform the above rule then,
 *  encryption, tokens, and a unique_identifier as a masked header to be logged,
 *  an alert will be provided with a detailed information on the user. 
 * Expiry is set to 24hrs.
 * Ensure reduced latency.
 * Test for time/big O notation.
 */

Route::controller(SystemBootController::class)
    ->group(function () {
        // run set up to create setup authentication
        Route::get('boot', 'setup');
        /**
         * authenticates and creates: 
         * Admin type, user setup, system permission,
         * system role, sync system role to all permissions
         * attaches system role to user system.
         */
        Route::post('setupAuth', 'setupAuth')->name('setupAuth');
        
    });

// landing page
Route::controller(WebController::class)
    ->group(function () {
        // landing page
        Route::get('/', 'landing');
    });

// organization of routes is in hierachy filter('asc')

/**
 * Routes to grant access to the highest level of managment.
 * Routes are protected by middlewares.
 * Mask post and patch route requests.
 * API's done through middlewares.
 * Permission to have a prefix name as managment.
 * Laratrust access control.
 * Mandatory access control.
 */

// backup access routes 
Route::controller(SystemBootController::class)
    ->middleware('auth')
    ->group(function () {
        /**
         * Mysql backup route
         * Accessed publicly 
         * No authorization
         * Notifiable and logged
         */
        Route::get('backup/{type}', 'mysqlBackup');
        Route::get('backup-auth', 'backupAuth');
        Route::post('backup-create/{type}', 'createBackup')->name('backup-create');
    });

Route::controller(ManagmentController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('main-manager', 'index');
    });

// system information
Route::controller(SysInfoController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('non-verified', 'NanVerify');
    });

// user routes
Route::controller(UserManagmentController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('user-otp/{id}', 'otpValidate');
        Route::get('approve/{type}/{id}', 'approveUser')->middleware('permission:approve user');
        Route::post('otp_validator/{id}', 'authenticate')->name('otp_validator');
        Route::get('user-create/{type}', 'createUser');
        Route::get('user-users', 'allUsers');
        Route::get('user-farmers/{type}', 'farmer');
        Route::post('user-store/{type}', 'storeUser')->name('main-store');
        Route::get('user-view/{type}/{id}', 'show');
        Route::get('users', 'users')->name('users.index');
        Route::get('user-action/{type}/{id}', 'userActions');
        Route::get('user-elevate/{type}/{id}', 'userElevate');
        Route::post('user-messenger/{type}/{id}', 'userElevate')->name('user-messanger');
        Route::post('user-update/{type}/{id}', 'update')->name('user-update');
        // test route
        // Route::get('view_user/{id}', 'show')->middleware('permission:access user');
    });

// activity routes
Route::controller(ActivitiesController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('activity-index/{type}', 'index'); 
        Route::get('activity-create', 'create');
        Route::post('activity-store', 'store')->name('activity-store');
        Route::get('activity-detail/{id}', 'show');
        Route::get('activity-edit/{id}', 'update');
        Route::get('activity-delete/{id}', 'delete');
    });

// requisition routes
Route::controller(RequisitionController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('requisition', 'index');
        Route::get('requisition-list/{type}', 'list');
        Route::get('requisition-pdm/{type}', 'pdmList');
        Route::get('request-activity/{type}', 'activityRequest');
        Route::get('request-pdm/{type}', 'pdmRequest');
        Route::get('make-requisition/{type}/{id}', 'makeRequest');
        Route::post('request-store/{type}/{id}', 'storeRequest')->name('request-store');
        Route::post('request-store-pdm', 'storeRequestPDM')->name('request-store-pdm');
        Route::get('approve/{type}/{origin}/{id}', 'approval');
        Route::get('proof/create', 'proofIndex');
        Route::get('proof/{type}', 'proof');
        Route::post('request-store-proof', 'uploadProof')->name('request-store-proof');
        Route::post('amend_request/{id}', 'amend')->name('amend_request');
    });

// expenses routes
Route::controller(ExpenseController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('expense-create', 'create');
        Route::post('expense-store', 'store')->name('expense-store');
        Route::get('expenses', 'index');
        Route::get('expense-approve/{id}', 'approve');
        Route::get('expense-delete/{id}', 'delete');
        // update and ammend route
        Route::post('expense-update/{id}/{type}', 'update')->name('expense-update');
    });

//analysis routes 
Route::controller(AnalysisController::class)
    ->middleware('auth')
    ->group(function () {
        // blade get call
        Route::get('user-analysis/{type}', 'users');
        Route::get('expense-analysis', 'expense');
        Route::get('payment-analysis', 'payment');
        Route::get('activity-analysis', 'activity');
        Route::get('user-request/{type}', 'requisition');

        // controller post sort request
        Route::post('filterStaff', 'filterStaff')->name('filterStaff');
        Route::post('filterFarmer', 'filterFarmer')->name('filterFarmer');
        Route::post('filterExpense', 'filterExpense')->name('filterExpense');
        Route::post('filterActivity', 'filterActivity')->name('filterActivity');
        Route::post('filterRequisition', 'filterRequisition')->name('filterRequisition');
        Route::post('filterPDM', 'filterPDM')->name('filterPDM');
        Route::post('filterPayment/{type}', 'filterPayment')->name('filterPayment');
    });

//report routes 
Route::controller(ReportController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('finance/{type}', 'index');
    });

//logs routes 
Route::controller(LogsController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('logs', 'index');
        Route::get('otp', 'otpLogs');
        Route::post('log_filter', 'logFilter')->name('log_filter');
    });
// calender routes
Route::controller(CalenderController::class)
    ->middleware('auth')
    ->group(function () { 
        Route::get('fullcalender', 'index');
        Route::post('fullcalenderAjax', 'ajax');
    });
// mail routes
Route::controller(MailController::class)
    ->middleware('auth')
    ->group(function () { 
        Route::get('send-mail/{type}', 'index');
        Route::get('activity-attendance/{id}', 'farmerAttendance');
        Route::post('email-send', 'create')->name('email-send');
    });    

    //USER ACCOUNTS ROUTES 
Route::controller(RcController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('rc-dashboard', 'index');
    });

Route::controller(AcController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('ac-dashboard', 'index');
    });

Route::controller(FcController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('fc-dashboard', 'index');
    });

// farmer routes
Route::controller(FarmerController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('farmer-attendance/{type}', 'index');
        Route::get('attendance-list/{type}/{id}', 'show');
        Route::post('store-attendance/{type}/{id}', 'store')->name('store-attendance');
    });

/**
 * Route to access access control and security
 */
Route::controller(AccessControlController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('access_control', 'index');
        Route::get('list/{type}', 'lists');
        Route::get('create_role', 'create');
        Route::post('role_create/{origin}', 'store')->name('role_create');
    });

// routes to sms 
Route::controller(SmsController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('sms_manager', 'index');
        Route::post('send_to_all', 'send_to_all')->name('send_to_all');
        Route::post('send_to_specific', 'send_to_specific')->name('send_to_specific');
        Route::get('sms_members', 'sms_members');
    });

Route::controller(ArchiveController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('archives', 'index');
    });    



// authentication routes 
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Auth::routes();
