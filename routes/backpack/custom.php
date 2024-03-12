<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('monitoring-sheet', 'MonitoringSheetCrudController');
    Route::crud('monitoring-sheet-category', 'MonitoringSheetCategoryCrudController');
    Route::crud('question', 'QuestionCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('area', 'AreaCrudController');
    Route::crud('process', 'ProcessCrudController');
    Route::crud('process-owner', 'ProcessOwnerCrudController');
    Route::crud('division', 'DivisionCrudController');
    Route::crud('funtional-quality-objectives', 'FuntionalQualityObjectivesCrudController');
    Route::crud('monitoring-sheet-answer', 'MonitoringSheetAnswerCrudController');
    Route::crud('risk-register', 'RiskRegisterCrudController');
    Route::crud('process-goals', 'ProcessGoalsCrudController');
    Route::get('/{monitoringSheetId}/{poId}/monitoring_sheet_preview', 'MonitoringSheetPreviewController@index')->name('page.monitoring_sheet_preview.index');
    Route::get('/{monitoringSheetId}/monitoring_sheet_preview', 'MonitoringSheetPreviewController@preview')->name('page.monitoring_sheet.preview');
    Route::get('send-email', function() {
        \Illuminate\Support\Facades\Mail::to('markcornelio28@gmail.com')->send(new \App\Mail\SendPassword('123456789'));
    });
}); // this should be the absolute last line of this file
