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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('monitoringSheet')

            <div class="max-w-lg mx-auto bg-white p-6 rounded shadow mt-2">
                <form action="{{ route('po.post.approve', [
                    'monitoringSheetId' => $assignedMonitoringSheet->monitoring_sheet_id,
                    'poId' => $assignedMonitoringSheet->assigned_id
                ]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="file" class="block text-gray-700 font-bold mb-2">Upload Signature:</label>
                        <input type="file" name="file" id="file" class="border rounded px-4 py-2 w-full" required>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Approve
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
