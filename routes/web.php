<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\AnswersController;
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



// Display a list of questions
Route::get('/dashboard', [QuestionsController::class, 'index'])->name('questions.index');

// Show the form to create a new question
Route::get('/questions/create', [QuestionsController::class, 'create'])->name('questions.create');

// Store a new question in the database
Route::post('/questions', [QuestionsController::class, 'store'])->name('questions.store');

// Show a specific question
Route::get('/questions/{id}', [QuestionsController::class, 'show'])->name('questions.show');

// Show the form to edit an existing question
Route::get('/questions/{id}/edit', [QuestionsController::class, 'edit'])->name('questions.edit');

// Update an existing question
Route::put('/questions/{id}', [QuestionsController::class, 'update'])->name('questions.update');

// Delete a question
Route::delete('/questions/{id}', [QuestionsController::class, 'destroy'])->name('questions.destroy');



// Display a list of answers (all answers)
Route::get('/answers', [AnswersController::class, 'index'])->name('answers.index');

// Show the form to create a new answer
Route::get('/questions/{question}/answers', [AnswersController::class, 'create'])->name('answers.create');

// Store a new answer
Route::post('/answers', [AnswersController::class, 'store'])->name('answers.store');

// Show a specific answer
Route::get('/answers/{id}', [AnswersController::class, 'show'])->name('answers.show');

// Show the form to edit an existing answer
Route::get('/answers/{id}/edit', [AnswersController::class, 'edit'])->name('answers.edit');

// Update an existing answer
Route::put('/answers/{id}', [AnswersController::class, 'update'])->name('answers.update');

// Delete an answer
Route::delete('/answers/{id}', [AnswersController::class, 'destroy'])->name('answers.destroy');

});


require __DIR__.'/auth.php';
