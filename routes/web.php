<?php

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

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Route::get('/event/{event}', [App\Http\Controllers\EventController::class, 'show'])->name('events.show');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');

Auth::routes();


Route::middleware(['auth'])->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/events/create', [App\Http\Controllers\EventController::class, 'create'])->name('events.create');
    Route::post('/events/store', [App\Http\Controllers\EventController::class, 'store'])->name('events.store');
    Route::post('/events/edit/{event}', [App\Http\Controllers\EventController::class, 'edit'])->name('events.edit');
    Route::post('/events/delete/{event}', [App\Http\Controllers\EventController::class, 'delete'])->name('events.delete');
    
    Route::get('/profile/{id}', [App\Http\Controllers\UserProfileController::class, 'index'])->name('profile');
    Route::post('/profile/{id}/edit', [App\Http\Controllers\UserProfileController::class, 'edit'])->name('profile.edit');

    Route::post('/eventregister', [App\Http\Controllers\RegisterController::class, 'register'])->name('eventregister');
    Route::post('/eventunregister', [App\Http\Controllers\RegisterController::class, 'unregister'])->name('eventunregister');
});


