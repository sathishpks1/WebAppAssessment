<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ContactController;

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
    return redirect()->route('list-people');
});

Route::get('/people-list', [PersonController::class, 'listPeople'])->name('list-people');
Route::get('/add-person', [PersonController::class, 'addPersonForm'])->name('add-person');
Route::post('/add-person', [PersonController::class, 'addPerson']);
Route::get('/people/{person}/edit', [PersonController::class, 'edit'])->name('people.edit');
Route::put('/people/{person}', [PersonController::class, 'update'])->name('people.update');
Route::get('/people/{person}', [PersonController::class, 'view'])->name('people.view');
Route::delete('/people/{person}', [PersonController::class, 'delete'])->name('people.delete');
Route::get('/people/{person}/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/people/{person}/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/people/{person}/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
Route::put('/people/{person}/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
Route::delete('/people/{person}/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');



Route::get('/countrycode', [CountryController::class, 'fetchCountries']);
