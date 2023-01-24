<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
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

//login and register
Route::middleware(['adminAuth'])->group(function () {
    Route::redirect('/', 'loginPage');

    Route::get('/loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('/registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware([
    'auth'])->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard']);
    Route::middleware('adminAuth')->group(function () {
        //category control
        Route::group(['prefix' => 'category'], function () {
            Route::get('/list', [CategoryController::class, 'list'])->name('list#Page');
            Route::get('/create/page', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('/create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('/edit/page/{id}', [CategoryController::class, 'editPage'])->name('category#editPage');
            Route::post('/update', [CategoryController::class, 'update'])->name('category#update');
        });

        //admin
        Route::prefix('admin')->group(function () {
            //password
            Route::get('/change/page', [AdminController::class, 'passwordchangePage'])->name('password#changePage');
            Route::post('/change', [AdminController::class, 'passwordchange'])->name('password#change');

            //account
            Route::get('/details', [AdminController::class, 'details'])->name('admin#details');
            Route::get('/edit/page', [AdminController::class, 'editpage'])->name('admin#edit');
            Route::post('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
            Route::get('/list', [AdminController::class, 'list'])->name('admin#listPage');

            Route::get('/ajax/change/role', [AdminController::class, 'ajaxchangeRole'])->name('ajax#changeRole');

            Route::get('/delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');

            Route::get('/change/role/{id}', [AdminController::class, 'changeRole'])->name('admin#changeRole');

            Route::post('/change', [AdminController::class, 'change'])->name('admin#change');

        });
        //user control
        Route::prefix('user')->group(function () {
            Route::get('/userlist', [UserController::class, 'userlist'])->name('user#listPage');
            Route::get('/userdelete/{id}', [UserController::class, 'userdelete'])->name('user#delete');
            Route::get('/useredit/{id}', [UserController::class, 'usereditPage'])->name('user#editPageByAdmin');
            Route::post('/user/{id}', [UserController::class, 'useredit'])->name('user#editByAdmin');
            Route::get('/ajax/change/userRole', [UserController::class, 'ajaxchangeuserRole'])->name('ajax#changeuserRole');

        });

        //contact control

        Route::prefix('contact')->group(function () {
            Route::get('/contactlist', [ContactController::class, 'contactList'])->name('contact#historyPage');
            Route::get('/delete/{id}', [ContactController::class, 'delete'])->name('contact#delete');
            Route::get('/details/{id}', [ContactController::class, 'details'])->name('contact#details');

        });

        //order control
        Route::prefix('order')->group(function () {
            Route::get('list', [OrderController::class, 'list'])->name('order#listPage');
            Route::get('details/{orderCode}', [OrderController::class, 'details'])->name('order#detailsPage');
            Route::get('admin/filter/list', [OrderController::class, 'filterList'])->name('admin#filterList');
            Route::get('ajax/update/status', [OrderController::class, 'updateStatus'])->name('ajax#updateStatus');
        });

        //product control
        Route::prefix('product')->group(function () {
            Route::get('/list', [ProductController::class, 'list'])->name('product#listPage');
            Route::get('/create/page', [ProductController::class, 'createPage'])->name('product#createPage');
            Route::post('/create', [ProductController::class, 'create'])->name('product#create');
            Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
            Route::get('/details/{id}', [ProductController::class, 'details'])->name('product#details');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product#edit');
            Route::post('/update', [ProductController::class, 'update'])->name('product#update');

        });

    });
    //user
    Route::group(['prefix' => 'user', 'middleware' => 'userAuth'], function () {
        Route::get('/home', [UserController::class, 'home'])->name('user#Home');
        Route::get('/contact/page', [UserController::class, 'contactPage'])->name('user#ContactPage');
        Route::post('/contact', [UserController::class, 'contact'])->name('user#contact');
        Route::get('/filter/{id}', [UserController::class, 'filter'])->name('user#filter');
        Route::get('/details/{id}', [UserController::class, 'details'])->name('user#details');

        Route::prefix('password')->group(function () {
            Route::get('change', [UserController::class, 'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change', [UserController::class, 'changePassword'])->name('user#changePassword');
        });
        Route::prefix('profile')->group(function () {

            Route::get('edit/page', [UserController::class, 'editPage'])->name('user#editPage');
            Route::post('edit/{id}', [UserController::class, 'edit'])->name('user#edit');
        });
        Route::prefix('cart')->group(function () {
            Route::get('list', [UserController::class, 'cartList'])->name('user#cartList');

        });
        Route::prefix('order')->group(function () {
            Route::get('list', [UserController::class, 'orderList'])->name('user#orderList');

        });

        // ajax
        Route::prefix('ajax')->group(function () {
            Route::get('pizza/list', [AjaxController::class, 'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart', [AjaxController::class, 'addToCart'])->name('ajax#addToCart');
            Route::get('removeAllCart', [AjaxController::class, 'removeAllCart'])->name('ajax#removeAllCart');
            Route::get('removeCart', [AjaxController::class, 'removeCart'])->name('ajax#removeCart');
            Route::get('addOrderList', [AjaxController::class, 'addOrderList'])->name('ajax#addOrderList');
            Route::get('increaseViewCount', [AjaxController::class, 'increaseViewCount'])->name('ajax#increaseViewCount');
        });
    });

});