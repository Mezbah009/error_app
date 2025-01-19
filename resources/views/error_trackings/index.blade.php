<x-app-layout>
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Error Trackings</h1>
            <a href="{{ route('error_trackings.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Error</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Developer</th>
                    <th class="border border-gray-300 px-4 py-2">Project</th>
                    <th class="border border-gray-300 px-4 py-2">Date</th>
                    <th class="border border-gray-300 px-4 py-2">Error Type</th>
                    <th class="border border-gray-300 px-4 py-2">Solution Description</th>
                    <th class="border border-gray-300 px-4 py-2">Solution Provided By</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Comments</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($errorTrackings as $errorTracking)
                <tr>


                    <td class="border border-gray-300 px-4 py-2">{{ $errorTracking->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $errorTracking->developer->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $errorTracking->project->title }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $errorTracking->date }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $errorTracking->error_type }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $errorTracking->solution_description }}</td>

                    <td class="border border-gray-300 px-4 py-2">{{ $errorTracking->solution_provided_by }}</td>

                    <td class="border border-gray-300 px-4 py-2">{{ $errorTracking->status }}</td>

                    <td class="border border-gray-300 px-4 py-2">{{ $errorTracking->comments }}</td>

                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('error_trackings.edit', $errorTracking) }}" class="text-blue-500 hover:underline">Edit</a>
                        |
                        <a href="{{ route('error_trackings.show', $errorTracking) }}" class="text-green-500 hover:underline">View</a>
                        |
                        <form action="{{ route('error_trackings.destroy', $errorTracking) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this error tracking?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $errorTrackings->links() }}
        </div>
    </div>
</x-app-layout>
