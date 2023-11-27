<?php

namespace App\Http\Controllers;

use App\Models\AssignedMonitoringSheet;
use App\Models\MonitoringSheet;
use App\Models\MonitoringSheetAnswer;
use App\Models\Question;
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

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();

            $data = $file->storeAs('storage/signatures', $fileName);

            $assignedMonitoringSheet->prepared_by_signature = $data;
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
        ])->setPaper('A4', 'landscape');

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

    public function approveCheckedBy($monitoringSheetId, $poId, Request $request)
    {
        $assignedMonitoringSheet = AssignedMonitoringSheet::where('monitoring_sheet_id', $monitoringSheetId)
            ->where('assigned_id', $poId)
            ->first();

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();

        $data = $file->storeAs('public/signatures', $fileName);

        $assignedMonitoringSheet->checked_by_signature = $data;
        $assignedMonitoringSheet->is_approved = true;
        $assignedMonitoringSheet->save();

        return redirect()->back();
    }

    public function updateQuestion($questionId, Request $request)
    {
        $question = Question::where('id', $questionId)->first();

        $question->question = $request->question;
        $question->save();

        return response()->json([
            'message' => 'Success'
        ]);
    }
}
