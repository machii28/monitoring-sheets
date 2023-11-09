<?php

namespace App\Http\Controllers;

use App\Models\AssignedMonitoringSheet;
use Illuminate\Http\Request;

class QMRController extends Controller
{
    public function fqo()
    {
        $data = [];
        $data['category'] = 'Functional Quality Objectives';
        $data['monitoringSheets'] = AssignedMonitoringSheet::
            where('is_filled_up', true)
            ->whereHas('monitoringSheet', function ($query) {
                $query->where('category', 'fqo');
            })->get();

        return view('qmr-monitoring', $data);
    }

    public function pg()
    {
        $data = [];
        $data['category'] = 'Process Goals';
        $data['monitoringSheets'] = AssignedMonitoringSheet::
            where('is_filled_up', true)
            ->whereHas('monitoringSheet', function ($query) {
                $query->where('category', 'pg');
            })->get();

        return view('qmr-monitoring', $data);
    }

    public function rr()
    {
        $data = [];
        $data['category'] = 'Risk Register';
        $data['monitoringSheets'] = AssignedMonitoringSheet::
            where('is_filled_up', true)
            ->whereHas('monitoringSheet', function ($query) {
                $query->where('category', 'rr');
            })->get();

        return view('qmr-monitoring', $data);
    }
}
