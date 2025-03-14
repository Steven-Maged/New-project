<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ $trak->trackName }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <img 
                            src="{{ asset('storage/' . $trak->trackPhoto) }}" 
                            alt="{{ $trak->trackName }}" 
                            class="w-full h-auto max-w-md rounded shadow-md"
                        >
                    </div>
                    <h1 class="mb-4 text-2xl font-bold">{{ $trak->trackName }}</h1>
                    <p class="mb-4">{{ $trak->trackDescription }}</p>
                    <p class="mb-4"><strong>Category:</strong> {{ $trak->trackCategory }}</p>
                    <a href="{{ url()->previous() }}"  class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                        {{ __('Back to All Traks') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
