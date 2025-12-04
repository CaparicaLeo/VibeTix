<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return redirect()->route('events.index');
});


// ---------------------------------------------------
// Rotas Públicas (usuário não logado pode ver eventos)
// ---------------------------------------------------

Route::resource('events', EventController::class)
    ->only(['index', 'show']);

Route::resource('events.tickets', TicketController::class)
    ->only(['index', 'show']);


/*
    Rotas para usuários autenticados (CRUD limitado)
*/
Route::middleware(['auth'])
    ->group(function () {

        Route::resource('inscriptions', App\Http\Controllers\InscriptionController::class)
            ->only(['index', 'show', 'store']);
    });
Route::get('/inscriptions/create/{event}', [App\Http\Controllers\InscriptionController::class, 'create'])
    ->middleware('auth')
    ->name('inscriptions.create');  

// ---------------------------------------------------
// Rotas para organizadores (CRUD total)
// ---------------------------------------------------
Route::middleware(['auth', 'organizer'])
    ->prefix('organizer')
    ->name('organizer.')
    ->group(function () {

        Route::resource('events', EventController::class)
            ->except(['index', 'show']);

        Route::resource('events.tickets', TicketController::class)
            ->except(['index', 'show']);

            
    });


// ---------------------------------------------------
// Breeze (Dashboard + profile)
// ---------------------------------------------------

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
