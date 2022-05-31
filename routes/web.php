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

Route::get('/', function () {
    return view('welcome',['users'=>\App\Models\User::all()]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {
    Route::resource('task', \App\Http\Controllers\TaskController::class)->except(['destroy', 'edit','show']);
    Route::resource('tag', \App\Http\Controllers\TagController::class)->only(['create', 'store']);
    Route::get('tag/{id}/tasks', [App\Http\Controllers\TagController::class, 'tasks'])->name('tag.tasks');
    Route::post('tags', [App\Http\Controllers\TagController::class, 'tags'])->name('tag.tags');
});
