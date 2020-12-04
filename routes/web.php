<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {

    If(Auth::check())
        {
            return redirect('/login');
        }else{
            return redirect('/login');
        }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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