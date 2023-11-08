<?php

namespace App\Http\Controllers\Admin;

use App\Models\MonitoringSheet;
use Illuminate\Routing\Controller;

/**
 * Class PreviewControllerController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PreviewController extends Controller
{
    public function index($monitoringSheetId)
    {
        $data = MonitoringSheet::find($monitoringSheetId);

        return view('admin.preview_controller', [
            'title' => 'Preview Controller',
            'monitoringSheet' => $data,
            'breadcrumbs' => [
                trans('backpack::crud.admin') => backpack_url('dashboard'),
                'PreviewController' => false,
            ],
            'page' => 'resources/views/admin/preview.blade.php',
            'controller' => 'app/Http/Controllers/Admin/PreviewControllerController.php',
        ]);
    }
}
