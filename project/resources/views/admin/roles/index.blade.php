<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Roles and Permissions') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Roles Table -->
                <table class="min-w-full table-auto">
                    <thead>
                    <tr>
                        <th class="px-4 py-2">Role Name</th>
                        <th class="px-4 py-2">Permissions</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td class="px-4 py-2">{{ $role->name }}</td>
                            <td class="px-4 py-2">
                                @foreach($role->permissions as $permission)
                                    <span class="badge badge-info">{{ $permission->name }}</span>|
                                @endforeach
                            </td>
                            <td class="px-4 py-2">
                                <button
                                    class="px-4 py-2 bg-blue-500 text-black font-semibold rounded-lg border border-blue-700 rounded-md hover:bg-blue-600"
                                    onclick="openEditModal({{ $role->id }})">
                                    Edit Permissions
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Role Permissions -->
    <div id="roleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex justify-center items-center h-full">
            <div class="bg-white p-6 rounded-md w-1/3">
                <h2 class="text-xl font-semibold mb-4">Edit Role Permissions</h2>
                <form action="{{ route('admin.manage.roles.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="role_id" id="role_id">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Role</label>
                        <select name="role" id="role" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2" disabled>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Permissions</label>
                        <select name="permissions[]" id="permissions" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2" multiple>
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-black font-semibold rounded-lg border border-blue-700 rounded-md hover:bg-blue-500">
                        Save Changes
                    </button>
                    <button type="button" class="ml-2 px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600" onclick="closeModal()">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(roleId) {
            // Find the role and permissions
            const role = @json($roles);
            const selectedRole = role.find(r => r.id === roleId);

            // Open the modal
            const modal = document.getElementById('roleModal');
            modal.classList.remove('hidden');

            // Set the role ID
            document.getElementById('role_id').value = selectedRole.id;
            document.getElementById('role').value = selectedRole.id;

            // Set the permissions (mark selected)
            const permissions = selectedRole.permissions.map(p => p.id);
            const permissionSelect = document.getElementById('permissions');

            Array.from(permissionSelect.options).forEach(option => {
                if (permissions.includes(parseInt(option.value))) {
                    option.selected = true;
                }
            });
        }

        function closeModal() {
            const modal = document.getElementById('roleModal');
            modal.classList.add('hidden');
        }
    </script>
</x-app-layout>
