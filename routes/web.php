<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\AdvertisementsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MultimediaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
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

Route::group(['middleware' => 'auth'], function () {
    Route::resource('category', CategoryController::class);
    Route::resource('news', NewsController::class);
    Route::resource('multimedia', MultimediaController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('advertisements', AdvertisementController::class);
    Route::resource('user', UserController::class);
    Route::resource('subscriber', SubscriberController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('roles', RoleController::class);

    // Header Avertisement
    Route::get('/headerindex', [AdvertisementsController::class, 'headerindex'])->name('headerindex');
    Route::get('/createheader', [AdvertisementsController::class, 'createheader'])->name('createheader');
    Route::post('/saveheader', [AdvertisementsController::class, 'saveheader'])->name('saveheader');
    Route::get('/editheader/{id}', [AdvertisementsController::class, 'editheader'])->name('editheader');
    Route::put('/updateheader/{id}', [AdvertisementsController::class, 'updateheader'])->name('updateheader');
    Route::delete('/deleteheader/{id}', [AdvertisementsController::class, 'deleteheader'])->name('deleteheader');

    // Sidebar Avertisement
    Route::get('/sidebarindex', [AdvertisementsController::class, 'sidebarindex'])->name('sidebarindex');
    Route::get('/createsidebar', [AdvertisementsController::class, 'createsidebar'])->name('createsidebar');
    Route::post('/savesidebar', [AdvertisementsController::class, 'savesidebar'])->name('savesidebar');
    Route::get('/editsidebar/{id}', [AdvertisementsController::class, 'editsidebar'])->name('editsidebar');
    Route::put('/updatesidebar/{id}', [AdvertisementsController::class, 'updatesidebar'])->name('updatesidebar');
    Route::delete('/deletesidebar/{id}', [AdvertisementsController::class, 'deletesidebar'])->name('deletesidebar');

    // Bottom Avertisement
    Route::get('/bottomindex', [AdvertisementsController::class, 'bottomindex'])->name('bottomindex');
    Route::get('/createbottom', [AdvertisementsController::class, 'createbottom'])->name('createbottom');
    Route::post('/savebottom', [AdvertisementsController::class, 'savebottom'])->name('savebottom');
    Route::get('/editbottom/{id}', [AdvertisementsController::class, 'editbottom'])->name('editbottom');
    Route::put('/updatebottom/{id}', [AdvertisementsController::class, 'updatebottom'])->name('updatebottom');
    Route::delete('/deletebottom/{id}', [AdvertisementsController::class, 'deletebottom'])->name('deletebottom');
});


Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/aboutus', [FrontController::class, 'aboutus'])->name('aboutus');
Route::get('/search', [FrontController::class, 'pageSearch'])->name('page.search');
Route::get('/registerSubscriber', [FrontController::class, 'registerSubscriber'])->name('register.subscriber');
Route::get('/confirm', [FrontController::class, 'confirmSubscribtion'])->name('confirm.subscribtion');
Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{slug}', [FrontController::class, 'pageCategory'])->name('page.category');
Route::get('/author/{name}', [FrontController::class, 'pageAuthor'])->name('page.author');
Route::get('/tags/{tag}', [FrontController::class, 'pageTag'])->name('page.tag');
Route::get('/{categoryslug}/{slug}', [FrontController::class, 'pageNews'])->name('page.news');
