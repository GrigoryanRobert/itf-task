<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PhoneBookApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/phone-books', [PhoneBookApiController::class, 'index'])->name('phonebookapi.index');
Route::get('/phone-book/{id}', [PhoneBookApiController::class, 'show'])->name('phonebookapi.show');
Route::post('/phone-book/{id}', [PhoneBookApiController::class, 'store'])->name('phonebookapi.create');
Route::put('/phone-book/{id}', [PhoneBookApiController::class, 'update'])->name('phonebookapi.update');
Route::delete('/phone-book/{id}', [PhoneBookApiController::class, 'destroy'])->name('phonebookapi.delete');
