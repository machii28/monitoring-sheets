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
                                            class="bg-red-400 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-400 dark:text-white">Done</span>
                                    @else
                                        <span
                                            class="bg-red-400 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-400 dark:text-white">Pending</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('po.answer.monitoring-sheet', ['monitoringSheetId' => $monitoringSheet->monitoringSheet->id]) }}"
                                       class="text-xs text-indigo-700 text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-flex">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                        </svg>
                                        Answer
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
