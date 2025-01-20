<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Create Error Tracking</h1>

        <form action="{{ route('error_trackings.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="developer_id" class="block text-sm font-medium text-gray-700">Developer</label>
                <select name="developer_id" id="developer_id" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>Select a Developer</option>
                    @foreach ($developers as $developer)
                        <option value="{{ $developer->id }}">{{ $developer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="project_id" class="block text-sm font-medium text-gray-700">Project</label>
                <select name="project_id" id="project_id" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>Select a Project</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->title }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" id="date" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="error_type" class="block text-sm font-medium text-gray-700">Error Type</label>
                <input type="text" name="error_type" id="error_type" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="solution_description" class="block text-sm font-medium text-gray-700">Solution
                    Description</label>
                <textarea name="solution_description" id="solution_description" rows="4" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <div>
                <label for="solution_provided_by" class="block text-sm font-medium text-gray-700">Solution Provided
                    By</label>
                <input type="text" name="solution_provided_by" id="solution_provided_by" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>Select Status</option>
                    <option value="Resolved">Resolved</option>
                    <option value="In Progress">In Progress</option>
                </select>
            </div>


            <div>
                <label for="comments" class="block text-sm font-medium text-gray-700">Comments</label>
                <textarea name="comments" id="comments" rows="4"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
        </form>
    </div>
</x-app-layout>
