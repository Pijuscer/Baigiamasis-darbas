<?php

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\CampController;
use App\Http\Controllers\CampRezervationController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRezervationController;
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
Route::get('/edit_user_profile/edit/{id}', [UserProfileController::class, 'editForm']);
Route::post('/edit_user_profile/edit/{id}', [UserProfileController::class, 'edit'])->name('my_user_profile.update');

Route::post('/user_profile_verified/{id}', [UserProfileController::class, 'verify_user'])->name('verify_profile');

Route::get('/add_event', [EventController::class, 'viewForm']);
Route::post('/add_event', [EventController::class, 'store']);
Route::get('/all_events', [EventController::class, 'index']);
Route::get('/all_events/edit/{id}', [EventController::class, 'editForm']);
Route::post('/all_events/edit/{id}', [EventController::class, 'edit'])->name('event.update');
Route::get('/all_events/remove/ask/{id}', [EventController::class, 'removeForm']);
Route::get('/all_events/remove/{id}', [EventController::class, 'remove']);

Route::get('/events', [EventController::class, 'eventsAll']);

Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{id}', [EventRezervationController::class, 'store'])->name('events.rezervation');
Route::get('/all_event_reservation', [EventRezervationController::class, 'index'])->name("all_event_reservation");

Route::get('/add_camp', [CampController::class, 'viewForm']);
Route::post('/add_camp', [CampController::class, 'store']);
Route::get('/all_camps', [CampController::class, 'index']);
Route::get('/all_camps/edit/{id}', [CampController::class, 'editForm']);
Route::post('/all_camps/edit/{id}', [CampController::class, 'edit'])->name('camp.update');
Route::get('/all_camps/remove/ask/{id}', [CampController::class, 'removeForm']);
Route::get('/all_camps/remove/{id}', [CampController::class, 'remove']);

Route::get('/camps', [CampController::class, 'campsAll']);

Route::get('/camps/{id}', [CampController::class, 'show'])->name('camps.show');
Route::post('/camps/{id}', [CampRezervationController::class, 'store'])->name('camps.rezervation');
Route::get('/all_camp_reservation', [CampRezervationController::class, 'index'])->name("all_camp_reservation");