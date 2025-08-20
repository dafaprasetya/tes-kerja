<?php

use App\Http\Controllers\TopikController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [TopikController::class, 'index'])->name('topik.dashboard');
    Route::get('/tambahtopik', [TopikController::class, 'formAdd'])->name('topik.form');
    Route::get('/tambahdataset', [TopikController::class, 'formAddDataset'])->name('topik.form.dataset');
    Route::get('/listtopik', [TopikController::class, 'topikList'])->name('topik.list');
    Route::get('/topik/{id}', [TopikController::class, 'topikDetail'])->name('topik.detail');
    Route::get('/dataset/{id}/download', [TopikController::class, 'datasetDownload'])->name('dataset.download');
    Route::post('/listtopik/post', [TopikController::class, 'topikAddPost'])->name('topik.form.post');
    Route::post('/topik/{id}/edit', [TopikController::class, 'topikEditPost'])->name('topik.edit.post');
    Route::post('/dataset/{id}/edit', [TopikController::class, 'datasetEditPost'])->name('dataset.edit.post');
    Route::post('/listtopik/dataset/post', [TopikController::class, 'datasetAddPost'])->name('dataset.form.post');
    Route::post('/topik/{id}/delete', [TopikController::class, 'deleteTopik'])->name('topik.delete');
    Route::post('/dateset/{id}/delete', [TopikController::class, 'deleteDataset'])->name('dataset.delete');
});
