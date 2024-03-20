<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center uppercase">
            Monitoring Sheet - {{ $assignedMonitoringSheet->monitoringSheet->category }}
            <span class="text-base block">
                Pangasinan State University
            </span>
        </h2>
        <span class="text-base text-center text-sm block">
            San Carlos City Campus
        </span>
    </x-slot>

    <div class="py-12">
        @if($assignedMonitoringSheet->monitoringSheet)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if ($errors->has('message'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5"
                         role="alert">
                        <strong class="font-bold">Error! </strong>
                        <span class="block sm:inline">{{ $errors->first('message') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20"><title>Close</title><path
                                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                          </span>
                    </div>
                @endif

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4">
                            <p class="font-semibold">DIVISION</p>
                            <p>{{ $assignedMonitoringSheet->monitoringSheet->division->name }}</p>
                        </div>
                        <div class="p-4">
                            <p class="font-semibold">YEAR QUARTER</p>
                            <p>{{ $assignedMonitoringSheet->monitoringSheet->year_quarter }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4">
                            <p class="font-semibold">AREA</p>
                            <p>{{ $assignedMonitoringSheet->monitoringSheet->area->name }}</p>
                        </div>
                        <div class="p-4">
                            <p class="font-semibold">COVERAGE PERIOD</p>
                            <p>{{ $assignedMonitoringSheet->monitoringSheet->coverage }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4">
                            <p class="font-semibold">Process</p>
                            <p>{{ $assignedMonitoringSheet->monitoringSheet->process->name }}</p>
                        </div>
                        <div class="p-4">
                            <p class="font-semibold">Date Submitted</p>
                            <p></p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4">
                            <p class="font-semibold">Prepared By</p>
                            <p>
                                {{ $assignedMonitoringSheet->monitoringSheet->prepared_by }}
                                <span
                                    class="text-xs">{{ $assignedMonitoringSheet->monitoringSheet->prepared_by_role }}</span>
                            </p>
                        </div>
                        <div class="p-4">
                            <p class="font-semibold">Checked By</p>
                            <p>
                                {{ $assignedMonitoringSheet->monitoringSheet->checked_by }}
                                <span
                                    class="text-xs">{{ $assignedMonitoringSheet->monitoringSheet->checked_by_role }}</span>
                            </p>
                        </div>
                    </div>

                    <form
                        action="{{ route('po.submit-answer.monitoring-sheet', ['monitoringSheetId' => $assignedMonitoringSheet->monitoringSheet->id]) }}"
                        method="POST"
                        id="answerForm"
                        enctype="multipart/form-data"
                    >
                        {{ csrf_field() }}
                        <div class="p-4">
                            <p class="font-semibold">Signature</p>

                            <div class="mb-4">
                                <label for="file" class="block text-gray-700 font-bold mb-2">Upload Signature:</label>
                                <input type="file" name="file" id="file" class="border rounded px-4 py-2 w-full">
                            </div>
                        </div>

                        <div class="p-4">
                            <div class="mx-auto w-1/2">
                                <button id="addQuestionButton" type="button"
                                        class="bg-blue-500 w-full text-white p-2 items-center">Add
                                    Question
                                </button>
                            </div>

                            @foreach($assignedMonitoringSheet->monitoringSheet->questions as $key => $question)
                                @php
                                    $answer = \App\Models\MonitoringSheetAnswer::where('assigned_monitoring_sheet_id', $assignedMonitoringSheet->monitoringSheet->id)
                                                ->where('question_id', $question->id)
                                                ->first();
                                @endphp
                                <div class="border m-2 p-4">
                                    <button type="button"
                                            class="bg-red-500 text-white px-4 py-2 rounded-md delete-button"
                                            data-question-id="{{ $question->id }}">Delete
                                    </button>
                                    <h3 class="text-center text-sm font-semibold uppercase">{{$assignedMonitoringSheet->monitoringSheet->category}}
                                        #{{ $key + 1 }}</h3>
                                    <h4 class="text-center font-semibold mt-2">{{ $question->question }}</h4>

                                    <div class="grid grid-cols-2 gap-4 mt-4">
                                        <div class="p-4 border">
                                            <p class="font-semibold">Status</p>
                                            <div class="mt-3">
                                                <input name="answers[{{ $question->id }}][status]" type="text"
                                                       value="{{ $answer ? $answer->status : '' }}"
                                                       class="w-full rounded-md border-slate-200 placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500">
                                            </div>
                                        </div>
                                        <div class="p-4 border">
                                            <p class="font-semibold">Remarks</p>
                                            <div class="mt-3">
                                                <input name="answers[{{ $question->id }}][remarks]" type="text"
                                                       value="{{ $answer ? $answer->remarks : '' }}"
                                                       class="w-full rounded-md border-slate-200 placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 mt-4">
                                        <div class="p-4 border">
                                            <p class="font-semibold">Root Cause</p>
                                            <div class="mt-3">
                                                <input name="answers[{{ $question->id }}][root_cause]" type="text"
                                                       value="{{ $answer ? $answer->root_cause : '' }}"
                                                       class="w-full rounded-md border-slate-200 placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500">
                                            </div>
                                        </div>
                                        <div class="p-4 border">
                                            <p class="font-semibold">Corrective Action</p>
                                            <div class="mt-3">
                                                <input name="answers[{{ $question->id }}][corrective_action]"
                                                       type="text"
                                                       value="{{ $answer ? $answer->corrective_action : '' }}"
                                                       class="w-full rounded-md border-slate-200 placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <input type="hidden" name="save_and_exit" id="saveAndExitField" value="0">

                    </form>

                    <div class="grid m-10 grid-cols-3">
                        <div class="mx-auto w-1/2">
                            <button type="button" id="answerFormButtonSubmit"
                                    class="bg-gray-800 w-full text-white p-2 items-center">Submit
                            </button>
                        </div>
                        <div class="mx-auto w-1/2">
                            <button id="buttonSave" type="button"
                                    class="bg-gray-600 w-full text-white p-2 items-center">Save
                            </button>
                        </div>
                        <div class="mx-auto w-1/2">
                            <button type="button" id="previewButton"
                                    class="bg-gray-500 w-full text-white p-2 items-center">Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if($assignedMonitoringSheet->monitoringSheet)
        <div id="previewModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-10 transition-opacity"
                 style="--tw-bg-opacity: 0.65 !important">

                <div
                    class="modal-container bg-white mx-auto rounded shadow-lg z-50 overflow-y-auto bg-white max-w-7xl p-6">
                    <div class="modal-container bg-white mx-auto rounded shadow-lg z-50 overflow-y-auto">
                        @include('monitoringSheet')
                    </div>

                    <div class="w-full">
                        <button id="closeModal" class="block mt-8 bg-blue-400 rounded-md w-1/4 text-white p-4 mx-auto">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div id="addQuestionModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-10 transition-opacity"
             style="--tw-bg-opacity: 0.65 !important">
            <div class="modal-container bg-white mx-auto rounded shadow-lg z-50 overflow-y-auto bg-white max-w-7xl p-6">
                <h2 class="text-2xl font-semibold mb-4">Add New Target</h2>
                <form id="addQuestionForm" action="/question/add" method="POST">
                    @csrf
                    <input type="hidden" name="monitoring_sheet_id" value="{{ $assignedMonitoringSheet->monitoringSheet->id }}">
                    <div class="mb-4">
                        <label for="question" class="block text-gray-700 font-bold mb-2">Target:</label>
                        <textarea id="question" name="question" rows="3"
                                  class="border rounded w-full px-3 py-2"></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                        <button type="button" id="closeAddQuestionModal"
                                class="bg-gray-400 text-white px-4 py-2 rounded ml-2">Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const previewButton = document.getElementById("previewButton");
            const previewModal = document.getElementById("previewModal");
            const closeModal = document.getElementById("closeModal");
            const saveButton = document.getElementById('buttonSave');
            const saveAndExit = document.getElementById('saveAndExitField');
            const answerForm = document.getElementById('answerForm');
            const buttonSubmit = document.getElementById('answerFormButtonSubmit');

            previewButton.addEventListener("click", function () {
                previewModal.style.display = "block";
            });

            closeModal.addEventListener("click", function () {
                previewModal.style.display = "none";
            });

            saveButton.addEventListener('click', function () {
                saveAndExit.value = "1";

                answerForm.submit();
            });

            buttonSubmit.addEventListener('click', function () {
                answerForm.submit();
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    // Find the question ID
                    const questionId = button.dataset.questionId;

                    // Create a form element
                    const form = document.createElement('form');
                    form.method = 'GET';
                    form.action = `/questions/${questionId}/delete`;
                    form.style.display = 'hidden';

                    // Add CSRF token
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);

                    // Add a method override input for DELETE request
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'GET';
                    form.appendChild(methodInput);

                    // Append the form to the document body and submit it
                    document.body.appendChild(form);
                    form.submit();
                });
            });
        });


        document.addEventListener("DOMContentLoaded", function () {
            const addQuestionButton = document.getElementById("addQuestionButton");
            const addQuestionModal = document.getElementById("addQuestionModal");
            const closeAddQuestionModal = document.getElementById("closeAddQuestionModal");
            const addQuestionForm = document.getElementById("addQuestionForm");

            addQuestionButton.addEventListener("click", function () {
                addQuestionModal.style.display = "block";
            });

            closeAddQuestionModal.addEventListener("click", function () {
                addQuestionModal.style.display = "none";
            });

            addQuestionForm.addEventListener("submit", function (event) {
                // Prevent the default form submission
                event.preventDefault();

                // Submit the form using AJAX or fetch
                // Example using fetch:
                fetch("/question/add", {
                    method: "POST",
                    body: new FormData(addQuestionForm)
                })
                    .then(response => {
                        if (response.ok) {
                            // Handle success, maybe close the modal
                            addQuestionModal.style.display = "none";

                            window.location.reload();
                            // Optionally, update the UI to show the newly added question
                        } else {
                            // Handle errors
                        }
                    })
                    .catch(error => {
                        // Handle network errors
                    });
            });
        });
    </script>
</x-app-layout>
