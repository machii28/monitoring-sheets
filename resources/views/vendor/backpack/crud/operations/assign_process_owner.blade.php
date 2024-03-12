@extends(backpack_view('blank'))

@section('header')
    <section class="header-operation container-fluid animated fadeIn d-flex mb-2 align-items-baseline d-print-none">
        <h2 class="mt-16">
            <span class="text-capitalize">Assign to Process Owners</span>
        </h2>
    </section>
@endsection

@section('content')
    <div class="container-fluid animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('funtional-quality-objectives.assign') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="mb-3">
                                <label class="form-label">Process Owner</label>

                                <select name="assigned_id" id="assigned_id" class="form-control">
                                    @foreach($processOwnersSelection as $processOwner)
                                        <option value="{{ $processOwner->id }}">{{ $processOwner->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" name="monitoring_sheet_id" value="{{ $monitoringSheetId }}">

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
                                <th>Process Owner</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($processOwners as $processOwner)
                                    <tr>
                                        <td>{{ $processOwner->processOwner->full_name }}</td>
                                        <td>{{ $processOwner->id }}</td>
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
