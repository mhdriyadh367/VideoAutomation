<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VideoController;

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

Route::get('/', function () {
    return view('login.index');
});




// login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// logout
Route::post('/logout', [LoginController::class, 'logout']);

// register
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);


// dashboard

Route::get('/dashboard', function(){
    return view('dashboard.index');
})->middleware('auth');


Route::prefix('video')->group(function() {
    Route::get('/', [VideoController::class, 'index'])->name('video.index');
    Route::post('/', [VideoController::class, 'store'])->name('video.store');
    Route::post('/video', [VideoController::class, 'store_video'])->name('video.store.video');
    Route::get('/{id}', [VideoController::class, 'show'])->name('video.show');
    // Route::delete('/{id}', [VideoController::class, 'destroy'])->name('video.destroy');


    Route::post('/coba/dulu', [VideoController::class, 'coba'])->name('video.coba');
    Route::post('/coba/gabung', [VideoController::class, 'merge_video'])->name('video.gabung');


    Route::get('/coba/gabung/lagi', [VideoController::class, 'merge_video_coba'])->name('video.gabung.coba');
});

