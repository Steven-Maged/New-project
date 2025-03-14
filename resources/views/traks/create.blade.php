<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create a New Track') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form Heading -->
                    <h1 class="mb-4 text-2xl font-bold">{{ __('Create a New Track') }}</h1>

                    <!-- Form Start -->
                    <form action="{{ route('traks.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Track Name -->
                        <div>
                            <x-label for="trackName" value="{{ __('Track Name') }}" />
                            <x-input id="trackName" type="text" name="trackName" class="block w-full mt-1" required />
                            <x-input-error for="trackName" class="mt-2" />
                        </div>

                        <!-- Track Photo -->
                        <div>
                            <x-label for="trackPhoto" value="{{ __('Track Photo') }}" />
                            <x-input id="trackPhoto" type="file" name="trackPhoto" class="block w-full mt-1" required />
                            <x-input-error for="trackPhoto" class="mt-2" />
                        </div>

                        <!-- Track Description -->
                        <div>
                            <x-label for="trackDescription" value="{{ __('Track Description') }}" />
                            <textarea id="trackDescription" name="trackDescription" 
                                      class="block w-full mt-1 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white"
                                      rows="4" required></textarea>
                            <x-input-error for="trackDescription" class="mt-2" />
                        </div>

                        <!-- Track Category -->
                        <div>
                            <x-label for="trackCategory" value="{{ __('Track Category') }}" />
                            <x-input id="trackCategory" type="text" name="trackCategory" class="block w-full mt-1" required />
                            <x-input-error for="trackCategory" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="px-6 py-2 ml-4 text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                {{ __('Add Track') }}
                            </x-button>
                        </div>
                    </form>
                    <!-- Form End -->

                    <!-- Back to All Tracks -->
                    <div class="mt-6">
                        <a href="{{ route('traks.index') }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                            {{ __('Back to All Tracks') }}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
