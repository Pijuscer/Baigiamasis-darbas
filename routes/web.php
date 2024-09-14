<?php

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/all_users', [CreateNewUser::class, 'index']);
Route::get('/all_users/edit/{id}', [CreateNewUser::class, 'editForm']);
Route::post('/all_users/edit/{id}', [CreateNewUser::class, 'edit']);
Route::get('/all_users/remove/ask/{id}', [CreateNewUser::class, 'removeForm']);
Route::get('/all_users/remove/{id}', [CreateNewUser::class, 'remove']);

Route::get('/add_user_profile', [UserProfileController::class, 'viewForm']);
Route::post('/add_user_profile', [UserProfileController::class, 'store']);

