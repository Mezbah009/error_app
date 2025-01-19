<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Error Tracking Details</h1>

        <div class="border border-gray-300 p-6 rounded-lg">
            <p><strong>Developer:</strong> {{ $errorTracking->developer->name }}</p>
            <p><strong>Project:</strong> {{ $errorTracking->project->name }}</p>
            <p><strong>Date:</strong> {{ $errorTracking->date }}</p>
            <p><strong>Error Type:</strong> {{ $errorTracking->error_type }}</p>
            <p><strong>Solution Description:</strong> {{ $errorTracking->solution_description }}</p>
            <p><strong>Solution Provided By:</strong> {{ $errorTracking->solution_provided_by }}</p>
            <p><strong>Status:</strong> {{ $errorTracking->status }}</p>
            <p><strong>Comments:</strong> {{ $errorTracking->comments }}</p>
        </div>

        <a href="{{ route('error_trackings.index') }}" class="mt-6 inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
    </div>
</x-app-layout>
