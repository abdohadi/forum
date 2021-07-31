<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('threads/{channel:slug}/{thread}', [ThreadController::class, 'show'])->name('threads.show');
Route::resource('threads', ThreadController::class)->except('show');
Route::get('threads/{channel:slug}', [ThreadController::class, 'index'])->name('threads.channel');

Route::resource('threads.replies', ReplyController::class);
Route::post('replies/{reply}/favorite', [FavoriteController::class, 'store'])->name('replies.favorite');

Route::get('profiles/{user:name}', [ProfileController::class, 'show'])->name('profile');


require __DIR__.'/auth.php';
