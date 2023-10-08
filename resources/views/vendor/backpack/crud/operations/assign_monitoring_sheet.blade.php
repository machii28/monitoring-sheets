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
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('process-owner.assign') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="mb-3">
                                <label class="form-label">Process Owner</label>
                                <input disabled type="text" class="form-control" value="{{ $processOwner->name }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Area</label>
                                <input disabled type="text" class="form-control" value="{{ $processOwner->area->name }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Process</label>
                                <input disabled type="text" class="form-control" value="{{ $processOwner->process->name }}">
                            </div>

                            <input type="hidden" name="assigned_id" value="{{ $processOwner->id }}">

                            <div class="mb-3">
                                <label for="Monitoring Sheet" class="form-label">Monitoring Sheet</label>
                                <select name="monitoring_sheet" id="monitoring_sheet" class="form-control">
                                    @foreach($monitoringSheets as $monitoringSheet)
                                        <option value="{{ $monitoringSheet->id }}">{{ $monitoringSheet->title }} - {{ $monitoringSheet->year_quarter }} - {{ $monitoringSheet->coverage }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button class="btn btn-primary">Assign Monitoring Sheet</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
