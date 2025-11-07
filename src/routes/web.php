<?php
use App\Http\Controllers\RankingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PalabraController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/palabrasRandom', [PalabraController::class, 'indexRandom'])->name('palabras.indexRandom')
        ->middleware(['auth', 'verified']);
//Ruta que verifica si la palabra dada en la ruta existe en la tabla 'palabras' y devuelve json
Route::get('/verificarPalabra/{palabra}', [PalabraController::class, 'verificarPalabra'])
        ->middleware(['auth', 'verified'])
        ->name('palabras.verificarPalabra');

// Ruta que muestra la lista de rankings con otro estilo
// Llama al método 'indexStyled' del mismo controlado
Route::get('/rankingsStyled', [RankingController::class, 'indexStyled'])->name('rankings.indexStyled')
        ->middleware(['auth', 'verified']);
Route::get('/lingo', function () {
    return view('lingo');
})->middleware('auth')->name('lingo');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
