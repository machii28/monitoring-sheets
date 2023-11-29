<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (auth()->user()->role !== 'Quality Assurance Officer' && auth()->user()->role !== 'Campus Executive Director/QMR')
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                        <div class="p-4 bg-green-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75"/>
                            </svg>
                        </div>
                        <div class="px-4 text-gray-700">
                            <h3 class="text-sm tracking-wider">Submitted Monitoring Sheets</h3>
                            <p class="text-3xl">{{ $filled_up_count }}</p>
                        </div>
                    </div>

                    <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                        <div class="p-4 bg-yellow-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/>
                            </svg>
                        </div>
                        <div class="px-4 text-gray-700">
                            <h3 class="text-sm tracking-wider">Assigned Monitoring Sheets</h3>
                            <p class="text-3xl">{{ $non_filled_up_count }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white shadow-lg shadow-slate-200 rounded-lg p-6">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400 text-sm text-slate-500">Total Assigned Monitoring Sheets</span>
	                        <span class="px-2 py-1 bg-teal-50 rounded-lg text-xs text-teal-400 font-medium min-w-[46px] text-center">
                                {{ $total_monitoring_sheets_progress }}%
                            </span>
                        </div>

                        <div class="w-full bg-slate-100 h-1 mb-6 mt-2">
                            <div class="bg-blue-400 h-1 rounded" style="width: {{ $total_monitoring_sheets_progress }}%"></div>
                        </div>
                    </div>

                    <div class="bg-white shadow-lg shadow-slate-200 rounded-lg p-6">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400 text-sm text-slate-500">Total FQO Monitoring Sheets</span>
	                        <span class="px-2 py-1 bg-teal-50 rounded-lg text-xs text-teal-400 font-medium min-w-[46px] text-center">{{ $total_fqo_progress }}%</span>
                        </div>

                        <div class="w-full bg-slate-100 h-1 mb-6 mt-2">
                            <div class="bg-blue-400 h-1 rounded" style="width: {{ $total_fqo_progress }}%"></div>
                        </div>
                    </div>

                    <div class="bg-white shadow-lg shadow-slate-200 rounded-lg p-6">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400 text-sm text-slate-500">Total Assigned RR Sheets</span>
	                        <span class="px-2 py-1 bg-teal-50 rounded-lg text-xs text-teal-400 font-medium min-w-[46px] text-center">{{ $total_rr_progress }}%</span>
                        </div>

                        <div class="w-full bg-slate-100 h-1 mb-6 mt-2">
                            <div class="bg-blue-400 h-1 rounded" style="width: {{ $total_rr_progress }}%"></div>
                        </div>
                    </div>

                    <div class="bg-white shadow-lg shadow-slate-200 rounded-lg p-6">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400 text-sm text-slate-500">Total Assigned PG Sheets</span>
	                        <span class="px-2 py-1 bg-teal-50 rounded-lg text-xs text-teal-400 font-medium min-w-[46px] text-center">{{ $total_pg_progress }}%</span>
                        </div>

                        <div class="w-full bg-slate-100 h-1 mb-6 mt-2">
                            <div class="bg-blue-400 h-1 rounded" style="width: {{ $total_pg_progress }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
