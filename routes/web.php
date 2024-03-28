<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/in', function () {
    return view('page.login');
});
Route::get('/up', function () {
    return view('page.register');
});
Route::get('/re', function () {
    return view('page.recovery');
});
Route::get('/res', function () {
    return view('page.reset');
});
Route::get('/ve', function () {
    return view('page.verification');
});
Route::get('/admin', function () {
    return view('page.dashboard');
});

Route::get('/writer', function () {
    return view('wt');
})->middleware('auth', 'role:admin,writer,user');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// penggunaan middleware bisa pada controller
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__ . '/auth.php';
