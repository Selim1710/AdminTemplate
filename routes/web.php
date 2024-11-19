<?php

use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\SiteSettingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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


Route::middleware('auth')->group(callback: function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/unauthorized-action', [AdminDashboardController::class, 'unauthorized'])->name('unauthorized.action');
    Route::get('user/my-account/edit', [AdminDashboardController::class, 'my_account_edit'])->name('user.my-account.edit');
    Route::post('my_account_update/{id}', [AdminDashboardController::class, 'my_account_update'])->name('my_account_update');
    
    //Role and User Section
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    //Site Setting
    Route::get('/site-setting', [SiteSettingController::class, 'index'])->name('site.setting');
    Route::post('/site-settings-store-update/{id?}', [SiteSettingController::class, 'createOrUpdate'])->name('site-settings.createOrUpdate');

});

require __DIR__.'/auth.php';
