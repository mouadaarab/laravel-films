<?php

use App\Http\Livewire\Home\Dashboard;
use Illuminate\Support\Facades\Route;

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


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::prefix('films')->group(function(){
        Route::get('trending', \App\Http\Livewire\Film\Trending::class)->name('films.trending');
        Route::get('{film}', \App\Http\Livewire\Film\Show::class)->name('films.show');
    });
});
