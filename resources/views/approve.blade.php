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
            @if ($errors->has('message'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5" role="alert">
                    <strong class="font-bold">Error! </strong>
                    <span class="block sm:inline">{{ $errors->first('message') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20"><title>Close</title><path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                  </span>
                </div>
            @endif

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
`
