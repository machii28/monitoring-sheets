<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center uppercase">
            Monitoring Sheet - {{ $monitoringSheet->category }}
            <span class="text-base block">
                Pangasinan State University
            </span>
        </h2>
        <span class="text-base text-center text-sm block">
            San Carlos City Campus
        </span>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4">
                        <p class="font-semibold">DIVISION</p>
                        <p>{{ $monitoringSheet->division->name }}</p>
                    </div>
                    <div class="p-4">
                        <p class="font-semibold">YEAR QUARTER</p>
                        <p>{{ $monitoringSheet->year_quarter }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4">
                        <p class="font-semibold">AREA</p>
                        <p>{{ $monitoringSheet->area->name }}</p>
                    </div>
                    <div class="p-4">
                        <p class="font-semibold">COVERAGE PERIOD</p>
                        <p>{{ $monitoringSheet->coverage }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4">
                        <p class="font-semibold">Process</p>
                        <p>{{ $monitoringSheet->process->name }}</p>
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
                            {{ $monitoringSheet->prepared_by }}
                            <span class="text-xs">{{ $monitoringSheet->prepared_by_role }}</span>
                        </p>
                    </div>
                    <div class="p-4">
                        <p class="font-semibold">Checked By</p>
                        <p>
                            {{ $monitoringSheet->checked_by }}
                            <span class="text-xs">{{ $monitoringSheet->checked_by_role }}</span>
                        </p>
                    </div>
                </div>

                <form
                    action="{{ route('po.submit-answer.monitoring-sheet', ['monitoringSheetId' => $monitoringSheet->id]) }}"
                    method="POST">
                    {{ csrf_field() }}
                    <div class="p-4">
                        @foreach($monitoringSheet->questions as $key => $question)
                            @php
                                $answer = \App\Models\MonitoringSheetAnswer::where('assigned_monitoring_sheet_id', $monitoringSheet->id)
                                            ->where('question_id', $question->id)
                                            ->first();
                            @endphp
                            <div class="border m-2 p-4">
                                <h3 class="text-center text-sm font-semibold uppercase">{{$monitoringSheet->category}}
                                    #{{ $key + 1 }}</h3>
                                <h4 class="text-center font-semibold mt-2">{{ $question->question }}</h4>

                                <div class="grid grid-cols-2 gap-4 mt-4">
                                    <div class="p-4 border">
                                        <p class="font-semibold">Status</p>
                                        <div class="mt-3">
                                            <input name="answers[{{ $question->id }}][status]" type="text" value="{{ $answer ? $answer->status : '' }}"
                                                   class="w-full rounded-md border-slate-200 placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500">
                                        </div>
                                    </div>
                                    <div class="p-4 border">
                                        <p class="font-semibold">Remarks</p>
                                        <div class="mt-3">
                                            <input name="answers[{{ $question->id }}][remarks]" type="text" value="{{ $answer ? $answer->remarks : '' }}"
                                                   class="w-full rounded-md border-slate-200 placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500">
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mt-4">
                                    <div class="p-4 border">
                                        <p class="font-semibold">Root Cause</p>
                                        <div class="mt-3">
                                            <input name="answers[{{ $question->id }}][root_cause]" type="text" value="{{ $answer ? $answer->root_cause : '' }}"
                                                   class="w-full rounded-md border-slate-200 placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500">
                                        </div>
                                    </div>
                                    <div class="p-4 border">
                                        <p class="font-semibold">Corrective Action</p>
                                        <div class="mt-3">
                                            <input name="answers[{{ $question->id }}][corrective_action]" type="text" value="{{ $answer ? $answer->corrective_action : '' }}"
                                                   class="w-full rounded-md border-slate-200 placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="grid m-10 grid-cols-3">
                        <div class="mx-auto w-1/2">
                            <button type="submit" class="bg-indigo-400 rounded-md w-full text-white p-4 items-center">Submit</button>
                        </div>
                        <div class="mx-auto w-1/2">
                            <button type="button" class="bg-green-cool-500 rounded-md w-full text-white p-4 items-center">Save and Exit</button>
                        </div>
                        <div class="mx-auto w-1/2">
                            <button type="button" id="previewButton" class="bg-blue-400 rounded-md w-full text-white p-4 items-center">Preview</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="previewModala" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 w-full h-full flex items-center justify-center z-50 hidden overflow-x-hidden overflow-y-auto">
        <div class="relative w-full max-w-2xl">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Terms of Service
                    </h3>
                    <button type="button" id="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                    </p>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="defaultModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                    <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const previewButton = document.getElementById("previewButton");
            const previewModal = document.getElementById("previewModal");
            const closeModal = document.getElementById("closeModal");

            previewButton.addEventListener("click", function () {
                previewModal.style.display = "block";
            });

            closeModal.addEventListener("click", function () {
                previewModal.style.display = "none";
            });
        });
    </script>
</x-app-layout>
