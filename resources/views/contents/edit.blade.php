<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Content') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Edit Content Form -->
                    <form action="{{ route('contents.update', $content->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Content Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Title') }}</label>
                            <input type="text" name="title" value="{{ old('title', $content->title) }}" class="block w-full mt-1 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white" required>
                        </div>

                        <!-- Select Course -->
                        <div class="mb-4">
                            <label for="course_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Select Course') }}</label>
                            <select name="course_id" class="block w-full mt-1 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white" required>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}" {{ $content->course_id == $course->id ? 'selected' : '' }}>
                                        {{ $course->courseName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Current Video Display -->
                        <div class="mb-4">
                            <label for="video" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Current Video') }}</label>
                            <div>
                                <video width="60%" height="auto" controls>
                                    <source src="{{ asset('storage/' . $content->url) }}" type="video/mp4">
                                    {{ __('Your browser does not support the video tag.') }}
                                </video>
                            </div>
                        </div>

                        <!-- Upload New Video (Optional) -->
                        <div class="mb-4">
                            <label for="video" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Upload New Video (Optional)') }}</label>
                            <input type="file" name="video" accept="video/*" class="block w-full mt-1 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white">
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <x-button type="submit" class="px-6 py-2 ml-4 text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                {{ __('Update Content') }}
                            </x-button>
                        </div>

                    </form>

                    <!-- Back to All Contents Button -->
                    <div class="mt-6">
                    <a href="{{ route('contents.index') }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                        {{ __('Back to All Contents') }}
                    </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
