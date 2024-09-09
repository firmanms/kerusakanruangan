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
