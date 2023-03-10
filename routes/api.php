<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ApiController;

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
Route::middleware('auth:sanctum')->get('athenticated', function () {
    return true;
});
Route::post('register', 'App\Http\Controllers\Auth\RegisterController@register');

Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
Route::get('userApartments', [ApiController::class, 'userApartments']);
Route::get('editApartment/{apartment}', [ApiController::class, 'geteditApartment']);
Route::post('apartments', [ApiController::class, 'createApartment']);
Route::get('delete/{apartment}', [ApiController::class, 'deleteApartment']);
Route::get('getData', [ApiController::class, 'getData']);
Route::get('getUserLogged', [ApiController::class, 'getUserLogged']);
Route::get('allApartments', [ApiController::class, 'allApartments']);
Route::post('updateApartment/{apartment}', [ApiController::class, 'updateApartment']);
// Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name("logout");