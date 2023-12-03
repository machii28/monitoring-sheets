<?php

namespace App\Http\Controllers;

use App\Models\AssignedMonitoringSheet;
use App\Models\MonitoringSheet;
use App\Models\MonitoringSheetAnswer;
use App\Models\Question;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Assign;

class PageController extends Controller
{
    public function dashboard(Request $request)
    {
        $nonFilledUpMonitoringSheets = \App\Models\AssignedMonitoringSheet::where('assigned_id', auth()->id())
                                    ->where('is_filled_up', 0)
                                    ->count();

        $filledUpMonitoringSheets = \App\Models\AssignedMonitoringSheet::where('assigned_id', auth()->id())
                                        ->where('is_filled_up', 1)
                                        ->count();

        $totalMonitoringSheetsProgress = AssignedMonitoringSheet::count() !== 0 ?
         (AssignedMonitoringSheet::where('is_filled_up', true)->count() / AssignedMonitoringSheet::count()) * 100 : 0;
        $totalFQOProgress = AssignedMonitoringSheet::whereHas('monitoringSheet', function ($query) {
                    $query->where('category', 'rr');
                })->count() ? (
                AssignedMonitoringSheet::whereHas('monitoringSheet', function ($query) {
                    $query->where('category', 'fqo');
                })->where('is_filled_up', true)->count() /
                AssignedMonitoringSheet::whereHas('monitoringSheet', function ($query) {
                    $query->where('category', 'fqo');
                })->count()
        ) * 100 : 0;
        $totalRRProgress = AssignedMonitoringSheet::whereHas('monitoringSheet', function ($query) {
                    $query->where('category', 'rr');
                })->count() !== 0 ? (
                AssignedMonitoringSheet::whereHas('monitoringSheet', function ($query) {
                    $query->where('category', 'rr');
                })->where('is_filled_up', true)->count() /
                AssignedMonitoringSheet::whereHas('monitoringSheet', function ($query) {
                    $query->where('category', 'rr');
                })->count()
        ) * 100 : 0;
        $totalPGProgress = AssignedMonitoringSheet::whereHas('monitoringSheet', function ($query) {
                    $query->where('category', 'pg');
                })->count() !== 0 ? (
                AssignedMonitoringSheet::whereHas('monitoringSheet', function ($query) {
                    $query->where('category', 'pg');
                })->where('is_filled_up', true)->count() /
                AssignedMonitoringSheet::whereHas('monitoringSheet', function ($query) {
                    $query->where('category', 'pg');
                })->count()
        ) * 100 : 0;

        return view('dashboard', [
            'filled_up_count' => $filledUpMonitoringSheets,
            'non_filled_up_count' => $nonFilledUpMonitoringSheets,
            'total_monitoring_sheets_progress' => $totalMonitoringSheetsProgress,
            'total_fqo_progress' => $totalFQOProgress,
            'total_rr_progress' => $totalRRProgress,
            'total_pg_progress' => $totalPGProgress
        ]);
    }
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
            if (!$request->get('save_and_exit')) {
                if (!$answer['status']) {
                    return redirect()->back()->withErrors([
                        'message' => 'Please fill-up the fields before submitting the monitoring sheets'
                    ]);
                }

                if (!$answer['remarks']) {
                    return redirect()->back()->withErrors([
                        'message' => 'Please fill-up the fields before submitting the monitoring sheets'
                    ]);
                }

                if (!$answer['root_cause']) {
                    return redirect()->back()->withErrors([
                        'message' => 'Please fill-up the fields before submitting the monitoring sheets'
                    ]);
                }

                if (!$answer['corrective_action']) {
                    return redirect()->back()->withErrors([
                        'message' => 'Please fill-up the fields before submitting the monitoring sheets'
                    ]);
                }
            }

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

            $data = $file->storeAs('public/signatures', $fileName);

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

    public function approveCheckedBy($monitoringSheetId, $poId, Request $request)
    {
        $assignedMonitoringSheet = AssignedMonitoringSheet::where('monitoring_sheet_id', $monitoringSheetId)
            ->where('assigned_id', $poId)
            ->first();

        if (!$request->hasFile('file')) {
            return redirect()->back()->withErrors([
                'message' => 'Please provide signature'
            ]);
        }

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
