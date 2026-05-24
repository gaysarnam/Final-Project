<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminController;
use App\Models\Feedback;
use App\Models\MenuCategory;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GoogleController;

/***********************
 * Google OAuth Routes *
 ***********************/

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']); 

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (Auth::check()) {
        return (Auth::user()->usertype == '1') ? redirect()->route('admin.dashboard') : redirect()->route('dashboard');
    }
    $feedbacks = Feedback::latest()->take(10)->get();
    return view('welcome', compact('feedbacks'));
})->middleware('prevent-back');

Route::get('/spa', function () {
    $categories = \App\Models\SpaCategory::with('services')->get();
    return view('spa', compact('categories'));
})->name('spa')->middleware('prevent-back');

Route::get('/lodging', function () {
    $rooms = \App\Models\Room::all();
    return view('lodging', compact('rooms'));
})->name('lodging')->middleware('prevent-back');

Route::get('/contact', function () { return view('contact'); })->name('contact')->middleware('prevent-back');

Route::get('/restaurant', function () {
    $categories = \App\Models\MenuCategory::with('restaurantMenus')->get();
    $tables = \App\Models\RestaurantTable::all();
    return view('restaurant', compact('categories', 'tables'));
})->name('restaurant')->middleware('prevent-back');

/*
|--------------------------------------------------------------------------
| OTP Password Reset Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['prevent-back'])->group(function () {
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showEmailForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOTP'])->name('otp.send');
    Route::get('/verify-otp', [ForgotPasswordController::class, 'showOTPForm'])->name('otp.verify');
    Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOTP'])->name('otp.check');
    Route::get('/reset-password-now', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.custom');
    Route::post('/reset-password-now', [ForgotPasswordController::class, 'resetPassword'])->name('password.update.custom');
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'prevent-back'])->group(function () {
    
    // Booking: Create new booking
    Route::post('/book-service', [BookingController::class, 'store'])->name('book.service');
    
    // Edit & Update Bookings
    Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
    Route::put('/booking/{id}/update', [BookingController::class, 'update'])->name('booking.update');
    
    // User cancellation endpoint (AJAX)
    Route::post('/booking/{id}/cancel', [BookingController::class, 'cancelUserBooking'])->name('booking.cancel');
    
    // Dashboard & Profile
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/my-profile', [ProfileController::class, 'show'])->name('custom.profile.show');
    Route::get('/my-profile/edit', [ProfileController::class, 'edit'])->name('custom.profile.edit');
    Route::put('/my-profile/update', [ProfileController::class, 'update'])->name('custom.profile.update');
    
    // Feedback
    Route::post('/feedback/submit', [FeedbackController::class, 'store'])->name('feedback.store');
    
    // User Dashboard
    Route::get('/dashboard', function () {
        $feedbacks = Feedback::latest()->take(10)->get();
        return view('dashboard', compact('feedbacks'));
    })->name('dashboard');

    // My Bookings Route
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('my.bookings');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin', 'prevent-back'])->prefix('admin')->group(function () {
    
    Route::get('/dashboard', function () {
        $feedbacks = App\Models\Feedback::latest()->take(10)->get();
        $totalBookings = App\Models\Booking::count();
        return view('admin.index', compact('feedbacks', 'totalBookings')); 
    })->name('admin.dashboard');

    Route::get('/bookings', [BookingController::class, 'index'])->name('admin.bookings');
    Route::put('/bookings/{id}', [BookingController::class, 'updateStatus'])->name('admin.bookings.update');

    Route::get('/users', [AdminController::class, 'userIndex'])->name('admin.users');
    Route::post('/users/{id}/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.users.status');
    Route::post('/users/{id}/promote', [AdminController::class, 'promoteUser'])->name('admin.users.promote');

    Route::get('/feedback', [AdminController::class, 'feedbackIndex'])->name('admin.feedback');
    Route::delete('/feedback/{id}', [AdminController::class, 'deleteFeedback'])->name('admin.feedback.delete');

    Route::get('/menu', [AdminController::class, 'menuIndex'])->name('admin.menu');
    Route::post('/menu/store', [AdminController::class, 'storeMenu'])->name('admin.menu.store');
    Route::put('/menu/update/{id}', [AdminController::class, 'updateMenu'])->name('admin.menu.update');
    Route::delete('/menu/{id}', [AdminController::class, 'deleteMenu'])->name('admin.menu.delete');
    Route::post('/menu/category', [AdminController::class, 'storeCategory'])->name('admin.category.store');
    Route::delete('/menu/category/{id}', [AdminController::class, 'deleteCategory'])->name('admin.category.delete');
    Route::put('/menu/category/{id}', [AdminController::class, 'updateCategory'])->name('admin.category.update');

    Route::post('/table/store', [AdminController::class, 'storeTable'])->name('admin.table.store');
    Route::put('/table/update/{id}', [AdminController::class, 'updateTable'])->name('admin.table.update');
    Route::delete('/table/delete/{id}', [AdminController::class, 'deleteTable'])->name('admin.table.delete');

    Route::get('/rooms', [AdminController::class, 'roomIndex'])->name('admin.rooms');
    Route::post('/rooms/store', [AdminController::class, 'storeRoom'])->name('admin.rooms.store');
    Route::put('/rooms/update/{id}', [AdminController::class, 'updateRoom'])->name('admin.rooms.update');
    Route::post('/rooms/toggle/{id}', [AdminController::class, 'toggleRoomStatus'])->name('admin.rooms.toggle');
    Route::delete('/rooms/delete/{id}', [AdminController::class, 'deleteRoom'])->name('admin.rooms.delete');

    Route::get('/spa-services', [AdminController::class, 'spaIndex'])->name('admin.spa');
    Route::post('/spa/category', [AdminController::class, 'storeSpaCategory'])->name('admin.spa.category.store');
    Route::delete('/spa/category/{id}', [AdminController::class, 'deleteSpaCategory'])->name('admin.spa.category.delete');
    Route::post('/spa/service', [AdminController::class, 'storeSpaService'])->name('admin.spa.service.store');
    Route::post('/spa/package', [AdminController::class, 'storeSpaPackage'])->name('admin.spa.package.store');
    Route::put('/spa/service/{id}', [AdminController::class, 'updateSpaService'])->name('admin.spa.service.update');
    Route::delete('/spa/service/{id}', [AdminController::class, 'deleteSpaService'])->name('admin.spa.service.delete');
});

Route::redirect('/user/profile', '/my-profile');