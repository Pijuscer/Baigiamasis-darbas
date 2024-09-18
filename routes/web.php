<?php

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\EventController;
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
Route::get('/all_user_profile', [UserProfileController::class, 'index']);
Route::get('/my_user_profile', [UserProfileController::class, 'index2']);

Route::get('/add_event', [EventController::class, 'viewForm']);
Route::post('/add_event', [EventController::class, 'store']);

