<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Daily Error Tracking!") }}
                </div>
            </div>
        </div>
    </div> --}}


    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 p-6">
        <!-- Total Error Trackings Card -->
        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
            <h3 class="text-xl font-bold text-gray-700">Total Error Trackings</h3>
            <p class="text-4xl font-semibold text-blue-500 mt-4">{{ $totalErrorTrackings }}</p>
        </div>

        <!-- Resolved Error Trackings Card -->
        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
            <h3 class="text-xl font-bold text-gray-700">Resolved</h3>
            <p class="text-4xl font-semibold text-green-500 mt-4">{{ $resolvedErrorTrackings }}</p>
        </div>

        <!-- In-Progress Error Trackings Card -->
        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
            <h3 class="text-xl font-bold text-gray-700">In Progress</h3>
            <p class="text-4xl font-semibold text-yellow-500 mt-4">{{ $inProgressErrorTrackings }}</p>
        </div>
    </div>

</x-app-layout>
