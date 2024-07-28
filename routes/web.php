<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Rute halaman utama yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/home', [PostController::class, 'index'])->name('home');
    Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');
    Route::get('/view{code}', [PostController::class, 'view'])->name('posts.view');
    Route::get('/edit/{code}', [PostController::class, 'edit'])->name('posts.edit');
    Route::get('/add', [PostController::class, 'add'])->name('posts.add');
    Route::get('/pdf', [PostController::class, 'generatePDF'])->name('posts.pdf');
    // Redirect jika user sudah login ke home
    Route::get('/', function () {
        return redirect()->route('home');
    });
});

// Rute untuk tamu (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/register', [ProfileController::class, 'registerForm'])->name("profile.register");
    Route::post('/register', [ProfileController::class, 'register'])->name("profile.register.post");
    Route::get('/login', [ProfileController::class, 'loginform'])->name("login");
    Route::post('/login', [ProfileController::class, 'login'])->name("login.post");
});

// Rute resource untuk posts tanpa middleware
Route::resource('/posts', PostController::class);
