<?php
//Admin Controllers
use App\Http\Controllers\AdminController;
//OtherControllers
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeTemplateController;
use App\Http\Controllers\TemplateController;
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

// available dashboard menu menu when you haven't selected a template
// 1:
Route::get('/', [TemplateController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [TemplateController::class, 'index'])->name('dashboard');
Route::get('/category_filter/{id}', [TemplateController::class, 'category_filter'])->name('category_filter');
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::get('/bookmarks', [BookmarkController::class, 'bookmarks'])->name('bookmarks')->middleware('auth');
Route::get('/add_bookmarks/{id}', [BookmarkController::class, 'add_bookmarks'])->name('add_bookmarks')->middleware('auth');
Route::get('/delete_bookmarks/{id}', [BookmarkController::class, 'delete_bookmarks'])->name('delete_bookmarks')->middleware('auth');
Route::get('/like_template/{id}', [LikeTemplateController::class, 'like_template'])->name('like_template')->middleware('auth');


// Admin Route
// 3:
Route::get('/create_template', function () {
    return view('add_template');
})->middleware('auth');
Route::post('/create_template', [AdminController::class, 'add_template'])->name('create_template')->middleware('auth');
Route::get('/user_list', [AdminController::class, 'user_list'])->name('user_list')->middleware('auth');
Route::get('/add_category', function () {
    return view('add_category');
})->name('add_category')->middleware('auth');
Route::post('/store_category', [AdminController::class, 'store_category'])->name('store_category')->middleware('auth');




// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
