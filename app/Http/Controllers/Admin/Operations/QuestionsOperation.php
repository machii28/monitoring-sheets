<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Models\MonitoringSheet;
use App\Models\Question;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Prologue\Alerts\Facades\Alert;

trait QuestionsOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupQuestionsRoutes($segment, $routeName, $controller)
    {
        Route::get($segment . '/{monitoringSheetId}/questions', [
            'as' => $routeName . '.questions',
            'uses' => $controller . '@questions',
            'operation' => 'questions',
        ]);

        Route::post($segment . '/{monitoringSheetId}/add-question', [
            'as' => $routeName . '.add-question',
            'uses' => $controller . '@add',
            'operation' => 'questions'
        ]);

        Route::post($segment . '/{questionId}/remove-question', [
            'as' => $routeName . '.remove-question',
            'uses' => $controller . '@remove',
            'operation' => 'questions'
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupQuestionsDefaults()
    {
        CRUD::allowAccess('questions');

        CRUD::operation('questions', function () {
            CRUD::loadDefaultOperationSettingsFromConfig();
        });

        CRUD::operation('list', function () {
            // CRUD::addButton('top', 'questions', 'view', 'crud::buttons.questions');
            CRUD::addButton('line', 'questions', 'view', 'crud::buttons.questions');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function questions($monitoringSheetId)
    {
        CRUD::hasAccessOrFail('questions');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = CRUD::getTitle() ?? 'Questions ' . $this->crud->entity_name;
        $this->data['monitoringSheetId'] = $monitoringSheetId;
        $this->data['questions'] = MonitoringSheet::find($monitoringSheetId)->questions;

        // load the view
        return view('crud::operations.questions', $this->data);
    }

    public function add($monitoringSheetId, Request $request)
    {
        $question = new Question();
        $question->question = $request->get('question');
        $question->monitoring_sheet_id = $monitoringSheetId;
        $question->save();

        Alert::success('<strong>Success !</strong> Question is added')->flash();

        return Redirect::back();
    }

    public function remove($questionId)
    {
        $question = Question::find($questionId);
        $question->delete();

        Alert::success('<strong>Success !</strong> Question is removed')->flash();

        return Redirect::back();
    }
}
