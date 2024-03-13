<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Models\AssignedMonitoringSheet;
use App\Models\User;
use App\Notifications\FormAssignedNotification;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Prologue\Alerts\Facades\Alert;

trait AssignProcessOwnerOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupAssignProcessOwnerRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/{monitoringSheetId}/assign-process-owner', [
            'as'        => $routeName.'.assignProcessOwner',
            'uses'      => $controller.'@assignProcessOwner',
            'operation' => 'assignProcessOwner',
        ]);

        Route::post($segment . '/assign-process-owner', [
            'as' => $routeName . '.assign',
            'uses' => $controller . '@assign',
            'operation' => 'assignProcessOwner'
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupAssignProcessOwnerDefaults()
    {
        CRUD::allowAccess('assignProcessOwner');

        CRUD::operation('assignProcessOwner', function () {
            CRUD::loadDefaultOperationSettingsFromConfig();
        });

        CRUD::operation('list', function () {
            // CRUD::addButton('top', 'assign_process_owner', 'view', 'crud::buttons.assign_process_owner');
             CRUD::addButton('line', 'assign_process_owner', 'view', 'crud::buttons.assign_process_owner');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function assignProcessOwner($monitoringSheetId)
    {
        CRUD::hasAccessOrFail('assignProcessOwner');
        $processOwners = AssignedMonitoringSheet::where('monitoring_sheet_id', $monitoringSheetId)
            ->get();

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = CRUD::getTitle() ?? 'Assign Process Owner '.$this->crud->entity_name;
        $this->data['processOwners'] = $processOwners;
        $this->data['monitoringSheetId'] = $monitoringSheetId;
        $this->data['processOwnersSelection'] = User::whereNotIn('role', [
            'Quality Assurance Officer',
            'Campus Executive Director/QMR'
        ])->get();

        // load the view
        return view('crud::operations.assign_process_owner', $this->data);
    }

    public function assign(Request $request)
    {
        $assigned = new AssignedMonitoringSheet();
        $assigned->assigned_id = $request->get('assigned_id');
        $assigned->monitoring_sheet_id = $request->get('monitoring_sheet_id');
        $assigned->assigned_by = backpack_auth()->id();
        $assigned->save();

        User::find($assigned->assigned_id)->notify(new FormAssignedNotification());

        Alert::success('<strong>Success !</strong> Monitoring Sheet Assigned')->flash();

        return Redirect::back();
    }
}
