@extends(backpack_view('blank'))

@php
    $submittedSheets = \App\Models\AssignedMonitoringSheet::where('is_filled_up', false)->count();
    $totalSheets = \App\Models\AssignedMonitoringSheet::count();
    $progress = $totalSheets ? ($submittedSheets/$totalSheets) * 100 : 0;

    $widgets['after_content'] = [
        [
            'type'        => 'progress',
            'class'       => 'card text-white bg-primary mb-2',
            'value'       => $submittedSheets,
            'description' => 'Submitted Sheets',
            'progress'    => $progress, // integer
            'hint'        => "$totalSheets remaining un-submitted monitoring sheets",
        ]
    ];
@endphp

@section('content')
    <h1></h1>
@endsection
