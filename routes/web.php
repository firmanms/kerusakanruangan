<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.layouts.app');
});
Route::get('formulirruangan/{id}', [App\Http\Controllers\FormulirController::class, 'formulirruangan'])->name('formulirruangan');
Route::get('formulirbangunan1/{id}', [App\Http\Controllers\FormulirController::class, 'formulirbangunan1'])->name('formulirbangunan1');
