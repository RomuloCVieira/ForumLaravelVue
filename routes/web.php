<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\SubComentarioController;

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
//comentarios
Route::get('/', [ItemsController::class, 'index'])->name('items.index');
Route::get('/items/{items}/edit', [ItemsController::class, 'edit'])->name('items.edit');
Route::post('/items', [ItemsController::class, 'store'])->name('items.store');

//subscomentarios
Route::get('/subs/create/{subcomentario}/forum/{forum}', [SubComentarioController::class, 'create'])->name('subs.create');
Route::post('/subs', [SubComentarioController::class, 'store'])->name('subs.store');


//topicos
Route::resource('forum', ForumController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/forum', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
