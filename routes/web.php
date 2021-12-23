<?php

use App\Http\Controllers\Admin\MasterCategoryController;
use App\Http\Controllers\Admin\MasterFaqController;
use App\Http\Controllers\Admin\MasterFileController;
use App\Http\Controllers\Admin\MasterGoodsController;
use App\Http\Controllers\Admin\MasterPaymentController;
use App\Http\Controllers\Admin\MasterRoleController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\AccountController as AdminAccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\User\AccountController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/faq', function () {
    return view('faq');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('/admin/sample', function () {
    return view('admin.sample');
});

Route::get('/products',[ProductsController::class, 'index'])->name('products');
Route::get('/products/show/{id}',[ProductsController::class, 'show'])->name('products.detail');

Route::group(['namespace' => '', 'prefix' => 'admin',  'middleware' => ['auth', 'is_admin']], function () {
    Route::resource('faq', MasterFaqController::class);
    Route::resource('category', MasterCategoryController::class);
    Route::resource('payment', MasterPaymentController::class);
    Route::resource('role', MasterRoleController::class);
    Route::resource('user', MembershipController::class);
    Route::resource('goods', MasterGoodsController::class);
    Route::post('goods/size', [MasterGoodsController::class, 'sizeUpdate'])->name('goods.size-update');
    Route::post('goods/color', [MasterGoodsController::class, 'colorUpdate'])->name('goods.color-update');
    Route::post('goods/addcolor', [MasterGoodsController::class, 'addColor'])->name('goods.addcolor');
    Route::delete('goods/color/{id}', [MasterGoodsController::class, 'destroyColor'])->name('goods.deletecolor');
    Route::delete('goods/size/{id}', [MasterGoodsController::class, 'destroySize'])->name('goods.deletesize');
    Route::resource('files', MasterFileController::class);
    Route::get('profile', [AdminAccountController::class, 'profile'])->name('admin.profile');
});

Route::group(['namespace' => '', 'prefix' => 'user',  'middleware' => ['auth', 'is_user']], function () {
    Route::get('home', [HomeController::class, 'userHome'])->name('user.home');
    Route::get('profile', [AccountController::class, 'profile'])->name('user.profile');
});
