@extends(backpack_view('blank'))

@section('content')
    <div class="jumbotron">
        <h1 class="mb-4">Monitoring Sheet Preview</h1>

        <div>
            <link type="text/css" rel="stylesheet" href="resources/sheet.css">
            <style>
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
                }

                .ritz .waffle .s8 {
                    border-bottom: 2px SOLID #000000;
                    border-right: 2px SOLID #000000;
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
                }

                .ritz .waffle .s18 {
                    border-bottom: 2px SOLID #000000;
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
                }

                .ritz .waffle .s19 {
                    border-bottom: 2px SOLID #000000;
                    border-right: 2px SOLID #000000;
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
                    border-bottom: 2px SOLID #000000;
                    border-right: 2px SOLID #000000;
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
                    padding: 0px 3px 0px 3px;
                }

                .ritz .waffle .s4 {
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

                .ritz .waffle .s16 {
                    border-right: 2px SOLID #000000;
                    background-color: #ffffff;
                    text-align: center;
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
                    text-align: left;
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
                }</style>
            <div class="ritz grid-container" dir="ltr">
                <table class="waffle" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr style="height: 100px">
                        <td class="s2">
                            <div style="width:110px;height:100px;"><img
                                    src="https://lh7-us.googleusercontent.com/sheets/ACTFsxQq7ZGQT_yfmE5OVqKV7OUXx_CxDywALwTVQCAFotb1-eZAHH3mxl149JetcNyf7D1_B4gS3DKeU4fc0JmzD1IJ0enMvi5MeUrRNmlx1bvRWLPCR0jS-6Gi6Yk0TngKkpb6bPk2kUf6rwgiWM-bSaNa0guacfUKJ4dVZhkJOg8FyM_NAYVyGkRjCQU9tB9h4OCajqjCwmLzWYWjEbPQradR9AhArZfRt_9lIeVnhU9RCwkd470TNb4veGt0Gci4iVo-YJRRSUWxtoctyBVnlRRySg-eLAMXjx1-MtWSv5kuV7Z_CqWgaK1wrwkZnRJ8wwCY1w5Ti83j2sR1DwV6FhIriRLGErGzvPmac2TW2DfZI5s04dNkmGqDhilkPJ4J5YBzMf388YIyCQl63cLeSw3NqkQIk3q-jmTukCqzIEtDQJakkKk-zYSSNCX5gaV7cbXKkJeqZFeQrqoSHeXIoGHL56O60Pbuq3MqC81mJXWtUmqQsukE5S_TvCwtwe2C0VBrsbJIf_Gw6yTh2tVMNvatKpRoaOQYW4FMMeSjPks4qO3b0SU3ofwcCpKNC_gBZcT_fHbdaEBt5wP8F5QUvMBhg7GBLSMQ1aHpPXSlHN5JowbxnWDVrP9b0TEGn4gLZDi-FR915yXEenmmpy7A0mCujK_-YRnWUbBjifyjaRNloLlmr4MZRdunM0abWei5UwwQHLUE6P2p21EmLvPDdvIoph5PDKhVLxkg-vlOqd157uFqpTFLTxCV5mNJcM8XmADwJs8BO_F5akvCjUz2HHJvE8oZfGFe2D-QFvs1UI96ksIUOlgceoB3maWu5JrblbRSv-TCRU2toAB50FkMv87_SkV2XNEgDMsB7XkYY3_WpymZMcmihT7H2xDsmU2PkjwIIJkbQ0Qa543KYc1hPd0QMiifLCn1OV-ByaR6bl1ljTNBeSXZhKWs2LpEkdIgXqtQ3qbNp2_gZPnK5wAOcNaAZqPcCa7sDAzbPTaZQOmG-NDL6xzSsyJW3YostSeE7blNB-TqvEGSjhqKkU9rvvIBOL3uQ8dQFDWgPPXED8H2WkUsBSKkR7WAUfhTr3Ymnn0yQ9v0qPKGpxw5mqcQnoOOwt-AyGfd22I=w110-h100"
                                    style="width:inherit;height:inherit;object-fit:scale-down;object-position:left top;"/>
                            </div>
                        </td>
                        <td class="s3" colspan="5">MONITORING SHEET
                            - {{ $assignedMonitoringSheet->monitoringSheet->getFormattedCategoryAttribute() }}<br><span
                                style="font-size:11pt;font-family:Arial;font-weight:bold;color:#000000;">PANGASINAN STATE UNIVERSITY<br>San Carlos City Campus</span>
                        </td>
                    </tr>
                    <tr style="height: 19px">
                        <td class="s4">DIVISION</td>
                        <td class="s4" colspan="3">{{ $assignedMonitoringSheet->monitoringSheet->division->name }}</td>
                        <td class="s4">YEAR / QUARTER</td>
                        <td class="s5">{{ $assignedMonitoringSheet->monitoringSheet->year_quarter }}</td>
                    </tr>
                    <tr style="height: 19px">
                        <td class="s4">AREA</td>
                        <td class="s4" colspan="3">{{ $assignedMonitoringSheet->monitoringSheet->area->name }}</td>
                        <td class="s4">COVERAGE PERIOD</td>
                        <td class="s5">{{ $assignedMonitoringSheet->monitoringSheet->coverage }}</td>
                    </tr>
                    <tr style="height: 19px">
                        <td class="s6">PROCESS</td>
                        <td class="s6" colspan="3">Colleges</td>
                        <td class="s6">DATE SUBMITTED</td>
                        <td class="s7"></td>
                    </tr>
                    <tr style="height: 29px">
                        <td class="s8" colspan="6">QUARTERLY ACCOMPLISHMENT REPORT</td>
                    </tr>
                    <tr style="height: 18px">
                        <td class="s9 uppercase">{{ $assignedMonitoringSheet->monitoringSheet->category }}</td>
                        <td class="s9">TARGET</td>
                        <td class="s9">STATUS</td>
                        <td class="s9">REMARKS</td>
                        <td class="s9">ROOT CAUSE</td>
                        <td class="s10">CORRECTIVE ACTION</td>
                    </tr>
                    @foreach($assignedMonitoringSheet->monitoringSheet->questions as $key => $question)
                        @php
                            $answer = \App\Models\MonitoringSheetAnswer::where('assigned_monitoring_sheet_id', $assignedMonitoringSheet->monitoringSheet->id)
                                        ->where('question_id', $question->id)
                                        ->first();
                        @endphp
                        <tr style="height: 18px">
                            <td class="s9 uppercase">{{ $assignedMonitoringSheet->monitoringSheet->category }} #{{ $key + 1 }}</td>
                            <td class="s11" style="width: 100%">
                                {{ $question->question }}
                            </td>
                            <td class="s9">{{ $answer ? $answer->status : '' }}</td>
                            <td class="s9">{{ $answer ? $answer->remarks : '' }}</td>
                            <td class="s9">{{ $answer ? $answer->root_cause : '' }}</td>
                            <td class="s10">{{ $answer ? $answer->corrective_action : '' }}</td>
                        </tr>
                    @endforeach
                    <tr style="height: 19px">
                        <td class="s16" colspan="3">{{ $assignedMonitoringSheet->monitoringSheet->prepared_by }}</td>
                        <td class="s17" colspan="3">{{ $assignedMonitoringSheet->monitoringSheet->checked_by }}</td>
                    </tr>
                    <tr style="height: 18px">
                        <td class="s18" colspan="3">{{ $assignedMonitoringSheet->monitoringSheet->prepared_by_role }}</td>
                        <td class="s19" colspan="3">{{ $assignedMonitoringSheet->monitoringSheet->checked_by_role }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
