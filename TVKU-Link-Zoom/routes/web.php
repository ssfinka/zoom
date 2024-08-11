<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\ManageLinkController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\PeminjamanLinkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanBulananController;
use Illuminate\Support\Facades\Route;

// Routes untuk autentikasi
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login-proses');
Route::get('signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('signup', [AuthController::class, 'signup'])->name('signup-proses');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Routes untuk admin
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('dashboard', [AuthController::class, 'index'])->name('dashboard');
    Route::get('manage-links', [ManageLinkController::class, 'index'])->name('manage-links');
    Route::get('create-link', [ManageLinkController::class, 'create'])->name('create-links');
    Route::post('store-link', [ManageLinkController::class, 'store'])->name('store-link');
    Route::get('edit-link/{id}', [ManageLinkController::class, 'edit'])->name('edit-link');
    Route::put('update-link/{id}', [ManageLinkController::class, 'update'])->name('update-link');
    Route::get('links/{id}', [ManageLinkController::class, 'show'])->name('show-link');
    Route::delete('delete-link/{id}', [ManageLinkController::class, 'destroy'])->name('delete-link');
    Route::get('/riwayat', [PeminjamanLinkController::class, 'riwayat'])->name('riwayat');

    // Routes untuk manajemen FAQ
    Route::get('faq', [FAQController::class, 'indexadmin'])->name('manage-faq');
    Route::get('faq/create', [FAQController::class, 'create'])->name('faq-create');
    Route::post('faq', [FAQController::class, 'store'])->name('faq-store');
    Route::get('faq/{id}/edit', [FAQController::class, 'edit'])->name('faq-edit');
    Route::put('faq/{id}', [FAQController::class, 'update'])->name('faq-update');
    Route::delete('/delete-faq/{id}', [FAQController::class, 'destroyFAQ'])->name('faq-destroy');

    // Routes untuk manajemen pengguna
    Route::get('manage-users', [ManageUserController::class, 'index'])->name('manage-users');
    Route::get('create-user', [ManageUserController::class, 'create'])->name('create-user');
    Route::post('store-user', [ManageUserController::class, 'store'])->name('store-user');
    Route::get('edit-user/{id}', [ManageUserController::class, 'edit'])->name('edit-user');
    Route::put('update-user/{id}', [ManageUserController::class, 'update'])->name('update-user');
    Route::get('users/{id}', [ManageUserController::class, 'show'])->name('show-user');
    Route::delete('delete-user/{id}', [ManageUserController::class, 'destroy'])->name('delete-user');

    Route::put('peminjaman/{id}/update-status', [PeminjamanLinkController::class, 'updateStatus'])->name('peminjaman.updateStatus');
    Route::get('peminjaman/{id}/approve-form', [PeminjamanLinkController::class, 'approveForm'])->name('peminjaman.approveForm');
    Route::put('peminjaman/{id}/approve', [PeminjamanLinkController::class, 'approve'])->name('peminjaman.approve');
    Route::put('peminjaman/{id}/reject', [PeminjamanLinkController::class, 'reject'])->name('peminjaman.reject');
    Route::get('peminjaman/{id}/detail', [PeminjamanLinkController::class, 'detail'])->name('peminjaman.detail');

    // Route untuk laporan bulanan
    Route::get('laporan-bulanan/chart', [LaporanBulananController::class, 'chart'])->name('laporan-bulanan.chart');
    Route::get('laporan-bulanan', [LaporanBulananController::class, 'index'])->name('laporan-bulanan');
});

// Routes untuk user
Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('form-peminjaman', [PeminjamanLinkController::class, 'create'])->name('peminjaman.create');
    Route::post('peminjaman', [PeminjamanLinkController::class, 'store'])->name('peminjaman.store');
    Route::post('peminjaman/selesai/{id}', [PeminjamanLinkController::class, 'markAsCompleted'])->name('peminjaman.selesai');
    Route::get('/peminjaman/feedback/{id}', [PeminjamanLinkController::class, 'feedbackForm'])->name('peminjaman.feedbackForm');
    Route::post('/peminjaman/feedback/{id}', [PeminjamanLinkController::class, 'submitFeedback'])->name('peminjaman.submitFeedback');
    Route::get('faq', [FAQController::class, 'indexuser'])->name('faq');
});
