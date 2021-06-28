<?php

use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ThreadController;
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
Route::resource('threads.replies', ReplyController::class);
Route::get('threads/{channel:slug}', [ThreadController::class, 'index'])->name('threads.channel');

require __DIR__.'/auth.php';
