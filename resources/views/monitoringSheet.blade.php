@php

$logo = '/images/logo.png';
$preparedBySignature = $assignedMonitoringSheet->prepared_by_signature
    ? str_replace('public/', '/storage/', $assignedMonitoringSheet->prepared_by_signature)
    : '';
$checkedBySignature = $assignedMonitoringSheet->checked_by_signature
    ? str_replace('public/', '/storage/', $assignedMonitoringSheet->checked_by_signature)
    : '';

if ($assignedMonitoringSheet['print']) {
    $logo = getcwd() . $logo;
    $preparedBySignature = $assignedMonitoringSheet->prepared_by_signature
    ? str_replace('storage\public', '/storage/app/public', storage_path($assignedMonitoringSheet->prepared_by_signature))
    : '';
    $checkedBySignature = $assignedMonitoringSheet->checked_by_signature
    ? str_replace('storage\public', '/storage/app/public', storage_path($assignedMonitoringSheet->checked_by_signature))
    : '';

    }

@endphp

<link type="text/css" rel="stylesheet" href="resources/sheet.css">
<style>
    .ritz .waffle {
        border: 2px SOLID black !important;
        width: 100%;
        border-spacing: -1px;
    }

    .ritz .waffle a {
        color: inherit;
    }

    .ritz .waffle .s13 {
        border-bottom: 2px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        color: #000000;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: top;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s12 {
        border-bottom: 2px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s15 {
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        font-style: italic;
        color: #000000;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: top;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s7 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #ff0000;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: top;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s10 {
        border-bottom: 1px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s1 {
        border-bottom: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: right;
        font-style: italic;
        color: #000000;
        font-family: 'Arial';
        font-size: 7pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s5 {
        border-bottom: 1px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s8 {
        border-bottom: 2px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: 'Arial';
        font-size: 12pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 3px;
        height: 18;
    }

    .ritz .waffle .s18 {
        border-bottom: 1px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        color: #ff0000;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s9 {
        border-bottom: 1px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 3px;
        height: 20;
    }

    .ritz .waffle .s19 {
        border-bottom: 1px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        color: #000000;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s3 {
        border: 1px solid black;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: 'Arial';
        font-size: 18pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 25px;
    }

    .ritz .waffle .s4 {
        border-bottom: 1px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 3px;
        height:15;

    }

    .ritz .waffle .s16 {
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        #text-align: center;
        font-weight: bold;
        color: #ff0000;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s2 {
        border-bottom: 2px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        color: #000000;
        font-family: 'docs-Calibri', Arial;
        font-size: 11pt;
        vertical-align: top;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0;
    }

    .ritz .waffle .s14 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s0 {
        border-bottom: 2px SOLID #000000;
        background-color: #ffffff;
    }

    .ritz .waffle .s6 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 3px;
        border-top: 1px solid;
        height: 15;
    }

    .ritz .waffle .s11 {
        border-bottom: 1px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        color: #000000;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: top;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s17 {
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        #text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .series_number {
        display: block;
        color: black;
        text-align: right;
        font-style: italic;
    }

    .series_number p  {
        margin-bottom: 10px;
    }

    .series_number p span {
        display: block;
    }
</style>

@if ($assignedMonitoringSheet['print'])
<div class="series_number">
    <p>
        FM-TM-QMS-06a
        <span>
            Rev.0
        </span>
        <span>
            02-May-2022
        </span>
    </p>
</div>
@endif
<div class="ritz grid-container" dir="ltr">
    <table class="waffle" style="border-spacing: 0px;">
        <tbody>
        <tr style="height: 100px">
            <td class="s2">
                <div style="display: flex; justify-content: center; margin: 10px;">
                    <img src="{{ $logo }}" width="100px" height="100px"/>
                </div>
            </td>
            <td class="s3" style="border-right: 2px solid black;" colspan="7">
                MONITORING SHEET
                - {{ $assignedMonitoringSheet->monitoringSheet->getFormattedCategoryAttribute() }}<br><span
                    style="font-size:11pt;font-family:Arial;font-weight:bold;color:#000000;">PANGASINAN STATE UNIVERSITY<br>San Carlos City Campus</span>
            </td>
        </tr>
        <tr style="height: 19px">
            <td class="s4">DIVISION</td>
            <td class="s4" colspan="4">{{ $assignedMonitoringSheet->monitoringSheet->division->name }}</td>
            <td class="s4">YEAR / QUARTER</td>
            <td class="s5" colspan="4"  >{{ $assignedMonitoringSheet->monitoringSheet->year_quarter }}</td>
        </tr>
        <tr style="height: 19px">
            <td class="s4">AREA</td>
            <td class="s4" colspan="4">{{ $assignedMonitoringSheet->monitoringSheet->area->name }}</td>
            <td class="s4">COVERAGE PERIOD</td>
            <td class="s5" colspan="4">
    @if($assignedMonitoringSheet->monitoringSheet->coverage === '1st Quarter')
        January-March
    @elseif($assignedMonitoringSheet->monitoringSheet->coverage === '2nd Quarter')
        April-June
    @elseif($assignedMonitoringSheet->monitoringSheet->coverage === '3rd Quarter')
        July-September
    @elseif($assignedMonitoringSheet->monitoringSheet->coverage === '4th Quarter')
        October-December
    @else
        Unknown Coverage
    @endif
</td>

        </tr>
        <tr style="height: 19px">
            <td class="s6">PROCESS</td>
            <td class="s6" colspan="4">{{ $assignedMonitoringSheet->monitoringSheet->process->name}}</td>
            <td class="s6">DATE SUBMITTED</td>
            <td class="s5" style="border-bottom: 2px solid black;" colspan="4">{{ Carbon\Carbon::parse($assignedMonitoringSheet->updated_at)->format('Y-m-d') }}</td>
        </tr>
        <tr style="height: 29px">
            <td class="s8" colspan="8">QUARTERLY ACCOMPLISHMENT REPORT</td>
        </tr>
        <tr style="height: 18px">
            <td class="s9 uppercase">{{ strtoupper($assignedMonitoringSheet->monitoringSheet->category) }}</td>
            <td class="s9" colspan="2">TARGET</td>
            <td class="s9">STATUS</td>
            <td class="s9">REMARKS</td>
            <td class="s9">ROOT CAUSE</td>
            <td class="s10" colspan="3">CORRECTIVE ACTION</td>
        </tr>
        @foreach($assignedMonitoringSheet->monitoringSheet->questions as $key => $question)
            @php
                $answer = \App\Models\MonitoringSheetAnswer::where('assigned_monitoring_sheet_id', $assignedMonitoringSheet->monitoringSheet->id)
                            ->where('question_id', $question->id)
                            ->first();
            @endphp
            <tr style="height: 18px">
                <td class="s9 uppercase">{{ strtoupper($assignedMonitoringSheet->monitoringSheet->category) }} #{{ $key + 1 }}</td>
                <td class="s11" colspan="2">
                    {{ $question->question }}
                </td>
                <td class="s9" >{{ $answer ? $answer->status : '' }}</td>
                <td class="s9">{{ $answer ? $answer->remarks : '' }}</td>
                <td class="s9">{{ $answer ? $answer->root_cause : '' }}</td>
                <td class="s10" colspan="3">{{ $answer ? $answer->corrective_action : '' }}</td>
            </tr>
        @endforeach
        <tr style="height: 19px">
            <td class="s16" style="text-align: center;" colspan="4">
                <p style="color: black; font-weight: lighter; margin-bottom: 10px; text-align: left;">Prepared By:</p>
                @if ($assignedMonitoringSheet->prepared_by_signature)
                    <img style="margin: auto; z-index: 9999999; display: block"
                         src="{{ $preparedBySignature }}"
                         height="100" width="150" alt="">
                @endif
                <div style="display: block; text-align: center;">
                    {{ $assignedMonitoringSheet->processOwner->full_name }}
                </div>
            </td>
            <td class="s17" style="text-align: center;" colspan="4">
                <p style="color: black; font-weight: lighter; margin-bottom: 10px; text-align: left;">Checked By:</p>
                @if ($assignedMonitoringSheet->checked_by_signature)
                    <img style="margin: auto; z-index: 9999999; display: block"
                         src="{{ $checkedBySignature }}"
                         height="100" width="150" alt="">
                @endif
                <div style="display: block; text-align: center;">
                    {{ \App\Models\User::where('role', 'Campus Executive Director/QMR')->first()->full_name }}
                </div>
            </td>
        </tr>
        <tr style="height: 18px">
            <td class="s18" colspan="4">{{ $assignedMonitoringSheet->processOwner->role }}</td>
            <td class="s19" colspan="4">{{
                 \App\Models\User::where('role', 'Campus Executive Director/QMR')->first()->role
              }}</td>
        </tr>
        </tbody>
    </table>
</div>
