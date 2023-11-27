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
                        @if($errors->has('question'))
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <form
                            action="{{ route('monitoring-sheet.add-question', ['monitoringSheetId' => $monitoringSheetId]) }}"
                            method="POST">
                            {{ csrf_field() }}

                            <input type="hidden" name="monitoring_sheet_id" value="{{ $monitoringSheetId }}">

                            <div class="mb-3">
                                <label for="question" class="form-label">Target</label>
                                <input type="text" name="question" id="question" class="form-control">
                            </div>

                            <button class="btn btn-primary">Add Target</button>

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
                                <th>Target</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            @foreach ($questions as $question)
                                <tr>
                                    <td>
                                        <p class="text-display">{{ $question->question }}</p>
                                        <input type="text" class="edit-input" style="display: none;" value="{{ $question->question }}">
                                        <input type="hidden" class="edit-input-id" value="{{ $question->id }}">
                                        <button type="button" class="btn btn-sm btn-link save-btn"
                                                style="display: none;">Save
                                        </button>
                                    </td>
                                    <td class="action-buttons">
                                        <form method="POST"
                                              action="{{ route('monitoring-sheet.remove-question', ['questionId' => $question->id]) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('POST') }}
                                            <button type="button" class="btn btn-sm btn-link edit-btn">Edit</button>
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const editButtons = document.querySelectorAll('.edit-btn');
            const saveButtons = document.querySelectorAll('.save-btn');
            const editInputs = document.querySelectorAll('.edit-input');
            const display = document.querySelectorAll('.text-display');
            const editInputId = document.querySelectorAll('.edit-input-id');

            editButtons.forEach((editBtn, index) => {
                editBtn.addEventListener('click', function () {
                    editInputs[index].style.display = 'inline-block';
                    saveButtons[index].style.display = 'inline-block';
                    display[index].style.display = 'none';
                    editButtons[index].style.display = 'none';
                });

                saveButtons[index].addEventListener('click', function () {
                    const question = editInputs[index].value;
                    const id = editInputId[index].value;

                    // For demonstration purposes, let's log the updated question.
                    $.ajax({
                        type: 'POST',
                        url: '/' + id + '/update-question',
                        data: {
                            question: question
                        },
                        success: function(data) {
                            console.log(data);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });

                    display[index].textContent = question;
                    editInputs[index].style.display = 'none';
                    saveButtons[index].style.display = 'none';
                    display[index].style.display = 'inline-block';
                    editButtons[index].style.display = 'inline-block';
                });
            });
        });
    </script>
@endsection
