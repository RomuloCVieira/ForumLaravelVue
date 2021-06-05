<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TopicoController;
use App\Http\Controllers\ComentarioController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/forum',function () {
    return Inertia::render('Dashboard'); 
})->name('dashboard');

Route::get('/teste',function () {
    return Inertia::render('Dashboard'); 
})->name('teste');

//topicos
Route::resource('forum', TopicoController::class);
Route::get('/', [TopicoController::class, 'index'])->name('items.index');

//comentarios
Route::get('/items/{items}/edit', [ComentarioController::class, 'edit'])->name('items.edit');
Route::post('/items', [ComentarioController::class, 'store'])->name('items.store');

//subscomentarios
Route::get('/subs/create/{subcomentario}/forum/{forum}', [SubComentarioController::class, 'create'])->name('subs.create');
Route::post('/subs', [SubComentarioController::class, 'store'])->name('subs.store');


