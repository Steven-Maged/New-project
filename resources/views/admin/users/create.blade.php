<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900">Add New User</h1>
    </x-slot>

    <div class="container p-4 mx-auto">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-900">Name</label>
                <input type="text" name="name" id="name" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                <input type="email" name="email" id="email" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                <input type="password" name="password" id="password" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-900">Role</label>
                <select name="role" id="role" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md" required>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
    </div>
</x-app-layout>
