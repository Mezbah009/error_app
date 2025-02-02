<x-app-layout>

    @section('content')
        <div class="container mx-auto py-8">
            <h1 class="text-2xl font-bold mb-6">Edit Project</h1>

            <form action="{{ route('projects.update', $project) }}" method="POST"
                class="max-w-lg mx-auto bg-white p-6 rounded shadow">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>

                    @error('title')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('projects.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Cancel</a>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </x-app-layout>


