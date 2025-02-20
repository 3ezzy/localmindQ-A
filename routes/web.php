<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/questions', function () {
    return view('questions.create');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::get('/tags', [TagsController::class, 'index'])->name('tags.index'); // Afficher tous les tags
Route::get('/tags/create', [TagsController::class, 'create'])->name('tags.create'); // Formulaire d'ajout
Route::post('/tags', [TagsController::class, 'store'])->name('tags.store'); // Ajouter un tag
Route::get('/tags/{tag}', [TagsController::class, 'show'])->name('tags.show'); // Afficher un tag spécifique
Route::get('/tags/{tag}/edit', [TagsController::class, 'edit'])->name('tags.edit'); // Formulaire de modification
Route::put('/tags/{tag}', [TagsController::class, 'update'])->name('tags.update'); // Modifier un tag
Route::delete('/tags/{tag}', [TagsController::class, 'destroy'])->name('tags.destroy'); // Supprimer un tag
});


require __DIR__.'/auth.php';
