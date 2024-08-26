<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.layouts.app');
});
Route::get('formulirruanga/{id}', [App\Http\Controllers\FormulirController::class, 'formulirruanga'])->name('formulirruanga');
