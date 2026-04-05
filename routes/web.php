<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::post('/sidebar/toggle', function (Illuminate\Http\Request $request) {
            $request->session()->put('sidebar_open', $request->input('open'));

            return response()->json(['success' => true]);
        })->name('sidebar.toggle');

require __DIR__.'/auth.php';
