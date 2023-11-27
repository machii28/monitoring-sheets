<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-800 text-white">
                        <tr class="text-center">
                            <th class="px-4 py-2">Role</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Year Quarter</th>
                            <th class="px-4 py-2">Date Submitted</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($monitoringSheets as $monitoringSheet)
                            <tr class="text-center">
                                <td class="px-4 py-2">{{ $monitoringSheet->processOwner->role }}</td>
                                <td class="px-4 py-2">{{ $monitoringSheet->processOwner->name }}</td>
                                <td class="px-4 py-2">{{ $monitoringSheet->monitoringSheet->year_quarter }}</td>
                                <td class="px-4 py-2">{{ $monitoringSheet->updated_at }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('po.approve', ['monitoringSheetId' => $monitoringSheet->monitoringSheet->id, 'poId' => $monitoringSheet->assigned_id]) }}"
                                       class="text-xs text-indigo-700 text-center">
                                        Approve
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</x-app-layout>

