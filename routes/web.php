<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\IndexController;
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
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{item}', [CatalogController::class, 'show'])->name('catalog.show');
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/news', [NewsController::class, 'index'])->name('news');

Route::get('/news/{post}', [NewsController::class, 'show'])->name('news.show');
Route::get('/news/{post}/edit', [NewsController::class, 'edit'])->name('news.edit');
Route::patch('/news/{post}', [NewsController::class, 'update'])->name('news.update');
Route::delete('/news/{post}', [NewsController::class, 'delete'])->name('news.delete');
/*Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});*/
Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::post('/dashboard', [AdminController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
