<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/catalogo', \App\Livewire\PublicCatalog::class)->name('catalog.index');
Route::get('/hallazgo/{id}', \App\Livewire\PublicShow::class)->name('discovery.public');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Nueva ruta para manejo de usuarios
    Route::get('/usuarios', function () {
        return view('admin.users');
    })->name('admin.users');

    Route::get('/bitacora/nueva', function () {
    // Si queremos obligar a que solo usuarios verificados entren:
    if (!auth()->user()->is_verified && auth()->user()->role === 'archaeologist') {
        abort(403, 'Tu cuenta aún está pendiente de verificación.');
    }
    return view('archaeologist.create-log');
})->name('log.create');


Route::get('/explorar', function () {
    return view('logs.index');
})->middleware(['auth'])->name('logs.index');

Route::get('/bitacora/{site}', \App\Livewire\Logs\LogShow::class)->name('logs.show');
Route::get('/exportar-pdf/{site}', [App\Http\Controllers\LogExportController::class, 'export'])->name('report.pdf');
Route::get('/bitacora/{site}/editar', \App\Livewire\Logs\LogEdit::class)->name('logs.edit');




});

Route::get('/contacto', function () {
    return view('contact');
})->name('contacto');

require __DIR__.'/auth.php';
