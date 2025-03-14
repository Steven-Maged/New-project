<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('All Contents') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">



                    <!-- Contents List -->
                    <ul class="space-y-4">
                        @foreach ($contents as $content)
                            <li class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex items-center">
                                    <video width="200" height="120" controls class="mr-4 rounded-lg">
                                        <source src="{{ asset('storage/' . $content->url) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <a href="{{ route('contents.show', $content->id) }}" class="text-lg font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-200">
                                        {{ $content->title }}
                                    </a>
                                </div>

                                <div class="flex space-x-2">
                                    @if(auth()->user()->role == 'admin')
                                        <!-- Edit Button -->
                                        <a href="{{ route('contents.edit', $content->id) }}" class="inline-flex items-center px-4 py-2 font-semibold text-white bg-yellow-500 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                            {{ __('Edit') }}
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('contents.destroy', $content->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-4 py-2 font-semibold text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </li>
                            @endforeach
                            <!-- Create New Content Link -->
                            @if(auth()->user()->role == 'admin')
                            <li class="flex items-center justify-between p-4 bg-gray-100 rounded-lg shadow-md hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600">
                                <a href="{{ route('contents.create') }}" class="flex items-center w-full">
                                    <div class="flex items-center">
                                        <!-- Placeholder Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" 
                                            class="w-16 h-16 mr-4 text-indigo-600 dark:text-indigo-400 sm:w-20 sm:h-20">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        <!-- Add Course Text -->
                                        <span class="text-lg font-semibold text-indigo-600 dark:text-indigo-400">
                                            {{ __('Add New Content') }}
                                        </span>
                                    </div>
                                </a>
                            </li>
                        @endif
                    </ul>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
