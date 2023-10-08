<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center uppercase">
            Monitoring Sheet - {{ $monitoringSheet->category->category }}
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
                        <p>{{ $monitoringSheet->division }}</p>
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
                                <h3 class="text-center text-sm">{{$monitoringSheet->category->abbreviation}}
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

                    <div class="grid m-10">
                        <div class="mx-auto w-1/4">
                            <button class="bg-indigo-400 rounded-md w-full text-white p-4 items-center">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
