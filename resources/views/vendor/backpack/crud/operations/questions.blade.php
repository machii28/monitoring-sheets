@extends(backpack_view('blank'))

@section('header')
    <section class="header-operation container-fluid animated fadeIn d-flex mb-2 align-items-baseline d-print-none">
        <h2>
            <span class="text-capitalize mb-0">Setup Target</span>
        </h2>
    </section>
@endsection


@section('content')
    <div class="container-fluid animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-body">
                        <form action="{{ route('monitoring-sheet.add-question', ['monitoringSheetId' => $monitoringSheetId]) }}" method="POST">
                            {{ csrf_field() }}

                            <input type="hidden" name="monitoring_sheet_id" value="{{ $monitoringSheetId }}">

                            <div class="mb-3">
                                <label for="question" class="form-label">Question</label>
                                <input type="text" name="question" id="question" class="form-control">
                            </div>

                            <button class="btn btn-primary">Add Question</button>

                            <a href="{{ route('page.monitoring_sheet.preview', [
                                            'monitoringSheetId' => $monitoringSheetId,
                                        ])   }}" class="btn btn-primary">Preview</a>

                            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
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
                                <th>Question</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            @foreach ($questions as $question)
                                <tr>
                                    <td>{{ $question->question }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('monitoring-sheet.remove-question', ['questionId' => $question->id]) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('POST') }}
                                            <button type="submit" class="btn btn-sm btn-link">Remove</button>
                                        </form>
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
