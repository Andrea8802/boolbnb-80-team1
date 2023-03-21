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

// Auth User
Route::post('register', 'App\Http\Controllers\Auth\RegisterController@register');
Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
Route::get('logout', [ApiController::class, 'logout'])->name("logout");
Route::get('getUserLogged', [ApiController::class, 'getUserLogged']);

// Apartment
Route::get('userApartments', [ApiController::class, 'userApartments']);
Route::get('Apartment/{apartment}', [ApiController::class, 'getApartment']);
Route::post('apartments', [ApiController::class, 'createApartment']);
Route::get('delete/{apartment}', [ApiController::class, 'deleteApartment']);
Route::get('getData', [ApiController::class, 'getData']);
Route::get('getInfo', [ApiController::class, 'getInfo']);
Route::get('allApartments', [ApiController::class, 'allApartments']);
Route::post('updateApartment/{apartment}', [ApiController::class, 'updateApartment']);
Route::post('searchApartment', [ApiController::class, 'searchApartment']);
Route::post('advancedSearch', [ApiController::class, 'advancedSearch']);
Route::get('getApartmentDetail/{apartment}', [ApiController::class, 'getApartmentDetail']);
Route::get('apartment-edit/{apartment}', [ApiController::class, 'getApartmentEdit']);
Route::post('Apartment/{apartment}/added-images', [ApiController::class, 'createAddedImages']);
Route::post('changeVisibility', [ApiController::class, 'changeVisibility']);

// Sponsor
Route::get('sponsors', [ApiController::class, 'getSponsors']);
Route::post('sponsorPayment', [ApiController::class, 'sponsorPayment']);
Route::get('apartmentsSponsor', [ApiController::class, 'getApartmentsSponsor']);
Route::post('sponsorApartmentId', [ApiController::class, 'sponsorApartmentId']);

// Messages
Route::post('getMessages', [ApiController::class, 'getMessages']);
Route::post('sendMessage/{apartment}', [ApiController::class, 'sendMessage']);
Route::get('message/{user}', [ApiController::class, 'getUserLogged']);
Route::post('getMessagesStat/{apartment}', [ApiController::class, 'getMessagesStat']);

// Statistics
Route::post('getStatistics/{apartment}', [ApiController::class, 'getStatistics']);
Route::post('getNumViews', [ApiController::class, 'getNumViews']);