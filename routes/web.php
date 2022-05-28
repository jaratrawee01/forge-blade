<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;


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
    return view('welcome');
}); 

Route::get('/dashboard', function () {
        $users=user::all();
        return view('dashboard', compact('users'));
    })->name('dashboard');

//Admin
Route::get('/admin',[AdminController::class,'index']); 

//user
Route::resource('/user',UserController::class);
Route::resource('/position',PositionController::class);
//อัพรูปภาพ
Route::resource('/service',ServiceController::class);
//ตะกล้สสินค้า
Route::resource('/product',ProductController::class);
Route::resource('/orders',OrderController::class);
