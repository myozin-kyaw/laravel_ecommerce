<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\RatingController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Frontend\FrontendController@index');
Route::get('/category', 'Frontend\FrontendController@category');
Route::get('/view-category/{slug}', 'Frontend\FrontendController@viewCategory');
Route::get('/category/{cat_slug}/{prod_slug}', 'Frontend\FrontendController@viewProduct');
Route::get('/product-list', [FrontendController::class, 'getProduct']);
Route::post('/searchItem', [FrontendController::class, 'search']);

Auth::routes();

Route::get('/load-cart-data', [CartController::class, 'cartCount']);
Route::post('/add-to-cart', [CartController::class, 'addProduct']);
Route::post('/delete-cartItem', [CartController::class, 'deleteCartItem']);
Route::post('/update-cartItem', [CartController::class, 'updateCartItem']);

Route::middleware(['auth'])->group(function(){
    Route::get('/cart', [CartController::class, 'viewCart']);
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/confirm-order', [CheckoutController::class, 'placeOrder']);

    Route::get('/my-orders',[UserOrderController::class, 'index']);
    Route::get('/view-order/{id}',[UserOrderController::class, 'viewOrder']);
    Route::put('/order-accepted/{id}', 'UserOrderController@orderAccepted');

    Route::post('/add-rating', [RatingController:: class, 'add']);
    Route::get('/add-review/{product_slug}/userreview', [ReviewController:: class, 'add']);
    Route::post('/add-review', [ReviewController:: class, 'addReview']);
    Route::get('/review-edit/{product_slug}/userreview', [ReviewController:: class, 'edit']);
    Route::put('/update-review', [ReviewController::class, 'update']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','isAdmin'])->group(function () {

    Route::get('/dashboard', 'Admin\FrontendController@index');
    Route::resource('categories', 'Admin\CategoryController')->names('categories');
    Route::resource('products', 'Admin\ProductController')->names('products');
    
    Route::get('/user-orders', 'Admin\AdminOrderController@index');
    Route::get('/view-orderByAdmin/{id}', 'Admin\AdminOrderController@viewOrder');

    Route::put('/order-deliver/{id}', 'Admin\AdminOrderController@orderDeliver');
    Route::put('/order-cancel/{id}', 'Admin\AdminOrderController@orderCancel');
    Route::get('/order-history', 'Admin\AdminOrderController@orderHistory');

    Route::get('/my-users', 'Admin\DashboardController@myUsers');
    Route::get('/view-user/{id}', 'Admin\DashboardController@viewUser');

    Route::get('/slide', 'Admin\FrontendController@sliderIndex');
    Route::resource('/slide/firstSlide', 'Admin\Slider\FirstSlideController')->names('firstSlide');
    Route::resource('slide/middleSlide', 'Admin\Slider\MiddleSlideController')->names('middleSlide');
    Route::resource('/slide/lastSlide', 'Admin\Slider\LastSlideController')->names('lastSlide');
    
});
