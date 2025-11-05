<?php
use App\Http\Controllers\RankingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Ruta que muestra la lista de rankings (vista normal)
// Llama al método 'index' del controlador RankingController
Route::get('/rankings', [RankingController::class, 'index'])->name('rankings.index');

// Ruta que muestra la lista de rankings con otro estilo
// Llama al método 'indexStyled' del mismo controlado
Route::get('/rankingsStyled', [RankingController::class, 'indexStyled'])->name('rankings.indexStyled');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
