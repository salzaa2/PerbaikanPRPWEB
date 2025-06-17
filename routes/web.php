<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenghuniController;

Route::get('/', [PenghuniController::class, 'beranda'])->name('beranda');
Route::get('/index', [PenghuniController::class, 'index'])->name('penghuni.index');
Route::post('/store', [PenghuniController::class, 'store'])->name('penghuni.store');
Route::get('/edit/{id}', [PenghuniController::class, 'edit'])->name('penghuni.edit');
Route::post('/update/{id}', [PenghuniController::class, 'update'])->name('penghuni.update');
Route::delete('/delete/{id}', [PenghuniController::class, 'destroy'])->name('penghuni.destroy');

