<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', function (): RedirectResponse {
    return redirect()->route(auth()->check() ? 'dashboard' : 'login');
})->name('home');

Route::middleware(['auth', 'can:dashboard.view'])->group(function (): void {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
});
