<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MultimediaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'roles'], 'roles' => ['admin']], function () {
    Route::resource('category', CategoryController::class);
    Route::resource('news', NewsController::class);
    Route::resource('multimedia', MultimediaController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('advertisements', AdvertisementController::class);
    Route::resource('user', UserController::class);
    Route::resource('subscriber', SubscriberController::class);
});


Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/aboutus', [FrontController::class, 'aboutus'])->name('aboutus');
Route::get('/search', [FrontController::class, 'pageSearch'])->name('page.search');
Route::get('/registerSubscriber', [FrontController::class, 'registerSubscriber'])->name('register.subscriber');
Route::get('/confirm',[FrontController::class, 'confirmSubscribtion'])->name('confirm.subscribtion');
Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{slug}', [FrontController::class, 'pageCategory'])->name('page.category');
Route::get('/author/{name}', [FrontController::class, 'pageAuthor'])->name('page.author');
Route::get('/tags/{tag}', [FrontController::class, 'pageTag'])->name('page.tag');
Route::get('/{categoryslug}/{slug}', [FrontController::class, 'pageNews'])->name('page.news');

