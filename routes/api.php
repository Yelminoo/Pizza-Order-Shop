<?php

use App\Http\Controllers\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get data
//localhost:8000/api/category/list
//localhost:8000/api/data/list
Route::get('product/list', [RouteController::class, 'productList']);
Route::get('category/list', [RouteController::class, 'categoryList']);
Route::get('data/list', [RouteController::class, 'dataList']);

//create data
//post method
//localhost:8000/api/category/create
//category key-name:for category name
//localhost:8000/api/contact/create
//key-name:for contact name
//key-email:for contact email
//key-message:for contact message
Route::post('contact/create', [RouteController::class, 'contactCreate']);
Route::post('category/create', [RouteController::class, 'categoryCreate']);

//delete data
//fill the id of item to be deleted in{id}
//localhost:8000/api/category/delete/{id}
//localhost:8000/api/contact/delet/{id}
Route::get('category/delete/{id}', [RouteController::class, 'categoryDelete']);
Route::get('contact/delete/{id}', [RouteController::class, 'contactDelete']);

//edit data
//localhost:8000/api/category/edit
//key:name:for update category name

//localhost:8000/api/contact/edit
//key-name:for update contact name
//key-email:for update contact email
//key-message:for update contact message

Route::post('category/edit', [RouteController::class, 'categoryEdit']);
Route::post('contact/edit', [RouteController::class, 'contactEdit']);