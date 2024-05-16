<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DelegateController;

use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/event_update', [EventController::class, 'edit'])->name('event.edit');
    Route::patch('/event_update', [EventController::class, 'update'])->name('event.update');
});

require __DIR__.'/auth.php';
//Route::middleware('guest')->group(function () {
    Route::get('/newExhibitor', [FormController::class, 'form'])->name('exhibitor.create');
    Route::post('/newExhibitorStore', [FormController::class, 'submit'])->name('exhibitor.submit');
// });

Route::get('/newdelegate', [DelegateController::class, 'show'])->name('delegate.create');




//Exhibitor Portal Routes
Route::post('/exhibitor', [App\Http\Controllers\ExhibitorController::class, 'login'])->name('exhibitor.login');
Route::get('/exhibitor/register', [App\Http\Controllers\ExhibitorController::class, 'register'])->name('exhibitor.register');
