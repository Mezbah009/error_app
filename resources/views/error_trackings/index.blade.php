<x-app-layout>

    <!-- Add this to your <head> if you don't have Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <div class="container mx-auto py-8" x-data="{
        showModal: false,
        editModal: false,
        errorTracking: {},
        viewErrorTracking(id) {
            axios.get(`/error_trackings/${id}`)
                .then(response => {
                    this.errorTracking = response.data;
                    this.showModal = true; // Set to true to show the modal
                });
        },
        editErrorTracking(id) {
            axios.get(`/error_trackings/${id}`)
                .then(response => {
                    this.errorTracking = response.data;
                    this.editModal = true; // Set to true to open the edit modal
                });
        }
    }">
        <h1 class="text-2xl font-bold mb-6">Error Tracking</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 w-1/8">Developer</th>
                    <th class="border border-gray-300 px-4 py-2 w-1/8">Project</th>
                    <th class="border border-gray-300 px-4 py-2 w-1/8">Date</th>
                    <th class="border border-gray-300 px-4 py-2 w-1/8">Error Type</th>
                    <th class="border border-gray-300 px-4 py-2 w-2/8">Solution Description</th>
                    <th class="border border-gray-300 px-4 py-2 w-1/8">Solution Provided By</th>
                    <th class="border border-gray-300 px-4 py-2 w-1/8">Status</th>
                    <th class="border border-gray-300 px-4 py-2 w-1/8">Comments</th>
                    <th class="border border-gray-300 px-4 py-2 w-1/8">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Insert Form Row -->
                <tr class="bg-gray-50">
                    <form action="{{ route('error_trackings.store') }}" method="POST">
                        @csrf
                        <td class="border border-gray-300 px-4 py-2">
                            <select name="developer_id" required class="w-full border border-gray-300 rounded-md">
                                <option value="" disabled selected>Select Developer</option>
                                @foreach ($developers as $developer)
                                    <option value="{{ $developer->id }}">{{ $developer->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <select name="project_id" required class="w-full border border-gray-300 rounded-md">
                                <option value="" disabled selected>Select Project</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="date" name="date" required
                                class="w-full border border-gray-300 rounded-md">
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="text" name="error_type" required
                                class="w-full border border-gray-300 rounded-md">
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <textarea name="solution_description" rows="1" required class="w-full border border-gray-300 rounded-md"></textarea>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="text" name="solution_provided_by" required
                                class="w-full border border-gray-300 rounded-md">
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <select name="status" required class="w-full border border-gray-300 rounded-md">
                                <option value="" disabled selected>Select Status</option>
                                <option value="Resolved">Resolved</option>
                                <option value="In Progress">In Progress</option>
                            </select>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <textarea name="comments" rows="1" class="w-full border border-gray-300 rounded-md"></textarea>
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
                        </td>
                    </form>
                </tr>

                <!-- Existing Records -->
                @foreach ($errorTrackings as $errorTracking)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 w-1/8">{{ $errorTracking->developer->name }}</td>
                        <td class="border border-gray-300 px-4 py-2 w-1/8">{{ $errorTracking->project->title }}</td>
                        <td class="border border-gray-300 px-4 py-2 w-1/8">{{ $errorTracking->date }}</td>
                        <td class="border border-gray-300 px-4 py-2 w-1/8">{{ $errorTracking->error_type }}</td>
                        <td class="border border-gray-300 px-4 py-2 w-2/8 truncate" style="max-width: 150px;">
                            {{ $errorTracking->solution_description }}</td>
                        <td class="border border-gray-300 px-4 py-2 w-1/8">{{ $errorTracking->solution_provided_by }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2 w-1/8">{{ $errorTracking->status }}</td>
                        <td class="border border-gray-300 px-4 py-2 w-1/8 truncate" style="max-width: 150px;">
                            {{ $errorTracking->comments }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <div class="flex items-center space-x-2">
                                <button class="text-green-500 hover:text-green-600 focus:outline-none text-sm"
                                    @click="viewErrorTracking({{ $errorTracking->id }})">
                                    <i class="fas fa-eye text-base"></i>
                                </button>
                                <button class="text-blue-500 hover:text-blue-600 focus:outline-none text-sm"
                                    @click="editErrorTracking({{ $errorTracking->id }})">
                                    <i class="fas fa-edit text-base"></i>
                                </button>
                                <form action="{{ route('error_trackings.destroy', $errorTracking) }}" method="POST"
                                    class="inline" onsubmit="return confirm('Are you sure you want to delete this?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-600 focus:outline-none text-sm">
                                        <i class="fas fa-trash-alt text-base"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $errorTrackings->links() }}
        </div>

        <!-- View Modal -->
        <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded shadow-md w-1/2">
                <h2 class="text-lg font-bold mb-4">Error Tracking Details</h2>
                <p><strong>Developer:</strong> <span x-text="errorTracking.developer.name"></span></p>
                <p><strong>Project:</strong> <span x-text="errorTracking.project.title"></span></p>
                <p><strong>Date:</strong> <span x-text="errorTracking.date"></span></p>
                <p><strong>Error Type:</strong> <span x-text="errorTracking.error_type"></span></p>
                <p><strong>Solution Description:</strong> <span x-text="errorTracking.solution_description"></span></p>
                <p><strong>Solution Provided By:</strong> <span x-text="errorTracking.solution_provided_by"></span></p>
                <p><strong>Status:</strong> <span x-text="errorTracking.status"></span></p>
                <p><strong>Comments:</strong> <span x-text="errorTracking.comments"></span></p>
                <button @click="showModal = false"
                    class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Close
                </button>
            </div>
        </div>

        <!-- Edit Modal -->
        <div x-show="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded shadow-md w-2/3">
                <h2 class="text-lg font-bold mb-4">Edit Error Tracking</h2>
                <form :action="'/error_trackings/' + errorTracking.id" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="mb-4">
                            <label class="block text-gray-700">Developer</label>
                            <select name="developer_id" required class="w-full border border-gray-300 rounded-md">
                                <template x-for="developer in {{ $developers->toJson() }}">
                                    <option :value="developer.id"
                                        :selected="developer.id === errorTracking.developer_id"
                                        x-text="developer.name"></option>
                                </template>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Project</label>
                            <select name="project_id" required class="w-full border border-gray-300 rounded-md">
                                <template x-for="project in {{ $projects->toJson() }}">
                                    <option :value="project.id" :selected="project.id === errorTracking.project_id"
                                        x-text="project.title"></option>
                                </template>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Date</label>
                            <input type="date" name="date" required
                                class="w-full border border-gray-300 rounded-md" :value="errorTracking.date">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Error Type</label>
                            <input type="text" name="error_type" required
                                class="w-full border border-gray-300 rounded-md" :value="errorTracking.error_type">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Solution Description</label>
                            <textarea name="solution_description" rows="3" required class="w-full border border-gray-300 rounded-md"
                                x-text="errorTracking.solution_description"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Solution Provided By</label>
                            <input type="text" name="solution_provided_by" required
                                class="w-full border border-gray-300 rounded-md"
                                :value="errorTracking.solution_provided_by">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Status</label>
                            <select name="status" required class="w-full border border-gray-300 rounded-md">
                                <option value="Resolved" :selected="errorTracking.status === 'Resolved'">Resolved
                                </option>
                                <option value="In Progress" :selected="errorTracking.status === 'In Progress'">In
                                    Progress</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Comments</label>
                            <textarea name="comments" rows="3" class="w-full border border-gray-300 rounded-md"
                                x-text="errorTracking.comments"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="button" @click="editModal = false"
                            class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
