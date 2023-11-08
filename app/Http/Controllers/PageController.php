<?php

namespace App\Http\Controllers;

use App\Models\AssignedMonitoringSheet;
use App\Models\MonitoringSheet;
use App\Models\MonitoringSheetAnswer;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function monitoringSheets(Request $request)
    {
        $data = [];

        $data['monitoringSheets'] = AssignedMonitoringSheet::where('assigned_id', auth()->id())
            ->get();

        return view('monitoring-sheets', $data);
    }

    public function answer($monitoringSheetId)
    {
        $assignedMonitoringSheet = AssignedMonitoringSheet::where('monitoring_sheet_id', $monitoringSheetId)
                                ->where('assigned_id', auth()->id())
                                ->first();

        $data['assignedMonitoringSheet'] = $assignedMonitoringSheet;

        return view('answer', $data);
    }

    public function submitAnswer($monitoringSheetId, Request $request)
    {
        $assignedMonitoringSheet = AssignedMonitoringSheet::where('monitoring_sheet_id', $monitoringSheetId)
                                    ->where('assigned_id', auth()->id())
                                    ->first();

        foreach ($request->get('answers') as $questionId => $answer) {
            MonitoringSheetAnswer::updateOrCreate([
                'assigned_monitoring_sheet_id' => $assignedMonitoringSheet->id,
                'question_id' => $questionId
            ], [
                'assigned_monitoring_sheet_id' => $assignedMonitoringSheet->id,
                'question_id' => $questionId,
                'status' => $answer['status'],
                'remarks' => $answer['remarks'],
                'root_cause' => $answer['root_cause'],
                'corrective_action' => $answer['corrective_action']
            ]);
        }

        $assignedMonitoringSheet->is_filled_up = !$request->get('save_and_exit');
        $assignedMonitoringSheet->save();

        return redirect()->route('po.monitoring-sheets', ['monitoringSheetId' => $monitoringSheetId]);
    }
}
