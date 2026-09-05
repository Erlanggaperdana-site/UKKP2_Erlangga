<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, DashboardController, PengaduanController, ProfileController, UserController};

Route::redirect('/', '/login');
Route::middleware('guest')->group(function () { Route::get('/login',[AuthController::class,'showLogin'])->name('login'); Route::post('/login',[AuthController::class,'login'])->name('login.attempt'); Route::get('/register',[AuthController::class,'showRegister'])->name('register'); Route::post('/register',[AuthController::class,'register'])->name('register.store'); });
Route::middleware('auth')->group(function () {
 Route::post('/logout',[AuthController::class,'logout'])->name('logout'); Route::get('/dashboard',DashboardController::class)->name('dashboard');
 Route::get('/profile',[ProfileController::class,'show'])->name('profile.show'); Route::get('/profile/edit',[ProfileController::class,'edit'])->name('profile.edit'); Route::put('/profile',[ProfileController::class,'update'])->name('profile.update'); Route::get('/profile/password',[ProfileController::class,'password'])->name('profile.password'); Route::put('/profile/password',[ProfileController::class,'updatePassword'])->name('profile.password.update');
 Route::middleware('role:admin,petugas')->resource('users',UserController::class);
 Route::get('/pengaduans/create', [PengaduanController::class, 'create'])->name('pengaduans.create');
 Route::post('/pengaduans', [PengaduanController::class, 'store'])->name('pengaduans.store');
 Route::resource('pengaduans', PengaduanController::class)
     ->except(['create', 'store'])
     ->parameters(['pengaduans' => 'pengaduan']);
});
