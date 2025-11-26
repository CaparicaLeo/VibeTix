<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::post('/events', [EventController::class, 'store'])->name('events.store');

Route::post('/events/{event}/tickets', [TicketController::class, 'store'])->name('tickets.store');
Route::get('/events/{event}/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
Route::get('/events/{event}/tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');