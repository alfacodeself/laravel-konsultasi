<?php

use App\Http\Controllers\Admin\Auth\{LoginAdminController, LogoutAdminController};
use App\Http\Controllers\Admin\{DashboardController, ProfileAdminController, PsychologAdminController, QuestionAdminController};
use App\Http\Controllers\User\Auth\{LoginController, LogoutController, RegisterController};
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\User\ProfileUserController;
use App\Http\Controllers\User\PsychologUserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\SessionAdminLoginMiddleware;
use App\Http\Middleware\SessionUserLoginMiddleware;
use Illuminate\Support\Facades\Route;

// ========> Admin Route <=========
Route::get('admin/login', [LoginAdminController::class, 'login'])->name('admin.login');
Route::post('admin/login', [LoginAdminController::class, 'authenticate']);

Route::prefix('admin')->middleware(SessionAdminLoginMiddleware::class)->as('admin.')->group(function(){
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::prefix('psycholog')->as('psycholog.')->group(function(){
        Route::get('/', [PsychologAdminController::class, 'index'])->name('index');
        Route::post('store', [PsychologAdminController::class, 'store'])->name('store');
        Route::put('{psycholog}/update', [PsychologAdminController::class, 'update'])->name('update');
        Route::put('{psycholog}/status', [PsychologAdminController::class, 'status'])->name('status');

        Route::prefix('{psycholog}/question')->as('question.')->group(function(){
            Route::get('/', [QuestionAdminController::class, 'index'])->name('index');
            Route::get('create', [QuestionAdminController::class, 'create'])->name('create');
            Route::post('store', [QuestionAdminController::class, 'store'])->name('store');
            Route::get('{question}/edit', [QuestionAdminController::class, 'edit'])->name('edit');
            Route::put('{question}/update', [QuestionAdminController::class, 'update'])->name('update');
            Route::delete('{question}/delete', [QuestionAdminController::class, 'destroy'])->name('destroy');
        });

    });
    Route::prefix('konsultasi')->as('konsultasi.')->group(function(){
        Route::view('/', 'admin.konsultasi.index')->name('index');
    });
    Route::prefix('pengaturan')->as('pengaturan.')->group(function(){
        Route::prefix('profil')->as('profil.')->group(function(){
            Route::get('/', [ProfileAdminController::class, 'index'])->name('index');
            Route::post('store', [ProfileAdminController::class, 'store'])->name('store');
            Route::post('account', [ProfileAdminController::class, 'setAccount'])->name('account');
        });
    });
    Route::post('logout', LogoutAdminController::class)->name('logout');
});

// ========> Route Client No Auth <============
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('psycholog/{psycholog}', [WelcomeController::class, 'psycholog'])->name('psikologi.index');
Route::get('psycholog/{psycholog}/question', [WelcomeController::class, 'show'])->name('psikologi.show');
Route::post('{psycholog}/store', [WelcomeController::class, 'store'])->name('tes');


// ========> Route User Login <===========
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'authenticate']);
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register', [RegisterController::class, 'register_process']);

Route::prefix('user')->as('user.')->middleware(SessionUserLoginMiddleware::class)->group(function(){
    Route::get('/', DashboardUserController::class)->name('dashboard');
    Route::post('logout', LogoutController::class)->name('logout');

    Route::prefix('psycholog')->as('psycholog.')->group(function(){
        Route::get('/', [PsychologUserController::class, 'index'])->name('index');
        Route::get('{psycholog}/detail', [PsychologUserController::class, 'show'])->name('show');
    });
    Route::prefix('pengaturan')->as('pengaturan.')->group(function(){
        Route::prefix('profil')->as('profil.')->group(function(){
            Route::get('/', [ProfileUserController::class, 'index'])->name('index');
            Route::post('store', [ProfileUserController::class, 'store'])->name('store');
            Route::post('account', [ProfileUserController::class, 'setAccount'])->name('account');
        });
    });
});