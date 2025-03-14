<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ $course->courseName }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            
            
            <div class="flex items-center">
                <!-- Display Profile Image -->
                <img src="{{ $users[$course->user_id]->profile_photo_path ? asset('storage/' . $users[$course->user_id]->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($users[$course->user_id]->name) . '&color=7F9CF5&background=EBF4FF' }}" 
                        alt="{{ $users[$course->user_id]->name }}" 
                        class="object-cover w-12 h-12 mr-4 rounded-full">
                <span class="text-lg font-semibold text-indigo-600 dark:text-indigo-400">
                    {{ $users[$course->user_id]->name }}
                </span>
            </div>


            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Course Image -->
                    <div class="mb-4">
                        <img 
                            src="{{ asset('storage/' . $course->coursePhoto) }}" 
                            alt="{{ $course->courseName }}" 
                            class="object-cover w-full h-64 rounded-lg shadow-md"
                        >
                    </div>

                    <video id="main-video" width="100%" height="400" controls class="rounded-lg" >
                            <source id="main-video-source" 
                                    src="{{ asset('storage/' . $course->intro_video) }}" 
                                    type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                    <!-- Course Details -->
                    <div class="mb-4">
                        <p class="text-lg font-semibold"><strong>Description:</strong> {{ $course->courseDescription }}</p>
                        <p class="text-lg font-semibold"><strong>Category:</strong> {{ $course->track->trackName ?? 'No category available' }}</p>
                        <p class="text-lg font-semibold"><strong>Price:</strong> ${{ $course->Price }}</p>
                        <p class="text-lg font-semibold"><strong>State:</strong> {{ $course->bayState ? 'Available' : 'Not Available' }}</p>
                    </div>

                    <!-- Back to All Courses -->
                    <div class="mt-6">
                        <a href="{{ url()->previous() }}" 
                            class="text-gray-900 btn btn-secondary dark:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-700">
                            {{ __('Back to  Courses') }}
                         </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
