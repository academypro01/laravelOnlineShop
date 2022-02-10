<?php

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

// welcome page
Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Auth::routes();

// Home page
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// backend need middleware
Route::prefix('administrator')->middleware(['auth','isAdmin'])->group(function () {
    //backend API
    Route::prefix('api')->group(function() {
        Route::get('categories', 'Backend\CategoryController@apiIndex');
        Route::post('attributes', 'Backend\AttributeGroupController@apiIndex');
    });
    //backend
    Route::get('/', 'Backend\MainController@mainPage')->name('administrator.mainPage');
    Route::resource('categories', 'Backend\CategoryController');
    Route::resource('attributesGroup', 'Backend\AttributeGroupController');
    Route::resource('attributesValue', 'Backend\AttributeValueController');
    Route::resource('brands', 'Backend\BrandController');
    Route::resource('photos', 'Backend\PhotoController');
    Route::post('photoUpload', 'Backend\PhotoController@upload')->name('photo.upload');
    Route::resource('categorySettings','Backend\CategorySettingController');
    Route::resource('products', 'Backend\ProductController');
    Route::get('product/trash', 'Backend\ProductController@trashIndex')->name('products.trash.index');
    Route::post('product/trash/forceDelete', 'Backend\ProductController@trashForceDelete')->name('products.trash.forceDelete');
    Route::post('product/trash/restore', 'Backend\ProductController@trashRestore')->name('products.trash.restore');
    Route::resource('coupons','Backend\CouponController');
    Route::get('orders','Backend\OrderController@index')->name('backend.orders.index');
    Route::resource('roles','Backend\RoleController');
});

// frontend API
Route::resource('/', 'Frontend\HomeController');
Route::prefix('api')->group(function () {
    Route::get('cities/{id}', 'Frontend\AddressController@apiCities')->name('frontend.api.cities');
    Route::get('provinces', 'Frontend\AddressController@apiProvinces')->name('frontend.api.provinces');
    Route::get('categories/{id}', 'Frontend\ProductController@getProductByCategoryApi');
    Route::get('categories/sort/{id}/{sortMethod}', 'Frontend\ProductController@getProductByCategorySortApi');
});

//frontend Cart
Route::get('/add-to-cart/{id}', 'Frontend\CartController@addToCart')->name('cart.add');
Route::post('/remove-item/{id}', 'Frontend\CartController@removeItem')->name('cart.remove');
Route::get('/cart', 'Frontend\CartController@getCart')->name('cart.cart');

//frontend user register
Route::post('front/user/register', 'Frontend\UserController@register')->name('frontend.user.register');

//frontend products
Route::get('product/{slug}','Frontend\ProductController@getProduct')->name('frontend.product.get');

//frontend Categories
Route::get('category/{id}','Frontend\ProductController@getProductByCategory')->name('frontend.category.products');


//frontend need middleware
Route::middleware(['auth'])->group(function() {
    Route::get('profile','Frontend\ProfileController@index')->name('frontend.profile');
    Route::post('coupon', 'Frontend\CouponController@addCoupon')->name('coupon.add');
    Route::get('payment-verify', 'Frontend\OrderController@verify')->name('frontend.payment.verify');
});
