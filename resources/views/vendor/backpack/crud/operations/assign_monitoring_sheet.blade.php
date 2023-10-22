@extends(backpack_view('blank'))

@section('header')
    <section class="header-operation container-fluid animated fadeIn d-flex mb-2 align-items-baseline d-print-none">
        <h2>
            <span class="text-capitalize mb-0">Assigned Monitoring Sheets</span>
        </h2>
    </section>
@endsection

@section('content')
    <div class="container-fluid animated fadeIn">
        <div class="row table-content">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <th>Monitoring Sheet</th>
                                <th>Is Filled Up</th>
                            </thead>
                            <tbody>
                            @foreach ($assignedMonitoringSheets as $assignedMonitoringSheet)
                                <tr>
                                    <td>{{ $assignedMonitoringSheet->monitoringSheet->title }} - {{ $monitoringSheet->year_quarter }} - {{ $monitoringSheet->coverage }}</td>
                                    <td>
                                        @if ($assignedMonitoringSheet->is_filled_up)
                                            <span class="badge rounded-pill bg-success">Filled Up</span>
                                        @else
                                            <span class="badge rounded-pill bg-warning">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
