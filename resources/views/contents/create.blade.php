<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create New Content') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Create Content Form -->
                    <form id="contentForm" action="{{ route('contents.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Video Upload -->
                        <div class="mb-4">
                            <label for="video" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Upload Video') }}</label>
                            <input type="file" name="video" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" accept="video/*" required>
                        </div>

                        <!-- Content Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Title') }}</label>
                            <input type="text" name="title" class="block w-full mt-1 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white" required>
                        </div>
                        
                        <!-- Course Description -->
                        <div>
                            <x-label for="description" value="{{ __('Vedio Description') }}" />
                            <textarea name="description" id="description" class="block w-full mt-1 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white" rows="4" required></textarea>
                            <x-input-error for="description" class="mt-2" />
                        </div>

                        <!-- Select Course -->
                        <div class="mb-4">
                            <label for="course_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Select Course') }}</label>
                            <select name="course_id" class="block w-full mt-1 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white" required>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->courseName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <x-button type="submit" class="px-6 py-2 ml-4 text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                {{ __('Create') }}
                            </x-button>
                        </div>
                    </form>

                    <div class="mt-6">
                    <a href="{{ route('contents.index') }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                        {{ __('Back to All Contents') }}
                    </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Loading Screen -->
    <div id="loadingScreen" class="fixed top-0 left-0 z-50 flex items-center justify-center hidden w-full h-full bg-black bg-opacity-50">
        <div class="text-white spinner-border" role="status">
            <span class="visually-hidden">{{ __('Loading...') }}</span>
        </div>
    </div>

    <script>
        // Display loading screen on form submit
        document.getElementById('contentForm').addEventListener('submit', function () {
            document.getElementById('loadingScreen').classList.remove('hidden');
        });
    </script>
</x-app-layout>
