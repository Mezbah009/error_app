<x-app-layout>
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Projects</h1>
            <a href="{{ route('projects.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Project</a>
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
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    {{-- <th class="border border-gray-300 px-4 py-2">Description</th> --}}
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $project->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $project->title }}</td>
                    {{-- <td class="border border-gray-300 px-4 py-2">{{ $project->description }}</td> --}}
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('projects.edit', $project) }}" class="text-blue-500 hover:underline">Edit</a>
                        |
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination links -->
        <div class="mt-6">
            {{ $projects->links() }}  <!-- Tailwind pagination links -->
        </div>
    </div>

</x-app-layout>

