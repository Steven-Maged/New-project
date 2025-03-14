<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('All Tracks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Top Actions: Create New Track Button and Search Form -->
                    <div class="flex items-center justify-between mb-6">
                        

                    <!-- Search Form -->
                    <form  method="GET" action="{{ route('traks.index') }}" class="w-full">
                        <div class="flex items-center w-full">
                            <input  type="text" name="search" value="{{ request('search') }}" placeholder="Search Tracks"
                                class="w-full px-4 py-2 bg-transparent border border-gray-300 rounded-md bg-glass focus:ring focus:ring-indigo-300 focus:outline-none">
                            <button type="submit" class="px-4 py-2 ml-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <i class=" fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <style>
                        .bg-glass {
                            background: rgba(255, 255, 255, 0.2);
                            backdrop-filter: blur(10px);
                            -webkit-backdrop-filter: blur(10px);
                            border: none;
                        }
                    </style>
                </div>

                    <!-- Tracks Grid -->
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach ($traks as $trak)
                            <div class="p-4 bg-gray-100 rounded-lg shadow-md dark:bg-gray-700">
                                <img src="{{ asset('storage/' . $trak->trackPhoto) }}" alt="{{ $trak->trackName }}" class="object-cover w-full h-48 mb-4 rounded-md">
                                <h3 ><a href="{{ route('traks.show', $trak->id) }}" class="text-lg font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-200">
                                    {{ $trak->trackName }}
                                </a></h3>
                                
                                <!-- Action Buttons -->
                                <div class="flex items-center justify-between mt-4">

                                    @if(auth()->user()->role == 'admin')
                                        <!-- Edit Button -->
                                        <a href="{{ route('traks.edit', $trak->id) }}" class="px-4 py-2 text-white bg-yellow-500 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                            {{ __('Edit') }}
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('traks.destroy', $trak->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Courses Button -->
                                    <form action="{{ route('courses.by.trak', $trak->id) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                                            {{ __('Courses') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        <!-- Create New Track Card -->
                        @if(auth()->user()->role == 'admin')
                        <div class="flex flex-col items-center justify-center p-4 transition duration-300 bg-gray-100 rounded-lg shadow-md dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                            <!-- Add Track Icon -->
                            <a href="{{ route('traks.create') }}" class="flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-16 h-48 text-indigo-600 dark:text-indigo-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>

                                <!-- Add Track Text -->
                                <span class="mt-4 text-lg font-semibold text-indigo-600 dark:text-indigo-400">
                                    {{ __('Create New Track') }}
                                </span>
                            </a>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
