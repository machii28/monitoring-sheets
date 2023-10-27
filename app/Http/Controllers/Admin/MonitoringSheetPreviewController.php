<?php

namespace App\Http\Controllers\Admin;

use App\Models\AssignedMonitoringSheet;
use Illuminate\Routing\Controller;

/**
 * Class MonitoringSheetPreviewController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MonitoringSheetPreviewController extends Controller
{
    public function index($monitoringSheetId, $poId)
    {
        $data = AssignedMonitoringSheet::where('monitoring_sheet_id', $monitoringSheetId)
                ->where('assigned_id', $poId)
                ->first();

        return view('admin.monitoring_sheet_preview', [
            'title' => 'Monitoring Sheet Preview',
            'assignedMonitoringSheet' => $data,
            'breadcrumbs' => [
                trans('backpack::crud.admin') => backpack_url('dashboard'),
                'MonitoringSheetPreview' => false,
            ],
            'page' => 'resources/views/admin/monitoring_sheet_preview.blade.php',
            'controller' => 'app/Http/Controllers/Admin/MonitoringSheetPreviewController.php',
        ]);
    }
}
