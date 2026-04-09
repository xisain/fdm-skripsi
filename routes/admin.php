<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::prefix('penerimaan')->group(function () {
        Route::get('/', function () {
            return view('penerimaan.index');
        })->name('admin.penerimaan.index');
    });
});
