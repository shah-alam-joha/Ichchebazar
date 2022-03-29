<?php

use Illuminate\Support\Facades\Route;

// Frontend routes using
use App\Http\Controllers\Frontend\PagesController as FrontendPagesController;
use App\Http\Controllers\Frontend\ProductsController as FrontendProductsController;
use App\Http\Controllers\Frontend\CategoriesController as FrontendCategoriesController;
use App\Http\Controllers\Frontend\VerificationController;
use App\Http\Controllers\Frontend\UsersController;
use App\Http\Controllers\Frontend\CartsController;
use App\Http\Controllers\Frontend\CheckoutsController;

// Backend routes using
use App\Http\Controllers\Backend\ProductsController as BackendProductsController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\BrandsController;
use App\Http\Controllers\Backend\PagesController as BackendPagesController;
use App\Http\Controllers\Backend\DivisionsController;
use App\Http\Controllers\Backend\DistrictsController;
use App\Http\Controllers\Backend\OrdersController;
use App\Http\Controllers\Backend\SlidersController;

//admin controller
use App\Http\Controllers\Auth\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Auth\Admin\ForgotPasswordController as AdminForgotPasswordController;
use App\Http\Controllers\Auth\Admin\ResetPasswordController as AdminResetPasswordController;


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

// Frontend Routes
Route::get('/', [FrontendPagesController::class, 'index'])->name('index');
Route::get('/contact', [FrontendPagesController::class, 'contact'])->name('contact');

//users routes
Route::group([ 'prefix' => 'users'], function(){
Route::get('/dashboard', [UsersController::class, 'dashboard'])->name('user.dashboard');
Route::get('/profile', [UsersController::class, 'profileEdit'])->name('user.profile.edit');
Route::post('/profile/update', [UsersController::class, 'profileUpdate'])->name('user.profile.update');
Route::get('/token/{token}', [VerificationController::class, 'verify'])->name('user.notification');

});

//cart routes
Route::group([ 'prefix' => 'carts'], function(){
Route::get('/', [CartsController::class, 'index'])->name('carts.index');
Route::post('/store', [CartsController::class, 'store'])->name('carts.store');
Route::post('/update/{id}', [CartsController::class, 'update'])->name('carts.update');
Route::post('/delete/{id}', [CartsController::class, 'delete'])->name('carts.delete');

});

//checkouts routes
Route::group([ 'prefix' => 'checkouts'], function(){
Route::get('/', [CheckoutsController::class, 'index'])->name('checkouts.index');
Route::post('/store', [CheckoutsController::class, 'store'])->name('checkouts.store');

});

// Products routes
Route::group(['prefix' => 'products'], function(){
Route::get('/', [FrontendProductsController::class, 'index'])->name('products');
Route::get('/{slug}', [FrontendProductsController::class, 'show'])->name('products.show');
Route::get('/new/search', [FrontendPagesController::class, 'search'])->name('search');
Route::get('/category', [FrontendCategoriesController::class, 'index'])->name('categories.index');
Route::get('/category/{id}', [FrontendCategoriesController::class, 'show'])->name('categories.show');
});
//admin routes 
Route::group([ 'prefix' => 'admin'], function() {
	Route::get('/', [BackendPagesController::class, 'index'])->name('admin.index');

	//admin login routes
	Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
	Route::post('/login/submit', [AdminLoginController::class, 'login'])->name('admin.login.submit');
	Route::post('/logout/submit', [AdminLoginController::class, 'logout'])->name('admin.logout');

	// send password reset emial
	Route::get('/password/reset', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
	Route::post('/password/reset/post', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');	

	// reset password
	Route::get('/password/reset/{token}', [AdminResetPasswordController::class,'showResetForm'])->name('admin.password.reset');
	Route::post('/password/reset', [AdminResetPasswordController::class, 'reset'])->name('admin.password.update');



	// admin products routes
	Route::group([ 'prefix' => '/products'], function() {

		Route::get('/', [BackendProductsController::class, 'products'])->name('admin.products');
		Route::get('/create', [BackendProductsController::class, 'create'])->name('admin.product.create');
		Route::post('/store', [BackendProductsController::class, 'store'])->name('admin.product.store');
		Route::get('/edit/{id}', [BackendProductsController::class, 'edit'])->name('admin.product.edit');
		Route::post('/update/{id}', [BackendProductsController::class, 'update'])->name('admin.product.update');
		Route::post('/delete/{id}', [BackendProductsController::class, 'delete'])->name('admin.product.delete');
		
	});

	//Order routes
	Route::group([ 'prefix' => '/orders'], function() {

		Route::get('/', [OrdersController::class, 'index'])->name('admin.orders');
		Route::get('/show/{id}', [OrdersController::class, 'show'])->name('admin.order.show');
		Route::post('/delete/{id}', [OrdersController::class, 'delete'])->name('admin.order.delete');
		Route::post('/completed/{id}', [OrdersController::class, 'completed'])->name('admin.order.completed');
		Route::post('/paid/{id}', [OrdersController::class, 'paid'])->name('admin.order.paid');
		Route::post('/charge-update/{id}', [OrdersController::class, 'chargeUpdate'])->name('admin.order.charge');
		Route::get('/invoice/{id}', [OrdersController::class, 'invoiceGenerate'])->name('admin.order.invoice');

		
	});

		//Categories routes
	Route::group([ 'prefix' => '/categories'], function() {

		Route::get('/', [CategoriesController::class, 'index'])->name('admin.categories');
		Route::get('/create', [CategoriesController::class, 'create'])->name('admin.category.create');
		Route::post('/store', [CategoriesController::class, 'store'])->name('admin.category.store');
		Route::get('/edit/{id}', [CategoriesController::class, 'edit'])->name('admin.category.edit');
		Route::post('/update/{id}', [CategoriesController::class, 'update'])->name('admin.category.update');
		Route::post('/delete/{id}', [CategoriesController::class, 'delete'])->name('admin.category.delete');
		
	});

	// brands Routes
	Route::group([ 'prefix' => '/brands'], function() {
		Route::get('/', [BrandsController::class, 'index'])->name('admin.brands');
		Route::get('/create', [BrandsController::class, 'create'])->name('admin.brand.create');
		Route::post('/store', [BrandsController::class, 'store'])->name('admin.brand.store');
		Route::get('/edit/{id}', [BrandsController::class, 'edit'])->name('admin.brand.edit');
		Route::post('/update/{id}', [BrandsController::class, 'update'])->name('admin.brand.update');
		Route::post('/delete/{id}', [BrandsController::class, 'delete'])->name('admin.brand.delete');
	});

   //Sliders routes
	Route::group([ 'prefix' => '/sliders'], function(){

 	Route::get('/', [SlidersController::class, 'index'])->name('admin.sliders');
 	Route::post('/store', [SlidersController::class, 'store'])->name('admin.slider.store');
 	Route::post('/update/{id}', [SlidersController::class, 'update'])->name('admin.slider.update');
 	Route::post('/delete/{id}', [SlidersController::class, 'delete'])->name('admin.slider.delete');
	});

	//Division routes
	Route::group([ 'prefix' => '/divisions'], function(){

 	Route::get('/', [DivisionsController::class, 'index'])->name('admin.divisions');
 	Route::get('/create', [DivisionsController::class, 'create'])->name('admin.division.create');
 	Route::post('/store', [DivisionsController::class, 'store'])->name('admin.division.store');
 	Route::get('/edit/{id}', [DivisionsController::class, 'edit'])->name('admin.division.edit');
 	Route::post('/update/{id}', [DivisionsController::class, 'update'])->name('admin.division.update');
 	Route::post('/delete/{id}', [DivisionsController::class, 'delete'])->name('admin.division.delete');
	});

//District routes
	Route::group([ 'prefix' => '/districts'], function(){

 	Route::get('/', [DistrictsController::class, 'index'])->name('admin.districts');
 	Route::get('/create', [DistrictsController::class, 'create'])->name('admin.district.create');
 	Route::post('/store', [DistrictsController::class, 'store'])->name('admin.district.store');
 	Route::get('/edit/{id}', [DistrictsController::class, 'edit'])->name('admin.district.edit');
 	Route::post('/update/{id}', [DistrictsController::class, 'update'])->name('admin.district.update');
 	Route::post('/delete/{id}', [DistrictsController::class, 'delete'])->name('admin.district.delete');
	});

});



Auth::routes();

 Route::get('/get-districts/{id}', function($id){
 	return json_encode(App\Models\District::where('division_id', $id)->get());
 });
