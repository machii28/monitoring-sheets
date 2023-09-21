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
                            <th class="px-4 py-2">Title</th>
                            <th class="px-4 py-2">Category</th>
                            <th class="px-4 py-2">Division</th>
                            <th class="px-4 py-2">Area</th>
                            <th class="px-4 py-2">Year Quarter</th>
                            <th class="px-4 py-2">Prepared By</th>
                            <th class="px-4 py-2">Checked By</th>
                            <th class="px-4 py-2">Process</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($monitoringSheets as $monitoringSheet)
                            <tr class="text-center">
                                <td class="px-4 py-2">{{ $monitoringSheet->title }}</td>
                                <td class="px-4 py-2">{{ $monitoringSheet->category->abbreviation }}</td>
                                <td class="px-4 py-2">{{ $monitoringSheet->division }}</td>
                                <td class="px-4 py-2">{{ $monitoringSheet->area->name }}</td>
                                <td class="px-4 py-2">{{ $monitoringSheet->year_quarter }}</td>
                                <td class="px-4 py-2">{{ $monitoringSheet->prepared_by }}</td>
                                <td class="px-4 py-2">{{ $monitoringSheet->checked_by }}</td>
                                <td class="px-4 py-2">{{ $monitoringSheet->process }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
