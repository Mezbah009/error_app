<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Edit Error Tracking</h1>

        <form action="{{ route('error_trackings.update', $errorTracking) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Developer -->
            <div>
                <label for="developer_id" class="block text-sm font-medium text-gray-700">Developer</label>
                <select name="developer_id" id="developer_id" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @foreach ($developers as $developer)
                        <option value="{{ $developer->id }}" {{ $developer->id == $errorTracking->developer_id ? 'selected' : '' }}>
                            {{ $developer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Project -->
            <div>
                <label for="project_id" class="block text-sm font-medium text-gray-700">Project</label>
                <select name="project_id" id="project_id" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ $project->id == $errorTracking->project_id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Date -->
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" id="date" value="{{ $errorTracking->date }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Error Type -->
            <div>
                <label for="error_type" class="block text-sm font-medium text-gray-700">Error Type</label>
                <input type="text" name="error_type" id="error_type" value="{{ $errorTracking->error_type }}" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Solution Description -->
            <div>
                <label for="solution_description" class="block text-sm font-medium text-gray-700">Solution Description</label>
                <textarea name="solution_description" id="solution_description" rows="4" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $errorTracking->solution_description }}</textarea>
            </div>

            <!-- Solution Provided By -->
            <div>
                <label for="solution_provided_by" class="block text-sm font-medium text-gray-700">Solution Provided By</label>
                <input type="text" name="solution_provided_by" id="solution_provided_by" value="{{ $errorTracking->solution_provided_by }}" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <input type="text" name="status" id="status" value="{{ $errorTracking->status }}" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Comments -->
            <div>
                <label for="comments" class="block text-sm font-medium text-gray-700">Comments</label>
                <textarea name="comments" id="comments" rows="4"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $errorTracking->comments }}</textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
        </form>
    </div>
</x-app-layout>
