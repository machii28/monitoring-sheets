@extends(backpack_view('blank'))

@php
    $submittedSheets = \App\Models\AssignedMonitoringSheet::where('is_filled_up', true)->count();
    $totalSheets = \App\Models\AssignedMonitoringSheet::count();
    $progress = $totalSheets ? ($submittedSheets/$totalSheets) * 100 : 0;

    $totalFQO = \App\Models\MonitoringSheet::where('category', 'fqo')->count();
    $totalSubmittedFQO =  \App\Models\AssignedMonitoringSheet::where('is_filled_up', 1)
                            ->with('monitoringSheet')
                            ->whereHas('monitoringSheet', function ($query) {
                                $query->where('category', 'fqo');
                            })
                            ->count();
    $fqoProgress = $totalFQO ? ($totalSubmittedFQO/$totalFQO) * 100 : 0;

    $totalRR = \App\Models\MonitoringSheet::where('category', 'rr')->count();
    $totalSubmittedRR =  \App\Models\AssignedMonitoringSheet::where('is_filled_up', 1)
                            ->with('monitoringSheet')
                            ->whereHas('monitoringSheet', function ($query) {
                                $query->where('category', 'rr');
                            })
                            ->count();
    $rrProgress = $totalRR ? ($totalSubmittedRR/$totalRR) * 100 : 0;

    $totalPG = \App\Models\MonitoringSheet::where('category', 'pg')->count();
    $totalSubmittedPG =  \App\Models\AssignedMonitoringSheet::where('is_filled_up', 1)
                            ->with('monitoringSheet')
                            ->whereHas('monitoringSheet', function ($query) {
                                $query->where('category', 'pg');
                            })
                            ->count();
    $pgProgress = $totalPG ? ($totalSubmittedPG/$totalPG) * 100 : 0;


    Backpack\CRUD\app\Library\Widget::add()->to('before_content')->type('div')->class('row')->content([

		Backpack\CRUD\app\Library\Widget::make()
			->type('progress')
			->class('card border-0 text-white bg-info mt-4')
			->progressClass('progress-bar')
			->value($totalSheets)
			->description('Total Monitoring Sheets')
			->progress($progress)
			->hint("$submittedSheets Submitted Monitoring Sheets"),

		Backpack\CRUD\app\Library\Widget::add()
		    ->type('progress')
		    ->class('card border-0 text-white bg-success mt-4')
		    ->progressClass('progress-bar')
		    ->value($totalFQO)
		    ->description('Total Number of Functional Quality Objectives')
		    ->progress($fqoProgress)
		    ->hint("$totalSubmittedFQO Total Number of Submitted FQO")
		    ->onlyHere(),

		Backpack\CRUD\app\Library\Widget::make()
			->group('hidden')
		    ->type('progress')
		    ->class('card border-0 text-white bg-warning mt-4')
		    ->value($totalRR)
		    ->progressClass('progress-bar')
		    ->description('Total Number of Risk Register')
		    ->progress($rrProgress)
		    ->hint("$totalSubmittedRR Total Number of Submitted RR"),

	    Backpack\CRUD\app\Library\Widget::make()
			->group('hidden')
		    ->type('progress')
		    ->class('card border-0 text-white bg-dark mt-4')
		    ->value($totalPG)
		    ->progressClass('progress-bar')
		    ->description('Total Number of Risk Process Goal')
		    ->progress($pgProgress)
		    ->hint("$totalSubmittedPG Total Number of Submitted PG"),
	]);
@endphp

@section('content')

@endsection
