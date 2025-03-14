<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="mb-4 text-2xl font-bold">{{ __('Edit Course') }}</h1>

                    <!-- Form Start -->
                    <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Course Name -->
                        <div>
                            <x-label for="courseName" value="{{ __('Course Name') }}" />
                            <x-input id="courseName" type="text" name="courseName" value="{{ $course->courseName }}" class="block w-full mt-1" required />
                            <x-input-error for="courseName" class="mt-2" />
                        </div>

                        <!-- Course Description -->
                        <div>
                            <x-label for="courseDescription" value="{{ __('Course Description') }}" />
                            <textarea name="courseDescription" id="courseDescription" class="block w-full mt-1 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white" rows="4" required>{{ $course->courseDescription }}</textarea>
                            <x-input-error for="courseDescription" class="mt-2" />
                        </div>

                        <!-- Track -->
                        <div>
                            <x-label for="track_id" value="{{ __('Track') }}" />
                            <select name="track_id" id="track_id" class="block w-full mt-1 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white" required>
                                @foreach ($traks as $trak)
                                    <option value="{{ $trak->id }}" {{ $trak->id == $course->track_id ? 'selected' : '' }}>
                                        {{ $trak->trackName }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error for="track_id" class="mt-2" />
                        </div>

                        <!-- Course Photo -->
                        <div>
                            <x-label for="coursePhoto" value="{{ __('Course Photo') }}" />
                            <x-input id="coursePhoto" type="file" name="coursePhoto" class="block w-full mt-1" />
                            <x-input-error for="coursePhoto" class="mt-2" />
                        </div>

                        <!-- Price -->
                        <div>
                            <x-label for="Price" value="{{ __('Price') }}" />
                            <x-input id="Price" type="number" name="Price" value="{{ $course->Price }}" min="0" class="block w-full mt-1" required />
                            <x-input-error for="Price" class="mt-2" />
                        </div>

                        <!-- Bay State -->
                        <div>
                            <x-label for="bayState" value="{{ __('Bay State') }}" />
                            <select name="bayState" id="bayState" class="block w-full mt-1 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white" required>
                                <option value="1" {{ $course->bayState ? 'selected' : '' }}>{{ __('Available') }}</option>
                                <option value="0" {{ !$course->bayState ? 'selected' : '' }}>{{ __('Not Available') }}</option>
                            </select>
                            <x-input-error for="bayState" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="px-6 py-2 ml-4 text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                    <!-- Form End -->

                    <!-- Back to All Courses -->
                    <div class="mt-6">
                        <a href="{{ route('courses.index') }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                            {{ __('Back to All Courses') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
