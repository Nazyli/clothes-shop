<?php

use App\Http\Controllers\Admin\MasterCategoryController;
use App\Http\Controllers\Admin\MasterFaqController;
use App\Http\Controllers\Admin\MasterFileController;
use App\Http\Controllers\Admin\MasterGoodsController;
use App\Http\Controllers\Admin\MasterPaymentController;
use App\Http\Controllers\Admin\MasterRoleController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\HomeController;
use App\Models\MasterFileUpload;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/faq', function () {
    return view('faq');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('/admin/sample', function () {
    return view('admin.sample');
});

Route::group(['namespace' => '', 'prefix' => 'admin',  'middleware' => ['auth', 'is_admin']], function () {
    Route::resource('faq', MasterFaqController::class);
    Route::resource('category', MasterCategoryController::class);
    Route::resource('payment', MasterPaymentController::class);
    Route::resource('role', MasterRoleController::class);
    Route::resource('user', MembershipController::class);
    Route::resource('goods', MasterGoodsController::class);
    Route::resource('files', MasterFileController::class);
});
