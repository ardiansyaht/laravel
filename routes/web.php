<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
Route::get('/', [PostController::class, 'index']);

Route::resource('/posts', PostController::class);


//route halaman statis

Route::get('/view{code}', [PostController::class, 'view'])->name('posts.view');
Route::get('/edit/{code}', [PostController::class, 'edit'])->name('posts.edit');
Route::get('/login', [PostController::class, 'login'])->name('posts.login');
Route::get('/add', [PostController::class, 'add'])->name('posts.add');
Route::get('/pdf', [PostController::class, 'generatePDF'])->name('posts.pdf');
