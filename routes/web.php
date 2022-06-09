<?php
//Admin Controllers
use App\Http\Controllers\AdminController;
//OtherControllers
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientTemplateController;
use App\Http\Controllers\LikeTemplateController;
use App\Http\Controllers\SubTemplateClientController;
// use App\Http\Controllers\SubTemplateController;
use App\Http\Controllers\TemplateController;
use App\Models\Rsvp;
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

Route::get('/category-filter/{id}', [TemplateController::class, 'category_filter'])->name('category-filter');
Route::get('/category', [CategoryController::class, 'category'])->name('category');


Route::middleware(['auth'])->group(function () {
    Route::get('/bookmarks', [BookmarkController::class, 'bookmarks'])->name('bookmarks');
    Route::get('/add-bookmarks/{id}', [BookmarkController::class, 'add_bookmarks'])->name('add-bookmarks');
    Route::get('/delete-bookmarks/{id}', [BookmarkController::class, 'delete_bookmarks'])->name('delete-bookmakrs');
    Route::get('/like-template/{id}', [LikeTemplateController::class, 'like_template'])->name('like-template');


    // when you have selected a template, this route will be available
    // 2:
    Route::get('/template-details/{id}', [TemplateController::class, 'details'])->name('template-details');
    Route::get('/edit-template/{id}', [ClientTemplateController::class, 'edit_template'])->name('edit-template');
    Route::get('/edit-sub-template/{id}', [SubTemplateClientController::class, 'edit_sub_template'])->name('edit-sub-template');
    Route::get('/my-template', [ClientTemplateController::class, 'my_template'])->name('my-template');
    Route::post('/select-template/{id}', [ClientTemplateController::class, 'select_template'])->name('select-template');
    Route::post('/new-layer', [SubTemplateClientController::class, 'new_layer'])->name('new-layer');
    Route::post('/delete-template', [ClientTemplateController::class, 'delete_template'])->name('delete-template');
    Route::post('/in-music', [ClientTemplateController::class, 'in_music'])->name('in-music');
    Route::post('/update-design', [SubTemplateClientController::class, 'update_design'])->name('update-design');
    Route::post('/delete-section', [SubTemplateClientController::class, 'delete_section'])->name('delete-section');
    Route::get('/add-music/{id}', [ClientTemplateController::class, 'add_music'])->name('add-music');
    Route::get('/send-email', [ClientTemplateController::class, 'send_email'])->name('send-email');
    Route::post('/send-bulk-email', [ClientTemplateController::class, 'send_bulk_email'])->name('send-bulk-email');
    Route::get('/responden', [Rsvp::class, 'responden'])->name('responden');



    // Admin Route
    // 3
    Route::get('/create-template', function () {
        return view('add_template');
    })->name('create-template');

    Route::get('/create-category', function () {
        return view('add_category');
    })->name('create-category');

    Route::post('/store-template', [AdminController::class, 'add_template'])->name('store-template');
    Route::post('/store-category', [AdminController::class, 'store_category'])->name('store-category');

    Route::get('/user-list', [AdminController::class, 'user_list'])->name('user-list');


    // Recipient Invitation
    Route::get('/invitation', [ClientTemplateController::class, 'invitation'])->name('invitation');
    Route::get('/fill-rsvp', function () {
        return view('fill_rsvp');
    })->name('fill-rsvp');
    Route::post('/add-rsvp', [Rsvp::class, 'add_rsvp'])->name('add-rsvp');
    Route::get('/download-format', [ClientTemplateController::class, 'download_format'])->name('download-format');

});





require __DIR__ . '/auth.php';
