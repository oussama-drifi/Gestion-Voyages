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

// Client routes
Route::middleware(['auth', 'client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/voyages', [\App\Http\Controllers\Client\ClientVoyageController::class, 'index'])->name('voyages.index');
    Route::get('/voyages/{voyage}', [\App\Http\Controllers\Client\ClientVoyageController::class, 'show'])->name('voyages.show');
    Route::post('/voyages/{voyage}/book', [\App\Http\Controllers\Client\ClientTicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets', [\App\Http\Controllers\Client\ClientTicketController::class, 'index'])->name('tickets.index');
});
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
    Route::get('societes/{societe}/voyages/create', [VoyageController::class, 'create'])->name('societes.voyages.create');
    Route::post('societes/{societe}/voyages', [VoyageController::class, 'store'])->name('societes.voyages.store');
    Route::resource('tickets', TicketController::class)->only(['index', 'show']);
});