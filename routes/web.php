<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceAppointmentController;
use Illuminate\Support\Facades\Route;

// Strefa Publiczna
Route::get('/', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');
Route::post('/cars/{car}/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');

// Strefa Zalogowanych
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Opinii i Warsztat (kliet dodaje, klient usuwa)
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    Route::post('/appointments', [ServiceAppointmentController::class, 'store'])->name('appointments.store');
    Route::delete('/appointments/{appointment}', [ServiceAppointmentController::class, 'destroy'])->name('appointments.destroy');

    // AKTUALIZACJA WARSZTATU TYLKO DLA ADMINA WARSZTATU (Student 3)
    Route::put('/appointments/{appointment}', [ServiceAppointmentController::class, 'update'])
        ->name('appointments.update')
        ->middleware('can:admin_repairs');

    // ==== STUDENT 1 (Flota i CRM) ====
    Route::middleware(['can:admin_cars'])->group(function () {
        Route::get('/admin/cars/create', [CarController::class, 'create'])->name('cars.create');
        Route::post('/admin/cars', [CarController::class, 'store'])->name('cars.store');
        Route::get('/admin/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
        Route::put('/admin/cars/{car}', [CarController::class, 'update'])->name('cars.update');
        Route::delete('/admin/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');

        Route::get('/admin/cars/{car}/inspections/create', [InspectionController::class, 'create'])->name('inspections.create');
        Route::post('/admin/cars/{car}/inspections', [InspectionController::class, 'store'])->name('inspections.store');
        Route::get('/admin/cars/{car}/repairs/create', [RepairController::class, 'create'])->name('repairs.create');
        Route::post('/admin/cars/{car}/repairs', [RepairController::class, 'store'])->name('repairs.store');

        Route::get('/admin/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
        Route::patch('/admin/inquiries/{inquiry}/status', [InquiryController::class, 'updateStatus'])->name('inquiries.updateStatus');
    });

    // ==== STUDENT 2 (Konta i ACL) ====
    Route::middleware(['can:admin_reviews'])->group(function () {
        Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
        Route::patch('/admin/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
        Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
