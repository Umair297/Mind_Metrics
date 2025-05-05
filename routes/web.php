<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ServiceDocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchoolController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


Route::get('/assessments', [AssessmentController::class, 'index'])->name('assessments.index');
Route::get('/assessments/create', [AssessmentController::class, 'create'])->name('assessments.create');
Route::post('/assessments', [AssessmentController::class, 'store'])->name('assessments.store');
Route::get('/assessment/{id}/show', [AssessmentController::class, 'show'])->name('assessments.show');
Route::get('/assessments/{id}/edit', [AssessmentController::class, 'edit'])->name('assessments.edit');
Route::put('/assessments/{id}', [AssessmentController::class, 'update'])->name('assessments.update');
Route::delete('/assessments/{id}', [AssessmentController::class, 'destroy'])->name('assessments.destroy');
Route::put('/assessments/{assessment}/set-school', [AssessmentController::class, 'setSchool'])->name('assessments.setSchool');


Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
Route::get('/services/{id}/show', action: [ServiceController::class, 'show'])->name('services.show');
Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

Route::get('assessments/documents/{assessment_id}', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/documents/create', action: [DocumentController::class, 'create'])->name('documents.create');
Route::post('/documents/store', [DocumentController::class, 'store'])->name('documents.store');
Route::get('/documents/edit/{id}', [DocumentController::class, 'edit'])->name('documents.edit');
Route::put('/documents/update/{id}', [DocumentController::class, 'update'])->name('documents.update');
Route::delete('/documents/delete/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy');
Route::post('/documents/multi', [DocumentController::class, 'storeMulti'])->name('documents.store.multi');


Route::get('services/documents/{service_id}', [ServiceDocumentController::class, 'index'])->name('service_documents.index');
Route::get('/service_documents/create', action: [ServiceDocumentController::class, 'create'])->name('service_documents.create');
Route::post('/service_documents/store', [ServiceDocumentController::class, 'store'])->name('service_documents.store');
Route::get('/service_documents/edit/{id}', [ServiceDocumentController::class, 'edit'])->name('service_documents.edit');
Route::put('/service_documents/update/{id}', [ServiceDocumentController::class, 'update'])->name('service_documents.update');
Route::delete('/service_documents/delete/{id}', [ServiceDocumentController::class, 'destroy'])->name('service_documents.destroy');
Route::post('/service_documents/multi', [ServiceDocumentController::class, 'storeMulti'])->name('service_documents.store.multi');


Route::get('/calendar-data', [DashboardController::class, 'calendarData'])->name('calendar.data');



Route::get('/schools', [SchoolController::class, 'index'])->name('schools.index');
Route::get('/schools/create', [SchoolController::class, 'create'])->name('schools.create');
Route::post('/schools/store', [SchoolController::class, 'store'])->name('schools.store');
Route::get('/schools/edit/{id}', [SchoolController::class, 'edit'])->name('schools.edit');
Route::put('/schools/update/{id}', [SchoolController::class, 'update'])->name('schools.update');
Route::delete('/schools/delete/{id}', [SchoolController::class, 'destroy'])->name('schools.destroy');
