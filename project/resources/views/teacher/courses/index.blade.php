<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage courses') }}
        </h2>
        <!-- Add User Button -->
        <button
            class="ml-4 px-4 py-2 bg-green-500 text-black font-semibold rounded-lg border border-blue-700 hover:bg-green-600 focus:outline-none"
            onclick="toggleAddCourseModal(true)">
            + Add Course
        </button>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>I am an admin!</p>

                    <!-- Users Table -->
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full text-left border-collapse border border-gray-200">
                            <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">ID</th>
                                <th class="border border-gray-300 px-4 py-2">Title</th>
                                <th class="border border-gray-300 px-4 py-2">Description</th>
                                <th class="border border-gray-300 px-4 py-2">Teacher</th>
                                <th class="border border-gray-300 px-4 py-2">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($courses as $course)
                                <tr class="hover:bg-gray-100">
                                    <td class="border border-gray-300 px-4 py-2">{{ $course->id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $course->title }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $course->description }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $course->teacher?->name }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ route('teacher.manage.courses.edit', $course->uuid) }}"
                                           class="text-blue-500 hover:underline">Edit</a>
                                        <form action="{{ route('teacher.manage.courses.destroy', $course->uuid) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-500 hover:underline ml-2"
                                                    onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Course Modal -->
    <div id="addCourseModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center {{ $errors->any() ? '' : 'hidden' }}">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4">Add New Course</h3>
            <form method="POST" action="{{ route('teacher.manage.courses.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <textarea  name="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                    @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="toggleAddCourseModal(false)" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-green-500 text-black font-semibold rounded-lg border border-blue-700 rounded hover:bg-green-600">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript for Modal -->
    <script>
        function toggleAddCourseModal(show) {
            const modal = document.getElementById('addCourseModal');
            if (show) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>
