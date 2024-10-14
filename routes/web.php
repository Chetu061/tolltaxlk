<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\TollController;
use App\Http\Controllers\Backend\LocationController;
use App\Http\Controllers\Backend\AxeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TolltaxController;
use App\Http\Controllers\Backend\NewtollController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// priti route
// profile
Route::get('/profile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

Route::controller(TollController::class)->group(function () {
    Route::get('toll/index', 'index')->name('backend.toll.index');
    Route::get('toll/create', 'create')->name('backend.toll.create');
  
    Route::post('toll/store', 'store')->name('toll.store');
    Route::get('toll/edit/{id}', 'edit')->name('backend.toll.edit');
    Route::put('toll/update/{id}', 'update')->name('toll.update');
    Route::get('toll/delete/{id}', 'destroy')->name('toll.delete');

});
// just
Route::get('/pdfdesign/{id}', [TollController::class, 'viewpdftest'])->name('pdf.tolltax');

Route::controller(UserController::class)->group(function () {
    Route::get('userindex', 'userindex')->name('backend.user.index');
   
   });
   Route::controller(LocationController::class)->group(function () {
    Route::get('location/index', 'index')->name('backend.location.index');
    Route::get('location/create', 'create')->name('backend.location.create');
    Route::post('location/store', 'store')->name('location.store');
    Route::get('location/edit/{id}', 'edit')->name('backend.location.edit');
    Route::put('location/update/{id}', 'update')->name('location.update');
    Route::get('location/delete/{id}', 'destroy')->name('location.delete');
});
Route::controller(AxeController::class)->group(function () {
    Route::get('axe/index', 'index')->name('backend.axe.index');
    Route::get('axe/create', 'create')->name('backend.axe.create');
    Route::post('axe/store', 'store')->name('axe.store');
    Route::get('axe/edit/{id}', 'edit')->name('backend.axe.edit');
    Route::put('axe/update/{id}', 'update')->name('axe.update');
    Route::get('axe/delete/{id}', 'destroy')->name('axe.delete');
});
Route::get('/toll/generate-pdf/{id}', [TollController::class, 'generatePDF'])->name('toll.generatePDF');

Route::controller(TolltaxController::class)->group(function () {
    Route::get('tolltax/index', 'index')->name('backend.tolltax.index');
Route::get('tollrate/create', 'create')->name('backend.tolltax.create');
Route::get('tollrate/store', 'store')->name('backend.tolltax.store');
Route::get('tollrate/edit/{id}', 'edit')->name('backend.tolltax.edit');
Route::put('tollrate/update/{id}', 'update')->name('tolltax.update');
Route::get('tollrate/delete/{id}', 'destroy')->name('tolltax.delete');
});
Route::controller(NewtollController::class)->group(function () {
    Route::get('newtoll/index', 'index')->name('backend.newtoll.index');
    Route::get('newtoll/create', 'create')->name('backend.newtoll.create');
    Route::post('newtoll/store', 'store')->name('newtoll.store');
    Route::get('newtoll/edit/{id}', 'edit')->name('backend.newtoll.edit');
    Route::put('newtoll/update/{id}', 'update')->name('newtoll.update');
    Route::get('newtoll/delete/{id}', 'destroy')->name('newtoll.delete');
    Route::get('/get-tax/{id}', 'getTax')->name('get.tax');
});
Route::get('/newtoll/pdf', [NewtollController::class, 'generatePDF'])->name('newtoll.pdf');

