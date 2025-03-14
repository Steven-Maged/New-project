<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('All Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Add New User Button -->
                    <div class="mb-4">
                        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 font-semibold text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            {{ __('Add New User') }}
                        </a>
                    </div>
                    <!-- Users List -->
                    <ul class="space-y-4">
                        @foreach($users as $user)
                        @if(auth()->user()->name == $user->name)
                            @continue
                        @endif
                            <li class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex items-center">
                                    <!-- Display Profile Image -->
                                    <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&color=7F9CF5&background=EBF4FF' }}" 
                                            alt="{{ $user->name }}" 
                                            class="object-cover w-12 h-12 mr-4 rounded-full">
                                    <span class="text-lg font-semibold text-indigo-600 dark:text-indigo-400">
                                        {{ $user->name }}
                                    </span>
                                </div>

                                <div class="flex space-x-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center px-4 py-2 font-semibold text-white bg-yellow-500 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                        {{ __('Edit') }}
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-4 py-2 font-semibold text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
