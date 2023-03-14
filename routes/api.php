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
Route::get('Apartment/{apartment}', [ApiController::class, 'getApartment']); //
Route::post('apartments', [ApiController::class, 'createApartment']);
Route::get('delete/{apartment}', [ApiController::class, 'deleteApartment']);
Route::get('getData', [ApiController::class, 'getData']);
Route::get('getUserLogged', [ApiController::class, 'getUserLogged']);
Route::get('allApartments', [ApiController::class, 'allApartments']);
Route::post('updateApartment/{apartment}', [ApiController::class, 'updateApartment']);
// Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
Route::get('logout', [ApiController::class, 'logout'])->name("logout");
Route::post('searchApartment', [ApiController::class, 'searchApartment']);
Route::get('sponsors', [ApiController::class, 'getSponsors']);
Route::get('getApartmentDetail/{apartment}', [ApiController::class, 'getApartmentDetail']);

Route::post('advancedSearch', [ApiController::class, 'advancedSearch']);


/* Route::get('getUser', [ApiController::class, 'getUser']); */

Route::get('apartment-edit/{apartment}', [ApiController::class, 'getApartmentEdit']);
Route::get('message/{apartment}', [ApiController::class, 'getApartment']);
Route::post('sendMessage/{apartment}', [ApiController::class, 'sendMessage']);