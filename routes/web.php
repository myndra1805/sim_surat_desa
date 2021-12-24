<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SuratController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['role:admin', 'auth']], function () {
    Route::prefix('/admin')->group(function(){
        Route::get('/dashboard', [AdminController::class, 'dashboard']);
        Route::get('/masyarakat', [AdminController::class, 'masyarakat']);
        Route::get('/surat', [AdminController::class, 'surat']);
        Route::get('/about', [AdminController::class, 'about']);
        Route::get('/profile', [AdminController::class, 'profile']);
        Route::post('/profile', [AdminController::class, 'updateProfile']);
    });
});

Route::group(['middleware' => ['role:user', 'auth']], function () {
    Route::prefix('/user')->group(function(){
        Route::get('/dashboard', [PagesController::class, 'dashboard']);
        Route::get('/surat', [PagesController::class, 'surat']);
        Route::get('/about', [AdminController::class, 'about']);
        Route::get('/profile', [PagesController::class, 'profile']);
        Route::post('/profile', [PagesController::class, 'updateprofile']);
    });
});

Route::group(['middleware' => ['role:admin', 'auth']], function () {
    Route::prefix('/masyarakat')->group(function(){
        Route::get('/read', [MasyarakatController::class, 'read']);
        Route::get('/update/{id}', [MasyarakatController::class, 'showUpdate']);
        Route::delete('/delete', [MasyarakatController::class, 'delete']);
        Route::put('/update', [MasyarakatController::class, 'update']);
    });
});

Route::group(['middleware' => ['role:user', 'auth']], function () {
    Route::prefix('/surat')->group(function(){
        Route::get('/read', [SuratController::class, 'read']);
        Route::get('/create', [SuratController::class, 'showCreate']);
        Route::get('/download-surat/{id}', [SuratController::class, 'downloadSurat']);
        Route::post('/create', [SuratController::class, 'create']);
    });
});

Route::group(['middleware' => ['role:admin', 'auth']], function () {
    Route::prefix('/surat')->group(function(){
        Route::get('/read-admin', [SuratController::class, 'readAdmin']);
        Route::get('/export', [SuratController::class, 'export']);
        Route::post('/accepted', [SuratController::class, 'accepted']);
        Route::post('/rejected', [SuratController::class, 'rejected']);
    });
});

require __DIR__ . '/auth.php';
