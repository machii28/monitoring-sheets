<?php

use App\Http\Controllers\LaravelSignPadController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QMRController;
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
    return view('auth.login');
});

Route::get('/dashboard', [
    PageController::class, 'dashboard'
])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('monitoring-sheets', [PageController::class, 'monitoringSheets'])->name('po.monitoring-sheets');

    Route::get('/{monitoringSheetId}/answer-monitoring-sheet', [PageController::class, 'answer'])->name('po.answer.monitoring-sheet');
    Route::post('/{monitoringSheetId}/submit-answer', [PageController::class, 'submitAnswer'])->name('po.submit-answer.monitoring-sheet');

    Route::post('/creagia/sign-pad', LaravelSignPadController::class)->name('sign-pad::signature');

    Route::get('fqo', [QMRController::class, 'fqo'])->name('fqo');
    Route::get('pg', [QMRController::class, 'pg'])->name('pg');
    Route::get('rr', [QMRController::class, 'rr'])->name('rr');

    Route::get('/{monitoringSheetId}/approve/{poId}', [PageController::class, 'approve'])->name('po.approve');
    Route::post('/{monitoringSheetId}/approve/{poId}', [PageController::class, 'approveCheckedBy'])->name('po.post.approve');
    Route::get('/questions/{questionId}/delete', [PageController::class, 'deleteTarget'])->name('target.delete');
    Route::post('/question/add', [PageController::class, 'addTarget'])->name('target.add');
});
Route::get('{monitoringSheetId}/print/{poId}', [PageController::class, 'print'])->name('po.print');
Route::post('/{questionId}/update-question', [PageController::class, 'updateQuestion'])->name('po.update-question');

require __DIR__.'/auth.php';
