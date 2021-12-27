<?php

use App\Http\Controllers\Admin\MasterCategoryController;
use App\Http\Controllers\Admin\MasterFaqController;
use App\Http\Controllers\Admin\MasterFileController;
use App\Http\Controllers\Admin\MasterGoodsController;
use App\Http\Controllers\Admin\MasterPaymentController;
use App\Http\Controllers\Admin\MasterRoleController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\AccountController as AdminAccountController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\TransactionController;
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
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::get('/products/show/{id}', [ProductsController::class, 'show'])->name('products.detail');
Route::get('/size/findByColorId/{id}', [ProductsController::class, 'getSizeByColorId'])->name('size.bycolor');
Route::get('/faq', fn() => view('faq'));
Route::get('/team', fn() => view('team'));


Auth::routes();

Route::group(['namespace' => '', 'prefix' => 'admin',  'middleware' => ['auth', 'is_admin']], function () {
    Route::get('home', [HomeController::class, 'adminHome'])->name('admin.home');
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
    Route::get('orders/confirm', [OrdersController::class, 'confirm'])->name('orders.confirm');
    Route::get('orders/confirm/{id}', [OrdersController::class, 'confirmShow'])->name('orders.confirm-show');
    Route::put('orders/approve/{id}', [OrdersController::class, 'confirmApprove'])->name('orders.confirm-approve');
    Route::get('orders/purchase', [OrdersController::class, 'purchase'])->name('orders.purchase');
    Route::get('orders/purchase/{id}', [OrdersController::class, 'purchaseShow'])->name('orders.purchase-show');
    Route::get('sample', fn () => view('admin.sample'));
});

Route::group(['namespace' => '', 'prefix' => 'user',  'middleware' => ['auth', 'is_user']], function () {
    Route::get('home', [HomeController::class, 'userHome'])->name('user.home');
    Route::get('profile', [AccountController::class, 'profile'])->name('user.profile');
    Route::post('transaction', [TransactionController::class, 'reqBuy'])->name('transaction.req-buy');
    Route::get('cart', [TransactionController::class, 'cart'])->name('transaction.cart');
    Route::post('cart/process', [TransactionController::class, 'cartProcess'])->name('transaction.cart-process');
    Route::delete('cart/{id}', [TransactionController::class, 'cartDestroy'])->name('transaction.cart-destroy');
    Route::get('pending', [TransactionController::class, 'pending'])->name('transaction.pending');
    Route::get('waiting', [TransactionController::class, 'waiting'])->name('transaction.waiting');
    Route::get('confirm/{id}', [TransactionController::class, 'confirm'])->name('transaction.confirm');
    Route::get('purchase/history', [TransactionController::class, 'history'])->name('transaction.history');
    Route::get('purchase/history/{id}', [TransactionController::class, 'show'])->name('transaction.show');
    Route::put('send-orders/{id}', [TransactionController::class, 'sendOrder'])->name('transaction.send-order');
    Route::delete('orders/{id}', [TransactionController::class, 'destroy'])->name('transaction.destroy');
    Route::resource('address', AddressController::class);
});
