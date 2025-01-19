<x-app-layout>
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Edit Project</h1>
            <a href="{{ route('projects.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to Projects</a>
        </div>

        <form action="{{ route('projects.update', $project) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Project Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('title')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>


            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Project</button>
            </div>
        </form>
    </div>
</x-app-layout>
