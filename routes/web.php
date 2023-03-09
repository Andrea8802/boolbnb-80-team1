<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('createApartment', [ApiController::class, 'createApartmentPage'])->middleware('auth')->name('createApartment');
// Route::get('editApartment', [ApiController::class, 'editApartmentPage'])->middleware('auth')->name('editApartment');

Route::post('apartments', [ApiController::class, 'createApartment']);
Route::get('apartment', [ApiController::class, 'userApartmentsPage'])->middleware('auth')->name('apartment');
Route::get('userApartments', [ApiController::class, 'userApartments']);
Route::get('getData', [ApiController::class, 'getData']);
Route::get('delete/{apartment}', [ApiController::class, 'deleteApartment']);
Route::get('editApartment/{apartment}', [ApiController::class, 'geteditApartment']);