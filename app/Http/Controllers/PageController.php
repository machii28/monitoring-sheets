<?php

namespace App\Http\Controllers;

use App\Models\MonitoringSheet;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function monitoringSheets(Request $request)
    {
        $data = [];

        $data['monitoringSheets'] = MonitoringSheet::where('area_id', auth()->user()->area_id)->get();

        return view('monitoring-sheets', $data);
    }
}
