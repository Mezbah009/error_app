<x-app-layout>

    @section('content')
        <div class="container mx-auto py-8">
            <h1 class="text-2xl font-bold mb-6">Edit User</h1>

            <form action="{{ route('users.update', $user) }}" method="POST"
                class="max-w-lg mx-auto bg-white p-6 rounded shadow">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full border border-gray-300 rounded px-4 py-2" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full border border-gray-300 rounded px-4 py-2" required>
                </div>

                <div class="mb-4">
                    <label for="employee_id" class="block text-sm font-medium text-gray-700">Employee Id</label>
                    <input type="text" id="employee_id" name="employee_id"
                        value="{{ old('employee_id', $user->employee_id) }}"
                        class="w-full border border-gray-300 rounded px-4 py-2" required>
                    @error('employee_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password (Optional)</label>
                    <input type="password" id="password" name="password"
                        class="w-full border border-gray-300 rounded px-4 py-2">
                </div>

                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select id="role" name="role" class="w-full border border-gray-300 rounded px-4 py-2" required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->value }}" {{ $user->role === $role->value ? 'selected' : '' }}>
                                {{ ucfirst($role->value) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('users.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Cancel</a>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </x-app-layout>
