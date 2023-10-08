<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Models\AssignedMonitoringSheet;
use App\Models\MonitoringSheet;
use App\Models\User;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Prologue\Alerts\Facades\Alert;

trait AssignMonitoringSheetOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupAssignMonitoringSheetRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/{processOwnerId}/assign-monitoring-sheet', [
            'as'        => $routeName.'.assignMonitoringSheet',
            'uses'      => $controller.'@assignMonitoringSheet',
            'operation' => 'assignMonitoringSheet',
        ]);

        Route::post($segment . '/assign-monitoring-sheet', [
            'as' => $routeName.'.assign',
            'uses' => $controller.'@assign',
            'operation' => 'assignMonitoringSheet'
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupAssignMonitoringSheetDefaults()
    {
        CRUD::allowAccess('assignMonitoringSheet');

        CRUD::operation('assignMonitoringSheet', function () {
            CRUD::loadDefaultOperationSettingsFromConfig();
        });

        CRUD::operation('list', function () {
             //CRUD::addButton('top', 'assign_monitoring_sheet', 'view', 'crud::buttons.assign_monitoring_sheet');
             CRUD::addButton('line', 'assign_monitoring_sheet', 'view', 'crud::buttons.assign_monitoring_sheet');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function assignMonitoringSheet($processOwnerId)
    {
        CRUD::hasAccessOrFail('assignMonitoringSheet');

        $processOwner = User::find($processOwnerId);

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = CRUD::getTitle() ?? 'Assign Monitoring Sheet '.$this->crud->entity_name;
        $this->data['processOwner'] = $processOwner;
        $this->data['monitoringSheets'] = MonitoringSheet::where('process_id', $processOwner->process_id)
                                            ->where('area_id', $processOwner->area_id)
                                            ->get();

        $this->data['assignedMonitoringSheets'] = AssignedMonitoringSheet::where('assigned_id', $processOwner->id)->get();

        // load the view
        return view('crud::operations.assign_monitoring_sheet', $this->data);
    }

    public function assign(Request $request)
    {
        CRUD::hasAccessOrFail('assignMonitoringSheet');
        $assigned = new AssignedMonitoringSheet();
        $assigned->assigned_id = $request->get('assigned_id');
        $assigned->monitoring_sheet_id = $request->get('monitoring_sheet');
        $assigned->assigned_by = backpack_auth()->id();
        $assigned->save();

        Alert::success('<strong>Success !</strong> Monitoring Sheet Assigned')->flash();

        return Redirect::back();
    }
}
