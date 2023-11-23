<?php

namespace App\Http\Controllers;

use App\Models\AssignedMonitoringSheet;
use App\Models\MonitoringSheet;
use App\Models\MonitoringSheetAnswer;
use Barryvdh\DomPDF\PDF;
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
        $assignedMonitoringSheet['print'] = false;

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

    public function print($monitoringSheetId, $poId)
    {
        $assignedMonitoringSheet = AssignedMonitoringSheet::where('monitoring_sheet_id', $monitoringSheetId)
            ->where('assigned_id', $poId)
            ->first();
        $assignedMonitoringSheet['print'] = true;


        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('print', [
            'assignedMonitoringSheet' => $assignedMonitoringSheet
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('monitoring_sheet.pdf');
    }

    public function approve($monitoringSheetId, $poId)
    {
         $assignedMonitoringSheet = AssignedMonitoringSheet::where('monitoring_sheet_id', $monitoringSheetId)
            ->where('assigned_id', $poId)
            ->first();

         return view('approve', [
             'assignedMonitoringSheet' => $assignedMonitoringSheet
         ]);
    }
}
