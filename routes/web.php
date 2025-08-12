<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::controller(DashboardController::class)->group(function () {

   Route::any('/admin-login', 'admin_login')->name('admin.login');
    Route::any('/admin-forget-password', 'admin_forget_password')->name('admin.forget.password');
    Route::get('/admin-reset-password/{id}', 'admin_reset_password')->name('admin.reset.password');
    Route::any('/admin-update-password', 'admin_update_password')->name('admin.forget.update');


    });





 Route::get('/', function () {
     return view('dashboard');
 })->middleware(['auth', 'verified'])->name('dashboard');



//Route::get('/', function () {
//    return view('admin-panel.app');
//})->middleware(['auth', 'verified'])->name('admin-panel');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
