<?php

use Illuminate\Http\Request;
use App\Models\EventParticipants;
use PHPUnit\Event\EventCollection;
use App\Http\Middleware\AdminCheck;
use App\Http\Middleware\VerifyRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventsController;
use App\Http\Middleware\VerificationEmail;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EventParticipantsController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Menampilkan Halaman Website
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

//Menampilkan Form Perubahan Email Pengguna
Route::get('/change-email', function () {
    return view('auth.register');
})->name('change.email');
// Memproses Perubahan Email Pengguna
Route::put('/change-email', [UsersController::class, 'update'])->name('change.email');
// Menampilkan Form Reset Password
Route::get('/password/reset', function () {
    return view('auth.passwords.email');
})->name('password.email');

// Rute untuk menampilkan halaman verifikasi email
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

// Rute untuk memverifikasi email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Rute untuk mengirim ulang email verifikasi
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Menampilkan Semua Event dan Menampilkan Detail Event
Route::get('Events', [HomeController::class, 'events'])->name('home.events');
Route::get('events', [EventsController::class, 'detailEvent'])->name('event.detail');

Auth::routes();
// Menampilkan detail event
Route::get('/events/preview/{event}', [EventsController::class, 'showPreview'])->name('events.preview');

Route::post('/join', [EventParticipantsController::class, 'store'])->name('join');

// Route yang bisa diakses apabila telah login
Route::middleware('auth')->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/event/{event}/scan', [EventsController::class, 'scanner'])->name('event.scan');

    // Route::get('/verification/{eventParticipan}', [EventParticipantsController::class, 'scan'])->name('participan.verification');
    Route::put('/verification/{eventParticipan}', [EventParticipantsController::class, 'scan'])->name('participan.verification');

    Route::prefix('profile')->group(function () {
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::get('/change-data', [ProfileController::class, 'show'])->name('profileData');
        Route::post('/update-picture/{user}', [UsersController::class, 'updateProfilePicture'])->name('user.update.picture');
        Route::post('/personal-data/{user}', [UsersController::class, 'updatePersonalData'])->name('change-personal-data');
    });

    // Route yang dapat diakses apabila sudah verifikasi 
    // Membatasi akses hanya untuk pengguna yang sudah memverifikasi email
    Route::middleware(VerificationEmail::class)->group(function () {

        Route::prefix('admin/')->middleware(['auth', AdminCheck::class])->group(function () {
            Route::resource('user', UsersController::class);
            Route::resource('eventParticipan', EventParticipantsController::class);
            Route::resource('event', EventsController::class);
        });

        Route::resource('eventParticipan', EventParticipantsController::class);

        Route::resource('event', EventsController::class);
        Route::get('events', [EventsController::class, 'detailEvent'])->name('event.detail');
        Route::get('eventss', [EventsController::class, 'editEvent'])->name('event.edit.preview');

        Route::get('admin/event/{event}/edit', [EventsController::class, 'edit'])->name('event.edit');
        Route::get('/joined', [HomeController::class, 'joined'])->name('joined');
        Route::post('/update-status/{event}', [HomeController::class, 'updateStatus'])->name('update.status');
        Route::get('/events/preview/{event}/edit', [EventsController::class, 'editPreview'])->name('events.preview.edit');
        Route::post('/events/preview/{event}/update', [EventsController::class, 'updatePreview'])->name('events.preview.update');
    });
});

Route::get('/home/logout', [HomeController::class, 'logout'])->name('home.logout');
// kembali ke halaman sebelumnya
Route::any('{query}', function () {
    return redirect()->back();
})->where('query', '.*');
