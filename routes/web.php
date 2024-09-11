<?php

use Illuminate\Support\Facades\Route;
//seting apabila notfound
//use Livewire\Livewire;

Route::get('/', function () {
    return view('frontend.layouts.app');
});

//setting apabila notfound
//  Livewire::setScriptRoute(function ($handle) {
//  return Route::get('/kerudung/livewire/livewire.js', $handle);
//    });

//    Livewire::setUpdateRoute(function ($handle) {
//    return Route::post('/kerudung/livewire/update', $handle);
//    });

Route::get('formulirruangan/{id}', [App\Http\Controllers\FormulirController::class, 'formulirruangan'])->name('formulirruangan');
Route::get('formulirbangunan1/{id}', [App\Http\Controllers\FormulirController::class, 'formulirbangunan1'])->name('formulirbangunan1');
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/optimize', function () {
    Artisan::call('optimize');
});
Route::get('/clearcache', function () {
    Artisan::call('route:clear');
});
