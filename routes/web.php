<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SingleProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\BannerController;

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

//     If(Auth::check())
//         {
//             return redirect('/login');
//         }else{
//             return redirect('/login');
//         }
// });

// Route::get('/',function () {
//     return view('shopping.index');
// });

Auth::routes();


Route::resource('/login', LoginController::class);

Route::resource('/register', RegisterController::class);

Route::get('/', [HomeController::class, 'index']);
Route::get('/category', [ShopController::class, 'getAllCategories']);
Route::get('/category/{data}', [ShopController::class, 'getCategoryProducts']);
Route::get('/shop', [ShopController::class, 'index']);

Route::get('/product/{data}', [SingleProductController::class, 'getProductDetails']);
Route::post('/product/addToCart', [SingleProductController::class, 'addToCart']);



Route::group(['middleware' => 'auth'], function () {

	Route::prefix('admin')->group(function () {

		/********************Dashboard Starts********************/
    	Route::resource('/dashboard', DashboardController::class);
    	/********************Dashboard Ends**********************/


    	/********************Categories Starts********************/
    	Route::resource('/categories', CategoryController::class);
    	/********************Categories Ends**********************/


        /********************Products Starts********************/
        Route::post('/products/getDeleteSelectedImages', [ProductController::class,'getDeleteSelectedImages']);

        Route::resource('/products', ProductController::class);
        /********************Products Ends**********************/


        /********************Users Starts********************/
        Route::resource('/users', UserController::class);
        /********************Users Ends**********************/


        /********************Roles Starts********************/
        Route::resource('/roles', RoleController::class);
        /********************Roles Ends**********************/


        /********************Promo Code Starts********************/
        Route::resource('/promo', PromoController::class);
        /********************Promo Code Ends**********************/


        /********************Banner Code Starts********************/
        Route::resource('/banner', BannerController::class);
        /********************Banner Code Ends**********************/


	});

});