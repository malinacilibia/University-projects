<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SuccessStoryController;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return redirect('/members');
});
// Ruta pentru descărcarea CSV-ului membrilor
Route::get('/members/download-csv', [MemberController::class, 'downloadCsv'])->name('members.download.csv');
// Această rută permite descărcarea listei membrilor în format CSV.
// Este conectată la metoda `downloadCsv` din `MemberController`.

// Resource pentru membri (CRUD complet)
Route::resource('members', MemberController::class);
// Creează automat rute pentru operațiile CRUD:
// - GET /members -> index()
// - GET /members/create -> create()
// - POST /members -> store()
// - GET /members/{member} -> show()
// - GET /members/{member}/edit -> edit()
// - PUT /members/{member} -> update()
// - DELETE /members/{member} -> destroy()

// Grup de rute pentru povești de succes (success stories) asociate unui membru
Route::prefix('members/{member}/success-stories')->group(function () {
    // Afișează toate poveștile de succes pentru un membru
    Route::get('/', [SuccessStoryController::class, 'index'])->name('success_stories.index');

    // Formular pentru crearea unei povești de succes
    Route::get('/create', [SuccessStoryController::class, 'create'])->name('success_stories.create');

    // Salvează o nouă poveste de succes
    Route::post('/', [SuccessStoryController::class, 'store'])->name('success_stories.store');

    // Formular pentru editarea unei povești de succes existente
    Route::get('/{success_story}/edit', [SuccessStoryController::class, 'edit'])->name('success_stories.edit');

    // Actualizează o poveste de succes existentă
    Route::put('/{success_story}', [SuccessStoryController::class, 'update'])->name('success_stories.update');

    // Șterge o poveste de succes existentă
    Route::delete('/{success_story}', [SuccessStoryController::class, 'destroy'])->name('success_stories.destroy');
});
// Rutele din acest grup sunt prefixate cu `members/{member}/success-stories`.
// Fiecare poveste de succes este asociată unui membru prin ID-ul acestuia.

// Resource pentru evenimente (CRUD complet)
Route::resource('events', EventController::class);
// Creează automat rute pentru operațiile CRUD:
// - GET /events -> index()
// - GET /events/create -> create()
// - POST /events -> store()
// - GET /events/{event} -> show()
// - GET /events/{event}/edit -> edit()
// - PUT /events/{event} -> update()
// - DELETE /events/{event} -> destroy()
