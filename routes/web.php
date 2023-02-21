<?php

use App\Http\Controllers\AccountStaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountUserController;
use App\Http\Controllers\StaffUserController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\TheaterController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffDataController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\PaymentMethodController;

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

/*
|
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
|
*/
Route::get('/', [UserController::class, 'index'])->name('users index');
Route::get('/film/{film}/{tanggal?}', [UserController::class, 'detailFilm'])->name('users detailFilm');
Route::get('/film/{film}/seat/{schedules}/{time}', [UserController::class, 'listSeat'])->name('users listSeat');
Route::post('/film/{film}/seat/{schedules}/{time}/confirm', [UserController::class, 'confirmFilm'])->name('users confirmFilm');
Route::post('/film/{film}/seat/{schedules}/{time}/proses', [UserController::class, 'prosesFilm'])->name('users prosesFilm');
Route::get('/confirm-payment/{transactions}', [UserController::class, 'confirmPayment'])->name('users confirmPayment');
Route::get('/confirm-payment/{transactions}/proses', [UserController::class, 'prosesConfirmPayment'])->name('users prosesConfirmPayment');
Route::get('/ticket-detail/{transactions}', [UserController::class, 'ticketDetail'])->name('users ticketDetail');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
*/
Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/login/loginProcess', [AuthController::class, 'loginProcess']);
Route::get('/auth/logout', [AuthController::class, 'logout']);
Route::get('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/register/registerProcess', [AuthController::class, 'registerProcess']);
Route::get('/auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/auth/forgot-password/forgotPasswordProcess', [AuthController::class, 'forgotPasswordProcess']);
Route::get('/auth/forgot-password/resendOTP', [AuthController::class, 'resendOtp']);


/*
|--------------------------------------------------------------------------
| ACCOUNT
*/
Route::middleware('auth')->group( function() {
    Route::get('/account', [AccountUserController::class, 'index']);
    Route::get('/account/setting', [AccountUserController::class, 'setting']);
    Route::post('/account/setting/process', [AccountUserController::class, 'settingProcess']);
});



/*
|
|--------------------------------------------------------------------------
| STAFF
|--------------------------------------------------------------------------
|
*/
Route::get('/staff/auth/login', [AuthController::class, 'staffLogin'])->name('staff.login');
Route::post('/staff/auth/staffLoginProcess', [AuthController::class, 'staffLoginProcess']);
Route::get('/staff/auth/logout', [AuthController::class, 'staffLogout']);

Route::middleware('staff')->group( function() {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff dashboard');
    Route::get('/staff/settings', [AccountStaffController::class, 'settings'])->name('settings staff');
    Route::post('/staff/settings/process', [AccountStaffController::class, 'settingProcess']);
});


/*
|--------------------------------------------------------------------------
| STAFF MASTERDATA
*/
Route::middleware('staff')->group( function() {
    Route::get('/staff/staff-data', [StaffDataController::class, 'index'])->name('staff data');
    Route::post('/staff/staff-data/addProcess', [StaffDataController::class, 'addProcess'])->name('staff add');
    Route::post('/staff/staff-data/updateProcess/{staff}', [StaffDataController::class, 'updateProcess'])->name('staff update');
    Route::get('/staff/staff-data/delete/{staff}', [StaffDataController::class, 'deleteProcess'])->name('staff delete');
});


/*
|--------------------------------------------------------------------------
| USERS MASTERDATA
*/
Route::middleware('staff')->group( function() {
    Route::get('/staff/users', [StaffUserController::class, 'index'])->name('users staff');
    Route::post('/staff/users/add', [StaffUserController::class, 'prosesAdd'])->name('users staff');
    Route::post('/staff/users/updateProcess/{users}', [StaffUserController::class, 'updateProcess'])->name('users staff');
    Route::get('/staff/users/delete/{users}', [StaffUserController::class, 'deleteProcess'])->name('users staff');
});


/*
|--------------------------------------------------------------------------
| FILM MASTERDATA
*/
Route::middleware('staff')->group( function() {
    Route::get('/staff/films', [FilmController::class, 'index'])->name('film staff');
    Route::get('/staff/films/add', [FilmController::class, 'add'])->name('film staff');
    Route::post('/staff/films/addProcess', [FilmController::class, 'addProcess'])->name('film staff');
    Route::get('/staff/films/update/{film}', [FilmController::class, 'update'])->name('film staff');
    Route::post('/staff/films/updateProcess/{film}', [FilmController::class, 'updateProcess'])->name('film staff');
    Route::get('/staff/films/delete/{film}', [FilmController::class, 'delete'])->name('film staff');
});


/*
|--------------------------------------------------------------------------
| THEATHER MASTERDATA
*/
Route::middleware('staff')->group( function() {
    Route::get('/staff/theater', [TheaterController::class, 'index'])->name('theater staff');
    Route::post('/staff/theater/addProcess', [TheaterController::class, 'addProcess'])->name('theater staff');
    Route::post('/staff/theater/updateProcess/{theater}', [TheaterController::class, 'updateProcess'])->name('theater staff');
    Route::get('/staff/theater/update/{theater}', [TheaterController::class, 'update'])->name('theater staff');
    Route::get('/staff/theater/delete/{theater}', [TheaterController::class, 'delete'])->name('theater staff');
});


/*
|--------------------------------------------------------------------------
| SCHEDULE MASTERDATA
*/
Route::middleware('staff')->group( function() {
    Route::get('/staff/schedule', [ScheduleController::class, 'index'])->name('schedule staff');
    Route::post('/staff/schedule/addProcess', [ScheduleController::class, 'addProcess'])->name('schedule staff');
    Route::post('/staff/schedule/updateProcess/{schedules}', [ScheduleController::class, 'updateProcess'])->name('schedule staff');
    Route::get('/staff/schedule/update/{schedules}', [ScheduleController::class, 'update'])->name('schedule staff');
    Route::get('/staff/schedule/delete/{schedules}', [ScheduleController::class, 'delete'])->name('schedule staff');
});


/*
|--------------------------------------------------------------------------
| TRANSACTIONS MASTERDATA
*/

// Route untuk level Admin
Route::middleware('staff')->group( function() {
    Route::get('/staff/transactions', [TransactionsController::class, 'index'])->name('transactions staff');
});

// Route untuk level Cashier
Route::middleware('staff:Cashier')->group( function() {
    Route::post('/staff/transactions/updateProcess/{transactions}', [TransactionsController::class, 'updateProcess'])->name('transactions staff');
    Route::get('/staff/transactions/update/{transactions}', [TransactionsController::class, 'update'])->name('transactions staff');
});


/*
|--------------------------------------------------------------------------
| PAYMENT METHOD MASTERDATA
*/

// Route untuk level Admin
Route::middleware('staff')->group( function() {
    Route::get('/staff/payment-method', [PaymentMethodController::class, 'index'])->name('payment-method staff');
});

// Route untuk level Cashier
Route::middleware('staff:Cashier')->group( function() {
    Route::post('/staff/payment-method/addProcess', [PaymentMethodController::class, 'addProcess'])->name('payment-method staff');
    Route::post('/staff/payment-method/updateProcess/{paymentMethod}', [PaymentMethodController::class, 'updateProcess'])->name('payment-method staff');
    Route::get('/staff/payment-method/update/{paymentMethod}', [PaymentMethodController::class, 'update'])->name('payment-method staff');
    Route::get('/staff/payment-method/delete/{paymentMethod}', [PaymentMethodController::class, 'delete'])->name('payment-method staff');
});


Route::view('/confirm', 'user.confirm');
Route::view('/confirm-payment', 'user.confirm-payment');
Route::view('/ticket-detail', 'user.ticket-detail');
Route::view('/login', 'user.auth.login');
Route::view('/register', 'user.auth.register');
Route::view('/forgot-password', 'user.auth.forgot-password');

Route::get('/test', [AuthController::class, 'prosesForgotPassword']);