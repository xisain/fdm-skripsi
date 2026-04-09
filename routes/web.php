<?php

use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Services\penerimaan\nomorAksesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::post('/sidebar/toggle', function (Request $request) {
    $request->session()->put('sidebar_open', $request->input('open'));

    return response()->json(['success' => true]);
})->name('sidebar.toggle');
Route::prefix('/penerimaan')->group(function () {
    Route::get('/create', [PenerimaanController::class, 'create'])->name('penerimaan.create');
    Route::get('/', [PenerimaanController::class, 'index'])->name('penerimaan.index');
    Route::post('/', [PenerimaanController::class, 'store'])->name('penerimaan.store');
    Route::get('/download-template', [PenerimaanController::class, 'downloadTemplate'])->name('penerimaan.downloadTemplate');
    Route::get('/getNomorAkses', function () {
        return response()->json([
            'nomor_akses' => app(nomorAksesService::class)->generateNomorAkses('BB'),
        ]);
    })->name('penerimaan.getNomorAkses');
});
Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
});
Route::prefix('team')->group(function () {
    Route::get('/', [TeamController::class, 'index'])->name('team.index');
    Route::post('/', [TeamController::class, 'store'])->name('team.store');

    Route::get('/create', [TeamController::class, 'create'])->name('team.create');

});

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
