<?php

use App\Http\Controllers\LaravelSignPadController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    $nonFilledUpMonitoringSheets = \App\Models\AssignedMonitoringSheet::where('assigned_id', auth()->id())
                                    ->where('is_filled_up', 0)
                                    ->count();

    $filledUpMonitoringSheets = \App\Models\AssignedMonitoringSheet::where('assigned_id', auth()->id())
                                    ->where('is_filled_up', 1)
                                    ->count();

    return view('dashboard', [
        'filled_up_count' => $filledUpMonitoringSheets,
        'non_filled_up_count' => $nonFilledUpMonitoringSheets
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('monitoring-sheets', [PageController::class, 'monitoringSheets'])->name('po.monitoring-sheets');

    Route::get('/{monitoringSheetId}/answer-monitoring-sheet', [PageController::class, 'answer'])->name('po.answer.monitoring-sheet');
    Route::post('/{monitoringSheetId}/submit-answer', [PageController::class, 'submitAnswer'])->name('po.submit-answer.monitoring-sheet');

    Route::post('/creagia/sign-pad', LaravelSignPadController::class)->name('sign-pad::signature');
    Route::get('{monitoringSheetId}/print/{poId}', [PageController::class, 'print'])->name('po.print');
});

require __DIR__.'/auth.php';
