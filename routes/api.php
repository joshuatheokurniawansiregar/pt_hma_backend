<?php

use App\Http\Controllers\NavigationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteLogoController;
use App\Models\WebsiteLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/user', [UserController::class, 'get_user_by_id']);
Route::get('/user/all', [UserController::class, 'get_all_users']);
Route::get('/user/active', [UserController::class, 'get_user_who_active']);

Route::post('/user/create', [UserController::class, 'create_user']);
Route::post('/user/update', [UserController::class, 'update_user']);
Route::post('/user/delete', [UserController::class, 'delete_user']);

Route::post('/user/login', [UserController::class, 'loginUser']);


Route::get('/website_logo', [WebsiteLogoController::class, 'get_website_logo_by_name']);


Route::get('/navigations', [NavigationController::class, 'get_all_navigations']);
