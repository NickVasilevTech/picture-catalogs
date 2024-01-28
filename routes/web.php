<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\WebController;
use Illuminate\Foundation\Application;
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

Route::get('/', [WebController::class, 'home'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'view'])->name('profile.view');

    Route::get('picture/view', [PictureController::class, 'view'])->name('picture.view');
    Route::post('picture/comment', [PictureController::class, 'leaveComment'])->name('picture.comment');
    Route::post('picture/upload', [PictureController::class, 'pictureUploadPost'])->name('picture.upload.post');

    Route::get('catalog/view', [CatalogController::class, 'view'])->name('catalog.view');
    Route::post('catalog/create', [CatalogController::class, 'create'])->name('catalog.create');
    Route::post('catalog/add-picture', [CatalogController::class, 'addPictureToCatalog'])->name('catalog.add-picture');
});

require __DIR__.'/auth.php';
