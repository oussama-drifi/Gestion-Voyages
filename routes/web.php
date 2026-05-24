<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SocieteController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\VoyageController;
use App\Http\Controllers\TicketController;

// Auth routes
Route::get('/login', [LoginController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'register'])->middleware('guest');

// Protected routes (admin only)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/', function () {
        return view('home', [
            'stats' => [
                'societes' => \App\Models\Societe::count(),
                'agences'  => \App\Models\Agence::count(),
                'buses'    => \App\Models\Bus::count(),
                'voyages'  => \App\Models\Voyage::count(),
                'tickets'  => \App\Models\Ticket::count(),
            ],
        ]);
    })->name('home');

    Route::resource('societes', SocieteController::class)->only(['index', 'show', 'create', 'store']);
    Route::resource('agences', AgenceController::class)->only(['index', 'show', 'create', 'store']);
    Route::resource('buses', BusController::class)->only(['index', 'show', 'create', 'store']);
    Route::resource('voyages', VoyageController::class)->only(['index', 'show']);
    Route::resource('tickets', TicketController::class)->only(['index', 'show']);
});
