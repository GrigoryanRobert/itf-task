<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PhoneBookController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/phone-book', [PhoneBookController::class, 'index'])->name('phonebook.index');
Route::get('/phone-book-create', [PhoneBookController::class, 'create'])->name('phonebooks.create');
Route::post('/phone-book-store', [PhoneBookController::class, 'store'])->name('phonebook.store');
Route::get('/phone-book/edit/{id}', [PhoneBookController::class, 'edit'])->name('phonebook.edit');
Route::put('/phone-book/update/{id}', [PhoneBookController::class, 'update'])->name('phonebook.update');
Route::delete('/phone-book/delete/{id}', [PhoneBookController::class, 'destroy'])->name('phonebook.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
