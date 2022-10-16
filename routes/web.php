<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\RoleManager;



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

Route::get('/admin', [FrontendController::class, 'welcome']);
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//dashboard
Route::get('/dashboard', [FrontendController::class, 'dashboard'])->name('dashboard'); 

//user
Route::get('/user/list', [UserController::class, 'index'])->name('user_list'); 
Route::get('/user/delete/{user_id}', [UserController::class, 'user_delete'])->name('user.delete'); 
Route::get('/user/restore/{user_id}', [UserController::class, 'user_restore'])->name('user.restore');
Route::get('/user/pdelete/{user_id}', [UserController::class, 'user_pdelete'])->name('user.pdelete');  

//category
Route::get('/category',[CategoryController::class, 'index'])->name('category.list');
Route::post('/category/store',[CategoryController::class, 'category_store'])->name('category.store');
Route::get('/category/delete/{category_id}',[CategoryController::class, 'category_delete'])->name('category.delete');

//subcategory
Route::get('/subcategory',[SubCategoryController::class, 'index'])->name('subcategory');
Route::post('/subcategory/store',[SubCategoryController::class, 'subcategory_store'])->name('subcategory_store');
Route::get('/subcategory/status/{subcategory_id}',[SubCategoryController::class, 'status'])->name('status');
Route::get('/subcategory/delete/{subcategory_id}',[SubCategoryController::class, 'subcategory_delete'])->name('subcategory.delete');
Route::get('/subcategory/trashed',[SubCategoryController::class, 'trashed_subcategory'])->name('trashed.subcategory');
Route::get('/subcategory/restore/{subcategory_id}',[SubCategoryController::class, 'subcategory_restore'])->name('subcategory.restore');

//brands
Route::get('/brand',[BrandController::class, 'index'])->name('brand');
Route::post('/getsubcategoryid',[ProductController::class, 'getsubcategoryid']);
Route::post('/brand/store',[BrandController::class, 'brand_store'])->name('brand.store');
Route::get('/brand/delete/{brand_id}',[BrandController::class, 'brand_delete'])->name('brand.delete');
Route::get('/brand/trashed',[BrandController::class, 'trashed_brand'])->name('trashed.brand');
Route::get('/brand/pdelete/{pbrand_id}',[BrandController::class, 'brand_pdelete'])->name('brand.pdelete');
Route::get('/brand/restore/{brand_id}',[BrandController::class, 'brand_restore'])->name('brand.restore');

//product
Route::get('/product',[ProductController::class, 'index'])->name('product');
Route::get('/product/add',[ProductController::class, 'product_add'])->name('product.add');
Route::post('/product/store',[ProductController::class, 'product_store'])->name('product.save');
Route::post('/getsubcategoryid',[ProductController::class, 'getsubcategoryid']);
Route::post('/getbrandid',[ProductController::class, 'getbrandid']);
Route::get('/product/status/{product_id}',[ProductController::class, 'product_status'])->name('product.status');
Route::get('/product/inventory/{product_id}',[ProductController::class, 'product_inventory'])->name('product.inventory');

//inventory
Route::post('/inventory/store',[ProductController::class, 'inventory_store'])->name('inventory.store');
Route::get('/inventory/status/{inventory_id}',[ProductController::class, 'inventory_status'])->name('inventory.status');

//variation
Route::get('/variation',[VariationController::class, 'variation'])->name('variation');
Route::post('/variation/color/store',[VariationController::class, 'color_store'])->name('color.store');
Route::post('/variation/size/store',[VariationController::class, 'size_store'])->name('size.store');
Route::get('/color/delete/{color_id}',[VariationController::class, 'color_delete'])->name('color.delete');
Route::get('/size/delete/{size_id}',[VariationController::class, 'size_delete'])->name('size.delete');

//forntend
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about_us', [FrontendController::class, 'about_us'])->name('about.us');

//product_details
Route::get('/product/details/{slug}', [FrontendController::class, 'product_details'])->name('product.details');

//cart
Route::post('/cart/store',[CartController::class, 'cart_store'])->name('cart.store');
Route::get('/cart/page',[CartController::class, 'cart_page'])->name('cart.page');
Route::post('/getSize',[CartController::class, 'getSize']);
Route::get('/cart/delete/{cart_id}',[CartController::class, 'cart_delete'])->name('cart.delete');
Route::post('/cart/update',[CartController::class, 'cart_update'])->name('cart.update');

//customer reg log
Route::get('/customer/registration',[CustomerController::class,'customer_reg'])->name('customer.reg');
Route::post('/customer/registration/store',[CustomerController::class,'customer_reg_store'])->name('customer.reg.store');
Route::get('/customer/email/verify/{token}',[CustomerController::class,'customer_email_verify']);
Route::get('/customer/login',[CustomerController::class,'customer_login'])->name('customer.login');
Route::post('/customer/login/check',[CustomerController::class,'customer_login_check'])->name('customer.login.check');
Route::get('/customer/logout',[CustomerController::class,'customer_logout'])->name('customer.logout');

//coupon
Route::get('/coupon',[CouponController::class,'index'])->name('coupon');
Route::post('/coupon/store',[CouponController::class,'coupon_store'])->name('coupon.store');
Route::get('/coupon/status/{coupon_id}',[CouponController::class,'coupon_status'])->name('coupon.status');
Route::get('/coupon/delete/{coupon_id}',[CouponController::class,'coupon_delete'])->name('coupon.delete');

//checkout
Route::get('/checkout',[CheckoutController::class,'checkout'])->name('checkout');
Route::post('/getdistrict',[CheckoutController::class,'getdistrict']);
Route::post('/getupazila',[CheckoutController::class,'getupazila']);

//order
Route::post('/order/store',[OrderController::class,'order_store'])->name('order.store');
Route::get('/order/success',[OrderController::class,'order_success'])->name('order.success');

//account
Route::get('/customer/profile',[AccountController::class,'customer_profile'])->name('customer.profile');
Route::get('/my/order',[AccountController::class,'my_order'])->name('my.order');
Route::get('/invoice/download/{order_id}',[AccountController::class,'invoice_download'])->name('invoice.download');
Route::get('/customer/pass/reset',[AccountController::class,'customer_pass_reset'])->name('customer.pass.reset');
Route::post('/customer/pass/reset/req',[AccountController::class,'customer_pass_reset_req'])->name('customer.pass.reset.req');
Route::get('/customer/pass/reset/form/{token}',[AccountController::class,'customer_pass_reset_form'])->name('customer.pass.reset.form');
Route::post('/customer/pass/reset/update',[AccountController::class,'customer_pass_reset_update'])->name('customer.pass.reset.update');

//review
Route::post('/review/store', [OrderController::class, 'review_store'])->name('review.store');

// SSLCOMMERZ Start

Route::get('/ssl/pay', [SslCommerzPaymentController::class, 'ssl_pay']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

//stripe
Route::get('stripe', [StripePaymentController::class, 'stripe']);
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

//rolemanager
Route::get('/role/manager', [RoleManager::class, 'role_manager'])->name('role.manager');
Route::post('/permission/store', [RoleManager::class, 'permission_store'])->name('permission.store');
Route::post('/create/role', [RoleManager::class, 'create_role'])->name('create.role');
Route::get('/edit/permission/{role_id}', [RoleManager::class, 'edit_permission'])->name('edit.permission');
Route::post('/role/permission/upadate', [RoleManager::class, 'role_permission_upadate'])->name('role.permission.upadate');
Route::get('/role/assign', [RoleManager::class, 'role_assign'])->name('role.assign');
Route::post('/role/assign/user', [RoleManager::class, 'role_assign_user'])->name('role.assign.user');

//github login
Route::get('/github/redirect', [GithubController::class, 'github_redirect'])->name('github.redirect'); 
Route::get('/github/callback', [GithubController::class, 'github_callback'])->name('github.callback');


//google login
Route::get('/google/redirect', [GoogleController::class, 'google_redirect'])->name('google.redirect'); 
Route::get('/google/callback', [GoogleController::class, 'google_callback'])->name('google.callback');