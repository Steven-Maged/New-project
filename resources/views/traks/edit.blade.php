<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Track') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="mb-4 text-2xl font-bold">{{ __('Edit Track') }}</h1>

                    <!-- Form Start -->
                    <form action="{{ route('traks.update', $trak->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Track Name -->
                        <div>
                            <x-label for="trackName" value="{{ __('Track Name') }}" />
                            <x-input id="trackName" type="text" name="trackName" class="block w-full mt-1" 
                                     value="{{ old('trackName', $trak->trackName) }}" required autofocus />
                            <x-input-error for="trackName" class="mt-2" />
                        </div>

                        <!-- Track Description -->
                        <div>
                            <x-label for="trackDescription" value="{{ __('Track Description') }}" />
                            <textarea id="trackDescription" name="trackDescription" 
                                      class="block w-full mt-1 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900"
                                      rows="4" required>{{ old('trackDescription', $trak->trackDescription) }}</textarea>
                            <x-input-error for="trackDescription" class="mt-2" />
                        </div>

                        <!-- Track Image -->
                        <div>
                            <x-label for="trackPhoto" value="{{ __('Track Image') }}" />
                            <x-input id="trackPhoto" type="file" name="trackPhoto" class="block w-full mt-1" accept="image/*" />
                            <x-input-error for="trackPhoto" class="mt-2" />
                        </div>

                        <!-- Current Image Preview -->
                        @if ($trak->trackPhoto)
                            <div class="mt-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Current Image:') }}</p>
                                <img src="{{ asset('storage/' . $trak->trackPhoto) }}" alt="{{ $trak->trackName }}" class="w-32 h-32 rounded shadow-md">
                            </div>
                        @endif

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Update Track') }}
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
