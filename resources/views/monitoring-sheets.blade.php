<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Monitoring Sheets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-800 text-white">
                        <tr class="text-center">
                            <th class="px-4 py-2">Category</th>
                            <th class="px-4 py-2">Area</th>
                            <th class="px-4 py-2">Year Quarter</th>
                            <th class="px-4 py-2">Process</th>
                            <th class="px-4 py-2">Is Filled Up</th>
                            <th class="px-4 py-2">Checked By</th>
                            <th class="px-4 py-">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($monitoringSheets as $monitoringSheet)
                            <tr class="text-center">
                                <td class="px-4 py-2">{{ $monitoringSheet->monitoringSheet->category }}</td>
                                <td class="px-4 py-2">{{ $monitoringSheet->monitoringSheet->area->name }}</td>
                                <td class="px-4 py-2">{{ $monitoringSheet->monitoringSheet->year_quarter }}</td>
                                <td class="px-4 py-2">{{ $monitoringSheet->monitoringSheet->process->name }}</td>
                                <td class="px-4 py-2">
                                    @if ($monitoringSheet->is_filled_up)
                                        <span
                                            class="bg-green-400 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-400 dark:text-white">Done</span>
                                    @else
                                        <span
                                            class="bg-red-400 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-400 dark:text-white">Pending</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    @if ($monitoringSheet->is_approved)
                                        {{
                                            \App\Models\User::where('role', 'Campus Executive Director/QMR')
                                            ->first()->name
                                        }}
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    @if (!$monitoringSheet->is_filled_up)
                                        <a href="{{ route('po.answer.monitoring-sheet', ['monitoringSheetId' => $monitoringSheet->monitoringSheet->id]) }}"
                                           class="text-xs bg-green-400 text-white text-center p-2">
                                            Fill-up
                                        </a>
                                    @else
                                        <a href="{{ route('po.print', ['monitoringSheetId' => $monitoringSheet->monitoringSheet->id, 'poId' => auth()->id()]) }}"
                                           class="text-xs bg-green-400 text-white text-center p-2">
                                            Print
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
