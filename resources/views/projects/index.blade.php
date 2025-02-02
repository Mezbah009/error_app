<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>


    <div class="container mx-auto py-8" x-data="{
        createModal: false,
        editModal: false,
        newProject: {
            title: '',
            description: ''
        },
        editProject: {
            id: '',
            title: '',
            description: ''
        },
        openCreateModal() {
            this.createModal = true;
        },
        openEditModal(project) {
            this.editProject = { ...project };
            this.editModal = true;
        },
        closeCreateModal() {
            this.createModal = false;
        },
        closeEditModal() {
            this.editModal = false;
        }
    }">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Projects List</h1>
            <button @click="openCreateModal" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add
                Project</button>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-center">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $project->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $project->title }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <!-- Edit Button -->
                            <button @click="openEditModal({{ $project->toJson() }})" aria-label="Edit Project">
                                <svg class="w-6 h-6 text-blue-500 hover:text-blue-600"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                </svg>
                            </button>
                            |
                            <!-- Delete Button -->
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline"
                                onsubmit="return confirm('Are you sure you want to delete this project?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" aria-label="Delete Project">
                                    <svg class="w-6 h-6 text-red-500 hover:text-red-600"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                    </svg>
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination links -->
        <div class="mt-6">
            {{ $projects->links() }} <!-- Tailwind pagination links -->
        </div>

        <!-- Create Project Modal -->
        <div x-show="createModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded shadow-md w-2/5">
                <h2 class="text-lg font-bold mb-4">Create Project</h2>
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700">Project Title</label>
                        <input type="text" name="title" required class="w-full border border-gray-300 rounded-md"
                            x-model="newProject.title">
                    </div>

                    {{-- <div class="mb-4">
                        <label class="block text-gray-700">Description</label>
                        <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-md"
                            x-model="newProject.description"></textarea>
                    </div> --}}

                    <div class="flex justify-end mt-6">
                        <button type="button" @click="closeCreateModal"
                            class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Project Modal -->
        <div x-show="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded shadow-md w-2/5">
                <h2 class="text-lg font-bold mb-4">Edit Project</h2>
                <form action="{{ route('projects.update', 'dummy') }}" method="POST"
                    :action="'/projects/' + editProject.id">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700">Project Title</label>
                        <input type="text" name="title" required class="w-full border border-gray-300 rounded-md"
                            x-model="editProject.title">
                    </div>

                    {{-- <div class="mb-4">
                        <label class="block text-gray-700">Description</label>
                        <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-md"
                            x-model="editProject.description"></textarea>
                    </div> --}}

                    <div class="flex justify-end mt-6">
                        <button type="button" @click="closeEditModal"
                            class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</x-app-layout>
